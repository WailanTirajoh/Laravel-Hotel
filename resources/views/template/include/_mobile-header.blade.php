<header class="mobile-header">
    <div class="container-fluid">
        <!-- Hamburger Menu Button -->
        <button class="hamburger-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileOffcanvas" aria-controls="mobileOffcanvas">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Brand -->
        <a href="{{ route('dashboard.index') }}" class="mobile-brand">
            <div class="brand-icon">
                <i class="fas fa-hotel"></i>
            </div>
            <span class="brand-text">Laravel Hotel</span>
        </a>

        <!-- Profile & Notifications -->
        <div class="mobile-profile">
            <!-- Notifications -->
            <button class="notification-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-bell"></i>
                @if (auth()->user()->unreadNotifications->count() > 0)
                    <span class="notification-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                @endif
            </button>

            <!-- Notification Dropdown -->
            <ul class="dropdown-menu dropdown-menu-end shadow-lg" style="width: 300px;">
                <li class="dropdown-header d-flex justify-content-between align-items-center">
                    <span class="fw-bold">Notifications</span>
                    @if (auth()->user()->unreadNotifications->count() > 0)
                        <span class="badge bg-primary">{{ auth()->user()->unreadNotifications->count() }} new</span>
                    @endif
                </li>
                <li><hr class="dropdown-divider"></li>

                <div style="max-height: 200px; overflow-y: auto;">
                    @forelse (auth()->user()->unreadNotifications->take(3) as $notification)
                        <li>
                            <a href="{{ route('notification.routeTo', ['id' => $notification->id]) }}" class="dropdown-item">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary rounded-circle p-2" style="width: 32px; height: 32px;">
                                            <i class="fas fa-bell text-white" style="font-size: 0.75rem;"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <div class="fw-medium text-dark" style="font-size: 0.8rem;">
                                            {{ Str::limit($notification->data['title'] ?? 'New Notification', 40) }}
                                        </div>
                                        <div class="text-muted small">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @empty
                        <li>
                            <div class="dropdown-item text-center text-muted py-3">
                                <i class="fas fa-bell-slash mb-2"></i>
                                <div>No new notifications</div>
                            </div>
                        </li>
                    @endforelse
                </div>

                @if (auth()->user()->unreadNotifications->count() > 3)
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item text-center text-primary" href="#">
                            <small>View all notifications</small>
                        </a>
                    </li>
                @endif
            </ul>

            <!-- User Profile Dropdown -->
            <div class="dropdown">
                <button class="profile-dropdown-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="profile-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div class="profile-info d-none d-sm-block">
                        <div class="profile-name">{{ auth()->user()->name }}</div>
                        <div class="profile-role">{{ auth()->user()->role ?? 'Admin' }}</div>
                    </div>
                    <i class="fas fa-chevron-down profile-arrow d-none d-sm-block"></i>
                </button>

                <!-- User Profile Dropdown Menu -->
                <ul class="dropdown-menu dropdown-menu-end shadow-lg" style="min-width: 200px;">
                    <li class="dropdown-header">
                        <div class="d-flex align-items-center">
                            <div class="profile-avatar me-2" style="width: 32px; height: 32px; font-size: 0.75rem;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                            </div>
                            <div>
                                <div class="fw-bold" style="font-size: 0.85rem;">{{ auth()->user()->name }}</div>
                                <div class="text-muted" style="font-size: 0.75rem;">{{ auth()->user()->role ?? 'Admin' }}</div>
                            </div>
                        </div>
                    </li>
                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user me-2 text-primary"></i>
                            View Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cog me-2 text-secondary"></i>
                            Account Settings
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-bell me-2 text-info"></i>
                            Notification Settings
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('mobile-logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            Sign Out
                        </a>
                        <form id="mobile-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Offcanvas Sidebar -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileOffcanvas" aria-labelledby="mobileOffcanvasLabel">
    <button type="button" class="btn-close offcanvas-close-btn" data-bs-dismiss="offcanvas" aria-label="Close">
        <i class="fas fa-times"></i>
    </button>

    <!-- Reuse the existing sidebar content -->
    <div class="lh-sidebar mobile-sidebar-content">
        <div class="sidebar-content">
            <!-- Brand Header -->
            <div class="sidebar-brand">
                <div class="brand-logo">
                    <i class="fas fa-hotel"></i>
                </div>
                <div class="brand-text">
                    <h4 class="mb-0">Laravel Hotel</h4>
                </div>
            </div>

            <!-- User Profile Section -->
            <div class="sidebar-user">
                <div class="user-avatar">
                    <img src="{{ auth()->user()->getAvatar() }}" alt="User Avatar" class="rounded-circle">
                </div>
                <div class="user-info">
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-role">{{ auth()->user()->role }}</div>
                </div>
                <div class="user-actions">
                    <div class="dropdown">
                        <button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Notifications Section -->
            <div class="sidebar-notifications">
                <div class="notifications-header">
                    <div class="notifications-title">
                        <i class="fas fa-bell me-2"></i>
                        Notifications
                        @if (auth()->user()->unreadNotifications->count() > 0)
                            <span class="notification-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                        @endif
                    </div>
                </div>
                <div class="notifications-content">
                    @forelse (auth()->user()->unreadNotifications->take(3) as $notification)
                        <a href="{{ route('notification.routeTo', ['id' => $notification->id]) }}" class="notification-item">
                            <div class="notification-icon">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="notification-text">
                                <div class="notification-message">{{ Str::limit($notification->data['message'] ?? 'New notification', 40) }}</div>
                                <div class="notification-time">{{ $notification->created_at->diffForHumans() }}</div>
                            </div>
                        </a>
                    @empty
                        <div class="notification-empty">
                            <i class="fas fa-bell-slash"></i>
                            <span>No new notifications</span>
                        </div>
                    @endforelse

                    @if (auth()->user()->unreadNotifications->count() > 3)
                        <div class="notifications-footer">
                            <a href="{{ route('notification.index') }}" class="view-all-notifications">
                                View all ({{ auth()->user()->unreadNotifications->count() }})
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="sidebar-nav">
                <!-- Dashboard -->
                <div class="nav-section">
                    <div class="nav-section-title">Overview</div>
                    <a href="{{ route('dashboard.index') }}"
                       class="nav-item {{ in_array(Route::currentRouteName(), ['dashboard.index', 'chart.dailyGuest']) ? 'active' : '' }}">
                        <div class="nav-icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <div class="nav-content">
                            <div class="nav-title">Dashboard</div>
                            <div class="nav-subtitle">Analytics & Overview</div>
                        </div>
                    </a>
                </div>

                @if (auth()->user()->role == 'Super' || auth()->user()->role == 'Admin')
                    <!-- Operations -->
                    <div class="nav-section">
                        <div class="nav-section-title">Operations</div>

                        <!-- Transactions -->
                        <a href="{{ route('transaction.index') }}"
                           class="nav-item {{ in_array(Route::currentRouteName(), ['payment.index', 'transaction.index', 'transaction.reservation.createIdentity', 'transaction.reservation.pickFromCustomer', 'transaction.reservation.usersearch', 'transaction.reservation.storeCustomer', 'transaction.reservation.viewCountPerson', 'transaction.reservation.chooseRoom', 'transaction.reservation.confirmation', 'transaction.reservation.payDownPayment']) ? 'active' : '' }}">
                            <div class="nav-icon">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <div class="nav-content">
                                <div class="nav-title">Transactions</div>
                                <div class="nav-subtitle">Bookings & Payments</div>
                            </div>
                        </a>

                        <!-- Room Management -->
                        <div class="nav-item dropdown-nav {{ in_array(Route::currentRouteName(), ['room.index', 'room.show', 'room.create', 'room.edit', 'type.index', 'type.create', 'type.edit', 'roomstatus.index', 'roomstatus.create', 'roomstatus.edit', 'facility.index', 'facility.create', 'facility.edit']) ? 'active' : '' }}">
                            <div class="nav-toggle" data-bs-toggle="collapse" data-bs-target="#mobileRoomSubmenu">
                                <div class="nav-icon">
                                    <i class="fas fa-bed"></i>
                                </div>
                                <div class="nav-content">
                                    <div class="nav-title">Room Management</div>
                                    <div class="nav-subtitle">Rooms, Types & Status</div>
                                </div>
                                <div class="nav-arrow">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                            <div class="collapse {{ in_array(Route::currentRouteName(), ['room.index', 'room.show', 'room.create', 'room.edit', 'type.index', 'type.create', 'type.edit', 'roomstatus.index', 'roomstatus.create', 'roomstatus.edit', 'facility.index', 'facility.create', 'facility.edit']) ? 'show' : '' }} w-100" id="mobileRoomSubmenu">
                                <div class="nav-submenu">
                                    <a href="{{ route('room.index') }}" class="nav-subitem {{ in_array(Route::currentRouteName(), ['room.index', 'room.show', 'room.create', 'room.edit']) ? 'active' : '' }}">
                                        <i class="fas fa-door-open me-2"></i>Rooms
                                    </a>
                                    <a href="{{ route('type.index') }}" class="nav-subitem {{ in_array(Route::currentRouteName(), ['type.index', 'type.create', 'type.edit']) ? 'active' : '' }}">
                                        <i class="fas fa-list me-2"></i>Room Types
                                    </a>
                                    <a href="{{ route('roomstatus.index') }}" class="nav-subitem {{ in_array(Route::currentRouteName(), ['roomstatus.index', 'roomstatus.create', 'roomstatus.edit']) ? 'active' : '' }}">
                                        <i class="fas fa-toggle-on me-2"></i>Room Status
                                    </a>
                                    <a href="{{ route('facility.index') }}" class="nav-subitem {{ in_array(Route::currentRouteName(), ['facility.index', 'facility.create', 'facility.edit']) ? 'active' : '' }}">
                                        <i class="fas fa-concierge-bell me-2"></i>Facilities
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Customer & User Management -->
                        <div class="nav-item dropdown-nav {{ in_array(Route::currentRouteName(), ['customer.index', 'customer.create', 'customer.edit', 'user.index', 'user.create', 'user.edit']) ? 'active' : '' }}">
                            <div class="nav-toggle" data-bs-toggle="collapse" data-bs-target="#mobileUserSubmenu">
                                <div class="nav-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="nav-content">
                                    <div class="nav-title">User Management</div>
                                    <div class="nav-subtitle">Customers & Staff</div>
                                </div>
                                <div class="nav-arrow">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                            <div class="collapse {{ in_array(Route::currentRouteName(), ['customer.index', 'customer.create', 'customer.edit', 'user.index', 'user.create', 'user.edit']) ? 'show' : '' }} w-100" id="mobileUserSubmenu">
                                <div class="nav-submenu">
                                    <a href="{{ route('customer.index') }}" class="nav-subitem {{ in_array(Route::currentRouteName(), ['customer.index', 'customer.create', 'customer.edit']) ? 'active' : '' }}">
                                        <i class="fas fa-user-friends me-2"></i>Customers
                                    </a>
                                    @if (auth()->user()->role == 'Super')
                                        <a href="{{ route('user.index') }}" class="nav-subitem {{ in_array(Route::currentRouteName(), ['user.index', 'user.create', 'user.edit']) ? 'active' : '' }}">
                                            <i class="fas fa-user-cog me-2"></i>Staff Users
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Analytics -->
                    <div class="nav-section">
                        <div class="nav-section-title">Analytics</div>

                        <a href="#" class="nav-item">
                            <div class="nav-icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <div class="nav-content">
                                <div class="nav-title">Reports</div>
                                <div class="nav-subtitle">Financial & Analytics</div>
                            </div>
                        </a>
                    </div>

                    <!-- Administration -->
                    <div class="nav-section">
                        <div class="nav-section-title">Administration</div>

                        <a href="#" class="nav-item">
                            <div class="nav-icon">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <div class="nav-content">
                                <div class="nav-title">Settings</div>
                                <div class="nav-subtitle">System Configuration</div>
                            </div>
                        </a>
                    </div>
                @endif
            </nav>

            <!-- Quick Actions -->
            <div class="sidebar-footer">
                <a href="{{ route('transaction.reservation.createIdentity') }}" class="btn btn-primary w-100 quick-action-btn">
                    <i class="fas fa-plus me-2"></i>
                    New Reservation
                </a>
            </div>
        </div>
    </div>
</div>
