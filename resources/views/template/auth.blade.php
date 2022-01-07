<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Icon --}}
    <link rel="icon" href="{{ asset('img/logo/sip.png') }}">

    <!-- Bootstrap CSS -->
    {{-- <link href="{{ asset('package/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="{{ asset('style/js/style.css') }}">

    {{-- Toastr --}}
    {{-- <link href="{{ asset('package/toastr/toastr/build/toastr.css') }}" rel="stylesheet" /> --}}
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
</head>

<body>
    <main>
        <div>
            @yield('content')
        </div>
    </main>
    <script src="{{ mix('/js/app.js') }}"></script>

    {{-- <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script> --}}

    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });

    </script>

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

    </script>

    {{-- Toastr JS --}}
    <script src="{{ 'package/toastr/toastr/build/toastr.min.js' }}"></script>

    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}","Success")
        @endif
        @if (Session::has('failed'))
            toastr.error("{{ Session::get('failed') }}","Failed")
        @endif

    </script>
</body>

</html>
