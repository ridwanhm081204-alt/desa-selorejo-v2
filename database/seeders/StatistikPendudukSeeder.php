<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\StatistikPenduduk;

class StatistikPendudukSeeder extends Seeder {
    public function run() {
        StatistikPenduduk::truncate();
        $tahun = 2024;
        
        // Total Populasi: 3,674 (Berdasarkan Kecamatan Dau Dalam Angka)
        $data = [
            // Gender
            ['tahun'=>$tahun,'jenis_data'=>'gender','label'=>'Laki-laki','nilai'=>1870],
            ['tahun'=>$tahun,'jenis_data'=>'gender','label'=>'Perempuan','nilai'=>1804],
            
            // Kelompok Usia
            ['tahun'=>$tahun,'jenis_data'=>'usia','label'=>'0-14 Tahun','nilai'=>735],
            ['tahun'=>$tahun,'jenis_data'=>'usia','label'=>'15-29 Tahun','nilai'=>918],
            ['tahun'=>$tahun,'jenis_data'=>'usia','label'=>'30-44 Tahun','nilai'=>882],
            ['tahun'=>$tahun,'jenis_data'=>'usia','label'=>'45-59 Tahun','nilai'=>735],
            ['tahun'=>$tahun,'jenis_data'=>'usia','label'=>'60+ Tahun','nilai'=>404],
            
            // Pendidikan Terakhir
            ['tahun'=>$tahun,'jenis_data'=>'pendidikan','label'=>'SD/Sederajat','nilai'=>808],
            ['tahun'=>$tahun,'jenis_data'=>'pendidikan','label'=>'SMP/Sederajat','nilai'=>735],
            ['tahun'=>$tahun,'jenis_data'=>'pendidikan','label'=>'SMA/Sederajat','nilai'=>1470],
            ['tahun'=>$tahun,'jenis_data'=>'pendidikan','label'=>'Diploma/Sarjana+','nilai'=>661],
            
            // Pekerjaan Utama
            ['tahun'=>$tahun,'jenis_data'=>'pekerjaan','label'=>'Petani/Berkebun','nilai'=>1470],
            ['tahun'=>$tahun,'jenis_data'=>'pekerjaan','label'=>'Pedagang/Jasa','nilai'=>735],
            ['tahun'=>$tahun,'jenis_data'=>'pekerjaan','label'=>'Karyawan Swasta','nilai'=>735],
            ['tahun'=>$tahun,'jenis_data'=>'pekerjaan','label'=>'Belum/Tidak Bekerja','nilai'=>734],
            
            // Agama
            ['tahun'=>$tahun,'jenis_data'=>'agama','label'=>'Islam','nilai'=>3612],
            ['tahun'=>$tahun,'jenis_data'=>'agama','label'=>'Kristen','nilai'=>48],
            ['tahun'=>$tahun,'jenis_data'=>'agama','label'=>'Hindu/Lainnya','nilai'=>14],
        ];
        
        StatistikPenduduk::insert($data);
    }
}
