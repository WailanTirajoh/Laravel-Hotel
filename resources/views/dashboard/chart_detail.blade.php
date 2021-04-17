@extends('template.master')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3 class="p-3 text-center">
                Occupied room at {{ Helper::dateFormat($date) }}
            </h3>
        </div>
    </div>
    <div class="row">
        @foreach ($transactions as $transaction)
            <div class="col-md-6">
                <div
                    class="row card g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary">
                            <a class="bg-dark p-3 text-center align-middle text-white" style="border-bottom-right-radius: 1rem"
                                href="{{ route('room.show', ['room' => $transaction->room->id]) }}">
                                {{ $transaction->room->number }}
                            </a>
                        </strong>
                        <div class="p-4">
                            <h3 class="mb-0">
                                <a href="{{ route('customer.show', ['customer' => $transaction->customer->id]) }}">
                                    {{ $transaction->customer->name }}
                                </a>
                            </h3>
                            <div class="mb-1 text-muted">
                                {{ Helper::dateFormat($transaction->check_in) }} -
                                {{ Helper::dateFormat($transaction->check_out) }}
                            </div>
                            <p class="card-text mb-auto">Room Status: {{ $transaction->room->roomStatus->name }}</p>
                        </div>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <img width="200" height="250" src="{{ $transaction->customer->user->getAvatar() }}" alt="">
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-4">
                <div class="card shadow-sm border">
                    <div class="card-body">
                        <a href="{{ route('room.show', ['room' => $transaction->room->id]) }}">
                            {{ $transaction->room->number }}
                        </a>
                        -
                        <a href="{{ route('customer.show', ['customer' => $transaction->customer->id]) }}">
                            {{ $transaction->customer->name }}
                        </a>
                    </div>
                </div>
            </div> --}}
        @endforeach
    </div>
@endsection
