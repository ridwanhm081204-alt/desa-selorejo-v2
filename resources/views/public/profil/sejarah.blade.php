@extends('layouts.public')
@section('title', 'Sejarah Desa')
@section('breadcrumb')
    <li class="breadcrumb-item">Profil Desa</li>
    <li class="breadcrumb-item active">Sejarah</li>
@endsection
@section('content')
<div class="section-hero-gradient pt-5 pb-4 mb-5 text-center text-white" style="min-height: auto;">
    <div class="container position-relative z-1">
        <h1 class="fw-bold mb-3"><i data-lucide="book-open" class="me-2 text-warning"></i>Sejarah Desa Selorejo</h1>
        <p class="lead fw-medium text-white-50">Mengenal lebih dekat asal-usul dan tradisi masa lalu.</p>
    </div>
</div>

<div class="container mb-5 pb-5">
    <div class="row align-items-center mb-5 pb-3">
        <div class="col-lg-6 mb-4 mb-lg-0 pe-lg-4">
            <div class="glass-card p-4 p-md-5 bg-white h-100 lh-lg text-justify text-muted" style="text-align: justify;">
                {!! nl2br(e($profile->sejarah ?? 'Data sejarah belum dicatat dalam sistem.')) !!}
            </div>
        </div>
        <div class="col-lg-6 position-relative">
            <div class="position-absolute bg-success rounded-circle" style="width:150px; height:150px; right:-20px; top:-20px; opacity:0.1; z-index:0;"></div>
            <img src="https://images.unsplash.com/photo-1542204165-65bf26472b9b?w=600&q=80" alt="Zaman Dulu Desa Selorejo" class="img-fluid rounded-4 shadow-lg position-relative z-1 border border-4 border-white">
            
            <div class="card-hover position-absolute bottom-0 start-0 translate-middle-y ms-4 p-3 bg-white text-dark shadow rounded-3 border-start border-4 border-success z-2">
                <div class="d-flex align-items-center">
                    <i data-lucide="clock" class="text-success me-3 icon-xl"></i>
                    <div>
                        <h6 class="mb-0 fw-bold">Eksistensi</h6>
                        <small>Terus Berkembang</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Timeline Visual Sejarah -->
    <div class="mt-5 pt-4 border-top border-success border-opacity-10">
        <div class="text-center mb-5">
            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill mb-2 border border-warning shadow-sm">Jejak Waktu Sejarah</span>
            <h3 class="fw-bold text-primary-custom text-dark">Lini Masa Perkembangan</h3>
        </div>
        
        <div class="row position-relative ps-4 ps-md-0">
            <div class="col-md-10 mx-auto">
                
                <div class="position-relative pb-4 ps-4 border-start border-2 border-success timeline-item">
                    <div class="position-absolute bg-success rounded-circle shadow" style="width: 16px; height: 16px; left: -9px; top: 0;"></div>
                    <h5 class="fw-bold text-success mb-1">Masa Babat Alas (Pertengahan Abad 18)</h5>
                    <p class="text-muted small mb-2"><i data-lucide="calendar" class="icon-sm me-1"></i> Asal Mula Desa Watugedhe</p>
                    <p class="text-dark">Pada masa awal, wilayah ini berupa kawasan hutan lebat yang kemudian dibuka (babat alas) oleh para penatua desa, yakni Mbah H. Turejo dan Mbah Sayang sekitar pertengahan abad ke-18. Awalnya desa ini dikenal dengan nama <strong>Desa Watugedhe</strong> dikarenakan di area tersebut terdapat dua buah batu berukuran sangat raksasa yang dikeramatkan.</p>
                </div>

                <div class="position-relative pb-4 ps-4 border-start border-2 border-success timeline-item mt-4">
                    <div class="position-absolute bg-success rounded-circle shadow" style="width: 16px; height: 16px; left: -9px; top: 0;"></div>
                    <h5 class="fw-bold text-success mb-1">Perubahan Nama Menjadi Selorejo</h5>
                    <p class="text-muted small mb-2"><i data-lucide="calendar" class="icon-sm me-1"></i> Kepemimpinan Mbah H. Turejo</p>
                    <p class="text-dark">Nama kawasan akhirnya diganti dari Watugedhe menjadi <strong>Selorejo</strong> untuk mengenang asal usul historis kawasan serta pengabdian sang perintis. <em>"Selo"</em> dalam bahasa Jawa yang berarti Batu, sedangkan kata <em>"Rejo"</em> diambil dari ujung nama Mbah H. Tu<strong>rejo</strong>.</p>
                </div>

                <div class="position-relative pb-4 ps-4 border-start border-2 border-success border-bottom-0 mt-4" style="border-image: linear-gradient(to bottom, var(--primary) 0%, transparent 100%) 1;">
                    <div class="position-absolute bg-warning rounded-circle shadow" style="width: 16px; height: 16px; left: -9px; top: 0; outline: 3px solid white;"></div>
                    <h5 class="fw-bold text-success mb-1">Puncak Transformasi Agrowisata & Jeruk Keprok</h5>
                    <p class="text-muted small mb-2"><i data-lucide="calendar" class="icon-sm me-1"></i> 1990an - Saat Ini</p>
                    <p class="text-dark">Topografi lereng Gunung (Elevasi 800-1.200 mdpl) dan suhu yang sejuk memicu transisi masif ladang warga menjadi pekaran Jeruk Keprok (termasuk varietas premium <em>Batu 55</em> dan <em>Baby Java</em>). Inisiatif petani ini membuahkan hasil hingga Desa Selorejo sukses meraih gelar nasional sebagai <strong>Desa Wisata Agrowisata Petik Jeruk Terpopuler</strong> yang berkali-kali menjuarai kompetisi tingkat Jawa Timur hingga Nasional.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
