<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\StrukturOrganisasi;

class StrukturOrganisasiSeeder extends Seeder {
    public function run() {
        StrukturOrganisasi::truncate();
        $data = [
            ['jabatan'=>'Kepala Desa','nama_pejabat'=>'Bambang Soponyono','urutan'=>1,'foto'=>null],
            ['jabatan'=>'Sekretaris Desa','nama_pejabat'=>'Retno Kustiah','urutan'=>2,'foto'=>null],
            ['jabatan'=>'Kasi Pemerintahan','nama_pejabat'=>'Adi Dwi Santoso','urutan'=>3,'foto'=>null],
            ['jabatan'=>'Kasi Kesejahteraan','nama_pejabat'=>'Y. Luhung Pranoto','urutan'=>4,'foto'=>null],
            ['jabatan'=>'Kasi Pelayanan','nama_pejabat'=>'Moch. Imron Rosyadi','urutan'=>5,'foto'=>null],
            ['jabatan'=>'Kaur Umum','nama_pejabat'=>'Ernawati','urutan'=>6,'foto'=>null],
            ['jabatan'=>'Kaur Keuangan','nama_pejabat'=>'Sri Utami','urutan'=>7,'foto'=>null],
            ['jabatan'=>'Kaur Perencanaan','nama_pejabat'=>'Nurkholis Yahya','urutan'=>8,'foto'=>null],
            ['jabatan'=>'Kadus Krajan','nama_pejabat'=>'Suwiji','urutan'=>9,'foto'=>null],
            ['jabatan'=>'Kadus Selokerto','nama_pejabat'=>'Soni Mononutu','urutan'=>10,'foto'=>null],
            ['jabatan'=>'Kadus Gumuk','nama_pejabat'=>'Misdiantok','urutan'=>11,'foto'=>null],
            ['jabatan'=>'Operator','nama_pejabat'=>'Anita Lestari','urutan'=>12,'foto'=>null],
            ['jabatan'=>'Staff Administrasi','nama_pejabat'=>'Puput Handika S.','urutan'=>13,'foto'=>null],
        ];
        StrukturOrganisasi::insert($data);
    }
}
