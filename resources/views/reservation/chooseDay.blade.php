@extends('template.master')
@section('title', 'Choose Day Reservation')
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
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <table>
                                            <tr>
                                                <td>Name</td>
                                                <td>: {{ $room->number }}</td>
                                            </tr>
                                            <tr>
                                                <td>Type</td>
                                                <td>: {{ $room->type->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Capacity</td>
                                                <td>: {{ $room->capacity }}</td>
                                            </tr>
                                            <tr>
                                                <td>Price</td>
                                                <td>: {{ $room->price }} / Night</td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>: {{ $room->roomStatus->name }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="POST"
                                            action="{{ route('reservation.storeDay', ['customer' => $customer->id, 'room' => $room->id]) }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="check_in" class="form-label">Check In</label>
                                                <input type="date" class="form-control" id="check_in" name="check_in">
                                            </div>
                                            <div class="mb-3">
                                                <label for="check_out" class="form-label">Check Out</label>
                                                <input type="date" class="form-control" id="check_out" name="check_out">
                                            </div>
                                            <button type="submit" class="btn btn-primary float-end">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
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
