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
        if (str_starts_with($this->url, 'http')) {
            return $this->url;
        }
        return asset('storage/' . $this->url);
    }
}
