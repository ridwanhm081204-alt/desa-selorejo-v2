<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1280">
    <title>@yield('title', 'Beranda') - {{\App\Models\Setting::get('nama_desa', 'Desa Wisata Selorejo')}}</title>
    <meta name="description" content="@yield('meta_description', 'Website resmi Desa Wisata Petik Jeruk Selorejo, Kecamatan Dau, Kabupaten Malang. Informasi wisata, profil desa, transparansi, dan berita terbaru.')">
    <meta name="keywords" content="@yield('meta_keywords', 'wisata petik jeruk, Selorejo, Kecamatan Dau, Kabupaten Malang, agrowisata, jeruk keprok')">
    <meta property="og:title" content="@yield('title', 'Desa Wisata Selorejo') — Website Resmi">
    <meta property="og:description" content="@yield('meta_description')">
    <meta name="author" content="Pemerintah Desa Selorejo">
    @yield('meta')
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Google Fonts loaded by app.css: Bebas Neue + Open Sans -->
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Design System CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/LogoMalang.png') }}">
    
    <!-- Lucide Icons CDN (Fail-safe for dynamic components) -->
    <script src="https://unpkg.com/lucide@latest"></script>

    
    <style>
        html { scroll-behavior: smooth; }
    </style>
    @stack('styles')

    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    @include('layouts.partials.page-loader')

    @include('layouts.partials.public-header')

    <main class="flex-grow-1">
        <!-- Breadcrumb jika bukan di beranda -->
        @if(request()->path() != '/')
            <div class="container mt-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-success">Beranda</a></li>
                        @yield('breadcrumb')
                    </ol>
                </nav>
            </div>
        @endif
        
        @yield('content')
    </main>

    @include('layouts.partials.public-footer')

    <!-- Optimized Asset Loading (Vite handles Bootstrap & Lucide) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Clean phone/whatsapp input fields on type
            document.querySelectorAll('input[name="no_hp_pemohon"], input[name="whatsapp"], input[name="telepon"]').forEach(input => {
                input.setAttribute('maxlength', '15');
                
                input.addEventListener('input', function() {
                    let val = this.value;
                    // Keep only numbers and optional leading +
                    let cleaned = val.replace(/(?!^\+)[^\d]/g, '');
                    if (cleaned !== val) {
                        this.value = cleaned;
                    }
                });
            });
        });
    </script>
    @stack('scripts')


</body>
</html>
