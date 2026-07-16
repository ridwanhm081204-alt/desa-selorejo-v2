@extends('layouts.dashboard')
@section('title', isset($apbdes) ? 'Edit APBDes' : 'Tambah Data Transparansi Dana')
@section('content')

<div class="row justify-content-center text-start">
    <div class="col-lg-9 col-xl-8">
        <div class="mb-4">
            <a href="{{ url('/operator/apbdes') }}" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm transition-all hover-lift">
                <i data-lucide="arrow-left" class="icon-sm me-1"></i> Kembali ke Rekapitulasi
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <!-- Header Card -->
            <div class="card-header bg-white border-0 p-4 d-flex align-items-center border-bottom">
                <div class="bg-success bg-opacity-10 text-success p-2 rounded-3 me-3">
                    <i data-lucide="{{ isset($apbdes) ? 'edit-3' : 'file-spreadsheet' }}" class="icon-sm"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0 text-dark">{{ isset($apbdes) ? 'Edit Anggaran APBDes' : 'Input Anggaran & Transparansi Dana' }}</h5>
                    <small class="text-muted">Kelola akuntabilitas dana desa Selorejo</small>
                </div>
            </div>

            <div class="card-body p-4 p-md-5">
                <form action="{{ isset($apbdes) ? url('/operator/apbdes/'.$apbdes->id) : url('/operator/apbdes') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($apbdes)) @method('PUT') @endif
                    
                    <div class="row g-4 mb-4 text-start">
                        <div class="col-md-3">
                            <label class="form-label fw-bold text-muted small">TAHUN ANGGARAN</label>
                            <input type="number" name="tahun" class="form-control rounded-3 py-2 fw-bold bg-light border-0 shadow-none" value="{{ old('tahun', $apbdes->tahun ?? date('Y')) }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold text-muted small">JENIS ANGGARAN</label>
                            <select name="jenis" class="form-select rounded-3 py-2 fw-bold text-success border-2 border-success border-opacity-10 shadow-none bg-light" required>
                                <option value="pendapatan" {{ (old('jenis', $apbdes->jenis ?? '') == 'pendapatan') ? 'selected' : '' }}>Pendapatan Desa</option>
                                <option value="belanja" {{ (old('jenis', $apbdes->jenis ?? '') == 'belanja') ? 'selected' : '' }}>Belanja / Pengeluaran</option>
                                <option value="pembiayaan_penerimaan" {{ (old('jenis', $apbdes->jenis ?? '') == 'pembiayaan_penerimaan') ? 'selected' : '' }}>Penerimaan Pembiayaan</option>
                                <option value="pembiayaan_pengeluaran" {{ (old('jenis', $apbdes->jenis ?? '') == 'pembiayaan_pengeluaran') ? 'selected' : '' }}>Pengeluaran Pembiayaan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small">BIDANG / NAMA KEGIATAN</label>
                            <input type="text" name="bidang" class="form-control rounded-3 py-2 border-0 bg-light shadow-none" value="{{ old('bidang', $apbdes->bidang ?? '') }}" placeholder="Contoh: Dana Desa (DD) / Pembangunan Jalan" required>
                        </div>
                    </div>

                    <div class="row g-4 mb-5 text-start">
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small">NOMINAL SEMULA (RP)</label>
                            <div class="input-group bg-light rounded-3 overflow-hidden border">
                                <span class="input-group-text bg-transparent border-0 fw-bold text-success">Rp</span>
                                <input type="number" name="nominal_semula" id="nominal_semula" class="form-control border-0 bg-transparent shadow-none py-2 fw-bold" value="{{ old('nominal_semula', $apbdes->nominal_semula ?? '') }}" placeholder="0" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small">BERTAMBAH / (BERKURANG) (RP)</label>
                            <div class="input-group bg-light rounded-3 overflow-hidden border">
                                <span class="input-group-text bg-transparent border-0 fw-bold text-success">Rp</span>
                                <input type="number" name="nominal_perubahan" id="nominal_perubahan" class="form-control border-0 bg-transparent shadow-none py-2 fw-bold" value="{{ old('nominal_perubahan', $apbdes->nominal_perubahan ?? '') }}" placeholder="0" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small">SETELAH PERUBAHAN (RP)</label>
                            <div class="input-group bg-light rounded-3 overflow-hidden border">
                                <span class="input-group-text bg-transparent border-0 fw-bold text-success">Rp</span>
                                <input type="number" name="nominal" id="nominal" class="form-control border-0 bg-transparent shadow-none py-2 fw-bold" value="{{ old('nominal', $apbdes->nominal ?? '') }}" placeholder="0" required readonly>
                            </div>
                            <small class="text-muted italic small">Dihitung otomatis (Semula + Perubahan).</small>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold text-muted small">SALINAN DOKUMEN (PDF)</label>
                            @if(isset($apbdes) && $apbdes->dokumen_pdf)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/'.$apbdes->dokumen_pdf) }}" target="_blank" class="small text-decoration-none fw-bold text-primary">
                                        <i data-lucide="file-check" class="icon-xs me-1"></i> LIHAT DOKUMEN SAAT INI
                                    </a>
                                </div>
                            @endif
                            <input type="file" name="dokumen_pdf" class="form-control rounded-3 border-0 bg-light shadow-none" accept="application/pdf text-start">
                            <small class="text-muted italic small d-block mt-1">Lampirkan RKA/DPA jika ada (Maks 5MB).</small>
                        </div>
                    </div>

                    <div class="pt-4 border-top d-flex justify-content-between">
                        <a href="{{ url('/operator/apbdes') }}" class="btn btn-white border rounded-pill px-4 fw-bold">BATAL</a>
                        <button type="submit" class="btn btn-success rounded-pill px-5 fw-bold shadow-sm hover-lift border-0">
                            <i data-lucide="save" class="icon-sm me-1"></i> {{ isset($apbdes) ? 'SIMPAN PERUBAHAN' : 'TAMBAH ANGGARAN' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-4 p-4 rounded-4 bg-white shadow-sm border align-items-center d-flex text-start">
            <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-circle me-3">
                <i data-lucide="info" class="icon-sm"></i>
            </div>
            <div class="small text-muted">
                Data yang diinput akan secara otomatis diakumulasikan dalam grafik transparansi pada halaman beranda informasi publik.
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const semulaInput = document.getElementById('nominal_semula');
        const perubahanInput = document.getElementById('nominal_perubahan');
        const akhirInput = document.getElementById('nominal');

        function updateAkhir() {
            const semula = parseFloat(semulaInput.value) || 0;
            const perubahan = parseFloat(perubahanInput.value) || 0;
            akhirInput.value = semula + perubahan;
        }

        if(semulaInput && perubahanInput) {
            semulaInput.addEventListener('input', updateAkhir);
            perubahanInput.addEventListener('input', updateAkhir);
        }
    });
</script>
@endpush
