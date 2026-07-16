<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerangkatRtRw extends Model
{
    protected $table = 'perangkat_rt_rw';

    protected $fillable = [
        'jenis',
        'nomor',
        'nama',
        'dusun',
        'nomor_rt',
        'nomor_rw',
        'urutan',
        'foto',
    ];

    /**
     * Scope untuk filter hanya RT
     */
    public function scopeRt($query)
    {
        return $query->where('jenis', 'RT');
    }

    /**
     * Scope untuk filter hanya RW
     */
    public function scopeRw($query)
    {
        return $query->where('jenis', 'RW');
    }

    /**
     * Accessor: label lengkap, misal "RT 01" atau "RW 01"
     */
    public function getLabelAttribute(): string
    {
        return $this->jenis . ' ' . str_pad($this->nomor, 2, '0', STR_PAD_LEFT);
    }

    public function getNamaAttribute($value): string
    {
        return \Illuminate\Support\Str::title($value);
    }
}
