<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuan';

    protected $fillable = [
        'no_tiket',
        'nik_pemohon',
        'nama_pemohon',
        'no_hp_pemohon',
        'email_pemohon',
        'jenis_layanan',
        'status',
        'catatan_admin',
        'diverifikasi_oleh'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $year = date('Y');
            // Safe count not relying on whereYear database native support
            $count = static::where('created_at', '>=', "$year-01-01 00:00:00")->count() + 1;
            $model->no_tiket = 'DES-' . $year . '-' . str_pad($count, 5, '0', STR_PAD_LEFT);
        });
    }

    public function detailAktaKelahiran()
    {
        return $this->hasOne(DetailAktaKelahiran::class, 'pengajuan_id');
    }

    public function detailAktaKematian()
    {
        return $this->hasOne(DetailAktaKematian::class, 'pengajuan_id');
    }

    public function detailKk()
    {
        return $this->hasOne(DetailKk::class, 'pengajuan_id');
    }

    public function detailKtp()
    {
        return $this->hasOne(DetailKtp::class, 'pengajuan_id');
    }

    public function dokumenUploads()
    {
        return $this->hasMany(DokumenUpload::class, 'pengajuan_id');
    }

    public function logStatuses()
    {
        return $this->hasMany(LogStatus::class, 'pengajuan_id')->orderBy('created_at', 'desc');
    }

    public function verifikator()
    {
        return $this->belongsTo(User::class, 'diverifikasi_oleh');
    }

    public function getJenisLayananLabelAttribute()
    {
        $labels = [
            'akta_kelahiran' => 'Akta Kelahiran',
            'akta_kematian' => 'Akta Kematian',
            'kk_baru' => 'KK Baru (Menikah)',
            'kk_tambah_anggota' => 'KK Tambah Anggota (Kelahiran)',
            'kk_ubah_data' => 'KK Perubahan Elemen Data',
            'kk_pisah' => 'KK Pisah KK',
            'ktp_baru' => 'KTP-el Baru / Pertama Kali',
            'ktp_hilang' => 'KTP-el Hilang',
            'ktp_rusak' => 'KTP-el Rusak',
            'ktp_ubah_data' => 'KTP-el Ubah Data',
        ];

        return $labels[$this->jenis_layanan] ?? $this->jenis_layanan;
    }

    public function getStatusBadgeClassAttribute()
    {
        $classes = [
            'diajukan' => 'bg-info text-white',
            'diverifikasi' => 'bg-warning text-dark',
            'diproses_disdukcapil' => 'bg-primary text-white',
            'selesai' => 'bg-success text-white',
            'ditolak' => 'bg-danger text-white',
        ];

        return $classes[$this->status] ?? 'bg-secondary text-white';
    }

    public function getStatusLabelAttribute()
    {
        $labels = [
            'diajukan' => 'Diajukan',
            'diverifikasi' => 'Diverifikasi Admin',
            'diproses_disdukcapil' => 'Diproses Disdukcapil',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak',
        ];

        return $labels[$this->status] ?? $this->status;
    }
}
