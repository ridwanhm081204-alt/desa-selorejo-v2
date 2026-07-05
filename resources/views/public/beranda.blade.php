@extends('layouts.public')

@section('title', 'Beranda')

@section('content')

<!-- A) HERO SECTION -->
<div class="section-hero-gradient d-flex align-items-center position-relative" style="height: 640px; min-height: 640px;">
    <!-- Background Slideshow -->
    <div class="hero-slideshow">
        <div class="hero-slide active" style="background-image: url('{{ asset('images/GapuraDesa.jpg') }}');"></div>
        <div class="hero-slide" style="background-image: url('{{ asset('images/Taman-Wisata-Selorejo.webp') }}');"></div>
        <div class="hero-slide" style="background-image: url('{{ asset('images/JerukSelorejo.jpg') }}');"></div>
    </div>
    
    <!-- Gradient Overlay -->
    <div class="hero-overlay" style="background: linear-gradient(to top, rgba(26,92,56,0.85) 0%, rgba(26,92,56,0.30) 70%, transparent 100%);"></div>

    <div class="container position-relative z-1">
        <div class="row justify-content-center text-center">
            <div class="col-lg-10 col-xl-9 text-white">
                <span class="badge bg-white mb-4 px-4 py-2 rounded-pill fw-bold shadow-sm" style="color: var(--color-forest) !important; font-family: var(--font-body); font-size: var(--text-sm); letter-spacing: 1px;">SUGENG RAWUH</span>
                <h1 class="display-3 mb-4 lh-sm fw-bold" style="text-shadow: 0 2px 15px rgba(0,0,0,0.7), 0 4px 30px rgba(0,0,0,0.5); font-family: var(--font-display); color: #fff; font-size: 3.8rem;">Desa Wisata <span style="color: var(--color-sunshine); text-shadow: 0 2px 15px rgba(0,0,0,0.7), 0 4px 30px rgba(0,0,0,0.5);">Petik Jeruk</span> Selorejo</h1>
                <p class="lead mb-5 fw-medium text-white" style="font-family: var(--font-body); font-size: 1.35rem; text-shadow: 0 2px 12px rgba(0,0,0,0.8), 0 1px 5px rgba(0,0,0,0.8);">Kecamatan Dau, Kabupaten Malang, Provinsi Jawa Timur</p>
                <div class="d-flex justify-content-center flex-wrap gap-3">
                    <a href="{{ url('/wisata') }}" class="btn px-5 py-3 shadow hover-lift" style="background: var(--accent); color: var(--text-on-accent); font-family: var(--font-heading); font-weight: 700; font-size: 1.1rem; border-radius: var(--radius-md); border: none;">Jelajahi Wisata</a>
                    <a href="{{ url('/profil/sejarah') }}" class="btn btn-outline-light px-5 py-3 shadow-sm fw-bold hover-lift" style="font-family: var(--font-heading); font-size: 1.1rem; border-radius: var(--radius-md);">Profil Desa</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- B-D) CONTENT OVERVIEW SECTION -->
