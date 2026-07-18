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

        /* Lucide Autocomplete Dropdown Styles */
        .lucide-dropdown-container {
            position: relative;
        }
        .lucide-dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 1050;
            max-height: 250px;
            overflow-y: auto;
            background: white;
            border: 1px solid rgba(45, 106, 79, 0.15);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-top: 5px;
            display: none;
        }
        .lucide-dropdown-item {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            cursor: pointer;
            transition: background 0.2s;
            font-size: 0.85rem;
            color: #333;
            text-align: left;
        }
        .lucide-dropdown-item:hover, .lucide-dropdown-item.active {
            background-color: #f0f7f4;
            color: #1b4332;
        }
        .lucide-dropdown-item svg, .lucide-dropdown-item i {
            width: 16px;
            height: 16px;
            margin-right: 10px;
            color: #2d6a4f;
            flex-shrink: 0;
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
        if (window.lucide && window.lucide.icons) {
            if (!window.lucide.icons.Facebook) window.lucide.icons.Facebook = [["path", {"d": "M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"}]];
            if (!window.lucide.icons.Instagram) window.lucide.icons.Instagram = [["rect", {"width": "20", "height": "20", "x": "2", "y": "2", "rx": "5", "ry": "5"}], ["path", {"d": "M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"}], ["line", {"x1": "17.5", "x2": "17.51", "y1": "6.5", "y2": "6.5"}]];
            if (!window.lucide.icons.Youtube) window.lucide.icons.Youtube = [["path", {"d": "M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"}], ["path", {"d": "m10 15 5-3-5-3z"}]];
            if (!window.lucide.icons.Tiktok) window.lucide.icons.Tiktok = [["path", {"d": "M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"}]];
            if (!window.lucide.icons.tiktok) window.lucide.icons.tiktok = [["path", {"d": "M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"}]];
        }
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

        // Global Lucide Autocomplete Dropdown Logic
        document.addEventListener('DOMContentLoaded', function () {
            const iconInputs = document.querySelectorAll('input[name="icon"]');
            if (iconInputs.length === 0) return;
            
            // Get all available icons dynamically from global lucide bundle
            const allIcons = Object.keys(window.lucide?.icons || {}).map(str => {
                return str.replace(/([a-z0-9])([A-Z])/g, '$1-$2').toLowerCase();
            }).sort();
            
            iconInputs.forEach(input => {
                // Setup wrapper
                const wrapper = document.createElement('div');
                wrapper.className = 'lucide-dropdown-container w-100';
                input.parentNode.insertBefore(wrapper, input);
                wrapper.appendChild(input);
                
                // Setup dropdown menu
                const menu = document.createElement('div');
                menu.className = 'lucide-dropdown-menu';
                wrapper.appendChild(menu);
                
                const renderList = (filter = '') => {
                    const query = filter.toLowerCase().trim();
                    const filtered = allIcons.filter(name => name.includes(query)).slice(0, 100);
                    
                    if (filtered.length === 0) {
                        menu.innerHTML = '<div class="p-2 text-muted text-center small">Ikon tidak ditemukan</div>';
                        return;
                    }
                    
                    menu.innerHTML = filtered.map(name => `
                        <div class="lucide-dropdown-item" data-icon="${name}">
                            <i data-lucide="${name}" class="icon-sm"></i>
                            <span>${name}</span>
                        </div>
                    `).join('');
                    
                    // Re-initialize lucide icons inside menu
                    if (window.lucide) {
                        window.lucide.createIcons({
                            root: menu
                        });
                    }
                };
                
                // Focus: show list
                input.addEventListener('focus', () => {
                    renderList(input.value);
                    menu.style.display = 'block';
                });
                
                // Typing: filter list
                input.addEventListener('input', () => {
                    renderList(input.value);
                });
                
                // Click item: select
                menu.addEventListener('click', (e) => {
                    const item = e.target.closest('.lucide-dropdown-item');
                    if (item) {
                        const iconName = item.getAttribute('data-icon');
                        input.value = iconName;
                        menu.style.display = 'none';
                        
                        // Dispatch standard input/change events
                        input.dispatchEvent(new Event('change', { bubbles: true }));
                        input.dispatchEvent(new Event('input', { bubbles: true }));
                    }
                });
                
                // Close when clicking outside
                document.addEventListener('click', (e) => {
                    if (!wrapper.contains(e.target)) {
                        menu.style.display = 'none';
                    }
                });
            });
        });

        // Clean phone/whatsapp input fields on type (Operator/Admin)
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('input[name="no_hp_pemohon"], input[name="whatsapp"], input[name="telepon"]').forEach(input => {
                input.setAttribute('maxlength', '15');
                
                input.addEventListener('input', function() {
                    let val = this.value;
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
