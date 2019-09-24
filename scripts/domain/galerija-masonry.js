import Masonry from 'masonry-layout';

const GalerijaMasonry = {
    $masonryContainers: [],
    $masonryInstances: [],

    init: function() {
        document.addEventListener('DOMContentLoaded', () => {
            this.bootstrapDom();

            if (this.$masonryContainers.length === 0) {
                return;
            }

            this.$masonryContainers.forEach(($masonryContainer) => {
                this.$masonryInstances.push(
                    new Masonry(
                        $masonryContainer,
                        {
                            columnWidth: '.grid-sizer',
                            itemSelector: 'li',
                            gutter: '.gutter-sizer',
                            percentPosition: true
                        }
                    )
                );

                this.addImageLoadListeners($masonryContainer);
            });
        });
    },

    addImageLoadListeners: function($masonryContainer) {
        const $images = $masonryContainer.querySelectorAll('img');

        $images.forEach(($image) => {
            if ($image.complete) {
                GalerijaMasonry.repositionAllMasonries();
            } else {
                $image.addEventListener('load', GalerijaMasonry.repositionAllMasonries);
            }
        });
    },

    imageLoadHandler: function() {
        GalerijaMasonry.repositionAllMasonries();
    },

    repositionAllMasonries: function() {
        GalerijaMasonry.$masonryInstances.forEach((instance) => {
            instance.layout();
        });
    },

    bootstrapDom: function() {
        this.$masonryContainers = document.querySelectorAll('#gallery-page-content .masonry');
    }
};

export default GalerijaMasonry.init();
