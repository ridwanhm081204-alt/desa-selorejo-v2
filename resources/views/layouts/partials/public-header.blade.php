<!-- HEADER (posisi sticky/fixed-top dengan Bootstrap) -->
<nav class="navbar navbar-expand-xl navbar-dark sticky-top py-2" style="background: var(--color-forest); border-bottom: 3px solid var(--accent);" id="mainNavbarWrapper">
    <div class="container-fluid px-3 px-xl-4 px-xxl-5">
        <a class="navbar-brand d-flex align-items-center me-3" href="{{ url('/') }}">
            <img src="{{ asset('images/logo_desa.png') }}?v={{ file_exists(public_path('images/logo_desa.png')) ? filemtime(public_path('images/logo_desa.png')) : '1' }}" alt="Logo Selorejo" class="me-3 shadow-sm" style="background: #fff; border-radius: var(--radius-sm); padding: 4px; width: 44px; height: 44px; object-fit: contain; margin-right: 14px !important;">
            <div>
                <strong class="d-block text-white" style="font-family: var(--font-display); font-size: 1.05rem; letter-spacing: 0.03em;">Pemerintah Desa Selorejo</strong>
                <small class="d-none d-md-block text-white-50" style="font-family: var(--font-body); font-size: 0.68rem; margin-bottom: 1px; color: rgba(255,255,255,0.85) !important;">Kec. Dau, Kab. Malang, Prov. Jawa Timur</small>
                <small class="d-block text-white-50" style="font-family: var(--font-body); font-size: 0.68rem; font-weight: 500; color: rgba(255,255,255,0.85) !important;">
                    <i data-lucide="calendar" class="me-1" style="width: 11px; height: 11px; vertical-align: middle; color: rgba(255,255,255,0.85) !important;"></i>
                    <span id="realtime-clock" style="vertical-align: middle;">Memuat waktu...</span>
                </small>
            </div>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-medium">
                <li class="nav-item"><a class="nav-link nav-link-custom {{ request()->is('/') ? 'active' : '' }}" href="{{ route('beranda') }}"><i data-lucide="home" class="icon-sm me-1"></i> Beranda</a></li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-custom dropdown-toggle {{ request()->is('profil*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown"><i data-lucide="building" class="icon-sm me-1"></i> Profil Desa</a>
                    <ul class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ route('profil.sejarah') }}">Sejarah</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.visi-misi') }}">Visi & Misi</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.geografis') }}">Geografis</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.peta') }}">Peta & Wilayah</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-custom dropdown-toggle {{ request()->is('pemerintahan*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown"><i data-lucide="users-2" class="icon-sm me-1"></i> Pemerintahan</a>
                    <ul class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ route('pemerintahan.struktur') }}">Struktur Organisasi</a></li>
                        <li><a class="dropdown-item" href="{{ route('pemerintahan.bpd') }}">BPD</a></li>
                        <li><a class="dropdown-item" href="{{ route('pemerintahan.lembaga') }}">Lembaga Desa</a></li>
                        <li><a class="dropdown-item" href="{{ route('pemerintahan.perangkat-rt-rw') }}">Perangkat RT & RW</a></li>
                        <li><a class="dropdown-item" href="{{ url('/pemerintahan/produkhukum') }}">Produk Hukum</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-custom dropdown-toggle {{ request()->is('layanan*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown"><i data-lucide="file-text" class="icon-sm me-1"></i> Layanan Kependudukan</a>
                    <ul class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ route('layanan.index') }}"><i data-lucide="file-text" class="icon-sm me-2"></i>Pengajuan Dokumen</a></li>
                        <li><a class="dropdown-item" href="{{ route('layanan.cek-status') }}"><i data-lucide="search" class="icon-sm me-2"></i>Cek Status Berkas</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-custom dropdown-toggle {{ request()->is('berita*') || request()->is('galeri*') || (request()->is('wisata*') && !request()->is('wisata/umkm*')) ? 'active' : '' }}" href="#" data-bs-toggle="dropdown"><i data-lucide="radio" class="icon-sm me-1"></i> Informasi Publik</a>
                    <ul class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ route('berita.index') }}"><i data-lucide="newspaper" class="icon-sm me-2"></i>Berita Desa</a></li>
                        <li><a class="dropdown-item" href="{{ route('galeri') }}"><i data-lucide="image" class="icon-sm me-2"></i>Galeri Foto & Video</a></li>
                        <li><a class="dropdown-item" href="{{ url('/wisata') }}"><i data-lucide="map-pin" class="icon-sm me-2"></i>Wisata Desa</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-custom dropdown-toggle {{ request()->is('produk*') || request()->is('wisata/umkm*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown"><i data-lucide="shopping-bag" class="icon-sm me-1"></i> Ekonomi & Produk</a>
                    <ul class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ route('produk.index') }}"><i data-lucide="shopping-bag" class="icon-sm me-2"></i>Produk Unggulan</a></li>
                        <li><a class="dropdown-item" href="{{ route('wisata.umkm') }}"><i data-lucide="store" class="icon-sm me-2"></i>Direktori UMKM</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-custom dropdown-toggle {{ request()->is('statistik*') || request()->is('transparansi*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown"><i data-lucide="bar-chart-3" class="icon-sm me-1"></i> Data & Transparansi</a>
                    <ul class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="{{ route('statistik') }}"><i data-lucide="bar-chart-2" class="icon-sm me-2"></i>Statistik Penduduk</a></li>
                        <li><a class="dropdown-item" href="{{ route('transparansi') }}"><i data-lucide="file-text" class="icon-sm me-2"></i>Transparansi APBDes</a></li>
                    </ul>
                </li>

                <li class="nav-item"><a class="nav-link nav-link-custom {{ request()->is('kontak*') ? 'active' : '' }}" href="{{ route('kontak.index') }}"><i data-lucide="message-square" class="icon-sm me-1"></i> Komunikasi</a></li>
            </ul>
        </div>
    </div>
</nav>

<style>
    #mainNavbar .nav-link-custom {
        padding-left: 0.35rem !important;
        padding-right: 0.35rem !important;
        font-size: 0.81rem !important;
        white-space: nowrap !important;
    }
    @media (min-width: 1300px) {
        #mainNavbar .nav-link-custom {
            padding-left: 0.55rem !important;
            padding-right: 0.55rem !important;
            font-size: 0.85rem !important;
        }
    }
    @media (min-width: 1440px) {
        #mainNavbar .nav-link-custom {
            padding-left: 0.7rem !important;
            padding-right: 0.7rem !important;
            font-size: 0.88rem !important;
        }
    }
</style>

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


