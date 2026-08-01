@extends('layouts.public')
@section('title', 'Direktori UMKM Desa Selorejo')
@section('breadcrumb')
    <li class="breadcrumb-item">Unit Usaha</li>
    <li class="breadcrumb-item active">Direktori UMKM</li>
@endsection

@section('content')
@include('layouts.partials.page-hero', [
    'title'    => 'Direktori UMKM Selorejo',
    'subtitle' => 'Temukan & dukung usaha mikro, kecil, dan menengah warga Desa Selorejo.',
    'icon'     => 'store'
])

{{-- ═══════════════════════════════════════════════════════════════════════════
     STATISTIK RINGKAS
═══════════════════════════════════════════════════════════════════════════ --}}
<div class="container mb-5">
    <div class="row g-3 justify-content-center">
        <div class="col-4 col-md-4">
            <div class="text-center py-3 px-2 rounded-4 border bg-white shadow-sm hover-lift">
                <div class="fw-bold mb-0" style="font-size:2rem; color:var(--color-forest); font-family:var(--font-heading);">{{ $totalUmkm }}</div>
                <small class="text-muted" style="font-family:var(--font-body);">Total UMKM</small>
            </div>
        </div>
        <div class="col-4 col-md-4">
            <div class="text-center py-3 px-2 rounded-4 border bg-white shadow-sm hover-lift">
                <div class="fw-bold mb-0" style="font-size:2rem; color:var(--color-forest); font-family:var(--font-heading);">3</div>
                <small class="text-muted" style="font-family:var(--font-body);">Dusun</small>
            </div>
        </div>
        <div class="col-4 col-md-4">
            <div class="text-center py-3 px-2 rounded-4 border bg-white shadow-sm hover-lift">
                <div class="fw-bold mb-0" style="font-size:2rem; color:var(--color-forest); font-family:var(--font-heading);">12</div>
                <small class="text-muted" style="font-family:var(--font-body);">Kategori Usaha</small>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════════════════════
     SEARCH & FILTER
═══════════════════════════════════════════════════════════════════════════ --}}
<div class="container mb-4">
    <form action="{{ route('wisata.umkm') }}" method="GET" class="row g-2 align-items-center justify-content-center" id="umkm-filter-form">
        <div class="col-md-4">
            <div class="input-group rounded-pill overflow-hidden border bg-white shadow-sm px-3">
                <span class="input-group-text bg-transparent border-0">
                    <i data-lucide="search" class="icon-sm" style="color:var(--color-forest)!important;"></i>
                </span>
                <input type="text" name="search" id="umkm-search-input" class="form-control border-0 shadow-none py-2" style="font-family:var(--font-body);"
                       placeholder="Cari nama usaha, pemilik, dusun..." value="{{ request('search') }}">
            </div>
        </div>
        <div class="col-md-2">
            <div class="d-flex align-items-center bg-white shadow-sm border rounded-pill px-3 py-1 hover-lift">
                <i data-lucide="tag" class="text-muted icon-sm me-1"></i>
                <select name="kategori" class="border-0 bg-transparent fw-bold text-muted px-1 py-1 shadow-none w-100"
                        style="font-size:var(--text-sm);outline:none;cursor:pointer;font-family:var(--font-body);" onchange="this.form.submit()">
                    <option value="semua" {{ request('kategori', 'semua') == 'semua' ? 'selected' : '' }}>Semua Kategori</option>
                    @foreach(\App\Models\Umkm::KATEGORI_LIST as $kat)
                        <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="d-flex align-items-center bg-white shadow-sm border rounded-pill px-3 py-1 hover-lift">
                <i data-lucide="map-pin" class="text-muted icon-sm me-1"></i>
                <select name="dusun" class="border-0 bg-transparent fw-bold text-muted px-1 py-1 shadow-none w-100"
                        style="font-size:var(--text-sm);outline:none;cursor:pointer;font-family:var(--font-body);" onchange="this.form.submit()">
                    <option value="semua" {{ request('dusun', 'semua') == 'semua' ? 'selected' : '' }}>Semua Dusun</option>
                    <option value="Krajan"    {{ request('dusun') == 'Krajan'    ? 'selected' : '' }}>Krajan</option>
                    <option value="Selokerto" {{ request('dusun') == 'Selokerto' ? 'selected' : '' }}>Selokerto</option>
                    <option value="Gumuk"     {{ request('dusun') == 'Gumuk'     ? 'selected' : '' }}>Gumuk</option>
                </select>
            </div>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn rounded-pill px-4 shadow-sm"
                    style="background-color:var(--color-forest)!important;color:#fff!important;font-family:var(--font-heading);border:none;">Cari</button>
            @if(request('search') || (request('kategori') && request('kategori') != 'semua') || (request('dusun') && request('dusun') != 'semua'))
                <a href="{{ route('wisata.umkm') }}" class="btn btn-outline-secondary rounded-pill px-3 ms-1"
                   style="font-family:var(--font-heading);">Reset</a>
            @endif
        </div>
    </form>
