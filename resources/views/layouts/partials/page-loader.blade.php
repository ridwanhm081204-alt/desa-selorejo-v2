<style>
    /* ── PAGE LOADING OVERLAY ── */
    #page-loader {
        position: fixed;
        inset: 0;
        z-index: 99999;
        background: linear-gradient(135deg, #f0f7f4 0%, #e8f5e9 50%, #f0f7f4 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0;
        transition: opacity 0.4s ease, visibility 0.4s ease;
    }
    #page-loader.loader-hidden {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }

    /* Spinning ring container */
    .loader-ring-wrap {
        position: relative;
        width: 120px;
        height: 120px;
        margin-bottom: 28px;
    }
    /* SVG spinner ring */
    .loader-ring-svg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        animation: loader-spin 1.6s linear infinite;
    }
    .loader-ring-svg circle {
        fill: none;
        stroke: url(#loaderGrad);
        stroke-width: 3.5;
        stroke-linecap: round;
        stroke-dasharray: 220;
        stroke-dashoffset: 60;
    }
    @keyframes loader-spin {
        to { transform: rotate(360deg); }
    }
    /* Second slower ring going opposite */
    .loader-ring-svg2 {
        position: absolute;
        inset: 6px;
        width: calc(100% - 12px);
        height: calc(100% - 12px);
        animation: loader-spin-rev 2.4s linear infinite;
        opacity: 0.35;
    }
    .loader-ring-svg2 circle {
        fill: none;
        stroke: #1a5c38;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-dasharray: 180;
        stroke-dashoffset: 80;
    }
    @keyframes loader-spin-rev {
        to { transform: rotate(-360deg); }
    }

    /* Logo inside ring */
    .loader-logo-wrap {
        position: absolute;
        inset: 10px;
        border-radius: 50%;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 20px rgba(26,92,56,0.12);
        overflow: hidden;
    }
    .loader-logo {
        width: 80%;
        height: 80%;
        object-fit: contain;
    }

    /* Text area */
    .loader-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1a5c38;
        letter-spacing: 0.3px;
        font-family: sans-serif;
        margin-bottom: 4px;
    }
    .loader-subtitle {
        font-size: 0.78rem;
        color: #666;
        letter-spacing: 0.5px;
        font-family: sans-serif;
        margin-bottom: 22px;
    }
    /* Animated dots */
    .loader-dots {
        display: flex;
        gap: 7px;
        align-items: center;
    }
    .loader-dots span {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #1a5c38;
        animation: loader-bounce 1.2s ease-in-out infinite;
    }
    .loader-dots span:nth-child(1) { animation-delay: 0s;    background: #1a5c38; }
    .loader-dots span:nth-child(2) { animation-delay: 0.18s;  background: #2e7d32; }
    .loader-dots span:nth-child(3) { animation-delay: 0.36s;  background: #4CAF50; }
    @keyframes loader-bounce {
        0%, 80%, 100% { transform: scale(0.7); opacity: 0.5; }
        40%            { transform: scale(1.2); opacity: 1;   }
    }
</style>

{{-- ── PAGE LOADING OVERLAY ── --}}
<div id="page-loader" role="status" aria-label="Mohon tunggu sebentar">

    {{-- Spinning ring + logo --}}
    <div class="loader-ring-wrap">
        {{-- Ring 2 (inner, reverse) --}}
        <svg class="loader-ring-svg2" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <circle cx="50" cy="50" r="46"/>
        </svg>
        {{-- Ring 1 (outer, gradient) --}}
        <svg class="loader-ring-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="loaderGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%"   stop-color="#1a5c38"/>
                    <stop offset="50%"  stop-color="#4CAF50"/>
                    <stop offset="100%" stop-color="#f5c518"/>
                </linearGradient>
            </defs>
            <circle cx="50" cy="50" r="46"/>
        </svg>
        {{-- Logo inside --}}
        <div class="loader-logo-wrap">
            <img src="{{ asset('images/logo_desa.png') }}" alt="Logo Desa Selorejo" class="loader-logo">
        </div>
    </div>

    {{-- Text --}}
    <div class="loader-title">Mohon Tunggu Sebentar</div>
    <div class="loader-subtitle">Desa Wisata Selorejo &mdash; Kec. Dau, Kab. Malang</div>

    {{-- Bouncing dots --}}
    <div class="loader-dots">
        <span></span>
        <span></span>
        <span></span>
    </div>

</div>

<script>
(function () {
    var loader   = document.getElementById('page-loader');
    if (!loader) return;
    var MIN_MS   = 800;   // minimum display time (ms)
    var startAt  = Date.now();

    function hideLoader() {
        var elapsed = Date.now() - startAt;
        var delay   = Math.max(0, MIN_MS - elapsed);
        setTimeout(function () {
            if (loader) loader.classList.add('loader-hidden');
        }, delay);
    }

    // Hide when page fully loaded
    if (document.readyState === 'complete') {
        hideLoader();
    } else {
        window.addEventListener('load', hideLoader);
    }

    // Show loader on every navigation click (internal links)
    document.addEventListener('click', function (e) {
        var anchor = e.target.closest('a');
        if (!anchor) return;
        var href = anchor.getAttribute('href');
        if (!href) return;
        // Skip: external, hash-only, javascript:, target=_blank, download
        if (anchor.target === '_blank') return;
        if (anchor.hasAttribute('download')) return;
        if (href.startsWith('#')) return;
        if (href.startsWith('javascript')) return;
        if (href.startsWith('mailto') || href.startsWith('tel')) return;
        // Only intercept same-origin links
        try {
            var url = new URL(href, window.location.href);
            if (url.origin !== window.location.origin) return;
        } catch (err) { return; }

        // Show loader
        if (loader) {
            loader.classList.remove('loader-hidden');
            startAt = Date.now();
        }
    });

    // Show loader on form submit (page navigations)
    document.addEventListener('submit', function (e) {
        var form = e.target;
        if (form.method && form.method.toLowerCase() === 'get') {
            if (loader) {
                loader.classList.remove('loader-hidden');
                startAt = Date.now();
            }
        }
    });
})();
</script>
