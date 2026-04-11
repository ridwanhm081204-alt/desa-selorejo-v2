<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apbdes extends Model
{
    protected $fillable = [
        'tahun',
        'jenis',
        'bidang',
        'nominal',
        'dokumen_pdf',
    ];
}
