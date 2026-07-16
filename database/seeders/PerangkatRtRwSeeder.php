<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PerangkatRtRw;

class PerangkatRtRwSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Data RT & RW Desa Selorejo sesuai pemekaran wilayah terbaru.
     * 3 Dusun: Krajan (RT01-12, RW01-04), Selokerto (RT13-19, RW05-06), Gumuk (RT20-21, RW07)
     */
    public function run(): void
    {
        // Hapus data lama sebelum seeding
        PerangkatRtRw::truncate();

        $data = [
            // ─── RT ────────────────────────────────────────────────────────
            // Dusun Krajan — RW 01
            ['jenis'=>'RT','nomor'=>1, 'nama'=>'Edi Sutrisno',        'dusun'=>'Dsn. Krajan',         'nomor_rt'=>1,  'nomor_rw'=>1, 'urutan'=>1],
            ['jenis'=>'RT','nomor'=>2, 'nama'=>'Sutrisno',             'dusun'=>'Dsn. Krajan',         'nomor_rt'=>2,  'nomor_rw'=>1, 'urutan'=>2],
            ['jenis'=>'RT','nomor'=>3, 'nama'=>'Wahyu Farit Wijaya',  'dusun'=>'Dsn. Krajan',         'nomor_rt'=>3,  'nomor_rw'=>1, 'urutan'=>3],
            // Dusun Krajan — RW 02
            ['jenis'=>'RT','nomor'=>4, 'nama'=>'Khoirul Anam',        'dusun'=>'Dsn. Krajan',         'nomor_rt'=>4,  'nomor_rw'=>2, 'urutan'=>4],
            ['jenis'=>'RT','nomor'=>5, 'nama'=>'Sunoto',               'dusun'=>'Dsn. Krajan',         'nomor_rt'=>5,  'nomor_rw'=>2, 'urutan'=>5],
            ['jenis'=>'RT','nomor'=>6, 'nama'=>'Miselan',              'dusun'=>'Dsn. Krajan',         'nomor_rt'=>6,  'nomor_rw'=>2, 'urutan'=>6],
            // Dusun Krajan — RW 03
            ['jenis'=>'RT','nomor'=>7, 'nama'=>'Muliono',              'dusun'=>'Dsn. Krajan',         'nomor_rt'=>7,  'nomor_rw'=>3, 'urutan'=>7],
            ['jenis'=>'RT','nomor'=>8, 'nama'=>'Hartono',              'dusun'=>'Dsn. Krajan',         'nomor_rt'=>8,  'nomor_rw'=>3, 'urutan'=>8],
            ['jenis'=>'RT','nomor'=>9, 'nama'=>'Sugeng Supriyo',      'dusun'=>'Dsn. Krajan',         'nomor_rt'=>9,  'nomor_rw'=>3, 'urutan'=>9],
            // Dusun Krajan — RW 04
            ['jenis'=>'RT','nomor'=>10,'nama'=>'Rianto',               'dusun'=>'Dsn. Krajan',         'nomor_rt'=>10, 'nomor_rw'=>4, 'urutan'=>10],
            ['jenis'=>'RT','nomor'=>11,'nama'=>'Ridianto',             'dusun'=>'Dsn. Krajan',         'nomor_rt'=>11, 'nomor_rw'=>4, 'urutan'=>11],
            ['jenis'=>'RT','nomor'=>12,'nama'=>'Pairi',                'dusun'=>'Dsn. Krajan',         'nomor_rt'=>12, 'nomor_rw'=>4, 'urutan'=>12],
            // Dusun Selokerto — RW 05
            ['jenis'=>'RT','nomor'=>13,'nama'=>'Gito',                 'dusun'=>'Dsn. Selokerto',      'nomor_rt'=>13, 'nomor_rw'=>5, 'urutan'=>13],
            ['jenis'=>'RT','nomor'=>14,'nama'=>'Muhammad Mauludin',   'dusun'=>'Dsn. Selokerto',      'nomor_rt'=>14, 'nomor_rw'=>5, 'urutan'=>14],
            ['jenis'=>'RT','nomor'=>15,'nama'=>'Misdi',                'dusun'=>'Dsn. Selokerto',      'nomor_rt'=>15, 'nomor_rw'=>5, 'urutan'=>15],
            ['jenis'=>'RT','nomor'=>16,'nama'=>'Edi Slamet',           'dusun'=>'Dsn. Selokerto',      'nomor_rt'=>16, 'nomor_rw'=>5, 'urutan'=>16],
            // Dusun Selokerto — RW 06
            ['jenis'=>'RT','nomor'=>17,'nama'=>'Riduwan',              'dusun'=>'Dsn. Selokerto',      'nomor_rt'=>17, 'nomor_rw'=>6, 'urutan'=>17],
            ['jenis'=>'RT','nomor'=>18,'nama'=>'Yudianto',             'dusun'=>'Dsn. Selokerto',      'nomor_rt'=>18, 'nomor_rw'=>6, 'urutan'=>18],
            ['jenis'=>'RT','nomor'=>19,'nama'=>'Nursi',                'dusun'=>'Dsn. Selokerto',      'nomor_rt'=>19, 'nomor_rw'=>6, 'urutan'=>19],
            // Dusun Gumuk — RW 06
            ['jenis'=>'RT','nomor'=>20,'nama'=>'Sujiari',              'dusun'=>'Dsn. Gumuk',          'nomor_rt'=>20, 'nomor_rw'=>6, 'urutan'=>20],
            // Dusun Gumuk — RW 07
            ['jenis'=>'RT','nomor'=>21,'nama'=>'Nurhasanudin',         'dusun'=>'Dsn. Gumuk',          'nomor_rt'=>21, 'nomor_rw'=>7, 'urutan'=>21],

            // ─── RW ───────────────────────────────────────────────────────
            ['jenis'=>'RW','nomor'=>1, 'nama'=>'Yateno',              'dusun'=>'Dsn. Krajan',            'nomor_rt'=>null, 'nomor_rw'=>1, 'urutan'=>1],
            ['jenis'=>'RW','nomor'=>2, 'nama'=>'Supandri',            'dusun'=>'Dsn. Krajan',            'nomor_rt'=>null, 'nomor_rw'=>2, 'urutan'=>2],
            ['jenis'=>'RW','nomor'=>3, 'nama'=>'Sugeng Santoso',      'dusun'=>'Dsn. Krajan',            'nomor_rt'=>null, 'nomor_rw'=>3, 'urutan'=>3],
            ['jenis'=>'RW','nomor'=>4, 'nama'=>'Sutomo',              'dusun'=>'Dsn. Krajan',            'nomor_rt'=>null, 'nomor_rw'=>4, 'urutan'=>4],
            ['jenis'=>'RW','nomor'=>5, 'nama'=>'Aji Nursantoso',      'dusun'=>'Dsn. Selokerto',         'nomor_rt'=>null, 'nomor_rw'=>5, 'urutan'=>5],
            ['jenis'=>'RW','nomor'=>6, 'nama'=>'Untung Santoso',      'dusun'=>'Dsn. Selokerto',         'nomor_rt'=>null, 'nomor_rw'=>6, 'urutan'=>6],
            ['jenis'=>'RW','nomor'=>7, 'nama'=>'Bagus Prasetyo',      'dusun'=>'Dsn. Gumuk',             'nomor_rt'=>null, 'nomor_rw'=>7, 'urutan'=>7],
        ];

        foreach ($data as $row) {
            PerangkatRtRw::create($row);
        }
    }
}
