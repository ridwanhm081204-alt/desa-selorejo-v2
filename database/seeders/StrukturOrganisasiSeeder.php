<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\StrukturOrganisasi;

class StrukturOrganisasiSeeder extends Seeder {
    public function run() {
        StrukturOrganisasi::truncate();
        $data = [
            ['jabatan'=>'Kepala Desa','nama_pejabat'=>'Bambang Soponyono','urutan'=>1,'foto'=>'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&q=80'],
            ['jabatan'=>'Sekretaris Desa','nama_pejabat'=>'Hermanto','urutan'=>2,'foto'=>null],
            ['jabatan'=>'Kaur Keuangan','nama_pejabat'=>'Siti Nurhayati','urutan'=>3,'foto'=>null],
            ['jabatan'=>'Kaur Perencanaan','nama_pejabat'=>'Bagus Setiawan','urutan'=>4,'foto'=>null],
            ['jabatan'=>'Kasi Pemerintahan','nama_pejabat'=>'Budi Utomo','urutan'=>5,'foto'=>null],
            ['jabatan'=>'Kasi Kesejahteraan','nama_pejabat'=>'Sri Wahyuni','urutan'=>6,'foto'=>null],
            ['jabatan'=>'Kasi Pelayanan','nama_pejabat'=>'M. Ihsan','urutan'=>7,'foto'=>null],
            ['jabatan'=>'Kepala Dusun Krajan','nama_pejabat'=>'Slamet Riyadi','urutan'=>8,'foto'=>null],
            ['jabatan'=>'Kepala Dusun Kebonagung','nama_pejabat'=>'Sholehudin','urutan'=>9,'foto'=>null]
        ];
        StrukturOrganisasi::insert($data);
    }
}
