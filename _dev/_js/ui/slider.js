import Swiper, { Navigation, Pagination } from "swiper";

export let slider = {
    sliders: [],
    settings: {
        speed: 200,
        slidesPerView: 1.25,
        spaceBetween: 16,

        //slides at the edge: https://stackoverflow.com/a/60823842, https://stackoverflow.com/a/62427943
        watchSlidesProgress: true,
        //centeredSlides: true,
        modules: [Navigation, Pagination],
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".slider__pagination",
            clickable: true,
        },
        breakpoints: {
            //settings for viewport bigger than 960px
            960: {
                slidesPerView: 3,
                spaceBetween: 32,
            },
            //settings for viewport bigger than 960px
            1280: {
                slidesPerView: 4,
                spaceBetween: 32,
            },
        },
    },

    init: function (sliderSelector = ".ui-slider", settingsCustom = {}, slidesVisible) {
        const selectors = document.querySelectorAll(sliderSelector);

        if (selectors == null) return;

        let settingsDefault = this.settings;

        selectors.forEach((slider) => {
            if (slider.dataset.slidesVisible) {
                let slidesVisible = parseInt(slider.dataset.slidesVisible);

                settingsDefault.breakpoints[1280].slidesPerView = slidesVisible;

                /**
                 * When 3 slides are visible, design slightly changes according to Invision: one tile is highlighted thus centering slides improves makes more sense, because otherwise there would be no scenario, the items at the edge got higlighted
                 */
                if (slidesVisible === 3) {
                    //settingsDefault.centeredSlides = true;
                    settingsDefault.breakpoints[960].centeredSlides = true;
                    settingsDefault.breakpoints[1280].centeredSlides = true;
                } else {
                    //settingsDefault.centeredSlides = false;
                    settingsDefault.breakpoints[960].centeredSlides = false;
                    settingsDefault.breakpoints[1280].centeredSlides = false;
                }
            }

            let settings = { ...settingsDefault, ...settingsCustom };

            new Swiper(slider, settings);
        });
    },
};
