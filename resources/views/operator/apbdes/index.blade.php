@extends('layouts.dashboard')
@section('title', 'Transparansi APBDes')
@section('content')

<!-- Section Hero Setting (CMS) -->
<div class="dash-card bg-white p-4 mb-4 border-top border-4 border-success shadow-sm rounded-4">
    <h6 class="fw-bold mb-3 d-flex align-items-center"><i data-lucide="image" class="text-success me-2 icon-sm"></i> Pengaturan Header Halaman</h6>
    <form action="{{ url('operator/apbdes/hero') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="small fw-bold text-muted">Judul Halaman</label>
                <input type="text" name="title" class="form-control form-control-sm" value="{{ $hero['title'] ?? 'Transparansi APBDes' }}">
            </div>
            <div class="col-md-5">
                <label class="small fw-bold text-muted">Sub-Judul</label>
                <input type="text" name="subtitle" class="form-control form-control-sm" value="{{ $hero['subtitle'] ?? 'Laporan Anggaran Pendapatan dan Belanja Desa Selorejo Tahun Anggaran 2024.' }}">
            </div>
            <div class="col-md-2">
                <label class="small fw-bold text-muted">Ikon (Lucide)</label>
                <input type="text" name="icon" class="form-control form-control-sm" value="{{ $hero['icon'] ?? 'file-text' }}">
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
            <h5 class="fw-bold mb-0">Manajemen Dokumen APBDes</h5>
            <small class="text-muted">Kelola transparansi anggaran dan belanja desa</small>
        </div>
        <a href="{{ url('/operator/apbdes/create') }}" class="btn btn-success rounded-pill px-4 shadow-sm hover-lift border-0">
            <i data-lucide="plus" class="icon-sm me-1"></i> Tambah Data APBDes
        </a>
    </div>
</div>

<!-- Table APBDes -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-center">
                <thead class="bg-light text-uppercase">
                    <tr>
                        <th class="ps-4 py-3 small fw-bold text-muted text-start" style="width: 8%">Tahun</th>
                        <th class="py-3 small fw-bold text-muted" style="width: 15%">Tipe Anggaran</th>
                        <th class="py-3 small fw-bold text-muted text-start">Bidang Kegiatan</th>
                        <th class="py-3 small fw-bold text-muted text-end" style="width: 12%">Semula</th>
                        <th class="py-3 small fw-bold text-muted text-end" style="width: 12%">Perubahan</th>
                        <th class="py-3 small fw-bold text-muted text-end" style="width: 15%">Akhir</th>
                        <th class="text-end pe-4 py-3 small fw-bold text-muted" style="width: 12%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($apbdes as $a)
                    <tr>
                        <td class="ps-4 py-3 text-start fw-bold text-dark">{{ $a->tahun }}</td>
                        <td class="py-3">
                            @if($a->jenis == 'pendapatan')
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">Pendapatan</span>
                            @elseif($a->jenis == 'belanja')
                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-1">Belanja</span>
                            @elseif($a->jenis == 'pembiayaan_penerimaan')
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1">Penerimaan Pembiayaan</span>
                            @elseif($a->jenis == 'pembiayaan_pengeluaran')
                                <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-1">Pengeluaran Pembiayaan</span>
                            @else
                                <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-1">{{ $a->jenis }}</span>
                            @endif
                        </td>
                        <td class="py-3 text-start text-dark small fw-medium">{{ $a->bidang }}</td>
                        <td class="py-3 text-end fw-bold text-muted">Rp {{ number_format($a->nominal_semula, 0, ',', '.') }}</td>
                        <td class="py-3 text-end fw-bold {{ $a->nominal_perubahan >= 0 ? 'text-success' : 'text-danger' }}">
                            {{ $a->nominal_perubahan >= 0 ? '+' : '' }}Rp {{ number_format($a->nominal_perubahan, 0, ',', '.') }}
                        </td>
                        <td class="py-3 text-end fw-bold text-primary">Rp {{ number_format($a->nominal, 0, ',', '.') }}</td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                @if($a->dokumen_pdf)
                                    <a href="{{ asset('storage/'.$a->dokumen_pdf) }}" target="_blank" class="btn btn-sm btn-white border shadow-sm hover-lift" title="Lihat PDF">
                                        <i data-lucide="file-text" class="icon-xs text-secondary"></i>
                                    </a>
                                @endif
                                <a href="{{ url('/operator/apbdes/'.$a->id.'/edit') }}" class="btn btn-sm btn-white border shadow-sm hover-lift" title="Edit Data">
                                    <i data-lucide="edit-3" class="icon-xs text-primary"></i>
                                </a>
                                <form action="{{ url('/operator/apbdes/'.$a->id) }}" method="POST" onsubmit="return confirm('Hapus data APBDes ini?')">
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
                            <i data-lucide="file-spreadsheet" class="icon-xl opacity-25 mb-2 d-block mx-auto text-success"></i>
                            Belum ada laporan APBDes yang diinput.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white p-3 border-0">
        {{ $apbdes->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
