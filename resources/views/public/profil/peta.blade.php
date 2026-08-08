@extends('layouts.public')

@section('title', 'Peta Wilayah & Destinasi Desa Selorejo')

@push('styles')
<style>
    /* ── Glass Card ── */
    .glass-card {
        background: rgba(255, 255, 255, 0.97);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(0, 0, 0, 0.08);
    }

    /* ── Info Row (identitas & spesifikasi) ── */
    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 8px;
        padding: 8px 0;
        border-bottom: 1px dashed rgba(0,0,0,0.08);
        font-size: 0.86rem;
    }
    .info-row:last-child { border-bottom: none; }
    .info-label { color: #666; font-family: var(--font-body); flex-shrink: 0; }
    .info-value { font-family: var(--font-heading); color: #1a1a1a; text-align: right; }

    /* ── Badge Kode Wilayah ── */
    .badge-kode {
        background: linear-gradient(135deg, var(--color-forest) 0%, #2e7d32 100%);
        color: white;
        font-family: monospace;
        font-size: 0.88rem;
        padding: 4px 12px;
        border-radius: 6px;
        letter-spacing: 1px;
    }

    /* ── Peta Image Wrapper (Lightbox & Full Width) ── */
    .peta-img-wrapper {
        position: relative;
        border-radius: 12px;
        background: #f5f5f5;
        overflow: hidden;
        cursor: zoom-in;
    }
    .peta-img-wrapper:hover opacity: 0.96; }
    .peta-zoom-hint {
        position: absolute;
        bottom: 12px;
        right: 12px;
        background: rgba(0,0,0,0.72);
        color: white;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-family: var(--font-body);
        pointer-events: none;
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* ── Tab Navigation (Floating without white bar) ── */
    #peta-tabs .nav-link {
        color: #444;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(8px);
        border: 1.5px solid rgba(0, 0, 0, 0.08);
        font-family: var(--font-heading);
        font-size: 0.88rem;
        transition: all 0.25s ease;
        padding: 9px 22px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    #peta-tabs .nav-link:hover {
        background: #ffffff;
        color: var(--color-forest, #1a5c38);
        border-color: rgba(26,92,56,0.3);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(26,92,56,0.1);
    }
    #peta-tabs .nav-link.active {
        background: var(--color-forest, #1a5c38) !important;
        color: #ffffff !important;
        border-color: var(--color-forest, #1a5c38) !important;
        box-shadow: 0 4px 14px rgba(26,92,56,0.25) !important;
    }

    /* ── Destinasi Wisata Card ── */
    .dest-card {
        border: 1px solid rgba(26,92,56,0.12);
        transition: all 0.28s ease;
        background: #fff;
    }
    .dest-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 32px rgba(26,92,56,0.14) !important;
        border-color: var(--color-forest) !important;
    }
    .dest-card:hover .dest-img { transform: scale(1.06); }

    /* ── UMKM Titik Card ── */
    .titik-card-box {
        border: 1px solid rgba(0,0,0,0.08);
        background: #fff;
        border-radius: 16px;
        transition: all 0.25s ease;
    }
    .titik-card-box:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.09) !important;
        border-color: var(--color-forest) !important;
    }
    .titik-card-box:hover .titik-img { transform: scale(1.06); }

    /* ── Aesthetic Filter Chips ── */
    .filter-chip-btn {
        transition: all 0.2s ease;
        font-family: var(--font-body);
        font-size: 0.8rem;
        padding: 6px 16px;
        background: rgba(255,255,255,0.9);
        border: 1px solid rgba(0,0,0,0.1) !important;
        color: #444;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    }
    .filter-chip-btn:hover {
        transform: translateY(-1px);
        border-color: var(--color-forest) !important;
        color: var(--color-forest) !important;
        background: #fff;
    }
    .filter-chip-btn.active-chip {
        background: var(--color-forest, #1a5c38) !important;
        color: #fff !important;
        border-color: var(--color-forest, #1a5c38) !important;
        box-shadow: 0 4px 12px rgba(26,92,56,0.2) !important;
    }

    /* ── Summary/Details Chevron ── */
    details summary::-webkit-details-marker { display: none; }
    details[open] .summary-chevron { transform: rotate(180deg); }
    .summary-chevron { transition: transform .25s ease; }

    .tab-pane.fade { transition: opacity .22s ease; }
</style>
@endpush

@section('content')
@php
    $petaBatas = $petaDokumens['batas-desa'] ?? null;
    $petaWisata = $petaDokumens['destinasi-wisata'] ?? null;
    $petaUmkm = $petaDokumens['kawasan-wisata-umkm'] ?? null;
@endphp

@include('layouts.partials.page-hero', [
    'title'    => 'Peta Wilayah & Destinasi Desa',
    'subtitle' => 'Dokumen kartometrik resmi batas administrasi, destinasi wisata, dan persebaran UMKM Desa Selorejo',
    'icon'     => 'map'
])

{{-- ══════════════ FLOATING TAB NAVIGATION (No White Backdrop) ══════════════ --}}
<div class="py-3" style="position:sticky;top:0;z-index:100;backdrop-filter:blur(10px);background:rgba(245,247,245,0.75);">
    <div class="container">
        <ul class="nav nav-pills gap-2 justify-content-center flex-nowrap overflow-auto py-1" id="peta-tabs" role="tablist" style="scrollbar-width:none;">
            <li class="nav-item" role="presentation">
                <button class="nav-link active fw-bold rounded-pill px-4 py-2.5 d-flex align-items-center gap-2"
                    id="tab-batas-desa-btn" data-bs-toggle="pill" data-bs-target="#tab-batas-desa"
                    type="button" role="tab" aria-selected="true">
                    <i data-lucide="landmark" style="width:16px;height:16px;"></i>
                    Peta Batas Desa Resmi
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold rounded-pill px-4 py-2.5 d-flex align-items-center gap-2"
                    id="tab-wisata-btn" data-bs-toggle="pill" data-bs-target="#tab-wisata"
                    type="button" role="tab" aria-selected="false">
                    <i data-lucide="map-pin" style="width:16px;height:16px;"></i>
                    Destinasi Wisata
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold rounded-pill px-4 py-2.5 d-flex align-items-center gap-2"
                    id="tab-umkm-btn" data-bs-toggle="pill" data-bs-target="#tab-umkm"
                    type="button" role="tab" aria-selected="false">
                    <i data-lucide="store" style="width:16px;height:16px;"></i>
                    Kawasan Wisata &amp; UMKM
                </button>
            </li>
        </ul>
    </div>
</div>

<div class="tab-content">

{{-- ════════════════════════════════════════════════════════
     TAB 1: PETA BATAS DESA RESMI
     ════════════════════════════════════════════════════════ --}}
<div class="tab-pane fade show active" id="tab-batas-desa" role="tabpanel" aria-labelledby="tab-batas-desa-btn">
<div class="container py-4">

    {{-- BARIS 1 (ATAS): GAMBAR PETA FULL WIDTH (COL-12) --}}
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="glass-card rounded-4 shadow-sm p-4" style="border-top:5px solid var(--color-forest);">
                <div class="d-flex align-items-center justify-content-between mb-3 px-1">
                    <div class="d-flex align-items-center gap-2">
                        <i data-lucide="map" style="width:22px;height:22px;color:var(--color-forest);"></i>
                        <h4 class="fw-bold mb-0" style="font-family:var(--font-heading);">Peta Batas Desa Resmi</h4>
                    </div>
                    <span class="badge rounded-pill px-3 py-2 d-flex align-items-center gap-1" style="background:rgba(26,92,56,0.08);color:var(--color-forest);border:1px solid rgba(26,92,56,0.18);font-family:var(--font-body);font-size:0.75rem;">
                        <i data-lucide="zoom-in" style="width:13px;height:13px;"></i> Klik untuk Zoom
                    </span>
                </div>
                <div class="peta-img-wrapper lightbox-trigger"
                     data-src="{{ asset('images/35.07.22.2005 SELOREJO.jpg') }}"
                     data-caption="Peta Batas Wilayah Desa Selorejo — Kode 35.07.22.2005 | Skala 1:14.000 | Tahun 2021"
                     data-category="Peta Resmi" data-date="2021">
                    <img src="{{ asset('images/35.07.22.2005 SELOREJO.jpg') }}"
                         alt="Peta Batas Desa Selorejo"
                         class="img-fluid w-100"
                         style="object-fit:contain;display:block;border-radius:8px;max-height:680px;"
                         loading="lazy">
                    <div class="peta-zoom-hint"><i data-lucide="zoom-in" style="width:14px;height:14px;"></i> Klik untuk memperbesar peta resolusi tinggi</div>
                </div>
                <p class="text-muted mb-0 mt-3 px-1 text-center" style="font-size:0.8rem;font-family:var(--font-body);line-height:1.5;">
                    <i data-lucide="info" style="width:13px;height:13px;color:var(--color-forest);vertical-align:-1px;"></i>
                    Sumber: Pemerintah Kab. Malang (2021). Data berdasarkan Citra Satelit (2013–2015) dan Kesepakatan Teknis Batas Desa 2021. SRGI 2013, UTM 49S.
                </p>
            </div>
        </div>
    </div>

    {{-- BARIS 2 (TENGAH): IDENTITAS + SPESIFIKASI TEKNIS GEOSPASIAL & KOORDINAT --}}
    <div class="row g-4 mb-4">
        <div class="col-lg-5">
            <div class="glass-card rounded-4 shadow-sm p-4 h-100" style="border-top:4px solid var(--color-forest);">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="rounded-2 p-2" style="background:var(--color-forest);">
                        <i data-lucide="file-map" style="width:18px;height:18px;color:#fff;"></i>
                    </div>
                    <h5 class="fw-bold mb-0" style="font-family:var(--font-heading);">Identitas Peta</h5>
                </div>
                <hr style="border-color:rgba(26,92,56,0.15);margin-bottom:12px;">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge-kode">35.07.22.2005</span>
                    <small class="text-muted" style="font-family:var(--font-body);">Kode Wilayah Resmi</small>
                </div>
                <div class="info-row"><span class="info-label">Nama Peta</span><span class="info-value">Peta Batas Desa Selorejo</span></div>
                <div class="info-row"><span class="info-label">Desa / Kecamatan</span><span class="info-value fw-bold">Selorejo / Dau</span></div>
                <div class="info-row"><span class="info-label">Kabupaten / Provinsi</span><span class="info-value">Malang / Jawa Timur</span></div>
                <div class="info-row"><span class="info-label">Skala Peta</span><span class="info-value fw-semibold">1 : 14.000</span></div>
                <div class="info-row"><span class="info-label">Tahun Terbit</span><span class="info-value fw-semibold">2021</span></div>
                <div class="info-row"><span class="info-label">Diterbitkan oleh</span><span class="info-value">Pemerintah Kab. Malang</span></div>
                <div class="mt-3 p-3 rounded-3" style="background:rgba(26,92,56,0.05);border:1px solid rgba(26,92,56,0.12);">
                    <p class="mb-0 text-muted" style="font-size:0.8rem;font-family:var(--font-body);line-height:1.6;">
                        <strong>Dokumen kartometrik resmi</strong> sebagai rujukan hukum administratif batas wilayah Desa Selorejo. © 2021.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="d-flex flex-column gap-4 h-100">
                <div class="glass-card rounded-4 shadow-sm p-4" style="border-top:4px solid #2196f3;">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="rounded-2 p-2" style="background:#2196f3;">
                            <i data-lucide="settings-2" style="width:18px;height:18px;color:#fff;"></i>
                        </div>
                        <h5 class="fw-bold mb-0" style="font-family:var(--font-heading);">Spesifikasi Teknis Geospasial</h5>
                    </div>
                    <hr style="border-color:rgba(33,150,243,0.2);margin-bottom:12px;">
                    <div class="row g-0">
                        <div class="col-sm-6"><div class="info-row pe-3"><span class="info-label">Sistem Koordinat</span><span class="info-value fw-semibold text-primary">{{ $petaBatas->sistem_koordinat ?? 'SRGI 2013' }}</span></div></div>
                        <div class="col-sm-6"><div class="info-row ps-3"><span class="info-label">Proyeksi</span><span class="info-value">{{ $petaBatas->proyeksi ?? 'Transverse Mercator' }}</span></div></div>
                        <div class="col-sm-6"><div class="info-row pe-3"><span class="info-label">Datum Geodesi</span><span class="info-value">{{ $petaBatas->datum ?? 'SRGI 2013' }}</span></div></div>
                        <div class="col-sm-6"><div class="info-row ps-3"><span class="info-label">Sistem Grid</span><span class="info-value">{{ $petaBatas->sistem_grid ?? 'Grid Geografi & UTM' }}</span></div></div>
                        <div class="col-sm-6"><div class="info-row pe-3"><span class="info-label">Zona UTM</span><span class="info-value">{{ $petaBatas->zona_utm ?? '49S (Selatan)' }}</span></div></div>
                        <div class="col-sm-6"><div class="info-row ps-3"><span class="info-label">Metode Pemetaan</span><span class="info-value">{{ $petaBatas->metode_pemetaan ?? 'Kartometrik Digital' }}</span></div></div>
                    </div>
                </div>

                <div class="glass-card rounded-4 shadow-sm p-4" style="border-top:4px solid #e63946;">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-2 p-2" style="background:#e63946;">
                                <i data-lucide="compass" style="width:18px;height:18px;color:#fff;"></i>
                            </div>
                            <h5 class="fw-bold mb-0" style="font-family:var(--font-heading);">Cakupan Koordinat Ekstrem</h5>
                        </div>
                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill" style="font-size:0.72rem;">UTM Zone 49S</span>
                    </div>
                    <div class="row g-2">
                        <div class="col-6"><div class="d-flex align-items-center gap-2 p-2.5 rounded-3" style="background:rgba(26,92,56,0.05);border:1px solid rgba(26,92,56,0.12);">
                            <i data-lucide="arrow-up" style="width:16px;height:16px;color:var(--color-forest);flex-shrink:0;"></i>
                            <div><div style="font-size:0.65rem;color:#888;text-transform:uppercase;letter-spacing:0.5px;line-height:1;">Utara (mU)</div><div class="fw-bold" style="font-size:0.85rem;font-family:monospace;">{{ $petaBatas->koordinat_utara ?? '9.122.500' }}</div></div>
                        </div></div>
                        <div class="col-6"><div class="d-flex align-items-center gap-2 p-2.5 rounded-3" style="background:rgba(230,57,70,0.05);border:1px solid rgba(230,57,70,0.12);">
                            <i data-lucide="arrow-down" style="width:16px;height:16px;color:#e63946;flex-shrink:0;"></i>
                            <div><div style="font-size:0.65rem;color:#888;text-transform:uppercase;letter-spacing:0.5px;line-height:1;">Selatan (mU)</div><div class="fw-bold" style="font-size:0.85rem;font-family:monospace;">{{ $petaBatas->koordinat_selatan ?? '9.115.983' }}</div></div>
                        </div></div>
                        <div class="col-6"><div class="d-flex align-items-center gap-2 p-2.5 rounded-3" style="background:rgba(255,152,0,0.05);border:1px solid rgba(255,152,0,0.12);">
                            <i data-lucide="arrow-right" style="width:16px;height:16px;color:#ff9800;flex-shrink:0;"></i>
                            <div><div style="font-size:0.65rem;color:#888;text-transform:uppercase;letter-spacing:0.5px;line-height:1;">Timur (mT)</div><div class="fw-bold" style="font-size:0.85rem;font-family:monospace;">{{ $petaBatas->koordinat_timur ?? '672.366' }}</div></div>
                        </div></div>
                        <div class="col-6"><div class="d-flex align-items-center gap-2 p-2.5 rounded-3" style="background:rgba(33,150,243,0.05);border:1px solid rgba(33,150,243,0.12);">
                            <i data-lucide="arrow-left" style="width:16px;height:16px;color:#2196f3;flex-shrink:0;"></i>
                            <div><div style="font-size:0.65rem;color:#888;text-transform:uppercase;letter-spacing:0.5px;line-height:1;">Barat (mT)</div><div class="fw-bold" style="font-size:0.85rem;font-family:monospace;">{{ $petaBatas->koordinat_barat ?? '660.489' }}</div></div>
                        </div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- BARIS 3 (BAWAH): GOOGLE MAPS + PANDUAN AKSES --}}
    <div class="row g-4 mb-4">
        <div class="col-lg-7">
            <div class="glass-card rounded-4 shadow-sm p-4" style="border-top:5px solid #4CAF50;">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <i data-lucide="navigation" style="width:20px;height:20px;color:#4CAF50;"></i>
                    <h5 class="fw-bold mb-0" style="font-family:var(--font-heading);">Google Maps Interaktif</h5>
                </div>
                <div class="rounded-3 overflow-hidden" style="height:320px;">
                    {!! $profile->peta_embed ?? '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15806.384864810932!2d112.53843605!3d-7.937170050000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7883ef912d9999%3A0xf8ff8468809efd9c!2sSelorejo%2C%20Kec.%20Dau%2C%20Kabupaten%20Malang%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1775912011055!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>' !!}
                </div>
                <a href="https://maps.google.com/?q=Desa+Selorejo+Kecamatan+Dau+Kabupaten+Malang" target="_blank"
                   class="btn btn-sm fw-bold w-100 rounded-pill mt-3 py-2 text-white"
                   style="background:var(--color-forest);border:none;font-family:var(--font-heading);">
                    <i data-lucide="external-link" style="width:14px;height:14px;" class="me-1"></i>Buka di Google Maps Navigasi
                </a>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="p-4 rounded-4 shadow-sm h-100 d-flex flex-column justify-content-between" style="background:var(--color-forest);color:#fff;">
                <div>
                    <h5 class="fw-bold mb-3 text-white" style="font-family:var(--font-heading);">
                        <i data-lucide="route" style="width:18px;height:18px;margin-right:6px;vertical-align:-2px;"></i>Panduan Akses Wilayah
                    </h5>
                    <div class="d-flex align-items-start gap-3 mb-4">
                        <div class="rounded-3 p-2.5 flex-shrink-0" style="background:rgba(255,255,255,0.15);"><i data-lucide="car" style="width:18px;height:18px;color:#fff;"></i></div>
                        <div>
                            <strong class="d-block mb-1 text-white" style="font-size:0.92rem;font-family:var(--font-heading);">Kendaraan Pribadi</strong>
                            <div class="small" style="color:rgba(255,255,255,0.9);line-height:1.6;font-family:var(--font-body);">{!! $profile->peta_rute_pribadi ?? '30 menit dari Kota Malang ke arah Barat menuju Kota Batu, belok di jalur Kecamatan Dau.' !!}</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-start gap-3">
                        <div class="rounded-3 p-2.5 flex-shrink-0" style="background:rgba(255,255,255,0.15);"><i data-lucide="bus" style="width:18px;height:18px;color:#fff;"></i></div>
                        <div>
                            <strong class="d-block mb-1 text-white" style="font-size:0.92rem;font-family:var(--font-heading);">Transportasi Umum</strong>
                            <div class="small" style="color:rgba(255,255,255,0.9);line-height:1.6;font-family:var(--font-body);">{!! $profile->peta_rute_umum ?? 'Angkutan pedesaan dari Terminal Landungsari menuju Kecamatan Dau.' !!}</div>
                        </div>
                    </div>
                </div>
                <div class="pt-3 border-top border-white border-opacity-25 mt-3">
                    <small class="text-white opacity-75" style="font-family:var(--font-body);font-size:0.78rem;">
                        📍 Balai Desa Selorejo, Kec. Dau, Kab. Malang, Jawa Timur 65151
                    </small>
                </div>
            </div>
        </div>
    </div>

</div>
</div>{{-- /tab-batas-desa --}}


{{-- ════════════════════════════════════════════════════════
     TAB 2: PETA DESTINASI WISATA DESA
     ════════════════════════════════════════════════════════ --}}
<div class="tab-pane fade" id="tab-wisata" role="tabpanel" aria-labelledby="tab-wisata-btn">
<div class="container py-4" id="section-destinasi-wisata">

    {{-- Section Header --}}
    <div class="d-flex align-items-center gap-3 mb-4">
        <div class="rounded-3 p-3 shadow-sm d-flex align-items-center justify-content-center flex-shrink-0" style="background:linear-gradient(135deg,#ff9800,#f57c00);width:52px;height:52px;">
            <i data-lucide="map-pin" style="width:26px;height:26px;color:#fff;"></i>
        </div>
        <div>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <h3 class="fw-bold text-dark mb-0" style="font-family:var(--font-heading);">Peta Destinasi Wisata Desa</h3>
                <span class="badge rounded-pill px-3 py-1" style="background:rgba(255,152,0,0.12);color:#e65100;border:1px solid rgba(255,152,0,0.25);font-family:var(--font-body);font-size:0.72rem;font-weight:700;">7 DESTINASI UNGGULAN</span>
            </div>
            <p class="text-muted mb-0 mt-1" style="font-family:var(--font-body);font-size:0.86rem;">
                Dokumen Kartografi Agrowisata &amp; Objek Wisata Alam Desa Selorejo, Kecamatan Dau, Kabupaten Malang
            </p>
        </div>
    </div>
    <hr style="border-color:rgba(255,152,0,0.25);opacity:1;margin-bottom:24px;">

    {{-- BARIS 1 (ATAS): GAMBAR PETA FULL WIDTH (COL-12) --}}
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="glass-card rounded-4 shadow-sm p-4" style="border-top:5px solid #ff9800;">
                <div class="d-flex align-items-center justify-content-between mb-3 px-1">
                    <div class="d-flex align-items-center gap-2">
                        <i data-lucide="map" style="width:22px;height:22px;color:#ff9800;"></i>
                        <h4 class="fw-bold mb-0" style="font-family:var(--font-heading);">Lembar Peta Destinasi Wisata</h4>
                    </div>
                    <span class="badge rounded-pill px-3 py-2 d-flex align-items-center gap-1" style="background:rgba(255,152,0,0.1);color:#e65100;border:1px solid rgba(255,152,0,0.25);font-family:var(--font-body);font-size:0.75rem;">
                        <i data-lucide="zoom-in" style="width:13px;height:13px;"></i> Klik untuk Zoom
                    </span>
                </div>
                @php
                    $imgWisataUrl = ($petaWisata && $petaWisata->file_path) ? $petaWisata->file_url : asset('images/Peta Destinasi Wisata Desa.png');
                    $imgWisataTitle = $petaWisata->judul ?? 'Peta Destinasi Wisata Desa';
                @endphp
                <div class="peta-img-wrapper lightbox-trigger"
                     data-src="{{ $imgWisataUrl }}"
                     data-caption="{{ $imgWisataTitle }} — Skala {{ $petaWisata->skala ?? '1:3.500' }} | {{ $petaWisata->dibuat_oleh ?? 'KKN 178 UNS' }}"
                     data-category="Peta Wisata" data-date="2026">
                    <img src="{{ $imgWisataUrl }}" alt="{{ $imgWisataTitle }}"
                         class="img-fluid w-100"
                         style="object-fit:contain;display:block;border-radius:8px;max-height:680px;"
                         loading="lazy">
                    <div class="peta-zoom-hint"><i data-lucide="zoom-in" style="width:14px;height:14px;"></i> Klik untuk memperbesar peta resolusi tinggi</div>
                </div>
                <p class="text-muted mb-0 mt-3 px-1 text-center" style="font-size:0.8rem;font-family:var(--font-body);">
                    <i data-lucide="mouse-pointer" style="width:13px;height:13px;color:#ff9800;"></i>
                    Klik gambar untuk membuka peta resolusi tinggi dengan navigasi Zoom, Pan &amp; Layar Penuh.
                </p>
            </div>
        </div>
    </div>

    {{-- BARIS 2 (TENGAH): IDENTITAS PETA WISATA (COL-5) + SPESIFIKASI KARTOGRAFI (COL-7) --}}
    <div class="row g-4 mb-5 align-items-start">
        <div class="col-lg-5">
            <div class="glass-card rounded-4 shadow-sm p-4" style="border-top:4px solid #ff9800;">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="rounded-2 p-2" style="background:#ff9800;">
                        <i data-lucide="file-badge" style="width:18px;height:18px;color:#fff;"></i>
                    </div>
                    <h5 class="fw-bold mb-0" style="font-family:var(--font-heading);">Identitas Peta Wisata</h5>
                </div>
                <hr style="border-color:rgba(255,152,0,0.2);margin-bottom:12px;">
                <div class="info-row"><span class="info-label">Nama Peta</span><span class="info-value fw-bold">{{ $petaWisata->judul ?? 'Peta Destinasi Wisata Desa' }}</span></div>
                <div class="info-row"><span class="info-label">Skala</span><span class="info-value fw-semibold" style="color:#e65100;">{{ $petaWisata->skala ?? '1 : 3.500' }}</span></div>
                <div class="info-row"><span class="info-label">Tahun Terbit</span><span class="info-value fw-semibold">2026</span></div>
                <div class="info-row"><span class="info-label">Dibuat Oleh</span><span class="info-value fw-semibold">{{ $petaWisata->dibuat_oleh ?? 'KKN Tematik 178 UNS' }}</span></div>
                <div class="mt-3 p-3 rounded-3" style="background:rgba(255,152,0,0.06);border:1px solid rgba(255,152,0,0.18);">
                    <p class="mb-0 text-muted" style="font-size:0.8rem;font-family:var(--font-body);line-height:1.6;">
                        <strong style="color:#e65100;">Sumber Data:</strong><br>
                        {!! nl2br(e($petaWisata->sumber_data ?? "1. Observasi Lapangan 2026\n2. Pemetaan KKN 178 UNS\n3. Pemerintah Desa Selorejo")) !!}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="glass-card rounded-4 shadow-sm p-4" style="border-top:4px solid #2196f3;">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="rounded-2 p-2" style="background:#2196f3;">
                        <i data-lucide="settings-2" style="width:18px;height:18px;color:#fff;"></i>
                    </div>
                    <h5 class="fw-bold mb-0" style="font-family:var(--font-heading);">Spesifikasi Kartografi</h5>
                </div>
                <hr style="border-color:rgba(33,150,243,0.2);margin-bottom:12px;">
                <div class="row g-0">
                    <div class="col-sm-6"><div class="info-row pe-3"><span class="info-label">Sistem Koordinat</span><span class="info-value fw-semibold text-primary">{{ $petaWisata->sistem_koordinat ?? 'SRGI 2013' }}</span></div></div>
                    <div class="col-sm-6"><div class="info-row ps-3"><span class="info-label">Proyeksi</span><span class="info-value">{{ $petaWisata->proyeksi ?? 'Transverse Mercator' }}</span></div></div>
                    <div class="col-sm-6"><div class="info-row pe-3"><span class="info-label">Datum Geodesi</span><span class="info-value">{{ $petaWisata->datum ?? 'SRGI 2013' }}</span></div></div>
                    <div class="col-sm-6"><div class="info-row ps-3"><span class="info-label">Zona UTM</span><span class="info-value">{{ $petaWisata->zona_utm ?? '49S (Selatan)' }}</span></div></div>
                    <div class="col-sm-6"><div class="info-row pe-3"><span class="info-label">Sistem Grid</span><span class="info-value">{{ $petaWisata->sistem_grid ?? 'Grid Geografi & UTM' }}</span></div></div>
                    <div class="col-sm-6"><div class="info-row ps-3"><span class="info-label">Metode Pemetaan</span><span class="info-value">{{ $petaWisata->metode_pemetaan ?? 'Kartometrik Digital' }}</span></div></div>
                </div>
                <div class="mt-3 p-3 rounded-3" style="background:rgba(33,150,243,0.05);border:1px solid rgba(33,150,243,0.15);">
                    <p class="mb-0 text-muted" style="font-size:0.8rem;font-family:var(--font-body);line-height:1.6;">
                        <strong class="text-primary"><i data-lucide="shield-check" style="width:13px;height:13px;vertical-align:-1px;" class="me-1"></i>Standar Acuan Geospasial:</strong><br>
                        Proyeksi Transverse Mercator &amp; Datum SRGI 2013 Zona 49S sesuai standar Badan Informasi Geospasial (BIG).
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- BARIS 3 (BAWAH): GRID 7 DESTINASI WISATA UNGGULAN DESA --}}
    <div class="mb-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <span class="badge rounded-pill px-3 py-1.5 fw-bold mb-2 d-inline-block" style="background:rgba(255,152,0,0.12);color:#e65100;border:1px solid rgba(255,152,0,0.25);font-family:var(--font-body);font-size:0.75rem;">7 OBYEK FAVORIT</span>
                <h3 class="fw-bold text-dark mb-0" style="font-family:var(--font-heading);">Destinasi Wisata Unggulan Desa</h3>
            </div>
            <a href="{{ route('wisata.index') }}" class="btn btn-sm rounded-pill fw-bold px-4 py-2" style="color:#e65100;border:1.5px solid #ff9800;font-family:var(--font-heading);background:transparent;">
                Lihat Semua Katalog &nbsp;<i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
            </a>
        </div>

        <div class="row g-4">
            @foreach($wisataUnggulan as $d)
            @php
                $dColor = $d->kategori_color;
                $detailUrl = $d->detail_url;
                $waUrl = $d->whatsapp_url;
                $gmapsUrl = $d->gmaps_url;
            @endphp
            <div class="col-sm-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden dest-card">
                    {{-- Foto Header --}}
                    <div class="position-relative overflow-hidden" style="height:180px;">
                        <img src="{{ $d->foto_url }}" alt="{{ $d->nama }}"
                             class="w-100 h-100 dest-img" style="object-fit:cover;transition:transform .4s ease;" loading="lazy">
                        <div class="position-absolute inset-0 w-100 h-100" style="background:linear-gradient(to bottom, rgba(0,0,0,0.05) 0%, rgba(0,0,0,0.68) 100%);"></div>
                        <span class="badge rounded-pill position-absolute top-0 start-0 m-2.5 fw-bold" style="background:{{ $dColor }};color:#fff;font-size:0.68rem;font-family:var(--font-body);">
                            {{ $d->kategori_icon }} {{ $d->kategori_label }}
                        </span>
                        <span class="badge rounded-pill position-absolute top-0 end-0 m-2.5 bg-white text-dark fw-bold shadow-sm" style="font-size:0.68rem;font-family:var(--font-body);">
                            📍 {{ ucfirst($d->dusun) }}
                        </span>
                        <div class="position-absolute bottom-0 start-0 p-3">
                            <h6 class="fw-bold text-white mb-0 lh-sm" style="font-family:var(--font-heading);font-size:1rem;">{{ $d->nama }}</h6>
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body p-3 d-flex flex-column">
                        @if($d->pemilik)
                            <p class="text-muted small mb-2 d-flex align-items-center" style="font-family:var(--font-body);font-size:0.8rem;">
                                <i data-lucide="user" style="width:13px;height:13px;color:var(--color-forest);" class="me-1.5 flex-shrink-0"></i>{{ $d->pemilik }}
                            </p>
                        @endif

                        <p class="text-muted small mb-3 lh-sm" style="font-family:var(--font-body);font-size:0.8rem;overflow:hidden;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;min-height:3.5em;">
                            {{ Str::limit($d->deskripsi_lengkap, 95) }}
                        </p>

                        <div class="d-flex flex-wrap gap-1.5 mb-3">
                            @if($d->jam_operasional)
                                <span class="badge rounded-pill px-2.5 py-1" style="background:#f5f5f5;color:#555;border:1px solid #ddd;font-size:0.68rem;font-family:var(--font-body);">
                                    <i data-lucide="clock" style="width:11px;height:11px;" class="me-1"></i>{{ $d->jam_operasional }}
                                </span>
                            @endif
                            @if($d->harga_tiket_formatted)
                                <span class="badge rounded-pill px-2.5 py-1" style="background:rgba(255,152,0,0.12);color:#e65100;border:1px solid rgba(255,152,0,0.25);font-size:0.68rem;font-family:var(--font-body);font-weight:700;">
                                    <i data-lucide="ticket" style="width:11px;height:11px;" class="me-1"></i>{{ $d->harga_tiket_formatted }}
                                </span>
                            @endif
                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-auto d-flex gap-2 align-items-center">
                            @if($detailUrl)
                                <a href="{{ $detailUrl }}"
                                   class="btn btn-sm rounded-pill fw-bold flex-fill text-white shadow-sm py-1.5"
                                   style="background:var(--color-forest);border:none;font-family:var(--font-heading);font-size:0.78rem;">
                                    <i data-lucide="eye" style="width:13px;height:13px;" class="me-1"></i>Detail Usaha
                                </a>
                            @else
                                <button type="button" onclick="openDestinasiModal({{ $d->id }})"
                                   class="btn btn-sm rounded-pill fw-bold flex-fill py-1.5"
                                   style="border:1.5px solid var(--color-forest);color:var(--color-forest);font-family:var(--font-heading);font-size:0.78rem;background:transparent;">
                                    <i data-lucide="info" style="width:13px;height:13px;" class="me-1"></i>Info Ringkas
                                </button>
                            @endif

                            @if($waUrl)
                                <a href="{{ $waUrl }}" target="_blank"
                                   class="btn btn-sm rounded-pill px-2.5 py-1.5 fw-bold" title="WhatsApp"
                                   style="background:#25D366;color:#fff;border:none;">
                                    <i data-lucide="message-circle" style="width:15px;height:15px;"></i>
                                </a>
                            @endif

                            @if($gmapsUrl)
                                <a href="{{ $gmapsUrl }}" target="_blank"
                                   class="btn btn-sm rounded-pill px-2.5 py-1.5 fw-bold" title="Google Maps"
                                   style="background:#4285F4;color:#fff;border:none;">
                                    <i data-lucide="map" style="width:15px;height:15px;"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Modals Detail Destinasi --}}
    @foreach($wisataUnggulan as $d)
    @php $dColor = $d->kategori_color; @endphp
    <div class="modal fade" id="modal-dest-{{ $d->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 rounded-4 overflow-hidden shadow-lg">
                <div class="position-relative" style="height:280px;background:#111;">
                    <img src="{{ $d->foto_url }}" alt="{{ $d->nama }}" style="width:100%;height:100%;object-fit:cover;opacity:0.85;">
                    <div class="position-absolute inset-0 w-100 h-100" style="background:linear-gradient(to bottom, transparent 30%, rgba(0,0,0,0.75));"></div>
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>
                    <div class="position-absolute bottom-0 start-0 p-4">
                        <span class="badge rounded-pill mb-2 px-3" style="background:{{ $dColor }};font-size:0.72rem;font-family:var(--font-body);">{{ $d->kategori_icon }} {{ $d->kategori_label }}</span>
                        <h3 class="fw-bold text-white mb-0" style="font-family:var(--font-heading);">{{ $d->nama }}</h3>
                    </div>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6"><small class="text-muted d-block" style="font-family:var(--font-body);">Lokasi</small><span class="fw-bold" style="font-family:var(--font-heading);">Dusun {{ ucfirst($d->dusun) }}, Desa Selorejo</span></div>
                        @if($d->pemilik)<div class="col-md-6"><small class="text-muted d-block" style="font-family:var(--font-body);">Pengelola</small><span class="fw-bold" style="font-family:var(--font-heading);">{{ $d->pemilik }}</span></div>@endif
                        @if($d->jam_operasional)<div class="col-md-6"><small class="text-muted d-block" style="font-family:var(--font-body);">Jam Operasional</small><span class="fw-semibold" style="font-family:var(--font-heading);">{{ $d->jam_operasional }}</span></div>@endif
                        @if($d->harga_tiket_formatted)<div class="col-md-6"><small class="text-muted d-block" style="font-family:var(--font-body);">Tiket / Biaya</small><span class="fw-bold text-success" style="font-family:var(--font-heading);">{{ $d->harga_tiket_formatted }}</span></div>@endif
                    </div>
                    <p style="line-height:1.7;font-size:0.9rem;font-family:var(--font-body);">{{ $d->deskripsi_lengkap }}</p>
                    <div class="d-flex gap-2 pt-3 border-top">
                        @if($d->detail_url)
                            <a href="{{ $d->detail_url }}" class="btn btn-sm rounded-pill fw-bold px-4 text-white" style="background:var(--color-forest);font-family:var(--font-heading);">
                                <i data-lucide="external-link" style="width:13px;height:13px;" class="me-1"></i>Halaman Detail
                            </a>
                        @endif
                        @if($d->whatsapp_url)
                            <a href="{{ $d->whatsapp_url }}" target="_blank" class="btn btn-sm rounded-pill fw-bold px-4" style="background:#25D366;color:#fff;font-family:var(--font-heading);">
                                <i data-lucide="message-circle" style="width:13px;height:13px;" class="me-1"></i>WhatsApp
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>
</div>{{-- /tab-wisata --}}


