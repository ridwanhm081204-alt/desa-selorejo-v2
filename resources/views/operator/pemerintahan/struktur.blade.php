@extends('layouts.dashboard')
@section('title', 'Struktur Organisasi')
@section('content')

<!-- Section Hero Setting (CMS) -->
<div class="dash-card bg-white p-4 mb-4 border-top border-4 border-success shadow-sm rounded-4 text-start">
    <h6 class="fw-bold mb-3 d-flex align-items-center"><i data-lucide="image" class="text-success me-2 icon-sm"></i> Pengaturan Header Halaman</h6>
    <form action="{{ url('operator/struktur/hero') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="small fw-bold text-muted">Judul Halaman</label>
                <input type="text" name="title" class="form-control form-control-sm" value="{{ $hero['title'] ?? 'Struktur Organisasi' }}">
            </div>
            <div class="col-md-5">
                <label class="small fw-bold text-muted">Sub-Judul</label>
                <input type="text" name="subtitle" class="form-control form-control-sm" value="{{ $hero['subtitle'] ?? 'Jajaran Perangkat Desa Selorejo Periode Terkini' }}">
            </div>
            <div class="col-md-2">
                <label class="small fw-bold text-muted">Ikon (Lucide)</label>
                <input type="text" name="icon" class="form-control form-control-sm" value="{{ $hero['icon'] ?? 'network' }}">
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="submit" class="btn btn-sm btn-success w-100 shadow-sm border-0">Simpan</button>
            </div>
        </div>
    </form>
</div>

<!-- Header Manajemen -->
<div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
    <div class="card-body p-4 d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-0">Data Aparat Desa</h5>
            <small class="text-muted">Kelola jajaran pimpinan dan perangkat desa</small>
        </div>
        <button class="btn btn-success rounded-pill px-4 shadow-sm hover-lift border-0" data-bs-toggle="modal" data-bs-target="#addModal">
            <i data-lucide="user-plus" class="icon-sm me-1"></i> Tambah Aparat
        </button>
    </div>
</div>

<!-- Table Struktur -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-center text-start">
                <thead class="bg-light text-uppercase">
                    <tr>
                        <th class="ps-4 py-3 small fw-bold text-muted text-start" style="width: 8%">No</th>
                        <th class="py-3 small fw-bold text-muted text-start">Jabatan</th>
                        <th class="py-3 small fw-bold text-muted text-start">Nama Pejabat</th>
                        <th class="py-3 small fw-bold text-muted">Foto</th>
                        <th class="text-end pe-4 py-3 small fw-bold text-muted" style="width: 15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $item)
                    <tr>
                        <td class="ps-4 py-3 text-start fw-bold text-muted">{{ $item->urutan }}</td>
                        <td class="py-3 text-start fw-bold text-dark">{{ $item->jabatan }}</td>
                        <td class="py-3 text-start text-muted">{{ $item->nama_pejabat }}</td>
                        <td class="py-3">
                            @if($item->foto)
                                <img src="{{ asset('storage/'.$item->foto) }}" class="rounded-circle shadow-sm border border-2 border-white" style="width:45px; height:45px; object-fit:cover;">
                            @else
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width:45px; height:45px;">
                                    <i data-lucide="user" class="text-muted opacity-50 icon-sm"></i>
                                </div>
                            @endif
                        </td>
                        <td class="text-end pe-4 py-3">
                            <div class="d-flex justify-content-end gap-2">
                                <button class="btn btn-sm btn-white border shadow-sm hover-lift" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}" title="Edit Aparat">
                                    <i data-lucide="edit-3" class="icon-xs text-primary"></i>
                                </button>
                                <form action="{{ route('operator.struktur.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data aparat ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-white border shadow-sm hover-lift" title="Hapus Aparat">
                                        <i data-lucide="trash-2" class="icon-xs text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted bg-white">
                            <i data-lucide="users" class="icon-xl opacity-25 mb-2 d-block mx-auto text-success"></i>
                            Belum ada data aparat yang diinput.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($data as $item)
<!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <form action="{{ route('operator.struktur.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
      @csrf @method('PUT')
      <div class="modal-header border-0 bg-success text-white py-3">
        <h5 class="modal-title fw-bold"><i data-lucide="edit-3" class="icon-sm me-2"></i> Edit Data Perangkat</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <div class="mb-3">
            <label class="small fw-bold text-muted mb-1">Jabatan Kontrol</label>
            <input type="text" name="jabatan" class="form-control rounded-3" value="{{ $item->jabatan }}" required>
        </div>
        <div class="mb-3">
            <label class="small fw-bold text-muted mb-1">Nama Lengkap Pejabat</label>
            <input type="text" name="nama_pejabat" class="form-control rounded-3" value="{{ $item->nama_pejabat }}" required>
        </div>
        <div class="mb-3">
            <label class="small fw-bold text-muted mb-1">Urutan Prioritas (Angka)</label>
            <input type="number" name="urutan" class="form-control rounded-3" value="{{ $item->urutan }}" required>
            <small class="text-muted mt-2 d-block">Angka terkecil tampil paling atas.</small>
        </div>
        <div class="mb-0">
            <label class="small fw-bold text-muted mb-1">Ganti Foto Profil</label>
            <input type="file" name="foto" class="form-control rounded-3">
        </div>
      </div>
      <div class="modal-footer border-0 p-4 pt-0">
        <button type="button" class="btn btn-light px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success px-4 rounded-pill shadow-sm">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>
@endforeach

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <form action="{{ route('operator.struktur.store') }}" method="POST" enctype="multipart/form-data" class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
      @csrf
      <div class="modal-header border-0 bg-success text-white py-3">
        <h5 class="modal-title fw-bold"><i data-lucide="user-plus" class="icon-sm me-2"></i> Tambah Perangkat Desa</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <div class="mb-3">
            <label class="small fw-bold text-muted mb-1">Jabatan</label>
            <input type="text" name="jabatan" class="form-control rounded-3" placeholder="Contoh: Kepala Desa" required>
        </div>
        <div class="mb-3">
            <label class="small fw-bold text-muted mb-1">Nama Lengkap</label>
            <input type="text" name="nama_pejabat" class="form-control rounded-3" placeholder="Nama tanpa gelar/dengan gelar" required>
        </div>
        <div class="mb-3">
            <label class="small fw-bold text-muted mb-1">Urutan Prioritas</label>
            <input type="number" name="urutan" class="form-control rounded-3" placeholder="1, 2, 3, ..." required>
        </div>
        <div class="mb-0">
            <label class="small fw-bold text-muted mb-1">Foto Profil</label>
            <input type="file" name="foto" class="form-control rounded-3">
        </div>
      </div>
      <div class="modal-footer border-0 p-4 pt-0">
        <button type="button" class="btn btn-light px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success px-4 rounded-pill shadow-sm">Tambahkan</button>
      </div>
    </form>
  </div>
</div>
@endsection
