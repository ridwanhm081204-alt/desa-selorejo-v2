@extends('layouts.public')
@section('title', 'Visi & Misi')
@section('breadcrumb')
    <li class="breadcrumb-item">Profil Desa</li>
    <li class="breadcrumb-item active">Visi & Misi</li>
@endsection
@section('content')
@include('layouts.partials.page-hero', [
    'title' => 'Visi & Misi',
    'subtitle' => 'Arah dan tujuan pembangunan Desa Selorejo ke depan.',
    'icon' => 'target'
])

<div class="container mb-5 pb-5">
    <div class="row g-4 justify-content-center">
        <!-- Visi Card -->
        <div class="col-lg-10">
            <div class="glass-card bg-white text-dark p-5 rounded-4 text-center position-relative overflow-hidden mb-4 shadow-lg border-0">
                <div class="position-relative z-1">
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm border border-warning">VISI KAMI</span>
                    <h5 class="fw-bold text-success mb-2" style="letter-spacing: 2px;">SATATA GAMA KARTA RAHARJA</h5>
                    <h2 class="fw-bold lh-base text-dark display-6 mt-2" style="text-shadow: 0 1px 2px rgba(0,0,0,0.05); font-size: 2.2rem;">
                        {{ $profile->visi ?? '"Terwujudnya Tatanan Kehidupan Masyarakat Desa Selorejo yang Agamis, Demokratis, Mandiri, Bersih, Indah dan Aman"' }}
                    </h2>
                </div>
            </div>
        </div>

        <!-- Misi List -->
        <div class="col-lg-10">
            <div class="glass-card bg-white p-4 p-md-5 rounded-4 shadow-sm border-0 border-top border-5 border-success position-relative">
                <div class="text-center mb-5">
                    <span class="badge bg-success text-white px-3 py-2 rounded-pill fw-bold mb-3">MISI KAMI</span>
                    <h3 class="fw-bold text-dark">Langkah Strategis Pembangunan</h3>
                </div>
                
                @php
                    $misiArray = $profile->misi ?? [];
                @endphp

                <div class="row g-4 mt-2 justify-content-center">
                    @foreach($misiArray as $m)
                        <div class="col-md-6 col-lg-6">
                            <div class="d-flex align-items-start card-hover h-100 p-4 rounded-4 bg-light border border-success border-opacity-10 shadow-sm">
                                <div class="bg-dark bg-opacity-10 text-dark rounded-circle p-2 me-3 shadow-sm flex-shrink-0" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                    <i data-lucide="{{ $m['icon'] ?? 'check-circle' }}" class="icon-sm"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-dark fw-bold mb-0 lh-lg" style="font-size: 0.95rem;">{{ $m['text'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
