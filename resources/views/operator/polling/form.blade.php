@extends('layouts.dashboard')
@section('title', isset($polling) ? 'Edit Polling' : 'Tambah Polling Baru')
@section('content')

<div class="row justify-content-center text-start">
    <div class="col-lg-8 col-xl-7">
        <div class="mb-4">
            <a href="{{ url('/operator/polling') }}" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm transition-all hover-lift">
                <i data-lucide="arrow-left" class="icon-sm me-1"></i> Kembali ke Manajemen Polling
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white p-4 border-bottom d-flex align-items-center">
                <div class="bg-success bg-opacity-10 text-success p-2 rounded-3 me-3">
                    <i data-lucide="{{ isset($polling) ? 'edit-3' : 'plus-circle' }}" class="icon-sm"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0 text-dark">{{ isset($polling) ? 'Edit Pertanyaan Polling' : 'Buat Polling Suara Baru' }}</h5>
                    <small class="text-muted">Gunakan bahasa yang mudah dipahami warga</small>
                </div>
            </div>
            
            <div class="card-body p-4 p-md-5">
                <form action="{{ isset($polling) ? url('/operator/polling/'.$polling->id) : url('/operator/polling') }}" 
                      method="POST">
                    @csrf
                    @if(isset($polling)) @method('PUT') @endif

                    <div class="mb-4 text-start">
                        <label class="form-label small fw-bold text-muted">PERTANYAAN / ASPIRASI *</label>
                        <textarea name="pertanyaan" class="form-control rounded-4 p-3 border-0 bg-light shadow-none fw-bold @error('pertanyaan') is-invalid @enderror" 
                                  rows="4" placeholder="Contoh: Bagaimana pendapat Anda mengenai fasilitas olahraga baru di dusun?" required>{{ old('pertanyaan', $polling->pertanyaan ?? '') }}</textarea>
                        @error('pertanyaan') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="row mb-5 g-4 text-start">
                        <div class="col-md-6 text-start">
                            <label class="form-label small fw-bold text-muted">TANGGAL MULAI *</label>
                            <input type="date" name="tanggal_mulai" class="form-control rounded-3 py-2 border-0 bg-light shadow-none @error('tanggal_mulai') is-invalid @enderror" 
                                   value="{{ old('tanggal_mulai', isset($polling) ? \Carbon\Carbon::parse($polling->tanggal_mulai)->format('Y-m-d') : date('Y-m-d')) }}" required>
                            @error('tanggal_mulai') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 text-start text-start">
                            <label class="form-label small fw-bold text-muted">TANGGAL SELESAI *</label>
                            <input type="date" name="tanggal_selesai" class="form-control rounded-3 py-2 border-0 bg-light shadow-none @error('tanggal_selesai') is-invalid @enderror" 
                                   value="{{ old('tanggal_selesai', isset($polling) ? \Carbon\Carbon::parse($polling->tanggal_selesai)->format('Y-m-d') : date('Y-m-d', strtotime('+7 days'))) }}" required>
                            @error('tanggal_selesai') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-5 p-4 bg-light rounded-4 text-start">
                        <label class="form-label small fw-bold text-muted mb-3 d-block">STATUS VISIBILITAS POLLING</label>
                        <div class="d-flex flex-column flex-md-row gap-4">
                            <div class="form-check custom-radio">
                                <input class="form-check-input" type="radio" name="is_active" id="active1" value="1" {{ old('is_active', $polling->is_active ?? 1) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="active1">
                                    <span class="text-success">AKTIF</span>
                                    <small class="d-block text-muted fw-normal">Polling akan muncul di beranda dan dapat dipilih.</small>
                                </label>
                            </div>
                            <div class="form-check custom-radio">
                                <input class="form-check-input" type="radio" name="is_active" id="active0" value="0" {{ old('is_active', $polling->is_active ?? 1) == 0 ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="active0">
                                    <span class="text-muted">NONAKTIF</span>
                                    <small class="d-block text-muted fw-normal">Polling disembunyikan sementara dari beranda.</small>
                                </label>
                            </div>
                        </div>
                        @error('is_active') <div class="text-danger small mt-1 font-bold">{{ $message }}</div> @enderror
                    </div>

                    <div class="pt-4 border-top d-flex justify-content-between">
                        <a href="{{ url('/operator/polling') }}" class="btn btn-white border rounded-pill px-4 fw-bold">BATAL</a>
                        <button type="submit" class="btn btn-success rounded-pill px-5 fw-bold shadow-sm hover-lift border-0">
                            <i data-lucide="save" class="icon-sm me-1"></i> {{ isset($polling) ? 'SIMPAN PERUBAHAN' : 'TERBITKAN POLLING' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-4 p-4 rounded-4 bg-white shadow-sm border align-items-center d-flex">
            <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-circle me-3">
                <i data-lucide="info" class="icon-sm"></i>
            </div>
            <div class="small text-muted text-start">
                Setiap polling yang aktif akan tampil di beranda utama website hingga periode tanggal selesai yang ditentukan habis.
            </div>
        </div>
    </div>
</div>

<style>
    .custom-radio .form-check-input:checked {
        background-color: #198754;
        border-color: #198754;
    }
</style>
@endsection
