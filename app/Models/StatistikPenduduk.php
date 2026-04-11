<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatistikPenduduk extends Model
{
    protected $table = 'statistik_penduduk';
    protected $fillable = [
        'tahun',
        'jenis_data',
        'label',
        'nilai',
    ];
    
    protected $casts = [
        'tahun' => 'integer',
    ];
}
