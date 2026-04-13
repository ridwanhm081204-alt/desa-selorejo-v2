@extends('layouts.dashboard')
@section('title', isset($operator) ? 'Edit Pengguna Operator' : 'Registrasi Operator Baru')
@section('content')

<div class="row justify-content-center text-start">
    <div class="col-lg-8 col-xl-7">
        <div class="mb-4">
            <a href="{{ url('/admin/operator') }}" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm transition-all hover-lift">
                <i data-lucide="arrow-left" class="icon-sm me-1"></i> Kembali ke Daftar
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <!-- Header Card -->
            <div class="card-header bg-white border-0 p-4 d-flex align-items-center border-bottom">
                <div class="bg-danger bg-opacity-10 text-danger p-2 rounded-3 me-3">
                    <i data-lucide="{{ isset($operator) ? 'user-cog' : 'user-plus' }}" class="icon-sm"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0 text-dark">{{ isset($operator) ? 'Ubah Informasi Akun' : 'Buat Akun Operator Baru' }}</h5>
                    <small class="text-muted">Akses ini terbatas untuk pengelolaan konten fitur desa</small>
                </div>
            </div>

            <div class="card-body p-4 p-md-5">
                <form action="{{ isset($operator) ? url('/admin/operator/'.$operator->id) : url('/admin/operator') }}" method="POST">
                    @csrf
                    @if(isset($operator)) @method('PUT') @endif
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted small text-uppercase">NAMA LENGKAP OPERATOR <span class="text-danger">*</span></label>
                        <div class="input-group bg-light rounded-3 overflow-hidden border">
                            <span class="input-group-text bg-transparent border-0"><i data-lucide="user" class="icon-xs text-muted"></i></span>
                            <input type="text" name="name" class="form-control border-0 bg-transparent shadow-none py-2 fw-bold" value="{{ old('name', $operator->name ?? '') }}" placeholder="Contoh: Ahmad Subardjo" required>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted small text-uppercase">ALAMAT EMAIL RESMI <span class="text-danger">*</span></label>
                        <div class="input-group bg-light rounded-3 overflow-hidden border">
                            <span class="input-group-text bg-transparent border-0"><i data-lucide="mail" class="icon-xs text-muted"></i></span>
                            <input type="email" name="email" class="form-control border-0 bg-transparent shadow-none py-2" value="{{ old('email', $operator->email ?? '') }}" placeholder="operator@selorejo.id" required>
                        </div>
                    </div>

                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small text-uppercase">PASSWORD {{ isset($operator) ? '(OPSIONAL)' : '*' }}</label>
                            <div class="input-group bg-light rounded-3 overflow-hidden border">
                                <span class="input-group-text bg-transparent border-0"><i data-lucide="lock" class="icon-xs text-muted"></i></span>
                                <input type="password" name="password" class="form-control border-0 bg-transparent shadow-none py-2" {{ isset($operator) ? '' : 'required' }} placeholder="••••••••">
                            </div>
                            @if(isset($operator))
                                <small class="text-muted italic small mt-1 d-block">Biarkan kosong jika tidak ingin diubah.</small>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small text-uppercase">KONFIRMASI PASSWORD</label>
                            <div class="input-group bg-light rounded-3 overflow-hidden border">
                                <span class="input-group-text bg-transparent border-0"><i data-lucide="shield-check" class="icon-xs text-muted"></i></span>
                                <input type="password" name="password_confirmation" class="form-control border-0 bg-transparent shadow-none py-2" {{ isset($operator) ? '' : 'required' }} placeholder="••••••••">
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-top d-flex justify-content-between align-items-center">
                        <a href="{{ url('/admin/operator') }}" class="btn btn-white border rounded-pill px-4 fw-bold">BATAL</a>
                        <button type="submit" class="btn btn-success rounded-pill px-5 fw-bold shadow-sm hover-lift border-0">
                            <i data-lucide="save" class="icon-sm me-1"></i> {{ isset($operator) ? 'SIMPAN PERUBAHAN' : 'BUAT AKUN' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-4 p-4 rounded-4 bg-white shadow-sm border align-items-center d-flex text-start">
            <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-circle me-3">
                <i data-lucide="info" class="icon-sm"></i>
            </div>
            <div class="small text-muted">
                Akun Operator hanya memiliki akses ke modul konten (Berita, Produk, Galeri, dll) dan tidak dapat mengakses fitur administrasi sistem seperti manajemen backup atau pengaturan root.
            </div>
        </div>
    </div>
</div>
@endsection
