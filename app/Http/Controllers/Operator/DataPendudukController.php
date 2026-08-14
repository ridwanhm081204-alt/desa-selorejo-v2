<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\DataPenduduk;
use App\Models\ImportBatch;
use App\Services\DataPendudukImportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DataPendudukController extends Controller
{
    protected DataPendudukImportService $importService;

    public function __construct(DataPendudukImportService $importService)
    {
        $this->importService = $importService;
    }

    public function index(Request $request)
    {
        $query = DataPenduduk::query();

        // Search NAMA, NIK, NKK
        if ($request->filled('q')) {
            $search = trim($request->input('q'));
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('nkk', 'like', "%{$search}%");
            });
        }

        // Filters
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->input('jenis_kelamin'));
        }

        if ($request->filled('status_kawin')) {
            $query->where('status_kawin', $request->input('status_kawin'));
        }

        if ($request->filled('rt')) {
            $query->where('rt', $request->input('rt'));
        }

        if ($request->filled('rw')) {
            $query->where('rw', $request->input('rw'));
        }

        if ($request->filled('kelompok_usia')) {
            $query->where('kelompok_usia', $request->input('kelompok_usia'));
        }

        $penduduk = $query->orderBy('nama', 'asc')->paginate(20)->appends($request->all());

        // Statistics data
        $statistik = DataPenduduk::getStatistikAgregat();

        // Distinct RT/RW lists for filter dropdowns
        $rtList = DataPenduduk::whereNotNull('rt')->where('rt', '!=', '-')->distinct()->pluck('rt')->sort()->values();
        $rwList = DataPenduduk::whereNotNull('rw')->where('rw', '!=', '-')->distinct()->pluck('rw')->sort()->values();

        // Recent Import Batches
        $importBatches = ImportBatch::with('uploader')->latest()->paginate(10, ['*'], 'batch_page');

        return view('operator.statistik.data-penduduk.index', compact(
            'penduduk',
            'statistik',
            'rtList',
            'rwList',
            'importBatches'
        ));
    }

    public function downloadTemplate(): StreamedResponse
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Template Data Penduduk');

        // Set Main Headers (A1:L1)
        $headers = DataPendudukImportService::EXPECTED_HEADERS;
        $sheet->fromArray([$headers], null, 'A1');

        // Header Styling (A1:L1)
        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '1A5C38']
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];
        $sheet->getStyle('A1:L1')->applyFromArray($headerStyle);
        $sheet->getRowDimension(1)->setRowHeight(25);

        // Sample Data Rows (A2:L3)
        $sampleData = [
            [
                '3507120101000001',
                '3507121508900001',
                'Budi Santoso',
                'Malang',
                '15/08/1990',
                'Kawin',
                'L',
                'Jl. Raya Selorejo No. 12',
                '01',
                '02',
                '34',
                'Petani'
            ],
            [
                '3507120101000001',
                '3507125204940002',
                'Siti Aminah',
                'Malang',
                '12/04/1994',
                'Kawin',
                'P',
                'Jl. Raya Selorejo No. 12',
                '01',
                '02',
                '30',
                'Wiraswasta'
            ]
        ];
        $sheet->fromArray($sampleData, null, 'A2');

        // Summary Age Groups Header Columns (N1:AK3)
        $ageGroups = [
            ['range' => 'N1:P1', 'label' => 'Usia 0-1 Tahun', 'col_l' => 'N', 'col_p' => 'O', 'col_tot' => 'P', 'min' => 0, 'max' => 1],
            ['range' => 'Q1:S1', 'label' => 'Usia 2-4 Tahun', 'col_l' => 'Q', 'col_p' => 'R', 'col_tot' => 'S', 'min' => 2, 'max' => 4],
            ['range' => 'T1:V1', 'label' => 'Usia 5-6 Tahun', 'col_l' => 'T', 'col_p' => 'U', 'col_tot' => 'V', 'min' => 5, 'max' => 6],
            ['range' => 'W1:Y1', 'label' => 'Usia 7-12 Tahun', 'col_l' => 'W', 'col_p' => 'X', 'col_tot' => 'Y', 'min' => 7, 'max' => 12],
            ['range' => 'Z1:AB1', 'label' => 'Usia 13-15 Tahun', 'col_l' => 'Z', 'col_p' => 'AA', 'col_tot' => 'AB', 'min' => 13, 'max' => 15],
            ['range' => 'AC1:AE1', 'label' => 'Usia 16-18 Tahun', 'col_l' => 'AC', 'col_p' => 'AD', 'col_tot' => 'AE', 'min' => 16, 'max' => 18],
            ['range' => 'AF1:AH1', 'label' => 'Usia 19-65 Tahun', 'col_l' => 'AF', 'col_p' => 'AG', 'col_tot' => 'AH', 'min' => 19, 'max' => 65],
            ['range' => 'AI1:AK1', 'label' => 'Usia Diatas 65 Tahun', 'col_l' => 'AI', 'col_p' => 'AJ', 'col_tot' => 'AK', 'min' => 66, 'max' => 150],
        ];

        $summaryHeaderStyle = [
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
        ];

        foreach ($ageGroups as $grp) {
            $sheet->mergeCells($grp['range']);
            $firstCell = explode(':', $grp['range'])[0];
            $sheet->setCellValue($firstCell, $grp['label']);

            // Sub-headers L, P, L+P
            $sheet->setCellValue($grp['col_l'] . '2', 'L');
            $sheet->setCellValue($grp['col_p'] . '2', 'P');
            $sheet->setCellValue($grp['col_tot'] . '2', 'L+P');

            // Formulated Row 3
            if ($grp['min'] === 0) {
                $sheet->setCellValue($grp['col_l'] . '3', '=COUNTIFS($G$2:$G$5000, "L", $K$2:$K$5000, "<=1")');
                $sheet->setCellValue($grp['col_p'] . '3', '=COUNTIFS($G$2:$G$5000, "P", $K$2:$K$5000, "<=1")');
            } elseif ($grp['min'] === 66) {
                $sheet->setCellValue($grp['col_l'] . '3', '=COUNTIFS($G$2:$G$5000, "L", $K$2:$K$5000, ">65")');
                $sheet->setCellValue($grp['col_p'] . '3', '=COUNTIFS($G$2:$G$5000, "P", $K$2:$K$5000, ">65")');
            } else {
                $sheet->setCellValue($grp['col_l'] . '3', '=COUNTIFS($G$2:$G$5000, "L", $K$2:$K$5000, ">=' . $grp['min'] . '", $K$2:$K$5000, "<=' . $grp['max'] . '")');
                $sheet->setCellValue($grp['col_p'] . '3', '=COUNTIFS($G$2:$G$5000, "P", $K$2:$K$5000, ">=' . $grp['min'] . '", $K$2:$K$5000, "<=' . $grp['max'] . '")');
            }
            $sheet->setCellValue($grp['col_tot'] . '3', '=' . $grp['col_l'] . '3+' . $grp['col_p'] . '3');
        }

        $sheet->getStyle('N1:AK3')->applyFromArray($summaryHeaderStyle);
        $sheet->getStyle('N1:AK3')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Summary Total Population Table (N5:P7)
        $sheet->mergeCells('N5:P5');
        $sheet->setCellValue('N5', 'JUMLAH TOTAL PENDUDUK');
        $sheet->setCellValue('N6', 'L');
        $sheet->setCellValue('O6', 'P');
        $sheet->setCellValue('P6', 'TOTAL');
        $sheet->setCellValue('N7', '=COUNTIF($G$2:$G$5000, "L")');
        $sheet->setCellValue('O7', '=COUNTIF($G$2:$G$5000, "P")');
        $sheet->setCellValue('P7', '=N7+O7');

        $totalTableStyle = [
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]
        ];
        $sheet->getStyle('N5:P7')->applyFromArray($totalTableStyle);

        // Set column widths
        foreach (range('A', 'L') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        $response = new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        });

        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="Template_Import_Data_Penduduk.xlsx"');
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }

    public function previewImport(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:10240',
        ], [
            'file.required' => 'File Excel wajib diunggah.',
            'file.mimes' => 'Format file harus berupa .xlsx atau .xls.',
            'file.max' => 'Ukuran file maksimal 10 MB.',
        ]);

        try {
            $file = $request->file('file');

            // Sanitize original filename — only keep safe characters
            $originalName = preg_replace('/[^a-zA-Z0-9._\-]/', '_', $file->getClientOriginalName());
            $originalName = basename($originalName); // prevent path traversal in filename

            // Ensure temporary directory exists
            Storage::disk('local')->makeDirectory('temp');
            Storage::disk('local')->makeDirectory('imports');

            // Read directly from PHP's uploaded temporary realPath
            $realPath = $file->getRealPath();
            $result = $this->importService->parseAndPreview($realPath, $originalName);

            // Save temporary copy for confirmation phase — use UUID-based safe filename only
            $tempFilename = 'temp/import_' . uniqid('', true) . '.xlsx';
            Storage::disk('local')->put($tempFilename, file_get_contents($realPath));
            $result['temp_key'] = $tempFilename;

            return response()->json([
                'status' => 'success',
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function commitImport(Request $request)
    {
        $request->validate([
            'temp_key'          => ['required', 'string', 'regex:/^temp\/import_[a-zA-Z0-9._]+\.xlsx$/'],
            'valid_rows'        => 'required|array|max:10000',
            'failed_details'    => 'nullable|array',
            'original_filename' => 'required|string|max:255',
        ]);

        $tempKey = $request->input('temp_key');

        // Security: prevent path traversal — temp_key must stay within temp/ directory
        $resolvedPath = Storage::disk('local')->path($tempKey);
        $allowedBase  = Storage::disk('local')->path('temp');
        if (!str_starts_with(realpath(dirname($resolvedPath)) ?: $resolvedPath, realpath($allowedBase))) {
            abort(403, 'Invalid file path.');
        }

        $validRows       = $request->input('valid_rows');
        $failedDetails   = $request->input('failed_details', []);
        $originalFilename = basename(preg_replace('/[^a-zA-Z0-9._\-]/', '_', $request->input('original_filename')));

        // Secondary validation: ensure each NIK/NKK field in valid_rows is exactly 16 digits
        foreach ($validRows as $i => $row) {
            if (!preg_match('/^\d{16}$/', $row['nik'] ?? '')) {
                return response()->json(['status' => 'error', 'message' => "NIK tidak valid pada baris import ke-" . ($i + 1)], 422);
            }
            if (!preg_match('/^\d{16}$/', $row['nkk'] ?? '')) {
                return response()->json(['status' => 'error', 'message' => "NKK tidak valid pada baris import ke-" . ($i + 1)], 422);
            }
            if (!in_array($row['jenis_kelamin'] ?? '', ['L', 'P'])) {
                return response()->json(['status' => 'error', 'message' => "Jenis kelamin tidak valid pada baris import ke-" . ($i + 1)], 422);
            }
        }

        try {
            $batch = $this->importService->commitImport(
                $validRows,
                $failedDetails,
                $originalFilename,
                $resolvedPath,
                Auth::id()
            );

            return response()->json([
                'status'   => 'success',
                'message'  => "Import berhasil dikonfirmasi! {$batch->success_rows} baris sukses dimasukkan/diperbarui.",
                'batch_id' => $batch->id
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('commitImport error', [
                'user_id' => Auth::id(),
                'error'   => $e->getMessage(),
            ]);
            return response()->json([
                'status'  => 'error',
                'message' => 'Gagal melakukan import data. Silakan coba lagi atau hubungi administrator.'
            ], 500);
        }
    }

    public function rollbackImport($id)
    {
        try {
            $this->importService->rollbackBatch((int)$id);
            return redirect()->back()->with('success', 'Batch import berhasil di-rollback. Data yang di-import telah dibatalkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membatalkan batch import: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nkk' => 'required|digits:16',
            'nik' => 'required|digits:16|unique:data_penduduk,nik',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'status_kawin' => 'nullable|string|max:50',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            'usia_input' => 'nullable|integer|min:0|max:150',
            'pekerjaan' => 'nullable|string|max:255',
        ], [
            'nkk.digits' => 'NKK harus 16 digit angka.',
            'nik.digits' => 'NIK harus 16 digit angka.',
            'nik.unique' => 'NIK sudah terdaftar di sistem.',
            'jenis_kelamin.in' => 'Jenis kelamin harus L (Laki-laki) atau P (Perempuan).'
        ]);

        $validated['rt'] = DataPendudukImportService::formatRtRw($validated['rt'] ?? '-');
        $validated['rw'] = DataPendudukImportService::formatRtRw($validated['rw'] ?? '-');
        $validated['tempat_lahir'] = !empty($validated['tempat_lahir']) ? $validated['tempat_lahir'] : '-';
        $validated['status_kawin'] = !empty($validated['status_kawin']) ? DataPendudukImportService::formatStatusKawin($validated['status_kawin']) : '-';
        $validated['alamat'] = !empty($validated['alamat']) ? $validated['alamat'] : '-';
        $validated['pekerjaan'] = !empty($validated['pekerjaan']) ? $validated['pekerjaan'] : '-';
        $validated['created_by'] = Auth::id();
        $validated['updated_by'] = Auth::id();

        DataPenduduk::create($validated);

        return redirect()->back()->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $penduduk = DataPenduduk::findOrFail($id);

        $validated = $request->validate([
            'nkk' => 'required|digits:16',
            'nik' => 'required|digits:16|unique:data_penduduk,nik,' . $penduduk->id,
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'status_kawin' => 'nullable|string|max:50',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            'usia_input' => 'nullable|integer|min:0|max:150',
            'pekerjaan' => 'nullable|string|max:255',
        ], [
            'nkk.digits' => 'NKK harus 16 digit angka.',
            'nik.digits' => 'NIK harus 16 digit angka.',
            'nik.unique' => 'NIK sudah digunakan oleh warga lain.',
        ]);

        $validated['rt'] = DataPendudukImportService::formatRtRw($validated['rt'] ?? '-');
        $validated['rw'] = DataPendudukImportService::formatRtRw($validated['rw'] ?? '-');
        $validated['tempat_lahir'] = !empty($validated['tempat_lahir']) ? $validated['tempat_lahir'] : '-';
        $validated['status_kawin'] = !empty($validated['status_kawin']) ? DataPendudukImportService::formatStatusKawin($validated['status_kawin']) : '-';
        $validated['alamat'] = !empty($validated['alamat']) ? $validated['alamat'] : '-';
        $validated['pekerjaan'] = !empty($validated['pekerjaan']) ? $validated['pekerjaan'] : '-';
        $validated['updated_by'] = Auth::id();

        $penduduk->update($validated);

        return redirect()->back()->with('success', 'Data penduduk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penduduk = DataPenduduk::findOrFail($id);
        $penduduk->delete();

        return redirect()->back()->with('success', 'Data penduduk berhasil dihapus.');
    }
}
