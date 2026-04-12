<style>
    .lightbox-overlay {
        background: rgba(0,0,0,0.92) !important;
        backdrop-filter: blur(8px);
    }
    .lightbox-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        padding: 40px;
    }
    .lightbox-btns-container {
        position: absolute;
        right: -65px;
        top: 0;
        display: flex;
        flex-direction: column;
        gap: 12px;
        z-index: 2147483647;
    }
    .lightbox-content {
        max-width: 80%;
        max-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: visible;
    }
    .btn-lightbox {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 32px rgba(0,0,0,0.4);
    }
    .btn-lightbox:hover {
        background: var(--primary);
        color: white;
        transform: scale(1.1);
    }
    .btn-lightbox-close {
        background: rgba(230, 57, 70, 0.4) !important;
        border-color: rgba(230, 57, 70, 0.5) !important;
    }
    .btn-lightbox-close:hover {
        background: #e63946 !important;
        border-color: #ff4d6d !important;
        transform: scale(1.1);
    }

    @media (max-width: 1400px) {
        .lightbox-btns-container {
            right: -55px;
        }
    }

    @media (max-width: 1100px) {
        .lightbox-btns-container {
            position: fixed;
            bottom: 30px;
            right: 0;
            top: auto;
            width: 100%;
            flex-direction: row;
            justify-content: center;
            transform: none;
            padding: 10px;
        }
        .btn-lightbox {
            background: rgba(0, 0, 0, 0.5);
            border-color: rgba(255, 255, 255, 0.2);
        }
        .btn-lightbox-close {
            background: rgba(230, 57, 70, 0.6) !important;
        }
    }
</style>

<div id="lightboxOverlay" class="lightbox-overlay" style="display: none; z-index: 2147483646;">
    <div class="lightbox-wrapper">
        <button class="lightbox-nav lightbox-prev" onclick="changeSlide(-1)">&#10094;</button>
        
        <div class="lightbox-content">
            <div class="lightbox-btns-container">
                <button class="btn-lightbox" onclick="zoomIn()" title="Perbesar"><i data-lucide="zoom-in"></i></button>
                <button class="btn-lightbox" onclick="zoomOut()" title="Perkecil"><i data-lucide="zoom-out"></i></button>
                <button class="btn-lightbox btn-lightbox-close" onclick="closeLightbox()" title="Tutup"><i data-lucide="x"></i></button>
            </div>
            
            <img id="lightboxImg" src="" alt="" style="transition: transform 0.3s ease-out; box-shadow: 0 10px 50px rgba(0,0,0,0.5); border-radius: 12px;">
        </div>

        <button class="lightbox-nav lightbox-next" onclick="changeSlide(1)">&#10095;</button>
    </div>

    <div class="lightbox-footer text-center">
        <h4 id="lightboxCaption" class="fw-bold text-white mb-1"></h4>
        <div class="text-white-50 small">
            <span id="lightboxCategory" class="badge bg-success me-2"></span>
            <span id="lightboxDate"></span>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let currentScale = 1;
    let currentGalleryIndex = 0;
    let galleryItems = [];

    function initGalleryData() {
        galleryItems = [];
        // Extract all elements with .lightbox-trigger class
        document.querySelectorAll('.lightbox-trigger').forEach((el, index) => {
            galleryItems.push({
                src: el.getAttribute('data-src'),
                caption: el.getAttribute('data-caption'),
                category: el.getAttribute('data-category'),
                date: el.getAttribute('data-date')
            });
        });
    }

    // Assign click listener to all triggers
    document.addEventListener('click', function(e) {
        const trigger = e.target.closest('.lightbox-trigger');
        if (trigger) {
            initGalleryData(); // Always refresh to handle current filtered DOM
            currentScale = 1;
            const src = trigger.getAttribute('data-src');
            currentGalleryIndex = galleryItems.findIndex(item => item.src === src);
            
            if (currentGalleryIndex !== -1) {
                updateLightboxContent();
                const overlay = document.getElementById('lightboxOverlay');
                overlay.style.display = 'flex';
                overlay.style.opacity = '1';
                document.body.style.overflow = 'hidden';
            }
        }
    });

    function updateLightboxContent() {
        if (galleryItems.length === 0) return;
        const item = galleryItems[currentGalleryIndex];
        const img = document.getElementById('lightboxImg');
        img.src = item.src;
        img.onload = () => { img.style.opacity = '1'; };
        img.style.transform = `scale(${currentScale})`;
        
        document.getElementById('lightboxCaption').innerText = item.caption;
        document.getElementById('lightboxCategory').innerText = item.category;
        document.getElementById('lightboxDate').innerText = item.date;
        
        // Refresh icons using any available lucide global
        const lucideLib = window.lucide || (typeof lucide !== 'undefined' ? lucide : null);
        if (lucideLib && lucideLib.createIcons) {
            lucideLib.createIcons();
        }
    }

    function closeLightbox() {
        document.getElementById('lightboxOverlay').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    function changeSlide(direction) {
        currentScale = 1; // Reset zoom
        currentGalleryIndex = (currentGalleryIndex + direction + galleryItems.length) % galleryItems.length;
        updateLightboxContent();
    }

    function zoomIn() {
        if (currentScale < 3) {
            currentScale += 0.25;
            document.getElementById('lightboxImg').style.transform = `scale(${currentScale})`;
        }
    }

    function zoomOut() {
        if (currentScale > 0.5) {
            currentScale -= 0.25;
            document.getElementById('lightboxImg').style.transform = `scale(${currentScale})`;
        }
    }

    // Keyboard support
    document.addEventListener('keydown', (e) => {
        const overlay = document.getElementById('lightboxOverlay');
        if (overlay && overlay.style.display === 'flex') {
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowRight') changeSlide(1);
            if (e.key === 'ArrowLeft') changeSlide(-1);
        }
    });
</script>
@endpush
