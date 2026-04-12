@extends('layouts.public')
@section('title', 'Sejarah Desa')
@section('breadcrumb')
    <li class="breadcrumb-item">Profil Desa</li>
    <li class="breadcrumb-item active">Sejarah</li>
@endsection
@section('content')
@include('layouts.partials.page-hero', [
    'title' => 'Sejarah Desa Selorejo',
    'subtitle' => 'Mengenal lebih dekat asal-usul dan tradisi masa lalu.',
    'icon' => 'book-open'
])

<div class="container mb-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="glass-card bg-white p-0 rounded-4 shadow-lg overflow-hidden border-0 mb-5">
                <!-- Foto Utama di Atas Kotak -->
                <div class="position-relative">
                    <img src="{{ asset('images/SelorejoWaduk.jpg') }}" alt="Pemandangan Desa Selorejo" class="img-fluid w-100" style="max-height: 500px; object-fit: cover;">
                    <div class="position-absolute bottom-0 start-0 w-100 p-4 bg-gradient-to-t from-dark to-transparent text-white d-none d-md-block">
                        <small class="text-white-50"><i data-lucide="camera" class="icon-sm me-1"></i> Dokumentasi Desa Selorejo</small>
                    </div>
                </div>

                <!-- Konten Teks Materi -->
                <div class="p-4 p-md-5">
                    <div class="lh-lg text-dark" style="text-align: justify; font-size: 1.05rem;">
                        <p class="mb-4">
                            Desa Selorejo yang dikenal saat ini awalnya memiliki akar sejarah yang kuat dengan nama <strong>"Watugedhe"</strong>. Nama ini merujuk pada keberadaan dua batu raksasa tak lazim yang dipercaya memiliki daya mistis (hingga kini batu tersebut masih berada di lokasi aslinya). Perjalanan desa ini dimulai sekitar pertengahan abad ke-18 pasca Perang Diponegoro. Para pionir, yakni <strong>Mbah H. Turejo</strong> dan <strong>Mbah Sayang</strong>, bersama rombongan pelarian dari Mataram Islam yang melawan kolonial Belanda, melakukan <em>"Babat Alas"</em> atau pembukaan lahan di tengah hutan lebat lereng gunung sebagai hunian baru. Seiring waktu, nama Watugedhe bertransformasi menjadi <strong>Selorejo</strong>, yang diambil dari kombinasi kata <em>"Selo"</em> (batu) dan <em>"Rejo"</em> (diambil dari nama Mbah H. Turejo), melambangkan wilayah berbatu yang dibangun dan dimakmurkan oleh sang pendiri.
                        </p>
                        <p class="mb-4">
                            Sebelum dikenal sebagai penghasil jeruk, wilayah Selorejo merupakan lahan subur yang didominasi oleh tanaman sayur-mayur. Transformasi besar terjadi pada awal dekade <strong>1990-an</strong> ketika muncul inisiatif dari dua tokoh masyarakat visioner, <strong>Abah Sulaiman</strong> dan <strong>Abah Dulawi</strong>. Mereka mulai merintis penanaman bibit jeruk keprok setelah melihat potensi topografi desa yang berada di ketinggian 650-1000 mdpl dengan suhu udara sejuk yang sangat ideal bagi pertumbuhan jeruk. Keberhasilan awal mereka memicu gelombang transisi lahan di seluruh desa, hingga akhirnya hampir setiap warga memiliki kebun jeruk sendiri dan mengubah wajah ekonomi desa secara drastis.
                        </p>
                        <p class="mb-0">
                            Memasuki era modern, potensi agrikultur ini dikembangkan lebih jauh menjadi sektor pariwisata yang terintegrasi. Pada tahun <strong>2011</strong>, Pemerintah Kabupaten Malang secara resmi mencanangkan Selorejo sebagai <strong>"Desa Wisata Jeruk"</strong>. Konsep agrowisata petik jeruk ini tidak hanya mempromosikan varietas unggulan seperti <em>Jeruk Keprok Batu 55</em> dan <em>Jeruk Baby Java</em>, tetapi juga memberikan pengalaman autentik bagi wisatawan untuk berinteraksi langsung dengan alam. Kini, Selorejo telah mengukuhkan posisinya sebagai salah satu destinasi wisata unggulan di Jawa Timur yang mandiri dan berkelanjutan.
                        </p>
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
                    <h5 class="fw-bold text-success mb-1">Pertengahan Abad ke-18</h5>
                    <p class="text-muted small mb-2"><i data-lucide="tag" class="icon-sm me-1"></i> Era Watugedhe (Babat Alas)</p>
                    <p class="text-dark">Pembukaan lahan di masa akhir Perang Diponegoro oleh rombongan pelarian dari Mataram Islam yang dipimpin Mbah H. Turejo dan Mbah Sayang. Kawasan hutan lereng gunung ini awalnya dinamakan Watugedhe karena adanya dua batu keramat raksasa.</p>
                </div>

                <div class="position-relative pb-4 ps-4 border-start border-2 border-success timeline-item mt-4">
                    <div class="position-absolute bg-success rounded-circle shadow" style="width: 16px; height: 16px; left: -9px; top: 0;"></div>
                    <h5 class="fw-bold text-success mb-1">Awal Abad ke-20</h5>
                    <p class="text-muted small mb-2"><i data-lucide="tag" class="icon-sm me-1"></i> Formalisasi Nama Selorejo</p>
                    <p class="text-dark">Perubahan nama resmi dari Watugedhe menjadi Selorejo sebagai bentuk penghormatan kepada perintis desa dan simbol kemakmuran masif yang mulai dirasakan warga.</p>
                </div>

                <div class="position-relative pb-4 ps-4 border-start border-2 border-success timeline-item mt-4">
                    <div class="position-absolute bg-success rounded-circle shadow" style="width: 16px; height: 16px; left: -9px; top: 0;"></div>
                    <h5 class="fw-bold text-success mb-1">Tahun 1990</h5>
                    <p class="text-muted small mb-2"><i data-lucide="sun" class="icon-sm me-1"></i> Era Revolusi Jeruk</p>
                    <p class="text-dark">Abah Sulaiman dan Abah Dulawi merintis penanaman jeruk keprok secara masif menggantikan tanaman sayur, memicu perubahan struktur ekonomi desa menjadi sentra jeruk di Malang.</p>
                </div>

                <div class="position-relative pb-4 ps-4 border-start border-2 border-success timeline-item mt-4">
                    <div class="position-absolute bg-success rounded-circle shadow" style="width: 16px; height: 16px; left: -9px; top: 0;"></div>
                    <h5 class="fw-bold text-success mb-1">Tahun 2011</h5>
                    <p class="text-muted small mb-2"><i data-lucide="map-pin" class="icon-sm me-1"></i> Peresmian Desa Wisata</p>
                    <p class="text-dark">Pemerintah Kabupaten Malang secara resmi mencanangkan Desa Selorejo sebagai destinasi "Agrowisata Petik Jeruk" yang kini melayani ribuan wisatawan setiap bulannya.</p>
                </div>

                <div class="position-relative pb-4 ps-4 border-start border-2 border-success border-bottom-0 mt-4" style="border-image: linear-gradient(to bottom, var(--primary) 0%, transparent 100%) 1;">
                    <div class="position-absolute bg-warning rounded-circle shadow" style="width: 16px; height: 16px; left: -9px; top: 0; outline: 3px solid white;"></div>
                    <h5 class="fw-bold text-success mb-1">Masa Kini</h5>
                    <p class="text-muted small mb-2"><i data-lucide="check-circle" class="icon-sm me-1"></i> Pusat Agrowisata Nasional</p>
                    <p class="text-dark">Selorejo memantapkan diri sebagai pusat edukasi agrowisata dan pemasok utama jeruk premium nasional dengan tata kelola berbasis pemberdayaan masyarakat lokal.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
