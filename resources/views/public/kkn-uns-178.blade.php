@extends('layouts.public')

@section('title', 'Profil KKN UNS 178 Desa Selorejo — Tim & Program Kerja')
@section('meta_description', 'Profil lengkap KKN Tematik UNS 178 di Desa Selorejo, Kecamatan Dau, Kabupaten Malang. Menampilkan seluruh program kerja digitalisasi, pemberdayaan UMKM, pendidikan, kesehatan, dan lingkungan beserta 10 anggota mahasiswa lintas fakultas.')
@section('meta_keywords', 'KKN UNS 178, KKN Selorejo, digitalisasi desa, website desa wisata, KKN Tematik UNS, mahasiswa UNS, program kerja KKN')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">KKN UNS 178</li>
@endsection

@push('styles')
<style>
    /* ── KKN Page Styles ── */
    .kkn-hero {
        background: linear-gradient(135deg, var(--color-forest) 0%, #0F3D25 60%, #2E7D4F 100%);
        position: relative;
        overflow: hidden;
        padding: 100px 0 80px;
    }
    .kkn-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        pointer-events: none;
    }
    .kkn-hero::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 60px;
        background: var(--color-cream);
        clip-path: ellipse(55% 100% at 50% 100%);
    }
    .kkn-info-badge {
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: var(--radius-md);
        padding: 12px 20px;
        backdrop-filter: blur(6px);
        transition: background 0.2s;
    }
    .kkn-info-badge:hover {
        background: rgba(255,255,255,0.18);
    }
    .sdg-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: var(--color-forest);
        color: #fff;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 50px;
        letter-spacing: 0.5px;
        font-family: var(--font-heading);
    }
    .sdg-badge.sdg-1  { background: #e5243b; }
    .sdg-badge.sdg-3  { background: #4c9f38; }
    .sdg-badge.sdg-4  { background: #c5192d; }
    .sdg-badge.sdg-8  { background: #a21942; }
    .sdg-badge.sdg-9  { background: #fd6925; }
    .sdg-badge.sdg-10 { background: #dd1367; }
    .sdg-badge.sdg-11 { background: #fd9d24; }
    .sdg-badge.sdg-17 { background: #19486a; }

    /* Program cards */
    .program-card {
        background: #fff;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
        border: 1px solid rgba(26,92,56,0.08);
        transition: transform 0.2s, box-shadow 0.2s;
        overflow: hidden;
    }
    .program-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
    }
    .program-card-accent {
        height: 5px;
        background: linear-gradient(90deg, var(--color-forest), var(--color-kiwi));
    }

    /* Member cards */
    .member-card {
        background: #fff;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        border: 1px solid rgba(26,92,56,0.08);
        transition: transform 0.25s, box-shadow 0.25s;
        overflow: hidden;
        cursor: pointer;
        position: relative;
    }
    .member-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-lg);
    }
    .member-photo-wrap {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        overflow: hidden;
        border: 4px solid var(--color-forest);
        background: var(--color-cream);
        margin: 0 auto;
        box-shadow: 0 4px 16px rgba(26,92,56,0.18);
        flex-shrink: 0;
    }
    .member-photo-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top center;
    }
    .member-badge {
        font-size: 0.65rem;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 50px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-family: var(--font-heading);
    }
    .badge-ketua {
        background: var(--color-sunshine);
        color: #1a1a1a;
    }
    .badge-developer {
        background: var(--color-forest);
        color: #fff;
    }

    /* Member proker overlay */
    .member-proker-overlay {
        display: none;
        position: absolute;
        inset: 0;
        background: linear-gradient(160deg, rgba(15,61,37,0.97) 0%, rgba(26,92,56,0.95) 100%);
        color: #fff;
        padding: 20px;
        overflow-y: auto;
        border-radius: var(--radius-lg);
        z-index: 5;
    }
    .member-card:hover .member-proker-overlay,
    .member-card.active .member-proker-overlay {
        display: flex;
        flex-direction: column;
        justify-content: center;
        animation: fadeInOverlay 0.2s ease;
    }
    @keyframes fadeInOverlay {
        from { opacity: 0; transform: scale(0.97); }
        to   { opacity: 1; transform: scale(1); }
    }

    /* DPL section */
    .dpl-card {
        background: linear-gradient(135deg, var(--color-forest) 0%, #1e6b43 100%);
        border-radius: var(--radius-lg);
        color: #fff;
        padding: 40px;
        box-shadow: var(--shadow-lg);
        position: relative;
        overflow: hidden;
    }
    .dpl-card::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 180px; height: 180px;
        border-radius: 50%;
        background: rgba(245,197,24,0.12);
        pointer-events: none;
    }
    .dpl-photo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        object-position: top center;
        border: 4px solid var(--color-sunshine);
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    }

    /* Other programs table */
    .proker-table tr:hover td {
        background: rgba(26,92,56,0.04);
    }

    /* Section accent line */
    .kkn-section-label {
        font-family: var(--font-heading);
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--color-forest);
        display: inline-block;
        margin-bottom: 8px;
    }
    .kkn-section-divider {
        width: 48px;
        height: 4px;
        background: linear-gradient(90deg, var(--color-forest), var(--color-kiwi));
        border-radius: 2px;
        margin: 12px 0 24px;
    }

    @media (max-width: 767px) {
        .kkn-hero { padding: 70px 0 70px; }
        .kkn-hero::after { height: 40px; }
        .member-proker-overlay { font-size: 0.85rem; }
    }
</style>
@endpush

@section('content')

{{-- ══════════════════════════════════════════════════════════════
     A) HERO
══════════════════════════════════════════════════════════════ --}}
<section class="kkn-hero">
    <div class="container position-relative z-1 text-center text-white">
@php
            $kknLogo        = $kknSettings['logo'] ?? 'images/logo-kkn-178.png';
            $kknLogoUrl     = str_starts_with($kknLogo, 'images/') ? asset($kknLogo) : asset('storage/' . $kknLogo);
            $kelompokLabel  = $kknSettings['kelompok_label'] ?? 'KKN TEMATIK UNS — KELOMPOK 178';
            $judulUtama     = $kknSettings['judul_utama'] ?? 'KKN Tematik UNS 178';
            $subjudul       = $kknSettings['subjudul'] ?? 'Desa Selorejo';
            $tagline        = $kknSettings['tagline'] ?? "Pemberdayaan Desa Selorejo Berbasis Digitalisasi, Inovasi Produk Lokal,\ndan Penguatan UMKM Menuju Desa Wisata Berkelanjutan";
            $linkInstagram  = $kknSettings['link_instagram'] ?? 'https://www.instagram.com/raharjo.selorejo';
            $linkTiktok     = $kknSettings['link_tiktok'] ?? 'https://www.tiktok.com/@raharjo.selorejo';
        @endphp
        <!-- Logo KKN 178 -->
        <div class="mb-4">
            <img src="{{ $kknLogoUrl }}" alt="Logo KKN 178 UNS" class="rounded-circle shadow-sm" style="width: 150px; height: 150px; object-fit: cover; border: 4px solid rgba(255,255,255,0.8); background-color: #fff;">
        </div>

        <span class="badge rounded-pill px-4 py-2 mb-4 d-inline-block fw-bold"
              style="background:rgba(245,197,24,0.2); border:1px solid rgba(245,197,24,0.5); color:var(--color-sunshine); font-family:var(--font-heading); font-size:0.78rem; letter-spacing:1.5px;">
            {{ $kelompokLabel }}
        </span>
        <h1 class="fw-bold mb-3 text-white"
            style="font-family: var(--font-display); font-size: clamp(2.4rem, 6vw, 4rem); letter-spacing: 0.03em; line-height: 1.1;">
            {{ $judulUtama }}<br>
            <span style="color: var(--color-sunshine);">{{ $subjudul }}</span>
        </h1>
        <p class="mb-5 mx-auto" style="max-width:680px; font-family:var(--font-body); font-size:1.05rem; color:rgba(255,255,255,0.88); line-height:1.75;">
            {!! nl2br(e($tagline)) !!}
        </p>

        {{-- Social Media Buttons --}}
        <div class="d-flex justify-content-center flex-wrap gap-3 mb-5">
            @if($linkInstagram)
            <a href="{{ $linkInstagram }}" target="_blank" class="btn btn-outline-light d-flex align-items-center gap-2" style="border-radius: 50px; padding: 0.6rem 1.8rem; border-color: rgba(255,255,255,0.5); font-weight: 500; letter-spacing: 0.5px; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(255,255,255,0.8)';" onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='rgba(255,255,255,0.5)';">
                <i data-lucide="instagram" style="width: 20px; height: 20px;"></i>
                Instagram
            </a>
            @endif
            @if($linkTiktok)
            <a href="{{ $linkTiktok }}" target="_blank" class="btn btn-outline-light d-flex align-items-center gap-2" style="border-radius: 50px; padding: 0.6rem 1.8rem; border-color: rgba(255,255,255,0.5); font-weight: 500; letter-spacing: 0.5px; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(255,255,255,0.8)';" onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='rgba(255,255,255,0.5)';">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 2.23-1.11 4.46-2.9 5.86-1.5 1.15-3.41 1.59-5.32 1.43-1.92-.15-3.69-1.07-4.96-2.45-1.28-1.38-1.89-3.32-1.63-5.22.25-1.9 1.34-3.56 2.87-4.63 1.53-1.06 3.44-1.41 5.28-1.01V15c-1.02-.2-2.11-.12-3.05.35-.94.47-1.64 1.34-1.95 2.33-.31.99-.18 2.11.35 3.01.52.9 1.42 1.52 2.45 1.71 1.03.18 2.1-.03 2.95-.57.85-.54 1.44-1.4 1.63-2.4.15-.81.1-1.65.1-2.47V0h3.83v.02z"/>
                </svg>
                TikTok
            </a>
            @endif
        </div>

@php
            $badgeLokasi  = $kknSettings['badge_lokasi']  ?? "Desa Selorejo, Kec. Dau\nKab. Malang, Jawa Timur";
            $badgePeriode = $kknSettings['badge_periode'] ?? 'Juli – Agustus 2026';
            $badgeTema    = $kknSettings['badge_tema']    ?? 'Digitalisasi Desa & Pemberdayaan Ekonomi';
            $badgeAnggota = $kknSettings['badge_anggota'] ?? "10 Mahasiswa\nFKIP · FEB · FKOR · FT · FP";
        @endphp
        {{-- Info badges --}}
        <div class="row g-3 justify-content-center mt-2">
            <div class="col-6 col-md-3">
                <div class="kkn-info-badge text-center">
                    <i data-lucide="map-pin" style="width:20px; margin-bottom:6px; color:var(--color-sunshine);"></i>
                    <div style="font-size:0.7rem; opacity:0.7; font-family:var(--font-heading); letter-spacing:1px; text-transform:uppercase;">Lokasi</div>
                    <div style="font-size:0.88rem; font-weight:600; font-family:var(--font-heading);">{!! nl2br(e($badgeLokasi)) !!}</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="kkn-info-badge text-center">
                    <i data-lucide="calendar" style="width:20px; margin-bottom:6px; color:var(--color-sunshine);"></i>
                    <div style="font-size:0.7rem; opacity:0.7; font-family:var(--font-heading); letter-spacing:1px; text-transform:uppercase;">Periode</div>
                    <div style="font-size:0.88rem; font-weight:600; font-family:var(--font-heading);">{{ $badgePeriode }}</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="kkn-info-badge text-center">
                    <i data-lucide="zap" style="width:20px; margin-bottom:6px; color:var(--color-sunshine);"></i>
                    <div style="font-size:0.7rem; opacity:0.7; font-family:var(--font-heading); letter-spacing:1px; text-transform:uppercase;">Tema</div>
                    <div style="font-size:0.88rem; font-weight:600; font-family:var(--font-heading);">{{ $badgeTema }}</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="kkn-info-badge text-center">
                    <i data-lucide="users" style="width:20px; margin-bottom:6px; color:var(--color-sunshine);"></i>
                    <div style="font-size:0.7rem; opacity:0.7; font-family:var(--font-heading); letter-spacing:1px; text-transform:uppercase;">Anggota</div>
                    <div style="font-size:0.88rem; font-weight:600; font-family:var(--font-heading);">{!! nl2br(e($badgeAnggota)) !!}</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════════
     B) TENTANG PROGRAM KKN
