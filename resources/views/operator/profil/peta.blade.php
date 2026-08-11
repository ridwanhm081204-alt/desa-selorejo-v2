@extends('layouts.dashboard')
@section('title', 'Kelola Peta & Wilayah')
@section('content')

@php use App\Models\PetaTitik; @endphp

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

        <form action="{{ url('/operator/profil') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="origin_tab" value="peta">
            
            @php
                $hero_peta = $profil->hero_peta ?? ['title' => 'Peta Wilayah Desa', 'subtitle' => 'Penunjuk arah digital...', 'icon' => 'map'];
            @endphp

            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden border-top border-4 border-success">
                <div class="card-body p-4 p-md-5">
                    
                    <!-- Notice Banner -->
                    <div class="alert alert-success d-flex align-items-center mb-5 border-0 shadow-sm rounded-4" style="background-color: var(--color-forest, #2e7d32); color: #fff;">
                        <i data-lucide="map" class="me-3 flex-shrink-0" style="width: 32px; height: 32px;"></i>
                        <div>
                            <h6 class="fw-bold mb-1 text-white">Pusat Pengelolaan Peta &amp; Geospasial Desa Selorejo</h6>
                            <p class="mb-0 small" style="color: rgba(255,255,255,0.95);">
                                Kelola header halaman, Google Maps embed, rute aksesibilitas desa, serta update metadata 3 lembar peta resmi (Peta Batas Desa, Peta Destinasi Wisata, &amp; Peta Persebaran UMKM) beserta titik lokasinya secara real-time.
                            </p>
                        </div>
                    </div>

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

                    <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="map-pin" class="text-success me-3"></i> Integrasi Google Maps</h5>
                    <div class="row g-4 mb-5 border-bottom pb-5">
                        <div class="col-12">
                            <label class="form-label text-muted small fw-bold">Link Iframe Google Maps (Embed HTML)</label>
                            <textarea name="peta_embed" class="form-control rounded-4 shadow-none p-3 border-success border-opacity-10" rows="5" placeholder='<iframe src="https://google.com/maps/embed...'>{{ old('peta_embed', $profil->peta_embed) }}</textarea>
                            <div class="text-muted small mt-3 fw-medium d-flex align-items-center">
                                <i data-lucide="help-circle" class="icon-xs text-primary me-2"></i> Klik Bagikan &gt; Sematkan pada Google Maps untuk mendapatkan kode ini.
                            </div>
                        </div>
                    </div>
                    
                    <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="route" class="text-success me-3"></i> Aksesibilitas Desa</h5>
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="p-4 border shadow-sm rounded-4 bg-white border-start border-4 border-primary h-100">
                                <label class="form-label small fw-bold text-primary mb-3"><i data-lucide="car-front" class="me-2 icon-sm"></i> JALUR KENDARAAN PRIBADI</label>
                                <textarea name="peta_rute_pribadi" class="form-control border-0 bg-light rounded-3 rich-text" rows="4">{{ old('peta_rute_pribadi', $profil->peta_rute_pribadi) }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-4 border shadow-sm rounded-4 bg-white border-start border-4 border-warning h-100">
                                <label class="form-label small fw-bold text-warning mb-3"><i data-lucide="bus-front" class="me-2 icon-sm"></i> TRANSPORTASI UMUM</label>
                                <textarea name="peta_rute_umum" class="form-control border-0 bg-light rounded-3 rich-text" rows="4">{{ old('peta_rute_umum', $profil->peta_rute_umum) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end pt-3 border-top">
                        <button type="submit" class="btn btn-success px-4 py-2.5 rounded-pill fw-bold hover-lift shadow-sm border-0">
                            <i data-lucide="save" class="me-1.5"></i> Simpan Informas Header &amp; Aksesibilitas
                        </button>
                    </div>
                </div>
            </div>
        </form>

        {{-- ══════════════════════════════════════════════════════════
             PANEL 1 — KELOLA PETA BATAS DESA RESMI
             ══════════════════════════════════════════════════════════ --}}
        @php $petaBatas = $petaDokumens['batas-desa'] ?? null; @endphp
        @if($petaBatas)
        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden border-top border-4 border-primary">
            <div class="card-body p-4 p-md-5">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="rounded-3 p-2 d-flex align-items-center justify-content-center bg-primary" style="width:40px;height:40px;">
                        <i data-lucide="landmark" style="width:20px;height:20px;color:#fff;"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">Metadata &amp; Dokumen Peta Batas Desa</h5>
                        <small class="text-muted">Kelola gambar peta resmi dan informasi kartometrik Peta Batas Desa</small>
                    </div>
                </div>

                <form action="{{ route('operator.peta-dokumen.update', 'batas-desa') }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="p-4 rounded-4 bg-light mb-3">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small fw-bold text-muted">Judul Peta</label>
                                <input type="text" name="judul" class="form-control rounded-3" value="{{ $petaBatas->judul }}">
                            </div>
                            <div class="col-md-3">
                                <label class="small fw-bold text-muted">Skala</label>
                                <input type="text" name="skala" class="form-control rounded-3" value="{{ $petaBatas->skala }}">
                            </div>
                            <div class="col-md-3">
                                <label class="small fw-bold text-muted">Sistem Koordinat</label>
                                <input type="text" name="sistem_koordinat" class="form-control rounded-3" value="{{ $petaBatas->sistem_koordinat }}">
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-bold text-muted">Sumber Data</label>
                                <textarea name="sumber_data" class="form-control rounded-3" rows="2">{{ $petaBatas->sumber_data }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-bold text-muted">Dibuat Oleh</label>
                                <input type="text" name="dibuat_oleh" class="form-control rounded-3" value="{{ $petaBatas->dibuat_oleh }}">
                            </div>
                            
                            <div class="col-md-4">
                                <label class="small fw-bold text-muted">Proyeksi</label>
                                <input type="text" name="proyeksi" class="form-control rounded-3" value="{{ $petaBatas->proyeksi }}">
                            </div>
                            <div class="col-md-4">
                                <label class="small fw-bold text-muted">Datum</label>
                                <input type="text" name="datum" class="form-control rounded-3" value="{{ $petaBatas->datum }}">
                            </div>
                            <div class="col-md-4">
                                <label class="small fw-bold text-muted">Sistem Grid</label>
                                <input type="text" name="sistem_grid" class="form-control rounded-3" value="{{ $petaBatas->sistem_grid }}">
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-bold text-muted">Zona UTM</label>
                                <input type="text" name="zona_utm" class="form-control rounded-3" value="{{ $petaBatas->zona_utm }}">
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-bold text-muted">Metode Pemetaan</label>
                                <input type="text" name="metode_pemetaan" class="form-control rounded-3" value="{{ $petaBatas->metode_pemetaan }}">
                            </div>
                            <div class="col-12 mt-3">
                                <h6 class="fw-bold text-muted mb-2"><i data-lucide="compass" style="width:14px;height:14px;" class="me-1"></i> Cakupan Koordinat Ekstrem (Batas Luar)</h6>
                                <div class="row g-2">
                                    <div class="col-md-3">
                                        <label class="small text-muted">Utara (mU)</label>
                                        <input type="text" name="koordinat_utara" class="form-control form-control-sm rounded-2" value="{{ $petaBatas->koordinat_utara }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="small text-muted">Selatan (mU)</label>
                                        <input type="text" name="koordinat_selatan" class="form-control form-control-sm rounded-2" value="{{ $petaBatas->koordinat_selatan }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="small text-muted">Timur (mT)</label>
                                        <input type="text" name="koordinat_timur" class="form-control form-control-sm rounded-2" value="{{ $petaBatas->koordinat_timur }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="small text-muted">Barat (mT)</label>
                                        <input type="text" name="koordinat_barat" class="form-control form-control-sm rounded-2" value="{{ $petaBatas->koordinat_barat }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <label class="small fw-bold text-muted">Ganti File Gambar Peta Batas Desa (maks. 10MB)</label>
                                @if($petaBatas->file_path)
                                    <div class="mb-2">
                                        <img src="{{ $petaBatas->file_url }}" alt="Preview" class="rounded-3 border" style="max-height:80px;object-fit:cover;">
                                        <small class="text-muted ms-2">File saat ini</small>
                                    </div>
                                @endif
                                <input type="file" name="file_peta" class="form-control rounded-3" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary rounded-pill fw-bold px-4">
                        <i data-lucide="save" style="width:14px;height:14px;" class="me-1"></i> Simpan Peta Batas Desa
                    </button>
                </form>
            </div>
        </div>
        @endif

        {{-- ══════════════════════════════════════════════════════════
             PANEL B — KELOLA PETA DESTINASI WISATA DESA
             ══════════════════════════════════════════════════════════ --}}
        @php $petaWisata = $petaDokumens['destinasi-wisata'] ?? null; @endphp
        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden border-top border-4" style="border-color:#ff9800!important;">
            <div class="card-body p-4 p-md-5">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="rounded-3 p-2 d-flex align-items-center justify-content-center" style="background:#ff9800;width:40px;height:40px;">
                        <i data-lucide="map-pin" style="width:20px;height:20px;color:#fff;"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">Peta Destinasi Wisata Desa</h5>
                        <small class="text-muted">Kelola gambar peta dan {{ $petaTitikStats['unggulan'] }} destinasi wisata unggulan</small>
                    </div>
                </div>

                {{-- Form update metadata & gambar --}}
                @if($petaWisata)
                <form action="{{ route('operator.peta-dokumen.update', 'destinasi-wisata') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                    @csrf @method('PUT')
                    <div class="p-4 rounded-4 bg-light mb-3">
                        <h6 class="fw-bold mb-3 text-muted"><i data-lucide="settings" style="width:14px;height:14px;" class="me-1"></i> Metadata Peta</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small fw-bold text-muted">Judul Peta</label>
                                <input type="text" name="judul" class="form-control rounded-3" value="{{ $petaWisata->judul }}">
                            </div>
                            <div class="col-md-3">
                                <label class="small fw-bold text-muted">Skala</label>
                                <input type="text" name="skala" class="form-control rounded-3" value="{{ $petaWisata->skala }}">
                            </div>
                            <div class="col-md-3">
                                <label class="small fw-bold text-muted">Sistem Koordinat</label>
                                <input type="text" name="sistem_koordinat" class="form-control rounded-3" value="{{ $petaWisata->sistem_koordinat }}">
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-bold text-muted">Sumber Data</label>
                                <textarea name="sumber_data" class="form-control rounded-3" rows="2">{{ $petaWisata->sumber_data }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-bold text-muted">Dibuat Oleh</label>
                                <input type="text" name="dibuat_oleh" class="form-control rounded-3" value="{{ $petaWisata->dibuat_oleh }}">
                            </div>
                            
                            <div class="col-md-4">
                                <label class="small fw-bold text-muted">Proyeksi</label>
                                <input type="text" name="proyeksi" class="form-control rounded-3" value="{{ $petaWisata->proyeksi }}">
                            </div>
                            <div class="col-md-4">
                                <label class="small fw-bold text-muted">Datum</label>
                                <input type="text" name="datum" class="form-control rounded-3" value="{{ $petaWisata->datum }}">
                            </div>
                            <div class="col-md-4">
                                <label class="small fw-bold text-muted">Sistem Grid</label>
                                <input type="text" name="sistem_grid" class="form-control rounded-3" value="{{ $petaWisata->sistem_grid }}">
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-bold text-muted">Zona UTM</label>
                                <input type="text" name="zona_utm" class="form-control rounded-3" value="{{ $petaWisata->zona_utm }}">
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-bold text-muted">Metode Pemetaan</label>
                                <input type="text" name="metode_pemetaan" class="form-control rounded-3" value="{{ $petaWisata->metode_pemetaan }}">
                            </div>
                            <div class="col-12 mt-3">
                                <h6 class="fw-bold text-muted mb-2"><i data-lucide="compass" style="width:14px;height:14px;" class="me-1"></i> Cakupan Koordinat Ekstrem (Batas Luar)</h6>
                                <div class="row g-2">
                                    <div class="col-md-3">
                                        <label class="small text-muted">Utara (mU)</label>
                                        <input type="text" name="koordinat_utara" class="form-control form-control-sm rounded-2" value="{{ $petaWisata->koordinat_utara }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="small text-muted">Selatan (mU)</label>
                                        <input type="text" name="koordinat_selatan" class="form-control form-control-sm rounded-2" value="{{ $petaWisata->koordinat_selatan }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="small text-muted">Timur (mT)</label>
                                        <input type="text" name="koordinat_timur" class="form-control form-control-sm rounded-2" value="{{ $petaWisata->koordinat_timur }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="small text-muted">Barat (mT)</label>
                                        <input type="text" name="koordinat_barat" class="form-control form-control-sm rounded-2" value="{{ $petaWisata->koordinat_barat }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <label class="small fw-bold text-muted">Ganti File Gambar Peta (maks. 10MB)</label>
                                @if($petaWisata->file_path)
                                    <div class="mb-2">
                                        <img src="{{ $petaWisata->file_url }}" alt="Preview" class="rounded-3 border" style="max-height:80px;object-fit:cover;">
                                        <small class="text-muted ms-2">File saat ini</small>
                                    </div>
                                @endif
                                <input type="file" name="file_peta" class="form-control rounded-3" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm rounded-pill fw-bold px-4" style="background:#ff9800;color:#fff;border:none;">
                        <i data-lucide="save" style="width:14px;height:14px;" class="me-1"></i> Simpan Peta Destinasi Wisata
                    </button>
                </form>
                @endif

                {{-- Daftar destinasi wisata unggulan --}}
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="fw-bold mb-0">Destinasi Wisata Unggulan <span class="badge rounded-pill ms-1" style="background:rgba(255,152,0,0.15);color:#e65100;">{{ $petaTitikStats['unggulan'] }}</span></h6>
                    <a href="{{ route('operator.peta-titik.create') }}" class="btn btn-sm rounded-pill fw-bold" style="background:#ff9800;color:#fff;border:none;">
                        <i data-lucide="plus" style="width:14px;height:14px;" class="me-1"></i> Tambah Destinasi
                    </a>
                </div>

                @php $unggulanList = \App\Models\PetaTitik::where('is_wisata_unggulan', true)->orderBy('urutan_tampil')->orderBy('nama')->get(); @endphp

                @if($unggulanList->isEmpty())
                    <div class="text-center py-4 text-muted border rounded-4">
                        <i data-lucide="map-pin-off" style="width:32px;height:32px;opacity:0.3;" class="mb-2"></i>
                        <p class="mb-0 small">Belum ada destinasi wisata unggulan. Tambahkan titik baru atau tandai titik yang sudah ada sebagai unggulan.</p>
                    </div>
                @else
                    <div class="table-responsive rounded-4 border">
                        <table class="table table-hover mb-0 align-middle" style="font-size:0.85rem;">
                            <thead style="background:rgba(255,152,0,0.08);">
                                <tr>
                                    <th class="border-0 fw-bold text-muted" style="font-size:0.72rem;letter-spacing:0.5px;">#</th>
                                    <th class="border-0 fw-bold text-muted" style="font-size:0.72rem;letter-spacing:0.5px;">NAMA</th>
                                    <th class="border-0 fw-bold text-muted" style="font-size:0.72rem;letter-spacing:0.5px;">DUSUN</th>
                                    <th class="border-0 fw-bold text-muted" style="font-size:0.72rem;letter-spacing:0.5px;">KATEGORI</th>
                                    <th class="border-0 fw-bold text-muted" style="font-size:0.72rem;letter-spacing:0.5px;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($unggulanList as $t)
                                <tr>
                                    <td class="text-muted">{{ $loop->iteration }}</td>
                                    <td class="fw-semibold">{{ $t->nama }}</td>
                                    <td><span class="badge rounded-pill bg-light text-dark border">Dusun {{ ucfirst($t->dusun) }}</span></td>
                                    <td><small class="text-muted">{{ $t->kategori_label }}</small></td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('operator.peta-titik.edit', $t->id) }}" class="btn btn-sm btn-outline-secondary rounded-pill" style="font-size:0.72rem;">
                                                <i data-lucide="pencil" style="width:12px;height:12px;"></i>
                                            </a>
                                            <form action="{{ route('operator.peta-titik.toggle-unggulan', $t->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm rounded-pill" style="background:rgba(255,152,0,0.15);color:#e65100;font-size:0.72rem;" title="Hapus dari unggulan">
                                                    <i data-lucide="star-off" style="width:12px;height:12px;"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('operator.peta-titik.destroy', $t->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus destinasi ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill" style="font-size:0.72rem;">
                                                    <i data-lucide="trash-2" style="width:12px;height:12px;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- ══════════════════════════════════════════════════════════
             PANEL A — KELOLA PETA KAWASAN WISATA & UMKM
             ══════════════════════════════════════════════════════════ --}}
        @php $petaUmkm = $petaDokumens['kawasan-wisata-umkm'] ?? null; @endphp
        <div class="card border-0 shadow-sm rounded-4 mb-5 overflow-hidden border-top border-4 border-success">
            <div class="card-body p-4 p-md-5">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="rounded-3 p-2 d-flex align-items-center justify-content-center" style="background:var(--color-forest,#1a5c38);width:40px;height:40px;">
                        <i data-lucide="store" style="width:20px;height:20px;color:#fff;"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">Peta Kawasan Wisata &amp; Persebaran UMKM</h5>
                        <small class="text-muted">Kelola gambar peta dan {{ $petaTitikStats['total'] }} titik lokasi</small>
                    </div>
                </div>

                {{-- Form update metadata & gambar --}}
                @if($petaUmkm)
                <form action="{{ route('operator.peta-dokumen.update', 'kawasan-wisata-umkm') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                    @csrf @method('PUT')
                    <div class="p-4 rounded-4 bg-light mb-3">
                        <h6 class="fw-bold mb-3 text-muted"><i data-lucide="settings" style="width:14px;height:14px;" class="me-1"></i> Metadata Peta</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="small fw-bold text-muted">Judul Peta</label>
                                <input type="text" name="judul" class="form-control rounded-3" value="{{ $petaUmkm->judul }}">
                            </div>
                            <div class="col-md-3">
                                <label class="small fw-bold text-muted">Skala</label>
                                <input type="text" name="skala" class="form-control rounded-3" value="{{ $petaUmkm->skala }}">
                            </div>
                            <div class="col-md-3">
                                <label class="small fw-bold text-muted">Sistem Koordinat</label>
                                <input type="text" name="sistem_koordinat" class="form-control rounded-3" value="{{ $petaUmkm->sistem_koordinat }}">
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-bold text-muted">Sumber Data (satu baris per sumber)</label>
                                <textarea name="sumber_data" class="form-control rounded-3" rows="3">{{ $petaUmkm->sumber_data }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-bold text-muted">Dibuat Oleh</label>
                                <input type="text" name="dibuat_oleh" class="form-control rounded-3" value="{{ $petaUmkm->dibuat_oleh }}">
                            </div>
                            
                            <div class="col-md-4">
                                <label class="small fw-bold text-muted">Proyeksi</label>
                                <input type="text" name="proyeksi" class="form-control rounded-3" value="{{ $petaUmkm->proyeksi }}">
                            </div>
                            <div class="col-md-4">
                                <label class="small fw-bold text-muted">Datum</label>
                                <input type="text" name="datum" class="form-control rounded-3" value="{{ $petaUmkm->datum }}">
                            </div>
                            <div class="col-md-4">
                                <label class="small fw-bold text-muted">Sistem Grid</label>
                                <input type="text" name="sistem_grid" class="form-control rounded-3" value="{{ $petaUmkm->sistem_grid }}">
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-bold text-muted">Zona UTM</label>
                                <input type="text" name="zona_utm" class="form-control rounded-3" value="{{ $petaUmkm->zona_utm }}">
                            </div>
                            <div class="col-md-6">
                                <label class="small fw-bold text-muted">Metode Pemetaan</label>
                                <input type="text" name="metode_pemetaan" class="form-control rounded-3" value="{{ $petaUmkm->metode_pemetaan }}">
                            </div>
                            <div class="col-12 mt-3">
                                <h6 class="fw-bold text-muted mb-2"><i data-lucide="compass" style="width:14px;height:14px;" class="me-1"></i> Cakupan Koordinat Ekstrem (Batas Luar)</h6>
                                <div class="row g-2">
                                    <div class="col-md-3">
                                        <label class="small text-muted">Utara (mU)</label>
                                        <input type="text" name="koordinat_utara" class="form-control form-control-sm rounded-2" value="{{ $petaUmkm->koordinat_utara }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="small text-muted">Selatan (mU)</label>
                                        <input type="text" name="koordinat_selatan" class="form-control form-control-sm rounded-2" value="{{ $petaUmkm->koordinat_selatan }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="small text-muted">Timur (mT)</label>
                                        <input type="text" name="koordinat_timur" class="form-control form-control-sm rounded-2" value="{{ $petaUmkm->koordinat_timur }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="small text-muted">Barat (mT)</label>
                                        <input type="text" name="koordinat_barat" class="form-control form-control-sm rounded-2" value="{{ $petaUmkm->koordinat_barat }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <label class="small fw-bold text-muted">Ganti File Gambar Peta (maks. 10MB)</label>
                                @if($petaUmkm->file_path)
                                    <div class="mb-2">
                                        <img src="{{ $petaUmkm->file_url }}" alt="Preview" class="rounded-3 border" style="max-height:80px;object-fit:cover;">
                                        <small class="text-muted ms-2">File saat ini</small>
                                    </div>
                                @endif
                                <input type="file" name="file_peta" class="form-control rounded-3" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm rounded-pill fw-bold px-4 btn-success border-0">
                        <i data-lucide="save" style="width:14px;height:14px;" class="me-1"></i> Simpan Peta Kawasan Wisata & UMKM
                    </button>
                </form>
                @endif

                {{-- Filter + Daftar Titik --}}
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                    <h6 class="fw-bold mb-0">Daftar Titik Peta
                        <span class="badge rounded-pill ms-1 bg-success">{{ $petaTitikStats['total'] }}</span>
                    </h6>
                    <a href="{{ route('operator.peta-titik.create') }}" class="btn btn-sm btn-success rounded-pill fw-bold">
                        <i data-lucide="plus" style="width:14px;height:14px;" class="me-1"></i> Tambah Titik
                    </a>
                </div>

                {{-- Search/Filter form --}}
                <form method="GET" action="{{ route('operator.profil.peta') }}" class="row g-2 mb-3">
                    <div class="col-md-5">
                        <input type="text" name="search" class="form-control form-control-sm rounded-pill" placeholder="Cari nama titik..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="kategori" class="form-select form-select-sm rounded-pill">
                            <option value="">Semua Kategori</option>
                            @foreach(PetaTitik::KATEGORI_LIST as $kSlug => $kLabel)
                                <option value="{{ $kSlug }}" @selected(request('kategori') === $kSlug)>{{ $kLabel }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="dusun" class="form-select form-select-sm rounded-pill">
                            <option value="">Semua Dusun</option>
                            @foreach(PetaTitik::DUSUN_LIST as $d)
                                <option value="{{ $d }}" @selected(request('dusun') === $d)>{{ ucfirst($d) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-sm btn-outline-success rounded-pill w-100">Filter</button>
                    </div>
                </form>

                @if($petaTitiks->isEmpty())
                    <div class="text-center py-4 text-muted border rounded-4">
                        <i data-lucide="search-x" style="width:32px;height:32px;opacity:0.3;" class="mb-2"></i>
                        <p class="mb-0 small">Tidak ada titik peta yang sesuai. <a href="{{ route('operator.profil.peta') }}" class="text-success">Reset filter</a></p>
                    </div>
                @else
                    <div class="table-responsive rounded-4 border">
                        <table class="table table-hover mb-0 align-middle" style="font-size:0.83rem;">
                            <thead style="background:rgba(26,92,56,0.06);">
                                <tr>
                                    <th class="border-0 fw-bold text-muted" style="font-size:0.71rem;letter-spacing:0.5px;">NAMA</th>
                                    <th class="border-0 fw-bold text-muted" style="font-size:0.71rem;letter-spacing:0.5px;">KATEGORI</th>
                                    <th class="border-0 fw-bold text-muted" style="font-size:0.71rem;letter-spacing:0.5px;">DUSUN</th>
                                    <th class="border-0 fw-bold text-muted" style="font-size:0.71rem;letter-spacing:0.5px;">UNGGULAN</th>
                                    <th class="border-0 fw-bold text-muted" style="font-size:0.71rem;letter-spacing:0.5px;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($petaTitiks as $t)
                                <tr>
                                    <td class="fw-semibold">{{ $t->nama }}</td>
                                    <td>
                                        <span class="badge rounded-pill d-inline-flex align-items-center gap-1" style="background:{{ $t->kategori_color }}18;color:{{ $t->kategori_color }};border:1px solid {{ $t->kategori_color }}30;font-size:0.68rem;">
                                            <i data-lucide="{{ $t->kategori_icon }}" style="width:11px;height:11px;"></i> {{ $t->kategori_label }}
                                        </span>
                                    </td>
                                    <td><small class="text-muted">{{ ucfirst($t->dusun) }}</small></td>
                                    <td>
                                        @if($t->is_wisata_unggulan)
                                            <span class="badge rounded-pill d-inline-flex align-items-center gap-1" style="background:rgba(255,152,0,0.15);color:#e65100;font-size:0.68rem;"><i data-lucide="star" style="width:10px;height:10px;"></i> Unggulan</span>
                                        @else
                                            <span class="text-muted" style="font-size:0.72rem;">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('operator.peta-titik.edit', $t->id) }}" class="btn btn-sm btn-outline-secondary rounded-pill" style="font-size:0.7rem;" title="Edit">
                                                <i data-lucide="pencil" style="width:11px;height:11px;"></i>
                                            </a>
                                            <form action="{{ route('operator.peta-titik.toggle-unggulan', $t->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm rounded-pill" style="font-size:0.7rem;background:rgba(255,152,0,0.1);color:#e65100;border:1px solid rgba(255,152,0,0.3);" title="{{ $t->is_wisata_unggulan ? 'Hapus dari unggulan' : 'Tandai sebagai unggulan' }}">
                                                    <i data-lucide="{{ $t->is_wisata_unggulan ? 'star-off' : 'star' }}" style="width:11px;height:11px;"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('operator.peta-titik.destroy', $t->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus titik peta \'{{ $t->nama }}\'?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill" style="font-size:0.7rem;" title="Hapus">
                                                    <i data-lucide="trash-2" style="width:11px;height:11px;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- Pagination --}}
                    @if($petaTitiks->hasPages())
                        <div class="mt-3 d-flex justify-content-center">
                            {{ $petaTitiks->withQueryString()->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                @endif
            </div>
        </div>

    </div>
</div>

@endsection
