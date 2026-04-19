@extends('layouts.dashboard')
@section('title', 'Manajemen Berita')
@section('content')

<!-- Section Hero Setting (CMS) -->
<div class="dash-card bg-white p-4 mb-4 border-top border-4 border-success shadow-sm rounded-4">
    <h6 class="fw-bold mb-3 d-flex align-items-center"><i data-lucide="image" class="text-success me-2 icon-sm"></i> Pengaturan Header Halaman</h6>
    <form action="{{ url('operator/berita/hero') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="small fw-bold text-muted">Judul Halaman</label>
                <input type="text" name="title" class="form-control form-control-sm" value="{{ $hero['title'] ?? 'Kabar Desa' }}">
            </div>
            <div class="col-md-5">
                <label class="small fw-bold text-muted">Sub-Judul</label>
                <input type="text" name="subtitle" class="form-control form-control-sm" value="{{ $hero['subtitle'] ?? 'Informasi, pengumuman, dan liputan terkini dari Desa Selorejo' }}">
            </div>
            <div class="col-md-2">
                <label class="small fw-bold text-muted">Ikon (Lucide)</label>
                <input type="text" name="icon" class="form-control form-control-sm" value="{{ $hero['icon'] ?? 'newspaper' }}">
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
                <h5 class="fw-bold mb-0">Daftar Berita Desa</h5>
                <small class="text-muted">Kelola publikasi dan informasi warga</small>
            </div>
            <div class="col-md-9">
                <form action="{{ url('/operator/berita') }}" method="GET" class="row g-2 justify-content-md-end">
                    <div class="col-md-4">
                        <div class="input-group input-group-sm rounded-pill overflow-hidden border px-2 bg-light">
                            <span class="input-group-text bg-transparent border-0"><i data-lucide="search" class="icon-xs text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-0 bg-transparent shadow-none" placeholder="Cari berita..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <select name="kategori" class="form-select form-select-sm border-0 bg-light rounded-pill px-3 shadow-none" onchange="this.form.submit()">
                            <option value="semua" {{ request('kategori') == 'semua' || !request('kategori') ? 'selected' : '' }}>Semua Kategori</option>
                            <option value="Kegiatan Desa" {{ request('kategori') == 'Kegiatan Desa' ? 'selected' : '' }}>Kegiatan Desa</option>
                            <option value="Pariwisata" {{ request('kategori') == 'Pariwisata' ? 'selected' : '' }}>Pariwisata</option>
                            <option value="Ekonomi & UMKM" {{ request('kategori') == 'Ekonomi & UMKM' ? 'selected' : '' }}>Ekonomi & UMKM</option>
                            <option value="Pembangunan" {{ request('kategori') == 'Pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                            <option value="Sosial" {{ request('kategori') == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                            <option value="Pengumuman" {{ request('kategori') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="sort" class="form-select form-select-sm border-0 bg-light rounded-pill px-3 shadow-none" onchange="this.form.submit()">
                            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                            <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                            <option value="judul_asc" {{ request('sort') == 'judul_asc' ? 'selected' : '' }}>A - Z</option>
                            <option value="judul_desc" {{ request('sort') == 'judul_desc' ? 'selected' : '' }}>Z - A</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <a href="{{ url('/operator/berita/create') }}" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm hover-lift border-0">
                            <i data-lucide="plus" class="icon-xs me-1"></i> Tulis Berita
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Table Berita -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 text-uppercase small fw-bold text-muted">Aset & Judul</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Info</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted text-center" style="width: 15%">Statistik</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Status</th>
                        <th class="text-end pe-4 py-3 text-uppercase small fw-bold text-muted">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($berita as $b)
                    <tr>
                        <td class="ps-4 py-3">
                            <div class="d-flex align-items-center">
                                @if($b->gambar)
                                    <img src="{{ asset('storage/'.$b->gambar) }}" class="rounded-3 shadow-sm me-3 border border-light" style="width:55px; height:55px; object-fit:cover;">
                                @else
                                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center me-3" style="width:55px; height:55px;">
                                        <i data-lucide="image" class="text-muted opacity-50"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-bold text-dark">{{ \Illuminate\Support\Str::limit($b->judul, 50) }}</div>
                                    <small class="text-muted"><i data-lucide="calendar" class="icon-xs me-1"></i>{{ \Carbon\Carbon::parse($b->tanggal)->translatedFormat('d F Y') }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">{{ $b->kategori }}</span>
                            <div class="small text-muted mt-1 px-1">Oleh: {{ $b->penulis }}</div>
                        </td>
                        <td class="text-center">
                            <div class="d-inline-flex flex-column gap-2" style="min-width: 120px;">
                                <div class="d-flex justify-content-between align-items-center bg-light rounded-pill px-2 py-1 border border-opacity-10" title="Dilihat">
                                    <span class="small text-muted me-2"><i data-lucide="eye" class="icon-xs text-primary"></i></span>
                                    <span class="fw-bold small">{{ number_format($b->views) }}</span>
                                </div>
                                <div class="d-flex gap-1 justify-content-between">
                                    <div class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1 flex-fill d-flex align-items-center justify-content-center" title="Suka">
                                        <i data-lucide="thumbs-up" class="icon-xs me-1"></i> {{ $b->likes }}
                                    </div>
                                    <div class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-2 py-1 flex-fill d-flex align-items-center justify-content-center" title="Tidak Suka">
                                        <i data-lucide="thumbs-down" class="icon-xs me-1"></i> {{ $b->dislikes }}
                                    </div>
                                </div>
                                <div class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-10 rounded-pill px-2 py-1 flex-fill d-flex align-items-center justify-content-center" title="Dibagikan">
                                    <i data-lucide="share-2" class="icon-xs me-1"></i> {{ $b->shares }}
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($b->status_publish == 'publish')
                                <span class="badge bg-success border-0 px-3 rounded-pill fw-medium"><i data-lucide="check-circle" class="icon-xs me-1"></i> Terbit</span>
                            @else
                                <span class="badge bg-secondary border-0 px-3 rounded-pill fw-medium"><i data-lucide="file-edit" class="icon-xs me-1"></i> Draft</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ url('/operator/berita/'.$b->id.'/edit') }}" class="btn btn-sm btn-white border shadow-sm hover-lift" title="Edit Berita">
                                    <i data-lucide="edit-3" class="icon-xs text-primary"></i>
                                </a>
                                <form action="{{ url('/operator/berita/'.$b->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus berita ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-white border shadow-sm hover-lift" title="Hapus Berita">
                                        <i data-lucide="trash-2" class="icon-xs text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted bg-white">
                            <i data-lucide="newspaper" class="icon-xl opacity-25 mb-2 d-block mx-auto text-success"></i>
                            Belum ada berita yang diterbitkan.
                        </td>
                    </tr>
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
