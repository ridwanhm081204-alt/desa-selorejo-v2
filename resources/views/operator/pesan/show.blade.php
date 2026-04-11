@extends('layouts.dashboard')
@section('title', 'Detail Pesan')
@section('content')
<div class="mb-3">
    <a href="{{ url('/operator/pesan') }}" class="btn btn-outline-secondary btn-sm"><i data-lucide="arrow-left" class="me-1" style="width:14px;"></i> Kembali</a>
</div>
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-5">
        <div class="d-flex justify-content-between border-bottom pb-4 mb-4">
            <div>
                <h4 class="fw-bold mb-1">{{ $pesan->nama }}</h4>
                <a href="mailto:{{ $pesan->email }}" class="text-primary text-decoration-none"><i data-lucide="mail" class="me-1" style="width:14px;"></i> {{ $pesan->email }}</a>
            </div>
            <div class="text-end text-muted">
                <i data-lucide="calendar" class="me-1" style="width:14px;"></i> {{ $pesan->created_at->format('d M Y H:i') }}
            </div>
        </div>
        
        <div class="pesan-content" style="line-height: 1.8; font-size: 1.05rem;">
            {!! nl2br(e($pesan->pesan)) !!}
        </div>
        
        <div class="mt-5 pt-4 border-top">
            <a href="mailto:{{ $pesan->email }}?subject=Balasan%20dari%20Desa%20Selorejo" class="btn btn-primary bg-primary-custom hover-lift"><i data-lucide="reply" class="me-1" style="width:16px;"></i> Balas via Email</a>
        </div>
    </div>
</div>
@endsection
