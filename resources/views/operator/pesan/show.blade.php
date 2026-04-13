@extends('layouts.dashboard')
@section('title', 'Detail Pesan Masuk')
@section('content')

<div class="row justify-content-center text-start">
    <div class="col-lg-8 col-xl-7">
        <div class="mb-4">
            <a href="{{ url('/operator/pesan') }}" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm transition-all hover-lift">
                <i data-lucide="arrow-left" class="icon-sm me-1"></i> Kembali ke Kotak Masuk
            </a>
        </div>

        <div class="card border-0 shadow-lg rounded-4 overflow-hidden bg-white">
            <!-- Mail Header -->
            <div class="card-header bg-success bg-opacity-10 border-0 p-4 p-md-5">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                    <div class="d-flex align-items-center">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 60px; height: 60px;">
                            <span class="fs-3 fw-bold">{{ strtoupper(substr($pesan->nama, 0, 1)) }}</span>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-1 text-dark">{{ $pesan->nama }}</h4>
                            <div class="d-flex align-items-center text-muted small">
                                <i data-lucide="mail" class="icon-xs me-1"></i>
                                <a href="mailto:{{ $pesan->email }}" class="text-decoration-none text-success fw-medium">{{ $pesan->email }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-md-end">
                        <div class="badge bg-white text-success border border-success border-opacity-25 rounded-pill px-3 py-2 shadow-sm mb-2">
                            <i data-lucide="calendar" class="icon-xs me-1"></i> {{ $pesan->created_at->translatedFormat('d F Y, H:i') }}
                        </div>
                        <div class="small text-muted">{{ $pesan->created_at->diffForHumans() }}</div>
                    </div>
                </div>
            </div>

            <!-- Mail Body -->
            <div class="card-body p-4 p-md-5">
                <div class="mb-4 small fw-bold text-muted border-bottom pb-2">ISI PESAN / ASPIRASI:</div>
                <div class="pesan-content text-dark" style="line-height: 1.8; font-size: 1.1rem; white-space: pre-line;">
                   {!! nl2br(e($pesan->pesan)) !!}
                </div>
                
                <!-- Action Tools -->
                <div class="mt-5 pt-5 border-top text-center text-md-start">
                    <h6 class="fw-bold text-muted small mb-3">TINDAKAN OPERATOR:</h6>
                    <div class="d-flex flex-column flex-md-row gap-2">
                        <a href="mailto:{{ $pesan->email }}?subject=Balasan%20dari%20Desa%20Selorejo" class="btn btn-success rounded-pill px-5 py-2 fw-bold shadow-sm hover-lift border-0">
                            <i data-lucide="reply" class="icon-sm me-1"></i> BALAS VIA EMAIL
                        </a>
                        <button onclick="window.print()" class="btn btn-white border rounded-pill px-4 fw-bold hover-lift">
                            <i data-lucide="printer" class="icon-sm me-1"></i> CETAK PESAN
                        </button>
                    </div>
                    <p class="small text-muted mt-4 italic">
                        <i data-lucide="info" class="icon-xs text-info me-1"></i> Pesan ini sudah otomatis ditandai sebagai "Sudah Dibaca" setelah Anda membukanya.
                    </p>
                </div>
            </div>
        </div>

        <!-- Feedback UI -->
        <div class="mt-4 p-4 rounded-4 bg-light align-items-center d-flex border text-start">
            <div class="bg-white text-info rounded-circle p-2 me-3 shadow-sm border border-info border-opacity-10">
                <i data-lucide="shield-check" class="icon-sm"></i>
            </div>
            <div class="small text-muted fw-medium">
                Sistem E-Government Selorejo menjamin kerahasiaan data pengirim pesan demi keamanan dan kenyamanan komunikasi.
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        .navbar-dashboard, .sidebar-operator, .btn-light, .mt-5.pt-5, .mt-4 {
            display: none !important;
        }
        .container-fluid {
            width: 100% !important;
            padding: 0 !important;
        }
        .card {
            box-shadow: none !important;
            border: 1px solid #eee !important;
        }
    }
</style>
@endsection
