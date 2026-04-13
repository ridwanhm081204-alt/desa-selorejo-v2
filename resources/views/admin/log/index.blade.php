@extends('layouts.dashboard')
@section('title', 'Audit Jejak Sistem')
@section('content')

<div class="row g-4 text-start">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden position-relative bg-dark" style="background: linear-gradient(45deg, #0b090a, #161a1d) !important;">
            <div class="card-body p-4 p-md-5 text-white position-relative z-1">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary text-white p-2 rounded-3 me-3">
                        <i data-lucide="shield-alert" class="icon-sm"></i>
                    </div>
                    <h5 class="fw-bold mb-0 text-white">Log Aktivitas & Audit Trail</h5>
                </div>
                <p class="opacity-75 mb-0">Catatan riwayat seluruh tindakan krusial oleh operator dan admin dalam sistem CMS Desa Selorejo. Audit ini bersifat permanen dan tidak dapat dihapus.</p>
            </div>
            <div class="position-absolute top-50 start-100 translate-middle bg-white opacity-10 rounded-circle" style="width: 250px; height: 250px; filter: blur(30px);"></div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light border-bottom">
                            <tr>
                                <th class="ps-4 py-3 text-muted small fw-bold text-uppercase">Waktu Tindakan</th>
                                <th class="py-3 text-muted small fw-bold text-uppercase">Pelaku (User)</th>
                                <th class="py-3 text-muted small fw-bold text-uppercase">Aktivitas / Tindakan</th>
                                <th class="text-end pe-4 py-3 text-muted small fw-bold text-uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark mb-0">{{ $log->created_at->format('H:i') }}</div>
                                    <small class="text-muted">{{ $log->created_at->translatedFormat('d M Y') }}</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-2" style="width:32px; height:32px;">
                                            <i data-lucide="user" class="icon-xs"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark small">{{ $log->user->name ?? 'System' }}</div>
                                            <div class="x-small text-muted">{{ ucfirst($log->user->role ?? '') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="p-2 rounded-3 bg-light border-start border-3 border-primary small text-dark fw-medium">
                                        {{ $log->action }}
                                    </div>
                                </td>
                                <td class="text-end pe-4">
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 fw-bold x-small border border-success border-opacity-25">AUDITED</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="text-muted opacity-50">
                                        <i data-lucide="clipboard-list" class="mb-2" style="width:48px;height:48px;"></i>
                                        <p>Belum ada jejak aktivitas tercatat.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($logs->hasPages())
            <div class="card-footer bg-white border-0 p-4">
                {{ $logs->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .x-small { font-size: 11px; }
</style>
@endsection
