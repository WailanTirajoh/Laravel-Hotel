@extends('template.master')
@section('title', 'Dashboard')
@section('content')
    <div id="dashboard" class="fade-in">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 text-gradient mb-1">Welcome back, {{ auth()->user()->name }}!</h1>
                        <p class="text-muted mb-0">Here's what's happening at your hotel today</p>
                    </div>
                    <div class="text-end">
                        <div class="text-muted small">{{ now()->format('l, F j, Y') }}</div>
                        <div class="fw-bold">{{ now()->format('g:i A') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats h-100">
                    <div class="card-body text-center">
                        <div class="stats-number">{{ count($transactions) }}</div>
                        <div class="stats-label">
                            <i class="fas fa-users me-2"></i>
                            Guests Today
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats card-stats-success h-100">
                    <div class="card-body text-center">
                        <div class="stats-number">
                            {{-- TODO: get completed today bookings --}} 0
                        </div>
                        <div class="stats-label">
                            <i class="fas fa-check-circle me-2"></i>
                            Completed Bookings
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats card-stats-warning h-100">
                    <div class="card-body text-center">
                        <div class="stats-number">
                            {{ $transactions->filter(function($t) { return $t->getTotalPrice() - $t->getTotalPayment() > 0; })->count() }}
                        </div>
                        <div class="stats-label">
                            <i class="fas fa-clock me-2"></i>
                            Pending Payments
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats card-stats-danger h-100">
                    <div class="card-body text-center">
                        <div class="stats-number">
                            {{ $transactions->filter(function($t) {
                                return Helper::getDateDifference(now(), $t->check_out) < 1 &&
                                       $t->getTotalPrice() - $t->getTotalPayment() > 0;
                            })->count() }}
                        </div>
                        <div class="stats-label">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Urgent Payments
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Today's Guests Table -->
            <div class="col-lg-8 mb-4">
                <div class="card card-lh h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 fw-bold">
                                <i class="fas fa-calendar-day text-primary me-2"></i>
                                Today's Guests
                            </h5>
                            <small class="text-muted">Current hotel occupancy - {{ now()->format('l, F j, Y') }}</small>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" title="Export">
                                <i class="fas fa-download"></i>
                            </button>
                            <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" title="Refresh">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive" style="max-width: calc(100vw - 100px)">
                            <table class="table table-lh mb-0">
                                <thead>
                                    <tr>
                                        <th>Guest</th>
                                        <th>Room</th>
                                        <th>Check-in/Out</th>
                                        <th>Days Left</th>
                                        <th>Balance</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($transactions as $transaction)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $transaction->customer->user->getAvatar() }}"
                                                        class="rounded-circle me-3" width="40" height="40" alt="">
                                                    <div>
                                                        <div class="fw-medium">
                                                            <a href="{{ route('customer.show', ['customer' => $transaction->customer->id]) }}"
                                                               class="text-decoration-none">
                                                                {{ $transaction->customer->name }}
                                                            </a>
                                                        </div>
                                                        <div class="text-muted small">ID: {{ $transaction->customer->id }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="fw-medium">
                                                    <a href="{{ route('room.show', ['room' => $transaction->room->id]) }}"
                                                       class="text-decoration-none">
                                                        Room {{ $transaction->room->number }}
                                                    </a>
                                                </div>
                                                <div class="text-muted small">{{ $transaction->room->type->name ?? 'Standard' }}</div>
                                            </td>
                                            <td>
                                                <div class="small">
                                                    <div><strong>In:</strong> {{ Helper::dateFormat($transaction->check_in) }}</div>
                                                    <div><strong>Out:</strong> {{ Helper::dateFormat($transaction->check_out) }}</div>
                                                </div>
                                            </td>
                                            <td>
                                                @php
                                                    $daysLeft = Helper::getDateDifference(now(), $transaction->check_out);
                                                @endphp
                                                <span class="badge {{ $daysLeft <= 0 ? 'bg-danger' : ($daysLeft <= 1 ? 'bg-warning' : 'bg-success') }} badge-lh">
                                                    {{ $daysLeft == 0 ? 'Last Day' : $daysLeft . ' ' . Helper::plural('Day', $daysLeft) }}
                                                </span>
                                            </td>
                                            <td>
                                                @php
                                                    $balance = $transaction->getTotalPrice() - $transaction->getTotalPayment();
                                                @endphp
                                                @if($balance <= 0)
                                                    <span class="text-success fw-medium">Paid</span>
                                                @else
                                                    <span class="text-danger fw-medium">{{ Helper::convertToRupiah($balance) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column gap-1">
                                                    <span class="badge {{ $transaction->getTotalPrice() - $transaction->getTotalPayment() == 0 ? 'bg-success' : 'bg-warning' }} badge-lh">
                                                        {{ $transaction->getTotalPrice() - $transaction->getTotalPayment() == 0 ? 'Completed' : 'In Progress' }}
                                                    </span>
                                                    @if (Helper::getDateDifference(now(), $transaction->check_out) < 1 && $transaction->getTotalPrice() - $transaction->getTotalPayment() > 0)
                                                        <span class="badge bg-danger badge-lh">
                                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                                            Urgent
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5">
                                                <div class="text-muted">
                                                    <i class="fas fa-bed mb-3" style="font-size: 3rem; opacity: 0.3;"></i>
                                                    <p class="mb-0">No guests checked in today</p>
                                                    <small>Your hotel is ready for new bookings!</small>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Chart -->
            <div class="col-lg-4 mb-4">
                <div class="card card-lh h-100">
                    <div class="card-header">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-chart-line text-primary me-2"></i>
                            Monthly Guests
                        </h5>
                        <small class="text-muted">Guest statistics for {{ Helper::thisMonth() }}/{{ Helper::thisYear() }}</small>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="text-center">
                                    <div class="h2 text-primary mb-0">{{ count($transactions) }}</div>
                                    <small class="text-muted">Total Guests This Month</small>
                                </div>
                            </div>
                        </div>

                        <div class="position-relative mb-4">
                            <canvas this-year="{{ Helper::thisYear() }}" this-month="{{ Helper::thisMonth() }}"
                                    id="visitors-chart" height="200" width="100%" class="chartjs-render-monitor"></canvas>
                        </div>

                        <div class="d-flex justify-content-between text-center">
                            <div class="flex-fill">
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <div class="bg-primary rounded me-2" style="width: 12px; height: 12px;"></div>
                                    <small class="text-muted">This Month</small>
                                </div>
                            </div>
                            <div class="flex-fill">
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <div class="bg-secondary rounded me-2" style="width: 12px; height: 12px;"></div>
                                    <small class="text-muted">Last Month</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row">
            <div class="col-12">
                <div class="card card-lh">
                    <div class="card-header">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-bolt text-warning me-2"></i>
                            Quick Actions
                        </h5>
                        <small class="text-muted">Common tasks and shortcuts</small>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 mb-3">
                                <a href="{{ route('transaction.reservation.createIdentity') }}"
                                   class="btn btn-hotel-primary btn-lh w-100 h-100 d-flex flex-column align-items-center justify-content-center"
                                   style="min-height: 80px;">
                                    <i class="fas fa-plus-circle mb-2" style="font-size: 1.5rem;"></i>
                                    <span>New Reservation</span>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <a href="{{ route('customer.index') }}"
                                   class="btn btn-hotel-success btn-lh w-100 h-100 d-flex flex-column align-items-center justify-content-center"
                                   style="min-height: 80px;">
                                    <i class="fas fa-users mb-2" style="font-size: 1.5rem;"></i>
                                    <span>Manage Customers</span>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <a href="{{ route('room.index') }}"
                                   class="btn btn-outline-primary btn-lh w-100 h-100 d-flex flex-column align-items-center justify-content-center"
                                   style="min-height: 80px;">
                                    <i class="fas fa-bed mb-2" style="font-size: 1.5rem;"></i>
                                    <span>Room Management</span>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <a href="{{ route('payment.index') }}"
                                   class="btn btn-outline-secondary btn-lh w-100 h-100 d-flex flex-column align-items-center justify-content-center"
                                   style="min-height: 80px;">
                                    <i class="fas fa-credit-card mb-2" style="font-size: 1.5rem;"></i>
                                    <span>Payment History</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @section('footer')
    <script src="{{ asset('style/js/chart.min.js') }}"></script>
    <script src="{{ asset('style/js/guestsChart.js') }}"></script>
    <script>
        function reloadJs(src) {
            src = $('script[src$="' + src + '"]').attr("src");
            $('script[src$="' + src + '"]').remove();
            $('<script/>').attr('src', src).appendTo('head');
        }

        Echo.channel('dashboard')
            .listen('.dashboard.event', (e) => {
                $("#dashboard").hide()
                $("#dashboard").load(window.location.href + " #dashboard");
                $("#dashboard").show(150)
                reloadJs('style/js/guestsChart.js');
                toastr.warning(e.message, "Hello, {{ auth()->user()->name }}");
            })
    </script>
@endsection --}}
