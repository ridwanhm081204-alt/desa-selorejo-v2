<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\StrukturOrganisasi;

class StrukturOrganisasiSeeder extends Seeder {
    public function run() {
        StrukturOrganisasi::truncate();
        $data = [
            ['jabatan'=>'Kepala Desa','nama_pejabat'=>'Bambang Soponyono','urutan'=>1,'foto'=>null],
            ['jabatan'=>'Sekretaris Desa','nama_pejabat'=>'-','urutan'=>2,'foto'=>null],
            ['jabatan'=>'Kaur Umum','nama_pejabat'=>'Retno Kustiah','urutan'=>3,'foto'=>null],
            ['jabatan'=>'Kaur Keuangan','nama_pejabat'=>'Yusak Dadang S','urutan'=>4,'foto'=>null],
            ['jabatan'=>'Kaur Perencanaan','nama_pejabat'=>'-','urutan'=>5,'foto'=>null],
            ['jabatan'=>'Kasi Pemerintahan','nama_pejabat'=>'Wiyono','urutan'=>6,'foto'=>null],
            ['jabatan'=>'Kasi Kesejahteraan','nama_pejabat'=>'Saleh','urutan'=>7,'foto'=>null],
            ['jabatan'=>'Kasi Kamtib','nama_pejabat'=>'Suiswanto','urutan'=>8,'foto'=>null],
            ['jabatan'=>'Kasi Pemberdayaan','nama_pejabat'=>'Solikin Wibowo','urutan'=>9,'foto'=>null],
            ['jabatan'=>'Kamituwo Dusun Selorejo (Krajan)','nama_pejabat'=>'Yasnadi','urutan'=>10,'foto'=>null],
            ['jabatan'=>'Kamituwo Dusun Selokerto','nama_pejabat'=>'Prayitno','urutan'=>11,'foto'=>null],
            ['jabatan'=>'Kamituwo Dusun Gumuk','nama_pejabat'=>'-','urutan'=>12,'foto'=>null],
        ];
        StrukturOrganisasi::insert($data);
    }
}
