<div class="mb-4">
    <label class="form-label fw-bold text-muted small">TAHUN DATA <span class="text-danger">*</span></label>
    <div class="input-group bg-light rounded-3 overflow-hidden border">
        <span class="input-group-text bg-transparent border-0"><i data-lucide="calendar" class="icon-xs text-muted"></i></span>
        <input type="number" name="tahun" class="form-control border-0 bg-transparent shadow-none py-2 fw-bold" value="{{ old('tahun', $item->tahun ?? date('Y')) }}" min="2000" max="2099" required>
    </div>
</div>

<div class="mb-4">
    <label class="form-label fw-bold text-muted small">PROFIL / JENIS DATA <span class="text-danger">*</span></label>
    <select name="jenis_data" class="form-select rounded-3 py-2 fw-bold text-success border-2 border-success border-opacity-10 shadow-none bg-light" required>
        @foreach(['Pendidikan','Pekerjaan','Agama','Usia','Jenis Kelamin','Lainnya'] as $jenis)
            <option value="{{ $jenis }}" {{ old('jenis_data', $item->jenis_data ?? '') == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label class="form-label fw-bold text-muted small">LABEL INFORMASI <span class="text-danger">*</span></label>
    <div class="input-group bg-light rounded-3 overflow-hidden border">
        <span class="input-group-text bg-transparent border-0"><i data-lucide="tag" class="icon-xs text-muted"></i></span>
        <input type="text" name="label" class="form-control border-0 bg-transparent shadow-none py-2" value="{{ old('label', $item->label ?? '') }}" placeholder="Contoh: Petani, Wiraswasta, Islam..." required>
    </div>
</div>

<div class="mb-0">
    <label class="form-label fw-bold text-muted small">NILAI / JUMLAH (JIWA/UNIT) <span class="text-danger">*</span></label>
    <div class="input-group bg-light rounded-3 overflow-hidden border">
        <span class="input-group-text bg-transparent border-0"><i data-lucide="users" class="icon-xs text-muted"></i></span>
        <input type="number" name="nilai" class="form-control border-0 bg-transparent shadow-none py-2 fw-bold" value="{{ old('nilai', $item->nilai ?? '') }}" min="0" placeholder="0" required>
    </div>
</div>
