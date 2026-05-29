@extends('layouts.public')
@section('title', 'Sejarah Desa')
@section('breadcrumb')
    <li class="breadcrumb-item">Profil Desa</li>
    <li class="breadcrumb-item active">Sejarah</li>
@endsection
@section('content')
@php
    $hero = $profile->hero_sejarah ?? ['title' => 'Sejarah Desa', 'subtitle' => 'Menelusuri jejak peradaban dan perkembangan Desa Selorejo dari masa ke masa.', 'icon' => 'history'];
@endphp

@include('layouts.partials.page-hero', [
    'title' => $hero['title'] ?? 'Sejarah Desa',
    'subtitle' => $hero['subtitle'] ?? 'Menelusuri jejak peradaban dan perkembangan Desa Selorejo dari masa ke masa.',
    'icon' => $hero['icon'] ?? 'history'
])

<div class="container mb-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="glass-card bg-white p-0 rounded-4 shadow-lg overflow-hidden border-0 mb-5">
                <!-- Foto Utama di Atas Kotak -->
                <div class="position-relative">
                    <img src="{{ asset('images/SelorejoWaduk.jpg') }}" alt="Pemandangan Desa Selorejo" class="img-fluid w-100" style="max-height: 500px; object-fit: cover;">
                    <div class="position-absolute bottom-0 start-0 w-100 p-4 bg-gradient-to-t from-dark to-transparent text-white d-none d-md-block">
                        <small class="text-white-50"><i data-lucide="camera" class="icon-sm me-1"></i> Dokumentasi Desa Selorejo</small>
                    </div>
                </div>

                <!-- Konten Teks Materi -->
                <div class="p-4 p-md-5">
                    <div class="lh-lg text-dark" style="text-align: justify; font-size: 1.05rem;">
                        {!! nl2br(e($profile->sejarah ?? '')) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Timeline Visual Sejarah -->
    <div class="mt-5 pt-4 border-top border-opacity-10" style="border-top-color: var(--color-forest) !important;">
        <div class="text-center mb-5">
            <span class="badge px-3 py-2 rounded-pill mb-2 border shadow-sm" style="background-color: var(--accent) !important; border-color: var(--accent) !important; color: var(--text-on-accent) !important; font-family: var(--font-body);">Jejak Waktu Sejarah</span>
            <h3 class="fw-bold text-dark" style="font-family: var(--font-heading);">Lini Masa Perkembangan</h3>
        </div>
        
        <div class="row position-relative ps-4 ps-md-0">
            <div class="col-md-10 mx-auto">
                @php $timelines = $profile->sejarah_timeline ?? []; @endphp
                @foreach($timelines as $index => $item)
                <div class="position-relative pb-4 ps-4 border-start border-2 timeline-item {{ $index > 0 ? 'mt-4' : '' }} {{ $loop->last ? 'border-bottom-0' : '' }}" 
                     style="border-left-color: var(--color-forest) !important; @if($loop->last) border-image: linear-gradient(to bottom, var(--color-forest) 0%, transparent 100%) 1; @endif">
                    
                    <div class="position-absolute rounded-circle shadow" 
                         style="width: 16px; height: 16px; left: -9px; top: 0; background-color: {{ $loop->last ? 'var(--accent)' : 'var(--color-forest)' }} !important; {{$loop->last ? 'outline: 3px solid white;' : ''}}"></div>
                    
                    <h5 class="fw-bold mb-1" style="color: var(--color-forest) !important; font-family: var(--font-heading);">{{ $item['year'] }}</h5>
                    <p class="text-muted small mb-2" style="font-family: var(--font-body);"><i data-lucide="{{ $item['icon'] ?? 'tag' }}" class="icon-sm me-1"></i> {{ $item['title'] }}</p>
                    <p class="text-dark" style="font-family: var(--font-body);">{{ $item['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>
@endsection
