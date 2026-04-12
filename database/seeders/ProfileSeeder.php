<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder {
    public function run() {
        Profile::truncate();
        Profile::create([
            'sejarah' => "Desa Selorejo, yang berakar dari nama kuno 'Watugedhe', adalah entitas yang kaya akan sejarah dan mitologi batu peninggalan pendiri abad ke-18, Mbah H. Turejo dan Mbah Sayang. Berkembang dari sentra sayur murni, desa ini bermesraan dengan agrikultur buah sejak 1990an hingga diresmikan sebagai Desa Wisata Jeruk yang makmur (Selo-Rejo).",
            'visi_misi' => "VISI: \"Terwujudnya Tatanan Kehidupan Masyarakat Desa Selorejo yang Agamis, Demokratis, Mandiri, Bersih, Indah dan Aman\" (SATATA GAMA KARTA RAHARJA).\n\nMISI:\n1. Membumikan nilai agama dan budaya.\n2. Pemerintahan yang bersih dan siap melayani.\n3. Roso rumongso handarbeni / saiyek saeko proyo.\n4. Kualitas SDM unggul.\n5. Kesejahteraan berbasis ekonomi sirkular jerukan.\n6. Pelestarian lingungan.\n7. Sinergitas instansi.",
            'geografi' => "Desa Selorejo memiliki luas wilayah sekitar 623 hektare dengan ketinggian ekstrem antara 800-1.200 meter di atas permukaan laut. Kondisi topografi berbukit penuh perhutanan (2.068 Ha). Suhu sejuk rata-rata berkisar 18-26°C dengan curah hujan stabil sangat menopang kultur agrikultur 100%.",
            'batas_wilayah' => "Utara: Desa Gading Kulon, Kec. Dau\nSelatan: Desa Petung Sewu, Kec. Dau\nTimur: Desa Tegalweru, Kec. Dau\nBarat: Kawasan Hutan",
            'peta_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.590213330273!2d112.54406589999999!3d-7.937794299999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7883e8e3f8e01f%3A0x99971f240006ad50!2sKantor%20Desa%20Selorejo!5e0!3m2!1sid!2sid!4v1775964843637!5m2!1sid!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'
        ]);
    }
}
