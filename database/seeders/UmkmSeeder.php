<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Umkm;

class UmkmSeeder extends Seeder
{
    public function run(): void
    {
        Umkm::truncate();

        $jsonFiles = [
            base_path('umkm_gumuk_selorejo_2026.json'),
            base_path('umkm_krajan_selorejo_2026.json'),
            base_path('umkm_selokerto_selorejo_2026.json'),
        ];

        $allJsonExist = true;
        foreach ($jsonFiles as $jf) {
            if (!file_exists($jf)) {
                $allJsonExist = false;
                break;
            }
        }

        $itemsToSeed = [];

        if ($allJsonExist) {
            foreach ($jsonFiles as $jf) {
                $content = file_get_contents($jf);
                $data = json_decode($content, true);
                $dusunRoot = ucfirst(trim($data['dusun'] ?? ''));

                foreach (($data['data_umkm'] ?? []) as $item) {
                    $namaPemilik = trim($item['nama_pemilik_usaha'] ?? '');
                    $namaUsaha   = trim($item['nama_usaha'] ?? '');
                    $jenisUsaha  = trim($item['jenis_usaha'] ?? '');
                    $noTelp      = trim($item['nomor_telepon_usaha'] ?? '');
                    $sosmed      = trim($item['username_marketplace'] ?? '');
                    $alamat      = trim($item['alamat_usaha_rt_rw'] ?? '');
                    $gmail       = trim($item['gmail_usaha'] ?? '');
                    $linkGmaps   = trim($item['link_gmaps_usaha'] ?? '');
                    $namaGmaps   = trim($item['nama_toko_di_gmaps'] ?? '');
                    $foto        = trim($item['foto'] ?? '');

                    if (empty($namaUsaha) && empty($namaPemilik)) continue;
                    if (empty($namaUsaha)) $namaUsaha = "Usaha {$namaPemilik}";

                    // Clean Gmaps link
                    if (empty($linkGmaps) || in_array($linkGmaps, ['-', 'baru didaftar']) || str_contains(strtolower($linkGmaps), 'ditolak') || str_contains(strtolower($linkGmaps), 'tidak')) {
                        $linkGmaps = 'BELUM_TERDAFTAR';
                    } else {
                        $linkGmaps = trim(explode("\n", $linkGmaps)[0]);
                    }

                    $itemsToSeed[] = [
                        'dusun'           => $dusunRoot,
                        'nama_pemilik'    => $namaPemilik,
                        'nama_usaha'      => $namaUsaha,
                        'jenis_usaha'     => $jenisUsaha,
                        'no_telepon'      => $noTelp,
                        'username_sosmed' => $sosmed,
                        'alamat_rt_rw'    => $alamat,
                        'gmail_usaha'     => $gmail,
                        'link_gmaps'      => $linkGmaps,
                        'nama_toko_gmaps' => $namaGmaps,
                        'foto'            => $foto,
                    ];
                }
            }
        } else {
            $csvPath = database_path('seeders/umkm-seed-data.csv');
            if (file_exists($csvPath)) {
                $handle = fopen($csvPath, 'r');
                fgetcsv($handle); // skip header
                while (($row = fgetcsv($handle)) !== false) {
                    if (count($row) < 10) continue;
                    $itemsToSeed[] = [
                        'dusun'           => trim($row[0]),
                        'nama_pemilik'    => trim($row[1]),
                        'nama_usaha'      => trim($row[2]),
                        'jenis_usaha'     => trim($row[3]),
                        'no_telepon'      => trim($row[4]),
                        'username_sosmed' => trim($row[5]),
                        'alamat_rt_rw'    => trim($row[6]),
                        'gmail_usaha'     => trim($row[7]),
                        'link_gmaps'      => trim($row[8]),
                        'nama_toko_gmaps' => trim($row[9]),
                        'foto'            => trim($row[10] ?? ''),
                    ];
                }
                fclose($handle);
            }
        }

        $count = 0;
        foreach ($itemsToSeed as $row) {
            // Normalisasi gmaps
            $linkGmaps = trim($row['link_gmaps']);
            if (empty($linkGmaps) || $linkGmaps === '-') {
                $linkGmaps = null;
                $statusLokasi = 'perlu_dicek';
            } elseif ($linkGmaps === 'BELUM_TERDAFTAR') {
                $statusLokasi = 'belum_terdaftar';
            } else {
                $statusLokasi = 'perlu_dicek';
            }

            // Normalisasi no telepon
            $noTelp = trim($row['no_telepon']);
            if (empty($noTelp) || $noTelp === '-') $noTelp = null;

            // Normalisasi sosmed
            $sosmed = trim($row['username_sosmed']);
            if (empty($sosmed) || $sosmed === '-') $sosmed = null;

            // Normalisasi gmail
            $gmail = trim($row['gmail_usaha']);
            if (empty($gmail) || $gmail === '-') $gmail = null;

            // Normalisasi nama toko gmaps
            $namaGmaps = trim($row['nama_toko_gmaps']);
            if (empty($namaGmaps) || $namaGmaps === '-') $namaGmaps = null;

            // Normalisasi alamat
            $alamat = trim($row['alamat_rt_rw']);
            if (empty($alamat) || $alamat === '-') $alamat = null;

            // Normalisasi foto
            $foto = trim($row['foto'] ?? '');
            if (empty($foto) || $foto === '-') $foto = null;

            // Auto-mapping kategori
            $kategori = Umkm::mapKategori($row['jenis_usaha']);

            Umkm::create([
                'dusun'           => trim($row['dusun']),
                'nama_pemilik'    => trim($row['nama_pemilik']),
                'nama_usaha'      => trim($row['nama_usaha']),
                'jenis_usaha'     => trim($row['jenis_usaha']),
                'kategori'        => $kategori,
                'no_telepon'      => $noTelp,
                'username_sosmed' => $sosmed,
                'alamat_rt_rw'    => $alamat,
                'gmail_usaha'     => $gmail,
                'link_gmaps'      => $linkGmaps,
                'nama_toko_gmaps' => $namaGmaps,
                'foto'            => $foto,
                'status_lokasi'   => $statusLokasi,
            ]);
            $count++;
        }

        $this->command->info("✓ {$count} data UMKM berhasil di-seed.");
    }
}
