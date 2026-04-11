@extends('layouts.public')
@section('title', 'Kontak Kami')
@section('breadcrumb')
    <li class="breadcrumb-item active">Kontak</li>
@endsection
@section('content')
<div class="page-header text-center">
    <h1 class="fw-bold">Hubungi Kami</h1>
    <p class="lead">Kami siap melayani dan mendengarkan aspirasi Anda.</p>
</div>
<div class="container mb-5">
    <div class="row g-5">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 glass-panel border-top border-4 border-success">
                <h4 class="fw-bold mb-4 text-success">Informasi Kontak</h4>
                
                <div class="d-flex align-items-start mb-3">
                    <div class="bg-success text-white p-2 rounded-circle me-3"><i data-lucide="map-pin"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1">Alamat</h6>
                        <p class="text-muted small">{{\App\Models\Setting::get('alamat', 'Jl. Selorejo, Kec. Dau')}}</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-start mb-3">
                    <div class="bg-success text-white p-2 rounded-circle me-3"><i data-lucide="phone"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1">Telepon / WhatsApp</h6>
                        <p class="text-muted small mb-0">{{\App\Models\Setting::get('telepon_desa', '(0341) 000')}}</p>
                        <p class="text-muted small">{{\App\Models\Setting::get('whatsapp', '08123')}}</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-start mb-3">
                    <div class="bg-success text-white p-2 rounded-circle me-3"><i data-lucide="mail"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1">Email</h6>
                        <p class="text-muted small">{{\App\Models\Setting::get('email_desa', 'info@selorejo.desa.id')}}</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-start text-white p-3 rounded-3 mt-4" style="background: var(--primary);">
                    <i data-lucide="clock" class="me-2 mt-1"></i>
                    <div>
                        <h6 class="fw-bold mb-1">Jam Pelayanan</h6>
                        <p class="mb-0 small">Senin - Jumat: 08.00 - 15.00 WIB</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-7">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h4 class="fw-bold mb-4">Kirim Pesan Langsung</h4>
                
                @if(session('success'))
                    <div class="alert alert-success d-flex align-items-center mb-4">
                        <i data-lucide="check-circle" class="me-2"></i> {{ session('success') }}
                    </div>
                @endif
                
                <form action="{{ route('kontak.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">Alamat Email</label>
                            <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted">Isi Pesan/Aspirasi</label>
                            <textarea name="pesan" class="form-control" rows="5" placeholder="Tuliskan pesan Anda di sini..." required></textarea>
                        </div>
                        <div class="col-12 mt-4 text-end">
                            <button type="submit" class="btn btn-primary bg-primary-custom px-4 hover-lift"><i data-lucide="send" class="me-1" style="width:16px;"></i> Kirim Pesan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
