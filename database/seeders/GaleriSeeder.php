<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Galeri;

class GaleriSeeder extends Seeder {
    public function run() {
        Galeri::truncate();
        $data = [
            ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1542442828-287217bfb218?w=800', 'caption'=>'Camping Ground Bumi Perkemahan Bedengan','kategori'=>'Wisata', 'tanggal'=>'2026-01-15'],
            ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1596489312224-87f5e8daadd1?w=800', 'caption'=>'Segarnya Jeruk Keprok Batu 55 Khas Selorejo','kategori'=>'Wisata', 'tanggal'=>'2025-08-20'],
            ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1559525839-b184a4d698c7?w=800', 'caption'=>'Kopi Arabika Lereng Kawi Hasil Panen Petani','kategori'=>'Produk', 'tanggal'=>'2025-09-01'],
            ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1601614742718-4721c0ad52f7?w=800', 'caption'=>'Pegunungan Kawi Landscape Dau','kategori'=>'Alam', 'tanggal'=>'2025-07-10'],
            ['tipe'=>'foto','url'=>'https://images.unsplash.com/photo-1563229871-ddb642ec0b6f?w=800', 'caption'=>'Kolaborasi Rapat BUMDes dan Kades Bapak Bambang','kategori'=>'Pemerintahan', 'tanggal'=>'2026-02-20'],
            ['tipe'=>'foto','url'=>'https://plus.unsplash.com/premium_photo-1661962360670-65e1dbba62bc?w=800', 'caption'=>'Infrastruktur Paving Jalan Tani Desa','kategori'=>'Pembangunan', 'tanggal'=>'2024-12-01']
        ];
        foreach ($data as $item) {
            Galeri::create($item);
        }
    }
}
