@extends('layouts.public')
@section('title', 'Login Portal Desa')
@section('content')

<div class="d-flex justify-content-center align-items-center py-5" style="min-height: 80vh; background: radial-gradient(circle at top right, rgba(26, 92, 56, 0.05), transparent);">
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="width: 420px; max-width: 100%; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border: 1px solid rgba(26, 92, 56, 0.1) !important;">
        <!-- Top accent line -->
        <div style="height: 5px; background: linear-gradient(90deg, var(--color-forest), var(--accent));"></div>
        
        <div class="card-body p-4 p-md-5 text-center" style="font-family: var(--font-body);">
            <div class="mb-5">
                <div class="d-inline-flex align-items-center justify-content-center bg-white shadow-sm rounded-circle p-3 mb-3 border border-light" style="width: 100px; height: 100px;">
                    <img src="{{ asset('images/logo_desa.png') }}" alt="Logo Selorejo" style="width: 60px; height: 60px; object-fit: contain;">
                </div>
                <h4 class="fw-bold text-dark mb-1" style="font-family: var(--font-heading);">E-Government Selorejo</h4>
                <p class="text-muted small">Silakan masuk untuk mengelola portal desa</p>
            </div>
            
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4 text-start">
                    <label class="form-label small fw-bold text-muted text-uppercase ms-1">Alamat Email</label>
                    <div class="input-group bg-light rounded-3 overflow-hidden border" style="border-color: var(--color-forest)1a !important;">
                        <span class="input-group-text bg-transparent border-0"><i data-lucide="mail" class="icon-sm" style="color: var(--color-forest) !important; opacity: 0.7;"></i></span>
                        <input type="email" name="email" class="form-control border-0 bg-transparent shadow-none py-2 text-dark" placeholder="nama@selorejo.id" required autofocus>
                    </div>
                </div>

                <div class="mb-4 text-start">
                    <label class="form-label small fw-bold text-muted text-uppercase ms-1">Password Keamanan</label>
                    <div class="input-group bg-light rounded-3 overflow-hidden border" style="border-color: var(--color-forest)1a !important;">
                        <span class="input-group-text bg-transparent border-0"><i data-lucide="lock" class="icon-sm" style="color: var(--color-forest) !important; opacity: 0.7;"></i></span>
                        <input type="password" name="password" id="password-input" class="form-control border-0 bg-transparent shadow-none py-2 text-dark" placeholder="••••••••" required>
                        <span class="input-group-text bg-transparent border-0 text-muted" id="toggle-password" style="cursor: pointer;">
                            <i data-lucide="eye" id="icon-toggle" class="icon-sm opacity-50"></i>
                        </span>
                    </div>
                </div>

                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <div class="form-check text-start">
                        <input class="form-check-input shadow-none border" type="checkbox" name="remember" id="remember" style="border-color: var(--color-forest)3a !important;">
                        <label class="form-check-label small text-muted fw-medium" for="remember">
                            Tetap masuk di perangkat ini
                        </label>
                    </div>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger border-0 rounded-3 p-2 mb-4 animate-shake" style="background-color: rgba(217, 48, 37, 0.1) !important; color: var(--color-tomato) !important;">
                        <div class="d-flex align-items-center justify-content-center">
                            <i data-lucide="alert-circle" class="icon-sm me-2"></i>
                            <small class="fw-bold">{{ $errors->first() }}</small>
                        </div>
                    </div>
                @endif
                
                <button type="submit" class="btn w-100 rounded-pill py-2 fw-bold shadow-sm hover-lift border-0 mt-2" style="background-color: var(--color-forest) !important; color: #fff !important; font-family: var(--font-heading);">
                    MASUK KE DASHBOARD
                </button>
            </form>

            <div class="mt-5 text-muted small border-top pt-4" style="border-top-color: var(--color-forest)1a !important;">
                &copy; {{ date('Y') }} <b>Pemerintah Desa Selorejo</b><br>
                <span class="opacity-50">Kecamatan Dau, Malang, Jawa Timur</span>
            </div>
        </div>
    </div>
</div>

<style>
    .animate-shake { animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both; }
    @keyframes shake {
      10%, 90% { transform: translate3d(-1px, 0, 0); }
      20%, 80% { transform: translate3d(2px, 0, 0); }
      30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
      40%, 60% { transform: translate3d(4px, 0, 0); }
    }
</style>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password-input');

        togglePassword.addEventListener('click', function() {
            const icon = document.getElementById('icon-toggle');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.setAttribute('data-lucide', 'eye-off');
            } else {
                passwordInput.type = 'password';
                icon.setAttribute('data-lucide', 'eye');
            }
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    });
</script>
@endpush
