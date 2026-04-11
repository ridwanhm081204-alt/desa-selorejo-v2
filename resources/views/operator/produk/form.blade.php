@extends('layouts.dashboard')
@section('title', isset($produk) ? 'Edit Produk' : 'Tambah Produk')
@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <form action="{{ isset($produk) ? url('/operator/produk/'.$produk->id) : url('/operator/produk') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($produk)) @method('PUT') @endif
            
            <div class="mb-4">
                <label class="form-label fw-bold">Nama Produk</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $produk->nama ?? '') }}" required>
            </div>
            
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control" value="{{ old('harga', $produk->harga ?? '') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Ketersediaan Stok / Status</label>
                    <input type="text" name="stok" class="form-control" value="{{ old('stok', $produk->stok ?? '') }}" placeholder="Contoh: Tersedia 50 Kg">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Deskripsi Produk</label>
                <textarea name="deskripsi" class="form-control" rows="5" required>{{ old('deskripsi', $produk->deskripsi ?? '') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Gambar Produk</label>
                @if(isset($produk) && $produk->gambar)
                <div class="mb-2"><img src="{{ asset('storage/'.$produk->gambar) }}" class="rounded shadow-sm" style="max-height: 100px;"></div>
                @endif
                <input type="file" name="gambar" class="form-control" accept="image/*" {{ isset($produk) ? '' : 'required' }}>
            </div>

            <div class="text-end border-top pt-4">
                <a href="{{ url('/operator/produk') }}" class="btn btn-outline-secondary px-4 me-2">Batal</a>
                <button type="submit" class="btn btn-success px-4 bg-primary-custom hover-lift"><i data-lucide="save" class="me-1" style="width:18px;"></i> Simpan Produk</button>
            </div>
        </form>
    </div>
</div>
@endsection
