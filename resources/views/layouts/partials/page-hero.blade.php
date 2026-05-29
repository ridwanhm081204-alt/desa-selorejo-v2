<div class="page-hero d-flex align-items-center position-relative overflow-hidden mb-5" style="min-height: 240px; background: linear-gradient(135deg, var(--color-forest) 0%, var(--primary-dark) 100%);">

    <div class="container position-relative z-1 text-center text-white py-5">
        <h1 class="page-hero-title mb-2" style="font-family: var(--font-display); font-size: var(--text-4xl); letter-spacing: 0.04em; color: #fff;">
            @if(isset($icon)) <i data-lucide="{{ $icon }}" class="me-2" style="color: var(--accent); vertical-align: middle; width: 36px; height: 36px;"></i> @endif
            {{ $title }}
        </h1>
        <p class="lead mb-0 text-white-50" style="font-family: var(--font-body); font-size: var(--text-sm); font-weight: 500;">{{ $subtitle ?? '' }}</p>
    </div>
</div>
