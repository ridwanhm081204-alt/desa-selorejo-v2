<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Umkm extends Model
{
    protected $table = 'umkms';

    protected $fillable = [
        'dusun',
        'nama_pemilik',
        'nama_usaha',
        'jenis_usaha',
        'kategori',
        'deskripsi',
        'jam_operasional',
        'produk_unggulan',
        'no_telepon',
        'username_sosmed',
        'alamat_rt_rw',
        'gmail_usaha',
        'link_gmaps',
        'nama_toko_gmaps',
        'latitude',
        'longitude',
        'status_lokasi',
        'foto',
    ];

    protected $casts = [
        'latitude'  => 'float',
        'longitude' => 'float',
    ];

    // ─── Daftar Kategori ────────────────────────────────────────────────────────

    public const KATEGORI_LIST = [
        'Toko Kelontong & Sembako',
        'Warung Makan',
        'Wisata & Kios Petik Jeruk',
        'Toko Buah & Sayur',
        'Jual Jeruk & Bibit',
        'Toko Obat Tanaman & Pupuk',
        'Kuliner Ringan & Jajanan',
        'Jasa & Persewaan',
        'Frozen Food',
        'Fashion & Kebutuhan Rumah Tangga',
        'Sembako & Hewan/Perabot',
        'Dagang Buah Lain',
    ];

    public const DUSUN_LIST = ['Krajan', 'Selokerto', 'Gumuk'];

    public const STATUS_LIST = ['terverifikasi', 'belum_terdaftar', 'perlu_dicek'];

    // ─── Scopes ─────────────────────────────────────────────────────────────────

    public function scopeVerified($query)
    {
        return $query->where('status_lokasi', 'terverifikasi');
    }

    public function scopeByKategori($query, string $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    public function scopeByDusun($query, string $dusun)
    {
        return $query->where('dusun', $dusun);
    }

    // ─── Helper Methods ──────────────────────────────────────────────────────────

    public function hasCoordinates(): bool
    {
        return !is_null($this->latitude) && !is_null($this->longitude);
    }

    public function isVerified(): bool
    {
        return $this->status_lokasi === 'terverifikasi';
    }

    public function hasGmaps(): bool
    {
        return !empty($this->link_gmaps) && $this->link_gmaps !== 'BELUM_TERDAFTAR';
    }

    /**
     * Membuat link WhatsApp dari nomor telepon.
     * Format: hapus 0 di depan, ganti dengan 62.
     */
    public function whatsappLink(): ?string
    {
        if (empty($this->no_telepon)) return null;

        $no = preg_replace('/[^0-9]/', '', $this->no_telepon);
        if (strlen($no) < 8) return null;

        if (Str::startsWith($no, '0')) {
            $no = '62' . substr($no, 1);
        } elseif (!Str::startsWith($no, '62')) {
            $no = '62' . $no;
        }

        return "https://wa.me/{$no}";
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

        // Unsplash photo pools per kategori untuk tampilan depan toko/perkebunan realistic
        $categoryPhotos = [
            'Wisata & Kios Petik Jeruk' => [
                'https://images.unsplash.com/photo-1611080626919-7cf5a9dbab5b?w=600&q=80',
                'https://images.unsplash.com/photo-1557800636-894a64c1696f?w=600&q=80',
                'https://images.unsplash.com/photo-1582979512210-99b6a53386f9?w=600&q=80',
                'https://images.unsplash.com/photo-1590502593747-42a996133562?w=600&q=80',
            ],
            'Jual Jeruk & Bibit' => [
                'https://images.unsplash.com/photo-1547514701-42782101795e?w=600&q=80',
                'https://images.unsplash.com/photo-1580052614034-c55d20bfee3b?w=600&q=80',
                'https://images.unsplash.com/photo-1534531141161-e41d133a8bd7?w=600&q=80',
            ],
            'Warung Makan' => [
                'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=600&q=80',
                'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=600&q=80',
                'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=600&q=80',
            ],
            'Toko Kelontong & Sembako' => [
                'https://images.unsplash.com/photo-1604719312566-8912e9227c6a?w=600&q=80',
                'https://images.unsplash.com/photo-1578916171728-46686eac8d58?w=600&q=80',
                'https://images.unsplash.com/photo-1583258292688-d0213dc5a3a8?w=600&q=80',
            ],
            'Toko Obat Tanaman & Pupuk' => [
                'https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?w=600&q=80',
                'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=600&q=80',
            ],
            'Kuliner Ringan & Jajanan' => [
                'https://images.unsplash.com/photo-1563245372-f21724e3856d?w=600&q=80',
                'https://images.unsplash.com/photo-1528735602780-2552fd46c7af?w=600&q=80',
            ],
            'Jasa & Persewaan' => [
                'https://images.unsplash.com/photo-1521791136064-7986c2920216?w=600&q=80',
                'https://images.unsplash.com/photo-1497366216548-37526070297c?w=600&q=80',
            ],
            'Frozen Food' => [
                'https://images.unsplash.com/photo-1584473457406-6df376d53de8?w=600&q=80',
                'https://images.unsplash.com/photo-1607623814075-e51df1bdc82f?w=600&q=80',
            ],
            'Fashion & Kebutuhan Rumah Tangga' => [
                'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=600&q=80',
                'https://images.unsplash.com/photo-1472851294608-062f824d29cc?w=600&q=80',
            ],
            'Sembako & Hewan/Perabot' => [
                'https://images.unsplash.com/photo-1583258292688-d0213dc5a3a8?w=600&q=80',
                'https://images.unsplash.com/photo-1604719312566-8912e9227c6a?w=600&q=80',
            ],
            'Toko Buah & Sayur' => [
                'https://images.unsplash.com/photo-1610832958506-aa56368176cf?w=600&q=80',
                'https://images.unsplash.com/photo-1518843875459-f738682238a6?w=600&q=80',
            ],
            'Dagang Buah Lain' => [
                'https://images.unsplash.com/photo-1464965911861-746a04b4bca6?w=600&q=80',
                'https://images.unsplash.com/photo-1519996529931-28324d5a630e?w=600&q=80',
            ],
        ];

        $pool = $categoryPhotos[$this->kategori] ?? $categoryPhotos['Wisata & Kios Petik Jeruk'];
        $index = $this->id % count($pool);

        return $pool[$index];
    }

    /**
     * Mapping jenis_usaha → kategori.
     * Dipanggil saat seeder dan bisa dipakai di controller.
     */
    public static function mapKategori(string $jenisUsaha): string
    {
        $jenis = strtolower($jenisUsaha);

        // Wisata & kios petik jeruk
        if (str_contains($jenis, 'wisata') || str_contains($jenis, 'petik jeruk') || str_contains($jenis, 'kios jeruk') || str_contains($jenis, 'agro')) {
            return 'Wisata & Kios Petik Jeruk';
        }

        // Jual jeruk & bibit
        if (str_contains($jenis, 'jual jeruk') || str_contains($jenis, 'grosir') || str_contains($jenis, 'ecer jeruk') || str_contains($jenis, 'jeruk & bibit') || str_contains($jenis, 'penjual jeruk') || str_contains($jenis, 'bensin ecer')) {
            return 'Jual Jeruk & Bibit';
        }

        // Toko obat tanaman & pupuk
        if (str_contains($jenis, 'obat tanaman') || str_contains($jenis, 'pupuk') || str_contains($jenis, 'pertanian')) {
            return 'Toko Obat Tanaman & Pupuk';
        }

        // Warung makan
        if (str_contains($jenis, 'warung') || str_contains($jenis, 'makan') || str_contains($jenis, 'bakso') || str_contains($jenis, 'mie ayam') || str_contains($jenis, 'kopi') || str_contains($jenis, 'cafe') || str_contains($jenis, 'kafe') || str_contains($jenis, 'kedai')) {
            return 'Warung Makan';
        }

        // Frozen food
        if (str_contains($jenis, 'frozen')) {
            return 'Frozen Food';
        }

        // Fashion & kebutuhan rumah tangga
        if (str_contains($jenis, 'plastik') || str_contains($jenis, 'baju') || str_contains($jenis, 'fashion') || str_contains($jenis, 'toserba') || str_contains($jenis, 'pakaian')) {
            return 'Fashion & Kebutuhan Rumah Tangga';
        }

        // Jasa & persewaan
        if (str_contains($jenis, 'atk') || str_contains($jenis, 'brilink') || str_contains($jenis, 'fotocopy') || str_contains($jenis, 'fc') || str_contains($jenis, 'persewaan') || str_contains($jenis, 'jasa') || str_contains($jenis, 'bengkel') || str_contains($jenis, 'laundry') || str_contains($jenis, 'landry') || str_contains($jenis, 'servis')) {
            return 'Jasa & Persewaan';
        }

        // Toko buah & sayur
        if (str_contains($jenis, 'buah') || str_contains($jenis, 'sayur')) {
            return 'Toko Buah & Sayur';
        }

        // Sembako & hewan/perabot
        if (str_contains($jenis, 'hewan') || str_contains($jenis, 'perabot') || str_contains($jenis, 'kambing')) {
            return 'Sembako & Hewan/Perabot';
        }

        // Kuliner ringan & jajanan
        if (str_contains($jenis, 'jajan') || str_contains($jenis, 'seblak') || str_contains($jenis, 'ringan') || str_contains($jenis, 'krispi') || str_contains($jenis, 'snack')) {
            return 'Kuliner Ringan & Jajanan';
        }

        // Dagang buah lain
        if (str_contains($jenis, 'strawberry') || (str_contains($jenis, 'dagang') && str_contains($jenis, 'buah'))) {
            return 'Dagang Buah Lain';
        }

        // Default: toko kelontong & sembako
        return 'Toko Kelontong & Sembako';
    }
}
