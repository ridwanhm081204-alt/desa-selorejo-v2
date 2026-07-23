<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LayananKonten;

class LayananKontenSeeder extends Seeder
{
    public function run(): void
    {
        $layanan = [
            [
                'kode'       => 'akta_kelahiran',
                'nama'       => 'Akta Kelahiran',
                'deskripsi'  => 'Pengajuan penerbitan Akta Kelahiran baru bagi anak yang lahir di dalam maupun di luar faskes.',
                'warna_hex'  => '#2AABE2',
                'icon_name'  => 'baby',
                'route_name' => 'layanan.akta-kelahiran',
                'aktif'      => true,
                'urutan'     => 1,
            ],
            [
                'kode'       => 'akta_kematian',
                'nama'       => 'Akta Kematian',
                'deskripsi'  => 'Layanan pelaporan kematian warga untuk penerbitan surat akta kematian resmi dari Disdukcapil.',
                'warna_hex'  => '#D93025',
                'icon_name'  => 'heart-off',
                'route_name' => 'layanan.akta-kematian',
                'aktif'      => true,
                'urutan'     => 2,
            ],
            [
                'kode'       => 'kk',
                'nama'       => 'Kartu Keluarga',
                'deskripsi'  => 'Pengajuan KK baru (pernikahan), penambahan anggota (kelahiran), perubahan elemen data, atau pisah KK.',
                'warna_hex'  => '#1A5C38',
                'icon_name'  => 'users',
                'route_name' => 'layanan.kk',
                'aktif'      => true,
                'urutan'     => 3,
            ],
            [
                'kode'       => 'ktp',
                'nama'       => 'KTP-el',
                'deskripsi'  => 'Layanan pengajuan KTP-el baru usia 17 tahun, penggantian KTP rusak/hilang, dan penjadwalan biometrik.',
                'warna_hex'  => '#F5C518',
                'icon_name'  => 'contact',
                'route_name' => 'layanan.ktp',
                'aktif'      => true,
                'urutan'     => 4,
            ],
        ];

        foreach ($layanan as $data) {
            LayananKonten::updateOrCreate(['kode' => $data['kode']], $data);
        }

        $this->command->info('LayananKontenSeeder selesai: ' . LayananKonten::count() . ' layanan tersimpan.');
    }
}
