<!-- TOP BAR -->
<div class="py-2 text-white" style="background: var(--color-forest); color: #fff; font-family: var(--font-body); font-size: var(--text-xs);">
    <div class="container d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <span class="me-3"><i data-lucide="map-pin" class="icon-xs me-1"></i> Desa Selorejo, Dau, Malang</span>
            <span class="d-none d-sm-inline"><i data-lucide="mail" class="icon-xs me-1"></i> info@selorejo.desa.id</span>
        </div>
        <div class="d-flex align-items-center">
            <i data-lucide="calendar" class="me-1" style="width:12px;"></i>
            <span id="realtime-clock">Memuat waktu...</span>
        </div>
    </div>
</div>

<!-- HEADER (posisi sticky/fixed-top dengan Bootstrap) -->
<nav class="navbar navbar-expand-lg navbar-light sticky-top" style="background: #fff; border-bottom: 3px solid var(--accent);" id="mainNavbarWrapper">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/logo_desa.png') }}" alt="Logo Selorejo" class="me-3 shadow-sm" style="background: var(--color-forest); border-radius: var(--radius-sm); padding: 7px; width: 45px; height: 45px; object-fit: contain;">
            <div>
                <strong class="d-block" style="font-family: var(--font-display); font-size: 1.1rem; letter-spacing: 0.04em; color: #1a1a1a;">Pemerintah Desa Selorejo</strong>
                <small class="d-none d-md-block" style="font-family: var(--font-body); font-size: var(--text-xs); color: #4a4a4a;">Kec. Dau, Kab. Malang, Prov. Jawa Timur</small>
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
                        <li><a class="dropdown-item" href="{{ url('/wisata') }}"><i data-lucide="map-pin" class="icon-sm me-2"></i>Destinasi Wisata</a></li>
                        <li><a class="dropdown-item" href="{{ route('produk.index') }}"><i data-lucide="shopping-bag" class="icon-sm me-2"></i>Produk Unggulan</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-custom dropdown-toggle {{ request()->is('layanan*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown"><i data-lucide="file-text" class="icon-sm me-1"></i> Pelayanan</a>
                    <ul class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ route('layanan.index') }}"><i data-lucide="file-text" class="icon-sm me-2"></i>Pengajuan Dokumen</a></li>
                        <li><a class="dropdown-item" href="{{ route('layanan.cek-status') }}"><i data-lucide="search" class="icon-sm me-2"></i>Cek Status Berkas</a></li>
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
<div style="background: var(--accent); padding: 7px 0; border-bottom: 2px solid var(--accent-hover);">
    <div class="container d-flex align-items-center">
        <strong class="me-3 text-nowrap d-flex align-items-center" style="font-family: var(--font-body); font-size: var(--text-xs); font-weight: 600; color: var(--text-on-accent);"><i data-lucide="bell" style="width:16px; color: var(--text-on-accent);" class="me-1"></i> <span class="d-none d-md-inline">SEKILAS INFO:</span></strong>
        <marquee behavior="scroll" direction="left" scrollamount="5" style="font-family: var(--font-body); font-size: var(--text-xs); font-weight: 600; color: var(--text-on-accent);">
            @foreach($beritaTerbaru as $b)
                {{ $b->judul }} &nbsp;&nbsp;·&nbsp;&nbsp;
            @endforeach
        </marquee>
    </div>
</div>
@else
<div style="background: var(--accent); padding: 7px 0; border-bottom: 2px solid var(--accent-hover);">
    <div class="container d-flex align-items-center">
        <strong class="me-3 text-nowrap d-flex align-items-center" style="font-family: var(--font-body); font-size: var(--text-xs); font-weight: 600; color: var(--text-on-accent);"><i data-lucide="bell" style="width:16px; color: var(--text-on-accent);" class="me-1"></i> <span class="d-none d-md-inline">SEKILAS INFO:</span></strong>
        <marquee behavior="scroll" direction="left" scrollamount="5" style="font-family: var(--font-body); font-size: var(--text-xs); font-weight: 600; color: var(--text-on-accent);">Selamat datang di Website Desa Wisata Petik Jeruk Selorejo</marquee>
    </div>
</div>
@endif


