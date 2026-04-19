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
                'deskripsi' => "Menjadi ikon utama Wisata Desa Selorejo, Agrowisata Petik Jeruk menawarkan pengalaman autentik berada di tengah hamparan kebun jeruk seluas puluhan hektare di lereng pegunungan yang sangat sejuk. Varietas unggulan yang dibudidayakan di sini adalah Jeruk Keprok Batu 55 dan Jeruk Babal, yang terkenal akan perpaduan rasa manis segar dan bulir yang melimpah. Udara pegunungan yang mencapai 18-22 derajat celcius menjadikan wisata ini sangat cocok untuk melepaskan penat dari hiruk pikuk perkotaan.\n\nPengunjung tidak hanya sekadar berjalan-jalan, melainkan diizinkan secara leluasa untuk mencicipi langsung dan memetik jeruk dari pohonnya. Tersedia pula edukasi pertanian singkat dari para petani lokal mengenai cara pembibitan, perawatan, hingga membedakan buah jeruk yang matang sempurna. Lokasi ini seringkali menjadi tujuan wisata keluarga terbaik karena aman untuk anak-anak dan sarat akan nilai edukasi lingkungan.",
                'harga_tiket' => 20000,
                'jadwal' => "Senin - Minggu: 08.00 - 16.00 WIB (Musim Panen Raya: Juni - Desember)",
                'aturan' => "1. Tiket masuk sudah termasuk makan jeruk sepuasnya secara gratis di dalam kebun.\n2. Jeruk yang dipetik dan dibawa pulang akan ditimbang dan dikenakan tarif perkilo (harga petani).\n3. Pengunjung dilarang keras mematahkan ranting atau merusak bunga bakal buah saat memetik.\n4. Harap membuang kulit jeruk pada tong sampah organik yang telah disediakan di tiap sudut kebun.",
                'gambar' => 'https://images.unsplash.com/photo-1557800636-894a64c1696f?w=1200'
            ],
            [
                'judul' => 'Bumi Perkemahan Bedengan',
                'kategori' => 'Wisata Alam',
                'deskripsi' => "Terletak strategis di kaki Gunung Panderman dan Gunung Kawi, Bumi Perkemahan Bedengan adalah oasis ketenangan di tengah hutan pinus yang berusia puluhan tahun. Aroma khas getah pinus berpadu dengan gemericik aliran sungai berbatu bening yang melintasi area perkemahan menciptakan suasana relaksasi alam yang tidak ada duanya. Kawasan Bedengan mempertahankan kontur aslinya tanpa banyak sentuhan beton buatan, sehingga kelestariannya masih terjaga murni.\n\nFasilitas di area camping ground ini telah ditata sedemikian rupa untuk memfasilitasi kegiatan Jambore, Outbound Perusahaan, hingga keluarga yang ingin membangun tenda akhir pekan. Pengelola menyediakan persewaan tenda, matras, hingga kayu bakar bagi wisatawan yang datang tanpa persiapan. Saat malam tiba, hamparan bintang di langit dapat terlihat sangat jelas karena minimnya polusi cahaya di kawasan hutan perhutani ini.",
                'harga_tiket' => 15000,
                'jadwal' => "Kunjungan Reguler: 07.00 - 17.00 WIB\nCamping & Menginap: Buka 24 Jam Non-Stop",
                'aturan' => "1. Dilarang keras membawa benda tajam berbahaya dan minuman keras ke area perkemahan.\n2. Biaya camping/menginap adalah Rp 35.000,- per tenda per malam (di luar tiket masuk awal).\n3. Dilarang menyalakan api unggun sembarangan selain di tungku batu/area yang sudah dikonstruksi.\n4. Jam malam diberlakukan pukul 22.00 WIB; harap mengecilkan suara musik demi ketenangan bersama.",
                'gambar' => 'https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7?w=1200'
            ],
            [
                'judul' => 'Air Terjun Brues',
                'kategori' => 'Wisata Alam',
                'deskripsi' => "Misteri keindahan alam yang tersembunyi di kedalaman vegetasi rimbun Desa Selorejo. Air Terjun Brues menawarkan keheningan eksotis dengan sumber mata air pegunungan yang sangat jernih dan menyegarkan. Berbeda dengan air terjun populer lainnya yang riuh, Brues membawakan kesan 'private resort' alami. Akses menuju lokasi memerlukan tracking ringan menyusuri jalan setapak pinggir sungai sejauh kurang lebih 1,5 kilometer yang dipenuhi oleh rimbunan paku-pakuan dan spesies burung endemik.\n\nCurahan air terjun setinggi 12 meter ini bermuara pada cekungan kolam alami yang tidak terlalu dalam, sehingga relatif aman bagi pengunjung yang ingin sekadar berendam atau bermain air. Keberadaan tebing batuan purba di sekeliling air terjun menjadikannya spot fotografi alam liar yang sangat dramatis dan memukau.",
                'harga_tiket' => 5000,
                'jadwal' => "Senin - Minggu: 07.00 - 15.00 WIB (Sangat disarankan kunjungan pagi hari)",
                'aturan' => "1. Pengunjung wajib melaporkan diri ke Pos Pemuda Perhutani di desa sebelum melakukan tracking.\n2. Tidak dianjurkan berkunjung atau tracking pada saat cuaca mendung gelap atau hujan lebat guna menghindari volume air mendadak.\n3. Jangan membuang sampah plastik; bawalah turun kembali sampah Anda ke desa.\n4. Patuhi marka jalan pita yang diikatkan di pohon sepanjang jalur tracking.",
                'gambar' => 'https://images.unsplash.com/photo-1433086966358-54859d0ed716?w=1200'
            ],
            [
                'judul' => 'Adventure Trail & Sirkuit ATV',
                'kategori' => 'Agrowisata',
                'deskripsi' => "Bagi para pencinta adrenalin dan olahraga otomotif, kontur perbukitan Desa Selorejo menyediakan lintasan menantang melalui wahana Adventure Trail dan Sirkuit ATV. Melintasi berbagai macam medan seperti jalan tanah merah berlumpur, sungai dangkal, hingga tanjakan menukik tebing di sela-sela perkebunan apel dan jeruk. Sirkuit ini dirancang oleh komunitas off-road lokal untuk memastikan keamanan sekaligus memberikan sensasi guncangan alam liar yang memompa jantung.\n\nPengelola menyediakan penyewaan lengkap unit motor Trail 150cc dan kendaraan ATV penggerak ganda (4x4) beserta pelindung keselamatan standar penuh (Helm, Goggle, Body Protector). Tak perlu khawatir tersesat, karena rute trail ini sudah dipandu oleh marshall berpengalaman yang akan menemani perjalanan Anda menembus pesona alam Selorejo dengan cara yang jauh berbeda dan maskulin.",
                'harga_tiket' => 150000,
                'jadwal' => "Sabtu, Minggu & Hari Libur Nasional: 08.00 - 16.00 WIB (Menyesuaikan kondisi sirkuit/cuaca)",
                'aturan' => "1. Peserta wahana diwajibkan menggunakan seluruh perlengkapan instrumen keamanan dasar (Helm, Sepatu safety, padding).\n2. Batasan usia minimal bagi penyewa ATV solo adalah 15 tahun.\n3. Dilarang memutar rute keluar dari jalur yang sudah diberi bendera marka karena berisiko berpapasan tajam.\n4. Jika kendaraan mengalami kendala teknis (mogok di jalur), dilarang membongkar sendiri; tunggu marshall tiba.",
                'gambar' => 'https://images.unsplash.com/photo-1531641022831-291772186846?w=1200'
            ],
            [
                'judul' => 'Wisata Kesenian & Budaya Jawi',
                'kategori' => 'Budaya & Event',
                'deskripsi' => "Desa Selorejo bukan melulu soal keindahan panoramanya, namun roh pariwisata mereka juga sangat kental berkat lestarinya api kesenian peradaban leluhur Nusantara. Kelompok Karawitan dan komunitas Tari Bantengan lokal membawakan atraksi seni yang memukau sebagai wujud komitmen regenerasi kebudayaan pada generasi muda. Di sanggar wisata budaya, suara tabuhan kendang, saron, dan gong akan menyambut kedatangan Anda dengan aura mistis sekaligus megah.\n\nWisatawan yang datang dalam bentuk rombongan (sekolah atau studi tour) biasanya akan diajak berlatih dasar-dasar memukul bilah gamelan, belajar mengikat udeng, serta mengenal filosofi tarian Jaran Kepang dan Bantengan asli Malang. Tempat ini merupakan ruang pelestarian nyata yang interaktif; menghubungkan pesona pariwisata dengan keakraban nilai etnik pedesaan peninggalan Mataraman kuno.",
                'harga_tiket' => 0,
                'jadwal' => "Latihan Sanggar Terbuka: Setiap Malam Minggu Pukul 19.30 WIB. \n(Reservasi grup edukasi buka setiap hari kerja)",
                'aturan' => "1. Sanggar terbuka secara gratis dan bebas untuk disaksikan masyarakat umum dengan tertib.\n2. Harap berpakaian wajar dan menjaga kesopanan tutur kata saat berada di sekitar instrumen sakral gamelan.\n3. Dilarang menaiki atau memukul instrumen gamelan tanpa didampingi oleh instruktur seniman setempat.\n4. Pendokumentasian foto/video sangat dipersilakan demi membantu memajukan promosi kesenian desa.",
                'gambar' => 'https://images.unsplash.com/photo-1598001859187-b2478f7e2c9e?w=1200'
            ],
            [
                'judul' => 'Karnaval Tumpeng Jeruk Ageng',
                'kategori' => 'Budaya & Event',
                'deskripsi' => "Karnaval Tumpeng Jeruk Ageng adalah Puncak Kemeriahan dan hari paling sibuk di Desa Selorejo yang dinanti-nanti secara antusias setiap setahun sekali. Acara ini merupakan karnaval budaya sekaligus perwujudan syukur warga (sedekah bumi) atas panen raya raya buah jeruk dan melimpahnya sumber mata air untuk pertanian. Ribuan buah jeruk keprok segar disusun menjulang tinggi mencapai 3 hingga 5 meter menyerupai gunungan tumpeng raksasa, diarak beramai-ramai melintasi poros balai desa menuju batas akhir perkemahan.\n\nTak hanya arak-arakan tumpeng, event ini dimeriahkan juga oleh pasukan drumband pemuda, defile kebaya lokal, pameran hasil bumi hias, dan pesta kembang api di penghujung hari. Puncaknya adalah ketika sesepuh desa selesai merapalkan doa keselamatan, dan warga serta wisatan bersama-sama bergotong-royong merebut tumpeng jeruk tersebut (*Grebeg Jeruk*). Acara ini merepresentasikan nilai kerukunan serta magnet masif yang menarik turis asing maupun domestik tumpah ruah di Selorejo.",
                'harga_tiket' => 0,
                'jadwal' => "Event Pariwisata Tahunan (Diselenggarakan setiap akhir bulan Agustus / Puncak Panen Raya)",
                'aturan' => "1. Acara berskala besar ini terbuka secara umum dan 100% gratis sebagai pelestarian Sedekah Bumi desa.\n2. Saat prosesi Grebeg (perebutan) Jeruk, dilarang saling mendorong kasar atau mencederai; utamakan keselamatan wanita dan anak.\n3. Hindari memarkir kendaraan sembarangan di bahu jalan poros utama desa agar tidak memblokir mobilisasi warga yang mengarak.\n4. Jaga barang bawaan berharga Anda di tengah lautan manusia.",
                'gambar' => 'https://images.unsplash.com/photo-1620608639207-657743905e94?w=1200'
            ],
        ];
        foreach ($data as $item) {
            Wisata::create($item);
        }
    }
}
