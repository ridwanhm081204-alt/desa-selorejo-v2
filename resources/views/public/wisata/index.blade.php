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
                <span class="input-group-text bg-transparent border-0"><i data-lucide="search" class="icon-sm text-success"></i></span>
                <input type="text" name="search" class="form-control border-0 shadow-none py-2" placeholder="Cari destinasi wisata..." value="{{ request('search') }}">
            </div>
        </div>
        <div class="col-md-2">
            <select name="kategori" class="form-select rounded-pill border shadow-sm py-2 px-3" onchange="this.form.submit()">
                <option value="semua" {{ request('kategori') == 'semua' || !request('kategori') ? 'selected' : '' }}>🏷️ Semua Kategori</option>
                <option value="Wisata Alam" {{ request('kategori') == 'Wisata Alam' ? 'selected' : '' }}>🌿 Wisata Alam</option>
                <option value="Agrowisata" {{ request('kategori') == 'Agrowisata' ? 'selected' : '' }}>🍊 Agrowisata</option>
                <option value="Budaya & Event" {{ request('kategori') == 'Budaya & Event' ? 'selected' : '' }}>🎭 Budaya & Event</option>
                <option value="Eduwisata" {{ request('kategori') == 'Eduwisata' ? 'selected' : '' }}>📚 Eduwisata</option>
                <option value="Religi" {{ request('kategori') == 'Religi' ? 'selected' : '' }}>🕌 Religi</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="sort" class="form-select rounded-pill border shadow-sm py-2 px-3" onchange="this.form.submit()">
                <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>⬆️ Terbaru</option>
                <option value="harga_low" {{ request('sort') == 'harga_low' ? 'selected' : '' }}>💰 HTM Termurah</option>
                <option value="harga_high" {{ request('sort') == 'harga_high' ? 'selected' : '' }}>💎 HTM Tertinggi</option>
                <option value="judul_asc" {{ request('sort') == 'judul_asc' ? 'selected' : '' }}>🔤 A - Z</option>
                <option value="judul_desc" {{ request('sort') == 'judul_desc' ? 'selected' : '' }}>🔤 Z - A</option>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-success rounded-pill px-4 shadow-sm">Cari</button>
            @if(request('search') || (request('kategori') && request('kategori') != 'semua') || request('sort'))
                <a href="{{ url('/wisata') }}" class="btn btn-outline-secondary rounded-pill px-3 ms-1">Reset</a>
            @endif
        </div>
    </form>
</div>

