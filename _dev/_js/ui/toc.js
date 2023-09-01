import { UI } from "../ui";

export let toc = {
    selectorID: "table-of-contents",

    bind: function () {
        const toc = document.getElementById(this.selectorID);

        if (toc === null || UI.mobile) return;

        const headers = document.querySelectorAll("h2[id]");
        const index_list_items = toc.querySelectorAll("li");

        if (headers === null || headers.length == 0) return;

        window.addEventListener("scroll", function () {
            var scrollTop = window.scrollY || document.documentElement.scrollTop;

            // Highlight the last scrolled-to: set everything inactive first
            index_list_items.forEach((li) => li.classList.remove("item--active"));

            // Then iterate backwards, on the first match highlight it and break
            for (var i = headers.length - 1; i >= 0; i--) {
                var anchorOffset = headers[i].offsetTop;

                if (scrollTop > anchorOffset - 132) {
                    var id = headers[i].getAttribute("id");
                    var link = toc.querySelector('a[href="#' + id + '"]');
                    link.closest("li").classList.add("item--active");
                    break;
                }
            }
        });
    },
};
