<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Apbdes;

class ApbdesSeeder extends Seeder {
    public function run() {
        Apbdes::truncate();
        $tahun = 2024;
        $pendapatan = [
            ['tahun'=>$tahun,'jenis'=>'pendapatan','bidang'=>'Dana Desa (APBN)','nominal'=>987650000],
            ['tahun'=>$tahun,'jenis'=>'pendapatan','bidang'=>'Alokasi Dana Desa (ADD)','nominal'=>412300000],
            ['tahun'=>$tahun,'jenis'=>'pendapatan','bidang'=>'Bagi Hasil Pajak Daerah','nominal'=>38500000],
            ['tahun'=>$tahun,'jenis'=>'pendapatan','bidang'=>'Pendapatan Asli Desa (PADes)','nominal'=>125000000],
            ['tahun'=>$tahun,'jenis'=>'pendapatan','bidang'=>'Bantuan Keuangan Provinsi','nominal'=>150000000]
        ];
        $belanja = [
            ['tahun'=>$tahun,'jenis'=>'belanja','bidang'=>'Bidang Pemerintahan Desa','nominal'=>312450000],
            ['tahun'=>$tahun,'jenis'=>'belanja','bidang'=>'Bidang Pembangunan','nominal'=>728900000],
            ['tahun'=>$tahun,'jenis'=>'belanja','bidang'=>'Bidang Pembinaan Kemasyarakatan','nominal'=>187600000],
            ['tahun'=>$tahun,'jenis'=>'belanja','bidang'=>'Bidang Pemberdayaan Masyarakat','nominal'=>245000000],
            ['tahun'=>$tahun,'jenis'=>'belanja','bidang'=>'Bidang Penanggulangan Bencana','nominal'=>67500000],
            ['tahun'=>$tahun,'jenis'=>'belanja','bidang'=>'Bidang Pengembangan Wisata Desa','nominal'=>170000000]
        ];
        Apbdes::insert(array_merge($pendapatan, $belanja));
    }
}
