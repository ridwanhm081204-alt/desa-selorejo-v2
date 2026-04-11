<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\TautanTerkait;

class TautanTerkaitSeeder extends Seeder {
    public function run() {
        TautanTerkait::truncate();
        $data = [
            ['nama'=>'Pemerintah Kabupaten Malang','url'=>'https://malangkab.go.id'],
            ['nama'=>'Kementerian Desa PDTT','url'=>'https://kemendesa.go.id'],
            ['nama'=>'Sistem Informasi Desa','url'=>'https://sid.kemendesa.go.id'],
            ['nama'=>'Puskesmas Kec. Dau','url'=>'https://puskesmasdau.malangkab.go.id'],
            ['nama'=>'Kecamatan Dau','url'=>'https://dau.malangkab.go.id'],
            ['nama'=>'LAPOR! Kabupaten Malang','url'=>'https://lapor.go.id']
        ];
        TautanTerkait::insert($data);
    }
}
