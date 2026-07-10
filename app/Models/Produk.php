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
        'link_shopee',
        'link_tokopedia',
        'link_marketplace_lainnya',
    ];

    /**
     * Cek apakah produk ini punya minimal satu link marketplace.
     */
    public function hasMarketplaceLinks(): bool
    {
        return !empty($this->link_shopee) || !empty($this->link_tokopedia) || !empty($this->link_marketplace_lainnya);
    }

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
