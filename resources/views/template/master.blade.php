<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Icon --}}
    <link rel="icon" href="{{ asset('img/logo/sip.png') }}">
    {{-- style --}}
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
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
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}", "Success")
        @endif
        @if (Session::has('failed'))
            toastr.error("{{ Session::get('failed') }}", "Failed")
        @endif
    </script>
    <script>
        toastr.options.timeOut = 10000;
        Echo.channel('reservation.{{ auth()->user()->random_key }}')
            .listen('.reservation.event', (e) => {
                $("#refreshThisDropdown").load(window.location.href + " #refreshThisDropdown");
                toastr.success(e.message);
            })
    </script>
    @yield('footer')
</body>

</html>
