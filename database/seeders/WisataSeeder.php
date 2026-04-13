<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Wisata;

class WisataSeeder extends Seeder {
    public function run() {
        Wisata::truncate();
        $data = [
            [
                'judul' => 'Agrowisata Petik Jeruk Selorejo',
                'kategori' => 'Agrowisata',
                'deskripsi' => "Menjadi ikon utama Desa Selorejo, Agrowisata Petik Jeruk menawarkan pengalaman autentik berada di tengah hamparan kebun jeruk seluas puluhan hektare... [truncated]",
                'harga_tiket' => 20000,
                'jadwal' => "Senin - Minggu: 08.00 - 16.00 WIB (Musim Panen: Juni - Desember)",
                'aturan' => "1. Tiket masuk sudah termasuk makan jeruk sepuasnya di dalam kebun...\n2. Jeruk yang dibawa pulang akan ditimbang...\n3. Harap menjaga kelestarian pohon...",
                'gambar' => 'https://images.unsplash.com/photo-1557800636-894a64c1696f?w=1200'
            ],
            [
                'judul' => 'Bumi Perkemahan Bedengan',
                'kategori' => 'Wisata Alam',
                'deskripsi' => "Terletak di kaki Gunung Panderman, Bumi Perkemahan Bedengan adalah oasis ketenangan di tengah hutan pinus yang rimbun...",
                'harga_tiket' => 10000,
                'jadwal' => "Kunjungan Biasa: 07.00 - 17.00 WIB\nCamping Ground: Buka 24 Jam",
                'aturan' => "1. Dilarang membuang sampah...\n2. Biaya camping menginap adalah Rp 25.000...\n3. Harap menjaga ketenangan...",
                'gambar' => 'https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7?w=1200'
            ],
            [
                'judul' => 'Air Terjun Brues',
                'kategori' => 'Wisata Alam',
                'deskripsi' => "Misteri keindahan alam yang tersembunyi di rimbunnya hutan Selorejo. Air Terjun Brues menawarkan keheningan dan kesejukan air pegunungan asli...",
                'harga_tiket' => 5000,
                'jadwal' => "Senin - Minggu: 07.00 - 15.00 WIB",
                'aturan' => "1. Wajib lapor ke pos pendataan...\n2. Dilarang keras merusak flora...\n3. Tidak dianjurkan berkunjung...",
                'gambar' => 'https://images.unsplash.com/photo-1433086966358-54859d0ed716?w=1200'
            ],
            [
                'judul' => 'Adventure Trail & Sirkuit ATV',
                'kategori' => 'Agrowisata',
                'deskripsi' => "Bagi para pecinta adrenalin dan olahraga otomotif, Selorejo menyediakan lintasan menantang untuk Motor Trail dan ATV...",
                'harga_tiket' => 150000,
                'jadwal' => "Sabtu & Minggu: 08.00 - 16.00 WIB",
                'aturan' => "1. Wajib menggunakan helm...\n2. Usia minimal 15 tahun...\n3. Ikuti rute yang telah ditentukan...",
                'gambar' => 'https://images.unsplash.com/photo-1531641022831-291772186846?w=1200'
            ],
            [
                'judul' => 'Wisata Kesenian & Budaya Jawi',
                'kategori' => 'Budaya & Event',
                'deskripsi' => "Desa Selorejo bukan hanya tentang alam, namun juga menjaga nyala api peradaban leluhur...",
                'harga_tiket' => 0,
                'jadwal' => "Latihan Rutin: Malam Minggu Pukul 19.00 WIB",
                'aturan' => "1. Terbuka untuk umum...\n2. Boleh mendokumentasikan...\n3. Khusus rombongan...",
                'gambar' => 'https://images.unsplash.com/photo-1598001859187-b2478f7e2c9e?w=1200'
            ],
            [
                'judul' => 'Karnaval Tumpeng Jeruk Ageng',
                'kategori' => 'Budaya & Event',
                'deskripsi' => "Ini adalah Puncak Kemeriahan Desa Selorejo yang dinanti-nanti setiap tahunnya. Arakan Tumpeng Jeruk Ageng merupakan perwujudan syukur warga...",
                'harga_tiket' => 0,
                'jadwal' => "Event Tahunan (Agustus / Puncak Musim Panen Raya)",
                'aturan' => "1. Tontonan gratis untuk publik.\n2. Dilarang mengambil jeruk tumpeng sebelum didoakan.\n3. Harap tertib.",
                'gambar' => 'https://images.unsplash.com/photo-1620608639207-657743905e94?w=1200'
            ],
        ];
        foreach ($data as $item) {
            Wisata::create($item);
        }
    }
}
