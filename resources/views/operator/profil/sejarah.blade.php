@extends('layouts.dashboard')
@section('title', 'Kelola Sejarah Desa')
@section('content')

<div class="row text-start">
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i data-lucide="check-circle" class="me-2 icon-sm"></i>
                    <div class="fw-bold">{{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ url('/operator/profil') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="origin_tab" value="sejarah">
            
            @php
                $hero_sejarah = $profil->hero_sejarah ?? ['title' => 'Sejarah Desa', 'subtitle' => 'Menelusuri jejak peradaban...', 'icon' => 'history'];
            @endphp

            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden border-top border-4 border-success">
                <div class="card-body p-4 p-md-5">
                    <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="image" class="text-success me-3"></i> Header Halaman Sejarah</h5>
                    <div class="row g-3 mb-5 p-3 bg-light rounded-4">
                        <div class="col-md-4">
                            <label class="small fw-bold text-muted mb-1">Judul Halaman</label>
                            <input type="text" name="hero_sejarah[title]" class="form-control rounded-3" value="{{ $hero_sejarah['title'] ?? '' }}">
                        </div>
                        <div class="col-md-5">
                            <label class="small fw-bold text-muted mb-1">Sub-Judul</label>
                            <input type="text" name="hero_sejarah[subtitle]" class="form-control rounded-3" value="{{ $hero_sejarah['subtitle'] ?? '' }}">
                        </div>
                        <div class="col-md-3">
                            <label class="small fw-bold text-muted mb-1">Ikon (Lucide)</label>
                            <input type="text" name="hero_sejarah[icon]" class="form-control rounded-3" value="{{ $hero_sejarah['icon'] ?? 'history' }}">
                        </div>
                    </div>

                    <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="pencil-line" class="text-success me-3"></i> Narasi & Gambar Sejarah Desa</h5>
                    <div class="row g-4 mb-5">
                        <div class="col-md-7">
                            <label class="form-label text-muted small fw-bold">Konten Sejarah (Mendukung HTML Sederhana)</label>
                            <textarea name="sejarah" class="form-control rounded-4 shadow-none p-4 rich-text" rows="12" placeholder="Masukkan narasi sejarah desa dengan mendalam...">{{ old('sejarah', $profil->sejarah) }}</textarea>
                        </div>
                        <div class="col-md-5 text-start">
                            <label class="form-label text-muted small fw-bold">Unggah Gambar Sejarah</label>
                            <div class="p-3 border rounded-4 bg-light text-center">
                                @if($profil->sejarah_image)
                                    <img src="{{ asset($profil->sejarah_image) }}" class="img-thumbnail rounded-4 shadow-sm mb-3" style="max-height: 200px; width: 100%; object-fit: contain;">
                                @else
                                    <div class="bg-white rounded-4 border border-dashed py-5 mb-3">
                                        <i data-lucide="image" class="text-muted opacity-25" style="width:48px;height:48px;"></i>
                                    </div>
                                @endif
                                <input type="file" name="sejarah_image" class="form-control rounded-pill border-0 shadow-sm" accept="image/*">
                                <small class="text-muted mt-3 d-block italic fw-medium">Direkomendasikan gambar dengan resolusi tinggi (Maks 2MB)</small>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4 pt-4 border-top">
                        <h5 class="fw-bold mb-0 d-flex align-items-center"><i data-lucide="calendar-days" class="text-success me-3"></i> Lini Masa (Timeline)</h5>
                        <button type="button" class="btn btn-sm btn-success rounded-pill px-4 shadow-sm border-0" onclick="addRow('timeline-container', 'timeline-template')">
                            <i data-lucide="plus" class="icon-sm me-1"></i> Tambah Jejak
                        </button>
                    </div>

                    <div id="timeline-container" class="pe-md-4">
                        @php $timelines = $profil->sejarah_timeline ?? []; @endphp
                        @foreach($timelines as $index => $item)
                        <div class="timeline-item-row dash-card p-4 rounded-4 mb-4 border border-success border-opacity-10 position-relative hover-lift">
                            <div class="row g-3">
                                <div class="col-md-2">
                                    <label class="small fw-bold text-muted">Era/Tahun</label>
                                    <input type="text" name="sejarah_timeline[{{ $index }}][year]" class="form-control rounded-3 border-success border-opacity-25" value="{{ $item['year'] }}" placeholder="19xx">
                                </div>
                                <div class="col-md-5">
                                    <label class="small fw-bold text-muted">Nama Peristiwa</label>
                                    <input type="text" name="sejarah_timeline[{{ $index }}][title]" class="form-control rounded-3" value="{{ $item['title'] }}" placeholder="Contoh: Pembukaan Desa">
                                </div>
                                <div class="col-md-3">
                                    <label class="small fw-bold text-muted">Ikon Visual</label>
                                    <input type="text" name="sejarah_timeline[{{ $index }}][icon]" class="form-control rounded-3" value="{{ $item['icon'] ?? 'milestone' }}" placeholder="map-pin">
                                </div>
                                <div class="col-md-2 d-flex align-items-end text-end">
                                    <button type="button" class="btn btn-sm btn-white border shadow-sm w-100 py-2 text-danger hover-lift" onclick="this.closest('.timeline-item-row').remove()">
                                        <i data-lucide="trash-2" class="icon-sm me-1"></i> Hapus
                                    </button>
                                </div>
                                <div class="col-12 mt-3">
                                    <label class="small fw-bold text-muted">Rekam Jejak / Keterangan</label>
                                    <textarea name="sejarah_timeline[{{ $index }}][desc]" class="form-control rounded-3" rows="3">{{ $item['desc'] }}</textarea>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Enhanced Global Submit -->
            <div class="card border-0 shadow-lg rounded-4 mb-5 mt-4 p-2 bg-success bg-opacity-10 header-gradient border-top border-4 border-success">
                <div class="card-body p-4 p-md-5 text-center">
                    <div class="bg-white d-inline-block p-4 rounded-circle mb-4 shadow-sm border border-success border-opacity-25">
                        <i data-lucide="send" class="text-success" style="width:40px; height:40px;"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-3">Finalisasi Perubahan Profil</h4>
                    <p class="text-muted mb-4 mx-auto" style="max-width: 600px;">Data profil Sejarah akan diperbarui secara real-time pada halaman publik Desa Selorejo.</p>
                    
                    <button type="submit" class="btn btn-success px-5 py-3 rounded-pill fw-bold hover-lift shadow border-0" style="font-size:1.1rem;">
                        <i data-lucide="save" class="me-2"></i> SIMPAN & PUBLIKASIKAN
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Template Header for Sejarah Timeline -->
<div id="timeline-template" class="d-none">
    <div class="timeline-item-row dash-card p-4 rounded-4 mb-4 border border-success border-opacity-10 position-relative">
        <div class="row g-3">
            <div class="col-md-2">
                <label class="small fw-bold text-muted">Era/Tahun</label>
                <input type="text" name="sejarah_timeline[INDEX][year]" class="form-control rounded-3 border-success border-opacity-25" placeholder="19xx">
            </div>
            <div class="col-md-5">
                <label class="small fw-bold text-muted">Nama Peristiwa</label>
                <input type="text" name="sejarah_timeline[INDEX][title]" class="form-control rounded-3" placeholder="Judul singkat">
            </div>
            <div class="col-md-3">
                <label class="small fw-bold text-muted">Ikon Visual</label>
                <input type="text" name="sejarah_timeline[INDEX][icon]" class="form-control rounded-3" value="milestone">
            </div>
            <div class="col-md-2 d-flex align-items-end text-end">
                <button type="button" class="btn btn-sm btn-white border shadow-sm w-100 py-2 text-danger" onclick="this.closest('.timeline-item-row').remove()"><i data-lucide="trash-2" class="icon-sm"></i></button>
            </div>
            <div class="col-12 mt-3">
                <label class="small fw-bold text-muted">Rekam Jejak / Keterangan</label>
                <textarea name="sejarah_timeline[INDEX][desc]" class="form-control rounded-3" rows="3"></textarea>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function addRow(containerId, templateId) {
        const container = document.getElementById(containerId);
        const template = document.getElementById(templateId).innerHTML;
        const html = template.replace(/INDEX/g, Date.now()); 
        container.insertAdjacentHTML('beforeend', html);
        
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }
</script>
@endpush
