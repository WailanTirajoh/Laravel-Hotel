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
                                <form class="row g-3" method="GET" action="{{route('reservation.chooseRoom',['customer'=>$customer->id])}}">
                                    <div class="col-md-12">
                                        <label for="count_person" class="form-label">Count Person</label>
                                        <input type="text"
                                            class="form-control @error('count_person') is-invalid @enderror" " id="
                                            count_person" name="count_person" value="{{ old('count_person') }}">
                                        @error('count_person')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn myBtn shadow-sm border float-end">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
