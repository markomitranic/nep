import trunkata from 'trunkata/dist/trunkata';

const shave = {
    $shavePoints: [],
    $menu: null,

    init: function() {
        document.addEventListener('DOMContentLoaded', () => {
            this.bootstrapDom();

            if (this.$shavePoints.length === 0) {
                return;
            }

            this.$shavePoints.forEach(($shavePoint) => {
                let rows = 1;

                if (!$shavePoint.dataset.hasOwnProperty('rows') || typeof $shavePoint.dataset.rows !== 'string') {
                    console.error('Rows dataset argument not provided for element shave.', $shavePoint);
                } else {
                    rows = parseInt($shavePoint.dataset.rows, 0);
                }

                trunkata($shavePoint, {lines: rows});
            });
        });
    },

    bootstrapDom: function() {
        this.$shavePoints = document.querySelectorAll('.shouldShave');
    }
};

export default shave.init();
