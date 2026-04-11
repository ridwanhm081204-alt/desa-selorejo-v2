@extends('layouts.public')
@section('title', $produk->nama)
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/produk') }}" class="text-decoration-none text-success">Produk</a></li>
    <li class="breadcrumb-item active">{{ $produk->nama }}</li>
@endsection
@section('content')
<div class="container mb-5 my-5">
    <div class="row g-5">
        <div class="col-md-6 text-center">
            <img src="{{ $produk->gambar_url }}" onerror="this.src='{{ asset('images/wisata_jeruk.png') }}'" class="img-fluid rounded-4 shadow-lg" style="object-fit: cover; width: 100%; max-height:500px;">
        </div>
        <div class="col-md-6 d-flex flex-column justify-content-center">
            <h1 class="fw-bold text-dark">{{ $produk->nama }}</h1>
            <h3 class="text-success fw-bold mb-4">Rp {{ number_format($produk->harga, 0, ',', '.') }}</h3>
            
            <div class="p-3 bg-light rounded-3 mb-4 border-start border-4 border-success">
                <span class="d-block fw-bold mb-1">Status Stok:</span>
                <span class="badge bg-{{ $produk->stok == 'Tersedia' ? 'success' : 'warning text-dark' }}">{{ $produk->stok ?? 'Menunggu Info' }}</span>
            </div>
            
            <h5 class="fw-bold mb-3">Deskripsi Produk</h5>
            <div class="text-dark" style="line-height: 1.8; font-weight: 400;">{!! $produk->deskripsi !!}</div>
            
            <a href="https://wa.me/{{\App\Models\Setting::get('whatsapp', '')}}?text=Halo%20saya%20ingin%20memesan%20produk%20{{ urlencode($produk->nama) }}" target="_blank" class="btn btn-success btn-lg mt-4 w-100 py-3 fw-bold rounded-pill shadow-sm hover-lift">
                <i data-lucide="message-circle" class="me-2"></i> Pesan via WhatsApp
            </a>
        </div>
    </div>
</div>
@endsection
