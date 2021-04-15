@extends('template.master')
@section('title', 'Dashboard')
@section('head')
    {{-- <link rel="stylesheet" href="{{ asset('style/css/admin.css') }}"> --}}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Online Store Visitors</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg">820</span>
                            <span>Visitors Over Time</span>
                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
                            <span class="text-success">
                                <i class="fas fa-arrow-up"></i> 12.5%
                            </span>
                            <span class="text-muted">Since last week</span>
                        </p>
                    </div>
                    <div class="position-relative mb-4">
                        <canvas id="visitors-chart" height="400" width="100%" class="chartjs-render-monitor"
                            style="display: block; width: 249px; height: 200px;"></canvas>
                    </div>
                    <div class="d-flex flex-row justify-content-between">
                        <span class="mr-2">
                            <i class="fas fa-square text-primary"></i> This Week
                        </span>
                        <span>
                            <i class="fas fa-square text-gray"></i> Last Week
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12">
                    {{-- <h1 class="text-center">Dashboard</h1> --}}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-6">
                    <div class="card border shadow-sm" style="border-radius: 0.5rem">
                        <div class="card-body text-center">
                            <h5>Dashboard</h5>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box border -->
                </div>
                <div class="col-lg-6">

                    <div class="card border shadow-sm" style="border-radius: 0.5rem">
                        <div class="card-body">
                            <h5>Guests {{ count($transactions) }}</h5>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box border -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
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
                                        <th>Price</th>
                                        <th>Debt</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>
                                                <img src="{{ $transaction->customer->user->getAvatar() }}"
                                                    class="rounded-circle border-sm" width="40" height="40" alt="">
                                                {{ $transaction->customer->name }}
                                            </td>
                                            <td>{{ $transaction->room->number }}</td>
                                            <td>{{ getDateDifference(now(), $transaction->check_out) }}
                                                {{ plural('Day', getDateDifference(now(), $transaction->check_out)) }}
                                            </td>
                                            <td>{{ $transaction->getTotalPayment($transaction->room->price, $transaction->check_in, $transaction->check_out) }}
                                            </td>
                                            <td>

                                            </td>
                                            <td>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('footer')
    <script src="{{ asset('style/js/jquery.js') }}"></script>
    <script src="{{ asset('style/js/chart.min.js') }}"></script>
    <script>
        /* global Chart:false */

        $(function() {
            'use strict'

            var ticksStyle = {
                fontColor: '#495057',
                fontStyle: 'bold'
            }

            var mode = 'index'
            var intersect = true

            var $salesChart = $('#sales-chart')
            // eslint-disable-next-line no-unused-vars
            var salesChart = new Chart($salesChart, {
                type: 'bar',
                data: {
                    labels: ['JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
                    datasets: [{
                            backgroundColor: '#007bff',
                            borderColor: '#007bff',
                            data: [1000, 2000, 3000, 2500, 2700, 2500, 3000]
                        },
                        {
                            backgroundColor: '#ced4da',
                            borderColor: '#ced4da',
                            data: [700, 1700, 2700, 2000, 1800, 1500, 2000]
                        }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            // display: false,
                            gridLines: {
                                display: true,
                                lineWidth: '4px',
                                color: 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks: $.extend({
                                beginAtZero: true,

                                // Include a dollar sign in the ticks
                                callback: function(value) {
                                    if (value >= 1000) {
                                        value /= 1000
                                        value += 'k'
                                    }

                                    return '$' + value
                                }
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            })

            var $visitorsChart = $('#visitors-chart')
            // eslint-disable-next-line no-unused-vars
            var visitorsChart = new Chart($visitorsChart, {
                data: {
                    labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
                    datasets: [{
                            type: 'line',
                            data: [100, 120, 170, 167, 180, 177, 160],
                            backgroundColor: 'transparent',
                            borderColor: '#007bff',
                            pointBorderColor: '#007bff',
                            pointBackgroundColor: '#007bff',
                            fill: false
                            // pointHoverBackgroundColor: '#007bff',
                            // pointHoverBorderColor    : '#007bff'
                        },
                        {
                            type: 'line',
                            data: [60, 80, 70, 67, 80, 77, 100],
                            backgroundColor: 'tansparent',
                            borderColor: '#ced4da',
                            pointBorderColor: '#ced4da',
                            pointBackgroundColor: '#ced4da',
                            fill: false
                            // pointHoverBackgroundColor: '#ced4da',
                            // pointHoverBorderColor    : '#ced4da'
                        }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            // display: false,
                            gridLines: {
                                display: true,
                                lineWidth: '4px',
                                color: 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks: $.extend({
                                beginAtZero: true,
                                suggestedMax: 200
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            })
        })

    </script>
@endsection
