<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $table = 'wisata';
    protected $fillable = [
        'judul',
        'kategori',
        'deskripsi',
        'harga_tiket',
        'jadwal',
        'aturan',
        'gambar',
        'whatsapp',
    ];

    public function getGambarUrlAttribute()
    {
        if (!$this->gambar) return asset('images/hero_desa.png');
        if (\Illuminate\Support\Str::startsWith($this->gambar, ['http://', 'https://'])) return $this->gambar;
        if (\Illuminate\Support\Str::startsWith($this->gambar, ['images/'])) return asset($this->gambar);
        return asset('storage/' . $this->gambar);
    }
}
