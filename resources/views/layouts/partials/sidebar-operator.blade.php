<div class="sidebar vh-100 position-fixed overflow-auto py-4 px-3 d-flex flex-column" style="width: 260px; left: 0; top: 0; background: linear-gradient(180deg, var(--primary-dark) 0%, var(--primary) 100%); z-index: 1050; border-right: 1px solid rgba(255,255,255,0.05);">
    <div class="text-center mb-5 px-3">
        <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-10 rounded-circle mb-3 shadow-sm border border-white border-opacity-10" style="width: 70px; height: 70px; overflow: hidden;">
            <img src="{{ asset('images/logo_desa.png') }}?v={{ file_exists(public_path('images/logo_desa.png')) ? filemtime(public_path('images/logo_desa.png')) : '1' }}" alt="Logo Desa" style="width: 45px; height: 45px; object-fit: contain;">
        </div>
        <h6 class="mt-2 text-white fw-bold mb-0">Operator Panel</h6>
        <small class="text-white text-opacity-50 small">{{\App\Models\Setting::get('nama_desa', 'Desa Selorejo')}}</small>
    </div>
    
    <div class="nav-section px-2 flex-grow-1">
        
        <ul class="nav flex-column gap-1 mb-4">
            <li class="nav-item">
                <a href="{{ url('/operator/dashboard') }}" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center {{ request()->is('operator/dashboard') ? 'active-glass shadow-sm' : 'bg-hover-glass' }}">
                    <i data-lucide="layout-dashboard" class="me-3 icon-sm"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#profilCollapse" data-bs-toggle="collapse" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center justify-content-between {{ request()->is('operator/profil*') ? 'bg-white bg-opacity-10' : 'bg-hover-glass' }}">
                    <div class="d-flex align-items-center">
                        <i data-lucide="building" class="me-3 icon-sm"></i> <span>Profil Desa</span>
                    </div>
                    <i data-lucide="chevron-down" class="icon-xs opacity-50"></i>
                </a>
                <div class="collapse {{ request()->is('operator/profil*') ? 'show' : '' }}" id="profilCollapse">
                    <ul class="nav flex-column ms-4 mt-2 mb-2 gap-1 border-start border-white border-opacity-10 ps-3">
                        <li><a href="{{ route('operator.profil.sejarah') }}" class="nav-link py-1 text-white text-opacity-75 small {{ request()->is('operator/profil/sejarah*') ? 'text-white fw-bold opacity-100' : 'hover-opacity' }}">Sejarah</a></li>
                        <li><a href="{{ route('operator.profil.visi-misi') }}" class="nav-link py-1 text-white text-opacity-75 small {{ request()->is('operator/profil/visi-misi*') ? 'text-white fw-bold opacity-100' : 'hover-opacity' }}">Visi & Misi</a></li>
                        <li><a href="{{ route('operator.profil.geografis') }}" class="nav-link py-1 text-white text-opacity-75 small {{ request()->is('operator/profil/geografis*') ? 'text-white fw-bold opacity-100' : 'hover-opacity' }}">Geografis</a></li>
                        <li><a href="{{ route('operator.profil.peta') }}" class="nav-link py-1 text-white text-opacity-75 small {{ request()->is('operator/profil/peta*') ? 'text-white fw-bold opacity-100' : 'hover-opacity' }}">Peta & Wilayah</a></li>
                    </ul>
                </div>
            </li>
            
            <li class="nav-item">
                <a href="#pemerintahanCollapse" data-bs-toggle="collapse" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center justify-content-between {{ request()->is('operator/struktur*') || request()->is('operator/bpd*') || request()->is('operator/lembaga*') || request()->is('operator/perangkat-rt-rw*') || request()->is('operator/produkhukum*') ? 'bg-white bg-opacity-10' : 'bg-hover-glass' }}">
                    <div class="d-flex align-items-center">
                        <i data-lucide="users-2" class="me-3 icon-sm"></i> <span>Pemerintahan</span>
                    </div>
                    <i data-lucide="chevron-down" class="icon-xs opacity-50"></i>
                </a>
                <div class="collapse {{ request()->is('operator/struktur*') || request()->is('operator/bpd*') || request()->is('operator/lembaga*') || request()->is('operator/perangkat-rt-rw*') || request()->is('operator/produkhukum*') ? 'show' : '' }}" id="pemerintahanCollapse">
                    <ul class="nav flex-column ms-4 mt-2 mb-2 gap-1 border-start border-white border-opacity-10 ps-3">
                        <li><a href="{{ url('/operator/struktur') }}" class="nav-link py-1 text-white text-opacity-75 small {{ request()->is('operator/struktur*') ? 'text-white fw-bold opacity-100' : 'hover-opacity' }}">Struktur Organisasi</a></li>
                        <li><a href="{{ url('/operator/bpd') }}" class="nav-link py-1 text-white text-opacity-75 small {{ request()->is('operator/bpd*') ? 'text-white fw-bold opacity-100' : 'hover-opacity' }}">BPD</a></li>
                        <li><a href="{{ url('/operator/lembaga') }}" class="nav-link py-1 text-white text-opacity-75 small {{ request()->is('operator/lembaga*') ? 'text-white fw-bold opacity-100' : 'hover-opacity' }}">Lembaga Desa</a></li>
                        <li><a href="{{ url('/operator/perangkat-rt-rw') }}" class="nav-link py-1 text-white text-opacity-75 small {{ request()->is('operator/perangkat-rt-rw*') ? 'text-white fw-bold opacity-100' : 'hover-opacity' }}">Perangkat RT & RW</a></li>
                        <li><a href="{{ url('/operator/produkhukum') }}" class="nav-link py-1 text-white text-opacity-75 small {{ request()->is('operator/produkhukum*') ? 'text-white fw-bold opacity-100' : 'hover-opacity' }}">Produk Hukum</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a href="#layananCollapse" data-bs-toggle="collapse" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center justify-content-between {{ request()->is('operator/layanan*') ? 'bg-white bg-opacity-10' : 'bg-hover-glass' }}">
                    <div class="d-flex align-items-center">
                        <i data-lucide="file-text" class="me-3 icon-sm"></i> <span>Layanan Kependudukan</span>
                    </div>
                    @php $pendingCount = \App\Models\Pengajuan::where('status', 'diajukan')->count(); @endphp
                    <div class="d-flex align-items-center">
                        @if($pendingCount > 0) <span class="badge bg-danger me-2">{{ $pendingCount }}</span> @endif
                        <i data-lucide="chevron-down" class="icon-xs opacity-50"></i>
                    </div>
                </a>
                <div class="collapse {{ request()->is('operator/layanan*') ? 'show' : '' }}" id="layananCollapse">
                    <ul class="nav flex-column ms-4 mt-2 mb-2 gap-1 border-start border-white border-opacity-10 ps-3">
                        <li><a href="{{ route('operator.layanan.index') }}" class="nav-link py-1 text-white text-opacity-75 small {{ request()->is('operator/layanan') || (request()->is('operator/layanan/*') && !request()->is('operator/layanan-konten*')) ? 'text-white fw-bold opacity-100' : 'hover-opacity' }}">Verifikasi Berkas</a></li>
                        <li><a href="{{ url('/operator/layanan-konten') }}" class="nav-link py-1 text-white text-opacity-75 small {{ request()->is('operator/layanan-konten*') ? 'text-white fw-bold opacity-100' : 'hover-opacity' }}">Konten Layanan</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a href="#informasiCollapse" data-bs-toggle="collapse" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center justify-content-between {{ request()->is('operator/berita*') || request()->is('operator/galeri*') || request()->is('operator/wisata*') ? 'bg-white bg-opacity-10' : 'bg-hover-glass' }}">
                    <div class="d-flex align-items-center">
                        <i data-lucide="radio" class="me-3 icon-sm"></i> <span>Informasi Publik</span>
                    </div>
                    <i data-lucide="chevron-down" class="icon-xs opacity-50"></i>
                </a>
                <div class="collapse {{ request()->is('operator/berita*') || request()->is('operator/galeri*') || request()->is('operator/wisata*') ? 'show' : '' }}" id="informasiCollapse">
                    <ul class="nav flex-column ms-4 mt-2 mb-2 gap-1 border-start border-white border-opacity-10 ps-3">
                        <li><a href="{{ url('/operator/berita') }}" class="nav-link py-1 text-white text-opacity-75 small {{ request()->is('operator/berita*') ? 'text-white fw-bold opacity-100' : 'hover-opacity' }}">Berita</a></li>
                        <li><a href="{{ url('/operator/galeri') }}" class="nav-link py-1 text-white text-opacity-75 small {{ request()->is('operator/galeri*') ? 'text-white fw-bold opacity-100' : 'hover-opacity' }}">Galeri</a></li>
                        <li><a href="{{ url('/operator/wisata') }}" class="nav-link py-1 text-white text-opacity-75 small {{ request()->is('operator/wisata*') ? 'text-white fw-bold opacity-100' : 'hover-opacity' }}">Wisata</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a href="#produkCollapse" data-bs-toggle="collapse" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center justify-content-between {{ request()->is('operator/produk*') ? 'bg-white bg-opacity-10' : 'bg-hover-glass' }}">
                    <div class="d-flex align-items-center">
                        <i data-lucide="shopping-bag" class="me-3 icon-sm"></i> <span>Ekonomi & Produk</span>
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

            <li class="nav-item">
                <a href="#dataCollapse" data-bs-toggle="collapse" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center justify-content-between {{ request()->is('operator/statistik*') || request()->is('operator/apbdes*') || request()->is('operator/polling*') ? 'bg-white bg-opacity-10' : 'bg-hover-glass' }}">
                    <div class="d-flex align-items-center">
                        <i data-lucide="bar-chart-3" class="me-3 icon-sm"></i> <span>Data & Transparansi</span>
                    </div>
                    <i data-lucide="chevron-down" class="icon-xs opacity-50"></i>
                </a>
                <div class="collapse {{ request()->is('operator/statistik*') || request()->is('operator/apbdes*') || request()->is('operator/polling*') ? 'show' : '' }}" id="dataCollapse">
                    <ul class="nav flex-column ms-4 mt-2 mb-2 gap-1 border-start border-white border-opacity-10 ps-3">
                        <li><a href="{{ url('/operator/statistik') }}" class="nav-link py-1 text-white text-opacity-75 small {{ request()->is('operator/statistik*') ? 'text-white fw-bold opacity-100' : 'hover-opacity' }}">Statistik</a></li>
                        <li><a href="{{ url('/operator/apbdes') }}" class="nav-link py-1 text-white text-opacity-75 small {{ request()->is('operator/apbdes*') ? 'text-white fw-bold opacity-100' : 'hover-opacity' }}">APBDes</a></li>
                        <li><a href="{{ url('/operator/polling') }}" class="nav-link py-1 text-white text-opacity-75 small {{ request()->is('operator/polling*') ? 'text-white fw-bold opacity-100' : 'hover-opacity' }}">Jajak Pendapat</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a href="#komunikasiCollapse" data-bs-toggle="collapse" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center justify-content-between {{ request()->is('operator/widget*') || request()->is('operator/pesan*') ? 'bg-white bg-opacity-10' : 'bg-hover-glass' }}">
                    <div class="d-flex align-items-center">
                        <i data-lucide="message-square" class="me-3 icon-sm"></i> <span>Komunikasi</span>
                    </div>
                    <i data-lucide="chevron-down" class="icon-xs opacity-50"></i>
                </a>
                <div class="collapse {{ request()->is('operator/widget*') || request()->is('operator/pesan*') ? 'show' : '' }}" id="komunikasiCollapse">
                    <ul class="nav flex-column ms-4 mt-2 mb-2 gap-1 border-start border-white border-opacity-10 ps-3">
                        <li><a href="{{ url('/operator/widget') }}" class="nav-link py-1 text-white text-opacity-75 small {{ request()->is('operator/widget*') ? 'text-white fw-bold opacity-100' : 'hover-opacity' }}">Widget Profil</a></li>
                        <li><a href="{{ url('/operator/pesan') }}" class="nav-link py-1 text-white text-opacity-75 small {{ request()->is('operator/pesan*') ? 'text-white fw-bold opacity-100' : 'hover-opacity' }}">Pesan Masuk</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>

    <!-- Profil KKN di bagian paling bawah -->
    <div class="mt-auto pt-3 border-top border-white border-opacity-10">
        <a href="{{ url('/operator/kkn') }}" class="nav-link py-2 px-3 text-white rounded-3 d-flex align-items-center {{ request()->is('operator/kkn*') ? 'active-glass shadow-sm' : 'bg-hover-glass' }}" style="border: 1px solid rgba(255,255,255,0.1);">
            <i data-lucide="graduation-cap" class="me-3 icon-sm"></i> <span class="fw-bold small">Profil KKN 178</span>
        </a>
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
