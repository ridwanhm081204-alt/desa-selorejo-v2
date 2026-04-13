@extends('layouts.dashboard')
@section('title', 'Kotak Masuk Pesan')
@section('content')

<!-- Header Manajemen -->
<div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden text-start">
    <div class="card-body p-4">
        <div class="row align-items-center g-3">
            <div class="col-md-4">
                <h5 class="fw-bold mb-0 d-flex align-items-center"><i data-lucide="mail" class="text-success me-2"></i> Kotak Pesan Masuk</h5>
                <small class="text-muted">Interaksi aspirasi dan pertanyaan warga</small>
            </div>
            <div class="col-md-8">
                <form action="{{ url('/operator/pesan') }}" method="GET" id="filterForm" class="row g-2 justify-content-md-end">
                    <div class="col-md-4 col-lg-3">
                        <select name="status" class="form-select form-select-sm border-0 bg-light rounded-pill px-3 shadow-none" onchange="this.form.submit()">
                            <option value="semua" {{ request('status') == 'semua' ? 'selected' : '' }}>Semua Status</option>
                            <option value="belum" {{ request('status') == 'belum' ? 'selected' : '' }}>Belum Dibaca</option>
                            <option value="sudah" {{ request('status') == 'sudah' ? 'selected' : '' }}>Sudah Dibaca</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <select name="sort" class="form-select form-select-sm border-0 bg-light rounded-pill px-3 shadow-none" onchange="this.form.submit()">
                            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Paling Baru</option>
                            <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Paling Lama</option>
                            <option value="nama_asc" {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                            <option value="nama_desc" {{ request('sort') == 'nama_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Table Pesan -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden text-start">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-uppercase">
                    <tr>
                        <th class="ps-4 py-3 small fw-bold text-muted" style="width: 20%">Waktu Masuk</th>
                        <th class="py-3 small fw-bold text-muted">Pengirim</th>
                        <th class="py-3 small fw-bold text-muted">Status</th>
                        <th class="text-end pe-4 py-3 small fw-bold text-muted" style="width: 15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesan as $p)
                    <tr class="{{ $p->status_baca == 'belum' ? 'bg-success bg-opacity-10' : '' }}">
                        <td class="ps-4 py-4 fw-medium text-dark small">
                            <i data-lucide="clock" class="icon-xs me-1 text-muted"></i>
                            {{ $p->created_at->translatedFormat('d M Y, H:i') }}
                        </td>
                        <td>
                            <div class="fw-bold text-dark d-flex align-items-center">
                                @if($p->status_baca == 'belum')
                                    <span class="p-1 bg-success rounded-circle me-2 animate-pulse"></span>
                                @endif
                                {{ $p->nama }}
                            </div>
                            <small class="text-muted d-block fw-normal"><i data-lucide="mail" class="icon-xs me-1"></i>{{ $p->email }}</small>
                        </td>
                        <td>
                            @if($p->status_baca == 'belum')
                                <span class="badge bg-success bg-opacity-25 text-success rounded-pill px-3 fw-bold border border-success border-opacity-10">BELUM DIBACA</span>
                            @else
                                <span class="badge bg-light text-muted rounded-pill px-3 fw-medium border">SUDAH DIBACA</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ url('/operator/pesan/'.$p->id) }}" class="btn btn-sm btn-white border shadow-sm hover-lift rounded-pill px-3 text-primary fw-bold">
                                <i data-lucide="mail-open" class="icon-xs me-1"></i> Buka Pesan
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted bg-white">
                            <i data-lucide="inbox" class="icon-xl opacity-25 mb-2 d-block mx-auto text-success"></i>
                            Kotak masuk pesan masih kosong.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white p-3 border-0">
        {{ $pesan->links('pagination::bootstrap-5') }}
    </div>
</div>

<style>
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: .4; }
    }
</style>
@endsection
