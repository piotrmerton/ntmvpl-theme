//import { UI } from "../ui";

export let nav = {
    //selectors
    headerSelectorID: "header-top",
    containerSelectorID: "header-nav",
    navSelectorID: "nav-top",
    buttonSelectorID: "ui-nav",

    //classes
    submenuClass: "submenu__list",
    hasSubmenuClass: "item--has-submenu",
    openClass: "menu--open",

    isOpen: false,

    bind: function () {
        let header = document.getElementById(this.headerSelectorID);
        let button = document.getElementById(this.buttonSelectorID);

        /*
         *	1. bind menu UI button
         */
        if (button === null) return;

        button.addEventListener("click", (event) => {
            this.toggleMenu();
            event.preventDefault();
        });

        /*
         *	2. bind navigation links with different logic regarding submenu based
         *	on current viewport width - deprecated for this project
         */

        //close menu by clicking anywhere...
        // document.addEventListener("click", (event) => {
        //     if (UI.mobile || UI.viewport.windowWidth < 960) return;
        //     this.resetMenu();
        // });

        // //...but not on header itself
        // header.addEventListener("click", (event) => {
        //     event.stopPropagation();
        // });
    },

    /**
     * toggle mobile menu
     */
    toggleMenu: function () {
        this.isOpen ? this.closeMenu() : this.openMenu();
    },

    //toggleSubmenu: function (el) {},

    openMenu: function () {
        this.isOpen = true;

        const header = document.getElementById(this.headerSelectorID);
        const container = document.getElementById(this.containerSelectorID);
        const menu = document.getElementById(this.navSelectorID);
        const button = document.getElementById(this.buttonSelectorID);

        header.classList.add(this.openClass);
        container.classList.add(this.openClass);
        menu.classList.add(this.openClass);
        button.classList.add(this.openClass);
    },

    closeMenu: function () {
        this.isOpen = false;

        let openMenuItems = document.querySelectorAll("." + this.openClass);

        openMenuItems.forEach((item) => {
            item.classList.remove(this.openClass);
        });
    },
};
