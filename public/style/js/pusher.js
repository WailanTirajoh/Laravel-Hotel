channel.bind('reservation-event', function(data) {
    $("#refreshThisDropdown").load(window.location.href + " #refreshThisDropdown");
    $("#refreshThisDropdown").load(" #refreshThisDropdown > *");
    toastr.success(JSON.stringify(data['message']), "Success");
});
