@extends('template.master')
@section('title', 'Count Person')
@section('head')
    <link rel="stylesheet" href="{{ asset('style/css/progress-indication.css') }}">
@endsection
@section('content')
    @include('reservation.progressbar')
    <div class="container mt-3">
        <div class="row justify-content-md-center">
            <div class="col-lg-12">
                <div class="card shadow-sm border">
                    <div class="card-body p-3">
                        <table>
                            <tr>
                                <td>Customer Name</td>
                                <td>: {{ $customer->name }}</td>
                            </tr>
                            <tr>
                                <td>Customer Job</td>
                                <td>: {{ $customer->job }}</td>
                            </tr>
                        </table>
                        <hr>
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
                                                    <td><span style="
                                                                display:inline-block;
                                                                /* white-space: nowrap; */
                                                                overflow: hidden;
                                                                text-overflow: ellipsis;
                                                                max-width: 1000px;">{{ $room->view }}</span></td>
                                                    <td>
                                                        <a class="btn btn-light btn-sm rounded shadow-sm border"
                                                            href="{{ route('room.edit', ['room' => $room->id]) }}">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
