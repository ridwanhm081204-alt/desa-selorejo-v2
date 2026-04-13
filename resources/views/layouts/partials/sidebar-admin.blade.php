<div class="sidebar vh-100 position-fixed overflow-auto py-4 px-3" style="width: 260px; left: 0; top: 0; background: linear-gradient(180deg, #1b4332 0%, #2d6a4f 100%); z-index: 1050; border-right: 1px solid rgba(255,255,255,0.05);">
    <div class="text-center mb-5 px-3">
        <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-10 rounded-circle mb-3 shadow-sm border border-white border-opacity-10" style="width: 70px; height: 70px; overflow: hidden;">
            <img src="{{ asset('images/logo_desa.png') }}" alt="Logo Desa" style="width: 45px; height: 45px; object-fit: contain;">
        </div>
        <h6 class="mt-2 text-white fw-bold mb-0">Admin Panel</h6>
        <small class="text-white text-opacity-50 small">{{\App\Models\Setting::get('nama_desa', 'Desa Selorejo')}}</small>
    </div>
    
    <div class="nav-section px-2">
        <small class="text-white text-opacity-25 text-uppercase fw-bold x-small mb-3 d-block ps-2">Sistem Utama</small>
        
        <ul class="nav flex-column gap-1 mb-4">
            <li class="nav-item">
                <a href="{{ url('/admin/dashboard') }}" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center {{ request()->is('admin/dashboard') ? 'active-glass shadow-sm' : 'bg-hover-glass' }}">
                    <i data-lucide="layout-dashboard" class="me-3 icon-sm"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/operator') }}" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center {{ request()->is('admin/operator*') ? 'active-glass shadow-sm' : 'bg-hover-glass' }}">
                    <i data-lucide="users" class="me-3 icon-sm"></i> <span>Manajemen Operator</span>
                </a>
            </li>
        </ul>

        <small class="text-white text-opacity-25 text-uppercase fw-bold x-small mb-3 d-block ps-2">Kapasitas & Keamanan</small>
        <ul class="nav flex-column gap-1 mb-4">
            <li class="nav-item">
                <a href="{{ url('/admin/backup') }}" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center {{ request()->is('admin/backup*') ? 'active-glass shadow-sm' : 'bg-hover-glass' }}">
                    <i data-lucide="database" class="me-3 icon-sm"></i> <span>Backup & Pemulihan</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/log') }}" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center {{ request()->is('admin/log*') ? 'active-glass shadow-sm' : 'bg-hover-glass' }}">
                    <i data-lucide="clipboard-list" class="me-3 icon-sm"></i> <span>Log Aktivitas Akun</span>
                </a>
            </li>
        </ul>

        <small class="text-white text-opacity-25 text-uppercase fw-bold x-small mb-3 d-block ps-2">Konfigurasi</small>
        <ul class="nav flex-column gap-1 mb-4">
            <li class="nav-item">
                <a href="{{ url('/admin/pengaturan') }}" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center {{ request()->is('admin/pengaturan*') ? 'active-glass shadow-sm' : 'bg-hover-glass' }}">
                    <i data-lucide="settings" class="me-3 icon-sm"></i> <span>Pengaturan Dasar</span>
                </a>
            </li>
        </ul>

        <div class="mt-5 pt-5 border-top border-white border-opacity-10">
            <a href="{{ url('/operator/dashboard') }}" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center bg-hover-glass">
                <i data-lucide="external-link" class="me-3 icon-sm"></i> <span>Ke Dashboard Operator</span>
            </a>
        </div>
    </div>
</div>

<style>
    .sidebar .nav-link {
        color: rgba(255,255,255,0.85) !important;
        transition: all 0.2s ease;
        border: 1px solid transparent;
    }
    .sidebar .nav-link:hover {
        color: #fff !important;
        background: rgba(255,255,255,0.1) !important;
    }
    .sidebar .nav-link.active-glass {
        background: rgba(255,255,255,0.2) !important;
        color: #fff !important;
        border: 1px solid rgba(255,255,255,0.1);
    }
    .bg-hover-glass:hover { background: rgba(255,255,255,0.1); }
    .x-small { font-size: 10px; letter-spacing: 1.5px; }
    .icon-xs { width: 12px; height: 12px; }
    /* Hide scrollbar for Chrome, Safari and Opera */
    .sidebar::-webkit-scrollbar { display: none; }
    /* Hide scrollbar for IE, Edge and Firefox */
    .sidebar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
