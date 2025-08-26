<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Icon --}}
    <link rel="icon" href="{{ asset('img/logo/sip.png') }}">
    {{-- style --}}
    @vite('resources/sass/app.scss')
    <title>@yield('title') - Hotel Admin</title>
    @yield('head')
</head>

<body class="sidebar-layout">
    <main>
        <!-- Enhanced Modal -->
        <div class="modal fade" id="main-modal" tabindex="-1" aria-labelledby="main-modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
                    <div class="modal-header bg-light border-0">
                        <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer border-0 bg-light">
                        <button id="btn-modal-close" type="button" class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button id="btn-modal-save" type="button" class="btn btn-hotel-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex vh-100" id="wrapper">
            <!-- Sidebar -->
            @include('template.include._sidebar')

            <!-- Page Content -->
            <div id="page-content-wrapper" class="flex-fill">
                <div class="p-2 h-100">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>

    @vite('resources/js/app.js')

    <!-- Initialize Tooltips -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Bootstrap tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Sidebar toggle functionality for mobile
            const toggleBtn = document.getElementById('sidebar-toggle');
            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    document.getElementById('sidebar-wrapper').classList.toggle('collapsed');
                });
            }
        });
    </script>

    @yield('footer')
</body>

</html>
