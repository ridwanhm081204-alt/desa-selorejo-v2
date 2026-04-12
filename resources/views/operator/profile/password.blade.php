@extends('layouts.dashboard')
@section('title', 'Ganti Password')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">

        <div class="card border-0 shadow-sm rounded-4 p-4">
            <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                <div class="bg-success text-white rounded-3 p-2 me-3">
                    <i data-lucide="lock" style="width:22px;height:22px;"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0">Ganti Password</h5>
                    <small class="text-muted">Perbarui kata sandi akun Anda</small>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center gap-2 mb-4">
                    <i data-lucide="check-circle" style="width:18px;"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger d-flex align-items-start gap-2 mb-4">
                    <i data-lucide="alert-circle" style="width:18px;flex-shrink:0;margin-top:2px;"></i>
                    <ul class="mb-0 ps-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('operator.settings.password.update') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold small">
                        <i data-lucide="lock" class="me-1 text-muted" style="width:14px;"></i> Password Lama <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <input type="password" name="password_lama" id="password_lama" class="form-control @error('password_lama') is-invalid @enderror" placeholder="Masukkan password saat ini" required>
                        <span class="input-group-text bg-white" style="cursor:pointer;" onclick="togglePass('password_lama', 'eye-lama')">
                            <i data-lucide="eye" id="eye-lama" style="width:16px;"></i>
                        </span>
                    </div>
                    @error('password_lama')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small">
                        <i data-lucide="key" class="me-1 text-muted" style="width:14px;"></i> Password Baru <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <input type="password" name="password_baru" id="password_baru" class="form-control @error('password_baru') is-invalid @enderror" placeholder="Minimal 6 karakter" required>
                        <span class="input-group-text bg-white" style="cursor:pointer;" onclick="togglePass('password_baru', 'eye-baru')">
                            <i data-lucide="eye" id="eye-baru" style="width:16px;"></i>
                        </span>
                    </div>
                    @error('password_baru')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold small">
                        <i data-lucide="check-square" class="me-1 text-muted" style="width:14px;"></i> Konfirmasi Password Baru <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <input type="password" name="password_baru_confirmation" id="password_konfirmasi" class="form-control" placeholder="Ulangi password baru" required>
                        <span class="input-group-text bg-white" style="cursor:pointer;" onclick="togglePass('password_konfirmasi', 'eye-konfirmasi')">
                            <i data-lucide="eye" id="eye-konfirmasi" style="width:16px;"></i>
                        </span>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success px-4">
                        <i data-lucide="save" class="me-1" style="width:16px;"></i> Simpan Password Baru
                    </button>
                    <a href="{{ url('/operator/dashboard') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    function togglePass(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon  = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.setAttribute('data-lucide', 'eye-off');
        } else {
            input.type = 'password';
            icon.setAttribute('data-lucide', 'eye');
        }
        lucide.createIcons();
    }
</script>
@endpush
