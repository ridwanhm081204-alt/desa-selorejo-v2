<style>
    .lightbox-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.92) !important;
        backdrop-filter: blur(8px);
        align-items: center;
        justify-content: center;
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

    /* Nav Prev / Next */
    .lightbox-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255,255,255,0.12);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.25);
        color: white;
        width: 52px;
        height: 52px;
        border-radius: 50%;
        font-size: 20px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.25s ease;
        z-index: 10;
        flex-shrink: 0;
    }
    .lightbox-nav:hover {
        background: rgba(255,255,255,0.25);
        transform: translateY(-50%) scale(1.1);
    }
    .lightbox-prev { left: 12px; }
    .lightbox-next { right: 12px; }

    /* Footer caption */
    .lightbox-footer {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        width: 90%;
        max-width: 600px;
        text-align: center;
        z-index: 2147483647;
    }

    /* Video Modal */
    .video-modal-overlay {
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.92);
        backdrop-filter: blur(8px);
        z-index: 2147483646;
        display: none;
        align-items: center;
        justify-content: center;
    }
    .video-modal-inner {
        position: relative;
        width: 90%;
        max-width: 900px;
    }
    .video-modal-inner iframe {
        width: 100%;
        aspect-ratio: 16/9;
        border-radius: 12px;
        border: none;
        box-shadow: 0 10px 50px rgba(0,0,0,0.5);
    }
    .video-modal-close {
        position: absolute;
        top: -50px;
        right: 0;
        background: rgba(230, 57, 70, 0.5);
        border: 1px solid rgba(230,57,70,0.6);
        color: white;
        width: 42px;
        height: 42px;
        border-radius: 10px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        transition: all 0.25s ease;
    }
    .video-modal-close:hover {
        background: #e63946;
        transform: scale(1.1);
    }
    .video-modal-caption {
        color: white;
        text-align: center;
        margin-top: 16px;
        font-size: 15px;
        opacity: 0.85;
    }

    @media (max-width: 1400px) {
        .lightbox-btns-container {
            right: -55px;
        }
    }

    @media (max-width: 1100px) {
        .lightbox-btns-container {
            position: fixed;
            bottom: 20px;
            right: 0;
            top: auto;
            width: 100%;
            flex-direction: row;
            justify-content: center;
            transform: none;
            padding: 10px;
            gap: 15px;
        }
        .btn-lightbox {
            width: 44px;
            height: 44px;
            background: rgba(0, 0, 0, 0.7);
            border-color: rgba(255, 255, 255, 0.3);
        }
        .btn-lightbox i {
            width: 18px;
            height: 18px;
        }
        .btn-lightbox-close {
            background: rgba(230, 57, 70, 0.8) !important;
        }
    }

    @media (max-width: 576px) {
        .lightbox-wrapper {
            padding: 15px;
        }
        .lightbox-content {
            max-width: 95%;
            max-height: 60vh;
        }
        .lightbox-footer {
            bottom: 85px;
        }
        .lightbox-nav {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }
    }
</style>

{{-- ===== FOTO LIGHTBOX OVERLAY ===== --}}
<div id="lightboxOverlay" class="lightbox-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 2147483646;">
    <div class="lightbox-wrapper">
        <button class="lightbox-nav lightbox-prev" onclick="changeSlide(-1)">&#10094;</button>
        
        <div class="lightbox-content">
            <div class="lightbox-btns-container">
                <button class="btn-lightbox" onclick="zoomIn()" title="Perbesar"><i data-lucide="zoom-in"></i></button>
                <button class="btn-lightbox" onclick="zoomOut()" title="Perkecil"><i data-lucide="zoom-out"></i></button>
                <button class="btn-lightbox btn-lightbox-close" onclick="closeLightbox()" title="Tutup"><i data-lucide="x"></i></button>
            </div>
            
            <img id="lightboxImg" src="" alt="" style="max-width:100%; max-height:70vh; transition: transform 0.3s ease-out; box-shadow: 0 10px 50px rgba(0,0,0,0.5); border-radius: 12px;">
        </div>

        <button class="lightbox-nav lightbox-next" onclick="changeSlide(1)">&#10095;</button>
    </div>

    <div class="lightbox-footer">
        <h4 id="lightboxCaption" class="fw-bold text-white mb-1" style="font-size:16px;"></h4>
        <div class="text-white-50 small">
            <span id="lightboxCategory" class="badge bg-success me-2"></span>
            <span id="lightboxDate"></span>
        </div>
    </div>
</div>

{{-- ===== VIDEO MODAL OVERLAY ===== --}}
<div id="videoModalOverlay" class="video-modal-overlay" style="display:none;">
    <div class="video-modal-inner">
        <button class="video-modal-close" onclick="closeVideoModal()" title="Tutup">&#x2715;</button>
        <iframe id="videoModalIframe" src="" allowfullscreen allow="autoplay; encrypted-media"></iframe>
        <div class="video-modal-caption">
            <strong id="videoModalCaption" class="text-white"></strong>
        </div>
    </div>
</div>