<div class="container mb-5 pb-5">
    @if($wisata->total() > 0)
    <div class="text-muted small mb-3 text-center">
        Menampilkan <strong>{{ $wisata->total() }}</strong> destinasi
        @if(request('search')) <span>· Hasil pencarian: <em>"{{ request('search') }}"</em></span> @endif
        @if(request('kategori') && request('kategori') != 'semua') <span>· Kategori: <em>{{ request('kategori') }}</em></span> @endif
    </div>
    @endif
    <div class="row g-5">
        @forelse($wisata as $w)
        <div class="col-12" id="wisata-{{ $w->id }}">
            <div class="glass-card bg-white p-0 rounded-4 shadow-lg overflow-hidden border border-success border-opacity-10 mb-5" style="background: white;">
                <div class="row g-0">
                    <!-- Bagian Gambar -->
                    <div class="col-lg-5 position-relative" style="min-height: 400px;">
                        <img src="{{ $w->gambar }}" class="position-absolute w-100 h-100" style="object-fit: cover;" alt="{{ $w->judul }}">
                        <div class="position-absolute top-0 start-0 m-4 d-flex flex-column gap-2">
                            <span class="badge bg-success bg-opacity-90 text-white px-3 py-2 rounded-pill fw-bold shadow-sm" style="font-size:0.75rem;">
                                <i data-lucide="tag" class="icon-xs me-1"></i> {{ $w->kategori ?? 'Wisata Desa' }}
                            </span>
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold shadow-sm border border-warning">
                                <i data-lucide="map-pin" class="icon-sm me-1"></i> Area Desa Selorejo
                            </span>
                        </div>
                    </div>

                    <!-- Bagian Deskripsi -->
                    <div class="col-lg-7 p-4 p-md-5 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-4 border-bottom border-success border-opacity-10 pb-4">
                            <div>
                                <h2 class="fw-bold text-dark mb-1">{{ $w->judul }}</h2>
                                <p class="text-muted small mb-0 fw-medium d-flex align-items-center">
                                    <i data-lucide="info" class="icon-sm me-2 text-primary"></i> Destinasi Unggulan Kecamatan Dau
                                </p>
                            </div>
                            <div class="text-end">
                                <div class="bg-success p-3 px-4 rounded-4 shadow-sm border border-white border-opacity-10 d-flex align-items-center">
                                    <i data-lucide="ticket" class="text-white icon-md me-3"></i>
                                    <div>
                                        <small class="text-white text-opacity-75 d-block lh-1 mb-1 fw-bold" style="font-size: 0.65rem; letter-spacing: 0.5px;">HARGA TIKET (HTM)</small>
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

                        <div class="text-dark lh-lg mb-5 flex-grow-1" style="text-align: justify; font-size: 1.05rem;">
                            @foreach(explode("\n\n", $w->deskripsi) as $paragraph)
                                <p class="mb-3">{{ $paragraph }}</p>
                            @endforeach
                        </div>

                        <div class="row g-3 mt-auto pt-4 border-top border-success border-opacity-10">
                            <!-- Jadwal Buka -->
                            <div class="col-md-6">
                                <div class="p-4 rounded-4 bg-success d-flex align-items-center h-100 shadow-sm">
                                    <i data-lucide="clock" class="text-white icon-md me-3"></i>
                                    <div>
                                        <small class="text-white text-opacity-75 d-block lh-1 mb-2 fw-bold">Jadwal Operasional</small>
                                        <p class="text-white mb-0 small fw-bold lh-sm">{!! nl2br(e($w->jadwal)) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Tata Tertib / Highlight -->
                            <div class="col-md-6">
                                <div class="p-4 rounded-4 bg-success d-flex align-items-center h-100 shadow-sm">
                                    <i data-lucide="shield-check" class="text-white icon-md me-3"></i>
                                    <div>
                                        <small class="text-white text-opacity-75 d-block lh-1 mb-2 fw-bold">Informasi Kunjungan</small>
                                        <p class="text-white mb-0 small fw-bold lh-sm">Wajib menjaga kelestarian alam dan kebersihan Desa.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted p-5 glass-panel">
            <i data-lucide="mountain" style="width:64px;height:64px;" class="opacity-25 mb-3 d-block mx-auto text-success"></i>
            @if(request('search') || request('kategori'))
                Destinasi wisata tidak ditemukan untuk filter yang dipilih.
                <div class="mt-3"><a href="{{ url('/wisata') }}" class="btn btn-outline-success rounded-pill px-4">Lihat Semua Wisata</a></div>
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
        <div class="p-4 p-md-5 rounded-4 bg-primary-custom text-white position-relative overflow-hidden shadow-lg border-0">
            <div class="position-absolute start-0 bottom-0 opacity-10" style="margin-left:-30px; margin-bottom:-30px;"><i data-lucide="map" style="width:200px; height:200px;"></i></div>
            <div class="position-relative z-1 py-4">
                <i data-lucide="navigation" class="icon-lg text-warning mb-4" style="width: 64px; height: 64px;"></i>
                <h2 class="fw-bold mb-3">Siap Menjelajahi Selorejo?</h2>
                <p class="lead mb-5 opacity-75">Manfaatkan panduan digital kami untuk menemukan rute tercepat menuju lokasi wisata.</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{ route('profil.peta') }}" class="btn btn-warning text-dark fw-bold px-5 py-3 rounded-pill shadow-lg hover-lift">
                        <i data-lucide="map-pin" class="icon-sm me-2"></i> Buka Panduan Peta Digital
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
