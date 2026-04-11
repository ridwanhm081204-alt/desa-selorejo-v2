@extends('layouts.dashboard')
@section('title', isset($operator) ? 'Edit Operator' : 'Tambah Operator')
@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <form action="{{ isset($operator) ? url('/admin/operator/'.$operator->id) : url('/admin/operator') }}" method="POST">
            @csrf
            @if(isset($operator)) @method('PUT') @endif
            
            <div class="mb-4">
                <label class="form-label fw-bold">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $operator->name ?? '') }}" required>
            </div>
            
            <div class="mb-4">
                <label class="form-label fw-bold">Alamat Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $operator->email ?? '') }}" required>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Password {{ isset($operator) ? '(Kosongkan jika tidak ingin diubah)' : '' }}</label>
                    <input type="password" name="password" class="form-control" {{ isset($operator) ? '' : 'required' }}>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" {{ isset($operator) ? '' : 'required' }}>
                </div>
            </div>

            <div class="text-end border-top pt-4">
                <a href="{{ url('/admin/operator') }}" class="btn btn-outline-secondary px-4 me-2">Batal</a>
                <button type="submit" class="btn btn-danger px-4 hover-lift"><i data-lucide="save" class="me-1" style="width:18px;"></i> Simpan Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