{{-- ════════════════════════════════════════════════════════
     TAB 3: PETA KAWASAN WISATA & PERSEBARAN UMKM
     ════════════════════════════════════════════════════════ --}}
@php
    $kategoriList = \App\Models\PetaTitik::KATEGORI_LIST;
    $kategoriIcons = \App\Models\PetaTitik::KATEGORI_ICONS;
    $kategoriColors = \App\Models\PetaTitik::KATEGORI_COLORS;
    $allPointsCount = $petaTitikGrouped->flatten()->count();
@endphp
<div class="tab-pane fade" id="tab-umkm" role="tabpanel" aria-labelledby="tab-umkm-btn">
<div class="container py-4" id="section-kawasan-umkm">

    {{-- Section Header --}}
    <div class="d-flex align-items-center gap-3 mb-4">
        <div class="rounded-3 p-3 shadow-sm d-flex align-items-center justify-content-center flex-shrink-0" style="background:linear-gradient(135deg,var(--color-forest),#2e7d32);width:52px;height:52px;">
            <i data-lucide="store" style="width:26px;height:26px;color:#fff;"></i>
        </div>
        <div>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <h3 class="fw-bold text-dark mb-0" style="font-family:var(--font-heading);">Peta Kawasan Wisata &amp; Persebaran UMKM</h3>
                <span class="badge rounded-pill px-3 py-1" style="background:rgba(26,92,56,0.1);color:var(--color-forest);border:1px solid rgba(26,92,56,0.25);font-family:var(--font-body);font-size:0.72rem;font-weight:700;">{{ $allPointsCount }} TITIK TERDATA</span>
            </div>
            <p class="text-muted mb-0 mt-1" style="font-family:var(--font-body);font-size:0.86rem;">
                Pemetaan Persebaran Pelaku UMKM, Kios Buah, Tempat Penting, dan Fasilitas Umum Desa Selorejo
            </p>
        </div>
    </div>
    <hr style="border-color:rgba(26,92,56,0.15);opacity:1;margin-bottom:24px;">

    {{-- BARIS 1 (ATAS): GAMBAR PETA FULL WIDTH (COL-12) --}}
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="glass-card rounded-4 shadow-sm p-4" style="border-top:5px solid var(--color-forest);">
                <div class="d-flex align-items-center justify-content-between mb-3 px-1">
                    <div class="d-flex align-items-center gap-2">
                        <i data-lucide="map" style="width:22px;height:22px;color:var(--color-forest);"></i>
                        <h4 class="fw-bold mb-0" style="font-family:var(--font-heading);">Lembar Peta Persebaran UMKM</h4>
                    </div>
                    <span class="badge rounded-pill px-3 py-2 d-flex align-items-center gap-1" style="background:rgba(26,92,56,0.08);color:var(--color-forest);border:1px solid rgba(26,92,56,0.18);font-family:var(--font-body);font-size:0.75rem;">
                        <i data-lucide="zoom-in" style="width:13px;height:13px;"></i> Klik untuk Zoom
                    </span>
                </div>
                @php
                    $imgUmkmUrl = ($petaUmkm && $petaUmkm->file_path) ? $petaUmkm->file_url : asset('images/Peta Destinasi Kawasan Wisata Dan Persebaran UMKM Desa.png');
                    $imgUmkmTitle = $petaUmkm->judul ?? 'Peta Kawasan Wisata & Persebaran UMKM';
                @endphp
                <div class="peta-img-wrapper lightbox-trigger"
                     data-src="{{ $imgUmkmUrl }}"
                     data-caption="{{ $imgUmkmTitle }} — {{ $allPointsCount }} Titik | Skala {{ $petaUmkm->skala ?? '1:3.500' }}"
                     data-category="Peta UMKM" data-date="2026">
                    <img src="{{ $imgUmkmUrl }}" alt="{{ $imgUmkmTitle }}"
                         class="img-fluid w-100"
                         style="object-fit:contain;display:block;border-radius:8px;max-height:680px;"
                         loading="lazy">
                    <div class="peta-zoom-hint"><i data-lucide="zoom-in" style="width:14px;height:14px;"></i> Klik untuk memperbesar peta resolusi tinggi</div>
                </div>
                <p class="text-muted mb-0 mt-3 px-1 text-center" style="font-size:0.8rem;font-family:var(--font-body);">
                    <i data-lucide="mouse-pointer" style="width:13px;height:13px;color:var(--color-forest);"></i>
                    Klik gambar untuk memperbesar &amp; melihat legenda persebaran UMKM dengan jelas.
                </p>
            </div>
        </div>
    </div>

    {{-- BARIS 2 (TENGAH): IDENTITAS PETA UMKM (COL-5) + SPESIFIKASI KARTOGRAFI (COL-7) --}}
    <div class="row g-4 mb-5 align-items-start">
        <div class="col-lg-5">
            <div class="glass-card rounded-4 shadow-sm p-4" style="border-top:4px solid var(--color-forest);">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="rounded-2 p-2" style="background:var(--color-forest);">
                        <i data-lucide="file-badge" style="width:18px;height:18px;color:#fff;"></i>
                    </div>
                    <h5 class="fw-bold mb-0" style="font-family:var(--font-heading);">Identitas Peta UMKM</h5>
                </div>
                <hr style="border-color:rgba(26,92,56,0.15);margin-bottom:12px;">
                <div class="info-row"><span class="info-label">Nama Peta</span><span class="info-value fw-bold">{{ $petaUmkm->judul ?? 'Peta Persebaran UMKM & Kawasan Wisata' }}</span></div>
                <div class="info-row"><span class="info-label">Total Titik Terdata</span><span class="info-value fw-bold" style="color:var(--color-forest);">{{ $allPointsCount }} Titik</span></div>
                <div class="info-row"><span class="info-label">Skala</span><span class="info-value fw-semibold">{{ $petaUmkm->skala ?? '1 : 3.500' }}</span></div>
                <div class="info-row"><span class="info-label">Tahun Terbit</span><span class="info-value fw-semibold">2026</span></div>
                <div class="info-row"><span class="info-label">Dibuat Oleh</span><span class="info-value fw-semibold">{{ $petaUmkm->dibuat_oleh ?? 'KKN 178 UNS' }}</span></div>
                <div class="mt-3 p-3 rounded-3" style="background:rgba(26,92,56,0.05);border:1px solid rgba(26,92,56,0.12);">
                    <p class="mb-0 text-muted" style="font-size:0.8rem;font-family:var(--font-body);line-height:1.6;">
                        <strong style="color:var(--color-forest);">Sumber Data:</strong><br>
                        {!! nl2br(e($petaUmkm->sumber_data ?? "1. Pemerintah Desa Selorejo\n2. Observasi Lapangan 2026\n3. Survey Pendataan UMKM\n4. Google Maps & Lapak ARCGIS")) !!}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="glass-card rounded-4 shadow-sm p-4" style="border-top:4px solid #2196f3;">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="rounded-2 p-2" style="background:#2196f3;">
                        <i data-lucide="settings-2" style="width:18px;height:18px;color:#fff;"></i>
                    </div>
                    <h5 class="fw-bold mb-0" style="font-family:var(--font-heading);">Spesifikasi Kartografi</h5>
                </div>
                <hr style="border-color:rgba(33,150,243,0.2);margin-bottom:12px;">
                <div class="row g-0">
                    <div class="col-sm-6"><div class="info-row pe-3"><span class="info-label">Sistem Koordinat</span><span class="info-value fw-semibold text-primary">{{ $petaUmkm->sistem_koordinat ?? 'SRGI 2013' }}</span></div></div>
                    <div class="col-sm-6"><div class="info-row ps-3"><span class="info-label">Proyeksi</span><span class="info-value">{{ $petaUmkm->proyeksi ?? 'Transverse Mercator' }}</span></div></div>
                    <div class="col-sm-6"><div class="info-row pe-3"><span class="info-label">Datum Geodesi</span><span class="info-value">{{ $petaUmkm->datum ?? 'SRGI 2013' }}</span></div></div>
                    <div class="col-sm-6"><div class="info-row ps-3"><span class="info-label">Zona UTM</span><span class="info-value">{{ $petaUmkm->zona_utm ?? '49S (Selatan)' }}</span></div></div>
                    <div class="col-sm-6"><div class="info-row pe-3"><span class="info-label">Sistem Grid</span><span class="info-value">{{ $petaUmkm->sistem_grid ?? 'Grid Geografi & UTM' }}</span></div></div>
                    <div class="col-sm-6"><div class="info-row ps-3"><span class="info-label">Metode Pemetaan</span><span class="info-value">{{ $petaUmkm->metode_pemetaan ?? 'Kartometrik Digital' }}</span></div></div>
                </div>
                <div class="mt-3 p-3 rounded-3" style="background:rgba(33,150,243,0.05);border:1px solid rgba(33,150,243,0.15);">
                    <p class="mb-0 text-muted" style="font-size:0.8rem;font-family:var(--font-body);line-height:1.6;">
                        <strong class="text-primary"><i data-lucide="shield-check" style="width:13px;height:13px;vertical-align:-1px;" class="me-1"></i>Standar Acuan Geospasial:</strong><br>
                        Proyeksi Transverse Mercator &amp; Datum SRGI 2013 Zona 49S sesuai standar Badan Informasi Geospasial (BIG).
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- BARIS 3: FILTER KATEGORI PETA (Aesthetic & Clean Control Panel) --}}
    @if($petaTitikGrouped->isNotEmpty())
    <div class="glass-card rounded-4 shadow-sm p-4 mb-4 border" style="border-top:4px solid var(--color-forest)!important;">
        <div class="row g-3 align-items-center mb-3">
            <div class="col-md-6">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-2 p-2" style="background:rgba(26,92,56,0.1);color:var(--color-forest);">
                        <i data-lucide="filter" style="width:18px;height:18px;"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-0" style="font-family:var(--font-heading);">Filter Kategori Peta</h5>
                        <small class="text-muted" style="font-family:var(--font-body);">Pilih kategori di bawah untuk membuka daftar titik lokasi</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center bg-white rounded-pill px-3 py-1 border shadow-sm" style="height:42px;">
                    <i data-lucide="search" style="width:16px;height:16px;color:#888;" class="flex-shrink-0 me-2"></i>
                    <input type="text" id="peta-search-input"
                           class="border-0 bg-transparent shadow-none w-100 py-0"
                           style="outline:none;font-family:var(--font-body);font-size:0.88rem;color:#333;"
                           placeholder="Cari nama usaha, lokasi, atau dusun...">
                </div>
            </div>
        </div>
        <div class="d-flex flex-wrap gap-2 pt-2" id="umkm-filter-chips">
            <button type="button" class="btn btn-sm rounded-pill fw-semibold filter-chip-btn"
                    data-filter="semua">
                🗺️ Semua ({{ $allPointsCount }})
            </button>
            @foreach($kategoriList as $kSlug => $kLabel)
                @if(isset($petaTitikGrouped[$kSlug]) && $petaTitikGrouped[$kSlug]->isNotEmpty())
                    <button type="button" class="btn btn-sm rounded-pill fw-semibold filter-chip-btn"
                            data-filter="{{ $kSlug }}">
                        {{ $kategoriIcons[$kSlug] ?? '📍' }} {{ $kLabel }}
                        <span class="badge rounded-pill ms-1" style="background:rgba(0,0,0,0.06);color:#555;font-size:0.68rem;">{{ $petaTitikGrouped[$kSlug]->count() }}</span>
                    </button>
                @endif
            @endforeach
        </div>
    </div>

    {{-- BARIS 4: DAFTAR TITIK PER KATEGORI (Default Collapsed for Lightweight Performance) --}}
    <div id="umkm-titik-list">
        @foreach($kategoriList as $kSlug => $kLabel)
            @if(isset($petaTitikGrouped[$kSlug]) && $petaTitikGrouped[$kSlug]->isNotEmpty())
            @php
                $kColor = $kategoriColors[$kSlug] ?? '#1a5c38';
                $kIcon  = $kategoriIcons[$kSlug] ?? '📍';
            @endphp
            <div class="umkm-kategori-block mb-4" data-kategori="{{ $kSlug }}" id="kategori-block-{{ $kSlug }}">
                <details class="rounded-4 overflow-hidden shadow-sm" style="border:1.5px solid {{ $kColor }}30;background:#fff;">
                    <summary class="d-flex align-items-center gap-3 px-4 py-3.5" style="cursor:pointer;list-style:none;background:{{ $kColor }}08;">
                        <span style="font-size:1.3rem;">{{ $kIcon }}</span>
                        <span class="fw-bold" style="font-family:var(--font-heading);font-size:1.05rem;color:{{ $kColor }};">{{ $kLabel }}</span>
                        <span class="badge rounded-pill" style="background:{{ $kColor }}18;color:{{ $kColor }};border:1px solid {{ $kColor }}35;font-size:0.75rem;font-family:var(--font-body);font-weight:700;">{{ $petaTitikGrouped[$kSlug]->count() }} titik terdata</span>
                        <i data-lucide="chevron-down" class="ms-auto summary-chevron" style="width:18px;height:18px;color:{{ $kColor }};flex-shrink:0;"></i>
                    </summary>
                    <div class="p-4 bg-light bg-opacity-50">
                        <div class="row g-4">
                            @foreach($petaTitikGrouped[$kSlug] as $titik)
                            @php
                                $detailUrl = $titik->detail_url;
                                $waUrl     = $titik->whatsapp_url;
                                $gmapsUrl  = $titik->gmaps_url;
                            @endphp
                            <div class="col-sm-6 col-lg-4 titik-card-item" data-search="{{ strtolower($titik->nama . ' ' . $titik->pemilik . ' ' . $titik->dusun) }}">
                                <div class="card border-0 h-100 titik-card-box shadow-sm overflow-hidden">
                                    {{-- Foto Card (Tinggi 160px untuk Tampilan Proporsional & Lebih Lebar) --}}
                                    <div class="position-relative overflow-hidden" style="height:165px;background:#e9ecef;">
                                        <img src="{{ $titik->foto_url }}" alt="{{ $titik->nama }}"
                                             class="w-100 h-100 titik-img" style="object-fit:cover;transition:transform .4s ease;" loading="lazy">
                                        <div class="position-absolute inset-0 w-100 h-100" style="background:linear-gradient(to bottom, rgba(0,0,0,0.05) 0%, rgba(0,0,0,0.55) 100%);"></div>
                                        <span class="badge rounded-pill position-absolute top-0 end-0 m-2.5 bg-white text-dark fw-bold shadow-sm" style="font-size:0.68rem;font-family:var(--font-body);">
                                            📍 Dusun {{ ucfirst($titik->dusun) }}
                                        </span>
                                        <span class="badge rounded-pill position-absolute top-0 start-0 m-2.5 fw-bold" style="background:{{ $kColor }};color:#fff;font-size:0.68rem;font-family:var(--font-body);">
                                            {{ $kIcon }} {{ $kLabel }}
                                        </span>
                                        <div class="position-absolute bottom-0 start-0 p-3">
                                            <h6 class="fw-bold text-white mb-0 lh-sm" style="font-family:var(--font-heading);font-size:0.95rem;">{{ $titik->nama }}</h6>
                                        </div>
                                    </div>

                                    {{-- Card Body --}}
                                    <div class="card-body p-3 d-flex flex-column">
                                        @if($titik->pemilik)
                                            <p class="text-muted small mb-2 d-flex align-items-center" style="font-family:var(--font-body);font-size:0.8rem;">
                                                <i data-lucide="user" style="width:13px;height:13px;color:var(--color-forest);" class="me-1.5 flex-shrink-0"></i>{{ $titik->pemilik }}
                                            </p>
                                        @endif

                                        @if($titik->jam_operasional)
                                            <p class="text-muted small mb-2 d-flex align-items-center" style="font-family:var(--font-body);font-size:0.78rem;">
                                                <i data-lucide="clock" style="width:12px;height:12px;" class="me-1.5 flex-shrink-0"></i>{{ $titik->jam_operasional }}
                                            </p>
                                        @endif

                                        <p class="text-muted small mb-3 lh-sm" style="font-family:var(--font-body);font-size:0.78rem;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;">
                                            {{ Str::limit($titik->deskripsi_lengkap, 85) }}
                                        </p>

                                        {{-- Action Buttons --}}
                                        <div class="mt-auto pt-2 border-top d-flex gap-1.5 flex-wrap">
                                            @if($detailUrl)
                                                <a href="{{ $detailUrl }}"
                                                   class="btn btn-sm rounded-pill fw-bold flex-fill text-white shadow-sm py-1.5"
                                                   style="background:{{ $kColor }};border:none;font-family:var(--font-heading);font-size:0.75rem;">
                                                    <i data-lucide="eye" style="width:12px;height:12px;" class="me-1"></i>Detail Usaha
                                                </a>
                                            @else
                                                <span class="btn btn-sm rounded-pill fw-bold flex-fill py-1.5 text-muted disabled"
                                                      style="background:#f8f9fa;border:1px solid #ddd;font-size:0.75rem;">
                                                    <i data-lucide="map-pin" style="width:12px;height:12px;" class="me-1"></i>Terdaftar di Peta
                                                </span>
                                            @endif

                                            @if($waUrl)
                                                <a href="{{ $waUrl }}" target="_blank"
                                                   class="btn btn-sm rounded-pill px-2.5 py-1.5 fw-bold" title="WhatsApp"
                                                   style="background:#25D366;color:#fff;border:none;">
                                                    <i data-lucide="message-circle" style="width:14px;height:14px;"></i>
                                                </a>
                                            @endif

                                            @if($gmapsUrl)
                                                <a href="{{ $gmapsUrl }}" target="_blank"
                                                   class="btn btn-sm rounded-pill px-2.5 py-1.5 fw-bold" title="Google Maps"
                                                   style="background:#4285F4;color:#fff;border:none;">
                                                    <i data-lucide="map" style="width:14px;height:14px;"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </details>
            </div>
            @endif
        @endforeach
    </div>

    {{-- CTA DIREKTORI UMKM LENGKAP --}}
    <div class="d-flex align-items-center gap-4 p-4 rounded-4 bg-white shadow-sm mt-4" style="border:2px dashed rgba(26,92,56,0.3);">
        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width:54px;height:54px;background:var(--color-forest);">
            <i data-lucide="store" style="width:26px;height:26px;color:#fff;"></i>
        </div>
        <div class="flex-grow-1">
            <h5 class="fw-bold mb-1" style="font-family:var(--font-heading);">Direktori UMKM Lengkap &amp; Produk Desa</h5>
            <p class="text-muted mb-0" style="font-family:var(--font-body);font-size:0.86rem;">Jelajahi {{ \App\Models\Umkm::count() }} profil pelaku usaha dengan filter produk, kontak WA, &amp; galeri produk.</p>
        </div>
        <a href="{{ route('wisata.umkm') }}" class="btn btn-sm rounded-pill fw-bold px-4 py-2.5 flex-shrink-0 text-white shadow-sm" style="background:var(--color-forest);font-family:var(--font-heading);">
            Buka Direktori &nbsp;<i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
        </a>
    </div>

    @else
    <div class="text-center py-5 text-muted">
        <i data-lucide="map-pin-off" style="width:48px;height:48px;opacity:0.25;" class="mb-3"></i>
        <p style="font-family:var(--font-body);">Data titik peta belum tersedia.</p>
    </div>
    @endif

