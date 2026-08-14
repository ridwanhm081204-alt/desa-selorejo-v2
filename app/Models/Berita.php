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
        'views',
        'likes',
        'dislikes',
    ];

    /**
     * Relasi ke tabel berita_foto (multiple photos).
     */
    public function fotos()
    {
        return $this->hasMany(BeritaFoto::class)->orderBy('urutan');
    }

    /**
     * Get the cover image URL (from gambar column).
     */
    public function getGambarUrlAttribute()
    {
        if (!$this->gambar) return asset('images/hero_desa.png');
        if (\Illuminate\Support\Str::startsWith($this->gambar, ['http://', 'https://'])) return $this->gambar;
        if (\Illuminate\Support\Str::startsWith($this->gambar, ['images/'])) return asset($this->gambar);
        return asset('storage/' . $this->gambar);
    }

    /**
     * Get all photo URLs for this berita.
     * Returns array of URL strings — uses berita_foto if available, falls back to gambar column.
     */
    public function getAllFotosAttribute(): array
    {
        // Load fotos if not already loaded
        $fotos = $this->fotos()->orderBy('urutan')->get();

        if ($fotos->isNotEmpty()) {
            return $fotos->map(fn($f) => $f->url)->toArray();
        }

        // Fallback: old single-photo berita
        if ($this->gambar) {
            return [$this->gambar_url];
        }

        return ['https://via.placeholder.com/800x400?text=Berita'];
    }
}
