<nav class="navbar navbar-expand navbar-lh px-3 fixed-top" style="height: 65px">
    <div class="container-fluid">
        <!-- Menu Toggle -->
        <div id="menu-toggle" class="btn btn-outline-secondary d-flex justify-content-center align-items-center me-3"
            style="width: 2.5rem; height: 2.5rem; border-radius: 8px;">
            <i class="fa fa-bars"></i>
        </div>

        <!-- Brand -->
        <div class="navbar-brand fw-bold text-gradient me-auto">
            <i class="fas fa-hotel me-2"></i>
            Hotel Admin
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="ms-auto d-flex align-items-center">

                <!-- Quick Actions (New) -->
                <div class="btn-group me-3" role="group">
                    <button type="button" class="btn btn-hotel-primary btn-sm" data-bs-toggle="tooltip" title="New Reservation">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" title="Search">
                        <i class="fas fa-search"></i>
                    </button>
                </div>

                <!-- Notifications -->
                <div class="dropdown me-3" id="refreshThisDropdown">
                    <div class="dropdown-toggle btn btn-outline-secondary position-relative"
                         id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false"
                         style="border-radius: 8px; padding: 0.5rem 0.75rem;">
                        <i class="fas fa-bell"></i>
                        @if (auth()->user()->unreadNotifications->count() > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ auth()->user()->unreadNotifications->count() }}
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        @endif
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="dropdownMenuButton2" style="width: 320px;">
                        <li class="dropdown-header d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Notifications</span>
                            @if (auth()->user()->unreadNotifications->count() > 0)
                                <span class="badge bg-primary">{{ auth()->user()->unreadNotifications->count() }} new</span>
                            @endif
                        </li>
                        <li><hr class="dropdown-divider"></li>

                        <div style="max-height: 300px; overflow-y: auto;">
                            @forelse (auth()->user()->unreadNotifications->take(5) as $notification)
                                <li>
                                    <a class="dropdown-item py-3 border-bottom"
                                       href="{{ route('notification.routeTo', ['id' => $notification->id]) }}">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                                     style="width: 32px; height: 32px;">
                                                    <i class="fa fa-bell text-white" style="font-size: 0.75rem;"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="mb-1 fw-medium">{{ $notification->data['message'] ?? 'New notification' }}</p>
                                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li>
                                    <div class="dropdown-item-text text-center py-4">
                                        <i class="fas fa-bell-slash text-muted mb-2" style="font-size: 2rem;"></i>
                                        <p class="text-muted mb-0">No new notifications</p>
                                    </div>
                                </li>
                            @endforelse
                        </div>

                        @if (auth()->user()->unreadNotifications->count() > 0)
                            <li><hr class="dropdown-divider"></li>
                            <li class="d-flex justify-content-between px-3 py-2">
                                <a href="{{ route('notification.markAllAsRead') }}" class="btn btn-sm btn-outline-primary">
                                    Mark all read
                                </a>
                                <a href="{{ route('notification.index') }}" class="btn btn-sm btn-primary">
                                    View All
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

                <!-- User Profile -->
                <div class="dropdown">
                    <div class="dropdown-toggle d-flex align-items-center" id="dropdownMenuButton1"
                         data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                        <img src="{{ auth()->user()->getAvatar() }}"
                             class="rounded-circle me-2"
                             width="32" height="32" alt="Profile">
                        <div class="d-none d-md-block text-start">
                            <div class="fw-medium" style="font-size: 0.875rem;">{{ auth()->user()->name }}</div>
                            <div class="text-muted" style="font-size: 0.75rem;">{{ auth()->user()->role }}</div>
                        </div>
                        <i class="fas fa-chevron-down ms-2 text-muted" style="font-size: 0.75rem;"></i>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="dropdownMenuButton1">
                        <li class="dropdown-header">
                            <div class="d-flex align-items-center">
                                <img src="{{ auth()->user()->getAvatar() }}"
                                     class="rounded-circle me-3"
                                     width="40" height="40" alt="Profile">
                                <div>
                                    <div class="fw-medium">{{ auth()->user()->name }}</div>
                                    <div class="text-muted small">{{ auth()->user()->email }}</div>
                                </div>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                               href="{{ route('user.show', ['user' => auth()->user()->id]) }}">
                                <i class="fas fa-user me-3 text-primary"></i>
                                View Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                               href="{{ route('activity-log.index') }}">
                                <i class="fas fa-history me-3 text-info"></i>
                                Activity Log
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="fas fa-cog me-3 text-secondary"></i>
                                Settings
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="/logout" method="POST" class="mb-0">
                                @csrf
                                <button class="dropdown-item d-flex align-items-center text-danger" type="submit">
                                    <i class="fas fa-sign-out-alt me-3"></i>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
