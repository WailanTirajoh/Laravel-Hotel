$(document).on("submit", "#form-login", function (e) {
    $("#loading_submit").removeClass("hide");
    $("#text_submit").addClass("hide");
    $("#btn_submit").addClass("isLoading").attr("disabled", "disabled");
});
