export let form = {
    uiSelect: ".ui-select",
    uiSelectLabel: ".ui-select-label",
    contactFormTextareaWrapper: ".field--textarea .wpcf7-form-control-wrap", //Contact Form 7 markup
    selectorField: ".form__field",

    bind: function () {
        this.selectAutoSubmit();
        this.bindFormFields();
        this.autoGrowTextarea(this.contactFormTextareaWrapper);
    },

    /**
     * auto resize <textarea>
     * source: https://css-tricks.com/the-cleanest-trick-for-autogrowing-textareas/
     */
    autoGrowTextarea(selector) {
        const nodes = document.querySelectorAll(selector);

        if (nodes === null) return;

        nodes.forEach((node) => {
            const textarea = node.querySelector("textarea");
            textarea.addEventListener("input", () => {
                node.dataset.replicatedValue = textarea.value;
            });
            textarea.addEventListener("focus", () => {
                node.classList.add("focused");
            });
            textarea.addEventListener("blur", () => {
                node.classList.remove("focused");
            });
        });
    },

    /**
     * By default, clicking <label> doesn't open <select>, and most modern browsers prevent modifying default actions
     * sources:
     * https://stackoverflow.com/a/39635285
     * https://stackoverflow.com/a/10136523
     *
     */
    //toggleSelectViaLabel(selector = this.uiSelectLabel) {},

    /**
     * automatically submit form when interacting with <select>
     *
     * @param {string} selector
     * @param {bool} reload - if true, page will be reloaded instead of submitted
     *
     */
    selectAutoSubmit(selector = this.uiSelect, reload = false) {
        const nodes = document.querySelectorAll(selector);

        if (nodes === null) return;

        nodes.forEach((node) => {
            const form = node.closest("form");

            node.addEventListener("change", (event) => {
                if (reload) {
                    //TO DO: check for valid URL?
                    window.location.href = event.target.value;
                } else {
                    /**
                     * Before submitting form, let's disable unselected <options> - this way, when
                     * form action is GET, there won't be any empty params in URL
                     **/

                    let inputs = form.querySelectorAll("select");
                    inputs.forEach((input) => {
                        if (!input.value) input.disabled = true;
                    });
                    form.submit();
                }
            });
        });
    },

    /**
     * Some inputs are wrapped into additional wrapper: let's add helper classes for styling purposes
     */
    bindFormFields(selector = this.selectorField) {
        const fields = document.querySelectorAll(selector);

        if (fields === null) return;

        fields.forEach((node) => {
            const input = node.querySelector("input, textarea");

            if (input !== null) {
                input.addEventListener("focus", () => {
                    node.classList.add("field--focused");
                });
                input.addEventListener("blur", () => {
                    node.classList.remove("field--focused");
                });
            }
        });
    },
};
