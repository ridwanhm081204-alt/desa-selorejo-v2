@extends('layouts.dashboard')
@section('title', 'Manajemen Backup Data')
@section('content')

<div class="row justify-content-center text-start">
    <div class="col-lg-10">
        
        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center p-3 animate-fade-in">
                <i data-lucide="check-circle" class="me-2 text-success"></i>
                <div class="fw-bold">{{ session('success') }}</div>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center p-3 animate-fade-in">
                <i data-lucide="alert-circle" class="me-2 text-danger"></i>
                <div class="fw-bold">{{ session('error') }}</div>
            </div>
        @endif

        <div class="row g-4">
            <!-- Backup Section -->
            <div class="col-md-6 text-start">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden text-start">
                    <div class="card-header bg-white p-4 border-bottom d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 text-success p-2 rounded-3 me-3">
                            <i data-lucide="download-cloud" class="icon-sm"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">Cadangkan Database</h5>
                            <small class="text-muted">Unduh salinan data sistem saat ini</small>
                        </div>
                    </div>
                    <div class="card-body p-4 p-md-5 text-center">
                        <div class="mb-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle mb-3" style="width: 100px; height: 100px;">
                                <i data-lucide="database" class="text-success" style="width: 50px; height: 50px;"></i>
                            </div>
                            <p class="text-muted small px-3">Cadangkan semua data berita, produk, wisata, dan pengaturan desa ke dalam file tunggal .sqlite</p>
                        </div>
                        
                        <form action="{{ url('/admin/backup') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success rounded-pill px-5 py-2 fw-bold shadow-sm hover-lift border-0">
                                <i data-lucide="download" class="icon-sm me-1"></i> MULAI BACKUP
                            </button>
                        </form>
                        
                        <div class="mt-4 pt-3 border-top small">
                            <span class="text-muted">Terakhir Backup:</span>
                            <div class="fw-bold text-dark mt-1">{{\App\Models\Setting::get('last_backup', 'Belum Pernah')}}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Import Section -->
            <div class="col-md-6 text-start text-start">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                    <div class="card-header bg-white p-4 border-bottom d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-3 me-3">
                            <i data-lucide="upload-cloud" class="icon-sm"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">Pemulihan (Import)</h5>
                            <small class="text-muted">Unggah file backup untuk memulihkan data</small>
                        </div>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <div class="alert alert-warning border-0 rounded-4 small mb-4 py-3">
                            <div class="d-flex align-items-start gap-2">
                                <i data-lucide="alert-triangle" class="text-warning icon-sm mt-1" style="flex-shrink:0;"></i>
                                <div class="fw-medium">Perhatian: Mengimpor database akan menimpa seluruh data saat ini secara permanen.</div>
                            </div>
                        </div>

                        <form action="{{ route('admin.backup.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label small fw-bold text-muted">UNGGAH FILE BACKUP (.sqlite) *</label>
                                <input type="file" name="backup_file" class="form-control rounded-3 bg-light border-0 shadow-none px-3 py-2" accept=".sqlite" required>
                                <small class="text-muted d-block mt-2 font-italic">Hanya mendukung format file SQLite yang dihasilkan dari sistem ini.</small>
                            </div>
                            
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-white border rounded-pill py-2 fw-bold shadow-sm hover-lift" onclick="return confirm('APAKAH ANDA YAKIN? Tindakan ini akan menimpa data saat ini. Sistem akan otomatis mencadangkan database lama sebelum proses dimulai.')">
                                    <i data-lucide="refresh-cw" class="icon-sm me-1 text-primary"></i> PROSES PEMULIHAN
                                </button>
                            </div>
                        </form>

                        <div class="mt-4 pt-4 border-top">
                            <div class="d-flex align-items-center text-muted small">
                                <i data-lucide="shield-check" class="icon-sm me-2 text-success"></i>
                                <span><b>Auto-Safe:</b> Database saat ini akan dicadangkan otomatis ke server sebelum ditimpa.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 p-4 rounded-4 bg-white shadow-sm border align-items-center d-flex text-start">
            <div class="bg-success bg-opacity-10 text-success p-2 rounded-circle me-3">
                <i data-lucide="info" class="icon-sm"></i>
            </div>
            <div class="small text-muted">
                File backup yang dihasilkan mencakup seluruh struktur database termasuk akun operator, konten profil desa, hingga log aktivitas. Simpan salinan di tempat yang aman.
            </div>
        </div>
    </div>
</div>

<style>
    .animate-fade-in { animation: fadeIn 0.5s ease-out; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection
