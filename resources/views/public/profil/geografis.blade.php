@extends('layouts.public')
@section('title', 'Kondisi Geografis')
@section('breadcrumb')
    <li class="breadcrumb-item">Profil Desa</li>
    <li class="breadcrumb-item active">Geografis</li>
@endsection
@section('content')
@include('layouts.partials.page-hero', [
    'title' => 'Kondisi Geografis',
    'subtitle' => 'Letak, topografi, dan iklim yang mendukung pertanian.',
    'icon' => 'mountain'
])

<div class="container mb-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="glass-card bg-white p-0 rounded-4 shadow-lg overflow-hidden border-0 mb-5">
                <!-- 4 Kotak Stats Berjejer Horizontal -->
                <div class="p-4 border-bottom border-success border-opacity-10 bg-light bg-opacity-30">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <div class="glass-card card-hover p-4 text-center h-100 border border-success border-opacity-10" style="background: white;">
                                <div class="bg-success bg-opacity-10 text-dark rounded-circle p-2 mx-auto mb-3 shadow-sm" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                    <i data-lucide="cloud-sun" class="icon-md"></i>
                                </div>
                                <h4 class="fw-bold text-dark mb-1">18-26°C</h4>
                                <p class="text-muted small mb-0">Suhu Rata-rata</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="glass-card card-hover p-4 text-center h-100 border border-success border-opacity-10" style="background: white;">
                                <div class="bg-success bg-opacity-10 text-dark rounded-circle p-2 mx-auto mb-3 shadow-sm" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                    <i data-lucide="mountain" class="icon-md"></i>
                                </div>
                                <h4 class="fw-bold text-dark mb-1">1.200 <small class="fs-6">mdpl</small></h4>
                                <p class="text-muted small mb-0">Ketinggian Maks.</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="glass-card card-hover p-4 text-center h-100 border border-success border-opacity-10" style="background: white;">
                                <div class="bg-success bg-opacity-10 text-dark rounded-circle p-2 mx-auto mb-3 shadow-sm" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                    <i data-lucide="cloud-rain" class="icon-md"></i>
                                </div>
                                <h4 class="fw-bold text-dark mb-1">2.000 <small class="fs-6">mm</small></h4>
                                <p class="text-muted small mb-0">Curah Hujan / Thn</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="glass-card card-hover p-4 text-center h-100 border border-success border-opacity-10" style="background: white;">
                                <div class="bg-success bg-opacity-10 text-dark rounded-circle p-2 mx-auto mb-3 shadow-sm" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                    <i data-lucide="map" class="icon-md"></i>
                                </div>
                                <h4 class="fw-bold text-dark mb-1">623 <small class="fs-6">Ha</small></h4>
                                <p class="text-muted small mb-0">Luas Wilayah</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Konten Teks Materi -->
                <div class="p-4 p-md-5">
                    <div class="text-center mb-4">
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm border border-warning">
                            <i data-lucide="map-pin" class="icon-sm me-1"></i> Informasi Wilayah
                        </span>
                        <h3 class="fw-bold text-dark mb-0">Letak dan Topografi Desa</h3>
                    </div>
                    
                    <div class="text-dark lh-lg mb-5" style="text-align: justify; font-size: 1.05rem;">
                        <p class="mb-3">Desa Selorejo secara strategis berada di Kecamatan Dau, Kabupaten Malang, dengan koordinat kisaran 7°56'16.50" LS dan 112°32'38.93" BT. Desa ini berada pada wilayah tinggi bersuhu sejuk yang ekstrem, yakni antara <strong>800 hingga 1.200 meter di atas permukaan laut (mdpl)</strong>. Kawasan desa dikelilingi oleh bentang alam yang luas, termasuk lebih dari 2.068 hektare area hutan (lindung dan produksi) dan lebih dari 238 hektare lahan perkebunan, menjadikannya paru-paru hijau dan kawasan tangkapan air vital bagi Kabupaten Malang.</p>
                        <p class="mb-3">Kondisi topografi Desa Selorejo didominasi oleh perbukitan. Struktur tanah pertanian murni yang mencapai tingkat kesuburan 100% dan suhu rata-rata sejuk menciptakan ekosistem yang sangat ideal bagi sektor agrikultur murni. Curah hujan yang stabil mendukung produktivitas lahan, terutama untuk budidaya komoditas unggulan Jeruk yang ditopang oleh subsektor peternakan (sapi, kambing, ayam, lele).</p>
                        <p class="mb-0">Dari aspek sosial-kewilayahan, Selorejo memiliki karakteristik khas yang menjadi kebanggaan tersendiri. Masyarakat desa dikenal sangat tangguh dan memiliki sifat bawaan <strong>"Sumeh"</strong> (ramah senyum). Karakteristik ramah tamah yang tulus ini pada akhirnya berpadu harmonis dengan lanskap alam yang asri, melahirkan daya tarik "wisata sosial" tak kasat mata yang membuat para pendatang maupun wisatawan betah berlama-lama di desa ini.</p>
                    </div>

                    <div class="mt-5 pt-4 border-top border-success border-opacity-10">
                        <h5 class="fw-bold text-dark mb-4 text-center">Pembagian Wilayah Administratif</h5>
                        <p class="text-center text-dark mb-4">Secara administratif, wilayah pemukiman Desa Selorejo terbagi menjadi 3 (tiga) Dusun utama dengan total 6 Rukun Warga (RW) dan 20 Rukun Tetangga (RT):</p>
                        <div class="row g-4 justify-content-center">
                            <div class="col-md-4">
                                <div class="glass-card p-4 rounded-4 text-center h-100 bg-light border border-success border-opacity-10">
                                    <div class="bg-success text-white rounded-circle p-2 mx-auto mb-3" style="width: 45px; height: 45px;"><i data-lucide="map-pin"></i></div>
                                    <h5 class="fw-bold text-dark mb-2">Dusun Krajan</h5>
                                    <p class="text-muted small mb-0">Dusun terluas dan terpadat permukimannya, meliputi RW I hingga RW IV (12 RT).</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="glass-card p-4 rounded-4 text-center h-100 bg-light border border-success border-opacity-10">
                                    <div class="bg-success text-white rounded-circle p-2 mx-auto mb-3" style="width: 45px; height: 45px;"><i data-lucide="map-pin"></i></div>
                                    <h5 class="fw-bold text-dark mb-2">Dusun Selokerto</h5>
                                    <p class="text-muted small mb-0">Berlokasi di sisi barat desa yang cukup padat, meliputi sebagian RW V dan RW VI (7 RT).</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="glass-card p-4 rounded-4 text-center h-100 bg-light border border-success border-opacity-10">
                                    <div class="bg-success text-white rounded-circle p-2 mx-auto mb-3" style="width: 45px; height: 45px;"><i data-lucide="map-pin"></i></div>
                                    <h5 class="fw-bold text-dark mb-2">Dusun Gumuk</h5>
                                    <p class="text-muted small mb-0">Berlokasi di selatan-barat desa, meliputi satu lingkungan spesifik di RW VI (1 RT).</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 pt-4 border-top border-success border-opacity-10 text-center">
                        <h5 class="fw-bold text-dark mb-4">Batas Administrasi Wilayah</h5>
                        <div class="row g-3 justify-content-center text-start">
                            <div class="col-md-5">
                                <ul class="list-group list-group-flush border-0">
                                    <li class="list-group-item bg-transparent px-0 text-dark d-flex align-items-center border-0">
                                        <i data-lucide="compass" class="text-success me-3 icon-md"></i> <strong class="me-2">Utara:</strong> Desa Gadingkulon, Kec. Dau
                                    </li>
                                    <li class="list-group-item bg-transparent px-0 text-dark d-flex align-items-center border-0">
                                        <i data-lucide="compass" class="text-success me-3 icon-md" style="transform: rotate(180deg);"></i> <strong class="me-2">Selatan:</strong> Desa Petungsewu, Kec. Dau
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-5">
                                <ul class="list-group list-group-flush border-0">
                                    <li class="list-group-item bg-transparent px-0 text-dark d-flex align-items-center border-0">
                                        <i data-lucide="compass" class="text-success me-3 icon-md" style="transform: rotate(90deg);"></i> <strong class="me-2">Timur:</strong> Desa Tegalweru, Kec. Dau
                                    </li>
                                    <li class="list-group-item bg-transparent px-0 text-dark d-flex align-items-center border-0">
                                        <i data-lucide="compass" class="text-success me-3 icon-md" style="transform: rotate(-90deg);"></i> <strong class="me-2">Barat:</strong> Kawasan Hutan Lindung
                                    </li>
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
