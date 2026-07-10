@extends('layouts.dashboard')
@section('title', isset($produk) ? 'Edit Produk' : 'Tambah Produk Baru')
@section('content')

<div class="row justify-content-center text-start">
    <div class="col-lg-8 col-xl-7">
        <div class="mb-4 text-start">
            <a href="{{ url('/operator/produk') }}" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm transition-all hover-lift">
                <i data-lucide="arrow-left" class="icon-sm me-1"></i> Kembali ke Katalog
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <!-- Header Card -->
            <div class="card-header bg-white border-0 p-4 d-flex align-items-center border-bottom">
                <div class="bg-success bg-opacity-10 text-success p-2 rounded-3 me-3">
                    <i data-lucide="{{ isset($produk) ? 'edit-3' : 'shopping-bag' }}" class="icon-sm"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0 text-dark">{{ isset($produk) ? 'Edit Informasi Produk' : 'Tambah Produk Unggulan' }}</h5>
                    <small class="text-muted">Kelola produk UMKM dan komoditas unggulan desa</small>
                </div>
            </div>

            <div class="card-body p-4 p-md-5">
                <form action="{{ isset($produk) ? url('/operator/produk/'.$produk->id) : url('/operator/produk') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($produk)) @method('PUT') @endif
                    
                    <div class="row mb-4 g-4 text-start">
                        <div class="col-md-8">
                            <label class="form-label fw-bold text-muted small">NAMA PRODUK / KOMODITAS <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control rounded-3 py-2 fw-bold text-dark border-0 bg-light shadow-none" value="{{ old('nama', $produk->nama ?? '') }}" placeholder="Contoh: Jeruk Selorejo Premium" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small">TAG / KATEGORI</label>
                            <select name="kategori" class="form-select rounded-3 py-2 fw-bold border-0 bg-light shadow-none">
                                <option value="Jeruk Segar" {{ old('kategori', $produk->kategori ?? '') == 'Jeruk Segar' ? 'selected' : '' }}>Jeruk Segar</option>
                                <option value="Olahan Buah" {{ old('kategori', $produk->kategori ?? '') == 'Olahan Buah' ? 'selected' : '' }}>Olahan Buah</option>
                                <option value="Makanan" {{ old('kategori', $produk->kategori ?? '') == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                                <option value="Minuman" {{ old('kategori', $produk->kategori ?? '') == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                                <option value="Kerajinan" {{ old('kategori', $produk->kategori ?? '') == 'Kerajinan' ? 'selected' : '' }}>Kerajinan</option>
                                <option value="Pertanian" {{ old('kategori', $produk->kategori ?? '') == 'Pertanian' ? 'selected' : '' }}>Pertanian</option>
                                <option value="Umum" {{ old('kategori', $produk->kategori ?? 'Umum') == 'Umum' ? 'selected' : '' }}>Umum</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row g-4 mb-4 text-start">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small">HARGA SATUAN (RP) <span class="text-danger">*</span></label>
                            <div class="input-group bg-light rounded-3 overflow-hidden">
                                <span class="input-group-text bg-success bg-opacity-10 text-success border-0 fw-bold">Rp</span>
                                <input type="number" name="harga" class="form-control border-0 bg-transparent shadow-none py-2" value="{{ old('harga', $produk->harga ?? '') }}" placeholder="15000" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small">STOK TERSEDIA (PCS) <span class="text-danger">*</span></label>
                            <div class="input-group bg-light rounded-3 overflow-hidden">
                                <span class="input-group-text bg-white border-0"><i data-lucide="package" class="icon-xs text-muted"></i></span>
                                <input type="number" name="stok" class="form-control border-0 bg-transparent shadow-none py-2" value="{{ old('stok', $produk->stok ?? '100') }}" min="0" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 text-start">
                        <label class="form-label fw-bold text-muted small">NOMOR WHATSAPP PENJUAL (OPSIONAL)</label>
                        <div class="input-group bg-light rounded-3 overflow-hidden">
                            <span class="input-group-text bg-white border-0"><i data-lucide="phone" class="icon-xs text-muted"></i></span>
                            <input type="text" name="whatsapp" class="form-control border-0 bg-transparent shadow-none py-2 @error('whatsapp') is-invalid @enderror" 
                                   value="{{ old('whatsapp', $produk->whatsapp ?? '') }}" placeholder="Kosongkan jika menggunakan nomor admin toko (08xxxx)">
                        </div>
                        <small class="text-muted d-block mt-1 italic" style="font-size: 0.75rem;">Gunakan format angka saja (contoh: 08123456789)</small>
                        @error('whatsapp') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                    </div>

                    {{-- Link Marketplace --}}
                    <div class="mb-4 p-4 bg-light rounded-4 text-start">
                        <label class="form-label fw-bold text-muted small mb-3">
                            <i data-lucide="shopping-cart" class="icon-xs me-1"></i> LINK MARKETPLACE (OPSIONAL)
                        </label>
                        <small class="text-muted d-block mb-3" style="font-size: 0.75rem;">Tambahkan link produk di marketplace agar pembeli bisa langsung membeli via Shopee/Tokopedia/lainnya.</small>
                        
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="input-group bg-white rounded-3 overflow-hidden shadow-sm">
                                    <span class="input-group-text border-0" style="background: #EE4D2D1a; color: #EE4D2D; font-weight: 700; font-size: 0.75rem; min-width: 110px;">
                                        <i data-lucide="shopping-bag" class="icon-xs me-1"></i> Shopee
                                    </span>
                                    <input type="url" name="link_shopee" class="form-control border-0 shadow-none py-2 @error('link_shopee') is-invalid @enderror" 
                                           value="{{ old('link_shopee', $produk->link_shopee ?? '') }}" placeholder="https://shopee.co.id/...">
                                </div>
                                @error('link_shopee') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <div class="input-group bg-white rounded-3 overflow-hidden shadow-sm">
                                    <span class="input-group-text border-0" style="background: #42b5491a; color: #42b549; font-weight: 700; font-size: 0.75rem; min-width: 110px;">
                                        <i data-lucide="store" class="icon-xs me-1"></i> Tokopedia
                                    </span>
                                    <input type="url" name="link_tokopedia" class="form-control border-0 shadow-none py-2 @error('link_tokopedia') is-invalid @enderror" 
                                           value="{{ old('link_tokopedia', $produk->link_tokopedia ?? '') }}" placeholder="https://www.tokopedia.com/...">
                                </div>
                                @error('link_tokopedia') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <div class="input-group bg-white rounded-3 overflow-hidden shadow-sm">
                                    <span class="input-group-text border-0" style="background: #6c757d1a; color: #6c757d; font-weight: 700; font-size: 0.75rem; min-width: 110px;">
                                        <i data-lucide="external-link" class="icon-xs me-1"></i> Lainnya
                                    </span>
                                    <input type="url" name="link_marketplace_lainnya" class="form-control border-0 shadow-none py-2 @error('link_marketplace_lainnya') is-invalid @enderror" 
                                           value="{{ old('link_marketplace_lainnya', $produk->link_marketplace_lainnya ?? '') }}" placeholder="https://... (Bukalapak, Lazada, dll)">
                                </div>
                                @error('link_marketplace_lainnya') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 text-start">
                        <label class="form-label fw-bold text-muted small">DESKRIPSI PRODUK <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" class="form-control rounded-4 p-3 border-0 bg-light shadow-none" rows="6" placeholder="Jelaskan kualitas, rasa, atau spesifikasi produk ini..." required>{{ old('deskripsi', $produk->deskripsi ?? '') }}</textarea>
                    </div>

                    <div class="mb-5 p-4 bg-light rounded-4 text-start">
                        <label class="form-label fw-bold text-muted small">FOTO PRODUK</label>
                        @if(isset($produk) && $produk->gambar)
                            <div class="mb-3 text-center bg-white p-2 rounded-3 border">
                                <div class="small text-muted mb-2 italic">Gambar unggahan saat ini:</div>
                                <img src="{{ asset('storage/'.$produk->gambar) }}" class="rounded-3 shadow-sm" style="max-height: 180px; width: auto; max-width: 100%; object-fit: contain;">
                            </div>
                        @endif
                        <input type="file" name="gambar" class="form-control rounded-pill border-0 shadow-sm bg-white" accept="image/*" {{ isset($produk) ? '' : 'required' }}>
                        <small class="text-muted d-block mt-3 font-italic"><i data-lucide="info" class="icon-xs me-1"></i> Gunakan latar belakang yang rapi. Max: 2MB.</small>
                    </div>

                    <div class="pt-4 border-top d-flex justify-content-between">
                        <a href="{{ url('/operator/produk') }}" class="btn btn-white border rounded-pill px-4 fw-bold">BATAL</a>
                        <button type="submit" class="btn btn-success rounded-pill px-5 fw-bold shadow-sm hover-lift border-0">
                            <i data-lucide="save" class="icon-sm me-1"></i> {{ isset($produk) ? 'SIMPAN PERUBAHAN' : 'TAMBAH PRODUK' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
