<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\KknAnggota;
use App\Models\KknSetting;

class KknController extends Controller
{
    public function index()
    {
        // ── Data Anggota: ambil dari DB, fallback ke array hardcoded ──
        $dbAnggota = KknAnggota::orderBy('urutan')->get();

        if ($dbAnggota->isNotEmpty()) {
            // Format agar kompatibel dengan template lama
            $anggota = $dbAnggota->map(function ($m) {
                return [
                    'nama'   => $m->nama,
                    'nim'    => $m->nim,
                    'prodi'  => $m->prodi,
                    'fak'    => $m->fakultas,
                    'foto'   => $m->foto
                                 ? (str_starts_with($m->foto, 'images/') ? $m->foto : 'storage/' . $m->foto)
                                 : 'images/default-avatar.png',
                    'badge'  => $m->badge,
                    'proker' => $m->proker,
                    'sdg'    => $m->sdg ?? [],
                    '_model' => $m, // expose model untuk akses id dsb jika perlu
                ];
            })->toArray();
        } else {
            // Fallback hardcoded (agar halaman tidak kosong jika seeder belum dijalankan)
            $anggota = $this->fallbackAnggota();
        }

        // ── Settings: ambil dari DB ──
        $kknSettings = [];
        $rows = KknSetting::all();
        foreach ($rows as $row) {
            $decoded = json_decode($row->value, true);
            $kknSettings[$row->key] = (json_last_error() === JSON_ERROR_NONE) ? $decoded : $row->value;
        }

        return view('public.kkn-uns-178', compact('anggota', 'kknSettings'));
    }

    private function fallbackAnggota(): array
    {
        return [
            ['nama'=>'Fauzan Van Tobbi','nim'=>'K2523042','prodi'=>'Pendidikan Teknik Mesin','fak'=>'FKIP UNS','foto'=>'images/Fauzan.png','badge'=>'ketua','proker'=>'Edukasi Energi Terbarukan untuk Siswa SD: Bermain Bersama Energi Terbarukan','sdg'=>[4]],
            ['nama'=>'Adellisa Alya Avrillita','nim'=>'K7123006','prodi'=>'Pendidikan Guru Sekolah Dasar','fak'=>'FKIP UNS','foto'=>'images/Adellisa.png','badge'=>null,'proker'=>'Pemanfaatan Limbah Kulit Jeruk sebagai Spray Anti Nyamuk Alami','sdg'=>[8]],
            ['nama'=>'Dewantara Daru Eka Widyarma','nim'=>'O0123029','prodi'=>'Pendidikan Jasmani, Kesehatan dan Rekreasi','fak'=>'FKOR UNS','foto'=>'images/Dewa.png','badge'=>null,'proker'=>'Pengenalan dan Praktik Permainan Tradisional untuk Aktivitas Fisik Siswa SD','sdg'=>[3,4]],
            ['nama'=>'Ferdiansyah Adi Pratama','nim'=>'H0223053','prodi'=>'Ilmu Tanah','fak'=>'FP UNS','foto'=>'images/Ferdi.png','badge'=>null,'proker'=>'Sosialisasi dan Pembuatan Komposter Berbasis Limbah Organik Rumah Tangga','sdg'=>[1,17]],
            ['nama'=>'Fitriana Bunga Agustin','nim'=>'F0123054','prodi'=>'Ekonomi Pembangunan','fak'=>'FEB UNS','foto'=>'images/Bunga.png','badge'=>null,'proker'=>'Pelatihan dan Pendampingan Digital Marketing UMKM melalui Media Sosial dan Google Maps','sdg'=>[1,8]],
            ['nama'=>'Hanifah Abriana','nim'=>'F0123057','prodi'=>'Ekonomi Pembangunan','fak'=>'FEB UNS','foto'=>'images/Nifah.png','badge'=>null,'proker'=>'Gerakan Karang Taruna Desa Selorejo untuk Edukasi Investasi Digital secara Aman','sdg'=>[1]],
            ['nama'=>'Margareth Valerie Sitepu','nim'=>'I0323066','prodi'=>'Teknik Industri','fak'=>'FT UNS','foto'=>'images/Marga.png','badge'=>null,'proker'=>'Pelatihan dan Pendampingan Standarisasi Penanganan Produk Jeruk Desa Selorejo','sdg'=>[8]],
            ['nama'=>'Putra Aditya Noveindra','nim'=>'O0123085','prodi'=>'Pendidikan Jasmani, Kesehatan dan Rekreasi','fak'=>'FKOR UNS','foto'=>'images/Putra.png','badge'=>null,'proker'=>'Edukasi Teknik Pembalutan sebagai Penanganan Awal saat Terjadi Cedera','sdg'=>[3,4]],
            ['nama'=>'Ridwan Hakim Mashadi','nim'=>'K3523066','prodi'=>'Pendidikan Teknik Informatika dan Komputer','fak'=>'FKIP UNS','foto'=>'images/Ridwan.png','badge'=>'developer','proker'=>'Pengembangan Website Desa Wisata Petik Jeruk Selorejo sebagai Media Promosi Digital Berkelanjutan','sdg'=>[8,9,11,17]],
            ['nama'=>'Rinta Harin Safira','nim'=>'I0223086','prodi'=>'Arsitektur','fak'=>'FT UNS','foto'=>'images/Rinta.png','badge'=>null,'proker'=>'Pemetaan Destinasi Kawasan Wisata Desa Selorejo','sdg'=>[17]],
        ];
    }
}
