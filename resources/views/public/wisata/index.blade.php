@extends('layouts.public')
@section('title', 'Destinasi Wisata Desa')
@section('breadcrumb')
    <li class="breadcrumb-item">Unit Usaha</li>
    <li class="breadcrumb-item active">Destinasi Wisata</li>
@endsection
@section('content')
@include('layouts.partials.page-hero', [
    'title' => $hero['title'] ?? 'Destinasi Wisata Selorejo',
    'subtitle' => $hero['subtitle'] ?? 'Jelajahi keajaiban alam dan kearifan agrikultur di lereng pegunungan Malang.',
    'icon' => $hero['icon'] ?? 'mountain'
])

<div class="container mb-4">
    <form action="{{ url('/wisata') }}" method="GET" class="row g-2 align-items-center justify-content-center">
        <div class="col-md-4">
            <div class="input-group rounded-pill overflow-hidden border bg-white shadow-sm px-3">
                <span class="input-group-text bg-transparent border-0"><i data-lucide="search" class="icon-sm" style="color: var(--color-forest) !important;"></i></span>
                <input type="text" name="search" class="form-control border-0 shadow-none py-2" style="font-family: var(--font-body);" placeholder="Cari destinasi wisata..." value="{{ request('search') }}">
            </div>
        </div>
        <div class="col-md-2">
            <div class="d-flex align-items-center bg-white shadow-sm border rounded-pill px-3 py-1 hover-lift">
                <i data-lucide="tag" class="text-muted icon-sm me-1"></i>
                <select name="kategori" class="border-0 bg-transparent fw-bold text-muted px-1 py-1 shadow-none w-100" style="font-size: var(--text-sm); outline: none; cursor: pointer; font-family: var(--font-body);" onchange="this.form.submit()">
                    <option value="semua" {{ request('kategori') == 'semua' || !request('kategori') ? 'selected' : '' }}>Semua Kategori</option>
                    <option value="Wisata Alam" {{ request('kategori') == 'Wisata Alam' ? 'selected' : '' }}>Wisata Alam</option>
                    <option value="Agrowisata" {{ request('kategori') == 'Agrowisata' ? 'selected' : '' }}>Agrowisata</option>
                    <option value="Budaya & Event" {{ request('kategori') == 'Budaya & Event' ? 'selected' : '' }}>Budaya & Event</option>
                    <option value="Eduwisata" {{ request('kategori') == 'Eduwisata' ? 'selected' : '' }}>Eduwisata</option>
                    <option value="Religi" {{ request('kategori') == 'Religi' ? 'selected' : '' }}>Religi</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="d-flex align-items-center bg-white shadow-sm border rounded-pill px-3 py-1 hover-lift">
                <i data-lucide="sliders-horizontal" class="text-muted icon-sm me-1"></i>
                <select name="sort" class="border-0 bg-transparent fw-bold text-muted px-1 py-1 shadow-none w-100" style="font-size: var(--text-sm); outline: none; cursor: pointer; font-family: var(--font-body);" onchange="this.form.submit()">
                    <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                    <option value="harga_low" {{ request('sort') == 'harga_low' ? 'selected' : '' }}>HTM Termurah</option>
                    <option value="harga_high" {{ request('sort') == 'harga_high' ? 'selected' : '' }}>HTM Tertinggi</option>
                    <option value="judul_asc" {{ request('sort') == 'judul_asc' ? 'selected' : '' }}>A - Z</option>
                    <option value="judul_desc" {{ request('sort') == 'judul_desc' ? 'selected' : '' }}>Z - A</option>
                </select>
            </div>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn rounded-pill px-4 shadow-sm" style="background-color: var(--color-forest) !important; color: #fff !important; font-family: var(--font-heading); border: none;">Cari</button>
            @if(request('search') || (request('kategori') && request('kategori') != 'semua') || request('sort'))
                <a href="{{ url('/wisata') }}" class="btn btn-outline-secondary rounded-pill px-3 ms-1" style="font-family: var(--font-heading);">Reset</a>
            @endif
        </div>
    </form>
</div>

