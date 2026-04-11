<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'sejarah',
        'visi_misi',
        'geografi',
        'batas_wilayah',
        'peta_embed',
    ];
}
