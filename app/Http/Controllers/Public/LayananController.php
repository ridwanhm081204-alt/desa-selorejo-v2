<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\LogStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    public function index()
    {
        return view('public.layanan.index');
    }

    public function formAktaKelahiran()
    {
        return view('public.layanan.form-akta-kelahiran');
    }

    public function formAktaKematian()
    {
        return view('public.layanan.form-akta-kematian');
    }

    public function formKk()
    {
        return view('public.layanan.form-kk');
    }

    public function formKtp()
    {
        return view('public.layanan.form-ktp');
    }

    public function store(Request $request)
    {
        $jenisLayanan = $request->input('jenis_layanan');

        // Common validation
        $rules = [
            'nik_pemohon' => 'required|numeric|digits:16',
            'nama_pemohon' => 'required|string|max:100',
            'no_hp_pemohon' => ['required', 'string', 'max:15', 'regex:/^\+?[0-9]{8,14}$/'],
            'email_pemohon' => 'nullable|email|max:100',
            'jenis_layanan' => 'required|string',
        ];

        // Custom validation based on type
        if ($jenisLayanan === 'akta_kelahiran') {
            $rules = array_merge($rules, [
                'nama_anak' => 'required|string|max:100',
                'tempat_lahir_anak' => 'required|string|max:50',
                'tanggal_lahir_anak' => 'required|date|before_or_equal:today',
                'jam_lahir_anak' => 'nullable|string',
                'jenis_kelamin_anak' => 'required|in:L,P',
                'anak_ke' => 'required|integer|min:1',
                'berat_lahir' => 'nullable|numeric|min:0',
                'panjang_lahir' => 'nullable|numeric|min:0',
                'nik_ayah' => 'required|numeric|digits:16',
                'nama_ayah' => 'required|string|max:100',
                'nik_ibu' => 'required|numeric|digits:16',
                'nama_ibu' => 'required|string|max:100',
                'no_kk_orangtua' => 'required|numeric|digits:16',
                'nama_saksi1' => 'required|string|max:100',
                'nik_saksi1' => 'required|numeric|digits:16',
                'nama_saksi2' => 'required|string|max:100',
                'nik_saksi2' => 'required|numeric|digits:16',
                'tempat_penerbit_surat_lahir' => 'required|in:rs,puskesmas,bidan,kepala_desa',
                // Files
                'file_surat_lahir' => 'required|file|mimes:pdf,jpg,png|max:2048',
                'file_kk_ortu' => 'required|file|mimes:pdf,jpg,png|max:2048',
                'file_ktp_ortu' => 'required|file|mimes:pdf,jpg,png|max:2048',
                'file_akta_nikah' => 'required|file|mimes:pdf,jpg,png|max:2048',
                'file_ktp_saksi' => 'required|file|mimes:pdf,jpg,png|max:2048',
            ]);
        } elseif ($jenisLayanan === 'akta_kematian') {
            $rules = array_merge($rules, [
                'nik_almarhum' => 'required|numeric|digits:16',
                'nama_almarhum' => 'required|string|max:100',
                'tempat_lahir_almarhum' => 'required|string|max:50',
                'tanggal_lahir_almarhum' => 'required|date',
                'tempat_meninggal' => 'required|string|max:100',
                'tanggal_meninggal' => 'required|date|before_or_equal:today',
                'sebab_kematian' => 'required|string|max:255',
                'nama_pelapor' => 'required|string|max:100',
                'nik_pelapor' => 'required|numeric|digits:16',
                'hubungan_pelapor' => 'required|string|max:50',
                'identitas_jelas' => 'nullable|boolean',
                // Files
                'file_surat_kematian' => 'required|file|mimes:pdf,jpg,png|max:2048',
                'file_ktp_almarhum' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
                'file_kk' => 'required|file|mimes:pdf,jpg,png|max:2048',
                'file_ktp_pelapor' => 'required|file|mimes:pdf,jpg,png|max:2048',
                'file_surat_kepolisian' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            ]);
        } elseif (str_starts_with($jenisLayanan, 'kk_')) {
            $rules = array_merge($rules, [
                'no_kk_asal' => 'nullable|numeric|digits:16',
                'alamat_baru' => 'nullable|string',
                // For KK Baru
                'nik_suami' => 'nullable|numeric|digits:16',
                'nama_suami' => 'nullable|required_if:jenis_layanan,kk_baru|string|max:100',
                'nik_istri' => 'nullable|numeric|digits:16',
                'nama_istri' => 'nullable|required_if:jenis_layanan,kk_baru|string|max:100',
                // For Tambah Anggota
                'nik_anak' => 'nullable|numeric|digits:16',
                'nama_anak' => 'nullable|required_if:jenis_layanan,kk_tambah_anggota|string|max:100',
                'no_akta_lahir' => 'nullable|string|max:100',
                // For Ubah Data
                'anggota_ubah_nama' => 'nullable|string|max:100',
                'jenis_perubahan' => 'nullable|string',
                'nilai_lama' => 'nullable|string',
                'nilai_baru' => 'nullable|string',
                // For Pisah KK
                'anggota_terlibat' => 'nullable|array',
                // Files
                'file_kk_lama' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
                'file_ktp_anggota' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
                'file_akta_nikah_perkawinan' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
                'file_ktp_mempelai' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
                'file_kk_asal' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
                'file_akta_lahir_anak' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
                'file_dokumen_pendukung_perubahan' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
                'file_surat_persetujuan_pisah' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            ]);
        } elseif (str_starts_with($jenisLayanan, 'ktp_')) {
            $rules = array_merge($rules, [
                'jenis_pengajuan_ktp' => 'required|in:baru_17tahun,rusak,hilang,ubah_data',
                'no_surat_kehilangan' => 'nullable|required_if:jenis_pengajuan_ktp,hilang|string|max:50',
                'jadwal_perekaman' => [
                    'nullable',
                    'date',
                    'after:today',
                    function ($attribute, $value, $fail) {
                        $timestamp = strtotime($value);
                        $dayOfWeek = date('N', $timestamp); // 1 (Mon) - 7 (Sun)
                        $time = date('H:i', $timestamp);
                        
                        if ($dayOfWeek > 5) {
                            $fail('Rencana kedatangan hanya boleh hari kerja (Senin - Jumat).');
                        }
                        if ($time < '08:00' || $time > '14:00') {
                            $fail('Rencana kedatangan hanya boleh antara jam 08:00 - 14:00.');
                        }
                    }
                ],
                // Files
                'file_kk_pemohon' => 'required|file|mimes:pdf,jpg,png|max:2048',
                'file_surat_kehilangan' => 'nullable|required_if:jenis_pengajuan_ktp,hilang|file|mimes:pdf,jpg,png|max:2048',
            ]);
        }

        $validated = $request->validate($rules);

        DB::beginTransaction();

        try {
            // 1. Create main Pengajuan record
            $pengajuan = Pengajuan::create([
                'nik_pemohon' => $validated['nik_pemohon'],
                'nama_pemohon' => $validated['nama_pemohon'],
                'no_hp_pemohon' => $validated['no_hp_pemohon'],
                'email_pemohon' => $validated['email_pemohon'],
                'jenis_layanan' => $jenisLayanan,
                'status' => 'diajukan',
            ]);

            // Create initial status log
            LogStatus::create([
                'pengajuan_id' => $pengajuan->id,
                'status_lama' => '-',
                'status_baru' => 'diajukan',
                'catatan' => 'Pengajuan berhasil dikirimkan oleh pemohon.',
            ]);

            // Helper to upload files
            $uploadFile = function ($fileKey, $jenisDokumen) use ($request, $pengajuan) {
                if ($request->hasFile($fileKey)) {
                    $file = $request->file($fileKey);
                    $path = $file->store('pengajuan/' . $pengajuan->no_tiket, 'public');
                    $pengajuan->dokumenUploads()->create([
                        'jenis_dokumen' => $jenisDokumen,
                        'nama_file' => $file->getClientOriginalName(),
                        'path_file' => $path,
                    ]);
                }
            };

            // 2. Save detail based on type
            if ($jenisLayanan === 'akta_kelahiran') {
                $pengajuan->detailAktaKelahiran()->create([
                    'nama_anak' => $validated['nama_anak'],
                    'tempat_lahir' => $validated['tempat_lahir_anak'],
                    'tanggal_lahir' => $validated['tanggal_lahir_anak'],
                    'jam_lahir' => $validated['jam_lahir_anak'],
                    'jenis_kelamin' => $validated['jenis_kelamin_anak'],
                    'anak_ke' => $validated['anak_ke'],
                    'berat_lahir' => $validated['berat_lahir'],
                    'panjang_lahir' => $validated['panjang_lahir'],
                    'nik_ayah' => $validated['nik_ayah'],
                    'nama_ayah' => $validated['nama_ayah'],
                    'nik_ibu' => $validated['nik_ibu'],
                    'nama_ibu' => $validated['nama_ibu'],
                    'no_kk_orangtua' => $validated['no_kk_orangtua'],
                    'nama_saksi1' => $validated['nama_saksi1'],
                    'nik_saksi1' => $validated['nik_saksi1'],
                    'nama_saksi2' => $validated['nama_saksi2'],
                    'nik_saksi2' => $validated['nik_saksi2'],
                    'tempat_penerbit_surat_lahir' => $validated['tempat_penerbit_surat_lahir'],
                ]);

                // Upload required files
                $uploadFile('file_surat_lahir', 'surat_lahir');
                $uploadFile('file_kk_ortu', 'kk_ortu');
                $uploadFile('file_ktp_ortu', 'ktp_ortu');
                $uploadFile('file_akta_nikah', 'akta_nikah');
                $uploadFile('file_ktp_saksi', 'ktp_saksi');

            } elseif ($jenisLayanan === 'akta_kematian') {
                $pengajuan->detailAktaKematian()->create([
                    'nik_almarhum' => $validated['nik_almarhum'],
                    'nama_almarhum' => $validated['nama_almarhum'],
                    'tempat_lahir' => $validated['tempat_lahir_almarhum'],
                    'tanggal_lahir' => $validated['tanggal_lahir_almarhum'],
                    'tempat_meninggal' => $validated['tempat_meninggal'],
                    'tanggal_meninggal' => $validated['tanggal_meninggal'],
                    'sebab_kematian' => $validated['sebab_kematian'],
                    'nama_pelapor' => $validated['nama_pelapor'],
                    'nik_pelapor' => $validated['nik_pelapor'],
                    'hubungan_pelapor' => $validated['hubungan_pelapor'],
                    'identitas_jelas' => $request->has('identitas_jelas'),
                ]);

                // Upload files
                $uploadFile('file_surat_kematian', 'surat_kematian');
                $uploadFile('file_ktp_almarhum', 'ktp_almarhum');
                $uploadFile('file_kk', 'kk_almarhum');
                $uploadFile('file_ktp_pelapor', 'ktp_pelapor');
                $uploadFile('file_surat_kepolisian', 'surat_kepolisian');

            } elseif (str_starts_with($jenisLayanan, 'kk_')) {
                // Determine jenis_perubahan enum based on jenis_layanan
                $jenisPerubahan = 'ubah_elemen_data';
                if ($jenisLayanan === 'kk_baru') $jenisPerubahan = 'baru_menikah';
                elseif ($jenisLayanan === 'kk_tambah_anggota') $jenisPerubahan = 'tambah_anggota';
                elseif ($jenisLayanan === 'kk_pisah') $jenisPerubahan = 'pisah_kk';

                // JSON fields
                $dataLama = null;
                $dataBaru = null;
                $anggotaTerlibat = null;

                if ($jenisLayanan === 'kk_baru') {
                    $dataBaru = [
                        'nik_suami' => $validated['nik_suami'] ?? null,
                        'nama_suami' => $validated['nama_suami'] ?? null,
                        'nik_istri' => $validated['nik_istri'] ?? null,
                        'nama_istri' => $validated['nama_istri'] ?? null,
                    ];
                } elseif ($jenisLayanan === 'kk_tambah_anggota') {
                    $dataBaru = [
                        'nik_anak' => $validated['nik_anak'] ?? null,
                        'nama_anak' => $validated['nama_anak'] ?? null,
                        'no_akta_lahir' => $validated['no_akta_lahir'] ?? null,
                    ];
                } elseif ($jenisLayanan === 'kk_ubah_data') {
                    $dataLama = [
                        'nama_anggota' => $validated['anggota_ubah_nama'] ?? null,
                        'jenis_perubahan' => $validated['jenis_perubahan'] ?? null,
                        'nilai_lama' => $validated['nilai_lama'] ?? null,
                    ];
                    $dataBaru = [
                        'nilai_baru' => $validated['nilai_baru'] ?? null,
                    ];
                } elseif ($jenisLayanan === 'kk_pisah') {
                    $anggotaTerlibat = $validated['anggota_terlibat'] ?? [];
                }

                $pengajuan->detailKk()->create([
                    'jenis_perubahan' => $jenisPerubahan,
                    'no_kk_asal' => $validated['no_kk_asal'] ?? null,
                    'alamat_baru' => $validated['alamat_baru'] ?? null,
                    'data_lama' => $dataLama,
                    'data_baru' => $dataBaru,
                    'anggota_terlibat' => $anggotaTerlibat,
                ]);

                // Upload files
                $uploadFile('file_kk_lama', 'kk_lama');
                $uploadFile('file_ktp_anggota', 'ktp_anggota');
                $uploadFile('file_akta_nikah_perkawinan', 'akta_nikah_perkawinan');
                $uploadFile('file_ktp_mempelai', 'ktp_mempelai');
                $uploadFile('file_kk_asal', 'kk_asal');
                $uploadFile('file_akta_lahir_anak', 'akta_lahir_anak');
                $uploadFile('file_dokumen_pendukung_perubahan', 'dokumen_pendukung_perubahan');
                $uploadFile('file_surat_persetujuan_pisah', 'surat_persetujuan_pisah');

            } elseif (str_starts_with($jenisLayanan, 'ktp_')) {
                $pengajuan->detailKtp()->create([
                    'jenis_pengajuan' => $validated['jenis_pengajuan_ktp'],
                    'no_surat_kehilangan' => $validated['no_surat_kehilangan'] ?? null,
                    'jadwal_perekaman' => $validated['jadwal_perekaman'] ?? null,
                ]);

                // Upload files
                $uploadFile('file_kk_pemohon', 'kk_pemohon');
                $uploadFile('file_surat_kehilangan', 'surat_kehilangan');
            }

            DB::commit();

            return redirect('/layanan/sukses?no_tiket=' . $pengajuan->no_tiket);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function sukses(Request $request)
    {
        $noTiket = $request->query('no_tiket');
        return view('public.layanan.sukses', compact('noTiket'));
    }

    public function cekStatus()
    {
        return view('public.layanan.cek-status');
    }

    public function hasilStatus(Request $request)
    {
        $request->validate([
            'query_status' => 'required|string|max:50',
        ]);

        $query = $request->input('query_status');

        $pengajuan = Pengajuan::with(['logStatuses.operator'])
            ->where('no_tiket', $query)
            ->orWhere('nik_pemohon', $query)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('public.layanan.hasil-status', compact('pengajuan', 'query'));
    }
}
