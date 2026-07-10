@extends('layouts.dashboard')
@section('title', 'Manajemen Pengajuan Layanan Administrasi')
@section('content')

<!-- Welcome Banner / Headers -->
<div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden position-relative text-start" style="background: linear-gradient(45deg, var(--primary-dark), var(--primary)) !important;">
    <div class="card-body p-4 p-md-5 text-white position-relative z-1">
        <h2 class="fw-bold mb-2" style="font-family: var(--font-heading);">Manajemen Pengajuan Layanan</h2>
        <p class="opacity-75 mb-0" style="font-family: var(--font-body);">Verifikasi berkas kependudukan (KTP, KK, Akta Kelahiran, Akta Kematian) dari warga Desa Selorejo.</p>
    </div>
    <div class="position-absolute top-50 start-100 translate-middle opacity-10 rounded-circle" style="width: 300px; height: 300px; background-color: var(--accent) !important;"></div>
</div>

<!-- Counter Badges -->
@php
    $totalCount = $counts['total'] ?? 0;
    $pctDiajukan = $totalCount > 0 ? round(($counts['diajukan'] / $totalCount) * 100) : 0;
    $pctDiverifikasi = $totalCount > 0 ? round(($counts['diverifikasi'] / $totalCount) * 100) : 0;
    $pctDiproses = $totalCount > 0 ? round(($counts['diproses_disdukcapil'] / $totalCount) * 100) : 0;
    $pctSelesai = $totalCount > 0 ? round(($counts['selesai'] / $totalCount) * 100) : 0;
    $pctDitolak = $totalCount > 0 ? round(($counts['ditolak'] / $totalCount) * 100) : 0;
