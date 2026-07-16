<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukHukum extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'jenis',
        'tahun',
        'tanggal_ditetapkan',
        'dokumen_pdf',
        'konten',
    ];
}
