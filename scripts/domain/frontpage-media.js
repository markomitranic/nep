import {tns} from 'tiny-slider/src/tiny-slider';

const frontpageMediaSlider = {
    $mediaSlider: null,
    transitionSpeed: 1500,
    slideDuration: 2500,
    slider: null,

    init: function() {
        document.addEventListener('DOMContentLoaded', () => {
            this.bootstrapDom();

            if (typeof (this.$mediaSlider) === 'undefined' || this.$mediaSlider === null) {
                return;
            }

            this.slider = tns({
                container: this.$mediaSlider,
                autoplay: true,
                mode: 'gallery',
                items: 1,
                controls: false,
                nav: false,
                autoHeight: true,
                arrowKeys: false,
                speed: this.transitionSpeed,
                autoplayTimeout: this.slideDuration,
                autoplayHoverPause: false,
                autoplayButton: false,
                autoplayButtonOutput: false
            });
        });
    },

    bootstrapDom: function() {
        this.$mediaSlider = document.querySelector('#media .slider-wrapper');
    }
};

export default frontpageMediaSlider.init();
