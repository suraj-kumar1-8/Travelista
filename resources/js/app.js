import './bootstrap';

import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import collapse from '@alpinejs/collapse';
import AOS from 'aos';
import 'aos/dist/aos.css';
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

window.Alpine = Alpine;
window.Swiper = Swiper;

Alpine.plugin(intersect);
Alpine.plugin(collapse);

Alpine.start();

// Global Image Fallback Handler
window.addEventListener('error', function(e) {
    if (e.target.tagName === 'IMG') {
        const fallbackImages = [
            'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?auto=format&fit=crop&q=80&w=2000',
            'https://images.unsplash.com/photo-1506929113670-b43135c8d33d?auto=format&fit=crop&q=80&w=2000',
            'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&q=80&w=2000'
        ];
        const randomFallback = fallbackImages[Math.floor(Math.random() * fallbackImages.length)];
        
        if (e.target.src !== randomFallback) {
            e.target.src = randomFallback;
        }
    }
}, true);

// Initialize AOS
AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true,
    mirror: false,
});

// Dark mode toggle helper
if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
} else {
    document.documentElement.classList.remove('dark');
}
