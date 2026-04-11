@extends('layouts.dashboard')
@section('title', 'Kotak Masuk Pesan')
@section('content')
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-0">Pesan Masuk dari Masyarakat</h5>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Tanggal Masuk</th>
                        <th>Pengirim</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesan as $p)
                    <tr class="{{ $p->status_baca == 'belum' ? 'fw-bold bg-light' : '' }}">
                        <td class="ps-4">{{ $p->created_at->format('d M Y H:i') }}</td>
                        <td>
                            <div>{{ $p->nama }}</div>
                            <small class="text-muted fw-normal">{{ $p->email }}</small>
                        </td>
                        <td>
                            @if($p->status_baca == 'belum')
                                <span class="badge bg-danger">Belum Dibaca</span>
                            @else
                                <span class="badge bg-light text-dark border">Sudah Dibaca</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ url('/operator/pesan/'.$p->id) }}" class="btn btn-sm btn-outline-primary shadow-sm hover-lift"><i data-lucide="eye" style="width:14px;" class="me-1"></i> Buka Pesan</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-5 text-muted">Belum ada pesan masuk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white p-3 border-0">
        {{ $pesan->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
