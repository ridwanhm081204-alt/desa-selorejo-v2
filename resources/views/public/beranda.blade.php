@extends('layouts.public')

@section('title', 'Beranda')

@section('content')

<!-- A) HERO SECTION -->
<div class="section-hero-gradient d-flex align-items-center position-relative" style="min-height: 85vh;">
    <!-- Background Slideshow -->
    <div class="hero-slideshow">
        <div class="hero-slide active" style="background-image: url('{{ asset('images/GapuraDesa.jpg') }}');"></div>
        <div class="hero-slide" style="background-image: url('{{ asset('images/Taman-Wisata-Selorejo.webp') }}');"></div>
        <div class="hero-slide" style="background-image: url('{{ asset('images/JerukSelorejo.jpg') }}');"></div>
    </div>
    
    <!-- Gradient Overlay -->
    <div class="hero-overlay"></div>

    <div class="container position-relative z-1">
        <div class="row align-items-center">
            <div class="col-lg-6 text-white pe-lg-5">
                <span class="badge bg-white text-primary-custom mb-3 px-3 py-2 rounded-pill fw-bold shadow-sm">Sugeng Rawuh</span>
                <h1 class="display-4 fw-bold mb-3 lh-sm" style="text-shadow: 0 2px 10px rgba(0,0,0,0.3);">Desa Wisata<br><span class="text-warning">Petik Jeruk</span> Selorejo</h1>
                <p class="lead mb-4 fw-medium text-white">Kecamatan Dau, Kabupaten Malang, Jawa Timur</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ url('/wisata') }}" class="btn btn-accent-custom px-4 shadow">Jelajahi Wisata</a>
                    <a href="{{ url('/profil/sejarah') }}" class="btn btn-outline-white px-4 shadow-sm fw-bold">Profil Desa</a>
                </div>
            </div>
            <!-- Bagian Kanan Dihapus sesuai permintaan user -->
        </div>
    </div>
</div>

<!-- B-D) CONTENT OVERVIEW SECTION -->
<div class="content-overview py-5" style="background-color: #fbfbfb;">
    <!-- B) STATS BAR -->
    <div class="container mb-5">
        <div class="row g-4 justify-content-center">
            <div class="col-6 col-md-3">
                <div class="glass-stat py-4 px-3 text-center">
                    <i data-lucide="users" class="text-success mb-2 icon-xl"></i>
                    <h3 class="stat-counter mb-0">{{ \App\Models\Setting::get('jumlah_penduduk', '3.640') }}</h3>
                    <span class="text-muted small fw-medium">Total Penduduk</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="glass-stat py-4 px-3 text-center">
                    <i data-lucide="home" class="text-success mb-2 icon-xl"></i>
                    <h3 class="stat-counter mb-0">{{ \App\Models\Setting::get('jumlah_kk', '1.024') }}</h3>
                    <span class="text-muted small fw-medium">Jumlah KK</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="glass-stat py-4 px-3 text-center">
                    <i data-lucide="map" class="text-success mb-2 icon-xl"></i>
                    <h3 class="stat-counter mb-0">{{ \App\Models\Setting::get('luas_wilayah', '623') }}</h3>
                    <span class="text-muted small fw-medium">Luas Wilayah (Ha)</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="glass-stat py-4 px-3 text-center">
                    <i data-lucide="layout" class="text-success mb-2 icon-xl"></i>
                    <h3 class="stat-counter mb-0">{{ \App\Models\Setting::get('jumlah_dusun', '2') }}</h3>
                    <span class="text-muted small fw-medium">Jumlah Dusun</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container pt-2">
        <!-- C) SAMBUTAN KEPALA DESA -->
        <div class="glass-card mb-5 overflow-hidden border-0 bg-white" style="background: rgba(255,255,255,0.85);">
            <div class="row g-0 align-items-center">
                <div class="col-md-3 text-center p-4">
                    @if($widgetAparat && $widgetAparat->foto_kades)
                        <img src="{{ asset('storage/' . $widgetAparat->foto_kades) }}" class="img-fluid rounded-circle shadow-lg border border-4 border-white" style="width: 180px; height: 180px; object-fit: cover;" alt="{{ $widgetAparat->nama_kades }}" onerror="this.src='{{ asset('images/kades_selorejo.jpg') }}'">
                    @else
                        <img src="{{ asset('images/kades_selorejo.jpg') }}" class="img-fluid rounded-circle shadow-lg border border-4 border-white" style="width: 180px; height: 180px; object-fit: cover;" alt="Kades">
                    @endif
                </div>
                <div class="col-md-9 p-4 p-lg-5 ps-md-0">
                    <span class="badge bg-success mb-2"><i data-lucide="mic" class="icon-sm me-1"></i> Sambutan Kepala Desa</span>
                    <h3 class="fw-bold mb-3 text-dark">{{ $widgetAparat->nama_kades ?? 'Bambang Soponyono' }}</h3>
                    <p class="lead text-dark fst-italic">"{!! nl2br(e($widgetAparat->sambutan ?? 'Selamat datang di website resmi Desa Selorejo. Kami berkomitmen untuk mewujudkan desa yang mandiri dan berdaya saing melalui digitalisasi dan pengembangan agrowisata.')) !!}"</p>
                </div>
            </div>
        </div>

        <!-- D) SHORTCUT LAYANAN CEPAT -->
        <div class="row g-4 mb-3 text-center">
            <div class="col-6 col-md-3">
                <a href="{{ url('/wisata') }}" class="text-decoration-none">
                    <div class="card-hover h-100 bg-white py-4 rounded-4 border border-success border-bottom-4 border-opacity-25" style="border-bottom-width:4px !important;">
                        <i data-lucide="map-pin" class="mx-auto mb-2 text-success icon-xl"></i>
                        <h6 class="mb-0 fw-bold text-dark">Lokasi Wisata</h6>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ url('/kontak') }}" class="text-decoration-none">
                    <div class="card-hover h-100 bg-white py-4 rounded-4 border border-success border-bottom-4 border-opacity-25" style="border-bottom-width:4px !important;">
                        <i data-lucide="phone" class="mx-auto mb-2 text-success icon-xl"></i>
                        <h6 class="mb-0 fw-bold text-dark">Hubungi Desa</h6>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ url('/produk') }}" class="text-decoration-none">
                    <div class="card-hover h-100 bg-white py-4 rounded-4 border border-success border-bottom-4 border-opacity-25" style="border-bottom-width:4px !important;">
                        <i data-lucide="shopping-bag" class="mx-auto mb-2 text-success icon-xl"></i>
                        <h6 class="mb-0 fw-bold text-dark">Produk Desa</h6>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ url('/galeri') }}" class="text-decoration-none">
                    <div class="card-hover h-100 bg-white py-4 rounded-4 border border-success border-bottom-4 border-opacity-25" style="border-bottom-width:4px !important;">
                        <i data-lucide="image" class="mx-auto mb-2 text-success icon-xl"></i>
                        <h6 class="mb-0 fw-bold text-dark">Galeri Foto</h6>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- E) POTENSI WISATA -->
