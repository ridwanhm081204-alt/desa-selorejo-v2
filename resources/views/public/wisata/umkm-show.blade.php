@extends('layouts.public')
@section('title', $umkm->nama_usaha . ' - Direktori UMKM Desa Selorejo')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('wisata.umkm') }}" class="text-decoration-none" style="color:var(--color-forest);">Direktori UMKM</a></li>
    <li class="breadcrumb-item active">{{ $umkm->nama_usaha }}</li>
@endsection

@section('content')

{{-- ═══════════════════════════════════════════════════════════════════════════
     HERO BANNER & PROFIL UTAMA
═══════════════════════════════════════════════════════════════════════════ --}}
<div class="container my-4">
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden position-relative" style="background:var(--color-forest); color:#ffffff;">
        {{-- Background Image dengan Overlay --}}
        <div class="position-absolute top-0 start-0 w-100 h-100" style="z-index:1;">
            <img src="{{ $umkm->foto_url }}" class="w-100 h-100" style="object-fit:cover; filter:blur(4px) brightness(0.4); transform:scale(1.05);" alt="{{ $umkm->nama_usaha }}">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background:linear-gradient(135deg, rgba(15,52,36,0.92) 0%, rgba(27,67,50,0.85) 100%);"></div>
        </div>

        <div class="card-body p-4 p-md-5 position-relative text-white" style="z-index:2;">
            <div class="row align-items-center g-4">
                {{-- Foto Utama Usaha --}}
                <div class="col-12 col-md-4 col-lg-3 text-center">
                    <div class="position-relative d-inline-block rounded-4 overflow-hidden shadow-lg border border-2 border-white border-opacity-25"
                         style="max-width:260px; width:100%; aspect-ratio:4/3;">
                        <img src="{{ $umkm->foto_url }}" class="w-100 h-100" style="object-fit:cover;" alt="{{ $umkm->nama_usaha }}">
                        <div class="position-absolute bottom-0 start-0 w-100 p-2 text-start" style="background:linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                            <span class="badge rounded-pill px-3 py-1 shadow-sm fw-bold"
                                  style="font-size:0.75rem;background:var(--accent)!important;color:var(--text-on-accent)!important;font-family:var(--font-body);">
                                <i data-lucide="map-pin" class="icon-xs me-1"></i>Dusun {{ $umkm->dusun }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Detail Header --}}
                <div class="col-12 col-md-8 col-lg-9">
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                        <span class="badge rounded-pill px-3 py-1 fw-bold text-uppercase"
                              style="background:rgba(255,255,255,0.2);color:#ffffff;font-size:0.75rem;backdrop-filter:blur(5px);">
                            <i data-lucide="tag" class="icon-xs me-1"></i>{{ $umkm->kategori }}
                        </span>
                        @if($umkm->isVerified())
                        <span class="badge rounded-pill px-3 py-1 fw-bold bg-success text-white" style="font-size:0.75rem;">
                            <i data-lucide="check-circle" class="icon-xs me-1"></i>Usaha Terverifikasi
                        </span>
                        @else
                        <span class="badge rounded-pill px-3 py-1 fw-bold bg-warning text-dark" style="font-size:0.75rem;">
                            <i data-lucide="clock" class="icon-xs me-1"></i>Status: {{ ucfirst(str_replace('_', ' ', $umkm->status_lokasi)) }}
                        </span>
                        @endif
                    </div>

                    <h1 class="fw-bold mb-2 text-white" style="font-family:var(--font-heading); font-size:clamp(1.75rem, 4vw, 2.5rem);">
                        {{ $umkm->nama_usaha }}
                    </h1>

                    @if($umkm->nama_toko_gmaps && $umkm->nama_toko_gmaps !== $umkm->nama_usaha)
                    <p class="text-white opacity-75 mb-2 font-monospace" style="font-size:0.9rem;">
                        <i data-lucide="map" class="icon-xs me-1"></i>Nama Google Maps: "{{ $umkm->nama_toko_gmaps }}"
                    </p>
                    @endif

                    <div class="d-flex flex-wrap align-items-center gap-3 text-white opacity-90 mt-3" style="font-family:var(--font-body); font-size:0.95rem;">
                        <div class="d-flex align-items-center">
                            <i data-lucide="user" class="icon-sm me-2 text-warning"></i>
                            <span>Pemilik: <strong>{{ $umkm->nama_pemilik }}</strong></span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i data-lucide="briefcase" class="icon-sm me-2 text-warning"></i>
                            <span>Jenis Usaha: <strong>{{ $umkm->jenis_usaha }}</strong></span>
                        </div>
                        @if($umkm->alamat_rt_rw)
                        <div class="d-flex align-items-center">
                            <i data-lucide="home" class="icon-sm me-2 text-warning"></i>
                            <span>RT/RW {{ $umkm->alamat_rt_rw }}, Dusun {{ $umkm->dusun }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════════════════════
     KONTEN UTAMA: DETAIL USAHA & KONTAK
═══════════════════════════════════════════════════════════════════════════ --}}
<div class="container mb-5">
    <div class="row g-4">
        {{-- Sisi Kiri (Deskripsi & Informasi Operasional) --}}
        <div class="col-lg-8">

            {{-- Card Deskripsi --}}
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                <h5 class="fw-bold mb-3 d-flex align-items-center" style="font-family:var(--font-heading); color:var(--color-forest);">
                    <i data-lucide="info" class="icon-md me-2" style="color:var(--accent);"></i>
                    Profil & Deskripsi Usaha
                </h5>

                <div class="lh-lg text-dark" style="font-family:var(--font-body); font-size:0.98rem; color:#111827!important;">
                    @if($umkm->deskripsi)
                        <p class="mb-0 text-dark" style="color:#111827!important;">{{ $umkm->deskripsi }}</p>
                    @else
                        <p class="mb-2 text-dark" style="color:#111827!important;">
                            <strong class="text-dark" style="color:#111827!important;">{{ $umkm->nama_usaha }}</strong> merupakan salah satu unit Usaha Mikro, Kecil, dan Menengah (UMKM) warga Desa Selorejo yang dikelola secara independen oleh <strong class="text-dark" style="color:#111827!important;">{{ $umkm->nama_pemilik }}</strong> di Dusun {{ $umkm->dusun }}.
                        </p>
                        <p class="mb-0 text-dark" style="color:#111827!important;">
                            Usaha ini bergerak di bidang kategori <em>{{ $umkm->kategori }}</em> dengan spesifikasi layanan/produk berupa <strong class="text-dark" style="color:#111827!important;">{{ $umkm->jenis_usaha }}</strong>. Dengan mendukung UMKM lokal Selorejo, Anda turut memajukan perekonomian serta kesejahteraan masyarakat desa setempat.
                        </p>
                    @endif
                </div>

                {{-- Detail Tambahan (Jam Operasional & Produk Unggulan) --}}
                <div class="row g-3 mt-3 pt-3 border-top">
                    <div class="col-md-6">
                        <div class="p-3 rounded-3 bg-light border">
                            <div class="small text-muted fw-bold text-uppercase mb-1" style="font-size:0.75rem;">
                                <i data-lucide="star" class="icon-xs me-1 text-warning"></i> Produk / Layanan Utama
                            </div>
                            <div class="fw-semibold text-dark">
                                {{ $umkm->produk_unggulan ?: $umkm->jenis_usaha }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded-3 bg-light border">
                            <div class="small text-muted fw-bold text-uppercase mb-1" style="font-size:0.75rem;">
                                <i data-lucide="clock" class="icon-xs me-1 text-success"></i> Jam Operasional
                            </div>
                            <div class="fw-semibold text-dark">
                                {{ $umkm->jam_operasional ?: 'Setiap Hari (08.00 - 17.00 WIB)' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Sisi Kanan (Informasi Kontak & Sosmed) --}}
        <div class="col-lg-4">

            {{-- Kartu Kontak Usaha --}}
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                <h5 class="fw-bold mb-3 border-bottom pb-2" style="font-family:var(--font-heading); color:var(--color-forest);">
                    <i data-lucide="phone-call" class="icon-md me-2" style="color:var(--color-forest);"></i>
                    Kontak & Informasi Usaha
                </h5>

                <div class="d-flex flex-column gap-3" style="font-family:var(--font-body);">
                    {{-- Pemilik --}}
                    <div class="d-flex align-items-start gap-3 p-2.5 rounded-3 bg-light">
                        <div class="p-2 rounded-circle bg-white text-forest shadow-sm">
                            <i data-lucide="user" class="icon-sm" style="color:var(--color-forest);"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block" style="font-size:0.75rem;">NAMA PEMILIK</small>
                            <span class="fw-bold text-dark" style="font-size:0.95rem;">{{ $umkm->nama_pemilik }}</span>
                        </div>
                    </div>

                    {{-- Dusun & RT/RW --}}
                    <div class="d-flex align-items-start gap-3 p-2.5 rounded-3 bg-light">
                        <div class="p-2 rounded-circle bg-white text-forest shadow-sm">
                            <i data-lucide="home" class="icon-sm" style="color:var(--color-forest);"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block" style="font-size:0.75rem;">LOKASI ALAMAT</small>
                            <span class="fw-bold text-dark" style="font-size:0.95rem;">Dusun {{ $umkm->dusun }}</span>
                            @if($umkm->alamat_rt_rw)
                                <small class="text-muted d-block">RT/RW {{ $umkm->alamat_rt_rw }}</small>
                            @endif
                        </div>
                    </div>

                    {{-- Telepon / WA --}}
                    @if($umkm->no_telepon)
                    <div class="d-flex align-items-start gap-3 p-2.5 rounded-3 bg-light">
                        <div class="p-2 rounded-circle bg-white text-success shadow-sm">
                            <i data-lucide="phone" class="icon-sm text-success"></i>
                        </div>
                        <div class="flex-grow-1">
                            <small class="text-muted d-block" style="font-size:0.75rem;">NOMOR TELEPON / WA</small>
                            <span class="fw-bold text-dark" style="font-size:0.95rem;">{{ $umkm->no_telepon }}</span>
                        </div>
                    </div>
                    @endif

                    {{-- Gmail Usaha --}}
                    @if($umkm->gmail_usaha)
                    <div class="d-flex align-items-start gap-3 p-2.5 rounded-3 bg-light">
                        <div class="p-2 rounded-circle bg-white text-danger shadow-sm">
                            <i data-lucide="mail" class="icon-sm text-danger"></i>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <small class="text-muted d-block" style="font-size:0.75rem;">EMAIL USAHA</small>
                            <a href="mailto:{{ $umkm->gmail_usaha }}" class="fw-bold text-dark text-truncate d-block" style="font-size:0.9rem;">
                                {{ $umkm->gmail_usaha }}
                            </a>
                        </div>
                    </div>
                    @endif

                    {{-- Username Sosmed / Marketplace --}}
                    @if($umkm->username_sosmed)
                    <div class="d-flex align-items-start gap-3 p-2.5 rounded-3 bg-light">
                        <div class="p-2 rounded-circle bg-white text-warning shadow-sm">
                            <i data-lucide="shopping-bag" class="icon-sm text-warning"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block" style="font-size:0.75rem;">SOSIAL MEDIA / MARKETPLACE</small>
                            <span class="fw-bold text-dark" style="font-size:0.9rem;">{{ $umkm->username_sosmed }}</span>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Action Buttons --}}
                <div class="d-grid gap-2 mt-4">
                    {{-- Button Petunjuk Arah (Google Maps) --}}
                    @if($umkm->hasGmaps())
                    <a href="{{ $umkm->link_gmaps }}" target="_blank" rel="noopener"
                       class="btn btn-primary rounded-pill py-2.5 fw-bold shadow-sm hover-lift text-white border-0" style="background:#4285F4!important;">
                        <i data-lucide="map-pin" class="icon-sm me-1"></i> Petunjuk Arah (Google Maps)
                    </a>
                    @else
                    <button type="button" disabled
                            class="btn rounded-pill py-2.5 fw-bold border-0"
                            style="background:#d1d5db;color:#9ca3af;cursor:not-allowed;"
                            title="Link Google Maps belum tersedia untuk usaha ini">
                        <i data-lucide="map-pin" class="icon-sm me-1"></i> Petunjuk Arah (Google Maps)
                    </button>
                    @endif

                    @if($waLink)
                    <a href="{{ $waLink }}" target="_blank" rel="noopener"
                       class="btn btn-success rounded-pill py-2.5 fw-bold shadow-sm hover-lift text-white border-0">
                        <i data-lucide="message-circle" class="icon-sm me-1"></i> Chat Via WhatsApp
                    </a>
                    @else
                    <button type="button" disabled
                            class="btn rounded-pill py-2.5 fw-bold border-0"
                            style="background:#d1d5db;color:#9ca3af;cursor:not-allowed;"
                            title="Nomor WhatsApp belum tersedia untuk usaha ini">
                        <i data-lucide="message-circle" class="icon-sm me-1"></i> Chat Via WhatsApp
                    </button>
                    @endif

                    <button type="button" onclick="shareUmkm()" class="btn btn-outline-forest rounded-pill py-2.5 fw-bold hover-lift">
                        <i data-lucide="share-2" class="icon-xs me-1"></i> Bagikan Halaman Usaha Ini
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════════════════════
     UMKM TERKAIT / SEJENIS
