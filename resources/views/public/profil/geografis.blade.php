@extends('layouts.public')
@section('title', 'Kondisi Geografis')
@section('breadcrumb')
    <li class="breadcrumb-item">Profil Desa</li>
    <li class="breadcrumb-item active">Geografis</li>
@endsection
@section('content')
@php
    $hero = $profile->hero_geografi ?? ['title' => 'Kondisi Geografis', 'subtitle' => 'Letak, topografi, dan iklim yang mendukung pertanian.', 'icon' => 'mountain'];
@endphp

@include('layouts.partials.page-hero', [
    'title' => $hero['title'] ?? 'Kondisi Geografis',
    'subtitle' => $hero['subtitle'] ?? 'Letak, topografi, dan iklim yang mendukung pertanian.',
    'icon' => $hero['icon'] ?? 'mountain'
])

<div class="container mb-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="glass-card bg-white p-0 rounded-4 shadow-lg overflow-hidden border-0 mb-5">
                <!-- 4 Kotak Stats Berjejer Horizontal -->
                <div class="p-4 border-bottom bg-light bg-opacity-30" style="border-bottom-color: var(--color-forest) !important;">
                    <div class="row g-3">
                        @php $stats = $profile->geografi_stats ?? []; @endphp
                        @foreach($stats as $s)
                        <div class="col-md-3">
                            <div class="glass-card card-hover p-4 text-center h-100 border" style="background: white; border-color: var(--color-forest) !important;">
                                <div class="rounded-circle p-2 mx-auto mb-3 shadow-sm" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; background-color: rgba(26,92,56,0.1); color: var(--color-forest);">
                                    <i data-lucide="{{ $s['icon'] ?? 'map' }}" class="icon-md"></i>
                                </div>
                                <h4 class="fw-bold text-dark mb-1" style="font-family: var(--font-heading);">{{ $s['value'] }}</h4>
                                <p class="text-muted small mb-0" style="font-family: var(--font-body);">{{ $s['label'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Konten Teks Materi -->
                <div class="p-4 p-md-5">
                    <div class="text-center mb-4">
                        <span class="badge px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm border" style="background-color: var(--accent) !important; border-color: var(--accent) !important; color: var(--text-on-accent) !important; font-family: var(--font-body);">
                            <i data-lucide="map-pin" class="icon-sm me-1"></i> Informasi Wilayah
                        </span>
                        <h3 class="fw-bold text-dark mb-0" style="font-family: var(--font-heading);">Letak dan Topografi Desa</h3>
                    </div>
                    
                    <div class="text-dark lh-lg mb-5" style="text-align: justify; font-size: 1.05rem; font-family: var(--font-body);">
                        {!! nl2br(e($profile->geografi ?? '')) !!}
                    </div>

                    <div class="mt-5 pt-4 border-top" style="border-top-color: var(--color-forest) !important;">
                        <h5 class="fw-bold text-dark mb-4 text-center" style="font-family: var(--font-heading);">Pembagian Wilayah Administratif</h5>
                        <p class="text-center text-dark mb-4" style="font-family: var(--font-body);">Secara administratif, wilayah pemukiman Desa Selorejo terbagi menjadi 3 (tiga) Dusun utama dengan total {{ \App\Models\PerangkatRtRw::where('jenis', 'RW')->count() ?: 7 }} Rukun Warga (RW) dan {{ \App\Models\PerangkatRtRw::where('jenis', 'RT')->count() ?: 21 }} Rukun Tetangga (RT):</p>
                        <div class="row g-4 justify-content-center">
                            @php 
                                $dusuns = $profile->dusun_info ?? [
                                    ['nama' => 'Dusun Krajan', 'geografi_desc' => 'Dusun terluas dan terpadat permukimannya, meliputi RW I hingga RW IV (12 RT).'],
                                    ['nama' => 'Dusun Selokerto', 'geografi_desc' => 'Berlokasi di sisi barat desa yang cukup padat, meliputi RW V dan RW VI (Sebagian) (7 RT).'],
                                    ['nama' => 'Dusun Gumuk', 'geografi_desc' => 'Berlokasi di selatan-barat desa, meliputi RW VI (sebagian) dan RW VII (2 RT).']
                                ];
                            @endphp
                            @foreach(array_slice($dusuns, 0, 3) as $dsn)
                            <div class="col-md-4">
                                <div class="glass-card p-4 rounded-4 text-center h-100 bg-light border" style="border-color: var(--color-forest) !important;">
                                    <div class="rounded-circle p-2 mx-auto mb-3 text-white" style="width: 45px; height: 45px; background-color: var(--color-forest) !important;"><i data-lucide="map-pin"></i></div>
                                    <h5 class="fw-bold text-dark mb-2" style="font-family: var(--font-heading);">{{ $dsn['nama'] }}</h5>
                                    <p class="text-muted small mb-0" style="font-family: var(--font-body);">{{ $dsn['geografi_desc'] }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-5 pt-4 border-top text-center" style="border-top-color: var(--color-forest) !important;">
                        <h5 class="fw-bold text-dark mb-4" style="font-family: var(--font-heading);">Batas Administrasi Wilayah</h5>
                        <div class="row g-3 justify-content-center text-start">
                            @php $batas = $profile->batas_wilayah_json ?? []; @endphp
                            <div class="col-md-5">
                                <ul class="list-group list-group-flush border-0">
                                    @foreach(array_slice($batas, 0, 2) as $b)
                                    <li class="list-group-item bg-transparent px-0 text-dark d-flex align-items-center border-0" style="font-family: var(--font-body);">
                                        <i data-lucide="{{ $b['icon'] ?? 'compass' }}" class="me-3 icon-md" style="color: var(--color-forest) !important; transform: rotate({{ $b['rotate'] ?? 0 }}deg);"></i> <strong class="me-2">{{ $b['dir'] }}:</strong> {{ $b['text'] }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-5">
                                <ul class="list-group list-group-flush border-0">
                                    @foreach(array_slice($batas, 2, 2) as $b)
                                    <li class="list-group-item bg-transparent px-0 text-dark d-flex align-items-center border-0" style="font-family: var(--font-body);">
                                        <i data-lucide="{{ $b['icon'] ?? 'compass' }}" class="me-3 icon-md" style="color: var(--color-forest) !important; transform: rotate({{ $b['rotate'] ?? 0 }}deg);"></i> <strong class="me-2">{{ $b['dir'] }}:</strong> {{ $b['text'] }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
