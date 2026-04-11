@extends('layouts.dashboard')
@section('title', 'Pengaturan Website')
@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <form action="{{ url('/admin/pengaturan') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <h5 class="fw-bold mb-3 border-bottom pb-2">Informasi Umum</h5>
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nama Desa</label>
                    <input type="text" name="nama_desa" class="form-control" value="{{ $settings['nama_desa'] ?? 'Desa Selorejo' }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Slogan / Tagline</label>
                    <input type="text" name="slogan" class="form-control" value="{{ $settings['slogan'] ?? 'Desa Wisata Petik Jeruk' }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Logo Website (Format PNG Transparan)</label>
                    @if(isset($settings['logo']) && $settings['logo'])
                        <div class="mb-2 bg-light p-2 rounded d-inline-block"><img src="{{ asset('storage/'.$settings['logo']) }}" style="height:50px;"></div>
                    @endif
                    <input type="file" name="logo" class="form-control" accept="image/png, image/jpeg">
                </div>
            </div>

            <h5 class="fw-bold mb-3 border-bottom pb-2">Kontak & Alamat</h5>
            <div class="row g-4 mb-4">
                <div class="col-md-12">
                    <label class="form-label fw-bold">Alamat Lengkap</label>
                    <input type="text" name="alamat" class="form-control" value="{{ $settings['alamat'] ?? '' }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Telepon Desa</label>
                    <input type="text" name="telepon_desa" class="form-control" value="{{ $settings['telepon_desa'] ?? '' }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">WhatsApp Resmi</label>
                    <input type="text" name="whatsapp" class="form-control" value="{{ $settings['whatsapp'] ?? '' }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Email Desa</label>
                    <input type="email" name="email_desa" class="form-control" value="{{ $settings['email_desa'] ?? '' }}">
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary bg-primary-custom px-5 hover-lift"><i data-lucide="save" class="me-1" style="width:18px;"></i> Simpan Pengaturan</button>
            </div>
        </form>
    </div>
</div>
@endsection
