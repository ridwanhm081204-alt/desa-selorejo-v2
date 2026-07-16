<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    protected $table = 'struktur_organisasi';
    protected $fillable = [
        'jabatan',
        'nama_pejabat',
        'foto',
        'urutan',
    ];

    public function getNamaPejabatAttribute($value): string
    {
        return \Illuminate\Support\Str::title($value);
    }
}
