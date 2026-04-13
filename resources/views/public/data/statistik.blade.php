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
            <div class="glass-card bg-white p-4 h-100 shadow-sm border-0 border-top border-4 border-success">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-success bg-opacity-10 p-2 rounded me-3"><i data-lucide="users" class="text-success"></i></div>
                    <h5 class="fw-bold text-dark mb-0">Distribusi Jenis Kelamin</h5>
                </div>
                <div style="height: 300px;">
                    <canvas id="genderChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="glass-card bg-white p-4 h-100 shadow-sm border-0 border-top border-4 border-success">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-success bg-opacity-10 p-2 rounded me-3"><i data-lucide="heart" class="text-success"></i></div>
                    <h5 class="fw-bold text-dark mb-0">Komposisi Agama</h5>
                </div>
                <div style="height: 300px;">
                    <canvas id="religionChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Kelompok Usia (Full Width or Large) -->
        <div class="col-12">
            <div class="glass-card bg-white p-4 p-md-5 shadow-sm border-0 border-top border-4 border-success">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-success bg-opacity-10 p-2 rounded me-3"><i data-lucide="activity" class="text-success"></i></div>
                    <h5 class="fw-bold text-dark mb-0">Struktur Kelompok Usia</h5>
                </div>
                <div style="height: 400px;">
                    <canvas id="ageChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Pendidikan & Pekerjaan (Horizontal Bar Grid) -->
        <div class="col-lg-6">
            <div class="glass-card bg-white p-4 h-100 shadow-sm border-0 border-top border-4 border-success">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-success bg-opacity-10 p-2 rounded me-3"><i data-lucide="graduation-cap" class="text-success"></i></div>
                    <h5 class="fw-bold text-dark mb-0">Tingkat Pendidikan Terakhir</h5>
                </div>
                <div style="height: 350px;">
                    <canvas id="educationChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="glass-card bg-white p-4 h-100 shadow-sm border-0 border-top border-4 border-success">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-success bg-opacity-10 p-2 rounded me-3"><i data-lucide="briefcase" class="text-success"></i></div>
                    <h5 class="fw-bold text-dark mb-0">Mata Pencaharian Utama</h5>
                </div>
                <div style="height: 350px;">
                    <canvas id="jobChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Sumber Data Attribution -->
    <div class="mt-5 text-center">
        <div class="d-inline-flex align-items-center bg-light p-2 px-4 rounded-pill border shadow-sm">
            <i data-lucide="database" class="icon-sm text-success me-2"></i>
            <span class="text-muted small fw-medium">Sumber Data: <strong class="text-dark">BPS Kabupaten Malang (Publikasi Kecamatan Dau Dalam Angka 2023)</strong> & Monografi Desa Selorejo.</span>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Global Options
        Chart.defaults.color = '#555';
        Chart.defaults.font.family = "'Outfit', sans-serif";

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
                    backgroundColor: ['#2d6a4f', '#74c69d'],
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
                    backgroundColor: ['#1b4332', '#40916c', '#95d5b2'],
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
                    backgroundColor: '#40916c',
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
                    backgroundColor: '#52b788',
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
                    backgroundColor: '#2d6a4f',
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
