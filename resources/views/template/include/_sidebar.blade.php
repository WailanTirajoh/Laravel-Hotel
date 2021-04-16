<style>
    .dropend:hover .dropdown-menu {
        display: block;
        margin-top: 0;
    }

</style>
<div class="bg-light border-right shadow-sm " id="sidebar-wrapper">
    <div class="d-flex flex-column bg-light"
        style="width: 4.5rem; border-top-right-radius:0.5rem; border-bottom-right-radius:0.5rem">
        <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
            <li>
                <a href="{{ route('dashboard.index') }}"
                    class="nav-link py-3 border-bottom myBtn
                    {{ Route::currentRouteName() == 'dashboard.index' ? 'active' : '' }}
                    {{ Route::currentRouteName() == 'chart.dialyGuest' ? 'active' : '' }}
                    "
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
                    <i class="fas fa-home"></i>
                </a>
            </li>
            @if (auth()->user()->role == 'Super' || auth()->user()->role == 'Admin')
                <li>
                    <a href="{{ route('transaction.index') }}" class="nav-link py-3 border-bottom myBtn
                        {{ Route::currentRouteName() == 'transaction.index' ? 'active' : '' }}
                        {{ Route::currentRouteName() == 'reservation.createIdentity' ? 'active' : '' }}
                        {{ Route::currentRouteName() == 'reservation.pickFromCustomer' ? 'active' : '' }}
                        {{ Route::currentRouteName() == 'reservation.usersearch' ? 'active' : '' }}
                        {{ Route::currentRouteName() == 'reservation.storeCustomer' ? 'active' : '' }}
                        {{ Route::currentRouteName() == 'reservation.countPerson' ? 'active' : '' }}
                        {{ Route::currentRouteName() == 'reservation.chooseRoom' ? 'active' : '' }}
                        {{ Route::currentRouteName() == 'reservation.confirmation' ? 'active' : '' }}
                        {{ Route::currentRouteName() == 'reservation.payDownPayment' ? 'active' : '' }}
                        " data-bs-toggle="tooltip" data-bs-placement="right" title="Transactions">
                        <i class="fas fa-cash-register"></i>
                    </a>
                </li>
                <li>
                    <div class="dropend">
                        <a class="nav-link py-3 border-bottom myBtn
                    {{ Route::currentRouteName() == 'room.index' ? 'active' : '' }}
                    {{ Route::currentRouteName() == 'room.create' ? 'active' : '' }}
                    {{ Route::currentRouteName() == 'room.edit' ? 'active' : '' }}
                    {{ Route::currentRouteName() == 'type.index' ? 'active' : '' }}
                    {{ Route::currentRouteName() == 'type.create' ? 'active' : '' }}
                    {{ Route::currentRouteName() == 'type.edit' ? 'active' : '' }}
                    {{ Route::currentRouteName() == 'roomstatus.index' ? 'active' : '' }}
                    {{ Route::currentRouteName() == 'roomstatus.create' ? 'active' : '' }}
                    {{ Route::currentRouteName() == 'roomstatus.edit' ? 'active' : '' }}
                        " data-bs-toggle="dropdown" aria-expanded="false">
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
                        <a class="nav-link py-3 border-bottom myBtn
                        {{ Route::currentRouteName() == 'customer.index' ? 'active' : '' }}
                        {{ Route::currentRouteName() == 'customer.create' ? 'active' : '' }}
                        {{ Route::currentRouteName() == 'customer.edit' ? 'active' : '' }}
                        {{ Route::currentRouteName() == 'user.index' ? 'active' : '' }}
                        {{ Route::currentRouteName() == 'user.create' ? 'active' : '' }}
                        {{ Route::currentRouteName() == 'user.edit' ? 'active' : '' }}
                    " data-bs-toggle="dropdown" aria-expanded="false">
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
            @endif
        </ul>
    </div>
</div>
