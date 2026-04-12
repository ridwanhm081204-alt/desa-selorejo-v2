@extends('layouts.public')
@section('title', $berita->judul)
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/berita') }}" class="text-success text-decoration-none">Kabar Desa</a></li>
    <li class="breadcrumb-item active">{{ \Illuminate\Support\Str::limit($berita->judul, 30) }}</li>
@endsection
@push('styles')
<style>
    .btn-share-custom {
        background: white;
        color: #2d6a4f;
        border: 2px solid #2d6a4f;
        border-radius: 50px;
        padding: 8px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }
    .btn-share-custom:hover {
        background: #2d6a4f;
        color: white !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(45, 106, 79, 0.2);
    }
    .btn-share-custom i {
        color: #2d6a4f;
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
            <h1 class="fw-bold text-dark mb-3">{{ $berita->judul }}</h1>
            <div class="d-flex align-items-center text-muted mb-4 pb-3 border-bottom">
                <span class="badge bg-warning text-dark me-3">{{ $berita->kategori }}</span>
                <span class="me-3"><i data-lucide="calendar" class="me-1" style="width:16px;"></i> {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}</span>
                <span class="me-3"><i data-lucide="user" class="me-1" style="width:16px;"></i> {{ $berita->penulis ?? 'Admin' }}</span>
                <span><i data-lucide="eye" class="me-1" style="width:16px;"></i> {{ number_format($berita->views) }}x dibaca</span>
            </div>
            
            <img src="{{ $berita->gambar_url }}" onerror="this.src='{{ asset('images/hero_desa.png') }}'" class="img-fluid rounded-4 shadow-sm mb-4 w-100" style="max-height: 400px; object-fit:cover;">
            
            <div class="content text-justify" style="line-height:1.8; font-size:1.05rem;">
                {!! $berita->konten !!}
            </div>
            
            <div class="mt-5 pt-4 border-top d-flex flex-column flex-md-row justify-content-between gap-4">
                <!-- Reaksi Area -->
                <div>
                    <h5 class="fw-bold mb-3">Apakah tulisan ini bermanfaat?</h5>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-outline-success rounded-pill px-4 d-flex align-items-center gap-2 btn-react" data-type="like" id="btn-like">
                            <i data-lucide="thumbs-up" class="icon-md"></i> Suka (<span id="likes-count">{{ $berita->likes }}</span>)
                        </button>
                        <button type="button" class="btn btn-outline-danger rounded-pill px-4 d-flex align-items-center gap-2 btn-react" data-type="dislike" id="btn-dislike">
                            <i data-lucide="thumbs-down" class="icon-md"></i> Tidak Suka (<span id="dislikes-count">{{ $berita->dislikes }}</span>)
                        </button>
                    </div>
                    <div id="reaction-message" class="text-muted small mt-2 d-none">Terima kasih atas tanggapan Anda!</div>
                </div>

                <!-- Share Area -->
                <div>
                    <h5 class="fw-bold mb-3">Bagikan Artikel Ini:</h5>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' ' . url()->current()) }}" target="_blank" class="btn-share-custom">
                            <i data-lucide="message-circle" class="icon-md"></i> WhatsApp
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="btn-share-custom">
                            <i data-lucide="facebook" class="icon-md"></i> Facebook
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
                    document.getElementById('reaction-message').classList.add('text-success');
                    
                    // Highlight selected
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
</script>
@endpush
