@extends('layouts.public')
@section('title', 'Galeri Desa')
@section('breadcrumb')
    <li class="breadcrumb-item active">Galeri Desa</li>
@endsection
@section('content')
@include('layouts.partials.page-hero', [
    'title' => 'Galeri Dokumentasi',
    'subtitle' => 'Jendela visual potensi dan pesona alami Desa Selorejo',
    'icon' => 'image'
])

<div class="container mb-5 pb-5" style="margin-top: -35px; position: relative; z-index: 10;">
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
            <form action="{{ route('galeri') }}" method="GET">
                <div class="glass-card bg-white p-2 p-md-3 rounded-pill shadow-sm d-flex border-0 align-items-center">
                    <i data-lucide="search" class="text-muted ms-3 me-2"></i>
                    <input type="text" class="form-control border-0 bg-transparent shadow-none" placeholder="Cari dokumentasi atau judul..." name="search" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-success rounded-pill px-4 fw-bold shadow">CARI</button>
                </div>
            </form>
        </div>
    </div>
    <style>
        .nav-pills .nav-link.active {
            background-color: #1b4332 !important;
            color: white !important;
            box-shadow: 0 4px 15px rgba(27, 67, 50, 0.2);
        }
        .nav-link-custom-tab {
            transition: all 0.3s ease;
            color: #666;
            background: white;
            border: 1px solid rgba(0,0,0,0.05) !important;
        }
        .nav-link-custom-tab:hover:not(.active) {
            background: #f8f9fa;
            color: #1b4332;
        }
    </style>

    <!-- Tabs -->
    <div class="d-flex justify-content-center mb-5">
        <ul class="nav nav-pills gap-2 flex-wrap justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active rounded-pill px-4 py-2 fw-bold text-uppercase border-0 shadow-sm nav-link-custom-tab" data-bs-toggle="pill" data-bs-target="#pills-semua">Semua</button>
            </li>
            <li class="nav-item">
                <button class="nav-link rounded-pill px-4 py-2 fw-bold text-uppercase border-0 shadow-sm nav-link-custom-tab" data-bs-toggle="pill" data-bs-target="#pills-foto"><i data-lucide="camera" class="icon-sm me-2"></i>Foto</button>
            </li>
            <li class="nav-item">
                <button class="nav-link rounded-pill px-4 py-2 fw-bold text-uppercase border-0 shadow-sm nav-link-custom-tab" data-bs-toggle="pill" data-bs-target="#pills-video"><i data-lucide="video" class="icon-sm me-2"></i>Video</button>
            </li>
        </ul>
    </div>

    <div class="tab-content" id="pills-tabContent">
        <!-- Semua -->
        <div class="tab-pane fade show active" id="pills-semua">
            <div class="row g-4">
                @forelse($galeri as $g)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card border-0 shadow-sm card-hover overflow-hidden position-relative rounded-4 bg-white p-2 @if($g->tipe == 'foto') lightbox-trigger @endif" 
                         @if($g->tipe == 'foto')
                            style="cursor: pointer;"
                            data-src="{{ $g->gambar_url }}"
                            data-caption="{{ $g->caption }}"
                            data-category="{{ $g->kategori }}"
                            data-date="{{ $g->tanggal ? $g->tanggal->translatedFormat('l, d F Y') : '-' }}"
                         @endif>
                        @if($g->tipe == 'foto')
                            <img src="{{ $g->gambar_url }}" class="w-100 rounded-3" style="height: 250px; object-fit: cover;" onerror="this.src='{{ asset('images/hero_desa.png') }}'">
                        @else
                            <div class="w-100 rounded-3 d-flex justify-content-center align-items-center text-white" style="height: 250px; background: linear-gradient(45deg, #1b4332, #74c69d);">
                                <i data-lucide="play-circle" style="width: 64px; height: 64px; opacity:0.8;"></i>
                            </div>
                        @endif
                        <div class="card-body p-3 mt-2 text-center">
                            <h6 class="text-dark fw-bold mb-1">{{ $g->caption ?? 'Dokumentasi' }}</h6>
                            <div class="d-flex align-items-center justify-content-center flex-wrap gap-2">
                                <span class="badge-kategori px-2 py-1" style="font-size: 0.65rem;">{{ $g->kategori }}</span>
                                <small class="text-muted"><i data-lucide="calendar" class="icon-sm me-1"></i>{{ $g->tanggal ? $g->tanggal->translatedFormat('d F Y') : 'Dokumentasi' }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 py-5 text-center text-muted glass-panel mx-auto w-75"><i data-lucide="image" class="mb-3 opacity-50" style="width:48px;height:48px;"></i><br>Belum ada dokumentasi galeri.</div>
                @endforelse
            </div>
        </div>

        <div class="tab-pane fade" id="pills-foto">
            <div class="row g-4">
                @foreach($galeri->where('tipe', 'foto') as $g)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card border-0 shadow-sm card-hover overflow-hidden position-relative rounded-4 bg-white p-2 lightbox-trigger" 
                         style="cursor: pointer;"
                         data-src="{{ $g->gambar_url }}"
                         data-caption="{{ $g->caption }}"
                         data-category="{{ $g->kategori }}"
                         data-date="{{ $g->tanggal ? $g->tanggal->translatedFormat('l, d F Y') : '-' }}">
                        <img src="{{ $g->gambar_url }}" class="w-100 rounded-3" style="height: 280px; object-fit: cover;" onerror="this.src='{{ asset('images/hero_desa.png') }}'">
                        <div class="position-absolute bottom-0 w-100 p-3 pt-5 ms-0 mb-2 me-2" style="background: linear-gradient(transparent, rgba(0,0,0,0.85)); border-radius: 0 0 10px 10px;">
                            <h6 class="text-white fw-bold mb-0 text-shadow">{{ $g->caption }}</h6>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Video -->
        <div class="tab-pane fade" id="pills-video">
            <div class="row g-4">
                @foreach($galeri->where('tipe', 'video') as $g)
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white p-2">
                        <div class="ratio ratio-16x9 rounded-3 overflow-hidden">
                            @if(str_contains($g->url, 'youtube.com') || str_contains($g->url, 'youtu.be'))
                                @php 
                                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $g->url, $match);
                                    $ytId = $match[1] ?? '';
                                @endphp
                                <iframe src="https://www.youtube.com/embed/{{ $ytId }}" allowfullscreen></iframe>
                            @else
                                <video controls class="bg-dark"><source src="{{ asset('storage/'.$g->url) }}"></video>
                            @endif
                        </div>
                        <div class="p-3 text-center">
                            <h6 class="fw-bold text-dark mb-0"><i data-lucide="video" class="icon-sm text-danger me-2"></i>{{ $g->caption }}</h6>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    
@include('layouts.partials.lightbox')
@endsection
