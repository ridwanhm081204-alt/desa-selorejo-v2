<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LembagaDesa extends Model
{
    protected $table = 'lembaga_desa';
    protected $fillable = [
        'nama_lembaga',
        'jenis',
        'ketua',
        'deskripsi',
        'foto',
    ];
}
