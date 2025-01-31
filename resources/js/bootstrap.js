import _ from "lodash";
import jquery from "jquery";
import popper from "popper.js";
import sweetalert2 from "sweetalert2";
import toastr from "toastr";
import axios from "axios";

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */
(async () => {
    window._ = _;
    try {
        window.Popper = popper;
        window.$ = window.jQuery = jquery;
        const [bootstrap, select2] = await Promise.all([
            import("bootstrap"),
            import("select2"),
        ]);
        window.bootstrap = bootstrap;
        select2.default();

        window.Swal = sweetalert2;
        const ttoastr = toastr;
        toastr.options = {
            closeButton: false,
            debug: false,
            newestOnTop: false,
            progressBar: false,
            positionClass: "toast-bottom-right",
            preventDuplicates: false,
            onclick: null,
            showDuration: "300",
            hideDuration: "1000",
            timeOut: "5000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut",
        };

        window.toastr = ttoastr;
    } catch (e) {}

    /**
     * We'll load the axios HTTP library which allows us to easily issue requests
     * to our Laravel back-end. This library automatically handles sending the
     * CSRF token as a header based on the value of the "XSRF" token cookie.
     */
    window.axios = axios;
    window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

    /**
     * Echo exposes an expressive API for subscribing to channels and listening
     * for events that are broadcast by Laravel. Echo and event broadcasting
     * allows your team to easily build robust real-time web applications.
     */

    window.CustomHelper = {
        errorHandlerForm(e) {
            for (const error in e.responseJSON.errors) {
                const errorLabel = error;
                const errorList = e.responseJSON.errors[error];
                $(`#error_${errorLabel}`).text(errorList.join(", "));
            }
        },
        clearError() {
            $(".error").text("");
        },
    };

    await Promise.all([import("datatables.net"), import("datatables.net-bs5")]);

    await Promise.all([
        import("./echo"),
        import("./pages/room-status"),
        import("./pages/type"),
        import("./pages/room"),
        import("./pages/dashboard"),
        import("./pages/login"),
        import("./pages/global"),
    ]);
})();