═══════════════════════════════════════════════════════════════════════════ --}}
@if(count($relatedUmkms) > 0)
<div class="container mb-5 pb-4">
    <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
        <div>
            <h4 class="fw-bold mb-0 text-dark" style="font-family:var(--font-heading);">
                UMKM Terkait di Desa Selorejo
            </h4>
            <small class="text-muted" style="font-family:var(--font-body);">Jelajahi usaha sejenis atau usaha lain di Dusun {{ $umkm->dusun }}</small>
        </div>
        <a href="{{ route('wisata.umkm') }}" class="btn btn-sm rounded-pill btn-outline-forest px-3 fw-bold" style="font-family:var(--font-heading);">
            Lihat Semua <i data-lucide="arrow-right" class="icon-xs ms-1"></i>
        </a>
    </div>

    <div class="row g-4">
        @foreach($relatedUmkms as $r)
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift overflow-hidden bg-white">
                <div class="position-relative overflow-hidden" style="height:140px;">
                    <img src="{{ $r->foto_url }}" class="w-100 h-100" style="object-fit:cover;" alt="{{ $r->nama_usaha }}">
                    <div class="position-absolute bottom-0 start-0 m-2">
                        <span class="badge rounded-pill px-2.5 py-1 shadow-sm fw-bold"
                              style="font-size:0.65rem;background:var(--color-forest)!important;color:#fff;">
                            {{ $r->dusun }}
                        </span>
                    </div>
                </div>

                <div class="card-body p-3 d-flex flex-column">
                    <h6 class="fw-bold text-dark mb-1" style="font-family:var(--font-heading); font-size:0.9rem;">
                        <a href="{{ route('wisata.umkm.show', $r->id) }}" class="text-decoration-none text-dark hover-forest">
                            {{ $r->nama_usaha }}
                        </a>
                    </h6>
                    <small class="text-muted mb-2" style="font-size:0.75rem;"><i data-lucide="user" class="icon-xs me-1"></i>{{ $r->nama_pemilik }}</small>
                    <span class="badge rounded-pill px-2 py-1 mb-2 align-self-start"
                          style="font-size:0.62rem;background:var(--color-forest)15;color:var(--color-forest);border:1px solid var(--color-forest)30;">
                        {{ $r->kategori }}
                    </span>

                    <div class="mt-auto pt-2">
                        <a href="{{ route('wisata.umkm.show', $r->id) }}"
                           class="btn btn-sm btn-outline-forest rounded-pill w-100 fw-bold"
                           style="font-size:0.75rem; font-family:var(--font-heading);">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