</div>
</div>{{-- /tab-umkm --}}

</div>{{-- /tab-content --}}

@push('scripts')
<script>
// ── Open destinasi modal ──────────────────────────────────────────────────────
function openDestinasiModal(id) {
    const el = document.getElementById('modal-dest-' + id);
    if (el) new bootstrap.Modal(el).show();
}

// ── Interactive Filter chips & Search behavior ────────────────────────────────
document.addEventListener('DOMContentLoaded', function () {
    const chips  = document.querySelectorAll('.filter-chip-btn');
    const blocks = document.querySelectorAll('.umkm-kategori-block');

    chips.forEach(chip => {
        chip.addEventListener('click', function () {
            const filter = this.dataset.filter;
            const isAlreadyActive = this.classList.contains('active-chip');

            chips.forEach(c => c.classList.remove('active-chip'));

            if (isAlreadyActive && filter !== 'semua') {
                // Toggle off: close all details
                blocks.forEach(b => {
                    const det = b.querySelector('details');
                    if (det) det.open = false;
                });
                return;
            }

            this.classList.add('active-chip');

            blocks.forEach(b => {
                const det = b.querySelector('details');
                if (filter === 'semua') {
                    b.style.display = '';
                    if (det) det.open = true;
                } else if (b.dataset.kategori === filter) {
                    b.style.display = '';
                    if (det) det.open = true;
                    // Smooth scroll to block
                    b.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                } else {
                    if (det) det.open = false;
                }
            });
        });
    });

    const searchInput = document.getElementById('peta-search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const q = this.value.toLowerCase().trim();
            blocks.forEach(block => {
                let cnt = 0;
                const det = block.querySelector('details');
                block.querySelectorAll('.titik-card-item').forEach(item => {
                    const match = !q || (item.dataset.search || '').includes(q);
                    item.style.display = match ? '' : 'none';
                    if (match) cnt++;
                });
                if (q) {
                    block.style.display = (cnt > 0) ? '' : 'none';
                    if (det && cnt > 0) det.open = true;
                } else {
                    block.style.display = '';
                    if (det) det.open = false;
                }
            });
        });
    }

    // Chevron rotate on details toggle
    document.querySelectorAll('details').forEach(det => {
        det.addEventListener('toggle', function () {
            const ch = this.querySelector('.summary-chevron');
            if (ch) ch.style.transform = this.open ? 'rotate(180deg)' : '';
        });
    });

    // Tab URL hash
    const hashMap = {
        '#tab-batas-desa': 'tab-batas-desa-btn',
        '#tab-wisata':     'tab-wisata-btn',
        '#tab-umkm':       'tab-umkm-btn',
    };
    const h = window.location.hash;
    if (hashMap[h]) {
        const btn = document.getElementById(hashMap[h]);
        if (btn) bootstrap.Tab.getOrCreateInstance(btn).show();
    }

    document.querySelectorAll('#peta-tabs button[data-bs-toggle="pill"]').forEach(btn => {
        btn.addEventListener('shown.bs.tab', function (e) {
            history.replaceState(null, null, e.target.getAttribute('data-bs-target'));
            if (window.lucide && typeof lucide.createIcons === 'function') {
                try { lucide.createIcons(); } catch(err) {}
            }
        });
    });
});

