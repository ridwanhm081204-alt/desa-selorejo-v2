<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetaDokumen extends Model
{
    protected $table = 'peta_dokumens';

    protected $fillable = [
        'judul',
        'slug',
        'file_path',
        'skala',
        'sistem_koordinat',
        'proyeksi',
        'datum',
        'sumber_data',
        'dibuat_oleh',
        'urutan_tampil',
    ];

    protected $casts = [
        'urutan_tampil' => 'integer',
    ];

    /**
     * URL publik gambar peta.
     */
    public function getFileUrlAttribute(): ?string
    {
        if (!$this->file_path) return null;

        if (str_starts_with($this->file_path, 'http://') || str_starts_with($this->file_path, 'https://')) {
            return $this->file_path;
        }
        if (str_starts_with($this->file_path, 'storage/')) {
            return asset($this->file_path);
        }
        // Gambar statis di public/ (mis. images/Peta Destinasi Wisata Desa.png)
        return asset($this->file_path);
    }
}
