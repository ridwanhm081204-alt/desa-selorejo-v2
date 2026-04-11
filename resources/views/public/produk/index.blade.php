@extends('layouts.public')
@section('title', 'Katalog Produk Desa')
@section('breadcrumb')
    <li class="breadcrumb-item">Wisata & Produk</li>
    <li class="breadcrumb-item active">Produk Unggulan</li>
@endsection
@section('content')
<div class="section-hero-gradient pt-5 pb-4 mb-5 text-center text-white" style="min-height: auto;">
    <div class="container position-relative z-1">
        <h1 class="fw-bold mb-3"><i data-lucide="shopping-bag" class="me-2 text-warning"></i>Katalog Produk Desa</h1>
        <p class="lead fw-medium text-white-50">Mendukung karya lokal dan UMKM Desa Selorejo</p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <div class="row g-4">
        @forelse($produk as $p)
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm card-hover bg-white rounded-4 overflow-hidden d-flex flex-column">
                <div class="position-relative">
                    <img src="{{ $p->gambar_url }}" onerror="this.src='{{ asset('images/wisata_jeruk.png') }}'" class="card-img-top w-100 img-cover" style="height: 220px;" alt="{{ $p->nama }}">
                    <div class="position-absolute top-0 start-0 m-3">
                        <span class="badge bg-warning text-dark px-2 py-1 shadow-sm"><i data-lucide="star" class="icon-sm me-1"></i>Unggulan</span>
                    </div>
                </div>
                
                <div class="card-body p-4 d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="fw-bold text-dark mb-0 text-truncate" title="{{ $p->nama }}">{{ $p->nama }}</h5>
                    </div>
                    <p class="text-success fw-bold fs-5 mb-3">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                    
                    <p class="text-dark small text-truncate-2 flex-grow-1 mb-4">{{ Str::limit($p->deskripsi, 80) }}</p>
                    
                    <div class="d-flex justify-content-between align-items-center mt-auto border-top pt-3 border-success border-opacity-10">
                        <span class="badge bg-light text-muted border px-2 py-1"><i data-lucide="box" class="icon-sm me-1"></i>Stok: {{ $p->stok }}</span>
                        <a href="{{ url('/produk/'.$p->id) }}" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold">Detail</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted p-5 glass-card">Belum ada katalog produk yang ditambahkan.</div>
        @endforelse
    </div>
</div>
@endsection
