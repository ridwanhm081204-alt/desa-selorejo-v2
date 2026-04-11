@extends('layouts.dashboard')
@section('title', 'Manajemen Operator')
@section('content')
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Daftar Akun Operator</h5>
        <a href="{{ url('/admin/operator/create') }}" class="btn btn-danger hover-lift"><i data-lucide="user-plus" class="me-1" style="width:18px;"></i> Tambah Operator</a>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Nama Lengkap</th>
                        <th>Email</th>
                        <th>Tgl Terdaftar</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($operators as $op)
                    <tr>
                        <td class="ps-4 fw-bold">{{ $op->name }}</td>
                        <td>{{ $op->email }}</td>
                        <td>{{ $op->created_at->format('d M Y') }}</td>
                        <td class="text-end pe-4">
                            <a href="{{ url('/admin/operator/'.$op->id.'/edit') }}" class="btn btn-sm btn-outline-primary"><i data-lucide="edit-2" style="width:14px;"></i></a>
                            <form action="{{ url('/admin/operator/'.$op->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus akun operator ini? Mereka tidak akan bisa login lagi.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i data-lucide="trash-2" style="width:14px;"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-5 text-muted">Belum ada akun operator.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
