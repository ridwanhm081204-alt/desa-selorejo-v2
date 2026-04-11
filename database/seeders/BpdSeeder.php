<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Bpd;

class BpdSeeder extends Seeder {
    public function run() {
        Bpd::truncate();
        $data = [
            ['nama'=>'Moch. Zainul Arifin','jabatan'=>'Ketua BPD'],
            ['nama'=>'Slamet Riyadi','jabatan'=>'Wakil Ketua BPD'],
            ['nama'=>'Nurul Hidayah','jabatan'=>'Sekretaris BPD'],
            ['nama'=>'Agus Supriyanto','jabatan'=>'Anggota BPD'],
            ['nama'=>'Eni Kusumawati','jabatan'=>'Anggota BPD'],
            ['nama'=>'Fandi Ahmad','jabatan'=>'Anggota BPD'],
            ['nama'=>'Ratna Dewi','jabatan'=>'Anggota BPD']
        ];
        Bpd::insert($data);
    }
}
