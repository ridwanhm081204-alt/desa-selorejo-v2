@extends('layouts.dashboard')
@section('title', 'Produk Hukum')
@section('content')

<!-- Section Hero Setting (CMS) -->
<div class="dash-card bg-white p-4 mb-4 border-top border-4 border-success shadow-sm rounded-4 text-start">
    <h6 class="fw-bold mb-3 d-flex align-items-center"><i data-lucide="image" class="text-success me-2 icon-sm"></i> Pengaturan Header Halaman</h6>
    <form action="{{ url('operator/produkhukum/hero') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="small fw-bold text-muted">Judul Halaman</label>
                <input type="text" name="title" class="form-control form-control-sm" value="{{ $hero['title'] ?? 'Produk Hukum' }}">
            </div>
            <div class="col-md-5">
                <label class="small fw-bold text-muted">Sub-Judul</label>
                <input type="text" name="subtitle" class="form-control form-control-sm" value="{{ $hero['subtitle'] ?? 'Kumpulan Peraturan Desa, Keputusan Kepala Desa, dan Dokumen Hukum Lainnya.' }}">
            </div>
            <div class="col-md-2">
                <label class="small fw-bold text-muted">Ikon (Lucide)</label>
                <input type="text" name="icon" class="form-control form-control-sm" value="{{ $hero['icon'] ?? 'scale' }}">
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
            <h5 class="fw-bold mb-0">Daftar Produk Hukum</h5>
            <small class="text-muted">Kelola dokumen hukum dan peraturan desa</small>
        </div>
        <button class="btn btn-success rounded-pill px-4 shadow-sm hover-lift border-0" data-bs-toggle="modal" data-bs-target="#addModal">
            <i data-lucide="plus" class="icon-sm me-1"></i> Tambah Dokumen
        </button>
    </div>
</div>

