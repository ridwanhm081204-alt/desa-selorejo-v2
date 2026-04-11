@extends('layouts.dashboard')
@section('title', 'Buat Polling Baru')
@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <form action="{{ url('/operator/polling') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="form-label fw-bold">Pertanyaan Polling</label>
                <input type="text" name="pertanyaan" class="form-control" placeholder="Contoh: Apakah Anda setuju dengan pembangunan fasilitas X?" required>
            </div>
            
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control" value="{{ date('Y-m-d', strtotime('+7 days')) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Status Tayang</label>
                    <select name="is_active" class="form-select">
                        <option value="1">Aktif Tayang</option>
                        <option value="0">Draft / Nonaktif</option>
                    </select>
                    <small class="text-muted d-block mt-1">Mengaktifkan ini akan menonaktifkan polling sebelumnya.</small>
                </div>
            </div>

            <div class="text-end">
                <a href="{{ url('/operator/polling') }}" class="btn btn-outline-secondary px-4 me-2">Batal</a>
                <button type="submit" class="btn btn-success px-4 bg-primary-custom hover-lift"><i data-lucide="save" class="me-1" style="width:18px;"></i> Simpan Polling</button>
            </div>
        </form>
    </div>
</div>
@endsection
