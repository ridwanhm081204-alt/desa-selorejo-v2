<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder {
    public function run() {
        $settings = [
            ['key'=>'nama_desa','value'=>'Desa Selorejo'],
            ['key'=>'nama_pemerintah','value'=>'Pemerintah Desa Selorejo'],
            ['key'=>'kecamatan','value'=>'Kecamatan Dau'],
            ['key'=>'kabupaten','value'=>'Kabupaten Malang'],
            ['key'=>'provinsi','value'=>'Jawa Timur'],
            ['key'=>'alamat','value'=>'Jl. Raya Selorejo No. 1, Desa Selorejo, Kec. Dau, Kab. Malang 65151'],
            ['key'=>'telepon','value'=>'0813.3163.5678'],
            ['key'=>'whatsapp','value'=>'0813.3163.5678'],
            ['key'=>'email','value'=>'desawisataselorejo@gmail.com'],
            ['key'=>'jam_kerja','value'=>'Senin-Jumat: 08.00-15.00 WIB'],
            ['key'=>'facebook','value'=>'https://facebook.com/desaselorejo'],
            ['key'=>'instagram','value'=>'https://instagram.com/desaselorejo'],
            ['key'=>'youtube','value'=>''],
            ['key'=>'kode_pos','value'=>'65151'],
            ['key'=>'jumlah_penduduk','value'=>'3.640'],
            ['key'=>'jumlah_kk','value'=>'1.024'],
            ['key'=>'luas_wilayah','value'=>'623'],
            ['key'=>'jumlah_dusun','value'=>'3'],
            ['key'=>'hero_struktur','value'=>json_encode(['title' => 'Struktur Organisasi', 'subtitle' => 'Jajaran Perangkat Desa Selorejo Periode Terkini', 'icon' => 'network'])],
            ['key'=>'hero_bpd','value'=>json_encode(['title' => 'Badan Permusyawaratan Desa', 'subtitle' => 'Lembaga legislatif desa sebagai mitra Pemerintah Desa.', 'icon' => 'users-2'])],
            ['key'=>'hero_lembaga', 'value'=>json_encode(['title' => 'Lembaga Desa', 'subtitle' => 'Lembaga Kemasyarakatan Pendukung Pembangunan Desa', 'icon' => 'building-2'])],
            ['key'=>'hero_wisata', 'value'=>json_encode(['title' => 'Destinasi Wisata Selorejo', 'subtitle' => 'Jelajahi keajaiban alam dan kearifan agrikultur di lereng pegunungan Malang.', 'icon' => 'mountain'])],
            ['key'=>'hero_produk', 'value'=>json_encode(['title' => 'Katalog Produk Desa', 'subtitle' => 'Mendukung karya lokal dan UMKM Desa Selorejo', 'icon' => 'shopping-bag'])],
            ['key'=>'hero_statistik', 'value'=>json_encode(['title' => 'Statistik Demografi Desa', 'subtitle' => 'Transparansi data penduduk Desa Wisata Selorejo berdasarkan angka riil kependudukan.', 'icon' => 'bar-chart-2'])],
            ['key'=>'hero_apbdes', 'value'=>json_encode(['title' => 'Transparansi APBDes', 'subtitle' => 'Laporan Anggaran Pendapatan dan Belanja Desa Selorejo Tahun Anggaran 2024.', 'icon' => 'file-text'])],
            ['key'=>'hero_berita', 'value'=>json_encode(['title' => 'Kabar Desa', 'subtitle' => 'Informasi, pengumuman, dan liputan terkini dari Desa Selorejo', 'icon' => 'newspaper'])],
            ['key'=>'hero_galeri', 'value'=>json_encode(['title' => 'Galeri Dokumentasi', 'subtitle' => 'Jendela visual potensi dan pesona alami Desa Selorejo', 'icon' => 'image'])],
            ['key'=>'hero_kontak', 'value'=>json_encode(['title' => 'Hubungi Kami', 'subtitle' => 'Kami siap melayani dan mendengarkan aspirasi Anda.', 'icon' => 'phone-call'])],
            ['key'=>'hero_polling', 'value'=>json_encode(['title' => 'Jejak Pendapat', 'subtitle' => 'Suara Anda sangat berarti bagi kemajuan desa kami.', 'icon' => 'pie-chart'])],
        ];
        foreach ($settings as $s) {
            Setting::updateOrCreate(['key'=>$s['key']], ['value'=>$s['value']]);
        }
    }
}
