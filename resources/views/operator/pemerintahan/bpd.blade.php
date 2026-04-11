@extends('layouts.dashboard')
@section('title', 'Data BPD')
@section('content')
<div class="dash-card bg-white p-4">
    <div class="d-flex justify-content-between mb-4">
        <h5 class="fw-bold">Data Anggota BPD</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Tambah BPD</button>
    </div>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jabatan }}</td>
                <td>
                    <form action="{{ route('operator.bpd.destroy', $item->id) }}" method="POST" class="d-inline">
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
    <form action="{{ route('operator.bpd.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header"><h5 class="modal-title">Tambah BPD</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body">
        <div class="mb-3"><label>Nama Lengkap</label><input type="text" name="nama" class="form-control" required></div>
        <div class="mb-3"><label>Jabatan</label><input type="text" name="jabatan" class="form-control" required></div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection
