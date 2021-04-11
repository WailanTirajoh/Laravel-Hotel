<style>
    .dropend:hover .dropdown-menu {
        display: block;
        margin-top: 0;
    }

</style>
<div class="bg-light border-right shadow-sm mt-3" id="sidebar-wrapper">
    <div class="d-flex flex-column bg-light" style="width: 4.5rem;">
        <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
            <li>
                <a href="{{ route('dashboard.index') }}"
                    class="nav-link py-3 border-bottom myBtn {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}"
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
                    <svg width="25" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </a>
            </li>
            <li>
                <a href="{{ route('payment.index') }}"
                    class="nav-link py-3 border-bottom myBtn {{ Route::currentRouteName() == 'payment' ? 'active' : '' }}"
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Payment">
                    <svg width="25" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </a>
            </li>
            <li>
                <div class="dropend">
                    <a class="nav-link py-3 border-bottom myBtn {{ Route::currentRouteName() == 'room' ? 'active' : '' }} {{ Route::currentRouteName() == 'type' ? 'active' : '' }}
                        data-bs-toggle=" dropdown" aria-expanded="false">
                        <svg width="25" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('room.index') }}">Room</a></li>
                        <li><a class="dropdown-item" href="{{ route('type.index') }}">Type</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="dropend">
                    <a class="nav-link py-3 border-bottom myBtn {{ Route::currentRouteName() == 'customer.search' ? 'active' : '' }} {{ Route::currentRouteName() == 'customer' ? 'active' : '' }} {{ Route::currentRouteName() == 'user' ? 'active' : '' }}
                        data-bs-toggle=" dropdown" aria-expanded="false">
                        <svg width="25" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('customer.index') }}">Customer</a></li>
                        @if (auth()->user()->role == 'Super')
                            <li><a class="dropdown-item" href="{{ route('user.index') }}">User</a></li>
                        @endif
                    </ul>
                </div>
            </li>
            {{-- <li>
                <a href="#" class="nav-link py-3 border-bottom myBtn @if (stripos($_SERVER['REQUEST_URI'], 'dashboard') !== false) active @endif" title="" data-bs-toggle="tooltip"
                    data-bs-placement="right" data-bs-original-title="Customers">
                    <svg class="bi" width="24" height="24">
                        <use xlink:href="#people-circle"></use>
                    </svg>
                </a>
            </li> --}}
        </ul>
    </div>
</div>
