@extends('layouts.public')
@section('title', 'Peta Desa')
@section('breadcrumb')
    <li class="breadcrumb-item">Profil Desa</li>
    <li class="breadcrumb-item active">Peta Desa</li>
@endsection
@section('content')
@php
    $hero = $profile->hero_peta ?? ['title' => 'Peta Wilayah Desa', 'subtitle' => 'Penunjuk arah digital menuju Desa Wisata Petik Jeruk Selorejo', 'icon' => 'map'];
@endphp

@include('layouts.partials.page-hero', [
    'title' => $hero['title'] ?? 'Peta Wilayah Desa',
    'subtitle' => $hero['subtitle'] ?? 'Penunjuk arah digital menuju Desa Wisata Petik Jeruk Selorejo',
    'icon' => $hero['icon'] ?? 'map'
])

<div class="container mb-5 pb-5">
    <div class="row g-4">
        <!-- Peta Kontainer -->
        <div class="col-lg-8">
            <div class="glass-card bg-white p-3 rounded-4 shadow-sm border-0 border-top border-5 border-success h-100">
                <div class="d-flex align-items-center mb-3 px-2">
                    <i data-lucide="navigation" class="text-dark me-2"></i>
                    <h5 class="fw-bold mb-0 text-dark">Google Maps Integrasi</h5>
                </div>
                <div class="rounded-3 overflow-hidden" style="height: 450px; background: #eee;">
                    {!! $profile->peta_embed ?? '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15806.384864810932!2d112.53843605!3d-7.937170050000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7883ef912d9999%3A0xf8ff8468809efd9c!2sSelorejo%2C%20Kec.%20Dau%2C%20Kabupaten%20Malang%2C%20Jawa%20Timur!5e0!3m2!1id!2sid!4v1775912011055!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>' !!}
                </div>
            </div>
        </div>

        <!-- Info Card -->
        <div class="col-lg-4">
            <div class="glass-card bg-primary-custom text-white p-4 p-md-5 rounded-4 shadow-sm border-0 h-100 d-flex flex-column justify-content-center hover-lift position-relative overflow-hidden">
                <div class="position-absolute align-self-end text-white" style="right:-30px; bottom:-30px; opacity: 0.05;"><i data-lucide="map-pin" style="width:200px; height:200px;"></i></div>
                <div class="position-relative z-1 text-center text-md-start">
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-4">Petunjuk Lokasi</span>
                    <h3 class="fw-bold mb-4 lh-base text-white">Panduan Akses Menuju Desa</h3>
                    
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-white bg-opacity-10 rounded p-2 me-3"><i data-lucide="car" class="icon-sm text-white" style="opacity: 0.8;"></i></div>
                        <div>
                            <strong class="d-block mb-1 text-white">Rute Kendaraan Pribadi</strong>
                            <p class="small text-white mb-0 lh-sm">{{ $profile->peta_rute_pribadi ?? 'Dapat diakses 30 menit dari Kota Malang ke arah Barat (Batu).' }}</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start mb-4">
                        <div class="bg-white bg-opacity-10 rounded p-2 me-3"><i data-lucide="bus" class="icon-sm text-white" style="opacity: 0.8;"></i></div>
                        <div>
                            <strong class="d-block mb-1 text-white">Akses Transportasi Umum</strong>
                            <p class="small text-white mb-0 lh-sm">{{ $profile->peta_rute_umum ?? 'Tersedia angkutan pedesaan jalur stasiun ke wilayah Terminal Landungsari.' }}</p>
                        </div>
                    </div>

                    <a href="https://maps.google.com/?q=Desa+Selorejo+Kecamatan+Dau+Kabupaten+Malang" target="_blank" class="btn btn-light text-success fw-bold w-100 rounded-pill shadow-lg hover-lift">Buka di Aplikasi Maps <i data-lucide="external-link" class="icon-sm ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Gambaran Pemetaan Wilayah & Legenda Peta (Data Historis 2016) -->
    <div class="mt-5 pt-4">
        <div class="row g-4 align-items-center">
            <!-- Peta Gambar -->
            <div class="col-lg-7">
                <div class="glass-card bg-white p-3 rounded-4 shadow-sm border border-success border-opacity-10">
                    <div class="d-flex align-items-center mb-3">
                        <i data-lucide="map" class="text-success me-2 icon-md"></i>
                        <h5 class="fw-bold mb-0 text-dark">Peta Klasifikasi Administratif</h5>
                    </div>
                    <div class="rounded-3 overflow-hidden text-center bg-light">
                        <img src="{{ $profile->peta_image ? asset($profile->peta_image) : asset('images/Peta Desa Selorejo.jpg') }}" class="img-fluid w-100" alt="Peta Desa Selorejo" style="max-height: 500px; object-fit: contain;">
                    </div>
                </div>
            </div>
            
            <!-- Penjelasan Legenda -->
            <div class="col-lg-5">
                <div class="glass-card bg-white p-4 rounded-4 shadow-sm border-0 border-start border-5 border-success h-100">
                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-bold mb-3 border border-success border-opacity-10">PEMETAAN SOSIAL</span>
                    <h3 class="fw-bold text-dark mb-4">Membaca Peta Desa</h3>
                    
                    <p class="text-muted mb-4 text-justify">
                        {{ $profile->peta_narasi_utama ?? 'Berdasarkan pemetaan struktural, batas wilayah Utara terhubung ke Desa Gading Kulon, Timur ke Tegal Weru, Selatan ke Petung Sewu, dan Barat berupa hamparan hutan murni.' }}
                    </p>

                    <h6 class="fw-bold text-dark mb-2"><i data-lucide="home" class="icon-sm text-success me-2"></i>Klasifikasi Permukiman (Legenda)</h6>
                    <p class="text-muted small mb-4">
                        {{ $profile->peta_narasi_legenda ?? 'Peta desa ini berfungsi tidak hanya secara administratif, tapi juga sosial-ekonomi. Pemukiman diklasifikasikan menjadi tiga tingkatan: Rumah Miskin, Rumah Sedang, dan Rumah Kaya, guna memfasilitasi perencanaan tata ruang dan program kesejahteraan yang tepat sasaran.' }}
                    </p>

                    <h6 class="fw-bold text-dark mb-2"><i data-lucide="building" class="icon-sm text-success me-2"></i>Fasilitas Umum Penting</h6>
                    <ul class="list-unstyled text-muted small mb-0">
                        @php 
                            $fasilitas = $profile->peta_fasilitas ?? [
                                ['icon' => 'check-circle', 'text' => 'Balai Desa sebagai pusat administrasi.'],
                                ['icon' => 'check-circle', 'text' => 'Balai Dukuh di masing-masing area Dusun.'],
                                ['icon' => 'check-circle', 'text' => 'Fasilitas Pendidikan (SD).'],
                                ['icon' => 'check-circle', 'text' => 'Jalur utama penghubung antar Dusun.']
                            ]; 
                        @endphp
                        @foreach($fasilitas as $f)
                        <li class="mb-2"><i data-lucide="{{ $f['icon'] }}" class="icon-sm text-success me-2"></i>{{ $f['text'] }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Pembagian Dusun & RT/RW -->
        <div class="row g-4 mt-2">
            @php 
                $dusuns = $profile->dusun_info ?? [
                    ['nama' => 'Dusun Krajan', 'peta_desc' => 'Berlokasi di bagian tengah hingga timur desa. Merupakan kawasan terluas, terpadat, dan menjadi pusat aktivitas utama penduduk.', 'admin_rw' => 'RW I - RW IV', 'admin_rt' => '12 RT (RT.01 - RT.12)', 'color_theme' => 'success'],
                    ['nama' => 'Dusun Selokerto', 'peta_desc' => 'Berlokasi di sisi barat/kiri dari peta desa. Cukup padat, terutama berkonsentrasi di sektor utara dan tengah wilayah dusun.', 'admin_rw' => 'RW V - RW VI (Sebagian)', 'admin_rt' => '7 RT (RT.13 - RT.19)', 'color_theme' => 'warning'],
                    ['nama' => 'Dusun Gumuk', 'peta_desc' => 'Berlokasi merapat di bagian barat daya. Relatif memiliki sebaran bangunan pemukiman yang lebih sedikit dibanding dua dusun lainnya.', 'admin_rw' => 'RW VI (Sebagian)', 'admin_rt' => '1 RT (RT.20)', 'color_theme' => 'primary']
                ];
            @endphp
            @foreach(array_slice($dusuns, 0, 3) as $dsn)
            <div class="col-md-4">
                <div class="glass-card bg-white p-4 rounded-4 shadow-sm h-100 border-top border-4 border-{{ $dsn['color_theme'] ?? 'success' }} hover-lift">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-{{ $dsn['color_theme'] ?? 'success' }} text-white rounded p-2 me-3"><i data-lucide="map" class="icon-sm"></i></div>
                        <h5 class="fw-bold text-dark mb-0">{{ $dsn['nama'] }}</h5>
                    </div>
                    <p class="text-muted small mb-4 text-justify" style="min-height: 60px;">{{ $dsn['peta_desc'] }}</p>
                    <div class="bg-{{ $dsn['color_theme'] ?? 'success' }} bg-opacity-10 rounded p-3 text-center border border-{{ $dsn['color_theme'] ?? 'success' }} border-opacity-25">
                        <strong class="d-block text-{{ $dsn['color_theme'] ?? 'success' }} mb-2 fw-bold"><i data-lucide="users" class="icon-sm me-1"></i> Area Administrasi</strong>
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <span class="badge bg-white text-{{ $dsn['color_theme'] ?? 'success' }} border border-{{ $dsn['color_theme'] ?? 'success' }} border-opacity-25 px-3 py-2 shadow-sm">{{ $dsn['admin_rw'] }}</span>
                            <span class="badge bg-white text-{{ $dsn['color_theme'] ?? 'success' }} border border-{{ $dsn['color_theme'] ?? 'success' }} border-opacity-25 px-3 py-2 shadow-sm">{{ $dsn['admin_rt'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Titik Lokasi Wisata Favorit -->
    <div class="mt-5 pt-5 border-top border-success border-opacity-10">
        <div class="text-center mb-5">
            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-bold mb-3 border border-success border-opacity-10">DESTINASI UNGGULAN</span>
            <h2 class="fw-bold text-dark">Titik Lokasi Wisata Favorit</h2>
            <p class="text-muted">Akses langsung menuju titik koordinat objek wisata di Desa Selorejo.</p>
        </div>

        <div class="row g-4">
            @php $wisataList = \App\Models\Wisata::all(); @endphp
            @foreach($wisataList as $w)
            <!-- Wisata Item -->
            <div class="col-md-6">
                <div class="glass-card bg-white p-3 rounded-4 shadow-sm border border-success border-opacity-10 h-100 flex-column d-flex">
                    <div class="d-flex align-items-center mb-3">
                        @php
                            $icon = 'map-pin';
                            $bg = 'bg-success text-white';
                            $q = strtolower($w->judul);
                            if(str_contains($q, 'jeruk')) { $icon = 'citrus'; $bg = 'bg-warning text-dark'; }
                            elseif(str_contains($q, 'bedengan')) { $icon = 'tent'; }
                            elseif(str_contains($q, 'air terjun')) { $icon = 'waves'; $bg = 'bg-info text-dark'; }
                            elseif(str_contains($q, 'trail') || str_contains($q, 'atv')) { $icon = 'bike'; $bg = 'bg-danger text-white'; }
                            elseif(str_contains($q, 'kesenian') || str_contains($q, 'budaya')) { $icon = 'music'; $bg = 'bg-primary text-white'; }
                        @endphp
                        <div class="{{ $bg }} rounded-circle p-2 me-3 shadow-sm d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i data-lucide="{{ $icon }}" class="icon-sm"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-0">{{ $w->judul }}</h6>
                    </div>
                    <div class="rounded-3 overflow-hidden mb-3" style="height: 300px; background: #eee;">
                        <iframe src="https://maps.google.com/maps?q={{ urlencode($w->judul . ' Selorejo Daerah Dau Malang') }}&t=&z=14&ie=UTF8&iwloc=&output=embed" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <a href="https://www.google.com/maps/search/{{ urlencode($w->judul . ' Selorejo') }}" target="_blank" class="btn btn-success w-100 rounded-pill fw-bold mt-auto btn-sm py-2">Navigasi Ke Lokasi <i data-lucide="navigation-2" class="icon-sm ms-1"></i></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
