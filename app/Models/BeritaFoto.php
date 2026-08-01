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
        if (\Illuminate\Support\Str::startsWith($this->path, ['http://', 'https://'])) {
            return $this->path;
        }
        return asset('storage/' . $this->path);
    }
}
