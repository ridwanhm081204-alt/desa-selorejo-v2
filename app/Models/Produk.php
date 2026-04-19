<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $fillable = [
        'nama',
        'kategori',
        'deskripsi',
        'harga',
        'gambar',
        'stok',
        'whatsapp',
    ];

    public function getGambarUrlAttribute()
    {
        if (!$this->gambar) return 'https://via.placeholder.com/500x500?text=Produk';
        if (\Illuminate\Support\Str::startsWith($this->gambar, ['http://', 'https://'])) return $this->gambar;
        return asset('storage/' . $this->gambar);
    }

    public function reviews()
    {
        return $this->hasMany(ProdukReview::class);
    }

    public function transaksis()
    {
        return $this->hasMany(ProdukTransaksi::class);
    }
}