<script>
    let currentScale = 1;
    let currentGalleryIndex = 0;
    let galleryItems = [];

    function initGalleryData() {
        galleryItems = [];
        document.querySelectorAll('.lightbox-trigger').forEach((el) => {
            galleryItems.push({
                src: el.getAttribute('data-src'),
                caption: el.getAttribute('data-caption'),
                category: el.getAttribute('data-category'),
                date: el.getAttribute('data-date')
            });
        });
    }

    // Foto lightbox click
    document.addEventListener('click', function(e) {
        const trigger = e.target.closest('.lightbox-trigger');
        if (trigger) {
            e.preventDefault();
            initGalleryData();
            currentScale = 1;
            const src = trigger.getAttribute('data-src');
            currentGalleryIndex = galleryItems.findIndex(item => item.src === src);
            if (currentGalleryIndex !== -1) {
                updateLightboxContent();
                const overlay = document.getElementById('lightboxOverlay');
                if (overlay) {
                    overlay.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                }
            }
        }
    });

    // Video modal click
    document.addEventListener('click', function(e) {
        const trigger = e.target.closest('.video-trigger');
        if (trigger) {
            e.preventDefault();
            const url = trigger.getAttribute('data-video-url');
            const caption = trigger.getAttribute('data-caption') || '';
            const embedUrl = getYouTubeEmbedUrl(url);
            const iframe = document.getElementById('videoModalIframe');

            if (embedUrl) {
                if (iframe) iframe.src = embedUrl + '?autoplay=1';
            } else {
                window.open(url, '_blank');
                return;
            }

            const captionEl = document.getElementById('videoModalCaption');
            if (captionEl) captionEl.innerText = caption;
            
            const modal = document.getElementById('videoModalOverlay');
            if (modal) {
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }
        }
    });

    function getYouTubeEmbedUrl(url) {
        if (!url) return null;
        const match = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i);
        if (match && match[1]) {
            return 'https://www.youtube.com/embed/' + match[1];
        }
        return null;
    }

    function closeVideoModal() {
        const modal = document.getElementById('videoModalOverlay');
        if (modal) modal.style.display = 'none';
        const iframe = document.getElementById('videoModalIframe');
        if (iframe) iframe.src = '';
        document.body.style.overflow = 'auto';
    }

    const videoOverlay = document.getElementById('videoModalOverlay');
    if (videoOverlay) {
        videoOverlay.addEventListener('click', function(e) {
            if (e.target === this) closeVideoModal();
        });
    }

    function updateLightboxContent() {
        if (galleryItems.length === 0) return;
        const item = galleryItems[currentGalleryIndex];
        const img = document.getElementById('lightboxImg');
        if (img) {
            img.style.opacity = '0';
            img.src = item.src;
            img.onload = () => { img.style.opacity = '1'; };
            img.style.transform = `scale(${currentScale})`;
        }
        
        const captionEl = document.getElementById('lightboxCaption');
        if (captionEl) captionEl.innerText = item.caption || '';
        
        const catEl = document.getElementById('lightboxCategory');
        if (catEl) catEl.innerText = item.category || '';
        
        const dateEl = document.getElementById('lightboxDate');
        if (dateEl) dateEl.innerText = item.date || '';
        
        const lucideLib = window.lucide || (typeof lucide !== 'undefined' ? lucide : null);
        if (lucideLib && lucideLib.createIcons) {
            try {
                lucideLib.createIcons();
            } catch (err) {
                // Caught safely: Vite-bundled Lucide might expect an 'icons' object, but it is harmless here
                console.warn('Lucide icon refreshing bypassed:', err.message);
            }
        }
    }

    function closeLightbox() {
        const overlay = document.getElementById('lightboxOverlay');
        if (overlay) overlay.style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    const lightboxOverlayEl = document.getElementById('lightboxOverlay');
    if (lightboxOverlayEl) {
        lightboxOverlayEl.addEventListener('click', function(e) {
            if (e.target === this) closeLightbox();
        });
    }

    function changeSlide(direction) {
        currentScale = 1;
        currentGalleryIndex = (currentGalleryIndex + direction + galleryItems.length) % galleryItems.length;
        updateLightboxContent();
    }

    function zoomIn() {
        if (currentScale < 3) {
            currentScale += 0.25;
            const img = document.getElementById('lightboxImg');
            if (img) img.style.transform = `scale(${currentScale})`;
        }
    }

    function zoomOut() {
        if (currentScale > 0.5) {
            currentScale -= 0.25;
            const img = document.getElementById('lightboxImg');
            if (img) img.style.transform = `scale(${currentScale})`;
        }
    }

    document.addEventListener('keydown', (e) => {
        const lightbox = document.getElementById('lightboxOverlay');
        const videoModal = document.getElementById('videoModalOverlay');
        if (lightbox && lightbox.style.display === 'flex') {
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowRight') changeSlide(1);
            if (e.key === 'ArrowLeft') changeSlide(-1);
        }
        if (videoModal && videoModal.style.display === 'flex') {
            if (e.key === 'Escape') closeVideoModal();
        }
    });
</script>

