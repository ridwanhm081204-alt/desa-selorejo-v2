@extends('layouts.public')
@section('title', 'Form Pengajuan Akta Kematian')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('layanan.index') }}" class="text-decoration-none text-success">Layanan Administrasi</a></li>
    <li class="breadcrumb-item active">Form Akta Kematian</li>
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
                    <div class="p-2 rounded-3 me-3 text-white shadow-sm" style="background-color: #D93025;">
                        <i data-lucide="heart-off" class="icon-sm"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0 text-dark" style="font-family: var(--font-heading);">Form Pengajuan Akta Kematian</h4>
                        <small class="text-muted">Laporkan kematian warga untuk penerbitan surat akta kematian resmi</small>
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
                        <input type="hidden" name="jenis_layanan" value="akta_kematian">

                        <!-- SECTION 1: DATA PEMOHON -->
                        <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark" style="font-family: var(--font-heading); color: #D93025 !important;">
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
                                <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">Untuk info/notifikasi progres pengajuan dokumen.</small>
                                @error('no_hp_pemohon') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">EMAIL PEMOHON (OPSIONAL)</label>
                                <input type="email" name="email_pemohon" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('email_pemohon') }}" placeholder="email@domain.com">
                                @error('email_pemohon') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- SECTION 2: DATA ALMARHUM -->
                        <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark" style="font-family: var(--font-heading); color: #D93025 !important;">
                            <i data-lucide="skull" class="icon-sm me-2"></i>2. Data Almarhum/Almarhumah
                        </h5>
                        <div class="row g-3 mb-5">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">NIK ALMARHUM <span class="text-danger">*</span></label>
                                <input type="text" name="nik_almarhum" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('nik_almarhum') }}" placeholder="Contoh: 3507xxxxxxxxxxxx" required maxlength="16">
                                @error('nik_almarhum') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">NAMA LENGKAP ALMARHUM <span class="text-danger">*</span></label>
                                <input type="text" name="nama_almarhum" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('nama_almarhum') }}" placeholder="Masukkan nama almarhum" required>
                                @error('nama_almarhum') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">TEMPAT LAHIR ALMARHUM <span class="text-danger">*</span></label>
                                <input type="text" name="tempat_lahir_almarhum" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('tempat_lahir_almarhum') }}" placeholder="Contoh: Malang" required>
                                @error('tempat_lahir_almarhum') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">TANGGAL LAHIR ALMARHUM <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_lahir_almarhum" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('tanggal_lahir_almarhum') }}" required>
                                @error('tanggal_lahir_almarhum') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">TEMPAT MENINGGAL <span class="text-danger">*</span></label>
                                <input type="text" name="tempat_meninggal" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('tempat_meninggal') }}" placeholder="Contoh: Rumah Sakit / Rumah Duka" required>
                                @error('tempat_meninggal') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">TANGGAL MENINGGAL <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_meninggal" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('tanggal_meninggal') }}" required>
                                @error('tanggal_meninggal') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold text-muted small">SEBAB KEMATIAN <span class="text-danger">*</span></label>
                                <input type="text" name="sebab_kematian" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('sebab_kematian') }}" placeholder="Sakit, Kecelakaan, Lanjut Usia, dll" required>
                                @error('sebab_kematian') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-12">
                                <div class="form-check form-switch bg-light p-3 rounded-3 ps-5">
                                    <input class="form-check-input" type="checkbox" name="identitas_jelas" id="identitas_jelas" value="0" {{ old('identitas_jelas') === '0' ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold text-dark" for="identitas_jelas">Identitas Jenazah Tidak Jelas (Membutuhkan Surat Kepolisian)</label>
                                    <span class="d-block text-muted small">Centang jika jenazah tidak memiliki identitas jelas (contoh: kecelakaan tanpa identitas, hanyut, dll).</span>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 3: DATA PELAPOR -->
                        <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark" style="font-family: var(--font-heading); color: #D93025 !important;">
                            <i data-lucide="users-2" class="icon-sm me-2"></i>3. Data Pelapor
                        </h5>
                        <div class="row g-3 mb-5">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">NAMA LENGKAP PELAPOR <span class="text-danger">*</span></label>
                                <input type="text" name="nama_pelapor" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('nama_pelapor') }}" placeholder="Nama pelapor" required>
                                @error('nama_pelapor') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-muted small">NIK PELAPOR <span class="text-danger">*</span></label>
                                <input type="text" name="nik_pelapor" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('nik_pelapor') }}" placeholder="NIK pelapor" required maxlength="16">
                                @error('nik_pelapor') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-bold text-muted small">HUBUNGAN DENGAN ALMARHUM <span class="text-danger">*</span></label>
                                <select name="hubungan_pelapor" class="form-select rounded-3 py-2 border-0 bg-light shadow-none" required>
                                    <option value="" disabled selected>Pilih Hubungan</option>
                                    <option value="Suami" {{ old('hubungan_pelapor') === 'Suami' ? 'selected' : '' }}>Suami</option>
                                    <option value="Istri" {{ old('hubungan_pelapor') === 'Istri' ? 'selected' : '' }}>Istri</option>
                                    <option value="Anak" {{ old('hubungan_pelapor') === 'Anak' ? 'selected' : '' }}>Anak</option>
                                    <option value="Orang Tua" {{ old('hubungan_pelapor') === 'Orang Tua' ? 'selected' : '' }}>Orang Tua</option>
                                    <option value="Saudara" {{ old('hubungan_pelapor') === 'Saudara' ? 'selected' : '' }}>Saudara</option>
                                    <option value="Lainnya" {{ old('hubungan_pelapor') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('hubungan_pelapor') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- SECTION 4: UPLOAD DOKUMEN -->
                        <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark" style="font-family: var(--font-heading); color: #D93025 !important;">
                            <i data-lucide="upload-cloud" class="icon-sm me-2"></i>4. Upload Dokumen Pendukung
                        </h5>
                        <div class="row g-4 mb-5">
                            @if(isset($layanan) && $layanan->syarat)
                                @foreach($layanan->syarat as $syarat)
                                    @php
                                        $isPolisi = $syarat->kode_syarat === 'file_surat_kepolisian';
                                    @endphp
                                    <div class="{{ $isPolisi ? 'col-md-12 d-none animate-fade-in' : 'col-md-6' }}" {!! $isPolisi ? 'id="file_polisi_container"' : '' !!}>
                                        <label class="form-label fw-bold text-muted small">{{ $syarat->nama_syarat }} {!! $syarat->is_required ? '<span class="text-danger">*</span>' : '' !!}</label>
                                        <input type="file" name="{{ $syarat->kode_syarat }}" {!! $isPolisi ? 'id="file_surat_kepolisian"' : '' !!} class="form-control rounded-pill border-0 shadow-sm bg-white" accept="image/*,application/pdf" {{ $syarat->is_required ? 'required' : '' }}>
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

                        <div class="pt-4 border-top d-flex justify-content-between">
                            <a href="{{ route('layanan.index') }}" class="btn btn-white border rounded-pill px-4 fw-bold">BATAL</a>
                            <button type="submit" class="btn btn-danger rounded-pill px-5 fw-bold shadow-sm hover-lift border-0">
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
        const checkIdentitas = document.getElementById('identitas_jelas');
        const container = document.getElementById('file_polisi_container');
        const inputPolisi = document.getElementById('file_surat_kepolisian');

        if(checkIdentitas && container) {
            const togglePolisi = () => {
                if (checkIdentitas.checked) {
                    container.classList.remove('d-none');
                    inputPolisi.setAttribute('required', 'required');
                } else {
                    container.classList.add('d-none');
                    inputPolisi.removeAttribute('required');
                }
            };
            checkIdentitas.addEventListener('change', togglePolisi);
            togglePolisi();
        }
    });
</script>
@endpush
@endsection
