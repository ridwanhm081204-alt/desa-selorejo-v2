@extends('layouts.public')
@section('title', 'Transparansi APBDes')
@section('breadcrumb')
    <li class="breadcrumb-item">Data Desa</li>
    <li class="breadcrumb-item active">Transparansi</li>
@endsection
@section('content')
@include('layouts.partials.page-hero', [
    'title' => $hero['title'] ?? 'Transparansi APBDes',
    'subtitle' => $hero['subtitle'] ?? 'Laporan Anggaran Pendapatan dan Belanja Desa Selorejo Tahun Anggaran 2024.',
    'icon' => $hero['icon'] ?? 'file-text'
])

<div class="container mb-5 pb-5">
    <div class="row g-4">
        <!-- Dashboard Charts Column -->
        <div class="col-xl-5">
            <div class="row g-4">
                <!-- Chart Pendapatan (Doughnut) -->
                <div class="col-12">
                    <div class="glass-card bg-white p-4 shadow-sm border h-100" style="border-top: 5px solid var(--color-forest) !important; border-color: var(--color-forest)1a !important;">
                        <div class="d-flex align-items-center mb-4">
                            <div class="p-2 rounded me-3" style="background-color: rgba(26,92,56,0.1) !important; color: var(--color-forest) !important;"><i data-lucide="trending-up"></i></div>
                            <h5 class="fw-bold text-dark mb-0" style="font-family: var(--font-heading);">Sumber Pendapatan Desa</h5>
                        </div>
                        <div style="height: 300px;">
                            <canvas id="revenuePie"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Chart Belanja (Horizontal Bar) -->
                <div class="col-12">
                    <div class="glass-card bg-white p-4 shadow-sm border h-100" style="border-top: 5px solid var(--accent-orange) !important; border-color: var(--color-forest)1a !important;">
                        <div class="d-flex align-items-center mb-4">
                            <div class="p-2 rounded me-3" style="background-color: rgba(245,124,0,0.1) !important; color: var(--accent-orange) !important;"><i data-lucide="trending-down"></i></div>
                            <h5 class="fw-bold text-dark mb-0" style="font-family: var(--font-heading);">Prioritas Belanja Bidang</h5>
                        </div>
                        <div style="height: 350px;">
                            <canvas id="expenditureBar"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Detail Column -->
        <div class="col-xl-7">
            <div class="glass-card bg-white p-4 p-md-5 h-100 shadow-sm border table-responsive" style="border-color: var(--color-forest)1a !important; font-family: var(--font-body);">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3" style="border-bottom-color: var(--color-forest)1a !important;">
                    <h5 class="fw-bold mb-0 text-dark" style="font-family: var(--font-heading);">Rincian APBDes Selorejo 2024</h5>
                    <span class="badge px-3 py-2 rounded-pill fw-bold" style="background-color: var(--color-forest) !important; color: #fff !important;">TOTAL: Rp {{ number_format($apbdes->where('jenis', 'pendapatan')->sum('nominal'), 0, ',', '.') }}</span>
                </div>

                <table class="table table-hover align-middle mb-0" style="border: 2px solid #111; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: var(--color-forest);">
                            <th class="py-3 fw-bold" style="color: #fff !important; border: 2px solid #111;">Jenis</th>
                            <th class="py-3 fw-bold" style="color: #fff !important; border: 2px solid #111;">Bidang / Sumber</th>
                            <th class="py-3 fw-bold text-end" style="color: #fff !important; border: 2px solid #111;">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($apbdes as $a)
                        <tr>
                            <td style="border: 1.5px solid #333;">
                                @if($a->jenis == 'pendapatan')
                                    <span class="badge px-2 py-1" style="background-color: rgba(26,92,56,0.1) !important; color: var(--color-forest) !important; border: 1px solid rgba(26,92,56,0.2) !important;"><i data-lucide="download" class="icon-xs me-1"></i> Pendapatan</span>
                                @else
                                    <span class="badge px-2 py-1" style="background-color: rgba(245,124,0,0.1) !important; color: var(--accent-orange) !important; border: 1px solid rgba(245,124,0,0.2) !important;"><i data-lucide="upload" class="icon-xs me-1"></i> Belanja</span>
                                @endif
                            </td>
                            <td class="fw-medium text-dark" style="border: 1.5px solid #333;">{{ $a->bidang }}</td>
                            <td class="text-end fw-bold text-dark" style="border: 1.5px solid #333;">Rp {{ number_format($a->nominal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Data Attribution -->
                <div class="mt-5 p-3 rounded-4 bg-light border d-flex align-items-center" style="border-color: var(--color-forest)1a !important;">
                    <i data-lucide="shield-check" class="me-3" style="width: 32px; height: 32px; color: var(--color-forest) !important;"></i>
                    <div>
                        <p class="mb-0 small text-muted lh-sm">Data ini disajikan secara transparan berdasarkan <strong class="text-dark">Pagu Anggaran Resmi Kabupaten Malang</strong> untuk Desa Selorejo Tahun Anggaran 2024.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Global Config
        Chart.defaults.font.family = "'Open Sans', sans-serif";
        Chart.defaults.color = '#555';

        const data = @json($apbdes);

        // Filter Data
        const pendapatan = data.filter(i => i.jenis === 'pendapatan');
        const belanja = data.filter(i => i.jenis === 'belanja');

        // 1. Revenue Doughnut Chart
        new Chart(document.getElementById('revenuePie'), {
            type: 'doughnut',
            data: {
                labels: pendapatan.map(i => i.bidang),
                datasets: [{
                    data: pendapatan.map(i => i.nominal),
                    backgroundColor: ['#1a5c38', '#f5c518', '#f57c00', '#2d6a4f', '#40916c'],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { boxWidth: 12, padding: 15 } }
                }
            }
        });

        // 2. Expenditure Horizontal Bar Chart
        new Chart(document.getElementById('expenditureBar'), {
            type: 'bar',
            data: {
                labels: belanja.map(i => i.bidang),
                datasets: [{
                    label: 'Nominal (Rp)',
                    data: belanja.map(i => i.nominal),
                    backgroundColor: '#1a5c38',
                    borderRadius: 5,
                    hoverBackgroundColor: '#f5c518'
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: { beginAtZero: true, grid: { borderDash: [5, 5] } }
                }
            }
        });
    });
</script>
@endpush
@endsection
