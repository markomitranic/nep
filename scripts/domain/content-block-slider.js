import {tns} from 'tiny-slider/src/tiny-slider';

const contentBlockSlider = {
    $slideLists: [],
    transitionSpeed: 500,
    slideDuration: 6000,
    slider: null,

    init: function() {
        document.addEventListener('DOMContentLoaded', () => {
            this.bootstrapDom();

            if (typeof (this.$slideLists) === 'undefined' || this.$slideLists === null || this.$slideLists.length < 1) {
                return;
            }

            this.$slideLists.forEach(($slideList) => {
                this.startSlider($slideList);
            });

        });
    },

    bootstrapDom: function() {
        this.$slideLists = document.querySelectorAll('.wp-block-slider ul');
    },

    startSlider: function($slideList) {
        this.slider = tns({
            container: $slideList,
            autoplay: true,
            mode: 'gallery',
            items: 1,
            controls: false,
            nav: true,
            swipeAngle: false,
            speed: this.transitionSpeed,
            autoplayTimeout: this.slideDuration,
            autoplayHoverPause: true,
            autoplayButton: false,
            autoplayButtonOutput: false
        });
    }
};

export default contentBlockSlider.init();
