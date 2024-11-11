import Swiper, { Autoplay, EffectCards, EffectFade } from 'swiper';

export const initSliders = () => {
    // Check if Swiper is loaded in
    if (!Swiper) return false;

    // Get all sliders
    const sliders = document.querySelectorAll('.js-slider');

    let rotate = false; // because rotation messes up the slider on smaller devices
    let effect = 'fade';
    if (window.innerWidth >= 1024) {
        rotate = true;
        effect = 'cards';
    }

    if (sliders) {
        [...sliders].forEach((slider) => {
            const type = slider.hasAttribute('data-slider') ? slider.getAttribute('data-slider') : 'default';

            const options = {
                portfolio: {
                    modules: [Autoplay, EffectCards, EffectFade],
                    effect: effect,
                    cardsEffect: {
                        slideShadows: false,
                        rotate: rotate,
                        perSlideOffset: 1, // Space between cards in px
                        perSlideRotate: 6, // Rotation of cards in degrees
                    },

                    wrapperClass: 'slider__wrapper',
                    slideClass: 'slider__slide',
                    autoplay: {
                        delay: 2500,
                        disableOnInteraction: true,
                        pauseOnMouseEnter: true,
                    },
                },
            };

            new Swiper(slider, options[type]);
        });
    }
};
