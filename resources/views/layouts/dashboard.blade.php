<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - {{\App\Models\Setting::get('nama_desa', 'Kemendes')}}</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Design System CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/LogoMalang.png') }}">

    
    <style>
        body { background-color: #f8f9fa; }
        .hover-bg-secondary:hover { background-color: rgba(255,255,255,0.1); }
        .content-area { margin-left: 250px; padding: 20px; width: calc(100% - 250px); min-height: 100vh; }
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .content-area { margin-left: 0; width: 100%; }
        }
    </style>
    @stack('styles')
</head>
<body>

    @if(Auth::check())
        @if(Auth::user()->role == 'operator')
            @include('layouts.partials.sidebar-operator')
        @elseif(Auth::user()->role == 'admin')
            @include('layouts.partials.sidebar-admin')
        @endif
    @endif

    <div class="content-area">
        <!-- Top Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow-sm mb-4 p-3 d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-dark fw-bold">@yield('title', 'Dashboard')</h4>
            
            <div class="d-flex align-items-center">
                <span class="me-3 text-muted">
                    <i data-lucide="user" class="me-1" style="width: 14px;"></i> {{ Auth::user()->name ?? 'Guest' }}
                    <span class="badge bg-secondary ms-1">{{ ucfirst(Auth::user()->role ?? '') }}</span>
                </span>
                
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm d-flex align-items-center">
                        <i data-lucide="log-out" class="me-1" style="width: 14px;"></i> Logout
                    </button>
                </form>
            </div>
        </nav>

        <!-- Main Content -->
        <div>
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script>lucide.createIcons();</script>
    @stack('scripts')
</body>
</html>
