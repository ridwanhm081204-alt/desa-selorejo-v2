@extends('layouts.public')
@section('title', $berita->judul)
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/berita') }}" class="text-decoration-none" style="color: var(--color-forest) !important; font-family: var(--font-body);">Kabar Desa</a></li>
    <li class="breadcrumb-item active" style="font-family: var(--font-body);">{{ \Illuminate\Support\Str::limit($berita->judul, 30) }}</li>
@endsection
@push('styles')
<style>
    /* ===== Modern Responsive Carousel Styles ===== */
    .berita-carousel {
        position: relative;
        width: 100%;
        border-radius: 20px;
        overflow: hidden;
        background: #0f172a;
        margin-bottom: 1.75rem;
        box-shadow: 0 12px 35px rgba(15, 23, 42, 0.15);
        user-select: none;
    }
    .berita-carousel-track-wrapper {
        overflow: hidden;
        width: 100%;
    }
    .berita-carousel-track {
        display: flex;
        transition: transform 0.45s cubic-bezier(0.25, 1, 0.5, 1);
        will-change: transform;
    }
    .berita-carousel-slide {
        flex: 0 0 100%;
        width: 100%;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #0f172a;
    }
    .berita-carousel-slide img {
        width: 100%;
        max-height: 480px;
        object-fit: contain;
        background: #0f172a;
        display: block;
        pointer-events: none;
    }

    /* High Contrast Glass Navigation Buttons */
    .carousel-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 12;
        background: rgba(15, 23, 42, 0.75);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1.5px solid rgba(255, 255, 255, 0.25);
        color: #ffffff !important;
        border-radius: 50%;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
        outline: none;
    }
    .carousel-btn svg {
        width: 22px;
        height: 22px;
        stroke-width: 2.8px;
        transition: transform 0.2s ease;
    }
    .carousel-btn:hover {
        background: var(--color-forest, #166534);
        border-color: rgba(255, 255, 255, 0.5);
        color: #ffffff !important;
        transform: translateY(-50%) scale(1.12);
        box-shadow: 0 10px 30px rgba(22, 101, 52, 0.5);
    }
    .carousel-btn-prev:hover svg {
        transform: translateX(-2px);
    }
    .carousel-btn-next:hover svg {
        transform: translateX(2px);
    }
    .carousel-btn:active {
        transform: translateY(-50%) scale(0.95);
    }
    .carousel-btn-prev { left: 16px; }
    .carousel-btn-next { right: 16px; }

    /* Pill Dots Indicator */
    .carousel-dots {
        position: absolute;
        bottom: 14px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        background: rgba(15, 23, 42, 0.65);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border-radius: 30px;
        border: 1px solid rgba(255, 255, 255, 0.15);
        z-index: 12;
    }
    .carousel-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.4);
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        padding: 0;
    }
    .carousel-dot:hover {
        background: rgba(255, 255, 255, 0.8);
    }
    .carousel-dot.active {
        width: 22px;
        border-radius: 10px;
        background: #ffffff;
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.6);
    }

    /* Counter Badge */
    .carousel-counter {
        position: absolute;
        top: 14px;
        right: 16px;
        background: rgba(15, 23, 42, 0.75);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #ffffff;
        font-size: 12px;
        font-weight: 700;
        padding: 5px 13px;
        border-radius: 20px;
        z-index: 12;
        letter-spacing: 0.8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.25);
    }

    /* Thumbnail Strip */
    .berita-thumbs-strip {
        display: flex;
        gap: 10px;
        overflow-x: auto;
        padding: 8px 4px;
        margin-bottom: 1.5rem;
        scrollbar-width: thin;
        scrollbar-color: var(--color-forest) #f1f5f9;
    }
    .berita-thumb-item {
        flex: 0 0 72px;
        height: 52px;
        border-radius: 10px;
        overflow: hidden;
        cursor: pointer;
        border: 2px solid transparent;
        opacity: 0.65;
        transition: all 0.25s ease;
        background: #0f172a;
    }
    .berita-thumb-item:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }
    .berita-thumb-item.active {
        opacity: 1;
        border-color: var(--color-forest, #166534);
        box-shadow: 0 0 0 3px rgba(22, 101, 52, 0.25);
    }
    .berita-thumb-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Single-image */
    .berita-single-img {
        width: 100%;
        max-height: 480px;
        object-fit: contain;
        background: #0f172a;
        border-radius: 20px;
        box-shadow: 0 12px 35px rgba(0,0,0,0.12);
        margin-bottom: 1.75rem;
    }

    /* Responsive Mobile adjustments */
    @media (max-width: 576px) {
        .carousel-btn {
            width: 40px;
            height: 40px;
        }
        .carousel-btn svg {
            width: 18px;
            height: 18px;
        }
        .carousel-btn-prev { left: 10px; }
        .carousel-btn-next { right: 10px; }
        .berita-carousel-slide img, .berita-single-img {
            max-height: 320px;
        }
        .berita-thumb-item {
            flex: 0 0 60px;
            height: 44px;
        }
    }

    /* Share Buttons */
    .btn-share-custom {
        background: white;
        color: var(--color-forest) !important;
        border: 2px solid var(--color-forest) !important;
        border-radius: 50px;
        padding: 8px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        font-family: var(--font-heading);
    }
    .btn-share-custom:hover {
        background: var(--color-forest) !important;
        color: white !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(26, 92, 56, 0.2);
    }
    .btn-share-custom i { color: var(--color-forest) !important; transition: all 0.3s ease; }
    .btn-share-custom:hover i { color: white !important; }
    .icon-md { width: 20px; height: 20px; }
</style>
@endpush
@section('content')
<div class="container mb-5 my-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="fw-bold text-dark mb-3" style="font-family: var(--font-heading);">{{ $berita->judul }}</h1>
            <div class="d-flex align-items-center text-muted mb-4 pb-3 border-bottom" style="font-family: var(--font-body); border-bottom-color: var(--color-forest)1a !important;">
                <span class="badge px-3 py-2 rounded-pill me-3" style="background-color: var(--accent) !important; color: var(--text-on-accent) !important;">{{ $berita->kategori }}</span>
                <span class="me-3"><i data-lucide="calendar" class="me-1" style="width:16px;"></i> {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}</span>
                <span class="me-3"><i data-lucide="user" class="me-1" style="width:16px;"></i> {{ $berita->penulis ?? 'Admin' }}</span>
                <span><i data-lucide="eye" class="me-1" style="width:16px;"></i> {{ number_format($berita->views) }}x dibaca</span>
            </div>
            
            @php
                $allFotos = $berita->all_fotos;
                $fotoCount = count($allFotos);
            @endphp

            @if($fotoCount > 1)
                {{-- ===== CAROUSEL (>1 foto) ===== --}}
                <div class="berita-carousel" id="beritaCarousel" aria-label="Galeri foto berita">
                    <div class="berita-carousel-track-wrapper">
                        <div class="berita-carousel-track" id="carouselTrack">
                            @foreach($allFotos as $i => $fotoUrl)
                                <div class="berita-carousel-slide" role="group" aria-label="Foto {{ $i+1 }} dari {{ $fotoCount }}">
                                    <img
                                        src="{{ $fotoUrl }}"
                                        alt="{{ $berita->judul }} — foto {{ $i+1 }}"
                                        onerror="this.src='{{ asset('images/hero_desa.png') }}'"
                                        loading="{{ $i === 0 ? 'eager' : 'lazy' }}"
                                    >
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Nav Buttons --}}
                    <button class="carousel-btn carousel-btn-prev" id="btnPrev" aria-label="Foto sebelumnya">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
                    </button>
                    <button class="carousel-btn carousel-btn-next" id="btnNext" aria-label="Foto selanjutnya">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>

                    {{-- Counter --}}
                    <div class="carousel-counter" id="carouselCounter">1 / {{ $fotoCount }}</div>

                    {{-- Dots (only if ≤10) --}}
                    @if($fotoCount <= 10)
                        <div class="carousel-dots" id="carouselDots">
                            @for($i = 0; $i < $fotoCount; $i++)
                                <button class="carousel-dot {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}" aria-label="Ke foto {{ $i+1 }}"></button>
                            @endfor
                        </div>
                    @endif
                </div>

                {{-- Thumbnail Strip --}}
                <div class="berita-thumbs-strip" id="carouselThumbs">
                    @foreach($allFotos as $i => $fotoUrl)
                        <div class="berita-thumb-item {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}">
                            <img src="{{ $fotoUrl }}" alt="Thumb {{ $i+1 }}" onerror="this.src='{{ asset('images/hero_desa.png') }}'">
                        </div>
                    @endforeach
                </div>
            @else
                {{-- ===== SINGLE IMAGE ===== --}}
                <img
                    src="{{ $allFotos[0] ?? $berita->gambar_url }}"
                    onerror="this.src='{{ asset('images/hero_desa.png') }}'"
                    class="berita-single-img"
                    alt="{{ $berita->judul }}"
                >
            @endif
            
            <div class="content text-justify" style="line-height:1.8; font-size:1.05rem; font-family: var(--font-body);">
                {!! $berita->konten !!}
            </div>
            
            <div class="mt-5 pt-4 border-top text-center" style="border-top-color: var(--color-forest)1a !important;">
                <!-- Reaksi Area -->
                <div class="mb-4">
                    <h5 class="fw-bold mb-3" style="font-family: var(--font-heading);">Apakah tulisan ini bermanfaat?</h5>
                    <div class="d-flex flex-wrap gap-2 justify-content-center">
                        <button type="button" class="btn rounded-pill px-4 d-flex align-items-center gap-2 btn-react" data-type="like" id="btn-like" style="border: 2px solid var(--color-forest) !important; color: var(--color-forest) !important; background: transparent; font-family: var(--font-heading); font-weight: 700; transition: all 0.2s;">
                            <i data-lucide="thumbs-up" class="icon-md"></i> Suka (<span id="likes-count">{{ $berita->likes }}</span>)
                        </button>
                        <button type="button" class="btn rounded-pill px-4 d-flex align-items-center gap-2 btn-react" data-type="dislike" id="btn-dislike" style="border: 2px solid var(--color-tomato) !important; color: var(--color-tomato) !important; background: transparent; font-family: var(--font-heading); font-weight: 700; transition: all 0.2s;">
                            <i data-lucide="thumbs-down" class="icon-md"></i> Tidak Suka (<span id="dislikes-count">{{ $berita->dislikes }}</span>)
                        </button>
                    </div>
                    <div id="reaction-message" class="small mt-2 d-none fw-bold" style="color: var(--color-forest) !important; font-family: var(--font-body);">Terima kasih atas tanggapan Anda!</div>
                </div>

                <!-- Share Area -->
                <div>
                    <h5 class="fw-bold mb-3" style="font-family: var(--font-heading);">Bagikan Artikel Ini:</h5>
                    <div class="d-flex flex-wrap gap-3 justify-content-center">
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' ' . url()->current()) }}" target="_blank" class="btn-share-custom share-btn">
                            <i data-lucide="message-circle" class="icon-md"></i> WhatsApp
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="btn-share-custom share-btn">
                            <i data-lucide="facebook" class="icon-md"></i> Facebook
                        </a>
                        <a href="javascript:void(0)" onclick="trackShare('Instagram')" class="btn-share-custom share-btn">
                            <i data-lucide="instagram" class="icon-md"></i> Instagram
                        </a>
                        <a href="javascript:void(0)" onclick="trackShare('TikTok')" class="btn-share-custom share-btn">
                            <i data-lucide="music-2" class="icon-md"></i> TikTok
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// ===== INFINITE CAROUSEL =====
(function() {
    const total = {{ $fotoCount }};
    if (total <= 1) return;

    const track     = document.getElementById('carouselTrack');
    const btnPrev   = document.getElementById('btnPrev');
    const btnNext   = document.getElementById('btnNext');
    const counter   = document.getElementById('carouselCounter');
    const dotsEl    = document.getElementById('carouselDots');
    const dots      = dotsEl ? dotsEl.querySelectorAll('.carousel-dot') : [];
    const thumbsEl  = document.getElementById('carouselThumbs');
    const thumbs    = thumbsEl ? thumbsEl.querySelectorAll('.berita-thumb-item') : [];
    const carousel  = document.getElementById('beritaCarousel');

    let current    = 0;
    let isAnimating = false;
    let autoTimer  = null;
    const AUTO_DELAY = 5000;

    function goTo(index, animate = true) {
        if (isAnimating) return;

        // Infinite wrap
        if (index < 0) index = total - 1;
        if (index >= total) index = 0;

        current = index;
        isAnimating = animate;

        track.style.transition = animate
            ? 'transform 0.45s cubic-bezier(0.25, 1, 0.5, 1)'
            : 'none';
        track.style.transform = `translateX(-${current * 100}%)`;

        // Update counter
        counter.textContent = `${current + 1} / ${total}`;

        // Update dots
        dots.forEach((d, i) => {
            d.classList.toggle('active', i === current);
        });

        // Update thumbnails
        thumbs.forEach((t, i) => {
            const isActive = (i === current);
            t.classList.toggle('active', isActive);
            if (isActive && thumbsEl) {
                t.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            }
        });

        if (animate) {
            setTimeout(() => { isAnimating = false; }, 450);
        }
    }

    // Auto-play
    function startAuto() {
        stopAuto();
        autoTimer = setInterval(() => goTo(current + 1), AUTO_DELAY);
    }
    function stopAuto() {
        if (autoTimer) { clearInterval(autoTimer); autoTimer = null; }
    }

    btnPrev.addEventListener('click', () => { stopAuto(); goTo(current - 1); startAuto(); });
    btnNext.addEventListener('click', () => { stopAuto(); goTo(current + 1); startAuto(); });

    dots.forEach(d => {
        d.addEventListener('click', () => { stopAuto(); goTo(parseInt(d.dataset.index)); startAuto(); });
    });

    thumbs.forEach(t => {
        t.addEventListener('click', () => { stopAuto(); goTo(parseInt(t.dataset.index)); startAuto(); });
    });

    // Touch / swipe support
    let touchStartX = 0;
    let touchEndX   = 0;
    const SWIPE_THRESHOLD = 50;

    carousel.addEventListener('touchstart', e => { touchStartX = e.changedTouches[0].screenX; }, { passive: true });
    carousel.addEventListener('touchend', e => {
        touchEndX = e.changedTouches[0].screenX;
        const diff = touchStartX - touchEndX;
        if (Math.abs(diff) > SWIPE_THRESHOLD) {
            stopAuto();
            goTo(diff > 0 ? current + 1 : current - 1);
            startAuto();
        }
    }, { passive: true });

    // Keyboard support
    carousel.setAttribute('tabindex', '0');
    carousel.addEventListener('keydown', e => {
        if (e.key === 'ArrowLeft')  { stopAuto(); goTo(current - 1); startAuto(); }
        if (e.key === 'ArrowRight') { stopAuto(); goTo(current + 1); startAuto(); }
    });

    // Pause on hover
    carousel.addEventListener('mouseenter', stopAuto);
    carousel.addEventListener('mouseleave', startAuto);

    // Init
    goTo(0, false);
    startAuto();
})();