<div class="content-overview py-5 my-0" style="background-color: var(--color-cream);">
    <!-- B) STATS BAR -->
    <div class="container mb-5">
        <div class="row g-4 justify-content-center">
            <div class="col-6 col-md-3">
                <div class="glass-stat py-4 px-3 text-center bg-white rounded-4 shadow-sm border border-light">
                    <i data-lucide="users" class="mb-2 icon-xl" style="color: var(--color-forest);"></i>
                    <h3 class="stat-counter mb-0 fw-bold" style="font-family: var(--font-heading); color: var(--color-forest);">{{ \App\Models\Setting::get('jumlah_penduduk', '3.640') }}</h3>
                    <span class="text-muted small fw-medium" style="font-family: var(--font-body);">Total Penduduk</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="glass-stat py-4 px-3 text-center bg-white rounded-4 shadow-sm border border-light">
                    <i data-lucide="home" class="mb-2 icon-xl" style="color: var(--color-forest);"></i>
                    <h3 class="stat-counter mb-0 fw-bold" style="font-family: var(--font-heading); color: var(--color-forest);">{{ \App\Models\Setting::get('jumlah_kk', '1.024') }}</h3>
                    <span class="text-muted small fw-medium" style="font-family: var(--font-body);">Jumlah KK</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="glass-stat py-4 px-3 text-center bg-white rounded-4 shadow-sm border border-light">
                    <i data-lucide="map" class="mb-2 icon-xl" style="color: var(--color-forest);"></i>
                    <h3 class="stat-counter mb-0 fw-bold" style="font-family: var(--font-heading); color: var(--color-forest);">{{ \App\Models\Setting::get('luas_wilayah', '623') }}</h3>
                    <span class="text-muted small fw-medium" style="font-family: var(--font-body);">Luas Wilayah (Ha)</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="glass-stat py-4 px-3 text-center bg-white rounded-4 shadow-sm border border-light">
                    <i data-lucide="layout" class="mb-2 icon-xl" style="color: var(--color-forest);"></i>
                    <h3 class="stat-counter mb-0 fw-bold" style="font-family: var(--font-heading); color: var(--color-forest);">{{ \App\Models\Setting::get('jumlah_dusun', '2') }}</h3>
                    <span class="text-muted small fw-medium" style="font-family: var(--font-body);">Jumlah Dusun</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container pt-2">
        <!-- C) SAMBUTAN KEPALA DESA -->
        <div class="glass-card mb-5 overflow-hidden border-0 bg-white shadow-sm rounded-4">
            <div class="row g-0 align-items-center">
                <div class="col-md-3 text-center p-3 p-md-4">
                    @if($widgetAparat && $widgetAparat->foto_kades)
                        <img src="{{ asset('storage/' . $widgetAparat->foto_kades) }}" class="img-fluid rounded-circle shadow-lg border border-4 border-light" style="width: 150px; height: 150px; object-fit: cover;" alt="{{ $widgetAparat->nama_kades }}" onerror="this.src='{{ asset('images/kades_selorejo.jpg') }}'">
                    @else
                        <img src="{{ asset('images/kades_selorejo.jpg') }}" class="img-fluid rounded-circle shadow-lg border border-4 border-light" style="width: 150px; height: 150px; object-fit: cover;" alt="Kades">
                    @endif
                </div>
                <div class="col-md-9 p-3 p-md-4 p-lg-5 text-center text-md-start">
                    <div class="section-heading-wrapper mb-3 text-center text-md-start">
                        <span class="section-label">DARI KEPALA DESA</span>
                        <h2 class="section-title" style="font-size: var(--text-2xl);">Sambutan Kepala Desa</h2>
                        <div class="section-divider"></div>
                    </div>
                    <h5 class="fw-bold mb-2 text-dark" style="font-family: var(--font-heading);">{{ $widgetAparat->nama_kades ?? 'Bambang Soponyono' }}</h5>
                    <p class="lead text-dark fst-italic" style="font-family: var(--font-body); font-size: var(--text-base); line-height: 1.7;">"{!! nl2br(e($widgetAparat->sambutan ?? 'Selamat datang di website resmi Desa Selorejo. Kami berkomitmen untuk mewujudkan desa yang mandiri dan berdaya saing melalui digitalisasi dan pengembangan agrowisata.')) !!}"</p>
                </div>
            </div>
        </div>

        <!-- D) SHORTCUT LAYANAN CEPAT -->
        <div class="mb-3">
            <div class="section-heading-wrapper text-center mb-4">
                <span class="section-label">NAVIGASI CEPAT</span>
                <h2 class="section-title">Akses Layanan Desa</h2>
                <div class="section-divider justify-content-center"></div>
            </div>
            
            <div class="row g-4 text-center">
                <div class="col-6 col-md-3">
                    <a href="{{ url('/wisata') }}" class="quick-btn py-4 d-block text-center shadow-sm">
                        <i data-lucide="map-pin" class="mx-auto mb-2 icon-xl"></i>
                        <h6 class="mb-0 fw-bold">Lokasi Wisata</h6>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ url('/kontak') }}" class="quick-btn py-4 d-block text-center shadow-sm">
                        <i data-lucide="phone" class="mx-auto mb-2 icon-xl"></i>
                        <h6 class="mb-0 fw-bold">Hubungi Desa</h6>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('produk.index') }}" class="quick-btn py-4 d-block text-center shadow-sm">
                        <i data-lucide="shopping-bag" class="mx-auto mb-2 icon-xl"></i>
                        <h6 class="mb-0 fw-bold">Produk Desa</h6>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ url('/galeri') }}" class="quick-btn py-4 d-block text-center shadow-sm">
                        <i data-lucide="image" class="mx-auto mb-2 icon-xl"></i>
                        <h6 class="mb-0 fw-bold">Galeri Foto</h6>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- E) POTENSI WISATA -->
