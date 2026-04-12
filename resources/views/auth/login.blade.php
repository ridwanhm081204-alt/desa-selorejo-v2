@extends('layouts.public')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card glass-panel" style="width: 400px;">
        <div class="card-body p-4 text-center">
            <div class="mb-4">
                <img src="{{ asset('images/logo_desa.png') }}" alt="Logo Selorejo" class="mb-3" style="width: 80px; height: 80px; object-fit: contain;">
                <h4 class="mt-2 text-dark">Pemerintah Desa Selorejo</h4>
            </div>
            
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3 text-start">
                    <label class="form-label"><i data-lucide="mail" class="icon-sm me-1 text-success"></i> Email</label>
                    <input type="email" name="email" class="form-control" placeholder="nama@gmail.com" required autofocus>
                </div>
                <div class="mb-3 text-start">
                    <label class="form-label"><i data-lucide="lock" class="icon-sm me-1 text-success"></i> Password</label>
                    <div class="input-group" style="box-shadow: 0 0 0 1px rgba(45,106,79,0.2); border-radius: 8px; overflow: hidden;">
                        <input type="password" name="password" id="password-input" class="form-control border-0" required style="box-shadow: none;">
                        <span class="input-group-text bg-white border-0 text-muted" id="toggle-password" style="cursor: pointer;">
                            <i data-lucide="eye" id="icon-toggle" class="icon-sm"></i>
                        </span>
                    </div>
                </div>

                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label small text-muted" for="remember">
                            Ingat Saya
                        </label>
                    </div>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger p-2 mb-3">
                        <small>{{ $errors->first() }}</small>
                    </div>
                @endif
                
                <button type="submit" class="btn btn-primary bg-primary-custom w-100 hover-lift">Masuk</button>
            </form>

            <div class="mt-4 text-muted small">
                &copy; {{ date('Y') }} Website Desa Wisata Petik Jeruk Selorejo
            </div>
        </div>
    </div>
</div>
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
