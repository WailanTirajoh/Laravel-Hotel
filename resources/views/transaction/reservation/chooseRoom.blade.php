@extends('template.master')
@section('title', 'Choose Room Reservation')
@section('head')
    <link rel="stylesheet" href="{{ asset('style/css/progress-indication.css') }}">
    <style>
        .wrapper {
            max-width: 400px;
        }

        .demo-1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

    </style>
@endsection
@section('content')
    @include('transaction.reservation.progressbar')
    <div class="container mt-3">
        <div class="row justify-content-md-center">
            <div class="col-md-8 mt-2">
                <div class="card shadow-sm border">
                    <div class="card-body p-3">
                        <h2>{{ count($rooms) }} Room Available for:</h2>
                        <p>{{ request()->input('count_person') }}
                            {{ Helper::plural('People', request()->input('count_person')) }} |
                            {{ Helper::dateFormat(request()->input('check_in')) }} ~
                            {{ Helper::dateFormat(request()->input('check_out')) }}</p>
                        <hr>
                        <div class="row">
                            @forelse ($rooms as $room)
                                <div class="col-lg-12">
                                    <div
                                        class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                        <div class="col p-4 d-flex flex-column position-static">
                                            <strong
                                                class="d-inline-block mb-2 text-secondary">{{ $room->roomStatus->name }}</strong>
                                            <h3 class="mb-0">{{ $room->type->name }} ~ {{ $room->number }}</h3>
                                            <div class="mb-1 text-muted">{{ Helper::convertToRupiah($room->price) }}
                                            </div>
                                            <div class="wrapper">
                                                <p class="card-text mb-auto demo-1">{{ $room->view }}</p>
                                            </div>
                                            <a href="{{ route('transaction.reservation.confirmation', ['customer' => $customer->id, 'room' => $room->id, 'from' => request()->input('check_in'), 'to' => request()->input('check_out')]) }}"
                                                class="">Choose</a>
                                        </div>
                                        <div class="col-auto d-none d-lg-block">
                                            <img src="{{ $room->firstImage() }}" width="200" height="250" alt="">
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h3>Theres no available room for {{ request()->input('count_person') }} or more
                                    person
                                </h3>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-2">
                <div class="card shadow-sm">
                    <img src="{{ $customer->user->getAvatar() }}"
                        style="border-top-right-radius: 0.5rem; border-top-left-radius: 0.5rem">
                    <div class="card-body">
                        <table>
                            <tr>
                                <td style="text-align: center; width:50px">
                                    <span>
                                        <i class="fas {{ $customer->gender == 'Male' ? 'fa-male' : 'fa-female' }}">
                                        </i>
                                    </span>
                                </td>
                                <td>
                                    {{ $customer->name }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; ">
                                    <span>
                                        <i class="fas fa-user-md"></i>
                                    </span>
                                </td>
                                <td>{{ $customer->job }}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; ">
                                    <span>
                                        <i class="fas fa-birthday-cake"></i>
                                    </span>
                                </td>
                                <td>
                                    {{ $customer->birthdate }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; ">
                                    <span>
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                </td>
                                <td>
                                    {{ $customer->address }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
