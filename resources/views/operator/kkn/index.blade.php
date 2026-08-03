@extends('layouts.dashboard')
@section('title', 'Kelola Halaman KKN UNS 178')
@section('content')

<div class="row text-start">
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i data-lucide="check-circle" class="me-2 icon-sm"></i>
                    <div class="fw-bold">{{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Tab Navigation --}}
        <ul class="nav nav-pills mb-4 bg-white p-2 rounded-pill shadow-sm d-inline-flex border" id="kknTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active rounded-pill px-4 py-2 d-flex align-items-center fw-bold" id="anggota-tab" data-bs-toggle="pill" data-bs-target="#tab-anggota" type="button" role="tab">
                    <i data-lucide="users" class="icon-sm me-2"></i> Data Anggota
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill px-4 py-2 d-flex align-items-center fw-bold" id="settings-tab" data-bs-toggle="pill" data-bs-target="#tab-settings" type="button" role="tab">
                    <i data-lucide="settings" class="icon-sm me-2"></i> Pengaturan Halaman
                </button>
            </li>
        </ul>

        <div class="tab-content" id="kknTabsContent">

            {{-- ═══════════════════════════════════════════════════
                 TAB 1: DAFTAR ANGGOTA
            ═══════════════════════════════════════════════════ --}}
            <div class="tab-pane fade show active" id="tab-anggota" role="tabpanel">
                <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h5 class="fw-bold mb-1"><i data-lucide="users" class="text-success me-2"></i> Anggota KKN UNS 178</h5>
                                <small class="text-muted">Total {{ $anggota->count() }} anggota terdaftar</small>
                            </div>
                            <a href="/operator/kkn/create" class="btn btn-success rounded-pill px-4 shadow-sm border-0 fw-bold">
                                <i data-lucide="plus" class="icon-sm me-1"></i> Tambah Anggota
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle rounded-4 overflow-hidden border-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 ps-3" style="width:50px;">#</th>
                                        <th class="border-0">Foto</th>
                                        <th class="border-0">Nama & NIM</th>
                                        <th class="border-0">Prodi / Fakultas</th>
                                        <th class="border-0">Badge</th>
                                        <th class="border-0">Program Kerja</th>
                                        <th class="border-0 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($anggota as $m)
                                    <tr>
                                        <td class="ps-3 text-muted small fw-bold">{{ $m->urutan }}</td>
                                        <td>
                                            @php
                                                $fotoUrl = $m->foto
                                                    ? (str_starts_with($m->foto, 'images/') ? asset($m->foto) : asset('storage/' . $m->foto))
                                                    : asset('images/default-avatar.png');
                                            @endphp
                                            <img src="{{ $fotoUrl }}" alt="{{ $m->nama }}"
                                                 class="rounded-circle shadow-sm border"
                                                 style="width:48px; height:48px; object-fit:cover; object-position:top;">
                                        </td>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $m->nama }}</div>
                                            <small class="text-muted">{{ $m->nim }}</small>
                                        </td>
                                        <td>
                                            <div class="small text-dark">{{ $m->prodi }}</div>
                                            <span class="badge rounded-pill" style="background:rgba(26,92,56,0.1); color:#1A5C38; font-size:0.7rem;">{{ $m->fakultas }}</span>
                                        </td>
                                        <td>
                                            @if($m->badge === 'ketua')
                                                <span class="badge rounded-pill bg-warning text-dark">⭐ Ketua</span>
                                            @elseif($m->badge === 'developer')
                                                <span class="badge rounded-pill bg-success text-white">💻 Developer</span>
                                            @else
                                                <span class="text-muted small">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="small text-muted" style="max-width:280px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;" title="{{ $m->proker }}">
                                                {{ $m->proker }}
                                            </div>
                                            @if($m->sdg)
                                                <div class="mt-1">
                                                    @foreach($m->sdg as $s)
                                                        <span class="badge rounded-pill bg-secondary text-white" style="font-size:0.65rem;">SDG {{ $s }}</span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex gap-2 justify-content-center">
                                                <a href="/operator/kkn/{{ $m->id }}/edit" class="btn btn-sm btn-light rounded-pill px-3 border hover-lift">
                                                    <i data-lucide="pencil" class="icon-xs me-1"></i> Edit
                                                </a>
                                                <form action="/operator/kkn/{{ $m->id }}" method="POST" onsubmit="return confirm('Hapus anggota {{ $m->nama }}?')">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-sm btn-danger rounded-pill px-3 border-0">
                                                        <i data-lucide="trash-2" class="icon-xs me-1"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if($anggota->isEmpty())
                            <div class="text-center py-5 text-muted">
                                <i data-lucide="users" class="mb-3" style="width:48px;height:48px;opacity:0.3;"></i>
                                <p>Belum ada anggota. <a href="/operator/kkn/create" class="text-success fw-bold">Tambah sekarang</a></p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Preview link --}}
                <div class="text-center text-muted small mt-3">
                    <i data-lucide="eye" class="icon-xs me-1"></i>
                    Preview: <a href="{{ url('/kkn-uns-178') }}" target="_blank" class="text-success fw-bold">{{ url('/kkn-uns-178') }}</a>
                </div>
            </div>

            {{-- ═══════════════════════════════════════════════════
                 TAB 2: PENGATURAN HALAMAN KKN
            ═══════════════════════════════════════════════════ --}}
            <div class="tab-pane fade" id="tab-settings" role="tabpanel">
                <form action="/operator/kkn/settings" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- ── Section: Identitas & Hero ── --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden border-top border-4 border-success">
                        <div class="card-body p-4 p-md-5">
                            <h5 class="fw-bold mb-4"><i data-lucide="layout" class="text-success me-2"></i> Identitas & Hero Halaman</h5>

                            <div class="row g-4 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold text-muted">Label Kelompok</label>
                                    <input type="text" name="kelompok_label" class="form-control rounded-3"
                                           value="{{ $decoded['kelompok_label'] ?? 'KKN TEMATIK UNS — KELOMPOK 178' }}"
                                           placeholder="KKN TEMATIK UNS — KELOMPOK 178">
                                    <small class="text-muted">Teks badge kecil di atas judul</small>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold text-muted">Judul Utama</label>
                                    <input type="text" name="judul_utama" class="form-control rounded-3"
                                           value="{{ $decoded['judul_utama'] ?? 'KKN Tematik UNS 178' }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold text-muted">Sub-Judul (Sorotan)</label>
                                    <input type="text" name="subjudul" class="form-control rounded-3"
                                           value="{{ $decoded['subjudul'] ?? 'Desa Selorejo' }}">
                                    <small class="text-muted">Tampil dengan warna kuning emas</small>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold text-muted">Tagline / Deskripsi Singkat</label>
                                    <textarea name="tagline" class="form-control rounded-3" rows="2"
                                              placeholder="Pemberdayaan Desa Selorejo Berbasis Digitalisasi...">{{ $decoded['tagline'] ?? '' }}</textarea>
                                </div>
                            </div>

                            {{-- Logo --}}
                            <div class="row g-4 mb-2">
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold text-muted">Logo KKN (foto bulat)</label>
                                    <div class="p-3 border rounded-4 bg-light text-center">
                                        @php
                                            $logoPath = $decoded['logo'] ?? 'images/logo-kkn-178.png';
                                            $logoUrl  = str_starts_with($logoPath, 'images/') ? asset($logoPath) : asset('storage/' . $logoPath);
                                        @endphp
                                        <img src="{{ $logoUrl }}" class="rounded-circle mb-3 border" style="width:80px;height:80px;object-fit:cover;" onerror="this.style.display='none'">
                                        <input type="file" name="logo" class="form-control rounded-pill border-0 shadow-sm" accept="image/*">
                                        <small class="text-muted d-block mt-2">Maks 2MB. Foto akan ditampilkan bulat.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ── Section: Info Badges ── --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden border-top border-4 border-success">
                        <div class="card-body p-4 p-md-5">
                            <h5 class="fw-bold mb-4"><i data-lucide="info" class="text-success me-2"></i> Info Badges (4 Kotak Bawah Hero)</h5>
                            <div class="row g-4">
                                <div class="col-md-3">
                                    <label class="form-label small fw-bold text-muted"><i data-lucide="map-pin" class="icon-xs me-1"></i> Lokasi</label>
                                    <textarea name="badge_lokasi" class="form-control rounded-3" rows="2">{{ $decoded['badge_lokasi'] ?? '' }}</textarea>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small fw-bold text-muted"><i data-lucide="calendar" class="icon-xs me-1"></i> Periode</label>
                                    <input type="text" name="badge_periode" class="form-control rounded-3" value="{{ $decoded['badge_periode'] ?? '' }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small fw-bold text-muted"><i data-lucide="zap" class="icon-xs me-1"></i> Tema</label>
                                    <textarea name="badge_tema" class="form-control rounded-3" rows="2">{{ $decoded['badge_tema'] ?? '' }}</textarea>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small fw-bold text-muted"><i data-lucide="users" class="icon-xs me-1"></i> Anggota</label>
                                    <textarea name="badge_anggota" class="form-control rounded-3" rows="2">{{ $decoded['badge_anggota'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ── Section: Link Sosmed ── --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden border-top border-4 border-success">
                        <div class="card-body p-4 p-md-5">
                            <h5 class="fw-bold mb-4"><i data-lucide="share-2" class="text-success me-2"></i> Link Media Sosial</h5>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted"><i data-lucide="instagram" class="icon-xs me-1"></i> Link Instagram</label>
                                    <input type="url" name="link_instagram" class="form-control rounded-3"
                                           value="{{ $decoded['link_instagram'] ?? '' }}"
                                           placeholder="https://www.instagram.com/...">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">TikTok</label>
                                    <input type="url" name="link_tiktok" class="form-control rounded-3"
                                           value="{{ $decoded['link_tiktok'] ?? '' }}"
                                           placeholder="https://www.tiktok.com/@...">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ── Section: Deskripsi Program ── --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden border-top border-4 border-success">
                        <div class="card-body p-4 p-md-5">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="fw-bold mb-0"><i data-lucide="file-text" class="text-success me-2"></i> Deskripsi Program KKN</h5>
                                <button type="button" class="btn btn-sm btn-success rounded-pill px-4 border-0" onclick="tambahParagraf()">
                                    <i data-lucide="plus" class="icon-xs me-1"></i> Tambah Paragraf
                                </button>
                            </div>
                            <div id="paragraf-container">
                                @php $paragraf = $decoded['deskripsi_program'] ?? ['']; @endphp
                                @foreach($paragraf as $pi => $p)
                                <div class="paragraf-row mb-3 d-flex gap-2 align-items-start">
                                    <span class="badge bg-light text-dark border mt-2 rounded-circle fw-bold" style="min-width:28px;">{{ $pi+1 }}</span>
                                    <textarea name="deskripsi_program[]" class="form-control rounded-3 flex-grow-1" rows="3"
                                              placeholder="Tulis paragraf deskripsi program KKN...">{{ $p }}</textarea>
                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-circle mt-1" onclick="this.closest('.paragraf-row').remove()" title="Hapus">
                                        <i data-lucide="x" class="icon-xs"></i>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            <small class="text-muted"><i data-lucide="info" class="icon-xs me-1"></i> HTML sederhana diperbolehkan di dalam paragraf (&lt;strong&gt;, &lt;em&gt;).</small>
                        </div>
                    </div>

                    {{-- ── Section: DPL ── --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden border-top border-4 border-success">
                        <div class="card-body p-4 p-md-5">
                            <h5 class="fw-bold mb-4"><i data-lucide="award" class="text-success me-2"></i> Dosen Pembimbing Lapangan (DPL)</h5>
                            @php $dpl = $decoded['dpl'] ?? []; @endphp
                            <div class="row g-4 align-items-start">
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold text-muted">Foto DPL</label>
                                    <div class="p-3 border rounded-4 bg-light text-center">
                                        @php
                                            $dplFoto = $dpl['foto'] ?? 'images/Rin Widya.png';
                                            $dplFotoUrl = str_starts_with($dplFoto, 'images/') ? asset($dplFoto) : asset('storage/' . $dplFoto);
                                        @endphp
                                        <img src="{{ $dplFotoUrl }}" class="rounded-circle mb-3 border" style="width:100px;height:100px;object-fit:cover;object-position:top;" onerror="this.style.display='none'">
                                        <input type="file" name="dpl_foto" class="form-control rounded-pill border-0 shadow-sm" accept="image/*">
                                        <small class="text-muted d-block mt-2">Maks 2MB</small>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label small fw-bold text-muted">Nama Lengkap + Gelar</label>
                                            <input type="text" name="dpl_nama" class="form-control rounded-3"
                                                   value="{{ $dpl['nama'] ?? 'Rin Widya Agustin, S.Psi., M.Psi.' }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-muted">Jabatan / Golongan</label>
                                            <input type="text" name="dpl_jabatan" class="form-control rounded-3"
                                                   value="{{ $dpl['jabatan'] ?? 'Penata / Lektor' }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold text-muted">Institusi</label>
                                            <input type="text" name="dpl_institusi" class="form-control rounded-3"
                                                   value="{{ $dpl['institusi'] ?? 'Universitas Sebelas Maret' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-5 bg-success bg-opacity-10 border-top border-4 border-success">
                        <div class="card-body p-4 text-center">
                            <button type="submit" class="btn btn-success px-5 py-3 rounded-pill fw-bold hover-lift shadow border-0">
                                <i data-lucide="save" class="me-2"></i> Simpan Pengaturan KKN
                            </button>
                            <div class="mt-3 text-muted small">Perubahan akan langsung tampil di halaman publik <a href="{{ url('/kkn-uns-178') }}" target="_blank" class="text-success">/kkn-uns-178</a></div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function tambahParagraf() {
    const container = document.getElementById('paragraf-container');
    const idx = container.querySelectorAll('.paragraf-row').length + 1;
    const html = `<div class="paragraf-row mb-3 d-flex gap-2 align-items-start">
        <span class="badge bg-light text-dark border mt-2 rounded-circle fw-bold" style="min-width:28px;">${idx}</span>
        <textarea name="deskripsi_program[]" class="form-control rounded-3 flex-grow-1" rows="3" placeholder="Tulis paragraf..."></textarea>
        <button type="button" class="btn btn-sm btn-outline-danger rounded-circle mt-1" onclick="this.closest('.paragraf-row').remove()" title="Hapus">
            <i data-lucide="x" class="icon-xs"></i>
        </button>
    </div>`;
    container.insertAdjacentHTML('beforeend', html);
    if (window.lucide) lucide.createIcons();
}
</script>
@endpush