@endsection

@push('styles')
<style>
    .hover-forest:hover {
        color: var(--color-forest) !important;
    }
</style>
@endpush

@push('scripts')
<script>
function shareUmkm() {
    const url   = window.location.href;
    const title = @json($umkm->nama_usaha);
    const text  = 'Lihat profil UMKM ' + title + ' di Desa Selorejo: ' + url;

    // 1️⃣ Web Share API (mobile / modern browser)
    if (navigator.share) {
        navigator.share({ title, text, url }).catch(() => {});
        return;
    }

    // 2️⃣ Clipboard API (HTTPS / localhost)
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(url).then(() => {
            showShareToast('✅ Link berhasil disalin ke clipboard!');
        }).catch(() => fallbackCopy(url));
        return;
    }

    // 3️⃣ execCommand fallback (HTTP, semua browser lama)
    fallbackCopy(url);
}

function fallbackCopy(text) {
    const ta = document.createElement('textarea');
    ta.value = text;
    ta.style.cssText = 'position:fixed;top:-9999px;left:-9999px;opacity:0;';
    document.body.appendChild(ta);
    ta.focus();
    ta.select();
    try {
        const ok = document.execCommand('copy');
        showShareToast(ok ? '✅ Link berhasil disalin ke clipboard!' : '⚠️ Gagal menyalin. Salin manual: ' + text);
    } catch (e) {
        showShareToast('⚠️ Gagal menyalin. Salin manual: ' + text);
    }
    document.body.removeChild(ta);
}

function showShareToast(msg) {
    const old = document.getElementById('share-toast');
    if (old) old.remove();

    const toast = document.createElement('div');
    toast.id = 'share-toast';
    toast.textContent = msg;
    toast.style.cssText = [
        'position:fixed', 'bottom:24px', 'left:50%', 'transform:translateX(-50%)',
        'background:#1b4332', 'color:#fff', 'padding:12px 24px', 'border-radius:50px',
        'font-family:var(--font-body,sans-serif)', 'font-size:0.9rem', 'font-weight:600',
        'box-shadow:0 8px 24px rgba(0,0,0,0.25)', 'z-index:9999',
        'opacity:0', 'transition:opacity 0.3s ease', 'white-space:nowrap',
    ].join(';');

    document.body.appendChild(toast);
    requestAnimationFrame(() => { toast.style.opacity = '1'; });
    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 350);
    }, 3000);
}
</script>
@endpush
