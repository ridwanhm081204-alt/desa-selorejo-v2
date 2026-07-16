<footer class="mt-5" style="background: var(--color-forest); color: #fff; padding: 48px 0 0 0;">
    <div class="container py-5">
        <div class="row g-4">
            <!-- Kolom 1 -->
            <div class="col-md-3">
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ asset('images/logo_desa.png') }}?v={{ file_exists(public_path('images/logo_desa.png')) ? filemtime(public_path('images/logo_desa.png')) : '1' }}" alt="Logo Selorejo" class="me-3 shadow-sm" style="background: var(--color-white); border-radius: var(--radius-sm); padding: 5px; width: 45px; height: 45px; object-fit: contain;">
                    <div>
                        <strong class="d-block text-white" style="font-family: var(--font-display); font-size: 1.1rem; letter-spacing: 0.04em; color: var(--accent);">Pemerintah Desa Selorejo</strong>
                        <small class="d-block" style="font-family: var(--font-body); font-size: var(--text-xs); color: rgba(255,255,255,0.85);">Kec. Dau, Kab. Malang, Prov. Jawa Timur</small>
                    </div>
                </div>
                <p style="font-family: var(--font-body); font-size: var(--text-sm); color: rgba(255,255,255,0.85); line-height: 1.8;" class="d-flex align-items-start gap-2 mt-2">
                    <i data-lucide="map-pin" class="mt-1" style="width:16px; min-width:16px;"></i> 
                    <a href="https://maps.app.goo.gl/wP2HTRTZ219oB9TM8" target="_blank" class="footer-link">{{\App\Models\Setting::get('alamat', '')}}</a>
                </p>
                <p style="font-family: var(--font-body); font-size: var(--text-sm); color: rgba(255,255,255,0.85); line-height: 1.8;" class="mb-2">
                    <a href="tel:{{\App\Models\Setting::get('telepon', '')}}" class="footer-link d-flex align-items-center gap-2">
                        <i data-lucide="phone" style="width:16px;"></i> {{\App\Models\Setting::get('telepon', '')}}
                    </a>
                </p>
                <p style="font-family: var(--font-body); font-size: var(--text-sm); color: rgba(255,255,255,0.85); line-height: 1.8;" class="mb-2">
                    <a href="mailto:{{\App\Models\Setting::get('email', '')}}" class="footer-link d-flex align-items-center gap-2">
                        <i data-lucide="mail" style="width:16px;"></i> {{\App\Models\Setting::get('email', '')}}
                    </a>
                </p>
                <p style="font-family: var(--font-body); font-size: var(--text-sm); color: rgba(255,255,255,0.85); line-height: 1.8;" class="mb-2">
                    @php
                        $waNum = preg_replace('/[^0-9]/', '', \App\Models\Setting::get('whatsapp', ''));
                        if (str_starts_with($waNum, '0')) {
                            $waNum = '62' . substr($waNum, 1);
                        }
                    @endphp
                    <a href="https://wa.me/{{ $waNum }}" target="_blank" class="footer-link d-flex align-items-center gap-2">
                        <i data-lucide="message-circle" style="width:16px;"></i> WhatsApp: {{\App\Models\Setting::get('whatsapp', '')}}
                    </a>
                </p>
                <div class="mt-4">
                    <a href="{{\App\Models\Setting::get('facebook', '#')}}" target="_blank" class="footer-social-icon">
                        <i data-lucide="facebook" style="width:16px;"></i>
                    </a>
                    <a href="{{\App\Models\Setting::get('instagram', '#')}}" target="_blank" class="footer-social-icon">
                        <i data-lucide="instagram" style="width:16px;"></i>
                    </a>
                    <a href="{{\App\Models\Setting::get('youtube', '#')}}" target="_blank" class="footer-social-icon">
                        <i data-lucide="youtube" style="width:16px;"></i>
                    </a>
                </div>
            </div>
            
            <!-- Kolom 2 -->
            <div class="col-md-3">
                <h5 class="mb-3 d-flex align-items-center gap-2" style="font-family: var(--font-display); font-size: 1.1rem; letter-spacing: 0.05em; color: var(--accent); margin-bottom: 16px; padding-bottom: 8px; border-bottom: 2px solid rgba(245,197,24,0.3);">
                    <i data-lucide="link" style="width:18px;"></i> Tautan Penting
                </h5>
                <ul class="list-unstyled small">
                    @foreach(\App\Models\TautanTerkait::all() as $tautan)
                    <li class="mb-2">
                        <a href="{{ $tautan->url }}" class="footer-link d-flex align-items-center gap-2" target="_blank">
                            <i data-lucide="chevron-right" style="width:14px;"></i> {{ $tautan->nama }}
                        </a>
                    </li>
                    @endforeach
                    @if(\App\Models\TautanTerkait::count() == 0)
                    <li class="mb-2"><a href="#" class="footer-link d-flex align-items-center gap-2"><i data-lucide="chevron-right" style="width:14px;"></i> Pemerintah Kabupaten Malang</a></li>
                    <li class="mb-2"><a href="#" class="footer-link d-flex align-items-center gap-2"><i data-lucide="chevron-right" style="width:14px;"></i> Kementerian Desa PDTT</a></li>
                    @endif
                </ul>
            </div>
            
            <!-- Kolom 3 -->
            <div class="col-md-3">
                <h5 class="mb-3 d-flex align-items-center gap-2" style="font-family: var(--font-display); font-size: 1.1rem; letter-spacing: 0.05em; color: var(--accent); margin-bottom: 16px; padding-bottom: 8px; border-bottom: 2px solid rgba(245,197,24,0.3);">
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
                <h5 class="mb-3 d-flex align-items-center gap-2" style="font-family: var(--font-display); font-size: 1.1rem; letter-spacing: 0.05em; color: var(--accent); margin-bottom: 16px; padding-bottom: 8px; border-bottom: 2px solid rgba(245,197,24,0.3);">
                    <i data-lucide="info" style="width:18px;"></i> Tentang Website
                </h5>
                <p style="font-family: var(--font-body); font-size: var(--text-sm); color: rgba(255,255,255,0.85); line-height: 1.8;" class="mb-3">Website resmi {{\App\Models\Setting::get('nama_desa', 'Desa Selorejo')}} dikelola oleh Pemerintah Desa untuk mewujudkan transparansi publik dan mempromosikan potensi agrowisata petik jeruk ke khalayak luas secara digital.</p>
                
                <div class="mt-4">
                    <a href="{{ url('/login') }}" class="btn btn-outline-light btn-sm rounded-pill d-inline-flex align-items-center hover-accent">
                        <i data-lucide="log-in" class="me-2" style="width:14px;"></i> Portal Admin
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="py-3 text-center" style="background: var(--primary-dark); padding: 12px 0; margin-top: 40px; border-top: 1px solid rgba(255,255,255,0.1);">
        <small style="font-family: var(--font-body); font-size: var(--text-xs); color: rgba(255,255,255,0.6); text-align: center;">Hak Cipta &copy; {{ date('Y') }} Pemerintah {{\App\Models\Setting::get('nama_desa', 'Desa Selorejo')}}, Kecamatan Dau, Kabupaten Malang</small>
    </div>
</footer>