</div>

{{-- ═══════════════════════════════════════════════════════════════════════════
     LISTING GRID KARTU UMKM
═══════════════════════════════════════════════════════════════════════════ --}}
<div class="container mb-5 pb-5" id="umkm-listing">

    @if($umkms->total() > 0)
    <div class="text-muted small mb-3 text-center" style="font-family:var(--font-body);">
        Menampilkan <strong>{{ $umkms->total() }}</strong> UMKM
        @if(request('search')) <span>· Hasil: <em>"{{ request('search') }}"</em></span> @endif
        @if(request('kategori') && request('kategori') != 'semua') <span>· Kategori: <em>{{ request('kategori') }}</em></span> @endif
        @if(request('dusun') && request('dusun') != 'semua') <span>· Dusun: <em>{{ request('dusun') }}</em></span> @endif
    </div>
    @endif

    <div class="row g-4">
        @forelse($umkms as $u)
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3" id="umkm-card-{{ $u->id }}">
            <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift overflow-hidden"
                 style="transition:all .3s ease; border-color:var(--color-forest)1a!important;">

                {{-- Gambar Tampilan Depan Usaha --}}
                <div class="position-relative overflow-hidden" style="height:160px;">
                    <a href="{{ route('wisata.umkm.show', $u->id) }}" class="d-block w-100 h-100">
                        <img src="{{ $u->foto_url }}" class="w-100 h-100" style="object-fit:cover; transition:transform .3s ease;" alt="{{ $u->nama_usaha }}" loading="lazy">
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background:linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.4) 100%);"></div>
                    </a>
                    
                    {{-- Badge Dusun --}}
                    <div class="position-absolute bottom-0 start-0 m-2 z-1 pointer-events-none">
                        <span class="badge rounded-pill px-2.5 py-1 shadow-sm fw-bold"
                              style="font-size:0.68rem;background:var(--color-forest)!important;color:#fff;font-family:var(--font-body);">
                            <i data-lucide="map-pin" class="icon-xs me-1"></i>{{ $u->dusun }}
                        </span>
                    </div>
                </div>

                <div class="card-body p-3 d-flex flex-column">
                    {{-- Nama Usaha --}}
                    <h6 class="fw-bold text-dark mb-1 lh-sm" style="font-family:var(--font-heading);font-size:0.95rem;">
                        <a href="{{ route('wisata.umkm.show', $u->id) }}" class="text-decoration-none text-dark hover-forest">
                            {{ $u->nama_usaha }}
                        </a>
                        @if($u->nama_toko_gmaps && $u->nama_toko_gmaps !== $u->nama_usaha)
                            <small class="text-muted fw-normal d-block" style="font-size:0.7rem;">({{ $u->nama_toko_gmaps }})</small>
                        @endif
                    </h6>

                    {{-- Nama Pemilik --}}
                    <p class="text-muted small mb-2 d-flex align-items-center" style="font-family:var(--font-body);">
                        <i data-lucide="user" class="icon-xs me-1" style="color:var(--color-forest);"></i>
                        {{ $u->nama_pemilik }}
                    </p>

                    {{-- Jenis & Kategori --}}
                    <div class="mb-2">
                        <span class="badge rounded-pill px-2 py-1 me-1"
                              style="font-size:0.65rem;background:var(--color-forest)15;color:var(--color-forest);border:1px solid var(--color-forest)30;font-family:var(--font-body);">
                            {{ $u->kategori }}
                        </span>
                    </div>

                    <p class="text-muted small mb-2 lh-sm" style="font-family:var(--font-body);font-size:0.75rem;">
                        <i data-lucide="briefcase" class="icon-xs me-1"></i>{{ $u->jenis_usaha }}
                    </p>

                    @if($u->alamat_rt_rw)
                    <p class="text-muted small mb-2" style="font-family:var(--font-body);font-size:0.75rem;">
                        <i data-lucide="home" class="icon-xs me-1"></i>RT/RW {{ $u->alamat_rt_rw }}, Dusun {{ $u->dusun }}
                    </p>
                    @endif

                    {{-- Tombol Aksi --}}
                    <div class="mt-auto pt-2 d-flex flex-wrap gap-2">
                        <a href="{{ route('wisata.umkm.show', $u->id) }}"
                           class="btn btn-sm rounded-pill px-3 fw-bold flex-fill text-white shadow-sm"
                           style="background:var(--color-forest);border:none;font-family:var(--font-heading);font-size:0.75rem;">
                            <i data-lucide="eye" class="icon-xs me-1"></i>Detail Usaha
                        </a>

                        @if($u->whatsappLink())
                        <a href="{{ $u->whatsappLink() }}" target="_blank" rel="noopener"
                           class="btn btn-sm rounded-pill px-2 fw-bold" title="WhatsApp"
                           style="background:#25D366;color:#fff;border:none;font-size:0.75rem;">
                            <i data-lucide="message-circle" class="icon-xs"></i>
                        </a>
                        @endif

                        @if($u->hasGmaps())
                        <a href="{{ $u->link_gmaps }}" target="_blank" rel="noopener"
                           class="btn btn-sm rounded-pill px-2 fw-bold" title="Google Maps"
                           style="background:#4285F4;color:#fff;border:none;font-size:0.75rem;">
                            <i data-lucide="map" class="icon-xs"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted p-5 bg-white rounded-4 border" style="font-family:var(--font-body);">
            <i data-lucide="store" style="width:64px;height:64px;color:var(--color-forest);opacity:0.2;" class="mb-3 d-block mx-auto"></i>
            @if(request('search') || request('kategori') || request('dusun'))
                UMKM tidak ditemukan untuk filter yang dipilih.
                <div class="mt-3">
                    <a href="{{ route('wisata.umkm') }}" class="btn rounded-pill px-4 hover-lift btn-outline-forest"
                       style="font-family:var(--font-heading);">Lihat Semua UMKM</a>
                </div>
            @else
                Data UMKM sedang diperbarui oleh pengelola.
            @endif
        </div>
        @endforelse
    </div>

    @if($umkms->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $umkms->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

{{-- ═══════════════════════════════════════════════════════════════════════════
     CTA BAWAH
═══════════════════════════════════════════════════════════════════════════ --}}
<div class="container mb-5">
    <div class="p-4 p-md-5 rounded-4 text-white position-relative overflow-hidden shadow-lg"
         style="background:var(--color-forest)!important;">
        <div class="position-absolute start-0 bottom-0 opacity-10" style="margin-left:-30px;margin-bottom:-30px;">
            <i data-lucide="store" style="width:200px;height:200px;"></i>
        </div>
        <div class="position-relative z-1 py-2 text-center">
            <i data-lucide="shopping-bag" class="icon-lg mb-3" style="width:48px;height:48px;color:var(--accent)!important;"></i>
            <h2 class="fw-bold mb-2 text-white" style="font-family:var(--font-heading);color:#ffffff!important;">Dukung UMKM Lokal Selorejo</h2>
            <p class="mb-4 text-white opacity-100 fw-medium" style="font-family:var(--font-body);color:#ffffff!important;">Beli produk lokal, dukung perekonomian warga desa kita bersama.</p>
            <a href="{{ route('produk.index') }}" class="btn fw-bold px-5 py-3 rounded-pill shadow-lg hover-lift"
               style="background:var(--accent)!important;color:var(--text-on-accent)!important;font-family:var(--font-heading);border:none;">
                <i data-lucide="shopping-cart" class="icon-sm me-2"></i>Lihat Katalog Produk Desa
            </a>
        </div>
    </div>
</div>

@endsection
