@extends('layouts.public')
@section('title', 'Galeri Desa')
@section('breadcrumb')
    <li class="breadcrumb-item active" style="font-family: var(--font-body);">Galeri & Dokumentasi</li>
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
                <div class="row g-3 justify-content-center align-items-center" style="font-family: var(--font-body);">
                    <div class="col-lg-3">
                        <div class="input-group shadow-sm rounded-pill overflow-hidden border">
                            <span class="input-group-text bg-white border-0 ps-3"><i data-lucide="search" class="text-muted icon-sm"></i></span>
                            <input type="text" name="search" class="form-control border-0 ps-1 shadow-none" placeholder="Cari dokumentasi..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-6 col-lg-2">
                        <div class="d-flex align-items-center bg-white shadow-sm border rounded-pill px-3 py-1 hover-lift">
                            <i data-lucide="film" class="text-muted icon-sm me-1"></i>
                            <select name="tipe" class="border-0 bg-transparent fw-bold text-muted px-1 py-1 shadow-none w-100" style="font-size: var(--text-sm); outline: none; cursor: pointer;" onchange="this.form.submit()">
                                <option value="semua" {{ request('tipe') == 'semua' ? 'selected' : '' }}>Semua Tipe</option>
                                <option value="foto" {{ request('tipe') == 'foto' ? 'selected' : '' }}>Foto</option>
                                <option value="video" {{ request('tipe') == 'video' ? 'selected' : '' }}>Video</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-lg-2">
                        <div class="d-flex align-items-center bg-white shadow-sm border rounded-pill px-3 py-1 hover-lift">
                            <i data-lucide="tag" class="text-muted icon-sm me-1"></i>
                            <select name="kategori" class="border-0 bg-transparent fw-bold text-muted px-1 py-1 shadow-none w-100" style="font-size: var(--text-sm); outline: none; cursor: pointer;" onchange="this.form.submit()">
                                <option value="semua" {{ request('kategori') == 'semua' ? 'selected' : '' }}>Semua Tag</option>
                                <option value="Potensi Desa" {{ request('kategori') == 'Potensi Desa' ? 'selected' : '' }}>Potensi Desa</option>
                                <option value="Wisata Alam" {{ request('kategori') == 'Wisata Alam' ? 'selected' : '' }}>Wisata Alam</option>
                                <option value="Kegiatan Warga" {{ request('kategori') == 'Kegiatan Warga' ? 'selected' : '' }}>Kegiatan Warga</option>
                                <option value="Infrastruktur" {{ request('kategori') == 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                                <option value="Event" {{ request('kategori') == 'Event' ? 'selected' : '' }}>Event & Festival</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-lg-2">
                        <div class="d-flex align-items-center bg-white shadow-sm border rounded-pill px-3 py-1 hover-lift">
                            <i data-lucide="sliders-horizontal" class="text-muted icon-sm me-1"></i>
                            <select name="sort" class="border-0 bg-transparent fw-bold text-muted px-1 py-1 shadow-none w-100" style="font-size: var(--text-sm); outline: none; cursor: pointer;" onchange="this.form.submit()">
                                <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                                <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                                <option value="judul_asc" {{ request('sort') == 'judul_asc' ? 'selected' : '' }}>Judul A-Z</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-lg-2">
                        <div class="d-grid">
                            <button type="submit" class="btn fw-bold shadow-sm rounded-pill py-2" style="background-color: var(--color-forest) !important; color: #fff !important; font-family: var(--font-heading); border: none;">FILTER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row g-4">
        @forelse($galeri as $g)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="glass-card card-hover h-100 bg-white border shadow-sm rounded-4 overflow-hidden d-flex flex-column position-relative {{ $g->tipe == 'foto' ? 'lightbox-trigger' : 'video-trigger' }}"
                 style="border-color: var(--color-forest)1a !important; cursor: pointer;"
                 @if($g->tipe == 'foto')
                    data-src="{{ $g->gambar_url }}"
                    data-caption="{{ $g->caption }}"
                    data-category="{{ $g->kategori }}"
                    data-date="{{ $g->tanggal ? $g->tanggal->translatedFormat('l, d F Y') : '-' }}"
                 @else
                    data-video-url="{{ $g->url }}"
                    data-caption="{{ $g->caption }}"
                 @endif>
                
                <div class="overflow-hidden" style="height: 250px;">
                    @if($g->tipe == 'foto')
                        <img src="{{ $g->gambar_url }}" onerror="this.src='{{ asset('images/hero_desa.png') }}'" class="w-100 h-100 object-fit-cover" alt="{{ $g->caption }}">
                        <div class="position-absolute top-0 start-0 m-3">
                            <span class="badge px-3 py-2 rounded-pill fw-bold shadow-sm" style="background-color: var(--color-forest) !important; color: #fff !important; font-family: var(--font-body); border: none;"><i data-lucide="image" class="icon-xs me-1"></i> FOTO</span>
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
                            <span class="badge px-3 py-2 rounded-pill fw-bold shadow-sm" style="background-color: var(--color-tomato) !important; color: #fff !important; font-family: var(--font-body); border: none;"><i data-lucide="video" class="icon-xs me-1"></i> VIDEO</span>
                        </div>
                    @endif
                </div>

                <div class="card-body p-4 text-center">
                    <span class="badge mb-3 d-inline-block px-3 py-1 rounded-pill tag-kategori-custom" style="font-family: var(--font-body);">{{ $g->kategori ?? 'Umum' }}</span>
                    <h6 class="fw-bold text-dark mb-2 lh-sm" style="font-family: var(--font-heading);">{{ $g->caption ?? 'Dokumentasi Desa' }}</h6>
                    <small class="text-muted" style="font-family: var(--font-body);"><i data-lucide="calendar" class="icon-xs me-1"></i>{{ $g->tanggal ? $g->tanggal->translatedFormat('d M Y') : '-' }}</small>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted p-5 bg-white border shadow-sm rounded-4" style="font-family: var(--font-body);">
            <i data-lucide="image-off" class="icon-xl mb-3 opacity-25 d-block mx-auto" style="color: var(--color-forest) !important;"></i>
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
