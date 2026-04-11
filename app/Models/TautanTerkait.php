<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TautanTerkait extends Model
{
    protected $table = 'tautan_terkait';
    protected $fillable = [
        'nama',
        'url',
    ];
}
