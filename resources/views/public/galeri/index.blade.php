@extends('layouts.public')
@section('title', 'Galeri Desa')
@section('breadcrumb')
    <li class="breadcrumb-item active">Galeri Desa</li>
@endsection
@section('content')
<div class="section-hero-gradient pt-5 pb-5 mb-5 text-center text-white" style="position: relative; background: linear-gradient(rgba(27,67,50,0.85), rgba(45,106,79,0.9)), url('{{ asset('images/hero_desa.png') }}') center/cover;">
    <div class="container position-relative z-1 pt-4">
        <h1 class="fw-bold mb-3 display-4"><i data-lucide="image" class="me-3 text-warning icon-xl"></i>Galeri Dokumentasi</h1>
        <p class="lead fw-medium text-white-50">Jendela visual potensi dan pesona alami Desa Selorejo</p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <!-- Tabs -->
    <ul class="nav nav-pills justify-content-center mb-5" id="pills-tab" role="tablist">
        <li class="nav-item shadow-sm rounded-pill mx-1 mb-2">
            <button class="nav-link active rounded-pill px-4 py-2 fw-bold text-uppercase border-0" data-bs-toggle="pill" data-bs-target="#pills-semua">Semua</button>
        </li>
        <li class="nav-item shadow-sm rounded-pill mx-1 mb-2">
            <button class="nav-link rounded-pill px-4 py-2 fw-bold text-uppercase border-0 bg-white text-muted" data-bs-toggle="pill" data-bs-target="#pills-foto"><i data-lucide="camera" class="icon-sm me-1"></i>Foto</button>
        </li>
        <li class="nav-item shadow-sm rounded-pill mx-1 mb-2">
            <button class="nav-link rounded-pill px-4 py-2 fw-bold text-uppercase border-0 bg-white text-muted" data-bs-toggle="pill" data-bs-target="#pills-video"><i data-lucide="video" class="icon-sm me-1"></i>Video</button>
        </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">
        <!-- Semua -->
        <div class="tab-pane fade show active" id="pills-semua">
            <div class="row g-4">
                @forelse($galeri as $g)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card border-0 shadow-sm hover-lift overflow-hidden position-relative rounded-4 bg-white p-2">
                        @if($g->tipe == 'foto')
                            <img src="{{ $g->gambar_url }}" class="w-100 rounded-3" style="height: 250px; object-fit: cover;" onerror="this.src='{{ asset('images/hero_desa.png') }}'">
                        @else
                            <div class="w-100 rounded-3 d-flex justify-content-center align-items-center text-white" style="height: 250px; background: linear-gradient(45deg, #1b4332, #74c69d);">
                                <i data-lucide="play-circle" style="width: 64px; height: 64px; opacity:0.8;"></i>
                            </div>
                        @endif
                        <div class="card-body p-3 mt-2 text-center">
                            <h6 class="text-dark fw-bold mb-1">{{ $g->caption ?? 'Dokumentasi' }}</h6>
                            <small class="text-muted"><i data-lucide="calendar" class="icon-sm me-1"></i>{{ $g->tanggal ? $g->tanggal->format('M Y') : 'Dokumentasi' }}</small>
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
                    <div class="card border-0 shadow-sm hover-lift overflow-hidden position-relative rounded-4 bg-white p-2">
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
    
    <div class="d-flex justify-content-center mt-5">
        {{ $galeri->links('pagination::bootstrap-5') }}
    </div>
</div>

@push('scripts')
{{-- Masonry Removed to fix layout bug --}}
@endpush
@endsection
