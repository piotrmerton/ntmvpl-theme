export let tabs = {
    selector: ".ui-tabs",
    selectorButton: ".do-toggle-tab",
    selectorTab: ".item--tab",
    selectorNav: ".tabs__nav",
    selectorTabContent: ".tab__content",
    classActive: "tab--open",
    animate: true,

    bind: function () {
        if (document.querySelector(this.selectorButton) === null) return;

        let tabsContainer = document.querySelector(this.selector);

        let buttons = tabsContainer.querySelectorAll(this.selectorButton);

        buttons.forEach((button) => {
            button.addEventListener("click", (event) => {
                let target = event.target;
                let tab = target.closest(this.selectorTab);

                this.toggleTab(tab);

                event.preventDefault();
            });
        });

        //window.addEventListener('resize', () => { this.reset() } );
    },

    toggleTab: function (tab) {
        console.log(tab);

        if (tab.classList.contains(this.classActive)) {
            this.closeTab(tab);
        } else {
            this.openTab(tab);
        }
    },

    openTab: function (tab) {
        tab.classList.add(this.classActive);
        tab.setAttribute("data-collapsed", "false");

        //because we are using transition animation for toggling, we need to explicitly set height of the content for animation to be precise
        //get the height of the element's inner content, regardless of its actual size, including content not visible on the screen due to overflow
        if (this.animate) {
            let tabContent = tab.querySelector(this.selectorTabContent);
            let contentHeight = tabContent.scrollHeight;
            tabContent.style.maxHeight = contentHeight + "px";
        }
    },

    closeTab: function (tab) {
        tab.classList.remove(this.classActive);
        tab.setAttribute("data-collapsed", "true");

        if (this.animate) {
            let tabContent = tab.querySelector(this.selectorTabContent);
            tabContent.removeAttribute("style");
        }
    },

    closeSiblings: function (tab) {
        let siblings = Array.prototype.filter.call(tab.parentNode.children, (child) => {
            return child !== tab;
        });

        //remove active class from siblings
        siblings.forEach((tab) => {
            tab.classList.remove(this.classActive);
            this.closeTab(tab);
        });
    },

    // close all tabs
    reset: function () {
        let tabsContainer = document.querySelector(this.selector);
        let tabs = tabsContainer.querySelectorAll(this.selectorTab);

        tabs.forEach((tab, index) => {
            tab.classList.remove(this.classActive);
            this.closeTab(tab);
        });
    },
};
