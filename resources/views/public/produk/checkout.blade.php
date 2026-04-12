@extends('layouts.public')
@section('title', 'Pemesanan ' . $produk->nama)
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/produk') }}" class="text-decoration-none text-success">Produk</a></li>
    <li class="breadcrumb-item"><a href="{{ route('produk.show', $produk->id) }}" class="text-decoration-none text-success">{{ $produk->nama }}</a></li>
    <li class="breadcrumb-item active">Checkout</li>
@endsection

@section('content')
<div class="container my-5">
    <div class="row g-4">
        <!-- Rincian Produk Side -->
        <div class="col-lg-4 order-lg-2">
            <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 100px; z-index: 100 !important;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Rincian Produk</h5>
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ $produk->gambar_url }}" class="rounded-3 me-3" style="width: 80px; height: 80px; object-fit: cover;">
                        <div>
                            <h6 class="fw-bold mb-1">{{ $produk->nama }}</h6>
                            <span class="text-success fw-bold">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
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
                        <span class="fw-bold fs-5">Total Bayar</span>
                        <span class="fw-bold fs-5 text-success" id="totalDisplay">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="alert alert-info mt-4 p-2 small border-0 rounded-3">
                        <i data-lucide="info" class="me-1" style="width: 14px;"></i> Stok tersedia: <strong>{{ $produk->stok }} Pcs</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Pemesanan -->
        <div class="col-lg-8 order-lg-1">
            <div class="card border-0 shadow-sm rounded-4 text-dark">
                <div class="card-body p-4 p-md-5">
                    <h2 class="fw-bold mb-4 text-dark"><i data-lucide="clipboard-list" class="me-2 text-success"></i>Form Pemesanan</h2>
                    
                    <form id="checkoutForm" class="needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
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

                            <div class="col-md-12">
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
                                <button type="submit" class="btn btn-success btn-lg w-100 py-3 fw-bold rounded-pill shadow" id="submitBtn" disabled>
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
                    confirmButtonColor: '#198754',
                    allowOutsideClick: false
                }).then(() => {
                    // Redirect to WhatsApp
                    const data = res.data;
                    const total = data.jumlah * productPrice;
                    const waNumber = "6289694707982";
                    
                    let message = `*STRUK PESANAN DESA SELOREJO*\n`;
                    message += `_Tanggal: ${tanggalFormatted}_\n\n`;
                    message += `*PRODUK*: ${productName}\n`;
                    message += `*HARGA*: ${formatRupiah(productPrice)}\n`;
                    message += `*JUMLAH*: ${data.jumlah} Pcs\n`;
                    message += `*TOTAL BAYAR*: ${formatRupiah(total)}\n`;
                    message += `--------------------------\n`;
                    message += `*DATA PEMESAN*\n`;
                    message += `Nama: ${data.nama_pemesan}\n`;
                    message += `Alamat: ${data.alamat}, ${data.kelurahan}, ${data.kecamatan}, ${data.kabupaten} (${data.kode_pos})\n`;
                    message += `Maps: ${data.gmaps_link}\n`;
                    message += `\n*PEMBAYARAN*\n`;
                    message += `Metode: ${data.metode_pembayaran}\n`;
                    message += `Status Bukti: Sudah Diunggah (√)\n`;
                    if (data.catatan) message += `\n*CATATAN*\n${data.catatan}\n`;
                    message += `\n_Mohon segera diproses, terima kasih._`;

                    window.open(`https://wa.me/${waNumber}?text=${encodeURIComponent(message)}`, '_blank');
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
