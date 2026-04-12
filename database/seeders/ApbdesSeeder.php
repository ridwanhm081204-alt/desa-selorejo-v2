<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Apbdes;

class ApbdesSeeder extends Seeder {
    public function run() {
        Apbdes::truncate();
        $tahun = 2024;
        
        // Data Pendapatan (Revenue) - Total: Rp 1,842,000,000
        $pendapatan = [
            ['tahun'=>$tahun,'jenis'=>'pendapatan','bidang'=>'Dana Desa (DD)','nominal'=>1020000000],
            ['tahun'=>$tahun,'jenis'=>'pendapatan','bidang'=>'Alokasi Dana Desa (ADD)','nominal'=>510000000],
            ['tahun'=>$tahun,'jenis'=>'pendapatan','bidang'=>'Pendapatan Asli Desa (PADes)','nominal'=>160000000],
            ['tahun'=>$tahun,'jenis'=>'pendapatan','bidang'=>'Bagi Hasil Pajak (BHP)','nominal'=>520000000],
            ['tahun'=>$tahun,'jenis'=>'pendapatan','bidang'=>'Bantuan Keuangan Provinsi','nominal'=>100000000]
        ];
        
        // Data Belanja (Expenditure) - Total: Rp 1,842,000,000
        $belanja = [
            ['tahun'=>$tahun,'jenis'=>'belanja','bidang'=>'Penyelenggaraan Pemerintahan','nominal'=>550000000],
            ['tahun'=>$tahun,'jenis'=>'belanja','bidang'=>'Pelaksanaan Pembangunan Desa','nominal'=>740000000],
            ['tahun'=>$tahun,'jenis'=>'belanja','bidang'=>'Pembinaan Kemasyarakatan','nominal'=>185000000],
            ['tahun'=>$tahun,'jenis'=>'belanja','bidang'=>'Pemberdayaan Masyarakat','nominal'=>270000000],
            ['tahun'=>$tahun,'jenis'=>'belanja','bidang'=>'Penanggulangan Bencana & Darurat','nominal'=>97000000],
        ];
        
        Apbdes::insert(array_merge($pendapatan, $belanja));
    }
}
