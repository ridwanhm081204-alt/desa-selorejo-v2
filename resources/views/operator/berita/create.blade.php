@extends('layouts.dashboard')
@section('title', isset($berita) ? 'Edit Berita' : 'Tulis Berita Baru')
@section('content')

<div class="row justify-content-center text-start">
    <div class="col-lg-10 col-xl-9">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <!-- Header Card -->
            <div class="card-header bg-white border-0 p-4 d-flex align-items-center border-bottom">
                <div class="bg-success bg-opacity-10 text-success p-2 rounded-3 me-3">
                    <i data-lucide="{{ isset($berita) ? 'edit-3' : 'plus-circle' }}" class="icon-sm"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0 text-dark">{{ isset($berita) ? 'Edit Konten Berita' : 'Tulis Berita Baru' }}</h5>
                    <small class="text-muted">Pastikan judul dan konten berita informatif bagi warga</small>
                </div>
            </div>

            <div class="card-body p-4 p-md-5">
                <form action="{{ isset($berita) ? url('/operator/berita/'.$berita->id) : url('/operator/berita') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($berita)) @method('PUT') @endif
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-8">
                            <label class="form-label fw-bold text-muted small">JUDUL BERITA</label>
                            <input type="text" name="judul" class="form-control rounded-3 py-2 fw-bold" value="{{ old('judul', $berita->judul ?? '') }}" placeholder="Contoh: Peresmian Pasar Desa Selorejo..." required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small">KATEGORI</label>
                            <select name="kategori" class="form-select rounded-3 py-2 fw-bold" required>
                                <option value="Kegiatan Desa" {{ (old('kategori', $berita->kategori ?? '') == 'Kegiatan Desa') ? 'selected' : '' }}>Kegiatan Desa</option>
                                <option value="Pariwisata" {{ (old('kategori', $berita->kategori ?? '') == 'Pariwisata') ? 'selected' : '' }}>Pariwisata</option>
                                <option value="Ekonomi & UMKM" {{ (old('kategori', $berita->kategori ?? '') == 'Ekonomi & UMKM') ? 'selected' : '' }}>Ekonomi & UMKM</option>
                                <option value="Pembangunan" {{ (old('kategori', $berita->kategori ?? '') == 'Pembangunan') ? 'selected' : '' }}>Pembangunan</option>
                                <option value="Sosial" {{ (old('kategori', $berita->kategori ?? '') == 'Sosial') ? 'selected' : '' }}>Sosial</option>
                                <option value="Pengumuman" {{ (old('kategori', $berita->kategori ?? '') == 'Pengumuman') ? 'selected' : '' }}>Pengumuman</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted small">ISI KONTEN BERITA</label>
                        <textarea name="konten" class="form-control rounded-4 p-4 shadow-none rich-text" rows="12" placeholder="Tuliskan berita secara lengkap di sini..." required>{{ old('konten', $berita->konten ?? '') }}</textarea>
                        <div class="mt-2 d-flex align-items-center text-muted small">
                            <i data-lucide="info" class="icon-xs me-1"></i> Tips: Gunakan paragraf yang jelas untuk memudahkan pembaca.
                        </div>
                    </div>

                    <div class="row g-4 mb-5 p-4 bg-light rounded-4">
                        <div class="col-md-5">
                            <label class="form-label fw-bold text-muted small">GAMBAR UNGGULAN (COVER)</label>
                            @if(isset($berita) && $berita->gambar)
                                <div class="mb-3">
                                    <div class="small text-muted mb-1 italic">Gambar Saat Ini:</div>
                                    <img src="{{ asset('storage/'.$berita->gambar) }}" class="rounded-3 shadow-sm border" style="max-height: 120px; width: 100%; object-fit: cover;">
                                </div>
                            @endif
                            <input type="file" name="gambar" class="form-control rounded-3" accept="image/*" {{ isset($berita) ? '' : 'required' }}>
                            <small class="text-muted d-block mt-2 font-italic">Format: JPG, PNG, WEBP (Maks 2MB)</small>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold text-muted small">TANGGAL PUBLISH</label>
                            <input type="date" name="tanggal" class="form-control rounded-3" value="{{ old('tanggal', isset($berita) ? $berita->tanggal : date('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small">STATUS PUBLIKASI</label>
                            <select name="status_publish" class="form-select rounded-3 py-2 fw-bold text-success" required>
                                <option value="publish" {{ (old('status_publish', $berita->status_publish ?? '') == 'publish') ? 'selected' : '' }}>Publikasikan Langsung</option>
                                <option value="draft" {{ (old('status_publish', $berita->status_publish ?? '') == 'draft') ? 'selected' : '' }}>Simpan Sebagai Draft</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center border-top pt-4">
                        <a href="{{ url('/operator/berita') }}" class="btn btn-light rounded-pill px-4 fw-bold">
                            <i data-lucide="arrow-left" class="icon-sm me-1"></i> BATAL
                        </a>
                        <button type="submit" class="btn btn-success rounded-pill px-5 py-2 fw-bold shadow-sm hover-lift border-0">
                            <i data-lucide="save" class="icon-sm me-1"></i> SIMPAN BERITA
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
