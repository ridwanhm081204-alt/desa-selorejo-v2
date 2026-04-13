@extends('layouts.public')
@section('title', 'Struktur Organisasi')
@section('breadcrumb')
    <li class="breadcrumb-item">Pemerintahan</li>
    <li class="breadcrumb-item active">Struktur Organisasi</li>
@endsection
@section('content')
@include('layouts.partials.page-hero', [
    'title' => $hero['title'] ?? 'Struktur Organisasi',
    'subtitle' => $hero['subtitle'] ?? 'Jajaran Perangkat Desa Selorejo Periode Terkini',
    'icon' => $hero['icon'] ?? 'network'
])

<div class="container mb-5 pb-5">
    <div class="row justify-content-center g-4">
        @forelse($struktur as $s)
        <div class="{{ $loop->first ? 'col-md-12 text-center mb-4' : 'col-md-4 col-sm-6' }}">
            <div class="glass-card card-hover h-100 bg-white p-4 border border-success border-opacity-10 text-center rounded-4 shadow-sm">
                @php
                    $fotoUrl = null;
                    if($s->foto) {
                        if(str_starts_with($s->foto, 'http')) {
                            $fotoUrl = $s->foto;
                        } else {
                            $fotoUrl = asset('storage/'.$s->foto);
                        }
                    } elseif($s->jabatan == 'Kepala Desa') {
                        $fotoUrl = asset('images/kades_selorejo.jpg');
                    }
                @endphp

                @if($fotoUrl)
                    <img src="{{ $fotoUrl }}" class="rounded-circle shadow-sm border border-4 border-success border-opacity-25 mb-3" style="width: {{ $loop->first ? '150px' : '100px' }}; height: {{ $loop->first ? '150px' : '100px' }}; object-fit: cover;" alt="{{ $s->nama_pejabat }}">
                @else
                    <div class="rounded-circle shadow-sm border border-4 border-success border-opacity-25 mx-auto mb-3 bg-light d-flex align-items-center justify-content-center text-dark" style="width: {{ $loop->first ? '150px' : '100px' }}; height: {{ $loop->first ? '150px' : '100px' }};">
                        <i data-lucide="user" style="width: {{ $loop->first ? '64px' : '48px' }}; height: {{ $loop->first ? '64px' : '48px' }};"></i>
                    </div>
                @endif
                <h5 class="fw-bold text-dark mb-1 {{ $loop->first ? 'fs-4' : '' }}">{{ $s->nama_pejabat }}</h5>
                <span class="badge {{ $loop->first ? 'bg-primary-custom px-3 py-2 fs-6' : 'bg-light text-dark border border-success border-opacity-10' }} rounded-pill">{{ $s->jabatan }}</span>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted p-5 glass-panel">Belum ada data Aparat / Struktur Organisasi Desa.</div>
        @endforelse
    </div>
</div>
@endsection