<!-- Table Produk Hukum -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden text-start">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-uppercase">
                    <tr>
                        <th class="ps-4 py-3 small fw-bold text-muted" style="width: 40%">Judul / Keterangan</th>
                        <th class="py-3 small fw-bold text-muted text-center">Jenis & Tahun</th>
                        <th class="py-3 small fw-bold text-muted text-center">Tgl Ditetapkan</th>
                        <th class="py-3 small fw-bold text-muted text-center">Dokumen PDF</th>
                        <th class="text-end pe-4 py-3 small fw-bold text-muted" style="width: 15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $item)
                    <tr>
                        <td class="ps-4 py-3 fw-bold text-dark">
                            {{ $item->judul }}
                        </td>
                        <td class="py-3 fw-medium text-center text-success">
                            <span class="badge bg-success-subtle text-success">{{ $item->jenis }}</span><br>
                            <small class="text-muted">Tahun {{ $item->tahun }}</small>
                        </td>
                        <td class="py-3 text-center text-muted">
                            {{ $item->tanggal_ditetapkan ? \Carbon\Carbon::parse($item->tanggal_ditetapkan)->translatedFormat('d F Y') : '-' }}
                        </td>
                        <td class="py-3 text-center">
                            @if($item->dokumen_pdf)
                                <a href="{{ asset('storage/'.$item->dokumen_pdf) }}" target="_blank" class="btn btn-sm btn-outline-danger hover-lift">
                                    <i data-lucide="file-text" class="icon-xs me-1"></i> Lihat PDF
                                </a>
                            @else
                                <span class="badge bg-light text-muted">Tidak Ada Dokumen</span>
                            @endif
                        </td>
                        <td class="text-end pe-4 py-3">
                            <div class="d-flex justify-content-end gap-2">
                                <button class="btn btn-sm btn-white border shadow-sm hover-lift" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}" title="Edit Dokumen">
                                    <i data-lucide="edit-3" class="icon-xs text-primary"></i>
                                </button>
                                <form action="{{ route('operator.produkhukum.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus dokumen ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-white border shadow-sm hover-lift" title="Hapus Dokumen">
                                        <i data-lucide="trash-2" class="icon-xs text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted bg-white">
                            <i data-lucide="scale" class="icon-xl opacity-25 mb-2 d-block mx-auto text-success"></i>
                            Belum ada dokumen produk hukum yang diinput.
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
    <form action="{{ route('operator.produkhukum.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="modal-content border-0 shadow-lg rounded-4">
      @csrf @method('PUT')
      <div class="modal-header border-0 bg-success text-white py-3">
        <h5 class="modal-title fw-bold"><i data-lucide="edit-3" class="icon-sm me-2"></i> Edit Produk Hukum</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <div class="mb-3">
            <label class="small fw-bold text-muted mb-1">Judul Dokumen</label>
            <input type="text" name="judul" class="form-control rounded-3" value="{{ $item->judul }}" required>
        </div>
        <div class="row g-2 mb-3">
            <div class="col-md-6">
                <label class="small fw-bold text-muted mb-1">Jenis Peraturan</label>
                <select name="jenis" class="form-select rounded-3" required>
                    <option value="Peraturan Desa" {{ $item->jenis == 'Peraturan Desa' ? 'selected' : '' }}>Peraturan Desa</option>
                    <option value="Peraturan Kepala Desa" {{ $item->jenis == 'Peraturan Kepala Desa' ? 'selected' : '' }}>Peraturan Kepala Desa</option>
                    <option value="Keputusan Kepala Desa" {{ $item->jenis == 'Keputusan Kepala Desa' ? 'selected' : '' }}>Keputusan Kepala Desa</option>
                    <option value="Peraturan Bersama" {{ $item->jenis == 'Peraturan Bersama' ? 'selected' : '' }}>Peraturan Bersama</option>
                    <option value="Lainnya" {{ $item->jenis == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="small fw-bold text-muted mb-1">Tahun</label>
                <input type="number" name="tahun" class="form-control rounded-3" value="{{ $item->tahun }}" required min="2000" max="2100">
            </div>
        </div>
        <div class="mb-3">
            <label class="small fw-bold text-muted mb-1">Tanggal Ditetapkan (Opsional)</label>
            <input type="date" name="tanggal_ditetapkan" class="form-control rounded-3" value="{{ $item->tanggal_ditetapkan }}">
        </div>
        <div class="mb-3 text-start">
            <label class="small fw-bold text-muted mb-1 d-block">Konten Dokumen (Teks Bebas / HTML)</label>
            <textarea name="konten" class="form-control rounded-3" rows="10" placeholder="Salin teks dokumen hukum ke sini jika tidak ada PDF...">{{ $item->konten }}</textarea>
        </div>
        <div class="mb-0 text-start">
            <label class="small fw-bold text-muted mb-1 d-block">Upload Dokumen PDF (Maks 10MB)</label>
            @if($item->dokumen_pdf)
                <small class="text-muted mb-2 d-block">File saat ini: <a href="{{ asset('storage/'.$item->dokumen_pdf) }}" target="_blank">Lihat PDF</a></small>
            @endif
            <input type="file" name="dokumen_pdf" class="form-control rounded-3" accept=".pdf">
            <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengubah file PDF.</small>
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

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered text-start">
    <form action="{{ route('operator.produkhukum.store') }}" method="POST" enctype="multipart/form-data" class="modal-content border-0 shadow-lg rounded-4">
      @csrf
      <div class="modal-header border-0 bg-success text-white py-3">
        <h5 class="modal-title fw-bold"><i data-lucide="plus" class="icon-sm me-2"></i> Tambah Produk Hukum</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <div class="mb-3">
            <label class="small fw-bold text-muted mb-1">Judul Dokumen</label>
            <input type="text" name="judul" class="form-control rounded-3" placeholder="Contoh: Rencana Kerja Pemerintah Desa Selorejo Tahun 2026" required>
        </div>
        <div class="row g-2 mb-3">
            <div class="col-md-6">
                <label class="small fw-bold text-muted mb-1">Jenis Peraturan</label>
                <select name="jenis" class="form-select rounded-3" required>
                    <option value="">-- Pilih Jenis --</option>
                    <option value="Peraturan Desa">Peraturan Desa</option>
                    <option value="Peraturan Kepala Desa">Peraturan Kepala Desa</option>
                    <option value="Keputusan Kepala Desa">Keputusan Kepala Desa</option>
                    <option value="Peraturan Bersama">Peraturan Bersama</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="small fw-bold text-muted mb-1">Tahun</label>
                <input type="number" name="tahun" class="form-control rounded-3" value="{{ date('Y') }}" required min="2000" max="2100">
            </div>
        </div>
        <div class="mb-3">
            <label class="small fw-bold text-muted mb-1">Tanggal Ditetapkan (Opsional)</label>
            <input type="date" name="tanggal_ditetapkan" class="form-control rounded-3">
        </div>
        <div class="mb-3 text-start">
            <label class="small fw-bold text-muted mb-1 d-block">Konten Dokumen (Teks Bebas / HTML)</label>
            <textarea name="konten" class="form-control rounded-3" rows="10" placeholder="Salin teks dokumen hukum ke sini jika tidak ada PDF..."></textarea>
        </div>
        <div class="mb-0 text-start">
            <label class="small fw-bold text-muted mb-1 d-block">Upload Dokumen PDF (Maks 10MB)</label>
            <input type="file" name="dokumen_pdf" class="form-control rounded-3" accept=".pdf">
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