══════════════════════════════════════════════════════════════ --}}
<section class="py-5" style="background: var(--color-cream);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <span class="kkn-section-label">Tentang Program</span>
                <h2 class="fw-bold mb-2" style="font-family:var(--font-heading); color:var(--color-forest); font-size:var(--text-2xl);">
                    Mengapa KKN di Desa Selorejo?
                </h2>
                <div class="kkn-section-divider"></div>

                @php
                    $deskripsiProgram = $kknSettings['deskripsi_program'] ?? [
                        'Kelompok KKN Tematik UNS 178 adalah kelompok pengabdian masyarakat mahasiswa Universitas Sebelas Maret (UNS) yang bertugas di Desa Selorejo, Kecamatan Dau, Kabupaten Malang. Program ini berada di bawah Subdirektorat KKN dan Organisasi Kemahasiswaan UNS, dengan bimbingan <strong>Rin Widya Agustin, S.Psi., M.Psi.</strong> sebagai Dosen Pembimbing Lapangan.',
                        'Desa Selorejo dikenal sebagai desa agrowisata dengan potensi unggulan berupa perkebunan jeruk keprok dan tebu, serta wisata petik jeruk yang sudah dikenal di kawasan Kecamatan Dau.',
                        'Kelompok ini merancang program kerja lintas bidang yang komprehensif: <strong>digitalisasi</strong>, <strong>ekonomi kreatif dan UMKM</strong>, <strong>pendidikan</strong>, <strong>kesehatan</strong>, serta <strong>lingkungan</strong>.',
                    ];
                @endphp
                @foreach($deskripsiProgram as $p)
                <p style="font-family:var(--font-body); font-size:1.02rem; line-height:1.85; color:#333;">
                    {!! $p !!}
                </p>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════════
     C) PROGRAM KERJA UTAMA — WEBSITE DESA WISATA
