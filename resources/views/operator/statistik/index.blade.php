@extends('layouts.dashboard')
@section('title', 'Statistik Penduduk')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-1">Data Statistik Penduduk</h5>
        <small class="text-muted">Kelola data demografis & statistik desa</small>
    </div>
    <a href="{{ route('operator.statistik.create') }}" class="btn btn-success d-flex align-items-center gap-2">
        <i data-lucide="plus" style="width:16px;"></i> Tambah Data
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success d-flex align-items-center gap-2 mb-4">
        <i data-lucide="check-circle" style="width:16px;"></i> {{ session('success') }}
    </div>
@endif

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Tahun</th>
                    <th>Jenis Data</th>
                    <th>Label</th>
                    <th>Nilai</th>
                    <th class="text-end pe-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($statistik as $item)
                    <tr>
                        <td class="ps-4">{{ $item->tahun }}</td>
                        <td><span class="badge bg-success bg-opacity-10 text-success">{{ $item->jenis_data }}</span></td>
                        <td>{{ $item->label }}</td>
                        <td class="fw-bold">{{ number_format($item->nilai) }}</td>
                        <td class="text-end pe-4">
                            <a href="{{ route('operator.statistik.edit', $item->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                <i data-lucide="edit-2" style="width:14px;"></i>
                            </a>
                            <form action="{{ route('operator.statistik.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i data-lucide="trash-2" style="width:14px;"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-5">
                            <i data-lucide="bar-chart-2" style="width:40px;height:40px;opacity:0.3;" class="d-block mx-auto mb-2"></i>
                            Belum ada data statistik.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
