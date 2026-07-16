<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Bpd;

class BpdSeeder extends Seeder {
    public function run() {
        Bpd::truncate();
        $data = [
            ['nama'=>'Anik Poniti','jabatan'=>'Ketua BPD','dusun'=>'Dsn. Krajan','nomor_rt'=>9,'nomor_rw'=>3],
            ['nama'=>'Ngateno','jabatan'=>'Wakil Ketua BPD','dusun'=>'Dsn. Selokerto','nomor_rt'=>14,'nomor_rw'=>5],
            ['nama'=>'Budiono','jabatan'=>'Sekretaris BPD','dusun'=>'Dsn. Krajan','nomor_rt'=>6,'nomor_rw'=>2],
            ['nama'=>'Agus Prayitno','jabatan'=>'Anggota BPD','dusun'=>'Dsn. Selokerto','nomor_rt'=>19,'nomor_rw'=>6],
            ['nama'=>'Zainul Arif','jabatan'=>'Anggota BPD','dusun'=>'Dsn. Krajan','nomor_rt'=>2,'nomor_rw'=>1],
        ];
        foreach ($data as $row) {
            Bpd::create($row);
        }
    }
}
