@extends('layouts.public')
@section('title', 'Pemesanan ' . $produk->nama)
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/produk') }}" class="text-decoration-none" style="color: var(--color-forest) !important; font-family: var(--font-body);">Produk</a></li>
    <li class="breadcrumb-item"><a href="{{ route('produk.show', $produk->id) }}" class="text-decoration-none" style="color: var(--color-forest) !important; font-family: var(--font-body);">{{ $produk->nama }}</a></li>
    <li class="breadcrumb-item active" style="font-family: var(--font-body);">Checkout</li>
@endsection

@section('content')
<div class="container my-5">
    <div class="row g-4">
        <!-- Rincian Produk Side -->
        <div class="col-lg-4 order-lg-2">
            <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 100px; z-index: 100 !important; border-top: 4px solid var(--color-forest) !important;">
                <div class="card-body p-4" style="font-family: var(--font-body);">
                    <h5 class="fw-bold mb-4" style="font-family: var(--font-heading);">Rincian Produk</h5>
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ $produk->gambar_url }}" class="rounded-3 me-3" style="width: 80px; height: 80px; object-fit: cover;">
                        <div>
                            <h6 class="fw-bold mb-1" style="font-family: var(--font-heading);">{{ $produk->nama }}</h6>
                            <span class="fw-bold" style="color: var(--color-forest) !important;">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <hr class="my-4 opacity-50">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Harga Satuan</span>
                        <span id="priceDisplay">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Jumlah (Pcs)</span>
                        <span id="qtyDisplay">1</span>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <span class="fw-bold fs-5" style="font-family: var(--font-heading);">Total Bayar</span>
                        <span class="fw-bold fs-5" style="color: var(--color-forest) !important; font-family: var(--font-heading);" id="totalDisplay">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="alert mt-4 p-2 small border-0 rounded-3" style="background-color: var(--color-cream) !important; color: var(--color-forest) !important;">
                        <i data-lucide="info" class="me-1" style="width: 14px;"></i> Stok tersedia: <strong>{{ $produk->stok }} Pcs</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Pemesanan -->
        <div class="col-lg-8 order-lg-1">
            <div class="card border-0 shadow-sm rounded-4 text-dark" style="border-top: 4px solid var(--color-forest) !important;">
                <div class="card-body p-4 p-md-5">
                    <h2 class="fw-bold mb-4 text-dark" style="font-family: var(--font-heading);"><i data-lucide="clipboard-list" class="me-2" style="color: var(--color-forest) !important;"></i>Form Pemesanan</h2>
                    
                    <form id="checkoutForm" class="needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3" style="font-family: var(--font-body);">
                            <!-- Tanggal Otomatis -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark"><i data-lucide="calendar" class="me-1"></i> Tanggal Pemesanan</label>
                                <input type="text" class="form-control bg-light text-dark fw-bold" value="{{ date('d F Y') }}" readonly>
                                <input type="hidden" name="tanggal" value="{{ date('Y-m-d') }}">
                            </div>
                            
                            <!-- Data Diri -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark"><i data-lucide="user" class="me-1"></i> Nama Lengkap Pemesan</label>
                                <input type="text" name="nama_pemesan" class="form-control rounded-3 text-dark border-dark" placeholder="Masukkan nama Anda" required>
                                <div class="invalid-feedback">Nama wajib diisi.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark"><i data-lucide="phone" class="me-1"></i> Nomor WhatsApp (Aktif)</label>
                                <input type="text" name="telepon" class="form-control rounded-3 text-dark border-dark" placeholder="Contoh: 08123456789" required>
                                <div class="invalid-feedback">Nomor WhatsApp wajib diisi untuk koordinasi pengiriman.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark"><i data-lucide="package" class="me-1"></i> Jumlah (Pcs)</label>
                                <input type="number" name="jumlah" id="qtyInput" class="form-control rounded-3 text-dark border-dark fw-bold" value="1" min="1" max="{{ $produk->stok }}" required>
                                <div class="small text-muted mb-2">Maksimal pembelian: {{ $produk->stok }} Pcs (sesuai stok tersedia).</div>
                                <div class="invalid-feedback">Minimal 1 dan maksimal {{ $produk->stok }}.</div>
                            </div>

                            <!-- Alamat -->
                            <div class="col-12">
                                <label class="form-label fw-bold text-dark"><i data-lucide="map-pin" class="me-1"></i> Alamat Lengkap (Jalan / No. Rumah)</label>
                                <textarea name="alamat" class="form-control rounded-3 text-dark border-dark" rows="2" placeholder="Contoh: Jl. Mawar No. 123" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark"><i data-lucide="home" class="me-1"></i> Kelurahan / Desa</label>
                                <input type="text" name="kelurahan" class="form-control rounded-3 text-dark border-dark" placeholder="Nama Kelurahan" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark"><i data-lucide="building" class="me-1"></i> Kecamatan</label>
                                <input type="text" name="kecamatan" class="form-control rounded-3 text-dark border-dark" placeholder="Nama Kecamatan" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark"><i data-lucide="landmark" class="me-1"></i> Kabupaten / Kota</label>
                                <input type="text" name="kabupaten" class="form-control rounded-3 text-dark border-dark" placeholder="Nama Kabupaten" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark"><i data-lucide="hash" class="me-1"></i> Kode Pos</label>
                                <input type="text" name="kode_pos" class="form-control rounded-3 text-dark border-dark" placeholder="xxxxx" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold text-dark"><i data-lucide="map" class="me-1"></i> Link Google Maps Alamat</label>
                                <input type="url" name="gmaps_link" class="form-control rounded-3 text-dark border-dark" placeholder="https://goo.gl/maps/..." required>
                                <div class="invalid-feedback">Sertakan link gmaps agar pengiriman lebih akurat.</div>
                            </div>

                            <!-- Pembayaran -->
                            <div class="col-md-6 mt-4">
                                <label class="form-label fw-bold text-dark"><i data-lucide="credit-card" class="me-1"></i> Metode Pembayaran</label>
                                <select name="metode_pembayaran" class="form-select rounded-3 text-dark border-dark" required>
                                    <option value="" disabled selected>Pilih Pembayaran</option>
                                    <option value="Transfer Bank">Transfer Bank</option>
                                    <option value="E-Money (Dana/OVO/ShopeePay)">E-Money (Dana/OVO/ShopeePay)</option>
                                    <option value="COD (Cash on Delivery)">COD (Cash on Delivery)</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="form-label fw-bold text-dark"><i data-lucide="image" class="me-1"></i> Upload Bukti Pembayaran (Maks 5MB)</label>
                                <input type="file" name="bukti_pembayaran" id="buktiInput" class="form-control rounded-3 text-dark border-dark" accept="image/*" required>
                                <div id="fileError" class="text-danger small mt-1 d-none">File harus berupa gambar dan maksimal 5MB!</div>
                            </div>

                            <div class="col-12 mt-4">
                                <label class="form-label fw-bold text-dark"><i data-lucide="message-square" class="me-1"></i> Catatan Pesanan</label>
                                <textarea name="catatan" class="form-control rounded-3 text-dark border-dark" rows="2" placeholder="Catatan tambahan (opsional)"></textarea>
                            </div>

                            <div class="col-12 mt-5 text-center">
                                <p class="small text-muted mb-3"><i data-lucide="shield-check" class="me-1"></i> Pastikan semua data sudah terisi dengan benar untuk mengaktifkan tombol beli.</p>
                                <button type="submit" class="btn btn-lg w-100 py-3 fw-bold rounded-pill shadow" style="background-color: var(--color-forest) !important; color: #fff !important; font-family: var(--font-heading); border: none;" id="submitBtn" disabled>
                                    <i data-lucide="shopping-cart" class="me-2"></i> <span id="btnText">Beli Sekarang</span>
                                    <span id="btnLoading" class="spinner-border spinner-border-sm d-none" role="status"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const productPrice = {{ $produk->harga }};
    const productName = "{{ $produk->nama }}";
    const qtyInput = document.getElementById('qtyInput');
    const qtyDisplay = document.getElementById('qtyDisplay');
    const totalDisplay = document.getElementById('totalDisplay');
    const form = document.getElementById('checkoutForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnLoading = document.getElementById('btnLoading');
    const buktiInput = document.getElementById('buktiInput');
    const fileError = document.getElementById('fileError');

    // Format Rupiah
    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(number);
    }

    // Real-time Validity Check (Enable/Disable Button)
    function checkFormValidity() {
        const isInputsValid = form.checkValidity();
        let isFileValid = true;

        if (buktiInput.files.length > 0) {
            const fileSize = buktiInput.files[0].size / 1024 / 1024; // MB
            if (fileSize > 5) {
                fileError.classList.remove('d-none');
                isFileValid = false;
            } else {
                fileError.classList.add('d-none');
                isFileValid = true;
            }
        } else {
            isFileValid = false;
        }

        submitBtn.disabled = !(isInputsValid && isFileValid);
    }

    // Listeners for activity
    form.querySelectorAll('input, textarea, select').forEach(input => {
        input.addEventListener('input', checkFormValidity);
        input.addEventListener('change', checkFormValidity);
    });

    // Update Total Display
    qtyInput.addEventListener('input', function() {
        let qty = parseInt(this.value) || 0;
        if (qty < 1) qty = 1;
        qtyDisplay.innerText = qty;
        totalDisplay.innerText = formatRupiah(qty * productPrice);
    });

    // Form Handling
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!form.checkValidity()) {
            e.stopPropagation();
            form.classList.add('was-validated');
            return;
        }

        const formData = new FormData(form);
        const tanggalFormatted = document.querySelector('input[value="{{ date("d F Y") }}"]').value;
        
        // UI Loading
        submitBtn.disabled = true;
        btnText.innerText = 'Memproses...';
        btnLoading.classList.remove('d-none');

        // Send to Backend for Stock Decrease
        fetch("{{ route('produk.process', $produk->id) }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(res => {
            if (res.success) {
                // Success Modal
                Swal.fire({
                    title: 'Pembelian Berhasil!',
                    text: 'Detail pesanan anda akan dikirimkan ke WhatsApp penjual.',
                    icon: 'success',
                    confirmButtonText: 'Kirim Struk ke WhatsApp',
                    confirmButtonColor: '#1a5c38',
                    allowOutsideClick: false
                }).then(() => {
                    // Redirect to WhatsApp using URL from server (contains transaction details)
                    if (res.whatsapp_url) {
                        window.open(res.whatsapp_url, '_blank');
                    }
                    window.location.href = "{{ route('produk.index') }}";
                });
            } else {
                Swal.fire('Gagal!', res.message, 'error');
            }
        })
        .catch(err => {
            console.error(err);
            Swal.fire('Terjadi Kesalahan!', 'Gagal memproses pesanan. Coba lagi nanti.', 'error');
        })
        .finally(() => {
            submitBtn.disabled = false;
            btnText.innerText = 'Beli Sekarang';
            btnLoading.classList.add('d-none');
            checkFormValidity();
        });
    });
</script>
@endpush
