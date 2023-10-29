@extends('template.master')
@section('title', 'Room')
@section('head')
    <style>
        .text {
            display: block;
            width: 150px;
            height: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row mt-2 mb-2">
                <div class="col-lg-12 mb-2">
                    <div class="d-grid gap-2 d-md-block">
                        <button id="add-button" type="button" class="btn btn-sm shadow-sm myBtn border rounded">
                            <svg width="25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="black">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm border">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select id="status" class="form-select" aria-label="Choose status">
                                            <option selected>All</option>
                                            @forelse ($roomStatuses as $roomStatus)
                                                <option value="{{ $roomStatus->id }}">{{ $roomStatus->name }}</option>
                                            @empty
                                                <option value="">No room status</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="mb-3">
                                        <label for="type" class="form-label">Type</label>
                                        <select id="type" class="form-select" aria-label="Choose type">
                                            <option selected>All</option>
                                            @forelse ($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @empty
                                                <option value="">No type</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <hr>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="room-table" class="table table-sm table-hover" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">Number</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Capacity</th>
                                            <th scope="col">Price / Day</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <h3>Room</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
