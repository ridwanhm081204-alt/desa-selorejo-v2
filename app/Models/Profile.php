<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'sejarah', 'sejarah_timeline', 'visi', 'misi',
        'geografi', 'geografi_stats', 'batas_wilayah', 'batas_wilayah_json',
        'peta_embed', 'peta_rute_pribadi', 'peta_rute_umum', 'peta_deskripsi',
        'hero_sejarah', 'hero_visimisi', 'hero_geografi', 'hero_peta',
        'motto', 'dusun_info', 'peta_image', 'peta_narasi_utama',
        'peta_narasi_legenda', 'peta_fasilitas'
    ];

    protected $casts = [
        'sejarah_timeline' => 'array',
        'misi' => 'array',
        'geografi_stats' => 'array',
        'batas_wilayah_json' => 'array',
        'hero_sejarah' => 'array',
        'hero_visimisi' => 'array',
        'hero_geografi' => 'array',
        'hero_peta' => 'array',
        'dusun_info' => 'array',
        'peta_fasilitas' => 'array'
    ];
}
