@extends('layouts.public')
@section('title', $berita->judul)
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/berita') }}" class="text-decoration-none" style="color: var(--color-forest) !important; font-family: var(--font-body);">Kabar Desa</a></li>
    <li class="breadcrumb-item active" style="font-family: var(--font-body);">{{ \Illuminate\Support\Str::limit($berita->judul, 30) }}</li>
@endsection
@push('styles')
<style>
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
    .btn-share-custom i {
        color: var(--color-forest) !important;
        transition: all 0.3s ease;
    }
    .btn-share-custom:hover i {
        color: white !important;
    }
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
            
            <img src="{{ $berita->gambar_url }}" onerror="this.src='{{ asset('images/hero_desa.png') }}'" class="img-fluid rounded-4 shadow-sm mb-4 w-100" style="max-height: 400px; object-fit:cover;">
            
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
                    
                    // Update the UI Numbers
                    document.getElementById('likes-count').innerText = data.likes;
                    document.getElementById('dislikes-count').innerText = data.dislikes;
                    
                    // Disable buttons and show thanks message
                    reactButtons.forEach(btn => btn.disabled = true);
                    document.getElementById('reaction-message').classList.remove('d-none');
                    
                    // Highlight selected
                    if(type === 'like') {
                        this.style.backgroundColor = 'var(--color-forest)';
                        this.style.color = '#fff';
                    } else {
                        this.style.backgroundColor = 'var(--color-tomato)';
                        this.style.color = '#fff';
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
        navigator.clipboard.writeText(text).then(function() {
            alert('Link Berita berhasil disalin! Silakan tempelkan di ' + platform + ' Anda.');
        }, function(err) {
            console.error('Could not copy text: ', err);
        });
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
