@extends('layouts.dashboard')
@section('title', 'Transparansi APBDes')
@section('content')
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Manajemen Dokumen APBDes</h5>
        <a href="{{ url('/operator/apbdes/create') }}" class="btn btn-success bg-primary-custom hover-lift"><i data-lucide="plus" class="me-1" style="width:18px;"></i> Tambah Data APBDes</a>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Tahun</th>
                        <th>Jenis Anggaran</th>
                        <th>Bidang Kegiatan</th>
                        <th>Nominal</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($apbdes as $a)
                    <tr>
                        <td class="ps-4 fw-bold">{{ $a->tahun }}</td>
                        <td><span class="badge bg-{{ $a->jenis == 'pendapatan' ? 'success' : 'danger' }}">{{ ucfirst($a->jenis) }}</span></td>
                        <td>{{ $a->bidang }}</td>
                        <td class="fw-bold text-dark">Rp {{ number_format($a->nominal, 0, ',', '.') }}</td>
                        <td class="text-end pe-4">
                            @if($a->dokumen_pdf)
                                <a href="{{ asset('storage/'.$a->dokumen_pdf) }}" target="_blank" class="btn btn-sm btn-outline-secondary" title="Lihat PDF"><i data-lucide="file-text" style="width:14px;"></i></a>
                            @endif
                            <a href="{{ url('/operator/apbdes/'.$a->id.'/edit') }}" class="btn btn-sm btn-outline-primary"><i data-lucide="edit-2" style="width:14px;"></i></a>
                            <form action="{{ url('/operator/apbdes/'.$a->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data APBDes ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm"><i data-lucide="trash-2" style="width:14px;"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-5 text-muted">Belum ada data APBDes.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white p-3 border-0">
        {{ $apbdes->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