<div class="py-5 my-0 text-white position-relative" style="background: var(--color-forest);">
    <div class="container py-3">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="{{ asset('images/wisata_jeruk.png') }}" alt="Wisata Petik Jeruk" class="img-fluid rounded-4 shadow-lg h-100 object-fit-cover border border-white border-opacity-10">
            </div>
            <div class="col-md-6 ps-md-5">
                <div class="section-heading-wrapper mb-4">
                    <span class="section-label" style="color: var(--accent) !important;">DESTINASI UNGGULAN</span>
                    <h2 class="section-title text-white">Wisata Petik Jeruk Keprok</h2>
                    <div class="section-divider"></div>
                </div>
                @if($wisata)
                    <p class="lead mb-4" style="font-family: var(--font-body); font-size: var(--text-base); line-height: 1.8; color: rgba(255,255,255,0.9);">{{ Str::limit($wisata->deskripsi, 250) }}</p>
                @else
                    <p class="lead mb-4" style="font-family: var(--font-body); font-size: var(--text-base); line-height: 1.8; color: rgba(255,255,255,0.9);">Datang dan rasakan sensasi memetik buah jeruk keprok segar langsung dari pohonnya dengan pemandangan alam perbukitan yang hijau dan menyejukkan mata.</p>
                @endif
                <a href="{{ url('/wisata') }}" class="btn px-4 py-2 fw-bold shadow-sm" style="background: var(--accent); color: var(--text-on-accent); border: none; font-family: var(--font-heading); border-radius: var(--radius-sm); transition: transform 0.2s;">
                    Selengkapnya <i data-lucide="arrow-right" class="icon-sm ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- F) PRODUK UNGGULAN -->