// ── Lightbox pan/grab support ─────────────────────────────────────────────────
(function () {
    let isDragging = false, startX = 0, startY = 0, scrollLeft = 0, scrollTop = 0;
    let panX = 0, panY = 0;

    document.addEventListener('DOMContentLoaded', function () {
        const overlay = document.getElementById('lightboxOverlay');
        const img     = document.getElementById('lightboxImg');
        if (!overlay || !img) return;

        img.style.cursor = 'grab';

        img.addEventListener('mousedown', function (e) {
            e.preventDefault();
            isDragging = true;
            img.style.cursor = 'grabbing';
            startX = e.clientX - panX;
            startY = e.clientY - panY;
        });

        document.addEventListener('mousemove', function (e) {
            if (!isDragging) return;
            panX = e.clientX - startX;
            panY = e.clientY - startY;
            img.style.transform = `scale(${window._lbScale || 1}) translate(${panX / (window._lbScale || 1)}px, ${panY / (window._lbScale || 1)}px)`;
        });

        document.addEventListener('mouseup', function () {
            if (!isDragging) return;
            isDragging = false;
            img.style.cursor = 'grab';
        });

        // Touch support
        img.addEventListener('touchstart', function (e) {
            if (e.touches.length === 1) {
                isDragging = true;
                startX = e.touches[0].clientX - panX;
                startY = e.touches[0].clientY - panY;
            }
        }, { passive: true });

        img.addEventListener('touchmove', function (e) {
            if (!isDragging || e.touches.length !== 1) return;
            panX = e.touches[0].clientX - startX;
            panY = e.touches[0].clientY - startY;
            img.style.transform = `scale(${window._lbScale || 1}) translate(${panX / (window._lbScale || 1)}px, ${panY / (window._lbScale || 1)}px)`;
        }, { passive: true });

        img.addEventListener('touchend', () => { isDragging = false; });

        // Reset pan when lightbox opens or slide changes
        const origUpdate = window.updateLightboxContent;
        if (typeof origUpdate === 'function') {
            window.updateLightboxContent = function () {
                panX = 0; panY = 0;
                origUpdate();
            };
        }
    });

    // Patch zoom functions to store scale & preserve pan
    const _origZoomIn  = window.zoomIn;
    const _origZoomOut = window.zoomOut;
    window.zoomIn = function () {
        if (typeof _origZoomIn === 'function') _origZoomIn();
        window._lbScale = window.currentScale;
    };
    window.zoomOut = function () {
        if (typeof _origZoomOut === 'function') _origZoomOut();
        window._lbScale = window.currentScale;
    };
})();
</script>
@endpush

@include('layouts.partials.lightbox')
@endsection
