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
                    <div class="glass-card bg-white p-4 shadow-sm border-0 border-top border-4 border-success h-100">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-success bg-opacity-10 p-2 rounded me-3"><i data-lucide="trending-up" class="text-success"></i></div>
                            <h5 class="fw-bold text-dark mb-0">Sumber Pendapatan Desa</h5>
                        </div>
                        <div style="height: 300px;">
                            <canvas id="revenuePie"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Chart Belanja (Horizontal Bar) -->
                <div class="col-12">
                    <div class="glass-card bg-white p-4 shadow-sm border-0 border-top border-4 border-danger h-100">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-danger bg-opacity-10 p-2 rounded me-3"><i data-lucide="trending-down" class="text-danger"></i></div>
                            <h5 class="fw-bold text-dark mb-0">Prioritas Belanja Bidang</h5>
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
            <div class="glass-card bg-white p-4 p-md-5 h-100 shadow-sm border-0 table-responsive">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                    <h5 class="fw-bold mb-0 text-dark">Rincian APBDes Selorejo 2024</h5>
                    <span class="badge bg-success px-3 py-2 rounded-pill fw-bold">TOTAL: Rp {{ number_format($apbdes->where('jenis', 'pendapatan')->sum('nominal'), 0, ',', '.') }}</span>
                </div>

                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 text-dark fw-bold border-0">Jenis</th>
                            <th class="py-3 text-dark fw-bold border-0">Bidang / Sumber</th>
                            <th class="py-3 text-dark fw-bold border-0 text-end">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($apbdes as $a)
                        <tr class="border-bottom border-light">
                            <td>
                                @if($a->jenis == 'pendapatan')
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-10 px-2 py-1"><i data-lucide="download" class="icon-xs me-1"></i> Pendapatan</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-10 px-2 py-1"><i data-lucide="upload" class="icon-xs me-1"></i> Belanja</span>
                                @endif
                            </td>
                            <td class="fw-medium text-dark">{{ $a->bidang }}</td>
                            <td class="text-end fw-bold text-dark">Rp {{ number_format($a->nominal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Data Attribution -->
                <div class="mt-5 p-3 rounded-4 bg-light border border-success border-opacity-10 d-flex align-items-center">
                    <i data-lucide="shield-check" class="text-success me-3" style="width: 32px; height: 32px;"></i>
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
        Chart.defaults.font.family = "'Outfit', sans-serif";
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
                    backgroundColor: ['#1b4332', '#2d6a4f', '#40916c', '#52b788', '#95d5b2'],
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
                    backgroundColor: '#e76f51',
                    borderRadius: 5,
                    hoverBackgroundColor: '#d62828'
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
