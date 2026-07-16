@extends('layouts.dashboard')
@section('title', 'Detail Pengajuan #' . $pengajuan->no_tiket)
@section('content')

<div class="mb-4 text-start">
    <a href="{{ route('operator.layanan.index') }}" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm transition-all hover-lift">
        <i data-lucide="arrow-left" class="icon-sm me-1"></i> Kembali ke Daftar
    </a>
</div>

<div class="row g-4 text-start" style="font-family: var(--font-body);">
    <!-- Left Column: Details & Documents -->
    <div class="col-lg-8">
        <!-- Main details card -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white">
            <div class="card-header bg-white border-0 p-4 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="d-flex align-items-center">
                    <div class="p-2 rounded-3 bg-success bg-opacity-10 text-success me-3">
                        <i data-lucide="file-text" class="icon-sm"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-dark">Detail Berkas Pengajuan</h5>
                        <small class="text-muted">{{ $pengajuan->no_tiket }} · {{ $pengajuan->jenis_layanan_label }}</small>
                    </div>
                </div>
                <span class="badge {{ $pengajuan->status_badge_class }} px-3 py-2 rounded-pill">{{ $pengajuan->status_label }}</span>
            </div>

            <div class="card-body p-4">
                <!-- Pemohon metadata -->
                <h6 class="fw-bold mb-3 text-success">Data Pemohon (Sisi Form)</h6>
                <div class="row g-3 mb-4 bg-light p-3 rounded-3">
                    <div class="col-sm-6">
                        <small class="text-muted d-block font-weight-bold text-uppercase small">Nama Pemohon</small>
                        <span class="fw-bold text-dark">{{ $pengajuan->nama_pemohon }}</span>
                    </div>
                    <div class="col-sm-6">
                        <small class="text-muted d-block font-weight-bold text-uppercase small">NIK Pemohon</small>
                        <span class="fw-bold text-dark">{{ $pengajuan->nik_pemohon }}</span>
                    </div>
                    <div class="col-sm-6">
                        <small class="text-muted d-block font-weight-bold text-uppercase small">No. WhatsApp</small>
                        <span class="fw-bold text-dark">{{ $pengajuan->no_hp_pemohon }}</span>
                    </div>
                    <div class="col-sm-6">
                        <small class="text-muted d-block font-weight-bold text-uppercase small">Email Pemohon</small>
                        <span class="fw-bold text-dark">{{ $pengajuan->email_pemohon ?: '-' }}</span>
                    </div>
                </div>

                <!-- Custom details based on type -->
                @if($pengajuan->jenis_layanan === 'akta_kelahiran' && $pengajuan->detailAktaKelahiran)
                    @php $detail = $pengajuan->detailAktaKelahiran; @endphp
                    <h6 class="fw-bold mb-3 text-success mt-4">Data Kelahiran Anak</h6>
                    <div class="row g-3 mb-4 border p-3 rounded-3">
                        <div class="col-sm-6">
                            <small class="text-muted d-block small">Nama Anak</small>
                            <span class="fw-bold text-dark">{{ $detail->nama_anak }}</span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block small">Jenis Kelamin</small>
                            <span class="fw-bold text-dark">{{ $detail->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block small">Tempat & Tanggal Lahir</small>
                            <span class="fw-bold text-dark">{{ $detail->tempat_lahir }}, {{ \Carbon\Carbon::parse($detail->tanggal_lahir)->translatedFormat('d F Y') }}</span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block small">Jam Lahir / Anak Ke</small>
                            <span class="fw-bold text-dark">{{ $detail->jam_lahir ?: '-' }} / Anak ke-{{ $detail->anak_ke }}</span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block small">Berat & Panjang Lahir</small>
                            <span class="fw-bold text-dark">{{ $detail->berat_lahir ?: '-' }} kg / {{ $detail->panjang_lahir ?: '-' }} cm</span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block small">Penerbit Surat Lahir</small>
                            <span class="fw-bold text-dark text-uppercase">{{ $detail->tempat_penerbit_surat_lahir }}</span>
                        </div>
                    </div>

                    <h6 class="fw-bold mb-3 text-success">Orang Tua & Saksi</h6>
                    <div class="row g-3 mb-4 border p-3 rounded-3">
                        <div class="col-sm-6">
                            <small class="text-muted d-block small">NIK Ayah / NIK Ibu</small>
                            <span class="fw-bold text-dark">{{ $detail->nik_ayah }} / {{ $detail->nik_ibu }}</span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block small">No. KK Orang Tua</small>
                            <span class="fw-bold text-dark">{{ $detail->no_kk_orangtua }}</span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block small">Saksi 1 (Nama/NIK)</small>
                            <span class="fw-bold text-dark">{{ $detail->nama_saksi1 }} ({{ $detail->nik_saksi1 }})</span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block small">Saksi 2 (Nama/NIK)</small>
                            <span class="fw-bold text-dark">{{ $detail->nama_saksi2 }} ({{ $detail->nik_saksi2 }})</span>
                        </div>
                    </div>
                @endif

                @if($pengajuan->jenis_layanan === 'akta_kematian' && $pengajuan->detailAktaKematian)
                    @php $detail = $pengajuan->detailAktaKematian; @endphp
                    <h6 class="fw-bold mb-3 text-success mt-4">Data Almarhum & Pelapor</h6>
                    <div class="row g-3 mb-4 border p-3 rounded-3">
                        <div class="col-sm-6">
                            <small class="text-muted d-block small">Nama / NIK Almarhum</small>
                            <span class="fw-bold text-dark">{{ $detail->nama_almarhum }} / {{ $detail->nik_almarhum }}</span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block small">TTL Almarhum</small>
                            <span class="fw-bold text-dark">{{ $detail->tempat_lahir }}, {{ \Carbon\Carbon::parse($detail->tanggal_lahir)->translatedFormat('d F Y') }}</span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block small">Meninggal di</small>
                            <span class="fw-bold text-dark">{{ $detail->tempat_meninggal }}, {{ \Carbon\Carbon::parse($detail->tanggal_meninggal)->translatedFormat('d F Y') }}</span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block small">Sebab Kematian</small>
                            <span class="fw-bold text-dark">{{ $detail->sebab_kematian ?: '-' }}</span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block small">Pelapor (Nama/NIK)</small>
                            <span class="fw-bold text-dark">{{ $detail->nama_pelapor }} ({{ $detail->nik_pelapor }})</span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block small">Hubungan / Identitas Jelas?</small>
                            <span class="fw-bold text-dark">{{ $detail->hubungan_pelapor }} / {{ $detail->identitas_jelas ? 'Ya (Jelas)' : 'Tidak Jelas (Laporan Polisi)' }}</span>
                        </div>
                    </div>
                @endif

                @if(str_starts_with($pengajuan->jenis_layanan, 'kk_') && $pengajuan->detailKk)
                    @php $detail = $pengajuan->detailKk; @endphp
                    <h6 class="fw-bold mb-3 text-success mt-4">Detail Pengajuan Perubahan KK</h6>
                    <div class="row g-3 mb-4 border p-3 rounded-3">
                        <div class="col-sm-6">
                            <small class="text-muted d-block small">Jenis Perubahan</small>
                            <span class="fw-bold text-dark text-uppercase">{{ str_replace('_', ' ', $detail->jenis_perubahan) }}</span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block small">No. KK Asal / KK Terkait</small>
                            <span class="fw-bold text-dark">{{ $detail->no_kk_asal ?: '-' }}</span>
                        </div>
                        @if($detail->alamat_baru)
                            <div class="col-12">
                                <small class="text-muted d-block small">Alamat Baru</small>
                                <span class="fw-bold text-dark">{{ $detail->alamat_baru }}</span>
                            </div>
                        @endif

                        @if($detail->data_lama)
                            <div class="col-md-6">
                                <small class="text-muted d-block small mb-2">Data Lama</small>
                                <div class="bg-light p-3 rounded-3 border">
                                    <ul class="list-unstyled mb-0 small text-dark">
                                        @foreach($detail->data_lama as $key => $val)
                                            @php
                                                $keyLabel = ucwords(str_replace('_', ' ', $key));
                                                if ($key === 'alamat') $keyLabel = 'Alamat';
                                                elseif ($key === 'jumlah_anggota') $keyLabel = 'Jumlah Anggota';
                                            @endphp
                                            <li class="mb-1"><strong>{{ $keyLabel }}:</strong> {{ is_array($val) ? implode(', ', $val) : $val }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if($detail->data_baru)
                            <div class="col-md-6">
                                <small class="text-muted d-block small mb-2">Data Baru</small>
                                <div class="bg-light p-3 rounded-3 border">
                                    <ul class="list-unstyled mb-0 small text-dark">
                                        @foreach($detail->data_baru as $key => $val)
                                            @php
                                                $keyLabel = ucwords(str_replace('_', ' ', $key));
                                                if ($key === 'alamat') $keyLabel = 'Alamat';
                                                elseif ($key === 'jumlah_anggota') $keyLabel = 'Jumlah Anggota';
                                            @endphp
                                            <li class="mb-1"><strong>{{ $keyLabel }}:</strong> {{ is_array($val) ? implode(', ', $val) : $val }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if($detail->anggota_terlibat)
                            <div class="col-12">
                                <small class="text-muted d-block small">Anggota Keluarga Terlibat</small>
                                <span class="fw-bold text-dark">{{ is_array($detail->anggota_terlibat) ? implode(', ', $detail->anggota_terlibat) : $detail->anggota_terlibat }}</span>
                            </div>
                        @endif
                    </div>
                @endif

                @if(str_starts_with($pengajuan->jenis_layanan, 'ktp_') && $pengajuan->detailKtp)
                    @php $detail = $pengajuan->detailKtp; @endphp
                    <h6 class="fw-bold mb-3 text-success mt-4">Detail Pengajuan KTP-el</h6>
                    <div class="row g-3 mb-4 border p-3 rounded-3">
                        <div class="col-sm-6">
                            <small class="text-muted d-block small">Jenis Pengajuan KTP</small>
                            <span class="fw-bold text-dark text-uppercase">{{ str_replace('_', ' ', $detail->jenis_pengajuan) }}</span>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted d-block small">No. Surat Kehilangan</small>
                            <span class="fw-bold text-dark">{{ $detail->no_surat_kehilangan ?: '-' }}</span>
                        </div>
                        @if($detail->jadwal_perekaman)
                            <div class="col-12">
                                <small class="text-muted d-block small">Jadwal Kehadiran (Perekaman/Pengambilan)</small>
                                <span class="fw-bold text-success">{{ \Carbon\Carbon::parse($detail->jadwal_perekaman)->translatedFormat('d F Y, H:i') }} WIB</span>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Uploaded Documents -->
                <h6 class="fw-bold mb-3 text-success mt-4">Dokumen Persyaratan yang Diunggah</h6>
                <div class="row g-3">
                    @foreach($pengajuan->dokumenUploads as $doc)
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 rounded-3 border bg-white shadow-xs hover-lift">
                                <div class="bg-success bg-opacity-10 text-success p-2 rounded-3 me-3">
                                    <i data-lucide="file" class="icon-sm"></i>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <span class="fw-bold text-dark small d-block text-truncate" title="{{ $doc->jenis_dokumen_label }}">{{ $doc->jenis_dokumen_label }}</span>
                                    <small class="text-muted text-truncate d-block" style="font-size: 0.75rem;">{{ $doc->safe_nama_file }}</small>
                                </div>
                                <a href="{{ $doc->file_url }}" target="_blank" class="btn btn-sm btn-white border rounded-circle shadow-xs ms-2 p-1" title="Lihat/Download Berkas">
                                    <i data-lucide="external-link" style="width: 16px; height: 16px;"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Verification & Status Updates -->
    <div class="col-lg-4">
        <!-- Action Card -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white" style="border-top: 4px solid var(--color-forest) !important;">
            <div class="card-header bg-white border-0 p-4 pb-0">
                <h5 class="fw-bold mb-0 text-dark">Perbarui Status Berkas</h5>
                <small class="text-muted">Proses verifikasi dokumen administrasi</small>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('operator.layanan.status', $pengajuan->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted small">STATUS PENGAJUAN</label>
                        <select name="status" class="form-select rounded-3 py-2 border bg-light shadow-none fw-bold text-success" required>
                            <option value="diajukan" {{ $pengajuan->status === 'diajukan' ? 'selected' : '' }}>Diajukan (Baru)</option>
                            <option value="diverifikasi" {{ $pengajuan->status === 'diverifikasi' ? 'selected' : '' }}>Diverifikasi Admin</option>
                            <option value="diproses_disdukcapil" {{ $pengajuan->status === 'diproses_disdukcapil' ? 'selected' : '' }}>Diproses Disdukcapil</option>
                            <option value="selesai" {{ $pengajuan->status === 'selesai' ? 'selected' : '' }}>Selesai / Jadi</option>
                            <option value="ditolak" {{ $pengajuan->status === 'ditolak' ? 'selected' : '' }}>Ditolak / Berkas Kurang</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted small">CATATAN / ALASAN</label>
                        <textarea name="catatan" class="form-control rounded-3 border bg-light shadow-none" rows="4" placeholder="Tulis catatan verifikasi atau alasan tolak..." required>{{ old('catatan', $pengajuan->catatan_admin) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success w-100 rounded-pill py-3 fw-bold shadow-sm hover-lift border-0">
                        <i data-lucide="save" class="icon-sm me-1"></i> SIMPAN PERUBAHAN
                    </button>
                </form>

                <div class="mt-3">
                    <a href="{{ route('operator.layanan.notif', $pengajuan->id) }}" target="_blank" class="btn btn-outline-forest w-100 rounded-pill py-3 fw-bold shadow-sm hover-lift">
                        <i data-lucide="message-circle" class="icon-sm me-1"></i> HUBUNGI / NOTIF WA
                    </a>
                </div>
            </div>
        </div>

        <!-- History Log Card -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
            <div class="card-header bg-white border-0 p-4 pb-0 border-bottom-0">
                <h5 class="fw-bold mb-0 text-dark">Riwayat Log Status</h5>
                <small class="text-muted">Jejak audit berkas layanan</small>
            </div>
            <div class="card-body p-4 pt-3">
                <div class="position-relative ps-3 border-start border-success border-opacity-25 pb-2 ms-2">
                    @foreach($pengajuan->logStatuses as $log)
                        <div class="mb-4 position-relative text-start">
                            <div class="position-absolute rounded-circle shadow-sm border border-white" style="width: 12px; height: 12px; left: -20px; top: 5px; background-color: var(--color-kiwi);"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-dark small" style="font-size: 0.75rem;">{{ $log->status_baru_label }}</span>
                                <small class="text-muted" style="font-size: 0.65rem;">{{ $log->created_at->format('d/m H:i') }}</small>
                            </div>
                            <p class="text-muted small mb-0 mt-1" style="font-size: 0.7rem; font-family: var(--font-body);">{{ $log->catatan }}</p>
                            @if($log->operator)
                                <small class="text-success d-block mt-1" style="font-size: 0.65rem;">Oleh: {{ $log->operator->name }}</small>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
