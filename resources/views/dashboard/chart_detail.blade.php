@extends('template.master')
@section('title', 'Dashboard')
@section('head')
    {{-- <link rel="stylesheet" href="{{ asset('style/css/admin.css') }}"> --}}
@endsection
@section('content')
<div class="row">
    @foreach ($transactions as $transaction)
    <div class="col-lg-4">
        <div class="card shadow-sm border">
            <div class="card-body">
                {{$transaction->room->number}} - {{$transaction->customer->name}}
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
