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
                        <h2>{{ $roomsCount }} Room Available for:</h2>
                        <p>{{ request()->input('count_person') }}
                            {{ Helper::plural('People', request()->input('count_person')) }} on
                            {{ Helper::dateFormat(request()->input('check_in')) }} to
                            {{ Helper::dateFormat(request()->input('check_out')) }}</p>
                        <hr>
                        <form method="GET"
                            action="{{ route('transaction.reservation.chooseRoom', ['customer' => $customer->id]) }}">
                            <div class="row mb-2">
                                <input type="text" hidden name="count_person"
                                    value="{{ request()->input('count_person') }}">
                                <input type="date" hidden name="check_in" value="{{ request()->input('check_in') }}">
                                <input type="date" hidden name="check_out" value="{{ request()->input('check_out') }}">
                                <div class="col-lg-6">
                                    <select class="form-select" id="sort_name" name="sort_name"
                                        aria-label="Default select example">
                                        <option value="Price" @if (request()->input('sort_name') == 'Price') selected @endif>Price</option>
                                        <option value="Number" @if (request()->input('sort_name') == 'Number') selected @endif>Number</option>
                                        <option value="Capacity" @if (request()->input('sort_name') == 'Capacity') selected @endif>Capacity</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <select class="form-select" id="sort_type" name="sort_type"
                                        aria-label="Default select example">
                                        <option value="ASC" @if (request()->input('sort_type') == 'ASC') selected @endif>Ascending</option>
                                        <option value="DESC" @if (request()->input('sort_type') == 'DESC') selected @endif>Descending</option>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <button type="submit" class="btn myBtn shadow-sm border w-100">Search</button>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            @forelse ($rooms as $room)
                                <div class="col-lg-12">
                                    <div
                                        class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                        <div class="col p-4 d-flex flex-column position-static">
                                            <strong class="d-inline-block mb-2 text-secondary">{{ $room->capacity }}
                                                {{ Str::plural('Person', $room->capacity) }}</strong>
                                            <h3 class="mb-0">{{ $room->number }} ~ {{ $room->type->name }}</h3>
                                            <div class="mb-1 text-muted">{{ Helper::convertToRupiah($room->price) }} /
                                                Day
                                            </div>
                                            <div class="wrapper">
                                                <p class="card-text mb-auto demo-1">{{ $room->view }}</p>
                                            </div>
                                            <a href="{{ route('transaction.reservation.confirmation', ['customer' => $customer->id, 'room' => $room->id, 'from' => request()->input('check_in'), 'to' => request()->input('check_out')]) }}"
                                                class="btn myBtn shadow-sm border w-100 m-2">Choose</a>
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
                        <div class="row">
                            <div class="col-lg-12">
                                {{ $rooms->onEachSide(1)->appends([
        'count_person' => request()->input('count_person'),
        'check_in' => request()->input('check_in'),
        'check_out' => request()->input('check_out'),
        'sort_name' => request()->input('sort_name'),
        'sort_type' => request()->input('sort_type'),
    ])->links('template.paginationlinks') }}
                            </div>
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
