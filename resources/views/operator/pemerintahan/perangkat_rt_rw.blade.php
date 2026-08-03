@extends('layouts.dashboard')
@section('title', 'Perangkat RT & RW')
@section('content')

<!-- Section Hero Setting (CMS) -->
<div class="dash-card bg-white p-4 mb-4 border-top border-4 border-success shadow-sm rounded-4 text-start">
    <h6 class="fw-bold mb-3 d-flex align-items-center"><i data-lucide="image" class="text-success me-2 icon-sm"></i> Pengaturan Header Halaman</h6>
    <form action="{{ url('operator/perangkat-rt-rw/hero') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="small fw-bold text-muted">Judul Halaman</label>
                <input type="text" name="title" class="form-control form-control-sm" value="{{ $hero['title'] ?? 'Perangkat RT & RW' }}">
            </div>
            <div class="col-md-5">
                <label class="small fw-bold text-muted">Sub-Judul</label>
                <input type="text" name="subtitle" class="form-control form-control-sm" value="{{ $hero['subtitle'] ?? 'Daftar Ketua RT dan RW Desa Selorejo' }}">
            </div>
            <div class="col-md-2">
                <label class="small fw-bold text-muted">Ikon (Lucide)</label>
                <input type="text" name="icon" class="form-control form-control-sm" value="{{ $hero['icon'] ?? 'map-pin' }}">
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="submit" class="btn btn-sm btn-success w-100 shadow-sm border-0">Simpan</button>
            </div>
        </div>
    </form>
</div>

<!-- Statistik Ringkas -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 text-start">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="rounded-3 p-3 d-flex align-items-center justify-content-center" style="background: rgba(26,92,56,0.1); color: var(--bs-success);">
                    <i data-lucide="map-pin" class="icon-md"></i>
                </div>
                <div>
                    <div class="fw-bold fs-4 text-dark">{{ $data->where('jenis','RT')->count() }}</div>
                    <small class="text-muted fw-medium">Total RT</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 text-start">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="rounded-3 p-3 d-flex align-items-center justify-content-center" style="background: rgba(13,110,253,0.1); color: var(--bs-primary);">
                    <i data-lucide="layers" class="icon-md"></i>
                </div>
                <div>
                    <div class="fw-bold fs-4 text-dark">{{ $data->where('jenis','RW')->count() }}</div>
                    <small class="text-muted fw-medium">Total RW</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 text-start">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="rounded-3 p-3 d-flex align-items-center justify-content-center" style="background: rgba(255,193,7,0.15); color: #856404;">
                    <i data-lucide="home" class="icon-md"></i>
                </div>
                <div>
                    <div class="fw-bold fs-4 text-dark">{{ $data->pluck('dusun')->unique()->count() }}</div>
                    <small class="text-muted fw-medium">Dusun</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Header Manajemen -->
<div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden text-start">
    <div class="card-body p-4 d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-0">Daftar Perangkat RT & RW</h5>
            <small class="text-muted">Kelola data ketua RT dan RW di seluruh wilayah Desa Selorejo</small>
        </div>
        <button class="btn btn-success rounded-pill px-4 shadow-sm hover-lift border-0" data-bs-toggle="modal" data-bs-target="#addModal">
            <i data-lucide="plus" class="icon-sm me-1"></i> Tambah Data
        </button>
    </div>
</div>

<!-- Filter Tabs -->
<ul class="nav nav-pills mb-3 gap-2" id="jenisTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active rounded-pill px-4" id="all-tab" data-bs-toggle="pill" data-bs-target="#all" type="button">Semua</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link rounded-pill px-4" id="rt-tab" data-bs-toggle="pill" data-bs-target="#rtPane" type="button">Hanya RT</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link rounded-pill px-4" id="rw-tab" data-bs-toggle="pill" data-bs-target="#rwPane" type="button">Hanya RW</button>
    </li>
</ul>

<div class="tab-content">
    <!-- Tab Semua -->
    <div class="tab-pane fade show active" id="all" role="tabpanel">
        @include('operator.pemerintahan._table_rt_rw', ['rows' => $data])
    </div>
    <!-- Tab RT -->
    <div class="tab-pane fade" id="rtPane" role="tabpanel">
        @include('operator.pemerintahan._table_rt_rw', ['rows' => $data->where('jenis','RT')])
    </div>
    <!-- Tab RW -->
    <div class="tab-pane fade" id="rwPane" role="tabpanel">
        @include('operator.pemerintahan._table_rt_rw', ['rows' => $data->where('jenis','RW')])
    </div>
</div>

