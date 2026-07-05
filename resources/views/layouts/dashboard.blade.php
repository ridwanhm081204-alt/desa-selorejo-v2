<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1280">
    <title>@yield('title', 'Dashboard') - {{\App\Models\Setting::get('nama_desa', 'Kemendes')}}</title>
    
    <!-- Google Fonts loaded by custom CSS: Bebas Neue + Open Sans -->
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Design System CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/LogoMalang.png') }}">

    
    <style>
        :root {
            --primary: #2d6a4f;
            --primary-dark: #1b4332;
            --primary-light: #52b788;
            --bg-light: #f0f7f4;
        }
        body { background-color: var(--bg-light); font-family: var(--font-body), sans-serif; color: #333; }
        .content-area { margin-left: 260px; padding: 30px; width: calc(100% - 260px); min-height: 100vh; transition: all 0.3s ease; }
        
        /* Premium Dashboard Components */
        .dash-card { border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(45, 106, 79, 0.08); transition: all 0.3s ease; background: white; }
        .dash-card:hover { transform: translateY(-5px); box-shadow: 0 15px 40px rgba(45, 106, 79, 0.15); }
        
        .hover-lift { transition: all 0.3s ease; }
        .hover-lift:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.1); }
        
        .btn-success { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border: none; }
        .btn-success:hover { background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%); transform: translateY(-2px); box-shadow: 0 5px 15px rgba(45,106,79,0.3); }

        .navbar { backdrop-filter: blur(10px); background: rgba(255,255,255,0.9) !important; border-bottom: 1px solid rgba(45,106,79,0.1); }

        .icon-sm { width: 16px; height: 16px; }
        .icon-xs { width: 14px; height: 14px; }

        @media (max-width: 991px) {
            .sidebar { transform: translateX(-100%); transition: transform 0.3s ease; }
            .content-area { margin-left: 0; width: 100%; padding: 20px; }
            .sidebar.show { transform: translateX(0); }
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
    
    <!-- Mobile Sidebar Backdrop -->
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <div class="content-area">
        <!-- Top Navigation -->
        <nav class="navbar navbar-expand-lg sticky-top rounded-4 shadow-sm mb-4 px-4 py-3 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <button class="btn btn-link link-dark d-lg-none me-2 p-0" id="sidebarToggle">
                    <i data-lucide="menu"></i>
                </button>
                <h5 class="mb-0 text-dark fw-bold">@yield('title', 'Dashboard')</h5>
            </div>
            
            <div class="d-flex align-items-center">
                <span class="me-3 text-muted d-flex align-items-center">
                    <i data-lucide="user" class="me-1 icon-xs"></i> 
                    <span class="d-none d-sm-inline-block text-truncate" style="max-width: 100px;">{{ Auth::user()->name ?? 'Guest' }}</span>
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
    <script>
        lucide.createIcons();
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.querySelector('.sidebar');
        const backdrop = document.getElementById('sidebarBackdrop');

        if (sidebarToggle && sidebar && backdrop) {
            const toggleSidebar = () => {
                sidebar.classList.toggle('show');
                backdrop.classList.toggle('show');
                document.body.style.overflow = sidebar.classList.contains('show') ? 'hidden' : '';
            };

            sidebarToggle.addEventListener('click', toggleSidebar);
            backdrop.addEventListener('click', toggleSidebar);
        }
    </script>
    @stack('scripts')
</body>
</html>
