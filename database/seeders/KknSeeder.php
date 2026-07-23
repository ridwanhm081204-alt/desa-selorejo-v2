<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KknAnggota;
use App\Models\KknSetting;

class KknSeeder extends Seeder
{
    public function run(): void
    {
        // ── Data Anggota (dari hardcoded di kkn-uns-178.blade.php) ──
        $anggota = [
            [
                'nama'     => 'Fauzan Van Tobbi',
                'nim'      => 'K2523042',
                'prodi'    => 'Pendidikan Teknik Mesin',
                'fakultas' => 'FKIP UNS',
                'foto'     => null, // pakai foto di public/images/Fauzan.png (path lama)
                'foto_legacy' => 'Fauzan.png',
                'badge'    => 'ketua',
                'proker'   => 'Edukasi Energi Terbarukan untuk Siswa SD: Bermain Bersama Energi Terbarukan',
                'sdg'      => [4],
                'urutan'   => 1,
            ],
            [
                'nama'     => 'Adellisa Alya Avrillita',
                'nim'      => 'K7123006',
                'prodi'    => 'Pendidikan Guru Sekolah Dasar',
                'fakultas' => 'FKIP UNS',
                'foto'     => null,
                'foto_legacy' => 'Adellisa.png',
                'badge'    => null,
                'proker'   => 'Pemanfaatan Limbah Kulit Jeruk sebagai Spray Anti Nyamuk Alami',
                'sdg'      => [8],
                'urutan'   => 2,
            ],
            [
                'nama'     => 'Dewantara Daru Eka Widyarma',
                'nim'      => 'O0123029',
                'prodi'    => 'Pendidikan Jasmani, Kesehatan dan Rekreasi',
                'fakultas' => 'FKOR UNS',
                'foto'     => null,
                'foto_legacy' => 'Dewa.png',
                'badge'    => null,
                'proker'   => 'Pengenalan dan Praktik Permainan Tradisional untuk Aktivitas Fisik Siswa SD',
                'sdg'      => [3, 4],
                'urutan'   => 3,
            ],
            [
                'nama'     => 'Ferdiansyah Adi Pratama',
                'nim'      => 'H0223053',
                'prodi'    => 'Ilmu Tanah',
                'fakultas' => 'FP UNS',
                'foto'     => null,
                'foto_legacy' => 'Ferdi.png',
                'badge'    => null,
                'proker'   => 'Sosialisasi dan Pembuatan Komposter Berbasis Limbah Organik Rumah Tangga',
                'sdg'      => [1, 17],
                'urutan'   => 4,
            ],
            [
                'nama'     => 'Fitriana Bunga Agustin',
                'nim'      => 'F0123054',
                'prodi'    => 'Ekonomi Pembangunan',
                'fakultas' => 'FEB UNS',
                'foto'     => null,
                'foto_legacy' => 'Bunga.png',
                'badge'    => null,
                'proker'   => 'Pelatihan dan Pendampingan Digital Marketing UMKM melalui Media Sosial dan Google Maps',
                'sdg'      => [1, 8],
                'urutan'   => 5,
            ],
            [
                'nama'     => 'Hanifah Abriana',
                'nim'      => 'F0123057',
                'prodi'    => 'Ekonomi Pembangunan',
                'fakultas' => 'FEB UNS',
                'foto'     => null,
                'foto_legacy' => 'Nifah.png',
                'badge'    => null,
                'proker'   => 'Gerakan Karang Taruna Desa Selorejo untuk Edukasi Investasi Digital secara Aman',
                'sdg'      => [1],
                'urutan'   => 6,
            ],
            [
                'nama'     => 'Margareth Valerie Sitepu',
                'nim'      => 'I0323066',
                'prodi'    => 'Teknik Industri',
                'fakultas' => 'FT UNS',
                'foto'     => null,
                'foto_legacy' => 'Marga.png',
                'badge'    => null,
                'proker'   => 'Pelatihan dan Pendampingan Standarisasi Penanganan Produk Jeruk Desa Selorejo',
                'sdg'      => [8],
                'urutan'   => 7,
            ],
            [
                'nama'     => 'Putra Aditya Noveindra',
                'nim'      => 'O0123085',
                'prodi'    => 'Pendidikan Jasmani, Kesehatan dan Rekreasi',
                'fakultas' => 'FKOR UNS',
                'foto'     => null,
                'foto_legacy' => 'Putra.png',
                'badge'    => null,
                'proker'   => 'Edukasi Teknik Pembalutan sebagai Penanganan Awal saat Terjadi Cedera',
                'sdg'      => [3, 4],
                'urutan'   => 8,
            ],
            [
                'nama'     => 'Ridwan Hakim Mashadi',
                'nim'      => 'K3523066',
                'prodi'    => 'Pendidikan Teknik Informatika dan Komputer',
                'fakultas' => 'FKIP UNS',
                'foto'     => null,
                'foto_legacy' => 'Ridwan.png',
                'badge'    => 'developer',
                'proker'   => 'Pengembangan Website Desa Wisata Petik Jeruk Selorejo sebagai Media Promosi Digital Berkelanjutan',
                'sdg'      => [8, 9, 11, 17],
                'urutan'   => 9,
            ],
            [
                'nama'     => 'Rinta Harin Safira',
                'nim'      => 'I0223086',
                'prodi'    => 'Arsitektur',
                'fakultas' => 'FT UNS',
                'foto'     => null,
                'foto_legacy' => 'Rinta.png',
                'badge'    => null,
                'proker'   => 'Pemetaan Destinasi Kawasan Wisata Desa Selorejo',
                'sdg'      => [17],
                'urutan'   => 10,
            ],
        ];

        foreach ($anggota as $data) {
            $legacy = $data['foto_legacy'];
            unset($data['foto_legacy']);
            // Simpan path legacy sebagai foto (images/Fauzan.png dll) agar tetap tampil
            $data['foto'] = 'images/' . $legacy;
            KknAnggota::updateOrCreate(['nim' => $data['nim']], $data);
        }

        // ── Settings KKN ──
        KknSetting::set('logo', 'images/logo-kkn-178.png');
        KknSetting::set('kelompok_label', 'KKN TEMATIK UNS — KELOMPOK 178');
        KknSetting::set('judul_utama', 'KKN Tematik UNS 178');
        KknSetting::set('subjudul', 'Desa Selorejo');
        KknSetting::set('tagline', "Pemberdayaan Desa Selorejo Berbasis Digitalisasi, Inovasi Produk Lokal,\ndan Penguatan UMKM Menuju Desa Wisata Berkelanjutan");

        KknSetting::set('link_instagram', 'https://www.instagram.com/raharjo.selorejo?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==');
        KknSetting::set('link_tiktok', 'https://www.tiktok.com/@raharjo.selorejo?is_from_webapp=1&sender_device=pc');

        KknSetting::set('badge_lokasi', "Desa Selorejo, Kec. Dau\nKab. Malang, Jawa Timur");
        KknSetting::set('badge_periode', 'Juli – Agustus 2026');
        KknSetting::set('badge_tema', 'Digitalisasi Desa & Pemberdayaan Ekonomi');
        KknSetting::set('badge_anggota', "10 Mahasiswa\nFKIP · FEB · FKOR · FT · FP");

        KknSetting::set('deskripsi_program', [
            "Kelompok KKN Tematik UNS 178 adalah kelompok pengabdian masyarakat mahasiswa Universitas Sebelas Maret (UNS) yang bertugas di Desa Selorejo, Kecamatan Dau, Kabupaten Malang. Program ini berada di bawah Subdirektorat KKN dan Organisasi Kemahasiswaan UNS, dengan bimbingan <strong>Rin Widya Agustin, S.Psi., M.Psi.</strong> sebagai Dosen Pembimbing Lapangan.",
            "Desa Selorejo dikenal sebagai desa agrowisata dengan potensi unggulan berupa perkebunan jeruk keprok dan tebu, serta wisata petik jeruk yang sudah dikenal di kawasan Kecamatan Dau. Namun promosi potensi ini masih sangat konvensional, mengandalkan mulut ke mulut, dan belum memanfaatkan platform digital secara optimal. Di sinilah peran kelompok ini: menjembatani antara potensi lokal yang luar biasa dengan jangkauan digital yang lebih luas.",
            "Kelompok ini merancang program kerja lintas bidang yang komprehensif: <strong>digitalisasi</strong> (website desa wisata), <strong>ekonomi kreatif dan UMKM</strong> (digital marketing, standarisasi produk, investasi digital), <strong>pendidikan dan literasi digital anak</strong> (desain grafis, energi terbarukan, permainan tradisional), <strong>kesehatan</strong> (edukasi pertolongan pertama cedera), serta <strong>lingkungan</strong> (komposter organik, spray anti nyamuk dari limbah jeruk), agar dampaknya terhadap desa terasa menyeluruh, bukan hanya dari satu sisi.",
        ]);

        // DPL (Dosen Pembimbing Lapangan)
        KknSetting::set('dpl', [
            'nama'      => 'Rin Widya Agustin, S.Psi., M.Psi.',
            'jabatan'   => 'Penata / Lektor',
            'institusi' => 'Universitas Sebelas Maret',
            'foto'      => 'images/Rin Widya.png',
        ]);

        $this->command->info('KKN seeder selesai: ' . KknAnggota::count() . ' anggota, ' . KknSetting::count() . ' settings.');
    }
}
