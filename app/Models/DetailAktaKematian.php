<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailAktaKematian extends Model
{
    protected $table = 'detail_akta_kematian';

    protected $fillable = [
        'pengajuan_id',
        'nik_almarhum',
        'nama_almarhum',
        'tempat_lahir',
        'tanggal_lahir',
        'tempat_meninggal',
        'tanggal_meninggal',
        'sebab_kematian',
        'nama_pelapor',
        'nik_pelapor',
        'hubungan_pelapor',
        'identitas_jelas'
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }
}
