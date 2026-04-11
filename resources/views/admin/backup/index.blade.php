@extends('layouts.dashboard')
@section('title', 'Backup Data Sistem')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-5 text-center">
                <i data-lucide="database" class="text-success mb-4" style="width:80px; height:80px;"></i>
                <h4 class="fw-bold mb-3">Backup Keseluruhan Database</h4>
                <p class="text-muted mb-4">Pastikan Anda melakukan backup secara berkala untuk menjaga keamanan data desa wisata. File backup akan diunduh secara otomatis setelah proses selesai.</p>
                
                @if(session('success'))
                    <div class="alert alert-success d-inline-block">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger d-inline-block">{{ session('error') }}</div>
                @endif
                
                <form action="{{ url('/admin/backup') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success btn-lg px-5 rounded-pill shadow-sm hover-lift"><i data-lucide="download" class="me-2" style="width:20px;"></i> Mulai Proses Backup</button>
                </form>
                
                <div class="mt-4 pt-3 border-top w-50 mx-auto">
                    <small class="text-muted">Terakhir Backup: <span class="fw-bold">{{\App\Models\Setting::get('last_backup', 'Belum Pernah')}}</span></small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
