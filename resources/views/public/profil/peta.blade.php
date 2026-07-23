@extends('layouts.public')
@section('title', 'Peta Batas Wilayah Desa Selorejo')
@section('breadcrumb')
    <li class="breadcrumb-item">Profil Desa</li>
    <li class="breadcrumb-item active">Peta Wilayah</li>
@endsection

@push('styles')
<style>
    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 10px 0;
        border-bottom: 1px solid rgba(26,92,56,0.08);
        font-family: var(--font-body);
        gap: 12px;
    }
    .info-row:last-child { border-bottom: none; }
    .info-label {
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #888;
        min-width: 130px;
        flex-shrink: 0;
    }
    .info-value {
        font-size: 0.9rem;
        font-weight: 500;
        color: #2d2d2d;
        text-align: right;
    }
    .legend-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 14px;
        border-radius: 10px;
        background: rgba(26,92,56,0.04);
        border: 1px solid rgba(26,92,56,0.1);
        font-family: var(--font-body);
        font-size: 0.9rem;
    }
    .legend-symbol {
        font-size: 1.2rem;
        min-width: 28px;
        text-align: center;
    }
    .batas-card {
        border-radius: 14px;
        border: 1.5px solid rgba(26,92,56,0.15);
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .batas-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(26,92,56,0.15) !important;
    }
    .tk-table thead th {
        background: var(--color-forest, #1a5c38);
        color: #fff;
        font-family: var(--font-heading);
        font-size: 0.78rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        position: sticky;
        top: 0;
        z-index: 2;
        white-space: nowrap;
    }
    .tk-table tbody tr:hover td {
        background: rgba(26,92,56,0.05);
    }
    .tk-table td, .tk-table th {
        padding: 8px 12px;
        font-size: 0.8rem;
        font-family: var(--font-body);
        white-space: nowrap;
    }
    .tk-table tbody tr:nth-child(even) td {
        background: rgba(26,92,56,0.025);
    }
    .code-tk { font-family: monospace; font-size: 0.72rem; color: #444; }
    .peta-img-wrapper {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        cursor: zoom-in;
        background: #f5f5f5;
    }
    .peta-img-wrapper:hover .peta-zoom-hint {
        opacity: 1;
    }
    .peta-zoom-hint {
        position: absolute;
        bottom: 12px;
        right: 12px;
        background: rgba(0,0,0,0.6);
        color: #fff;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-family: var(--font-body);
        opacity: 0;
        transition: opacity 0.3s;
        pointer-events: none;
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .koordinat-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(26,92,56,0.07);
        border: 1px solid rgba(26,92,56,0.18);
        border-radius: 10px;
        padding: 10px 16px;
        font-family: var(--font-body);
    }
    .section-divider {
        border: none;
        height: 3px;
        background: linear-gradient(90deg, var(--color-forest, #1a5c38) 0%, transparent 100%);
        border-radius: 2px;
        margin: 0 0 24px 0;
        opacity: 0.25;
    }
    .badge-kode {
        font-family: monospace;
        font-size: 1rem;
        letter-spacing: 1px;
        background: rgba(26,92,56,0.1);
        color: var(--color-forest, #1a5c38);
        border: 1px solid rgba(26,92,56,0.2);
        border-radius: 8px;
        padding: 4px 14px;
    }
    @media (max-width: 576px) {
        .info-label { min-width: 100px; font-size: 0.75rem; }
        .info-value { font-size: 0.82rem; }
        .tk-table td, .tk-table th { padding: 6px 8px; font-size: 0.72rem; }
    }
</style>
@endpush

@section('content')
@php
    $hero = $profile->hero_peta ?? ['title' => 'Peta Batas Wilayah Desa', 'subtitle' => 'Dokumen kartometrik resmi batas administrasi Desa Selorejo, Kecamatan Dau, Kabupaten Malang', 'icon' => 'map'];
@endphp

@include('layouts.partials.page-hero', [
    'title'    => $hero['title'] ?? 'Peta Batas Wilayah Desa',
    'subtitle' => $hero['subtitle'] ?? 'Dokumen kartometrik resmi batas administrasi Desa Selorejo, Kecamatan Dau, Kabupaten Malang',
    'icon'     => $hero['icon'] ?? 'map'
])

<div class="container mb-5 pb-5">

    {{-- ══ BARIS 1: Identitas + Spesifikasi Teknis ══ --}}
    <div class="row g-4 mb-4">

        {{-- Identitas Peta --}}
        <div class="col-lg-5">
            <div class="glass-card bg-white p-4 rounded-4 shadow-sm h-100" style="border-top: 4px solid var(--color-forest) !important;">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="rounded-2 p-2" style="background:var(--color-forest)!important;">
                        <i data-lucide="file-map" style="width:18px;height:18px;color:#fff;"></i>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark" style="font-family:var(--font-heading);">Identitas Peta</h5>
                </div>
                <hr class="section-divider">

                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge-kode">35.07.22.2005</span>
                    <small class="text-muted" style="font-family:var(--font-body);">Kode Wilayah Resmi</small>
                </div>

                <div class="info-row"><span class="info-label">Nama Peta</span><span class="info-value">Peta Batas Desa Selorejo</span></div>
                <div class="info-row"><span class="info-label">Desa</span><span class="info-value fw-bold">Selorejo</span></div>
                <div class="info-row"><span class="info-label">Kecamatan</span><span class="info-value">Dau</span></div>
                <div class="info-row"><span class="info-label">Kabupaten</span><span class="info-value">Malang</span></div>
                <div class="info-row"><span class="info-label">Provinsi</span><span class="info-value">Jawa Timur</span></div>
                <div class="info-row"><span class="info-label">Skala Peta</span><span class="info-value fw-semibold">1 : 14.000</span></div>
                <div class="info-row"><span class="info-label">Tahun Terbit</span><span class="info-value fw-semibold">2021</span></div>
                <div class="info-row"><span class="info-label">Diterbitkan</span><span class="info-value">Pemerintah Kab. Malang</span></div>
                <div class="info-row"><span class="info-label">Kontak</span><span class="info-value" style="font-size:0.78rem;">pmd@malangkab.go.id<br>(0341) 352454</span></div>

                <div class="mt-3 p-3 rounded-3" style="background:rgba(26,92,56,0.06); border:1px solid rgba(26,92,56,0.12);">
                    <p class="mb-0 text-muted" style="font-size:0.82rem; font-family:var(--font-body); line-height:1.6;">
                        Peta ini merupakan <strong>dokumen kartometrik resmi</strong> yang menjadi rujukan hukum administratif batas wilayah Desa Selorejo. © 2021, seluruh hak dilindungi Undang-Undang Republik Indonesia.
                    </p>
                </div>
            </div>
        </div>

        {{-- Spesifikasi Teknis + Koordinat --}}
        <div class="col-lg-7">
            <div class="row g-4 h-100">
                {{-- Spesifikasi Teknis --}}
                <div class="col-12">
                    <div class="glass-card bg-white p-4 rounded-4 shadow-sm" style="border-top: 4px solid #2196f3 !important;">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="rounded-2 p-2" style="background:#2196f3!important;">
                                <i data-lucide="settings-2" style="width:18px;height:18px;color:#fff;"></i>
                            </div>
                            <h5 class="fw-bold mb-0 text-dark" style="font-family:var(--font-heading);">Spesifikasi Teknis</h5>
                        </div>
                        <hr class="section-divider" style="background:linear-gradient(90deg,#2196f3,transparent);">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="p-3 rounded-3 h-100" style="background:rgba(33,150,243,0.05); border:1px solid rgba(33,150,243,0.15);">
                                    <div style="font-size:0.72rem; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#2196f3; font-family:var(--font-heading);">Sistem Proyeksi</div>
                                    <div class="fw-semibold mt-1" style="font-family:var(--font-body); font-size:0.9rem;">Transverse Mercator</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-3 rounded-3 h-100" style="background:rgba(33,150,243,0.05); border:1px solid rgba(33,150,243,0.15);">
                                    <div style="font-size:0.72rem; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#2196f3; font-family:var(--font-heading);">Sistem Grid</div>
                                    <div class="fw-semibold mt-1" style="font-family:var(--font-body); font-size:0.9rem;">Grid Geografi & Grid UTM</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-3 rounded-3 h-100" style="background:rgba(33,150,243,0.05); border:1px solid rgba(33,150,243,0.15);">
                                    <div style="font-size:0.72rem; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#2196f3; font-family:var(--font-heading);">Datum Horizontal</div>
                                    <div class="fw-semibold mt-1" style="font-family:var(--font-body); font-size:0.88rem;">SRGI 2013</div>
                                    <div style="font-size:0.72rem; color:#888; font-family:var(--font-body);">Sistem Referensi Geospasial Indonesia 2013</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-3 rounded-3 h-100" style="background:rgba(33,150,243,0.05); border:1px solid rgba(33,150,243,0.15);">
                                    <div style="font-size:0.72rem; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:#2196f3; font-family:var(--font-heading);">Zona UTM</div>
                                    <div class="fw-bold mt-1" style="font-family:var(--font-body); font-size:1.3rem; color:#2196f3;">49S</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Koordinat Geografis --}}
                <div class="col-12">
                    <div class="glass-card bg-white p-3 rounded-4 shadow-sm" style="border-top: 4px solid #9c27b0 !important;">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="rounded-2 p-2" style="background:#9c27b0!important;">
                                <i data-lucide="crosshair" style="width:16px;height:16px;color:#fff;"></i>
                            </div>
                            <h5 class="fw-bold mb-0 text-dark" style="font-family:var(--font-heading);">Koordinat Geografis</h5>
                        </div>
                        <p class="text-muted mb-2" style="font-family:var(--font-body); font-size:0.78rem;">Posisi: <strong>7°54′–7°59′ LS</strong>, <strong>112°28′–112°33′ BT</strong></p>
                        <div class="row g-2">
                            <div class="col-6"><div class="d-flex align-items-center gap-2 p-2 rounded-2" style="background:rgba(26,92,56,0.06); border:1px solid rgba(26,92,56,0.15);">
                                <i data-lucide="arrow-up" style="width:14px;height:14px;color:var(--color-forest);flex-shrink:0;"></i>
                                <div><div style="font-size:0.65rem; color:#888; font-family:var(--font-heading); text-transform:uppercase; letter-spacing:0.4px; line-height:1;">Utara (mU)</div>
                                <div class="fw-bold" style="font-size:0.82rem; font-family:monospace; line-height:1.3;">9.127.326</div></div>
                            </div></div>
                            <div class="col-6"><div class="d-flex align-items-center gap-2 p-2 rounded-2" style="background:rgba(230,57,70,0.06); border:1px solid rgba(230,57,70,0.15);">
                                <i data-lucide="arrow-down" style="width:14px;height:14px;color:#e63946;flex-shrink:0;"></i>
                                <div><div style="font-size:0.65rem; color:#888; font-family:var(--font-heading); text-transform:uppercase; letter-spacing:0.4px; line-height:1;">Selatan (mU)</div>
                                <div class="fw-bold" style="font-size:0.82rem; font-family:monospace; line-height:1.3;">9.115.983</div></div>
                            </div></div>
                            <div class="col-6"><div class="d-flex align-items-center gap-2 p-2 rounded-2" style="background:rgba(255,152,0,0.06); border:1px solid rgba(255,152,0,0.15);">
                                <i data-lucide="arrow-right" style="width:14px;height:14px;color:#ff9800;flex-shrink:0;"></i>
                                <div><div style="font-size:0.65rem; color:#888; font-family:var(--font-heading); text-transform:uppercase; letter-spacing:0.4px; line-height:1;">Timur (mT)</div>
                                <div class="fw-bold" style="font-size:0.82rem; font-family:monospace; line-height:1.3;">672.366</div></div>
                            </div></div>
                            <div class="col-6"><div class="d-flex align-items-center gap-2 p-2 rounded-2" style="background:rgba(33,150,243,0.06); border:1px solid rgba(33,150,243,0.15);">
                                <i data-lucide="arrow-left" style="width:14px;height:14px;color:#2196f3;flex-shrink:0;"></i>
                                <div><div style="font-size:0.65rem; color:#888; font-family:var(--font-heading); text-transform:uppercase; letter-spacing:0.4px; line-height:1;">Barat (mT)</div>
                                <div class="fw-bold" style="font-size:0.82rem; font-family:monospace; line-height:1.3;">660.489</div></div>
                            </div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ══ BARIS 2: Gambar Peta Resmi (lightbox) + Google Maps ══ --}}
    <div class="row g-4 mb-4">
        {{-- Peta Resmi dengan Lightbox --}}
        <div class="col-lg-7">
            <div class="glass-card bg-white p-3 rounded-4 shadow-sm h-100" style="border-top: 5px solid var(--color-forest) !important;">
                <div class="d-flex align-items-center justify-content-between mb-3 px-1">
                    <div class="d-flex align-items-center gap-2">
                        <i data-lucide="map" class="text-dark" style="width:20px;height:20px;color:var(--color-forest)!important;"></i>
                        <h5 class="fw-bold mb-0 text-dark" style="font-family:var(--font-heading);">Peta Batas Desa Resmi</h5>
                    </div>
                    <span class="badge rounded-pill px-3 py-2" style="background:rgba(26,92,56,0.1); color:var(--color-forest); font-family:var(--font-body); font-size:0.75rem; border:1px solid rgba(26,92,56,0.2);">
                        <i data-lucide="zoom-in" style="width:13px;height:13px;vertical-align:-2px;"></i> Klik untuk Zoom
                    </span>
                </div>

                <div class="peta-img-wrapper lightbox-trigger"
                     data-src="{{ asset('images/35.07.22.2005 SELOREJO.jpg') }}"
                     data-caption="Peta Batas Wilayah Desa Selorejo — Kode 35.07.22.2005 | Kecamatan Dau, Kabupaten Malang | Skala 1:14.000 | Tahun 2021"
                     data-category="Peta Resmi"
                     data-date="2021"
                     style="cursor: zoom-in;">
                    <img src="{{ asset('images/35.07.22.2005 SELOREJO.jpg') }}"
                         alt="Peta Batas Wilayah Desa Selorejo Kode 35.07.22.2005"
                         class="img-fluid w-100"
                         style="max-height: 520px; object-fit: contain; display: block; margin: 0 auto; border-radius: 8px;">
                    <div class="peta-zoom-hint">
                        <i data-lucide="zoom-in" style="width:14px;height:14px;"></i> Klik untuk memperbesar
                    </div>
                </div>

                <div class="mt-3 px-1">
                    <p class="mb-0 text-muted" style="font-size:0.78rem; font-family:var(--font-body); line-height:1.5;">
                        <i data-lucide="info" style="width:13px;height:13px;vertical-align:-2px;color:var(--color-forest);"></i>
                        Sumber: Pemerintah Kabupaten Malang (2021). Data berdasarkan Citra Satelit Resolusi Tinggi (2013–2015) dan Kesepakatan Teknis Batas Desa Tahun 2021. Sistem Referensi: SRGI 2013, Zona UTM 49S.
                    </p>
                </div>
            </div>
        </div>

        {{-- Google Maps + Info Akses --}}
        <div class="col-lg-5">
            <div class="d-flex flex-column gap-4 h-100">
                {{-- Google Maps --}}
                <div class="glass-card bg-white p-3 rounded-4 shadow-sm flex-grow-1" style="border-top: 5px solid #4CAF50 !important;">
                    <div class="d-flex align-items-center gap-2 mb-3 px-1">
                        <i data-lucide="navigation" style="width:20px;color:#4CAF50;"></i>
                        <h5 class="fw-bold mb-0 text-dark" style="font-family:var(--font-heading);">Google Maps Interaktif</h5>
                    </div>
                    <div class="rounded-3 overflow-hidden" style="height: 300px;">
                        {!! $profile->peta_embed ?? '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15806.384864810932!2d112.53843605!3d-7.937170050000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7883ef912d9999%3A0xf8ff8468809efd9c!2sSelorejo%2C%20Kec.%20Dau%2C%20Kabupaten%20Malang%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1775912011055!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>' !!}
                    </div>
                    <div class="mt-3">
                        <a href="https://maps.google.com/?q=Desa+Selorejo+Kecamatan+Dau+Kabupaten+Malang" target="_blank"
                           class="btn btn-sm fw-bold w-100 rounded-pill py-2"
                           style="background-color:var(--color-forest)!important; color:#fff!important; font-family:var(--font-heading); border:none;">
                            Buka di Google Maps &nbsp;<i data-lucide="external-link" style="width:14px;height:14px;vertical-align:-2px;"></i>
                        </a>
                    </div>
                </div>

                {{-- Rute Akses --}}
                <div class="p-4 rounded-4 shadow-sm" style="background:var(--color-forest)!important; color:#fff!important;">
                    <h6 class="fw-bold mb-3" style="font-family:var(--font-heading); color:#fff!important;">
                        <i data-lucide="route" style="width:16px;height:16px;vertical-align:-2px;margin-right:6px;"></i>Panduan Akses
                    </h6>
                    <div class="d-flex align-items-start mb-3">
                        <div class="rounded p-2 me-3 flex-shrink-0" style="background:rgba(255,255,255,0.15);"><i data-lucide="car" style="width:16px;height:16px;color:#fff;"></i></div>
                        <div>
                            <strong class="d-block mb-1" style="font-family:var(--font-heading); font-size:0.88rem; color:#fff!important;">Kendaraan Pribadi</strong>
                            <div class="small mb-0" style="font-family:var(--font-body); color:rgba(255,255,255,0.88)!important; line-height:1.5;">{!! $profile->peta_rute_pribadi ?? '• 30 menit dari Kota Malang ke arah Barat menuju Kota Batu, belok di jalur Kecamatan Dau.' !!}</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-start">
                        <div class="rounded p-2 me-3 flex-shrink-0" style="background:rgba(255,255,255,0.15);"><i data-lucide="bus" style="width:16px;height:16px;color:#fff;"></i></div>
                        <div>
                            <strong class="d-block mb-1 text-white" style="font-family:var(--font-heading); font-size:0.88rem;">Transportasi Umum</strong>
                            <div class="small text-white mb-0" style="font-family:var(--font-body); opacity:0.88; line-height:1.5;">{!! $profile->peta_rute_umum ?? 'Angkutan pedesaan dari Terminal Landungsari menuju wilayah Kecamatan Dau.' !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ══ BARIS 3: Batas Wilayah Administrasi ══ --}}
    <div class="glass-card bg-white p-4 p-md-5 rounded-4 shadow-sm mb-4" style="border-top: 4px solid #ff9800 !important;">
        <div class="d-flex align-items-center gap-2 mb-4">
            <div class="rounded-2 p-2" style="background:#ff9800!important;">
                <i data-lucide="git-branch" style="width:18px;height:18px;color:#fff;"></i>
            </div>
            <h4 class="fw-bold mb-0 text-dark" style="font-family:var(--font-heading);">Batas Wilayah Administrasi</h4>
        </div>
        <p class="text-muted mb-4" style="font-family:var(--font-body); max-width:750px;">
            Berdasarkan peta batas desa resmi, Desa Selorejo berbatasan langsung dengan desa-desa dan wilayah administrasi berikut ini. Batas wilayah ini merupakan hasil kesepakatan teknis antar kepala desa/lurah dan camat yang telah disahkan secara administratif.
        </p>

        <div class="row g-3">
            {{-- Lintas Kabupaten --}}
            <div class="col-md-6 col-lg-3">
                <div class="batas-card bg-white shadow-sm p-0 h-100">
                    <div class="p-3 text-white" style="background:linear-gradient(135deg,#e63946,#c1121f);">
                        <div class="fw-bold mb-1" style="font-family:var(--font-heading); font-size:0.88rem;">
                            <i data-lucide="landmark" style="width:15px;height:15px;vertical-align:-2px;margin-right:4px;"></i>Lintas Kabupaten/Kota
                        </div>
                    </div>
                    <ul class="list-unstyled p-3 mb-0" style="font-family:var(--font-body); font-size:0.87rem;">
                        <li class="py-2 border-bottom d-flex gap-2"><span class="badge rounded-pill mt-1 flex-shrink-0" style="background:#e63946;width:8px;height:8px;padding:0;align-self:center;"></span><span><strong>Kabupaten Blitar</strong> — sisi barat (kawasan pegunungan &amp; hutan)</span></li>
                        <li class="py-2 d-flex gap-2"><span class="badge rounded-pill mt-1 flex-shrink-0" style="background:#e63946;width:8px;height:8px;padding:0;align-self:center;"></span><span><strong>Kota Batu</strong> — sisi utara wilayah desa</span></li>
                    </ul>
                </div>
            </div>
            {{-- Kec. Dau --}}
            <div class="col-md-6 col-lg-3">
                <div class="batas-card bg-white shadow-sm p-0 h-100">
                    <div class="p-3 text-white" style="background:linear-gradient(135deg,var(--color-forest,#1a5c38),#2e7d32);">
                        <div class="fw-bold mb-1" style="font-family:var(--font-heading); font-size:0.88rem;">
                            <i data-lucide="map-pin" style="width:15px;height:15px;vertical-align:-2px;margin-right:4px;"></i>Kecamatan Dau
                        </div>
                    </div>
                    <ul class="list-unstyled p-3 mb-0" style="font-family:var(--font-body); font-size:0.87rem;">
                        <li class="py-1 border-bottom d-flex gap-2 align-items-center"><i data-lucide="chevron-right" style="width:13px;color:var(--color-forest);flex-shrink:0;"></i>Desa Gadingkulon</li>
                        <li class="py-1 border-bottom d-flex gap-2 align-items-center"><i data-lucide="chevron-right" style="width:13px;color:var(--color-forest);flex-shrink:0;"></i>Desa Sumbersekar</li>
                        <li class="py-1 border-bottom d-flex gap-2 align-items-center"><i data-lucide="chevron-right" style="width:13px;color:var(--color-forest);flex-shrink:0;"></i>Desa Tegalweru</li>
                        <li class="py-1 border-bottom d-flex gap-2 align-items-center"><i data-lucide="chevron-right" style="width:13px;color:var(--color-forest);flex-shrink:0;"></i>Desa Petungsewu</li>
                        <li class="py-1 d-flex gap-2 align-items-center"><i data-lucide="chevron-right" style="width:13px;color:var(--color-forest);flex-shrink:0;"></i>Desa Kucur</li>
                    </ul>
                </div>
            </div>
            {{-- Kec. Wagir --}}
            <div class="col-md-6 col-lg-3">
                <div class="batas-card bg-white shadow-sm p-0 h-100">
                    <div class="p-3 text-white" style="background:linear-gradient(135deg,#2196f3,#1565c0);">
                        <div class="fw-bold mb-1" style="font-family:var(--font-heading); font-size:0.88rem;">
                            <i data-lucide="map-pin" style="width:15px;height:15px;vertical-align:-2px;margin-right:4px;"></i>Kecamatan Wagir &amp; Ngajum
                        </div>
                    </div>
                    <ul class="list-unstyled p-3 mb-0" style="font-family:var(--font-body); font-size:0.87rem;">
                        <li class="py-1 border-bottom d-flex gap-2 align-items-center"><i data-lucide="chevron-right" style="width:13px;color:#2196f3;flex-shrink:0;"></i>Desa Petungsewu (Wagir)</li>
                        <li class="py-1 border-bottom d-flex gap-2 align-items-center"><i data-lucide="chevron-right" style="width:13px;color:#2196f3;flex-shrink:0;"></i>Desa Dalisodo</li>
                        <li class="py-1 border-bottom d-flex gap-2 align-items-center"><i data-lucide="chevron-right" style="width:13px;color:#2196f3;flex-shrink:0;"></i>Desa Jedong</li>
                        <li class="py-1 border-bottom d-flex gap-2 align-items-center"><i data-lucide="chevron-right" style="width:13px;color:#2196f3;flex-shrink:0;"></i>Desa Sukodadi &amp; Sumbersuko</li>
                        <li class="py-1 border-bottom d-flex gap-2 align-items-center"><i data-lucide="chevron-right" style="width:13px;color:#2196f3;flex-shrink:0;"></i>Desa Babadan (Ngajum)</li>
                        <li class="py-1 d-flex gap-2 align-items-center"><i data-lucide="chevron-right" style="width:13px;color:#2196f3;flex-shrink:0;"></i>Desa Balesari (Ngajum)</li>
                    </ul>
                </div>
            </div>
            {{-- Kec. Lain --}}
            <div class="col-md-6 col-lg-3">
                <div class="batas-card bg-white shadow-sm p-0 h-100">
                    <div class="p-3 text-white" style="background:linear-gradient(135deg,#9c27b0,#6a1b9a);">
                        <div class="fw-bold mb-1" style="font-family:var(--font-heading); font-size:0.88rem;">
                            <i data-lucide="map-pin" style="width:15px;height:15px;vertical-align:-2px;margin-right:4px;"></i>Kecamatan Lainnya
                        </div>
                    </div>
                    <ul class="list-unstyled p-3 mb-0" style="font-family:var(--font-body); font-size:0.87rem;">
                        <li class="py-1 border-bottom d-flex gap-2 align-items-center"><i data-lucide="chevron-right" style="width:13px;color:#9c27b0;flex-shrink:0;"></i>Ds. Wonosari, Kec. Wonosari</li>
                        <li class="py-1 border-bottom d-flex gap-2 align-items-center"><i data-lucide="chevron-right" style="width:13px;color:#9c27b0;flex-shrink:0;"></i>Ds. Pujon Kidul, Kec. Pujon</li>
                        <li class="py-1 border-bottom d-flex gap-2 align-items-center"><i data-lucide="chevron-right" style="width:13px;color:#9c27b0;flex-shrink:0;"></i>Ds. Pujon Lor, Kec. Pujon</li>
                        <li class="py-1 d-flex gap-2 align-items-center"><i data-lucide="chevron-right" style="width:13px;color:#9c27b0;flex-shrink:0;"></i>Ds. Pandesari, Kec. Pujon</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- ══ BARIS 4: Legenda + Kantor Pemerintahan + Pembagian Dusun ══ --}}
    <div class="row g-4 mb-4">
        {{-- Legenda Peta --}}
        <div class="col-md-6 col-lg-4">
            <div class="glass-card bg-white p-4 rounded-4 shadow-sm h-100" style="border-top: 4px solid #607d8b !important;">
                <div class="d-flex align-items-center gap-2 mb-4">
                    <div class="rounded-2 p-2" style="background:#607d8b!important;">
                        <i data-lucide="layers" style="width:18px;height:18px;color:#fff;"></i>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark" style="font-family:var(--font-heading);">Legenda Peta</h5>
                </div>
                <div class="d-flex flex-column gap-2">
                    <div class="legend-item"><span class="legend-symbol" style="color:green;">●</span><span>Titik Kartometrik (TK)</span></div>
                    <div class="legend-item"><span class="legend-symbol" style="color:#e63946;">▲</span><span>Pilar Batas (PBU/PABU)</span></div>
                    <div class="legend-item"><span class="legend-symbol">⚫</span><span>Kantor Pemerintahan</span></div>
                    <div class="legend-item">
                        <span class="legend-symbol" style="font-size:0.75rem; letter-spacing:-2px; white-space:nowrap; font-weight:900;">- - -</span>
                        <span>Batas Provinsi (tebal)</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-symbol" style="font-size:0.75rem; letter-spacing:-2px; white-space:nowrap;">- - -</span>
                        <span>Batas Kabupaten/Kota</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-symbol" style="font-size:0.7rem; letter-spacing:-2px; white-space:nowrap;">- -</span>
                        <span>Batas Kecamatan (tipis)</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-symbol" style="font-size:0.9rem; letter-spacing:-1px;">· · ·</span>
                        <span>Batas Desa/Kelurahan</span>
                    </div>
                </div>
                <div class="mt-3 p-3 rounded-3" style="background:rgba(96,125,139,0.06); border:1px solid rgba(96,125,139,0.15);">
                    <p class="mb-0 text-muted" style="font-size:0.78rem; font-family:var(--font-body);">
                        <strong>TK</strong> = Titik Kartometrik &nbsp;|&nbsp; <strong>PBU</strong> = Pilar Batas Utama &nbsp;|&nbsp; <strong>PABU</strong> = Pilar Batas Utama yang telah ditanam fisik di lapangan
                    </p>
                </div>
            </div>
        </div>

        {{-- Kantor Pemerintahan + Sumber Data --}}
        <div class="col-md-6 col-lg-4">
            <div class="d-flex flex-column gap-4 h-100">
                <div class="glass-card bg-white p-4 rounded-4 shadow-sm" style="border-top: 4px solid #ff9800 !important;">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="rounded-2 p-2" style="background:#ff9800!important;">
                            <i data-lucide="building-2" style="width:18px;height:18px;color:#fff;"></i>
                        </div>
                        <h5 class="fw-bold mb-0 text-dark" style="font-family:var(--font-heading);">Kantor Pemerintahan</h5>
                    </div>
                    <p class="text-muted small mb-3" style="font-family:var(--font-body);">Titik kantor yang ditandai pada peta batas desa:</p>
                    <ul class="list-unstyled mb-0" style="font-family:var(--font-body); font-size:0.88rem;">
                        <li class="d-flex gap-2 align-items-center py-2 border-bottom">
                            <i data-lucide="building" style="width:15px;color:#ff9800;flex-shrink:0;"></i>
                            <span><strong>Kantor Desa Selorejo</strong></span>
                        </li>
                        <li class="d-flex gap-2 align-items-center py-2 border-bottom">
                            <i data-lucide="building" style="width:15px;color:#ff9800;flex-shrink:0;"></i>
                            <span>Kantor Desa Gadingkulon</span>
                        </li>
                        <li class="d-flex gap-2 align-items-center py-2 border-bottom">
                            <i data-lucide="building" style="width:15px;color:#ff9800;flex-shrink:0;"></i>
                            <span>Kantor Kepala Desa Petungsewu</span>
                        </li>
                        <li class="d-flex gap-2 align-items-center py-2">
                            <i data-lucide="building" style="width:15px;color:#ff9800;flex-shrink:0;"></i>
                            <span>Kantor Kepala Desa Kucur</span>
                        </li>
                    </ul>
                </div>

                {{-- Sumber Data --}}
                <div class="glass-card bg-white p-4 rounded-4 shadow-sm flex-grow-1" style="border-top: 4px solid #4CAF50 !important;">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="rounded-2 p-2" style="background:#4CAF50!important;">
                            <i data-lucide="database" style="width:18px;height:18px;color:#fff;"></i>
                        </div>
                        <h5 class="fw-bold mb-0 text-dark" style="font-family:var(--font-heading);">Sumber Data</h5>
                    </div>
                    <ul class="list-unstyled mb-0" style="font-family:var(--font-body); font-size:0.85rem;">
                        <li class="d-flex gap-2 py-2 border-bottom">
                            <i data-lucide="satellite" style="width:15px;color:#4CAF50;flex-shrink:0;margin-top:2px;"></i>
                            <span>Citra Tegak Satelit Resolusi Tinggi (akuisisi 2013–2015)</span>
                        </li>
                        <li class="d-flex gap-2 py-2 border-bottom">
                            <i data-lucide="handshake" style="width:15px;color:#4CAF50;flex-shrink:0;margin-top:2px;"></i>
                            <span>Kesepakatan Teknis Batas Desa Tahun 2021</span>
                        </li>
                        <li class="d-flex gap-2 py-2">
                            <i data-lucide="map-pinned" style="width:15px;color:#4CAF50;flex-shrink:0;margin-top:2px;"></i>
                            <span>Data batas administrasi Kabupaten/Kota dari Pemerintah Kab. Malang</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Pembagian Dusun --}}
        <div class="col-lg-4">
            <div class="glass-card bg-white p-4 rounded-4 shadow-sm h-100" style="border-top: 4px solid var(--color-forest) !important;">
                <div class="d-flex align-items-center gap-2 mb-4">
                    <div class="rounded-2 p-2" style="background:var(--color-forest)!important;">
                        <i data-lucide="layout-grid" style="width:18px;height:18px;color:#fff;"></i>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark" style="font-family:var(--font-heading);">Pembagian Dusun</h5>
                </div>
                @php
                    $dusuns = $profile->dusun_info ?? [
                        ['nama' => 'Dusun Krajan', 'peta_desc' => 'Bagian tengah-timur desa. Terluas, terpadat, dan menjadi pusat aktivitas utama penduduk.', 'admin_rw' => 'RW I – RW IV', 'admin_rt' => '12 RT (RT.01 – RT.12)', 'color_theme' => 'success'],
                        ['nama' => 'Dusun Selokerto', 'peta_desc' => 'Sisi barat/kiri peta desa. Cukup padat, terkonsentrasi di sektor utara dan tengah dusun.', 'admin_rw' => 'RW V – RW VI', 'admin_rt' => '7 RT (RT.13 – RT.19)', 'color_theme' => 'warning'],
                        ['nama' => 'Dusun Gumuk', 'peta_desc' => 'Sisi barat daya. Sebaran bangunan berkembang di wilayah RW VI dan RW VII.', 'admin_rw' => 'RW VI – RW VII', 'admin_rt' => '2 RT (RT.20 – RT.21)', 'color_theme' => 'primary'],
                    ];
                @endphp
                <div class="d-flex flex-column gap-3">
                    @foreach(array_slice($dusuns, 0, 3) as $dsn)
                    @php
                        $tc = 'var(--color-forest)';
                        $bg = 'rgba(26,92,56,0.08)';
                        if(($dsn['color_theme']??'')==='warning'){$tc='#ff9800';$bg='rgba(255,152,0,0.08)';}
                        elseif(($dsn['color_theme']??'')==='primary'){$tc='#9c27b0';$bg='rgba(156,39,176,0.08)';}
                    @endphp
                    <div class="p-3 rounded-3" style="background:{{$bg}}; border-left:4px solid {{$tc}};">
                        <div class="fw-bold mb-1" style="color:{{$tc}}; font-family:var(--font-heading); font-size:0.95rem;">
                            {{ $dsn['nama'] }}
                        </div>
                        <p class="text-muted small mb-2" style="font-family:var(--font-body); line-height:1.5;">{{ $dsn['peta_desc'] }}</p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge px-2 py-1" style="background:{{$bg}};color:{{$tc}};border:1px solid {{$tc}}33;font-family:var(--font-body);font-size:0.73rem;">{{ $dsn['admin_rw'] }}</span>
                            <span class="badge px-2 py-1" style="background:{{$bg}};color:{{$tc}};border:1px solid {{$tc}}33;font-family:var(--font-body);font-size:0.73rem;">{{ $dsn['admin_rt'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- ══ BARIS 5: Tabel 61 Titik Kartometrik ══ --}}
    <div class="glass-card bg-white p-4 p-md-5 rounded-4 shadow-sm mb-4" style="border-top: 4px solid #e63946 !important;">
        <div class="d-flex align-items-center gap-2 mb-2">
            <div class="rounded-2 p-2" style="background:#e63946!important;">
                <i data-lucide="crosshair" style="width:18px;height:18px;color:#fff;"></i>
            </div>
            <h4 class="fw-bold mb-0 text-dark" style="font-family:var(--font-heading);">61 Titik Kartometrik Batas Desa</h4>
        </div>
        <p class="text-muted mb-4" style="font-family:var(--font-body); max-width:800px;">
            Titik kartometrik adalah koordinat presisi hasil <strong>kesepakatan teknis antar pemerintah desa dan kecamatan</strong> yang menjadi acuan resmi penarikan garis batas wilayah dan memiliki kekuatan hukum administratif.
            Kode <strong>TK</strong> = Titik Kartometrik &nbsp;|&nbsp; <strong>PBU</strong> = Pilar Batas Utama &nbsp;|&nbsp; <strong>PABU</strong> = Pilar Batas Utama (fisik tertanam di lapangan).
        </p>
        <div class="rounded-3 overflow-hidden border" style="border-color:rgba(26,92,56,0.15)!important;">
            <div style="max-height: 500px; overflow-y: auto;">
                <table class="table table-bordered table-hover mb-0 tk-table">
                    <thead>
                        <tr>
                            <th style="min-width:40px;">No</th>
                            <th style="min-width:220px;">Kode Titik</th>
                            <th style="min-width:130px;">Lintang</th>
                            <th style="min-width:130px;">Bujur</th>
                            <th style="min-width:100px;">X – UTM (m)</th>
                            <th style="min-width:100px;">Y – UTM (m)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $titikList = [
                            [1,'TK 35.07.22.2005-26.2005-001','7°56\'41.179" S','112°28\'16.609" E','662.172,89','9.121.519,83'],
                            [2,'TK 35.05-07.22.2005-26.2005-000','7°56\'49.939" S','112°28\'4.472" E','661.800,24','9.121.252,07'],
                            [3,'TK 35.07.22.2005-26.2004-26.2005-35.79-000','7°56\'21.727" S','112°28\'28.659" E','662.544,05','9.122.116,07'],
                            [4,'TK 35.07.22.2001-22.2004-22.2005-000','7°57\'4.272" S','112°30\'28.847" E','666.220,11','9.120.795,89'],
                            [5,'TK 35.07.22.2005-22.2009-001','7°56\'10.628" S','112°33\'12.936" E','671.251,51','9.122.425,22'],
                            [6,'TK 35.07.22.2005-22.2009-35.79-000','7°55\'41.063" S','112°31\'6.484" E','667.382,08','9.123.347,78'],
                            [7,'TK 35.07.22.2005-22.2009-002','7°56\'5.426" S','112°32\'57.667" E','670.784,48','9.122.586,79'],
                            [8,'TK 35.07.22.2005-22.2009-003','7°56\'1.371" S','112°32\'58.404" E','670.807,52','9.122.711,28'],
                            [9,'TK 35.07.22.2005-22.2009-004','7°56\'0.848" S','112°32\'49.949" E','670.548,63','9.122.728,31'],
                            [10,'TK 35.07.22.2005-22.2009-005','7°55\'58.268" S','112°32\'50.186" E','670.556,18','9.122.807,52'],
                            [11,'TK 35.07.22.2005-22.2009-006','7°55\'56.810" S','112°32\'45.407" E','670.409,99','9.122.852,86'],
                            [12,'TK 35.07.22.2005-22.2009-007','7°55\'57.381" S','112°32\'40.793" E','670.268,60','9.122.835,87'],
                            [13,'TK 35.07.22.2005-22.2009-008','7°55\'57.227" S','112°32\'38.131" E','670.187,11','9.122.840,89'],
                            [14,'TK 35.07.22.2005-22.2009-009','7°55\'56.538" S','112°32\'36.775" E','670.145,65','9.122.862,21'],
                            [15,'TK 35.07.22.2005-22.2009-010','7°55\'56.756" S','112°32\'29.108" E','669.910,82','9.122.856,39'],
                            [16,'TK 35.07.22.2005-22.2009-011','7°55\'57.613" S','112°32\'28.527" E','669.892,91','9.122.830,11'],
                            [17,'TK 35.07.22.2005-22.2009-012','7°55\'55.335" S','112°32\'20.256" E','669.639,85','9.122.901,04'],
                            [18,'TK 35.07.22.2005-22.2009-014','7°55\'55.266" S','112°32\'19.190" E','669.607,22','9.122.903,29'],
                            [19,'TK 35.07.22.2005-22.2009-015','7°55\'55.562" S','112°32\'16.537" E','669.525,93','9.122.894,50'],
                            [20,'TK 35.07.22.2005-22.2009-016','7°55\'51.714" S','112°32\'17.455" E','669.554,50','9.123.012,60'],
                            [21,'TK 35.07.22.2005-22.2009-017','7°55\'49.772" S','112°32\'8.877" E','669.291,99','9.123.073,22'],
                            [22,'TK 35.07.22.2005-22.2009-018','7°55\'51.100" S','112°32\'4.429" E','669.155,62','9.123.032,93'],
                            [23,'TK 35.07.22.2005-22.2009-019','7°55\'56.423" S','112°31\'52.983" E','668.804,46','9.122.870,73'],
                            [24,'TK 35.07.22.2004-22.2005-001','7°56\'32.731" S','112°33\'11.043" E','671.191,01','9.121.746,47'],
                            [25,'TK 35.07.22.2005-22.2006-001','7°56\'16.268" S','112°33\'16.682" E','671.365,60','9.122.251,55'],
                            [26,'TK 35.05-07.22.2001-22.2005-000','7°57\'27.006" S','112°28\'15.402" E','662.130,93','9.120.112,23'],
                            [27,'TK 35.07.22.2004-22.2005-22.2006-000','7°56\'34.671" S','112°33\'13.820" E','671.275,83','9.121.686,55'],
                            [28,'TK 35.07.22.2005-22.2006-22.2009-000','7°56\'10.992" S','112°33\'16.725" E','671.367,51','9.122.413,62'],
                            [29,'TK 35.07.22.2004-22.2005-002','7°56\'31.171" S','112°32\'52.972" E','670.637,73','9.121.796,46'],
                            [30,'TK 35.07.22.2004-22.2005-003','7°56\'31.620" S','112°32\'49.298" E','670.525,18','9.121.783,08'],
                            [31,'TK 35.07.22.2004-22.2005-006','7°56\'33.301" S','112°32\'44.729" E','670.385,04','9.121.731,97'],
                            [32,'TK 35.07.22.2004-22.2005-008','7°56\'33.239" S','112°32\'40.223" E','670.247,05','9.121.734,37'],
                            [33,'TK 35.07.22.2004-22.2005-013','7°56\'37.121" S','112°32\'32.662" E','670.015,03','9.121.615,99'],
                            [34,'TK 35.07.22.2004-22.2005-014','7°56\'39.214" S','112°32\'28.729" E','669.894,36','9.121.552,14'],
                            [35,'TK 35.07.22.2004-22.2005-007','7°56\'34.009" S','112°32\'43.463" E','670.346,20','9.121.710,36'],
                            [36,'TK 35.07.22.2005-22.2006-002','7°56\'17.806" S','112°33\'19.742" E','671.459,15','9.122.203,95'],
                            [37,'TK 35.07.22.2005-22.2006-003','7°56\'20.165" S','112°33\'19.583" E','671.454,01','9.122.131,50'],
                            [38,'TK 35.07.22.2005-22.2006-003','7°56\'20.537" S','112°33\'16.856" E','671.370,44','9.122.120,38'],
                            [39,'TK 35.07.22.2005-22.2009-013','7°55\'56.047" S','112°32\'19.562" E','669.618,52','9.122.879,25'],
                            [40,'TK 35.07.22.2004-22.2005-004','7°56\'30.566" S','112°32\'45.519" E','670.409,55','9.121.815,89'],
                            [41,'TK 35.07.22.2004-22.2005-005','7°56\'32.837" S','112°32\'43.993" E','670.362,54','9.121.746,30'],
                            [42,'TK 35.07.22.2004-22.2005-010','7°56\'34.553" S','112°32\'36.570" E','670.135,03','9.121.694,43'],
                            [43,'TK 35.07.22.2004-22.2005-009','7°56\'33.309" S','112°32\'36.629" E','670.136,99','9.121.732,65'],
                            [44,'TK 35.07.22.2004-22.2005-011','7°56\'34.476" S','112°32\'35.926" E','670.115,32','9.121.696,87'],
                            [45,'TK 35.07.22.2004-22.2005-012','7°56\'37.899" S','112°32\'34.753" E','670.078,99','9.121.591,87'],
                            [46,'TK 35.07.22.2004-22.2005-016','7°56\'33.050" S','112°31\'55.931" E','668.890,60','9.121.745,21'],
                            [47,'TK 35.07.22.2004-22.2005-015','7°56\'30.967" S','112°32\'1.373" E','669.057,48','9.121.808,60'],
                            [48,'TK 35.07.22.2004-22.2005-017','7°56\'35.662" S','112°31\'14.450" E','667.619,90','9.121.669,66'],
                            [49,'TK 35.07.22.2004-22.2005-018','7°56\'39.614" S','112°31\'11.376" E','667.525,32','9.121.548,61'],
                            [50,'TK 35.07.22.2004-22.2005-019','7°56\'39.829" S','112°31\'6.681" E','667.381,51','9.121.542,53'],
                            [51,'TK 35.07.22.2001-22.2005-001','7°57\'27.192" S','112°30\'8.678" E','665.599,89','9.120.094,05'],
                            [52,'TK 35.07.22.2001-22.2005-002','7°57\'12.634" S','112°28\'39.314" E','662.864,79','9.120.551,12'],
                            [53,'TK 35.07.22.2001-22.2005-003','7°57\'16.804" S','112°28\'22.041" E','662.335,36','9.120.424,91'],
                            [54,'PABU 35.07.22.2004-22.2005.002','7°56\'39.971" S','112°32\'31.673" E','669.984,42','9.121.528,56'],
                            [55,'PBU 35.07.22.2004-22.2005.001','7°56\'36.691" S','112°32\'25.755" E','669.803,55','9.121.629,99'],
                            [56,'PBU 35.07.22.2005-22.2009.006','7°55\'57.138" S','112°32\'37.957" E','670.181,78','9.122.843,65'],
                            [57,'PABU 35.07.22.2004-22.2005.004','7°56\'34.458" S','112°33\'13.682" E','671.271,63','9.121.693,09'],
                            [58,'PABU 35.07.22.2005-22.2006.005','7°56\'11.085" S','112°33\'16.801" E','671.369,85','9.122.410,74'],
                            [59,'PBU 35.07.22.2005-22.2009.007','7°55\'56.505" S','112°32\'19.400" E','669.613,53','9.122.865,21'],
                            [60,'PABU 35.07.22.2004-22.2005.003','7°56\'32.537" S','112°32\'48.841" E','670.511,06','9.121.754,97'],
                            [61,'PABU 35.07.22.2005-22.2009.008','7°55\'56.399" S','112°31\'53.043" E','668.806,31','9.122.871,43'],
                        ];
                        @endphp
                        @foreach($titikList as $t)
                        <tr>
                            <td class="text-center fw-semibold">{{ $t[0] }}</td>
                            <td>
                                @if(str_starts_with($t[1], 'PABU'))
                                    <span class="badge me-1" style="background:#e63946;font-size:0.65rem;">PABU</span>
                                @elseif(str_starts_with($t[1], 'PBU'))
                                    <span class="badge me-1" style="background:#ff9800;font-size:0.65rem;">PBU</span>
                                @else
                                    <span class="badge me-1" style="background:var(--color-forest,#1a5c38);font-size:0.65rem;">TK</span>
                                @endif
                                <span class="code-tk">{{ preg_replace('/^(TK|PABU|PBU)\s+/', '', $t[1]) }}</span>
                            </td>
                            <td style="font-family:monospace;font-size:0.78rem;">{{ $t[2] }}</td>
                            <td style="font-family:monospace;font-size:0.78rem;">{{ $t[3] }}</td>
                            <td style="font-family:monospace;font-size:0.78rem;text-align:right;">{{ $t[4] }}</td>
                            <td style="font-family:monospace;font-size:0.78rem;text-align:right;">{{ $t[5] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-3 p-3 rounded-3 d-flex align-items-start gap-3" style="background:rgba(230,57,70,0.05); border:1px solid rgba(230,57,70,0.15);">
            <i data-lucide="info" style="width:16px;color:#e63946;flex-shrink:0;margin-top:2px;"></i>
            <p class="mb-0 text-muted" style="font-size:0.82rem; font-family:var(--font-body); line-height:1.6;">
                Total <strong>61 titik koordinat presisi</strong> resmi sebagai acuan garis batas wilayah Desa Selorejo. Batas wilayah ini bersifat legal dan dapat dijadikan rujukan dalam penyelesaian sengketa batas maupun perencanaan tata ruang desa. Untuk verifikasi lapangan atau salinan resmi, hubungi <strong>Kantor Desa Selorejo</strong> atau Pemerintah Kabupaten Malang.
            </p>
        </div>
    </div>

    {{-- ══ BARIS 6: Titik Lokasi Wisata (Google Maps per wisata) ══ --}}
    <div class="mt-2 pt-4 border-top" style="border-top-color:rgba(26,92,56,0.15)!important;">
        <div class="text-center mb-5">
            <span class="badge px-3 py-2 rounded-pill fw-bold mb-3" style="background:rgba(26,92,56,0.1);color:var(--color-forest);border:1px solid rgba(26,92,56,0.2);font-family:var(--font-body);">DESTINASI UNGGULAN</span>
            <h2 class="fw-bold text-dark" style="font-family:var(--font-heading);">Titik Lokasi Wisata Favorit</h2>
            <p class="text-muted" style="font-family:var(--font-body);">Akses langsung navigasi menuju objek wisata unggulan Desa Selorejo.</p>
        </div>
        <div class="row g-4">
            @php $wisataList = \App\Models\Wisata::all(); @endphp
            @foreach($wisataList as $w)
            <div class="col-md-6">
                <div class="glass-card bg-white p-3 rounded-4 shadow-sm border h-100 flex-column d-flex" style="border-color:rgba(26,92,56,0.15)!important;">
                    <div class="d-flex align-items-center mb-3">
                        @php
                            $icon = 'map-pin'; $bgStyle = 'background-color:var(--color-forest)!important;color:#fff!important;';
                            $q = strtolower($w->judul);
                            if(str_contains($q,'jeruk')){$icon='citrus';$bgStyle='background-color:var(--accent)!important;color:var(--text-on-accent)!important;';}
                            elseif(str_contains($q,'bedengan')){$icon='tent';}
                            elseif(str_contains($q,'air terjun')){$icon='waves';$bgStyle='background-color:#2196f3!important;color:#fff!important;';}
                            elseif(str_contains($q,'trail')||str_contains($q,'atv')){$icon='bike';$bgStyle='background-color:var(--color-tomato)!important;color:#fff!important;';}
                        @endphp
                        <div class="rounded-circle p-2 me-3 shadow-sm d-flex align-items-center justify-content-center" style="width:40px;height:40px;{{$bgStyle}}">
                            <i data-lucide="{{ $icon }}" class="icon-sm"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-0" style="font-family:var(--font-heading);">{{ $w->judul }}</h6>
                    </div>
                    <div class="rounded-3 overflow-hidden mb-3" style="height:300px;background:#eee;">
                        <iframe src="https://maps.google.com/maps?q={{ urlencode($w->judul . ' Selorejo Daerah Dau Malang') }}&t=&z=14&ie=UTF8&iwloc=&output=embed"
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <a href="https://www.google.com/maps/search/{{ urlencode($w->judul . ' Selorejo') }}"
                       target="_blank"
                       class="btn w-100 rounded-pill fw-bold mt-auto btn-sm py-2"
                       style="background-color:var(--color-forest)!important;color:#fff!important;font-family:var(--font-heading);border:none;transition:transform 0.2s;">
                        Navigasi Ke Lokasi &nbsp;<i data-lucide="navigation-2" class="icon-sm ms-1"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>

@include('layouts.partials.lightbox')
@endsection
