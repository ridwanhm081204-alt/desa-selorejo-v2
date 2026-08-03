@extends('layouts.dashboard')
@section('title', 'Upload Galeri')
@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <form action="{{ url('/operator/galeri') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="form-label fw-bold">Pilih Tipe Media</label>
                <select name="tipe" class="form-select" id="mediaTipe" onchange="toggleTipe()" required>
                    <option value="foto" selected>Foto/Gambar</option>
                    <option value="video">Video YouTube</option>
                </select>
            </div>
            
            <div class="mb-4" id="inputFoto">
                <label class="form-label fw-bold">Upload File (Max 2MB)</label>
                <input type="file" name="file_foto" class="form-control" accept="image/*">
            </div>
            
            <div class="mb-4" id="inputVideo" style="display:none;">
                <label class="form-label fw-bold">URL YouTube</label>
                <input type="url" name="url_video" class="form-control" placeholder="https://www.youtube.com/watch?v=...">
            </div>

            <div class="row mb-4">
                <div class="col-md-5">
                    <label class="form-label fw-bold">Keterangan (Caption)</label>
                    <input type="text" name="caption" class="form-control" placeholder="Tulis keterangan singkat...">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Kategori / Tag</label>
                    <select name="kategori" class="form-select" required>
                        <option value="Potensi Desa">Potensi Desa</option>
                        <option value="Wisata Alam">Wisata Alam</option>
                        <option value="Kegiatan Warga">Kegiatan Warga</option>
                        <option value="Infrastruktur">Infrastruktur</option>
                        <option value="Event">Event & Festival</option>
                        <option value="Umum">Umum</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
            </div>

            <div class="text-end">
                <a href="{{ url('/operator/galeri') }}" class="btn btn-outline-secondary px-4 me-2">Batal</a>
                <button type="submit" class="btn btn-success px-4 bg-primary-custom hover-lift"><i data-lucide="upload" class="me-1" style="width:18px;"></i> Upload Media</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function toggleTipe() {
    let t = document.getElementById('mediaTipe').value;
    if(t === 'foto') {
        document.getElementById('inputFoto').style.display = 'block';
        document.getElementById('inputVideo').style.display = 'none';
        document.querySelector('input[name="file_foto"]').setAttribute('required', 'true');
        document.querySelector('input[name="url_video"]').removeAttribute('required');
    } else {
        document.getElementById('inputFoto').style.display = 'none';
        document.getElementById('inputVideo').style.display = 'block';
        document.querySelector('input[name="url_video"]').setAttribute('required', 'true');
        document.querySelector('input[name="file_foto"]').removeAttribute('required');
    }
}
toggleTipe();
</script>
@endpush
@endsection
