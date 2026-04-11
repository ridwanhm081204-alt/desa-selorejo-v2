@extends('layouts.dashboard')
@section('title', 'Operator Dashboard')
@section('content')
<div class="row g-4">
    <!-- Card Statistik -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 p-3 bg-white border-bottom border-4 border-primary">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted mb-2">Total Berita</h6>
                    <h2 class="fw-bold mb-0">{{ $jumlahBerita }}</h2>
                </div>
                <div class="bg-primary text-white p-3 rounded-3 opacity-75">
                    <i data-lucide="newspaper"></i>
                </div>
            </div>
            <a href="{{ url('/operator/berita') }}" class="small text-decoration-none mt-3 d-block text-primary">Lihat Detail &rarr;</a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 p-3 bg-white border-bottom border-4 border-success">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted mb-2">Pesan Baru</h6>
                    <h2 class="fw-bold mb-0">{{ $jumlahPesan }}</h2>
                </div>
                <div class="bg-success text-white p-3 rounded-3 opacity-75">
                    <i data-lucide="mail"></i>
                </div>
            </div>
            <a href="{{ url('/operator/pesan') }}" class="small text-decoration-none mt-3 d-block text-success">Cek Kotak Masuk &rarr;</a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 p-3 bg-white border-bottom border-4 border-warning">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted mb-2">Galeri Foto/Video</h6>
                    <h2 class="fw-bold mb-0">{{ $jumlahGaleri }}</h2>
                </div>
                <div class="bg-warning text-white p-3 rounded-3 opacity-75">
                    <i data-lucide="image"></i>
                </div>
            </div>
            <a href="{{ url('/operator/galeri') }}" class="small text-decoration-none mt-3 d-block text-warning">Kelola Galeri &rarr;</a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 p-3 bg-white border-bottom border-4 border-danger">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted mb-2">Produk Unggulan</h6>
                    <h2 class="fw-bold mb-0">{{ $jumlahProduk }}</h2>
                </div>
                <div class="bg-danger text-white p-3 rounded-3 opacity-75">
                    <i data-lucide="shopping-bag"></i>
                </div>
            </div>
            <a href="{{ url('/operator/produk') }}" class="small text-decoration-none mt-3 d-block text-danger">Kelola Produk &rarr;</a>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 p-4 glass-panel">
            <h5 class="fw-bold border-bottom pb-3 mb-4">Akses Cepat Pengelolaan Update</h5>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ url('/operator/profil') }}" class="btn btn-outline-success"><i data-lucide="edit-3" class="me-1" style="width:16px;"></i> Update Profil Desa</a>
                <a href="{{ url('/operator/wisata') }}" class="btn btn-outline-success"><i data-lucide="map" class="me-1" style="width:16px;"></i> Detail Wisata</a>
                <a href="{{ url('/operator/polling') }}" class="btn btn-outline-success"><i data-lucide="pie-chart" class="me-1" style="width:16px;"></i> Buat Jajak Pendapat</a>
                <a href="{{ url('/operator/settings/password') }}" class="btn btn-outline-secondary"><i data-lucide="lock" class="me-1" style="width:16px;"></i> Ganti Password</a>
            </div>
        </div>
    </div>
</div>
@endsection
