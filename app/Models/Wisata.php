<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $table = 'wisata';
    protected $fillable = [
        'judul',
        'deskripsi',
        'harga_tiket',
        'jadwal',
        'aturan',
        'gambar',
    ];
}
