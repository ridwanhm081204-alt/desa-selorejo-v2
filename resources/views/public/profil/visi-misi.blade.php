@extends('layouts.public')
@section('title', 'Visi & Misi')
@section('breadcrumb')
    <li class="breadcrumb-item">Profil Desa</li>
    <li class="breadcrumb-item active">Visi & Misi</li>
@endsection
@section('content')
<div class="section-hero-gradient pt-5 pb-4 mb-5 text-center text-white" style="min-height: auto;">
    <div class="container position-relative z-1">
        <h1 class="fw-bold mb-3"><i data-lucide="target" class="me-2 text-warning"></i>Visi & Misi</h1>
        <p class="lead fw-medium text-white-50">Arah dan tujuan pembangunan Desa Selorejo ke depan.</p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <div class="row g-4 justify-content-center">
        <!-- Visi Card -->
        <div class="col-lg-10">
            <div class="glass-card bg-white text-dark p-5 rounded-4 text-center position-relative overflow-hidden mb-4 shadow-lg border-0">
                <div class="position-absolute opacity-10 top-0 start-50 translate-middle-x" style="transform: translateY(-20%) translateX(-50%) !important;">
                    <i data-lucide="eye" style="width: 250px; height: 250px; color: #2d6a4f;"></i>
                </div>
                <div class="position-relative z-1">
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm border border-warning">VISI KAMI</span>
                    <h2 class="fw-bold lh-base text-dark" style="text-shadow: 0 1px 3px rgba(255,255,255,0.8);">
                        @php
                            $visimisi = $profile->visi_misi ?? '';
                            // Sederhananya, mengekstrak bagian Visi jika ada kata "VISI:" atau defaultnya
                            preg_match('/VISI:(.*?)(MISI:|$)/is', $visimisi, $matchesVisi);
                            $visi = $matchesVisi[1] ?? 'Terwujudnya Desa Selorejo yang Mandiri, Sejahtera, dan Berdaya Saing Berbasis Agrowisata yang Berkelanjutan.';
                        @endphp
                        "{{ trim($visi) }}"
                    </h2>
                </div>
            </div>
        </div>

        <!-- Misi List -->
        <div class="col-lg-10">
            <div class="glass-card bg-white p-4 p-md-5 rounded-4 shadow-sm border-0 border-top border-5 border-success position-relative">
                <div class="text-center mb-4">
                    <span class="badge bg-success text-white px-3 py-2 rounded-pill fw-bold mb-3">MISI KAMI</span>
                    <h3 class="fw-bold text-dark">Langkah Strategis Pembangunan</h3>
                </div>
                
                @php
                    preg_match('/MISI:(.*)/is', $visimisi, $matchesMisi);
                    $misiText = $matchesMisi[1] ?? "1. Meningkatkan produktivitas pertanian jeruk keprok.\n2. Mengembangkan potensi wisata secara berkelanjutan.\n3. Memberdayakan sumber daya manusia lokal.";
                    // Pecah berdasarkan angka list atau newline
                    $misiArray = array_filter(preg_split('/(\d+\.\s+)/', $misiText));
                @endphp

                <div class="row g-4 mt-2">
                    @foreach($misiArray as $index => $misi)
                        @if(trim($misi) != '')
                        <div class="col-md-6">
                            <div class="d-flex align-items-start card-hover h-100 p-3 rounded-3 bg-light bg-opacity-50 border border-success border-opacity-10">
                                <div class="bg-success text-white rounded-circle p-2 me-3 shadow-sm flex-shrink-0">
                                    <i data-lucide="check" class="icon-sm"></i>
                                </div>
                                <div>
                                    <p class="text-dark fw-medium mb-0 lh-lg">{{ trim($misi) }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
