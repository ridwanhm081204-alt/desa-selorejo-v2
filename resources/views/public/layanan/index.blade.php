@extends('layouts.public')
@section('title', 'Sistem Layanan Administrasi Desa')
@section('breadcrumb')
    <li class="breadcrumb-item active">Layanan Administrasi</li>
@endsection
@section('content')
@include('layouts.partials.page-hero', [
    'title' => 'Sistem Pelayanan Administrasi Desa',
    'subtitle' => 'Ajukan permohonan dokumen kependudukan secara online dengan mudah, cepat, dan transparan',
    'icon' => 'file-text'
])

<div class="container mb-5 pb-5">
    <div class="row g-4 justify-content-center">
        <!-- 1. Akta Kelahiran -->
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden hover-lift bg-white">
                <div class="p-4 text-center" style="background: rgba(42, 171, 226, 0.05);">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 shadow-sm" style="width: 70px; height: 70px; background: #2AABE2; color: #fff;">
                        <i data-lucide="baby" style="width: 32px; height: 32px;"></i>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark" style="font-family: var(--font-heading);">Akta Kelahiran</h5>
                </div>
                <div class="card-body p-4 d-flex flex-column text-center">
                    <p class="text-muted small flex-grow-1" style="font-family: var(--font-body);">Pengajuan penerbitan Akta Kelahiran baru bagi anak yang lahir di dalam maupun di luar faskes.</p>
                    <a href="{{ route('layanan.akta-kelahiran') }}" class="btn btn-sm rounded-pill py-2 w-100 fw-bold" style="background-color: #2AABE2; color: #fff; border: none; font-family: var(--font-heading);">Pilih Layanan</a>
                </div>
            </div>
        </div>

        <!-- 2. Akta Kematian -->
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden hover-lift bg-white">
                <div class="p-4 text-center" style="background: rgba(219, 48, 37, 0.05);">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 shadow-sm" style="width: 70px; height: 70px; background: #D93025; color: #fff;">
                        <i data-lucide="heart-off" style="width: 32px; height: 32px;"></i>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark" style="font-family: var(--font-heading);">Akta Kematian</h5>
                </div>
                <div class="card-body p-4 d-flex flex-column text-center">
                    <p class="text-muted small flex-grow-1" style="font-family: var(--font-body);">Layanan pelaporan kematian warga untuk penerbitan surat akta kematian resmi dari Disdukcapil.</p>
                    <a href="{{ route('layanan.akta-kematian') }}" class="btn btn-sm rounded-pill py-2 w-100 fw-bold" style="background-color: #D93025; color: #fff; border: none; font-family: var(--font-heading);">Pilih Layanan</a>
                </div>
            </div>
        </div>

        <!-- 3. Kartu Keluarga (KK) -->
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden hover-lift bg-white">
                <div class="p-4 text-center" style="background: rgba(26, 92, 56, 0.05);">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 shadow-sm" style="width: 70px; height: 70px; background: var(--color-forest); color: #fff;">
                        <i data-lucide="users" style="width: 32px; height: 32px;"></i>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark" style="font-family: var(--font-heading);">Kartu Keluarga</h5>
                </div>
                <div class="card-body p-4 d-flex flex-column text-center">
                    <p class="text-muted small flex-grow-1" style="font-family: var(--font-body);">Pengajuan KK baru (pernikahan), penambahan anggota (kelahiran), perubahan elemen data, atau pisah KK.</p>
                    <a href="{{ route('layanan.kk') }}" class="btn btn-sm rounded-pill py-2 w-100 fw-bold" style="background-color: var(--color-forest); color: #fff; border: none; font-family: var(--font-heading);">Pilih Layanan</a>
                </div>
            </div>
        </div>

        <!-- 4. KTP-el -->
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden hover-lift bg-white">
                <div class="p-4 text-center" style="background: rgba(245, 197, 24, 0.05);">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 shadow-sm" style="width: 70px; height: 70px; background: var(--color-sunshine); color: var(--color-dark);">
                        <i data-lucide="contact" style="width: 32px; height: 32px;"></i>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark" style="font-family: var(--font-heading);">KTP-el</h5>
                </div>
                <div class="card-body p-4 d-flex flex-column text-center">
                    <p class="text-muted small flex-grow-1" style="font-family: var(--font-body);">Layanan pengajuan KTP-el baru usia 17 tahun, penggantian KTP rusak/hilang, dan penjadwalan biometrik.</p>
                    <a href="{{ route('layanan.ktp') }}" class="btn btn-sm rounded-pill py-2 w-100 fw-bold" style="background-color: var(--color-sunshine); color: var(--color-dark); border: none; font-family: var(--font-heading);">Pilih Layanan</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Cek Status Section -->
    <div class="row mt-5 pt-3">
        <div class="col-md-8 mx-auto">
            <div class="card border-0 shadow-sm rounded-4 p-5 bg-white text-center">
                <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle mb-3" style="width: 60px; height: 60px;">
                    <i data-lucide="search" class="text-success" style="width: 28px; height: 28px;"></i>
                </div>
                <h4 class="fw-bold mb-2 text-dark" style="font-family: var(--font-heading);">Sudah mengajukan dokumen sebelumnya?</h4>
                <p class="text-muted mb-4 small" style="font-family: var(--font-body);">Anda bisa memantau perkembangan/status dokumen Anda dengan memasukkan nomor tiket atau NIK Anda.</p>
                <div>
                    <a href="{{ route('layanan.cek-status') }}" class="btn rounded-pill px-5 fw-bold hover-lift btn-outline-forest" style="font-family: var(--font-heading);">Cek Progres Pengajuan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
