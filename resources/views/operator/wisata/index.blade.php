@extends('layouts.dashboard')
@section('title', 'Manajemen Wisata Desa')
@section('content')

<!-- Section Hero Setting (CMS) -->
<div class="dash-card bg-white p-4 mb-4 border-top border-4 border-success shadow-sm rounded-4">
    <h6 class="fw-bold mb-3 d-flex align-items-center"><i data-lucide="image" class="text-success me-2 icon-sm"></i> Pengaturan Header Halaman</h6>
    <form action="{{ url('operator/wisata/hero') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="small fw-bold text-muted">Judul Halaman</label>
                <input type="text" name="title" class="form-control form-control-sm" value="{{ $hero['title'] ?? 'Destinasi Wisata Selorejo' }}">
            </div>
            <div class="col-md-5">
                <label class="small fw-bold text-muted">Sub-Judul</label>
                <input type="text" name="subtitle" class="form-control form-control-sm" value="{{ $hero['subtitle'] ?? 'Jelajahi keajaiban alam dan kearifan agrikultur di lereng pegunungan Malang.' }}">
            </div>
            <div class="col-md-2">
                <label class="small fw-bold text-muted">Ikon (Lucide)</label>
                <input type="text" name="icon" class="form-control form-control-sm" value="{{ $hero['icon'] ?? 'mountain' }}">
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
                <h5 class="fw-bold mb-0">Daftar Destinasi</h5>
                <small class="text-muted">Kelola objek wisata desa</small>
            </div>
            <div class="col-md-9">
                <form action="{{ url('/operator/wisata') }}" method="GET" class="row g-2 justify-content-md-end">
                    <div class="col-md-4">
                        <div class="input-group input-group-sm rounded-pill overflow-hidden border px-2 bg-light">
                            <span class="input-group-text bg-transparent border-0"><i data-lucide="search" class="icon-xs text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-0 bg-transparent shadow-none" placeholder="Cari wisata..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <select name="kategori" class="form-select form-select-sm border-0 bg-light rounded-pill px-3 shadow-none" onchange="this.form.submit()">
                            <option value="semua" {{ request('kategori') == 'semua' || !request('kategori') ? 'selected' : '' }}>Semua Tag</option>
                            <option value="Wisata Alam" {{ request('kategori') == 'Wisata Alam' ? 'selected' : '' }}>Wisata Alam</option>
                            <option value="Agrowisata" {{ request('kategori') == 'Agrowisata' ? 'selected' : '' }}>Agrowisata</option>
                            <option value="Budaya & Event" {{ request('kategori') == 'Budaya & Event' ? 'selected' : '' }}>Budaya & Event</option>
                            <option value="Eduwisata" {{ request('kategori') == 'Eduwisata' ? 'selected' : '' }}>Eduwisata</option>
                            <option value="Religi" {{ request('kategori') == 'Religi' ? 'selected' : '' }}>Religi</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="sort" class="form-select form-select-sm border-0 bg-light rounded-pill px-3 shadow-none" onchange="this.form.submit()">
                            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                            <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                            <option value="harga_low" {{ request('sort') == 'harga_low' ? 'selected' : '' }}>HTM Termurah</option>
                            <option value="harga_high" {{ request('sort') == 'harga_high' ? 'selected' : '' }}>HTM Tertinggi</option>
                            <option value="judul_asc" {{ request('sort') == 'judul_asc' ? 'selected' : '' }}>A - Z</option>
                            <option value="judul_desc" {{ request('sort') == 'judul_desc' ? 'selected' : '' }}>Z - A</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('operator.wisata.create') }}" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm hover-lift border-0">
                            <i data-lucide="plus" class="icon-xs me-1"></i> Tambah
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Table Wisata -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-uppercase">
                    <tr>
                        <th class="ps-4 py-3 small fw-bold text-muted">Destinasi</th>
                        <th class="py-3 small fw-bold text-muted text-center" style="width: 15%">Harga Tiket</th>
                        <th class="py-3 small fw-bold text-muted" style="width: 25%">Jadwal</th>
                        <th class="text-end pe-4 py-3 small fw-bold text-muted" style="width: 12%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $item)
                    <tr>
                        <td class="ps-4 py-3">
                            <div class="d-flex align-items-center">
                                @if($item->gambar)
                                    <img src="{{ Str::startsWith($item->gambar, 'http') ? $item->gambar : asset('storage/'.$item->gambar) }}" class="rounded-3 shadow-sm me-3 border border-light" style="width:65px; height:65px; object-fit:cover;">
                                @else
                                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center me-3" style="width:65px; height:65px;">
                                        <i data-lucide="map" class="text-muted opacity-50"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-bold text-dark">{{ $item->judul }}</div>
                                    <div class="d-flex align-items-center gap-2 mt-1">
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1 small fw-bold" style="font-size: 0.65rem;">
                                            <i data-lucide="tag" class="icon-xs me-1"></i> {{ $item->kategori ?? 'Umum' }}
                                        </span>
                                        <small class="text-muted text-truncate d-block" style="max-width:200px;">{{ Str::limit($item->deskripsi, 40) }}</small>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 text-center">
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-bold">
                                Rp {{ number_format($item->harga_tiket, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="py-3 small text-muted">
                            <div class="d-flex align-items-start">
                                <i data-lucide="clock" class="icon-xs me-2 text-muted mt-1"></i>
                                <span>{{ $item->jadwal }}</span>
                            </div>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('operator.wisata.edit', $item->id) }}" class="btn btn-sm btn-white border shadow-sm hover-lift" title="Edit Destinasi">
                                    <i data-lucide="edit-3" class="icon-xs text-primary"></i>
                                </a>
                                <form action="{{ route('operator.wisata.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus wisata ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-white border shadow-sm hover-lift" title="Hapus Destinasi">
                                        <i data-lucide="trash-2" class="icon-xs text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted bg-white">
                            <i data-lucide="mountain" class="icon-xl opacity-25 mb-2 d-block mx-auto text-success"></i>
                            Belum ada objek wisata yang terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($data->hasPages())
    <div class="card-footer bg-white border-0 p-3">
        {{ $data->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
