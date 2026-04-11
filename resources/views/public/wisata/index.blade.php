@extends('layouts.public')
@section('title', 'Wisata Petik Jeruk')
@section('breadcrumb')
    <li class="breadcrumb-item">Wisata & Produk</li>
    <li class="breadcrumb-item active">Wisata Petik Jeruk</li>
@endsection
@section('content')
<div class="section-hero-gradient pt-5 pb-4 mb-5 text-center text-white" style="{{ $wisata && $wisata->gambar ? 'background: linear-gradient(rgba(27,67,50,0.85), rgba(45,106,79,0.9)), url('.asset('storage/'.$wisata->gambar).') center/cover;' : '' }}">
    <div class="container position-relative z-1">
        <h1 class="fw-bold mb-3"><i data-lucide="map" class="me-2 text-warning"></i>{{ $wisata->judul ?? 'Wisata Petik Jeruk' }}</h1>
        <p class="lead fw-medium text-white-50">Jelajahi segarnya alam dan manisnya hasil panen lokal kami.</p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8 pe-lg-4">
            <div class="glass-card bg-white p-4 p-md-5 rounded-4 shadow-sm border-0 border-top border-5 border-success h-100">
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3"><i data-lucide="info" class="icon-sm me-1"></i> Detail Agrowisata</span>
                <h3 class="fw-bold text-dark mb-4">Mengenal Wisata Jeruk Selorejo</h3>
                <div class="text-muted lh-lg" style="text-align: justify;">
                    {!! nl2br(e($wisata->deskripsi ?? 'Informasi wisata mendetail belum tersedia.')) !!}
                </div>
                
                <div class="mt-5 pt-4 border-top border-success border-opacity-10">
                    <h4 class="fw-bold text-primary-custom mb-3"><i data-lucide="alert-circle" class="icon-sm me-2"></i>Tata Tertib Pengunjung</h4>
                    <div class="bg-success bg-opacity-10 p-4 rounded-4 border border-success border-opacity-25">
                        <p class="mb-0 fw-medium text-dark lh-lg">
                            {!! nl2br(e($wisata->aturan ?? '-')) !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-lg bg-primary-custom text-white rounded-4 overflow-hidden mb-4 hover-lift position-relative">
                <div class="position-absolute end-0 bottom-0 opacity-10" style="margin-right:-20px; margin-bottom:-20px;"><i data-lucide="ticket" style="width:150px; height:150px;"></i></div>
                <div class="card-body p-4 p-md-5 text-center position-relative z-1">
                    <div class="bg-white text-success rounded-circle p-3 d-inline-block shadow-sm mb-4">
                        <i data-lucide="ticket" class="icon-lg"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Harga Tiket Masuk</h5>
                    <h2 class="fw-bold text-warning mb-0 display-5">Rp {{ number_format($wisata->harga_tiket ?? 0, 0, ',', '.') }}</h2>
                    <small class="text-white-50 d-block mt-2">Per Orang (Termasuk Fasilitas Dasar)</small>
                </div>
            </div>
            
            <div class="glass-card bg-white p-4 rounded-4 shadow-sm border border-success border-opacity-10 hover-lift">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-success text-white rounded p-2 me-3 shadow-sm"><i data-lucide="clock" class="icon-md"></i></div>
                    <h5 class="fw-bold text-dark mb-0">Jadwal Buka</h5>
                </div>
                <div class="bg-light p-3 rounded-3 text-center border">
                    <p class="mb-0 fw-bold text-dark fs-5">{!! nl2br(e($wisata->jadwal ?? 'Setiap Hari')) !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
