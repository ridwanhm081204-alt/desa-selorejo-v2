@extends('layouts.dashboard')
@section('title', 'Kelola Wisata')
@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <form action="{{ url('/operator/wisata') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="form-label fw-bold">Judul Wisata</label>
                <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $wisata->judul) }}" required>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Deskripsi Lengkap</label>
                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="6" required>{{ old('deskripsi', $wisata->deskripsi) }}</textarea>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Harga Tiket (Rp)</label>
                    <input type="number" name="harga_tiket" class="form-control" value="{{ old('harga_tiket', $wisata->harga_tiket) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Jadwal Operasional</label>
                    <input type="text" name="jadwal" class="form-control" value="{{ old('jadwal', $wisata->jadwal) }}" placeholder="Contoh: Setiap Hari 08.00-16.00">
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Aturan Pengunjung</label>
                <textarea name="aturan" class="form-control" rows="3">{{ old('aturan', $wisata->aturan) }}</textarea>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Gambar Utama</label>
                @if($wisata->gambar)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$wisata->gambar) }}" class="rounded shadow-sm" style="max-height: 200px;">
                </div>
                @endif
                <input type="file" name="gambar" class="form-control" accept="image/*">
                <small class="text-muted">Abaikan jika tidak ingin mengubah gambar. Max 2MB (JPG/PNG).</small>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-success px-4 bg-primary-custom hover-lift"><i data-lucide="save" class="me-1" style="width:18px;"></i> Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
