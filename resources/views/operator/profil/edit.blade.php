@extends('layouts.dashboard')
@section('title', 'Kelola Profil Desa')
@section('content')

<div class="row text-start">
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i data-lucide="check-circle" class="me-2 icon-sm"></i>
                    <div class="fw-bold">{{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ url('/operator/profil') }}" method="POST" id="profileForm" enctype="multipart/form-data">
            @csrf
            
            @php
                $hero_sejarah = $profil->hero_sejarah ?? ['title' => 'Sejarah Desa', 'subtitle' => 'Menelusuri jejak peradaban...', 'icon' => 'history'];
                $hero_visimisi = $profil->hero_visimisi ?? ['title' => 'Visi & Misi', 'subtitle' => 'Arah dan tujuan pembangunan...', 'icon' => 'target'];
                $hero_geografi = $profil->hero_geografi ?? ['title' => 'Kondisi Geografis', 'subtitle' => 'Letak, topografi...', 'icon' => 'mountain'];
                $hero_peta = $profil->hero_peta ?? ['title' => 'Peta Wilayah Desa', 'subtitle' => 'Penunjuk arah digital...', 'icon' => 'map'];
            @endphp

            <!-- Premium Nav Tabs -->
            <ul class="nav nav-pills mb-4 bg-white p-2 rounded-pill shadow-sm d-inline-flex border" id="profileTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active rounded-pill px-4 py-2 d-flex align-items-center fw-bold transition-all" id="sejarah-tab" data-bs-toggle="pill" data-bs-target="#sejarah" type="button" role="tab"><i data-lucide="book-open" class="icon-sm me-2"></i> SEJARAH</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-4 py-2 d-flex align-items-center fw-bold transition-all" id="visimisi-tab" data-bs-toggle="pill" data-bs-target="#visimisi" type="button" role="tab"><i data-lucide="target" class="icon-sm me-2"></i> VISI & MISI</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-4 py-2 d-flex align-items-center fw-bold transition-all" id="geografi-tab" data-bs-toggle="pill" data-bs-target="#geografi" type="button" role="tab"><i data-lucide="mountain" class="icon-sm me-2"></i> GEOGRAFIS</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-4 py-2 d-flex align-items-center fw-bold transition-all" id="peta-tab" data-bs-toggle="pill" data-bs-target="#peta" type="button" role="tab"><i data-lucide="map" class="icon-sm me-2"></i> PETA & WILAYAH</button>
                </li>
            </ul>

            <!-- Tab Content Area -->
            <div class="tab-content" id="profileTabsContent">
                
                <!-- Tab 1: Sejarah -->
                <div class="tab-pane fade show active" id="sejarah" role="tabpanel">
                    <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden border-top border-4 border-success">
                        <div class="card-body p-4 p-md-5">
                            <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="image" class="text-success me-3"></i> Header Halaman Sejarah</h5>
                            <div class="row g-3 mb-5 p-3 bg-light rounded-4">
                                <div class="col-md-4">
                                    <label class="small fw-bold text-muted mb-1">Judul Halaman</label>
                                    <input type="text" name="hero_sejarah[title]" class="form-control rounded-3" value="{{ $hero_sejarah['title'] ?? '' }}">
                                </div>
                                <div class="col-md-5">
                                    <label class="small fw-bold text-muted mb-1">Sub-Judul</label>
                                    <input type="text" name="hero_sejarah[subtitle]" class="form-control rounded-3" value="{{ $hero_sejarah['subtitle'] ?? '' }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="small fw-bold text-muted mb-1">Ikon (Lucide)</label>
                                    <input type="text" name="hero_sejarah[icon]" class="form-control rounded-3" value="{{ $hero_sejarah['icon'] ?? 'history' }}">
                                </div>
                            </div>

                            <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="pencil-line" class="text-success me-3"></i> Narasi Sejarah Desa</h5>
                            <div class="mb-5">
                                <label class="form-label text-muted small fw-bold">Konten Sejarah (Mendukung HTML Sederhana)</label>
                                <textarea name="sejarah" class="form-control rounded-4 shadow-none p-4" rows="12" placeholder="Masukkan narasi sejarah desa dengan mendalam...">{{ old('sejarah', $profil->sejarah) }}</textarea>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4 pt-4 border-top">
                                <h5 class="fw-bold mb-0 d-flex align-items-center"><i data-lucide="calendar-days" class="text-success me-3"></i> Lini Masa (Timeline)</h5>
                                <button type="button" class="btn btn-sm btn-success rounded-pill px-4 shadow-sm border-0" onclick="addRow('timeline-container', 'timeline-template')">
                                    <i data-lucide="plus" class="icon-sm me-1"></i> Tambah Jejak
                                </button>
                            </div>

                            <div id="timeline-container" class="pe-md-4">
                                @php $timelines = $profil->sejarah_timeline ?? []; @endphp
                                @foreach($timelines as $index => $item)
                                <div class="timeline-item-row dash-card p-4 rounded-4 mb-4 border border-success border-opacity-10 position-relative hover-lift">
                                    <div class="row g-3">
                                        <div class="col-md-2">
                                            <label class="small fw-bold text-muted">Era/Tahun</label>
                                            <input type="text" name="sejarah_timeline[{{ $index }}][year]" class="form-control rounded-3 border-success border-opacity-25" value="{{ $item['year'] }}" placeholder="19xx">
                                        </div>
                                        <div class="col-md-5">
                                            <label class="small fw-bold text-muted">Nama Peristiwa</label>
                                            <input type="text" name="sejarah_timeline[{{ $index }}][title]" class="form-control rounded-3" value="{{ $item['title'] }}" placeholder="Contoh: Pembukaan Desa">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="small fw-bold text-muted">Ikon Visual</label>
                                            <input type="text" name="sejarah_timeline[{{ $index }}][icon]" class="form-control rounded-3" value="{{ $item['icon'] ?? 'milestone' }}" placeholder="map-pin">
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end text-end">
                                            <button type="button" class="btn btn-sm btn-white border shadow-sm w-100 py-2 text-danger hover-lift" onclick="this.closest('.timeline-item-row').remove()">
                                                <i data-lucide="trash-2" class="icon-sm me-1"></i> Hapus
                                            </button>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label class="small fw-bold text-muted">Rekam Jejak / Keterangan</label>
                                            <textarea name="sejarah_timeline[{{ $index }}][desc]" class="form-control rounded-3" rows="3">{{ $item['desc'] }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 2: Visi & Misi -->
                <div class="tab-pane fade" id="visimisi" role="tabpanel">
                    <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden border-top border-4 border-success">
                        <div class="card-body p-4 p-md-5">
                            <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="image" class="text-success me-3"></i> Header Halaman Visi Misi</h5>
                            <div class="row g-3 mb-5 p-3 bg-light rounded-4">
                                <div class="col-md-4">
                                    <label class="small fw-bold text-muted">Judul Halaman</label>
                                    <input type="text" name="hero_visimisi[title]" class="form-control rounded-3" value="{{ $hero_visimisi['title'] ?? '' }}">
                                </div>
                                <div class="col-md-5">
                                    <label class="small fw-bold text-muted">Sub-Judul</label>
                                    <input type="text" name="hero_visimisi[subtitle]" class="form-control rounded-3" value="{{ $hero_visimisi['subtitle'] ?? '' }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="small fw-bold text-muted">Ikon (Lucide)</label>
                                    <input type="text" name="hero_visimisi[icon]" class="form-control rounded-3" value="{{ $hero_visimisi['icon'] ?? 'target' }}">
                                </div>
                            </div>

                            <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="rocket" class="text-success me-3"></i> Visi Desa</h5>
                            <div class="row mb-5 g-4 border-bottom pb-5">
                                <div class="col-md-4">
                                    <label class="form-label text-muted small fw-bold">Semboyan / Motto (Capital)</label>
                                    <input type="text" name="motto" class="form-control rounded-3 border-2 border-success border-opacity-25 py-2 fw-bold" value="{{ old('motto', $profil->motto) }}" placeholder="SATATA GAMA KARTA RAHARJA">
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label text-muted small fw-bold">Pernyataan Visi Utama</label>
                                    <textarea name="visi" class="form-control rounded-4 p-3" rows="3" placeholder='Pernyataan visi komprehensif desa...'>{{ old('visi', $profil->visi) }}</textarea>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="fw-bold mb-0 d-flex align-items-center"><i data-lucide="check-square" class="text-success me-3"></i> Poin-Poin Misi</h5>
                                <button type="button" class="btn btn-sm btn-success rounded-pill px-4 shadow-sm border-0" onclick="addRow('misi-container', 'misi-template')">
                                    <i data-lucide="plus" class="icon-sm me-1"></i> Tambah Misi
                                </button>
                            </div>

                            <div id="misi-container">
                                @php $misi = $profil->misi ?? []; @endphp
                                @foreach($misi as $index => $item)
                                <div class="misi-item-row p-4 rounded-4 mb-3 border border-light shadow-sm hover-lift bg-white position-relative">
                                    <div class="row g-3">
                                        <div class="col-md-2">
                                            <label class="small fw-bold text-muted">Ikon Poin</label>
                                            <input type="text" name="misi[{{ $index }}][icon]" class="form-control rounded-3" value="{{ $item['icon'] }}" placeholder="chevron-right">
                                        </div>
                                        <div class="col-md-9">
                                            <label class="small fw-bold text-muted">Pernyataan Misi</label>
                                            <input type="text" name="misi[{{ $index }}][text]" class="form-control rounded-3 border-success border-opacity-10" value="{{ $item['text'] }}">
                                        </div>
                                        <div class="col-md-1 d-flex align-items-end text-end">
                                            <button type="button" class="btn btn-sm btn-white border border-danger text-danger rounded-pill shadow-sm" onclick="this.closest('.misi-item-row').remove()"><i data-lucide="trash-2" class="icon-sm"></i></button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 3: Geografis -->
                <div class="tab-pane fade" id="geografi" role="tabpanel">
                    <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden border-top border-4 border-success">
                        <div class="card-body p-4 p-md-5">
                            <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="image" class="text-success me-3"></i> Header Halaman Geografis</h5>
                            <div class="row g-3 mb-5 p-3 bg-light rounded-4">
                                <div class="col-md-4">
                                    <label class="small fw-bold text-muted">Judul Halaman</label>
                                    <input type="text" name="hero_geografi[title]" class="form-control rounded-3" value="{{ $hero_geografi['title'] ?? '' }}">
                                </div>
                                <div class="col-md-5">
                                    <label class="small fw-bold text-muted">Sub-Judul</label>
                                    <input type="text" name="hero_geografi[subtitle]" class="form-control rounded-3" value="{{ $hero_geografi['subtitle'] ?? '' }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="small fw-bold text-muted">Ikon (Lucide)</label>
                                    <input type="text" name="hero_geografi[icon]" class="form-control rounded-3" value="{{ $hero_geografi['icon'] ?? 'mountain' }}">
                                </div>
                            </div>

                            <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="alert-circle" class="text-success me-3"></i> Gambaran Umum Topografi</h5>
                            <div class="mb-5">
                                <textarea name="geografi" class="form-control rounded-4 shadow-none p-4" rows="8">{{ old('geografi', $profil->geografi) }}</textarea>
                            </div>

                            <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="layout-grid" class="text-success me-3"></i> Parameter Fisik Wilayah</h5>
                            <div class="row g-4 mb-5 border-bottom pb-5 text-center">
                                @php $stats = $profil->geografi_stats ?? []; @endphp
                                @for($i = 0; $i < 4; $i++)
                                <div class="col-md-3">
                                    <div class="p-4 border shadow-sm rounded-4 bg-white hover-lift">
                                        <div class="mb-3">
                                            <label class="d-block small fw-bold text-muted mb-2">Ikon {{ $i+1 }}</label>
                                            <input type="text" name="geografi_stats[{{ $i }}][icon]" class="form-control form-control-sm text-center border-success border-opacity-25" value="{{ $stats[$i]['icon'] ?? '' }}" placeholder="mountain">
                                        </div>
                                        <div class="mb-3">
                                            <label class="d-block small fw-bold text-muted mb-2">Nilai / Angka</label>
                                            <input type="text" name="geografi_stats[{{ $i }}][value]" class="form-control form-control-sm text-center fw-bold text-success" value="{{ $stats[$i]['value'] ?? '' }}" placeholder="1.200 mdpl">
                                        </div>
                                        <div>
                                            <label class="d-block small fw-bold text-muted mb-2">Label Informasi</label>
                                            <input type="text" name="geografi_stats[{{ $i }}][label]" class="form-control form-control-sm text-center" value="{{ $stats[$i]['label'] ?? '' }}" placeholder="Kapasitas...">
                                        </div>
                                    </div>
                                </div>
                                @endfor
                            </div>

                            <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="compass" class="text-success me-3"></i> Batas Wilayah Astronomis/Geografis</h5>
                            <div class="row g-3 mb-5 border-bottom pb-5">
                                @php $batas = $profil->batas_wilayah_json ?? []; @endphp
                                @foreach(['Utara', 'Selatan', 'Timur', 'Barat'] as $idx => $dir)
                                <div class="col-md-6">
                                    <div class="p-4 border shadow-sm rounded-4 bg-light border-success border-opacity-10">
                                        <div class="row align-items-center g-3">
                                            <div class="col-3 text-center border-end">
                                                <div class="fw-bold text-success mb-2">{{ $dir }}</div>
                                                <input type="hidden" name="batas_wilayah_json[{{ $idx }}][dir]" value="{{ $dir }}">
                                                <input type="hidden" name="batas_wilayah_json[{{ $idx }}][icon]" value="compass">
                                                <div class="small text-muted mb-1 mt-1">Rotasi</div>
                                                <input type="text" name="batas_wilayah_json[{{ $idx }}][rotate]" class="form-control form-control-sm text-center" value="{{ $batas[$idx]['rotate'] ?? '0' }}">
                                            </div>
                                            <div class="col-9 ps-4">
                                                <label class="small fw-bold text-muted mb-2">Administrasi Perbatasan</label>
                                                <input type="text" name="batas_wilayah_json[{{ $idx }}][text]" class="form-control rounded-3 border-0 py-2 shadow-sm" value="{{ $batas[$idx]['text'] ?? '' }}" placeholder="Berbatasan dengan Desa...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="users" class="text-success me-3"></i> Struktur Wilayah Dusun</h5>
                            <div class="row g-4">
                                @php $dusuns = collect($profil->dusun_info ?? [])->pad(3, ['nama' => '', 'geografi_desc' => '', 'peta_desc' => '', 'admin_rw' => '', 'admin_rt' => '', 'color_theme' => 'success']); @endphp
                                @foreach($dusuns as $idx => $dsn)
                                <div class="col-12">
                                    <div class="p-4 shadow-sm border border-light rounded-4 bg-white hover-lift">
                                        <div class="row g-4 align-items-start">
                                            <div class="col-md-4 border-end pe-md-4">
                                                <div class="mb-4">
                                                    <label class="small fw-bold text-muted mb-2">Identitas Dusun</label>
                                                    <input type="text" name="dusun_info[{{ $idx }}][nama]" class="form-control rounded-3 border-success border-opacity-25 fw-bold text-success py-2" value="{{ $dsn['nama'] }}" placeholder="Nama Dusun">
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col-6">
                                                        <label class="small fw-bold text-muted mb-1">Total RW</label>
                                                        <div class="input-group input-group-sm">
                                                            <span class="input-group-text bg-white border-end-0"><i data-lucide="layers" class="icon-xs"></i></span>
                                                            <input type="text" name="dusun_info[{{ $idx }}][admin_rw]" class="form-control rounded-3 border-start-0" value="{{ $dsn['admin_rw'] }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="small fw-bold text-muted mb-1">Total RT</label>
                                                        <div class="input-group input-group-sm">
                                                            <span class="input-group-text bg-white border-end-0"><i data-lucide="users" class="icon-xs"></i></span>
                                                            <input type="text" name="dusun_info[{{ $idx }}][admin_rt]" class="form-control rounded-3 border-start-0" value="{{ $dsn['admin_rt'] }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8 ps-md-4">
                                                <div class="mb-4">
                                                    <label class="small fw-bold text-muted mb-2">Narasi Geografis Tingkat Dusun</label>
                                                    <textarea name="dusun_info[{{ $idx }}][geografi_desc]" class="form-control rounded-3 bg-light border-0" rows="3" placeholder="Jelaskan kondisi alam dusun ini...">{{ $dsn['geografi_desc'] }}</textarea>
                                                </div>
                                                <div>
                                                    <label class="small fw-bold text-muted mb-2">Detail Lokasi pada Peta</label>
                                                    <textarea name="dusun_info[{{ $idx }}][peta_desc]" class="form-control rounded-3 bg-light border-0" rows="2" placeholder="Letak relatif (Pojok utara, dekat hutan, dsb)">{{ $dsn['peta_desc'] }}</textarea>
                                                </div>
                                            </div>
                                            <input type="hidden" name="dusun_info[{{ $idx }}][color_theme]" value="{{ $dsn['color_theme'] ?? 'success' }}">
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 4: Peta & Akses -->
                <div class="tab-pane fade" id="peta" role="tabpanel">
                    <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden border-top border-4 border-success">
                        <div class="card-body p-4 p-md-5">
                            <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="image" class="text-success me-3"></i> Header Halaman Peta</h5>
                            <div class="row g-3 mb-5 p-3 bg-light rounded-4">
                                <div class="col-md-4">
                                    <label class="small fw-bold text-muted">Judul Halaman</label>
                                    <input type="text" name="hero_peta[title]" class="form-control rounded-3" value="{{ $hero_peta['title'] ?? '' }}">
                                </div>
                                <div class="col-md-5">
                                    <label class="small fw-bold text-muted">Sub-Judul</label>
                                    <input type="text" name="hero_peta[subtitle]" class="form-control rounded-3" value="{{ $hero_peta['subtitle'] ?? '' }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="small fw-bold text-muted">Ikon (Lucide)</label>
                                    <input type="text" name="hero_peta[icon]" class="form-control rounded-3" value="{{ $hero_peta['icon'] ?? 'map' }}">
                                </div>
                            </div>

                            <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="map-pin" class="text-success me-3"></i> Integrasi Peta Digital</h5>
                            <div class="row g-4 mb-5 border-bottom pb-5">
                                <div class="col-md-7">
                                    <label class="form-label text-muted small fw-bold">Link Iframe Google Maps (Embed HTML)</label>
                                    <textarea name="peta_embed" class="form-control rounded-4 shadow-none p-3 border-success border-opacity-10" rows="6" placeholder='<iframe src="https://google.com/maps/embed...'>{{ old('peta_embed', $profil->peta_embed) }}</textarea>
                                    <div class="text-muted small mt-3 fw-medium d-flex align-items-center">
                                        <i data-lucide="help-circle" class="icon-xs text-primary me-2"></i> Klik Bagikan > Sematkan pada Google Maps untuk mendapatkan kode ini.
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label text-muted small fw-bold">Unggah Citra Peta Administratif</label>
                                    <div class="p-3 border rounded-4 bg-light text-center">
                                        @if($profil->peta_image)
                                            <img src="{{ asset($profil->peta_image) }}" class="img-thumbnail rounded-4 shadow-sm mb-3" style="max-height: 200px; width: 100%; object-fit: contain;">
                                        @else
                                            <div class="bg-white rounded-4 border border-dashed py-5 mb-3">
                                                <i data-lucide="image" class="text-muted opacity-25" style="width:48px;height:48px;"></i>
                                            </div>
                                        @endif
                                        <input type="file" name="peta_image" class="form-control rounded-pill border-0 shadow-sm" accept="image/*">
                                        <small class="text-muted mt-3 d-block italic fw-medium">Direkomendasikan rasio 16:9 (High Res)</small>
                                    </div>
                                </div>
                            </div>
                            
                            <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="info" class="text-success me-3"></i> Deskripsi & Legenda Wilayah</h5>
                            <div class="row g-4 mb-5 border-bottom pb-5">
                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-bold">Keterangan Utama Peta Wilayah</label>
                                    <textarea name="peta_narasi_utama" class="form-control rounded-4 p-3" rows="5" placeholder="Gambarkan luas dan pembagian dasarnya...">{{ old('peta_narasi_utama', $profil->peta_narasi_utama) }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-bold">Legenda / Klasifikasi Lahan</label>
                                    <textarea name="peta_narasi_legenda" class="form-control rounded-4 p-3 border-success border-opacity-10" rows="5" placeholder="Misal: Kuning perumahan, Hijau perkebunan jeruk...">{{ old('peta_narasi_legenda', $profil->peta_narasi_legenda) }}</textarea>
                                </div>
                            </div>

                            <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="route" class="text-success me-3"></i> Aksesibilitas Desa</h5>
                            <div class="row g-4 mb-5">
                                <div class="col-md-6">
                                    <div class="p-4 border shadow-sm rounded-4 bg-white border-start border-4 border-primary">
                                        <label class="form-label small fw-bold text-primary mb-3"><i data-lucide="car-front" class="me-2 icon-sm"></i> JALUR KENDARAAN PRIBADI</label>
                                        <textarea name="peta_rute_pribadi" class="form-control border-0 bg-light rounded-3" rows="4">{{ old('peta_rute_pribadi', $profil->peta_rute_pribadi) }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-4 border shadow-sm rounded-4 bg-white border-start border-4 border-warning">
                                        <label class="form-label small fw-bold text-warning mb-3"><i data-lucide="bus-front" class="me-2 icon-sm"></i> TRANSPORTASI UMUM</label>
                                        <textarea name="peta_rute_umum" class="form-control border-0 bg-light rounded-3" rows="4">{{ old('peta_rute_umum', $profil->peta_rute_umum) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4 pt-4 border-top">
                                <h5 class="fw-bold mb-0 d-flex align-items-center"><i data-lucide="hospital-building" class="text-success me-3"></i> Objek Vital & Fasilitas Umum</h5>
                                <button type="button" class="btn btn-sm btn-success rounded-pill px-4 shadow-sm border-0" onclick="addRow('fasilitas-container', 'fasilitas-template')">
                                    <i data-lucide="plus" class="icon-sm me-1"></i> Tambah Lokasi
                                </button>
                            </div>

                            <div id="fasilitas-container" class="row">
                                @php $fasilitas = collect($profil->peta_fasilitas ?? [])->pad(1, ['icon' => 'check-circle', 'text' => '']); @endphp
                                @foreach($fasilitas as $index => $item)
                                <div class="col-md-6 mb-3 fasilitas-item-row">
                                    <div class="p-4 border shadow-sm rounded-4 bg-light border-success border-opacity-10 position-relative">
                                        <div class="row g-3">
                                            <div class="col-3">
                                                <label class="small fw-bold text-muted mb-1">Ikon</label>
                                                <input type="text" name="peta_fasilitas[{{ $index }}][icon]" class="form-control text-center rounded-3 bg-white" value="{{ $item['icon'] }}" placeholder="building">
                                            </div>
                                            <div class="col-7">
                                                <label class="small fw-bold text-muted mb-1">Nama Fasilitas</label>
                                                <input type="text" name="peta_fasilitas[{{ $index }}][text]" class="form-control rounded-3 border-0 shadow-sm" value="{{ $item['text'] }}" placeholder="Kantor Desa, Masjid...">
                                            </div>
                                            <div class="col-2 d-flex align-items-end text-end">
                                                <button type="button" class="btn btn-sm btn-white border shadow-sm text-danger h-100 w-100 rounded-3 hover-lift" onclick="this.closest('.fasilitas-item-row').remove()"><i data-lucide="trash-2" class="icon-sm"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Global Submit -->
            <div class="card border-0 shadow-lg rounded-4 mb-5 mt-4 p-2 bg-success bg-opacity-10 header-gradient border-top border-4 border-success">
                <div class="card-body p-4 p-md-5 text-center">
                    <div class="bg-white d-inline-block p-4 rounded-circle mb-4 shadow-sm border border-success border-opacity-25">
                        <i data-lucide="send" class="text-success" style="width:40px; height:40px;"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-3">Finalisasi Perubahan Profil</h4>
                    <p class="text-muted mb-4 mx-auto" style="max-width: 600px;">Seluruh data profil mulai dari Sejarah hingga Peta Wilayah akan diperbarui secara real-time pada halaman publik Desa Selorejo.</p>
                    
                    <button type="submit" class="btn btn-success px-5 py-3 rounded-pill fw-bold hover-lift shadow border-0" style="font-size:1.1rem;">
                        <i data-lucide="save" class="me-2"></i> SIMPAN & PUBLIKASIKAN
                    </button>
                    
                    <div class="mt-4 d-flex justify-content-center gap-4 text-muted small fw-medium">
                        <span class="d-flex align-items-center"><i data-lucide="shield-check" class="icon-xs me-1 text-success"></i> Auto-verified</span>
                        <span class="d-flex align-items-center"><i data-lucide="clock" class="icon-xs me-1 text-success"></i> Real-time sync</span>
                        <span class="d-flex align-items-center"><i data-lucide="globe" class="icon-xs me-1 text-success"></i> LIVE on Web</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Better Templates for Dynamic Rows -->

<!-- Template Header for Sejarah Timeline -->
<div id="timeline-template" class="d-none">
    <div class="timeline-item-row dash-card p-4 rounded-4 mb-4 border border-success border-opacity-10 position-relative">
        <div class="row g-3">
            <div class="col-md-2">
                <label class="small fw-bold text-muted">Era/Tahun</label>
                <input type="text" name="sejarah_timeline[INDEX][year]" class="form-control rounded-3 border-success border-opacity-25" placeholder="19xx">
            </div>
            <div class="col-md-5">
                <label class="small fw-bold text-muted">Nama Peristiwa</label>
                <input type="text" name="sejarah_timeline[INDEX][title]" class="form-control rounded-3" placeholder="Judul singkat">
            </div>
            <div class="col-md-3">
                <label class="small fw-bold text-muted">Ikon Visual</label>
                <input type="text" name="sejarah_timeline[INDEX][icon]" class="form-control rounded-3" value="milestone">
            </div>
            <div class="col-md-2 d-flex align-items-end text-end">
                <button type="button" class="btn btn-sm btn-white border shadow-sm w-100 py-2 text-danger" onclick="this.closest('.timeline-item-row').remove()"><i data-lucide="trash-2" class="icon-sm"></i></button>
            </div>
            <div class="col-12 mt-3">
                <label class="small fw-bold text-muted">Rekam Jejak / Keterangan</label>
                <textarea name="sejarah_timeline[INDEX][desc]" class="form-control rounded-3" rows="3"></textarea>
            </div>
        </div>
    </div>
</div>

<!-- Template Header for Misi -->
<div id="misi-template" class="d-none">
    <div class="misi-item-row p-4 rounded-4 mb-3 border border-light shadow-sm bg-white position-relative">
        <div class="row g-3">
            <div class="col-md-2">
                <label class="small fw-bold text-muted">Ikon Poin</label>
                <input type="text" name="misi[INDEX][icon]" class="form-control rounded-3" value="chevron-right">
            </div>
            <div class="col-md-9">
                <label class="small fw-bold text-muted">Pernyataan Misi</label>
                <input type="text" name="misi[INDEX][text]" class="form-control rounded-3 border-success border-opacity-10">
            </div>
            <div class="col-md-1 d-flex align-items-end text-end">
                <button type="button" class="btn btn-sm btn-white border border-danger text-danger rounded-pill shadow-sm" onclick="this.closest('.misi-item-row').remove()"><i data-lucide="trash-2" class="icon-sm"></i></button>
            </div>
        </div>
    </div>
</div>

<!-- Template Header for Fasilitas -->
<div id="fasilitas-template" class="d-none">
    <div class="col-md-6 mb-3 fasilitas-item-row">
        <div class="p-4 border shadow-sm rounded-4 bg-light border-success border-opacity-10 position-relative">
            <div class="row g-3">
                <div class="col-3">
                    <label class="small fw-bold text-muted mb-1">Ikon</label>
                    <input type="text" name="peta_fasilitas[INDEX][icon]" class="form-control text-center rounded-3 bg-white" value="check-circle" placeholder="building">
                </div>
                <div class="col-7">
                    <label class="small fw-bold text-muted mb-1">Nama Fasilitas</label>
                    <input type="text" name="peta_fasilitas[INDEX][text]" class="form-control rounded-3 border-0 shadow-sm" placeholder="Masukan nama fasilitas...">
                </div>
                <div class="col-2 d-flex align-items-end text-end">
                    <button type="button" class="btn btn-sm btn-white border shadow-sm text-danger h-100 w-100 rounded-3" onclick="this.closest('.fasilitas-item-row').remove()"><i data-lucide="trash-2" class="icon-sm"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function addRow(containerId, templateId) {
        const container = document.getElementById(containerId);
        const template = document.getElementById(templateId).innerHTML;
        const index = container.children.length; // Use simple counter
        
        const html = template.replace(/INDEX/g, Date.now()); // Use timestamp for unique keys in dynamic adding
        container.insertAdjacentHTML('beforeend', html);
        
        // Refresh icons
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }
</script>
@endpush
