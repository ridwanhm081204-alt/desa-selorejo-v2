@extends('layouts.dashboard')
@section('title', 'Tulis Berita Baru')
@push('styles')
<style>
    .foto-preview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 12px;
        margin-top: 12px;
    }
    .foto-preview-item {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        aspect-ratio: 4/3;
        background: #f1f5f9;
        border: 2px solid #e2e8f0;
        transition: border-color 0.2s;
    }
    .foto-preview-item:first-child {
        border-color: #198754;
        box-shadow: 0 0 0 2px #19875440;
    }
    .foto-preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .foto-preview-item .remove-btn {
        position: absolute;
        top: 4px;
        right: 4px;
        background: rgba(220,53,69,0.9);
        border: none;
        color: white;
        border-radius: 50%;
        width: 26px;
        height: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 13px;
        transition: background 0.2s;
        z-index: 2;
    }
    .foto-preview-item .remove-btn:hover { background: #dc3545; }
    .foto-preview-item .cover-badge {
        position: absolute;
        bottom: 4px;
        left: 4px;
        background: #198754;
        color: white;
        font-size: 9px;
        font-weight: 700;
        padding: 2px 7px;
        border-radius: 20px;
        letter-spacing: 0.5px;
    }
    .foto-upload-zone {
        border: 2px dashed #cbd5e1;
        border-radius: 12px;
        padding: 28px 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.25s ease;
        background: #f8fafc;
    }
    .foto-upload-zone:hover, .foto-upload-zone.drag-over {
        border-color: #198754;
        background: #f0fdf4;
    }
    .foto-counter {
        font-size: 13px;
        font-weight: 600;
        color: #64748b;
    }
    .foto-counter .count {
        color: #198754;
        font-size: 16px;
    }
    #foto-input { display: none; }
</style>
@endpush
@section('content')

<div class="row justify-content-center text-start">
    <div class="col-lg-10 col-xl-9">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <!-- Header Card -->
            <div class="card-header bg-white border-0 p-4 d-flex align-items-center border-bottom">
                <div class="bg-success bg-opacity-10 text-success p-2 rounded-3 me-3">
                    <i data-lucide="plus-circle" class="icon-sm"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0 text-dark">Tulis Berita Baru</h5>
                    <small class="text-muted">Pastikan judul dan konten berita informatif bagi warga</small>
                </div>
            </div>

            <div class="card-body p-4 p-md-5">
                @if($errors->any())
                    <div class="alert alert-danger rounded-3 mb-4">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ url('/operator/berita') }}" method="POST" enctype="multipart/form-data" id="form-berita">
                    @csrf
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-8">
                            <label class="form-label fw-bold text-muted small">JUDUL BERITA</label>
                            <input type="text" name="judul" class="form-control rounded-3 py-2 fw-bold @error('judul') is-invalid @enderror" value="{{ old('judul') }}" placeholder="Contoh: Peresmian Pasar Desa Selorejo..." required>
                            @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small">KATEGORI</label>
                            <select name="kategori" class="form-select rounded-3 py-2 fw-bold" required>
                                <option value="Kegiatan Desa" {{ old('kategori') == 'Kegiatan Desa' ? 'selected' : '' }}>Kegiatan Desa</option>
                                <option value="Pariwisata" {{ old('kategori') == 'Pariwisata' ? 'selected' : '' }}>Pariwisata</option>
                                <option value="Ekonomi & UMKM" {{ old('kategori') == 'Ekonomi & UMKM' ? 'selected' : '' }}>Ekonomi & UMKM</option>
                                <option value="Pembangunan" {{ old('kategori') == 'Pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                                <option value="Sosial" {{ old('kategori') == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                                <option value="Pengumuman" {{ old('kategori') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted small">ISI KONTEN BERITA</label>
                        <textarea name="konten" class="form-control rounded-4 p-4 shadow-none rich-text" rows="12" placeholder="Tuliskan berita secara lengkap di sini..." required>{{ old('konten') }}</textarea>
                        <div class="mt-2 d-flex align-items-center text-muted small">
                            <i data-lucide="info" class="icon-xs me-1"></i> Tips: Gunakan paragraf yang jelas untuk memudahkan pembaca.
                        </div>
                    </div>

                    <!-- Multi-Photo Upload -->
                    <div class="mb-4 p-4 bg-light rounded-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <label class="form-label fw-bold text-muted small mb-0">FOTO BERITA</label>
                                <div class="text-muted small mt-1">Maks. 10 foto &bull; Foto pertama otomatis jadi <strong class="text-success">cover</strong></div>
                            </div>
                            <span class="foto-counter"><span class="count" id="foto-count">0</span>/10 foto</span>
                        </div>

                        <!-- Upload Zone -->
                        <div class="foto-upload-zone" id="upload-zone" onclick="document.getElementById('foto-input').click()">
                            <i data-lucide="image-plus" style="width:36px;height:36px;color:#94a3b8;"></i>
                            <div class="mt-2 fw-semibold text-muted">Klik atau seret foto ke sini</div>
                            <div class="text-muted small">JPG, PNG, WEBP, HEIC &bull; Maks 10MB per foto</div>
                        </div>

                        {{--
                            PENTING: input ini TIDAK menggunakan name="fotos[]" karena kita kelola via DataTransfer.
                            Files dimasukkan ke hidden inputs via JS sebelum submit.
                        --}}
                        <input type="file" id="foto-input" accept="image/*,.heic,.heif" multiple style="display:none;">

                        <!-- Preview Grid -->
                        <div class="foto-preview-grid d-none" id="foto-preview-grid"></div>

                        <!-- Container untuk hidden inputs yang berisi file sebenarnya (diisi JS saat submit) -->
                        <div id="foto-files-container"></div>

                        @error('fotos') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
                        @error('fotos.0') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
                    </div>

                    <div class="row g-4 mb-5 p-4 bg-light rounded-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small">TANGGAL PUBLISH</label>
                            <input type="date" name="tanggal" class="form-control rounded-3" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small">STATUS PUBLIKASI</label>
                            <select name="status_publish" class="form-select rounded-3 py-2 fw-bold text-success" required>
                                <option value="publish" {{ old('status_publish') == 'publish' ? 'selected' : '' }}>Publikasikan Langsung</option>
                                <option value="draft" {{ old('status_publish') == 'draft' ? 'selected' : '' }}>Simpan Sebagai Draft</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center border-top pt-4">
                        <a href="{{ url('/operator/berita') }}" class="btn btn-light rounded-pill px-4 fw-bold">
                            <i data-lucide="arrow-left" class="icon-sm me-1"></i> BATAL
                        </a>
                        <button type="submit" id="btn-submit" class="btn btn-success rounded-pill px-5 py-2 fw-bold shadow-sm hover-lift border-0">
                            <i data-lucide="save" class="icon-sm me-1"></i> SIMPAN BERITA
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function() {
    const zone       = document.getElementById('upload-zone');
    const grid       = document.getElementById('foto-preview-grid');
    const countEl    = document.getElementById('foto-count');
    const form       = document.getElementById('form-berita');
    const filePickerInput = document.getElementById('foto-input');
    const MAX_PHOTOS = 10;

    // Kita simpan file-file yang dipilih user di sini
    let selectedFiles = [];

    /* -------- UI helpers -------- */
    function updateCount() {
        const n = selectedFiles.length;
        countEl.textContent = n;
        countEl.style.color = n >= MAX_PHOTOS ? '#dc3545' : '#198754';
        grid.classList.toggle('d-none', n === 0);
    }

    function isImageFile(f) {
        if (!f) return false;
        if (f.type && f.type.startsWith('image/')) return true;
        const ext = (f.name || '').split('.').pop().toLowerCase();
        return ['jpg', 'jpeg', 'png', 'gif', 'webp', 'heic', 'heif', 'bmp', 'svg'].includes(ext);
    }

    function renderPreviews() {
        grid.innerHTML = '';
        selectedFiles.forEach((file, i) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'foto-preview-item';
                div.dataset.index = i;
                const fallbackSvg = `data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 24 24' fill='none' stroke='%23166534' stroke-width='2'><rect x='3' y='3' width='18' height='18' rx='2'/><circle cx='8.5' cy='8.5' r='1.5'/><polyline points='21 15 16 10 5 21'/></svg>`;
                div.innerHTML = `
                    <img src="${e.target.result}" alt="foto ${i+1}" onerror="this.onerror=null; this.src='${fallbackSvg}';">
                    ${i === 0 ? '<span class="cover-badge">COVER</span>' : ''}
                    <button type="button" class="remove-btn" data-idx="${i}" title="Hapus foto ini">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </button>
                `;
                // Attach remove handler
                div.querySelector('.remove-btn').addEventListener('click', function() {
                    const idx = parseInt(this.dataset.idx);
                    selectedFiles.splice(idx, 1);
                    renderPreviews();
                    updateCount();
                });
                grid.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
        updateCount();
    }

    /* -------- Add files -------- */
    function addFiles(newFiles) {
        const remaining = MAX_PHOTOS - selectedFiles.length;
        if (remaining <= 0) {
            alert('Maksimal 10 foto per berita!');
            return;
        }
        const validFiles = Array.from(newFiles).filter(isImageFile);
        if (validFiles.length === 0) {
            alert('File yang dipilih bukan gambar yang didukung! Silakan pilih foto (JPG, PNG, WEBP, HEIC).');
            return;
        }

        const toAdd = validFiles.slice(0, remaining);

        if (validFiles.length > remaining) {
            alert(`Hanya ${remaining} foto yang bisa ditambahkan (maks 10).`);
        }

        selectedFiles = selectedFiles.concat(toAdd);
        renderPreviews();
    }

    /* -------- File picker -------- */
    filePickerInput.addEventListener('change', function() {
        if (this.files && this.files.length > 0) {
            addFiles(this.files);
        }
        this.value = '';
    });

    /* -------- Drag & Drop -------- */
    zone.addEventListener('dragover',  e => { e.preventDefault(); zone.classList.add('drag-over'); });
    zone.addEventListener('dragleave', () => zone.classList.remove('drag-over'));
    zone.addEventListener('drop', e => {
        e.preventDefault();
        zone.classList.remove('drag-over');
        if (e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files.length > 0) {
            addFiles(e.dataTransfer.files);
        }
    });

    /* -------- Form Submit: inject files via DataTransfer -------- */
    form.addEventListener('submit', function(e) {
        if (typeof tinymce !== 'undefined') {
            tinymce.triggerSave();
        }

        if (selectedFiles.length === 0) {
            e.preventDefault();
            alert('Minimal 1 foto harus diupload!');
            return;
        }

        // Buat satu <input type="file"> tersembunyi dengan semua file via DataTransfer
        const container = document.getElementById('foto-files-container');
        container.innerHTML = ''; // Clear sebelumnya

        const dt = new DataTransfer();
        selectedFiles.forEach(f => dt.items.add(f));

        const hiddenInput = document.createElement('input');
        hiddenInput.type     = 'file';
        hiddenInput.name     = 'fotos[]';
        hiddenInput.multiple = true;
        hiddenInput.style.display = 'none';
        hiddenInput.files    = dt.files;
        container.appendChild(hiddenInput);
    });
})();
</script>
@endpush
