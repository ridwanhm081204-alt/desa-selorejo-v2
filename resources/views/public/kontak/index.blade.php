@extends('layouts.public')
@section('title', 'Kontak Kami')
@section('breadcrumb')
    <li class="breadcrumb-item active" style="font-family: var(--font-body);">Kontak</li>
@endsection
@section('content')
@include('layouts.partials.page-hero', [
    'title' => $hero['title'] ?? 'Hubungi Kami',
    'subtitle' => $hero['subtitle'] ?? 'Kami siap melayani dan mendengarkan aspirasi Anda.',
    'icon' => $hero['icon'] ?? 'phone-call'
])
<div class="container mb-5">
    <div class="row g-5">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4" style="border-top: 4px solid var(--color-forest) !important; font-family: var(--font-body);">
                 <h4 class="fw-bold mb-4 d-flex align-items-center" style="color: var(--color-forest) !important; font-family: var(--font-heading);">
                    <i data-lucide="info" class="me-2 text-success icon-md" style="width: 24px; height: 24px;"></i> Informasi Kontak
                </h4>
                
                <div class="d-flex align-items-start mb-3">
                    <div class="text-white p-2 rounded-circle me-3" style="background-color: var(--color-forest) !important;"><i data-lucide="map-pin"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1" style="font-family: var(--font-heading);">Alamat</h6>
                        <p class="text-muted small">{{\App\Models\Setting::get('alamat', 'Jl. Selorejo, Kec. Dau')}}</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-start mb-3">
                    <div class="text-white p-2 rounded-circle me-3" style="background-color: var(--color-forest) !important;"><i data-lucide="phone"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1" style="font-family: var(--font-heading);">Telepon / WhatsApp</h6>
                        <p class="text-muted small mb-0">{{\App\Models\Setting::get('telepon')}}</p>
                        <p class="text-muted small">DAU: {{\App\Models\Setting::get('whatsapp')}}</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-start mb-3">
                    <div class="text-white p-2 rounded-circle me-3" style="background-color: var(--color-forest) !important;"><i data-lucide="mail"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1" style="font-family: var(--font-heading);">Email</h6>
                        <p class="text-muted small">{{\App\Models\Setting::get('email')}}</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-start text-white p-3 rounded-3 mt-4" style="background-color: var(--color-forest) !important;">
                    <i data-lucide="clock" class="me-2 mt-1" style="color: var(--accent) !important;"></i>
                    <div>
                        <h6 class="fw-bold mb-1 text-white" style="font-family: var(--font-heading);">Jam Pelayanan</h6>
                        <p class="mb-0 small text-white" style="color: #ffffff !important;">{{\App\Models\Setting::get('jam_kerja')}}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-7">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h4 class="fw-bold mb-4 d-flex align-items-center" style="font-family: var(--font-heading); color: var(--color-forest) !important;">
                    <i data-lucide="mail" class="me-2 text-success icon-md" style="width: 24px; height: 24px;"></i> Kirim Pesan Langsung
                </h4>
                
                @if(session('success'))
                    <div class="alert alert-success d-flex align-items-center mb-4" style="font-family: var(--font-body);">
                        <i data-lucide="check-circle" class="me-2"></i> {{ session('success') }}
                    </div>
                @endif
                
                <form action="{{ route('kontak.store') }}" method="POST">
                    @csrf
                    <div class="row g-3" style="font-family: var(--font-body);">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted"><i data-lucide="user" class="icon-sm me-1" style="color: var(--color-forest) !important;"></i> Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" id="input-nama" class="form-control rounded-pill px-3" placeholder="Masukkan nama" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted"><i data-lucide="mail" class="icon-sm me-1" style="color: var(--color-forest) !important;"></i> Alamat Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="input-email" class="form-control rounded-pill px-3" placeholder="name@example.com" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted"><i data-lucide="message-square" class="icon-sm me-1" style="color: var(--color-forest) !important;"></i> Isi Pesan/Aspirasi <span class="text-danger">*</span></label>
                            <textarea name="pesan" id="input-pesan" class="form-control rounded-4 px-3" rows="5" placeholder="Tuliskan pesan Anda di sini..." required></textarea>
                        </div>
                        <div class="col-12 mt-4 text-end">
                            <button type="submit" id="btn-kirim" class="btn px-4 hover-lift rounded-pill" style="background-color: var(--color-forest) !important; color: #fff !important; font-family: var(--font-heading); border: none;" disabled><i data-lucide="send" class="me-1" style="width:16px;"></i> Kirim Pesan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputNama = document.getElementById('input-nama');
        const inputEmail = document.getElementById('input-email');
        const inputPesan = document.getElementById('input-pesan');
        const btnKirim = document.getElementById('btn-kirim');

        function checkFormValid() {
            if (inputNama.value.trim() !== '' && inputEmail.value.trim() !== '' && inputPesan.value.trim() !== '') {
                btnKirim.removeAttribute('disabled');
            } else {
                btnKirim.setAttribute('disabled', 'true');
            }
        }

        // Jalankan pengecekan real-time
        inputNama.addEventListener('input', checkFormValid);
        inputEmail.addEventListener('input', checkFormValid);
        inputPesan.addEventListener('input', checkFormValid);
        
        // Pengecekan saat Load awal (misal browser auto-fill)
        checkFormValid();
    });
</script>
@endpush
