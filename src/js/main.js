// Import modules.
import { initSliders } from './modules/initSliders';
import { initMobileMenuToggle } from './modules/initMobileMenuToggle';
// import { initPayDemo } from './modules/initPayDemo';

// Main thread
(async function () {
    'use strict';

    // Use modules
    initSliders();
    initMobileMenuToggle();
    // initPayDemo();
})();
