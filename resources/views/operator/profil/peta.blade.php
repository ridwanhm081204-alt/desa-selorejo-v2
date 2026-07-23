@extends('layouts.dashboard')
@section('title', 'Kelola Peta & Wilayah')
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
                        <i data-lucide="shield-check" class="me-3" style="width: 32px; height: 32px;"></i>
                        <div>
                            <h6 class="fw-bold mb-1 text-white">Integrasi Peta Resmi Desa (V2)</h6>
                            <p class="mb-0 small" style="color: rgba(255,255,255,0.9);">
                                Halaman Peta kini terintegrasi langsung dengan <strong>Peta Batas Desa Resmi (35.07.22.2005)</strong> yang mencakup 61 Titik Kartometrik secara statis. 
                                Pengaturan <em>gambar peta, legenda, narasi, dan fasilitas umum</em> kini di-handle secara otomatis (tersimpan aman di database namun tidak ditampilkan lagi di form ini). Anda hanya perlu mengelola informasi Akses & Rute.
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
                            <textarea name="peta_embed" class="form-control rounded-4 shadow-none p-3 border-success border-opacity-10" rows="6" placeholder='<iframe src="https://google.com/maps/embed...'>{{ old('peta_embed', $profil->peta_embed) }}</textarea>
                            <div class="text-muted small mt-3 fw-medium d-flex align-items-center">
                                <i data-lucide="help-circle" class="icon-xs text-primary me-2"></i> Klik Bagikan > Sematkan pada Google Maps untuk mendapatkan kode ini.
                            </div>
                        </div>
                    </div>
                    
                    <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="route" class="text-success me-3"></i> Aksesibilitas Desa</h5>
                    <div class="row g-4">
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
                </div>
            </div>

            <div class="card border-0 shadow-lg rounded-4 mb-5 mt-4 p-2 bg-success bg-opacity-10 header-gradient border-top border-4 border-success">
                <div class="card-body p-4 p-md-5 text-center">
                    <div class="bg-white d-inline-block p-4 rounded-circle mb-4 shadow-sm border border-success border-opacity-25">
                        <i data-lucide="send" class="text-success" style="width:40px; height:40px;"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-3">Finalisasi Perubahan Profil</h4>
                    <p class="text-muted mb-4 mx-auto" style="max-width: 600px;">Data profil Peta & Wilayah akan diperbarui secara real-time pada halaman publik Desa Selorejo.</p>
                    
                    <button type="submit" class="btn btn-success px-5 py-3 rounded-pill fw-bold hover-lift shadow border-0" style="font-size:1.1rem;">
                        <i data-lucide="save" class="me-2"></i> SIMPAN & PUBLIKASIKAN
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
