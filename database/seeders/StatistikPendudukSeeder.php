<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\StatistikPenduduk;

class StatistikPendudukSeeder extends Seeder {
    public function run() {
        StatistikPenduduk::truncate();
        $tahun = 2024;
        $data = [
            ['tahun'=>$tahun,'jenis_data'=>'gender','label'=>'Laki-laki','nilai'=>1847],
            ['tahun'=>$tahun,'jenis_data'=>'gender','label'=>'Perempuan','nilai'=>1793],
            ['tahun'=>$tahun,'jenis_data'=>'usia','label'=>'0-14 tahun','nilai'=>612],
            ['tahun'=>$tahun,'jenis_data'=>'usia','label'=>'15-29 tahun','nilai'=>748],
            ['tahun'=>$tahun,'jenis_data'=>'usia','label'=>'30-44 tahun','nilai'=>689],
            ['tahun'=>$tahun,'jenis_data'=>'usia','label'=>'45-59 tahun','nilai'=>421],
            ['tahun'=>$tahun,'jenis_data'=>'usia','label'=>'60+ tahun','nilai'=>170],
            ['tahun'=>$tahun,'jenis_data'=>'pendidikan','label'=>'Tidak/Belum Sekolah','nilai'=>198],
            ['tahun'=>$tahun,'jenis_data'=>'pendidikan','label'=>'SD/Sederajat','nilai'=>823],
            ['tahun'=>$tahun,'jenis_data'=>'pendidikan','label'=>'SMP/Sederajat','nilai'=>612],
            ['tahun'=>$tahun,'jenis_data'=>'pendidikan','label'=>'SMA/Sederajat','nilai'=>734],
            ['tahun'=>$tahun,'jenis_data'=>'pendidikan','label'=>'D3/S1/S2/S3','nilai'=>273],
            ['tahun'=>$tahun,'jenis_data'=>'pekerjaan','label'=>'Petani/Berkebun','nilai'=>892],
            ['tahun'=>$tahun,'jenis_data'=>'pekerjaan','label'=>'Buruh Tani','nilai'=>312],
            ['tahun'=>$tahun,'jenis_data'=>'pekerjaan','label'=>'Pedagang/Wirausaha','nilai'=>287],
            ['tahun'=>$tahun,'jenis_data'=>'pekerjaan','label'=>'PNS/TNI/Polri','nilai'=>64],
            ['tahun'=>$tahun,'jenis_data'=>'pekerjaan','label'=>'Pelajar/Mahasiswa','nilai'=>523],
            ['tahun'=>$tahun,'jenis_data'=>'pekerjaan','label'=>'Lainnya','nilai'=>562],
            ['tahun'=>$tahun,'jenis_data'=>'agama','label'=>'Islam','nilai'=>3584],
            ['tahun'=>$tahun,'jenis_data'=>'agama','label'=>'Kristen','nilai'=>42],
            ['tahun'=>$tahun,'jenis_data'=>'agama','label'=>'Lainnya','nilai'=>14],
        ];
        StatistikPenduduk::insert($data);
    }
}
