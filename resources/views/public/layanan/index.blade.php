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
        @foreach($layananKonten as $lk)
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden hover-lift bg-white">
                <div class="p-4 text-center" style="background: {{ $lk->warna_hex }}10;">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 shadow-sm" style="width: 70px; height: 70px; background: {{ $lk->warna_hex }}; color: #fff;">
                        <i data-lucide="{{ $lk->icon_name }}" style="width: 32px; height: 32px;"></i>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark" style="font-family: var(--font-heading);">{{ $lk->nama }}</h5>
                </div>
                <div class="card-body p-4 d-flex flex-column text-center">
                    <p class="text-muted small flex-grow-1" style="font-family: var(--font-body);">{{ $lk->deskripsi }}</p>
                    @if($lk->route_name && \Illuminate\Support\Facades\Route::has($lk->route_name))
                        <a href="{{ route($lk->route_name) }}" class="btn btn-sm rounded-pill py-2 w-100 fw-bold" style="background-color: {{ $lk->warna_hex }}; color: #fff; border: none; font-family: var(--font-heading);">Pilih Layanan</a>
                    @else
                        <a href="#" class="btn btn-sm rounded-pill py-2 w-100 fw-bold" style="background-color: {{ $lk->warna_hex }}; color: #fff; border: none; font-family: var(--font-heading);">Pilih Layanan</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
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
