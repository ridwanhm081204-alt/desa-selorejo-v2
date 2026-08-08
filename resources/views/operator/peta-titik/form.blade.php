@extends('layouts.dashboard')
@section('title', isset($titik) ? 'Edit Titik Peta' : 'Tambah Titik Peta')
@section('content')

@php use App\Models\PetaTitik; use App\Models\Umkm; @endphp

<div class="row text-start">
    <div class="col-12 col-lg-8 mx-auto">

        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('operator.profil.peta') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
                <i data-lucide="arrow-left" style="width:14px;height:14px;" class="me-1"></i> Kembali
            </a>
            <h4 class="fw-bold mb-0">{{ isset($titik) ? 'Edit Titik Peta' : 'Tambah Titik Peta Baru' }}</h4>
        </div>

        @if($errors->any())
            <div class="alert alert-danger rounded-4 mb-4 border-0 shadow-sm">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($titik) ? route('operator.peta-titik.update', $titik->id) : route('operator.peta-titik.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($titik)) @method('PUT') @endif

            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden border-top border-4 border-success">
                <div class="card-body p-4 p-md-5">
                    <h5 class="fw-bold mb-4 d-flex align-items-center">
                        <i data-lucide="map-pin" class="text-success me-3"></i> Informasi Titik
                    </h5>

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-bold text-muted small">Nama Titik <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control rounded-3 @error('nama') is-invalid @enderror"
                                   value="{{ old('nama', $titik->nama ?? '') }}" placeholder="cth. Wisata Petik Jeruk Pak Muji" required>
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small">Kategori <span class="text-danger">*</span></label>
                            <select name="kategori" class="form-select rounded-3 @error('kategori') is-invalid @enderror" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach(PetaTitik::KATEGORI_LIST as $kSlug => $kLabel)
                                    <option value="{{ $kSlug }}" @selected(old('kategori', $titik->kategori ?? '') === $kSlug)>
                                        {{ PetaTitik::KATEGORI_ICONS[$kSlug] ?? '' }} {{ $kLabel }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small">Dusun <span class="text-danger">*</span></label>
                            <select name="dusun" class="form-select rounded-3 @error('dusun') is-invalid @enderror" required>
                                <option value="">-- Pilih Dusun --</option>
                                @foreach(PetaTitik::DUSUN_LIST as $d)
                                    <option value="{{ $d }}" @selected(old('dusun', $titik->dusun ?? '') === $d)>Dusun {{ ucfirst($d) }}</option>
                                @endforeach
                            </select>
                            @error('dusun') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold text-muted small">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control rounded-3 @error('deskripsi') is-invalid @enderror"
                                      rows="3" placeholder="Deskripsi singkat tentang tempat ini (opsional, dipakai untuk destinasi unggulan)">{{ old('deskripsi', $titik->deskripsi ?? '') }}</textarea>
                            @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small">Sumber Data</label>
                            <input type="text" name="sumber_data" class="form-control rounded-3"
                                   value="{{ old('sumber_data', $titik->sumber_data ?? 'Observasi Lapangan 2026') }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold text-muted small">Urutan Tampil</label>
                            <input type="number" name="urutan_tampil" class="form-control rounded-3" min="0"
                                   value="{{ old('urutan_tampil', $titik->urutan_tampil ?? 0) }}">
                            <div class="form-text">Semakin kecil angka, tampil lebih awal.</div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold text-muted small">Tandai sebagai Destinasi Unggulan?</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" name="is_wisata_unggulan" id="is_wisata_unggulan" value="1"
                                       @checked(old('is_wisata_unggulan', $titik->is_wisata_unggulan ?? false))>
                                <label class="form-check-label fw-semibold" for="is_wisata_unggulan" style="color:#e65100;">⭐ Destinasi Unggulan</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Foto --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3 d-flex align-items-center">
                        <i data-lucide="image" class="text-success me-2" style="width:16px;height:16px;"></i> Foto
                    </h6>
                    @if(isset($titik) && $titik->foto && !str_starts_with($titik->foto, 'http'))
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $titik->foto) }}" alt="Foto" class="rounded-3 border" style="max-height:120px;object-fit:cover;">
                            <small class="text-muted ms-2">Foto saat ini</small>
                        </div>
                    @endif
                    <input type="file" name="foto" class="form-control rounded-3 @error('foto') is-invalid @enderror" accept="image/*">
                    <div class="form-text">Format: JPG, PNG, WebP. Maks. 4MB. Kosongkan jika tidak ingin mengganti.</div>
                    @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            {{-- Koordinat (opsional) --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-1 d-flex align-items-center">
                        <i data-lucide="crosshair" class="text-primary me-2" style="width:16px;height:16px;"></i> Koordinat GPS
                        <span class="badge rounded-pill ms-2 bg-secondary" style="font-size:0.65rem;">Opsional</span>
                    </h6>
                    <p class="text-muted small mb-3">Koordinat boleh dikosongkan sekarang dan diisi belakangan. Tidak mempengaruhi tampilan peta statis.</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Latitude</label>
                            <input type="number" name="latitude" step="0.0000001" class="form-control rounded-3 @error('latitude') is-invalid @enderror"
                                   value="{{ old('latitude', $titik->latitude ?? '') }}" placeholder="cth. -7.9368">
                            @error('latitude') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Longitude</label>
                            <input type="number" name="longitude" step="0.0000001" class="form-control rounded-3 @error('longitude') is-invalid @enderror"
                                   value="{{ old('longitude', $titik->longitude ?? '') }}" placeholder="cth. 112.5275">
                            @error('longitude') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Link ke UMKM / Wisata (opsional) --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-1 d-flex align-items-center">
                        <i data-lucide="link" class="text-warning me-2" style="width:16px;height:16px;"></i> Tautkan ke Data UMKM / Wisata
                        <span class="badge rounded-pill ms-2 bg-secondary" style="font-size:0.65rem;">Opsional</span>
                    </h6>
                    <p class="text-muted small mb-3">Tautkan titik peta ini ke data pelaku UMKM atau objek wisata yang sudah terdaftar untuk menghubungkan ke halaman detail secara otomatis.</p>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Tautkan ke Data UMKM</label>
                            <select name="umkm_id" class="form-select rounded-3">
                                <option value="">-- Tidak ditautkan ke UMKM --</option>
                                @foreach(Umkm::orderBy('nama_usaha')->get() as $u)
                                    <option value="{{ $u->id }}" @selected(old('umkm_id', ($titik->umkm_id ?? null)) == $u->id)>
                                        {{ $u->nama_usaha }} ({{ $u->dusun }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Tautkan ke Objek Wisata</label>
                            <select name="wisata_id" class="form-select rounded-3">
                                <option value="">-- Tidak ditautkan ke Objek Wisata --</option>
                                @foreach(\App\Models\Wisata::orderBy('judul')->get() as $w)
                                    <option value="{{ $w->id }}" @selected(old('wisata_id', ($titik->wisata_id ?? null)) == $w->id)>
                                        {{ $w->judul }} ({{ $w->kategori }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-success rounded-pill px-5 fw-bold">
                    <i data-lucide="save" class="me-2" style="width:16px;height:16px;"></i>
                    {{ isset($titik) ? 'Simpan Perubahan' : 'Tambah Titik Peta' }}
                </button>
                <a href="{{ route('operator.profil.peta') }}" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
            </div>

        </form>
    </div>
</div>

@endsection
