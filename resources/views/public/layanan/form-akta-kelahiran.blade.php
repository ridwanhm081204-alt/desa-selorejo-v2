@extends('layouts.public')
@section('title', 'Form Pengajuan Akta Kelahiran')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('layanan.index') }}" class="text-decoration-none text-success">Layanan Administrasi</a></li>
    <li class="breadcrumb-item active">Form Akta Kelahiran</li>
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
                    <div class="p-2 rounded-3 me-3 text-white" style="background-color: #2AABE2;">
                        <i data-lucide="baby" class="icon-sm"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0 text-dark" style="font-family: var(--font-heading);">Form Pengajuan Akta Kelahiran</h4>
                        <small class="text-muted">Isi data anak, orang tua, saksi, dan upload dokumen persyaratan</small>
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
                        <input type="hidden" name="jenis_layanan" value="akta_kelahiran">

                        <!-- SECTION 1: DATA PEMOHON -->
                        <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark" style="font-family: var(--font-heading); color: #2AABE2 !important;">
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
                                <input type="text" name="nama_pemohon" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('nama_pemohon') }}" placeholder="Masukkan nama pemohon" required>
                                @error('nama_pemohon') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">NOMOR WHATSAPP AKTIF <span class="text-danger">*</span></label>
                                <input type="text" name="no_hp_pemohon" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('no_hp_pemohon') }}" placeholder="Contoh: 08123456789" required>
                                <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">Digunakan untuk mengirimkan link update notifikasi progres pengajuan dokumen.</small>
                                @error('no_hp_pemohon') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">EMAIL PEMOHON (OPSIONAL)</label>
                                <input type="email" name="email_pemohon" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('email_pemohon') }}" placeholder="email@domain.com">
                                @error('email_pemohon') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- SECTION 2: DATA ANAK -->
                        <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark" style="font-family: var(--font-heading); color: #2AABE2 !important;">
                            <i data-lucide="baby" class="icon-sm me-2"></i>2. Data Anak
                        </h5>
                        <div class="row g-3 mb-5">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">NAMA LENGKAP ANAK <span class="text-danger">*</span></label>
                                <input type="text" name="nama_anak" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('nama_anak') }}" placeholder="Masukkan nama lengkap anak" required>
                                @error('nama_anak') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">TEMPAT LAHIR <span class="text-danger">*</span></label>
                                <input type="text" name="tempat_lahir_anak" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('tempat_lahir_anak') }}" placeholder="Contoh: Malang" required>
                                @error('tempat_lahir_anak') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-muted small">TANGGAL LAHIR <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_lahir_anak" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('tanggal_lahir_anak') }}" required>
                                @error('tanggal_lahir_anak') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-muted small">JAM LAHIR (OPSIONAL)</label>
                                <input type="time" name="jam_lahir_anak" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('jam_lahir_anak') }}">
                                @error('jam_lahir_anak') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-muted small">JENIS KELAMIN <span class="text-danger">*</span></label>
                                <select name="jenis_kelamin_anak" class="form-select rounded-3 py-2 border-0 bg-light shadow-none" required>
                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="L" {{ old('jenis_kelamin_anak') === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin_anak') === 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin_anak') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-muted small">ANAK KE- (ANGKA) <span class="text-danger">*</span></label>
                                <input type="number" name="anak_ke" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('anak_ke') }}" min="1" placeholder="1" required>
                                @error('anak_ke') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-muted small">BERAT LAHIR (KG/GRAM, OPSIONAL)</label>
                                <input type="number" step="0.01" name="berat_lahir" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('berat_lahir') }}" placeholder="Contoh: 3.2">
                                @error('berat_lahir') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-muted small">PANJANG LAHIR (CM, OPSIONAL)</label>
                                <input type="number" step="0.01" name="panjang_lahir" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('panjang_lahir') }}" placeholder="Contoh: 48">
                                @error('panjang_lahir') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">PENERBIT SURAT KETERANGAN LAHIR <span class="text-danger">*</span></label>
                                <select name="tempat_penerbit_surat_lahir" id="tempat_penerbit_surat_lahir" class="form-select rounded-3 py-2 border-0 bg-light shadow-none" required>
                                    <option value="" disabled selected>Pilih Instansi Penerbit</option>
                                    <option value="rs" {{ old('tempat_penerbit_surat_lahir') === 'rs' ? 'selected' : '' }}>Rumah Sakit (RS)</option>
                                    <option value="puskesmas" {{ old('tempat_penerbit_surat_lahir') === 'puskesmas' ? 'selected' : '' }}>Puskesmas</option>
                                    <option value="bidan" {{ old('tempat_penerbit_surat_lahir') === 'bidan' ? 'selected' : '' }}>Bidan Mandiri</option>
                                    <option value="kepala_desa" {{ old('tempat_penerbit_surat_lahir') === 'kepala_desa' ? 'selected' : '' }}>Kepala Desa / Lurah sendiri</option>
                                </select>
                                @error('tempat_penerbit_surat_lahir') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-12 d-none animate-fade-in" id="desa_note_container">
                                <div class="p-3 rounded-3 alert alert-warning d-flex align-items-center mb-0">
                                    <i data-lucide="info" class="me-3 flex-shrink-0 text-warning" style="width: 24px; height: 24px;"></i>
                                    <small class="text-dark" style="font-size: 0.8rem;">
                                        <strong>Catatan Penting:</strong> Karena anak lahir di luar fasilitas kesehatan, surat keterangan lahir akan diterbitkan oleh Kepala Desa Selorejo terlebih dahulu. Admin desa akan mengonfirmasi via WhatsApp.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 3: DATA ORANG TUA -->
                        <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark" style="font-family: var(--font-heading); color: #2AABE2 !important;">
                            <i data-lucide="heart" class="icon-sm me-2"></i>3. Data Orang Tua
                        </h5>
                        <div class="row g-3 mb-5">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">NIK AYAH (16 DIGIT) <span class="text-danger">*</span></label>
                                <input type="text" name="nik_ayah" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('nik_ayah') }}" placeholder="Contoh: 3507xxxxxxxxxxxx" required maxlength="16">
                                @error('nik_ayah') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">NIK IBU (16 DIGIT) <span class="text-danger">*</span></label>
                                <input type="text" name="nik_ibu" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('nik_ibu') }}" placeholder="Contoh: 3507xxxxxxxxxxxx" required maxlength="16">
                                @error('nik_ibu') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">NOMOR KARTU KELUARGA (KK) ORANG TUA <span class="text-danger">*</span></label>
                                <input type="text" name="no_kk_orangtua" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('no_kk_orangtua') }}" placeholder="Contoh: 3507xxxxxxxxxxxx" required maxlength="16">
                                @error('no_kk_orangtua') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- SECTION 4: DATA SAKSI -->
                        <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark" style="font-family: var(--font-heading); color: #2AABE2 !important;">
                            <i data-lucide="shield-check" class="icon-sm me-2"></i>4. Data Saksi (2 Orang)
                        </h5>
                        <div class="row g-3 mb-5">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">NAMA SAKSI 1 <span class="text-danger">*</span></label>
                                <input type="text" name="nama_saksi1" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('nama_saksi1') }}" placeholder="Masukkan nama saksi 1" required>
                                @error('nama_saksi1') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">NIK SAKSI 1 (16 DIGIT) <span class="text-danger">*</span></label>
                                <input type="text" name="nik_saksi1" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('nik_saksi1') }}" placeholder="Contoh: 3507xxxxxxxxxxxx" required maxlength="16">
                                @error('nik_saksi1') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">NAMA SAKSI 2 <span class="text-danger">*</span></label>
                                <input type="text" name="nama_saksi2" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('nama_saksi2') }}" placeholder="Masukkan nama saksi 2" required>
                                @error('nama_saksi2') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">NIK SAKSI 2 (16 DIGIT) <span class="text-danger">*</span></label>
                                <input type="text" name="nik_saksi2" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('nik_saksi2') }}" placeholder="Contoh: 3507xxxxxxxxxxxx" required maxlength="16">
                                @error('nik_saksi2') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- SECTION 5: UPLOAD DOKUMEN -->
                        <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark" style="font-family: var(--font-heading); color: #2AABE2 !important;">
                            <i data-lucide="upload-cloud" class="icon-sm me-2"></i>5. Upload Dokumen Pendukung
                        </h5>
                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">SURAT KETERANGAN LAHIR <span class="text-danger">*</span></label>
                                <input type="file" name="file_surat_lahir" class="form-control rounded-pill border-0 shadow-sm bg-white" accept="image/*,application/pdf" required>
                                <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">Dari RS/Puskesmas/Bidan/Desa. Format: PDF, JPG, PNG (Max 2MB)</small>
                                @error('file_surat_lahir') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">SCAN KK ORANG TUA <span class="text-danger">*</span></label>
                                <input type="file" name="file_kk_ortu" class="form-control rounded-pill border-0 shadow-sm bg-white" accept="image/*,application/pdf" required>
                                <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">Kartu Keluarga asli orang tua. Format: PDF, JPG, PNG (Max 2MB)</small>
                                @error('file_kk_ortu') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">SCAN KTP ORANG TUA (JADI SATU FILE) <span class="text-danger">*</span></label>
                                <input type="file" name="file_ktp_ortu" class="form-control rounded-pill border-0 shadow-sm bg-white" accept="image/*,application/pdf" required>
                                <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">Scan KTP asli Ayah & Ibu dijadikan satu. Format: PDF, JPG, PNG (Max 2MB)</small>
                                @error('file_ktp_ortu') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">SCAN AKTA NIKAH ORANG TUA / SPTJM <span class="text-danger">*</span></label>
                                <input type="file" name="file_akta_nikah" class="form-control rounded-pill border-0 shadow-sm bg-white" accept="image/*,application/pdf" required>
                                <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">Akta nikah resmi / surat pernyataan tanggung jawab mutlak. Format: PDF, JPG, PNG (Max 2MB)</small>
                                @error('file_akta_nikah') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">SCAN KTP 2 SAKSI (JADI SATU FILE) <span class="text-danger">*</span></label>
                                <input type="file" name="file_ktp_saksi" class="form-control rounded-pill border-0 shadow-sm bg-white" accept="image/*,application/pdf" required>
                                <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">Scan KTP asli saksi 1 & saksi 2 dijadikan satu. Format: PDF, JPG, PNG (Max 2MB)</small>
                                @error('file_ktp_saksi') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="pt-4 border-top d-flex justify-content-between">
                            <a href="{{ route('layanan.index') }}" class="btn btn-white border rounded-pill px-4 fw-bold">BATAL</a>
                            <button type="submit" class="btn btn-info rounded-pill px-5 fw-bold shadow-sm hover-lift border-0 text-white">
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
        const issuerSelect = document.getElementById('tempat_penerbit_surat_lahir');
        const noteContainer = document.getElementById('desa_note_container');

        if(issuerSelect && noteContainer) {
            const toggleNote = () => {
                if (issuerSelect.value === 'kepala_desa') {
                    noteContainer.classList.remove('d-none');
                } else {
                    noteContainer.classList.add('d-none');
                }
            };
            issuerSelect.addEventListener('change', toggleNote);
            toggleNote();
        }
    });
</script>
@endpush
@endsection
