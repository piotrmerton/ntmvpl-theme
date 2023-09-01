export let modal = {
    buttonSelector: ".do-toggle-modal, [data-modal-target]",
    activeClass: "modal--active",
    openClass: "modal--open",
    currentViewportPosition: null,

    /**
     * @param {string} buttonClass
     */
    bind: function (buttonSelector = this.buttonSelector) {
        let buttons = document.querySelectorAll(buttonSelector);

        for (let i = 0; i < buttons.length; i++) {
            let modalTargetName = buttons[i].dataset.modalTarget;

            modalTargetName = modalTargetName === undefined ? "contact-form" : modalTargetName;

            buttons[i].addEventListener("click", (event) => {
                event.preventDefault();
                this.toggle(modalTargetName);
            });
        }

        /**
         *  close UI by clicking on overlay
         *  take note that overlay is dynamically appended via JS, so we need to bind event to document
         */
        document.addEventListener("click", (event) => {
            if (event.target.classList.contains("overlay--modal")) {
                let modalName = event.target.closest(".modal").dataset.modal;
                this.close(modalName);
            }
        });
    },

    /**
     * @param {string} modalName
     */
    toggle: function (modalName) {
        let modalTarget = document.querySelector('[data-modal="' + modalName + '"]');

        modalTarget.classList.contains(this.openClass) ? this.close(modalName) : this.open(modalName);
    },

    /**
     * @param {string} modalName
     * @param {boolean} toggle
     */
    open: function (modalName, toggle = false) {
        let modalTarget = document.querySelector('[data-modal="' + modalName + '"]');

        //if modal is already opened, don't do anything
        if (modalTarget.classList.contains(this.openClass)) return;

        //save scroll position
        this.currentViewportPosition = window.scrollY;

        //jump to the top of the page
        //scroll(0, 0);

        //toggle active classes for modal element and body
        modalTarget.classList.add(this.openClass);
        document.body.classList.add(this.activeClass);
    },

    /**
     * @param {string} modalName
     */
    close: function (modalName) {
        let modalTarget = document.querySelector('[data-modal="' + modalName + '"]');

        //remove modal related classes from modal and body
        modalTarget.classList.remove(this.openClass);
        document.body.classList.remove(this.activeClass);

        //set previous scroll position
        //scroll(0, this.currentViewportPosition);
    },
};
