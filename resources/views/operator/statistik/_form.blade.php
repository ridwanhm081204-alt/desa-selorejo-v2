<div class="mb-3">
    <label class="form-label fw-semibold small">Tahun <span class="text-danger">*</span></label>
    <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $item->tahun ?? date('Y')) }}" min="2000" max="2099" required>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold small">Jenis Data <span class="text-danger">*</span></label>
    <select name="jenis_data" class="form-select" required>
        @foreach(['Pendidikan','Pekerjaan','Agama','Usia','Jenis Kelamin','Lainnya'] as $jenis)
            <option value="{{ $jenis }}" {{ old('jenis_data', $item->jenis_data ?? '') == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold small">Label <span class="text-danger">*</span></label>
    <input type="text" name="label" class="form-control" value="{{ old('label', $item->label ?? '') }}" placeholder="Contoh: SD, SMP, Petani, Islam..." required>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold small">Nilai (Jiwa/Unit) <span class="text-danger">*</span></label>
    <input type="number" name="nilai" class="form-control" value="{{ old('nilai', $item->nilai ?? '') }}" min="0" required>
</div>
