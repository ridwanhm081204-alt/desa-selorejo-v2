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
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required autofocus>
                </div>
                <div class="mb-3 text-start">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
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
