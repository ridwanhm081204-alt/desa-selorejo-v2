<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataPenduduk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'data_penduduk';

    protected $fillable = [
        'nkk',
        'nik',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'status_kawin',
        'jenis_kelamin',
        'alamat',
        'rt',
        'rw',
        'usia_input',
        'pekerjaan',
        'kelompok_usia',
        'sumber_import_id',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'usia_input' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->kelompok_usia = static::determineKelompokUsia($model->tanggal_lahir, $model->usia_input);
        });
    }

    /**
     * Determines age group label based on birth date or input age fallback.
     */
    public static function determineKelompokUsia($tanggalLahir, $usiaInput = null): string
    {
        $usia = null;

        if ($tanggalLahir) {
            try {
                $usia = Carbon::parse($tanggalLahir)->age;
            } catch (\Exception $e) {
                $usia = null;
            }
        }

        if ($usia === null && $usiaInput !== null && is_numeric($usiaInput)) {
            $usia = (int) $usiaInput;
        }

        if ($usia === null || $usia < 0) {
            return 'Usia Tidak Diketahui';
        }

        if ($usia <= 1) {
            return 'Balita';
        } elseif ($usia <= 4) {
            return 'Anak Awal';
        } elseif ($usia <= 6) {
            return 'Anak Pra-Sekolah';
        } elseif ($usia <= 12) {
            return 'Anak Sekolah';
        } elseif ($usia <= 15) {
            return 'Remaja Awal';
        } elseif ($usia <= 18) {
            return 'Remaja Akhir';
        } elseif ($usia <= 65) {
            return 'Dewasa/Produktif';
        } else {
            return 'Lansia';
        }
    }

    /**
     * Get computed age at current date.
     */
    public function getUsiaAttribute()
    {
        if ($this->tanggal_lahir) {
            return Carbon::parse($this->tanggal_lahir)->age;
        }
        return $this->usia_input;
    }

    /**
     * Get dynamic kelompok_usia attribute.
     */
    public function getKelompokUsiaAttribute($value)
    {
        return static::determineKelompokUsia($this->tanggal_lahir, $this->usia_input);
    }

    public function sumberImport()
    {
        return $this->belongsTo(ImportBatch::class, 'sumber_import_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get statistics summary for Age and Gender distribution.
     */
    public static function getStatistikAgregat(): array
    {
        $totalPenduduk = static::count();

        $orderedGroups = [
            'Balita' => '0–1 Tahun',
            'Anak Awal' => '2–4 Tahun',
            'Anak Pra-Sekolah' => '5–6 Tahun',
            'Anak Sekolah' => '7–12 Tahun',
            'Remaja Awal' => '13–15 Tahun',
            'Remaja Akhir' => '16–18 Tahun',
            'Dewasa/Produktif' => '19–65 Tahun',
            'Lansia' => 'Di atas 65 Tahun',
        ];

        // Grouping data from database dynamically
        $pendudukList = static::select('tanggal_lahir', 'usia_input', 'jenis_kelamin')->get();

        $ageCounts = [];
        foreach ($orderedGroups as $groupKey => $label) {
            $ageCounts[$groupKey] = 0;
        }
        $ageCounts['Usia Tidak Diketahui'] = 0;

        $genderCounts = [
            'L' => 0,
            'P' => 0,
        ];

        foreach ($pendudukList as $p) {
            $group = static::determineKelompokUsia($p->tanggal_lahir, $p->usia_input);
            if (isset($ageCounts[$group])) {
                $ageCounts[$group]++;
            } else {
                $ageCounts['Usia Tidak Diketahui']++;
            }

            if (in_array($p->jenis_kelamin, ['L', 'P'])) {
                $genderCounts[$p->jenis_kelamin]++;
            }
        }

        $ageData = [];
        foreach ($orderedGroups as $groupKey => $label) {
            $count = $ageCounts[$groupKey];
            $percentage = $totalPenduduk > 0 ? round(($count / $totalPenduduk) * 100, 1) : 0;
            $ageData[] = [
                'kelompok' => $groupKey,
                'label' => $label,
                'jumlah' => $count,
                'persentase' => $percentage,
            ];
        }

        if ($ageCounts['Usia Tidak Diketahui'] > 0) {
            $count = $ageCounts['Usia Tidak Diketahui'];
            $percentage = $totalPenduduk > 0 ? round(($count / $totalPenduduk) * 100, 1) : 0;
            $ageData[] = [
                'kelompok' => 'Usia Tidak Diketahui',
                'label' => 'Usia Tidak Diketahui',
                'jumlah' => $count,
                'persentase' => $percentage,
            ];
        }

        return [
            'total' => $totalPenduduk,
            'kelompok_usia' => $ageData,
            'gender' => [
                'L' => $genderCounts['L'],
                'P' => $genderCounts['P'],
                'L_percent' => $totalPenduduk > 0 ? round(($genderCounts['L'] / $totalPenduduk) * 100, 1) : 0,
                'P_percent' => $totalPenduduk > 0 ? round(($genderCounts['P'] / $totalPenduduk) * 100, 1) : 0,
            ],
        ];
    }
}
