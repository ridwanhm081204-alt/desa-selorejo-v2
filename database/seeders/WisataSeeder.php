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
                'deskripsi' => "Menjadi ikon utama Desa Selorejo, Agrowisata Petik Jeruk menawarkan pengalaman autentik berada di tengah hamparan kebun jeruk seluas puluhan hektare. Desa ini dikenal sebagai penghasil jeruk berkualitas tinggi dengan varietas unggulan seperti Jeruk Keprok Batu 55 yang manis segar, Jeruk Baby Java, hingga varietas Valencia.\n\nWisatawan tidak hanya sekadar berkunjung, namun dapat merasakan sensasi memetik buah jeruk langsung dari dahan pohonnya di bawah bimbingan petani lokal. Keunikan dari wisata ini adalah konsep 'All You Can Eat' di dalam kebun, di mana pengunjung diperbolehkan menikmati buah jeruk sepuasnya selama berada di lokasi. \n\nLokasi kebun yang berada di lereng bukit memberikan panorama visual yang menakjubkan dengan latar belakang pegunungan dan udara yang sangat bersih. Wisata ini sangat direkomendasikan untuk edukasi anak-anak mengenai dunia pertanian buah-buahan.",
                'harga_tiket' => 20000,
                'jadwal' => "Senin - Minggu: 08.00 - 16.00 WIB (Musim Panen: Juni - Desember)",
                'aturan' => "1. Tiket masuk sudah termasuk makan jeruk sepuasnya di dalam kebun.\n2. Jeruk yang dibawa pulang akan ditimbang dengan harga pasar petani yang terjangkau.\n3. Harap menjaga kelestarian pohon dengan tidak mematahkan ranting secara kasar.",
                'gambar' => 'https://images.unsplash.com/photo-1557800636-894a64c1696f?w=1200&q=80'
            ],
            [
                'judul' => 'Bumi Perkemahan Bedengan',
                'deskripsi' => "Terletak di kaki Gunung Panderman, Bumi Perkemahan Bedengan adalah oasis ketenangan di tengah hutan pinus yang rimbun. Keistimewaan utama tempat ini adalah aliran Sungai Metro yang jernih dan dangkal, memungkinkan pengunjung untuk bermain air atau sekadar bersantai mendengarkan gemericik air yang menenangkan.\n\nDengan udara yang sangat sejuk pada ketinggian sekitar 1.100 mdpl, Bedengan menjadi destinasi favorit untuk berkemah (camping), piknik keluarga, hingga kegiatan outbound. Area ini memiliki 17 titik camping ground yang telah tertata rapi, lengkap dengan fasilitas pendukung yang memadai untuk kenyamanan pengunjung.\n\nTempat ini juga menjadi spot fotografi favorit berkat barisan pohon pinus yang menjulang tinggi, menciptakan suasana 'Vibe Hutan' yang sangat estetik untuk keperluan media sosial maupun pre-wedding.",
                'harga_tiket' => 10000,
                'jadwal' => "Kunjungan Biasa: 07.00 - 17.00 WIB\nCamping Ground: Buka 24 Jam",
                'aturan' => "1. Dilarang membuang sampah di area hutan maupun aliran sungai.\n2. Biaya camping menginap adalah Rp 25.000 per tenda/malam.\n3. Harap menjaga ketenangan dan tidak merusak vegetasi sekitar.",
                'gambar' => 'https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7?w=1200&q=80'
            ],
            [
                'judul' => 'Air Terjun Brues',
                'deskripsi' => "Misteri keindahan alam yang tersembunyi di rimbunnya hutan Selorejo. Air Terjun Brues menawarkan keheningan dan kesejukan air pegunungan asli yang belum banyak tersentuh tangan manusia.\n\nAkses menuju air terjun berupa jalur penjelajahan ringan (trekking) yang akan memanjakan mata dengan keanekaragaman hayati hutan tropis. Lokasi ini sangat cocok untuk pelarian dari kepenatan kota (healing) dan bagi mereka yang menyukai petualangan alam liar yang asri.",
                'harga_tiket' => 5000,
                'jadwal' => "Senin - Minggu: 07.00 - 15.00 WIB (Tutup jika cuaca buruk)",
                'aturan' => "1. Wajib lapor ke pos pendataan sebelum masuk.\n2. Dilarang keras merusak flora dan fauna.\n3. Tidak dianjurkan berkunjung saat hujan deras.",
                'gambar' => 'https://images.unsplash.com/photo-1433086966358-54859d0ed716?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'
            ],
            [
                'judul' => 'Adventure Trail & Sirkuit ATV',
                'deskripsi' => "Bagi para pecinta adrenalin dan olahraga otomotif, Selorejo menyediakan lintasan menantang untuk Motor Trail dan ATV. Dengan kontur tanah perbukitan yang memiliki tingkat kesulitan bervariasi, arena ini menguji ketangkasan sekaligus menyuguhkan pemandangan lereng gunung yang spektakuler.\n\nPengunjung dapat memilih bermain di arena sirkuit cross tertutup yang aman bagi pemula, maupun mengambil paket 'Adventure Trip' membelah jalur perhutanan didampingi oleh instruktur profesional. Fasilitas penyewaan unit ATV dan motor trail juga tersedia lengkap dengan perlengkapan keselamatan standar.",
                'harga_tiket' => 150000,
                'jadwal' => "Sabtu & Minggu: 08.00 - 16.00 WIB (Hari kerja dengan reservasi)",
                'aturan' => "1. Wajib menggunakan helm dan safety gear.\n2. Usia minimal 15 tahun (untuk menyetir sendiri).\n3. Ikuti rute yang telah ditentukan pengelola.",
                'gambar' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/Motocross_en_C%C3%B3rdoba_-_Spain.jpg/1200px-Motocross_en_C%C3%B3rdoba_-_Spain.jpg'
            ],
            [
                'judul' => 'Wisata Kesenian & Budaya Jawi',
                'deskripsi' => "Desa Selorejo bukan hanya tentang alam, namun juga menjaga nyala api peradaban leluhur. Kami memiliki komunitas kebudayaan akar rumput yang sangat aktif melestarikan kesenian tari hingga musik tradisional Jawa.\n\nWisatawan dapat memesan pertunjukan khusus atau berinteraksi langsung dalam latihan rutin kesenian seperti Jaranan, Bantengan, Pencak Silat Tradisional, Campur Sari, hingga Ludruk dan Wayang Kulit. Ini adalah sarana edukasi budaya yang interaktif dan sangat berkesan bagi pelajar, mahasiswa, maupun ekspatriat.",
                'harga_tiket' => 0,
                'jadwal' => "Latihan Rutin: Malam Minggu Pukul 19.00 WIB (Balai Dukuh)",
                'aturan' => "1. Terbuka untuk umum tanpa dipungut biaya.\n2. Boleh mendokumentasikan selama tidak mengganggu acara.\n3. Khusus untuk rombongan yang ingin pentas privat, berlaku tarif donasi sanggar.",
                'gambar' => 'https://upload.wikimedia.org/wikipedia/commons/e/ea/Kesenian_Jaranan.jpg'
            ],
            [
                'judul' => 'Karnaval Tumpeng Jeruk Ageng',
                'deskripsi' => "Ini adalah Puncak Kemeriahan Desa Selorejo yang dinanti-nanti setiap tahunnya. Arakan Tumpeng Jeruk Ageng merupakan perwujudan syukur warga atas melimpahnya panen bumi, di mana ribuan buah jeruk disusun menjulang tinggi menyerupai gunung (tumpeng).\n\nAcara ini melibatkan seluruh warga dari Dusun Krajan hingga Selokerto dalam balutan pawai karnaval yang meriah, diwarnai dengan selamatan (Barikan), pentas kesenian jalanan, dan diakhiri dengan prosesi 'Grebeg' di mana warga dan wisatawan boleh berebut mengambil buah dari gunungan tumpeng tersebut sebagai simbol keberkahan.",
                'harga_tiket' => 0,
                'jadwal' => "Event Tahunan (Agustus / Puncak Musim Panen Raya)",
                'aturan' => "1. Tontonan gratis untuk publik.\n2. Dilarang mengambil jeruk tumpeng sebelum didoakan dan diinstruksikan panitia.\n3. Harap tertib saat mengikuti arak-arakan.",
                'gambar' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/cd/Gunungan_Grebeg_Maulud.jpg/1200px-Gunungan_Grebeg_Maulud.jpg'
            ]
        ];
        Wisata::insert($data);
    }
}
