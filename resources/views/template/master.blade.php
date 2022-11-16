<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Icon --}}
    <link rel="icon" href="{{ asset('img/logo/sip.png') }}">
    {{-- style --}}
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
    @yield('head')
</head>

<body>
    <header>
        @include('template.include._navbar')
    </header>
    <main class="my-3">
        <!-- Modal -->
        <div class="modal fade" id="main-modal" tabindex="-1" aria-labelledby="main-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button id="btn-modal-close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="btn-modal-save" type="button" class="btn btn-primary text-white">Save</button>
                    </div>
                </div>
            </div>
        </div>
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
    @vite('resources/js/app.js')
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
