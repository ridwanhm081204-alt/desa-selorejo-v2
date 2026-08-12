<?php

namespace App\Services;

use App\Models\DataPenduduk;
use App\Models\ImportBatch;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class DataPendudukImportService
{
    public const EXPECTED_HEADERS = [
        'NKK',
        'NIK',
        'NAMA',
        'TEMPAT LAHIR',
        'TANGGAL LAHIR',
        'STS KAWIN',
        'KELAMIN',
        'ALAMAT',
        'RT',
        'RW',
        'USIA',
        'PEKERJAAN',
    ];

    /**
     * Parses Excel file, validates structure and rows, returns preview summary.
     */
    public function parseAndPreview(string $fullPath, string $originalFilename): array
    {
        $reader = IOFactory::createReaderForFile($fullPath);
        $reader->setReadDataOnly(true);
        $reader->setReadEmptyCells(false);
        $spreadsheet = $reader->load($fullPath);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray(null, false, false, true);

        if (empty($rows)) {
            throw new \InvalidArgumentException('File Excel kosong atau tidak dapat dibaca.');
        }

        // Header check on row 1
        $headerRow = array_values(array_filter($rows[1] ?? [], fn($v) => $v !== null));
        $normalizedHeaders = array_map(fn($h) => strtoupper(trim((string)$h)), array_slice($headerRow, 0, 12));

        $expectedUpper = array_map('strtoupper', self::EXPECTED_HEADERS);

        if (count($normalizedHeaders) < count($expectedUpper)) {
            throw new \InvalidArgumentException(
                'Header kolom Excel tidak sesuai template. Membutuhkan 12 kolom: ' . implode(', ', self::EXPECTED_HEADERS)
            );
        }

        for ($i = 0; $i < count($expectedUpper); $i++) {
            if ($normalizedHeaders[$i] !== $expectedUpper[$i]) {
                throw new \InvalidArgumentException(
                    "Header kolom ke-" . ($i + 1) . " salah. Ditemukan: '{$normalizedHeaders[$i]}', Seharusnya: '{$expectedUpper[$i]}'"
                );
            }
        }

        $totalRows = 0;
        $validRows = [];
        $failedDetails = [];
        $newCount = 0;
        $updateCount = 0;
        $seenNiksInFile = [];

        // Fetch existing NIKs in DB for fast duplicate checking
        $existingNiks = DataPenduduk::withTrashed()->pluck('id', 'nik')->toArray();

        // Process data rows starting from line 2
        for ($rowIndex = 2; $rowIndex <= count($rows); $rowIndex++) {
            $row = $rows[$rowIndex] ?? [];
            
            // Check if entire row is empty
            $isEmptyRow = true;
            foreach ($row as $cell) {
                if ($cell !== null && trim((string)$cell) !== '') {
                    $isEmptyRow = false;
                    break;
                }
            }
            if ($isEmptyRow) {
                continue;
            }

            $totalRows++;

            $rawNkk = trim((string)($row['A'] ?? ''));
            $rawNik = trim((string)($row['B'] ?? ''));
            $rawNama = trim((string)($row['C'] ?? ''));
            $rawTempatLahir = trim((string)($row['D'] ?? ''));
            $rawTanggalLahir = $row['E'] ?? null;
            $rawStsKawin = trim((string)($row['F'] ?? ''));
            $rawKelamin = trim((string)($row['G'] ?? ''));
            $rawAlamat = trim((string)($row['H'] ?? ''));
            $rawRt = trim((string)($row['I'] ?? ''));
            $rawRw = trim((string)($row['J'] ?? ''));
            $rawUsia = $row['K'] ?? null;
            $rawPekerjaan = trim((string)($row['L'] ?? ''));

            $errors = [];

            // 1. Mandatory NKK validation (16 digits string)
            if ($rawNkk === '') {
                $errors[] = 'NKK wajib diisi';
            } elseif (!preg_match('/^\d{16}$/', $rawNkk)) {
                $errors[] = 'NKK harus 16 digit angka';
            }

            // 2. Mandatory NIK validation (16 digits string)
            if ($rawNik === '') {
                $errors[] = 'NIK wajib diisi';
            } elseif (!preg_match('/^\d{16}$/', $rawNik)) {
                $errors[] = 'NIK harus 16 digit angka';
            } elseif (isset($seenNiksInFile[$rawNik])) {
                $errors[] = 'NIK duplikat pada baris ' . $seenNiksInFile[$rawNik] . ' di file Excel';
            }

            // 3. Mandatory NAMA validation
            if ($rawNama === '') {
                $errors[] = 'NAMA wajib diisi';
            }

            // 4. Mandatory KELAMIN validation
            $kelaminUpper = strtoupper($rawKelamin);
            if (in_array($kelaminUpper, ['L', 'LAKI-LAKI', 'LAKI LAKI', 'MALE', 'PRIA'])) {
                $gender = 'L';
            } elseif (in_array($kelaminUpper, ['P', 'PEREMPUAN', 'FEMALE', 'WANITA'])) {
                $gender = 'P';
            } else {
                $errors[] = 'KELAMIN wajib diisi (L atau P)';
                $gender = null;
            }

            if (!empty($errors)) {
                $failedDetails[] = [
                    'row' => $rowIndex,
                    'nik' => $rawNik ?: '-',
                    'nama' => $rawNama ?: '-',
                    'reason' => implode('; ', $errors),
                ];
                continue;
            }

            // Record seen NIK in file
            $seenNiksInFile[$rawNik] = $rowIndex;

            // Optional fields formatting
            $tempatLahir = ($rawTempatLahir !== '' && $rawTempatLahir !== '-') ? $rawTempatLahir : '-';
            
            // Tanggal lahir parsing
            $tanggalLahir = self::parseTanggalLahir($rawTanggalLahir);
            
            // Status kawin formatting
            $statusKawin = self::formatStatusKawin($rawStsKawin);
            
            // Alamat
            $alamat = ($rawAlamat !== '' && $rawAlamat !== '-') ? $rawAlamat : '-';
            
            // RT & RW padding
            $rt = self::formatRtRw($rawRt);
            $rw = self::formatRtRw($rawRw);

            // Usia input fallback
            $usiaInput = (is_numeric($rawUsia) && (int)$rawUsia >= 0) ? (int)$rawUsia : null;

            // Pekerjaan
            $pekerjaan = ($rawPekerjaan !== '' && $rawPekerjaan !== '-') ? $rawPekerjaan : '-';

            // Check action (Insert vs Update)
            $isUpdate = isset($existingNiks[$rawNik]);
            if ($isUpdate) {
                $updateCount++;
            } else {
                $newCount++;
            }

            $validRows[] = [
                'row_index' => $rowIndex,
                'nkk' => $rawNkk,
                'nik' => $rawNik,
                'nama' => $rawNama,
                'tempat_lahir' => $tempatLahir,
                'tanggal_lahir' => $tanggalLahir ? $tanggalLahir->format('Y-m-d') : null,
                'tanggal_lahir_formatted' => $tanggalLahir ? $tanggalLahir->format('d/m/Y') : '-',
                'status_kawin' => $statusKawin,
                'jenis_kelamin' => $gender,
                'alamat' => $alamat,
                'rt' => $rt,
                'rw' => $rw,
                'usia_input' => $usiaInput,
                'pekerjaan' => $pekerjaan,
                'action' => $isUpdate ? 'update' : 'insert',
                'kelompok_usia' => DataPenduduk::determineKelompokUsia($tanggalLahir, $usiaInput),
            ];
        }

        return [
            'original_filename' => $originalFilename,
            'total_rows' => $totalRows,
            'valid_count' => count($validRows),
            'failed_count' => count($failedDetails),
            'new_count' => $newCount,
            'update_count' => $updateCount,
            'failed_details' => $failedDetails,
            'valid_rows' => $validRows,
        ];
    }

    /**
     * Commits previewed valid rows into database inside transaction.
     */
    public function commitImport(array $validRows, array $failedDetails, string $originalFilename, string $tempFilePath, int $userId): ImportBatch
    {
        return DB::transaction(function () use ($validRows, $failedDetails, $originalFilename, $tempFilePath, $userId) {
            // Save file into private storage
            Storage::disk('local')->makeDirectory('imports');
            $permanentFileName = 'imports/' . date('Ymd_His') . '_' . uniqid() . '.xlsx';
            if (file_exists($tempFilePath)) {
                Storage::disk('local')->put($permanentFileName, file_get_contents($tempFilePath));
                @unlink($tempFilePath);
            }

            $batch = ImportBatch::create([
                'filename' => $originalFilename,
                'file_path' => $permanentFileName,
                'total_rows' => count($validRows) + count($failedDetails),
                'success_rows' => count($validRows),
                'failed_rows' => count($failedDetails),
                'failed_details' => $failedDetails,
                'uploaded_by' => $userId,
            ]);

            foreach ($validRows as $row) {
                $penduduk = DataPenduduk::withTrashed()->where('nik', $row['nik'])->first();

                if ($penduduk) {
                    if ($penduduk->trashed()) {
                        $penduduk->restore();
                    }
                    $penduduk->fill([
                        'nkk' => $row['nkk'],
                        'nama' => $row['nama'],
                        'tempat_lahir' => $row['tempat_lahir'],
                        'tanggal_lahir' => $row['tanggal_lahir'],
                        'status_kawin' => $row['status_kawin'],
                        'jenis_kelamin' => $row['jenis_kelamin'],
                        'alamat' => $row['alamat'],
                        'rt' => $row['rt'],
                        'rw' => $row['rw'],
                        'usia_input' => $row['usia_input'],
                        'pekerjaan' => $row['pekerjaan'],
                        'sumber_import_id' => $batch->id,
                        'updated_by' => $userId,
                    ]);
                    $penduduk->save();
                } else {
                    DataPenduduk::create([
                        'nkk' => $row['nkk'],
                        'nik' => $row['nik'],
                        'nama' => $row['nama'],
                        'tempat_lahir' => $row['tempat_lahir'],
                        'tanggal_lahir' => $row['tanggal_lahir'],
                        'status_kawin' => $row['status_kawin'],
                        'jenis_kelamin' => $row['jenis_kelamin'],
                        'alamat' => $row['alamat'],
                        'rt' => $row['rt'],
                        'rw' => $row['rw'],
                        'usia_input' => $row['usia_input'],
                        'pekerjaan' => $row['pekerjaan'],
                        'sumber_import_id' => $batch->id,
                        'created_by' => $userId,
                        'updated_by' => $userId,
                    ]);
                }
            }

            return $batch;
        });
    }

    /**
     * Rollbacks an entire import batch.
     */
    public function rollbackBatch(int $batchId): bool
    {
        return DB::transaction(function () use ($batchId) {
            $batch = ImportBatch::findOrFail($batchId);
            
            // Soft delete data penduduk imported in this batch
            DataPenduduk::where('sumber_import_id', $batch->id)->delete();

            // Soft delete batch
            $batch->delete();

            return true;
        });
    }

    /**
     * Parses date values from Excel cell (supports text DD/MM/YYYY, YYYY-MM-DD, or Excel serial numbers).
     */
    public static function parseTanggalLahir($cellValue): ?Carbon
    {
        if ($cellValue === null || trim((string)$cellValue) === '' || trim((string)$cellValue) === '-') {
            return null;
        }

        // If numeric, handle Excel serial date
        if (is_numeric($cellValue)) {
            try {
                $dt = ExcelDate::excelToDateTimeObject((float)$cellValue);
                return Carbon::instance($dt);
            } catch (\Exception $e) {
                return null;
            }
        }

        $str = trim((string)$cellValue);

        // Try standard format DD/MM/YYYY
        if (preg_match('/^(\d{1,2})[\/\-](\d{1,2})[\/\-](\d{4})$/', $str, $matches)) {
            try {
                return Carbon::createFromDate((int)$matches[3], (int)$matches[2], (int)$matches[1]);
            } catch (\Exception $e) {
                return null;
            }
        }

        // Try matching YYYY-MM-DD or YYYY年MM月DD日
        if (preg_match('/(\d{4})[^\d]+(\d{1,2})[^\d]+(\d{1,2})/', $str, $matches)) {
            try {
                return Carbon::createFromDate((int)$matches[1], (int)$matches[2], (int)$matches[3]);
            } catch (\Exception $e) {
                return null;
            }
        }

        try {
            return Carbon::parse($str);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Normalizes status kawin value.
     */
    public static function formatStatusKawin(string $val): string
    {
        $trimmed = trim($val);
        if ($trimmed === '' || $trimmed === '-') {
            return '-';
        }

        $upper = strtoupper($trimmed);
        if ($upper === 'S' || $upper === 'K' || str_contains($upper, 'KAWIN') || str_contains($upper, 'MENIKAH')) {
            return 'Kawin';
        } elseif ($upper === 'B' || str_contains($upper, 'BELUM')) {
            return 'Belum Kawin';
        } elseif ($upper === 'CH' || str_contains($upper, 'HIDUP')) {
            return 'Cerai Hidup';
        } elseif ($upper === 'CM' || str_contains($upper, 'MATI')) {
            return 'Cerai Mati';
        }

        return ucwords(strtolower($trimmed));
    }

    /**
     * Normalizes RT/RW to 2 digits string (e.g. "1" -> "01").
     */
    public static function formatRtRw(string $val): string
    {
        $trimmed = trim($val);
        if ($trimmed === '' || $trimmed === '-') {
            return '-';
        }

        if (is_numeric($trimmed)) {
            return str_pad((string)(int)$trimmed, 2, '0', STR_PAD_LEFT);
        }

        return $trimmed;
    }
}
