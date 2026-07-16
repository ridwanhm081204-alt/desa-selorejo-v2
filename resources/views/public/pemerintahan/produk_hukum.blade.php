@extends('layouts.public')
@section('title', 'Produk Hukum')
@section('breadcrumb')
    <li class="breadcrumb-item">Pemerintahan</li>
    <li class="breadcrumb-item active">Produk Hukum</li>
@endsection
@section('content')
@include('layouts.partials.page-hero', [
    'title' => $hero['title'] ?? 'Produk Hukum',
    'subtitle' => $hero['subtitle'] ?? 'Kumpulan Peraturan Desa, Keputusan Kepala Desa, dan Dokumen Hukum Lainnya.',
    'icon' => $hero['icon'] ?? 'scale'
])

<div class="container mb-5 pb-5">
    <div class="glass-card bg-white p-4 p-md-5 rounded-4 border-0 shadow-sm">
        <div class="text-center mb-5">
            <span class="badge px-3 py-2 rounded-pill fw-bold mb-2 border border-opacity-10" style="background-color: rgba(26,92,56,0.1) !important; color: var(--color-forest) !important; border-color: rgba(26,92,56,0.1) !important; font-family: var(--font-body);">Regulasi Desa</span>
            <h3 class="fw-bold text-dark" style="font-family: var(--font-heading);">Daftar Produk Hukum Desa Selorejo</h3>
        </div>

        <div class="table-responsive">
            <table class="table align-middle" style="font-family: var(--font-body);">
                <thead style="background-color: var(--color-forest);">
                    <tr>
                        <th class="py-3 px-4 text-white text-uppercase fw-bold small" style="letter-spacing: 0.5px; width: 45%;">Judul Produk Hukum</th>
                        <th class="py-3 px-4 text-white text-uppercase fw-bold small" style="letter-spacing: 0.5px;">Jenis</th>
                        <th class="py-3 px-4 text-white text-uppercase fw-bold small text-center" style="letter-spacing: 0.5px;">Tahun</th>
                        <th class="py-3 px-4 text-white text-uppercase fw-bold small text-center" style="letter-spacing: 0.5px;">Ditetapkan</th>
                        <th class="py-3 px-4 text-white text-uppercase fw-bold small text-end" style="letter-spacing: 0.5px; width: 15%;">Dokumen</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produkHukum as $item)
                    <tr class="bg-hover-light transition-all" style="border-bottom: 1px solid rgba(0,0,0,0.05);">
                        <td class="py-4 px-4 fw-bold text-dark lh-sm">
                            {{ $item->judul }}
                        </td>
                        <td class="py-4 px-4">
                            <span class="badge bg-success-subtle text-success border border-success border-opacity-25 px-2 py-1 rounded-pill shadow-sm">
                                <i data-lucide="tag" class="icon-xs me-1"></i>{{ $item->jenis }}
                            </span>
                        </td>
                        <td class="py-4 px-4 fw-medium text-dark text-center">
                            {{ $item->tahun }}
                        </td>
                        <td class="py-4 px-4 text-muted text-center small">
                            {{ $item->tanggal_ditetapkan ? \Carbon\Carbon::parse($item->tanggal_ditetapkan)->translatedFormat('d F Y') : '-' }}
                        </td>
                        <td class="py-4 px-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                @if($item->konten)
                                    <button class="btn btn-sm btn-outline-success rounded-pill shadow-sm px-3 hover-lift d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#bacaModal{{ $item->id }}">
                                        <i data-lucide="book-open" class="icon-xs me-1"></i> Baca
                                    </button>
                                @endif
                                @if($item->dokumen_pdf)
                                    <a href="{{ asset('storage/'.$item->dokumen_pdf) }}" target="_blank" class="btn btn-sm btn-success rounded-pill shadow-sm px-3 hover-lift d-inline-flex align-items-center">
                                        <i data-lucide="download" class="icon-xs me-1"></i> Unduh
                                    </a>
                                @endif
                                @if(!$item->konten && !$item->dokumen_pdf)
                                    <span class="text-muted small italic opacity-75">Tidak tersedia</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i data-lucide="folder-open" class="icon-xl text-muted opacity-25 mb-3 d-block mx-auto" style="width:48px;height:48px;"></i>
                            <span class="text-muted" style="font-family: var(--font-body);">Belum ada produk hukum yang dipublikasikan.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($produkHukum as $item)
    @if($item->konten)
    <!-- Modal Baca Konten -->
    <div class="modal fade" id="bacaModal{{ $item->id }}" tabindex="-1" aria-labelledby="bacaModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-bottom border-success border-opacity-25 bg-light pb-3">
                    <h5 class="modal-title fw-bold text-dark" id="bacaModalLabel{{ $item->id }}" style="font-family: var(--font-heading);">{{ $item->judul }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 p-md-5 bg-white text-dark" style="font-family: var(--font-body); font-size: 1rem; line-height: 1.8;">
                    {!! $item->konten !!}
                </div>
                <div class="modal-footer border-0 bg-light">
                    <button type="button" class="btn btn-secondary rounded-pill px-4 shadow-sm" data-bs-dismiss="modal">Tutup</button>
                    @if($item->dokumen_pdf)
                        <a href="{{ asset('storage/'.$item->dokumen_pdf) }}" target="_blank" class="btn btn-success rounded-pill px-4 shadow-sm">
                            <i data-lucide="download" class="icon-xs me-1"></i> Unduh PDF
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
@endforeach

@endsection
