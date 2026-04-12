<!-- HEADER (posisi sticky/fixed-top dengan Bootstrap) -->
<div class="bg-primary-custom text-white py-1">
    <div class="container d-flex justify-content-between align-items-center small">
        <div class="d-flex align-items-center">
            <i data-lucide="calendar" class="me-2" style="width:14px;"></i>
            <span id="realtime-clock"></span>
        </div>
        <div>
            <a href="#" class="text-white me-2 hover-accent"><i data-lucide="facebook" style="width:14px;"></i></a>
            <a href="#" class="text-white me-2 hover-accent"><i data-lucide="instagram" style="width:14px;"></i></a>
            <a href="#" class="text-white me-3 hover-accent"><i data-lucide="youtube" style="width:14px;"></i></a>
            <a href="{{ url('/login') }}" class="text-white text-decoration-none fw-bold hover-accent"><i data-lucide="log-in" class="me-1" style="width:14px;"></i> Login Admin</a>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark glass-navbar sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/logo_desa.png') }}" alt="Logo Selorejo" class="me-3 shadow-sm" style="width: 45px; height: 45px; object-fit: contain;">
            <div>
                <strong class="d-block text-white" style="font-size: 1.1rem;">Pemerintah Desa Selorejo</strong>
                <small class="text-white d-block" style="font-size: 0.75rem; opacity: 0.9;">Kec. Dau, Kab. Malang, Prov. Jawa Timur</small>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-medium">
                <li class="nav-item"><a class="nav-link nav-link-custom {{ request()->is('/') ? 'active' : '' }}" href="{{ route('beranda') }}"><i data-lucide="home" class="icon-sm me-1"></i> Beranda</a></li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-custom dropdown-toggle {{ request()->is('profil*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown"><i data-lucide="info" class="icon-sm me-1"></i> Profil Desa</a>
                    <ul class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ route('profil.sejarah') }}">Sejarah</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.visi-misi') }}">Visi & Misi</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.geografis') }}">Geografis</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.peta') }}">Peta</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-custom dropdown-toggle {{ request()->is('pemerintahan*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown"><i data-lucide="users" class="icon-sm me-1"></i> Pemerintahan</a>
                    <ul class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ route('pemerintahan.struktur') }}">Struktur Organisasi</a></li>
                        <li><a class="dropdown-item" href="{{ route('pemerintahan.bpd') }}">BPD</a></li>
                        <li><a class="dropdown-item" href="{{ route('pemerintahan.lembaga') }}">Lembaga Desa</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-custom dropdown-toggle {{ request()->is('wisata*') || request()->is('produk*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown"><i data-lucide="map-pin" class="icon-sm me-1"></i> Wisata & Produk</a>
                    <ul class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ route('wisata') }}"><i data-lucide="map-pin" class="icon-sm me-2"></i>Destinasi Wisata</a></li>
                        <li><a class="dropdown-item" href="{{ route('produk.index') }}"><i data-lucide="shopping-bag" class="icon-sm me-2"></i>Produk Unggulan</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-custom dropdown-toggle {{ request()->is('statistik*') || request()->is('transparansi*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown"><i data-lucide="bar-chart-2" class="icon-sm me-1"></i> Data Desa</a>
                    <ul class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ route('statistik') }}"><i data-lucide="bar-chart-2" class="icon-sm me-2"></i>Statistik Penduduk</a></li>
                        <li><a class="dropdown-item" href="{{ route('transparansi') }}"><i data-lucide="file-text" class="icon-sm me-2"></i>Transparansi APBDes</a></li>
                    </ul>
                </li>

                <li class="nav-item"><a class="nav-link nav-link-custom {{ request()->is('berita*') ? 'active' : '' }}" href="{{ route('berita.index') }}"><i data-lucide="newspaper" class="icon-sm me-1"></i> Berita</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom {{ request()->is('galeri*') ? 'active' : '' }}" href="{{ route('galeri') }}"><i data-lucide="image" class="icon-sm me-1"></i> Galeri</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom {{ request()->is('kontak*') ? 'active' : '' }}" href="{{ route('kontak.index') }}"><i data-lucide="mail" class="icon-sm me-1"></i> Kontak</a></li>
            </ul>
        </div>
    </div>
</nav>

@php
    $beritaTerbaru = \App\Models\Berita::where('status_publish', 'publish')->orderBy('tanggal', 'desc')->get();
@endphp

@if($beritaTerbaru->count() > 0)
<div class="bg-white text-dark py-2 small shadow-sm border-bottom border-light">
    <div class="container d-flex align-items-center">
        <strong class="me-3 text-nowrap text-dark fw-bold"><i data-lucide="bell" style="width:16px" class="me-1 text-danger"></i> SEKILAS INFO:</strong>
        <marquee behavior="scroll" direction="left" scrollamount="5" class="text-dark fw-bold">
            @foreach($beritaTerbaru as $b)
                {{ $b->judul }} &nbsp; ★ &nbsp; 
            @endforeach
        </marquee>
    </div>
</div>
@else
<div class="bg-white text-dark py-2 small shadow-sm border-bottom border-light">
    <div class="container d-flex align-items-center">
        <strong class="me-3 text-nowrap text-dark fw-bold"><i data-lucide="bell" style="width:16px" class="me-1 text-danger"></i> SEKILAS INFO:</strong>
        <marquee behavior="scroll" direction="left" scrollamount="5" class="text-dark fw-bold">Selamat datang di Website Desa Wisata Petik Jeruk Selorejo</marquee>
    </div>
</div>
@endif


