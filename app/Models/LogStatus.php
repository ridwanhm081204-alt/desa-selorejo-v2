<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogStatus extends Model
{
    protected $table = 'log_status';

    protected $fillable = [
        'pengajuan_id',
        'status_lama',
        'status_baru',
        'diubah_oleh',
        'catatan'
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }

    public function operator()
    {
        return $this->belongsTo(User::class, 'diubah_oleh');
    }

    public function getStatusBaruLabelAttribute()
    {
        $labels = [
            'diajukan' => 'Diajukan',
            'diverifikasi' => 'Diverifikasi Admin',
            'diproses_disdukcapil' => 'Diproses Disdukcapil',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak',
        ];

        return $labels[$this->status_baru] ?? $this->status_baru;
    }
}