// ===== REACTIONS =====
document.addEventListener('DOMContentLoaded', function() {
    const reactButtons = document.querySelectorAll('.btn-react');
    
    reactButtons.forEach(button => {
        button.addEventListener('click', function() {
            const type = this.getAttribute('data-type');
            
            fetch("{{ route('berita.react', $berita->id) }}", {
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
                document.getElementById('likes-count').innerText    = data.likes;
                document.getElementById('dislikes-count').innerText = data.dislikes;
                reactButtons.forEach(btn => btn.disabled = true);
                document.getElementById('reaction-message').classList.remove('d-none');
                if(type === 'like') {
                    this.style.backgroundColor = 'var(--color-forest)';
                    this.style.color = '#fff';
                } else {
                    this.style.backgroundColor = 'var(--color-tomato)';
                    this.style.color = '#fff';
                }
            })
            .catch(error => { console.error('Error:', error); });
        });
    });
});

// ===== SHARE =====
function trackShare(platform) {
    const url = '{{ url()->current() }}';
    fetch("{{ route('berita.share', $berita->id) }}", {
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
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Link Berita berhasil disalin! Silakan tempelkan di ' + platform + ' Anda.');
        }, function(err) {
            fallbackCopyToClipboard(text, platform);
        });
    } else {
        fallbackCopyToClipboard(text, platform);
    }
}

function fallbackCopyToClipboard(text, platform) {
    const textArea = document.createElement("textarea");
    textArea.value = text;
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    try {
        const successful = document.execCommand('copy');
        if (successful) {
            alert('Link Berita berhasil disalin! Silakan tempelkan di ' + platform + ' Anda.');
        } else {
            alert('Gagal menyalin link.');
        }
    } catch (err) {
        alert('Gagal menyalin link: ' + err);
    }
    document.body.removeChild(textArea);
}

document.querySelectorAll('.share-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        const platform = this.innerText.trim();
        if (platform === 'WhatsApp' || platform === 'Facebook') {
            trackShare(platform);
        }
    });
});
</script>
@endpush
