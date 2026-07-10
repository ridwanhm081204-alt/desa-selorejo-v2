@extends('layouts.public')
@section('title', 'Pengajuan Berhasil Dikirim')
@section('content')
<div class="container mb-5 pb-5 mt-5">
    <div class="row justify-content-center text-start">
        <div class="col-md-7 col-lg-6">
            <div class="card border-0 shadow-lg rounded-4 p-5 bg-white text-center">
                <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success rounded-circle mb-4" style="width: 80px; height: 80px;">
                    <i data-lucide="check-circle-2" style="width: 40px; height: 40px;"></i>
                </div>
                
                <h3 class="fw-bold mb-2 text-dark" style="font-family: var(--font-heading);">Pengajuan Berhasil Dikirim!</h3>
                <p class="text-muted small mb-4" style="font-family: var(--font-body);">Berkas pengajuan Anda telah diterima oleh sistem pelayanan online Pemerintah Desa Selorejo.</p>
                
                <!-- Ticket Box -->
                <div class="p-4 rounded-4 mb-4" style="background-color: rgba(26, 92, 56, 0.05); border: 2px dashed rgba(26, 92, 56, 0.15);">
                    <small class="text-muted fw-bold d-block text-uppercase small" style="font-family: var(--font-body);">NOMOR TIKET LAYANAN ANDA</small>
                    <h2 class="fw-bold my-2 text-success" id="ticket-number" style="font-family: var(--font-heading); letter-spacing: 0.05em;">{{ $noTiket }}</h2>
                    <button class="btn btn-sm btn-white border rounded-pill px-3 shadow-sm hover-lift" onclick="copyTicket()" style="font-family: var(--font-heading);">
                        <i data-lucide="copy" class="icon-xs me-1"></i> Salin Nomor Tiket
                    </button>
                </div>

                <div class="p-3 alert alert-info rounded-3 text-start mb-4">
                    <h6 class="fw-bold text-dark mb-1 small"><i data-lucide="info" class="icon-xs me-1"></i> Langkah Selanjutnya:</h6>
                    <ol class="small text-muted mb-0 ps-3" style="font-family: var(--font-body); line-height: 1.6;">
                        <li>Simpan nomor tiket Anda di atas untuk melacak progres berkas.</li>
                        <li>Petugas desa akan memverifikasi berkas Anda dalam waktu 1-2 hari kerja.</li>
                        <li>Notifikasi update/persetujuan/penolakan status akan dikirimkan otomatis via WhatsApp.</li>
                    </ol>
                </div>

                <div class="d-flex gap-2 justify-content-center">
                    <a href="{{ route('layanan.index') }}" class="btn btn-outline-success rounded-pill px-4 fw-bold shadow-sm hover-lift" style="font-family: var(--font-heading);">Pilihan Layanan</a>
                    <a href="{{ route('layanan.cek-status') }}?query_status={{ $noTiket }}" class="btn btn-success rounded-pill px-4 fw-bold shadow-sm hover-lift text-white border-0" style="font-family: var(--font-heading);">Lacak Berkas</a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function copyTicket() {
        const ticketText = document.getElementById('ticket-number').innerText;
        navigator.clipboard.writeText(ticketText).then(() => {
            alert('Nomor tiket berhasil disalin!');
        }).catch(err => {
            console.error('Gagal menyalin tiket: ', err);
        });
    }
</script>
@endpush
@endsection
