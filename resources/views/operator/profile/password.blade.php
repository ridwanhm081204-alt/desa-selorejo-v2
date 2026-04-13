@extends('layouts.dashboard')
@section('title', 'Ganti Password')
@section('content')

<div class="row justify-content-center text-start">
    <div class="col-lg-6 col-md-8">

        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white border-top border-4 border-success overflow-hidden">
            <div class="d-flex align-items-center mb-5 border-bottom pb-4">
                <div class="bg-success text-white rounded-circle p-3 me-3 shadow-sm">
                    <i data-lucide="lock" style="width:24px;height:24px;"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0 text-dark">Ganti Password Keamanan</h5>
                    <small class="text-muted">Perbarui kata sandi akun operator secara berkala</small>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center p-3 animate-fade-in">
                    <i data-lucide="check-circle" class="me-2 text-success"></i>
                    <div class="fw-bold">{{ session('success') }}</div>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 p-3 animate-fade-in">
                    <div class="d-flex align-items-start gap-2">
                        <i data-lucide="alert-circle" class="text-danger icon-sm mt-1"></i>
                        <ul class="mb-0 ps-2 small fw-bold">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('operator.settings.password.update') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-bold text-muted small">PASSWORD SAAT INI</label>
                    <div class="input-group bg-light rounded-3 overflow-hidden border">
                        <span class="input-group-text bg-transparent border-0"><i data-lucide="shield-check" class="icon-xs text-muted"></i></span>
                        <input type="password" name="password_lama" id="password_lama" class="form-control border-0 bg-transparent shadow-none py-2" placeholder="Konfirmasi sandi lama..." required>
                        <button type="button" class="btn btn-transparent border-0" onclick="togglePass('password_lama', 'eye-lama')">
                            <i data-lucide="eye" id="eye-lama" style="width:16px;"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-muted small">PASSWORD BARU</label>
                    <div class="input-group bg-light rounded-3 overflow-hidden border border-success border-opacity-25">
                        <span class="input-group-text bg-transparent border-0"><i data-lucide="key-round" class="icon-xs text-success"></i></span>
                        <input type="password" name="password_baru" id="password_baru" class="form-control border-0 bg-transparent shadow-none py-2 @error('password_baru') is-invalid @enderror" placeholder="Minimal 6 karakter..." required>
                        <button type="button" class="btn btn-transparent border-0" onclick="togglePass('password_baru', 'eye-baru')">
                            <i data-lucide="eye" id="eye-baru" style="width:16px;"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="form-label fw-bold text-muted small">KONFIRMASI PASSWORD BARU</label>
                    <div class="input-group bg-light rounded-3 overflow-hidden border">
                        <span class="input-group-text bg-transparent border-0"><i data-lucide="check-check" class="icon-xs text-muted"></i></span>
                        <input type="password" name="password_baru_confirmation" id="password_konfirmasi" class="form-control border-0 bg-transparent shadow-none py-2" placeholder="Ulangi sandi baru..." required>
                        <button type="button" class="btn btn-transparent border-0" onclick="togglePass('password_konfirmasi', 'eye-konfirmasi')">
                            <i data-lucide="eye" id="eye-konfirmasi" style="width:16px;"></i>
                        </button>
                    </div>
                </div>

                <div class="d-grid gap-2 text-center">
                    <button type="submit" class="btn btn-success py-3 rounded-pill fw-bold shadow-sm hover-lift border-0">
                        <i data-lucide="save" class="me-2 icon-sm"></i> SIMPAN PERUBAHAN KEAMANAN
                    </button>
                    <a href="{{ url('/operator/dashboard') }}" class="btn btn-light py-2 rounded-pill fw-bold text-muted mt-2 border-0">KEMBALI KE BERANDA</a>
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
