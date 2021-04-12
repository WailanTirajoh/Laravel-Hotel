@extends('template.master')
@section('title', 'User')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>{{ $user->name }}</h3>
            </div>
            <div class="card-body">
                <div class="row g-0 bg-light position-relative">
                    <div class="col-md-4 mb-md-0 p-md-4">
                        <img src="{{$user->getAvatar()}}" class="w-100" alt="...">
                    </div>
                    <div class="col-md-8 p-4 ps-md-0">
                        <h5 class="mt-0">{{ $user->email }}</h5>
                        <p> {{ $user->role }} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
