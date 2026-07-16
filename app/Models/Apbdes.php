<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apbdes extends Model
{
    protected $fillable = [
        'tahun',
        'jenis',
        'bidang',
        'kategori_bidang',
        'nominal',
        'nominal_semula',
        'nominal_perubahan',
        'dokumen_pdf',
    ];
}
