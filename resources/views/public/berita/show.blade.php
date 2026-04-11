@extends('layouts.public')
@section('title', $berita->judul)
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/berita') }}" class="text-success text-decoration-none">Kabar Desa</a></li>
    <li class="breadcrumb-item active">{{ \Illuminate\Support\Str::limit($berita->judul, 30) }}</li>
@endsection
@section('content')
<div class="container mb-5 my-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="fw-bold text-dark mb-3">{{ $berita->judul }}</h1>
            <div class="d-flex align-items-center text-muted mb-4 pb-3 border-bottom">
                <span class="badge bg-warning text-dark me-3">{{ $berita->kategori }}</span>
                <span class="me-3"><i data-lucide="calendar" class="me-1" style="width:16px;"></i> {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}</span>
                <span><i data-lucide="user" class="me-1" style="width:16px;"></i> {{ $berita->penulis ?? 'Admin' }}</span>
            </div>
            
            <img src="{{ $berita->gambar_url }}" class="img-fluid rounded-4 shadow-sm mb-4 w-100" style="max-height: 400px; object-fit:cover;">
            
            <div class="content text-justify" style="line-height:1.8; font-size:1.05rem;">
                {!! nl2br(e($berita->konten)) !!}
            </div>
            
            <div class="mt-5 pt-4 border-top">
                <h5 class="fw-bold mb-3">Bagikan Artikel Ini:</h5>
                <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' ' . url()->current()) }}" target="_blank" class="btn btn-success rounded-pill px-4 me-2"><i data-lucide="message-circle" class="me-1"></i> WhatsApp</a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="btn btn-primary rounded-pill px-4"><i data-lucide="facebook" class="me-1"></i> Facebook</a>
            </div>
        </div>
    </div>
</div>
@endsection
