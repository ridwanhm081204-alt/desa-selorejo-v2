import './bootstrap';
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
import { createIcons, icons } from 'lucide';

document.addEventListener('DOMContentLoaded', () => {
    // Initialize Lucide icons
    if (typeof createIcons !== 'undefined' || icons) {
        createIcons({ icons });
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


