<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenUpload extends Model
{
    protected $table = 'dokumen_upload';

    protected $fillable = [
        'pengajuan_id',
        'jenis_dokumen',
        'nama_file',
        'path_file'
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }

    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->path_file);
    }

    public function getJenisDokumenLabelAttribute()
    {
        $labels = [
            'surat_lahir' => 'Surat Keterangan Lahir',
            'kk_ortu' => 'KK Orang Tua',
            'ktp_ortu' => 'KTP Orang Tua',
            'akta_nikah' => 'Akta Nikah / SPTJM',
            'ktp_saksi' => 'KTP 2 Saksi',
            'surat_kematian' => 'Surat Kematian',
            'ktp_almarhum' => 'KTP Almarhum',
            'kk_almarhum' => 'KK Almarhum/Pelapor',
            'ktp_pelapor' => 'KTP Pelapor',
            'surat_kepolisian' => 'Surat Keterangan Kepolisian',
            'akta_nikah_perkawinan' => 'Buku Nikah / Akta Perkawinan',
            'ktp_mempelai' => 'KTP Kedua Mempelai',
            'kk_asal' => 'KK Asal Suami & Istri',
            'akta_lahir_anak' => 'Akta Kelahiran Anak',
            'kk_lama' => 'KK Lama / KK Asal',
            'dokumen_pendukung_perubahan' => 'Dokumen Pendukung Perubahan',
            'ktp_anggota' => 'KTP Anggota Terkait',
            'surat_persetujuan_pisah' => 'Surat Persetujuan Pisah KK',
            'kk_pemohon' => 'KK Pemohon',
            'surat_kehilangan' => 'Surat Kehilangan Kepolisian',
        ];

        return $labels[$this->jenis_dokumen] ?? ucwords(str_replace('_', ' ', $this->jenis_dokumen));
    }
}
