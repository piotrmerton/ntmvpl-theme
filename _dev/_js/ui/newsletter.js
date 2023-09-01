/**
 * Simple Custom Handler for Mailerlite Form;
 *
 * The snippets generated via Mailerlite Dashboard/ Mailerlite WP Plugin rely extensively on jQuery and jQuery plugins like jQuery Validator and jQuery Input Mask; also WP Plugin doesn't track Location for added subscribers; let's use simple Fetch request instead and use HTML native form validation; For anything more fancy use Mailerlite snippets, but keep in mind they will load jQuery site-wide
 *
 */
export let newsletter = {
    bind: function () {
        const form = document.getElementById("newsletter-signin");
        const cta = document.getElementById("newsletter-cta");

        if (form !== null) {
            form.addEventListener("submit", (event) => {
                event.preventDefault();

                this.request(form);
            });
        }

        /**
         * Track mailerlite view when clicking newsletter cta that opens newsletter modal form
         * Tracking URL provided in "Embed form into yuour website" -> HTML Code @ Mailerlite Dashboard
         */
        if (cta !== null && form !== null) {
            const trackViewUrl = form.dataset.trackViewUrl;

            if (trackViewUrl !== undefined) {
                cta.addEventListener("click", () => {
                    console.log("Mailerlite CTA clicked");

                    fetch(trackViewUrl);
                });
            }
        }
    },

    request: function (form) {
        const formData = new FormData(form); // Get form data

        const url = form.getAttribute("action");

        // Use fetch to send the form data to MailerLite's server
        fetch(url, {
            method: "POST",
            body: formData,
        })
            .then((response) => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error("Remote server not available");
                }
            })

            /**
             * Mailerlite Response Data structure as of 07/2023
             *
             * @param success boolean
             * @param errors array of error for earch form fields
             *
             **/

            .then((data) => {
                // Handle the JSON response data

                //console.log("Response data:", data);

                if (data.success) {
                    form.classList.add("form--send");
                    form.classList.add("form--success");
                    console.log("Mailerlite susbscribed successfully");
                } else {
                    form.classList.add("form--send");
                    form.classList.add("form--error");
                    console.log("Failed to subscribe to mailerlite");
                    console.table(data.errors);

                    throw new Error("Failed to subscribe to newsletter.");
                }
            });
    },
};
