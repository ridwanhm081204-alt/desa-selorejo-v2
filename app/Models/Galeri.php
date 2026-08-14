<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';
    protected $fillable = [
        'tipe',
        'url',
        'caption',
        'kategori',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function getGambarUrlAttribute()
    {
        if (!$this->url) {
            return asset('images/hero_desa.png');
        }
        if (str_starts_with($this->url, 'http://') || str_starts_with($this->url, 'https://')) {
            return $this->url;
        }
        if (str_starts_with($this->url, 'images/')) {
            return asset($this->url);
        }
        return asset('storage/' . $this->url);
    }
}
