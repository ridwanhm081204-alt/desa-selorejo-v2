@extends('layouts.public')
@section('title', 'Badan Permusyawaratan Desa')
@section('breadcrumb')
    <li class="breadcrumb-item">Pemerintahan</li>
    <li class="breadcrumb-item active">BPD</li>
@endsection
@section('content')
@include('layouts.partials.page-hero', [
    'title' => 'Badan Permusyawaratan Desa',
    'subtitle' => 'Lembaga legislatif desa sebagai mitra Pemerintah Desa.',
    'icon' => 'users-2'
])

<div class="container mb-5 pb-5">
    <div class="glass-card bg-white p-4 p-md-5 rounded-4 border-0 shadow-sm">
        <div class="text-center mb-5">
            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-bold mb-2">Mitra Desa</span>
            <h3 class="fw-bold text-dark">Daftar Keanggotaan BPD</h3>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse($bpd as $b)
            <div class="{{ str_contains(strtolower($b->jabatan), 'ketua') ? 'col-md-10 mb-2' : 'col-md-6' }}">
                <div class="d-flex align-items-center card-hover bg-light bg-opacity-50 border border-success border-opacity-10 p-4 rounded-4 h-100">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle p-3 me-4 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 64px; height: 64px;">
                        @if(str_contains(strtolower($b->jabatan), 'ketua'))
                            <i data-lucide="award" class="icon-xl"></i>
                        @else
                            <i data-lucide="user-check" class="icon-xl"></i>
                        @endif
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-1">{{ $b->nama }}</h5>
                        <span class="text-muted"><i data-lucide="tag" class="icon-sm me-1"></i> {{ $b->jabatan }}</span>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted py-5">Belum ada data anggota BPD yang tercatat.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