@foreach($data as $item)
<!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered text-start">
    <form action="{{ route('operator.perangkat-rt-rw.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="modal-content border-0 shadow-lg rounded-4">
      @csrf @method('PUT')
      <div class="modal-header border-0 bg-success text-white py-3">
        <h5 class="modal-title fw-bold"><i data-lucide="edit-3" class="icon-sm me-2"></i> Edit {{ $item->jenis }} {{ str_pad($item->nomor,2,'0',STR_PAD_LEFT) }}</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="small fw-bold text-muted mb-1">Jenis</label>
                <select name="jenis" class="form-select rounded-3" required>
                    <option value="RT" {{ $item->jenis=='RT'?'selected':'' }}>RT (Rukun Tetangga)</option>
                    <option value="RW" {{ $item->jenis=='RW'?'selected':'' }}>RW (Rukun Warga)</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="small fw-bold text-muted mb-1">Nomor RT/RW</label>
                <input type="number" name="nomor" class="form-control rounded-3" value="{{ $item->nomor }}" min="1" required>
            </div>
            <div class="col-12">
                <label class="small fw-bold text-muted mb-1">Nama Ketua</label>
                <input type="text" name="nama" class="form-control rounded-3" value="{{ $item->nama }}" required>
            </div>
            <div class="col-md-8">
                <label class="small fw-bold text-muted mb-1">Dusun</label>
                <select name="dusun" class="form-select rounded-3" required>
                    <option value="Dsn. Krajan" {{ $item->dusun=='Dsn. Krajan'?'selected':'' }}>Dsn. Krajan</option>
                    <option value="Dsn. Selokerto" {{ $item->dusun=='Dsn. Selokerto'?'selected':'' }}>Dsn. Selokerto</option>
                    <option value="Dsn. Gumuk" {{ $item->dusun=='Dsn. Gumuk'?'selected':'' }}>Dsn. Gumuk</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="small fw-bold text-muted mb-1">Nomor RW</label>
                <input type="number" name="nomor_rw" class="form-control rounded-3" value="{{ $item->nomor_rw }}" min="1" required>
            </div>
            <div class="col-md-6">
                <label class="small fw-bold text-muted mb-1">Nomor RT <span class="text-muted fw-normal">(jika RT)</span></label>
                <input type="number" name="nomor_rt" class="form-control rounded-3" value="{{ $item->nomor_rt }}" min="1" placeholder="Kosongkan jika RW">
            </div>
            <div class="col-md-6">
                <label class="small fw-bold text-muted mb-1">Urutan Tampil</label>
                <input type="number" name="urutan" class="form-control rounded-3" value="{{ $item->urutan }}" min="0" required>
            </div>
            <div class="col-12">
                <label class="small fw-bold text-muted mb-1 d-block">Ganti Foto (Opsional)</label>
                @if($item->foto)
                    <img src="{{ asset('storage/'.$item->foto) }}" class="rounded-3 mb-2 border" style="width:50px; height:50px; object-fit:cover;">
                @endif
                <input type="file" name="foto" class="form-control rounded-3">
            </div>
        </div>
      </div>
      <div class="modal-footer border-0 p-4 pt-0">
        <button type="button" class="btn btn-light px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success px-4 rounded-pill shadow-sm">Update Data</button>
      </div>
    </form>
  </div>
</div>
@endforeach

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered text-start">
    <form action="{{ route('operator.perangkat-rt-rw.store') }}" method="POST" enctype="multipart/form-data" class="modal-content border-0 shadow-lg rounded-4">
      @csrf
      <div class="modal-header border-0 bg-success text-white py-3">
        <h5 class="modal-title fw-bold"><i data-lucide="plus" class="icon-sm me-2"></i> Tambah Perangkat RT / RW</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="small fw-bold text-muted mb-1">Jenis</label>
                <select name="jenis" class="form-select rounded-3" id="addJenis" required>
                    <option value="RT">RT (Rukun Tetangga)</option>
                    <option value="RW">RW (Rukun Warga)</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="small fw-bold text-muted mb-1">Nomor RT/RW</label>
                <input type="number" name="nomor" class="form-control rounded-3" placeholder="Contoh: 1" min="1" required>
            </div>
            <div class="col-12">
                <label class="small fw-bold text-muted mb-1">Nama Ketua</label>
                <input type="text" name="nama" class="form-control rounded-3" placeholder="Nama lengkap ketua" required>
            </div>
            <div class="col-md-8">
                <label class="small fw-bold text-muted mb-1">Dusun</label>
                <select name="dusun" class="form-select rounded-3" required>
                    <option value="Dsn. Krajan">Dsn. Krajan</option>
                    <option value="Dsn. Selokerto">Dsn. Selokerto</option>
                    <option value="Dsn. Gumuk">Dsn. Gumuk</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="small fw-bold text-muted mb-1">Nomor RW</label>
                <input type="number" name="nomor_rw" class="form-control rounded-3" placeholder="Nomor RW" min="1" required>
            </div>
            <div class="col-md-6" id="addNomorRtGroup">
                <label class="small fw-bold text-muted mb-1">Nomor RT <span class="text-muted fw-normal">(jika RT)</span></label>
                <input type="number" name="nomor_rt" class="form-control rounded-3" placeholder="Kosongkan jika RW" min="1">
            </div>
            <div class="col-md-6">
                <label class="small fw-bold text-muted mb-1">Urutan Tampil</label>
                <input type="number" name="urutan" class="form-control rounded-3" placeholder="0" min="0" value="0" required>
            </div>
            <div class="col-12">
                <label class="small fw-bold text-muted mb-1 d-block">Foto Profil (Opsional)</label>
                <input type="file" name="foto" class="form-control rounded-3">
            </div>
        </div>
      </div>
      <div class="modal-footer border-0 p-4 pt-0">
        <button type="button" class="btn btn-light px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success px-4 rounded-pill shadow-sm">Tambahkan</button>
      </div>
    </form>
  </div>
</div>

<script>
// Sembunyikan field nomor_rt jika jenis dipilih RW
document.getElementById('addJenis').addEventListener('change', function() {
    const group = document.getElementById('addNomorRtGroup');
    group.style.display = this.value === 'RW' ? 'none' : '';
});
</script>
@endsection
