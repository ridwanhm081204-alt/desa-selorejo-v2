@extends('layouts.public')
@section('title', 'Badan Permusyawaratan Desa')
@section('breadcrumb')
    <li class="breadcrumb-item">Pemerintahan</li>
    <li class="breadcrumb-item active">BPD</li>
@endsection
@section('content')
@include('layouts.partials.page-hero', [
    'title' => $hero['title'] ?? 'Badan Permusyawaratan Desa',
    'subtitle' => $hero['subtitle'] ?? 'Lembaga legislatif desa sebagai mitra Pemerintah Desa.',
    'icon' => $hero['icon'] ?? 'users-2'
])

<div class="container mb-5 pb-5">
    <div class="glass-card bg-white p-4 p-md-5 rounded-4 border-0 shadow-sm">
        <div class="text-center mb-5">
            <span class="badge px-3 py-2 rounded-pill fw-bold mb-2 border border-opacity-10" style="background-color: rgba(26,92,56,0.1) !important; color: var(--color-forest) !important; border-color: rgba(26,92,56,0.1) !important; font-family: var(--font-body);">Mitra Desa</span>
            <h3 class="fw-bold text-dark" style="font-family: var(--font-heading);">Daftar Keanggotaan BPD</h3>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse($bpd as $b)
            <div class="{{ str_contains(strtolower($b->jabatan), 'ketua') ? 'col-md-10 mb-2' : 'col-md-6' }}">
                <div class="d-flex align-items-center card-hover bg-light bg-opacity-50 border p-4 rounded-4 h-100" style="border-color: var(--color-forest)33 !important;">
                    <div class="rounded-circle p-3 me-4 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 64px; height: 64px; overflow:hidden; background-color: rgba(26,92,56,0.1) !important; color: var(--color-forest) !important;">
                        @if($b->foto)
                            <img src="{{ asset('storage/'.$b->foto) }}" alt="{{ $b->nama }}" class="img-fluid" style="width:100%; height:100%; object-fit:cover;">
                        @elseif(str_contains(strtolower($b->jabatan), 'ketua'))
                            <i data-lucide="award" class="icon-xl"></i>
                        @else
                            <i data-lucide="user-check" class="icon-xl"></i>
                        @endif
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-1" style="font-family: var(--font-heading);">{{ $b->nama }}</h5>
                        <div class="d-flex flex-wrap align-items-center gap-1 gap-md-2 text-muted small" style="font-family: var(--font-body);">
                            <span class="text-success fw-semibold"><i data-lucide="tag" class="icon-xs me-1"></i>{{ $b->jabatan }}</span>
                            @if($b->dusun)
                                <span class="d-none d-md-inline">•</span>
                                <span><i data-lucide="map-pin" class="icon-xs me-1"></i>{{ $b->dusun }} @if($b->nomor_rt) RT.{{ str_pad($b->nomor_rt,2,'0',STR_PAD_LEFT) }} @endif @if($b->nomor_rw) RW.{{ str_pad($b->nomor_rw,2,'0',STR_PAD_LEFT) }} @endif</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted py-5" style="font-family: var(--font-body);">Belum ada data anggota BPD yang tercatat.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
