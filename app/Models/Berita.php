<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';
    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar',
        'kategori',
        'tanggal',
        'penulis',
        'status_publish',
    ];

    public function getGambarUrlAttribute()
    {
        if (!$this->gambar) return 'https://via.placeholder.com/800x400?text=Berita';
        if (\Illuminate\Support\Str::startsWith($this->gambar, ['http://', 'https://'])) return $this->gambar;
        return asset('storage/' . $this->gambar);
    }
}
