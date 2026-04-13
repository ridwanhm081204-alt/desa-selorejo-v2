@extends('layouts.dashboard')
@section('title', 'Statistik Penduduk')
@section('content')

<!-- Section Hero Setting (CMS) -->
<div class="dash-card bg-white p-4 mb-4 border-top border-4 border-success shadow-sm rounded-4">
    <h6 class="fw-bold mb-3 d-flex align-items-center"><i data-lucide="image" class="text-success me-2 icon-sm"></i> Pengaturan Header Halaman</h6>
    <form action="{{ url('operator/statistik/hero') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="small fw-bold text-muted">Judul Halaman</label>
                <input type="text" name="title" class="form-control form-control-sm" value="{{ $hero['title'] ?? 'Statistik Demografi Desa' }}">
            </div>
            <div class="col-md-5">
                <label class="small fw-bold text-muted">Sub-Judul</label>
                <input type="text" name="subtitle" class="form-control form-control-sm" value="{{ $hero['subtitle'] ?? 'Transparansi data penduduk Desa Wisata Selorejo berdasarkan angka riil kependudukan.' }}">
            </div>
            <div class="col-md-2">
                <label class="small fw-bold text-muted">Ikon (Lucide)</label>
                <input type="text" name="icon" class="form-control form-control-sm" value="{{ $hero['icon'] ?? 'bar-chart-2' }}">
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
            <h5 class="fw-bold mb-0">Data Statistik Penduduk</h5>
            <small class="text-muted">Kelola data demografis & kependudukan</small>
        </div>
        <a href="{{ route('operator.statistik.create') }}" class="btn btn-success rounded-pill px-4 shadow-sm hover-lift border-0">
            <i data-lucide="plus" class="icon-sm me-1"></i> Tambah Data
        </a>
    </div>
</div>

<!-- Table Statistik -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-uppercase">
                    <tr>
                        <th class="ps-4 py-3 small fw-bold text-muted" style="width: 10%">Tahun</th>
                        <th class="py-3 small fw-bold text-muted">Kategori Data</th>
                        <th class="py-3 small fw-bold text-muted">Label / Keterangan</th>
                        <th class="py-3 small fw-bold text-muted text-center" style="width: 15%">Nilai</th>
                        <th class="text-end pe-4 py-3 small fw-bold text-muted" style="width: 12%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($statistik as $item)
                    <tr>
                        <td class="ps-4 py-3 fw-bold text-dark">{{ $item->tahun }}</td>
                        <td class="py-3">
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">{{ $item->jenis_data }}</span>
                        </td>
                        <td class="py-3 text-dark">{{ $item->label }}</td>
                        <td class="py-3 text-center fw-bold text-primary">{{ number_format($item->nilai) }}</td>
                        <td class="text-end pe-4 py-3">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('operator.statistik.edit', $item->id) }}" class="btn btn-sm btn-white border shadow-sm hover-lift" title="Edit Data">
                                    <i data-lucide="edit-3" class="icon-xs text-primary"></i>
                                </a>
                                <form action="{{ route('operator.statistik.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data statistik ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-white border shadow-sm hover-lift" title="Hapus Data">
                                        <i data-lucide="trash-2" class="icon-xs text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted bg-white">
                            <i data-lucide="bar-chart-2" class="icon-xl opacity-25 mb-2 d-block mx-auto text-success"></i>
                            Belum ada data statistik yang diinput.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
