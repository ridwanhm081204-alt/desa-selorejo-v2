<footer class="mt-5" style="background-color: #1b4332; color: #fff;">
    <div class="container py-5">
        <div class="row g-4">
            <!-- Kolom 1 -->
            <div class="col-md-3">
                <div class="d-flex align-items-center mb-3">
                    <i data-lucide="leaf" class="me-2"></i>
                    <h5 class="mb-0">{{\App\Models\Setting::get('nama_desa', 'Desa Selorejo')}}</h5>
                </div>
                <p class="small text-white d-flex align-items-start gap-2">
                    <i data-lucide="map-pin" class="mt-1" style="width:16px; min-width:16px;"></i> 
                    <span>{{\App\Models\Setting::get('alamat', '')}}</span>
                </p>
                <p class="small text-white mb-2">
                    <a href="tel:{{\App\Models\Setting::get('telepon', '')}}" class="text-white text-decoration-none hover-accent d-flex align-items-center gap-2">
                        <i data-lucide="phone" style="width:16px;"></i> {{\App\Models\Setting::get('telepon', '')}}
                    </a>
                </p>
                <p class="small text-white mb-2">
                    <a href="mailto:{{\App\Models\Setting::get('email', '')}}" class="text-white text-decoration-none hover-accent d-flex align-items-center gap-2">
                        <i data-lucide="mail" style="width:16px;"></i> {{\App\Models\Setting::get('email', '')}}
                    </a>
                </p>
                <p class="small text-white mb-2">
                    <a href="https://wa.me/{{\App\Models\Setting::get('whatsapp', '')}}" target="_blank" class="text-white text-decoration-none hover-accent d-flex align-items-center gap-2">
                        <i data-lucide="message-circle" style="width:16px;"></i> WhatsApp: {{\App\Models\Setting::get('whatsapp', '')}}
                    </a>
                </p>
            </div>
            
            <!-- Kolom 2 -->
            <div class="col-md-3">
                <h5 class="mb-3 border-bottom pb-2 d-flex align-items-center gap-2">
                    <i data-lucide="link" style="width:18px;"></i> Tautan Penting
                </h5>
                <ul class="list-unstyled small">
                    @foreach(\App\Models\TautanTerkait::all() as $tautan)
                    <li class="mb-2">
                        <a href="{{ $tautan->url }}" class="text-white text-decoration-none hover-accent d-flex align-items-center gap-2" target="_blank">
                            <i data-lucide="chevron-right" style="width:14px;"></i> {{ $tautan->nama }}
                        </a>
                    </li>
                    @endforeach
                    @if(\App\Models\TautanTerkait::count() == 0)
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none hover-accent d-flex align-items-center gap-2"><i data-lucide="chevron-right" style="width:14px;"></i> Pemerintah Kabupaten Malang</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none hover-accent d-flex align-items-center gap-2"><i data-lucide="chevron-right" style="width:14px;"></i> Kementerian Desa PDTT</a></li>
                    @endif
                </ul>
            </div>
            
            <!-- Kolom 3 -->
            <div class="col-md-3">
                <h5 class="mb-3 border-bottom pb-2 d-flex align-items-center gap-2">
                    <i data-lucide="map" style="width:18px;"></i> Lokasi Kami
                </h5>
                <div class="rounded overflow-hidden shadow-sm border border-white border-opacity-10">
                    @php $profile = \App\Models\Profile::first(); @endphp
                    @if($profile && $profile->peta_embed)
                        {!! str_replace('height="400"', 'height="200"', $profile->peta_embed) !!}
                    @else
                        <div class="bg-secondary d-flex align-items-center justify-content-center text-white" style="height: 200px;">
                            Peta Belum Tersedia
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Kolom 4 -->
            <div class="col-md-3">
                <h5 class="mb-3 border-bottom pb-2 d-flex align-items-center gap-2">
                    <i data-lucide="info" style="width:18px;"></i> Tentang Website
                </h5>
                <p class="small text-white" style="line-height: 1.6; opacity: 0.9;">Website resmi {{\App\Models\Setting::get('nama_desa', 'Desa Selorejo')}} dikelola oleh Pemerintah Desa untuk mewujudkan transparansi publik dan mempromosikan potensi agrowisata petik jeruk ke khalayak luas secara digital.</p>
            </div>
        </div>
    </div>
    
    <div class="py-3 text-center" style="background-color: #081c15; border-top: 1px solid rgba(255,255,255,0.1);">
        <small class="text-white">Copyright &copy; {{ date('Y') }} Pemerintah {{\App\Models\Setting::get('nama_desa', 'Desa Selorejo')}}. All Rights Reserved.</small>
    </div>
</footer>