<div class="container mb-5 pb-5">
    @if($wisata->total() > 0)
    <div class="text-muted small mb-3 text-center" style="font-family: var(--font-body);">
        Menampilkan <strong>{{ $wisata->total() }}</strong> destinasi
        @if(request('search')) <span>· Hasil pencarian: <em>"{{ request('search') }}"</em></span> @endif
        @if(request('kategori') && request('kategori') != 'semua') <span>· Kategori: <em>{{ request('kategori') }}</em></span> @endif
    </div>
    @endif
    <div class="row g-5">
        @forelse($wisata as $w)
        <div class="col-12" id="wisata-{{ $w->id }}">
            <div class="glass-card bg-white p-0 rounded-4 shadow-lg overflow-hidden border mb-5" style="background: white; border-color: var(--color-forest)1a !important;">
                <div class="row g-0">
                    <!-- Bagian Gambar -->
                    <div class="col-lg-5 position-relative" style="min-height: 400px;">
                        <img src="{{ $w->gambar }}" class="position-absolute w-100 h-100" style="object-fit: cover;" alt="{{ $w->judul }}">
                        <div class="position-absolute top-0 start-0 m-4 d-flex flex-column gap-2">
                            <span class="badge px-3 py-2 rounded-pill fw-bold shadow-sm" style="font-size:0.75rem; background-color: var(--color-forest) !important; color: #fff !important; font-family: var(--font-body); border: none;">
                                <i data-lucide="tag" class="icon-xs me-1"></i> {{ $w->kategori ?? 'Wisata Desa' }}
                            </span>
                            <span class="badge px-3 py-2 rounded-pill fw-bold shadow-sm border" style="background-color: var(--accent) !important; border-color: var(--accent) !important; color: var(--text-on-accent) !important; font-family: var(--font-body);">
                                <i data-lucide="map-pin" class="icon-sm me-1"></i> Area Desa Selorejo
                            </span>
                        </div>
                    </div>

                    <!-- Bagian Deskripsi -->
                    <div class="col-lg-7 p-4 p-md-5 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-4 border-bottom pb-4" style="border-bottom-color: var(--color-forest)1a !important;">
                            <div>
                                <h2 class="fw-bold text-dark mb-1" style="font-family: var(--font-heading);">{{ $w->judul }}</h2>
                                <p class="text-muted small mb-0 fw-medium d-flex align-items-center" style="font-family: var(--font-body);">
                                    <i data-lucide="info" class="icon-sm me-2" style="color: var(--color-forest);"></i> Destinasi Unggulan Kecamatan Dau
                                </p>
                            </div>
                            <div class="text-end">
                                <div class="p-3 px-4 rounded-4 shadow-sm border border-white border-opacity-10 d-flex align-items-center" style="background-color: var(--color-forest) !important; font-family: var(--font-heading);">
                                    <i data-lucide="ticket" class="text-white icon-md me-3"></i>
                                    <div>
                                        <small class="text-white text-opacity-75 d-block lh-1 mb-1 fw-bold" style="font-size: 0.65rem; letter-spacing: 0.5px; font-family: var(--font-body);">HARGA TIKET (HTM)</small>
                                        <h4 class="fw-bold text-white mb-0">
                                            @if($w->harga_tiket == 0)
                                                GRATIS
                                            @else
                                                Rp {{ number_format($w->harga_tiket, 0, ',', '.') }}
                                            @endif
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-dark lh-lg mb-4 flex-grow-1" style="text-align: justify; font-size: 1.05rem; font-family: var(--font-body);">
                            {{ Str::limit($w->deskripsi, 200, '...') }}
                        </div>

                         <div class="mt-auto pt-4 border-top text-end" style="border-top-color: var(--color-forest)1a !important;">
                            <a href="{{ url('/wisata/'.$w->id) }}" class="btn fw-bold px-4 rounded-pill shadow-sm hover-lift btn-outline-forest" style="font-family: var(--font-heading);">Lihat Detail Wisata <i data-lucide="arrow-right" class="icon-sm ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted p-5 bg-white rounded-4 border" style="font-family: var(--font-body);">
            <i data-lucide="mountain" style="width:64px;height:64px; color: var(--color-forest) !important;" class="opacity-25 mb-3 d-block mx-auto"></i>
            @if(request('search') || request('kategori'))
                Destinasi wisata tidak ditemukan untuk filter yang dipilih.
                <div class="mt-3"><a href="{{ url('/wisata') }}" class="btn rounded-pill px-4 hover-lift btn-outline-forest" style="font-family: var(--font-heading);">Lihat Semua Wisata</a></div>
            @else
                Data objek wisata sedang diperbarui oleh pengelola.
            @endif
        </div>
        @endforelse
    </div>

    @if($wisata->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $wisata->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
    @endif

    <!-- Info Tambahan Rute -->
    <div class="mt-5 text-center">
        <div class="p-4 p-md-5 rounded-4 text-white position-relative overflow-hidden shadow-lg border-0" style="background: var(--color-forest) !important;">
            <div class="position-absolute start-0 bottom-0 opacity-10" style="margin-left:-30px; margin-bottom:-30px;"><i data-lucide="map" style="width:200px; height:200px;"></i></div>
            <div class="position-relative z-1 py-4">
                <i data-lucide="navigation" class="icon-lg mb-4" style="width: 64px; height: 64px; color: var(--accent) !important;"></i>
                <h2 class="fw-bold mb-3" style="font-family: var(--font-heading);">Siap Menjelajahi Selorejo?</h2>
                <p class="lead mb-5 opacity-75" style="font-family: var(--font-body);">Manfaatkan panduan digital kami untuk menemukan rute tercepat menuju lokasi wisata.</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{ route('profil.peta') }}" class="btn fw-bold px-5 py-3 rounded-pill shadow-lg hover-lift" style="background-color: var(--accent) !important; color: var(--text-on-accent) !important; font-family: var(--font-heading); border: none;">
                        <i data-lucide="map-pin" class="icon-sm me-2"></i> Buka Panduan Peta Digital
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
