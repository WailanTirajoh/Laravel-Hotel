<div id="sidebar-wrapper" class="lh-sidebar">
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
                    @if (auth()->user()->unreadNotifications()->count() > 0)
                        <span class="notification-badge">{{ auth()->user()->unreadNotifications()->count() }}</span>
                    @endif
                </div>
            </div>
            <div class="notifications-content">
                @forelse (auth()->user()->unreadNotifications()->latest()->limit(3)->get() as $notification)
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

                @if (auth()->user()->unreadNotifications()->count() > 3)
                    <div class="notifications-footer">
                        <a href="{{ route('notification.index') }}" class="view-all-notifications">
                            View all ({{ auth()->user()->unreadNotifications()->count() }})
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
                        <div class="nav-toggle" data-bs-toggle="collapse" data-bs-target="#roomSubmenu">
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
                        <div class="collapse {{ in_array(Route::currentRouteName(), ['room.index', 'room.show', 'room.create', 'room.edit', 'type.index', 'type.create', 'type.edit', 'roomstatus.index', 'roomstatus.create', 'roomstatus.edit', 'facility.index', 'facility.create', 'facility.edit']) ? 'show' : '' }} w-100" id="roomSubmenu">
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
                        <div class="nav-toggle" data-bs-toggle="collapse" data-bs-target="#userSubmenu">
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
                        <div class="collapse {{ in_array(Route::currentRouteName(), ['customer.index', 'customer.create', 'customer.edit', 'user.index', 'user.create', 'user.edit']) ? 'show' : '' }} w-100" id="userSubmenu">
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

    <!-- Mobile Toggle Button -->
    <button class="sidebar-toggle d-lg-none" id="sidebar-toggle">
        <i class="fas fa-bars"></i>
    </button>
</div>

<style>
.lh-sidebar {
    width: 280px;
    background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    z-index: 1000;
    overflow: hidden;
    transition: all 0.3s ease;
}

.sidebar-content {
    display: flex;
    flex-direction: column;
    height: 100%;
    padding: 0;
}

/* Brand Section */
.sidebar-brand {
    display: flex;
    align-items: center;
    padding: 1.5rem 1.25rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    background: rgba(255, 255, 255, 0.05);
}

.brand-logo {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    margin-right: 1rem;
}

.brand-text h4 {
    color: white;
    font-weight: 700;
    font-size: 1.1rem;
}

.brand-text small {
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.75rem;
}

/* User Profile Section */
.sidebar-user {
    display: flex;
    align-items: center;
    padding: 1rem 1.25rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    background: rgba(255, 255, 255, 0.03);
}

.user-avatar img {
    width: 40px;
    height: 40px;
    border: 2px solid rgba(255, 255, 255, 0.2);
}

.user-info {
    margin-left: 0.75rem;
    flex: 1;
}

.user-name {
    color: white;
    font-weight: 600;
    font-size: 0.9rem;
    line-height: 1.2;
}

.user-role {
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.75rem;
}

.user-actions .btn {
    color: rgba(255, 255, 255, 0.6);
    border: none;
    padding: 0.25rem 0.5rem;
}

.user-actions .btn:hover {
    color: white;
    background: rgba(255, 255, 255, 0.1);
}

/* Notifications Section */
.sidebar-notifications {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    background: rgba(255, 255, 255, 0.02);
}

.notifications-header {
    padding: 1rem 1.25rem 0.5rem;
}

.notifications-title {
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.85rem;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.notification-badge {
    background: #ef4444;
    color: white;
    font-size: 0.7rem;
    font-weight: 700;
    padding: 0.125rem 0.375rem;
    border-radius: 10px;
    margin-left: auto;
}

.notifications-content {
    max-height: 200px;
    overflow-y: auto;
}

.notification-item {
    display: flex;
    align-items: flex-start;
    padding: 0.75rem 1.25rem;
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    transition: all 0.3s ease;
    border-left: 3px solid transparent;
}

.notification-item:hover {
    background: rgba(255, 255, 255, 0.05);
    border-left-color: #3b82f6;
    color: white;
    text-decoration: none;
}

.notification-icon {
    width: 24px;
    height: 24px;
    background: rgba(59, 130, 246, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 0.75rem;
    flex-shrink: 0;
    color: #60a5fa;
    font-size: 0.7rem;
}

.notification-text {
    flex: 1;
    min-width: 0;
}

.notification-message {
    font-size: 0.8rem;
    line-height: 1.3;
    margin-bottom: 0.25rem;
    color: rgba(255, 255, 255, 0.9);
}

.notification-time {
    font-size: 0.7rem;
    color: rgba(255, 255, 255, 0.5);
}

.notification-empty {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 1.5rem 1.25rem;
    color: rgba(255, 255, 255, 0.5);
    text-align: center;
}

.notification-empty i {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    opacity: 0.7;
}

.notification-empty span {
    font-size: 0.8rem;
}

.notifications-footer {
    padding: 0.5rem 1.25rem 1rem;
    text-align: center;
}

.view-all-notifications {
    color: #60a5fa;
    font-size: 0.8rem;
    font-weight: 500;
    text-decoration: none;
    transition: color 0.3s ease;
}

.view-all-notifications:hover {
    color: #3b82f6;
    text-decoration: none;
}

/* Scrollbar for notifications */
.notifications-content::-webkit-scrollbar {
    width: 3px;
}

.notifications-content::-webkit-scrollbar-track {
    background: transparent;
}

.notifications-content::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 2px;
}

.notifications-content::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.3);
}

