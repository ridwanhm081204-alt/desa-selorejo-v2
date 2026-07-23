<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananKonten extends Model
{
    protected $table = 'layanan_konten';

    protected $fillable = [
        'kode', 'nama', 'deskripsi',
        'warna_hex', 'icon_name', 'route_name',
        'aktif', 'urutan',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    public function syarat()
    {
        return $this->hasMany(LayananSyarat::class, 'layanan_konten_id')->orderBy('urutan');
    }
}
