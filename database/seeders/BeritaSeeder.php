<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Berita;

class BeritaSeeder extends Seeder {
    public function run() {
        Berita::truncate();
        $berita = [
            [
                'judul' => 'Koperasi "Merah Putih" Desa Selorejo Suplai Jeruk Bantu Program Makan Bergizi Gratis Nasional',
                'slug' => 'koperasi-selorejo-suplai-jeruk-makan-bergizi-gratis',
                'konten' => '<p>Di awal 2026 ini, inovasi tiada henti datang dari <strong>Koperasi Desa Merah Putih</strong> di Selorejo. Bekerja sama secara strategis dengan para pekebun jeruk, koperasi ini sukses berperan sebagai pusat serapan (off-taker) komoditas jeruk keprok lokal untuk melayani kebutuhan Program Nasional "Makan Bergizi Gratis" (MBG) yang dicetuskan Pemerintah.</p><p>Kades Selorejo, Bambang Soponyono, menyatakan apresiasinya, "Ini adalah jalan besar di mana hasil agrowisata dan perkebunan Dau bisa berkolaborasi dengan program penuntasan stunting dan kecukupan gizi berskala nasional," tutupnya.</p>',
                'kategori' => 'Kabar Desa',
                'tanggal' => '2026-02-15',
                'penulis' => 'Admin Desa',
                'gambar' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=800&q=80',
                'status_publish' => 'publish'
            ],
            [
                'judul' => 'Masterplan Destinasi Wisata 2024: Membangun Lahan Parkir Khusus Bus Pariwisata untuk Bedengan & Petik Jeruk',
                'slug' => 'masterplan-lahan-parkir-bus-pariwisata-2024',
                'konten' => '<p>Pemerintah Desa Selorejo mengintegrasikan perencanaan strategis untuk menyelesaikan masalah penumpukan kendaraan di area wisata alam Bumi Perkemahan Bedengan dan Wisata Petik Jeruk saat akhir pekan. APBDes difokuskan untuk membebaskan lahan dan melakukan <i>paving blok</i> guna memfasilitasi jalur manuver dan pemberhentian Bus Pariwisata tipe Medium dan Large.</p><p>Proses pembangunan ini didukung dana investasi desa dan BUMDes yang target pengoperasiannya akan rampung sebelum puncak musim liburan Q3 mendatang.</p>',
                'kategori' => 'Kabar Desa',
                'tanggal' => '2024-11-20',
                'penulis' => 'Humas Pemdes',
                'gambar' => 'https://images.unsplash.com/photo-1506521781263-d8422e82f27a?w=800&q=80',
                'status_publish' => 'publish'
            ],
            [
                'judul' => 'Kampanye Beralih ke Pertanian Organik: Ciptakan Jeruk Bebas Residu Pestisida',
                'slug' => 'kampanye-beralih-pertanian-organik-jeruk',
                'konten' => '<p>Balai Penyuluhan Pertanian Kecamatan Dau (BPP Dau) bersama perangkat desa gencar melakukan sosialisasi "Pertanian Ramah Iklim" kepada puluhan kelompok tani Jeruk Selorejo.</p><p>Program ini menyasar pendampingan pembuatan pupuk kendang terfermentasi, MOL, serta pembasmi hama nabati demi mewujudkan buah Jeruk Keprok Batu 55 yang bebas kimia demi keamanan tubuh saat dikonsumsi utuh saat Agrowisata Petik Jeruk berlangsung.</p>',
                'kategori' => 'Kabar Desa',
                'tanggal' => '2025-05-10',
                'penulis' => 'BUMDes Selorejo',
                'gambar' => 'https://images.unsplash.com/photo-1592982537447-6f296cb3adea?w=800&q=80',
                'status_publish' => 'publish'
            ],
            [
                'judul' => 'Musyawarah Perencanaan Desa: Menentukan Prioritas Pembangunan Tahun 2027',
                'slug' => 'musyawarah-perencanaan-desa-selorejo-2027',
                'konten' => '<p>Warga Selorejo berkumpul di balai desa untuk merumuskan arah kebijakan pembangunan mendatang. Diskusi hangat mengenai perbaikan jalan tani dan penguatan sistem drainase menjadi topik utama dalam pertemuan ini guna mendukung akses agrowisata yang lebih baik.</p>',
                'kategori' => 'Kabar Desa',
                'tanggal' => '2026-03-01',
                'penulis' => 'Sekretaris Desa',
                'gambar' => 'https://images.unsplash.com/photo-1577412647305-991150c7d163?w=800&q=80',
                'status_publish' => 'publish'
            ],
            [
                'judul' => 'Festival Jeruk Selorejo: Semarak Panen Raya di Lereng Kawi',
                'slug' => 'festival-jeruk-selorejo-semarak-panen-raya',
                'konten' => '<p>Kemeriahan festival tahunan yang menampilkan gunungan jeruk setinggi 3 meter. Acara ini menarik ribuan wisatawan dan menjadi ajang promosi bagi produk olahan turunan jeruk hasil kreasi ibu-ibu PKK desa.</p>',
                'kategori' => 'Kabar Desa',
                'tanggal' => '2025-08-15',
                'penulis' => 'Admin Desa',
                'gambar' => 'https://images.unsplash.com/photo-1550258987-190a2d41a8ba?w=800&q=80',
                'status_publish' => 'publish'
            ],
            [
                'judul' => 'Peningkatan Digitalisasi Desa: Akses Wi-Fi Gratis di Area Publik',
                'slug' => 'peningkatan-digitalisasi-desa-selorejo-wifi-gratis',
                'konten' => '<p>Dalam upaya mewujudkan Smart Village, Pemdes Selorejo telah memasang titik hotspot Wi-Fi gratis di Balai Desa dan Alun-Alun. Fasilitas ini ditujukan untuk mempermudah akses informasi dan mendukung kegiatan belajar daring bagi pelajar desa.</p>',
                'kategori' => 'Kabar Desa',
                'tanggal' => '2026-01-10',
                'penulis' => 'Operator Desa',
                'gambar' => 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?w=800&q=80',
                'status_publish' => 'publish'
            ],
            [
                'judul' => 'Pelatihan UMKM Desa: Inovasi Pengemasan Produk Jeruk',
                'slug' => 'pelatihan-umkm-desa-inovasi-pengemasan',
                'konten' => '<p>Pelaku UMKM lokal mendapatkan pendampingan mengenai desain kemasan modern dan strategi pemasaran digital. Tujuannya agar produk khas Selorejo dapat menembus pasar ritel yang lebih luas dan memiliki nilai jual yang lebih tinggi.</p>',
                'kategori' => 'Kabar Desa',
                'tanggal' => '2025-12-05',
                'penulis' => 'BUMDes Selorejo',
                'gambar' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=800&q=80',
                'status_publish' => 'publish'
            ],
            [
                'judul' => 'Posyandu Terintegrasi: Menjamin Kesehatan Ibu dan Anak',
                'slug' => 'posyandu-terintegrasi-kesehatan-ibu-anak',
                'konten' => '<p>Kegiatan rutin pemeriksaan kesehatan di Selorejo kini hadir dengan layanan lebih lengkap. Selain penimbangan dan imunisasi, kini tersedia layanan konsultasi gizi menggunakan hasil bumi lokal sebagai bahan tambahan MP-ASI yang sehat.</p>',
                'kategori' => 'Kabar Desa',
                'tanggal' => '2026-04-05',
                'penulis' => 'Admin Desa',
                'gambar' => 'https://images.unsplash.com/photo-1584362946045-12448ca55d91?w=800&q=80',
                'status_publish' => 'publish'
            ]
        ];
        Berita::insert($berita);
    }
}
