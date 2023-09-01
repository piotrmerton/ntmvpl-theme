import { form } from "./ui/form";
import { modal } from "./ui/modal";
import { nav } from "./ui/nav";
import { newsletter } from "./ui/newsletter";
import { slider } from "./ui/slider";
import { tabs } from "./ui/tabs";
import { toc } from "./ui/toc";
import { viewport } from "./ui/viewport";

export let UI = {
    mobile: /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent),
    debug: true,

    // calculate and store viewport dimensions
    // this method will be bound to window resize event so try not to overload it
    init: function () {
        viewport.init();

        if (this.debug) console.log("Window width: " + viewport.windowWidth + ", Window height: " + viewport.windowHeight);
    },

    form,
    modal,
    nav,
    slider,
    tabs,
    toc,
    viewport,
    newsletter,
};
