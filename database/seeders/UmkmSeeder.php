<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Umkm;

class UmkmSeeder extends Seeder
{
    public function run(): void
    {
        Umkm::truncate();

        $csvPath = database_path('seeders/umkm-seed-data.csv');

        if (!file_exists($csvPath)) {
            $this->command->error("File CSV tidak ditemukan: {$csvPath}");
            return;
        }

        $handle = fopen($csvPath, 'r');
        $header = fgetcsv($handle); // skip header row

        $count = 0;
        while (($row = fgetcsv($handle)) !== false) {
            if (count($row) < 10) continue;

            [$dusun, $nama_pemilik, $nama_usaha, $jenis_usaha, $no_telepon,
             $username_sosmed, $alamat_rt_rw, $gmail_usaha, $link_gmaps, $nama_toko_gmaps] = $row;

            // Skip baris kosong
            if (empty(trim($nama_usaha))) continue;

            // Normalisasi link gmaps
            $link_gmaps = trim($link_gmaps);
            if (empty($link_gmaps) || $link_gmaps === ' ') {
                $link_gmaps = null;
                $status_lokasi = 'perlu_dicek';
            } elseif ($link_gmaps === 'BELUM_TERDAFTAR') {
                $status_lokasi = 'belum_terdaftar';
            } else {
                $status_lokasi = 'perlu_dicek'; // akan di-update oleh umkm:geocode
            }

            // Normalisasi no telepon
            $no_telepon = trim($no_telepon);
            if (empty($no_telepon) || $no_telepon === '-') $no_telepon = null;

            // Normalisasi sosmed
            $username_sosmed = trim($username_sosmed);
            if (empty($username_sosmed) || $username_sosmed === '-') $username_sosmed = null;

            // Normalisasi gmail
            $gmail_usaha = trim($gmail_usaha);
            if (empty($gmail_usaha) || $gmail_usaha === '-') $gmail_usaha = null;

            // Normalisasi nama toko gmaps
            $nama_toko_gmaps = trim($nama_toko_gmaps);
            if (empty($nama_toko_gmaps)) $nama_toko_gmaps = null;

            // Normalisasi alamat
            $alamat_rt_rw = trim($alamat_rt_rw);
            if (empty($alamat_rt_rw) || $alamat_rt_rw === '-') $alamat_rt_rw = null;

            // Auto-mapping kategori
            $kategori = Umkm::mapKategori($jenis_usaha);

            Umkm::create([
                'dusun'           => trim($dusun),
                'nama_pemilik'    => trim($nama_pemilik),
                'nama_usaha'      => trim($nama_usaha),
                'jenis_usaha'     => trim($jenis_usaha),
                'kategori'        => $kategori,
                'no_telepon'      => $no_telepon,
                'username_sosmed' => $username_sosmed,
                'alamat_rt_rw'    => $alamat_rt_rw,
                'gmail_usaha'     => $gmail_usaha,
                'link_gmaps'      => $link_gmaps,
                'nama_toko_gmaps' => $nama_toko_gmaps,
                'status_lokasi'   => $status_lokasi,
            ]);
            $count++;
        }

        fclose($handle);
        $this->command->info("✓ {$count} data UMKM berhasil di-seed.");
    }
}
