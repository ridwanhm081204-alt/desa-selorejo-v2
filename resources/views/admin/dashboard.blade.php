@extends('layouts.dashboard')
@section('title', 'Admin Control Panel')
@section('content')
<div class="row g-4 mb-5">
    <!-- Card Statistik -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 p-4 bg-white border-bottom border-4 border-danger">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted mb-2">Total Akun Operator</h6>
                    <h2 class="fw-bold mb-0">{{ $jumlahOperator }}</h2>
                </div>
                <div class="bg-danger text-white p-3 rounded-3 opacity-75">
                    <i data-lucide="users"></i>
                </div>
            </div>
            <a href="{{ url('/admin/operator') }}" class="small text-decoration-none mt-4 d-block text-danger fw-bold">Kelola Akses Operator &rarr;</a>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 p-4 bg-white border-bottom border-4 border-primary">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted mb-2">Total Aktivitas Log</h6>
                    <h2 class="fw-bold mb-0">{{ $jumlahLog }}</h2>
                </div>
                <div class="bg-primary text-white p-3 rounded-3 opacity-75">
                    <i data-lucide="clipboard-list"></i>
                </div>
            </div>
            <a href="{{ url('/admin/log') }}" class="small text-decoration-none mt-4 d-block text-primary fw-bold">Lihat Semua Aktivitas &rarr;</a>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 p-4 bg-white border-bottom border-4 border-success">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted mb-2">Terakhir Backup Database</h6>
                    <h5 class="fw-bold mb-0 text-dark">{{ $lastBackup }}</h5>
                </div>
                <div class="bg-success text-white p-3 rounded-3 opacity-75">
                    <i data-lucide="database"></i>
                </div>
            </div>
            <a href="{{ url('/admin/backup') }}" class="small text-decoration-none mt-4 d-block text-success fw-bold">Manajemen Backup &rarr;</a>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 p-4 glass-panel border-start border-4 border-dark">
    <div class="d-flex align-items-center">
        <i data-lucide="shield-alert" class="text-danger me-3" style="width:40px; height:40px;"></i>
        <div>
            <h5 class="fw-bold mb-1">Pusat Kendali Administrasi (Root)</h5>
            <p class="text-muted mb-0">Perhatian: Anda memiliki akses penuh terhadap manajemen user, sistem file, dan pengaturan inti website. Segala tindakan akun Admin akan diaudit.</p>
        </div>
    </div>
</div>
@endsection