<div class="py-5" style="background: var(--color-cream);">
    <div class="container py-3">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div class="section-heading-wrapper mb-0">
                <span class="section-label">PRODUK DESA</span>
                <h2 class="section-title">Produk Unggulan</h2>
                <div class="section-divider"></div>
            </div>
            <a href="{{ route('produk.index') }}" class="btn rounded-pill px-4" style="border: 2px solid var(--color-forest); color: var(--color-forest); font-family: var(--font-heading); font-weight: 600; transition: all 0.2s; background: transparent;">Lihat Semua</a>
        </div>

        <div id="produkCarousel" class="carousel slide" data-bs-ride="false" data-bs-interval="false">
            <div class="carousel-inner">
                @forelse($produk->chunk(3) as $index => $chunk)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="row g-4 pb-4">
                        @foreach($chunk as $p)
                        <div class="col-md-4">
                            <a href="{{ url('/produk/'.$p->id) }}" class="text-decoration-none">
                                <div class="produk-card card h-100 overflow-hidden bg-white">
                                    <img src="{{ $p->gambar_url }}" onerror="this.src='{{ asset('images/wisata_jeruk.png') }}'" class="card-img-top img-cover" style="height: 200px;">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="stok-badge tersedia">Stok: {{ $p->stok }}</span>
                                            <div class="harga fw-bold mb-0">Rp {{ number_format($p->harga,0,',','.') }}</div>
                                        </div>
                                        <h5 class="fw-bold text-dark" style="font-family: var(--font-heading);">{{ $p->nama }}</h5>
                                        <p class="text-dark small text-truncate-2" style="font-family: var(--font-body);">{{ Str::limit($p->deskripsi, 80) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-muted py-5 bg-white rounded-4 shadow-sm border">Belum ada produk unggulan ditambahkan.</div>
                @endforelse
            </div>
            
            <!-- Custom Pagination Style Controls -->
            @if($produk->count() > 3)
            <div class="mt-4">
                <ul class="pagination-custom" id="produkPagination">
                    <li class="page-item" id="prevPage">
                        <a class="page-link-custom" href="javascript:void(0)" data-bs-target="#produkCarousel" data-bs-slide="prev">
                            <i data-lucide="chevron-left" class="icon-sm"></i>
                        </a>
                    </li>
                    
                    @foreach($produk->chunk(3) as $index => $chunk)
                    <li class="page-item {{ $index == 0 ? 'active' : '' }}" data-slide-to-item="{{ $index }}">
                        <a class="page-link-custom" href="javascript:void(0)" data-bs-target="#produkCarousel" data-bs-slide-to="{{ $index }}">
                            {{ $index + 1 }}
                        </a>
                    </li>
                    @endforeach
                    
                    <li class="page-item" id="nextPage">
                        <a class="page-link-custom" href="javascript:void(0)" data-bs-target="#produkCarousel" data-bs-slide="next">
                            <i data-lucide="chevron-right" class="icon-sm"></i>
                        </a>
                    </li>
                </ul>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- G & H) BERITA TERBARU & POLLING -->
<div class="py-5" style="background: #fff;">
    <div class="container py-3">
        <div class="row g-5">
            <!-- Berita Area -->
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <div class="section-heading-wrapper mb-0">
                        <span class="section-label">INFORMASI</span>
                        <h2 class="section-title">Berita Terbaru</h2>
                        <div class="section-divider"></div>
                    </div>
                    <a href="{{ route('berita.index') }}" class="btn rounded-pill px-4" style="border: 2px solid var(--color-forest); color: var(--color-forest); font-family: var(--font-heading); font-weight: 600; transition: all 0.2s; background: transparent;">Semua Berita</a>
                </div>
                
                <div id="beritaCarousel" class="carousel slide" data-bs-ride="false" data-bs-interval="false">
                    <div class="carousel-inner">
                        @forelse($berita->chunk(4) as $index => $chunk)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="row g-4 pb-4">
                                @foreach($chunk as $b)
                                <div class="col-md-6">
                                    <a href="{{ url('/berita/'.$b->slug) }}" class="text-decoration-none">
                                        <div class="berita-card card-hover d-flex align-items-start gap-3 p-3 h-100">
                                            <img src="{{ $b->gambar_url }}" onerror="this.src='{{ asset('images/hero_desa.png') }}'" class="rounded-3" style="width: 100px; height: 100px; object-fit: cover;">
                                            <div class="flex-grow-1">
                                                <span class="badge badge-kategori mb-2">{{ $b->kategori }}</span>
                                                <h6 class="fw-bold mb-1 lh-sm text-dark text-truncate-2" style="font-family: var(--font-heading);">{{ $b->judul }}</h6>
                                                <small class="text-muted" style="font-family: var(--font-body);"><i data-lucide="calendar" class="icon-sm me-1"></i>{{ \Carbon\Carbon::parse($b->tanggal)->translatedFormat('d F Y') }}</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center py-4 bg-light rounded-4 border text-muted">Belum ada berita yang diterbitkan.</div>
                        @endforelse
                    </div>

                    <!-- Custom Pagination Style Controls for News -->
                    @if($berita->count() > 4)
                    <div class="mt-4">
                        <ul class="pagination-custom" id="beritaPagination">
                            <li class="page-item" id="prevBerita">
                                <a class="page-link-custom" href="javascript:void(0)" data-bs-target="#beritaCarousel" data-bs-slide="prev">
                                    <i data-lucide="chevron-left" class="icon-sm"></i>
                                </a>
                            </li>
                            
                            @foreach($berita->chunk(4) as $index => $chunk)
                            <li class="page-item {{ $index == 0 ? 'active' : '' }}" data-slide-to-item="{{ $index }}">
                                <a class="page-link-custom" href="javascript:void(0)" data-bs-target="#beritaCarousel" data-bs-slide-to="{{ $index }}">
                                    {{ $index + 1 }}
                                </a>
                            </li>
                            @endforeach
                            
                            <li class="page-item" id="nextBerita">
                                <a class="page-link-custom" href="javascript:void(0)" data-bs-target="#beritaCarousel" data-bs-slide="next">
                                    <i data-lucide="chevron-right" class="icon-sm"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Polling Sidebar Area -->
            <div class="col-lg-4">
                <div class="section-heading-wrapper mb-4">
                    <span class="section-label">POLLING WARGA</span>
                    <h2 class="section-title">Jejak Pendapat</h2>
                    <div class="section-divider"></div>
                </div>
                
                @if($pollings->count() > 0)
                <div id="pollingCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($pollings as $index => $polling)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="glass-card text-white p-4 rounded-4 shadow-sm position-relative overflow-hidden" style="background: var(--color-forest) !important; border: none;">
                                <div class="position-relative z-1">
                                    <p class="lead mb-4 fw-medium text-white" style="font-family: var(--font-body); font-size: var(--text-base);">{{ $polling->pertanyaan }}</p>
                                    
                                    @if(session('success') && session('polling_id') == $polling->id)
                                        <div class="alert alert-light text-success fw-bold p-2 text-center rounded-3 mb-4"><i data-lucide="check-circle" class="icon-sm me-1"></i>{{ session('success') }}</div>
                                    @endif
                                    @if(session('error') && session('polling_id') == $polling->id)
                                        <div class="alert alert-warning p-2 text-center rounded-3 mb-4"><i data-lucide="alert-circle" class="icon-sm me-1"></i>{{ session('error') }}</div>
                                    @endif

                                    <form action="{{ route('polling.vote', $polling->id) }}" method="POST" class="mb-4">
                                        @csrf
                                        <div class="d-grid gap-2">
                                            <button type="submit" name="answer" value="ya" class="btn btn-light fw-bold rounded-pill hover-lift shadow-sm" style="color: var(--color-forest) !important;">Ya, Setuju</button>
                                            <button type="submit" name="answer" value="tidak" class="btn btn-poll-no rounded-pill hover-lift" style="background: rgba(255,255,255,0.15) !important; color: #fff !important; border: 1px solid rgba(255,255,255,0.3) !important;">Tidak Setuju</button>
                                        </div>
                                    </form>
                                    
                                    @php 
                                        $total = $polling->totalVotes(); 
                                        $pctYa = $total > 0 ? round(($polling->jumlah_ya / $total) * 100) : 0;
                                        $pctTidak = $total > 0 ? round(($polling->jumlah_tidak / $total) * 100) : 0;
                                    @endphp
                                    
                                    <div class="pt-3 border-top border-light border-opacity-25">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <small class="text-white">Hasil Sementara: <strong>{{ $total }} Suara</strong></small>
                                            @if($pollings->count() > 1)
                                                <span class="badge bg-white rounded-pill" style="color: var(--color-forest) !important;">{{ $index + 1 }} / {{ $pollings->count() }}</span>
                                            @endif
                                        </div>
                                        <div class="progress rounded-pill bg-light bg-opacity-25 mb-3" style="height: 12px;">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $pctYa }}%; background: var(--accent);" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="d-flex justify-content-between small text-white fw-bold" style="font-family: var(--font-body);">
                                            <span><i data-lucide="thumbs-up" class="icon-xs me-1"></i> Ya: {{ $pctYa }}% <span class="opacity-75 fw-normal">({{ $polling->jumlah_ya }} suara)</span></span>
                                            <span><i data-lucide="thumbs-down" class="icon-xs me-1"></i> Tidak: {{ $pctTidak }}% <span class="opacity-75 fw-normal">({{ $polling->jumlah_tidak }} suara)</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    @if($pollings->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#pollingCarousel" data-bs-slide="prev" style="width: 10%;">
                        <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(1) grayscale(100) brightness(2);"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#pollingCarousel" data-bs-slide="next" style="width: 10%;">
                        <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(1) grayscale(100) brightness(2);"></span>
                    </button>
                    @endif
                </div>
                @else
                <div class="glass-card bg-light p-4 rounded-4 text-center text-muted border">
                    <i data-lucide="info" class="mx-auto mb-2 text-muted icon-xl"></i>
                    <p class="mb-0">Belum ada polling aktif saat ini.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- I) GALERI PREVIEW CAROUSEL -->
