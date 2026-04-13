@extends('layouts.dashboard')
@section('title', 'Lembaga Desa')
@section('content')

<!-- Section Hero Setting (CMS) -->
<div class="dash-card bg-white p-4 mb-4 border-top border-4 border-success shadow-sm rounded-4 text-start">
    <h6 class="fw-bold mb-3 d-flex align-items-center"><i data-lucide="image" class="text-success me-2 icon-sm"></i> Pengaturan Header Halaman</h6>
    <form action="{{ url('operator/lembaga/hero') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="small fw-bold text-muted">Judul Halaman</label>
                <input type="text" name="title" class="form-control form-control-sm" value="{{ $hero['title'] ?? 'Lembaga Desa' }}">
            </div>
            <div class="col-md-5">
                <label class="small fw-bold text-muted">Sub-Judul</label>
                <input type="text" name="subtitle" class="form-control form-control-sm" value="{{ $hero['subtitle'] ?? 'Lembaga Kemasyarakatan Pendukung Pembangunan Desa' }}">
            </div>
            <div class="col-md-2">
                <label class="small fw-bold text-muted">Ikon (Lucide)</label>
                <input type="text" name="icon" class="form-control form-control-sm" value="{{ $hero['icon'] ?? 'building-2' }}">
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="submit" class="btn btn-sm btn-success w-100 shadow-sm border-0">Simpan</button>
            </div>
        </div>
    </form>
</div>

<!-- Header Manajemen -->
<div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden text-start">
    <div class="card-body p-4 d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-0">Lembaga Masyarakat</h5>
            <small class="text-muted">Kelola jajaran organisasi kemasyarakatan desa</small>
        </div>
        <button class="btn btn-success rounded-pill px-4 shadow-sm hover-lift border-0" data-bs-toggle="modal" data-bs-target="#addModal">
            <i data-lucide="plus" class="icon-sm me-1"></i> Tambah Lembaga
        </button>
    </div>
</div>

<!-- Table Lembaga -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden text-start">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-uppercase">
                    <tr>
                        <th class="ps-4 py-3 small fw-bold text-muted" style="width: 25%">Nama Lembaga</th>
                        <th class="py-3 small fw-bold text-muted">Jenis / Bidang</th>
                        <th class="py-3 small fw-bold text-muted">Ketua</th>
                        <th class="py-3 small fw-bold text-muted text-center" style="width: 15%">Logo/Foto</th>
                        <th class="text-end pe-4 py-3 small fw-bold text-muted" style="width: 15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $item)
                    <tr>
                        <td class="ps-4 py-3 fw-bold text-dark">{{ $item->nama_lembaga }}</td>
                        <td class="py-3">
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">{{ $item->jenis }}</span>
                        </td>
                        <td class="py-3 fw-medium text-dark">{{ $item->ketua }}</td>
                        <td class="py-3 text-center">
                            @if($item->foto)
                                <img src="{{ asset('storage/'.$item->foto) }}" class="rounded-3 shadow-sm border border-light" style="width:50px; height:50px; object-fit:cover;">
                            @else
                                <div class="bg-light rounded-3 d-flex align-items-center justify-content-center mx-auto shadow-sm" style="width:50px; height:50px;">
                                    <i data-lucide="building-2" class="text-muted opacity-50 icon-sm"></i>
                                </div>
                            @endif
                        </td>
                        <td class="text-end pe-4 py-3">
                            <div class="d-flex justify-content-end gap-2">
                                <button class="btn btn-sm btn-white border shadow-sm hover-lift" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}" title="Edit Lembaga">
                                    <i data-lucide="edit-3" class="icon-xs text-primary"></i>
                                </button>
                                <form action="{{ route('operator.lembaga.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus lembaga ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-white border shadow-sm hover-lift" title="Hapus Lembaga">
                                        <i data-lucide="trash-2" class="icon-xs text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted bg-white">
                            <i data-lucide="building-2" class="icon-xl opacity-25 mb-2 d-block mx-auto text-success"></i>
                            Belum ada lembaga yang diinput.
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
  <div class="modal-dialog modal-dialog-centered text-start">
    <form action="{{ route('operator.lembaga.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
      @csrf @method('PUT')
      <div class="modal-header border-0 bg-success text-white py-3">
        <h5 class="modal-title fw-bold"><i data-lucide="edit-3" class="icon-sm me-2"></i> Edit Data Lembaga</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <div class="mb-3">
            <label class="small fw-bold text-muted mb-1">Nama Lembaga</label>
            <input type="text" name="nama_lembaga" class="form-control rounded-3" value="{{ $item->nama_lembaga }}" required>
        </div>
        <div class="mb-3">
            <label class="small fw-bold text-muted mb-1">Jenis / Bidang Lembaga</label>
            <input type="text" name="jenis" class="form-control rounded-3" value="{{ $item->jenis }}" required>
        </div>
        <div class="mb-3">
            <label class="small fw-bold text-muted mb-1">Nama Ketua Lembaga</label>
            <input type="text" name="ketua" class="form-control rounded-3" value="{{ $item->ketua }}" required>
        </div>
        <div class="mb-3">
            <label class="small fw-bold text-muted mb-1">Deskripsi Singkat (Opsional)</label>
            <textarea name="deskripsi" class="form-control rounded-3" rows="3">{{ $item->deskripsi }}</textarea>
        </div>
        <div class="mb-0">
            <label class="small fw-bold text-muted mb-1 d-block">Ganti Foto/Logo</label>
            <input type="file" name="foto" class="form-control rounded-3">
        </div>
      </div>
      <div class="modal-footer border-0 p-4 pt-0">
        <button type="button" class="btn btn-light px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success px-4 rounded-pill shadow-sm">Update Data</button>
      </div>
    </form>
  </div>
</div>
@endforeach

<div class="modal fade" id="addModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered text-start">
    <form action="{{ route('operator.lembaga.store') }}" method="POST" enctype="multipart/form-data" class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
      @csrf
      <div class="modal-header border-0 bg-success text-white py-3">
        <h5 class="modal-title fw-bold"><i data-lucide="plus" class="icon-sm me-2"></i> Tambah Lembaga Desa</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <div class="mb-3">
            <label class="small fw-bold text-muted mb-1">Nama Lembaga</label>
            <input type="text" name="nama_lembaga" class="form-control rounded-3" placeholder="Contoh: PKK, Karang Taruna" required>
        </div>
        <div class="mb-3">
            <label class="small fw-bold text-muted mb-1">Jenis / Bidang</label>
            <input type="text" name="jenis" class="form-control rounded-3" placeholder="Contoh: Pemberdayaan Perempuan" required>
        </div>
        <div class="mb-3">
            <label class="small fw-bold text-muted mb-1">Nama Ketua</label>
            <input type="text" name="ketua" class="form-control rounded-3" placeholder="Nama lengkap ketua" required>
        </div>
        <div class="mb-3">
            <label class="small fw-bold text-muted mb-1">Deskripsi Singkat</label>
            <textarea name="deskripsi" class="form-control rounded-3" rows="3" placeholder="Tulis visi misi atau profil singkat lembaga..."></textarea>
        </div>
        <div class="mb-0">
            <label class="small fw-bold text-muted mb-1 d-block">Upload Logo/Foto</label>
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
