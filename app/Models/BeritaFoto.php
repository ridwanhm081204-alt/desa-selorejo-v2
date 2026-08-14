<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeritaFoto extends Model
{
    protected $table = 'berita_foto';

    protected $fillable = [
        'berita_id',
        'path',
        'urutan',
    ];

    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }

    /**
     * Get the full URL for the photo.
     */
    public function getUrlAttribute(): string
    {
        if (!$this->path) {
            return asset('images/hero_desa.png');
        }
        if (\Illuminate\Support\Str::startsWith($this->path, ['http://', 'https://'])) {
            return $this->path;
        }
        if (\Illuminate\Support\Str::startsWith($this->path, ['images/'])) {
            return asset($this->path);
        }
        return asset('storage/' . $this->path);
    }
}
