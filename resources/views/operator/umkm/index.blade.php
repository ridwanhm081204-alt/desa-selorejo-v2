@extends('layouts.dashboard')
@section('title', 'Manajemen UMKM Desa')
@section('content')

{{-- ─── Header Stats ─────────────────────────────────────────────────────────── --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="dash-card p-3 text-center">
            <div class="fw-bold text-success" style="font-size:1.8rem;">{{ $stats['total'] }}</div>
            <small class="text-muted">Total UMKM</small>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="dash-card p-3 text-center">
            <div class="fw-bold text-success" style="font-size:1.8rem;">{{ $stats['terverifikasi'] }}</div>
            <small class="text-muted">Terverifikasi</small>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="dash-card p-3 text-center">
            <div class="fw-bold text-warning" style="font-size:1.8rem;">{{ $stats['perlu_dicek'] }}</div>
            <small class="text-muted">Perlu Dicek</small>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="dash-card p-3 text-center">
            <div class="fw-bold text-danger" style="font-size:1.8rem;">{{ $stats['belum'] }}</div>
            <small class="text-muted">Belum Terdaftar</small>
        </div>
    </div>
</div>

{{-- ─── Header + Filter ──────────────────────────────────────────────────────── --}}
<div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
    <div class="card-body p-4">
        <div class="row align-items-center g-3">
            <div class="col-md-3">
                <h5 class="fw-bold mb-0">Daftar UMKM</h5>
                <small class="text-muted">Kelola data usaha warga desa</small>
            </div>
            <div class="col-md-9">
                <form action="{{ url('/operator/umkm') }}" method="GET" class="row g-2 justify-content-md-end">
                    <div class="col-md-3">
                        <div class="input-group input-group-sm rounded-pill overflow-hidden border px-2 bg-light">
                            <span class="input-group-text bg-transparent border-0"><i data-lucide="search" class="icon-xs text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-0 bg-transparent shadow-none"
                                   placeholder="Cari usaha..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <select name="dusun" class="form-select form-select-sm border-0 bg-light rounded-pill px-2 shadow-none" onchange="this.form.submit()">
                            <option value="semua" {{ request('dusun', 'semua') == 'semua' ? 'selected' : '' }}>Semua Dusun</option>
                            <option value="Krajan"    {{ request('dusun') == 'Krajan'    ? 'selected' : '' }}>Krajan</option>
                            <option value="Selokerto" {{ request('dusun') == 'Selokerto' ? 'selected' : '' }}>Selokerto</option>
                            <option value="Gumuk"     {{ request('dusun') == 'Gumuk'     ? 'selected' : '' }}>Gumuk</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="kategori" class="form-select form-select-sm border-0 bg-light rounded-pill px-2 shadow-none" onchange="this.form.submit()">
                            <option value="semua" {{ request('kategori', 'semua') == 'semua' ? 'selected' : '' }}>Semua Kategori</option>
                            @foreach(\App\Models\Umkm::KATEGORI_LIST as $kat)
                                <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto d-flex gap-2">
                        <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 border-0 shadow-sm">Cari</button>
                        <a href="{{ url('/operator/umkm/create') }}" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm hover-lift border-0">
                            <i data-lucide="plus" class="icon-xs me-1"></i>Tambah
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ─── Info Geocoding ───────────────────────────────────────────────────────── --}}
@if($stats['perlu_dicek'] > 0)
<div class="alert alert-warning border-0 rounded-4 shadow-sm mb-4 d-flex align-items-center gap-3" role="alert">
    <i data-lucide="map-off" class="text-warning flex-shrink-0" style="width:20px;height:20px;"></i>
    <div class="flex-grow-1 small">
        Ada <strong>{{ $stats['perlu_dicek'] }}</strong> UMKM dengan status <em>perlu_dicek</em> (koordinat belum diisi).
        Jalankan: <code>php artisan umkm:geocode</code> untuk mengisi koordinat secara otomatis.
    </div>
</div>
@endif

