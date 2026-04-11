@extends('layouts.public')
@section('title', 'Transparansi APBDes')
@section('breadcrumb')
    <li class="breadcrumb-item">Data Desa</li>
    <li class="breadcrumb-item active">Transparansi</li>
@endsection
@section('content')
<div class="section-hero-gradient pt-5 pb-4 mb-5 text-center text-white" style="min-height: auto;">
    <div class="container position-relative z-1">
        <h1 class="fw-bold mb-3"><i data-lucide="file-text" class="me-2 text-warning"></i>Transparansi APBDes</h1>
        <p class="lead fw-medium text-white-50">Informasi Anggaran Pendapatan dan Belanja Desa</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row g-4">
        <!-- Visualisasi Pie Chart -->
        <div class="col-lg-4">
            <div class="glass-card bg-white p-4 h-100">
                <h5 class="fw-bold text-center text-primary-custom border-bottom pb-2 mb-4">Postur Anggaran (Tahun Ini)</h5>
                <div style="position: relative; height:300px; width:100%">
                    <canvas id="apbdesChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Tabel Detail -->
        <div class="col-lg-8">
            <div class="glass-card bg-white p-4 h-100 table-responsive border-0">
                <h5 class="fw-bold mb-4 text-primary-custom border-bottom pb-2">Rincian APBDes Terkini</h5>
                <table class="table table-hover align-middle mb-0 text-sm">
                    <thead class="bg-primary-custom text-white" style="background: var(--primary);">
                        <tr>
                            <th class="py-3 text-white border-0 rounded-start">Tahun</th>
                            <th class="py-3 text-white border-0">Jenis</th>
                            <th class="py-3 text-white border-0">Bidang</th>
                            <th class="py-3 text-white border-0 text-end">Nominal</th>
                            <th class="py-3 text-white border-0 text-center rounded-end">Dokumen</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($apbdes as $a)
                        <tr class="border-bottom border-success border-opacity-10">
                            <td><span class="badge bg-light text-dark border">{{ $a->tahun }}</span></td>
                            <td>
                                @if($a->jenis == 'pendapatan')
                                    <span class="badge bg-success bg-opacity-25 text-success border border-success"><i data-lucide="arrow-down-left" class="icon-sm me-1"></i> Pendapatan</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-25 text-danger border border-danger"><i data-lucide="arrow-up-right" class="icon-sm me-1"></i> Belanja</span>
                                @endif
                            </td>
                            <td class="fw-medium text-dark">{{ $a->bidang }}</td>
                            <td class="text-end fw-bold text-dark">Rp {{ number_format($a->nominal, 0, ',', '.') }}</td>
                            <td class="text-center">
                                @if($a->dokumen_pdf)
                                    <a href="{{ asset('storage/'.$a->dokumen_pdf) }}" target="_blank" class="btn btn-sm btn-outline-primary py-1 px-2 rounded-3"><i data-lucide="download" class="icon-sm"></i> File</a>
                                @else
                                    <span class="text-muted small"><i data-lucide="minus" class="icon-sm"></i></span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center py-5 text-muted glass-panel border-0">Belum ada data transparansi APBDes yang dipublikasikan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        @php
            $currentYear = date('Y');
            // Menghitung total untuk chart (tahun terkini/terbesar jika ada) // fallback menggunakan semua data tahun terbaru
            $latestYearData = $apbdes->where('tahun', $apbdes->max('tahun'));
            $totalPendapatan = $latestYearData->where('jenis', 'pendapatan')->sum('nominal');
            $totalBelanja = $latestYearData->where('jenis', 'belanja')->sum('nominal');
        @endphp

        const ctx = document.getElementById('apbdesChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pendapatan', 'Belanja'],
                datasets: [{
                    data: [{{ $totalPendapatan }}, {{ $totalBelanja }}],
                    backgroundColor: [
                        '#52b788', // var(--primary-light) -> Success area
                        '#e76f51'  // var(--accent-dark) -> Warning/Danger area
                    ],
                    borderColor: '#ffffff',
                    borderWidth: 2,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            font: { family: 'Inter', size: 13, weight: '500' }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) label += ': ';
                                if (context.raw !== null) {
                                    label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(context.raw);
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection
