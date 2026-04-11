<div class="sidebar bg-dark text-white p-3 vh-100 position-fixed overflow-auto" style="width: 250px; left: 0; top: 0;">
    <div class="text-center mb-4">
        <i data-lucide="leaf" class="text-success" style="width: 40px; height: 40px;"></i>
        <h5 class="mt-2 text-white">Operator Panel</h5>
        <small class="text-white-50">{{\App\Models\Setting::get('nama_desa', 'Desa Selorejo')}}</small>
    </div>
    
    <ul class="nav flex-column mb-auto">
        <li class="nav-item mb-1">
            <a href="{{ url('/operator/dashboard') }}" class="nav-link text-white d-flex align-items-center rounded {{ request()->is('operator/dashboard') ? 'bg-success' : 'hover-bg-secondary' }}">
                <i data-lucide="layout-dashboard" class="me-2" style="width: 18px;"></i> Dashboard
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ url('/operator/profil') }}" class="nav-link text-white d-flex align-items-center rounded {{ request()->is('operator/profil*') ? 'bg-success' : 'hover-bg-secondary' }}">
                <i data-lucide="building" class="me-2" style="width: 18px;"></i> Profil Desa
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="#pemerintahanCollapse" data-bs-toggle="collapse" class="nav-link text-white d-flex align-items-center rounded hover-bg-secondary w-100 dropdown-toggle">
                <i data-lucide="users" class="me-2" style="width: 18px;"></i> Pemerintahan
            </a>
            <div class="collapse {{ request()->is('operator/struktur*') || request()->is('operator/bpd*') || request()->is('operator/lembaga*') ? 'show' : '' }}" id="pemerintahanCollapse">
                <ul class="nav flex-column ms-3 mt-1">
                    <li class="nav-item"><a href="{{ url('/operator/struktur') }}" class="nav-link text-white-50"><i data-lucide="chevron-right" class="me-1 icon-sm"></i> Struktur</a></li>
                    <li class="nav-item"><a href="{{ url('/operator/bpd') }}" class="nav-link text-white-50"><i data-lucide="chevron-right" class="me-1 icon-sm"></i> BPD</a></li>
                    <li class="nav-item"><a href="{{ url('/operator/lembaga') }}" class="nav-link text-white-50"><i data-lucide="chevron-right" class="me-1 icon-sm"></i> Lembaga</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ url('/operator/wisata') }}" class="nav-link text-white d-flex align-items-center rounded {{ request()->is('operator/wisata*') ? 'bg-success' : 'hover-bg-secondary' }}">
                <i data-lucide="map" class="me-2" style="width: 18px;"></i> Wisata
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ url('/operator/produk') }}" class="nav-link text-white d-flex align-items-center rounded {{ request()->is('operator/produk*') ? 'bg-success' : 'hover-bg-secondary' }}">
                <i data-lucide="shopping-bag" class="me-2" style="width: 18px;"></i> Produk
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ url('/operator/galeri') }}" class="nav-link text-white d-flex align-items-center rounded {{ request()->is('operator/galeri*') ? 'bg-success' : 'hover-bg-secondary' }}">
                <i data-lucide="image" class="me-2" style="width: 18px;"></i> Galeri
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ url('/operator/statistik') }}" class="nav-link text-white d-flex align-items-center rounded {{ request()->is('operator/statistik*') ? 'bg-success' : 'hover-bg-secondary' }}">
                <i data-lucide="bar-chart-2" class="me-2" style="width: 18px;"></i> Statistik
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ url('/operator/apbdes') }}" class="nav-link text-white d-flex align-items-center rounded {{ request()->is('operator/apbdes*') ? 'bg-success' : 'hover-bg-secondary' }}">
                <i data-lucide="file-text" class="me-2" style="width: 18px;"></i> APBDes
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ url('/operator/berita') }}" class="nav-link text-white d-flex align-items-center rounded {{ request()->is('operator/berita*') ? 'bg-success' : 'hover-bg-secondary' }}">
                <i data-lucide="newspaper" class="me-2" style="width: 18px;"></i> Berita
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ url('/operator/polling') }}" class="nav-link text-white d-flex align-items-center rounded {{ request()->is('operator/polling*') ? 'bg-success' : 'hover-bg-secondary' }}">
                <i data-lucide="pie-chart" class="me-2" style="width: 18px;"></i> Polling
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ url('/operator/widget') }}" class="nav-link text-white d-flex align-items-center rounded {{ request()->is('operator/widget*') ? 'bg-success' : 'hover-bg-secondary' }}">
                <i data-lucide="layout-template" class="me-2" style="width: 18px;"></i> Widget
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ url('/operator/pesan') }}" class="nav-link text-white d-flex align-items-center rounded {{ request()->is('operator/pesan*') ? 'bg-success' : 'hover-bg-secondary' }}">
                <i data-lucide="mail" class="me-2" style="width: 18px;"></i> Pesan
            </a>
        </li>
    </ul>
</div>
