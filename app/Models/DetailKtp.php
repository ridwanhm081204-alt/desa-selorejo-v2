<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailKtp extends Model
{
    protected $table = 'detail_ktp';

    protected $fillable = [
        'pengajuan_id',
        'jenis_pengajuan',
        'no_surat_kehilangan',
        'jadwal_perekaman'
    ];

    protected $casts = [
        'jadwal_perekaman' => 'datetime'
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }
}
