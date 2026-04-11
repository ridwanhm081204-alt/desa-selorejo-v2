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
        return $this->gambar ? asset('storage/' . $this->gambar) : 'https://via.placeholder.com/800x400?text=Berita';
    }
}
