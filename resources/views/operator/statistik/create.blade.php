@extends('layouts.dashboard')
@section('title', 'Tambah Data Statistik')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                <div class="bg-success text-white rounded-3 p-2 me-3">
                    <i data-lucide="bar-chart-2" style="width:20px;height:20px;"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0">Tambah Data Statistik</h5>
                    <small class="text-muted">Isi data demografis baru</small>
                </div>
            </div>
            @if($errors->any())
                <div class="alert alert-danger mb-3">
                    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif
            <form action="{{ route('operator.statistik.store') }}" method="POST">
                @csrf
                @include('operator.statistik._form')
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-success px-4"><i data-lucide="save" class="me-1" style="width:16px;"></i> Simpan</button>
                    <a href="{{ route('operator.statistik.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
