<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder {
    public function run() {
        Profile::truncate();
        Profile::create([
            'sejarah' => "Desa Selorejo adalah sebuah desa yang terletak di Kecamatan Dau, Kabupaten Malang, Provinsi Jawa Timur. Desa ini dikenal sebagai salah satu sentra produksi jeruk keprok terbesar di Kabupaten Malang. Nama Selorejo berasal dari kata 'selo' (batu) dan 'rejo' (makmur), yang bermakna kemakmuran di atas tanah berbatu. Desa ini mulai berkembang sebagai kawasan agrowisata sejak tahun 1990-an ketika perkebunan jeruk keprok mulai dikelola secara lebih terstruktur oleh warga.",
            'visi_misi' => "VISI: Terwujudnya Desa Selorejo yang Mandiri, Sejahtera, dan Berdaya Saing Berbasis Agrowisata yang Berkelanjutan.\n\nMISI:\n1. Meningkatkan produktivitas pertanian jeruk keprok dan produk unggulan desa.\n2. Mengembangkan potensi wisata petik jeruk secara profesional dan berkelanjutan.\n3. Meningkatkan kualitas infrastruktur dan pelayanan publik.\n4. Memberdayakan sumber daya manusia lokal melalui pelatihan dan pendidikan.\n5. Mewujudkan tata kelola pemerintahan desa yang transparan dan akuntabel.",
            'geografi' => "Desa Selorejo memiliki luas wilayah sekitar 623 hektare dengan ketinggian antara 600-700 meter di atas permukaan laut. Kondisi topografi berbukit dengan kemiringan sedang hingga curam sangat cocok untuk budidaya jeruk keprok. Suhu rata-rata berkisar 18-26°C dengan curah hujan sekitar 1.800-2.200 mm per tahun.",
            'batas_wilayah' => "Utara: Desa Mulyoagung, Kec. Dau\nSelatan: Desa Sumbersekar, Kec. Dau\nTimur: Desa Petungsewu, Kec. Dau\nBarat: Desa Kucur, Kec. Dau",
            'peta_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15806.384864810932!2d112.53843605!3d-7.937170050000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7883ef912d9999%3A0xf8ff8468809efd9c!2sSelorejo%2C%20Kec.%20Dau%2C%20Kabupaten%20Malang%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1775912011055!5m2!1sid!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'
        ]);
    }
}
