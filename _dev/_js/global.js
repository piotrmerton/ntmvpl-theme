import { UI } from "./ui";

document.addEventListener("DOMContentLoaded", () => {
    UI.init();
    UI.modal.bind();
    UI.nav.bind();
    UI.form.bind();
    UI.tabs.bind();
    UI.toc.bind();
    UI.newsletter.bind();

    //Generic sliders with default settings
    UI.slider.init();

    //Posts (Blog, Case Studies) slider custom settings
    UI.slider.init(".posts-slider", {
        breakpoints: {
            //settings for viewport bigger than 960px
            960: {
                slidesPerView: 3,
                spaceBetween: 32,
            },
            //settings for viewport bigger than 960px
            1280: {
                slidesPerView: 3,
                spaceBetween: 64,
            },
        },
    });

    //Testimonials slider custom settings
    UI.slider.init(".testimonials-slider", {
        //pagination doesn't work well with loop in 9.x.x
        //https://github.com/nolimits4web/swiper/issues/6460
        loop: true,
        loopedSlides: 3,

        breakpoints: {
            //settings for viewport bigger than 960px
            960: {
                slidesPerView: 1,
                spaceBetween: 40,
                centeredSlides: true,

                //Not all parameters can be changed in breakpoints, only those which do not require different layout and logic, like slidesPerView, slidesPerGroup, spaceBetween, grid.rows. Such parameters like loop and effect won't work
                //source: https://swiperjs.com/swiper-api#param-breakpoints
            },
        },
    });
});

window.addEventListener("resize", () => {
    UI.init();
});
