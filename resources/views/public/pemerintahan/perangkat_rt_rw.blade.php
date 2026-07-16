@extends('layouts.public')
@section('title', 'Perangkat RT & RW')
@section('breadcrumb')
    <li class="breadcrumb-item">Pemerintahan</li>
    <li class="breadcrumb-item active">Perangkat RT & RW</li>
@endsection
@section('content')
@include('layouts.partials.page-hero', [
    'title'    => $hero['title']    ?? 'Perangkat RT & RW',
    'subtitle' => $hero['subtitle'] ?? 'Daftar Ketua RT dan RW Desa Selorejo',
    'icon'     => $hero['icon']     ?? 'map-pin'
])

<div class="container mb-5 pb-5">

    {{-- Statistik ringkas --}}
    @php
        $totalRt = $rtByRw->flatten()->count();
        $totalRw = $rwList->count();
    @endphp
    <div class="row g-3 mb-5 justify-content-center">
        <div class="col-auto">
            <div class="d-flex align-items-center gap-3 bg-white border rounded-4 px-4 py-3 shadow-sm"
                 style="border-color: var(--color-forest)33 !important;">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:42px;height:42px;background:rgba(26,92,56,0.1);color:var(--color-forest);">
                    <i data-lucide="map-pin" class="icon-sm"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark fs-5">{{ $totalRt }} RT</div>
                    <small class="text-muted" style="font-family:var(--font-body);">Rukun Tetangga</small>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <div class="d-flex align-items-center gap-3 bg-white border rounded-4 px-4 py-3 shadow-sm"
                 style="border-color: var(--color-forest)33 !important;">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:42px;height:42px;background:rgba(13,110,253,0.1);color:#0d6efd;">
                    <i data-lucide="layers" class="icon-sm"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark fs-5">{{ $totalRw }} RW</div>
                    <small class="text-muted" style="font-family:var(--font-body);">Rukun Warga</small>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <div class="d-flex align-items-center gap-3 bg-white border rounded-4 px-4 py-3 shadow-sm"
                 style="border-color: var(--color-forest)33 !important;">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:42px;height:42px;background:rgba(255,193,7,0.15);color:#856404;">
                    <i data-lucide="home" class="icon-sm"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark fs-5">3 Dusun</div>
                    <small class="text-muted" style="font-family:var(--font-body);">Wilayah Desa</small>
                </div>
            </div>
        </div>
    </div>


    {{-- Tab per Dusun --}}
    @php
        $dusunGroups = [
            'Dsn. Krajan'    => ['label'=>'Dusun Krajan',    'icon'=>'map-pin', 'rwRange'=>[1,2,3,4]],
            'Dsn. Selokerto' => ['label'=>'Dusun Selokerto', 'icon'=>'map-pin', 'rwRange'=>[5,6]],
            'Dsn. Gumuk'     => ['label'=>'Dusun Gumuk',     'icon'=>'map-pin', 'rwRange'=>[6,7]],
        ];
    @endphp

    <ul class="nav nav-pills mb-4 gap-2 justify-content-center flex-wrap" id="dusunTab" role="tablist">
        @foreach($dusunGroups as $dusunKey => $dusun)
        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-pill px-4 py-2 fw-semibold {{ $loop->first ? 'active' : '' }}"
                    id="tab-{{ $loop->index }}"
                    data-bs-toggle="pill"
                    data-bs-target="#pane-{{ $loop->index }}"
                    type="button"
                    style="font-family: var(--font-body);">
                <i data-lucide="{{ $dusun['icon'] }}" class="icon-xs me-1"></i>
                {{ $dusun['label'] }}
            </button>
        </li>
        @endforeach
    </ul>

    <div class="tab-content">
        @foreach($dusunGroups as $dusunKey => $dusun)
        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pane-{{ $loop->index }}" role="tabpanel">

            {{-- RW dalam dusun ini --}}
            @php
                $rwDalamDusun = $rwList->filter(fn($rw) => $rw->dusun === $dusunKey || in_array($rw->nomor_rw, $dusun['rwRange']));
                // Hanya RW yang punya RT di dusun ini
                $rwDalamDusun = $rwList->filter(function($rw) use ($dusunKey, $rtByRw) {
                    $rts = $rtByRw->get($rw->nomor_rw, collect());
                    return $rts->contains('dusun', $dusunKey) || $rw->dusun === $dusunKey;
                });
            @endphp

            @if($rwDalamDusun->isEmpty())
                <div class="text-center text-muted py-5" style="font-family:var(--font-body);">
                    Belum ada data untuk dusun ini.
                </div>
            @else
                <div class="row g-4">
                    @foreach($rwDalamDusun as $rw)
                    @php
                        // RT yang ada di RW ini DAN di dusun ini (exact match)
                        $rtDalamRw = ($rtByRw->get($rw->nomor_rw) ?? collect())
                                        ->filter(fn($rt) => $rt->dusun === $dusunKey)
                                        ->sortBy('nomor');
                    @endphp
                    <div class="col-lg-6">
                        {{-- Card RW --}}
                        <div class="glass-card bg-white rounded-4 border shadow-sm h-100 overflow-hidden"
                             style="border-color: var(--color-forest)33 !important;">
                            {{-- RW Header --}}
                            <div class="p-4 d-flex align-items-center gap-3"
                                 style="background: linear-gradient(135deg, rgba(26,92,56,0.06) 0%, rgba(26,92,56,0.02) 100%); border-bottom: 1px solid rgba(26,92,56,0.1);">
                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm"
                                     style="width:54px;height:54px;background:rgba(26,92,56,0.12);color:var(--color-forest);overflow:hidden;">
                                    @if($rw->foto)
                                        <img src="{{ asset('storage/'.$rw->foto) }}" alt="{{ $rw->nama }}" style="width:100%;height:100%;object-fit:cover;">
                                    @else
                                        <i data-lucide="layers" class="icon-md"></i>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <span class="badge rounded-pill fw-bold px-3"
                                              style="background:rgba(13,110,253,0.12);color:#0d6efd;font-family:var(--font-body);">
                                            RW {{ str_pad($rw->nomor,2,'0',STR_PAD_LEFT) }}
                                        </span>
                                        <small class="text-muted" style="font-family:var(--font-body);">{{ $dusunKey }}</small>
                                    </div>
                                    <h5 class="fw-bold text-dark mb-0" style="font-family:var(--font-heading);">{{ $rw->nama }}</h5>
                                    <small class="text-muted" style="font-family:var(--font-body);">Ketua RW {{ str_pad($rw->nomor,2,'0',STR_PAD_LEFT) }}</small>
                                </div>
                                <span class="badge rounded-pill bg-success text-white" style="font-family:var(--font-body);">
                                    {{ $rtDalamRw->count() }} RT
                                </span>
                            </div>

                            {{-- Daftar RT --}}
                            @if($rtDalamRw->isNotEmpty())
                            <div class="p-3">
                                <small class="text-muted fw-bold text-uppercase d-block mb-2 ps-1"
                                       style="font-size:11px;letter-spacing:0.5px;font-family:var(--font-body);">
                                    Ketua RT di Wilayah Ini
                                </small>
                                <div class="row g-2">
                                    @foreach($rtDalamRw as $rt)
                                    <div class="col-12">
                                        <div class="d-flex align-items-center gap-3 p-3 rounded-3 card-hover"
                                             style="background:rgba(26,92,56,0.03);border:1px solid rgba(26,92,56,0.08);">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                                 style="width:38px;height:38px;background:rgba(26,92,56,0.08);color:var(--color-forest);overflow:hidden;">
                                                @if($rt->foto)
                                                    <img src="{{ asset('storage/'.$rt->foto) }}" alt="{{ $rt->nama }}" style="width:100%;height:100%;object-fit:cover;">
                                                @else
                                                    <i data-lucide="user" class="icon-xs"></i>
                                                @endif
                                            </div>
                                            <div class="flex-grow-1 min-w-0">
                                                <h6 class="fw-bold text-dark small text-truncate mb-0" style="font-family:var(--font-heading);">{{ $rt->nama }}</h6>
                                                <small class="text-muted" style="font-family:var(--font-body);">{{ $rt->dusun }}</small>
                                            </div>
                                            <span class="badge rounded-pill fw-bold px-2 flex-shrink-0"
                                                  style="background:rgba(26,92,56,0.1);color:var(--color-forest);font-family:var(--font-body);">
                                                RT {{ str_pad($rt->nomor,2,'0',STR_PAD_LEFT) }}
                                            </span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @else
                            <div class="p-4 text-center text-muted small" style="font-family:var(--font-body);">
                                Belum ada RT terdaftar di RW ini.
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
        @endforeach
    </div>

</div>
@endsection
