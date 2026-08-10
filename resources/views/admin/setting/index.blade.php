@extends('layouts.dashboard')
@section('title', 'Konfigurasi Inti Website')
@section('content')

<div class="row justify-content-center text-start">
    <div class="col-lg-10 col-xl-9">
        
        <div class="mb-4">
            <h5 class="fw-bold text-dark"><i data-lucide="settings-2" class="icon-sm me-2 text-primary"></i> Pengaturan Global Portal</h5>
            <p class="text-muted small">Konfigurasi ini akan direfleksikan ke seluruh bagian publik dan manajemen website.</p>
        </div>

        <form action="{{ url('/admin/pengaturan') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Identitas Card -->
            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                <div class="card-header bg-white p-4 border-0 border-bottom">
                    <h6 class="fw-bold mb-0">Identitas & Branding Desa</h6>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small text-uppercase">NAMA DESA / INSTANSI <span class="text-danger">*</span></label>
                            <div class="input-group bg-light rounded-3 overflow-hidden border">
                                <span class="input-group-text bg-transparent border-0"><i data-lucide="building" class="icon-xs text-muted"></i></span>
                                <input type="text" name="nama_desa" class="form-control border-0 bg-transparent shadow-none py-2 fw-bold" value="{{ $settings['nama_desa'] ?? 'Desa Selorejo' }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small text-uppercase">SLOGAN / TAGLINE</label>
                            <div class="input-group bg-light rounded-3 overflow-hidden border">
                                <span class="input-group-text bg-transparent border-0"><i data-lucide="quote" class="icon-xs text-muted"></i></span>
                                <input type="text" name="slogan" class="form-control border-0 bg-transparent shadow-none py-2" value="{{ $settings['slogan'] ?? 'Desa Wisata Petik Jeruk' }}" placeholder="Slogan desa...">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold text-muted small text-uppercase">LOGO WEBSITE (PNG/JPG)</label>
                            <div class="p-4 bg-light rounded-4 border-dashed text-center">
                                @if(isset($settings['logo']) && $settings['logo'])
                                    <div class="mb-3">
                                        <img src="{{ asset('storage/'.$settings['logo']) }}" class="img-fluid rounded shadow-sm bg-white p-2" style="max-height:80px;" alt="Logo Desa">
                                    </div>
                                @endif
                                <input type="file" name="logo" class="form-control bg-white rounded-pill border-0 shadow-sm" accept="image/png, image/jpeg">
                                <small class="text-muted d-block mt-2">Format disarankan: PNG Transparan atau JPG resolusi tinggi.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kontak Card -->
            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                <div class="card-header bg-white p-4 border-0 border-bottom">
                    <h6 class="fw-bold mb-0">Statistik Beranda</h6>
                    <small class="text-muted">Ditampilkan di bagian atas halaman utama website publik.</small>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="row g-4">
                        <div class="col-md-3">
                            <label class="form-label fw-bold text-muted small text-uppercase">JUMLAH PENDUDUK</label>
                            <div class="input-group bg-light rounded-3 overflow-hidden border">
                                <span class="input-group-text bg-transparent border-0"><i data-lucide="users" class="icon-xs text-muted"></i></span>
                                <input type="text" name="jumlah_penduduk" class="form-control border-0 bg-transparent shadow-none py-2" value="{{ $settings['jumlah_penduduk'] ?? '3.640' }}" placeholder="3.640">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold text-muted small text-uppercase">JUMLAH KK</label>
                            <div class="input-group bg-light rounded-3 overflow-hidden border">
                                <span class="input-group-text bg-transparent border-0"><i data-lucide="home" class="icon-xs text-muted"></i></span>
                                <input type="text" name="jumlah_kk" class="form-control border-0 bg-transparent shadow-none py-2" value="{{ $settings['jumlah_kk'] ?? '1.024' }}" placeholder="1.024">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold text-muted small text-uppercase">LUAS WILAYAH (Ha)</label>
                            <div class="input-group bg-light rounded-3 overflow-hidden border">
                                <span class="input-group-text bg-transparent border-0"><i data-lucide="map" class="icon-xs text-muted"></i></span>
                                <input type="text" name="luas_wilayah" class="form-control border-0 bg-transparent shadow-none py-2" value="{{ $settings['luas_wilayah'] ?? '623' }}" placeholder="623">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold text-muted small text-uppercase">JUMLAH DUSUN</label>
                            <div class="input-group bg-light rounded-3 overflow-hidden border">
                                <span class="input-group-text bg-transparent border-0"><i data-lucide="layout" class="icon-xs text-muted"></i></span>
                                <input type="text" name="jumlah_dusun" class="form-control border-0 bg-transparent shadow-none py-2" value="{{ $settings['jumlah_dusun'] ?? '3' }}" placeholder="3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hero Beranda & Konten Beranda Card -->
            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                <div class="card-header bg-white p-4 border-0 border-bottom">
                    <h6 class="fw-bold mb-0">Konten Hero & Seksi Beranda</h6>
                    <small class="text-muted">Teks hero beranda, seksi potensi wisata, deskripsi footer, dan URL Maps kontak.</small>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small text-uppercase">BADGE HERO (mis. SUGENG RAWUH)</label>
                            <input type="text" name="hero_beranda_badge" class="form-control bg-light border-0 shadow-none py-2" value="{{ $settings['hero_beranda_badge'] ?? 'SUGENG RAWUH' }}" placeholder="SUGENG RAWUH">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small text-uppercase">JUDUL HERO BERANDA</label>
                            <input type="text" name="hero_beranda_title" class="form-control bg-light border-0 shadow-none py-2" value="{{ $settings['hero_beranda_title'] ?? 'Desa Wisata Petik Jeruk Selorejo' }}" placeholder="Desa Wisata Petik Jeruk Selorejo">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small text-uppercase">SUBTITLE HERO BERANDA</label>
                            <input type="text" name="hero_beranda_subtitle" class="form-control bg-light border-0 shadow-none py-2" value="{{ $settings['hero_beranda_subtitle'] ?? 'Kecamatan Dau, Kabupaten Malang, Provinsi Jawa Timur' }}" placeholder="Kecamatan Dau...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small text-uppercase">JUDUL SEKSI POTENSI WISATA</label>
                            <input type="text" name="beranda_wisata_judul" class="form-control bg-light border-0 shadow-none py-2" value="{{ $settings['beranda_wisata_judul'] ?? 'Wisata Petik Jeruk Keprok' }}" placeholder="Wisata Petik Jeruk Keprok">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small text-uppercase">URL MAPS HALAMAN KONTAK</label>
                            <input type="url" name="kontak_maps_url" class="form-control bg-light border-0 shadow-none py-2" value="{{ $settings['kontak_maps_url'] ?? 'https://maps.app.goo.gl/wP2HTRTZ219oB9TM8' }}" placeholder="https://maps.app.goo.gl/...">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold text-muted small text-uppercase">DESKRIPSI FOOTER (Kolom Tentang Website)</label>
                            <textarea name="footer_deskripsi" class="form-control bg-light border-0 shadow-none" rows="3" placeholder="Website resmi ... dikelola oleh Pemerintah Desa...">{{ $settings['footer_deskripsi'] ?? '' }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold text-muted small text-uppercase">GAMBAR SEKSI POTENSI WISATA (Gambar kiri beranda)</label>
                            <div class="p-4 bg-light rounded-4 border text-center">
                                @if(isset($settings['beranda_wisata_gambar']) && $settings['beranda_wisata_gambar'])
                                    <div class="mb-3">
                                        <img src="{{ asset('storage/'.$settings['beranda_wisata_gambar']) }}" class="img-fluid rounded shadow-sm" style="max-height:120px;object-fit:cover;" alt="Gambar Wisata">
                                    </div>
                                @endif
                                <input type="file" name="beranda_wisata_gambar" class="form-control bg-white rounded-pill border-0 shadow-sm" accept="image/*">
                                <small class="text-muted d-block mt-2">Jika dikosongkan, gambar default <code>wisata_jeruk.png</code> akan digunakan.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card border-0 shadow-sm rounded-4 mb-5 overflow-hidden">
                <div class="card-header bg-white p-4 border-0 border-bottom">
                    <h6 class="fw-bold mb-0">Informasi Kontak & Lokasi</h6>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted small text-uppercase">ALAMAT LENGKAP KANTOR DESA</label>
                        <div class="input-group bg-light rounded-3 overflow-hidden border">
                            <span class="input-group-text bg-transparent border-0"><i data-lucide="map-pin" class="icon-xs text-muted"></i></span>
                            <input type="text" name="alamat" class="form-control border-0 bg-transparent shadow-none py-2" value="{{ $settings['alamat'] ?? '' }}" placeholder="Desa Selorejo, Kecamatan Dau - 61515, Kabupaten Malang, Jawa Timur...">
                        </div>
                    </div>
                    
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small text-uppercase">TELEPON KANTOR</label>
                            <div class="input-group bg-light rounded-3 overflow-hidden border">
                                <span class="input-group-text bg-transparent border-0"><i data-lucide="phone" class="icon-xs text-muted"></i></span>
                                <input type="text" name="telepon_desa" class="form-control border-0 bg-transparent shadow-none py-2" value="{{ $settings['telepon_desa'] ?? '' }}" placeholder="0341-XXXXXX">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small text-uppercase">WHATSAPP OFFICIAL</label>
                            <div class="input-group bg-light rounded-3 overflow-hidden border">
                                <span class="input-group-text bg-transparent border-0"><i data-lucide="message-circle" class="icon-xs text-success"></i></span>
                                <input type="text" name="whatsapp" class="form-control border-0 bg-transparent shadow-none py-2 fw-bold" value="{{ $settings['whatsapp'] ?? '' }}" placeholder="08XXXXXXXXXX">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small text-uppercase">EMAIL RESMI DESA</label>
                            <div class="input-group bg-light rounded-3 overflow-hidden border">
                                <span class="input-group-text bg-transparent border-0"><i data-lucide="mail" class="icon-xs text-muted"></i></span>
                                <input type="email" name="email_desa" class="form-control border-0 bg-transparent shadow-none py-2" value="{{ $settings['email_desa'] ?? '' }}" placeholder="desa@selorejo.id">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-top d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center text-muted small">
                    <i data-lucide="info" class="icon-sm me-2"></i>
                    Pastikan seluruh data kontak valid untuk mempermudah pelayanan warga.
                </div>
                <button type="submit" class="btn btn-success rounded-pill px-5 fw-bold shadow-sm hover-lift border-0">
                    <i data-lucide="save" class="icon-sm me-1"></i> SIMPAN PERUBAHAN
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .border-dashed { border: 2px dashed #dee2e6 !important; }
</style>
@endsection
