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
        <div class="col-6 col-md-3">
            <div class="text-center py-3 px-2 rounded-4 border bg-white shadow-sm hover-lift">
                <div class="fw-bold mb-0" style="font-size:2rem; color:var(--color-forest); font-family:var(--font-heading);">{{ $totalUmkm }}</div>
                <small class="text-muted" style="font-family:var(--font-body);">Total UMKM</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="text-center py-3 px-2 rounded-4 border bg-white shadow-sm hover-lift">
                <div class="fw-bold mb-0" style="font-size:2rem; color:var(--color-forest); font-family:var(--font-heading);">{{ $totalVerifikasi }}</div>
                <small class="text-muted" style="font-family:var(--font-body);">Terverifikasi di Peta</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="text-center py-3 px-2 rounded-4 border bg-white shadow-sm hover-lift">
                <div class="fw-bold mb-0" style="font-size:2rem; color:var(--color-forest); font-family:var(--font-heading);">3</div>
                <small class="text-muted" style="font-family:var(--font-body);">Dusun</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
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
     PETA INTERAKTIF
═══════════════════════════════════════════════════════════════════════════ --}}
<div class="container mb-4">
    <div class="glass-card bg-white rounded-4 shadow border overflow-hidden" style="border-color:var(--color-forest)1a!important;">
        {{-- Header Peta --}}
        <div class="d-flex align-items-center justify-content-between px-4 py-3 border-bottom"
             style="background:linear-gradient(135deg,var(--color-forest) 0%,var(--primary-dark) 100%);">
            <div class="d-flex align-items-center text-white">
                <i data-lucide="map" class="me-2" style="width:20px;height:20px;color:var(--accent);"></i>
                <span class="fw-bold" style="font-family:var(--font-heading);">Peta UMKM Desa Selorejo</span>
                <span class="badge rounded-pill ms-2 px-3 py-1 fw-bold shadow-sm"
                      style="font-size:0.75rem;font-family:var(--font-body);background:var(--accent)!important;color:var(--text-on-accent)!important;border:none;" id="map-marker-count">
                    {{ $totalVerifikasi }} titik
                </span>
            </div>
            <div class="d-flex align-items-center gap-2">
                {{-- Toggle Heatmap --}}
                <button id="btn-heatmap" class="btn btn-sm rounded-pill px-3 fw-bold border-0"
                        style="background:rgba(255,255,255,0.15);color:#fff;font-family:var(--font-body);font-size:0.78rem;"
                        onclick="toggleHeatmap()">
                    <i data-lucide="flame" class="icon-xs me-1"></i> Heatmap
                </button>
                {{-- Toggle Semua Marker --}}
                <button id="btn-all-markers" class="btn btn-sm rounded-pill px-3 fw-bold border-0"
                        style="background:rgba(255,255,255,0.25);color:#fff;font-family:var(--font-body);font-size:0.78rem;"
                        onclick="showAllMarkers()">
                    <i data-lucide="layers" class="icon-xs me-1"></i> Semua
                </button>
            </div>
        </div>

        {{-- Legend Kategori Warna --}}
        <div class="px-4 py-2 border-bottom bg-light d-flex flex-wrap gap-2 align-items-center"
             style="font-family:var(--font-body);font-size:0.72rem;">
            <span class="text-muted fw-bold me-1">Legenda:</span>
            <span class="badge rounded-pill" style="background:#2d6a4f;">🟢 Wisata Jeruk</span>
            <span class="badge rounded-pill" style="background:#52b788;">🟩 Jual Jeruk</span>
            <span class="badge rounded-pill" style="background:#e07a5f;">🔴 Warung Makan</span>
            <span class="badge rounded-pill" style="background:#3d405b;">🔵 Kelontong & Sembako</span>
            <span class="badge rounded-pill" style="background:#f2cc8f;color:#333;">🟡 Jasa & Lainnya</span>
        </div>

        {{-- Map Container (Leaflet.js + OpenStreetMap — gratis, tanpa API key) --}}
        <div id="umkm-map" style="height:420px; width:100%; z-index:1;"></div>
    </div>
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

                {{-- Gambar Tampilan Depan Usaha / Streetview --}}
                <div class="position-relative overflow-hidden" style="height:160px;">
                    <img src="{{ $u->foto_url }}" class="w-100 h-100" style="object-fit:cover;" alt="{{ $u->nama_usaha }}" loading="lazy">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background:linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.4) 100%);"></div>
                    
                    {{-- Badge Dusun --}}
                    <div class="position-absolute bottom-0 start-0 m-2 z-1">
                        <span class="badge rounded-pill px-2.5 py-1 shadow-sm fw-bold"
                              style="font-size:0.68rem;background:var(--color-forest)!important;color:#fff;font-family:var(--font-body);">
                            <i data-lucide="map-pin" class="icon-xs me-1"></i>{{ $u->dusun }}
                        </span>
                    </div>
                </div>

                <div class="card-body p-3 d-flex flex-column">
                    {{-- Nama Usaha --}}
                    <h6 class="fw-bold text-dark mb-1 lh-sm" style="font-family:var(--font-heading);font-size:0.95rem;">
                        {{ $u->nama_usaha }}
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
                        @if($u->whatsappLink())
                        <a href="{{ $u->whatsappLink() }}" target="_blank" rel="noopener"
                           class="btn btn-sm rounded-pill px-3 fw-bold flex-fill"
                           style="background:#25D366;color:#fff;border:none;font-family:var(--font-body);font-size:0.75rem;">
                            <i data-lucide="message-circle" class="icon-xs me-1"></i>WhatsApp
                        </a>
                        @elseif($u->no_telepon)
                        <a href="tel:{{ $u->no_telepon }}" class="btn btn-sm rounded-pill px-3 fw-bold flex-fill"
                           style="background:var(--color-forest);color:#fff;border:none;font-family:var(--font-body);font-size:0.75rem;">
                            <i data-lucide="phone" class="icon-xs me-1"></i>Telepon
                        </a>
                        @endif

                        @if($u->hasGmaps())
                        <a href="{{ $u->link_gmaps }}" target="_blank" rel="noopener"
                           class="btn btn-sm rounded-pill px-3 fw-bold flex-fill"
                           style="background:#4285F4;color:#fff;border:none;font-family:var(--font-body);font-size:0.75rem;">
                            <i data-lucide="map" class="icon-xs me-1"></i>Google Maps
                        </a>
                        @endif

                        @if($u->isVerified())
                        <button class="btn btn-sm rounded-pill px-2 fw-bold"
                                onclick="focusMapMarker({{ $u->id }}, {{ $u->latitude }}, {{ $u->longitude }})"
                                title="Lihat di Peta"
                                style="background:var(--color-forest)15;color:var(--color-forest);border:1px solid var(--color-forest)30;font-size:0.72rem;font-family:var(--font-body);">
                            <i data-lucide="crosshair" class="icon-xs"></i>
                        </button>
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

