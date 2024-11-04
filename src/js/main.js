// Import modules.
import { initSliders } from './modules/initSliders';
import { initMobileMenuToggle } from './modules/initMobileMenuToggle';
import { initSplitting } from './modules/initSplitting';
import AOS from 'aos';

// import { initPayDemo } from './modules/initPayDemo';

// Main thread
(async function () {
    'use strict';

    let heroTexts = document.querySelectorAll('.hero .editor p');
    heroTexts.forEach((heroText) => {
        heroText.classList.add('fade-up-10');
    });
    // heroText.setAttribute('data-aos', 'fade-up-10');

    AOS.init({
        duration: 850,
        delay: 0,
        once: true,
        offset: 100,
        easing: 'ease-in-out-cubic',
    });

    // Use modules
    initSliders();
    initMobileMenuToggle();
    initSplitting();
    // initPayDemo();
})();
