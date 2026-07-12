<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Pengajuan;
use App\Models\DetailAktaKelahiran;
use App\Models\DetailAktaKematian;
use App\Models\DetailKk;
use App\Models\DetailKtp;
use App\Models\DokumenUpload;
use App\Models\LogStatus;
use App\Models\User;
use Carbon\Carbon;

class LayananSeeder extends Seeder
{
    private $generatedNiks = [];
    private $generatedKks = [];
    private $generatedNames = [];

    public function run(): void
    {
        // 1. Truncate existing data in reverse order of dependencies
        DB::statement('PRAGMA foreign_keys = OFF;');
        LogStatus::truncate();
        DokumenUpload::truncate();
        DetailKtp::truncate();
        DetailKk::truncate();
        DetailAktaKematian::truncate();
        DetailAktaKelahiran::truncate();
        Pengajuan::truncate();
        DB::statement('PRAGMA foreign_keys = ON;');

        // Get operator ID for status transitions
        $operatorId = User::where('role', 'operator')->first()?->id ?? (User::where('role', 'admin')->first()?->id ?? null);

        // Status options
        $statuses = ['diajukan', 'diverifikasi', 'diproses_disdukcapil', 'selesai', 'ditolak'];

        // We want exactly 100 records in total, split equally (25 each) across the 4 main types.
        // Within each type, we want 5 records for each of the 5 statuses (25 total per type).
        // Let's loop 100 times.
        // i: 0 to 99
        // type index: floor(i / 25) => 0 = Akta Kelahiran, 1 = Akta Kematian, 2 = KK, 3 = KTP
        // status index: (i % 25) % 5 => 0 = diajukan, 1 = diverifikasi, 2 = diproses_disdukcapil, 3 = selesai, 4 = ditolak
        for ($i = 0; $i < 100; $i++) {
            $typeIdx = floor($i / 25);
            $statusIdx = ($i % 25) % 5;

            $status = $statuses[$statusIdx];
            $createdAt = Carbon::now()->subDays(30)->addMinutes($i * 430);

            // Generate pemohon info
            $namaPemohon = $this->generateUniqueName();
            $nikPemohon = $this->generateUniqueNik();
            $noHpPemohon = $this->generatePhoneNumber();
            $emailPemohon = strtolower(str_replace(' ', '', $namaPemohon)) . '@gmail.com';

            // Determine jenis_layanan
            $jenisLayanan = '';
            if ($typeIdx == 0) {
                $jenisLayanan = 'akta_kelahiran';
            } elseif ($typeIdx == 1) {
                $jenisLayanan = 'akta_kematian';
            } elseif ($typeIdx == 2) {
                // KK types: kk_baru, kk_tambah_anggota, kk_ubah_data, kk_pisah
                $kkSubTypes = ['kk_baru', 'kk_tambah_anggota', 'kk_ubah_data', 'kk_pisah'];
                $jenisLayanan = $kkSubTypes[$i % 4];
            } else {
                // KTP types: ktp_baru, ktp_hilang, ktp_rusak, ktp_ubah_data
                $ktpSubTypes = ['ktp_baru', 'ktp_hilang', 'ktp_rusak', 'ktp_ubah_data'];
                $jenisLayanan = $ktpSubTypes[$i % 4];
            }

            // Create Pengajuan
            $pengajuan = new Pengajuan();
            $pengajuan->nik_pemohon = $nikPemohon;
            $pengajuan->nama_pemohon = $namaPemohon;
            $pengajuan->no_hp_pemohon = $noHpPemohon;
            $pengajuan->email_pemohon = $emailPemohon;
            $pengajuan->jenis_layanan = $jenisLayanan;
            $pengajuan->status = $status;
            $pengajuan->diverifikasi_oleh = ($status === 'diajukan') ? null : $operatorId;
            
            // Set some realistic catatan_admin
            if ($status === 'ditolak') {
                $reasons = [
                    'Berkas kurang lengkap, mohon unggah ulang foto KTP yang jelas.',
                    'Scan Kartu Keluarga asal tidak terbaca / buram.',
                    'Tanda tangan saksi pada surat keterangan lahir belum terisi.',
                    'Nama almarhum tidak sesuai dengan NIK yang diinput.',
                    'Surat keterangan kehilangan dari kepolisian sudah kedaluwarsa.'
                ];
                $pengajuan->catatan_admin = $reasons[$i % 5];
            } elseif ($status === 'selesai') {
                $pengajuan->catatan_admin = 'Pengajuan telah selesai diproses. Silakan mengambil dokumen fisik di Kantor Desa Selorejo pada jam kerja.';
            } elseif ($status === 'diproses_disdukcapil') {
                $pengajuan->catatan_admin = 'Berkas sudah diverifikasi desa dan sedang dalam proses pencetakan di Disdukcapil Kabupaten.';
            } elseif ($status === 'diverifikasi') {
                $pengajuan->catatan_admin = 'Berkas sudah diperiksa oleh operator desa dan dinyatakan lengkap.';
            } else {
                $pengajuan->catatan_admin = null;
            }

            $pengajuan->created_at = $createdAt;
            $pengajuan->updated_at = $createdAt;
            $pengajuan->save();

            // Create Detail record based on type
            if ($jenisLayanan === 'akta_kelahiran') {
                $gender = ($i % 2 == 0) ? 'L' : 'P';
                $namaAnak = $this->generateUniqueName($gender);
                
                DetailAktaKelahiran::create([
                    'pengajuan_id' => $pengajuan->id,
                    'nama_anak' => $namaAnak,
                    'tempat_lahir' => 'Malang',
                    'tanggal_lahir' => Carbon::now()->subMonths(mt_rand(1, 12))->subDays(mt_rand(1, 28))->toDateString(),
                    'jam_lahir' => sprintf('%02d:%02d:00', mt_rand(0, 23), mt_rand(0, 59)),
                    'jenis_kelamin' => $gender,
                    'anak_ke' => mt_rand(1, 4),
                    'berat_lahir' => mt_rand(250, 420) / 100, // 2.50 to 4.20 kg
                    'panjang_lahir' => mt_rand(45, 53), // 45 to 53 cm
                    'nik_ayah' => $this->generateUniqueNik(),
                    'nama_ayah' => $this->generateUniqueName('L'),
                    'nik_ibu' => $this->generateUniqueNik(),
                    'nama_ibu' => $this->generateUniqueName('P'),
                    'no_kk_orangtua' => $this->generateUniqueKk(),
                    'nama_saksi1' => $this->generateUniqueName(),
                    'nik_saksi1' => $this->generateUniqueNik(),
                    'nama_saksi2' => $this->generateUniqueName(),
                    'nik_saksi2' => $this->generateUniqueNik(),
                    'tempat_penerbit_surat_lahir' => ['rs', 'puskesmas', 'bidan', 'kepala_desa'][$i % 4],
                ]);

                // Create Dokumen Upload
                $docs = [
                    'surat_lahir' => 'surat_keterangan_lahir.pdf',
                    'kk_ortu' => 'kk_orangtua.pdf',
                    'ktp_ortu' => 'ktp_orangtua.jpg',
                    'akta_nikah' => 'akta_nikah.pdf',
                    'ktp_saksi' => 'ktp_saksi.jpg'
                ];
                foreach ($docs as $jenisDoc => $fileName) {
                    DokumenUpload::create([
                        'pengajuan_id' => $pengajuan->id,
                        'jenis_dokumen' => $jenisDoc,
                        'nama_file' => $fileName,
                        'path_file' => 'dokumen_dummy/' . $jenisDoc . '_' . $pengajuan->id . ($jenisDoc === 'ktp_ortu' || $jenisDoc === 'ktp_saksi' ? '.jpg' : '.pdf'),
                    ]);
                }

            } elseif ($jenisLayanan === 'akta_kematian') {
                $genderAlmarhum = ($i % 2 == 0) ? 'L' : 'P';
                $namaAlmarhum = $this->generateUniqueName($genderAlmarhum);
                $tglLahir = Carbon::now()->subYears(mt_rand(60, 85))->subDays(mt_rand(1, 300));
                $tglMeninggal = (clone $createdAt)->subDays(mt_rand(1, 5));

                DetailAktaKematian::create([
                    'pengajuan_id' => $pengajuan->id,
                    'nik_almarhum' => $this->generateUniqueNik(),
                    'nama_almarhum' => $namaAlmarhum,
                    'tempat_lahir' => 'Malang',
                    'tanggal_lahir' => $tglLahir->toDateString(),
                    'tempat_meninggal' => 'Desa Selorejo, Malang',
                    'tanggal_meninggal' => $tglMeninggal->toDateString(),
                    'sebab_kematian' => ['Sakit Tua', 'Stroke', 'Serangan Jantung', 'Komplikasi Medis', 'Kecelakaan'][$i % 5],
                    'nama_pelapor' => $namaPemohon, // The applicant is the reporter
                    'nik_pelapor' => $nikPemohon,
                    'hubungan_pelapor' => ['Anak Kandung', 'Istri', 'Suami', 'Saudara Kandung'][$i % 4],
                    'identitas_jelas' => true,
                ]);

                // Create Dokumen Upload
                $docs = [
                    'surat_kematian' => 'surat_kematian.pdf',
                    'ktp_almarhum' => 'ktp_almarhum.jpg',
                    'kk_almarhum' => 'kk_almarhum.pdf',
                    'ktp_pelapor' => 'ktp_pelapor.jpg'
                ];
                foreach ($docs as $jenisDoc => $fileName) {
                    DokumenUpload::create([
                        'pengajuan_id' => $pengajuan->id,
                        'jenis_dokumen' => $jenisDoc,
                        'nama_file' => $fileName,
                        'path_file' => 'dokumen_dummy/' . $jenisDoc . '_' . $pengajuan->id . ($jenisDoc === 'ktp_almarhum' || $jenisDoc === 'ktp_pelapor' ? '.jpg' : '.pdf'),
                    ]);
                }

            } elseif (str_starts_with($jenisLayanan, 'kk_')) {
                // Determine jenis_perubahan based on jenis_layanan
                $jenisPerubahan = 'ubah_elemen_data';
                if ($jenisLayanan === 'kk_baru') $jenisPerubahan = 'baru_menikah';
                elseif ($jenisLayanan === 'kk_tambah_anggota') $jenisPerubahan = 'tambah_anggota';
                elseif ($jenisLayanan === 'kk_pisah') $jenisPerubahan = 'pisah_kk';

                $anggota = [];
                for ($k = 0; $k < mt_rand(2, 4); $k++) {
                    $anggota[] = $this->generateUniqueName();
                }

                DetailKk::create([
                    'pengajuan_id' => $pengajuan->id,
                    'jenis_perubahan' => $jenisPerubahan,
                    'no_kk_asal' => $this->generateUniqueKk(),
                    'alamat_baru' => 'RT ' . sprintf('%02d', mt_rand(1, 10)) . ' RW ' . sprintf('%02d', mt_rand(1, 4)) . ', Dusun Selorejo, Desa Selorejo',
                    'data_lama' => ['alamat' => 'RT 01 RW 01, Selorejo', 'jumlah_anggota' => count($anggota)],
                    'data_baru' => ['alamat' => 'RT ' . mt_rand(1, 10) . ' RW ' . mt_rand(1, 4) . ', Selorejo', 'jumlah_anggota' => count($anggota) + ($jenisPerubahan === 'tambah_anggota' ? 1 : 0)],
                    'anggota_terlibat' => $anggota,
                ]);

                // Create Dokumen Upload
                if ($jenisLayanan === 'kk_baru') {
                    $docs = [
                        'akta_nikah_perkawinan' => 'buku_nikah_suami_istri.pdf',
                        'ktp_mempelai' => 'ktp_suami_istri.jpg',
                        'kk_asal' => 'kk_asal_orangtua.pdf'
                    ];
                } else {
                    $docs = [
                        'kk_lama' => 'kartu_keluarga_lama.pdf',
                        'dokumen_pendukung_perubahan' => 'dokumen_pendukung.pdf'
                    ];
                    if ($jenisLayanan === 'kk_pisah') {
                        $docs['surat_persetujuan_pisah'] = 'surat_persetujuan_keluarga.pdf';
                    }
                }

                foreach ($docs as $jenisDoc => $fileName) {
                    DokumenUpload::create([
                        'pengajuan_id' => $pengajuan->id,
                        'jenis_dokumen' => $jenisDoc,
                        'nama_file' => $fileName,
                        'path_file' => 'dokumen_dummy/' . $jenisDoc . '_' . $pengajuan->id . ($jenisDoc === 'ktp_mempelai' ? '.jpg' : '.pdf'),
                    ]);
                }

            } elseif (str_starts_with($jenisLayanan, 'ktp_')) {
                // Determine jenis_pengajuan based on jenis_layanan
                $jenisPengajuan = 'ubah_data';
                if ($jenisLayanan === 'ktp_baru') $jenisPengajuan = 'baru_17tahun';
                elseif ($jenisLayanan === 'ktp_hilang') $jenisPengajuan = 'hilang';
                elseif ($jenisLayanan === 'ktp_rusak') $jenisPengajuan = 'rusak';

                DetailKtp::create([
                    'pengajuan_id' => $pengajuan->id,
                    'jenis_pengajuan' => $jenisPengajuan,
                    'no_surat_kehilangan' => ($jenisLayanan === 'ktp_hilang') ? 'SKTLK/' . mt_rand(100, 999) . '/VII/' . Carbon::now()->year : null,
                    'jadwal_perekaman' => ($status === 'selesai' || $status === 'ditolak') ? null : (clone $createdAt)->addDays(mt_rand(2, 5))->setTime(mt_rand(8, 12), 0, 0),
                ]);

                // Create Dokumen Upload
                $docs = [
                    'kk_pemohon' => 'kartu_keluarga_pemohon.pdf'
                ];
                if ($jenisLayanan === 'ktp_hilang') {
                    $docs['surat_kehilangan'] = 'surat_keterangan_kehilangan_polisi.pdf';
                }

                foreach ($docs as $jenisDoc => $fileName) {
                    DokumenUpload::create([
                        'pengajuan_id' => $pengajuan->id,
                        'jenis_dokumen' => $jenisDoc,
                        'nama_file' => $fileName,
                        'path_file' => 'dokumen_dummy/' . $jenisDoc . '_' . $pengajuan->id . '.pdf',
                    ]);
                }
            }

            // Create Log Status records based on the current status
            // Time increments to represent history
            $t = clone $createdAt;
            if ($status === 'diajukan') {
                LogStatus::create([
                    'pengajuan_id' => $pengajuan->id,
                    'status_lama' => 'diajukan',
                    'status_baru' => 'diajukan',
                    'diubah_oleh' => null,
                    'catatan' => 'Permohonan berhasil dikirim oleh pemohon melalui form online.',
                    'created_at' => $t,
                    'updated_at' => $t,
                ]);
            } elseif ($status === 'diverifikasi') {
                $t1 = (clone $t)->subHours(6);
                LogStatus::create([
                    'pengajuan_id' => $pengajuan->id,
                    'status_lama' => 'diajukan',
                    'status_baru' => 'diajukan',
                    'diubah_oleh' => null,
                    'catatan' => 'Permohonan berhasil dikirim oleh pemohon melalui form online.',
                    'created_at' => $t1,
                    'updated_at' => $t1,
                ]);
                LogStatus::create([
                    'pengajuan_id' => $pengajuan->id,
                    'status_lama' => 'diajukan',
                    'status_baru' => 'diverifikasi',
                    'diubah_oleh' => $operatorId,
                    'catatan' => 'Berkas telah diperiksa oleh petugas desa dan dinyatakan lengkap.',
                    'created_at' => $t,
                    'updated_at' => $t,
                ]);
            } elseif ($status === 'diproses_disdukcapil') {
                $t1 = (clone $t)->subHours(24);
                $t2 = (clone $t)->subHours(12);
                LogStatus::create([
                    'pengajuan_id' => $pengajuan->id,
                    'status_lama' => 'diajukan',
                    'status_baru' => 'diajukan',
                    'diubah_oleh' => null,
                    'catatan' => 'Permohonan berhasil dikirim oleh pemohon melalui form online.',
                    'created_at' => $t1,
                    'updated_at' => $t1,
                ]);
                LogStatus::create([
                    'pengajuan_id' => $pengajuan->id,
                    'status_lama' => 'diajukan',
                    'status_baru' => 'diverifikasi',
                    'diubah_oleh' => $operatorId,
                    'catatan' => 'Berkas telah diperiksa oleh petugas desa dan dinyatakan lengkap.',
                    'created_at' => $t2,
                    'updated_at' => $t2,
                ]);
                LogStatus::create([
                    'pengajuan_id' => $pengajuan->id,
                    'status_lama' => 'diverifikasi',
                    'status_baru' => 'diproses_disdukcapil',
                    'diubah_oleh' => $operatorId,
                    'catatan' => 'Berkas diajukan dan sedang diproses cetak di kantor Disdukcapil Kabupaten.',
                    'created_at' => $t,
                    'updated_at' => $t,
                ]);
            } elseif ($status === 'selesai') {
                $t1 = (clone $t)->subHours(48);
                $t2 = (clone $t)->subHours(36);
                $t3 = (clone $t)->subHours(12);
                LogStatus::create([
                    'pengajuan_id' => $pengajuan->id,
                    'status_lama' => 'diajukan',
                    'status_baru' => 'diajukan',
                    'diubah_oleh' => null,
                    'catatan' => 'Permohonan berhasil dikirim oleh pemohon melalui form online.',
                    'created_at' => $t1,
                    'updated_at' => $t1,
                ]);
                LogStatus::create([
                    'pengajuan_id' => $pengajuan->id,
                    'status_lama' => 'diajukan',
                    'status_baru' => 'diverifikasi',
                    'diubah_oleh' => $operatorId,
                    'catatan' => 'Berkas telah diperiksa oleh petugas desa dan dinyatakan lengkap.',
                    'created_at' => $t2,
                    'updated_at' => $t2,
                ]);
                LogStatus::create([
                    'pengajuan_id' => $pengajuan->id,
                    'status_lama' => 'diverifikasi',
                    'status_baru' => 'diproses_disdukcapil',
                    'diubah_oleh' => $operatorId,
                    'catatan' => 'Berkas diajukan dan sedang diproses cetak di kantor Disdukcapil Kabupaten.',
                    'created_at' => $t3,
                    'updated_at' => $t3,
                ]);
                LogStatus::create([
                    'pengajuan_id' => $pengajuan->id,
                    'status_lama' => 'diproses_disdukcapil',
                    'status_baru' => 'selesai',
                    'diubah_oleh' => $operatorId,
                    'catatan' => 'Dokumen fisik KTP/KK/Akta telah selesai dicetak dan siap diambil.',
                    'created_at' => $t,
                    'updated_at' => $t,
                ]);
            } elseif ($status === 'ditolak') {
                $t1 = (clone $t)->subHours(12);
                LogStatus::create([
                    'pengajuan_id' => $pengajuan->id,
                    'status_lama' => 'diajukan',
                    'status_baru' => 'diajukan',
                    'diubah_oleh' => null,
                    'catatan' => 'Permohonan berhasil dikirim oleh pemohon melalui form online.',
                    'created_at' => $t1,
                    'updated_at' => $t1,
                ]);
                LogStatus::create([
                    'pengajuan_id' => $pengajuan->id,
                    'status_lama' => 'diajukan',
                    'status_baru' => 'ditolak',
                    'diubah_oleh' => $operatorId,
                    'catatan' => $pengajuan->catatan_admin,
                    'created_at' => $t,
                    'updated_at' => $t,
                ]);
            }
        }
    }

