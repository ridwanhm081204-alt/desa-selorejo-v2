@extends('layouts.dashboard')
@section('title', 'Manajemen Galeri')
@section('content')
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Dokumentasi Desa</h5>
        <a href="{{ url('/operator/galeri/create') }}" class="btn btn-success bg-primary-custom hover-lift"><i data-lucide="upload" class="me-1" style="width:18px;"></i> Upload Media</a>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Preview</th>
                        <th>Keterangan</th>
                        <th>Tipe</th>
                        <th>Tanggal</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($galeri as $g)
                    <tr>
                        <td class="ps-4">
                            @if($g->tipe == 'foto')
                                <img src="{{ asset('storage/'.$g->url) }}" class="rounded shadow-sm" style="width:80px; height:60px; object-fit:cover;">
                            @else
                                <div class="bg-dark text-white rounded d-flex justify-content-center align-items-center" style="width:80px; height:60px;">
                                    <i data-lucide="video" style="width:24px;"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold">{{ Str::limit($g->caption, 40) ?? 'Tanpa Caption' }}</div>
                            <small class="text-muted">{{ $g->kategori }}</small>
                        </td>
                        <td>
                            <span class="badge bg-{{ $g->tipe == 'foto' ? 'success' : 'danger' }}">{{ ucfirst($g->tipe) }}</span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($g->tanggal)->format('d M Y') }}</td>
                        <td class="text-end pe-4">
                            <form action="{{ url('/operator/galeri/'.$g->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus file ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm"><i data-lucide="trash-2" style="width:14px;"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-5 text-muted">Belum ada file media.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white p-3 border-0">
        {{ $galeri->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
