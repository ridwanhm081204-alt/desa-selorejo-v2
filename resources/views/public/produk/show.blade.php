@extends('layouts.public')
@section('title', $produk->nama)
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/produk') }}" class="text-decoration-none" style="color: var(--color-forest) !important; font-family: var(--font-body);">Produk</a></li>
    <li class="breadcrumb-item active" style="font-family: var(--font-body);">{{ $produk->nama }}</li>
@endsection
@section('content')
<div class="container mb-5 my-5">
    <div class="row g-5">
        <div class="col-md-6 text-center">
            <div class="position-relative">
                <img src="{{ $produk->gambar_url }}" onerror="this.src='{{ asset('images/wisata_jeruk.png') }}'" class="img-fluid rounded-4 shadow-lg w-100" style="object-fit: cover; max-height:500px;">
                <div class="position-absolute bottom-0 end-0 m-3">
                    <span class="badge px-3 py-2 rounded-pill shadow" style="background-color: var(--color-forest) !important; color: #fff !important; font-family: var(--font-body);"><i data-lucide="tag" class="icon-xs me-1"></i> {{ $produk->kategori ?? 'UMKM Desa' }}</span>
                </div>
            </div>
            
            <!-- Share Medsos -->
            <div class="mt-4 p-3 bg-white rounded-4 shadow-sm border" style="border-color: var(--color-forest)1a !important;">
                <h6 class="fw-bold mb-3 text-dark small text-uppercase" style="font-family: var(--font-heading);"><i data-lucide="share-2" class="icon-xs me-1"></i> Bagikan Produk</h6>
                <div class="d-flex justify-content-center gap-2 flex-wrap" style="font-family: var(--font-body);">
                    <a href="https://api.whatsapp.com/send?phone={{ preg_replace('/[^0-9]/', '', $produk->whatsapp ?: \App\Models\Setting::get('whatsapp', '')) }}&text={{ urlencode('Beli produk lokal Selorejo: ' . $produk->nama . ' ' . url()->current()) }}" target="_blank" class="btn btn-sm rounded-pill px-3 share-btn" style="border-color: var(--color-forest) !important; color: var(--color-forest) !important; background: transparent;">
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
        </div>
        <div class="col-md-6 d-flex flex-column justify-content-center">
            <h1 class="fw-bold text-dark mb-1" style="font-family: var(--font-heading);">{{ $produk->nama }}</h1>
            <div class="d-flex align-items-center mb-3">
                <div class="text-warning me-2">
                    @php $avg = $produk->reviews->avg('rating') ?? 0; @endphp
                    @for($i=1; $i<=5; $i++)
                        <i data-lucide="star" class="icon-sm {{ $i <= $avg ? 'fill-warning' : 'text-muted' }}" style="width:16px;"></i>
                    @endfor
                </div>
                <span class="text-muted small" style="font-family: var(--font-body);">({{ $produk->reviews->count() }} Ulasan)</span>
            </div>

            <h3 class="fw-bold mb-4" style="color: var(--color-forest) !important; font-family: var(--font-heading);">Rp {{ number_format($produk->harga, 0, ',', '.') }}</h3>
            
            <div class="p-3 rounded-3 mb-4 border-start border-4" style="background-color: var(--color-cream) !important; border-left-color: var(--color-forest) !important;">
                <span class="d-block fw-bold mb-1 small text-muted text-uppercase" style="font-family: var(--font-body);">Status Stok:</span>
                <span class="stok-badge {{ $produk->stok > 0 ? 'tersedia' : 'habis' }}">{{ $produk->stok > 0 ? 'Tersedia (' . $produk->stok . ')' : 'Stok Habis' }}</span>
            </div>
            
            <h5 class="fw-bold mb-3 d-flex align-items-center" style="font-family: var(--font-heading);"><i data-lucide="file-text" class="icon-sm me-2" style="color: var(--color-forest) !important;"></i>Deskripsi Produk</h5>
            <div class="text-dark mb-4" style="line-height: 1.8; font-weight: 400; text-align: justify; font-family: var(--font-body);">{!! $produk->deskripsi !!}</div>
            
            {{-- Dual Order Buttons --}}
            <div class="d-flex flex-column gap-2 mt-auto">
                {{-- Button Pesan via WhatsApp --}}
                <a href="{{ route('produk.checkout', $produk->id) }}" class="btn btn-lg w-100 py-3 fw-bold rounded-pill shadow-sm hover-lift {{ $produk->stok <= 0 ? 'disabled' : '' }}" style="background-color: var(--color-forest) !important; color: #fff !important; font-family: var(--font-heading); border: none;">
                    <i data-lucide="message-circle" class="me-2"></i> {{ $produk->stok > 0 ? 'Pesan via WhatsApp' : 'Maaf, Stok Habis' }}
                </a>

                {{-- Button Beli di Marketplace --}}
                @if($produk->hasMarketplaceLinks())
                <div class="dropdown w-100">
                    <button class="btn btn-lg w-100 py-3 fw-bold rounded-pill shadow-sm hover-lift dropdown-toggle {{ $produk->stok <= 0 ? 'disabled' : '' }}" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background: linear-gradient(135deg, #EE4D2D 0%, #FF6633 50%, #42b549 100%) !important; color: #fff !important; font-family: var(--font-heading); border: none;">
                        <i data-lucide="shopping-cart" class="me-2"></i> Beli di Marketplace
                    </button>
                    <ul class="dropdown-menu w-100 border-0 shadow-lg rounded-4 p-2" style="font-family: var(--font-body);">
                        @if($produk->link_shopee)
                        <li>
                            <a class="dropdown-item rounded-3 py-3 px-3 d-flex align-items-center hover-lift" href="{{ $produk->link_shopee }}" target="_blank" rel="noopener noreferrer">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle me-3" style="width: 36px; height: 36px; background: #EE4D2D1a;">
                                    <i data-lucide="shopping-bag" style="width: 18px; height: 18px; color: #EE4D2D;"></i>
                                </span>
                                <div>
                                    <span class="fw-bold d-block" style="color: #EE4D2D;">Shopee</span>
                                    <small class="text-muted">Beli di Shopee</small>
                                </div>
                                <i data-lucide="external-link" class="ms-auto icon-sm text-muted"></i>
                            </a>
                        </li>
                        @endif
                        @if($produk->link_tokopedia)
                        <li>
                            <a class="dropdown-item rounded-3 py-3 px-3 d-flex align-items-center hover-lift" href="{{ $produk->link_tokopedia }}" target="_blank" rel="noopener noreferrer">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle me-3" style="width: 36px; height: 36px; background: #42b5491a;">
                                    <i data-lucide="store" style="width: 18px; height: 18px; color: #42b549;"></i>
                                </span>
                                <div>
                                    <span class="fw-bold d-block" style="color: #42b549;">Tokopedia</span>
                                    <small class="text-muted">Beli di Tokopedia</small>
                                </div>
                                <i data-lucide="external-link" class="ms-auto icon-sm text-muted"></i>
                            </a>
                        </li>
                        @endif
                        @if($produk->link_marketplace_lainnya)
                        <li>
                            <a class="dropdown-item rounded-3 py-3 px-3 d-flex align-items-center hover-lift" href="{{ $produk->link_marketplace_lainnya }}" target="_blank" rel="noopener noreferrer">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle me-3" style="width: 36px; height: 36px; background: #6c757d1a;">
                                    <i data-lucide="external-link" style="width: 18px; height: 18px; color: #6c757d;"></i>
                                </span>
                                <div>
                                    <span class="fw-bold d-block text-dark">Marketplace Lainnya</span>
                                    <small class="text-muted">Beli di marketplace lain</small>
                                </div>
                                <i data-lucide="external-link" class="ms-auto icon-sm text-muted"></i>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- SECTION REVIEW & RATING -->
    <div class="row mt-5 pt-5 border-top" style="border-top-color: var(--color-forest)1a !important;">
        <div class="col-lg-4 mb-5">
            <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px; border-top: 4px solid var(--color-forest) !important;">
                <h5 class="fw-bold text-dark mb-4" style="font-family: var(--font-heading);">Beri Ulasan Produk</h5>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert" style="font-family: var(--font-body);">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('produk.review', $produk->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-bold" style="font-family: var(--font-body);">Penilaian Bintang</label>
                        <div class="rating-input d-flex gap-2">
                            @for($i=5; $i>=1; $i--)
                            <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}" class="btn-check" required>
                            <label class="btn btn-outline-warning btn-sm rounded-pill" for="star{{ $i }}">{{ $i }} <i data-lucide="star" class="icon-xs"></i></label>
                            @endfor
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="nama_lengkap" class="form-control rounded-pill px-3" style="font-family: var(--font-body);" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control rounded-pill px-3" style="font-family: var(--font-body);" placeholder="Alamat Email" required>
                    </div>
                    <div class="mb-3">
                        <textarea name="saran" class="form-control rounded-4 px-3" style="font-family: var(--font-body);" rows="3" placeholder="Saran/Kelebihan Produk..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <textarea name="kritik" class="form-control rounded-4 px-3" style="font-family: var(--font-body);" rows="3" placeholder="Kritik/Kekurangan Produk..." required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold" style="font-family: var(--font-body);">Foto Produk (Wajib)</label>
                        <input type="file" name="foto_produk" class="form-control form-control-sm rounded-pill" style="font-family: var(--font-body);" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn w-100 rounded-pill fw-bold" style="background-color: var(--color-forest) !important; color: #fff !important; font-family: var(--font-heading); border: none;">Kirim Ulasan</button>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-dark mb-0" style="font-family: var(--font-heading);">Ulasan Pengguna ({{ $produk->reviews->count() }})</h4>
                <form action="{{ url()->current() }}" method="GET" class="d-flex gap-2">
                    <div class="d-flex align-items-center bg-white shadow-sm border rounded-pill px-3 py-1 hover-lift">
                        <i data-lucide="sliders-horizontal" class="text-muted icon-sm me-1"></i>
                        <select name="review_sort" class="border-0 bg-transparent fw-bold text-muted px-1 py-1 shadow-none w-100" style="font-size: var(--text-sm); outline: none; cursor: pointer; font-family: var(--font-body);" onchange="this.form.submit()">
                            <option value="terbaru" {{ request('review_sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                            <option value="terlama" {{ request('review_sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                            <option value="rating_desc" {{ request('review_sort') == 'rating_desc' ? 'selected' : '' }}>Bintang Tertinggi</option>
                            <option value="rating_asc" {{ request('review_sort') == 'rating_asc' ? 'selected' : '' }}>Bintang Terendah</option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="review-list">
                @forelse($produk->reviews as $review)
                <div class="card border-0 shadow-sm rounded-4 mb-3 p-4 bg-white" style="border-left: 4px solid var(--color-forest) !important;">
                    <div class="row">
                        <div class="col-md-{{ $review->foto_produk ? '8' : '12' }}">
                            <div class="d-flex justify-content-between mb-2">
                                <h6 class="fw-bold mb-0" style="color: var(--color-forest) !important; font-family: var(--font-heading);">{{ $review->nama_lengkap }}</h6>
                                <small class="text-muted" style="font-family: var(--font-body);">{{ $review->created_at->translatedFormat('d F Y') }}</small>
                            </div>
                            <div class="text-warning mb-3">
                                @for($i=1; $i<=5; $i++)
                                    <i data-lucide="star" class="icon-xs {{ $i <= $review->rating ? 'fill-warning' : 'text-muted' }}" style="width:14px;"></i>
                                @endfor
                            </div>
                            
                            @if($review->saran)
                            <div class="mb-3">
                                <small class="text-muted fw-bold d-block mb-1 text-uppercase" style="font-size: 0.65rem; font-family: var(--font-body);">Saran & Keunggulan:</small>
                                <p class="text-dark small mb-0" style="font-family: var(--font-body);">{{ $review->saran }}</p>
                            </div>
                            @endif

                            @if($review->kritik)
                            <div class="mb-0">
                                <small class="text-muted fw-bold d-block mb-1 text-uppercase" style="font-size: 0.65rem; font-family: var(--font-body);">Kritik & Masukan:</small>
                                <p class="text-dark small mb-0" style="font-family: var(--font-body);">{{ $review->kritik }}</p>
                            </div>
                            @endif
                        </div>
                        @if($review->foto_produk)
                        <div class="col-md-4 mt-3 mt-md-0">
                            <img src="{{ asset('storage/' . $review->foto_produk) }}" class="rounded-3 w-100 shadow-sm object-fit-cover" style="height: 120px;">
                        </div>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center py-5 text-muted bg-white border rounded-4" style="font-family: var(--font-body);">
                    <i data-lucide="message-square" class="icon-lg opacity-25 mb-2"></i>
                    <p class="mb-0">Belum ada ulasan untuk produk ini. Jadi yang pertama memberi ulasan!</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function trackShare(platform) {
        const url = '{{ url()->current() }}';
        
        // Simpan ke database
        fetch("{{ route('produk.share', $produk->id) }}", {
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
            alert('Link Produk berhasil disalin! Silakan tempelkan di ' + platform + ' Anda.');
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
