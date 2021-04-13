@extends('template.master')
@section('title', 'Choose Room Reservation')
@section('head')
    <link rel="stylesheet" href="{{ asset('style/css/progress-indication.css') }}">
@endsection
@section('content')
    @include('reservation.progressbar')
    <div class="container mt-3">
        <div class="row justify-content-md-center">
            <div class="col-sm-8 mt-2">
                <div class="card shadow-sm border">
                    <div class="card-body p-3">
                        <h2>Choose a room:</h2>
                        <hr>
                        @if (count($rooms) == 0)
                            <h3>Theres no available room for {{ request()->input('count_person') }} or more person</h3>
                        @else
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Number</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Capacity</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">View</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($rooms as $room)
                                                    <tr>
                                                        <td scope="row">
                                                            {{ $loop->iteration }}
                                                        </td>
                                                        <td>{{ $room->number }}</td>
                                                        <td>{{ $room->type->name }}</td>
                                                        <td>{{ $room->capacity }}</td>
                                                        <td>{{ $room->price }}</td>
                                                        <td>{{ $room->roomStatus->name }}</td>
                                                        <td><span
                                                                style="
                                                                                                    display:inline-block;
                                                                                                    /* white-space: nowrap; */
                                                                                                    overflow: hidden;
                                                                                                    text-overflow: ellipsis;
                                                                                                    max-width: 1000px;">{{ $room->view }}</span>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-light btn-sm rounded shadow-sm border"
                                                                href="{{ route('reservation.chooseDay', ['customer' => $customer->id, 'room' => $room->id]) }}">
                                                                Choose
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mt-2">
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
