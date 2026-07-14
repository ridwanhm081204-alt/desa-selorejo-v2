@extends('layouts.public')
@section('title', 'Lembaga Desa')
@section('breadcrumb')
    <li class="breadcrumb-item">Pemerintahan</li>
    <li class="breadcrumb-item active">Lembaga Desa</li>
@endsection
@section('content')
@include('layouts.partials.page-hero', [
    'title' => $hero['title'] ?? 'Lembaga Desa',
    'subtitle' => $hero['subtitle'] ?? 'Lembaga Kemasyarakatan Pendukung Pembangunan Desa',
    'icon' => $hero['icon'] ?? 'building-2'
])

<div class="container mb-5 pb-5">
    <div class="row g-4 justify-content-center">
        @forelse($lembaga as $l)
        <div class="col-lg-6">
            <div class="glass-card card-hover bg-white p-4 p-md-5 rounded-4 border shadow-sm h-100 d-flex flex-column" style="border-color: var(--color-forest)33 !important;">
                <div class="d-flex justify-content-between align-items-start border-bottom pb-4 mb-4" style="border-bottom-color: var(--color-forest)33 !important;">
                    <h4 class="fw-bold text-dark mb-0 d-flex align-items-center" style="font-family: var(--font-heading);">
                        <i data-lucide="shield-check" class="icon-md me-3 text-dark"></i>{{ $l->nama_lembaga }}
                    </h4>
                    <span class="badge px-3 py-2 rounded-pill fw-bold border" style="background-color: var(--accent) !important; border-color: var(--accent) !important; color: var(--text-on-accent) !important; font-family: var(--font-body); font-size: 0.7rem;">{{ $l->jenis }}</span>
                </div>
                <div class="mb-4 flex-grow-1">
                    <p class="text-muted small lh-lg mb-0 text-justify" style="text-align: justify; font-size: 0.95rem; font-family: var(--font-body);">{{ $l->deskripsi ?: 'Lembaga kemasyarakatan yang berperan aktif dalam mendukung program pembangunan dan pemberdayaan masyarakat di lingkungan Desa Selorejo.' }}</p>
                </div>
                <div class="mt-auto p-4 rounded-4 d-flex align-items-center w-100 border bg-light" style="border-color: var(--color-forest)33 !important;">
                    <div class="rounded-circle p-2 shadow-sm me-3 border d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; overflow:hidden; background-color: rgba(26,92,56,0.1) !important; color: var(--color-forest) !important; border-color: rgba(26,92,56,0.1) !important;">
                        @if($l->foto)
                            <img src="{{ asset('storage/'.$l->foto) }}" alt="{{ $l->ketua }}" class="img-fluid" style="width:100%; height:100%; object-fit:cover;">
                        @else
                            <i data-lucide="user-check" class="text-dark icon-sm"></i>
                        @endif
                    </div>
                    <div>
                        <small class="text-dark d-block lh-1 mb-2 fw-bold" style="font-family: var(--font-body); color: #000 !important;">Ketua Lembaga</small>
                        <strong class="text-dark fs-5" style="font-family: var(--font-heading); color: #000 !important;">{{ $l->ketua ?: 'Belum ditentukan' }}</strong>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted p-5 bg-white border rounded-4" style="font-family: var(--font-body);">Belum ada data Lembaga Desa.</div>
        @endforelse
    </div>
</div>
@endsection
