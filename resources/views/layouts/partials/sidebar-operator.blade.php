<div class="sidebar vh-100 position-fixed overflow-auto py-4 px-3" style="width: 260px; left: 0; top: 0; background: linear-gradient(180deg, var(--primary-dark) 0%, var(--primary) 100%); z-index: 1050; border-right: 1px solid rgba(255,255,255,0.05);">
    <div class="text-center mb-5 px-3">
        <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-10 rounded-circle mb-3 shadow-sm border border-white border-opacity-10" style="width: 70px; height: 70px; overflow: hidden;">
            <img src="{{ asset('images/logo_desa.png') }}" alt="Logo Desa" style="width: 45px; height: 45px; object-fit: contain;">
        </div>
        <h6 class="mt-2 text-white fw-bold mb-0">Operator Panel</h6>
        <small class="text-white text-opacity-50 small">{{\App\Models\Setting::get('nama_desa', 'Desa Selorejo')}}</small>
    </div>
    
    <div class="nav-section px-2">
        <small class="text-white text-opacity-25 text-uppercase fw-bold x-small mb-3 d-block ps-2">Menu Utama</small>
        
        <ul class="nav flex-column gap-1 mb-4">
            <li class="nav-item">
                <a href="{{ url('/operator/dashboard') }}" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center {{ request()->is('operator/dashboard') ? 'active-glass shadow-sm' : 'bg-hover-glass' }}">
                    <i data-lucide="layout-dashboard" class="me-3 icon-sm"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/operator/profil') }}" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center {{ request()->is('operator/profil*') ? 'active-glass shadow-sm' : 'bg-hover-glass' }}">
                    <i data-lucide="building" class="me-3 icon-sm"></i> <span>Profil Desa</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="#pemerintahanCollapse" data-bs-toggle="collapse" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center justify-content-between {{ request()->is('operator/struktur*') || request()->is('operator/bpd*') || request()->is('operator/lembaga*') ? 'bg-white bg-opacity-10' : 'bg-hover-glass' }}">
                    <div class="d-flex align-items-center">
                        <i data-lucide="users-2" class="me-3 icon-sm"></i> <span>Pemerintahan</span>
                    </div>
                    <i data-lucide="chevron-down" class="icon-xs opacity-50"></i>
                </a>
                <div class="collapse {{ request()->is('operator/struktur*') || request()->is('operator/bpd*') || request()->is('operator/lembaga*') ? 'show' : '' }}" id="pemerintahanCollapse">
                    <ul class="nav flex-column ms-4 mt-2 mb-2 gap-1 border-start border-white border-opacity-10 ps-3">
                        <li><a href="{{ url('/operator/struktur') }}" class="nav-link py-1 text-white text-opacity-75 small {{ request()->is('operator/struktur*') ? 'text-white fw-bold opacity-100' : 'hover-opacity' }}">Struktur Organisasi</a></li>
                        <li><a href="{{ url('/operator/bpd') }}" class="nav-link py-1 text-white text-opacity-75 small {{ request()->is('operator/bpd*') ? 'text-white fw-bold opacity-100' : 'hover-opacity' }}">BPD</a></li>
                        <li><a href="{{ url('/operator/lembaga') }}" class="nav-link py-1 text-white text-opacity-75 small {{ request()->is('operator/lembaga*') ? 'text-white fw-bold opacity-100' : 'hover-opacity' }}">Lembaga Desa</a></li>
                    </ul>
                </div>
            </li>
        </ul>

        <small class="text-white text-opacity-25 text-uppercase fw-bold x-small mb-3 d-block ps-2">Layanan Kependudukan</small>
        <ul class="nav flex-column gap-1 mb-4">
            <li class="nav-item">
                <a href="{{ route('operator.layanan.index') }}" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center {{ request()->is('operator/layanan*') ? 'active-glass shadow-sm' : 'bg-hover-glass' }}">
                    <i data-lucide="file-text" class="me-3 icon-sm"></i> <span>Verifikasi Berkas</span>
                    @php
                        $pendingCount = \App\Models\Pengajuan::where('status', 'diajukan')->count();
                    @endphp
                    @if($pendingCount > 0)
                        <span class="badge bg-danger ms-auto">{{ $pendingCount }}</span>
                    @endif
                </a>
            </li>
        </ul>

        <small class="text-white text-opacity-25 text-uppercase fw-bold x-small mb-3 d-block ps-2">Informasi Publik</small>
        <ul class="nav flex-column gap-1 mb-4">
            <li class="nav-item"><a href="{{ url('/operator/berita') }}" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center {{ request()->is('operator/berita*') ? 'active-glass shadow-sm' : 'bg-hover-glass' }}"><i data-lucide="newspaper" class="me-3 icon-sm"></i> <span>Berita</span></a></li>
            <li class="nav-item"><a href="{{ url('/operator/galeri') }}" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center {{ request()->is('operator/galeri*') ? 'active-glass shadow-sm' : 'bg-hover-glass' }}"><i data-lucide="image" class="me-3 icon-sm"></i> <span>Galeri</span></a></li>
            <li class="nav-item"><a href="{{ url('/operator/wisata') }}" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center {{ request()->is('operator/wisata*') ? 'active-glass shadow-sm' : 'bg-hover-glass' }}"><i data-lucide="map-pin" class="me-3 icon-sm"></i> <span>Wisata</span></a></li>
            <li class="nav-item">
                <a href="#produkCollapse" data-bs-toggle="collapse" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center justify-content-between {{ request()->is('operator/produk*') ? 'bg-white bg-opacity-10' : 'bg-hover-glass' }}">
                    <div class="d-flex align-items-center">
                        <i data-lucide="shopping-bag" class="me-3 icon-sm"></i> <span>Produk</span>
                    </div>
                    <i data-lucide="chevron-down" class="icon-xs opacity-50"></i>
                </a>
                <div class="collapse {{ request()->is('operator/produk*') ? 'show' : '' }}" id="produkCollapse">
                    <ul class="nav flex-column ms-4 mt-2 mb-2 gap-1 border-start border-white border-opacity-10 ps-3">
                        <li><a href="{{ url('/operator/produk') }}" class="nav-link py-1 text-white text-opacity-75 small {{ request()->is('operator/produk') || request()->is('operator/produk/create') || request()->is('operator/produk/*/edit') ? 'text-white fw-bold opacity-100' : 'hover-opacity' }}">Manajemen Produk</a></li>
                        <li><a href="{{ url('/operator/produk/transaksi') }}" class="nav-link py-1 text-white text-opacity-75 small {{ request()->is('operator/produk/transaksi') ? 'text-white fw-bold opacity-100' : 'hover-opacity' }}">Riwayat Transaksi</a></li>
                    </ul>
                </div>
            </li>
        </ul>

        <small class="text-white text-opacity-25 text-uppercase fw-bold x-small mb-3 d-block ps-2">Data & Transparansi</small>
        <ul class="nav flex-column gap-1 mb-4">
            <li class="nav-item"><a href="{{ url('/operator/statistik') }}" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center {{ request()->is('operator/statistik*') ? 'active-glass shadow-sm' : 'bg-hover-glass' }}"><i data-lucide="bar-chart-3" class="me-3 icon-sm"></i> <span>Statistik</span></a></li>
            <li class="nav-item"><a href="{{ url('/operator/apbdes') }}" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center {{ request()->is('operator/apbdes*') ? 'active-glass shadow-sm' : 'bg-hover-glass' }}"><i data-lucide="file-text" class="me-3 icon-sm"></i> <span>APBDes</span></a></li>
            <li class="nav-item"><a href="{{ url('/operator/polling') }}" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center {{ request()->is('operator/polling*') ? 'active-glass shadow-sm' : 'bg-hover-glass' }}"><i data-lucide="pie-chart" class="me-3 icon-sm"></i> <span>Jajak Pendapat</span></a></li>
        </ul>

        <small class="text-white text-opacity-25 text-uppercase fw-bold x-small mb-3 d-block ps-2">Komunikasi</small>
        <ul class="nav flex-column gap-1 mb-4">
            <li class="nav-item"><a href="{{ url('/operator/widget') }}" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center {{ request()->is('operator/widget*') ? 'active-glass shadow-sm' : 'bg-hover-glass' }}"><i data-lucide="layout-template" class="me-3 icon-sm"></i> <span>Widget Profil</span></a></li>
            <li class="nav-item"><a href="{{ url('/operator/pesan') }}" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center {{ request()->is('operator/pesan*') ? 'active-glass shadow-sm' : 'bg-hover-glass' }}"><i data-lucide="mail" class="me-3 icon-sm"></i> <span>Pesan Masuk</span></a></li>
        </ul>
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
    .hover-opacity:hover { opacity: 1 !important; transform: translateX(3px); transition: all 0.2s; }
    .x-small { font-size: 10px; letter-spacing: 1.5px; }
    .icon-xs { width: 12px; height: 12px; }
    /* Hide scrollbar for Chrome, Safari and Opera */
    .sidebar::-webkit-scrollbar { display: none; }
    /* Hide scrollbar for IE, Edge and Firefox */
    .sidebar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
