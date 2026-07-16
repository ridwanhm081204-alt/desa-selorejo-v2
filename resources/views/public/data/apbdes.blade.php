@extends('layouts.public')
@section('title', 'Transparansi APBDes')
@section('breadcrumb')
    <li class="breadcrumb-item">Data Desa</li>
    <li class="breadcrumb-item active">Transparansi</li>
@endsection
@section('content')

@php
    // Kelompokkan tahun yang tersedia
    $years = $apbdes->pluck('tahun')->unique()->sortDesc();
    $selectedYear = request('tahun', $years->first() ?? 2026);
    $selectedApbdes = $apbdes->where('tahun', $selectedYear);

    $pendapatan = $selectedApbdes->where('jenis', 'pendapatan');
    $belanja = $selectedApbdes->where('jenis', 'belanja');
    $penerimaan = $selectedApbdes->where('jenis', 'pembiayaan_penerimaan');
    $pengeluaran = $selectedApbdes->where('jenis', 'pembiayaan_pengeluaran');

    // Total Nominal Akhir
    $totalPendapatanSemula = $pendapatan->sum('nominal_semula');
    $totalPendapatanPerubahan = $pendapatan->sum('nominal_perubahan');
    $totalPendapatan = $pendapatan->sum('nominal');

    $totalBelanjaSemula = $belanja->sum('nominal_semula');
    $totalBelanjaPerubahan = $belanja->sum('nominal_perubahan');
    $totalBelanja = $belanja->sum('nominal');

    $totalPenerimaanSemula = $penerimaan->sum('nominal_semula');
    $totalPenerimaanPerubahan = $penerimaan->sum('nominal_perubahan');
    $totalPenerimaan = $penerimaan->sum('nominal');

    $totalPengeluaranSemula = $pengeluaran->sum('nominal_semula');
    $totalPengeluaranPerubahan = $pengeluaran->sum('nominal_perubahan');
    $totalPengeluaran = $pengeluaran->sum('nominal');

    $nettoPembiayaanSemula = $totalPenerimaanSemula - $totalPengeluaranSemula;
    $nettoPembiayaanPerubahan = $totalPenerimaanPerubahan - $totalPengeluaranPerubahan;
    $nettoPembiayaan = $totalPenerimaan - $totalPengeluaran;
@endphp

@include('layouts.partials.page-hero', [
    'title' => 'Transparansi APBDes ' . $selectedYear,
    'subtitle' => 'Laporan Akuntabilitas Anggaran Pendapatan dan Belanja Desa Selorejo Tahun Anggaran ' . $selectedYear . '.',
    'icon' => 'file-text'
])

