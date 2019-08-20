const superNova = {
    movementLength: 70,
    movementSpeed: 0.5,
    currentKey: 0,
    dancingElements: [],

    init: function() {
        document.addEventListener('DOMContentLoaded', () => {
            this.bootstrapDom();

            if (this.dancingElements.length === 0) {
                return;
            }

            this.setSpeed();
            this.spinner();
        });
    },

    bootstrapDom: function() {
        this.dancingElements = document.querySelectorAll('#logo-supernova .dancing');
    },

    spinner: function() {
        setInterval(() => {
            const element = this.dancingElements[this.currentKey];

            element.style.strokeDashoffset = Math.floor(Math.random() * -this.movementLength);

            this.currentKey++;
            if (this.currentKey >= this.dancingElements.length) {
                this.currentKey = 0;
            }

        }, 50);
    },

    setSpeed: function() {
        this.dancingElements.forEach((element) => {
            element.style.transition = this.movementSpeed + 's stroke-dashoffset ease-in-out';
        });
    }
};

superNova.init();