{{-- ─── Tabel UMKM ───────────────────────────────────────────────────────────── --}}
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-uppercase">
                    <tr>
                        <th class="ps-4 py-3 small fw-bold text-muted" style="width:35%">Usaha</th>
                        <th class="py-3 small fw-bold text-muted">Dusun</th>
                        <th class="py-3 small fw-bold text-muted">Kategori</th>
                        <th class="py-3 small fw-bold text-muted text-center">Status Lokasi</th>
                        <th class="py-3 small fw-bold text-muted">Kontak</th>
                        <th class="text-end pe-4 py-3 small fw-bold text-muted" style="width:10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $item)
                    <tr>
                        <td class="ps-4 py-3">
                            <div class="fw-bold text-dark">{{ $item->nama_usaha }}</div>
                            @if($item->nama_toko_gmaps && $item->nama_toko_gmaps !== $item->nama_usaha)
                                <small class="text-muted">{{ $item->nama_toko_gmaps }}</small>
                            @endif
                            <div class="small text-muted mt-1">
                                <i data-lucide="user" class="icon-xs me-1"></i>{{ $item->nama_pemilik }}
                            </div>
                            <div class="small text-muted">
                                <i data-lucide="briefcase" class="icon-xs me-1"></i>{{ Str::limit($item->jenis_usaha, 40) }}
                            </div>
                        </td>
                        <td class="py-3">
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1 small fw-bold">
                                {{ $item->dusun }}
                            </span>
                            @if($item->alamat_rt_rw)
                            <div class="small text-muted mt-1">RT/RW {{ $item->alamat_rt_rw }}</div>
                            @endif
                        </td>
                        <td class="py-3">
                            <span class="badge rounded-pill px-2 py-1 small fw-normal"
                                  style="background:var(--bg-light);color:#2d6a4f;border:1px solid #52b78830;font-size:0.68rem;">
                                {{ $item->kategori }}
                            </span>
                        </td>
                        <td class="py-3 text-center">
                            @php
                                $statusBadge = match($item->status_lokasi) {
                                    'terverifikasi'   => ['bg-success', 'Terverifikasi'],
                                    'belum_terdaftar' => ['bg-danger',  'Belum Terdaftar'],
                                    default           => ['bg-warning text-dark', 'Perlu Dicek'],
                                };
                            @endphp
                            <span class="badge {{ $statusBadge[0] }} rounded-pill px-2 py-1 small">{{ $statusBadge[1] }}</span>
                            @if($item->hasCoordinates())
                            <div class="small text-muted mt-1" style="font-size:0.65rem;">
                                {{ number_format($item->latitude, 4) }}, {{ number_format($item->longitude, 4) }}
                            </div>
                            @endif
                        </td>
                        <td class="py-3">
                            @if($item->no_telepon)
                            <div class="small text-muted d-flex align-items-center">
                                <i data-lucide="phone" class="icon-xs me-1"></i>{{ $item->no_telepon }}
                            </div>
                            @endif
                            @if($item->gmail_usaha)
                            <div class="small text-muted d-flex align-items-center">
                                <i data-lucide="mail" class="icon-xs me-1"></i>{{ Str::limit($item->gmail_usaha, 25) }}
                            </div>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('wisata.umkm.show', $item->id) }}" target="_blank"
                                   class="btn btn-sm btn-white border shadow-sm hover-lift" title="Lihat Halaman Publik">
                                    <i data-lucide="external-link" class="icon-xs text-success"></i>
                                </a>
                                <a href="{{ route('operator.umkm.edit', $item->id) }}"
                                   class="btn btn-sm btn-white border shadow-sm hover-lift" title="Edit">
                                    <i data-lucide="edit-3" class="icon-xs text-primary"></i>
                                </a>
                                <form action="{{ route('operator.umkm.destroy', $item->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus UMKM ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-white border shadow-sm hover-lift" title="Hapus">
                                        <i data-lucide="trash-2" class="icon-xs text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted bg-white">
                            <i data-lucide="store" class="opacity-25 mb-2 d-block mx-auto text-success" style="width:48px;height:48px;"></i>
                            Belum ada data UMKM yang terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($data->hasPages())
    <div class="card-footer bg-white border-0 p-3">
        {{ $data->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

@endsection
