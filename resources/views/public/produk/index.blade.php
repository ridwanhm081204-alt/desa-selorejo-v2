@extends('layouts.public')
@section('title', 'Katalog Produk Desa')
@section('breadcrumb')
    <li class="breadcrumb-item">Wisata & Produk</li>
    <li class="breadcrumb-item active">Produk Unggulan</li>
@endsection
@section('content')
@include('layouts.partials.page-hero', [
    'title' => $hero['title'] ?? 'Katalog Produk Desa',
    'subtitle' => $hero['subtitle'] ?? 'Mendukung karya lokal dan UMKM Desa Selorejo',
    'icon' => $hero['icon'] ?? 'shopping-bag'
])

<div class="container mb-4">
    <form action="{{ url('/produk') }}" method="GET" class="row g-2 align-items-center justify-content-center">
        <div class="col-md-4">
            <div class="input-group rounded-pill overflow-hidden border bg-white shadow-sm px-3">
                <span class="input-group-text bg-transparent border-0"><i data-lucide="search" class="icon-sm text-success"></i></span>
                <input type="text" name="search" class="form-control border-0 shadow-none py-2" placeholder="Cari produk unggulan..." value="{{ request('search') }}">
            </div>
        </div>
        <div class="col-md-2">
            <select name="kategori" class="form-select rounded-pill border shadow-sm py-2 px-3" onchange="this.form.submit()">
                <option value="semua" {{ request('kategori') == 'semua' || !request('kategori') ? 'selected' : '' }}>🏷️ Semua Kategori</option>
                <option value="Jeruk Segar" {{ request('kategori') == 'Jeruk Segar' ? 'selected' : '' }}>🍊 Jeruk Segar</option>
                <option value="Olahan Buah" {{ request('kategori') == 'Olahan Buah' ? 'selected' : '' }}>🥤 Olahan Buah</option>
                <option value="Makanan" {{ request('kategori') == 'Makanan' ? 'selected' : '' }}>🍪 Makanan</option>
                <option value="Minuman" {{ request('kategori') == 'Minuman' ? 'selected' : '' }}>🧴 Minuman</option>
                <option value="Kerajinan" {{ request('kategori') == 'Kerajinan' ? 'selected' : '' }}>🪴 Kerajinan</option>
                <option value="Pertanian" {{ request('kategori') == 'Pertanian' ? 'selected' : '' }}>🌱 Pertanian</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="sort" class="form-select rounded-pill border shadow-sm py-2 px-3" onchange="this.form.submit()">
                <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>⬆️ Terbaru</option>
                <option value="harga_low" {{ request('sort') == 'harga_low' ? 'selected' : '' }}>💰 Termurah</option>
                <option value="harga_high" {{ request('sort') == 'harga_high' ? 'selected' : '' }}>💎 Termahal</option>
                <option value="nama_asc" {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>🔤 A - Z</option>
                <option value="nama_desc" {{ request('sort') == 'nama_desc' ? 'selected' : '' }}>🔤 Z - A</option>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-success rounded-pill px-4 shadow-sm">Cari</button>
            @if(request('search') || (request('kategori') && request('kategori') != 'semua') || request('sort'))
                <a href="{{ url('/produk') }}" class="btn btn-outline-secondary rounded-pill px-3 ms-1">Reset</a>
            @endif
        </div>
    </form>
</div>

<div class="container mb-5 pb-5">
    @if($produk->total() > 0)
    <div class="text-muted small mb-3 text-center">
        Menampilkan <strong>{{ $produk->total() }}</strong> produk
        @if(request('search')) <span>· Hasil pencarian: <em>"{{ request('search') }}"</em></span> @endif
        @if(request('kategori') && request('kategori') != 'semua') <span>· Kategori: <em>{{ request('kategori') }}</em></span> @endif
    </div>
    @endif
    <div class="row g-4">
        @forelse($produk as $p)
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm card-hover bg-white rounded-4 overflow-hidden d-flex flex-column">
                <div class="position-relative">
                    <img src="{{ $p->gambar_url }}" onerror="this.src='{{ asset('images/wisata_jeruk.png') }}'" class="card-img-top w-100 img-cover" style="height: 220px;" alt="{{ $p->nama }}">
                    <div class="position-absolute top-0 start-0 m-3">
                        <span class="badge bg-success bg-opacity-90 text-white px-2 py-1 shadow-sm rounded-pill" style="font-size:0.7rem;">
                            <i data-lucide="tag" class="icon-xs me-1"></i>{{ $p->kategori ?? 'Produk Desa' }}
                        </span>
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
        <div class="col-12 text-center text-muted p-5 glass-card">
            <i data-lucide="shopping-bag" style="width:64px;height:64px;" class="opacity-25 mb-3 d-block mx-auto text-success"></i>
            @if(request('search') || request('kategori'))
                Produk tidak ditemukan untuk filter yang dipilih.
                <div class="mt-3"><a href="{{ url('/produk') }}" class="btn btn-outline-success rounded-pill px-4">Lihat Semua Produk</a></div>
            @else
                Belum ada katalog produk yang ditambahkan.
            @endif
        </div>
        @endforelse
    </div>
    @if($produk->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $produk->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
