<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LayananSyaratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $layanan = \App\Models\LayananKonten::all()->keyBy('kode');
        
        $syarats = [];

        // 1. Akta Kelahiran
        if (isset($layanan['akta_kelahiran'])) {
            $id = $layanan['akta_kelahiran']->id;
            $syarats = array_merge($syarats, [
                ['layanan_konten_id' => $id, 'kode_syarat' => 'file_pengantar_rt_rw', 'nama_syarat' => 'SURAT PENGANTAR RT/RW', 'keterangan' => 'Surat pengantar dari RT/RW setempat. Format: PDF, JPG, PNG (Max 2MB)', 'is_required' => true, 'urutan' => 1],
                ['layanan_konten_id' => $id, 'kode_syarat' => 'file_surat_lahir', 'nama_syarat' => 'SURAT KETERANGAN LAHIR', 'keterangan' => 'Dari RS/Puskesmas/Bidan/Desa. Format: PDF, JPG, PNG (Max 2MB)', 'is_required' => true, 'urutan' => 2],
                ['layanan_konten_id' => $id, 'kode_syarat' => 'file_kk_ortu', 'nama_syarat' => 'SCAN KK ORANG TUA', 'keterangan' => 'Kartu Keluarga asli orang tua. Format: PDF, JPG, PNG (Max 2MB)', 'is_required' => true, 'urutan' => 3],
                ['layanan_konten_id' => $id, 'kode_syarat' => 'file_ktp_ortu', 'nama_syarat' => 'SCAN KTP ORANG TUA (JADI SATU FILE)', 'keterangan' => 'Scan KTP asli Ayah & Ibu dijadikan satu. Format: PDF, JPG, PNG (Max 2MB)', 'is_required' => true, 'urutan' => 4],
                ['layanan_konten_id' => $id, 'kode_syarat' => 'file_akta_nikah', 'nama_syarat' => 'SCAN AKTA NIKAH ORANG TUA / SPTJM', 'keterangan' => 'Akta nikah resmi / surat pernyataan tanggung jawab mutlak. Format: PDF, JPG, PNG (Max 2MB)', 'is_required' => true, 'urutan' => 5],
                ['layanan_konten_id' => $id, 'kode_syarat' => 'file_ktp_saksi', 'nama_syarat' => 'SCAN KTP 2 SAKSI (JADI SATU FILE)', 'keterangan' => 'Scan KTP asli saksi 1 & saksi 2 dijadikan satu. Format: PDF, JPG, PNG (Max 2MB)', 'is_required' => true, 'urutan' => 6],
            ]);
        }

        // 2. Akta Kematian
        if (isset($layanan['akta_kematian'])) {
            $id = $layanan['akta_kematian']->id;
            $syarats = array_merge($syarats, [
                ['layanan_konten_id' => $id, 'kode_syarat' => 'file_pengantar_rt_rw', 'nama_syarat' => 'SURAT PENGANTAR RT/RW', 'keterangan' => 'Surat pengantar dari RT/RW setempat. Format: PDF, JPG, PNG (Max 2MB)', 'is_required' => true, 'urutan' => 1],
                ['layanan_konten_id' => $id, 'kode_syarat' => 'file_surat_kematian', 'nama_syarat' => 'SURAT KETERANGAN KEMATIAN', 'keterangan' => 'Dari RS/Puskesmas/Desa. Format: PDF, JPG, PNG (Max 2MB)', 'is_required' => true, 'urutan' => 2],
                ['layanan_konten_id' => $id, 'kode_syarat' => 'file_ktp_almarhum', 'nama_syarat' => 'SCAN KTP ALMARHUM', 'keterangan' => 'Jika ada/hilang lampirkan surat kehilangan. Format: PDF, JPG, PNG (Max 2MB)', 'is_required' => false, 'urutan' => 3],
                ['layanan_konten_id' => $id, 'kode_syarat' => 'file_kk', 'nama_syarat' => 'SCAN KK ASLI', 'keterangan' => 'Scan KK asli almarhum/pelapor. Format: PDF, JPG, PNG (Max 2MB)', 'is_required' => true, 'urutan' => 4],
                ['layanan_konten_id' => $id, 'kode_syarat' => 'file_ktp_pelapor', 'nama_syarat' => 'SCAN KTP PELAPOR', 'keterangan' => 'Scan KTP asli pelapor. Format: PDF, JPG, PNG (Max 2MB)', 'is_required' => true, 'urutan' => 5],
                ['layanan_konten_id' => $id, 'kode_syarat' => 'file_surat_kepolisian', 'nama_syarat' => 'SURAT KEPOLISIAN (KHUSUS KEMATIAN TIDAK WAJAR)', 'keterangan' => 'Lampirkan jika sebab kematian tidak wajar (kecelakaan/lainnya). Format: PDF, JPG, PNG (Max 2MB)', 'is_required' => false, 'urutan' => 6],
            ]);
        }

        // 3. KK
        if (isset($layanan['kk'])) {
            $id = $layanan['kk']->id;
            $syarats = array_merge($syarats, [
                ['layanan_konten_id' => $id, 'kode_syarat' => 'file_pengantar_rt_rw', 'nama_syarat' => 'SURAT PENGANTAR RT/RW', 'keterangan' => 'Surat pengantar dari RT/RW setempat. Format: PDF, JPG, PNG (Max 2MB)', 'is_required' => true, 'urutan' => 1],
                ['layanan_konten_id' => $id, 'kode_syarat' => 'file_kk_lama', 'nama_syarat' => 'KK LAMA / ASLI', 'keterangan' => 'Wajib untuk rubah data/tambah anggota. Format: PDF, JPG, PNG', 'is_required' => false, 'urutan' => 2],
                ['layanan_konten_id' => $id, 'kode_syarat' => 'file_ktp_anggota', 'nama_syarat' => 'KTP ANGGOTA KELUARGA', 'keterangan' => 'Scan KTP terkait pengajuan. Format: PDF, JPG, PNG', 'is_required' => false, 'urutan' => 3],
                ['layanan_konten_id' => $id, 'kode_syarat' => 'file_akta_nikah_perkawinan', 'nama_syarat' => 'AKTA NIKAH / BUKU NIKAH', 'keterangan' => 'Untuk pembuatan KK Baru (Menikah). Format: PDF, JPG, PNG', 'is_required' => false, 'urutan' => 4],
                ['layanan_konten_id' => $id, 'kode_syarat' => 'file_ktp_mempelai', 'nama_syarat' => 'KTP KEDUA MEMPELAI', 'keterangan' => 'Untuk pembuatan KK Baru (Menikah). Format: PDF, JPG, PNG', 'is_required' => false, 'urutan' => 5],
                ['layanan_konten_id' => $id, 'kode_syarat' => 'file_kk_asal', 'nama_syarat' => 'KK ASAL SUAMI & ISTRI', 'keterangan' => 'Untuk pembuatan KK Baru (Menikah). Format: PDF, JPG, PNG', 'is_required' => false, 'urutan' => 6],
                ['layanan_konten_id' => $id, 'kode_syarat' => 'file_akta_lahir_anak', 'nama_syarat' => 'AKTA KELAHIRAN ANAK', 'keterangan' => 'Untuk tambah anggota keluarga baru. Format: PDF, JPG, PNG', 'is_required' => false, 'urutan' => 7],
                ['layanan_konten_id' => $id, 'kode_syarat' => 'file_dokumen_pendukung_perubahan', 'nama_syarat' => 'DOKUMEN PENDUKUNG PERUBAHAN', 'keterangan' => 'Ijazah/Akta Lahir/Buku Nikah (untuk rubah data). Format: PDF, JPG, PNG', 'is_required' => false, 'urutan' => 8],
                ['layanan_konten_id' => $id, 'kode_syarat' => 'file_surat_persetujuan_pisah', 'nama_syarat' => 'SURAT PERSETUJUAN PISAH KK', 'keterangan' => 'Untuk pengajuan Pisah KK. Format: PDF, JPG, PNG', 'is_required' => false, 'urutan' => 9],
            ]);
        }

        // 4. KTP
        if (isset($layanan['ktp'])) {
            $id = $layanan['ktp']->id;
            $syarats = array_merge($syarats, [
                ['layanan_konten_id' => $id, 'kode_syarat' => 'file_pengantar_rt_rw', 'nama_syarat' => 'SURAT PENGANTAR RT/RW', 'keterangan' => 'Surat pengantar dari RT/RW setempat. Format: PDF, JPG, PNG (Max 2MB)', 'is_required' => true, 'urutan' => 1],
                ['layanan_konten_id' => $id, 'kode_syarat' => 'file_kk_pemohon', 'nama_syarat' => 'SCAN KARTU KELUARGA (KK)', 'keterangan' => 'Scan KK asli pemohon. Format: PDF, JPG, PNG (Max 2MB)', 'is_required' => true, 'urutan' => 2],
                ['layanan_konten_id' => $id, 'kode_syarat' => 'file_surat_kehilangan', 'nama_syarat' => 'SURAT KEHILANGAN KEPOLISIAN', 'keterangan' => 'Wajib jika pengajuan karena KTP Hilang. Format: PDF, JPG, PNG', 'is_required' => false, 'urutan' => 3],
            ]);
        }

        \App\Models\LayananSyarat::insert($syarats);
    }
}
