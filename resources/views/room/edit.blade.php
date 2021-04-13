@extends('template.master')
@section('title', 'Edit Room')
@section('head')
{{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="{{asset('select2/css/select2.css')}}" rel="stylesheet" />
<script src="{{asset('select2/js/select2.js')}}"></script>
@endsection
@section('content')
<style>
    .select2-container .select2-selection--single {
        height: 34px !important;
    }

    .select2-container--default .select2-selection--single {
        border: 1px solid #ccc !important;
        border-radius: 0px !important;
    }
</style>
<div class="row justify-content-md-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border">
            <div class="card-header">
                <h2>Edit Room</h2>
            </div>
            <div class="card-body p-3">
                <form class="row g-3" method="POST" action="{{route('room.update',['room'=>$room->id])}}">
                    @method('PUT')
                    @csrf
                    <div class="col-md-12">
                        <label for="type_id" class="form-label">Type</label>
                        <select id="type_id" name="type_id" class="form-control select2">
                            @foreach ($types as $type)
                            <option value="{{$type->id}}" @if ($room->type->id == $type->id) selected @endif>{{$type->name}}</option>
                            @endforeach
                        </select>
                        @error('type_id')
                        <div class="text-danger mt-1">
                            {{ $message  }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="room_status_id" class="form-label">Room Status</label>
                        <select id="room_status_id" name="room_status_id" class="form-control select2">
                            @foreach ($roomstatuses as $roomstatus)
                            <option value="{{$roomstatus->id}}" @if ($room->roomstatus->id == $roomstatus->id) selected @endif>{{$roomstatus->name}} ({{$roomstatus->code}})</option>
                            @endforeach
                        </select>
                        @error('room_status_id')
                        <div class="text-danger mt-1">
                            {{ $message  }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="number" class="form-label">Room Number</label>
                        <input room="text" class="form-control @error('number') is-invalid @enderror" id="number"
                            name="number" value="{{$room->number}}" placeholder="ex: 1A">
                        @error('number')
                        <div class="text-danger mt-1">
                            {{ $message  }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="capacity" class="form-label">Capacity</label>
                        <input room="text" class="form-control @error('capacity') is-invalid @enderror" id="capacity"
                            name="capacity" value="{{$room->capacity}}" placeholder="ex: 4">
                        @error('capacity')
                        <div class="text-danger mt-1">
                            {{ $message  }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="price" class="form-label">Price</label>
                        <input room="text" class="form-control @error('price') is-invalid @enderror" id="price"
                            name="price" value="{{$room->price}}" placeholder="ex: 500000">
                        @error('price')
                        <div class="text-danger mt-1">
                            {{ $message  }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="view" class="form-label">View</label>
                        <textarea class="form-control" id="view" name="view" rows="3"
                            placeholder="ex: window see beach">{{$room->view}}</textarea>
                        @error('view')
                        <div class="text-danger mt-1">
                            {{ $message  }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <button room="submit" class="btn btn-light shadow-sm border float-end">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('.select2').select2();
</script>

@endsection