    private function generateUniqueNik(): string
    {
        do {
            $nik = '350712' . str_pad((string)mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);
        } while (in_array($nik, $this->generatedNiks));
        $this->generatedNiks[] = $nik;
        return $nik;
    }

    private function generateUniqueKk(): string
    {
        do {
            $kk = '350712' . str_pad((string)mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);
        } while (in_array($kk, $this->generatedKks));
        $this->generatedKks[] = $kk;
        return $kk;
    }

    private function generateUniqueName(?string $gender = null): string
    {
        $maleFirst = ['Aditya', 'Agus', 'Ahmad', 'Andi', 'Anton', 'Aris', 'Bambang', 'Budi', 'Cahyo', 'Dedi', 'Dwi', 'Eko', 'Fajar', 'Gunawan', 'Hadi', 'Hendra', 'Heri', 'Irfan', 'Joko', 'Kartono', 'Lukman', 'Mulyono', 'Nugroho', 'Prabowo', 'Rudi', 'Setiawan', 'Slamet', 'Suryo', 'Taufik', 'Tri', 'Untung', 'Wahyu', 'Wibowo', 'Yayan', 'Yusuf'];
        $femaleFirst = ['Ani', 'Ayu', 'Cinta', 'Dewi', 'Diah', 'Dian', 'Eka', 'Endah', 'Fitri', 'Gita', 'Indah', 'Irma', 'Kartika', 'Laras', 'Lestari', 'Maya', 'Mega', 'Ningsih', 'Nurul', 'Putri', 'Ratih', 'Ratna', 'Retno', 'Rina', 'Sari', 'Siti', 'Sri', 'Suci', 'Tri', 'Utami', 'Wulan', 'Yeni', 'Yuliana', 'Yuni', 'Zahra'];
        $lastNames = ['Saputra', 'Pratama', 'Wijaya', 'Kusuma', 'Santoso', 'Hidayat', 'Wibowo', 'Setiawan', 'Nugroho', 'Prasetyo', 'Utomo', 'Susanto', 'Cahyono', 'Hartono', 'Budiman', 'Purnomo', 'Subagyo', 'Wahyudi', 'Gunawan', 'Raharjo', 'Rustam', 'Subekti', 'Widyatmoko', 'Sujarwo', 'Suryadi', 'Mahendra', 'Kurniawan', 'Hardi', 'Siregar', 'Lubis', 'Nasution', 'Tanjung', 'Harahap', 'Simanjuntak'];

        if ($gender === 'L') {
            $firstPool = $maleFirst;
        } elseif ($gender === 'P') {
            $firstPool = $femaleFirst;
        } else {
            $firstPool = array_merge($maleFirst, $femaleFirst);
        }

        do {
            $first = $firstPool[array_rand($firstPool)];
            $last = $lastNames[array_rand($lastNames)];
            $name = $first . ' ' . $last;
        } while (in_array($name, $this->generatedNames));
        $this->generatedNames[] = $name;
        return $name;
    }

    private function generatePhoneNumber(): string
    {
        return '08' . mt_rand(11, 99) . mt_rand(100000, 999999) . mt_rand(10, 99);
    }
}
