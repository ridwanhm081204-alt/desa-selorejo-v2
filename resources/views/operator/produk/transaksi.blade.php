@extends('layouts.dashboard')
@section('title', 'Riwayat Transaksi Produk')
@section('content')

<!-- Header Section -->
<div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
    <div class="card-body p-4 bg-white">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <h4 class="fw-bold mb-1 text-dark">Riwayat Pembelian Produk</h4>
                <p class="text-muted small mb-0">Kelola dan pantau seluruh transaksi UMKM Desa Selorejo secara profesional.</p>
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <a href="{{ url('/operator/produk') }}" class="btn btn-outline-success rounded-pill px-4 fw-bold shadow-sm hover-lift">
                    <i data-lucide="arrow-left" class="icon-sm me-2"></i> Kembali ke Produk
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Main Table Card -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light border-bottom border-light">
                    <tr>
                        <th class="ps-4 py-3 small fw-bold text-muted text-uppercase tracking-wider">ID & Waktu</th>
                        <th class="py-3 small fw-bold text-muted text-uppercase tracking-wider">Pelanggan</th>
                        <th class="py-3 small fw-bold text-muted text-uppercase tracking-wider">Detail Produk</th>
                        <th class="py-3 small fw-bold text-muted text-uppercase tracking-wider text-center" style="width: 200px;">Status Pesanan</th>
                        <th class="py-3 small fw-bold text-muted text-uppercase tracking-wider text-center">Total Bayar</th>
                        <th class="pe-4 py-3 small fw-bold text-muted text-uppercase tracking-wider text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $t)
                    <tr class="hover-bg-light transition-all">
                        <!-- ID & Waktu -->
                        <td class="ps-4 py-4">
                            <div class="d-flex flex-column">
                                <span class="fw-bold text-dark fs-6">#{{ $t->id }}</span>
                                <span class="text-muted" style="font-size: 0.75rem;">
                                    <i data-lucide="calendar" class="icon-xs me-1"></i> {{ $t->created_at->translatedFormat('d M Y') }}
                                </span>
                                <span class="text-muted" style="font-size: 0.75rem;">
                                    <i data-lucide="clock" class="icon-xs me-1"></i> {{ $t->created_at->format('H:i') }} WIB
                                </span>
                            </div>
                        </td>

                        <!-- Pelanggan -->
                        <td class="py-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <i data-lucide="user" class="icon-sm"></i>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $t->nama_pemesan }}</div>
                                    @if($t->telepon)
                                        @php
                                            $phone = preg_replace('/[^0-9]/', '', $t->telepon);
                                            if (str_starts_with($phone, '0')) {
                                                $phone = '62' . substr($phone, 1);
                                            }
                                            
                                            $productName = $t->produk ? $t->produk->nama : 'Produk Dihapus';
                                            $qty = $t->jumlah;
                                            $total = number_format($t->total_harga, 0, ',', '.');
                                            $status = $t->status;
                                            $address = $t->alamat . ', Desa ' . ($t->kelurahan ?? 'Selorejo') . ', Kec. ' . ($t->kecamatan ?? 'Dau') . ', ' . ($t->kabupaten ?? 'Malang');
                                            
                                            $message = "Halo *" . $t->nama_pemesan . "*,\n\n"
                                                     . "Kami dari *Pemerintah Desa Selorejo* menginformasikan mengenai detail transaksi pembelian Anda:\n\n"
                                                     . "📌 *ID Transaksi*: #" . $t->id . "\n"
                                                     . "📦 *Produk*: " . $productName . " (" . $qty . "x)\n"
                                                     . "💰 *Total Bayar*: Rp " . $total . "\n"
                                                     . "📍 *Alamat Kirim*: " . $address . "\n"
                                                     . "🔄 *Status Pesanan*: " . $status . "\n\n"
                                                     . "Terima kasih atas pesanan Anda!";
                                                     
                                            $waUrl = "https://wa.me/" . $phone . "?text=" . urlencode($message);
                                        @endphp
                                        <a href="{{ $waUrl }}" target="_blank" class="badge bg-success bg-opacity-10 text-success text-decoration-none rounded-pill px-2 py-1 mt-1 hover-lift d-inline-flex align-items-center">
                                            <i data-lucide="phone" class="icon-xs me-1"></i> Hubungi WA
                                        </a>
                                    @else
                                        <span class="text-muted small fst-italic">No. WA tidak ada</span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <!-- Detail Produk -->
                        <td class="py-4">
                            @if($t->produk)
                                <div class="fw-bold text-dark">{{ $t->produk->nama }}</div>
                                <div class="badge bg-light text-muted border-0 fw-normal" style="font-size: 0.7rem;">
                                    <i data-lucide="package" class="icon-xs me-1"></i> {{ $t->jumlah }} x Rp {{ number_format($t->produk->harga, 0, ',', '.') }}
                                </div>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3">Produk Dihapus</span>
                            @endif
                        </td>

                        <!-- Status Pesanan -->
                        <td class="py-4 text-center">
                            <div class="d-inline-block w-100">
                                <select class="form-select form-select-sm rounded-pill status-updater border-0 shadow-sm fw-bold px-3 py-2" 
                                        data-id="{{ $t->id }}" 
                                        style="font-size: 0.75rem; 
                                               transition: all 0.3s ease;
                                               background-color: {{ 
                                                   $t->status == 'Pesanan Masuk' ? '#e7f1ff' : (
                                                   $t->status == 'Sedang Dipacking' ? '#fff3cd' : (
                                                   $t->status == 'Dalam Perjalanan' ? '#cff4fc' : '#d1e7dd')) 
                                               }};
                                               color: {{ 
                                                   $t->status == 'Pesanan Masuk' ? '#0d6efd' : (
                                                   $t->status == 'Sedang Dipacking' ? '#856404' : (
                                                   $t->status == 'Dalam Perjalanan' ? '#055160' : '#0f5132')) 
                                               }};">
                                    <option value="Pesanan Masuk" {{ $t->status == 'Pesanan Masuk' ? 'selected' : '' }}>Pesanan Masuk</option>
                                    <option value="Sedang Dipacking" {{ $t->status == 'Sedang Dipacking' ? 'selected' : '' }}>Sedang Dipacking</option>
                                    <option value="Dalam Perjalanan" {{ $t->status == 'Dalam Perjalanan' ? 'selected' : '' }}>Dalam Perjalanan</option>
                                    <option value="Sudah Sampai Tujuan" {{ $t->status == 'Sudah Sampai Tujuan' ? 'selected' : '' }}>Sudah Sampai</option>
                                </select>
                            </div>
                        </td>

                        <!-- Total Harga -->
                        <td class="py-4 text-center">
                            <div class="fw-bold fs-6 text-success">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</div>
                            <span class="text-muted x-small text-uppercase tracking-tighter" style="font-size: 0.65rem;">VIA: {{ $t->metode_pembayaran }}</span>
                        </td>

                        <!-- Aksi -->
                        <td class="pe-4 py-4 text-end">
                            @php
                                $gmapsQuery = urlencode($t->alamat . ', Desa ' . ($t->kelurahan ?? 'Selorejo') . ', Kec. ' . ($t->kecamatan ?? 'Dau') . ', ' . ($t->kabupaten ?? 'Malang'));
                            @endphp
                            <a href="https://www.google.com/maps/search/?api=1&query={{ $gmapsQuery }}" 
                               target="_blank" 
                               class="btn btn-sm btn-white border shadow-sm rounded-pill px-3 py-2 hover-lift text-decoration-none d-inline-flex align-items-center"
                               data-bs-toggle="popover" 
                               data-bs-trigger="hover"
                               title="Detail Alamat" 
                               data-bs-content="{{ $t->alamat }}, Desa {{ $t->kelurahan ?? 'Selorejo' }}, Kec. {{ $t->kecamatan ?? 'Dau' }}, {{ $t->kabupaten ?? 'Malang' }}, CP: {{ $t->telepon ?? '-' }}">
                                <i data-lucide="map-pin" class="icon-xs text-danger me-1"></i> Lokasi
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted bg-white border-0">
                            <div class="py-5">
                                <i data-lucide="shopping-cart" class="icon-xl opacity-25 mb-3 d-block mx-auto text-success"></i>
                                <h5 class="fw-bold mb-1">Belum Ada Transaksi</h5>
                                <p class="small text-muted mb-0">Saat ini belum ada riwayat pembelian produk UMKM.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Pagination -->
    <div class="card-footer bg-white p-4 border-0 border-top border-light">
        <div class="d-flex justify-content-center">
            {{ $transaksis->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<style>
    .transition-all { transition: all 0.2s ease-in-out; }
    .hover-bg-light:hover { background-color: rgba(45, 106, 79, 0.02) !important; }
    .icon-xl { width: 60px; height: 60px; }
    .tracking-wider { letter-spacing: 0.1rem; }
    .x-small { font-size: 0.65rem; }
    .btn-white { background: #fff; color: #333; }
    .btn-white:hover { background: #f8f9fa; }
    
    /* Custom style for status dropdown on change */
    .status-updater:focus {
        box-shadow: 0 0 0 0.25rem rgba(45, 106, 79, 0.25);
        border-color: var(--primary);
    }
</style>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Init Popovers
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
          return new bootstrap.Popover(popoverTriggerEl)
        });

        // Handle Status Update
        document.querySelectorAll('.status-updater').forEach(select => {
            select.addEventListener('change', function() {
                const id = this.dataset.id;
                const status = this.value;
                const currentSelect = this;
                
                // Visual feedback loading
                currentSelect.classList.add('opacity-50');
                currentSelect.disabled = true;

                fetch(`/operator/produk/transaksi/${id}/status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ status: status })
                })
                .then(response => response.json())
                .then(res => {
                    if(res.success) {
                        // Success Toast
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true
                        });
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        });

                        // Update dynamic colors
                        if(status === 'Pesanan Masuk') {
                            currentSelect.style.backgroundColor = '#e7f1ff'; currentSelect.style.color = '#0d6efd';
                        } else if(status === 'Sedang Dipacking') {
                            currentSelect.style.backgroundColor = '#fff3cd'; currentSelect.style.color = '#856404';
                        } else if(status === 'Dalam Perjalanan') {
                            currentSelect.style.backgroundColor = '#cff4fc'; currentSelect.style.color = '#055160';
                        } else {
                            currentSelect.style.backgroundColor = '#d1e7dd'; currentSelect.style.color = '#0f5132';
                        }
                    } else {
                        Swal.fire('Error', 'Gagal memperbarui status.', 'error');
                    }
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire('Error', 'Terjadi kesalahan pada server.', 'error');
                })
                .finally(() => {
                    currentSelect.classList.remove('opacity-50');
                    currentSelect.disabled = false;
                });
            });
        });
    });
</script>
@endpush
