@extends('layouts.dashboard')
@section('title', 'Edit Data Statistik')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                <div class="bg-primary text-white rounded-3 p-2 me-3">
                    <i data-lucide="edit-2" style="width:20px;height:20px;"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0">Edit Data Statistik</h5>
                    <small class="text-muted">Ubah data demografis yang sudah ada</small>
                </div>
            </div>
            @if($errors->any())
                <div class="alert alert-danger mb-3">
                    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif
            <form action="{{ route('operator.statistik.update', $item->id) }}" method="POST">
                @csrf @method('PUT')
                @include('operator.statistik._form', ['item' => $item])
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary px-4"><i data-lucide="save" class="me-1" style="width:16px;"></i> Perbarui</button>
                    <a href="{{ route('operator.statistik.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
