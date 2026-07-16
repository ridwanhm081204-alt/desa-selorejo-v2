<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Apbdes;

class ApbdesSeeder extends Seeder {
    public function run() {
        Apbdes::truncate();
        
        $data = [
            // ─── TAHUN 2025 (PERUBAHAN APBDES) ──────────────────────────────
            // PENDAPATAN
            [
                'tahun' => 2025,
                'jenis' => 'pendapatan',
                'bidang' => 'Pendapatan Desa',
                'kategori_bidang' => null,
                'nominal_semula' => 1833253698,
                'nominal_perubahan' => 213805589,
                'nominal' => 2047059287,
            ],
            // BELANJA
            [
                'tahun' => 2025,
                'jenis' => 'belanja',
                'bidang' => 'Belanja Desa',
                'kategori_bidang' => null,
                'nominal_semula' => 2210830321,
                'nominal_perubahan' => 20805589,
                'nominal' => 2231635910,
            ],
            // PEMBIAYAAN (PENERIMAAN)
            [
                'tahun' => 2025,
                'jenis' => 'pembiayaan_penerimaan',
                'bidang' => 'Penerimaan Pembiayaan',
                'kategori_bidang' => null,
                'nominal_semula' => 377576623,
                'nominal_perubahan' => -193000000,
                'nominal' => 184576623,
            ],
            // PEMBIAYAAN (PENGELUARAN)
            [
                'tahun' => 2025,
                'jenis' => 'pembiayaan_pengeluaran',
                'bidang' => 'Pengeluaran Pembiayaan',
                'kategori_bidang' => null,
                'nominal_semula' => 0,
                'nominal_perubahan' => 193000000,
                'nominal' => 193000000,
            ],

            // ─── TAHUN 2026 (APBDes Murni) ──────────────────────────────────
            // PENDAPATAN
            [
                'tahun' => 2026,
                'jenis' => 'pendapatan',
                'bidang' => 'Pendapatan Asli Desa',
                'kategori_bidang' => null,
                'nominal_semula' => 270000000,
                'nominal_perubahan' => 0,
                'nominal' => 270000000,
            ],
            [
                'tahun' => 2026,
                'jenis' => 'pendapatan',
                'bidang' => 'Dana Desa',
                'kategori_bidang' => null,
                'nominal_semula' => 346392000,
                'nominal_perubahan' => 0,
                'nominal' => 346392000,
            ],
            [
                'tahun' => 2026,
                'jenis' => 'pendapatan',
                'bidang' => 'Alokasi Dana Desa',
                'kategori_bidang' => null,
                'nominal_semula' => 572065000,
                'nominal_perubahan' => 0,
                'nominal' => 572065000,
            ],
            [
                'tahun' => 2026,
                'jenis' => 'pendapatan',
                'bidang' => 'Bagi Hasil Pajak dan Retribusi',
                'kategori_bidang' => null,
                'nominal_semula' => 93681025,
                'nominal_perubahan' => 0,
                'nominal' => 93681025,
            ],
            [
                'tahun' => 2026,
                'jenis' => 'pendapatan',
                'bidang' => 'Pendapatan Lain-lain (Bunga Bank)',
                'kategori_bidang' => null,
                'nominal_semula' => 12000000,
                'nominal_perubahan' => 0,
                'nominal' => 12000000,
            ],

            // BELANJA (Bidang Pemerintah Desa)
            [
                'tahun' => 2026,
                'jenis' => 'belanja',
                'bidang' => '1. Kegiatan Penyelenggaraan Belanja Siltap, Tunjangan dan Operasional Pemerintahan',
                'kategori_bidang' => 'Bidang Pemerintah Desa',
                'nominal_semula' => 739446686,
                'nominal_perubahan' => 0,
                'nominal' => 739446686,
            ],
            [
                'tahun' => 2026,
                'jenis' => 'belanja',
                'bidang' => '2. Penyediaan Sarana Prasarana Pemerintahan Desa',
                'kategori_bidang' => 'Bidang Pemerintah Desa',
                'nominal_semula' => 101071934,
                'nominal_perubahan' => 0,
                'nominal' => 101071934,
            ],
            [
                'tahun' => 2026,
                'jenis' => 'belanja',
                'bidang' => '3. Pengelolaan Administrasi Kependudukan, Pencatatan Sipil, Statistik dan Kearsipan',
                'kategori_bidang' => 'Bidang Pemerintah Desa',
                'nominal_semula' => 2400000,
                'nominal_perubahan' => 0,
                'nominal' => 2400000,
            ],
            [
                'tahun' => 2026,
                'jenis' => 'belanja',
                'bidang' => '4. Penyelenggaraan Tata Praja Pemerintahan, Perencanaan, Keuangan dan Pelaporan',
                'kategori_bidang' => 'Bidang Pemerintah Desa',
                'nominal_semula' => 23819500,
                'nominal_perubahan' => 0,
                'nominal' => 23819500,
            ],
            [
                'tahun' => 2026,
                'jenis' => 'belanja',
                'bidang' => '5. Sub Bidang Pertanahan',
                'kategori_bidang' => 'Bidang Pemerintah Desa',
                'nominal_semula' => 81836000,
                'nominal_perubahan' => 0,
                'nominal' => 81836000,
            ],

            // BELANJA (Bidang Pembangunan Desa)
            [
                'tahun' => 2026,
                'jenis' => 'belanja',
                'bidang' => '1. Sub Bidang Pendidikan',
                'kategori_bidang' => 'Bidang Pembangunan Desa',
                'nominal_semula' => 233113100,
                'nominal_perubahan' => 0,
                'nominal' => 233113100,
            ],
            [
                'tahun' => 2026,
                'jenis' => 'belanja',
                'bidang' => '2. Sub Bidang Kesehatan',
                'kategori_bidang' => 'Bidang Pembangunan Desa',
                'nominal_semula' => 89035116,
                'nominal_perubahan' => 0,
                'nominal' => 89035116,
            ],

            // BELANJA (Bidang Pembinaan Kemasyarakatan)
            [
                'tahun' => 2026,
                'jenis' => 'belanja',
                'bidang' => '1. Sub Bidang Ketentraman, Ketertiban Umum dan Perlindungan Masyarakat',
                'kategori_bidang' => 'Bidang Pembinaan Kemasyarakatan',
                'nominal_semula' => 9925000,
                'nominal_perubahan' => 0,
                'nominal' => 9925000,
            ],
            [
                'tahun' => 2026,
                'jenis' => 'belanja',
                'bidang' => '2. Sub Bidang Kebudayaan dan Keagamaan',
                'kategori_bidang' => 'Bidang Pembinaan Kemasyarakatan',
                'nominal_semula' => 46100000,
                'nominal_perubahan' => 0,
                'nominal' => 46100000,
            ],
            [
                'tahun' => 2026,
                'jenis' => 'belanja',
                'bidang' => '3. Sub Bidang Kelembagaan Masyarakat',
                'kategori_bidang' => 'Bidang Pembinaan Kemasyarakatan',
                'nominal_semula' => 33025000,
                'nominal_perubahan' => 0,
                'nominal' => 33025000,
            ],

            // BELANJA (Bidang Pemberdayaan Masyarakat)
            [
                'tahun' => 2026,
                'jenis' => 'belanja',
                'bidang' => '1. Sub Bidang Pertanian dan Peternakan',
                'kategori_bidang' => 'Bidang Pemberdayaan Masyarakat',
                'nominal_semula' => 4950000,
                'nominal_perubahan' => 0,
                'nominal' => 4950000,
            ],
            [
                'tahun' => 2026,
                'jenis' => 'belanja',
                'bidang' => '2. Sub Bidang Peningkatan Kapasitas Aparatur Desa',
                'kategori_bidang' => 'Bidang Pemberdayaan Masyarakat',
                'nominal_semula' => 7025000,
                'nominal_perubahan' => 0,
                'nominal' => 7025000,
            ],
            [
                'tahun' => 2026,
                'jenis' => 'belanja',
                'bidang' => '3. Sub Bidang Koperasi, Usaha Micro Kecil dan Menengah (UMKM)',
                'kategori_bidang' => 'Bidang Pemberdayaan Masyarakat',
                'nominal_semula' => 36790000,
                'nominal_perubahan' => 0,
                'nominal' => 36790000,
            ],

            // BELANJA (Bidang Penanggulangan Bencana)
            [
                'tahun' => 2026,
                'jenis' => 'belanja',
                'bidang' => '1. Sub Bidang Penanggulangan Bencana',
                'kategori_bidang' => 'Bidang Penanggulangan Bencana, Keadaan Darurat & Mendesak',
                'nominal_semula' => 4000000,
                'nominal_perubahan' => 0,
                'nominal' => 4000000,
            ],
            [
                'tahun' => 2026,
                'jenis' => 'belanja',
                'bidang' => '2. Sub Bidang Keadaan Darurat',
                'kategori_bidang' => 'Bidang Penanggulangan Bencana, Keadaan Darurat & Mendesak',
                'nominal_semula' => 4000000,
                'nominal_perubahan' => 0,
                'nominal' => 4000000,
            ],
            [
                'tahun' => 2026,
                'jenis' => 'belanja',
                'bidang' => '3. Sub Bidang Keadaan Mendesak - BLT Dana Desa',
                'kategori_bidang' => 'Bidang Penanggulangan Bencana, Keadaan Darurat & Mendesak',
                'nominal_semula' => 36000000,
                'nominal_perubahan' => 0,
                'nominal' => 36000000,
            ],

            // PEMBIAYAAN (PENERIMAAN)
            [
                'tahun' => 2026,
                'jenis' => 'pembiayaan_penerimaan',
                'bidang' => 'Penerimaan Pembiayaan : Silpa Tahun Sebelumnya',
                'kategori_bidang' => null,
                'nominal_semula' => 227677711,
                'nominal_perubahan' => 0,
                'nominal' => 227677711,
            ],
            // PEMBIAYAAN (PENGELUARAN)
            [
                'tahun' => 2026,
                'jenis' => 'pembiayaan_pengeluaran',
                'bidang' => 'Pengeluaran Pembiayaan : Penyertaan Modal Desa',
                'kategori_bidang' => null,
                'nominal_semula' => 69278400,
                'nominal_perubahan' => 0,
                'nominal' => 69278400,
            ],
        ];
        
        Apbdes::insert($data);
    }
}
