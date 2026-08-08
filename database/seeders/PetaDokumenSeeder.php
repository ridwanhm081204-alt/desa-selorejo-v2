<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PetaDokumen;

class PetaDokumenSeeder extends Seeder
{
    public function run(): void
    {
        PetaDokumen::truncate();

        $data = [
            [
                'judul'            => 'Peta Batas Desa Resmi',
                'slug'             => 'batas-desa',
                'file_path'        => null, // file peta batas desa tertanam di kode (data statis)
                'skala'            => '1:14.000',
                'sistem_koordinat' => 'SRGI 2013',
                'proyeksi'         => 'Transverse Mercator',
                'datum'            => 'SRGI 2013',
                'sumber_data'      => 'Pemerintah Kabupaten Malang, Tahun 2021',
                'dibuat_oleh'      => 'Pemerintah Kabupaten Malang',
                'urutan_tampil'    => 1,
            ],
            [
                'judul'            => 'Peta Destinasi Wisata Desa',
                'slug'             => 'destinasi-wisata',
                'file_path'        => 'images/Peta Destinasi Wisata Desa.png',
                'skala'            => '1:3.500',
                'sistem_koordinat' => 'WGS 1984 UTM Zone 49S',
                'proyeksi'         => 'Transverse Mercator',
                'datum'            => 'WGS 1984',
                'sumber_data'      => "1. Observasi Lapangan Tahun 2026\n2. Pemerintah Desa Selorejo",
                'dibuat_oleh'      => 'KKN 178 UNS Desa Selorejo',
                'urutan_tampil'    => 2,
            ],
            [
                'judul'            => 'Peta Destinasi Kawasan Wisata Dan Persebaran UMKM Desa',
                'slug'             => 'kawasan-wisata-umkm',
                'file_path'        => 'images/Peta Destinasi Kawasan Wisata Dan Persebaran UMKM Desa.png',
                'skala'            => '1:3.500',
                'sistem_koordinat' => 'WGS 1984 UTM Zone 49S',
                'proyeksi'         => 'Transverse Mercator',
                'datum'            => 'WGS 1984',
                'sumber_data'      => "1. Pemerintah Desa Selorejo\n2. Observasi Lapangan Tahun 2026\n3. Survey Pendataan dan Pemetaan UMKM\n4. Google Maps\n5. Lapak ARCGIS",
                'dibuat_oleh'      => 'KKN Tematik Tim 178 UNS, Tahun 2026',
                'urutan_tampil'    => 3,
            ],
        ];

        foreach ($data as $item) {
            PetaDokumen::create($item);
        }

        $this->command->info('✓ ' . count($data) . ' data peta dokumen berhasil di-seed.');
    }
}
