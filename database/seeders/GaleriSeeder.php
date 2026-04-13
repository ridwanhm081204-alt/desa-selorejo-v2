<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Galeri;

class GaleriSeeder extends Seeder {
    public function run() {
        Galeri::truncate();
        $data = [
            // Wisata / Camping
            ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1542442828-287217bfb218?w=800', 'caption'=>'Camping Ground Bumi Perkemahan Bedengan','kategori'=>'Wisata Alam', 'tanggal'=>'2026-03-01'],
            ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1596489312224-87f5e8daadd1?w=800', 'caption'=>'Atmosfer Berkemah di Hutan Pinus Selorejo','kategori'=>'Wisata Alam', 'tanggal'=>'2026-03-05'],
            ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1559525839-b184a4d698c7?w=800', 'caption'=>'Area Campground Outdoor Ramai Wisatawan','kategori'=>'Event', 'tanggal'=>'2026-03-10'],
            
            // Agrobisnis / Jeruk
            ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1627435601357-3f6c76feb185?w=800', 'caption'=>'Hamparan Kebun Jeruk Keprok Batu 55','kategori'=>'Potensi Desa', 'tanggal'=>'2026-03-12'],
            ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1590779033100-9f60af05a013?w=800', 'caption'=>'Proses Panen Jeruk oleh Petani Lokal','kategori'=>'Kegiatan Warga', 'tanggal'=>'2026-03-14'],
            ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1601614742718-4721c0ad52f7?w=800', 'caption'=>'Pohon Jeruk Rimbun dengan Buah Siap Petik','kategori'=>'Potensi Desa', 'tanggal'=>'2026-03-15'],
            
            // Landscape / Alam
            ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1518495122543-bc87e5606d54?w=800', 'caption'=>'Terasering Sawah Hijau Selorejo','kategori'=>'Wisata Alam', 'tanggal'=>'2026-03-16'],
            ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=800', 'caption'=>'Panorama Alam Lereng Kawi yang Menyejukkan','kategori'=>'Wisata Alam', 'tanggal'=>'2026-03-18'],
            ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1596489312224-87f5e8daadd1?w=800', 'caption'=>'Infrastruktur Jalan Desa yang Rapih Menuju Wisata','kategori'=>'Infrastruktur', 'tanggal'=>'2026-03-20'],
            
            // Sosial / Budaya
            ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1558905623-bc97b76778f5?w=800', 'caption'=>'Kegiatan Gotong Royong Warga Desa','kategori'=>'Kegiatan Warga', 'tanggal'=>'2026-03-22'],
            ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1592982537447-6f296cb3adea?w=800', 'caption'=>'Pembangunan Jembatan Desa Selorejo','kategori'=>'Infrastruktur', 'tanggal'=>'2026-03-24'],
            ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1588612143093-41bb33659223?w=800', 'caption'=>'Pesta Rakyat Bersih Desa Selorejo','kategori'=>'Event', 'tanggal'=>'2026-03-26'],
        ];
        foreach ($data as $item) {
            Galeri::create($item);
        }
    }
}
