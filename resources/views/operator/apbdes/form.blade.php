@extends('layouts.dashboard')
@section('title', isset($apbdes) ? 'Edit APBDes' : 'Tambah Data APBDes')
@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <form action="{{ isset($apbdes) ? url('/operator/apbdes/'.$apbdes->id) : url('/operator/apbdes') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($apbdes)) @method('PUT') @endif
            
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <label class="form-label fw-bold">Tahun Anggaran</label>
                    <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $apbdes->tahun ?? date('Y')) }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Jenis</label>
                    <select name="jenis" class="form-select" required>
                        <option value="pendapatan" {{ (old('jenis', $apbdes->jenis ?? '') == 'pendapatan') ? 'selected' : '' }}>Pendapatan Desa</option>
                        <option value="belanja" {{ (old('jenis', $apbdes->jenis ?? '') == 'belanja') ? 'selected' : '' }}>Belanja / Pengeluaran</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Bidang Kegiatan / Nama Pendapatan</label>
                    <input type="text" name="bidang" class="form-control" value="{{ old('bidang', $apbdes->bidang ?? '') }}" required>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nominal (Rp)</label>
                    <input type="number" name="nominal" class="form-control" value="{{ old('nominal', $apbdes->nominal ?? '') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Dokumen Rincian (Opsional, PDF max 5MB)</label>
                    @if(isset($apbdes) && $apbdes->dokumen_pdf)
                        <div class="mb-2"><a href="{{ asset('storage/'.$apbdes->dokumen_pdf) }}" target="_blank" class="small text-decoration-none"><i data-lucide="file-text" style="width:14px;"></i> Lihat File Saat Ini</a></div>
                    @endif
                    <input type="file" name="dokumen_pdf" class="form-control" accept="application/pdf">
                </div>
            </div>

            <div class="text-end border-top pt-4">
                <a href="{{ url('/operator/apbdes') }}" class="btn btn-outline-secondary px-4 me-2">Batal</a>
                <button type="submit" class="btn btn-success px-4 bg-primary-custom hover-lift"><i data-lucide="save" class="me-1" style="width:18px;"></i> Simpan Data APBDes</button>
            </div>
        </form>
    </div>
</div>
@endsection
