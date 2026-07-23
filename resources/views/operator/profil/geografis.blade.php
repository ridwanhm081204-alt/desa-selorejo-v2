@extends('layouts.dashboard')
@section('title', 'Kelola Kondisi Geografis')
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
            <input type="hidden" name="origin_tab" value="geografis">
            
            @php
                $hero_geografi = $profil->hero_geografi ?? ['title' => 'Kondisi Geografis', 'subtitle' => 'Letak, topografi...', 'icon' => 'mountain'];
            @endphp

            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden border-top border-4 border-success">
                <div class="card-body p-4 p-md-5">
                    <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="image" class="text-success me-3"></i> Header Halaman Geografis</h5>
                    <div class="row g-3 mb-5 p-3 bg-light rounded-4">
                        <div class="col-md-4">
                            <label class="small fw-bold text-muted">Judul Halaman</label>
                            <input type="text" name="hero_geografi[title]" class="form-control rounded-3" value="{{ $hero_geografi['title'] ?? '' }}">
                        </div>
                        <div class="col-md-5">
                            <label class="small fw-bold text-muted">Sub-Judul</label>
                            <input type="text" name="hero_geografi[subtitle]" class="form-control rounded-3" value="{{ $hero_geografi['subtitle'] ?? '' }}">
                        </div>
                        <div class="col-md-3">
                            <label class="small fw-bold text-muted">Ikon (Lucide)</label>
                            <input type="text" name="hero_geografi[icon]" class="form-control rounded-3" value="{{ $hero_geografi['icon'] ?? 'mountain' }}">
                        </div>
                    </div>

                    <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="alert-circle" class="text-success me-3"></i> Gambaran Umum Topografi</h5>
                    <div class="mb-5">
                        <textarea name="geografi" class="form-control rounded-4 shadow-none p-4 rich-text" rows="8">{{ old('geografi', $profil->geografi) }}</textarea>
                    </div>

                    <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="layout-grid" class="text-success me-3"></i> Parameter Fisik Wilayah</h5>
                    <div class="row g-4 mb-5 border-bottom pb-5 text-center">
                        @php $stats = $profil->geografi_stats ?? []; @endphp
                        @for($i = 0; $i < 4; $i++)
                        <div class="col-md-3">
                            <div class="p-4 border shadow-sm rounded-4 bg-white hover-lift">
                                <div class="mb-3">
                                    <label class="d-block small fw-bold text-muted mb-2">Ikon {{ $i+1 }}</label>
                                    <input type="text" name="geografi_stats[{{ $i }}][icon]" class="form-control form-control-sm text-center border-success border-opacity-25" value="{{ $stats[$i]['icon'] ?? '' }}" placeholder="mountain">
                                </div>
                                <div class="mb-3">
                                    <label class="d-block small fw-bold text-muted mb-2">Nilai / Angka</label>
                                    <input type="text" name="geografi_stats[{{ $i }}][value]" class="form-control form-control-sm text-center fw-bold text-success" value="{{ $stats[$i]['value'] ?? '' }}" placeholder="1.200 mdpl">
                                </div>
                                <div>
                                    <label class="d-block small fw-bold text-muted mb-2">Label Informasi</label>
                                    <input type="text" name="geografi_stats[{{ $i }}][label]" class="form-control form-control-sm text-center" value="{{ $stats[$i]['label'] ?? '' }}" placeholder="Kapasitas...">
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>

                    <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="compass" class="text-success me-3"></i> Batas Wilayah Astronomis/Geografis</h5>
                    <div class="row g-3 mb-5 border-bottom pb-5">
                        @php $batas = $profil->batas_wilayah_json ?? []; @endphp
                        @foreach(['Utara', 'Selatan', 'Timur', 'Barat'] as $idx => $dir)
                        <div class="col-md-6">
                            <div class="p-4 border shadow-sm rounded-4 bg-light border-success border-opacity-10">
                                <div class="row align-items-center g-3">
                                    <div class="col-3 text-center border-end">
                                        <div class="fw-bold text-success mb-2">{{ $dir }}</div>
                                        <input type="hidden" name="batas_wilayah_json[{{ $idx }}][dir]" value="{{ $dir }}">
                                        <input type="hidden" name="batas_wilayah_json[{{ $idx }}][icon]" value="compass">
                                        <div class="small text-muted mb-1 mt-1">Rotasi</div>
                                        <input type="text" name="batas_wilayah_json[{{ $idx }}][rotate]" class="form-control form-control-sm text-center" value="{{ $batas[$idx]['rotate'] ?? '0' }}">
                                    </div>
                                    <div class="col-9 ps-4">
                                        <label class="small fw-bold text-muted mb-2">Administrasi Perbatasan</label>
                                        <input type="text" name="batas_wilayah_json[{{ $idx }}][text]" class="form-control rounded-3 border-0 py-2 shadow-sm" value="{{ $batas[$idx]['text'] ?? '' }}" placeholder="Berbatasan dengan Desa...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="users" class="text-success me-3"></i> Struktur Wilayah Dusun</h5>
                    <div class="row g-4">
                        @php $dusuns = collect($profil->dusun_info ?? [])->pad(3, ['nama' => '', 'geografi_desc' => '', 'peta_desc' => '', 'admin_rw' => '', 'admin_rt' => '', 'color_theme' => 'success']); @endphp
                        @foreach($dusuns as $idx => $dsn)
                        <div class="col-12">
                            <div class="p-4 shadow-sm border border-light rounded-4 bg-white hover-lift">
                                <div class="row g-4 align-items-start">
                                    <div class="col-md-4 border-end pe-md-4">
                                        <div class="mb-4">
                                            <label class="small fw-bold text-muted mb-2">Identitas Dusun</label>
                                            <input type="text" name="dusun_info[{{ $idx }}][nama]" class="form-control rounded-3 border-success border-opacity-25 fw-bold text-success py-2" value="{{ $dsn['nama'] }}" placeholder="Nama Dusun">
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <label class="small fw-bold text-muted mb-1">Total RW</label>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text bg-white border-end-0"><i data-lucide="layers" class="icon-xs"></i></span>
                                                    <input type="text" name="dusun_info[{{ $idx }}][admin_rw]" class="form-control rounded-3 border-start-0" value="{{ $dsn['admin_rw'] }}">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label class="small fw-bold text-muted mb-1">Total RT</label>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text bg-white border-end-0"><i data-lucide="users" class="icon-xs"></i></span>
                                                    <input type="text" name="dusun_info[{{ $idx }}][admin_rt]" class="form-control rounded-3 border-start-0" value="{{ $dsn['admin_rt'] }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 ps-md-4">
                                        <div class="mb-4">
                                            <label class="small fw-bold text-muted mb-2">Narasi Geografis Tingkat Dusun</label>
                                            <textarea name="dusun_info[{{ $idx }}][geografi_desc]" class="form-control rounded-3 bg-light border-0 rich-text" rows="3" placeholder="Jelaskan kondisi alam dusun ini...">{{ $dsn['geografi_desc'] }}</textarea>
                                        </div>
                                        <div>
                                            <label class="small fw-bold text-muted mb-2">Detail Lokasi pada Peta</label>
                                            <textarea name="dusun_info[{{ $idx }}][peta_desc]" class="form-control rounded-3 bg-light border-0 rich-text" rows="2" placeholder="Letak relatif (Pojok utara, dekat hutan, dsb)">{{ $dsn['peta_desc'] }}</textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" name="dusun_info[{{ $idx }}][color_theme]" value="{{ $dsn['color_theme'] ?? 'success' }}">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-lg rounded-4 mb-5 mt-4 p-2 bg-success bg-opacity-10 header-gradient border-top border-4 border-success">
                <div class="card-body p-4 p-md-5 text-center">
                    <div class="bg-white d-inline-block p-4 rounded-circle mb-4 shadow-sm border border-success border-opacity-25">
                        <i data-lucide="send" class="text-success" style="width:40px; height:40px;"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-3">Finalisasi Perubahan Profil</h4>
                    <p class="text-muted mb-4 mx-auto" style="max-width: 600px;">Data profil Geografis akan diperbarui secara real-time pada halaman publik Desa Selorejo.</p>
                    
                    <button type="submit" class="btn btn-success px-5 py-3 rounded-pill fw-bold hover-lift shadow border-0" style="font-size:1.1rem;">
                        <i data-lucide="save" class="me-2"></i> SIMPAN & PUBLIKASIKAN
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