@endphp
<div class="row g-3 mb-4 text-start" style="font-family: var(--font-body);">
    <div class="col-md-2 col-sm-4">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white text-center border-start border-4 border-info">
            <small class="text-muted d-block fw-bold" style="font-size: 0.7rem;">TOTAL PENGAJUAN</small>
            <h3 class="fw-bold mb-0 text-dark mt-1">{{ $counts['total'] }}</h3>
            <small class="text-muted fw-bold d-block mt-1">100%</small>
        </div>
    </div>
    <div class="col-md-2 col-sm-4">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white text-center border-start border-4 border-primary">
            <small class="text-muted d-block fw-bold" style="font-size: 0.7rem;">DIAJUKAN (BARU)</small>
            <h3 class="fw-bold mb-0 text-primary mt-1">{{ $counts['diajukan'] }}</h3>
            <small class="text-muted fw-bold d-block mt-1">{{ $pctDiajukan }}%</small>
        </div>
    </div>
    <div class="col-md-2 col-sm-4">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white text-center border-start border-4 border-warning">
            <small class="text-muted d-block fw-bold" style="font-size: 0.7rem;">DIVERIFIKASI</small>
            <h3 class="fw-bold mb-0 text-warning mt-1">{{ $counts['diverifikasi'] }}</h3>
            <small class="text-muted fw-bold d-block mt-1">{{ $pctDiverifikasi }}%</small>
        </div>
    </div>
    <div class="col-md-2 col-sm-4">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white text-center border-start border-4 border-secondary">
            <small class="text-muted d-block fw-bold" style="font-size: 0.7rem;">DIPROSES DISDUK</small>
            <h3 class="fw-bold mb-0 text-muted mt-1">{{ $counts['diproses_disdukcapil'] }}</h3>
            <small class="text-muted fw-bold d-block mt-1">{{ $pctDiproses }}%</small>
        </div>
    </div>
    <div class="col-md-2 col-sm-4">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white text-center border-start border-4 border-success">
            <small class="text-muted d-block fw-bold" style="font-size: 0.7rem;">SELESAI</small>
            <h3 class="fw-bold mb-0 text-success mt-1">{{ $counts['selesai'] }}</h3>
            <small class="text-muted fw-bold d-block mt-1">{{ $pctSelesai }}%</small>
        </div>
    </div>
    <div class="col-md-2 col-sm-4">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white text-center border-start border-4 border-danger">
            <small class="text-muted d-block fw-bold" style="font-size: 0.7rem;">DITOLAK</small>
            <h3 class="fw-bold mb-0 text-danger mt-1">{{ $counts['ditolak'] }}</h3>
            <small class="text-muted fw-bold d-block mt-1">{{ $pctDitolak }}%</small>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5 text-start bg-white" style="font-family: var(--font-body);">
    <div class="card-body p-4">
        <!-- Search & Filter Form -->
        <form action="{{ route('operator.layanan.index') }}" method="GET" class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="input-group bg-light rounded-pill overflow-hidden shadow-none px-3 border">
                    <span class="input-group-text bg-transparent border-0"><i data-lucide="search" class="icon-sm text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-0 bg-transparent shadow-none py-2" placeholder="Cari Tiket / NIK / Nama Pemohon..." value="{{ request('search') }}">
                </div>
            </div>

            <div class="col-md-3">
                <select name="status" class="form-select rounded-pill border py-2 px-3 bg-light shadow-none" onchange="this.form.submit()">
                    <option value="semua">Semua Status</option>
                    <option value="diajukan" {{ request('status') === 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                    <option value="diverifikasi" {{ request('status') === 'diverifikasi' ? 'selected' : '' }}>Diverifikasi Admin</option>
                    <option value="diproses_disdukcapil" {{ request('status') === 'diproses_disdukcapil' ? 'selected' : '' }}>Diproses Disdukcapil</option>
                    <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <div class="col-md-3">
                <select name="jenis" class="form-select rounded-pill border py-2 px-3 bg-light shadow-none" onchange="this.form.submit()">
                    <option value="semua">Semua Jenis Layanan</option>
                    <option value="akta_kelahiran" {{ request('jenis') === 'akta_kelahiran' ? 'selected' : '' }}>Akta Kelahiran</option>
                    <option value="akta_kematian" {{ request('jenis') === 'akta_kematian' ? 'selected' : '' }}>Akta Kematian</option>
                    <option value="kk_baru" {{ request('jenis') === 'kk_baru' ? 'selected' : '' }}>KK Baru (Menikah)</option>
                    <option value="kk_tambah_anggota" {{ request('jenis') === 'kk_tambah_anggota' ? 'selected' : '' }}>KK Tambah Anggota</option>
                    <option value="kk_ubah_data" {{ request('jenis') === 'kk_ubah_data' ? 'selected' : '' }}>KK Ubah Data</option>
                    <option value="kk_pisah" {{ request('jenis') === 'kk_pisah' ? 'selected' : '' }}>KK Pisah KK</option>
                    <option value="ktp_baru" {{ request('jenis') === 'ktp_baru' ? 'selected' : '' }}>KTP-el Baru</option>
                    <option value="ktp_ganti" {{ request('jenis') === 'ktp_ganti' ? 'selected' : '' }}>KTP-el Ganti (Hilang/Rusak/Ubah)</option>
                </select>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-success w-100 rounded-pill py-2 fw-bold shadow-none">Filter</button>
            </div>
        </form>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 rounded-start-3 text-muted small fw-bold">NO TIKET</th>
                        <th class="border-0 text-muted small fw-bold">PEMOHON</th>
                        <th class="border-0 text-muted small fw-bold">NIK</th>
                        <th class="border-0 text-muted small fw-bold">LAYANAN</th>
                        <th class="border-0 text-muted small fw-bold">STATUS</th>
                        <th class="border-0 text-muted small fw-bold">TANGGAL MASUK</th>
                        <th class="border-0 rounded-end-3 text-muted small fw-bold text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengajuans as $p)
                        <tr>
                            <td><strong class="text-success">{{ $p->no_tiket }}</strong></td>
                            <td>
                                <span class="fw-bold d-block text-dark">{{ $p->nama_pemohon }}</span>
                                <small class="text-muted">{{ $p->no_hp_pemohon }}</small>
                            </td>
                            <td>{{ $p->nik_pemohon }}</td>
                            <td><span class="small text-muted">{{ $p->jenis_layanan_label }}</span></td>
                            <td>
                                <span class="badge {{ $p->status_badge_class }} px-2 py-1 rounded-pill small" style="font-size: 0.7rem;">{{ $p->status_label }}</span>
                            </td>
                            <td><small class="text-muted">{{ $p->created_at->format('d/m/Y H:i') }}</small></td>
                            <td class="text-center">
                                <a href="{{ route('operator.layanan.show', $p->id) }}" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i data-lucide="file-text" style="width: 48px; height: 48px;" class="opacity-25 mb-3 d-block mx-auto"></i>
                                Belum ada pengajuan berkas masuk untuk filter ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pengajuans->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $pengajuans->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection
