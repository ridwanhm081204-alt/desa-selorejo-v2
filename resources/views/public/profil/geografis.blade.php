@extends('layouts.public')
@section('title', 'Kondisi Geografis')
@section('breadcrumb')
    <li class="breadcrumb-item">Profil Desa</li>
    <li class="breadcrumb-item active">Geografis</li>
@endsection
@section('content')
<div class="section-hero-gradient pt-5 pb-4 mb-5 text-center text-white" style="min-height: auto;">
    <div class="container position-relative z-1">
        <h1 class="fw-bold mb-3"><i data-lucide="mountain" class="me-2 text-warning"></i>Kondisi Geografis</h1>
        <p class="lead fw-medium text-white-50">Letak, topografi, dan iklim yang mendukung pertanian.</p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <div class="row g-4 align-items-center">
        <!-- Weather/Statis info -->
        <div class="col-lg-5 order-lg-2 mb-4 mb-lg-0">
            <div class="row g-3">
                <div class="col-6">
                    <div class="glass-card bg-primary-custom text-white p-4 text-center rounded-4 h-100 shadow-sm hover-lift">
                        <i data-lucide="cloud-sun" class="mb-3 text-warning" style="width: 48px; height: 48px;"></i>
                        <h3 class="fw-bold mb-1">18-26°C</h3>
                        <p class="mb-0 text-white-50 small">Suhu Rata-rata</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="glass-card bg-white p-4 text-center rounded-4 h-100 shadow-sm hover-lift border border-success border-opacity-25">
                        <i data-lucide="mountain" class="mb-3 text-success" style="width: 48px; height: 48px;"></i>
                        <h3 class="fw-bold mb-1 text-dark">650 mdpl</h3>
                        <p class="mb-0 text-muted small">Ketinggian Tempat</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="glass-card bg-white p-4 text-center rounded-4 h-100 shadow-sm hover-lift border border-success border-opacity-25">
                        <i data-lucide="cloud-rain" class="mb-3 text-info" style="width: 48px; height: 48px;"></i>
                        <h3 class="fw-bold mb-1 text-dark">2.000 mm</h3>
                        <p class="mb-0 text-muted small">Curah Hujan / Thn</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="glass-card bg-white p-4 text-center rounded-4 h-100 shadow-sm hover-lift border border-success border-opacity-25">
                        <i data-lucide="map" class="mb-3 text-success" style="width: 48px; height: 48px;"></i>
                        <h3 class="fw-bold mb-1 text-dark">623 Ha</h3>
                        <p class="mb-0 text-muted small">Luas Total Wilayah</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deskripsi Geografis -->
        <div class="col-lg-7 order-lg-1 pe-lg-5">
            <div class="glass-card bg-white p-4 p-md-5 rounded-4 border-0 shadow-sm h-100">
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3"><i data-lucide="info" class="icon-sm me-1"></i> Informasi Wilayah</span>
                <h3 class="fw-bold text-dark mb-4">Letak dan Topografi Desa</h3>
                
                <div class="text-muted lh-lg text-justify" style="text-align: justify;">
                    {!! nl2br(e($profile->geografi ?? 'Desa Selorejo, yang terletak di Kecamatan Dau, Kabupaten Malang, dikaruniai kondisi geografis yang luar biasa. Berada di lereng pegunungan, desa ini memiliki kualitas tanah yang subur dan cuaca sejuk yang menjadi habitat paling ideal untuk budidaya komoditas Jeruk Keprok. Kemiringan lahan bervariasi dengan dominasi perbukitan ringan.')) !!}
                </div>

                <div class="mt-4 pt-4 border-top border-success border-opacity-10">
                    <h5 class="fw-bold text-dark mb-3">Batas Administrasi Wilayah</h5>
                    
                    @php
                        $batas = $profile->batas_wilayah ?? "Utara: Desa Mulyoagung\nSelatan: Desa Sumbersekar\nTimur: Desa Petungsewu\nBarat: Desa Kucur";
                        $batasArray = explode("\n", trim($batas));
                    @endphp

                    <ul class="list-group list-group-flush border-0">
                        @foreach($batasArray as $b)
                            @if(trim($b))
                            <li class="list-group-item bg-transparent px-0 text-muted d-flex align-items-center">
                                <i data-lucide="map-pin" class="text-success me-3 icon-sm"></i> {{ trim($b) }}
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
