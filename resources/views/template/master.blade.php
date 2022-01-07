<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Icon --}}
    <link rel="icon" href="{{ asset('img/logo/sip.png') }}">
    {{-- style --}}
    <link rel="stylesheet" href="{{ asset('style/css/style.css') }}">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    {{-- Sweet Alert --}}
    <link rel="stylesheet" href="{{ asset('package/sweetalert2/dist/sweetalert2.min.css') }}">
    <title>@yield('title')</title>

    {{-- Toastr --}}
    <link href="{{ asset('package/toastr/toastr/build/toastr.css') }}" rel="stylesheet" />

    {{-- Toggle IOS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('package/toggle/vc-toggle-switch.css') }}" />

    {{-- Font Awesome --}}
    <link href="{{ asset('package/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">


    @yield('head')
</head>

<body>
    <header>
        @include('template.include._navbar')
    </header>
    <main class="my-3">
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->

            <!-- /#sidebar-wrapper -->
            @include('template.include._sidebar')
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
                {{-- <div class="wrapfooter">
                </div> --}}
            </div>
            <!-- /#page-content-wrapper -->

        </div>
    </main>
    <footer class="footer mt-auto py-2 shadow-sm border-top mt-3" style="background: #f8f9fa; height:55px">
        @include('template.include._footer')
    </footer>
    <script src="{{ mix('/js/app.js') }}"></script>
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
    <script>
        toastr.options.timeOut = 10000;
        Echo.channel('reservation.{{ auth()->user()->random_key }}')
            .listen('.reservation.event', (e) => {
                $("#refreshThisDropdown").load(window.location.href + " #refreshThisDropdown");
                // $("#refreshThisDropdown").load(" #refreshThisDropdown > *");
                toastr.success(e.message);
            })
    </script>
    @yield('footer')
</body>

</html>
