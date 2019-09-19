import {tns} from 'tiny-slider/src/tiny-slider';

const frontpageNewsSlider = {
    $newsSlider: null,
    transitionSpeed: 500,
    slideDuration: 4000,
    slider: null,

    init: function() {
        document.addEventListener('DOMContentLoaded', () => {
            this.bootstrapDom();

            if (typeof (this.$newsSlider) === 'undefined' || this.$newsSlider === null) {
                return;
            }

            this.slider = tns({
                container: this.$newsSlider,
                autoplay: true,
                mode: 'gallery',
                items: 1,
                controls: false,
                nav: false,
                autoHeight: true,
                arrowKeys: false,
                speed: this.transitionSpeed,
                autoplayTimeout: this.slideDuration,
                autoplayHoverPause: true,
                autoplayButton: false,
                autoplayButtonOutput: false
            });
        });
    },

    bootstrapDom: function() {
        this.$newsSlider = document.querySelector('#news ul');
    }
};

export default frontpageNewsSlider.init();
