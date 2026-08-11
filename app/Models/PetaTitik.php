<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PetaTitik extends Model
{
    protected $table = 'peta_titiks';

    protected $fillable = [
        'nama',
        'kategori',
        'dusun',
        'deskripsi',
        'foto',
        'latitude',
        'longitude',
        'is_wisata_unggulan',
        'sumber_data',
        'urutan_tampil',
        'umkm_id',
        'wisata_id',
        'gmaps_link',
    ];

    protected $casts = [
        'latitude'           => 'float',
        'longitude'          => 'float',
        'is_wisata_unggulan' => 'boolean',
        'urutan_tampil'      => 'integer',
    ];

    // ─── Daftar Kategori (11 kategori Peta A §2.2) ──────────────────────────────

    public const KATEGORI_LIST = [
        'tempat_ibadah'          => 'Tempat Ibadah',
        'klinik'                 => 'Klinik',
        'toko_kelontong_sembako' => 'Toko Kelontong & Sembako',
        'warung_makan'           => 'Warung Makan',
        'toko_buah_wisata_jeruk' => 'Toko Buah & Wisata Petik Jeruk',
        'bengkel'                => 'Bengkel',
        'toko_berbagai_jenis'    => 'Toko Berbagai Jenis',
        'cafe'                   => 'Cafe',
        'camping_ground'         => 'Bumi Perkemahan',
        'fasilitas_desa'         => 'Fasilitas Desa',
    ];

    public const KATEGORI_ICONS = [
        'tempat_ibadah'          => 'building-2',
        'klinik'                 => 'hospital',
        'toko_kelontong_sembako' => 'shopping-bag',
        'warung_makan'           => 'utensils',
        'toko_buah_wisata_jeruk' => 'citrus',
        'bengkel'                => 'wrench',
        'toko_berbagai_jenis'    => 'store',
        'cafe'                   => 'coffee',
        'camping_ground'         => 'tent',
        'fasilitas_desa'         => 'landmark',
    ];

    public const KATEGORI_COLORS = [
        'tempat_ibadah'          => '#4caf50',
        'klinik'                 => '#2196f3',
        'toko_kelontong_sembako' => '#e91e63',
        'warung_makan'           => '#ffc107',
        'toko_buah_wisata_jeruk' => '#ff9800',
        'bengkel'                => '#607d8b',
        'toko_berbagai_jenis'    => '#1a5c38',
        'cafe'                   => '#7b1fa2',
        'camping_ground'         => '#33691e',
        'fasilitas_desa'         => '#0d47a1',
    ];

    public const DUSUN_LIST = ['krajan', 'selokerto', 'gumuk'];

    // ─── Scopes ─────────────────────────────────────────────────────────────────

    public function scopeWisataUnggulan($query)
    {
        return $query->where('is_wisata_unggulan', true);
    }

    public function scopeByKategori($query, string $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    public function scopeByDusun($query, string $dusun)
    {
        return $query->where('dusun', $dusun);
    }

    // ─── Relationships ───────────────────────────────────────────────────────────

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id');
    }

    public function wisata()
    {
        return $this->belongsTo(Wisata::class, 'wisata_id');
    }

    // ─── Accessors & Helpers ─────────────────────────────────────────────────────

    public function getDetailUrlAttribute(): ?string
    {
        if ($this->umkm_id) {
            return route('wisata.umkm.show', $this->umkm_id);
        }
        if ($this->wisata_id) {
            return route('wisata.show', $this->wisata_id);
        }
        return null;
    }

    public function getFotoUrlAttribute(): string
    {
        if ($this->foto) {
            if (Str::startsWith($this->foto, ['http://', 'https://'])) {
                return $this->foto;
            }
            if (Str::startsWith($this->foto, ['images/', 'storage/'])) {
                return asset($this->foto);
            }
            return asset('storage/' . $this->foto);
        }

        if ($this->umkm && $this->umkm->foto_url) {
            return $this->umkm->foto_url;
        }

        if ($this->wisata && $this->wisata->gambar) {
            if (Str::startsWith($this->wisata->gambar, ['http://', 'https://'])) {
                return $this->wisata->gambar;
            }
            return asset('storage/' . $this->wisata->gambar);
        }

        // Fallback per kategori
        $fallbacks = [
            'toko_buah_wisata_jeruk' => 'https://images.unsplash.com/photo-1611080626919-7cf5a9dbab5b?w=600&q=80',
            'camping_ground'         => 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=600&q=80',
            'cafe'                   => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=600&q=80',
            'warung_makan'           => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=600&q=80',
            'toko_kelontong_sembako' => 'https://images.unsplash.com/photo-1604719312566-8912e9227c6a?w=600&q=80',
            'tempat_ibadah'          => 'https://images.unsplash.com/photo-1584551246679-0daf3d275d0f?w=600&q=80',
            'klinik'                 => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?w=600&q=80',
            'bengkel'                => 'https://images.unsplash.com/photo-1606577924006-27d39b132ae2?w=600&q=80',
            'toko_berbagai_jenis'    => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=600&q=80',
            'fasilitas_desa'         => 'https://images.unsplash.com/photo-1486325212027-8081e485255e?w=600&q=80',
        ];

        return $fallbacks[$this->kategori] ?? 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=600&q=80';
    }

    public function getPemilikAttribute(): ?string
    {
        return $this->umkm?->nama_pemilik;
    }

    public function getKontakTeleponAttribute(): ?string
    {
        return $this->umkm?->no_telepon ?? $this->wisata?->whatsapp;
    }

    public function getWhatsappUrlAttribute(): ?string
    {
        if ($this->umkm) {
            return $this->umkm->whatsappLink();
        }

        if ($this->wisata && $this->wisata->whatsapp) {
            $no = preg_replace('/[^0-9]/', '', $this->wisata->whatsapp);
            if (Str::startsWith($no, '0')) $no = '62' . substr($no, 1);
            elseif (!Str::startsWith($no, '62')) $no = '62' . $no;
            return "https://wa.me/{$no}";
        }

        return null;
    }

    public function getGmapsUrlAttribute(): ?string
    {
        if ($this->gmaps_link) {
            return $this->gmaps_link;
        }
        if ($this->umkm && $this->umkm->hasGmaps()) {
            return $this->umkm->link_gmaps;
        }
        return null;
    }

    public function getJamOperasionalAttribute(): ?string
    {
        return $this->umkm?->jam_operasional ?? $this->wisata?->jadwal;
    }

    public function getProdukUnggulanAttribute(): ?string
    {
        return $this->umkm?->produk_unggulan;
    }

    public function getHargaTiketFormattedAttribute(): ?string
    {
        if ($this->wisata && !is_null($this->wisata->harga_tiket)) {
            return $this->wisata->harga_tiket == 0 ? 'Gratis / Bebas Masuk' : 'Rp ' . number_format($this->wisata->harga_tiket, 0, ',', '.');
        }
        return null;
    }

    public function getDeskripsiLengkapAttribute(): string
    {
        if (!empty($this->deskripsi)) {
            return $this->deskripsi;
        }

        if ($this->umkm && !empty($this->umkm->deskripsi)) {
            return $this->umkm->deskripsi;
        }

        if ($this->wisata && !empty($this->wisata->deskripsi)) {
            return $this->wisata->deskripsi;
        }

        return 'Informasi tempat dan titik lokasi pada peta wilayah Desa Selorejo.';
    }

    public function getKategoriLabelAttribute(): string
    {
        return self::KATEGORI_LIST[$this->kategori] ?? ucfirst($this->kategori);
    }

    public function getKategoriIconAttribute(): string
    {
        return self::KATEGORI_ICONS[$this->kategori] ?? 'map-pin';
    }

    public function getKategoriColorAttribute(): string
    {
        return self::KATEGORI_COLORS[$this->kategori] ?? '#1a5c38';
    }

    public function getDusunLabelAttribute(): string
    {
        return ucfirst($this->dusun);
    }
}
