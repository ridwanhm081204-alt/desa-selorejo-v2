@extends('layouts.dashboard')

@section('title', 'Kelola Profil Desa')

@section('content')
<div class="row">
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i data-lucide="check-circle" class="me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ url('/operator/profil') }}" method="POST" id="profileForm">
            @csrf

            <!-- Nav Tabs -->
            <ul class="nav nav-pills mb-4 bg-white p-2 rounded-4 shadow-sm" id="profileTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active rounded-pill px-4 d-flex align-items-center" id="sejarah-tab" data-bs-toggle="pill" data-bs-target="#sejarah" type="button" role="tab"><i data-lucide="book-open" class="icon-sm me-2"></i> Sejarah</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-4 d-flex align-items-center" id="visimisi-tab" data-bs-toggle="pill" data-bs-target="#visimisi" type="button" role="tab"><i data-lucide="target" class="icon-sm me-2"></i> Visi & Misi</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-4 d-flex align-items-center" id="geografi-tab" data-bs-toggle="pill" data-bs-target="#geografi" type="button" role="tab"><i data-lucide="mountain" class="icon-sm me-2"></i> Geografis</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-4 d-flex align-items-center" id="peta-tab" data-bs-toggle="pill" data-bs-target="#peta" type="button" role="tab"><i data-lucide="map" class="icon-sm me-2"></i> Peta & Akses</button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="profileTabsContent">
                <!-- Tab 1: Sejarah -->
                <div class="tab-pane fade show active" id="sejarah" role="tabpanel">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="align-left" class="text-success me-2"></i> Narasi Sejarah Desa</h5>
                            <div class="mb-4">
                                <label class="form-label text-muted small fw-bold">Konten Utama Sejarah</label>
                                <textarea name="sejarah" class="form-control" rows="10" placeholder="Masukkan narasi sejarah desa...">{{ old('sejarah', $profil->sejarah) }}</textarea>
                            </div>

                            <hr class="my-5 opacity-25">

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="fw-bold mb-0 d-flex align-items-center"><i data-lucide="list" class="text-success me-2"></i> Lini Masa (Timeline)</h5>
                                <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3" onclick="addRow('timeline-container', 'timeline-template')">
                                    <i data-lucide="plus" class="icon-sm me-1"></i> Tambah Jejak Waktu
                                </button>
                            </div>

                            <div id="timeline-container">
                                @php $timelines = $profil->sejarah_timeline ?? []; @endphp
                                @foreach($timelines as $index => $item)
                                <div class="timeline-item-row glass-card p-3 rounded-4 mb-3 border border-success border-opacity-10 position-relative">
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <label class="small fw-bold text-muted">Tahun/Era</label>
                                            <input type="text" name="sejarah_timeline[{{ $index }}][year]" class="form-control form-control-sm" value="{{ $item['year'] }}" placeholder="Misal: 1945">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="small fw-bold text-muted">Judul Peristiwa</label>
                                            <input type="text" name="sejarah_timeline[{{ $index }}][title]" class="form-control form-control-sm" value="{{ $item['title'] }}" placeholder="Judul singkat">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="small fw-bold text-muted">Ikon (Lucide Name)</label>
                                            <input type="text" name="sejarah_timeline[{{ $index }}][icon]" class="form-control form-control-sm" value="{{ $item['icon'] ?? 'tag' }}" placeholder="tag, sun, map-pin">
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-sm btn-outline-danger w-100" onclick="this.closest('.timeline-item-row').remove()">Hapus</button>
                                        </div>
                                        <div class="col-12">
                                            <label class="small fw-bold text-muted">Deskripsi Detail</label>
                                            <textarea name="sejarah_timeline[{{ $index }}][desc]" class="form-control form-control-sm" rows="2">{{ $item['desc'] }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 2: Visi & Misi -->
                <div class="tab-pane fade" id="visimisi" role="tabpanel">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="eye" class="text-success me-2"></i> Visi Desa</h5>
                            <div class="mb-4">
                                <label class="form-label text-muted small fw-bold">Kalimat Visi</label>
                                <textarea name="visi" class="form-control" rows="3" placeholder='Contoh: "Terwujudnya Masyarakat Desa yang Aman dan Sejahtera"'>{{ old('visi', $profil->visi) }}</textarea>
                            </div>

                            <hr class="my-5 opacity-25">

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="fw-bold mb-0 d-flex align-items-center"><i data-lucide="target" class="text-success me-2"></i> Misi Desa (Poin-Poin)</h5>
                                <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3" onclick="addRow('misi-container', 'misi-template')">
                                    <i data-lucide="plus" class="icon-sm me-1"></i> Tambah Misi
                                </button>
                            </div>

                            <div id="misi-container">
                                @php $misi = $profil->misi ?? []; @endphp
                                @foreach($misi as $index => $item)
                                <div class="misi-item-row p-3 rounded-4 mb-3 bg-light position-relative">
                                    <div class="row g-3">
                                        <div class="col-md-2">
                                            <label class="small fw-bold text-muted">Ikon</label>
                                            <input type="text" name="misi[{{ $index }}][icon]" class="form-control form-control-sm" value="{{ $item['icon'] }}" placeholder="book-open">
                                        </div>
                                        <div class="col-md-9">
                                            <label class="small fw-bold text-muted">Deskripsi Misi</label>
                                            <input type="text" name="misi[{{ $index }}][text]" class="form-control form-control-sm" value="{{ $item['text'] }}">
                                        </div>
                                        <div class="col-md-1 d-flex align-items-end">
                                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger" onclick="this.closest('.misi-item-row').remove()"><i data-lucide="trash-2" class="icon-sm"></i></button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 3: Geografis -->
                <div class="tab-pane fade" id="geografi" role="tabpanel">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="info" class="text-success me-2"></i> Narasi Geografis</h5>
                            <div class="mb-4">
                                <textarea name="geografi" class="form-control" rows="8">{{ old('geografi', $profil->geografi) }}</textarea>
                            </div>

                            <hr class="my-5 opacity-25">

                            <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="grid" class="text-success me-2"></i> Statistik Wilayah (4 Kotak)</h5>
                            <div class="row g-3">
                                @php $stats = $profil->geografi_stats ?? []; @endphp
                                @for($i = 0; $i < 4; $i++)
                                <div class="col-md-3">
                                    <div class="p-3 border rounded-4 bg-light">
                                        <label class="small fw-bold text-muted">Ikon {{ $i+1 }}</label>
                                        <input type="text" name="geografi_stats[{{ $i }}][icon]" class="form-control form-control-sm mb-2" value="{{ $stats[$i]['icon'] ?? '' }}" placeholder="mountain">
                                        <label class="small fw-bold text-muted">Nilai</label>
                                        <input type="text" name="geografi_stats[{{ $i }}][value]" class="form-control form-control-sm mb-2" value="{{ $stats[$i]['value'] ?? '' }}" placeholder="1.200 mdpl">
                                        <label class="small fw-bold text-muted">Label</label>
                                        <input type="text" name="geografi_stats[{{ $i }}][label]" class="form-control form-control-sm" value="{{ $stats[$i]['label'] ?? '' }}" placeholder="Ketinggian Maks.">
                                    </div>
                                </div>
                                @endfor
                            </div>

                            <hr class="my-5 opacity-25">

                            <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="compass" class="text-success me-2"></i> Batas Wilayah</h5>
                            <div class="row g-2">
                                @php $batas = $profil->batas_wilayah_json ?? []; @endphp
                                @foreach(['Utara', 'Selatan', 'Timur', 'Barat'] as $idx => $dir)
                                <div class="col-md-6 mb-3">
                                    <div class="p-3 border rounded-4 bg-light">
                                        <div class="row g-2">
                                            <div class="col-4">
                                                <label class="small fw-bold">{{ $dir }}</label>
                                                <input type="hidden" name="batas_wilayah_json[{{ $idx }}][dir]" value="{{ $dir }}">
                                                <input type="hidden" name="batas_wilayah_json[{{ $idx }}][icon]" value="compass">
                                                <input type="text" name="batas_wilayah_json[{{ $idx }}][rotate]" class="form-control form-control-sm" value="{{ $batas[$idx]['rotate'] ?? '0' }}" placeholder="Rotasi Ikon">
                                            </div>
                                            <div class="col-8">
                                                <label class="small fw-bold">Berbatasan Dengan</label>
                                                <input type="text" name="batas_wilayah_json[{{ $idx }}][text]" class="form-control form-control-sm" value="{{ $batas[$idx]['text'] ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 4: Peta & Akses -->
                <div class="tab-pane fade" id="peta" role="tabpanel">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="map-pin" class="text-success me-2"></i> Integrasi Google Maps</h5>
                            <div class="mb-4">
                                <label class="form-label text-muted small fw-bold">Link Iframe (Sematkan Peta)</label>
                                <textarea name="peta_embed" class="form-control" rows="4" placeholder='<iframe src="https://google.com/maps/embed...'>{{ old('peta_embed', $profil->peta_embed) }}</textarea>
                                <div class="alert alert-warning border-0 rounded-4 mt-2 small">
                                    <i data-lucide="alert-circle" class="icon-sm me-1"></i> Caranya: Buka Google Maps > Klik Berbagi > Sematkan Peta > Salin HTML.
                                </div>
                            </div>

                            <hr class="my-5 opacity-25">

                            <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="navigation" class="text-success me-2"></i> Panduan Akses Menuju Desa</h5>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted small fw-bold">Rute Kendaraan Pribadi</label>
                                    <textarea name="peta_rute_pribadi" class="form-control" rows="3">{{ old('peta_rute_pribadi', $profil->peta_rute_pribadi) }}</textarea>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-muted small fw-bold">Akses Transportasi Umum</label>
                                    <textarea name="peta_rute_umum" class="form-control" rows="3">{{ old('peta_rute_umum', $profil->peta_rute_umum) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Global Submit -->
            <div class="card border-0 shadow-sm rounded-4 mb-5">
                <div class="card-body p-4 text-center bg-success bg-opacity-10 text-success">
                    <p class="mb-3 fw-bold">Pastikan semua data sudah benar sebelum menyimpan.</p>
                    <button type="submit" class="btn btn-success px-5 py-3 rounded-pill fw-bold hover-lift">
                        <i data-lucide="save" class="me-2"></i> Simpan Perubahan Profil
                    </button>
                    <p class="small text-muted mt-3 mb-0">*Setelah disimpan, tampilan frontend akan langsung berubah sesuai isi di atas.</p>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Template Header for Sejarah Timeline -->
<div id="timeline-template" class="d-none">
    <div class="timeline-item-row glass-card p-3 rounded-4 mb-3 border border-success border-opacity-10 position-relative">
        <div class="row g-3">
            <div class="col-md-3">
                <label class="small fw-bold text-muted">Tahun/Era</label>
                <input type="text" name="sejarah_timeline[INDEX][year]" class="form-control form-control-sm" placeholder="Misal: 1945">
            </div>
            <div class="col-md-4">
                <label class="small fw-bold text-muted">Judul Peristiwa</label>
                <input type="text" name="sejarah_timeline[INDEX][title]" class="form-control form-control-sm" placeholder="Judul singkat">
            </div>
            <div class="col-md-3">
                <label class="small fw-bold text-muted">Ikon (Lucide)</label>
                <input type="text" name="sejarah_timeline[INDEX][icon]" class="form-control form-control-sm" value="tag">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-sm btn-outline-danger w-100" onclick="this.closest('.timeline-item-row').remove()">Hapus</button>
            </div>
            <div class="col-12">
                <label class="small fw-bold text-muted">Deskripsi Detail</label>
                <textarea name="sejarah_timeline[INDEX][desc]" class="form-control form-control-sm" rows="2"></textarea>
            </div>
        </div>
    </div>
</div>

<!-- Template Header for Misi -->
<div id="misi-template" class="d-none">
    <div class="misi-item-row p-3 rounded-4 mb-3 bg-light position-relative">
        <div class="row g-3">
            <div class="col-md-2">
                <label class="small fw-bold text-muted">Ikon</label>
                <input type="text" name="misi[INDEX][icon]" class="form-control form-control-sm" value="check-circle" placeholder="book-open">
            </div>
            <div class="col-md-9">
                <label class="small fw-bold text-muted">Deskripsi Misi</label>
                <input type="text" name="misi[INDEX][text]" class="form-control form-control-sm">
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-sm btn-icon btn-outline-danger" onclick="this.closest('.misi-item-row').remove()"><i data-lucide="trash-2" class="icon-sm"></i></button>
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
        const index = container.children.length;
        
        const html = template.replace(/INDEX/g, index);
        container.insertAdjacentHTML('beforeend', html);
        
        // Refresh icons
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }
</script>
@endpush
