@extends('layouts.dashboard')
@section('title', 'Kelola Visi & Misi')
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
            <input type="hidden" name="origin_tab" value="visi-misi">
            
            @php
                $hero_visimisi = $profil->hero_visimisi ?? ['title' => 'Visi & Misi', 'subtitle' => 'Arah dan tujuan pembangunan...', 'icon' => 'target'];
            @endphp

            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden border-top border-4 border-success">
                <div class="card-body p-4 p-md-5">
                    <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="image" class="text-success me-3"></i> Header Halaman Visi Misi</h5>
                    <div class="row g-3 mb-5 p-3 bg-light rounded-4">
                        <div class="col-md-4">
                            <label class="small fw-bold text-muted">Judul Halaman</label>
                            <input type="text" name="hero_visimisi[title]" class="form-control rounded-3" value="{{ $hero_visimisi['title'] ?? '' }}">
                        </div>
                        <div class="col-md-5">
                            <label class="small fw-bold text-muted">Sub-Judul</label>
                            <input type="text" name="hero_visimisi[subtitle]" class="form-control rounded-3" value="{{ $hero_visimisi['subtitle'] ?? '' }}">
                        </div>
                        <div class="col-md-3">
                            <label class="small fw-bold text-muted">Ikon (Lucide)</label>
                            <input type="text" name="hero_visimisi[icon]" class="form-control rounded-3" value="{{ $hero_visimisi['icon'] ?? 'target' }}">
                        </div>
                    </div>

                    <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="rocket" class="text-success me-3"></i> Visi Desa</h5>
                    <div class="row mb-5 g-4 border-bottom pb-5">
                        <div class="col-md-4">
                            <label class="form-label text-muted small fw-bold">Semboyan / Motto (Capital)</label>
                            <input type="text" name="motto" class="form-control rounded-3 border-2 border-success border-opacity-25 py-2 fw-bold" value="{{ old('motto', $profil->motto) }}" placeholder="SATATA GAMA KARTA RAHARJA">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label text-muted small fw-bold">Pernyataan Visi Utama</label>
                            <textarea name="visi" class="form-control rounded-4 p-3 rich-text" rows="3" placeholder='Pernyataan visi komprehensif desa...'>{{ old('visi', $profil->visi) }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0 d-flex align-items-center"><i data-lucide="check-square" class="text-success me-3"></i> Poin-Poin Misi</h5>
                        <button type="button" class="btn btn-sm btn-success rounded-pill px-4 shadow-sm border-0" onclick="addRow('misi-container', 'misi-template')">
                            <i data-lucide="plus" class="icon-sm me-1"></i> Tambah Misi
                        </button>
                    </div>

                    <div id="misi-container">
                        @php $misi = $profil->misi ?? []; @endphp
                        @foreach($misi as $index => $item)
                        <div class="misi-item-row p-4 rounded-4 mb-3 border border-light shadow-sm hover-lift bg-white position-relative">
                            <div class="row g-3">
                                <div class="col-md-2">
                                    <label class="small fw-bold text-muted">Ikon Poin</label>
                                    <input type="text" name="misi[{{ $index }}][icon]" class="form-control rounded-3" value="{{ $item['icon'] }}" placeholder="chevron-right">
                                </div>
                                <div class="col-md-9">
                                    <label class="small fw-bold text-muted">Pernyataan Misi</label>
                                    <input type="text" name="misi[{{ $index }}][text]" class="form-control rounded-3 border-success border-opacity-10" value="{{ $item['text'] }}">
                                </div>
                                <div class="col-md-1 d-flex align-items-end text-end">
                                    <button type="button" class="btn btn-sm btn-white border border-danger text-danger rounded-pill shadow-sm" onclick="this.closest('.misi-item-row').remove()"><i data-lucide="trash-2" class="icon-sm"></i></button>
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
                    <p class="text-muted mb-4 mx-auto" style="max-width: 600px;">Data profil Visi & Misi akan diperbarui secara real-time pada halaman publik Desa Selorejo.</p>
                    
                    <button type="submit" class="btn btn-success px-5 py-3 rounded-pill fw-bold hover-lift shadow border-0" style="font-size:1.1rem;">
                        <i data-lucide="save" class="me-2"></i> SIMPAN & PUBLIKASIKAN
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Template Header for Misi -->
<div id="misi-template" class="d-none">
    <div class="misi-item-row p-4 rounded-4 mb-3 border border-light shadow-sm bg-white position-relative">
        <div class="row g-3">
            <div class="col-md-2">
                <label class="small fw-bold text-muted">Ikon Poin</label>
                <input type="text" name="misi[INDEX][icon]" class="form-control rounded-3" value="chevron-right">
            </div>
            <div class="col-md-9">
                <label class="small fw-bold text-muted">Pernyataan Misi</label>
                <input type="text" name="misi[INDEX][text]" class="form-control rounded-3 border-success border-opacity-10">
            </div>
            <div class="col-md-1 d-flex align-items-end text-end">
                <button type="button" class="btn btn-sm btn-white border border-danger text-danger rounded-pill shadow-sm" onclick="this.closest('.misi-item-row').remove()"><i data-lucide="trash-2" class="icon-sm"></i></button>
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
