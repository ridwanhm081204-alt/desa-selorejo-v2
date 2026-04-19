@extends('layouts.public')

@section('title', $wisata->judul . ' - Destinasi Wisata')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/wisata') }}" class="text-decoration-none text-success">Destinasi Wisata</a></li>
    <li class="breadcrumb-item active text-truncate" style="max-width: 200px;">{{ $wisata->judul }}</li>
@endsection

@section('content')
<div class="container py-4 py-md-5">
    <div class="row align-items-lg-start">
        <!-- GAMBAR & INFO UTAMA -->
        <div class="col-lg-8 mb-4">
            <div class="glass-card bg-white p-0 rounded-4 shadow-lg overflow-hidden border border-success border-opacity-10 mb-4">
                <div class="position-relative" style="height: 450px;">
                    <img src="{{ $wisata->gambar }}" onerror="this.src='{{ asset('images/wisata_jeruk.png') }}'" class="w-100 h-100 object-fit-cover" alt="{{ $wisata->judul }}">
                    
                    <div class="position-absolute bottom-0 start-0 w-100 p-4 p-md-5" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);">
                        <div class="d-flex gap-2 mb-3">
                            <span class="badge bg-success bg-opacity-90 text-white px-3 py-2 rounded-pill fw-bold shadow-sm" style="font-size:0.85rem;">
                                <i data-lucide="tag" class="icon-xs me-1"></i> {{ $wisata->kategori ?? 'Wisata Alam' }}
                            </span>
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold shadow-sm border border-warning" style="font-size:0.85rem;">
                                <i data-lucide="map-pin" class="icon-sm me-1"></i> Area Selorejo
                            </span>
                        </div>
                        <h1 class="fw-bold text-white mb-0 display-6" style="text-shadow: 0 2px 4px rgba(0,0,0,0.5);">{{ $wisata->judul }}</h1>
                    </div>
                </div>
                
                <div class="p-4 p-md-5">
                    <h4 class="fw-bold text-dark border-bottom pb-2 mb-4 d-flex align-items-center">
                        <i data-lucide="info" class="text-success me-2"></i> Deskripsi Destinasi
                    </h4>
                    
                    <div class="text-dark lh-lg mb-4" style="text-align: justify; font-size: 1.1rem; opacity: 0.9;">
                        @foreach(explode("\n\n", $wisata->deskripsi) as $paragraph)
                            <p class="mb-3">{{ $paragraph }}</p>
                        @endforeach
                    </div>

                    <!-- Reaksi Area -->
                    <div class="mt-5 pt-4 border-top text-center">
                        <h5 class="fw-bold mb-3 small text-muted text-uppercase tracking-wider">Apakah destinasi ini menarik?</h5>
                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                            <button type="button" class="btn btn-outline-success rounded-pill px-4 d-flex align-items-center gap-2 btn-react" data-type="like" id="btn-like">
                                <i data-lucide="thumbs-up" class="icon-sm"></i> Menarik (<span id="likes-count">{{ $wisata->likes }}</span>)
                            </button>
                            <button type="button" class="btn btn-outline-danger rounded-pill px-4 d-flex align-items-center gap-2 btn-react" data-type="dislike" id="btn-dislike">
                                <i data-lucide="thumbs-down" class="icon-sm"></i> Biasa Saja (<span id="dislikes-count">{{ $wisata->dislikes }}</span>)
                            </button>
                        </div>
                        <div class="mt-3 d-flex align-items-center justify-content-center text-muted small">
                            <i data-lucide="eye" class="icon-sm me-1"></i> {{ number_format($wisata->views) }}x dilihat
                        </div>
                        <div id="reaction-message" class="text-success small mt-2 d-none fw-bold">Terima kasih atas tanggapan Anda!</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- SIDEBAR INFO TIKET & JADWAL -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 100px; z-index: 10;">
                
                <div class="card p-4 rounded-4 shadow-sm border-0 border-top border-4 border-success mb-4 bg-white">
                    <h5 class="fw-bold mb-4 text-center text-dark">Informasi Tiket & Akses</h5>
                    
                    <div class="bg-light p-3 rounded-3 mb-3 text-center border overflow-hidden">
                        <small class="text-muted fw-bold d-block mb-1">HARGA TIKET MASUK (HTM)</small>
                        <h2 class="fw-bold text-success mb-0">
                            @if($wisata->harga_tiket == 0)
                                GRATIS
                            @else
                                Rp {{ number_format($wisata->harga_tiket, 0, ',', '.') }}
                            @endif
                        </h2>
                    </div>

                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item px-0 py-3 d-flex align-items-start border-bottom">
                            <i data-lucide="clock" class="text-warning me-3 mt-1"></i>
                            <div>
                                <strong class="d-block mb-1">Jadwal Operasional</strong>
                                <span class="text-muted lh-sm d-block">{!! nl2br(e($wisata->jadwal)) !!}</span>
                            </div>
                        </li>
                        <li class="list-group-item px-0 py-3 d-flex align-items-start">
                            <i data-lucide="shield-alert" class="text-danger me-3 mt-1"></i>
                            <div>
                                <strong class="d-block mb-1">Syarat & Aturan Kunjungan</strong>
                                <span class="text-muted lh-sm d-block">{!! nl2br(e($wisata->aturan)) !!}</span>
                            </div>
                        </li>
                    </ul>
                    
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $wisata->whatsapp ?: \App\Models\Setting::get('whatsapp', '')) }}?text={{ urlencode("Halo Pengelola Wisata Desa Selorejo,\n\nSaya tertarik untuk berkunjung ke: " . $wisata->judul . "\n\nBisakah saya mendapatkan informasi lebih lanjut mengenai akses dan ketersediaan kuota untuk kunjungan dalam waktu dekat?\n\nTerima kasih.") }}" target="_blank" class="btn btn-success w-100 mt-4 rounded-pill fw-bold hover-lift">
                        <i data-lucide="message-circle" class="me-2 icon-sm"></i> Hubungi Pengelola
                    </a>
                </div>
                
                <div class="card p-3 rounded-4 shadow-sm border-0 bg-light mb-3">
                    <h6 class="fw-bold mb-3 text-dark small text-uppercase"><i data-lucide="share-2" class="icon-xs me-1"></i> Bagikan Ke Medsos</h6>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="https://api.whatsapp.com/send?text={{ urlencode('Ayo kunjungi ' . $wisata->judul . ' di Desa Selorejo! ' . url()->current()) }}" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-3 share-btn">
                            <i data-lucide="message-circle" class="icon-xs me-1"></i> WA
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3 share-btn">
                            <i data-lucide="facebook" class="icon-xs me-1"></i> FB
                        </a>
                        <a href="javascript:void(0)" onclick="trackShare('Instagram')" class="btn btn-sm btn-outline-danger rounded-pill px-3 share-btn">
                            <i data-lucide="instagram" class="icon-xs me-1"></i> IG
                        </a>
                        <a href="javascript:void(0)" onclick="trackShare('TikTok')" class="btn btn-sm btn-outline-dark rounded-pill px-3 share-btn">
                            <i data-lucide="music-2" class="icon-xs me-1"></i> TikTok
                        </a>
                    </div>
                </div>
                
                <div class="d-flex justify-content-center">
                    <a href="{{ url('/wisata') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-4 shadow-sm">
                        <i data-lucide="arrow-left" class="icon-sm"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@if($wisataLain && $wisataLain->count() > 0)
