<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Wisata;

class WisataSeeder extends Seeder {
    public function run() {
        Wisata::truncate();
        $data = [
            [
                'judul' => 'Bumi Perkemahan Bedengan',
                'deskripsi' => "Kawasan wisata alam hutan pinus yang sangat asri. Dilengkapi dengan aliran Sungai Metro yang jernih dan udara pegunungan yang sangat sejuk (1.200 mdpl). Bedengan menawarkan 17 titik area kemah (camping ground) dan area nongkrong pinggir sungai. Sangat cocok untuk wisata keluarga dan pemulihan stres dari hiruk-pikuk kota.",
                'harga_tiket' => 10000,
                'jadwal' => "Kunjungan Biasa: 07.00 - 17.00 WIB\nCamping Area: Buka 24 Jam",
                'aturan' => "1. Dilarang membuang sampah sembarangan (botol plastik bawa turun kembali).\n2. Harga tiket camping adalah Rp 20.000/malam.\n3. Dilarang merusak tumbuhan hutan pinus.",
                'gambar' => 'https://images.unsplash.com/photo-1542442828-287217bfb218?w=800&q=80'
            ],
            [
                'judul' => 'Agrowisata Petik Jeruk Dau',
                'deskripsi' => "Wisata andalan Desa Selorejo. Anda dapat memetik langsung jeruk segar jenis Keprok Batu 55 dan Baby Java langsung dari dahan pohonnya di lahan seluas puluhan hektar berlatar belakang Gunung Semeru.",
                'harga_tiket' => 20000,
                'jadwal' => "Senin - Minggu: 08.00 - 16.00 WIB",
                'aturan' => "1. Tiket masuk sudah termasuk makan sepuasnya di dalam kebun.\n2. Jeruk dibawa pulang ditimbang dengan harga per kilogram.\n3. Dilarang merusak dan mematahkan ranting pohon.",
                'gambar' => 'https://images.unsplash.com/photo-1596489312224-87f5e8daadd1?w=800&q=80'
            ]
        ];
        Wisata::insert($data);
    }
}
