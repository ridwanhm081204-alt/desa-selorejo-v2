@extends('layouts.dashboard')
@section('title', 'Admin Control Panel')
@section('content')

<!-- Welcome Banner Admin -->
<div class="card border-0 shadow-sm rounded-4 mb-5 overflow-hidden position-relative text-start" style="background: linear-gradient(45deg, var(--primary-dark), var(--primary)) !important;">
    <div class="card-body p-4 p-md-5 text-white position-relative z-1">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="badge rounded-pill px-3 py-1 mb-3 small fw-bold" style="background-color: var(--color-tomato) !important; color: #fff !important; font-family: var(--font-body); border: none;">ROOT ACCESS</div>
                <h2 class="fw-bold mb-2" style="font-family: var(--font-heading);">Selamat Datang di Pusat Kendali Admin</h2>
                <p class="opacity-75 mb-0" style="font-family: var(--font-body);">Kelola otorisasi operator, audit sistem, dan konfigurasi inti portal Desa Selorejo dari satu titik pusat. Gunakan akses ini dengan bijak.</p>
            </div>
            <div class="col-md-4 text-md-end mt-4 mt-md-0">
                <div class="d-flex justify-content-md-end gap-2 text-md-end">
                    <a href="{{ url('/admin/pengaturan') }}" class="btn rounded-pill px-4 py-2 fw-bold shadow-sm hover-lift border-0" style="color: var(--text-on-accent) !important; background: var(--accent) !important; font-family: var(--font-heading);">
                        <i data-lucide="settings" class="icon-sm me-1"></i> SETTINGS
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Subtle Decorative Pattern -->
    <div class="position-absolute top-50 start-100 translate-middle opacity-10 rounded-circle" style="width: 400px; height: 400px; background-color: var(--accent) !important;"></div>
</div>

<div class="row g-4 mb-5 text-start" style="font-family: var(--font-body);">
    <!-- Card Statistik Admin -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 p-4 bg-white hover-lift transition-all" style="border-bottom: 4px solid var(--color-tomato) !important;">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h6 class="text-muted mb-1 small fw-bold text-uppercase">Otorisasi Operator</h6>
                    <h2 class="fw-bold mb-0 text-dark">{{ $jumlahOperator }} <span class="fs-6 fw-normal text-muted">Akun</span></h2>
                </div>
                <div class="p-3 rounded-4" style="background-color: rgba(217,48,37,0.1) !important; color: var(--color-tomato) !important;">
                    <i data-lucide="users" style="width:28px;height:28px;"></i>
                </div>
            </div>
            <a href="{{ url('/admin/operator') }}" class="small text-decoration-none d-flex align-items-center fw-bold" style="color: var(--color-tomato) !important;">KELOLA AKSES OPERATOR <i data-lucide="chevron-right" class="icon-xs ms-1"></i></a>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 p-4 bg-white hover-lift transition-all" style="border-bottom: 4px solid var(--color-forest) !important;">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h6 class="text-muted mb-1 small fw-bold text-uppercase">Audit Jejak Sistem</h6>
                    <h2 class="fw-bold mb-0 text-dark">{{ $jumlahLog }} <span class="fs-6 fw-normal text-muted">Log</span></h2>
                </div>
                <div class="p-3 rounded-4" style="background-color: rgba(26,92,56,0.1) !important; color: var(--color-forest) !important;">
                    <i data-lucide="activity" style="width:28px;height:28px;"></i>
                </div>
            </div>
            <a href="{{ url('/admin/log') }}" class="small text-decoration-none d-flex align-items-center fw-bold" style="color: var(--color-forest) !important;">LIHAT AUDIT TRAIL <i data-lucide="chevron-right" class="icon-xs ms-1"></i></a>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 p-4 bg-white hover-lift transition-all" style="border-bottom: 4px solid var(--color-kiwi) !important;">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h6 class="text-muted mb-1 small fw-bold text-uppercase">Integritas Data</h6>
                    <h2 class="fw-bold mb-0 text-dark">Stable</h2>
                </div>
                <div class="p-3 rounded-4" style="background-color: rgba(124,181,24,0.1) !important; color: var(--color-kiwi) !important;">
                    <i data-lucide="database" style="width:28px;height:28px;"></i>
                </div>
            </div>
            <div class="small text-muted mb-1">Terakhir Backup:</div>
            <div class="d-flex align-items-center justify-content-between">
                <span class="fw-bold small text-dark">{{ $lastBackup }}</span>
                <a href="{{ url('/admin/backup') }}" class="small text-decoration-none fw-bold" style="color: var(--color-kiwi) !important;">BACKUP <i data-lucide="arrow-right" class="icon-xs"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white text-start" style="border-left: 5px solid var(--color-forest) !important;">
    <div class="d-flex align-items-center">
        <div class="bg-light rounded-circle p-3 me-4" style="color: var(--color-forest) !important;">
            <i data-lucide="shield-check" style="width:32px; height:32px;"></i>
        </div>
        <div>
            <h5 class="fw-bold mb-1" style="font-family: var(--font-heading);">Keamanan & Kerahasiaan Data</h5>
            <p class="text-muted mb-0 lh-lg" style="font-family: var(--font-body);">Sebagai Administrator, Anda memiliki tanggung jawab penuh atas kerahasiaan data penduduk dan pengaturan portal. Segala perubahan yang dilakukan pada modul pengaturan akan berdampak langsung ke seluruh ekosistem website Desa Selorejo.</p>
        </div>
    </div>
</div>
@endsection
