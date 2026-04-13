@extends('layouts.public')
@section('title', 'Galeri Desa')
@section('breadcrumb')
    <li class="breadcrumb-item active">Galeri & Dokumentasi</li>
@endsection
@section('content')
@include('layouts.partials.page-hero', [
    'title' => $hero['title'] ?? 'Galeri Dokumentasi',
    'subtitle' => $hero['subtitle'] ?? 'Jendela visual potensi dan pesona alami Desa Selorejo',
    'icon' => $hero['icon'] ?? 'image'
])

<div class="container mb-5 pb-5" style="margin-top: -35px; position: relative; z-index: 10;">
    <div class="row justify-content-center mb-4">
        <div class="col-lg-10">
            <form action="{{ route('galeri') }}" method="GET" class="glass-card bg-white p-3 p-md-4 shadow-sm rounded-4 border-0">
                <div class="row g-3">
                    <div class="col-lg-4">
                        <div class="input-group shadow-sm rounded-pill overflow-hidden border">
                            <span class="input-group-text bg-white border-0 ps-3"><i data-lucide="search" class="text-muted icon-sm"></i></span>
                            <input type="text" name="search" class="form-control border-0 ps-1 shadow-none" placeholder="Cari dokumentasi..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-6 col-lg-2">
                        <select name="tipe" class="form-select shadow-none border rounded-pill px-3" onchange="this.form.submit()">
                            <option value="semua" {{ request('tipe') == 'semua' ? 'selected' : '' }}>Tipe Media</option>
                            <option value="foto" {{ request('tipe') == 'foto' ? 'selected' : '' }}>Foto</option>
                            <option value="video" {{ request('tipe') == 'video' ? 'selected' : '' }}>Video</option>
                        </select>
                    </div>
                    <div class="col-6 col-lg-2">
                        <select name="kategori" class="form-select shadow-none border rounded-pill px-3" onchange="this.form.submit()">
                            <option value="semua" {{ request('kategori') == 'semua' ? 'selected' : '' }}>Semua Tag</option>
                            <option value="Potensi Desa" {{ request('kategori') == 'Potensi Desa' ? 'selected' : '' }}>Potensi Desa</option>
                            <option value="Wisata Alam" {{ request('kategori') == 'Wisata Alam' ? 'selected' : '' }}>Wisata Alam</option>
                            <option value="Kegiatan Warga" {{ request('kategori') == 'Kegiatan Warga' ? 'selected' : '' }}>Kegiatan Warga</option>
                            <option value="Infrastruktur" {{ request('kategori') == 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                            <option value="Event" {{ request('kategori') == 'Event' ? 'selected' : '' }}>Event & Festival</option>
                        </select>
                    </div>
                    <div class="col-6 col-lg-2">
                        <select name="sort" class="form-select shadow-none border rounded-pill px-3" onchange="this.form.submit()">
                            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                            <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                            <option value="judul_asc" {{ request('sort') == 'judul_asc' ? 'selected' : '' }}>Judul A-Z</option>
                        </select>
                    </div>
                    <div class="col-6 col-lg-2">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success fw-bold shadow-sm rounded-pill py-2">FILTER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row g-4">
        @forelse($galeri as $g)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="glass-card card-hover h-100 bg-white border border-success border-opacity-10 shadow-sm rounded-4 overflow-hidden d-flex flex-column @if($g->tipe == 'foto') lightbox-trigger @endif"
                 @if($g->tipe == 'foto')
                    style="cursor: pointer;"
                    data-src="{{ $g->gambar_url }}"
                    data-caption="{{ $g->caption }}"
                    data-category="{{ $g->kategori }}"
                    data-date="{{ $g->tanggal ? $g->tanggal->translatedFormat('l, d F Y') : '-' }}"
                 @endif>
                
                <div class="position-relative overflow-hidden" style="height: 250px;">
                    @if($g->tipe == 'foto')
                        <img src="{{ $g->gambar_url }}" onerror="this.src='{{ asset('images/hero_desa.png') }}'" class="w-100 h-100 object-fit-cover" alt="{{ $g->caption }}">
                        <div class="position-absolute top-0 start-0 m-3">
                            <span class="badge bg-success bg-opacity-75 rounded-pill px-3 py-2 fw-bold shadow-sm"><i data-lucide="image" class="icon-xs me-1"></i> FOTO</span>
                        </div>
                    @else
                        <div class="w-100 h-100 bg-dark d-flex align-items-center justify-content-center">
                            @if(str_contains($g->url, 'youtube.com') || str_contains($g->url, 'youtu.be'))
                                @php 
                                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $g->url, $match);
                                    $ytId = $match[1] ?? '';
                                @endphp
                                <img src="https://img.youtube.com/vi/{{ $ytId }}/hqdefault.jpg" class="w-100 h-100 object-fit-cover opacity-50">
                                <i data-lucide="play-circle" class="position-absolute text-white" style="width: 60px; height: 60px;"></i>
                            @else
                                <i data-lucide="video" class="text-white" style="width: 60px; height: 60px;"></i>
                            @endif
                        </div>
                        <div class="position-absolute top-0 start-0 m-3">
                            <span class="badge bg-danger bg-opacity-75 rounded-pill px-3 py-2 fw-bold shadow-sm"><i data-lucide="video" class="icon-xs me-1"></i> VIDEO</span>
                        </div>
                        @if($g->tipe == 'video')
                            <a href="{{ $g->url }}" target="_blank" class="stretched-link"></a>
                        @endif
                    @endif
                </div>

                <div class="card-body p-4 text-center">
                    <span class="badge-kategori mb-3 d-inline-block">{{ $g->kategori ?? 'Umum' }}</span>
                    <h6 class="fw-bold text-dark mb-2 lh-sm">{{ $g->caption ?? 'Dokumentasi Desa' }}</h6>
                    <small class="text-muted"><i data-lucide="calendar" class="icon-xs me-1"></i>{{ $g->tanggal ? $g->tanggal->translatedFormat('d M Y') : '-' }}</small>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted p-5 glass-card mb-5 bg-white shadow-sm rounded-4">
            <i data-lucide="image-off" class="icon-xl mb-3 opacity-25 d-block mx-auto text-success"></i>
            Belum ada dokumentasi galeri yang sesuai kriteria.
        </div>
        @endforelse
    </div>
    
    <div class="d-flex justify-content-center mt-5">
        {{ $galeri->links('pagination::bootstrap-5') }}
    </div>
</div>

@include('layouts.partials.lightbox')
@endsection
