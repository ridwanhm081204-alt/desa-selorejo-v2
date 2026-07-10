@extends('layouts.public')
@section('title', 'Cek Status Pengajuan Layanan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('layanan.index') }}" class="text-decoration-none text-success">Layanan Administrasi</a></li>
    <li class="breadcrumb-item active">Cek Status</li>
@endsection
@section('content')
<div class="container mb-5 pb-5 mt-5">
    <div class="row justify-content-center text-start">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                <div class="card-header bg-success bg-opacity-10 text-success border-0 p-4 text-center border-bottom">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success text-white mb-3" style="width: 60px; height: 60px;">
                        <i data-lucide="search" style="width: 28px; height: 28px;"></i>
                    </div>
                    <h4 class="fw-bold mb-0 text-dark" style="font-family: var(--font-heading);">Cek Status Pengajuan</h4>
                    <p class="text-muted small mb-0 mt-1">Masukkan Nomor Tiket atau NIK Pemohon</p>
                </div>
                <div class="card-body p-4 p-md-5">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('layanan.hasil-status') }}" method="GET">
                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted small">NOMOR TIKET ATAU NIK PEMOHON</label>
                            <input type="text" name="query_status" class="form-control form-control-lg rounded-pill px-4 border bg-light shadow-none text-center fw-bold text-success" placeholder="DES-2026-XXXXX / 3507xxxxxxxxxxxx" required value="{{ request('query_status') }}">
                            <small class="text-muted d-block mt-2 text-center" style="font-size: 0.75rem;">Contoh tiket: <strong>DES-2026-00001</strong></small>
                        </div>
                        <button type="submit" class="btn btn-success w-100 rounded-pill py-3 fw-bold shadow-sm hover-lift border-0 text-white" style="font-family: var(--font-heading);">
                            <i data-lucide="search" class="icon-sm me-1"></i> LACAK PENGIRIMAN
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
