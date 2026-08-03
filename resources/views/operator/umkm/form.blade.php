@extends('layouts.dashboard')
@section('title', isset($umkm) ? 'Edit UMKM: '.$umkm->nama_usaha : 'Tambah UMKM Baru')
@section('content')

<div class="row justify-content-center text-start">
    <div class="col-lg-9 col-xl-8">
        <div class="mb-4">
            <a href="{{ route('operator.umkm.index') }}" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm hover-lift">
                <i data-lucide="arrow-left" class="icon-sm me-1"></i> Kembali ke Daftar UMKM
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white p-4 d-flex align-items-center border-bottom">
                <div class="bg-success bg-opacity-10 text-success p-2 rounded-3 me-3">
                    <i data-lucide="{{ isset($umkm) ? 'edit-3' : 'plus-circle' }}" class="icon-sm"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0 text-dark">{{ isset($umkm) ? 'Edit Data UMKM' : 'Tambah UMKM Baru' }}</h5>
                    <small class="text-muted">Kelola data usaha mikro kecil dan menengah Desa Selorejo</small>
                </div>
            </div>

            <div class="card-body p-4 p-md-5">
                <form action="{{ isset($umkm) ? route('operator.umkm.update', $umkm->id) : route('operator.umkm.store') }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($umkm)) @method('PUT') @endif

                    {{-- ─── Informasi Usaha ─────────────────────────────────────────────── --}}
                    <h6 class="fw-bold text-muted text-uppercase small mb-3 border-bottom pb-2">
                        <i data-lucide="store" class="icon-xs me-1"></i>Informasi Usaha
                    </h6>

                    <div class="row mb-3 g-3">
                        <div class="col-md-8">
                            <label class="form-label small fw-bold text-muted">NAMA USAHA <span class="text-danger">*</span></label>
                            <input type="text" name="nama_usaha"
                                   class="form-control rounded-3 py-2 border-0 bg-light shadow-none @error('nama_usaha') is-invalid @enderror"
                                   value="{{ old('nama_usaha', $umkm->nama_usaha ?? '') }}" required
                                   placeholder="Contoh: Warung Sari Roso">
                            @error('nama_usaha') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">DUSUN <span class="text-danger">*</span></label>
                            <select name="dusun" class="form-select rounded-3 py-2 border-0 bg-light shadow-none @error('dusun') is-invalid @enderror" required>
                                @foreach(\App\Models\Umkm::DUSUN_LIST as $d)
                                    <option value="{{ $d }}" {{ old('dusun', $umkm->dusun ?? '') == $d ? 'selected' : '' }}>{{ $d }}</option>
                                @endforeach
                            </select>
                            @error('dusun') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3 g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">JENIS USAHA (apa adanya) <span class="text-danger">*</span></label>
                            <input type="text" name="jenis_usaha"
                                   class="form-control rounded-3 py-2 border-0 bg-light shadow-none @error('jenis_usaha') is-invalid @enderror"
                                   value="{{ old('jenis_usaha', $umkm->jenis_usaha ?? '') }}" required
                                   placeholder="Contoh: Toko Kelontong Sembako">
                            @error('jenis_usaha') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">KATEGORI (untuk filter & peta) <span class="text-danger">*</span></label>
                            <select name="kategori" class="form-select rounded-3 py-2 border-0 bg-light shadow-none @error('kategori') is-invalid @enderror" required>
                                @foreach(\App\Models\Umkm::KATEGORI_LIST as $kat)
                                    <option value="{{ $kat }}" {{ old('kategori', $umkm->kategori ?? '') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                                @endforeach
                            </select>
                            @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3 g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">PRODUK / LAYANAN UNGGULAN</label>
                            <input type="text" name="produk_unggulan"
                                   class="form-control rounded-3 py-2 border-0 bg-light shadow-none @error('produk_unggulan') is-invalid @enderror"
                                   value="{{ old('produk_unggulan', $umkm->produk_unggulan ?? '') }}"
                                   placeholder="Contoh: Jeruk Siam Fresh, Bakso Beranak, Kopi Dampit">
                            @error('produk_unggulan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">JAM OPERASIONAL</label>
                            <input type="text" name="jam_operasional"
                                   class="form-control rounded-3 py-2 border-0 bg-light shadow-none @error('jam_operasional') is-invalid @enderror"
                                   value="{{ old('jam_operasional', $umkm->jam_operasional ?? '') }}"
                                   placeholder="Contoh: Senin - Minggu (08.00 - 20.00 WIB)">
                            @error('jam_operasional') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">DESKRIPSI LENGKAP USAHA</label>
                        <textarea name="deskripsi" rows="4"
                                  class="form-control rounded-3 py-2 border-0 bg-light shadow-none @error('deskripsi') is-invalid @enderror"
                                  placeholder="Tuliskan deskripsi lengkap mengenai sejarah singkat usaha, produk yang dijual, keunggulan, atau cara pemesanan...">{{ old('deskripsi', $umkm->deskripsi ?? '') }}</textarea>
                        @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- ─── Informasi Pemilik ───────────────────────────────────────────── --}}
                    <h6 class="fw-bold text-muted text-uppercase small mb-3 border-bottom pb-2 mt-4">
                        <i data-lucide="user" class="icon-xs me-1"></i>Informasi Pemilik
                    </h6>

                    <div class="row mb-3 g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">NAMA PEMILIK <span class="text-danger">*</span></label>
                            <input type="text" name="nama_pemilik"
                                   class="form-control rounded-3 py-2 border-0 bg-light shadow-none @error('nama_pemilik') is-invalid @enderror"
                                   value="{{ old('nama_pemilik', $umkm->nama_pemilik ?? '') }}" required
                                   placeholder="Nama lengkap pemilik">
                            @error('nama_pemilik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">NOMOR TELEPON</label>
                            <div class="input-group bg-light rounded-3 overflow-hidden">
                                <span class="input-group-text bg-white border-0"><i data-lucide="phone" class="icon-xs text-muted"></i></span>
                                <input type="text" name="no_telepon"
                                       class="form-control border-0 bg-transparent shadow-none py-2 @error('no_telepon') is-invalid @enderror"
                                       value="{{ old('no_telepon', $umkm->no_telepon ?? '') }}"
                                       placeholder="08xxxxxxxxxx">
                            </div>
                            @error('no_telepon') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3 g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">ALAMAT RT/RW</label>
                            <input type="text" name="alamat_rt_rw"
                                   class="form-control rounded-3 py-2 border-0 bg-light shadow-none"
                                   value="{{ old('alamat_rt_rw', $umkm->alamat_rt_rw ?? '') }}"
                                   placeholder="Contoh: 1/1, atau 13/05 Selokerto">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">GMAIL USAHA</label>
                            <div class="input-group bg-light rounded-3 overflow-hidden">
                                <span class="input-group-text bg-white border-0"><i data-lucide="mail" class="icon-xs text-muted"></i></span>
                                <input type="email" name="gmail_usaha"
                                       class="form-control border-0 bg-transparent shadow-none py-2"
                                       value="{{ old('gmail_usaha', $umkm->gmail_usaha ?? '') }}"
                                       placeholder="usaha@gmail.com">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">USERNAME SOSMED (Shopee / ShopeeFood / Tokopedia / TikTok)</label>
                        <input type="text" name="username_sosmed"
                               class="form-control rounded-3 py-2 border-0 bg-light shadow-none"
                               value="{{ old('username_sosmed', $umkm->username_sosmed ?? '') }}"
                               placeholder="Contoh: toko.bu.sari atau kiosjerukD.Orange">
                    </div>

                    {{-- ─── Informasi Lokasi Google Maps ────────────────────────────────── --}}
                    <h6 class="fw-bold text-muted text-uppercase small mb-3 border-bottom pb-2 mt-4">
                        <i data-lucide="map-pin" class="icon-xs me-1"></i>Informasi Lokasi Google Maps
                    </h6>

                    <div class="row mb-3 g-3">
                        <div class="col-md-7">
                            <label class="form-label small fw-bold text-muted">LINK GOOGLE MAPS (URL pendek)</label>
                            <div class="input-group bg-light rounded-3 overflow-hidden">
                                <span class="input-group-text bg-white border-0"><i data-lucide="link" class="icon-xs text-muted"></i></span>
                                <input type="url" name="link_gmaps"
                                       class="form-control border-0 bg-transparent shadow-none py-2 @error('link_gmaps') is-invalid @enderror"
                                       value="{{ old('link_gmaps', ($umkm->link_gmaps ?? '') == 'BELUM_TERDAFTAR' ? '' : ($umkm->link_gmaps ?? '')) }}"
                                       placeholder="https://maps.app.goo.gl/...">
                            </div>
                            <small class="text-muted d-block mt-1" style="font-size:0.72rem;">
                                <i data-lucide="info" class="icon-xs me-1"></i>
                                Kosongkan jika belum terdaftar di Google Maps. Koordinat akan diisi otomatis setelah disimpan.
                            </small>
                            @error('link_gmaps') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-5">
                            <label class="form-label small fw-bold text-muted">NAMA TOKO DI GOOGLE MAPS</label>
                            <input type="text" name="nama_toko_gmaps"
                                   class="form-control rounded-3 py-2 border-0 bg-light shadow-none"
                                   value="{{ old('nama_toko_gmaps', $umkm->nama_toko_gmaps ?? '') }}"
                                   placeholder="Jika berbeda dari nama usaha">
                        </div>
                    </div>

                    @if(isset($umkm) && $umkm->hasCoordinates())
                    <div class="p-3 rounded-3 bg-success bg-opacity-10 border border-success border-opacity-25 mb-3 small">
                        <i data-lucide="check-circle" class="icon-xs text-success me-1"></i>
                        <strong>Koordinat terverifikasi:</strong>
                        {{ number_format($umkm->latitude, 6) }}, {{ number_format($umkm->longitude, 6) }}
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill ms-2">{{ $umkm->status_lokasi }}</span>
                    </div>
                    @elseif(isset($umkm))
                    <div class="p-3 rounded-3 bg-warning bg-opacity-10 border border-warning border-opacity-25 mb-3 small">
                        <i data-lucide="alert-triangle" class="icon-xs text-warning me-1"></i>
                        Status lokasi: <strong>{{ $umkm->status_lokasi }}</strong>.
                        @if($umkm->hasGmaps())
                            Koordinat akan diisi otomatis setelah form ini disimpan.
                        @else
                            Tambahkan link Google Maps untuk mengisi koordinat.
                        @endif
                    </div>
                    @endif

                    {{-- ─── Foto Usaha ───────────────────────────────────────────────────── --}}
                    <h6 class="fw-bold text-muted text-uppercase small mb-3 border-bottom pb-2 mt-4">
                        <i data-lucide="image" class="icon-xs me-1"></i>Foto Usaha (Opsional)
                    </h6>

                    <div class="mb-4 p-4 bg-light rounded-4">
                        @if(isset($umkm) && $umkm->foto)
                        <div class="mb-3">
                            <small class="text-muted d-block mb-2">Foto saat ini:</small>
                            <img src="{{ $umkm->foto_url }}" class="rounded-3 shadow-sm border" style="max-height:180px;width:100%;object-fit:cover;">
                        </div>
                        @endif
                        <input type="file" name="foto" class="form-control rounded-pill border-0 shadow-sm bg-white" accept="image/*">
                        <small class="text-muted d-block mt-2"><i data-lucide="image" class="icon-xs me-1"></i>Foto produk atau tampak depan usaha. Maks 2MB.</small>
                        @error('foto') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    {{-- ─── Submit ───────────────────────────────────────────────────────── --}}
                    <div class="pt-4 border-top d-flex justify-content-between">
                        <a href="{{ route('operator.umkm.index') }}" class="btn btn-white border rounded-pill px-4 fw-bold">BATAL</a>
                        <button type="submit" class="btn btn-success rounded-pill px-5 fw-bold shadow-sm hover-lift border-0">
                            <i data-lucide="save" class="icon-sm me-1"></i>
                            {{ isset($umkm) ? 'SIMPAN PERUBAHAN' : 'TAMBAH UMKM' }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
