@extends('layouts.public')
@section('title', 'Hasil Pelacakan Pengajuan Layanan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('layanan.index') }}" class="text-decoration-none text-success">Layanan Administrasi</a></li>
    <li class="breadcrumb-item"><a href="{{ route('layanan.cek-status') }}" class="text-decoration-none text-success">Cek Status</a></li>
    <li class="breadcrumb-item active">Hasil Pelacakan</li>
@endsection
@section('content')
<div class="container mb-5 pb-5 mt-4">
    <div class="row justify-content-center text-start">
        <div class="col-lg-8">
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <a href="{{ route('layanan.cek-status') }}" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm transition-all hover-lift">
                    <i data-lucide="arrow-left" class="icon-sm me-1"></i> Cari Ulang
                </a>
                <span class="text-muted small">Kata kunci: <strong>{{ $query }}</strong></span>
            </div>

            @if($pengajuan->isEmpty())
                <div class="card border-0 shadow-sm rounded-4 p-5 bg-white text-center">
                    <div class="d-inline-flex align-items-center justify-content-center bg-danger bg-opacity-10 text-danger rounded-circle mb-3" style="width: 70px; height: 70px;">
                        <i data-lucide="info" style="width: 32px; height: 32px;"></i>
                    </div>
                    <h4 class="fw-bold mb-2 text-dark" style="font-family: var(--font-heading);">Pengajuan Tidak Ditemukan</h4>
                    <p class="text-muted mb-4 small" style="font-family: var(--font-body);">Pastikan nomor tiket (contoh: 0100001) atau NIK Pemohon yang Anda masukkan sudah benar.</p>
                    <div>
                        <a href="{{ route('layanan.cek-status') }}" class="btn btn-success rounded-pill px-4 fw-bold hover-lift border-0 text-white" style="font-family: var(--font-heading);">Coba Lagi</a>
                    </div>
                </div>
            @else
                <h4 class="fw-bold mb-4 text-dark" style="font-family: var(--font-heading);">Ditemukan {{ $pengajuan->count() }} Pengajuan Dokumen</h4>

                @foreach($pengajuan as $p)
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white">
                        <div class="card-header bg-light border-0 p-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div>
                                <span class="badge {{ $p->status_badge_class }} px-3 py-2 rounded-pill shadow-sm text-uppercase small mb-2 d-inline-block">{{ $p->status_label }}</span>
                                <h5 class="fw-bold mb-0 text-dark" style="font-family: var(--font-heading);">{{ $p->no_tiket }}</h5>
                            </div>
                            <div class="text-end">
                                <span class="d-block small fw-bold text-success">{{ $p->jenis_layanan_label }}</span>
                                <small class="text-muted">Tanggal: {{ $p->created_at->translatedFormat('d F Y, H:i') }} WIB</small>
                            </div>
                        </div>

                        <div class="card-body p-4 p-md-5">
                            <!-- Detail Pemohon -->
                            <div class="row mb-4 border-bottom pb-4 g-3">
                                <div class="col-sm-6">
                                    <small class="text-muted d-block font-weight-bold text-uppercase small">Nama Pemohon</small>
                                    <span class="fw-bold text-dark">{{ $p->nama_pemohon }}</span>
                                </div>
                                <div class="col-sm-6">
                                    <small class="text-muted d-block font-weight-bold text-uppercase small">NIK Pemohon</small>
                                    <span class="fw-bold text-dark">{{ $p->nik_pemohon }}</span>
                                </div>
                            </div>

                            <!-- Timeline Progres -->
                            <h6 class="fw-bold mb-4 text-dark d-flex align-items-center" style="font-family: var(--font-heading);">
                                <i data-lucide="git-commit" class="text-success icon-sm me-2"></i> Timeline Status Pengajuan
                            </h6>

                            <div class="position-relative ps-4 ms-2 border-start border-2 border-success border-opacity-25 pb-2">
                                @foreach($p->logStatuses as $index => $log)
                                    <div class="mb-4 position-relative">
                                        <!-- Dot Indicator -->
                                        <div class="position-absolute rounded-circle shadow-sm border border-white" 
                                             style="width: 16px; height: 16px; left: -33px; top: 4px; 
                                             background-color: {{ $index === 0 ? 'var(--color-kiwi)' : 'var(--color-gray-mid)' }};"></div>
                                        
                                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                            <span class="fw-bold text-dark small">{{ $log->status_baru_label }}</span>
                                            <span class="text-muted small" style="font-size: 0.7rem;">{{ $log->created_at->translatedFormat('d M Y, H:i') }} WIB</span>
                                        </div>
                                        <p class="text-muted small mb-0 mt-1" style="font-family: var(--font-body);">{{ $log->catatan }}</p>
                                    </div>
                                @endforeach
                            </div>

                            @if($p->catatan_admin)
                                <div class="p-3 bg-light rounded-3 border-start border-4 border-success mt-4">
                                    <small class="fw-bold text-dark text-uppercase small d-block">Catatan Terakhir Petugas Desa:</small>
                                    <p class="text-dark small mb-0 mt-1" style="font-family: var(--font-body);">{{ $p->catatan_admin }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
