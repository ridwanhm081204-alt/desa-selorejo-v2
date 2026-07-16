{{-- Partial: _table_rt_rw.blade.php --}}
{{-- Dipakai oleh tab "Semua", "Hanya RT", dan "Hanya RW" --}}
<div class="card border-0 shadow-sm rounded-4 overflow-hidden text-start mb-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-uppercase">
                    <tr>
                        <th class="ps-4 py-3 small fw-bold text-muted" style="width: 8%">Jenis</th>
                        <th class="py-3 small fw-bold text-muted" style="width: 25%">Nama Ketua</th>
                        <th class="py-3 small fw-bold text-muted">Dusun & Lokasi</th>
                        <th class="py-3 small fw-bold text-muted text-center" style="width: 10%">Foto</th>
                        <th class="py-3 small fw-bold text-muted text-center" style="width: 8%">Urutan</th>
                        <th class="text-end pe-4 py-3 small fw-bold text-muted" style="width: 13%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rows as $item)
                    <tr>
                        <td class="ps-4 py-3">
                            @if($item->jenis === 'RT')
                                <span class="badge rounded-pill bg-success bg-opacity-10 text-success px-3 py-1 fw-bold">RT {{ str_pad($item->nomor,2,'0',STR_PAD_LEFT) }}</span>
                            @else
                                <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary px-3 py-1 fw-bold">RW {{ str_pad($item->nomor,2,'0',STR_PAD_LEFT) }}</span>
                            @endif
                        </td>
                        <td class="py-3 fw-bold text-dark">{{ $item->nama }}</td>
                        <td class="py-3 text-muted small">
                            <div class="fw-medium text-dark">{{ $item->dusun }}</div>
                            @if($item->jenis === 'RT')
                                <span class="text-muted">RT.{{ str_pad($item->nomor_rt,2,'0',STR_PAD_LEFT) }} / RW.{{ str_pad($item->nomor_rw,2,'0',STR_PAD_LEFT) }}</span>
                            @else
                                <span class="text-muted">RW.{{ str_pad($item->nomor_rw,2,'0',STR_PAD_LEFT) }}</span>
                            @endif
                        </td>
                        <td class="py-3 text-center">
                            @if($item->foto)
                                <img src="{{ asset('storage/'.$item->foto) }}" class="rounded-circle shadow-sm border border-2 border-white" style="width:40px; height:40px; object-fit:cover;">
                            @else
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm" style="width:40px; height:40px;">
                                    <i data-lucide="{{ $item->jenis === 'RT' ? 'map-pin' : 'layers' }}" class="text-muted opacity-50 icon-xs"></i>
                                </div>
                            @endif
                        </td>
                        <td class="py-3 text-center">
                            <span class="badge bg-light text-dark border">{{ $item->urutan }}</span>
                        </td>
                        <td class="text-end pe-4 py-3">
                            <div class="d-flex justify-content-end gap-2">
                                <button class="btn btn-sm btn-white border shadow-sm hover-lift" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}" title="Edit">
                                    <i data-lucide="edit-3" class="icon-xs text-primary"></i>
                                </button>
                                <form action="{{ route('operator.perangkat-rt-rw.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data {{ $item->jenis }} {{ $item->nomor }} ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-white border shadow-sm hover-lift" title="Hapus">
                                        <i data-lucide="trash-2" class="icon-xs text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted bg-white">
                            <i data-lucide="map-pin" class="icon-xl opacity-25 mb-2 d-block mx-auto text-success"></i>
                            Belum ada data RT/RW yang diinput.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
