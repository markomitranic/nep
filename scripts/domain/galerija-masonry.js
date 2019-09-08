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
            });
            console.log(this.$masonryInstances);
        });
    },

    bootstrapDom: function() {
        this.$masonryContainers = document.querySelectorAll('#gallery-page-content .masonry');
    }
};

export default GalerijaMasonry.init();
