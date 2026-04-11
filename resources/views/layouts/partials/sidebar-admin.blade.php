<div class="sidebar bg-dark text-white p-3 vh-100 position-fixed overflow-auto" style="width: 250px; left: 0; top: 0;">
    <div class="text-center mb-4">
        <i data-lucide="shield" class="text-danger" style="width: 40px; height: 40px;"></i>
        <h5 class="mt-2 text-white">Admin Panel</h5>
        <small class="text-white-50">{{\App\Models\Setting::get('nama_desa', 'Desa Selorejo')}}</small>
    </div>
    
    <ul class="nav flex-column mb-auto">
        <li class="nav-item mb-1">
            <a href="{{ url('/admin/dashboard') }}" class="nav-link text-white d-flex align-items-center rounded {{ request()->is('admin/dashboard') ? 'bg-danger' : 'hover-bg-secondary' }}">
                <i data-lucide="layout-dashboard" class="me-2" style="width: 18px;"></i> Dashboard
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ url('/admin/operator') }}" class="nav-link text-white d-flex align-items-center rounded {{ request()->is('admin/operator*') ? 'bg-danger' : 'hover-bg-secondary' }}">
                <i data-lucide="users" class="me-2" style="width: 18px;"></i> Manajemen Operator
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ url('/admin/backup') }}" class="nav-link text-white d-flex align-items-center rounded {{ request()->is('admin/backup*') ? 'bg-danger' : 'hover-bg-secondary' }}">
                <i data-lucide="database" class="me-2" style="width: 18px;"></i> Backup Data
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ url('/admin/log') }}" class="nav-link text-white d-flex align-items-center rounded {{ request()->is('admin/log*') ? 'bg-danger' : 'hover-bg-secondary' }}">
                <i data-lucide="clipboard-list" class="me-2" style="width: 18px;"></i> Log Aktivitas
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ url('/admin/pengaturan') }}" class="nav-link text-white d-flex align-items-center rounded {{ request()->is('admin/pengaturan*') ? 'bg-danger' : 'hover-bg-secondary' }}">
                <i data-lucide="settings" class="me-2" style="width: 18px;"></i> Pengaturan
            </a>
        </li>
    </ul>
</div>
