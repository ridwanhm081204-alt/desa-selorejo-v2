@extends('layouts.public')
@section('title', 'Peta Desa')
@section('breadcrumb')
    <li class="breadcrumb-item">Profil Desa</li>
    <li class="breadcrumb-item active">Peta Desa</li>
@endsection
@section('content')
<div class="section-hero-gradient pt-5 pb-4 mb-5 text-center text-white" style="min-height: auto;">
    <div class="container position-relative z-1">
        <h1 class="fw-bold mb-3"><i data-lucide="map" class="me-2 text-warning"></i>Peta Wilayah Desa</h1>
        <p class="lead fw-medium text-white-50">Penunjuk arah digital menuju Desa Wisata Petik Jeruk Selorejo</p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <div class="row g-4">
        <!-- Peta Kontainer -->
        <div class="col-lg-8">
            <div class="glass-card bg-white p-3 rounded-4 shadow-sm border-0 border-top border-5 border-success h-100">
                <div class="d-flex align-items-center mb-3 px-2">
                    <i data-lucide="navigation" class="text-success me-2"></i>
                    <h5 class="fw-bold mb-0 text-dark">Google Maps Integrasi</h5>
                </div>
                <div class="rounded-3 overflow-hidden" style="height: 450px; background: #eee;">
                    {!! $profile->peta_embed ?? '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15806.384864810932!2d112.53843605!3d-7.937170050000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7883ef912d9999%3A0xf8ff8468809efd9c!2sSelorejo%2C%20Kec.%20Dau%2C%20Kabupaten%20Malang%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1775912011055!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>' !!}
                </div>
            </div>
        </div>

        <!-- Info Card -->
        <div class="col-lg-4">
            <div class="glass-card bg-primary-custom text-white p-4 p-md-5 rounded-4 shadow-sm border-0 h-100 d-flex flex-column justify-content-center hover-lift position-relative overflow-hidden">
                <div class="position-absolute align-self-end opacity-10" style="right:-30px; bottom:-30px;"><i data-lucide="map-pin" style="width:200px; height:200px;"></i></div>
                <div class="position-relative z-1">
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-4">Petunjuk Lokasi</span>
                    <h3 class="fw-bold mb-4 lh-base text-white">Panduan Akses Menuju Desa</h3>
                    
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-success rounded p-2 me-3"><i data-lucide="car" class="icon-sm text-white"></i></div>
                        <div>
                            <strong class="d-block mb-1">Rute Kendaraan Pribadi</strong>
                            <p class="small text-white-50 mb-0 lh-sm">Dapat diakses 30 menit dari Kota Malang ke arah Barat (Batu).</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start mb-4">
                        <div class="bg-success rounded p-2 me-3"><i data-lucide="bus" class="icon-sm text-white"></i></div>
                        <div>
                            <strong class="d-block mb-1">Akses Transportasi Umum</strong>
                            <p class="small text-white-50 mb-0 lh-sm">Tersedia angkutan pedesaan jalur stasiun ke wilayah Terminal Landungsari.</p>
                        </div>
                    </div>

                    <a href="https://maps.google.com/?q=Desa+Selorejo+Kecamatan+Dau+Kabupaten+Malang" target="_blank" class="btn btn-light text-success fw-bold w-100 rounded-pill shadow">Buka di Aplikasi Maps <i data-lucide="external-link" class="icon-sm ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
