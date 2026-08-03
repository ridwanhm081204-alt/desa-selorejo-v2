@extends('layouts.dashboard')
@section('title', 'Edit Berita')
@push('styles')
<style>
    .foto-existing-grid, .foto-preview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 12px;
        margin-top: 12px;
    }
    .foto-item {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        aspect-ratio: 4/3;
        background: #f1f5f9;
        border: 2px solid #e2e8f0;
        transition: border-color 0.2s;
    }
    .foto-item.cover-item {
        border-color: #198754;
        box-shadow: 0 0 0 2px #19875440;
    }
    .foto-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .foto-item .remove-btn {
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
    .foto-item .remove-btn:hover { background: #dc3545; }
    .foto-item .cover-badge {
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
        padding: 22px 20px;
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
    .foto-counter .count { color: #198754; font-size: 16px; }
    #foto-input-edit { display: none; }
    .pending-remove-overlay {
        position: absolute;
        inset: 0;
        background: rgba(220,53,69,0.55);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 3;
        border-radius: 8px;
    }
    .pending-remove-overlay span {
        background: #dc3545;
        color: white;
        font-size: 10px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 20px;
    }
</style>
@endpush
@section('content')

<div class="row justify-content-center text-start">
    <div class="col-lg-10 col-xl-9">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <!-- Header Card -->
            <div class="card-header bg-white border-0 p-4 d-flex align-items-center border-bottom">
                <div class="bg-success bg-opacity-10 text-success p-2 rounded-3 me-3">
                    <i data-lucide="edit-3" class="icon-sm"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0 text-dark">Edit Konten Berita</h5>
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

                <form action="{{ url('/operator/berita/' . $berita->id) }}" method="POST" enctype="multipart/form-data" id="form-edit-berita">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-8">
                            <label class="form-label fw-bold text-muted small">JUDUL BERITA</label>
                            <input type="text" name="judul" class="form-control rounded-3 py-2 fw-bold @error('judul') is-invalid @enderror" value="{{ old('judul', $berita->judul) }}" placeholder="Contoh: Peresmian Pasar Desa Selorejo..." required>
                            @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-muted small">KATEGORI</label>
                            <select name="kategori" class="form-select rounded-3 py-2 fw-bold" required>
                                <option value="Kegiatan Desa" {{ old('kategori', $berita->kategori) == 'Kegiatan Desa' ? 'selected' : '' }}>Kegiatan Desa</option>
                                <option value="Pariwisata" {{ old('kategori', $berita->kategori) == 'Pariwisata' ? 'selected' : '' }}>Pariwisata</option>
                                <option value="Ekonomi & UMKM" {{ old('kategori', $berita->kategori) == 'Ekonomi & UMKM' ? 'selected' : '' }}>Ekonomi & UMKM</option>
                                <option value="Pembangunan" {{ old('kategori', $berita->kategori) == 'Pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                                <option value="Sosial" {{ old('kategori', $berita->kategori) == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                                <option value="Pengumuman" {{ old('kategori', $berita->kategori) == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted small">ISI KONTEN BERITA</label>
                        <textarea name="konten" class="form-control rounded-4 p-4 shadow-none rich-text" rows="12" placeholder="Tuliskan berita secara lengkap di sini..." required>{{ old('konten', $berita->konten) }}</textarea>
                        <div class="mt-2 d-flex align-items-center text-muted small">
                            <i data-lucide="info" class="icon-xs me-1"></i> Tips: Gunakan paragraf yang jelas untuk memudahkan pembaca.
                        </div>
                    </div>

                    <!-- Foto Section -->
                    <div class="mb-4 p-4 bg-light rounded-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <label class="form-label fw-bold text-muted small mb-0">FOTO BERITA</label>
                                <div class="text-muted small mt-1">Maks. 10 foto &bull; Foto pertama otomatis jadi <strong class="text-success">cover</strong></div>
                            </div>
                            <span class="foto-counter">
                                Total: <span class="count" id="foto-total">0</span>/10
                            </span>
                        </div>

                        @php
                            $fotosExisting = $berita->fotos()->orderBy('urutan')->get();
                            $hasMultiFoto  = $fotosExisting->isNotEmpty();
                        @endphp

                        <!-- Foto Yang Sudah Ada -->
                        <div class="mb-3">
                            <div class="small fw-bold text-muted mb-2">📸 Foto Tersimpan</div>

                            @if($hasMultiFoto)
                                <div class="foto-existing-grid" id="existing-grid">
                                    @foreach($fotosExisting as $i => $foto)
                                        <div class="foto-item {{ $i === 0 ? 'cover-item' : '' }}" id="foto-card-{{ $foto->id }}">
                                            <img src="{{ $foto->url }}" alt="foto {{ $i+1 }}" onerror="this.src='{{ asset('images/hero_desa.png') }}'">
                                            @if($i === 0) <span class="cover-badge">COVER</span> @endif
                                            @if($fotosExisting->count() > 1)
                                                <button type="button" class="remove-btn" data-foto-id="{{ $foto->id }}" title="Hapus foto ini">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                                </button>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                {{-- Berita lama (hanya punya gambar di kolom gambar) --}}
                                <div class="foto-existing-grid">
                                    <div class="foto-item cover-item">
                                        <img src="{{ $berita->gambar_url }}" alt="cover" onerror="this.src='{{ asset('images/hero_desa.png') }}'">
                                        <span class="cover-badge">COVER</span>
                                    </div>
                                </div>
                                <div class="text-muted small mt-2">
                                    <i data-lucide="info" class="icon-xs me-1"></i> Ini berita lama. Tambahkan foto baru di bawah untuk menambah galeri foto.
                                </div>
                            @endif
                        </div>

                        <!-- Hidden inputs untuk foto yang akan dihapus (diisi oleh JS) -->
                        <div id="hapus-foto-container"></div>

                        <!-- Upload Foto Baru -->
                        <div class="mt-3">
                            <div class="small fw-bold text-muted mb-2">➕ Tambah Foto Baru</div>
                            <div class="foto-upload-zone" id="upload-zone-edit" onclick="document.getElementById('foto-input-edit').click()">
                                <i data-lucide="image-plus" style="width:28px;height:28px;color:#94a3b8;"></i>
                                <div class="mt-1 fw-semibold text-muted small">Klik atau seret foto ke sini</div>
                                <div class="text-muted" style="font-size:11px;">JPG, PNG, WEBP, HEIC &bull; Maks 10MB per foto</div>
                            </div>
                            <input type="file" id="foto-input-edit" accept="image/*,.heic,.heif" multiple style="display:none;">
                            <div class="foto-preview-grid d-none mt-2" id="foto-preview-grid-edit"></div>
                        </div>

                        <!-- Container untuk hidden file inputs (diisi JS saat submit) -->
                        <div id="new-foto-files-container"></div>

                        @error('fotos') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
                        @error('fotos.*') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
                    </div>

                    <div class="row g-4 mb-5 p-4 bg-light rounded-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small">TANGGAL PUBLISH</label>
                            <input type="date" name="tanggal" class="form-control rounded-3" value="{{ old('tanggal', $berita->tanggal) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small">STATUS PUBLIKASI</label>
                            <select name="status_publish" class="form-select rounded-3 py-2 fw-bold text-success" required>
                                <option value="publish" {{ old('status_publish', $berita->status_publish) == 'publish' ? 'selected' : '' }}>Publikasikan Langsung</option>
                                <option value="draft" {{ old('status_publish', $berita->status_publish) == 'draft' ? 'selected' : '' }}>Simpan Sebagai Draft</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center border-top pt-4">
                        <a href="{{ url('/operator/berita') }}" class="btn btn-light rounded-pill px-4 fw-bold">
                            <i data-lucide="arrow-left" class="icon-sm me-1"></i> BATAL
                        </a>
                        <button type="submit" class="btn btn-success rounded-pill px-5 py-2 fw-bold shadow-sm hover-lift border-0">
                            <i data-lucide="save" class="icon-sm me-1"></i> SIMPAN PERUBAHAN
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
    const EXISTING_COUNT  = {{ $fotosExisting->count() ?: 1 }};
    const MAX_PHOTOS      = 10;
    const form            = document.getElementById('form-edit-berita');
    const zone            = document.getElementById('upload-zone-edit');
    const grid            = document.getElementById('foto-preview-grid-edit');
    const totalEl         = document.getElementById('foto-total');
    const hapusContainer  = document.getElementById('hapus-foto-container');
    const filePickerInput = document.getElementById('foto-input-edit');

    let markedForRemoval = new Set();  // set of foto IDs
    let newFiles = [];                 // array of File objects to upload

    /* -------- Update total counter -------- */
    function updateTotal() {
        const current = EXISTING_COUNT - markedForRemoval.size + newFiles.length;
        totalEl.textContent = current;
        totalEl.style.color = current >= MAX_PHOTOS ? '#dc3545' : '#198754';
    }

    /* -------- Mark/unmark existing foto for removal -------- */
    document.querySelectorAll('.remove-btn[data-foto-id]').forEach(btn => {
        btn.addEventListener('click', function() {
            const fotoId = parseInt(this.dataset.fotoId);
            const card   = document.getElementById('foto-card-' + fotoId);

            if (markedForRemoval.has(fotoId)) {
                // Unmark
                markedForRemoval.delete(fotoId);
                card.querySelector('.pending-remove-overlay')?.remove();
                this.style.background = 'rgba(220,53,69,0.9)';
                hapusContainer.querySelector(`input[value="${fotoId}"]`)?.remove();
            } else {
                // Mark for removal
                const minFoto = EXISTING_COUNT - markedForRemoval.size + newFiles.length;
                if (minFoto <= 1) {
                    alert('Berita harus memiliki minimal 1 foto!');
                    return;
                }
                markedForRemoval.add(fotoId);
                const overlay = document.createElement('div');
                overlay.className = 'pending-remove-overlay';
                overlay.innerHTML = '<span>AKAN DIHAPUS</span>';
                card.appendChild(overlay);
                this.style.background = '#198754';

                const inp  = document.createElement('input');
                inp.type   = 'hidden';
                inp.name   = 'hapus_foto[]';
                inp.value  = fotoId;
                hapusContainer.appendChild(inp);
            }
            updateTotal();
        });
    });

    /* -------- Render new file previews -------- */
    function renderNewPreviews() {
        grid.innerHTML = '';
        grid.classList.toggle('d-none', newFiles.length === 0);

        newFiles.forEach((file, i) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'foto-item';
                div.innerHTML = `
                    <img src="${e.target.result}" alt="baru ${i+1}">
                    <button type="button" class="remove-btn" data-new-idx="${i}" title="Hapus">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </button>
                `;
                div.querySelector('.remove-btn').addEventListener('click', function() {
                    const idx = parseInt(this.dataset.newIdx);
                    newFiles.splice(idx, 1);
                    renderNewPreviews();
                    updateTotal();
                });
                grid.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
        updateTotal();
    }

    /* -------- Add new files -------- */
    function addNewFiles(incoming) {
        const currentTotal = EXISTING_COUNT - markedForRemoval.size + newFiles.length;
        const remaining    = MAX_PHOTOS - currentTotal;
        if (remaining <= 0) {
            alert('Sudah mencapai batas maksimal 10 foto!');
            return;
        }
        const filtered = Array.from(incoming).filter(f => f.type.startsWith('image/'));
        const toAdd    = filtered.slice(0, remaining);
        if (filtered.length > remaining) {
            alert(`Hanya ${remaining} foto yang bisa ditambahkan.`);
        }
        newFiles = newFiles.concat(toAdd);
        renderNewPreviews();
    }

    /* -------- File picker -------- */
    filePickerInput.addEventListener('change', function() {
        if (this.files.length > 0) addNewFiles(this.files);
        // Safe to clear: we already copied files into newFiles array
        this.value = '';
    });

    /* -------- Drag & Drop -------- */
    zone.addEventListener('dragover',  e => { e.preventDefault(); zone.classList.add('drag-over'); });
    zone.addEventListener('dragleave', () => zone.classList.remove('drag-over'));
    zone.addEventListener('drop', e => {
        e.preventDefault();
        zone.classList.remove('drag-over');
        addNewFiles(e.dataTransfer.files);
    });

    /* -------- Form submit: inject new files via hidden input -------- */
    form.addEventListener('submit', function() {
        if (typeof tinymce !== 'undefined') {
            tinymce.triggerSave();
        }

        const container = document.getElementById('new-foto-files-container');
        container.innerHTML = '';

        if (newFiles.length > 0) {
            const dt = new DataTransfer();
            newFiles.forEach(f => dt.items.add(f));

            const hiddenInput    = document.createElement('input');
            hiddenInput.type     = 'file';
            hiddenInput.name     = 'fotos[]';
            hiddenInput.multiple = true;
            hiddenInput.style.display = 'none';
            hiddenInput.files    = dt.files;
            container.appendChild(hiddenInput);
        }
    });

    // Init counter
    updateTotal();
})();
</script>
@endpush
