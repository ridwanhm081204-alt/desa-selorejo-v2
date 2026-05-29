@extends('layouts.public')
@section('title', 'Statistik Penduduk')
@section('breadcrumb')
    <li class="breadcrumb-item">Data Desa</li>
    <li class="breadcrumb-item active">Statistik Penduduk</li>
@endsection
@section('content')
@include('layouts.partials.page-hero', [
    'title' => $hero['title'] ?? 'Statistik Demografi Desa',
    'subtitle' => $hero['subtitle'] ?? 'Transparansi data penduduk Desa Wisata Selorejo berdasarkan angka riil kependudukan.',
    'icon' => $hero['icon'] ?? 'bar-chart-2'
])

<div class="container mb-5 pb-5">
    <div class="row g-4">
        <!-- Gender & Agama (Small Charts Row) -->
        <div class="col-lg-6">
            <div class="glass-card bg-white p-4 h-100 shadow-sm border" style="border-top: 5px solid var(--color-forest) !important; border-color: var(--color-forest)1a !important;">
                <div class="d-flex align-items-center mb-4">
                    <div class="p-2 rounded me-3" style="background-color: rgba(26,92,56,0.1) !important; color: var(--color-forest) !important;"><i data-lucide="users"></i></div>
                    <h5 class="fw-bold text-dark mb-0" style="font-family: var(--font-heading);">Distribusi Jenis Kelamin</h5>
                </div>
                <div style="height: 300px;">
                    <canvas id="genderChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="glass-card bg-white p-4 h-100 shadow-sm border" style="border-top: 5px solid var(--color-forest) !important; border-color: var(--color-forest)1a !important;">
                <div class="d-flex align-items-center mb-4">
                    <div class="p-2 rounded me-3" style="background-color: rgba(26,92,56,0.1) !important; color: var(--color-forest) !important;"><i data-lucide="heart"></i></div>
                    <h5 class="fw-bold text-dark mb-0" style="font-family: var(--font-heading);">Komposisi Agama</h5>
                </div>
                <div style="height: 300px;">
                    <canvas id="religionChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Kelompok Usia (Full Width or Large) -->
        <div class="col-12">
            <div class="glass-card bg-white p-4 p-md-5 shadow-sm border" style="border-top: 5px solid var(--color-forest) !important; border-color: var(--color-forest)1a !important;">
                <div class="d-flex align-items-center mb-4">
                    <div class="p-2 rounded me-3" style="background-color: rgba(26,92,56,0.1) !important; color: var(--color-forest) !important;"><i data-lucide="activity"></i></div>
                    <h5 class="fw-bold text-dark mb-0" style="font-family: var(--font-heading);">Struktur Kelompok Usia</h5>
                </div>
                <div style="height: 400px;">
                    <canvas id="ageChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Pendidikan & Pekerjaan (Horizontal Bar Grid) -->
        <div class="col-lg-6">
            <div class="glass-card bg-white p-4 h-100 shadow-sm border" style="border-top: 5px solid var(--color-forest) !important; border-color: var(--color-forest)1a !important;">
                <div class="d-flex align-items-center mb-4">
                    <div class="p-2 rounded me-3" style="background-color: rgba(26,92,56,0.1) !important; color: var(--color-forest) !important;"><i data-lucide="graduation-cap"></i></div>
                    <h5 class="fw-bold text-dark mb-0" style="font-family: var(--font-heading);">Tingkat Pendidikan Terakhir</h5>
                </div>
                <div style="height: 350px;">
                    <canvas id="educationChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="glass-card bg-white p-4 h-100 shadow-sm border" style="border-top: 5px solid var(--color-forest) !important; border-color: var(--color-forest)1a !important;">
                <div class="d-flex align-items-center mb-4">
                    <div class="p-2 rounded me-3" style="background-color: rgba(26,92,56,0.1) !important; color: var(--color-forest) !important;"><i data-lucide="briefcase"></i></div>
                    <h5 class="fw-bold text-dark mb-0" style="font-family: var(--font-heading);">Mata Pencaharian Utama</h5>
                </div>
                <div style="height: 350px;">
                    <canvas id="jobChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Sumber Data Attribution -->
    <div class="mt-5 text-center">
        <div class="d-inline-flex align-items-center bg-light p-2 px-4 rounded-pill border shadow-sm" style="border-color: var(--color-forest)1a !important;">
            <i data-lucide="database" class="icon-sm me-2" style="color: var(--color-forest) !important;"></i>
            <span class="text-muted small fw-medium" style="font-family: var(--font-body);">Sumber Data: <strong class="text-dark">BPS Kabupaten Malang (Publikasi Kecamatan Dau Dalam Angka 2023)</strong> & Monografi Desa Selorejo.</span>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Global Options
        Chart.defaults.color = '#555';
        Chart.defaults.font.family = "'Open Sans', sans-serif";

        const stats = @json($statistik);

        // Helper to get labels and values
        const getChartData = (category) => {
            const data = stats[category] || [];
            return {
                labels: data.map(item => item.label),
                values: data.map(item => item.nilai)
            };
        };

        // 1. Gender Chart (Doughnut)
        const gender = getChartData('gender');
        new Chart(document.getElementById('genderChart'), {
            type: 'doughnut',
            data: {
                labels: gender.labels,
                datasets: [{
                    data: gender.values,
                    backgroundColor: ['#1a5c38', '#f5c518'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        // 2. Religion Chart (Pie)
        const religion = getChartData('agama');
        new Chart(document.getElementById('religionChart'), {
            type: 'pie',
            data: {
                labels: religion.labels,
                datasets: [{
                    data: religion.values,
                    backgroundColor: ['#1a5c38', '#f5c518', '#f57c00', '#2d6a4f', '#40916c'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        // 3. Age Chart (Vertical Bar)
        const age = getChartData('usia');
        new Chart(document.getElementById('ageChart'), {
            type: 'bar',
            data: {
                labels: age.labels,
                datasets: [{
                    label: 'Jumlah Jiwa',
                    data: age.values,
                    backgroundColor: '#1a5c38',
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // 4. Education Chart (Horizontal Bar)
        const education = getChartData('pendidikan');
        new Chart(document.getElementById('educationChart'), {
            type: 'bar',
            data: {
                labels: education.labels,
                datasets: [{
                    label: 'Jumlah Jiwa',
                    data: education.values,
                    backgroundColor: '#f5c518',
                    borderRadius: 5
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                scales: { 
                    x: { beginAtZero: true }
                }
            }
        });

        // 5. Job Chart (Horizontal Bar)
        const job = getChartData('pekerjaan');
        new Chart(document.getElementById('jobChart'), {
            type: 'bar',
            data: {
                labels: job.labels,
                datasets: [{
                    label: 'Jumlah Jiwa',
                    data: job.values,
                    backgroundColor: '#1a5c38',
                    borderRadius: 5
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                scales: { 
                    x: { beginAtZero: true }
                }
            }
        });
    });
</script>
@endpush
@endsection
