@extends('layouts.dashboard')
@section('title', 'Operator Dashboard')
@section('content')

<!-- Welcome Banner -->
<div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden position-relative text-start" style="background: linear-gradient(45deg, var(--primary-dark), var(--primary)) !important;">
    <div class="card-body p-4 p-md-5 text-white position-relative z-1">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold mb-2" style="font-family: var(--font-heading);">Selamat Datang, Operator Desa!</h2>
                <p class="opacity-75 mb-4 mb-md-0" style="font-family: var(--font-body);">E-Government Portal Desa Selorejo hadir untuk mempermudah transparansi dan pelayanan publik. Kelola seluruh aset digital desa Anda dari satu tempat.</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ url('/operator/profil') }}" class="btn rounded-pill px-4 py-2 fw-bold hover-lift shadow-sm" style="background-color: var(--accent) !important; color: var(--text-on-accent) !important; font-family: var(--font-heading); border: none;">
                    <i data-lucide="edit-3" class="icon-sm me-1"></i> UPDATE PROFIL
                </a>
            </div>
        </div>
    </div>
    <!-- Decorative Circle -->
    <div class="position-absolute top-50 start-100 translate-middle opacity-10 rounded-circle" style="width: 300px; height: 300px; background-color: var(--accent) !important;"></div>
</div>

<div class="row g-4 text-start" style="font-family: var(--font-body);">
    <!-- Card Statistik -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 p-3 bg-white hover-lift transition-all" style="border-left: 4px solid var(--color-forest) !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted mb-1 small fw-bold">TOTAL BERITA</h6>
                    <h2 class="fw-bold mb-0 text-dark">{{ $jumlahBerita }}</h2>
                </div>
                <div class="p-3 rounded-4" style="background-color: rgba(26,92,56,0.1) !important; color: var(--color-forest) !important;">
                    <i data-lucide="newspaper"></i>
                </div>
            </div>
            <a href="{{ url('/operator/berita') }}" class="small text-decoration-none mt-3 d-flex align-items-center fw-bold" style="color: var(--color-forest) !important;">MANAJEMEN BERITA <i data-lucide="chevron-right" class="icon-xs ms-1"></i></a>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 p-3 bg-white hover-lift transition-all" style="border-left: 4px solid var(--color-kiwi) !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted mb-1 small fw-bold">PESAN MASUK</h6>
                    <h2 class="fw-bold mb-0 text-dark">{{ $jumlahPesan }}</h2>
                </div>
                <div class="p-3 rounded-4" style="background-color: rgba(124,181,24,0.1) !important; color: var(--color-kiwi) !important;">
                    <i data-lucide="mail"></i>
                </div>
            </div>
            <a href="{{ url('/operator/pesan') }}" class="small text-decoration-none mt-3 d-flex align-items-center fw-bold" style="color: var(--color-kiwi) !important;">CEK KOTAK MASUK <i data-lucide="chevron-right" class="icon-xs ms-1"></i></a>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 p-3 bg-white hover-lift transition-all" style="border-left: 4px solid var(--color-sunshine) !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted mb-1 small fw-bold">ASET GALERI</h6>
                    <h2 class="fw-bold mb-0 text-dark">{{ $jumlahGaleri }}</h2>
                </div>
                <div class="p-3 rounded-4" style="background-color: rgba(245,197,24,0.1) !important; color: var(--color-sunshine) !important;">
                    <i data-lucide="image"></i>
                </div>
            </div>
            <a href="{{ url('/operator/galeri') }}" class="small text-decoration-none mt-3 d-flex align-items-center fw-bold" style="color: var(--color-sunshine) !important;">KELOLA MEDIA <i data-lucide="chevron-right" class="icon-xs ms-1"></i></a>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 p-3 bg-white hover-lift transition-all" style="border-left: 4px solid var(--color-carro) !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted mb-1 small fw-bold">PRODUK LOKAL</h6>
                    <h2 class="fw-bold mb-0 text-dark">{{ $jumlahProduk }}</h2>
                </div>
                <div class="p-3 rounded-4" style="background-color: rgba(242,101,34,0.1) !important; color: var(--color-carro) !important;">
                    <i data-lucide="shopping-bag"></i>
                </div>
            </div>
            <a href="{{ url('/operator/produk') }}" class="small text-decoration-none mt-3 d-flex align-items-center fw-bold" style="color: var(--color-carro) !important;">MANAJEMEN PRODUK <i data-lucide="chevron-right" class="icon-xs ms-1"></i></a>
        </div>
    </div>
</div>

<div class="row mt-5 text-start">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white" style="border-top: 4px solid var(--color-forest) !important;">
            <div class="d-flex align-items-center mb-5 border-bottom pb-4" style="border-bottom-color: var(--color-forest)1a !important;">
                <div class="bg-light rounded-circle p-3 me-3" style="color: var(--color-forest) !important;">
                    <i data-lucide="zap" style="width:24px;height:24px;"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0" style="font-family: var(--font-heading);">Akses Cepat Pengelolaan</h5>
                    <small class="text-muted" style="font-family: var(--font-body);">Pintasan navigasi untuk fitur yang sering digunakan</small>
                </div>
            </div>
            
            <div class="row g-3" style="font-family: var(--font-body);">
                <div class="col-6 col-md-3">
                    <a href="{{ url('/operator/wisata') }}" class="dash-card p-3 rounded-4 text-center d-block text-decoration-none transition-all hover-lift bg-light border-0 h-100">
                        <i data-lucide="map" class="mb-2" style="width:32px;height:32px; color: var(--color-forest) !important;"></i>
                        <div class="fw-bold text-dark small">Destinasi Wisata</div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ url('/operator/polling') }}" class="dash-card p-3 rounded-4 text-center d-block text-decoration-none transition-all hover-lift bg-light border-0 h-100">
                        <i data-lucide="pie-chart" class="mb-2" style="width:32px;height:32px; color: var(--color-forest) !important;"></i>
                        <div class="fw-bold text-dark small">Jajak Pendapat</div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ url('/operator/apbdes') }}" class="dash-card p-3 rounded-4 text-center d-block text-decoration-none transition-all hover-lift bg-light border-0 h-100">
                        <i data-lucide="file-spreadsheet" class="mb-2" style="width:32px;height:32px; color: var(--color-forest) !important;"></i>
                        <div class="fw-bold text-dark small">Transparansi Dana</div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ url('/operator/settings/password') }}" class="dash-card p-3 rounded-4 text-center d-block text-decoration-none transition-all hover-lift bg-light border-0 h-100">
                        <i data-lucide="lock" class="text-muted mb-2" style="width:32px;height:32px;"></i>
                        <div class="fw-bold text-dark small">Ganti Password</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
