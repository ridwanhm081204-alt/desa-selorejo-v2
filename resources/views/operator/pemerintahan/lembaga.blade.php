@extends('layouts.dashboard')
@section('title', 'Data Lembaga Desa')
@section('content')
<div class="dash-card bg-white p-4">
    <div class="d-flex justify-content-between mb-4">
        <h5 class="fw-bold">Data Lembaga Masyarakat</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Lembaga</button>
    </div>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Lembaga</th>
                <th>Jenis</th>
                <th>Ketua</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item->nama_lembaga }}</td>
                <td>{{ $item->jenis }}</td>
                <td>{{ $item->ketua }}</td>
                <td>
                    <form action="{{ route('operator.lembaga.destroy', $item->id) }}" method="POST" class="d-inline">
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
    <form action="{{ route('operator.lembaga.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header"><h5 class="modal-title">Tambah Lembaga</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body">
        <div class="mb-3"><label>Nama Lembaga</label><input type="text" name="nama_lembaga" class="form-control" required></div>
        <div class="mb-3"><label>Jenis Lembaga</label><input type="text" name="jenis" class="form-control" required></div>
        <div class="mb-3"><label>Ketua Lembaga</label><input type="text" name="ketua" class="form-control" required></div>
        <div class="mb-3"><label>Deskripsi Singkat</label><textarea name="deskripsi" class="form-control"></textarea></div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection
