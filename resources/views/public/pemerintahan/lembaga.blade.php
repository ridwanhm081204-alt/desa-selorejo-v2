@extends('layouts.public')
@section('title', 'Lembaga Desa')
@section('breadcrumb')
    <li class="breadcrumb-item">Pemerintahan</li>
    <li class="breadcrumb-item active">Lembaga Desa</li>
@endsection
@section('content')
@include('layouts.partials.page-hero', [
    'title' => 'Lembaga Desa',
    'subtitle' => 'Lembaga Kemasyarakatan Pendukung Pembangunan Desa',
    'icon' => 'building-2'
])

<div class="container mb-5 pb-5">
    <div class="row g-4">
        @forelse($lembaga as $l)
        <div class="col-lg-6">
            <div class="glass-card card-hover bg-white p-4 p-md-5 rounded-4 border-0 shadow-sm h-100 d-flex flex-column border border-success border-opacity-10" style="background: white;">
                <div class="d-flex justify-content-between align-items-start border-bottom border-success border-opacity-10 pb-4 mb-4">
                    <h4 class="fw-bold text-dark mb-0 d-flex align-items-center">
                        <i data-lucide="shield-check" class="icon-md me-3 text-dark"></i>{{ $l->nama_lembaga }}
                    </h4>
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold border border-warning shadow-sm" style="font-size: 0.7rem;">{{ $l->jenis }}</span>
                </div>
                <div class="mb-4 flex-grow-1">
                    <p class="text-muted small lh-lg mb-0 text-justify" style="text-align: justify; font-size: 0.95rem;">{{ $l->deskripsi ?: 'Lembaga kemasyarakatan yang berperan aktif dalam mendukung program pembangunan dan pemberdayaan masyarakat di lingkungan Desa Selorejo.' }}</p>
                </div>
                <div class="mt-auto p-4 rounded-4 d-flex align-items-center w-100 border border-success border-opacity-10 bg-light">
                    <div class="bg-success bg-opacity-10 rounded-circle p-2 shadow-sm me-3 border border-success border-opacity-10 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i data-lucide="user-check" class="text-dark icon-sm"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block lh-1 mb-2 fw-bold">Ketua Lembaga</small>
                        <strong class="text-dark fs-5">{{ $l->ketua ?: 'Belum ditentukan' }}</strong>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted p-5 glass-panel">Belum ada data Lembaga Desa.</div>
        @endforelse
    </div>
</div>
@endsection