<div class="bg-light py-5 border-top border-success border-opacity-10">
    <div class="container">
        <h4 class="fw-bold mb-4 text-dark text-center">Destinasi Menarik Lainnya</h4>
        <div class="row justify-content-center g-4">
            @foreach($wisataLain as $wl)
            <div class="col-md-4">
                <a href="{{ url('/wisata/'.$wl->id) }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm card-hover rounded-4 overflow-hidden bg-white">
                        <img src="{{ $wl->gambar }}" onerror="this.src='{{ asset('images/wisata_jeruk.png') }}'" class="card-img-top img-cover" style="height: 180px;">
                        <div class="card-body p-4">
                            <span class="badge bg-success bg-opacity-10 text-success mb-2 rounded-pill px-3">
                                {{ $wl->kategori ?? 'Wisata Desa' }}
                            </span>
                            <h6 class="fw-bold text-dark mb-2">{{ $wl->judul }}</h6>
                            <p class="text-muted small mb-0">{{ Str::limit($wl->deskripsi, 60) }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const reactButtons = document.querySelectorAll('.btn-react');
        
        reactButtons.forEach(button => {
            button.addEventListener('click', function() {
                const type = this.getAttribute('data-type');
                
                fetch("{{ route('wisata.react', $wisata->id) }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ type: type })
                })
                .then(response => response.json())
                .then(data => {
                    if(data.error) {
                        alert(data.error);
                        return;
                    }
                    
                    document.getElementById('likes-count').innerText = data.likes;
                    document.getElementById('dislikes-count').innerText = data.dislikes;
                    
                    reactButtons.forEach(btn => btn.disabled = true);
                    document.getElementById('reaction-message').classList.remove('d-none');
                    
                    if(type === 'like') {
                        this.classList.remove('btn-outline-success');
                        this.classList.add('btn-success', 'text-white');
                    } else {
                        this.classList.remove('btn-outline-danger');
                        this.classList.add('btn-danger', 'text-white');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    });

    function trackShare(platform) {
        const url = '{{ url()->current() }}';
        
        // Simpan ke database
        fetch("{{ route('wisata.share', $wisata->id) }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        });

        if (platform === 'Instagram' || platform === 'TikTok') {
            copyToClipboard(url, platform);
        }
    }

    function copyToClipboard(text, platform) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Link Wisata berhasil disalin! Silakan tempelkan di ' + platform + ' Anda.');
        }, function(err) {
            console.error('Could not copy text: ', err);
        });
    }

    document.querySelectorAll('.share-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            const platform = this.innerText.trim();
            if (platform === 'WA' || platform === 'FB') {
                trackShare(platform);
            }
        });
    });
</script>
@endpush
