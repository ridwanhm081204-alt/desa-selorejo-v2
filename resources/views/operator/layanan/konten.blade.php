@extends('layouts.dashboard')
@section('title', 'Kelola Konten Layanan Administrasi')
@section('content')

<div class="row text-start">
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i data-lucide="check-circle" class="me-2 icon-sm"></i>
                    <div class="fw-bold">{{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="fw-bold mb-1"><i data-lucide="file-text" class="text-success me-2"></i> Konten Layanan Administrasi</h5>
                <small class="text-muted">Edit nama, deskripsi, warna, dan ikon untuk setiap kartu layanan di halaman publik.</small>
            </div>
            <a href="{{ url('/layanan') }}" target="_blank" class="btn btn-sm btn-light rounded-pill px-3 border hover-lift">
                <i data-lucide="eye" class="icon-xs me-1"></i> Preview
            </a>
        </div>

        {{-- Preview Kartu --}}
        <div class="card border-0 shadow-sm rounded-4 mb-5 bg-light overflow-hidden">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <span class="badge rounded-pill bg-white text-muted border px-3 py-2 small fw-bold shadow-sm">
                        <i data-lucide="eye" class="icon-xs me-1"></i> Preview Halaman /layanan (Live)
                    </span>
                </div>
                <div class="row g-3 justify-content-center" id="preview-container">
                    @foreach($layanan as $lk)
                    <div class="col-md-3" id="preview-card-{{ $lk->id }}">
                        <div class="card border-0 shadow-sm rounded-4 h-100 text-center" style="opacity: {{ $lk->aktif ? '1' : '0.5' }}">
                            <div class="p-3" style="background: {{ $lk->warna_hex }}20;">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-2 shadow-sm" style="width:55px;height:55px;background:{{ $lk->warna_hex }};color:#fff;">
                                    <i data-lucide="{{ $lk->icon_name }}" style="width:24px;height:24px;"></i>
                                </div>
                                <div class="fw-bold small text-dark preview-nama-{{ $lk->id }}">{{ $lk->nama }}</div>
                            </div>
                            <div class="card-body p-3">
                                <p class="text-muted" style="font-size:0.78rem; line-height:1.5;" id="preview-desc-{{ $lk->id }}">{{ $lk->deskripsi }}</p>
                                <div class="btn btn-sm rounded-pill py-1 px-3 fw-bold text-white w-100" style="background:{{ $lk->warna_hex }}; font-size:0.75rem;">Pilih Layanan</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Form Edit Batch --}}
        <form action="/operator/layanan-konten/batch" method="POST">
            @csrf

            @foreach($layanan as $idx => $lk)
            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden border-top border-4" style="border-top-color: {{ $lk->warna_hex }} !important;">
                <div class="card-body p-4 p-md-5">
                    <input type="hidden" name="layanan[{{ $idx }}][id]" value="{{ $lk->id }}">

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle flex-shrink-0 shadow-sm"
                             style="width:50px;height:50px;background:{{ $lk->warna_hex }};color:#fff;">
                            <i data-lucide="{{ $lk->icon_name }}" style="width:22px;height:22px;"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Layanan {{ $idx + 1 }}: <span class="text-success">{{ $lk->kode }}</span></h6>
                            <small class="text-muted">Route: {{ $lk->route_name }}</small>
                        </div>
                        <div class="ms-auto form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="layanan[{{ $idx }}][aktif]"
                                   value="1" id="aktif_{{ $lk->id }}" {{ $lk->aktif ? 'checked' : '' }}>
                            <label class="form-check-label small fw-bold" for="aktif_{{ $lk->id }}">Tampilkan</label>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">Nama Layanan</label>
                            <input type="text" name="layanan[{{ $idx }}][nama]" class="form-control rounded-3"
                                   value="{{ $lk->nama }}" placeholder="Nama layanan" required
                                   oninput="document.querySelector('.preview-nama-{{ $lk->id }}').textContent = this.value">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted">Ikon (Lucide)</label>
                            <input type="text" name="layanan[{{ $idx }}][icon_name]" class="form-control rounded-3"
                                   value="{{ $lk->icon_name }}" placeholder="baby, users, contact...">
                            <small class="text-muted"><a href="https://lucide.dev/icons/" target="_blank" class="text-success">Lihat daftar ikon →</a></small>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted">Warna Utama (HEX)</label>
                            <div class="input-group">
                                <span class="input-group-text p-1 border-end-0">
                                    <input type="color" name="layanan[{{ $idx }}][warna_hex]" value="{{ $lk->warna_hex }}"
                                           class="form-control form-control-color border-0 p-0"
                                           style="width:34px;height:34px;cursor:pointer;"
                                           title="Pilih warna">
                                </span>
                                <input type="text" class="form-control rounded-end-3 border-start-0"
                                       value="{{ $lk->warna_hex }}" placeholder="#2AABE2" readonly
                                       style="background:#fff;">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold text-muted">Deskripsi Singkat</label>
                            <textarea name="layanan[{{ $idx }}][deskripsi]" class="form-control rounded-3" rows="2"
                                      placeholder="Penjelasan singkat tentang layanan ini..."
                                      oninput="document.getElementById('preview-desc-{{ $lk->id }}').textContent = this.value">{{ $lk->deskripsi }}</textarea>
                        </div>
                    </div>

                    {{-- Syarat Dokumen --}}
                    <hr class="my-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0 text-dark"><i data-lucide="file-check-2" class="icon-sm text-primary me-2"></i>Syarat Dokumen Dinamis</h6>
                        <button type="button" class="btn btn-sm btn-primary rounded-pill px-3 fw-bold" data-bs-toggle="modal" data-bs-target="#modalAddSyarat{{ $lk->id }}">
                            <i data-lucide="plus" class="icon-xs me-1"></i> Tambah Syarat
                        </button>
                    </div>

                    @if($lk->syarat->count() > 0)
                        <div class="table-responsive rounded-3 border">
                            <table class="table table-hover table-striped mb-0 align-middle small">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th width="20%">Kode Syarat (Input Name)</th>
                                        <th width="25%">Nama Label Tampil</th>
                                        <th width="30%">Keterangan</th>
                                        <th width="10%" class="text-center">Wajib?</th>
                                        <th width="10%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lk->syarat as $s_idx => $syarat)
                                    <tr>
                                        <td class="text-center">{{ $syarat->urutan ?? $s_idx + 1 }}</td>
                                        <td><code class="text-primary">{{ $syarat->kode_syarat }}</code></td>
                                        <td class="fw-bold">{{ $syarat->nama_syarat }}</td>
                                        <td class="text-muted" style="font-size:0.8rem;">{{ $syarat->keterangan ?? '-' }}</td>
                                        <td class="text-center">
                                            @if($syarat->is_required)
                                                <span class="badge bg-danger rounded-pill px-2">Wajib</span>
                                            @else
                                                <span class="badge bg-secondary rounded-pill px-2">Opsional</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-1">
                                                <button type="button" class="btn btn-sm btn-light border text-primary" data-bs-toggle="modal" data-bs-target="#modalEditSyarat{{ $syarat->id }}" title="Edit">
                                                    <i data-lucide="edit-2" style="width:14px;height:14px;"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-light border text-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteSyarat{{ $syarat->id }}" title="Hapus">
                                                    <i data-lucide="trash-2" style="width:14px;height:14px;"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-light border rounded-3 text-center text-muted mb-0">
                            <i data-lucide="info" class="icon-sm mb-1 d-block mx-auto text-muted"></i>
                            Belum ada syarat dokumen dinamis untuk layanan ini.
                        </div>
                    @endif
                </div>
            </div>
            @endforeach

            {{-- Submit --}}
            <div class="card border-0 shadow-sm rounded-4 mb-5 bg-success bg-opacity-10 border-top border-4 border-success">
                <div class="card-body p-4 text-center">
                    <button type="submit" class="btn btn-success px-5 py-3 rounded-pill fw-bold hover-lift shadow border-0">
                        <i data-lucide="save" class="me-2"></i> Simpan Semua Konten Layanan
                    </button>
                    <div class="mt-3 text-muted small">
                        Perubahan akan langsung tampil di <a href="{{ url('/layanan') }}" target="_blank" class="text-success">/layanan</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- MODALS FOR SYARAT DOKUMEN --}}
