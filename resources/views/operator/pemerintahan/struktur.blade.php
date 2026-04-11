@extends('layouts.dashboard')
@section('title', 'Data Struktur Organisasi')
@section('content')
<div class="dash-card bg-white p-4">
    <div class="d-flex justify-content-between mb-4">
        <h5 class="fw-bold">Data Aparat Desa</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Aparat</button>
    </div>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Jabatan</th>
                <th>Nama</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item->urutan }}</td>
                <td>{{ $item->jabatan }}</td>
                <td>{{ $item->nama_pejabat }}</td>
                <td>
                    @if($item->foto)
                        <img src="{{ asset('storage/'.$item->foto) }}" width="50">
                    @endif
                </td>
                <td>
                    <form action="{{ route('operator.struktur.destroy', $item->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="addModal" tabindex="-1">
  <div class="modal-dialog">
    <form action="{{ route('operator.struktur.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
      @csrf
      <div class="modal-header"><h5 class="modal-title">Tambah Aparat</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body">
        <div class="mb-3"><label>Jabatan</label><input type="text" name="jabatan" class="form-control" required></div>
        <div class="mb-3"><label>Nama Pejabat</label><input type="text" name="nama_pejabat" class="form-control" required></div>
        <div class="mb-3"><label>Urutan Penempatan (Angka)</label><input type="number" name="urutan" class="form-control" required></div>
        <div class="mb-3"><label>Foto</label><input type="file" name="foto" class="form-control"></div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection
