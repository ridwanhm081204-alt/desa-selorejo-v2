<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Polling extends Model
{
    protected $table = 'polling';
    protected $fillable = [
        'pertanyaan',
        'jumlah_ya',
        'jumlah_tidak',
        'tanggal_mulai',
        'tanggal_selesai',
        'is_active',
    ];

    public function totalVotes()
    {
        return $this->jumlah_ya + $this->jumlah_tidak;
    }
}
