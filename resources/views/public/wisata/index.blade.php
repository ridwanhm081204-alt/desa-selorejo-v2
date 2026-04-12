@extends('layouts.public')
@section('title', 'Destinasi Wisata Desa')
@section('breadcrumb')
    <li class="breadcrumb-item">Unit Usaha</li>
    <li class="breadcrumb-item active">Destinasi Wisata</li>
@endsection
@section('content')
@include('layouts.partials.page-hero', [
    'title' => 'Destinasi Wisata Selorejo',
    'subtitle' => 'Jelajahi keajaiban alam dan kearifan agrikultur di lereng pegunungan Malang.',
    'icon' => 'mountain'
])

<div class="container mb-5 pb-5">
    <div class="row g-5">
        @forelse($wisata as $w)
        <div class="col-12" id="wisata-{{ $w->id }}">
            <div class="glass-card bg-white p-0 rounded-4 shadow-lg overflow-hidden border border-success border-opacity-10 mb-5" style="background: white;">
                <div class="row g-0">
                    <!-- Bagian Gambar -->
                    <div class="col-lg-5 position-relative" style="min-height: 400px;">
                        <img src="{{ $w->gambar }}" class="position-absolute w-100 h-100" style="object-fit: cover;" alt="{{ $w->judul }}">
                        <div class="position-absolute top-0 start-0 m-4">
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
                                        <h4 class="fw-bold text-white mb-0">Rp {{ number_format($w->harga_tiket, 0, ',', '.') }}</h4>
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
        <div class="col-12 text-center text-muted p-5 glass-panel">Data objek wisata sedang diperbarui oleh pengelola.</div>
        @endforelse
    </div>

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
