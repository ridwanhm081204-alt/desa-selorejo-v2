@extends('layouts.public')
@section('title', 'Statistik Penduduk')
@section('breadcrumb')
    <li class="breadcrumb-item">Data Desa</li>
    <li class="breadcrumb-item active">Statistik Penduduk</li>
@endsection
@section('content')
<div class="section-hero-gradient pt-5 pb-4 mb-5 text-center text-white" style="min-height: auto;">
    <div class="container position-relative z-1">
        <h1 class="fw-bold mb-3"><i data-lucide="bar-chart-2" class="me-2 text-warning"></i>Statistik Demografi Desa</h1>
        <p class="lead fw-medium text-white-50">Transparansi data penduduk Desa Wisata Selorejo</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="glass-card bg-white p-4 p-md-5">
                <h4 class="fw-bold mb-4 text-center text-primary-custom border-bottom pb-3">Distribusi Penduduk</h4>
                
                <div style="position: relative; height:400px; width:100%">
                    <canvas id="statistikChart"></canvas>
                </div>
                
                <div class="mt-5 row text-center g-3">
                    @forelse($statistik as $stat)
                    <div class="col-6 col-md-3">
                        <div class="p-3 border rounded-3 bg-light bg-opacity-50 border-success border-opacity-25">
                            <h6 class="text-muted mb-1">{{ $stat->label }}</h6>
                            <h3 class="fw-bold text-success mb-0">{{ number_format($stat->nilai, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-muted">Belum ada data detail statistik.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('statistikChart').getContext('2d');
        
        let gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(82, 183, 136, 0.8)'); // primary-light
        gradient.addColorStop(1, 'rgba(45, 106, 79, 0.8)'); // primary

        @php
            $labels = $statistik->pluck('label');
            $values = $statistik->pluck('nilai');
        @endphp

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Jumlah Jiwa',
                    data: {!! json_encode($values) !!},
                    backgroundColor: gradient,
                    borderColor: '#1b4332',
                    borderWidth: 1,
                    borderRadius: 6,
                    hoverBackgroundColor: '#2d6a4f'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(27, 67, 50, 0.9)',
                        padding: 10,
                        titleFont: { size: 14 },
                        bodyFont: { size: 14, weight: 'bold' }
                    }
                },
                scales: {
                    y: { 
                        beginAtZero: true,
                        grid: { borderDash: [5, 5] }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection
