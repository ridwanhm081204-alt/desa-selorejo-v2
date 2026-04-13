<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profile::updateOrCreate(['id' => 1], [
            // SEJARAH
            'sejarah' => 'Desa Selorejo yang dikenal saat ini awalnya memiliki akar sejarah yang kuat dengan nama "Watugedhe". Nama ini merujuk pada keberadaan dua batu raksasa tak lazim yang dipercaya memiliki daya mistis (hingga kini batu tersebut masih berada di lokasi aslinya). Perjalanan desa ini dimulai sekitar pertengahan abad ke-18 pasca Perang Diponegoro. Para pionir, yakni Mbah H. Turejo dan Mbah Sayang, bersama rombongan pelarian dari Mataram Islam yang melawan kolonial Belanda, melakukan "Babat Alas" atau pembukaan lahan di tengah hutan lebat lereng gunung sebagai hunian baru.\n\nSeiring waktu, nama Watugedhe bertransformasi menjadi Selorejo, yang diambil dari kombinasi kata "Selo" (batu) dan "Rejo" (diambil dari nama Mbah H. Turejo), melambangkan wilayah berbatu yang dibangun dan dimakmurkan oleh sang pendiri.\n\nSebelum dikenal sebagai penghasil jeruk, wilayah Selorejo merupakan lahan subur yang didominasi oleh tanaman sayur-mayur. Transformasi besar terjadi pada awal dekade 1990-an ketika muncul inisiatif dari dua tokoh masyarakat visioner, Abah Sulaiman dan Abah Dulawi. Mereka mulai merintis penanaman bibit jeruk keprok setelah melihat potensi topografi desa yang berada di ketinggian 650-1000 mdpl dengan suhu udara sejuk yang sangat ideal bagi pertumbuhan jeruk.\n\nMemasuki era modern, potensi agrikultur ini dikembangkan lebih jauh menjadi sektor pariwisata yang terintegrasi. Pada tahun 2011, Pemerintah Kabupaten Malang secara resmi mencanangkan Selorejo sebagai "Desa Wisata Jeruk". Kini, Selorejo telah mengukuhkan posisinya sebagai salah satu destinasi wisata unggulan di Jawa Timur yang mandiri dan berkelanjutan.',
            
            'sejarah_timeline' => [
                ['year' => 'Pertengahan Abad ke-18', 'title' => 'Era Watugedhe (Babat Alas)', 'desc' => 'Pembukaan lahan di masa akhir Perang Diponegoro oleh rombongan pelarian dari Mataram Islam yang dipimpin Mbah H. Turejo dan Mbah Sayang.', 'icon' => 'tag'],
                ['year' => 'Awal Abad ke-20', 'title' => 'Formalisasi Nama Selorejo', 'desc' => 'Perubahan nama resmi dari Watugedhe menjadi Selorejo sebagai bentuk penghormatan kepada perintis desa.', 'icon' => 'tag'],
                ['year' => 'Tahun 1990', 'title' => 'Era Revolusi Jeruk', 'desc' => 'Abah Sulaiman dan Abah Dulawi merintis penanaman jeruk keprok secara masif menggantikan tanaman sayur.', 'icon' => 'sun'],
                ['year' => 'Tahun 2011', 'title' => 'Peresmian Desa Wisata', 'desc' => 'Pemerintah Kabupaten Malang secara resmi mencanangkan Desa Selorejo sebagai destinasi "Agrowisata Petik Jeruk".', 'icon' => 'map-pin'],
                ['year' => 'Masa Kini', 'title' => 'Pusat Agrowisata Nasional', 'desc' => 'Selorejo memantapkan diri sebagai pusat edukasi agrowisata dan pemasok utama jeruk premium nasional.', 'icon' => 'check-circle'],
            ],

            // VISI MISI
            'visi' => '"Terwujudnya Tatanan Kehidupan Masyarakat Desa Selorejo yang Agamis, Demokratis, Mandiri, Bersih, Indah dan Aman"',
            'misi' => [
                ['icon' => 'book-open', 'text' => 'Mewujudkan pemahaman dan pengamalan nilai-nilai agama, adat istiadat, dan budaya lokal.'],
                ['icon' => 'shield-check', 'text' => 'Mewujudkan tata kelola pemerintahan yang baik, bersih, siap melayani, dan melindungi.'],
                ['icon' => 'users', 'text' => 'Menyatukan visi dalam membangun desa dengan asas kebersamaan (roso rumongso handarbeni / saiyek saeko proyo).'],
                ['icon' => 'graduation-cap', 'text' => 'Mewujudkan usaha peningkatan kualitas sumber daya manusia (SDM) masyarakat desa.'],
                ['icon' => 'sprout', 'text' => 'Mewujudkan kesejahteraan berbasis pertanian dengan menggalakkan UMKM dan pemberdayaan masyarakat.'],
                ['icon' => 'leaf', 'text' => 'Meningkatkan kualitas lingkungan hidup melalui sistem pengelolaan sumber daya alam yang berkelanjutan.'],
                ['icon' => 'network', 'text' => 'Membangun komunikasi dan kerja sama yang baik antara pemerintah desa, masyarakat, dan instansi lainnya.'],
            ],

            // GEOGRAFI
            'geografi' => 'Desa Selorejo secara strategis berada di Kecamatan Dau, Kabupaten Malang, dengan koordinat kisaran 7°56\'16.50" LS dan 112°32\'38.93" BT. Desa ini berada pada wilayah tinggi bersuhu sejuk yang ekstrem, yakni antara 800 hingga 1.200 meter di atas permukaan laut (mdpl). Kawasan desa dikelilingi oleh bentang alam yang luas, termasuk lebih dari 2.068 hektare area hutan (lindung dan produksi) dan lebih dari 238 hektare lahan perkebunan, menjadikannya paru-paru hijau dan kawasan tangkapan air vital bagi Kabupaten Malang.\n\nKondisi topografi Desa Selorejo didominasi oleh perbukitan. Struktur tanah pertanian murni yang mencapai tingkat kesuburan 100% dan suhu rata-rata sejuk menciptakan ekosistem yang sangat ideal bagi sektor agrikultur murni. Curah hujan yang stabil mendukung produktivitas lahan, terutama untuk budidaya komoditas unggulan Jeruk yang ditopang oleh subsektor peternakan (sapi, kambing, ayam, lele).\n\nDari aspek sosial-kewilayahan, Selorejo memiliki karakteristik khas yang menjadi kebanggaan tersendiri. Masyarakat desa dikenal sangat tangguh dan memiliki sifat bawaan "Sumeh" (ramah senyum). Karakteristik ramah tamah yang tulus ini pada akhirnya berpadu harmonis dengan lanskap alam yang asri.',
            
            'geografi_stats' => [
                ['icon' => 'cloud-sun', 'value' => '18-26°C', 'label' => 'Suhu Rata-rata'],
                ['icon' => 'mountain', 'value' => '1.200 mdpl', 'label' => 'Ketinggian Maks.'],
                ['icon' => 'cloud-rain', 'value' => '2.000 mm', 'label' => 'Curah Hujan / Thn'],
                ['icon' => 'map', 'value' => '623 Ha', 'label' => 'Luas Wilayah'],
            ],

            'batas_wilayah_json' => [
                ['dir' => 'Utara', 'text' => 'Desa Gadingkulon, Kec. Dau', 'icon' => 'compass', 'rotate' => '0'],
                ['dir' => 'Selatan', 'text' => 'Desa Petungsewu, Kec. Dau', 'icon' => 'compass', 'rotate' => '180'],
                ['dir' => 'Timur', 'text' => 'Desa Tegalweru, Kec. Dau', 'icon' => 'compass', 'rotate' => '90'],
                ['dir' => 'Barat', 'text' => 'Kawasan Hutan Lindung', 'icon' => 'compass', 'rotate' => '-90'],
            ],

            // PETA
            'peta_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15806.384864810932!2d112.53843605!3d-7.937170050000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7883ef912d9999%3A0xf8ff8468809efd9c!2sSelorejo%2C%20Kec.%20Dau%2C%20Kabupaten%20Malang%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1775912011055!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            'peta_rute_pribadi' => 'Dapat diakses 30 menit dari Kota Malang ke arah Barat (Batu).',
            'peta_rute_umum' => 'Tersedia angkutan pedesaan jalur stasiun ke wilayah Terminal Landungsari.',
        ]);
    }
}
