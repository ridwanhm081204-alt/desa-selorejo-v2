<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KknAnggota extends Model
{
    protected $table = 'kkn_anggota';

    protected $fillable = [
        'nama', 'nim', 'prodi', 'fakultas',
        'foto', 'badge', 'proker', 'sdg', 'urutan',
    ];

    protected $casts = [
        'sdg' => 'array',
    ];
}
