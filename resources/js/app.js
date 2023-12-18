import './bootstrap';

import Swiper from 'swiper/bundle';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const swiper = new Swiper('.swiper', {
    speed: 400,
    spaceBetween: 0,
    autoplay: {
        delay: 5000,
    },
    loop: true,
});
