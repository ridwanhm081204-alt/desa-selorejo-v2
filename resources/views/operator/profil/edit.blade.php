@extends('layouts.dashboard')
@section('title', 'Kelola Profil Desa')
@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <form action="{{ url('/operator/profil') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="form-label fw-bold">Sejarah Desa</label>
                <textarea name="sejarah" class="form-control" rows="5">{{ old('sejarah', $profil->sejarah) }}</textarea>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Visi & Misi</label>
                <textarea name="visi_misi" class="form-control" rows="5">{{ old('visi_misi', $profil->visi_misi) }}</textarea>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Kondisi Geografis</label>
                <textarea name="geografi" class="form-control" rows="4">{{ old('geografi', $profil->geografi) }}</textarea>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Batas Wilayah</label>
                <textarea name="batas_wilayah" class="form-control" rows="3">{{ old('batas_wilayah', $profil->batas_wilayah) }}</textarea>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Kode Embed Peta (Google Maps iFrame)</label>
                <textarea name="peta_embed" class="form-control" rows="3" placeholder='<iframe src="https://www.google.com/maps/embed?...'>{{ old('peta_embed', $profil->peta_embed) }}</textarea>
                <small class="text-muted">Tempel tag &lt;iframe&gt; yang didapat dari fitur "Bagikan Peta" Google Maps.</small>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-success px-4 bg-primary-custom hover-lift"><i data-lucide="save" class="me-1" style="width:18px;"></i> Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
