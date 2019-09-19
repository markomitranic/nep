const frontpageHeroFlasher = {
    $hero: null,
    slideDuration: 4000,

    init: function() {
        document.addEventListener('DOMContentLoaded', () => {
            this.bootstrapDom();

            if (typeof (this.$hero) === 'undefined' ||
                this.$hero === null ||
                !this.$hero.classList.contains('flashing')
            ) {
                return;
            }

            setInterval(() => {
                this.$hero.classList.toggle('misli-buducnost-visible');
            }, this.slideDuration);
        });
    },

    bootstrapDom: function() {
        this.$hero = document.querySelector('#page-title');
    }
};

export default frontpageHeroFlasher.init();
