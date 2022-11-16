$(function() {
    $(document).on("click", "#menu-toggle", function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
})

