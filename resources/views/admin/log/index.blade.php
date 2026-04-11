@extends('layouts.dashboard')
@section('title', 'Log Aktivitas Sistem')
@section('content')
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-0">Riwayat Aktivitas Pengguna</h5>
        <small class="text-muted">Semua aksi kritis yang dilakukan Admin dan Operator tercatat di sini.</small>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Waktu Kejadian</th>
                        <th>User Pelaku</th>
                        <th>Role Akses</th>
                        <th class="pe-4">Tindakan / Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                    <tr>
                        <td class="ps-4">{{ $log->created_at->format('d M Y H:i:s') }}</td>
                        <td class="fw-bold">{{ $log->user->name ?? 'Sistem/Dihapus' }}</td>
                        <td>
                            @if($log->user && $log->user->role == 'admin')
                                <span class="badge bg-danger">Admin</span>
                            @elseif($log->user && $log->user->role == 'operator')
                                <span class="badge bg-primary">Operator</span>
                            @else
                                <span class="badge bg-secondary">Guest</span>
                            @endif
                        </td>
                        <td class="pe-4">{{ $log->action }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-5 text-muted">Belum ada riwayat aktivitas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white p-3 border-0">
        {{ $logs->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
