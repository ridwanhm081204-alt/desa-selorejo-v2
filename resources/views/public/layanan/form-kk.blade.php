@extends('layouts.public')
@section('title', 'Form Pengajuan Kartu Keluarga (KK)')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('layanan.index') }}" class="text-decoration-none text-success">Layanan Administrasi</a></li>
    <li class="breadcrumb-item active">Form KK</li>
@endsection
@section('content')
<div class="container mb-5 pb-5">
    <div class="row justify-content-center text-start">
        <div class="col-lg-10">
            <div class="mb-4">
                <a href="{{ route('layanan.index') }}" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm transition-all hover-lift">
                    <i data-lucide="arrow-left" class="icon-sm me-1"></i> Kembali ke Pilihan Layanan
                </a>
            </div>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                <div class="card-header bg-white border-0 p-4 d-flex align-items-center border-bottom">
                    <div class="p-2 rounded-3 me-3 text-white shadow-sm" style="background-color: var(--color-forest);">
                        <i data-lucide="users" class="icon-sm"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0 text-dark" style="font-family: var(--font-heading);">Form Pengajuan Kartu Keluarga (KK)</h4>
                        <small class="text-muted">Pilih jenis pengajuan KK untuk mengisi form yang sesuai</small>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert" style="font-family: var(--font-body);">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('layanan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- CHOOSE SUB-TYPE -->
                        <div class="mb-5 p-4 rounded-4" style="background-color: rgba(26, 92, 56, 0.03); border: 1px solid rgba(26, 92, 56, 0.1);">
                            <label class="form-label fw-bold text-dark mb-2">PILIH JENIS PENGAJUAN KK <span class="text-danger">*</span></label>
                            <select name="jenis_layanan" id="jenis_layanan_select" class="form-select rounded-3 py-3 border-0 bg-white shadow-sm fw-bold text-success" required>
                                <option value="" disabled selected>Pilih Jenis Pengajuan...</option>
                                <option value="kk_baru" {{ old('jenis_layanan') === 'kk_baru' ? 'selected' : '' }}>KK Baru (Karena Pernikahan)</option>
                                <option value="kk_tambah_anggota" {{ old('jenis_layanan') === 'kk_tambah_anggota' ? 'selected' : '' }}>Penambahan Anggota (Kelahiran Anak)</option>
                                <option value="kk_ubah_data" {{ old('jenis_layanan') === 'kk_ubah_data' ? 'selected' : '' }}>Perubahan Elemen Data KK</option>
                                <option value="kk_pisah" {{ old('jenis_layanan') === 'kk_pisah' ? 'selected' : '' }}>Pisah KK (Pindah Alamat/Pecah KK)</option>
                            </select>
                            @error('jenis_layanan') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                        </div>

                        <!-- SECTION 1: DATA PEMOHON (Common) -->
                        <div class="d-none" id="common_section">
                            <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark" style="font-family: var(--font-heading); color: var(--color-forest) !important;">
                                <i data-lucide="user" class="icon-sm me-2"></i>1. Data Diri Pemohon
                            </h5>
                            <div class="row g-3 mb-5">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-muted small">NIK PEMOHON (16 DIGIT) <span class="text-danger">*</span></label>
                                    <input type="text" name="nik_pemohon" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('nik_pemohon') }}" placeholder="Contoh: 3507xxxxxxxxxxxx" required maxlength="16">
                                    @error('nik_pemohon') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-muted small">NAMA LENGKAP PEMOHON <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_pemohon" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('nama_pemohon') }}" placeholder="Nama pemohon" required>
                                    @error('nama_pemohon') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-muted small">NOMOR WHATSAPP AKTIF <span class="text-danger">*</span></label>
                                    <input type="text" name="no_hp_pemohon" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('no_hp_pemohon') }}" placeholder="Contoh: 08123456789" required>
                                    @error('no_hp_pemohon') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-muted small">EMAIL PEMOHON (OPSIONAL)</label>
                                    <input type="email" name="email_pemohon" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('email_pemohon') }}" placeholder="email@domain.com">
                                    @error('email_pemohon') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-bold text-muted small">SURAT PENGANTAR RT/RW <span class="text-danger">*</span></label>
                                    <input type="file" name="file_pengantar_rt_rw" class="form-control rounded-pill border-0 shadow-sm bg-white" accept="image/*,application/pdf" required>
                                    <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">Surat pengantar dari RT/RW setempat (Wajib untuk semua jenis pengajuan KK). Format: PDF, JPG, PNG (Max 2MB)</small>
                                    @error('file_pengantar_rt_rw') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- SUB-FORM A: KK BARU (MENIKAH) -->
                        <div class="d-none" id="section_kk_baru">
                            <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark" style="font-family: var(--font-heading); color: var(--color-forest) !important;">
                                <i data-lucide="heart" class="icon-sm me-2"></i>2. Data Suami & Istri (KK Baru)
                            </h5>
                            <div class="row g-3 mb-5">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-muted small">NIK SUAMI <span class="text-danger">*</span></label>
                                    <input type="text" name="nik_suami" id="input_nik_suami" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('nik_suami') }}" placeholder="NIK Suami" maxlength="16">
                                    @error('nik_suami') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-muted small">NAMA LENGKAP SUAMI <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_suami" id="input_nama_suami" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('nama_suami') }}" placeholder="Nama Lengkap Suami">
                                    @error('nama_suami') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-muted small">NIK ISTRI <span class="text-danger">*</span></label>
                                    <input type="text" name="nik_istri" id="input_nik_istri" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('nik_istri') }}" placeholder="NIK Istri" maxlength="16">
                                    @error('nik_istri') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-muted small">NAMA LENGKAP ISTRI <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_istri" id="input_nama_istri" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('nama_istri') }}" placeholder="Nama Lengkap Istri">
                                    @error('nama_istri') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-bold text-muted small">NOMOR KK ASAL (SUAMI / ISTRI) <span class="text-danger">*</span></label>
                                    <input type="text" name="no_kk_asal" id="input_kk_asal_baru" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('no_kk_asal') }}" placeholder="Masukkan salah satu nomor KK asal" maxlength="16">
                                    @error('no_kk_asal') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-bold text-muted small">ALAMAT KK BARU <span class="text-danger">*</span></label>
                                    <textarea name="alamat_baru" id="input_alamat_baru_kk" class="form-control rounded-3 border-0 bg-light shadow-none" rows="3" placeholder="Masukkan alamat lengkap keluarga baru"></textarea>
                                    @error('alamat_baru') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark" style="font-family: var(--font-heading); color: var(--color-forest) !important;">
                                <i data-lucide="upload-cloud" class="icon-sm me-2"></i>3. Upload Dokumen Pendukung
                            </h5>
                            <div class="row g-4 mb-5">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-muted small">SCAN BUKU NIKAH / AKTA PERKAWINAN <span class="text-danger">*</span></label>
                                    <input type="file" name="file_akta_nikah_perkawinan" id="file_nikah_baru" class="form-control rounded-pill border-0 shadow-sm bg-white" accept="image/*,application/pdf">
                                    <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">Format: PDF, JPG, PNG (Max 2MB)</small>
                        </div>

                        <!-- SUB-FORM B: TAMBAH ANGGOTA (KELAHIRAN) -->
                        <div class="d-none" id="section_kk_tambah_anggota">
                            <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark" style="font-family: var(--font-heading); color: var(--color-forest) !important;">
                                <i data-lucide="baby" class="icon-sm me-2"></i>2. Data Anak (Tambah Anggota)
                            </h5>
                            <div class="row g-3 mb-5">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-muted small">NOMOR KK YANG AKAN DIUBAH <span class="text-danger">*</span></label>
                                    <input type="text" name="no_kk_asal" id="input_kk_asal_tambah" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('no_kk_asal') }}" placeholder="Nomor KK yang diubah" maxlength="16">
                                    @error('no_kk_asal') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-muted small">NIK ANAK YANG DITAMBAHKAN (OPSIONAL)</label>
                                    <input type="text" name="nik_anak" id="input_nik_anak" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('nik_anak') }}" placeholder="NIK anak jika sudah ada" maxlength="16">
                                    @error('nik_anak') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-muted small">NAMA LENGKAP ANAK <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_anak" id="input_nama_anak" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('nama_anak') }}" placeholder="Nama lengkap anak">
                                    @error('nama_anak') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-muted small">NOMOR AKTA KELAHIRAN ANAK <span class="text-danger">*</span></label>
                                    <input type="text" name="no_akta_lahir" id="input_akta_lahir" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('no_akta_lahir') }}" placeholder="Nomor akta lahir anak">
                                    @error('no_akta_lahir') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                </div>
                            </div>

                                </div>
                            </div>
                        </div>

                        <!-- SUB-FORM C: UBAH ELEMEN DATA -->
                        <div class="d-none" id="section_kk_ubah_data">
                            <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark" style="font-family: var(--font-heading); color: var(--color-forest) !important;">
                                <i data-lucide="edit-3" class="icon-sm me-2"></i>2. Data Perubahan Elemen
                            </h5>
                            <div class="row g-3 mb-5">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-muted small">NOMOR KK <span class="text-danger">*</span></label>
                                    <input type="text" name="no_kk_asal" id="input_kk_asal_ubah" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('no_kk_asal') }}" placeholder="Nomor KK" maxlength="16">
                                    @error('no_kk_asal') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-muted small">NAMA ANGGOTA KELUARGA YANG DIUBAH <span class="text-danger">*</span></label>
                                    <input type="text" name="anggota_ubah_nama" id="input_anggota_ubah" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('anggota_ubah_nama') }}" placeholder="Contoh: Budi Santoso">
                                    @error('anggota_ubah_nama') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-muted small">JENIS PERUBAHAN <span class="text-danger">*</span></label>
                                    <select name="jenis_perubahan" id="select_jenis_perubahan" class="form-select rounded-3 py-2 border-0 bg-light shadow-none">
                                        <option value="" disabled selected>Pilih Jenis Perubahan</option>
                                        <option value="Status Perkawinan" {{ old('jenis_perubahan') === 'Status Perkawinan' ? 'selected' : '' }}>Status Perkawinan</option>
                                        <option value="Pekerjaan" {{ old('jenis_perubahan') === 'Pekerjaan' ? 'selected' : '' }}>Pekerjaan</option>
                                        <option value="Pendidikan" {{ old('jenis_perubahan') === 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                                        <option value="Nama / TTL" {{ old('jenis_perubahan') === 'Nama / TTL' ? 'selected' : '' }}>Nama / TTL</option>
                                        <option value="Agama" {{ old('jenis_perubahan') === 'Agama' ? 'selected' : '' }}>Agama</option>
                                    </select>
                                    @error('jenis_perubahan') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-muted small">DATA LAMA (SEBELUM PERUBAHAN) <span class="text-danger">*</span></label>
                                    <input type="text" name="nilai_lama" id="input_nilai_lama" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('nilai_lama') }}" placeholder="Data lama">
                                    @error('nilai_lama') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-muted small">DATA BARU (SETELAH PERUBAHAN) <span class="text-danger">*</span></label>
                                    <input type="text" name="nilai_baru" id="input_nilai_baru" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('nilai_baru') }}" placeholder="Data baru">
                                    @error('nilai_baru') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                </div>
                            </div>

                                </div>
                            </div>
                        </div>

                        <!-- SUB-FORM D: PISAH KK -->
                        <div class="d-none" id="section_kk_pisah">
                            <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark" style="font-family: var(--font-heading); color: var(--color-forest) !important;">
                                <i data-lucide="split" class="icon-sm me-2"></i>2. Data Pemisahan KK
                            </h5>
                            <div class="row g-3 mb-5">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-muted small">NOMOR KK ASAL <span class="text-danger">*</span></label>
                                    <input type="text" name="no_kk_asal" id="input_kk_asal_pisah" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('no_kk_asal') }}" placeholder="Nomor KK asal" maxlength="16">
                                    @error('no_kk_asal') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-muted small">ANGGOTA KELUARGA YANG MAU DIPISAHKAN <span class="text-danger">*</span></label>
                                    <input type="text" name="anggota_terlibat[]" id="input_anggota_pisah" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="" placeholder="Contoh: Nama/NIK Anggota Terkait">
                                    <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">Masukkan nama dan NIK anggota keluarga yang memisahkan diri.</small>
                                    @error('anggota_terlibat') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-bold text-muted small">ALAMAT BARU <span class="text-danger">*</span></label>
                                    <textarea name="alamat_baru" id="input_alamat_baru_pisah" class="form-control rounded-3 border-0 bg-light shadow-none" rows="3" placeholder="Masukkan alamat lengkap tempat tinggal baru"></textarea>
                                    @error('alamat_baru') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                </div>
                            </div>

                                </div>
                            </div>
                        </div>

                        <!-- DYNAMIC UPLOAD SECTION -->
                        <div class="d-none animate-fade-in mt-4" id="section_dokumen_dinamis">
                            <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark" style="font-family: var(--font-heading); color: var(--color-forest) !important;">
                                <i data-lucide="upload-cloud" class="icon-sm me-2"></i>Upload Dokumen Pendukung
                            </h5>
                            <div class="row g-4 mb-5">
                                @if(isset($layanan) && $layanan->syarat)
                                    @foreach($layanan->syarat as $syarat)
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold text-muted small">{{ $syarat->nama_syarat }} {!! $syarat->is_required ? '<span class="text-danger">*</span>' : '' !!}</label>
                                            <input type="file" name="{{ $syarat->kode_syarat }}" class="form-control rounded-pill border-0 shadow-sm bg-white" accept="image/*,application/pdf" {{ $syarat->is_required ? 'required' : '' }}>
                                            @if($syarat->keterangan)
                                                <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">{{ $syarat->keterangan }}</small>
                                            @endif
                                            @error($syarat->kode_syarat) <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12"><div class="alert alert-warning">Data syarat dokumen belum tersedia.</div></div>
                                @endif
                            </div>
                        </div>

                        <div class="pt-4 border-top d-flex justify-content-between d-none" id="buttons_section">
                            <a href="{{ route('layanan.index') }}" class="btn btn-white border rounded-pill px-4 fw-bold">BATAL</a>
                            <button type="submit" class="btn btn-success rounded-pill px-5 fw-bold shadow-sm hover-lift border-0 text-white">
                                <i data-lucide="send" class="icon-sm me-1"></i> KIRIM PENGAJUAN
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const select = document.getElementById('jenis_layanan_select');
        const commonSec = document.getElementById('common_section');
        const secBaru = document.getElementById('section_kk_baru');
        const secTambah = document.getElementById('section_kk_tambah_anggota');
        const secUbah = document.getElementById('section_kk_ubah_data');
        const secPisah = document.getElementById('section_kk_pisah');
        const buttons = document.getElementById('buttons_section');

        const inputs = {
            kk_baru: [
                {id: 'input_nik_suami', req: true},
                {id: 'input_nama_suami', req: true},
                {id: 'input_nik_istri', req: true},
                {id: 'input_nama_istri', req: true},
                {id: 'input_kk_asal_baru', req: true},
                {id: 'input_alamat_baru_kk', req: true}
            ],
            kk_tambah_anggota: [
                {id: 'input_kk_asal_tambah', req: true},
                {id: 'input_nama_anak', req: true},
                {id: 'input_akta_lahir', req: true}
            ],
            kk_ubah_data: [
                {id: 'input_kk_asal_ubah', req: true},
                {id: 'input_anggota_ubah', req: true},
                {id: 'select_jenis_perubahan', req: true},
                {id: 'input_nilai_lama', req: true},
                {id: 'input_nilai_baru', req: true}
            ],
            kk_pisah: [
                {id: 'input_kk_asal_pisah', req: true},
                {id: 'input_anggota_pisah', req: true},
                {id: 'input_alamat_baru_pisah', req: true}
            ]
        };

        const resetRequirements = () => {
            Object.keys(inputs).forEach(key => {
                inputs[key].forEach(field => {
                    const el = document.getElementById(field.id);
                    if(el) {
                        el.removeAttribute('required');
                    }
                });
            });
        };

        const applyRequirements = (type) => {
            resetRequirements();
            if (inputs[type]) {
                inputs[type].forEach(field => {
                    const el = document.getElementById(field.id);
                    if(el && field.req) {
                        el.setAttribute('required', 'required');
                    }
                });
            }
        };

        if (select) {
            select.addEventListener('change', function () {
                const val = select.value;
                commonSec.classList.remove('d-none');
                buttons.classList.remove('d-none');
                const secDin = document.getElementById('section_dokumen_dinamis');
                if(secDin) secDin.classList.remove('d-none');

                secBaru.classList.add('d-none');
                secTambah.classList.add('d-none');
                secUbah.classList.add('d-none');
                secPisah.classList.add('d-none');

                if (val === 'kk_baru') {
                    secBaru.classList.remove('d-none');
                } else if (val === 'kk_tambah_anggota') {
                    secTambah.classList.remove('d-none');
                } else if (val === 'kk_ubah_data') {
                    secUbah.classList.remove('d-none');
                } else if (val === 'kk_pisah') {
                    secPisah.classList.remove('d-none');
                }
                applyRequirements(val);
            });

            // Trigger on page load if old value exists
            if (select.value) {
                select.dispatchEvent(new Event('change'));
            }
        }
    });
</script>
@endpush
@endsection
