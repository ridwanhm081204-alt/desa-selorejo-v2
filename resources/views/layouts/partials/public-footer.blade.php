<footer class="mt-5" style="background-color: #1b4332; color: #fff;">
    <div class="container py-5">
        <div class="row g-4">
            <!-- Kolom 1 -->
            <div class="col-md-3">
                <div class="d-flex align-items-center mb-3">
                    <i data-lucide="leaf" class="me-2"></i>
                    <h5 class="mb-0">{{\App\Models\Setting::get('nama_desa', 'Desa Selorejo')}}</h5>
                </div>
                <p class="small text-white-50"><i data-lucide="map-pin" style="width:14px;"></i> {{\App\Models\Setting::get('alamat', '')}}</p>
                <p class="small text-white-50"><i data-lucide="phone" style="width:14px;"></i> {{\App\Models\Setting::get('telepon_desa', '')}}</p>
                <p class="small text-white-50"><i data-lucide="mail" style="width:14px;"></i> {{\App\Models\Setting::get('email_desa', '')}}</p>
                <p class="small text-white-50"><i data-lucide="message-circle" style="width:14px;"></i> WhatsApp: {{\App\Models\Setting::get('whatsapp', '')}}</p>
            </div>
            
            <!-- Kolom 2 -->
            <div class="col-md-3">
                <h5 class="mb-3">Tautan Penting</h5>
                <ul class="list-unstyled small">
                    @foreach(\App\Models\TautanTerkait::all() as $tautan)
                    <li class="mb-2"><a href="{{ $tautan->url }}" class="text-white-50 text-decoration-none hover-text-white" target="_blank">{{ $tautan->nama }}</a></li>
                    @endforeach
                    @if(\App\Models\TautanTerkait::count() == 0)
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Pemerintah Kabupaten Malang</a></li>
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Kementerian Desa</a></li>
                    @endif
                </ul>
            </div>
            
            <!-- Kolom 3 -->
            <div class="col-md-3">
                <h5 class="mb-3">Lokasi Kami</h5>
                <div class="rounded overflow-hidden">
                    @php $profile = \App\Models\Profile::first(); @endphp
                    @if($profile && $profile->peta_embed)
                        {!! str_replace('width="100%"', 'width="100%" height="150"', $profile->peta_embed) !!}
                    @else
                        <div class="bg-secondary d-flex align-items-center justify-content-center text-white" style="height: 150px;">
                            Peta Belum Tersedia
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Kolom 4 -->
            <div class="col-md-3">
                <h5 class="mb-3">Tentang Website</h5>
                <p class="small text-white-50">Website resmi {{\App\Models\Setting::get('nama_desa', 'Desa Selorejo')}} dikelola oleh Pemerintah Desa untuk mewujudkan transparansi publik dan mempromosikan potensi agrowisata petik jeruk ke khalayak luas secara digital.</p>
            </div>
        </div>
    </div>
    
    <div class="py-3 text-center" style="background-color: #081c15;">
        <small class="text-white-50">Copyright &copy; {{ date('Y') }} Pemerintah {{\App\Models\Setting::get('nama_desa', 'Desa Selorejo')}}. All Rights Reserved.</small>
    </div>
</footer>
