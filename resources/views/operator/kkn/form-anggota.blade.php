@extends('layouts.dashboard')
@section('title', isset($anggota) ? 'Edit Anggota KKN' : 'Tambah Anggota KKN')
@section('content')

<div class="row text-start">
    <div class="col-lg-8 col-xl-7 mx-auto">
        <div class="mb-4">
            <a href="/operator/kkn" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm hover-lift">
                <i data-lucide="arrow-left" class="icon-sm me-1"></i> Kembali ke Daftar
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i data-lucide="check-circle" class="me-2 icon-sm"></i>
                    <div class="fw-bold">{{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden border-top border-4 border-success">
            <div class="card-body p-4 p-md-5">
                <h5 class="fw-bold mb-4">
                    <i data-lucide="{{ isset($anggota) ? 'pencil' : 'user-plus' }}" class="text-success me-2"></i>
                    {{ isset($anggota) ? 'Edit Data Anggota' : 'Tambah Anggota KKN' }}
                </h5>

                @php
                    $formAction = isset($anggota) ? '/operator/kkn/' . $anggota->id : '/operator/kkn';
                @endphp
                <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($anggota)) @method('PUT') @endif

                    {{-- Urutan & Badge --}}
                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted">Urutan Tampil</label>
                            <input type="number" name="urutan" class="form-control rounded-3" min="1"
                                   value="{{ old('urutan', $anggota->urutan ?? '') }}" placeholder="1">
                            <small class="text-muted">Angka kecil tampil lebih awal</small>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">Badge / Peran Khusus</label>
                            <select name="badge" class="form-select rounded-3">
                                <option value="">— Anggota Biasa —</option>
                                <option value="ketua" {{ old('badge', $anggota->badge ?? '') === 'ketua' ? 'selected' : '' }}>⭐ Ketua Kelompok</option>
                                <option value="developer" {{ old('badge', $anggota->badge ?? '') === 'developer' ? 'selected' : '' }}>💻 Pengembang Website</option>
                            </select>
                        </div>
                    </div>

                    {{-- Identitas --}}
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <label class="form-label small fw-bold text-muted">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control rounded-3 @error('nama') is-invalid @enderror"
                                   value="{{ old('nama', $anggota->nama ?? '') }}" placeholder="Nama lengkap anggota" required>
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">NIM</label>
                            <input type="text" name="nim" class="form-control rounded-3"
                                   value="{{ old('nim', $anggota->nim ?? '') }}" placeholder="K3523066">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label small fw-bold text-muted">Program Studi</label>
                            <input type="text" name="prodi" class="form-control rounded-3"
                                   value="{{ old('prodi', $anggota->prodi ?? '') }}" placeholder="Pendidikan Teknik Informatika dan Komputer">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">Fakultas</label>
                            <input type="text" name="fakultas" class="form-control rounded-3"
                                   value="{{ old('fakultas', $anggota->fakultas ?? '') }}" placeholder="FKIP UNS">
                        </div>
                    </div>

                    {{-- Foto --}}
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted">Foto Anggota</label>
                        <div class="p-4 border rounded-4 bg-light">
                            <div class="d-flex align-items-start gap-4">
                                @if(isset($anggota) && $anggota->foto)
                                    @php
                                        $fotoUrl = str_starts_with($anggota->foto, 'images/') ? asset($anggota->foto) : asset('storage/' . $anggota->foto);
                                    @endphp
                                    <img src="{{ $fotoUrl }}" class="rounded-circle border shadow-sm flex-shrink-0"
                                         style="width:80px;height:80px;object-fit:cover;object-position:top;"
                                         onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                                @endif
                                <div class="flex-grow-1">
                                    <input type="file" name="foto" class="form-control rounded-3" accept="image/*">
                                    <small class="text-muted d-block mt-2">Format: JPG, PNG, WebP. Maks 2MB. Foto akan ditampilkan berbentuk bulat.</small>
                                    @if(isset($anggota) && $anggota->foto)
                                        <small class="text-muted d-block">Kosongkan jika tidak ingin mengganti foto.</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Program Kerja --}}
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted">Program Kerja (Proker)</label>
                        <textarea name="proker" class="form-control rounded-3" rows="3"
                                  placeholder="Judul lengkap program kerja utama anggota ini...">{{ old('proker', $anggota->proker ?? '') }}</textarea>
                    </div>

                    {{-- SDG --}}
                    <div class="mb-5">
                        <label class="form-label small fw-bold text-muted">SDG yang Relevan</label>
                        <div class="p-3 bg-light rounded-4">
                            <div class="row g-2">
                                @php
                                    $sdgList = [1 => 'SDG 1 (Kemiskinan)', 3 => 'SDG 3 (Kesehatan)', 4 => 'SDG 4 (Pendidikan)',
                                                8 => 'SDG 8 (Pekerjaan)', 9 => 'SDG 9 (Inovasi)', 10 => 'SDG 10 (Kesetaraan)',
                                                11 => 'SDG 11 (Kota)', 17 => 'SDG 17 (Kemitraan)'];
                                    $selectedSdg = old('sdg', $anggota->sdg ?? []);
                                @endphp
                                @foreach($sdgList as $num => $label)
                                <div class="col-6 col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="sdg[]" value="{{ $num }}"
                                               id="sdg_{{ $num }}"
                                               {{ in_array($num, $selectedSdg) ? 'checked' : '' }}>
                                        <label class="form-check-label small" for="sdg_{{ $num }}">{{ $label }}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="d-flex gap-3 justify-content-end">
                        <a href="/operator/kkn" class="btn btn-light rounded-pill px-4 border hover-lift">Batal</a>
                        <button type="submit" class="btn btn-success rounded-pill px-5 fw-bold shadow border-0 hover-lift">
                            <i data-lucide="save" class="icon-sm me-1"></i>
                            {{ isset($anggota) ? 'Simpan Perubahan' : 'Tambah Anggota' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