══════════════════════════════════════════════════════════════ --}}
<section class="py-5" style="background:#fff;">
    <div class="container">


        {{-- Program: Website Desa Wisata --}}
        <div class="program-card">
            <div class="program-card-accent"></div>
            <div class="p-4 p-md-5">
                <div class="d-flex flex-wrap align-items-start gap-3 mb-4">
                    <div class="d-flex align-items-center justify-content-center rounded-3 flex-shrink-0"
                         style="width:56px;height:56px;background:rgba(26,92,56,0.1);">
                        <i data-lucide="globe" style="width:28px;height:28px;color:var(--color-forest);"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-1" style="font-family:var(--font-heading); color:var(--color-forest); font-size:1.25rem;">
                            Pengembangan Website Desa Wisata Petik Jeruk Selorejo<br>
                            <span style="font-weight:400; font-size:1rem;">sebagai Media Promosi Digital Berkelanjutan</span>
                        </h3>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            <span class="sdg-badge sdg-8">SDG 8</span>
                            <span class="sdg-badge sdg-9">SDG 9</span>
                            <span class="sdg-badge sdg-11">SDG 11</span>
                            <span class="sdg-badge sdg-17">SDG 17</span>
                        </div>
                    </div>
                </div>

                <p style="font-family:var(--font-body); line-height:1.85; color:#444;">
                    Program ini dirancang secara kolaboratif antara mahasiswa Program Studi Pendidikan Teknik Informatika dan Komputer UNS dengan perangkat Desa Selorejo, menggunakan pendekatan partisipatif berbasis kebutuhan nyata desa. Seluruh konten, fitur, dan desain website digali langsung bersama perangkat desa, pelaku wisata lokal, serta kelompok tani dan peternak, dengan tujuan menciptakan identitas digital desa yang mampu menjangkau calon wisatawan, investor, dan mitra pembangunan desa secara lebih luas dibanding metode promosi mulut ke mulut yang selama ini dipakai.
                </p>

                <div class="row g-4 mt-1">
                    {{-- Modul --}}
                    <div class="col-md-6">
                        <div class="h-100 p-4 rounded-3" style="background:rgba(26,92,56,0.04); border:1px solid rgba(26,92,56,0.1);">
                            <h5 class="fw-bold mb-3 d-flex align-items-center gap-2" style="font-family:var(--font-heading); color:var(--color-forest); font-size:0.95rem;">
                                <i data-lucide="layout-grid" style="width:18px;"></i> Modul Utama Website
                            </h5>
                            <ul class="list-unstyled mb-0" style="font-family:var(--font-body); font-size:0.92rem; line-height:1.9;">
                                <li class="d-flex align-items-start gap-2"><i data-lucide="check-circle-2" style="width:15px;min-width:15px;margin-top:3px;color:var(--color-kiwi);"></i> Beranda — profil &amp; sejarah desa</li>
                                <li class="d-flex align-items-start gap-2"><i data-lucide="check-circle-2" style="width:15px;min-width:15px;margin-top:3px;color:var(--color-kiwi);"></i> Informasi wisata petik jeruk (harga, jadwal)</li>
                                <li class="d-flex align-items-start gap-2"><i data-lucide="check-circle-2" style="width:15px;min-width:15px;margin-top:3px;color:var(--color-kiwi);"></i> Galeri foto &amp; dokumentasi wisata</li>
                                <li class="d-flex align-items-start gap-2"><i data-lucide="check-circle-2" style="width:15px;min-width:15px;margin-top:3px;color:var(--color-kiwi);"></i> Produk unggulan desa (jeruk, tebu, pupuk organik)</li>
                                <li class="d-flex align-items-start gap-2"><i data-lucide="check-circle-2" style="width:15px;min-width:15px;margin-top:3px;color:var(--color-kiwi);"></i> Kontak &amp; peta terintegrasi Google Maps</li>
                                <li class="d-flex align-items-start gap-2"><i data-lucide="check-circle-2" style="width:15px;min-width:15px;margin-top:3px;color:var(--color-kiwi);"></i> Layanan adminduk (KTP, KK, akta kelahiran/kematian)</li>
                            </ul>
                        </div>
                    </div>

                    {{-- Transfer Ilmu --}}
                    <div class="col-md-6">
                        <div class="h-100 p-4 rounded-3" style="background:rgba(245,197,24,0.07); border:1px solid rgba(245,197,24,0.25);">
                            <h5 class="fw-bold mb-3 d-flex align-items-center gap-2" style="font-family:var(--font-heading); color:var(--color-forest); font-size:0.95rem;">
                                <i data-lucide="book-open" style="width:18px;"></i> Transfer Ilmu &amp; Keberlanjutan
                            </h5>
                            <ul class="list-unstyled mb-0" style="font-family:var(--font-body); font-size:0.92rem; line-height:1.9;">
                                <li class="d-flex align-items-start gap-2"><i data-lucide="arrow-right-circle" style="width:15px;min-width:15px;margin-top:3px;color:var(--color-carro);"></i> Workshop hands-on untuk perangkat desa &amp; karang taruna</li>
                                <li class="d-flex align-items-start gap-2"><i data-lucide="arrow-right-circle" style="width:15px;min-width:15px;margin-top:3px;color:var(--color-carro);"></i> Modul panduan tertulis bahasa sederhana</li>
                                <li class="d-flex align-items-start gap-2"><i data-lucide="arrow-right-circle" style="width:15px;min-width:15px;margin-top:3px;color:var(--color-carro);"></i> Jadwal pembaruan konten rutin oleh operator desa</li>
                                <li class="d-flex align-items-start gap-2"><i data-lucide="arrow-right-circle" style="width:15px;min-width:15px;margin-top:3px;color:var(--color-carro);"></i> Integrasi media sosial resmi desa</li>
                                <li class="d-flex align-items-start gap-2"><i data-lucide="arrow-right-circle" style="width:15px;min-width:15px;margin-top:3px;color:var(--color-carro);"></i> Pendaftaran ke platform wisata nasional (Wonderful Indonesia)</li>
                                <li class="d-flex align-items-start gap-2"><i data-lucide="arrow-right-circle" style="width:15px;min-width:15px;margin-top:3px;color:var(--color-carro);"></i> Pengembangan fitur pemesanan kunjungan wisata daring</li>
                            </ul>
                        </div>
                    </div>

                    {{-- Faktor Pendukung / Penghambat --}}
                    <div class="col-md-6">
                        <div class="p-4 rounded-3" style="background:rgba(124,181,24,0.07); border:1px solid rgba(124,181,24,0.2);">
                            <h5 class="fw-bold mb-3 d-flex align-items-center gap-2" style="font-family:var(--font-heading); color:var(--color-kiwi); font-size:0.95rem;">
                                <i data-lucide="thumbs-up" style="width:18px;"></i> Faktor Pendukung
                            </h5>
                            <ul class="list-unstyled mb-0" style="font-family:var(--font-body); font-size:0.9rem; line-height:1.85; color:#444;">
                                <li>✅ Potensi wisata petik jeruk sudah dikenal di Kec. Dau</li>
                                <li>✅ Dukungan penuh perangkat desa (data &amp; fasilitas)</li>
                                <li>✅ Kompetensi akademik mahasiswa di pengembangan web</li>
                                <li>✅ Karang taruna melek teknologi sebagai calon operator</li>
                                <li>✅ Jaringan internet yang memadai di desa</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-4 rounded-3" style="background:rgba(217,48,37,0.05); border:1px solid rgba(217,48,37,0.15);">
                            <h5 class="fw-bold mb-3 d-flex align-items-center gap-2" style="font-family:var(--font-heading); color:var(--color-tomato); font-size:0.95rem;">
                                <i data-lucide="alert-triangle" style="width:18px;"></i> Faktor Penghambat
                            </h5>
                            <ul class="list-unstyled mb-0" style="font-family:var(--font-body); font-size:0.9rem; line-height:1.85; color:#444;">
                                <li>⚠️ Keterbatasan pemahaman digital perangkat desa</li>
                                <li>⚠️ Keterbatasan konten multimedia berkualitas tinggi</li>
                                <li>⚠️ Waktu pelaksanaan KKN yang singkat</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


