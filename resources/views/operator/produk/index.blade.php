@extends('layouts.dashboard')
@section('title', 'Manajemen Produk')
@section('content')
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Daftar Produk Desa</h5>
        <a href="{{ url('/operator/produk/create') }}" class="btn btn-success bg-primary-custom hover-lift"><i data-lucide="plus" class="me-1" style="width:18px;"></i> Tambah Produk</a>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Produk</th>
                        <th>Harga</th>
                        <th>Stok / Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produk as $p)
                    <tr>
                        <td class="ps-4">
                            @if($p->gambar)
                            <img src="{{ asset('storage/'.$p->gambar) }}" class="rounded shadow-sm me-3 float-start" style="width:50px; height:50px; object-fit:cover;">
                            @endif
                            <div class="fw-bold">{{ $p->nama }}</div>
                            <small class="text-muted text-truncate d-inline-block" style="max-width:200px;">{{ Str::words($p->deskripsi, 5) }}</small>
                        </td>
                        <td class="fw-bold text-success">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                        <td><span class="badge bg-secondary">{{ $p->stok ?? 0 }} Pcs</span></td>
                        <td class="text-end pe-4">
                            <a href="{{ url('/operator/produk/'.$p->id.'/edit') }}" class="btn btn-sm btn-outline-primary"><i data-lucide="edit-2" style="width:14px;"></i></a>
                            <form action="{{ url('/operator/produk/'.$p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus produk ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm"><i data-lucide="trash-2" style="width:14px;"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-5 text-muted">Belum ada produk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white p-3 border-0">
        {{ $produk->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
