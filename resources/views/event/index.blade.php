<!DOCTYPE html>

<head>
    <title>Pusher Testt</title>
    <link href="{{ asset('package/toastr/toastr/build/toastr.css') }}" rel="stylesheet" />
    {{-- Sweet Alert 2 JS --}}
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    {{-- Toastr JS --}}
    <script src="{{ asset('package/toastr/toastr/build/toastr.min.js') }}"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('18781accf1f887a59b22', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('channel-reservation');
        channel.bind('reservation-event', function(data) {
            toastr.success(JSON.stringify(data['message']), "Success");
        });

    </script>
</head>

<body>
    <h1>Pusher Testt</h1>
    <p>
        Try publishing an event to channel <code>my-channel</code>
        with event name <code>my-event</code>.
    </p>
</body>
{{-- Sweet Alert 2 JS --}}
<script src="{{ asset('package/sweetalert2/dist/sweetalert2.min.js') }}"></script>
{{-- Toastr JS --}}
<script src="{{ asset('package/toastr/toastr/build/toastr.min.js') }}"></script>
<script>
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}","Success")
    @endif
    @if (Session::has('failed'))
        toastr.error("{{ Session::get('failed') }}","Failed")
    @endif

</script>
