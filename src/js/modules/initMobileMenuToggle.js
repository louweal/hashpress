export const initMobileMenuToggle = function initMobileMenuToggle() {
    /** this is for expanding/collapsing the mobile menu on smaller devices */
    const menuToggle = document.querySelector('.js-toggle-mobile-menu');
    if (!menuToggle) return;
    let body = document.querySelector('body');

    // Add the toggleMenu event to the toggle
    menuToggle.addEventListener('click', function toggleMenu(event) {
        event.preventDefault();

        if (body.classList.contains('is-mobile-menu-open')) {
            body.classList.remove('is-mobile-menu-open');
            menuToggle.classList.remove('is-active');
        } else {
            body.classList.add('is-mobile-menu-open');
            menuToggle.classList.add('is-active');
        }
    });

    let menuCloseToggle = document.querySelector('.js-close-mobile-menu');
    if (!menuCloseToggle) return;

    menuCloseToggle.addEventListener('click', function toggleMenu(event) {
        body.classList.remove('is-mobile-menu-open');
        menuToggle.classList.remove('is-active');
    });
};
