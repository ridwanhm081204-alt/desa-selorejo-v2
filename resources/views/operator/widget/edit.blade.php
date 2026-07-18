@extends('layouts.dashboard')
@section('title', 'Widget & Kontak')
@section('content')

<div class="row justify-content-center text-start">
    <div class="col-lg-10 col-xl-8">
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center p-3 animate-fade-in">
                <i data-lucide="check-circle" class="me-2 text-success"></i>
                <div class="fw-bold">{{ session('success') }}</div>
            </div>
        @endif

        <!-- CMS Header Halaman Kontak (Banner) -->
        <div class="dash-card bg-white p-4 mb-4 border-top border-4 border-success shadow-sm rounded-4">
            <h6 class="fw-bold mb-3 d-flex align-items-center"><i data-lucide="image" class="text-success me-2 icon-sm"></i> Kustomisasi Header Kontak (Banner)</h6>
            <form action="{{ route('operator.widget.hero') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="small fw-bold text-muted mb-1">Judul Utama Halaman</label>
                        <input type="text" name="title" class="form-control rounded-3" value="{{ $hero['title'] ?? 'Hubungi Kami' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="small fw-bold text-muted mb-1">Sub-Judul / Deskripsi Singkat</label>
                        <input type="text" name="subtitle" class="form-control rounded-3" value="{{ $hero['subtitle'] ?? 'Kami siap melayani dan mendengarkan aspirasi Anda.' }}">
                    </div>
                    <div class="col-md-8">
                        <label class="small fw-bold text-muted mb-1">Ikon Banner (Lucide Name)</label>
                        <input type="text" name="icon" class="form-control rounded-3" value="{{ $hero['icon'] ?? 'phone-call' }}">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-success w-100 rounded-3 shadow-sm border-0 fw-bold border-0">SIMPAN HEADER</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Main Settings Sidebar-like Cards -->
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 overflow-hidden">
            <div class="d-flex align-items-center mb-5 border-bottom pb-4">
                <div class="bg-success text-white rounded-circle p-3 me-3 shadow-sm">
                    <i data-lucide="layout-template" style="width:24px;height:24px;"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0">Informasi Kontak & Sosial</h5>
                    <small class="text-muted">Data ini terintegrasi ke Footer & Halaman Kontak</small>
                </div>
            </div>

            <form action="{{ route('operator.widget.update') }}" method="POST">
                @csrf

                <div class="row g-4">
                    <!-- Kolom Kiri: Kontak -->
                    <div class="col-md-6 border-end pe-md-4">
                        <h6 class="fw-bold text-success mb-4 d-flex align-items-center">
                            <i data-lucide="phone" class="me-2 icon-sm"></i> Saluran Komunikasi
                        </h6>
                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted small">Telepon Kantor (Landline)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i data-lucide="phone-forwarded" class="icon-xs"></i></span>
                                <input type="text" name="telepon" class="form-control border-0 bg-light" value="{{ $settings['telepon'] ?? '' }}" placeholder="(0341) xxxx">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted small">Nomor WhatsApp Desa</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i data-lucide="message-circle" class="icon-xs text-success"></i></span>
                                <input type="text" name="whatsapp" class="form-control border-0 bg-light" value="{{ $settings['whatsapp'] ?? '' }}" placeholder="0812 xxx">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted small">E-mail Resmi</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i data-lucide="mail" class="icon-xs"></i></span>
                                <input type="email" name="email" class="form-control border-0 bg-light" value="{{ $settings['email'] ?? '' }}" placeholder="desa@selorejo.id">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted small">Jam Operasional</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i data-lucide="clock" class="icon-xs"></i></span>
                                <input type="text" name="jam_kerja" class="form-control border-0 bg-light" value="{{ $settings['jam_kerja'] ?? '' }}" placeholder="Senin-Jumat: 08.00-15.00">
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Sosmed -->
                    <div class="col-md-6 ps-md-4">
                        <h6 class="fw-bold text-primary mb-4 d-flex align-items-center">
                            <i data-lucide="share-2" class="me-2 icon-sm"></i> Jejaring Sosial
                        </h6>
                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted small">Facebook Profile/Page URL</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i data-lucide="facebook" class="icon-xs text-primary"></i></span>
                                <input type="url" name="facebook" class="form-control border-0 bg-light" value="{{ $settings['facebook'] ?? '' }}" placeholder="https://facebook.com/...">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted small">Instagram Profile URL</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i data-lucide="instagram" class="icon-xs text-danger"></i></span>
                                <input type="url" name="instagram" class="form-control border-0 bg-light" value="{{ $settings['instagram'] ?? '' }}" placeholder="https://instagram.com/...">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted small">YouTube Channel URL</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i data-lucide="youtube" class="icon-xs text-danger"></i></span>
                                <input type="url" name="youtube" class="form-control border-0 bg-light" value="{{ $settings['youtube'] ?? '' }}" placeholder="https://youtube.com/...">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted small">TikTok Profile URL</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i data-lucide="tiktok" class="icon-xs text-dark"></i></span>
                                <input type="url" name="tiktok" class="form-control border-0 bg-light" value="{{ $settings['tiktok'] ?? '' }}" placeholder="https://tiktok.com/@...">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5 pt-4 border-top text-center">
                    <button type="submit" class="btn btn-success px-5 py-3 rounded-pill fw-bold hover-lift shadow border-0">
                        <i data-lucide="save" class="me-2"></i> SIMPAN SEMUA PENGATURAN
                    </button>
                    <p class="small text-muted mt-3 mb-0">Perubahan akan langsung berdampak pada informasi di bagian bawah (Footer) website.</p>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .animate-fade-in { animation: fadeIn 0.5s ease-out; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection
