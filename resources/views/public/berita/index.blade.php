@extends('layouts.public')
@section('title', 'Kabar Desa')
@section('breadcrumb')
    <li class="breadcrumb-item active" style="font-family: var(--font-body);">Berita & Kabar Desa</li>
@endsection
@section('content')
@include('layouts.partials.page-hero', [
    'title' => $hero['title'] ?? 'Kabar Desa',
    'subtitle' => $hero['subtitle'] ?? 'Informasi, pengumuman, dan liputan terkini dari Desa Selorejo',
    'icon' => $hero['icon'] ?? 'newspaper'
])

<div class="container mb-5 pb-5" style="margin-top: -35px; position: relative; z-index: 10;">
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
            <form action="{{ route('berita.index') }}" method="GET">
                <div class="glass-card bg-white p-2 p-md-3 rounded-pill shadow-sm d-flex border-0 align-items-center mb-3">
                    <i data-lucide="search" class="text-muted ms-3 me-2"></i>
                    <input type="text" class="form-control border-0 bg-transparent shadow-none" style="font-family: var(--font-body);" placeholder="Cari kabar atau pengumuman..." name="search" value="{{ request('search') }}">
                    <button type="submit" class="btn rounded-pill px-4 fw-bold shadow" style="background-color: var(--color-forest) !important; color: #fff !important; font-family: var(--font-heading); border: none;">CARI</button>
                </div>
                
                <div class="d-flex flex-wrap justify-content-center gap-3" style="font-family: var(--font-body);">
                    <div class="d-flex align-items-center bg-white shadow-sm border rounded-pill px-3 py-1 hover-lift">
                        <i data-lucide="tag" class="text-muted icon-sm me-1"></i>
                        <select name="kategori" class="border-0 bg-transparent fw-bold text-muted px-2 py-1 shadow-none" style="font-size: var(--text-sm); outline: none; cursor: pointer;" onchange="this.form.submit()">
                            <option value="semua" {{ request('kategori') == 'semua' ? 'selected' : '' }}>Semua Kategori</option>
                            <option value="Kegiatan Desa" {{ request('kategori') == 'Kegiatan Desa' ? 'selected' : '' }}>Kegiatan Desa</option>
                            <option value="Pariwisata" {{ request('kategori') == 'Pariwisata' ? 'selected' : '' }}>Pariwisata</option>
                            <option value="Ekonomi & UMKM" {{ request('kategori') == 'Ekonomi & UMKM' ? 'selected' : '' }}>Ekonomi & UMKM</option>
                            <option value="Pembangunan" {{ request('kategori') == 'Pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                            <option value="Sosial" {{ request('kategori') == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                            <option value="Pengumuman" {{ request('kategori') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                        </select>
                    </div>
                    
                    <div class="d-flex align-items-center bg-white shadow-sm border rounded-pill px-3 py-1 hover-lift">
                        <i data-lucide="sliders-horizontal" class="text-muted icon-sm me-1"></i>
                        <select name="sort" class="border-0 bg-transparent fw-bold text-muted px-2 py-1 shadow-none" style="font-size: var(--text-sm); outline: none; cursor: pointer;" onchange="this.form.submit()">
                            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                            <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                            <option value="judul_asc" {{ request('sort') == 'judul_asc' ? 'selected' : '' }}>Judul A-Z</option>
                            <option value="judul_desc" {{ request('sort') == 'judul_desc' ? 'selected' : '' }}>Judul Z-A</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row g-4">
        @forelse($berita as $b)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="berita-card card-hover h-100 bg-white border shadow-sm rounded-4 overflow-hidden d-flex flex-column position-relative" style="border-color: var(--color-forest)1a !important;">
                <span class="badge position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill z-2 fw-bold shadow-sm" style="background-color: var(--accent) !important; color: var(--text-on-accent) !important; font-family: var(--font-body); border: none;"><i data-lucide="tag" class="icon-sm me-1"></i>{{ $b->kategori }}</span>
                <div class="overflow-hidden position-relative" style="height: 220px;">
                    <img src="{{ $b->gambar_url }}" onerror="this.src='{{ asset('images/tani_lokal.png') }}'" class="w-100 h-100 object-fit-cover" alt="{{ $b->judul }}">
                    <div class="position-absolute bottom-0 w-100 p-3 pt-5" style="background: linear-gradient(transparent, rgba(0,0,0,0.8));">
                        <small class="text-white fw-bold" style="font-family: var(--font-body);"><i data-lucide="calendar" class="icon-sm me-1"></i>{{ \Carbon\Carbon::parse($b->tanggal)->translatedFormat('d F Y') }}</small>
                    </div>
                </div>
                
                <div class="card-body p-4 d-flex flex-column position-relative">
                    <h5 class="fw-bold mb-3 lh-sm" style="font-family: var(--font-heading);">
                        <a href="{{ url('/berita/'.$b->slug) }}" class="text-dark text-decoration-none stretched-link">{{ $b->judul }}</a>
                    </h5>
                    <p class="text-muted small lh-lg flex-grow-1" style="font-family: var(--font-body);">{{ Str::limit(strip_tags($b->konten), 120) }}</p>
                </div>
                
                <div class="card-footer bg-transparent border-top p-3 pt-0 d-flex justify-content-between align-items-center" style="border-top-color: var(--color-forest)1a !important;">
                    <div class="d-flex align-items-center" style="font-family: var(--font-body);">
                        <div class="rounded-circle text-white d-flex align-items-center justify-content-center me-2" style="width:30px; height:30px; background-color: var(--color-forest) !important;"><i data-lucide="user" class="icon-sm"></i></div>
                        <small class="text-muted fw-bold">Admin</small>
                    </div>
                    <a href="{{ url('/berita/'.$b->slug) }}" class="text-decoration-none fw-bold small d-inline-flex align-items-center px-3 py-1 rounded-pill btn-baca-custom" style="font-family: var(--font-heading); position: relative; z-index: 2;">Baca <i data-lucide="arrow-right" class="icon-sm ms-1"></i></a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted p-5 bg-white border rounded-4" style="font-family: var(--font-body);">Belum ada berita yang diterbitkan.</div>
        @endforelse
    </div>
    
    <div class="d-flex justify-content-center mt-5">
        {{ $berita->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
