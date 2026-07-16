<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bpd extends Model
{
    protected $table = 'bpd';
    protected $fillable = [
        'nama',
        'jabatan',
        'dusun',
        'nomor_rt',
        'nomor_rw',
        'foto',
    ];

    public function getNamaAttribute($value): string
    {
        return \Illuminate\Support\Str::title($value);
    }
}