<div class="py-5 text-white" style="background: var(--color-forest);">
    <div class="container py-3">
        <div class="section-heading-wrapper text-center mb-5">
            <span class="section-label" style="color: var(--accent);">DOKUMENTASI</span>
            <h2 class="section-title text-white">Potret Desa Selorejo</h2>
            <div class="section-divider justify-content-center"></div>
        </div>
        
        <div id="galeriCarousel" class="carousel slide" data-bs-ride="false" data-bs-interval="false">
            <div class="carousel-inner">
                @forelse($galeri->chunk(3) as $index => $chunk)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="row g-3 pb-4">
                        @foreach($chunk as $g)
                        <div class="col-md-4">
                            <div class="card-hover rounded-4 overflow-hidden position-relative shadow-sm lightbox-trigger border border-white border-opacity-10" 
                                 style="cursor: pointer;"
                                 data-src="{{ $g->gambar_url }}"
                                 data-caption="{{ $g->caption }}"
                                 data-category="{{ $g->kategori }}"
                                 data-date="{{ $g->tanggal ? $g->tanggal->translatedFormat('l, d F Y') : '-' }}">
                                <img src="{{ $g->gambar_url }}" class="w-100" style="height: 280px; object-fit: cover;" onerror="this.src='{{ asset('images/hero_desa.png') }}'">
                                <div class="position-absolute bottom-0 w-100 p-3" style="background: linear-gradient(transparent, rgba(0,0,0,0.8)); opacity:0; transition: opacity 0.3s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0">
                                    <p class="text-white mb-0 small fw-medium text-center">{{ $g->caption ?? 'Dokumentasi' }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-white-50 py-5 bg-white bg-opacity-5 rounded-4 border border-white border-opacity-10">Belum ada foto galeri ditambahkan.</div>
                @endforelse
            </div>

            <!-- Custom Pagination Style Controls for Gallery -->
            @if($galeri->count() > 3)
            <div class="mt-2">
                <ul class="pagination-custom" id="galeriPagination">
                    <li class="page-item" id="prevGaleri">
                        <a class="page-link-custom" href="javascript:void(0)" data-bs-target="#galeriCarousel" data-bs-slide="prev">
                            <i data-lucide="chevron-left" class="icon-sm"></i>
                        </a>
                    </li>
                    
                    @foreach($galeri->chunk(3) as $index => $chunk)
                    <li class="page-item {{ $index == 0 ? 'active' : '' }}" data-slide-to-item="{{ $index }}">
                        <a class="page-link-custom" href="javascript:void(0)" data-bs-target="#galeriCarousel" data-bs-slide-to="{{ $index }}">
                            {{ $index + 1 }}
                        </a>
                    </li>
                    @endforeach
                    
                    <li class="page-item" id="nextGaleri">
                        <a class="page-link-custom" href="javascript:void(0)" data-bs-target="#galeriCarousel" data-bs-slide="next">
                            <i data-lucide="chevron-right" class="icon-sm"></i>
                        </a>
                    </li>
                </ul>
            </div>
            @endif
        </div>

        <div class="text-center mt-5">
            <a href="{{ url('/galeri') }}" class="btn px-5 py-2 fw-bold shadow-sm" style="background: var(--accent); color: var(--text-on-accent); border: none; font-family: var(--font-heading); border-radius: var(--radius-sm); transition: transform 0.2s;">Lihat Semua Foto</a>
        </div>
    </div>
</div>

@include('layouts.partials.lightbox')

<!-- J & K) PETA GOOGLE MAPS & TAUTAN TERKAIT -->
<div class="py-5" style="background: #fff;">
    <div class="container py-3">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="section-heading-wrapper mb-4">
                    <span class="section-label">LOKASI FISIK</span>
                    <h2 class="section-title">Peta Desa Selorejo</h2>
                    <div class="section-divider"></div>
                </div>
                <div class="rounded-4 overflow-hidden shadow-sm ratio ratio-16x9 border border-light" style="min-height: 330px;">
                    {!! $profile->peta_embed ?? '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15806.384864810932!2d112.53843605!3d-7.937170050000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7883ef912d9999%3A0xf8ff8468809efd9c!2sSelorejo%2C%20Kec.%20Dau%2C%20Kabupaten%20Malang%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1775912011055!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>' !!}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="section-heading-wrapper mb-4">
                    <span class="section-label">INFORMASI EKSTERNAL</span>
                    <h2 class="section-title">Tautan Terkait</h2>
                    <div class="section-divider"></div>
                </div>
                <div class="list-group list-group-flush rounded-4 shadow-sm border border-light bg-white">
                    @if(isset($tautanTerkait) && count($tautanTerkait) > 0)
                        @foreach($tautanTerkait as $tautan)
                        <a href="{{ $tautan->url }}" target="_blank" class="list-group-item list-group-item-action d-flex align-items-center py-3 border-bottom border-light" style="font-family: var(--font-body);">
                            <i data-lucide="external-link" class="icon-sm me-3" style="color: var(--color-forest);"></i>
                            <span class="text-dark fw-medium">{{ $tautan->nama }}</span>
                        </a>
                        @endforeach
                    @else
                        <div class="list-group-item py-4 text-center text-muted">Belum ada tautan terkait.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Function to handle Carousel + Custom Pagination Sync
        const setupCustomCarousel = (carouselId, paginationId) => {
            const carouselEl = document.getElementById(carouselId);
            const paginationEl = document.getElementById(paginationId);
            if (!carouselEl || !paginationEl) return;

            const initCarousel = () => {
                if (typeof bootstrap !== 'undefined' && bootstrap.Carousel) {
                    const carousel = new bootstrap.Carousel(carouselEl, {
                        interval: false,
                        ride: false
                    });

                    const prevBtn = paginationEl.querySelector('.page-item:first-child');
                    const nextBtn = paginationEl.querySelector('.page-item:last-child');
                    const paginationItems = paginationEl.querySelectorAll('.page-item[data-slide-to-item]');
                    const totalSlides = paginationItems.length;

                    carouselEl.addEventListener('slide.bs.carousel', function (event) {
                        const index = event.to;
                        paginationItems.forEach(item => item.classList.remove('active'));
                        if (paginationItems[index]) paginationItems[index].classList.add('active');

                        if (index === 0) prevBtn.classList.add('disabled');
                        else prevBtn.classList.remove('disabled');

                        if (index === totalSlides - 1) nextBtn.classList.add('disabled');
                        else nextBtn.classList.remove('disabled');
                    });

                    // Initial State
                    if (totalSlides > 0) {
                        prevBtn.classList.add('disabled');
                        if (totalSlides === 1) nextBtn.classList.add('disabled');
                    }
                } else {
                    setTimeout(initCarousel, 100);
                }
            };
            initCarousel();
        };

        // Setup carousels
        setupCustomCarousel('produkCarousel', 'produkPagination');
        setupCustomCarousel('beritaCarousel', 'beritaPagination');
        setupCustomCarousel('galeriCarousel', 'galeriPagination');
    });
</script>

@endsection
