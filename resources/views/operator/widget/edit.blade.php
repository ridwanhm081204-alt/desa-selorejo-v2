@extends('layouts.dashboard')
@section('title', 'Pengaturan Widget & Kontak')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                <div class="bg-success text-white rounded-3 p-2 me-3">
                    <i data-lucide="layout-template" style="width:22px;height:22px;"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0">Pengaturan Widget & Kontak</h5>
                    <small class="text-muted">Data ini tampil di Footer & halaman Kontak publik</small>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center gap-2 mb-4">
                    <i data-lucide="check-circle" style="width:16px;"></i> {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('operator.widget.update') }}" method="POST">
                @csrf

                <h6 class="fw-bold text-muted mb-3 text-uppercase" style="font-size:0.75rem; letter-spacing:1px;">
                    <i data-lucide="phone" class="me-1" style="width:14px;"></i> Informasi Kontak Resmi
                </h6>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Telepon Kantor</label>
                        <input type="text" name="telepon" class="form-control" value="{{ $settings['telepon'] ?? '' }}" placeholder="contoh: (0341) 123456">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Nomor WhatsApp</label>
                        <input type="text" name="whatsapp" class="form-control" value="{{ $settings['whatsapp'] ?? '' }}" placeholder="contoh: 08123456789">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Email Desa</label>
                        <input type="email" name="email" class="form-control" value="{{ $settings['email'] ?? '' }}" placeholder="contoh: desa@selorejo.id">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Jam Kerja</label>
                        <input type="text" name="jam_kerja" class="form-control" value="{{ $settings['jam_kerja'] ?? '' }}" placeholder="contoh: Senin-Jumat: 08.00-15.00">
                    </div>
                </div>

                <hr class="my-4">

                <h6 class="fw-bold text-muted mb-3 text-uppercase" style="font-size:0.75rem; letter-spacing:1px;">
                    <i data-lucide="share-2" class="me-1" style="width:14px;"></i> Media Sosial
                </h6>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">
                            <i data-lucide="facebook" class="me-1" style="width:14px;"></i> Facebook URL
                        </label>
                        <input type="url" name="facebook" class="form-control" value="{{ $settings['facebook'] ?? '' }}" placeholder="https://facebook.com/...">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">
                            <i data-lucide="instagram" class="me-1" style="width:14px;"></i> Instagram URL
                        </label>
                        <input type="url" name="instagram" class="form-control" value="{{ $settings['instagram'] ?? '' }}" placeholder="https://instagram.com/...">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold small">
                            <i data-lucide="youtube" class="me-1" style="width:14px;"></i> YouTube URL
                        </label>
                        <input type="url" name="youtube" class="form-control" value="{{ $settings['youtube'] ?? '' }}" placeholder="https://youtube.com/...">
                    </div>
                </div>

                <button type="submit" class="btn btn-success px-4">
                    <i data-lucide="save" class="me-1" style="width:16px;"></i> Simpan Pengaturan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