/* Navigation */
.sidebar-nav {
    flex: 1;
    padding: 0.5rem 0;
    overflow-y: auto;
    overflow-x: hidden;
}

/* Scrollbar Styling for Navigation Only */
.sidebar-nav::-webkit-scrollbar {
    width: 4px;
}

.sidebar-nav::-webkit-scrollbar-track {
    background: transparent;
}

.sidebar-nav::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 2px;
}

.sidebar-nav::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.3);
}

.nav-section {
    margin-bottom: 1.5rem;
}

.nav-section-title {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 0.5rem 1.25rem;
    margin-bottom: 0.5rem;
}

.nav-item {
    display: flex;
    align-items: center;
    padding: 0.875rem 1.25rem;
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    transition: all 0.3s ease;
    border-left: 3px solid transparent;
    position: relative;
}
.nav-item:not(.dropdown-nav):hover {
    color: white;
    background: rgba(255, 255, 255, 0.08);
    border-left-color: #3b82f6;
}

.nav-item:not(.dropdown-nav).active {
    color: white;
    background: rgba(59, 130, 246, 0.15);
    border-left-color: #3b82f6;
}

.nav-icon {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 0.875rem;
    font-size: 1rem;
    flex-shrink: 0;
}

.nav-content {
    flex: 1;
    min-width: 0;
}

.nav-title {
    font-weight: 600;
    font-size: 0.9rem;
    line-height: 1.2;
    margin-bottom: 0.125rem;
}

.nav-subtitle {
    font-size: 0.75rem;
    color: rgba(255, 255, 255, 0.5);
    line-height: 1.2;
}

.dropdown-nav {
    display: flex;
    flex-direction: column;
    padding: 0;
}

/* Dropdown Navigation */
.dropdown-nav .nav-toggle {
    display: flex;
    align-items: center;
    padding: 0.875rem 1.25rem;
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    transition: all 0.3s ease;
    border-left: 3px solid transparent;
    cursor: pointer;
    width: 100%;
    background: none;
    border: none;
    text-align: left;
}

.dropdown-nav .nav-toggle:hover {
    color: white;
    background: rgba(255, 255, 255, 0.08);
    border-left-color: #3b82f6;
}

.dropdown-nav.active .nav-toggle {
    color: white;
    background: rgba(59, 130, 246, 0.15);
    border-left-color: #3b82f6;
}

.nav-arrow {
    width: 20px;
    display: flex;
    justify-content: center;
    transition: transform 0.3s ease;
}

.nav-toggle[aria-expanded="true"] .nav-arrow {
    transform: rotate(180deg);
}

.nav-submenu {
    padding: 0.5rem 0;
}

.nav-subitem {
    display: flex;
    align-items: center;
    padding: 0.5rem 1.25rem 0.5rem 3.5rem;
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    font-size: 0.85rem;
    transition: all 0.3s ease;
}

.nav-subitem:hover {
    color: white;
    background: rgba(255, 255, 255, 0.05);
}

.nav-subitem.active {
    color: #3b82f6;
    background: rgba(59, 130, 246, 0.1);
}

/* Sidebar Footer */
.sidebar-footer {
    padding: 1.25rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.quick-action-btn {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

.quick-action-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
}

/* Mobile Toggle */
.sidebar-toggle {
    position: fixed;
    top: 1rem;
    left: 1rem;
    background: #1e293b;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 0.75rem;
    font-size: 1.1rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    z-index: 1001;
}

.lh-sidebar {
    width: var(--bs-offcanvas-width);
}

@media (min-width: 992px) {
    /* body.sidebar-layout {
        margin-left: 280px;
    } */
    .lh-sidebar {
        width: 280px;
    }

    .sidebar-toggle {
        display: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle dropdown toggles and state persistence
    const dropdownToggles = document.querySelectorAll('.nav-toggle[data-bs-toggle="collapse"]');

    dropdownToggles.forEach(toggle => {
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
});
</script>
