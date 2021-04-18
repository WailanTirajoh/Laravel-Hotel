@extends('template.master')
@section('title', 'Dashboard')
@section('head')
    {{-- <link rel="stylesheet" href="{{ asset('style/css/admin.css') }}"> --}}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6 mb-3">
            <div class="card shadow-sm border">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Guests</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg">Belum</span>
                            <span>Total Guests at {{ Helper::thisMonth() }}</span>
                        </p>
                        {{-- <p class="ml-auto d-flex flex-column text-right">
                            <span class="text-success">
                                <i class="fas fa-arrow-up"></i> Belum
                            </span>
                            <span class="text-muted">Since last month</span>
                        </p> --}}
                    </div>
                    <div class="position-relative mb-4">
                        <canvas this-year="{{ Helper::thisYear() }}" this-month="{{ Helper::thisMonth() }}"
                            id="visitors-chart" height="400" width="100%" class="chartjs-render-monitor"
                            style="display: block; width: 249px; height: 200px;"></canvas>
                    </div>
                    <div class="d-flex flex-row justify-content-between">
                        <span class="mr-2">
                            <i class="fas fa-square text-primary"></i> {{ Helper::thisMonth() }}
                        </span>
                        <span>
                            <i class="fas fa-square text-gray"></i> Last month
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="row mb-3">
                <div class="col-lg-6">
                    <div class="card shadow-sm border" style="border-radius: 0.5rem">
                        <div class="card-body text-center">
                            <h5>Dashboard</h5>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box border -->
                </div>
                <div class="col-lg-6">
                    <div class="card shadow-sm border" style="border-radius: 0.5rem">
                        <div class="card-body">
                            <h5>{{ count($transactions) }} Guests this day</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm border">
                        <div class="card-header">
                            <div class="row ">
                                <div class="col-lg-12 d-flex justify-content-between">
                                    <h3>Guests</h3>
                                    <div>
                                        <a href="#" class="btn btn-tool btn-sm">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <a href="#" class="btn btn-tool btn-sm">
                                            <i class="fas fa-bars"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Room</th>
                                        <th>Day Left</th>
                                        <th>Debt</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($transactions as $transaction)
                                        <tr>
                                            <td>
                                                <img src="{{ $transaction->customer->user->getAvatar() }}"
                                                    class="rounded-circle img-thumbnail" width="40" height="40" alt="">
                                                {{ $transaction->customer->name }}
                                            </td>
                                            <td>{{ $transaction->room->number }}</td>
                                            <td>{{ Helper::getDateDifference(now(), $transaction->check_out) }}
                                                {{ Helper::plural('Day', Helper::getDateDifference(now(), $transaction->check_out)) }}
                                            </td>
                                            <td>
                                                {{ Helper::convertToRupiah($transaction->getTotalPrice($transaction->room->price, $transaction->check_in, $transaction->check_out) - $transaction->getTotalPayment()) }}
                                            </td>
                                            <td>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                There's no data in this table
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="row justify-content-md-center mt-3">
                                <div class="col-sm-10 d-flex mx-auto justify-content-md-center">
                                    <div class="pagination-block">
                                        {{ $transactions->onEachSide(1)->links('template.paginationlinks') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script> --}}
    <canvas id="pieChart"></canvas>
@endsection
@section('footer')
<script src="{{ asset('style/js/jquery.js') }}"></script>
<script src="{{ asset('style/js/chart.min.js') }}"></script>
<script src="{{ asset('style/js/guestsChart.js') }}"></script>
@endsection
