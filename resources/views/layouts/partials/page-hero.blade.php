<div class="section-hero-gradient d-flex align-items-center position-relative overflow-hidden mb-5" style="min-height: 280px;">
    <!-- Background Slideshow -->
    <div class="hero-slideshow">
        <div class="hero-slide active" style="background-image: url('{{ asset('images/GapuraDesa.jpg') }}');"></div>
        <div class="hero-slide" style="background-image: url('{{ asset('images/Taman-Wisata-Selorejo.webp') }}');"></div>
        <div class="hero-slide" style="background-image: url('{{ asset('images/JerukSelorejo.jpg') }}');"></div>
    </div>
    
    <!-- Gradient Overlay -->
    <div class="hero-overlay"></div>

    <div class="container position-relative z-1 text-center text-white py-5">
        <h1 class="display-5 fw-bold mb-3 text-white">
            @if(isset($icon)) <i data-lucide="{{ $icon }}" class="me-3 text-warning"></i> @endif
            {{ $title }}
        </h1>
        <p class="lead fw-medium text-white mb-0" style="opacity: 1;">{{ $subtitle ?? '' }}</p>
    </div>
</div>
