@extends('layouts.public')
@section('title', 'Struktur Organisasi')
@section('breadcrumb')
    <li class="breadcrumb-item">Pemerintahan</li>
    <li class="breadcrumb-item active">Struktur Organisasi</li>
@endsection
@section('content')
<div class="section-hero-gradient pt-5 pb-4 mb-5 text-center text-white" style="min-height: auto;">
    <div class="container position-relative z-1">
        <h1 class="fw-bold mb-3"><i data-lucide="network" class="me-2 text-warning"></i>Struktur Organisasi</h1>
        <p class="lead fw-medium text-white-50">Jajaran Perangkat Desa Selorejo Periode Terkini</p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <div class="row justify-content-center g-4">
        @forelse($struktur as $s)
        <div class="{{ $loop->first ? 'col-md-12 text-center mb-4' : 'col-md-4 col-sm-6' }}">
            <div class="glass-card card-hover h-100 bg-white p-4 border border-success border-opacity-10 text-center rounded-4 shadow-sm">
                @if($s->foto)
                    <img src="{{ asset('storage/'.$s->foto) }}" class="rounded-circle shadow-sm border border-4 border-success border-opacity-25 mb-3" style="width: {{ $loop->first ? '150px' : '100px' }}; height: {{ $loop->first ? '150px' : '100px' }}; object-fit: cover;" alt="{{ $s->nama_pejabat }}">
                @else
                    <div class="rounded-circle shadow-sm border border-4 border-success border-opacity-25 mx-auto mb-3 bg-light d-flex align-items-center justify-content-center text-success" style="width: {{ $loop->first ? '150px' : '100px' }}; height: {{ $loop->first ? '150px' : '100px' }};">
                        <i data-lucide="user" style="width: {{ $loop->first ? '64px' : '48px' }}; height: {{ $loop->first ? '64px' : '48px' }};"></i>
                    </div>
                @endif
                <h5 class="fw-bold text-dark mb-1 {{ $loop->first ? 'fs-4' : '' }}">{{ $s->nama_pejabat }}</h5>
                <span class="badge {{ $loop->first ? 'bg-primary-custom px-3 py-2 fs-6' : 'bg-success bg-opacity-25 text-success' }} rounded-pill">{{ $s->jabatan }}</span>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted p-5 glass-panel">Belum ada data Aparat / Struktur Organisasi Desa.</div>
        @endforelse
    </div>
</div>
@endsection
