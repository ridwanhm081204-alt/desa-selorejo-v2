@extends('layouts.dashboard')
@section('title', 'Jajak Pendapat & Polling')
@section('content')
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Manajemen Polling</h5>
        <a href="{{ url('/operator/polling/create') }}" class="btn btn-success bg-primary-custom hover-lift"><i data-lucide="plus" class="me-1" style="width:18px;"></i> Buat Polling Baru</a>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Pertanyaan Polling</th>
                        <th>Periode</th>
                        <th>Hasil</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($polling as $p)
                    <tr>
                        <td class="ps-4 fw-bold">{{ $p->pertanyaan }}</td>
                        <td>
                            <small class="text-muted d-block">Mulai: {{ \Carbon\Carbon::parse($p->tanggal_mulai)->format('d M Y') }}</small>
                            <small class="text-muted d-block">Selesai: {{ \Carbon\Carbon::parse($p->tanggal_selesai)->format('d M Y') }}</small>
                        </td>
                        <td>
                            <div class="d-flex gx-2 align-items-center">
                                <span class="badge bg-success me-1">Ya: {{ $p->jumlah_ya }}</span>
                                <span class="badge bg-secondary">Tidak: {{ $p->jumlah_tidak }}</span>
                            </div>
                        </td>
                        <td>
                            @if($p->is_active)
                                <span class="badge bg-primary">Aktif</span>
                            @else
                                <span class="badge bg-light text-dark border">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <form action="{{ url('/operator/polling/'.$p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus polling ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm"><i data-lucide="trash-2" style="width:14px;"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-5 text-muted">Belum ada polling yang dibuat.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