@push('styles')
{{-- Leaflet.js CSS (cdn.jsdelivr.net - 100% reachable) --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.markercluster@1.5.3/dist/MarkerCluster.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css"/>
<style>
    #umkm-map {
        background-color: #e5e3df !important;
        min-height: 420px;
    }
    .leaflet-popup-content-wrapper {
        border-radius: 12px !important;
        box-shadow: 0 8px 24px rgba(0,0,0,0.15) !important;
    }
</style>
@endpush

@push('scripts')
{{-- Leaflet.js core & plugins (cdn.jsdelivr.net) --}}
<script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/leaflet.heat@0.2.0/dist/leaflet-heat.js"></script>
<script src="https://cdn.jsdelivr.net/npm/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

<script>
const UMKM_MAP_DATA = @json($umkmMap);

// Warna marker per kategori
const KATEGORI_COLORS = {
    'Wisata & Kios Petik Jeruk':         '#2d6a4f',
    'Jual Jeruk & Bibit':                '#52b788',
    'Warung Makan':                       '#e07a5f',
    'Toko Kelontong & Sembako':          '#3d405b',
    'Toko Obat Tanaman & Pupuk':         '#8b5e3c',
    'Kuliner Ringan & Jajanan':          '#f4a261',
    'Jasa & Persewaan':                  '#c9a227',
    'Frozen Food':                        '#457b9d',
    'Fashion & Kebutuhan Rumah Tangga':  '#e76f51',
    'Sembako & Hewan/Perabot':           '#6d6875',
    'Toko Buah & Sayur':                 '#81b29a',
    'Dagang Buah Lain':                  '#b5842a',
};

let map, heatLayer, clusterGroup, markersMap = {};
let heatmapActive = false;

// ─── Buat SVG circle icon per warna ────────────────────────────────────────
function makeIcon(color) {
    const svg = `<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="9" fill="${color}" stroke="#ffffff" stroke-width="2.5"/>
    </svg>`;
    return L.divIcon({
        html: svg,
        className: 'leaflet-custom-pin',
        iconSize: [26, 26],
        iconAnchor: [13, 13],
        popupAnchor: [0, -14],
    });
}

function initUmkmMap() {
    const mapEl = document.getElementById('umkm-map');
    if (!mapEl || typeof L === 'undefined') return;

    if (map) {
        map.remove();
    }

    map = L.map('umkm-map', {
        center: [-7.937, 112.528],
        zoom: 14,
        scrollWheelZoom: false,
    });

    // Tile Layer Utama: OpenStreetMap
    const osmTile = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        maxZoom: 19,
    });

    // Tile Layer Cadangan: CartoDB Voyager
    const cartoTile = L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; CARTO',
        subdomains: 'abcd',
        maxZoom: 19,
    });

    osmTile.addTo(map);

    // Jika OSM bermasalah, switch otomatis ke CartoDB
    osmTile.on('tileerror', function() {
        if (!map.hasLayer(cartoTile)) {
            map.removeLayer(osmTile);
            cartoTile.addTo(map);
        }
    });

    // Invalidate size agar canvas peta langsung terisi penuh tanpa box putih
    setTimeout(() => { if (map) map.invalidateSize(); }, 150);
    setTimeout(() => { if (map) map.invalidateSize(); }, 600);

    // Enable scroll zoom pada click
    map.on('click', () => map.scrollWheelZoom.enable());
    map.on('mouseout', () => map.scrollWheelZoom.disable());

    renderMarkers(UMKM_MAP_DATA);
}

