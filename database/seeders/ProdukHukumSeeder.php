<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProdukHukum;

class ProdukHukumSeeder extends Seeder
{
    public function run(): void
    {
        ProdukHukum::truncate();

        ProdukHukum::create([
            'judul' => 'RENCANA KERJA PEMERINTAH DESA SELOREJO TAHUN 2026',
            'jenis' => 'Peraturan Desa',
            'tahun' => 2025,
            'tanggal_ditetapkan' => '2025-11-30',
            'konten' => '<p><strong>Dengan Kesepakatan Bersama<br>BADAN PERMUSYAWARATAN DESA SELOREJO<br>dan<br>KEPALA DESA SELOREJO</strong></p>
            <p><strong>M E M U T U S K A N :</strong></p>
            <p>Menetapkan : <strong>PERATURAN DESA TENTANG RENCANA KERJA PEMERINTAH DESA SELOREJO TAHUN 2026</strong></p>
            <hr>
            <h4>Pasal 1</h4>
            <p>(1) Rencana Kerja Pemerintah Desa Tahun 2026 disusun dengan sistematika sebagai berikut:<br>
            <strong>BAB I PENDAHULUAN</strong><br>
            1.1 Latar Belakang;<br>
            1.2 Dasar Hukum;<br>
            1.3 Maksud dan Tujuan<br>
            <br>
            <strong>BAB II GAMBARAN UMUM KEBIJAKAN KEUANGAN</strong><br>
            2.1 Kebijakan Pendapatan Desa<br>
            2.2 Kebijakan Belanja Desa<br>
            2.3 Kebijakan Pembiayaan Desa<br>
            <br>
            <strong>BAB III EVALUASI PELAKSANAAN RKP DESA DAN PERMASALAHAN PEMBANGUNAN</strong><br>
            3.1 Evaluasi Pelaksanaan RKP Desa Tahun Sebelumnya<br>
            3.2 Permasalahan Pembangunan<br>
            <br>
            <strong>BAB IV RENCANA PROGRAM DAN KEGIATAN PEMBANGUNAN DESA</strong><br>
            4.1 Prioritas Program dan Kegiatan Skala Desa<br>
            4.2 Prioritas Program dan Kegiatan Skala Kabupaten, Provinsi dan Pusat<br>
            4.3 Pagu Indikatif Desa Masing-Masing Bidang<br>
            <br>
            <strong>BAB V PENUTUP</strong><br>
            5.1 Lampiran - lampiran</p>
            <p>(2) Rencana Kerja Pemerintah Desa Tahun 2026 sebagaimana dimaksud pada ayat (1) tercantum dalam Lampiran yang merupakan bagian yang tidak terpisahkan dari Peraturan Desa ini.</p>
            <h4>Pasal 2</h4>
            <p>Rencana Kerja Pemerintah Desa Tahun 2026 merupakan Landasan dan Pedoman Bagi Pemerintahan Desa, Lembaga Kemasyarakatan Desa dan masyarakat dalam Pelaksanaan Pembangunan Desa Tahun 2026.</p>
            <h4>Pasal 3</h4>
            <p>RKP Desa dapat diubah dalam hal:<br>
            a) Terjadi peristiwa khusus, seperti bencana alam, krisis politik, krisis ekonomi, dan/atau kerusuhan sosial yang berkepanjangan; atau<br>
            b) Terdapat perubahan mendasar atas kebijakan Pemerintah, Pemerintah Provinsi Jawa Timur dan/atau Pemerintah Kabupaten Malang.</p>
            <h4>Pasal 4</h4>
            <p>Perubahan RKP Desa sebagaimana dimaksud dalam Pasal (3) dibahas dan disepakati bersama dengan Badan Permusyawaratan Desa (BPD) dalam Musrenbang Desa dan selanjutnya ditetapkan dengan Peraturan Desa.</p>
            <h4>Pasal 5</h4>
            <p>Berdasarkan Peraturan Desa ini selanjutnya disusun Anggaran Pendapatan dan Belanja Desa Tahun Anggaran 2026.</p>
            <h4>Pasal 6</h4>
            <p>Peraturan Desa ini mulai berlaku pada tanggal diundangkan, agar setiap orang mengetahuinya, memerintahkan pengundangan Peraturan Desa ini dengan penempatannya dalam Lembaran Desa.</p>
            <hr>
            <p>Ditetapkan di : Selorejo<br>
            Pada tanggal : 30 Nopember 2025<br>
            <strong>KEPALA DESA SELOREJO<br><br><br>BAMBANG SOPONYONO</strong></p>
            <p>Diundangkan di : Selorejo<br>
            Pada tanggal : 30 Nopember 2025<br>
            <strong>SEKRETARIS DESA<br><br><br>RETNO KUSTIAH</strong></p>
            <p><em>Lembaran Berita Desa Selorejo Kecamatan Dau Kabupaten Malang Nomor 4 Tahun 2025</em></p>'
        ]);
        
        ProdukHukum::create([
            'judul' => 'ANGGARAN PENDAPATAN DAN BELANJA DESA SELOREJO TAHUN 2026',
            'jenis' => 'Peraturan Desa',
            'tahun' => 2025,
            'tanggal_ditetapkan' => '2025-12-30',
        ]);
    }
}
