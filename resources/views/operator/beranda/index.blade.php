@extends('layouts.dashboard')
@section('title', 'CMS Beranda')
@section('content')

<div class="row justify-content-center text-start">
    <div class="col-lg-12">
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center p-3">
                <i data-lucide="check-circle" class="me-2 text-success"></i>
                <div class="fw-bold">{{ session('success') }}</div>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        <div class="mb-4">
            <h5 class="fw-bold text-dark"><i data-lucide="layout" class="icon-sm me-2 text-success"></i> CMS Halaman Beranda</h5>
            <p class="text-muted small">Kelola slideshow hero dan tautan terkait beranda dari sini.</p>
        </div>

        <div class="row g-4">

            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white p-4 border-0 border-bottom">
                        <h6 class="fw-bold mb-0"><i data-lucide="image" class="text-success me-2"></i>Slideshow Hero Beranda</h6>
                        <small class="text-muted">Upload/hapus gambar latar slideshow (maks. 2MB/gambar)</small>
                    </div>
                    <div class="card-body p-4">
                        @if(count($slideshow) > 0)
                            <div class="row g-3 mb-4">
                                @foreach($slideshow as $i => $slide)
                                <div class="col-md-6">
                                    <div class="position-relative rounded-3 overflow-hidden border shadow-sm" style="height:140px">
                                        <img src="{{ asset('storage/'.$slide['path']) }}" onerror="this.src='{{ asset('images/hero_desa.png') }}'" class="w-100 h-100" style="object-fit:cover">
                                        <div class="position-absolute top-0 start-0 w-100 d-flex justify-content-between align-items-start p-2" style="background:linear-gradient(to bottom,rgba(0,0,0,.6),transparent)">
                                            <span class="badge bg-dark">Slide {{ $i+1 }}</span>
                                            <form action="{{ route('operator.beranda.slide.delete') }}" method="POST" onsubmit="return confirm('Hapus slide?')">
                                                @csrf
                                                <input type="hidden" name="index" value="{{ $i }}">
                                                <button type="submit" class="btn btn-sm btn-danger rounded-circle p-1" style="width:26px;height:26px;line-height:1"><i data-lucide="x" style="width:12px;height:12px"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info rounded-3 mb-4 small"><i data-lucide="info" class="me-1 icon-xs"></i> Belum ada slide custom. Gambar default akan digunakan.</div>
                        @endif
                        <form action="{{ route('operator.beranda.slide.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label class="form-label fw-bold text-muted small">TAMBAH SLIDE BARU</label>
                            <div class="input-group">
                                <input type="file" name="slide_image" class="form-control rounded-3 border" accept="image/*" required>
                                <button type="submit" class="btn btn-success rounded-3 border-0 fw-bold px-3"><i data-lucide="upload" class="me-1 icon-xs"></i> Upload</button>
                            </div>
                            <small class="text-muted d-block mt-1">Format: JPG/PNG/WEBP. Resolusi: 1920x1080px.</small>
                        </form>
                        @if(count($slideshow)>=1)
                        <div class="alert alert-warning rounded-3 mt-3 small mb-0"><i data-lucide="alert-triangle" class="me-1 icon-xs"></i> Jika ada slide custom, gambar default tidak ditampilkan.</div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white p-4 border-0 border-bottom">
                        <h6 class="fw-bold mb-0"><i data-lucide="external-link" class="text-primary me-2"></i>Tautan Terkait</h6>
                        <small class="text-muted">Ditampilkan di bagian bawah beranda (kolom Tautan Terkait)</small>
                    </div>
                    <div class="card-body p-4">
                        @if($tautanTerkait->count() > 0)
                        <div class="table-responsive mb-4"><table class="table table-sm table-hover align-middle"><thead class="table-light"><tr><th class="small fw-bold text-muted">NAMA</th><th class="small fw-bold text-muted">URL</th><th class="small fw-bold text-muted text-end">AKSI</th></tr></thead><tbody>
                        @foreach($tautanTerkait as $tautan)
                        <tr><td class="fw-bold small">{{ $tautan->nama }}</td><td class="small text-muted text-truncate" style="max-width:160px"><a href="{{ $tautan->url }}" target="_blank" class="text-decoration-none">{{ $tautan->url }}</a></td>
                        <td class="text-end">
                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-2 py-0" data-bs-toggle="modal" data-bs-target="#editTautan{{ $tautan->id }}"><i data-lucide="edit-2" style="width:12px;height:12px"></i></button>
                        <form action="{{ route('operator.beranda.tautan.destroy', $tautan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-2 py-0"><i data-lucide="trash-2" style="width:12px;height:12px"></i></button></form>
                        </td></tr>
                        @endforeach
                        </tbody></table></div>
                        @else<div class="alert alert-light rounded-3 small mb-4">Belum ada tautan.</div>@endif
                        <form action="{{ route('operator.beranda.tautan.store') }}" method="POST">@csrf
                            <label class="form-label fw-bold text-muted small">TAMBAH TAUTAN BARU</label>
                            <div class="row g-2">
                                <div class="col-5"><input type="text" name="nama" class="form-control form-control-sm rounded-3 border" placeholder="Nama" required></div>
                                <div class="col-5"><input type="url" name="url" class="form-control form-control-sm rounded-3 border" placeholder="https://..." required></div>
                                <div class="col-2"><button type="submit" class="btn btn-sm btn-primary rounded-3 border-0 fw-bold w-100"><i data-lucide="plus" class="icon-xs"></i></button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        @foreach($tautanTerkait as $tautan)
        <div class="modal fade" id="editTautan{{ $tautan->id }}" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content rounded-4 border-0 shadow"><div class="modal-header border-0"><h6 class="modal-title fw-bold">Edit Tautan</h6><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <form action="{{ route('operator.beranda.tautan.update', $tautan->id) }}" method="POST">@csrf @method('PUT')
        <div class="modal-body px-4"><div class="mb-3"><label class="form-label fw-bold small text-muted">NAMA</label><input type="text" name="nama" class="form-control rounded-3" value="{{ $tautan->nama }}" required></div><div class="mb-3"><label class="form-label fw-bold small text-muted">URL</label><input type="url" name="url" class="form-control rounded-3" value="{{ $tautan->url }}" required></div></div>
        <div class="modal-footer border-0"><button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary rounded-3 fw-bold border-0">Simpan</button></div></form></div></div></div>
        @endforeach

    </div>
</div>
<style>.animate-fade-in{animation:fadeIn .5s ease-out}@keyframes fadeIn{from{opacity:0;transform:translateY(-10px)}to{opacity:1;transform:translateY(0)}}</style>
@endsection
