const mobileMenu = {
    $menuButton: null,
    $menu: null,

    init: function() {
        document.addEventListener('DOMContentLoaded', () => {
            this.bootstrapDom();

            if (typeof (this.$menuButton) === 'undefined' && this.$menuButton === null) {
                return;
            } else if (typeof (this.$menu) === 'undefined' && this.$menu === null) {
                return;
            }

            this.$menuButton.addEventListener('click', () => {
                document.body.classList.toggle('no-scroll');
                this.$menu.classList.toggle('visible');
            });
        });
    },

    bootstrapDom: function() {
        this.$menuButton = document.getElementById('mobile-menu-button');
        this.$menu = document.querySelector('#header-menu');
    }
};

export default mobileMenu.init();
