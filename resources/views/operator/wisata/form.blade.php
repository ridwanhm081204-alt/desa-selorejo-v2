@extends('layouts.dashboard')
@section('title', isset($wisata) ? 'Edit Wisata' : 'Tambah Wisata Baru')
@section('content')

<div class="row justify-content-center text-start">
    <div class="col-lg-8 col-xl-7">
        <div class="mb-4 text-start">
            <a href="{{ route('operator.wisata.index') }}" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm transition-all hover-lift">
                <i data-lucide="arrow-left" class="icon-sm me-1"></i> Kembali ke Daftar
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white p-4 d-flex align-items-center border-bottom">
                <div class="bg-success bg-opacity-10 text-success p-2 rounded-3 me-3">
                    <i data-lucide="{{ isset($wisata) ? 'edit-3' : 'plus-circle' }}" class="icon-sm"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0 text-dark">{{ isset($wisata) ? 'Edit Informasi Wisata' : 'Tambah Destinasi Wisata Baru' }}</h5>
                    <small class="text-muted">Kelola daya tarik wisata unggulan Desa Selorejo</small>
                </div>
            </div>
            
            <div class="card-body p-4 p-md-5">
                <form action="{{ isset($wisata) ? route('operator.wisata.update', $wisata->id) : route('operator.wisata.store') }}" 
                      method="POST" 
                      enctype="multipart/form-data">
                    @csrf
                    @if(isset($wisata)) @method('PUT') @endif

                    <div class="row mb-4 g-4 text-start">
                        <div class="col-md-8">
                            <label class="form-label small fw-bold text-muted">JUDUL DESTINASI <span class="text-danger">*</span></label>
                            <input type="text" name="judul" class="form-control rounded-3 py-2 fw-bold text-dark border-0 bg-light shadow-none @error('judul') is-invalid @enderror" 
                                   value="{{ old('judul', $wisata->judul ?? '') }}" required placeholder="Contoh: Agrowisata Petik Jeruk">
                            @error('judul') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">TAG / KATEGORI <span class="text-danger">*</span></label>
                            <select name="kategori" class="form-select rounded-3 py-2 fw-bold border-0 bg-light shadow-none @error('kategori') is-invalid @enderror" required>
                                <option value="Wisata Alam" {{ old('kategori', $wisata->kategori ?? '') == 'Wisata Alam' ? 'selected' : '' }}>Wisata Alam</option>
                                <option value="Agrowisata" {{ old('kategori', $wisata->kategori ?? '') == 'Agrowisata' ? 'selected' : '' }}>Agrowisata</option>
                                <option value="Budaya & Event" {{ old('kategori', $wisata->kategori ?? '') == 'Budaya & Event' ? 'selected' : '' }}>Budaya & Event</option>
                                <option value="Eduwisata" {{ old('kategori', $wisata->kategori ?? '') == 'Eduwisata' ? 'selected' : '' }}>Eduwisata</option>
                                <option value="Religi" {{ old('kategori', $wisata->kategori ?? '') == 'Religi' ? 'selected' : '' }}>Religi</option>
                                <option value="Umum" {{ old('kategori', $wisata->kategori ?? 'Umum') == 'Umum' ? 'selected' : '' }}>Umum</option>
                            </select>
                            @error('kategori') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-4 text-start">
                        <label class="form-label small fw-bold text-muted">DESKRIPSI LENGKAP <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" class="form-control rounded-4 p-3 border-0 bg-light shadow-none @error('deskripsi') is-invalid @enderror" 
                                  rows="8" required placeholder="Gambarkan keunikan dan daya tarik utama tempat ini...">{{ old('deskripsi', $wisata->deskripsi ?? '') }}</textarea>
                        @error('deskripsi') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="row mb-4 g-4 text-start">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">HTM / HARGA TIKET (RP) <span class="text-danger">*</span></label>
                            <div class="input-group bg-light rounded-3 overflow-hidden">
                                <span class="input-group-text bg-success bg-opacity-10 text-success border-0 fw-bold">Rp</span>
                                <input type="number" name="harga_tiket" class="form-control border-0 bg-transparent shadow-none py-2 @error('harga_tiket') is-invalid @enderror" 
                                       value="{{ old('harga_tiket', $wisata->harga_tiket ?? '') }}" required placeholder="20000">
                            </div>
                            @error('harga_tiket') <div class="text-danger small mt-1 font-bold">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">JADWAL OPERASIONAL <span class="text-danger">*</span></label>
                            <div class="input-group bg-light rounded-3 overflow-hidden">
                                <span class="input-group-text bg-white border-0"><i data-lucide="clock" class="icon-xs text-muted"></i></span>
                                <input type="text" name="jadwal" class="form-control border-0 bg-transparent shadow-none py-2 @error('jadwal') is-invalid @enderror" 
                                       value="{{ old('jadwal', $wisata->jadwal ?? '') }}" required placeholder="Misal: Setiap Hari, 08:00 - 17:00">
                            </div>
                            @error('jadwal') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-4 text-start text-start">
                        <label class="form-label small fw-bold text-muted">ATURAN PENGUNJUNG (OPSIONAL)</label>
                        <textarea name="aturan" class="form-control rounded-3 p-3 border-0 bg-light shadow-none @error('aturan') is-invalid @enderror" 
                                  rows="3" placeholder="Contoh: Dilarang memetik buah tanpa izin, wajib menjaga kebersihan...">{{ old('aturan', $wisata->aturan ?? '') }}</textarea>
                        @error('aturan') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-5 p-4 bg-light rounded-4 text-start overflow-hidden">
                        <label class="form-label small fw-bold text-muted">FOTO SAMPUL DESTINASI</label>
                        @if(isset($wisata) && $wisata->gambar)
                            <div class="mb-3">
                                <div class="small text-muted mb-2 italic">Dokumentasi Saat Ini:</div>
                                <img src="{{ Str::startsWith($wisata->gambar, 'http') ? $wisata->gambar : asset('storage/'.$wisata->gambar) }}" 
                                     class="rounded-3 shadow-sm border" style="max-height: 220px; width: 100%; object-fit: cover;">
                            </div>
                        @endif
                        <input type="file" name="gambar" class="form-control rounded-pill border-0 shadow-sm bg-white" 
                               accept="image/*" {{ isset($wisata) ? '' : 'required' }}>
                        <small class="text-muted d-block mt-3 font-italic"><i data-lucide="image" class="icon-xs me-1"></i> Rasio ideal 3:2 atau 16:9. Maksimum 2MB.</small>
                        @error('gambar') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="pt-4 border-top d-flex justify-content-between">
                        <a href="{{ route('operator.wisata.index') }}" class="btn btn-white border rounded-pill px-4 fw-bold">BATAL</a>
                        <button type="submit" class="btn btn-success rounded-pill px-5 fw-bold shadow-sm hover-lift border-0">
                            <i data-lucide="save" class="icon-sm me-1"></i> {{ isset($wisata) ? 'SIMPAN PERUBAHAN' : 'TERBITKAN WISATA' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
