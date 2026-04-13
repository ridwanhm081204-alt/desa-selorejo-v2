@extends('layouts.dashboard')
@section('title', 'Operator Dashboard')
@section('content')

<!-- Welcome Banner -->
<div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden position-relative bg-success text-start" style="background: linear-gradient(45deg, #1b4332, #2d6a4f) !important;">
    <div class="card-body p-4 p-md-5 text-white position-relative z-1">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold mb-2">Selamat Datang, Operator Desa!</h2>
                <p class="opacity-75 mb-4 mb-md-0">E-Government Portal Desa Selorejo hadir untuk mempermudah transparansi dan pelayanan publik. Kelola seluruh aset digital desa Anda dari satu tempat.</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ url('/operator/profil') }}" class="btn btn-white rounded-pill px-4 py-2 fw-bold hover-lift shadow-sm" style="color: #1b4332 !important;">
                    <i data-lucide="edit-3" class="icon-sm me-1"></i> UPDATE PROFIL
                </a>
            </div>
        </div>
    </div>
    <!-- Decorative Circle -->
    <div class="position-absolute top-50 start-100 translate-middle bg-white opacity-10 rounded-circle" style="width: 300px; height: 300px;"></div>
</div>

<div class="row g-4 text-start">
    <!-- Card Statistik -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 p-3 bg-white hover-lift transition-all border-start border-4 border-primary">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted mb-1 small fw-bold">TOTAL BERITA</h6>
                    <h2 class="fw-bold mb-0 text-dark">{{ $jumlahBerita }}</h2>
                </div>
                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4">
                    <i data-lucide="newspaper"></i>
                </div>
            </div>
            <a href="{{ url('/operator/berita') }}" class="small text-decoration-none mt-3 d-flex align-items-center fw-bold text-primary">MANAJEMEN BERITA <i data-lucide="chevron-right" class="icon-xs ms-1"></i></a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 p-3 bg-white hover-lift transition-all border-start border-4 border-success">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted mb-1 small fw-bold">PESAN MASUK</h6>
                    <h2 class="fw-bold mb-0 text-dark">{{ $jumlahPesan }}</h2>
                </div>
                <div class="bg-success bg-opacity-10 text-success p-3 rounded-4">
                    <i data-lucide="mail"></i>
                </div>
            </div>
            <a href="{{ url('/operator/pesan') }}" class="small text-decoration-none mt-3 d-flex align-items-center fw-bold text-success">CEK KOTAK MASUK <i data-lucide="chevron-right" class="icon-xs ms-1"></i></a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 p-3 bg-white hover-lift transition-all border-start border-4 border-warning">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted mb-1 small fw-bold">ASET GALERI</h6>
                    <h2 class="fw-bold mb-0 text-dark">{{ $jumlahGaleri }}</h2>
                </div>
                <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-4">
                    <i data-lucide="image"></i>
                </div>
            </div>
            <a href="{{ url('/operator/galeri') }}" class="small text-decoration-none mt-3 d-flex align-items-center fw-bold text-warning">KELOLA MEDIA <i data-lucide="chevron-right" class="icon-xs ms-1"></i></a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 p-3 bg-white hover-lift transition-all border-start border-4 border-danger">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted mb-1 small fw-bold">PRODUK LOKAL</h6>
                    <h2 class="fw-bold mb-0 text-dark">{{ $jumlahProduk }}</h2>
                </div>
                <div class="bg-danger bg-opacity-10 text-danger p-3 rounded-4">
                    <i data-lucide="shopping-bag"></i>
                </div>
            </div>
            <a href="{{ url('/operator/produk') }}" class="small text-decoration-none mt-3 d-flex align-items-center fw-bold text-danger">MANAJEMEN PRODUK <i data-lucide="chevron-right" class="icon-xs ms-1"></i></a>
        </div>
    </div>
</div>

<div class="row mt-5 text-start">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white border-top border-4 border-success">
            <div class="d-flex align-items-center mb-5 border-bottom pb-4">
                <div class="bg-light text-success rounded-circle p-3 me-3">
                    <i data-lucide="zap" style="width:24px;height:24px;"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0">Akses Cepat Pengelolaan</h5>
                    <small class="text-muted">Pintasan navigasi untuk fitur yang sering digunakan</small>
                </div>
            </div>
            
            <div class="row g-3">
                <div class="col-6 col-md-3">
                    <a href="{{ url('/operator/wisata') }}" class="dash-card p-3 rounded-4 text-center d-block text-decoration-none transition-all hover-lift bg-light border-0 h-100">
                        <i data-lucide="map" class="text-success mb-2" style="width:32px;height:32px;"></i>
                        <div class="fw-bold text-dark small">Destinasi Wisata</div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ url('/operator/polling') }}" class="dash-card p-3 rounded-4 text-center d-block text-decoration-none transition-all hover-lift bg-light border-0 h-100">
                        <i data-lucide="pie-chart" class="text-success mb-2" style="width:32px;height:32px;"></i>
                        <div class="fw-bold text-dark small">Jajak Pendapat</div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ url('/operator/apbdes') }}" class="dash-card p-3 rounded-4 text-center d-block text-decoration-none transition-all hover-lift bg-light border-0 h-100">
                        <i data-lucide="file-spreadsheet" class="text-success mb-2" style="width:32px;height:32px;"></i>
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
