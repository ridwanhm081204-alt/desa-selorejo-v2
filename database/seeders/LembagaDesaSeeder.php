<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\LembagaDesa;

class LembagaDesaSeeder extends Seeder {
    public function run() {
        LembagaDesa::truncate();
        $data = [
            ['nama_lembaga'=>'Karang Taruna Selorejo Muda','jenis'=>'Karang Taruna','ketua'=>'Rizky Pratama','deskripsi'=>'Karang Taruna Desa Selorejo aktif dalam kegiatan kepemudaan, sosial, dan pengembangan potensi wisata desa bagi generasi muda.'],
            ['nama_lembaga'=>'PKK Desa Selorejo','jenis'=>'PKK','ketua'=>'Ny. Hj. Sutrisno','deskripsi'=>'PKK Desa Selorejo aktif dalam pemberdayaan perempuan, posyandu, ketahanan pangan keluarga, dan kegiatan sosial kemasyarakatan.'],
            ['nama_lembaga'=>'Linmas Desa Selorejo','jenis'=>'Linmas','ketua'=>'Suharto','deskripsi'=>'Satuan Perlindungan Masyarakat (Linmas) Desa Selorejo bertugas menjaga ketentraman, ketertiban, dan keamanan lingkungan desa.']
        ];
        LembagaDesa::insert($data);
    }
}
