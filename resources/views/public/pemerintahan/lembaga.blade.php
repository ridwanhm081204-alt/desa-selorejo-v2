@extends('layouts.public')
@section('title', 'Lembaga Desa')
@section('breadcrumb')
    <li class="breadcrumb-item">Pemerintahan</li>
    <li class="breadcrumb-item active">Lembaga Desa</li>
@endsection
@section('content')
<div class="section-hero-gradient pt-5 pb-4 mb-5 text-center text-white" style="min-height: auto;">
    <div class="container position-relative z-1">
        <h1 class="fw-bold mb-3"><i data-lucide="building-2" class="me-2 text-warning"></i>Lembaga Desa</h1>
        <p class="lead fw-medium text-white-50">Lembaga Kemasyarakatan Pendukung Pembangunan Desa</p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <div class="row g-4">
        @forelse($lembaga as $l)
        <div class="col-lg-6">
            <div class="glass-card bg-white p-4 rounded-4 border-0 shadow-sm h-100 d-flex flex-column hover-lift">
                <div class="d-flex justify-content-between align-items-start border-bottom border-success border-opacity-10 pb-3 mb-3">
                    <h4 class="fw-bold text-primary-custom mb-0"><i data-lucide="shield" class="icon-md me-2 text-warning"></i>{{ $l->nama_lembaga }}</h4>
                    <span class="badge bg-success px-3 py-2 rounded-pill">{{ $l->jenis }}</span>
                </div>
                <div class="mb-3 flex-grow-1">
                    <p class="text-muted lh-lg mb-0 text-justify" style="text-align: justify;">{{ $l->deskripsi ?: 'Tidak ada deskripsi lembaga.' }}</p>
                </div>
                <div class="mt-auto bg-light bg-opacity-50 p-3 rounded-3 border border-success border-opacity-10 d-inline-flex align-items-center w-100">
                    <div class="bg-white rounded-circle p-2 shadow-sm me-3 border border-success border-opacity-10">
                        <i data-lucide="user" class="text-success icon-sm"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block lh-1 mb-1">Ketua Lembaga</small>
                        <strong class="text-dark">{{ $l->ketua ?: 'Belum ditentukan' }}</strong>
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