function renderMarkers(data) {
    if (!map || typeof L === 'undefined') return;

    if (clusterGroup) map.removeLayer(clusterGroup);
    if (heatLayer)    map.removeLayer(heatLayer);
    markersMap = {};
    heatmapActive = false;
    const btnHeat = document.getElementById('btn-heatmap');
    if (btnHeat) btnHeat.style.background = 'rgba(255,255,255,0.15)';

    clusterGroup = L.markerClusterGroup({
        maxClusterRadius: 45,
        spiderfyOnMaxZoom: true,
        showCoverageOnHover: false,
        zoomToBoundsOnClick: true,
    });

    const heatPoints = [];

    data.forEach(umkm => {
        if (!umkm.lat || !umkm.lng) return;

        const lat   = parseFloat(umkm.lat);
        const lng   = parseFloat(umkm.lng);
        const color = KATEGORI_COLORS[umkm.kategori] || '#2d6a4f';
        const icon  = makeIcon(color);

        const waBtn   = umkm.wa_link
            ? `<a href="${umkm.wa_link}" target="_blank" rel="noopener" style="display:inline-block;margin-right:4px;padding:4px 10px;background:#25D366;color:#fff;border-radius:20px;font-size:0.72rem;text-decoration:none;font-weight:600;">💬 WhatsApp</a>`
            : '';
        const mapsBtn = umkm.link_gmaps
            ? `<a href="${umkm.link_gmaps}" target="_blank" rel="noopener" style="display:inline-block;padding:4px 10px;background:#4285F4;color:#fff;border-radius:20px;font-size:0.72rem;text-decoration:none;font-weight:600;">🗺 Google Maps</a>`
            : '';

        const popupContent = `
            <div style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;min-width:200px;max-width:240px;padding:2px;">
                <div style="font-weight:700;font-size:0.9rem;color:#1b4332;border-bottom:1px solid #e9ecef;padding-bottom:5px;margin-bottom:6px;">${umkm.nama_usaha}</div>
                <div style="font-size:0.75rem;color:#444;margin-bottom:3px;">👤 Pemilik: <strong>${umkm.nama_pemilik}</strong></div>
                <div style="font-size:0.75rem;color:#444;margin-bottom:3px;">🏪 Kategori: <strong>${umkm.kategori}</strong></div>
                <div style="font-size:0.75rem;color:#444;margin-bottom:${umkm.no_telepon ? '3' : '8'}px;">📍 Dusun ${umkm.dusun}${umkm.alamat_rt_rw ? ' · RT/RW ' + umkm.alamat_rt_rw : ''}</div>
                ${umkm.no_telepon ? `<div style="font-size:0.75rem;color:#444;margin-bottom:8px;">📞 ${umkm.no_telepon}</div>` : ''}
                <div style="margin-top:6px;">${waBtn}${mapsBtn}</div>
            </div>`;

        const marker = L.marker([lat, lng], { icon })
            .bindPopup(popupContent, { maxWidth: 250 });

        clusterGroup.addLayer(marker);
        markersMap[umkm.id] = marker;
        heatPoints.push([lat, lng, 0.8]);
    });

    map.addLayer(clusterGroup);

    if (typeof L.heatLayer === 'function') {
        heatLayer = L.heatLayer(heatPoints, {
            radius: 35,
            blur: 20,
            maxZoom: 17,
            gradient: { 0.4: '#52b788', 0.65: '#f4a261', 1: '#e07a5f' },
        });
    }

    const counter = document.getElementById('map-marker-count');
    if (counter) counter.textContent = Object.keys(markersMap).length + ' titik';
}

function toggleHeatmap() {
    if (!heatLayer || !map) return;
    heatmapActive = !heatmapActive;
    if (heatmapActive) {
        heatLayer.addTo(map);
        document.getElementById('btn-heatmap').style.background = 'rgba(255,100,50,0.7)';
    } else {
        map.removeLayer(heatLayer);
        document.getElementById('btn-heatmap').style.background = 'rgba(255,255,255,0.15)';
    }
}

function showAllMarkers() {
    if (!map) return;
    renderMarkers(UMKM_MAP_DATA);
    map.setView([-7.937, 112.528], 14);
}

function focusMapMarker(id, lat, lng) {
    if (!map) return;
    document.getElementById('umkm-map').scrollIntoView({ behavior: 'smooth', block: 'center' });
    setTimeout(() => {
        map.setView([parseFloat(lat), parseFloat(lng)], 17, { animate: true });
        if (markersMap[id] && clusterGroup) {
            clusterGroup.zoomToShowLayer(markersMap[id], () => {
                markersMap[id].openPopup();
            });
        }
    }, 350);
}

// Inisialisasi peta
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initUmkmMap);
} else {
    initUmkmMap();
}
window.addEventListener('resize', () => { if (map) map.invalidateSize(); });
</script>
@endpush