@foreach($layanan as $lk)
    <!-- Modal Add Syarat -->
    <div class="modal fade" id="modalAddSyarat{{ $lk->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Tambah Syarat: {{ $lk->nama }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('operator.layanan-konten.syarat.store', $lk->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Kode Syarat (Input Name) <span class="text-danger">*</span></label>
                            <input type="text" name="kode_syarat" class="form-control rounded-3" placeholder="file_ktp_pemohon" required>
                            <small class="text-muted" style="font-size:0.75rem;">Gunakan format snake_case tanpa spasi, diawali 'file_' (contoh: file_kk, file_ktp).</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Nama Label Tampil <span class="text-danger">*</span></label>
                            <input type="text" name="nama_syarat" class="form-control rounded-3" placeholder="SCAN KTP ASLI" required>
                            <small class="text-muted" style="font-size:0.75rem;">Label yang akan dibaca oleh warga di form layanan.</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Keterangan / Bantuan</label>
                            <textarea name="keterangan" class="form-control rounded-3" rows="2" placeholder="Format: PDF, JPG, PNG (Max 2MB)"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label small fw-bold text-muted">Wajib Diupload?</label>
                                <select name="is_required" class="form-select rounded-3">
                                    <option value="1">Ya, Wajib</option>
                                    <option value="0">Tidak (Opsional)</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label small fw-bold text-muted">Urutan</label>
                                <input type="number" name="urutan" class="form-control rounded-3" value="{{ $lk->syarat->max('urutan') + 1 }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Simpan Syarat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach($lk->syarat as $syarat)
        <!-- Modal Edit Syarat -->
        <div class="modal fade" id="modalEditSyarat{{ $syarat->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content border-0 shadow rounded-4">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold">Edit Syarat Dokumen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('operator.layanan-konten.syarat.update', $syarat->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Kode Syarat (Input Name) <span class="text-danger">*</span></label>
                                <input type="text" name="kode_syarat" class="form-control rounded-3 bg-light" value="{{ $syarat->kode_syarat }}" required readonly>
                                <small class="text-danger" style="font-size:0.75rem;">Kode syarat tidak bisa diubah karena berpotensi merusak relasi data lama.</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Nama Label Tampil <span class="text-danger">*</span></label>
                                <input type="text" name="nama_syarat" class="form-control rounded-3" value="{{ $syarat->nama_syarat }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Keterangan / Bantuan</label>
                                <textarea name="keterangan" class="form-control rounded-3" rows="2">{{ $syarat->keterangan }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label small fw-bold text-muted">Wajib Diupload?</label>
                                    <select name="is_required" class="form-select rounded-3">
                                        <option value="1" {{ $syarat->is_required ? 'selected' : '' }}>Ya, Wajib</option>
                                        <option value="0" {{ !$syarat->is_required ? 'selected' : '' }}>Tidak (Opsional)</option>
                                    </select>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label small fw-bold text-muted">Urutan</label>
                                    <input type="number" name="urutan" class="form-control rounded-3" value="{{ $syarat->urutan }}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 pt-0">
                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Update Syarat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Delete Syarat -->
        <div class="modal fade" id="modalDeleteSyarat{{ $syarat->id }}" tabindex="-1">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content border-0 shadow rounded-4 text-center p-4">
                    <div class="mb-3">
                        <i data-lucide="alert-triangle" class="text-danger" style="width:48px;height:48px;"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Hapus Syarat?</h5>
                    <p class="text-muted small mb-4">Syarat <strong>{{ $syarat->nama_syarat }}</strong> akan dihapus permanen. Aksi ini tidak dapat dibatalkan.</p>
                    <form action="{{ route('operator.layanan-konten.syarat.destroy', $syarat->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <div class="d-flex gap-2 justify-content-center">
                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold">Ya, Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endforeach

@endsection

@push('scripts')
<script>
// Sync color input teks ketika color picker berubah
document.querySelectorAll('input[type="color"]').forEach(picker => {
    picker.addEventListener('input', function() {
        // Update text input beside it
        const textInput = this.closest('.input-group').querySelector('input[type="text"]');
        if (textInput) textInput.value = this.value;
    });
});
</script>
@endpush
