<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailAktaKelahiran extends Model
{
    protected $table = 'detail_akta_kelahiran';

    protected $fillable = [
        'pengajuan_id',
        'nama_anak',
        'tempat_lahir',
        'tanggal_lahir',
        'jam_lahir',
        'jenis_kelamin',
        'anak_ke',
        'berat_lahir',
        'panjang_lahir',
        'nik_ayah',
        'nama_ayah',
        'nik_ibu',
        'nama_ibu',
        'no_kk_orangtua',
        'nama_saksi1',
        'nik_saksi1',
        'nama_saksi2',
        'nik_saksi2',
        'tempat_penerbit_surat_lahir'
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }
}
