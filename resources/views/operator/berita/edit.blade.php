@extends('layouts.dashboard')
@section('title', isset($berita) ? 'Edit Berita' : 'Tulis Berita')
@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <form action="{{ isset($berita) ? url('/operator/berita/'.$berita->id) : url('/operator/berita') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($berita)) @method('PUT') @endif
            
            <div class="row g-4 mb-4">
                <div class="col-md-8">
                    <label class="form-label fw-bold">Judul Berita</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul', $berita->judul ?? '') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Kategori</label>
                    <select name="kategori" class="form-select" required>
                        <option value="Kabar Desa" {{ (old('kategori', $berita->kategori ?? '') == 'Kabar Desa') ? 'selected' : '' }}>Kabar Desa</option>
                        <option value="Pengumuman" {{ (old('kategori', $berita->kategori ?? '') == 'Pengumuman') ? 'selected' : '' }}>Pengumuman</option>
                        <option value="Info Wisata" {{ (old('kategori', $berita->kategori ?? '') == 'Info Wisata') ? 'selected' : '' }}>Info Wisata</option>
                        <option value="Kegiatan KKN" {{ (old('kategori', $berita->kategori ?? '') == 'Kegiatan KKN') ? 'selected' : '' }}>Kegiatan KKN</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Isi Konten</label>
                <textarea name="konten" class="form-control" rows="10" required>{{ old('konten', $berita->konten ?? '') }}</textarea>
                <small class="text-muted">Gunakan text editor atau format text biasa.</small>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Gambar Cover</label>
                    @if(isset($berita) && $berita->gambar)
                    <div class="mb-2"><img src="{{ asset('storage/'.$berita->gambar) }}" class="rounded shadow-sm" style="max-height: 100px;"></div>
                    @endif
                    <input type="file" name="gambar" class="form-control" accept="image/*" {{ isset($berita) ? '' : 'required' }}>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', isset($berita) ? $berita->tanggal : date('Y-m-d')) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Status Publish</label>
                    <select name="status_publish" class="form-select" required>
                        <option value="publish" {{ (old('status_publish', $berita->status_publish ?? '') == 'publish') ? 'selected' : '' }}>Publish Segera</option>
                        <option value="draft" {{ (old('status_publish', $berita->status_publish ?? '') == 'draft') ? 'selected' : '' }}>Simpan sbg Draft</option>
                    </select>
                </div>
            </div>

            <div class="text-end border-top pt-3">
                <a href="{{ url('/operator/berita') }}" class="btn btn-outline-secondary px-4 me-2">Batal</a>
                <button type="submit" class="btn btn-success px-4 bg-primary-custom hover-lift"><i data-lucide="save" class="me-1" style="width:18px;"></i> Simpan Berita</button>
            </div>
        </form>
    </div>
</div>
@endsection
