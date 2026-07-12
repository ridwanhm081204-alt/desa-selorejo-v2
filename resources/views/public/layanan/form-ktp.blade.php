@extends('layouts.public')
@section('title', 'Form Pengajuan KTP-el')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('layanan.index') }}" class="text-decoration-none text-success">Layanan Administrasi</a></li>
    <li class="breadcrumb-item active">Form KTP-el</li>
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
                    <div class="p-2 rounded-3 me-3 text-dark shadow-sm" style="background-color: var(--color-sunshine);">
                        <i data-lucide="contact" class="icon-sm"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0 text-dark" style="font-family: var(--font-heading);">Form Pengajuan KTP-el</h4>
                        <small class="text-muted">Layanan pendaftaran antrean perekaman KTP-el baru, rusak, atau hilang</small>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert" style="font-family: var(--font-body);">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="alert alert-warning d-flex align-items-center mb-4 rounded-3 p-3">
                        <i data-lucide="info" class="me-3 text-warning flex-shrink-0" style="width: 24px; height: 24px;"></i>
                        <small class="text-dark">
                            <strong>Pemberitahuan:</strong> Penerbitan KTP-el membutuhkan perekaman data biometrik secara langsung (iris mata, sidik jari, foto wajah). Form online ini digunakan untuk pendaftaran antrean berkas dan jadwal kedatangan perekaman/pengambilan, bukan penyelesaian online penuh.
                        </small>
                    </div>

                    <form action="{{ route('layanan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="jenis_layanan" id="jenis_layanan_input" value="ktp_baru">

                        <!-- SECTION 1: DATA PEMOHON -->
                        <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark" style="font-family: var(--font-heading); color: var(--color-sunshine) !important;">
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
                                <input type="text" name="nama_pemohon" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('nama_pemohon') }}" placeholder="Masukkan nama lengkap pemohon" required>
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
                        </div>

                        <!-- SECTION 2: DATA KTP-EL -->
                        <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark" style="font-family: var(--font-heading); color: var(--color-sunshine) !important;">
                            <i data-lucide="contact" class="icon-sm me-2"></i>2. Informasi Pengajuan KTP-el
                        </h5>
                        <div class="row g-3 mb-5">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">JENIS PENGAJUAN <span class="text-danger">*</span></label>
                                <select name="jenis_pengajuan_ktp" id="jenis_pengajuan_ktp" class="form-select rounded-3 py-2 border-0 bg-light shadow-none" required>
                                    <option value="" disabled selected>Pilih Jenis Pengajuan</option>
                                    <option value="baru_17tahun" {{ old('jenis_pengajuan_ktp') === 'baru_17tahun' ? 'selected' : '' }}>KTP-el Baru / Pertama Kali (Usia 17 Tahun)</option>
                                    <option value="rusak" {{ old('jenis_pengajuan_ktp') === 'rusak' ? 'selected' : '' }}>KTP-el Rusak (Minta Cetak Ulang)</option>
                                    <option value="hilang" {{ old('jenis_pengajuan_ktp') === 'hilang' ? 'selected' : '' }}>KTP-el Hilang</option>
                                    <option value="ubah_data" {{ old('jenis_pengajuan_ktp') === 'ubah_data' ? 'selected' : '' }}>Perubahan Data KTP-el</option>
                                </select>
                                @error('jenis_pengajuan_ktp') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 d-none animate-fade-in" id="surat_kehilangan_text_container">
                                <label class="form-label fw-bold text-muted small">NOMOR SURAT KEHILANGAN POLISI <span class="text-danger">*</span></label>
                                <input type="text" name="no_surat_kehilangan" id="no_surat_kehilangan" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('no_surat_kehilangan') }}" placeholder="Contoh: LP/H/123/X/2026/Polres">
                                @error('no_surat_kehilangan') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">Rencana Kedatangan untuk Perekaman/Pengambilan Sidik Jari (Opsional)</label>
                                <input type="datetime-local" name="jadwal_perekaman" id="jadwal_perekaman" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('jadwal_perekaman') }}">
                                <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">Pilih hari kerja (Senin - Jumat, jam 08.00 - 14.00) agar admin bisa menjadwalkan kedatangan Anda.</small>
                                <div class="text-danger mt-1 small" id="jadwal_perekaman_error" style="display: none; font-weight: bold;"></div>
                                @error('jadwal_perekaman') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- SECTION 3: UPLOAD DOKUMEN -->
                        <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark" style="font-family: var(--font-heading); color: var(--color-sunshine) !important;">
                            <i data-lucide="upload-cloud" class="icon-sm me-2"></i>3. Upload Dokumen Pendukung
                        </h5>
                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">SCAN KARTU KELUARGA (KK) <span class="text-danger">*</span></label>
                                <input type="file" name="file_kk_pemohon" class="form-control rounded-pill border-0 shadow-sm bg-white" accept="image/*,application/pdf" required>
                                <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">Scan KK asli pemohon. Format: PDF, JPG, PNG (Max 2MB)</small>
                                @error('file_kk_pemohon') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 d-none animate-fade-in" id="surat_kehilangan_file_container">
                                <label class="form-label fw-bold text-muted small">SCAN SURAT KEHILANGAN DARI KEPOLISIAN <span class="text-danger">*</span></label>
                                <input type="file" name="file_surat_kehilangan" id="file_surat_kehilangan" class="form-control rounded-pill border-0 shadow-sm bg-white" accept="image/*,application/pdf">
                                <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">Scan surat laporan kehilangan asli. Format: PDF, JPG, PNG (Max 2MB)</small>
                                @error('file_surat_kehilangan') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="pt-4 border-top d-flex justify-content-between">
                            <a href="{{ route('layanan.index') }}" class="btn btn-white border rounded-pill px-4 fw-bold">BATAL</a>
                            <button type="submit" class="btn btn-warning rounded-pill px-5 fw-bold shadow-sm hover-lift border-0">
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
        const typeSelect = document.getElementById('jenis_ajuan_ktp_container'); // wait, let's look at element id
        const select = document.getElementById('jenis_pengajuan_ktp');
        const textContainer = document.getElementById('surat_kehilangan_text_container');
        const fileContainer = document.getElementById('surat_kehilangan_file_container');
        const textInput = document.getElementById('no_surat_kehilangan');
        const fileInput = document.getElementById('file_surat_kehilangan');
        const jenisLayananInput = document.getElementById('jenis_layanan_input');

        if(select) {
            const toggleKehilangan = () => {
                const val = select.value;
                
                // Map the hidden jenis_layanan input dynamically
                if (val === 'baru_17tahun') {
                    jenisLayananInput.value = 'ktp_baru';
                } else if (val === 'rusak') {
                    jenisLayananInput.value = 'ktp_ganti'; // wait, matched to enum in migration
                } else if (val === 'hilang') {
                    jenisLayananInput.value = 'ktp_ganti';
                } else if (val === 'ubah_data') {
                    jenisLayananInput.value = 'ktp_ganti';
                }

                if (val === 'hilang') {
                    textContainer.classList.remove('d-none');
                    fileContainer.classList.remove('d-none');
                    textInput.setAttribute('required', 'required');
                    fileInput.setAttribute('required', 'required');
                } else {
                    textContainer.classList.add('d-none');
                    fileContainer.classList.add('d-none');
                    textInput.removeAttribute('required');
                    fileInput.removeAttribute('required');
                }
            };

            select.addEventListener('change', toggleKehilangan);
            toggleKehilangan();
        }

        const inputJadwal = document.getElementById('jadwal_perekaman');
        const errorJadwal = document.getElementById('jadwal_perekaman_error');

        if (inputJadwal && errorJadwal) {
            inputJadwal.addEventListener('change', function () {
                const val = this.value;
                if (!val) {
                    errorJadwal.style.display = 'none';
                    return;
                }

                const date = new Date(val);
                const day = date.getDay(); // 0 is Sunday, 6 is Saturday
                const hour = date.getHours();
                const minutes = date.getMinutes();

                let isValid = true;
                let errorMsg = '';

                if (day === 0 || day === 6) {
                    isValid = false;
                    errorMsg = 'Jadwal kedatangan hanya bisa dipilih untuk hari kerja (Senin - Jumat).';
                } else if (hour < 8 || hour > 14 || (hour === 14 && minutes > 0)) {
                    isValid = false;
                    errorMsg = 'Jadwal kedatangan hanya bisa dipilih antara jam 08.00 - 14.00.';
                }

                if (!isValid) {
                    errorJadwal.innerText = errorMsg;
                    errorJadwal.style.display = 'block';
                    this.value = '';
                } else {
                    errorJadwal.style.display = 'none';
                }
            });
        }
    });
</script>
@endpush
@endsection
