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
                    class="nav-link py-3 border-bottom myBtn {{ Route::currentRouteName() == 'dashboard.index' ? 'active' : '' }}"
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
                    <i class="fas fa-home"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('reservation.index') }}"
                    class="nav-link py-3 border-bottom myBtn {{ Route::currentRouteName() == 'reservation.index' ? 'active' : '' }}"
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Room Reservation">
                    <i class="fas fa-cash-register"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('transaction.index') }}"
                    class="nav-link py-3 border-bottom myBtn {{ Route::currentRouteName() == 'payment.index' ? 'active' : '' }}"
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Transaction">
                    <i class="fas fa-file-invoice-dollar"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('payment.index') }}"
                    class="nav-link py-3 border-bottom myBtn {{ Route::currentRouteName() == 'payment.index' ? 'active' : '' }}"
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Payment">
                    <i class="fas fa-money-bill-wave-alt"></i>
                </a>
            </li>
            <li>
                <div class="dropend">
                    <a class="nav-link py-3 border-bottom myBtn {{ Route::currentRouteName() == 'room.index' ? 'active' : '' }} {{ Route::currentRouteName() == 'type.index' ? 'active' : '' }}
                        data-bs-toggle=" dropdown" aria-expanded="false">
                        <i class="fas fa-house-user"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('room.index') }}">Room</a></li>
                        <li><a class="dropdown-item" href="{{ route('type.index') }}">Type</a></li>
                        <li><a class="dropdown-item" href="{{ route('roomstatus.index') }}">Status</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="dropend">
                    <a class="nav-link py-3 border-bottom myBtn {{ Route::currentRouteName() == 'customer.search' ? 'active' : '' }} {{ Route::currentRouteName() == 'customer.index' ? 'active' : '' }} {{ Route::currentRouteName() == 'user.index' ? 'active' : '' }}
                        data-bs-toggle=" dropdown" aria-expanded="false">
                        <i class="fas fa-users"></i>
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
