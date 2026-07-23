<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananSyarat extends Model
{
    protected $table = 'layanan_syarat';

    protected $fillable = [
        'layanan_konten_id',
        'kode_syarat',
        'nama_syarat',
        'keterangan',
        'is_required',
        'urutan',
    ];

    protected $casts = [
        'is_required' => 'boolean',
    ];

    public function layananKonten()
    {
        return $this->belongsTo(LayananKonten::class, 'layanan_konten_id');
    }
}
