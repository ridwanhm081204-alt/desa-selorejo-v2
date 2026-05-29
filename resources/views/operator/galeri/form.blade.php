@extends('layouts.dashboard')
@section('title', isset($galeri) ? 'Edit Media Galeri' : 'Upload Galeri')
@section('content')

<div class="row justify-content-center text-start">
    <div class="col-lg-8 col-xl-7">
        <div class="mb-4">
            <a href="{{ url('/operator/galeri') }}" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm transition-all hover-lift">
                <i data-lucide="arrow-left" class="icon-sm me-1"></i> Kembali ke Galeri
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white p-4 border-bottom d-flex align-items-center">
                <div class="bg-success bg-opacity-10 text-success p-2 rounded-3 me-3">
                    <i data-lucide="{{ isset($galeri) ? 'edit-3' : 'upload-cloud' }}" class="icon-sm"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0 text-dark">{{ isset($galeri) ? 'Edit Media Dokumentasi' : 'Upload Media Galeri Baru' }}</h5>
                    <small class="text-muted">Format foto/video untuk dokumentasi kegiatan desa</small>
                </div>
            </div>
            
            <div class="card-body p-4 p-md-5">
                <form action="{{ isset($galeri) ? url('/operator/galeri/'.$galeri->id) : url('/operator/galeri') }}" 
                      method="POST" 
                      enctype="multipart/form-data">
                    @csrf
                    @if(isset($galeri)) @method('PUT') @endif

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted">JENIS MEDIA</label>
                        <select name="tipe" class="form-select rounded-3 py-2 fw-bold text-success border-2 border-success border-opacity-10 shadow-none" id="mediaTipe" onchange="toggleTipe()" required>
                            <option value="foto" {{ old('tipe', $galeri->tipe ?? 'foto') == 'foto' ? 'selected' : '' }}>Foto / Gambar Statis</option>
                            <option value="video" {{ old('tipe', $galeri->tipe ?? '') == 'video' ? 'selected' : '' }}>Video (Embed YouTube)</option>
                        </select>
                        @error('tipe') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-5 p-4 bg-light rounded-4" id="inputFoto">
                        <label class="form-label small fw-bold text-muted">FILE BERKAS MEDIA {{ !isset($galeri) ? '*' : '(Unggah untuk ganti)' }}</label>
                        @if(isset($galeri) && $galeri->tipe == 'foto')
                            <div class="mb-3">
                                <span class="small text-muted d-block mb-2 italic">Gambar unggahan saat ini:</span>
                                <img src="{{ asset('storage/'.$galeri->url) }}" class="rounded-3 shadow-sm border" style="max-height: 180px; width: 100%; object-fit: cover;">
                            </div>
                        @endif
                        <input type="file" name="file_foto" class="form-control rounded-3 bg-white" accept="image/*">
                        <small class="text-muted d-block mt-2 font-italic"><i data-lucide="info" class="icon-xs me-1"></i> JPG, PNG, WEBP (Max: 2MB). Gunakan rasio terbaik.</small>
                        @error('file_foto') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-5 p-4 bg-light rounded-4" id="inputVideo" style="display:none;">
                        <label class="form-label small fw-bold text-muted">LINK / URL YOUTUBE *</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i data-lucide="youtube" class="text-danger icon-sm"></i></span>
                            <input type="url" name="url_video" class="form-control rounded-start-0 py-2" 
                                   value="{{ old('url_video', (isset($galeri) && $galeri->tipe == 'video') ? $galeri->url : '') }}"
                                   placeholder="https://www.youtube.com/watch?v=...">
                        </div>
                        <small class="text-muted d-block mt-2 font-italic"><i data-lucide="help-circle" class="icon-xs me-1"></i> Salin alamat video dari browser.</small>
                        @error('url_video') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted">KETERANGAN / CAPTION MEDIA</label>
                        <input type="text" name="caption" class="form-control rounded-3 py-2 fw-medium border-0 bg-light shadow-none" 
                               value="{{ old('caption', $galeri->caption ?? '') }}" placeholder="Contoh: Pembukaan Festival Budaya 2024">
                        @error('caption') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="row mb-5 g-4">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">TAG / KATEGORI DOKUMENTASI</label>
                            <select name="kategori" class="form-select rounded-3 py-2 border-0 bg-light shadow-none fw-bold" required>
                                <option value="Potensi Desa" {{ old('kategori', $galeri->kategori ?? '') == 'Potensi Desa' ? 'selected' : '' }}>Potensi Desa</option>
                                <option value="Wisata Alam" {{ old('kategori', $galeri->kategori ?? '') == 'Wisata Alam' ? 'selected' : '' }}>Wisata Alam</option>
                                <option value="Kegiatan Warga" {{ old('kategori', $galeri->kategori ?? '') == 'Kegiatan Warga' ? 'selected' : '' }}>Kegiatan Warga</option>
                                <option value="Infrastruktur" {{ old('kategori', $galeri->kategori ?? '') == 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                                <option value="Event" {{ old('kategori', $galeri->kategori ?? '') == 'Event' ? 'selected' : '' }}>Event & Festival</option>
                                <option value="Umum" {{ old('kategori', $galeri->kategori ?? 'Umum') == 'Umum' ? 'selected' : '' }}>Umum</option>
                            </select>
                            @error('kategori') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">TANGGAL DOKUMENTASI *</label>
                            <input type="date" name="tanggal" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" 
                                   value="{{ old('tanggal', isset($galeri) ? \Carbon\Carbon::parse($galeri->tanggal)->format('Y-m-d') : date('Y-m-d')) }}" required>
                            @error('tanggal') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="pt-4 border-top d-flex justify-content-between">
                        <a href="{{ url('/operator/galeri') }}" class="btn btn-white border rounded-pill px-4 fw-bold">BATAL</a>
                        <button type="submit" class="btn btn-success rounded-pill px-5 fw-bold shadow-sm hover-lift border-0">
                            <i data-lucide="save" class="icon-sm me-1"></i> {{ isset($galeri) ? 'SIMPAN PERUBAHAN' : 'UNGGAH MEDIA' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-4 p-4 rounded-4 bg-white shadow-sm border align-items-center d-flex">
            <div class="bg-warning bg-opacity-10 text-warning p-2 rounded-circle me-3">
                <i data-lucide="help-circle" class="icon-sm"></i>
            </div>
            <div class="small text-muted">
                Media yang Anda unggah akan secara otomatis terarsip dalam kategori yang sesuai di halaman galeri publik Desa Selorejo.
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function toggleTipe() {
    let t = document.getElementById('mediaTipe').value;
    if(t === 'foto') {
        document.getElementById('inputFoto').style.display = 'block';
        document.getElementById('inputVideo').style.display = 'none';
        @if(!isset($galeri))
            document.querySelector('input[name="file_foto"]').setAttribute('required', 'true');
        @endif
        document.querySelector('input[name="url_video"]').removeAttribute('required');
    } else {
        document.getElementById('inputFoto').style.display = 'none';
        document.getElementById('inputVideo').style.display = 'block';
        document.querySelector('input[name="url_video"]').setAttribute('required', 'true');
        document.querySelector('input[name="file_foto"]').removeAttribute('required');
    }
}
toggleTipe();
</script>
@endpush
@endsection
