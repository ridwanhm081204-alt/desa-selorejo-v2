@extends('layouts.dashboard')
@section('title', 'Manajemen Produk')
@section('content')

<!-- Section Hero Setting (CMS) -->
<div class="dash-card bg-white p-4 mb-4 border-top border-4 border-success shadow-sm rounded-4">
    <h6 class="fw-bold mb-3 d-flex align-items-center"><i data-lucide="image" class="text-success me-2 icon-sm"></i> Pengaturan Header Halaman</h6>
    <form action="{{ url('operator/produk/hero') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="small fw-bold text-muted">Judul Halaman</label>
                <input type="text" name="title" class="form-control form-control-sm" value="{{ $hero['title'] ?? 'Katalog Produk Desa' }}">
            </div>
            <div class="col-md-5">
                <label class="small fw-bold text-muted">Sub-Judul</label>
                <input type="text" name="subtitle" class="form-control form-control-sm" value="{{ $hero['subtitle'] ?? 'Mendukung karya lokal dan UMKM Desa Selorejo' }}">
            </div>
            <div class="col-md-2">
                <label class="small fw-bold text-muted">Ikon (Lucide)</label>
                <input type="text" name="icon" class="form-control form-control-sm" value="{{ $hero['icon'] ?? 'shopping-bag' }}">
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="submit" class="btn btn-sm btn-success w-100 shadow-sm border-0">Simpan</button>
            </div>
        </div>
    </form>
</div>

<!-- Header Manajemen -->
<div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
    <div class="card-body p-4">
        <div class="row align-items-center g-3">
            <div class="col-md-3">
                <h5 class="fw-bold mb-0">Daftar Produk Desa</h5>
                <small class="text-muted">Kelola produk unggulan Selorejo</small>
            </div>
            <div class="col-md-9">
                <form action="{{ url('/operator/produk') }}" method="GET" class="row g-2 justify-content-md-end">
                    <div class="col-md-4">
                        <div class="input-group input-group-sm rounded-pill overflow-hidden border px-2 bg-light">
                            <span class="input-group-text bg-transparent border-0"><i data-lucide="search" class="icon-xs text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-0 bg-transparent shadow-none" placeholder="Cari produk..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <select name="kategori" class="form-select form-select-sm border-0 bg-light rounded-pill px-3 shadow-none" onchange="this.form.submit()">
                            <option value="semua" {{ request('kategori') == 'semua' || !request('kategori') ? 'selected' : '' }}>Semua Tag</option>
                            <option value="Jeruk Segar" {{ request('kategori') == 'Jeruk Segar' ? 'selected' : '' }}>Jeruk Segar</option>
                            <option value="Olahan Buah" {{ request('kategori') == 'Olahan Buah' ? 'selected' : '' }}>Olahan Buah</option>
                            <option value="Makanan" {{ request('kategori') == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                            <option value="Minuman" {{ request('kategori') == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                            <option value="Kerajinan" {{ request('kategori') == 'Kerajinan' ? 'selected' : '' }}>Kerajinan</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="sort" class="form-select form-select-sm border-0 bg-light rounded-pill px-3 shadow-none" onchange="this.form.submit()">
                            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                            <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                            <option value="harga_low" {{ request('sort') == 'harga_low' ? 'selected' : '' }}>Harga Terendah</option>
                            <option value="harga_high" {{ request('sort') == 'harga_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                            <option value="nama_asc" {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>A - Z</option>
                            <option value="nama_desc" {{ request('sort') == 'nama_desc' ? 'selected' : '' }}>Z - A</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <a href="{{ url('/operator/produk/create') }}" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm hover-lift border-0">
                            <i data-lucide="plus" class="icon-xs me-1"></i> Tambah
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Table Produk -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-uppercase">
                    <tr>
                        <th class="ps-4 py-3 small fw-bold text-muted">Produk</th>
                        <th class="py-3 small fw-bold text-muted text-center">Rating</th>
                        <th class="py-3 small fw-bold text-muted text-center" style="width: 15%">Harga Unit</th>
                        <th class="py-3 small fw-bold text-muted text-center" style="width: 15%">Stok Tersedia</th>
                        <th class="text-end pe-4 py-3 small fw-bold text-muted" style="width: 12%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produk as $p)
                    <tr>
                        <td class="ps-4 py-3">
                            <div class="d-flex align-items-center">
                                @if($p->gambar)
                                    <img src="{{ asset('storage/'.$p->gambar) }}" class="rounded-3 shadow-sm me-3 border border-light" style="width:60px; height:60px; object-fit:cover;">
                                @else
                                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center me-3" style="width:60px; height:60px;">
                                        <i data-lucide="shopping-basket" class="text-muted opacity-50"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-bold text-dark">{{ $p->nama }}</div>
                                    <div class="d-flex align-items-center gap-2 mt-1">
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1 small fw-bold" style="font-size: 0.65rem;">
                                            <i data-lucide="tag" class="icon-xs me-1"></i> {{ $p->kategori ?? 'Umum' }}
                                        </span>
                                        <small class="text-muted text-truncate d-block" style="max-width:200px;">{{ Str::limit($p->deskripsi, 35) }}</small>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="d-inline-flex flex-column gap-2" style="min-width: 120px;">
                                @php $avgRating = $p->reviews->avg('rating') ?? 0; @endphp
                                <div class="badge bg-warning bg-opacity-10 text-dark border border-warning border-opacity-25 rounded-pill px-3 py-1 fw-bold" style="font-size: 0.75rem;" title="Rating Rata-rata">
                                    <i data-lucide="star" class="icon-xs text-warning fill-warning me-1"></i> {{ number_format($avgRating, 1) }}
                                    <small class="text-muted fw-normal ms-1">({{ $p->reviews->count() }})</small>
                                </div>
                                <div class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-10 rounded-pill px-2 py-1 flex-fill d-flex align-items-center justify-content-center" title="Dibagikan">
                                    <i data-lucide="share-2" class="icon-xs me-1"></i> {{ $p->shares ?? 0 }}
                                </div>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <div class="fw-bold text-success">Rp {{ number_format($p->harga, 0, ',', '.') }}</div>
                        </td>
                        <td class="py-3 text-center">
                            @if(($p->stok ?? 0) > 0)
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">{{ $p->stok }} Pcs</span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3">Habis</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ url('/operator/produk/'.$p->id.'/edit') }}" class="btn btn-sm btn-white border shadow-sm hover-lift" title="Edit Produk">
                                    <i data-lucide="edit-3" class="icon-xs text-primary"></i>
                                </a>
                                <form action="{{ url('/operator/produk/'.$p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus produk ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-white border shadow-sm hover-lift" title="Hapus Produk">
                                        <i data-lucide="trash-2" class="icon-xs text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted bg-white">
                            <i data-lucide="shopping-bag" class="icon-xl opacity-25 mb-2 d-block mx-auto text-success"></i>
                            Belum ada produk yang terdaftar.
                        </td>
                    </tr>
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