{{-- ══════════════════════════════════════════════════════════════
     E) DOSEN PEMBIMBING LAPANGAN
══════════════════════════════════════════════════════════════ --}}
<section class="py-5" style="background: var(--color-cream);">
    <div class="container">
        <div class="text-center mb-4">
            <span class="kkn-section-label">Pembimbing</span>
            <h2 class="fw-bold mb-2" style="font-family:var(--font-heading); color:var(--color-forest); font-size:var(--text-2xl);">
                Dosen Pembimbing Lapangan
            </h2>
            <div class="kkn-section-divider mx-auto"></div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                @php
                    $dpl = $kknSettings['dpl'] ?? ['nama'=>'Rin Widya Agustin, S.Psi., M.Psi.','jabatan'=>'Penata / Lektor','institusi'=>'Universitas Sebelas Maret','foto'=>'images/Rin Widya.png'];
                    $dplFoto = $dpl['foto'] ?? 'images/Rin Widya.png';
                    $dplFotoUrl = str_starts_with($dplFoto, 'images/') ? asset($dplFoto) : asset('storage/' . $dplFoto);
                @endphp
                <div class="dpl-card">
                    <div class="d-flex flex-column flex-sm-row align-items-center gap-4">
                        <div class="flex-shrink-0 text-center">
                            <img
                                src="{{ $dplFotoUrl }}"
                                alt="{{ $dpl['nama'] ?? '' }}"
                                class="dpl-photo"
                                loading="lazy"
                                onerror="this.src=''; this.style.display='none'; this.nextElementSibling.style.display='flex';"
                            >
                            <div class="dpl-photo d-none align-items-center justify-content-center"
                                 style="background:rgba(255,255,255,0.15); font-size:2.5rem;">👩‍🏫</div>
                        </div>
                        <div class="text-center text-sm-start">
                            <div style="font-size:0.7rem; letter-spacing:1.5px; text-transform:uppercase; opacity:0.65; font-family:var(--font-heading); margin-bottom:6px;">Dosen Pembimbing Lapangan</div>
                            <h3 class="fw-bold text-white mb-1" style="font-family:var(--font-heading); font-size:1.3rem;">
                                {{ $dpl['nama'] ?? 'Rin Widya Agustin, S.Psi., M.Psi.' }}
                            </h3>
                            <div class="mb-2" style="font-size:0.88rem; opacity:0.85; font-family:var(--font-body);">{{ $dpl['jabatan'] ?? 'Penata / Lektor' }}</div>
                            <div class="d-flex align-items-center gap-2 justify-content-center justify-content-sm-start">
                                <i data-lucide="building-2" style="width:15px;opacity:0.7;"></i>
                                <span style="font-size:0.88rem; font-family:var(--font-body);">{{ $dpl['institusi'] ?? 'Universitas Sebelas Maret' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════════
     F) GRID KARTU ANGGOTA  (1 ketua — 3 — 3 — 3)
══════════════════════════════════════════════════════════════ --}}
<section class="py-5" style="background:#fff;">
    <div class="container">
        <div class="text-center mb-4">
            <span class="kkn-section-label">Tim Mahasiswa</span>
            <h2 class="fw-bold mb-2" style="font-family:var(--font-heading); color:var(--color-forest); font-size:var(--text-2xl);">
                10 Anggota Kelompok KKN 178
            </h2>
            <div class="kkn-section-divider mx-auto"></div>
            <p class="text-muted" style="font-family:var(--font-body); font-size:0.9rem; max-width:480px; margin: 0 auto;">
                Arahkan kursor ke kartu anggota untuk melihat program kerja masing-masing.
            </p>
        </div>

        @php
        // $anggota sudah di-pass dari controller (dari DB atau fallback hardcoded)
        // Format: array of assoc dengan keys: nama, nim, prodi, fak, foto, badge, proker, sdg
        $sdgClasses = [1=>'sdg-1', 3=>'sdg-3', 4=>'sdg-4', 8=>'sdg-8', 9=>'sdg-9', 10=>'sdg-10', 11=>'sdg-11', 17=>'sdg-17'];
        @endphp

        {{-- Baris 1: Ketua (urutan pertama / badge ketua), seorang diri di tengah --}}
        @php $ketua = $anggota[0]; @endphp
        <div class="row g-4 justify-content-center mb-2">
            <div class="col-10 col-sm-7 col-md-5 col-lg-4">
                <div class="member-card text-center p-4" style="min-height:320px;">
                    <div class="member-card-front">
                        <div class="member-photo-wrap mb-3 mx-auto" style="width:140px;height:140px;">
                            <img
                                src="{{ asset($ketua['foto']) }}"
                                alt="{{ $ketua['nama'] }}"
                                loading="lazy"
                                onerror="this.src='{{ asset('images/default-avatar.png') }}'; this.onerror=null;"
                            >
                        </div>
                        <span class="member-badge badge-ketua mb-2 d-inline-block">⭐ Ketua Kelompok</span>
                        <h5 class="fw-bold mb-1" style="font-family:var(--font-heading); font-size:1rem; color:#1a1a1a;">{{ $ketua['nama'] }}</h5>
                        <div style="font-size:0.8rem; color:var(--color-forest); font-family:var(--font-heading); font-weight:600;">{{ $ketua['nim'] }}</div>
                        <div style="font-size:0.85rem; color:#555; font-family:var(--font-body); margin-top:4px;">{{ $ketua['prodi'] }}</div>
                        <div class="mt-2">
                            <span class="badge rounded-pill" style="background:rgba(26,92,56,0.1); color:var(--color-forest); font-size:0.72rem; font-family:var(--font-heading); font-weight:700;">{{ $ketua['fak'] }}</span>
                        </div>
                    </div>
                    <div class="member-proker-overlay">
                        <div class="mb-2" style="font-size:0.65rem; letter-spacing:1.5px; text-transform:uppercase; opacity:0.65; font-family:var(--font-heading);">Program Kerja</div>
                        <p class="mb-3" style="font-family:var(--font-body); font-size:0.9rem; line-height:1.65;">{!! $ketua['proker'] !!}</p>
                        <div class="d-flex flex-wrap gap-1 justify-content-center">
                            @foreach($ketua['sdg'] as $s)
                                <span class="sdg-badge {{ $sdgClasses[$s] ?? '' }}">SDG {{ $s }}</span>
                            @endforeach
                        </div>
                        <div class="mt-3" style="font-size:0.75rem; opacity:0.6; font-family:var(--font-heading);">{{ $ketua['nim'] }} · {{ $ketua['fak'] }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Baris 2–N: anggota lain, 3 per baris --}}
        <div class="row g-4 justify-content-center">
            @foreach(array_slice($anggota, 1) as $m)
            <div class="col-12 col-sm-6 col-md-4">
                <div class="member-card text-center p-4" style="min-height:300px;">
                    <div class="member-card-front">
                        <div class="member-photo-wrap mb-3 mx-auto" style="width:130px;height:130px;">
                            <img
                                src="{{ asset($m['foto']) }}"
                                alt="{{ $m['nama'] }}"
                                loading="lazy"
                                onerror="this.src='{{ asset('images/default-avatar.png') }}'; this.onerror=null;"
                            >
                        </div>
                        @if($m['badge'] === 'developer')
                            <span class="member-badge badge-developer mb-2 d-inline-block">💻 Pengembang Website</span>
                        @endif
                        <h5 class="fw-bold mb-1" style="font-family:var(--font-heading); font-size:0.97rem; color:#1a1a1a;">{{ $m['nama'] }}</h5>
                        <div style="font-size:0.78rem; color:var(--color-forest); font-family:var(--font-heading); font-weight:600;">{{ $m['nim'] }}</div>
                        <div style="font-size:0.83rem; color:#555; font-family:var(--font-body); margin-top:4px;">{{ $m['prodi'] }}</div>
                        <div class="mt-2">
                            <span class="badge rounded-pill" style="background:rgba(26,92,56,0.1); color:var(--color-forest); font-size:0.7rem; font-family:var(--font-heading); font-weight:700;">{{ $m['fak'] }}</span>
                        </div>
                    </div>
                    <div class="member-proker-overlay">
                        <div class="mb-2" style="font-size:0.65rem; letter-spacing:1.5px; text-transform:uppercase; opacity:0.65; font-family:var(--font-heading);">Program Kerja</div>
                        <p class="mb-3" style="font-family:var(--font-body); font-size:0.88rem; line-height:1.6;">{!! $m['proker'] !!}</p>
                        <div class="d-flex flex-wrap gap-1 justify-content-center">
                            @foreach($m['sdg'] as $s)
                                <span class="sdg-badge {{ $sdgClasses[$s] ?? '' }}">SDG {{ $s }}</span>
                            @endforeach
                        </div>
                        <div class="mt-3" style="font-size:0.72rem; opacity:0.6; font-family:var(--font-heading);">{{ $m['nim'] }} · {{ $m['fak'] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════════
     G) BACK TO TOP / CTA FOOTER
══════════════════════════════════════════════════════════════ --}}
<section class="py-4 text-center" style="background:#fff; border-top: 1px solid rgba(26,92,56,0.08);">
    <div class="container">
        <a href="{{ url('/') }}" class="btn btn-outline-success rounded-pill px-5 me-2"
           style="font-family:var(--font-heading); font-weight:600; border-color:var(--color-forest); color:var(--color-forest);">
            <i data-lucide="arrow-left" class="me-2" style="width:15px;"></i> Kembali ke Beranda
        </a>
        <a href="{{ url('/wisata') }}" class="btn px-5 rounded-pill"
           style="background:var(--color-forest); color:#fff; font-family:var(--font-heading); font-weight:600;">
            <i data-lucide="map" class="me-2" style="width:15px;"></i> Jelajahi Wisata Selorejo
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Reinit lucide icons (for dynamically rendered content)
    if (window.lucide) lucide.createIcons();

    // Mobile: tap to toggle overlay
    document.querySelectorAll('.member-card').forEach(function(card) {
        card.addEventListener('click', function(e) {
            // Only on touch / mobile (no hover capability)
            if (window.matchMedia('(hover: none)').matches) {
                this.classList.toggle('active');
            }
        });
    });
});
</script>
@endpush
