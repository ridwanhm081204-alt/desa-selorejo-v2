import './bootstrap';
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
import { createIcons, icons } from 'lucide';

// Copy and inject missing brand icons (Facebook, Instagram, Youtube) removed from Lucide library
const customIcons = {
    ...icons,
    Facebook: [["path", {"d": "M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"}]],
    Instagram: [
        ["rect", {"width": "20", "height": "20", "x": "2", "y": "2", "rx": "5", "ry": "5"}],
        ["path", {"d": "M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"}],
        ["line", {"x1": "17.5", "x2": "17.51", "y1": "6.5", "y2": "6.5"}]
    ],
    Youtube: [
        ["path", {"d": "M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"}],
        ["path", {"d": "m10 15 5-3-5-3z"}]
    ],
    Tiktok: [
        ["path", {"d": "M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"}]
    ],
    tiktok: [
        ["path", {"d": "M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"}]
    ]
};

window.lucide = { createIcons, icons: customIcons };

document.addEventListener('DOMContentLoaded', () => {
    // Initialize Lucide icons
    if (window.lucide) {
        window.lucide.createIcons({ icons: customIcons });
    }

    // Realtime Clock Logic
    const clockElement = document.getElementById('realtime-clock');
    if (clockElement) {
        const updateClock = () => {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric', 
                hour: '2-digit', 
                minute: '2-digit', 
                second: '2-digit' 
            };
            clockElement.innerText = now.toLocaleDateString('id-ID', options);
        };
        updateClock();
        setInterval(updateClock, 1000);
    }
    // Hero Slideshow Logic
    const slides = document.querySelectorAll('.hero-slide');
    if (slides.length > 0) {
        let currentSlide = 0;
        setInterval(() => {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }, 3000);
    }
});


