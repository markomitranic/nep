const homeSlider = {
    init: function() {
        document.addEventListener('DOMContentLoaded', () => {

            if (!document.body.classList.contains('home')) {
                return;
            }

            $ = jQuery;

            $('document').ready(() => {
                this.bootsrapDom();
                if (!this.$slider.length) {
                    return;
                }
                this.listenForLoad();
                this.activateSlider();
            });
        });
    },

    bootsrapDom: function() {
        this.$slider = $('#home-slider .owl-carousel');
        this.$placeholder = $('#home-slider #slide-placeholder');
        this.$caption = $('#carousel-caption');
        this.$currentIndex = $('.slide-counter .current');
    },

    listenForLoad: function() {
        if (this.$placeholder.length) {
            this.$slider.on('initialized.owl.carousel', () => {
                setTimeout(() => { // Otherwise, the transition would be visible.
                    this.$placeholder.hide();
                    this.$slider.show();
                    this.$caption.show();
                }, 500);
            });
        }
    },

    activateSlider: function() {
        this.$slider.owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 6000,
            autoplayHoverPause: true,
            margin: false,
            nav: true,
            items: 1,
            dots: false,
            singleItem: true,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            onChanged: (e) => {
                this.displayExternalCaption(e);
                this.displayCurrentSlideNumber(e);
            }
        });
    },

    displayExternalCaption: function(e) {
        const $newSlide = this.$slider.find('.owl-item').eq(e.item.index).find('a');
        const title = $newSlide.data('title');
        this.$caption.text(title);
    },

    displayCurrentSlideNumber: function(e) {
        const $newSlideIndex = this.$slider.find('.owl-item').eq(e.item.index).find('a').data('index');
        this.$currentIndex.text($newSlideIndex);
    }

};

export default homeSlider.init();
