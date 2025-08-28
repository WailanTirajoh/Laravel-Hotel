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
                        <h1 class="modal-title fs-5 fw-bold" id="main-modalLabel"></h1>
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

        <!-- Mobile Header -->
        @include('template.include._mobile-header')

        <div class="d-flex vh-100" id="wrapper">
            <!-- Desktop Sidebar -->
            @include('template.include._sidebar')

            <!-- Page Content -->
            <div id="page-content-wrapper" class="flex-fill">
                <div class="p-3 h-100">
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

            // Mobile dropdown functionality for offcanvas sidebar
            const mobileDropdownToggles = document.querySelectorAll('#mobileOffcanvas .nav-toggle[data-bs-toggle="collapse"]');

            mobileDropdownToggles.forEach(toggle => {
                const targetId = toggle.getAttribute('data-bs-target');
                const targetElement = document.querySelector(targetId);
                const arrow = toggle.querySelector('.nav-arrow');

                // Set initial state based on whether submenu is shown (server-side rendered)
                if (targetElement && targetElement.classList.contains('show')) {
                    toggle.setAttribute('aria-expanded', 'true');
                    if (arrow) {
                        arrow.style.transform = 'rotate(180deg)';
                    }
                } else {
                    toggle.setAttribute('aria-expanded', 'false');
                    if (arrow) {
                        arrow.style.transform = 'rotate(0deg)';
                    }
                }

                // Handle click events for manual toggle
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Get or create Bootstrap Collapse instance
                    const collapse = bootstrap.Collapse.getOrCreateInstance(targetElement, {
                        toggle: false
                    });

                    // Toggle the collapse
                    collapse.toggle();
                });

                // Listen to Bootstrap collapse events to update aria and arrow
                targetElement.addEventListener('shown.bs.collapse', function() {
                    toggle.setAttribute('aria-expanded', 'true');
                    if (arrow) {
                        arrow.style.transform = 'rotate(180deg)';
                    }
                });

                targetElement.addEventListener('hidden.bs.collapse', function() {
                    toggle.setAttribute('aria-expanded', 'false');
                    if (arrow) {
                        arrow.style.transform = 'rotate(0deg)';
                    }
                });
            });

            // Auto-close mobile menu when clicking nav links
            const mobileNavLinks = document.querySelectorAll('#mobileOffcanvas .nav-item:not(.dropdown-nav), #mobileOffcanvas .nav-subitem');
            const offcanvasElement = document.getElementById('mobileOffcanvas');

            mobileNavLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (offcanvasElement && window.innerWidth <= 768) {
                        const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasElement);
                        if (offcanvas) {
                            offcanvas.hide();
                        }
                    }
                });
            });
        });
    </script>

    @yield('footer')
</body>

</html>
