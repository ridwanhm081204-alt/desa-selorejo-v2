@extends('layouts.dashboard')
@section('title', 'Manajemen Galeri')
@section('content')

<!-- Section Hero Setting (CMS) -->
<div class="dash-card bg-white p-4 mb-4 border-top border-4 border-success shadow-sm rounded-4">
    <h6 class="fw-bold mb-3 d-flex align-items-center"><i data-lucide="image" class="text-success me-2 icon-sm"></i> Pengaturan Header Halaman</h6>
    <form action="{{ url('operator/galeri/hero') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="small fw-bold text-muted">Judul Halaman</label>
                <input type="text" name="title" class="form-control form-control-sm" value="{{ $hero['title'] ?? 'Galeri Dokumentasi' }}">
            </div>
            <div class="col-md-5">
                <label class="small fw-bold text-muted">Sub-Judul</label>
                <input type="text" name="subtitle" class="form-control form-control-sm" value="{{ $hero['subtitle'] ?? 'Jendela visual potensi dan pesona alami Desa Selorejo' }}">
            </div>
            <div class="col-md-2">
                <label class="small fw-bold text-muted">Ikon (Lucide)</label>
                <input type="text" name="icon" class="form-control form-control-sm" value="{{ $hero['icon'] ?? 'image' }}">
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
                <h5 class="fw-bold mb-0">Dokumentasi Desa</h5>
                <small class="text-muted">Kelola aset foto dan video desa</small>
            </div>
            <div class="col-md-9">
                <form action="{{ url('/operator/galeri') }}" method="GET" class="row g-2 justify-content-md-end">
                    <div class="col-md-3">
                        <div class="input-group input-group-sm rounded-pill overflow-hidden border px-2 bg-light">
                            <span class="input-group-text bg-transparent border-0"><i data-lucide="search" class="icon-xs text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-0 bg-transparent shadow-none" placeholder="Cari media..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <select name="kategori" class="form-select form-select-sm border-0 bg-light rounded-pill px-3 shadow-none" onchange="this.form.submit()">
                            <option value="semua" {{ request('kategori') == 'semua' || !request('kategori') ? 'selected' : '' }}>Semua Tag</option>
                            <option value="Wisata Alam" {{ request('kategori') == 'Wisata Alam' ? 'selected' : '' }}>Wisata Alam</option>
                            <option value="Potensi Desa" {{ request('kategori') == 'Potensi Desa' ? 'selected' : '' }}>Potensi Desa</option>
                            <option value="Kegiatan Warga" {{ request('kategori') == 'Kegiatan Warga' ? 'selected' : '' }}>Kegiatan Warga</option>
                            <option value="Infrastruktur" {{ request('kategori') == 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                            <option value="Event" {{ request('kategori') == 'Event' ? 'selected' : '' }}>Event</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="tipe" class="form-select form-select-sm border-0 bg-light rounded-pill px-3 shadow-none" onchange="this.form.submit()">
                            <option value="semua" {{ request('tipe') == 'semua' || !request('tipe') ? 'selected' : '' }}>Semua Tipe</option>
                            <option value="foto" {{ request('tipe') == 'foto' ? 'selected' : '' }}>Foto</option>
                            <option value="video" {{ request('tipe') == 'video' ? 'selected' : '' }}>Video</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="sort" class="form-select form-select-sm border-0 bg-light rounded-pill px-3 shadow-none" onchange="this.form.submit()">
                            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                            <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                            <option value="caption_asc" {{ request('sort') == 'caption_asc' ? 'selected' : '' }}>Caption A-Z</option>
                            <option value="caption_desc" {{ request('sort') == 'caption_desc' ? 'selected' : '' }}>Caption Z-A</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <a href="{{ url('/operator/galeri/create') }}" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm hover-lift border-0">
                            <i data-lucide="plus" class="icon-xs me-1"></i> Upload
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Table Galeri -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-center">
                <thead class="bg-light text-uppercase">
                    <tr>
                        <th class="ps-4 py-3 small fw-bold text-muted text-start" style="width: 15%">Preview</th>
                        <th class="py-3 small fw-bold text-muted text-start">Caption & Tag</th>
                        <th class="py-3 small fw-bold text-muted" style="width: 10%">Tipe</th>
                        <th class="py-3 small fw-bold text-muted" style="width: 15%">Tanggal</th>
                        <th class="text-end pe-4 py-3 small fw-bold text-muted" style="width: 12%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($galeri as $g)
                    <tr>
                        <td class="ps-4 py-3 text-start">
                            @if($g->tipe == 'foto')
                                <div class="position-relative d-inline-block">
                                    <img src="{{ asset('storage/'.$g->url) }}" class="rounded-3 shadow-sm border border-light" style="width:100px; height:65px; object-fit:cover;">
                                    <div class="position-absolute bottom-0 end-0 bg-success rounded-circle d-flex align-items-center justify-content-center border border-white" style="width:20px; height:20px; transform: translate(30%, 30%) shadow-sm;">
                                        <i data-lucide="camera" class="text-white" style="width:10px; height:10px;"></i>
                                    </div>
                                </div>
                            @else
                                <div class="position-relative d-inline-block">
                                    <div class="bg-dark rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width:100px; height:65px;">
                                        <i data-lucide="video" class="text-white-50" style="width:24px;"></i>
                                    </div>
                                    <div class="position-absolute bottom-0 end-0 bg-danger rounded-circle d-flex align-items-center justify-content-center border border-white" style="width:20px; height:20px; transform: translate(30%, 30%) shadow-sm;">
                                        <i data-lucide="play" class="text-white" style="width:10px; height:10px;"></i>
                                    </div>
                                </div>
                            @endif
                        </td>
                        <td class="py-3 text-start">
                            <div class="fw-bold text-dark">{{ Str::limit($g->caption, 60) ?? 'Tanpa Keterangan' }}</div>
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-0 small mt-1" style="font-size: 0.7rem;">{{ $g->kategori ?? 'Umum' }}</span>
                        </td>
                        <td class="py-3">
                            @if($g->tipe == 'foto')
                                <span class="badge bg-success bg-opacity-75 rounded-pill px-2">FOTO</span>
                            @else
                                <span class="badge bg-danger bg-opacity-75 rounded-pill px-2">VIDEO</span>
                            @endif
                        </td>
                        <td class="py-3 small text-muted">
                            <i data-lucide="calendar" class="icon-xs me-1"></i> {{ \Carbon\Carbon::parse($g->tanggal)->translatedFormat('d F Y') }}
                        </td>
                        <td class="text-end pe-4 py-3">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ url('/operator/galeri/'.$g->id.'/edit') }}" class="btn btn-sm btn-white border shadow-sm hover-lift" title="Edit Media">
                                    <i data-lucide="edit-3" class="icon-xs text-primary"></i>
                                </a>
                                <form action="{{ url('/operator/galeri/'.$g->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus media ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-white border shadow-sm hover-lift" title="Hapus Media">
                                        <i data-lucide="trash-2" class="icon-xs text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted bg-white">
                            <i data-lucide="image" class="icon-xl opacity-25 mb-2 d-block mx-auto text-success"></i>
                            Belum ada file media yang diupload.
                        </td>
                    </tr>
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