<div class="section-green py-5 my-5 text-white position-relative">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="{{ asset('images/wisata_jeruk.png') }}" alt="Wisata Petik Jeruk" class="img-fluid rounded-4 shadow-lg h-100 object-fit-cover">
            </div>
            <div class="col-md-6 ps-md-5">
                <span class="badge bg-warning text-dark mb-2 rounded-pill px-3 py-2"><i data-lucide="star" class="icon-sm me-1"></i> Destinasi Unggulan</span>
                <h2 class="fw-bold mb-4">Wisata Petik Jeruk Keprok</h2>
                @if($wisata)
                    <p class="lead mb-4">{{ Str::limit($wisata->deskripsi, 250) }}</p>
                @else
                    <p class="lead mb-4">Datang dan rasakan sensasi memetik buah jeruk keprok segar langsung dari pohonnya dengan pemandangan alam perbukitan yang hijau dan menyejukkan mata.</p>
                @endif
                <a href="{{ url('/wisata') }}" class="btn btn-outline-warning fw-bold px-4 rounded-pill shadow-sm hover-lift">Selengkapnya <i data-lucide="arrow-right" class="icon-sm ms-1"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    
    <!-- F) PRODUK UNGGULAN -->
    <div class="mb-5 pb-3">
        <div class="d-flex justify-content-between align-items-end mb-4 border-bottom border-2 pb-2 border-success border-opacity-25">
            <h3 class="fw-bold mb-0 text-dark"><i data-lucide="shopping-cart" class="text-success me-2"></i>Produk Unggulan</h3>
            <a href="{{ url('/produk') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">Lihat Semua</a>
        </div>

        <div id="produkCarousel" class="carousel slide" data-bs-ride="false" data-bs-interval="false">
            <div class="carousel-inner">
                @forelse($produk->chunk(3) as $index => $chunk)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="row g-4 pb-4">
                        @foreach($chunk as $p)
                        <div class="col-md-4">
                            <a href="{{ url('/produk/'.$p->id) }}" class="text-decoration-none">
                                <div class="card h-100 border-0 shadow-sm card-hover rounded-4 overflow-hidden bg-white">
                                    <img src="{{ Str::startsWith($p->gambar, 'http') ? $p->gambar : asset('storage/'.$p->gambar) }}" onerror="this.src='{{ asset('images/wisata_jeruk.png') }}'" class="card-img-top img-cover" style="height: 200px;">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-2">
                                            <small class="badge bg-light text-success border border-success">{{ $p->stok }}</small>
                                            <h5 class="text-success fw-bold mb-0">Rp {{ number_format($p->harga,0,',','.') }}</h5>
                                        </div>
                                        <h5 class="fw-bold text-dark">{{ $p->nama }}</h5>
                                        <p class="text-muted small text-truncate-2">{{ Str::limit($p->deskripsi, 80) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-muted py-5 glass-card">Belum ada produk unggulan ditambahkan.</div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const carouselEl = document.getElementById('produkCarousel');
            if (!carouselEl) return;
            
            // Wait for Bootstrap to be available
            const initCarousel = () => {
                if (typeof bootstrap !== 'undefined' && bootstrap.Carousel) {
                    const carousel = new bootstrap.Carousel(carouselEl, {
                        interval: false,
                        ride: false
                    });

                    const prevBtn = document.getElementById('prevPage');
                    const nextBtn = document.getElementById('nextPage');
                    const paginationItems = document.querySelectorAll('#produkPagination .page-item[data-slide-to-item]');
                    const totalSlides = paginationItems.length;

                    carouselEl.addEventListener('slide.bs.carousel', function (event) {
                        const index = event.to;
                        
                        // Update Numeric Buttons
                        paginationItems.forEach(item => item.classList.remove('active'));
                        if(paginationItems[index]) paginationItems[index].classList.add('active');

                        // Update Prev/Next Buttons Disabled State
                        if (index === 0) {
                            prevBtn.classList.add('disabled');
                        } else {
                            prevBtn.classList.remove('disabled');
                        }

                        if (index === totalSlides - 1) {
                            nextBtn.classList.add('disabled');
                        } else {
                            nextBtn.classList.remove('disabled');
                        }
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
        });
    </script>

    <!-- G & H) BERITA TERBARU & POLLING -->
    <div class="row g-5 mb-5 pb-4">
        <!-- Berita Area -->
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-end mb-4 border-bottom border-2 pb-2 border-success border-opacity-25">
                <h3 class="fw-bold mb-0 text-dark"><i data-lucide="newspaper" class="text-success me-2"></i>Kabar Desa</h3>
                <a href="{{ url('/berita') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">Semua Kabar</a>
            </div>
            
            <div class="row g-4">
                @forelse($berita as $b)
                <div class="col-md-6 mb-2">
                    <a href="{{ url('/berita/'.$b->slug) }}" class="text-decoration-none">
                        <div class="card-hover d-flex align-items-start gap-3 bg-white p-3 rounded-4 shadow-sm border border-success border-opacity-10 h-100">
                            <img src="{{ $b->gambar_url ?? asset('images/hero_desa.png') }}" onerror="this.src='{{ asset('images/hero_desa.png') }}'" class="rounded-3" style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="flex-grow-1">
                                <span class="badge badge-kategori mb-2">{{ $b->kategori }}</span>
                                <h6 class="fw-bold mb-1 lh-sm text-dark">{{ $b->judul }}</h6>
                                <small class="text-muted"><i data-lucide="calendar" class="icon-sm me-1"></i>{{ \Carbon\Carbon::parse($b->tanggal)->format('d M Y') }}</small>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center py-4 glass-card text-muted">Belum ada berita yang diterbitkan.</div>
                @endforelse
            </div>
        </div>
        
        <!-- Polling Sidebar Area -->
        <div class="col-lg-4">
            <div class="d-flex justify-content-between align-items-end mb-4 border-bottom border-2 pb-2 border-success border-opacity-25">
                <h3 class="fw-bold mb-0 text-dark"><i data-lucide="pie-chart" class="text-success me-2"></i>Jajak Pendapat</h3>
            </div>
            
            @if($polling)
            <div class="glass-card bg-primary-custom text-white p-4 h-100 rounded-4 shadow-sm position-relative overflow-hidden">
                <div class="position-absolute opacity-10 end-0 bottom-0"><i data-lucide="help-circle" style="width: 150px; height: 150px;"></i></div>
                <div class="position-relative z-1">
                    <p class="lead mb-4 fw-medium text-white">{{ $polling->pertanyaan }}</p>
                    
                    @if(session('success'))
                        <div class="alert alert-light text-success fw-bold p-2 text-center rounded-3"><i data-lucide="check-circle" class="icon-sm me-1"></i>{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-warning p-2 text-center rounded-3"><i data-lucide="alert-circle" class="icon-sm me-1"></i>{{ session('error') }}</div>
                    @endif

                    <form action="#" method="GET" class="mb-4">
                        @csrf
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-light text-success fw-bold rounded-pill hover-lift shadow-sm" onclick="alert('Terima kasih! Suara Anda telah direkam.')">Ya, Setuju</button>
                            <button type="button" class="btn btn-outline-light rounded-pill hover-lift" onclick="alert('Terima kasih! Suara Anda telah direkam.')">Tidak Setuju</button>
                        </div>
                    </form>
                    
                    @php 
                        $total = $polling->totalVotes(); 
                        $pctYa = $total > 0 ? round(($polling->jumlah_ya / $total) * 100) : 0;
                        $pctTidak = $total > 0 ? round(($polling->jumlah_tidak / $total) * 100) : 0;
                    @endphp
                    
                    <div class="pt-3 border-top border-light border-opacity-25">
                        <small class="d-block mb-1 text-white-50">Hasil Sementara ({{ $total }} Suara)</small>
                        <div class="progress rounded-pill bg-light bg-opacity-25" style="height: 10px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $pctYa }}%" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2 small text-white-50 fw-bold">
                            <span>Ya: {{ $pctYa }}%</span>
                            <span>Tidak: {{ $pctTidak }}%</span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- I) GALERI PREVIEW -->
    <div class="mb-5 pb-5">
        <div class="text-center mb-5">
            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 mb-2"><i data-lucide="camera" class="icon-sm me-1"></i> Galeri Dokumentasi</span>
            <h2 class="fw-bold text-dark">Potret Desa Selorejo</h2>
        </div>
        <div class="row g-2">
            @forelse($galeri as $index => $g)
            @if($index < 6)
            <div class="col-md-4 col-6">
                <div class="card-hover rounded-3 overflow-hidden position-relative">
                    <img src="{{ Str::startsWith($g->url, 'http') ? $g->url : asset('storage/'.$g->url) }}" class="w-100" style="height: 250px; object-fit: cover;" onerror="this.src='{{ asset('images/hero_desa.png') }}'">
                    <div class="position-absolute bottom-0 w-100 p-3" style="background: linear-gradient(transparent, rgba(0,0,0,0.8)); opacity:0; transition: opacity 0.3s; cursor: pointer;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0">
                        <p class="text-white mb-0 small fw-medium text-center">{{ $g->caption ?? 'Dokumentasi' }}</p>
                    </div>
                </div>
            </div>
            @endif
            @empty
            <div class="col-12 text-center text-muted">Belum ada foto galeri.</div>
            @endforelse
        </div>
        <div class="text-center mt-4">
            <a href="{{ url('/galeri') }}" class="btn btn-outline-success rounded-pill px-4 fw-bold shadow-sm hover-lift">Lihat Semua Foto</a>
        </div>
    </div>

    <!-- J) PETA GOOGLE MAPS & K) TAUTAN TERKAIT -->
    <div class="row g-4 mb-5 pb-4">
        <div class="col-lg-8">
            <h4 class="fw-bold mb-3 border-bottom pb-2 text-dark"><i data-lucide="map" class="text-success me-2"></i>Lokasi Desa Selorejo</h4>
            <div class="rounded-4 overflow-hidden shadow-sm" style="height: 400px; border: 1px solid rgba(116,198,157,0.3);">
                {!! $profile->peta_embed ?? '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15806.384864810932!2d112.53843605!3d-7.937170050000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7883ef912d9999%3A0xf8ff8468809efd9c!2sSelorejo%2C%20Kec.%20Dau%2C%20Kabupaten%20Malang%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1775912011055!5m2!1sid!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>' !!}
            </div>
        </div>
        <div class="col-lg-4">
            <h4 class="fw-bold mb-3 border-bottom pb-2 text-dark"><i data-lucide="link" class="text-success me-2"></i>Tautan Terkait</h4>
            <div class="list-group list-group-flush rounded-4 shadow-sm border border-success border-opacity-10 bg-white">
                @if(isset($tautanTerkait) && count($tautanTerkait) > 0)
                    @foreach($tautanTerkait as $tautan)
                    <a href="{{ $tautan->url }}" target="_blank" class="list-group-item list-group-item-action d-flex align-items-center py-3 border-bottom border-light">
                        <i data-lucide="external-link" class="icon-sm text-success me-3"></i>
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

@endsection
