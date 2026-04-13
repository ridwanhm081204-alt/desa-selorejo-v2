@extends('layouts.dashboard')
@section('title', 'Jajak Pendapat & Polling')
@section('content')

<!-- Section Hero Setting (CMS) -->
<div class="dash-card bg-white p-4 mb-4 border-top border-4 border-success shadow-sm rounded-4 text-start">
    <h6 class="fw-bold mb-3 d-flex align-items-center"><i data-lucide="pie-chart" class="text-success me-2 icon-sm"></i> Pengaturan Polling (Beranda)</h6>
    <form action="{{ route('operator.polling.hero') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-5">
                <label class="small fw-bold text-muted mb-1">Judul Bagian</label>
                <input type="text" name="title" class="form-control rounded-3" value="{{ $hero['title'] ?? 'Jejak Pendapat' }}">
            </div>
            <div class="col-md-5">
                <label class="small fw-bold text-muted mb-1">Sub-Judul (Internal)</label>
                <input type="text" name="subtitle" class="form-control rounded-3" value="{{ $hero['subtitle'] ?? 'Suara Anda sangat berarti bagi kemajuan desa kami.' }}">
            </div>
            <div class="col-md-2">
                <label class="small fw-bold text-muted mb-1">Ikon (Lucide)</label>
                <input type="text" name="icon" class="form-control rounded-3" value="{{ $hero['icon'] ?? 'pie-chart' }}">
            </div>
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-success rounded-pill px-4 shadow-sm border-0 fw-bold">SIMPAN PENGATURAN</button>
            </div>
        </div>
    </form>
</div>

<!-- Header Manajemen -->
<div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden text-start">
    <div class="card-body p-4 d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-0">Manajemen Polling</h5>
            <small class="text-muted">Kelola survei dan jajak pendapat warga</small>
        </div>
        <a href="{{ url('/operator/polling/create') }}" class="btn btn-success rounded-pill px-4 shadow-sm hover-lift border-0 fw-bold">
            <i data-lucide="plus" class="icon-sm me-1"></i> TAMBAH POLLING
        </a>
    </div>
</div>

<!-- Table Polling -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden text-start">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-uppercase">
                    <tr>
                        <th class="ps-4 py-3 small fw-bold text-muted">Aspirasi / Pertanyaan</th>
                        <th class="py-3 small fw-bold text-muted">Masa Aktif</th>
                        <th class="py-3 small fw-bold text-muted text-center" style="width: 25%">Statistik Hasil</th>
                        <th class="py-3 small fw-bold text-muted text-center">Status</th>
                        <th class="text-end pe-4 py-3 small fw-bold text-muted" style="width: 12%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($polling as $p)
                    <tr>
                        <td class="ps-4 py-4 fw-bold text-dark lh-sm" style="max-width: 300px;">{{ $p->pertanyaan }}</td>
                        <td class="py-3 small text-muted">
                            <div class="d-flex flex-column gap-1">
                                <span class="d-flex align-items-center"><i data-lucide="play" class="icon-xs me-2 text-success"></i>{{ \Carbon\Carbon::parse($p->tanggal_mulai)->translatedFormat('d M Y') }}</span>
                                <span class="d-flex align-items-center"><i data-lucide="square" class="icon-xs me-2 text-danger"></i>{{ \Carbon\Carbon::parse($p->tanggal_selesai)->translatedFormat('d M Y') }}</span>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            @php 
                                $total = $p->jumlah_ya + $p->jumlah_tidak;
                                $persenYa = $total > 0 ? round(($p->jumlah_ya / $total) * 100) : 0;
                                $persenTidak = $total > 0 ? round(($p->jumlah_tidak / $total) * 100) : 0;
                            @endphp
                            <div class="px-3">
                                <div class="progress mb-2 rounded-pill" style="height: 10px; background-color: #f0f0f0;">
                                    <div class="progress-bar bg-success rounded-pill" style="width:{{ $persenYa }}%"></div>
                                    <div class="progress-bar bg-secondary rounded-pill" style="width:{{ $persenTidak }}%"></div>
                                </div>
                                <div class="d-flex justify-content-between small fw-bold">
                                    <span class="text-success"><i data-lucide="check" class="icon-xs me-1"></i>Ya: {{ $p->jumlah_ya }} ({{ $persenYa }}%)</span>
                                    <span class="text-muted"><i data-lucide="x" class="icon-xs me-1"></i>Tidak: {{ $p->jumlah_tidak }} ({{ $persenTidak }}%)</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            @if($p->is_active)
                                <span class="badge bg-primary bg-opacity-75 rounded-pill px-3 shadow-sm border-0 fw-bold">AKTIF</span>
                            @else
                                <span class="badge bg-light text-muted rounded-pill px-3 border border-light shadow-sm fw-medium">NONAKTIF</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ url('/operator/polling/'.$p->id.'/edit') }}" class="btn btn-sm btn-white border shadow-sm hover-lift" title="Edit Polling">
                                    <i data-lucide="edit-3" class="icon-xs text-primary"></i>
                                </a>
                                <form action="{{ url('/operator/polling/'.$p->id) }}" method="POST" onsubmit="return confirm('Hapus polling ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-white border shadow-sm hover-lift" title="Hapus Polling">
                                        <i data-lucide="trash-2" class="icon-xs text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted bg-white">
                            <i data-lucide="pie-chart" class="icon-xl opacity-25 mb-2 d-block mx-auto text-success"></i>
                            Belum ada jajak pendapat yang dibuat.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