<div class="container mb-5 pb-5">
    
    <!-- Tab Pemilihan Tahun -->
    <div class="d-flex justify-content-center gap-2 mb-4 flex-wrap">
        @foreach($years as $yr)
            <a href="?tahun={{ $yr }}" 
               class="btn px-4 py-2 rounded-pill fw-bold border shadow-sm transition-all {{ $selectedYear == $yr ? 'btn-success text-white border-success' : 'btn-light text-dark bg-white' }}"
               style="font-family: var(--font-body);">
                Tahun Anggaran {{ $yr }}
            </a>
        @endforeach
    </div>

    <!-- Header Peraturan / Judul Poster -->
    <div class="glass-card bg-white p-4 p-md-5 rounded-4 shadow-sm border text-center mb-5 position-relative overflow-hidden" 
         style="border-top: 5px solid var(--color-forest) !important; border-color: var(--color-forest)1a !important;">
        @if($selectedYear == 2026)
            <h3 class="fw-bold text-success mb-2" style="font-family: var(--font-heading); letter-spacing: 0.05em;">APB DESA DESA SELOREJO</h3>
            <h4 class="fw-bold text-dark mb-4 text-uppercase" style="font-family: var(--font-heading);">TAHUN ANGGARAN 2026</h4>
            <div class="row g-3 justify-content-center">
                <div class="col-auto">
                    <div class="px-3 py-2 bg-light border rounded-3 text-start d-flex align-items-center gap-2">
                        <div class="rounded-circle bg-success text-white p-1 d-flex align-items-center justify-content-center" style="width:24px;height:24px;"><i data-lucide="user" class="icon-xs"></i></div>
                        <small class="text-muted"><strong class="text-dark">Bambang Soponyono</strong><br>Kepala Desa Selorejo</small>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="px-3 py-2 bg-light border rounded-3 text-start d-flex align-items-center gap-2">
                        <div class="rounded-circle bg-success text-white p-1 d-flex align-items-center justify-content-center" style="width:24px;height:24px;"><i data-lucide="award" class="icon-xs"></i></div>
                        <small class="text-muted"><strong class="text-dark">H. Yandri Susanto, S.Pt., M.Pd.</strong><br>Menteri Desa PDTT</small>
                    </div>
                </div>
            </div>
        @elseif($selectedYear == 2025)
            <h4 class="fw-bold text-success mb-2" style="font-family: var(--font-heading); letter-spacing: 0.05em;">PEMERINTAH DESA SELOREJO</h4>
            <h5 class="fw-bold text-dark mb-3" style="font-family: var(--font-heading);">PERATURAN DESA SELOREJO NOMOR 2 TAHUN 2025</h5>
            <div class="badge px-4 py-2 rounded-pill fw-bold text-uppercase mb-3" style="background-color: var(--accent) !important; color: var(--text-on-accent) !important; font-size: 0.85rem;">TENTANG</div>
            <h4 class="fw-bold text-dark mb-0 text-uppercase" style="font-family: var(--font-heading); font-size: 1.3rem;">PERUBAHAN ANGGARAN PENDAPATAN DAN BELANJA DESA TAHUN ANGGARAN 2025</h4>
        @endif
    </div>

    <!-- Kotak Ringkasan Anggaran (3 Stats) -->
    <div class="row g-3 mb-5 justify-content-center">
        <div class="col-md-4">
            <div class="d-flex align-items-center gap-3 bg-white border rounded-4 p-4 shadow-sm h-100" style="border-left: 5px solid var(--color-forest) !important; border-color: var(--color-forest)1a !important;">
                <div class="rounded-circle d-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success" style="width:48px;height:48px;flex-shrink:0;">
                    <i data-lucide="trending-up" class="icon-md"></i>
                </div>
                <div>
                    <small class="text-muted d-block" style="font-family:var(--font-body);">TOTAL PENDAPATAN</small>
                    <div class="fw-bold text-dark fs-5">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="d-flex align-items-center gap-3 bg-white border rounded-4 p-4 shadow-sm h-100" style="border-left: 5px solid var(--accent-orange) !important; border-color: var(--color-forest)1a !important;">
                <div class="rounded-circle d-flex align-items-center justify-content-center bg-danger bg-opacity-10 text-danger" style="width:48px;height:48px;flex-shrink:0;">
                    <i data-lucide="trending-down" class="icon-md"></i>
                </div>
                <div>
                    <small class="text-muted d-block" style="font-family:var(--font-body);">TOTAL BELANJA</small>
                    <div class="fw-bold text-dark fs-5">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="d-flex align-items-center gap-3 bg-white border rounded-4 p-4 shadow-sm h-100" style="border-left: 5px solid #0d6efd !important; border-color: var(--color-forest)1a !important;">
                <div class="rounded-circle d-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary" style="width:48px;height:48px;flex-shrink:0;">
                    <i data-lucide="wallet" class="icon-md"></i>
                </div>
                <div>
                    <small class="text-muted d-block" style="font-family:var(--font-body);">PEMBIAYAAN NETTO</small>
                    <div class="fw-bold text-dark fs-5">Rp {{ number_format($nettoPembiayaan, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik dan Tabel Rincian -->
    <div class="row g-4">
        <!-- Visual Charts Column -->
        <div class="col-xl-5">
            <!-- Card 1: Perbandingan Anggaran -->
            <div class="glass-card bg-white p-4 shadow-sm border mb-4 animate-up" 
                 style="border-top: 5px solid var(--color-forest) !important; border-color: var(--color-forest)1a !important;">
                <div class="d-flex align-items-center mb-3">
                    <div class="p-2 rounded me-3 bg-success bg-opacity-10 text-success"><i data-lucide="bar-chart-3"></i></div>
                    <h5 class="fw-bold text-dark mb-0" style="font-family: var(--font-heading);">Perbandingan Anggaran</h5>
                </div>
                <div style="height: 240px; position: relative;">
                    <canvas id="apbdesGroupedBar"></canvas>
                </div>
            </div>
            
            <!-- Card 2: Distribusi Anggaran -->
            <div class="glass-card bg-white p-4 shadow-sm border animate-up" 
                 style="border-top: 5px solid var(--accent-orange) !important; border-color: var(--color-forest)1a !important;">
                <div class="d-flex align-items-center mb-3">
                    <div class="p-2 rounded me-3 bg-danger bg-opacity-10 text-danger"><i data-lucide="pie-chart"></i></div>
                    <h5 class="fw-bold text-dark mb-0" style="font-family: var(--font-heading);">
                        {{ $selectedYear == 2026 ? 'Sumber Pendapatan 2026' : 'Porsi Pendapatan vs Belanja' }}
                    </h5>
                </div>
                <div style="height: 240px; position: relative;">
                    <canvas id="apbdesPieChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Tabel Detail Column -->
        <div class="col-xl-7">
            <div class="glass-card bg-white p-4 p-md-5 h-100 shadow-sm border table-responsive" 
                 style="border-color: var(--color-forest)1a !important; font-family: var(--font-body);">
                
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3" 
                     style="border-bottom-color: var(--color-forest)1a !important;">
                    <h5 class="fw-bold mb-0 text-dark" style="font-family: var(--font-heading);">Rincian Pos APBDes Selorejo</h5>
                    <span class="badge px-3 py-2 rounded-pill fw-bold" style="background-color: var(--color-forest) !important; color: #fff !important;">TA {{ $selectedYear }}</span>
                </div>

                <!-- TABEL RINCIAN 4 KOLOM SELARAS -->
                <table class="table table-hover align-middle mb-0" style="border: 2px solid #222; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: var(--color-forest); color: #fff;">
                            <th class="py-3 px-3 fw-bold text-start" style="border: 2px solid #222; color: #fff !important; width: 40%;">Uraian Pos Anggaran</th>
                            <th class="py-3 px-2 fw-bold text-center" style="border: 2px solid #222; color: #fff !important; width: 20%;">Semula (Rp)</th>
                            <th class="py-3 px-2 fw-bold text-center" style="border: 2px solid #222; color: #fff !important; width: 20%;">Bertambah/(Berkurang) (Rp)</th>
                            <th class="py-3 px-2 fw-bold text-center" style="border: 2px solid #222; color: #fff !important; width: 20%;">Setelah Perubahan (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- ==================== 1. PENDAPATAN ==================== -->
                        <tr style="background-color: rgba(26,92,56,0.06);">
                            <td class="fw-bold text-dark text-start" style="border: 2px solid #222;"><i data-lucide="trending-up" class="icon-sm me-1 text-success"></i> 1. PENDAPATAN DESA</td>
                            <td class="text-end fw-bold text-success" style="border: 2px solid #222;">{{ number_format($totalPendapatanSemula, 0, ',', '.') }}</td>
                            <td class="text-end fw-bold text-success" style="border: 2px solid #222;">
                                {{ $totalPendapatanPerubahan >= 0 ? '+' : '' }}{{ number_format($totalPendapatanPerubahan, 0, ',', '.') }}
                            </td>
                            <td class="text-end fw-bold text-success" style="border: 2px solid #222;">{{ number_format($totalPendapatan, 0, ',', '.') }}</td>
                        </tr>
                        @if($selectedYear == 2026)
                            @foreach($pendapatan as $p)
                            <tr>
                                <td class="text-start ps-4 text-dark small" style="border: 1px solid #ddd;">{{ $p->bidang }}</td>
                                <td class="text-end fw-semibold small text-muted" style="border: 1px solid #ddd;">{{ number_format($p->nominal_semula, 0, ',', '.') }}</td>
                                <td class="text-end small text-muted" style="border: 1px solid #ddd;">0</td>
                                <td class="text-end fw-bold small text-success" style="border: 1px solid #ddd;">{{ number_format($p->nominal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        @endif

                        <!-- ==================== 2. BELANJA ==================== -->
                        <tr style="background-color: rgba(245,124,0,0.06);">
                            <td class="fw-bold text-dark text-start" style="border: 2px solid #222;"><i data-lucide="trending-down" class="icon-sm me-1 text-danger"></i> 2. BELANJA DESA</td>
                            <td class="text-end fw-bold text-warning" style="border: 2px solid #222;">{{ number_format($totalBelanjaSemula, 0, ',', '.') }}</td>
                            <td class="text-end fw-bold text-success" style="border: 2px solid #222;">
                                {{ $totalBelanjaPerubahan >= 0 ? '+' : '' }}{{ number_format($totalBelanjaPerubahan, 0, ',', '.') }}
                            </td>
                            <td class="text-end fw-bold text-warning" style="border: 2px solid #222;">{{ number_format($totalBelanja, 0, ',', '.') }}</td>
                        </tr>
                        @if($selectedYear == 2026)
                            @php
                                $groupedBelanja = $belanja->groupBy('kategori_bidang');
                            @endphp
                            @foreach($groupedBelanja as $kategori => $items)
                                <tr style="background-color: #f8f9fa;">
                                    <td class="text-start fw-bold ps-3 text-dark small" style="border: 1.5px solid #aaa;">{{ $kategori }}</td>
                                    <td class="text-end fw-bold text-muted small" style="border: 1.5px solid #aaa;">{{ number_format($items->sum('nominal_semula'), 0, ',', '.') }}</td>
                                    <td class="text-end fw-bold text-muted small" style="border: 1.5px solid #aaa;">0</td>
                                    <td class="text-end fw-bold text-dark small" style="border: 1.5px solid #aaa;">{{ number_format($items->sum('nominal'), 0, ',', '.') }}</td>
                                </tr>
                                @foreach($items as $it)
                                <tr>
                                    <td class="text-start ps-5 text-muted small" style="border: 1px solid #eee; font-size: 0.85rem;">{{ $it->bidang }}</td>
                                    <td class="text-end text-muted small" style="border: 1px solid #eee; font-size: 0.85rem;">{{ number_format($it->nominal_semula, 0, ',', '.') }}</td>
                                    <td class="text-end text-muted small" style="border: 1px solid #eee; font-size: 0.85rem;">0</td>
                                    <td class="text-end text-muted small fw-semibold" style="border: 1px solid #eee; font-size: 0.85rem;">{{ number_format($it->nominal, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            @endforeach
                        @endif

                        <!-- SURPLUS / DEFISIT -->
                        @php
                            $defisitSemula = $totalPendapatanSemula - $totalBelanjaSemula;
                            $defisitPerubahan = $totalPendapatanPerubahan - $totalBelanjaPerubahan;
                            $defisitAkhir = $totalPendapatan - $totalBelanja;
                        @endphp
                        <tr style="background-color: #f8f9fa;">
                            <td class="fw-bold text-dark text-start ps-4" style="border: 2px solid #222;">Surplus/(Defisit)</td>
                            <td class="text-end fw-bold text-danger" style="border: 2px solid #222;">
                                ({{ number_format(abs($defisitSemula), 0, ',', '.') }})
                            </td>
                            <td class="text-end fw-bold {{ $defisitPerubahan >= 0 ? 'text-success' : 'text-danger' }}" style="border: 2px solid #222;">
                                {{ $defisitPerubahan >= 0 ? '+' : '' }}{{ number_format($defisitPerubahan, 0, ',', '.') }}
                            </td>
                            <td class="text-end fw-bold text-danger" style="border: 2px solid #222;">
                                ({{ number_format(abs($defisitAkhir), 0, ',', '.') }})
                            </td>
                        </tr>

                        <!-- ==================== 3. PEMBIAYAAN ==================== -->
                        <tr style="background: #e9ecef;">
                            <td colspan="4" class="fw-bold text-dark text-start" style="border: 1.5px solid #444;">3. PEMBIAYAAN DESA</td>
                        </tr>
                        @if($selectedYear == 2026)
                            @foreach($penerimaan as $pn)
                            <tr>
                                <td class="text-start ps-4 text-dark small" style="border: 1px solid #ddd;">3.1. {{ $pn->bidang }}</td>
                                <td class="text-end fw-semibold small text-muted" style="border: 1px solid #ddd;">{{ number_format($pn->nominal_semula, 0, ',', '.') }}</td>
                                <td class="text-end small text-muted" style="border: 1px solid #ddd;">0</td>
                                <td class="text-end fw-bold small text-success" style="border: 1px solid #ddd;">{{ number_format($pn->nominal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                            @foreach($pengeluaran as $pl)
                            <tr>
                                <td class="text-start ps-4 text-dark small" style="border: 1px solid #ddd;">3.2. {{ $pl->bidang }}</td>
                                <td class="text-end fw-semibold small text-muted" style="border: 1px solid #ddd;">{{ number_format($pl->nominal_semula, 0, ',', '.') }}</td>
                                <td class="text-end small text-muted" style="border: 1px solid #ddd;">0</td>
                                <td class="text-end fw-bold small text-danger" style="border: 1px solid #ddd;">({{ number_format($pl->nominal, 0, ',', '.') }})</td>
                            </tr>
                            @endforeach
                        @else
                            @if($penerimaan->first())
                            @php $pnFirst = $penerimaan->first(); @endphp
                            <tr>
                                <td class="text-start ps-4" style="border: 1px solid #ddd;">3.1. Penerimaan Pembiayaan</td>
                                <td class="text-end fw-semibold text-muted" style="border: 1px solid #ddd;">{{ number_format($pnFirst->nominal_semula, 0, ',', '.') }}</td>
                                <td class="text-end text-danger fw-semibold" style="border: 1px solid #ddd;">({{ number_format(abs($pnFirst->nominal_perubahan), 0, ',', '.') }})</td>
                                <td class="text-end fw-bold text-success" style="border: 1px solid #ddd;">{{ number_format($pnFirst->nominal, 0, ',', '.') }}</td>
                            </tr>
                            @endif

                            @if($pengeluaran->first())
                            @php $plFirst = $pengeluaran->first(); @endphp
                            <tr>
                                <td class="text-start ps-4" style="border: 1px solid #ddd;">3.2. Pengeluaran Pembiayaan</td>
                                <td class="text-end fw-semibold text-muted" style="border: 1px solid #ddd;">{{ number_format($plFirst->nominal_semula, 0, ',', '.') }}</td>
                                <td class="text-end text-success fw-semibold" style="border: 1px solid #ddd;">{{ number_format($plFirst->nominal_perubahan, 0, ',', '.') }}</td>
                                <td class="text-end fw-bold text-danger" style="border: 1px solid #ddd;">{{ number_format($plFirst->nominal, 0, ',', '.') }}</td>
                            </tr>
                            @endif
                        @endif

                        <!-- SELISIH PEMBIAYAAN NETTO -->
                        <tr style="background-color: #f8f9fa;">
                            <td class="fw-bold text-dark text-start ps-4" style="border: 2px solid #222;">Selisih Pembiayaan (3.1 - 3.2)</td>
                            <td class="text-end fw-bold text-success" style="border: 2px solid #222;">{{ number_format(abs($nettoPembiayaanSemula), 0, ',', '.') }}</td>
                            <td class="text-end fw-bold {{ $nettoPembiayaanPerubahan >= 0 ? 'text-success' : 'text-danger' }}" style="border: 2px solid #222;">
                                {{ $nettoPembiayaanPerubahan >= 0 ? '+' : '' }}{{ number_format($nettoPembiayaanPerubahan, 0, ',', '.') }}
                            </td>
                            <td class="text-end fw-bold text-success" style="border: 2px solid #222;">{{ number_format(abs($nettoPembiayaan), 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Data Attribution -->
                <div class="mt-4 p-3 rounded-4 bg-light border d-flex align-items-center" style="border-color: var(--color-forest)1a !important;">
                    <i data-lucide="shield-check" class="me-3 text-success" style="width: 32px; height: 32px;"></i>
                    <div>
                        <p class="mb-0 small text-muted lh-sm">Data ini disajikan secara transparan berdasarkan <strong class="text-dark">Pagu Anggaran Resmi Pemerintah Desa Selorejo</strong> untuk Tahun Anggaran {{ $selectedYear }}.</p>
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
        Chart.defaults.font.family = "'Open Sans', sans-serif";
        Chart.defaults.color = '#333';

        // ─── CHART 1: PERBANDINGAN ANGGARAN (Grouped Bar Chart) ──────────────
        const ctxBar = document.getElementById('apbdesGroupedBar').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Pendapatan Desa', 'Belanja Desa'],
                datasets: [
                    {
                        label: 'Semula',
                        data: [{{ $totalPendapatanSemula }}, {{ $totalBelanjaSemula }}],
                        backgroundColor: '#a5a5a5',
                        borderRadius: 6,
                    },
                    {
                        label: 'Setelah Perubahan',
                        data: [{{ $totalPendapatan }}, {{ $totalBelanja }}],
                        backgroundColor: '#1a5c38',
                        borderRadius: 6,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top', labels: { boxWidth: 12 } },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) label += ': ';
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(val) { return 'Rp ' + (val / 1e9) + ' M'; }
                        }
                    }
                }
            }
        });

        // ─── CHART 2: DISTRIBUSI ANGGARAN (Doughnut Chart) ──────────────────
        const ctxPie = document.getElementById('apbdesPieChart').getContext('2d');
        @if($selectedYear == 2026)
            // Doughnut porsi sumber pendapatan untuk 2026
            new Chart(ctxPie, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($pendapatan->pluck('bidang')->toArray()) !!},
                    datasets: [{
                        data: {!! json_encode($pendapatan->pluck('nominal')->toArray()) !!},
                        backgroundColor: ['#1a5c38', '#f5c518', '#f57c00', '#2d6a4f', '#0d6efd'],
                        borderWidth: 1,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: { boxWidth: 10, font: { size: 9 } }
                        }
                    }
                }
            });
        @else
            // Doughnut porsi total Pendapatan vs Belanja vs Pembiayaan untuk 2025
            new Chart(ctxPie, {
                type: 'doughnut',
                data: {
                    labels: ['Pendapatan', 'Belanja', 'Penerimaan Pembiayaan'],
                    datasets: [{
                        data: [{{ $totalPendapatan }}, {{ $totalBelanja }}, {{ $totalPenerimaan }}],
                        backgroundColor: ['#1a5c38', '#f57c00', '#0d6efd'],
                        borderWidth: 1,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: { boxWidth: 10, font: { size: 9 } }
                        }
                    }
                }
            });
        @endif
    });
</script>
@endpush
@endsection
