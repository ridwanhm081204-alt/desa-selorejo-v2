<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailKk extends Model
{
    protected $table = 'detail_kk';

    protected $fillable = [
        'pengajuan_id',
        'jenis_perubahan',
        'no_kk_asal',
        'alamat_baru',
        'data_lama',
        'data_baru',
        'anggota_terlibat'
    ];

    protected $casts = [
        'data_lama' => 'array',
        'data_baru' => 'array',
        'anggota_terlibat' => 'array'
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }
}
