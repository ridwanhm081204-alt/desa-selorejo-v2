@extends('layouts.dashboard')
@section('title', 'Edit Data Statistik')
@section('content')
<div class="row justify-content-center text-start">
    <div class="col-lg-6 col-md-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white border-top border-4 border-success">
            <div class="d-flex align-items-center mb-5 border-bottom pb-4">
                <div class="bg-success text-white rounded-circle p-3 me-3 shadow-sm text-center d-flex align-items-center justify-content-center" style="width: 54px; height: 54px;">
                    <i data-lucide="edit-3" style="width:24px;height:24px;"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0 text-dark">Edit Data Statistik</h5>
                    <small class="text-muted">Perbarui parameter demografis yang ada</small>
                </div>
            </div>

            @if($errors->any())
                <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 p-3 animate-fade-in">
                    <div class="d-flex align-items-start gap-2">
                        <i data-lucide="alert-circle" class="text-danger icon-sm mt-1"></i>
                        <ul class="mb-0 ps-2 small fw-bold">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('operator.statistik.update', $item->id) }}" method="POST">
                @csrf @method('PUT')
                @include('operator.statistik._form')
                
                <div class="d-grid gap-2 mt-5">
                    <button type="submit" class="btn btn-success py-3 rounded-pill fw-bold shadow-sm hover-lift border-0">
                        <i data-lucide="save" class="me-2 icon-sm"></i> SIMPAN PERUBAHAN DATA
                    </button>
                    <a href="{{ route('operator.statistik.index') }}" class="btn btn-light py-2 rounded-pill fw-bold text-muted mt-2 border-0">KEMBALI KE DAFTAR</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
