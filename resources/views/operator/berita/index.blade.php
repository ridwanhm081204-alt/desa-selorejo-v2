@extends('layouts.dashboard')
@section('title', 'Manajemen Berita')
@section('content')
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Daftar Kabar Desa</h5>
        <a href="{{ url('/operator/berita/create') }}" class="btn btn-success bg-primary-custom hover-lift"><i data-lucide="plus" class="me-1" style="width:18px;"></i> Tulis Berita</a>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Tanggal</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($berita as $b)
                    <tr>
                        <td class="ps-4">{{ \Carbon\Carbon::parse($b->tanggal)->format('d M Y') }}</td>
                        <td>
                            @if($b->gambar)
                            <img src="{{ asset('storage/'.$b->gambar) }}" class="rounded shadow-sm me-2 float-start" style="width:50px; height:50px; object-fit:cover;">
                            @endif
                            <div class="fw-bold">{{ \Illuminate\Support\Str::limit($b->judul, 40) }}</div>
                            <small class="text-muted">{{ $b->penulis }}</small>
                        </td>
                        <td><span class="badge bg-warning text-dark">{{ $b->kategori }}</span></td>
                        <td>
                            @if($b->status_publish == 'publish')
                                <span class="badge bg-success">Publish</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ url('/operator/berita/'.$b->id.'/edit') }}" class="btn btn-sm btn-outline-primary"><i data-lucide="edit-2" style="width:14px;"></i></a>
                            <form action="{{ url('/operator/berita/'.$b->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus berita ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i data-lucide="trash-2" style="width:14px;"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada berita.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white p-3 border-0">
        {{ $berita->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
