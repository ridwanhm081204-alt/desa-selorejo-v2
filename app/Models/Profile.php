<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'sejarah',
        'sejarah_timeline',
        'visi',
        'misi',
        'geografi',
        'geografi_stats',
        'batas_wilayah',
        'batas_wilayah_json',
        'peta_embed',
        'peta_rute_pribadi',
        'peta_rute_umum',
        'peta_deskripsi',
    ];

    protected $casts = [
        'sejarah_timeline' => 'array',
        'misi' => 'array',
        'geografi_stats' => 'array',
        'batas_wilayah_json' => 'array',
    ];
}
