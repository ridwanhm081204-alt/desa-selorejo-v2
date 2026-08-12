@extends('layouts.dashboard')
@section('title', 'Data Penduduk & Import Excel')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Page -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i data-lucide="users" class="me-2 text-success"></i> Manajemen Data Penduduk
            </h4>
            <p class="text-muted small mb-0">Kelola data kependudukan mentah Desa Selorejo, import Excel, dan grafik statistik usia otomatis.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('operator.statistik.data-penduduk.template') }}" class="btn btn-outline-success btn-sm rounded-pill px-3 d-flex align-items-center shadow-sm">
                <i data-lucide="download" class="me-1 icon-xs"></i> Unduh Template Excel
            </a>
            <button type="button" class="btn btn-success btn-sm rounded-pill px-3 d-flex align-items-center shadow-sm" data-bs-toggle="modal" data-bs-target="#modalImportExcel">
                <i data-lucide="upload" class="me-1 icon-xs"></i> Import Excel Data
            </button>
            <button type="button" class="btn btn-primary btn-sm rounded-pill px-3 d-flex align-items-center shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahPenduduk">
                <i data-lucide="plus" class="me-1 icon-xs"></i> Tambah Data Manual
            </button>
        </div>
    </div>

    <!-- Ringkasan Agregat Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="dash-card p-3 h-100 border-start border-4 border-success">
                <small class="text-muted fw-semibold text-uppercase x-small d-block mb-1">Total Penduduk</small>
                <div class="d-flex align-items-center justify-content-between">
                    <h3 class="fw-bold text-dark mb-0">{{ number_format($statistik['total']) }}</h3>
                    <div class="p-2 rounded-circle bg-success bg-opacity-10 text-success">
                        <i data-lucide="users" class="icon-sm"></i>
                    </div>
                </div>
                <small class="text-muted micro-text mt-1 d-block">COUNT data riil terverifikasi</small>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="dash-card p-3 h-100 border-start border-4 border-primary">
                <small class="text-muted fw-semibold text-uppercase x-small d-block mb-1">Laki-Laki</small>
                <div class="d-flex align-items-center justify-content-between">
                    <h3 class="fw-bold text-primary mb-0">{{ number_format($statistik['gender']['L']) }}</h3>
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill">{{ $statistik['gender']['L_percent'] }}%</span>
                </div>
                <small class="text-muted micro-text mt-1 d-block">Total jiwa jenis kelamin L</small>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="dash-card p-3 h-100 border-start border-4 border-warning">
                <small class="text-muted fw-semibold text-uppercase x-small d-block mb-1">Perempuan</small>
                <div class="d-flex align-items-center justify-content-between">
                    <h3 class="fw-bold text-warning mb-0">{{ number_format($statistik['gender']['P']) }}</h3>
                    <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill">{{ $statistik['gender']['P_percent'] }}%</span>
                </div>
                <small class="text-muted micro-text mt-1 d-block">Total jiwa jenis kelamin P</small>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="dash-card p-3 h-100 border-start border-4 border-info">
                <small class="text-muted fw-semibold text-uppercase x-small d-block mb-1">Kategori Usia</small>
                <div class="d-flex align-items-center justify-content-between">
                    <h3 class="fw-bold text-info mb-0">{{ count($statistik['kelompok_usia']) }}</h3>
                    <div class="p-2 rounded-circle bg-info bg-opacity-10 text-info">
                        <i data-lucide="bar-chart-2" class="icon-sm"></i>
                    </div>
                </div>
                <small class="text-muted micro-text mt-1 d-block">Rentang klasifikasi otomatis</small>
            </div>
        </div>
    </div>

    <!-- Grafik Statistik Usia Auto-generated -->
    <div class="card dash-card border-0 mb-4 overflow-hidden">
        <div class="card-header bg-white py-3 px-4 d-flex align-items-center justify-content-between border-bottom border-light">
            <div class="d-flex align-items-center">
                <div class="p-2 rounded me-2 bg-success bg-opacity-10 text-success">
                    <i data-lucide="activity" class="icon-sm"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-dark mb-0">Grafik Distribusi Kelompok Usia (Auto-Generate)</h6>
                    <small class="text-muted">Ter-update otomatis setiap kali ada penambahan, perubahan, atau import Excel.</small>
                </div>
            </div>
            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3">
                Live Dynamic Aggregation
            </span>
        </div>
        <div class="card-body p-4">
            <div style="height: 350px;">
                <canvas id="operatorAgeChart"></canvas>
            </div>
            <!-- Legend Table -->
            <div class="row g-2 mt-3 pt-3 border-top">
                @foreach($statistik['kelompok_usia'] as $item)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                        <div class="p-2 rounded bg-light border text-center">
                            <span class="d-block text-muted small">{{ $item['label'] }}</span>
                            <strong class="text-dark fs-6">{{ number_format($item['jumlah']) }}</strong>
                            <small class="text-success d-block fw-semibold">({{ $item['persentase'] }}%)</small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Table Section with Filters & Search -->
    <div class="card dash-card border-0 mb-4">
        <div class="card-header bg-white py-3 px-4 border-bottom border-light">
            <div class="row g-2 align-items-center justify-content-between">
                <div class="col-12 col-md-4">
                    <h6 class="fw-bold text-dark mb-0">Daftar Data Penduduk</h6>
                    <small class="text-muted">Total {{ $penduduk->total() }} baris terdaftar</small>
                </div>
                <div class="col-12 col-md-8">
                    <form action="{{ route('operator.statistik.data-penduduk.index') }}" method="GET" class="row g-2 justify-content-md-end">
                        <div class="col-12 col-sm-4">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-light border-end-0"><i data-lucide="search" class="icon-xs text-muted"></i></span>
                                <input type="text" name="q" class="form-control form-control-sm border-start-0" placeholder="Cari NAMA / NIK / NKK..." value="{{ request('q') }}">
                            </div>
                        </div>
                        <div class="col-6 col-sm-2">
                            <select name="jenis_kelamin" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="">- Gender -</option>
                                <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="col-6 col-sm-2">
                            <select name="kelompok_usia" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="">- Usia -</option>
                                @foreach($statistik['kelompok_usia'] as $ku)
                                    <option value="{{ $ku['kelompok'] }}" {{ request('kelompok_usia') == $ku['kelompok'] ? 'selected' : '' }}>{{ $ku['kelompok'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 col-sm-2">
                            <select name="rt" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="">- RT -</option>
                                @foreach($rtList as $rtVal)
                                    <option value="{{ $rtVal }}" {{ request('rt') == $rtVal ? 'selected' : '' }}>RT {{ $rtVal }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 col-sm-2">
                            <a href="{{ route('operator.statistik.data-penduduk.index') }}" class="btn btn-light btn-sm w-100 border text-muted">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-nowrap">
                <thead class="table-light">
                    <tr class="text-secondary small text-uppercase">
                        <th class="ps-4">No</th>
                        <th>NKK / NIK (PII Protected)</th>
                        <th>Nama Lengkap</th>
                        <th>Kelamin</th>
                        <th>TTL / Usia</th>
                        <th>Kelompok Usia</th>
                        <th>RT / RW</th>
                        <th>Status / Pekerjaan</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penduduk as $index => $item)
                        <tr>
                            <td class="ps-4 text-muted small">{{ $penduduk->firstItem() + $index }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-2">
                                        <div class="small fw-semibold text-dark pii-field" data-full="{{ $item->nkk }}" data-masked="{{ substr($item->nkk, 0, 4) . '-****-****-' . substr($item->nkk, -4) }}">
                                            NKK: {{ substr($item->nkk, 0, 4) . '-****-****-' . substr($item->nkk, -4) }}
                                        </div>
                                        <div class="text-muted micro-text pii-field" data-full="{{ $item->nik }}" data-masked="{{ substr($item->nik, 0, 4) . '-****-****-' . substr($item->nik, -4) }}">
                                            NIK: {{ substr($item->nik, 0, 4) . '-****-****-' . substr($item->nik, -4) }}
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-link link-secondary p-0 text-decoration-none btn-toggle-pii" title="Tampilkan / Sembunyikan NIK/NKK">
                                        <i data-lucide="eye" class="icon-xs"></i>
                                    </button>
                                </div>
                            </td>
                            <td>
                                <strong class="text-dark d-block">{{ $item->nama }}</strong>
                                <small class="text-muted micro-text">{{ $item->alamat }}</small>
                            </td>
                            <td>
                                @if($item->jenis_kelamin == 'L')
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill">Laki-Laki</span>
                                @else
                                    <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill">Perempuan</span>
                                @endif
                            </td>
                            <td>
                                <span class="d-block text-dark small">{{ $item->tempat_lahir }}, {{ $item->tanggal_lahir ? $item->tanggal_lahir->format('d/m/Y') : '-' }}</span>
                                <small class="text-success fw-bold">{{ $item->usia !== null ? $item->usia . ' Tahun' : '-' }}</small>
                            </td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill">
                                    {{ $item->kelompok_usia }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">RT {{ $item->rt ?? '-' }} / RW {{ $item->rw ?? '-' }}</span>
                            </td>
                            <td>
                                <small class="d-block text-muted">{{ $item->status_kawin }}</small>
                                <small class="fw-medium text-dark">{{ $item->pekerjaan }}</small>
                            </td>
                            <td class="text-end pe-4">
                                <button type="button" class="btn btn-sm btn-white border shadow-sm me-1" onclick='editPenduduk(@json($item))' title="Edit Data">
                                    <i data-lucide="edit-3" class="icon-xs text-primary"></i>
                                </button>
                                <form action="{{ route('operator.statistik.data-penduduk.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data penduduk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-white border shadow-sm text-danger" title="Hapus Data">
                                        <i data-lucide="trash-2" class="icon-xs"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i data-lucide="inbox" class="icon-lg mb-2 text-muted opacity-50"></i>
                                <p class="mb-0">Belum ada data penduduk yang cocok. Unggah Excel atau tambah manual.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($penduduk->hasPages())
            <div class="card-footer bg-white py-3 border-top border-light">
                {{ $penduduk->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

    <!-- Section Riwayat Import Batch -->
    <div class="card dash-card border-0 mb-4">
        <div class="card-header bg-white py-3 px-4 border-bottom border-light d-flex align-items-center justify-content-between">
            <div>
                <h6 class="fw-bold text-dark mb-0">Riwayat Import Batch & Audit Log</h6>
                <small class="text-muted">Setiap import tercatat untuk pertanggungjawaban data dan dapat di-rollback per batch.</small>
            </div>
            <i data-lucide="history" class="icon-sm text-muted"></i>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-nowrap">
                <thead class="table-light">
                    <tr class="text-secondary small text-uppercase">
                        <th class="ps-4">No Batch</th>
                        <th>Nama File</th>
                        <th>Total Baris</th>
                        <th>Berhasil / Gagal</th>
                        <th>Operator Pengunggah</th>
                        <th>Waktu Import</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($importBatches as $batch)
                        <tr>
                            <td class="ps-4 font-monospace fw-bold text-success">#BATCH-{{ $batch->id }}</td>
                            <td>
                                <strong class="text-dark d-block">{{ $batch->filename }}</strong>
                                <small class="text-muted micro-text">{{ $batch->file_path }}</small>
                            </td>
                            <td><span class="fw-bold text-dark">{{ $batch->total_rows }}</span></td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success me-1">{{ $batch->success_rows }} Berhasil</span>
                                @if($batch->failed_rows > 0)
                                    <span class="badge bg-danger bg-opacity-10 text-danger">{{ $batch->failed_rows }} Gagal</span>
                                @endif
                            </td>
                            <td>
                                <span class="small text-dark fw-medium">{{ $batch->uploader->name ?? 'System' }}</span>
                            </td>
                            <td>
                                <small class="text-muted">{{ $batch->created_at->format('d M Y, H:i') }} WIB</small>
                            </td>
                            <td class="text-end pe-4">
                                <form action="{{ route('operator.statistik.data-penduduk.rollback', $batch->id) }}" method="POST" onsubmit="return confirm('PERINGATAN: Membatalkan batch #BATCH-{{ $batch->id }} akan menghapus data penduduk yang di-import dari file {{ $batch->filename }}. Lanjutkan rollback?')">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 py-1">
                                        <i data-lucide="rotate-ccw" class="icon-xs me-1"></i> Rollback Batch
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted small">
                                Belum ada riwayat batch import file Excel.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($importBatches->hasPages())
            <div class="card-footer bg-white py-2 border-top border-light">
                {{ $importBatches->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>

<!-- Modal Import Excel & Interactive Preview -->
<div class="modal fade" id="modalImportExcel" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-success text-white py-3 px-4">
                <h5 class="modal-title fw-bold d-flex align-items-center">
                    <i data-lucide="file-spreadsheet" class="me-2"></i> Import Data Penduduk via Excel
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <!-- Step 1: Upload File Form -->
                <div id="stepUpload">
                    <div class="p-4 rounded-3 border-2 border-dashed bg-light text-center mb-4" id="dropzoneArea">
                        <i data-lucide="upload-cloud" class="icon-lg text-success mb-2" style="width: 48px; height: 48px;"></i>
                        <h6 class="fw-bold text-dark mb-1">Pilih File Spreadsheet Excel (.xlsx / .xls)</h6>
                        <p class="text-muted small mb-3">Pastikan struktur header kolom sesuai dengan template standar (12 kolom).</p>
                        
                        <form id="formPreviewExcel" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" id="inputFileExcel" class="d-none" accept=".xlsx,.xls">
                            <button type="button" class="btn btn-success rounded-pill px-4" onclick="document.getElementById('inputFileExcel').click()">
                                <i data-lucide="folder" class="me-1 icon-xs"></i> Pilih File Excel
                            </button>
                            <div id="fileNameDisplay" class="mt-2 fw-semibold text-success small"></div>
                        </form>
                    </div>

                    <div class="alert alert-info border-0 rounded-3 mb-0 small">
                        <h6 class="fw-bold mb-1"><i data-lucide="info" class="me-1 icon-xs"></i> Petunjuk Format Excel:</h6>
                        <ul class="mb-0 ps-3">
                            <li>12 Kolom Wajib Urut: <strong>NKK, NIK, NAMA, TEMPAT LAHIR, TANGGAL LAHIR, STS KAWIN, KELAMIN, ALAMAT, RT, RW, USIA, PEKERJAAN</strong>.</li>
                            <li>NIK duplikat akan diproses sebagai <strong>UPDATE DATA</strong> otomatis.</li>
                            <li>Baris dengan NIK/NKK/NAMA/KELAMIN kosong akan ditolak per-baris tanpa menggagalkan seluruh file.</li>
                        </ul>
                    </div>
                </div>

                <!-- Step 2: Interactive Preview -->
                <div id="stepPreview" style="display: none;">
                    <div class="alert alert-light border rounded-3 mb-3 p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="fw-bold text-dark mb-1" id="previewFileName">File: sample.xlsx</h6>
                                <small class="text-muted">Hasil Validasi & Parsing Baris</small>
                            </div>
                            <div class="d-flex gap-2">
                                <span class="badge bg-secondary rounded-pill px-3 py-2" id="previewTotalRows">Total: 0 Baris</span>
                                <span class="badge bg-success rounded-pill px-3 py-2" id="previewValidRows">Sukses: 0</span>
                                <span class="badge bg-danger rounded-pill px-3 py-2" id="previewFailedRows">Gagal: 0</span>
                                <span class="badge bg-primary rounded-pill px-3 py-2" id="previewNewRows">Data Baru: 0</span>
                                <span class="badge bg-warning rounded-pill px-3 py-2" id="previewUpdateRows">Update Existing: 0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Accordion Gagal -->
                    <div id="failedSection" class="mb-3" style="display: none;">
                        <div class="alert alert-danger border-0 rounded-3 p-3 mb-0">
                            <h6 class="fw-bold mb-2 text-danger"><i data-lucide="alert-triangle" class="me-1 icon-xs"></i> Baris Gagal Validasi (<span id="countFailedText">0</span> Baris Ditolak):</h6>
                            <div class="table-responsive max-vh-30">
                                <table class="table table-sm table-bordered bg-white mb-0 small text-nowrap">
                                    <thead class="table-danger">
                                        <tr>
                                            <th>Baris Ke</th>
                                            <th>NIK / NAMA</th>
                                            <th>Alasan Gagal Ditolak</th>
                                        </tr>
                                    </thead>
                                    <tbody id="failedTableBody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Preview Data Valid -->
                    <h6 class="fw-bold text-dark mb-2">Pratinjau Data Valid yang Akan Di-Commit:</h6>
                    <div class="table-responsive border rounded-3 mb-3" style="max-height: 300px; overflow-y: auto;">
                        <table class="table table-sm table-hover align-middle mb-0 text-nowrap small">
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th>No</th>
                                    <th>Aksi Status</th>
                                    <th>NKK</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Gender</th>
                                    <th>Tanggal Lahir / Usia</th>
                                    <th>Kelompok Usia</th>
                                    <th>RT / RW</th>
                                </tr>
                            </thead>
                            <tbody id="validTableBody"></tbody>
                        </table>
                    </div>
                </div>

                <!-- Loading Spinner -->
                <div id="previewLoading" class="text-center py-5" style="display: none;">
                    <div class="spinner-border text-success mb-2" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="text-muted small mb-0">Membaca dan memvalidasi file Excel, harap tunggu...</p>
                </div>
            </div>
            <div class="modal-footer bg-light px-4 py-3">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success rounded-pill px-4" id="btnCommitImport" style="display: none;">
                    <i data-lucide="check-circle" class="me-1 icon-xs"></i> Konfirmasi & Commit Import
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah & Edit Data Penduduk Manual -->
<div class="modal fade" id="modalTambahPenduduk" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-primary text-white py-3 px-4">
                <h5 class="modal-title fw-bold" id="modalFormTitle">Tambah Data Penduduk Manual</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formPenduduk" method="POST" action="{{ route('operator.statistik.data-penduduk.store') }}">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Nomor Kartu Keluarga (NKK) <span class="text-danger">*</span></label>
                            <input type="text" name="nkk" id="inputNkk" class="form-control" maxlength="16" required placeholder="16 digit NKK">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Nomor Induk Kependudukan (NIK) <span class="text-danger">*</span></label>
                            <input type="text" name="nik" id="inputNik" class="form-control" maxlength="16" required placeholder="16 digit NIK">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-bold small">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" id="inputNama" class="form-control" required placeholder="Nama sesuai KTP/KK">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin" id="inputKelamin" class="form-select" required>
                                <option value="L">Laki-Laki (L)</option>
                                <option value="P">Perempuan (P)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="inputTempatLahir" class="form-control" placeholder="Kota / Kabupaten">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="inputTanggalLahir" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">Status Perkawinan</label>
                            <select name="status_kawin" id="inputStatusKawin" class="form-select">
                                <option value="Kawin">Kawin</option>
                                <option value="Belum Kawin">Belum Kawin</option>
                                <option value="Cerai Hidup">Cerai Hidup</option>
                                <option value="Cerai Mati">Cerai Mati</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">RT (2 Digit)</label>
                            <input type="text" name="rt" id="inputRt" class="form-control" maxlength="2" placeholder="Contoh: 01">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">RW (2 Digit)</label>
                            <input type="text" name="rw" id="inputRw" class="form-control" maxlength="2" placeholder="Contoh: 02">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">Usia Fallback (Jika Tgl Lahir Kosong)</label>
                            <input type="number" name="usia_input" id="inputUsiaInput" class="form-control" min="0" max="150" placeholder="Usia (Tahun)">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-bold small">Mata Pencaharian / Pekerjaan</label>
                            <input type="text" name="pekerjaan" id="inputPekerjaan" class="form-control" placeholder="Petani, Swasta, dll">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small">Alamat Lengkap Jalan / Dusun</label>
                            <textarea name="alamat" id="inputAlamat" class="form-control" rows="2" placeholder="Jl. Raya Selorejo RT 01 RW 02..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let parsedDataState = null;

    document.addEventListener("DOMContentLoaded", function() {
        // Initialize Chart.js Age Distribution for Operator Panel
        const statsData = @json($statistik['kelompok_usia']);
        
        const labels = statsData.map(item => item.label);
        const values = statsData.map(item => item.jumlah);

        const ctx = document.getElementById('operatorAgeChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Jiwa',
                    data: values,
                    backgroundColor: '#1a5c38',
                    hoverBackgroundColor: '#2d6a4f',
                    borderRadius: 8,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.raw + ' Jiwa';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });

        // Toggle PII masking for NIK / NKK
        document.querySelectorAll('.btn-toggle-pii').forEach(btn => {
            btn.addEventListener('click', function() {
                const row = this.closest('tr');
                const fields = row.querySelectorAll('.pii-field');
                let isMasked = fields[0].textContent.includes('****');
                
                fields.forEach(f => {
                    const full = f.getAttribute('data-full');
                    const masked = f.getAttribute('data-masked');
                    if (isMasked) {
                        f.textContent = f.textContent.startsWith('NKK:') ? 'NKK: ' + full : 'NIK: ' + full;
                    } else {
                        f.textContent = f.textContent.startsWith('NKK:') ? 'NKK: ' + masked : 'NIK: ' + masked;
                    }
                });

                const icon = this.querySelector('i');
                if (icon) {
                    if (isMasked) {
                        icon.setAttribute('data-lucide', 'eye-off');
                    } else {
                        icon.setAttribute('data-lucide', 'eye');
                    }
                    if (window.lucide) window.lucide.createIcons();
                }
            });
        });

        // File Select Handler
        const inputFile = document.getElementById('inputFileExcel');
        inputFile.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                document.getElementById('fileNameDisplay').textContent = 'File terpilih: ' + this.files[0].name;
                uploadAndPreviewFile();
            }
        });
    });

    function uploadAndPreviewFile() {
        const fileInput = document.getElementById('inputFileExcel');
        if (!fileInput.files || !fileInput.files[0]) return;

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

        const formData = new FormData();
        formData.append('file', fileInput.files[0]);
        formData.append('_token', csrfToken);

        document.getElementById('stepUpload').style.display = 'none';
        document.getElementById('previewLoading').style.display = 'block';

        fetch('{{ route("operator.statistik.data-penduduk.preview") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (response.status === 419) {
                alert('Sesi / Token keamanan telah berakhir karena halaman cukup lama terbuka. Halaman akan diperbarui otomatis.');
                window.location.reload();
                return null;
            }
            return response.json();
        })
        .then(res => {
            if (!res) return;
            document.getElementById('previewLoading').style.display = 'none';
            if (res.status === 'success') {
                parsedDataState = res.data;
                renderPreviewState(res.data);
            } else {
                if (res.message && res.message.toLowerCase().includes('csrf')) {
                    alert('Sesi / Token keamanan telah diperbarui. Halaman akan diperbarui otomatis.');
                    window.location.reload();
                    return;
                }
                alert('Gagal memproses file Excel: ' + (res.message || 'Format tidak valid.'));
                document.getElementById('stepUpload').style.display = 'block';
            }
        })
        .catch(err => {
            document.getElementById('previewLoading').style.display = 'none';
            document.getElementById('stepUpload').style.display = 'block';
            alert('Terjadi kesalahan koneksi saat membaca file Excel.');
        });
    }

    function renderPreviewState(data) {
        document.getElementById('stepPreview').style.display = 'block';
        document.getElementById('btnCommitImport').style.display = data.valid_count > 0 ? 'inline-block' : 'none';

        document.getElementById('previewFileName').textContent = 'File: ' + data.original_filename;
        document.getElementById('previewTotalRows').textContent = 'Total: ' + data.total_rows + ' Baris';
        document.getElementById('previewValidRows').textContent = 'Sukses: ' + data.valid_count;
        document.getElementById('previewFailedRows').textContent = 'Gagal: ' + data.failed_count;
        document.getElementById('previewNewRows').textContent = 'Data Baru: ' + data.new_count;
        document.getElementById('previewUpdateRows').textContent = 'Update Existing: ' + data.update_count;

        // Render Failed Rows Section
        const failedSection = document.getElementById('failedSection');
        const failedBody = document.getElementById('failedTableBody');

        if (data.failed_count > 0) {
            failedSection.style.display = 'block';
            document.getElementById('countFailedText').textContent = data.failed_count;
            let failedHtml = '';
            data.failed_details.forEach(item => {
                failedHtml += `
                    <tr>
                        <td class="fw-bold text-danger">Baris ${item.row}</td>
                        <td>NIK: ${item.nik} | ${item.nama}</td>
                        <td class="text-danger fw-semibold">${item.reason}</td>
                    </tr>
                `;
            });
            failedBody.innerHTML = failedHtml;
        } else {
            failedSection.style.display = 'none';
            failedBody.innerHTML = '';
        }

        // Render Valid Rows (preview sample up to 100 rows for instant rendering)
        const validBody = document.getElementById('validTableBody');
        let validHtml = '';
        const previewLimit = 100;
        const rowsToDisplay = data.valid_rows.slice(0, previewLimit);
        
        rowsToDisplay.forEach((row, idx) => {
            const badgeAction = row.action === 'update' 
                ? '<span class="badge bg-warning bg-opacity-10 text-warning border border-warning rounded-pill">Update Existing</span>'
                : '<span class="badge bg-primary bg-opacity-10 text-primary border border-primary rounded-pill">Data Baru</span>';
            
            validHtml += `
                <tr>
                    <td>${idx + 1}</td>
                    <td>${badgeAction}</td>
                    <td>${row.nkk}</td>
                    <td class="fw-bold">${row.nik}</td>
                    <td>${row.nama}</td>
                    <td>${row.jenis_kelamin === 'L' ? 'Laki-Laki' : 'Perempuan'}</td>
                    <td>${row.tanggal_lahir_formatted}</td>
                    <td><span class="badge bg-success bg-opacity-10 text-success">${row.kelompok_usia}</span></td>
                    <td>RT ${row.rt} / RW ${row.rw}</td>
                </tr>
            `;
        });

        if (data.valid_rows.length > previewLimit) {
            validHtml += `
                <tr>
                    <td colspan="9" class="text-center py-3 text-muted bg-light fw-semibold">
                        <i data-lucide="info" class="me-1 icon-xs"></i> 
                        Menampilkan pratinjau <strong>100 dari ${data.valid_rows.length} baris</strong> data valid. Seluruh ${data.valid_rows.length} data akan di-import ke database saat tombol konfirmasi diklik.
                    </td>
                </tr>
            `;
        }
        validBody.innerHTML = validHtml;
        if (window.lucide) window.lucide.createIcons();
    }

    // Commit Event
    document.getElementById('btnCommitImport').addEventListener('click', function() {
        if (!parsedDataState || parsedDataState.valid_count === 0) return;

        if (!confirm(`Konfirmasi import ${parsedDataState.valid_count} baris data ke database?`)) return;

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

        this.disabled = true;
        this.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Meng-import...';

        fetch('{{ route("operator.statistik.data-penduduk.commit") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                _token: csrfToken,
                temp_key: parsedDataState.temp_key,
                valid_rows: parsedDataState.valid_rows,
                failed_details: parsedDataState.failed_details,
                original_filename: parsedDataState.original_filename
            })
        })
        .then(res => {
            if (res.status === 419) {
                alert('Sesi / Token keamanan telah berakhir. Halaman akan dimuat ulang.');
                window.location.reload();
                return null;
            }
            return res.json();
        })
        .then(data => {
            if (!data) return;
            if (data.status === 'success') {
                alert(data.message);
                window.location.reload();
            } else {
                alert('Gagal commit import: ' + (data.message || 'Error server'));
                this.disabled = false;
                this.innerHTML = '<i data-lucide="check-circle" class="me-1 icon-xs"></i> Konfirmasi & Commit Import';
            }
        })
        .catch(err => {
            alert('Terjadi kesalahan jaringan.');
            this.disabled = false;
            this.innerHTML = '<i data-lucide="check-circle" class="me-1 icon-xs"></i> Konfirmasi & Commit Import';
        });
    });

    function editPenduduk(item) {
        document.getElementById('modalFormTitle').textContent = 'Edit Data Penduduk (' + item.nama + ')';
        const form = document.getElementById('formPenduduk');
        form.action = '/operator/statistik/data-penduduk/' + item.id;
        document.getElementById('formMethod').value = 'PUT';

        document.getElementById('inputNkk').value = item.nkk || '';
        document.getElementById('inputNik').value = item.nik || '';
        document.getElementById('inputNama').value = item.nama || '';
        document.getElementById('inputKelamin').value = item.jenis_kelamin || 'L';
        document.getElementById('inputTempatLahir').value = item.tempat_lahir !== '-' ? (item.tempat_lahir || '') : '';
        document.getElementById('inputTanggalLahir').value = item.tanggal_lahir ? item.tanggal_lahir.substring(0, 10) : '';
        document.getElementById('inputStatusKawin').value = item.status_kawin !== '-' ? (item.status_kawin || 'Kawin') : 'Kawin';
        document.getElementById('inputRt').value = item.rt !== '-' ? (item.rt || '') : '';
        document.getElementById('inputRw').value = item.rw !== '-' ? (item.rw || '') : '';
        document.getElementById('inputUsiaInput').value = item.usia_input !== null ? item.usia_input : '';
        document.getElementById('inputPekerjaan').value = item.pekerjaan !== '-' ? (item.pekerjaan || '') : '';
        document.getElementById('inputAlamat').value = item.alamat !== '-' ? (item.alamat || '') : '';

        const modal = new bootstrap.Modal(document.getElementById('modalTambahPenduduk'));
        modal.show();
    }
</script>
@endpush
@endsection
