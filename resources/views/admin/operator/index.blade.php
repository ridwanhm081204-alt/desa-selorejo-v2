@extends('layouts.dashboard')
@section('title', 'Manajemen Akun Operator')
@section('content')

<div class="row g-4 text-start">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div class="d-flex align-items-center">
                    <div class="bg-danger bg-opacity-10 text-danger p-3 rounded-4 me-3">
                        <i data-lucide="users" style="width:24px;height:24px;"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Otoritas Akses Operator</h5>
                        <small class="text-muted">Kelola akun staf yang diberikan akses input data desa</small>
                    </div>
                </div>
                <div>
                    <a href="{{ url('/admin/operator/create') }}" class="btn btn-success rounded-pill px-4 fw-bold shadow-sm hover-lift border-0">
                        <i data-lucide="user-plus" class="icon-sm me-1"></i> TAMBAH OPERATOR
                    </a>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light border-bottom">
                            <tr>
                                <th class="ps-4 py-3 text-muted small fw-bold text-uppercase">Informasi Operator</th>
                                <th class="py-3 text-muted small fw-bold text-uppercase">Alamat Email</th>
                                <th class="py-3 text-muted small fw-bold text-uppercase">Tgl Bergabung</th>
                                <th class="text-end pe-4 py-3 text-muted small fw-bold text-uppercase">Aksi Kelola</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($operators as $op)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-3 shadow-sm" style="width:40px; height:40px; background: linear-gradient(45deg, #2d6a4f, #52b788) !important;">
                                            {{ strtoupper(substr($op->name, 0, 1)) }}
                                        </div>
                                        <div class="fw-bold text-dark">{{ $op->name }}</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark px-3 py-2 rounded-pill border">{{ $op->email }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center text-muted">
                                        <i data-lucide="calendar" class="icon-xs me-1 opacity-50"></i>
                                        {{ $op->created_at->translatedFormat('d M Y') }}
                                    </div>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ url('/admin/operator/'.$op->id.'/edit') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 shadow-none hover-lift">
                                            <i data-lucide="edit-3" class="icon-xs me-1"></i> Edit
                                        </a>
                                        <form action="{{ url('/admin/operator/'.$op->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus akun operator ini? Mereka tidak akan bisa login lagi.')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 shadow-none hover-lift">
                                                <i data-lucide="trash-2" class="icon-xs me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="text-muted">
                                        <i data-lucide="user-x" class="mb-3 d-block mx-auto opacity-25" style="width:64px;height:64px;"></i>
                                        <p class="fw-bold mb-0">Belum ada akun operator terdaftar</p>
                                        <small>Silakan tambahkan operator untuk mulai mengisi konten</small>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if(method_exists($operators, 'hasPages') && $operators->hasPages())
            <div class="card-footer bg-white border-0 p-4">
                {{ $operators->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>

        <div class="mt-4 p-4 rounded-4 bg-white shadow-sm border align-items-center d-flex text-start">
            <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-circle me-3">
                <i data-lucide="alert-octagon" class="icon-sm"></i>
            </div>
            <div class="small text-muted">
                Daftar di atas hanya menampilkan pengguna dengan peran <b>Operator</b>. Administrator Utama tidak tercantum dalam daftar ini untuk alasan keamanan.
            </div>
        </div>
    </div>
</div>
@endsection
