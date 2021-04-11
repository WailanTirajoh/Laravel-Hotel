@extends('template.master')
@section('title', 'Room')
@section('content')

<div class="row mt-2 mb-2">
    <div class="col-lg-6 mb-2">
        <div class="d-grid gap-2 d-md-block">
            <a href="{{route('room.add')}}" class="btn btn-sm shadow-sm myBtn">
                <svg width="25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="black">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </a>
        </div>
    </div>
    <div class="col-lg-6">
        <form class="d-flex" method="POST" action="/room/search">
            @csrf
            <input class="form-control me-2" room="search" placeholder="Search" aria-label="Search" id="search"
                name="search" value="">
            <button class="btn btn-outline-dark" room="submit">Search</button>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow-sm border">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" style="white-space: nowrap">
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
                                <td scope="row">{{($rooms ->currentpage()-1) * $rooms ->perpage() + $loop->index + 1}}
                                </td>
                                <td>{{$room->number}}</td>
                                <td>{{$room->type->name}}</td>
                                <td>{{$room->capacity}}</td>
                                <td>{{$room->price}}</td>
                                <td>{{$room->view}}</td>
                                <td>
                                    <a class="btn btn-light btn-sm rounded shadow-sm border"
                                        href="{{route('room.edit',['room'=>$room->id])}}">
                                        <svg width="25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <a class="btn btn-light btn-sm rounded shadow-sm border delete"
                                        room-id="{{$room->id}}" room-name="{{$room->number}}"
                                        room-url="{{route('room.destroy',['room'=>$room->id])}}">
                                        <svg width="25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
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
<div class="row justify-content-md-center mt-3">
    <div class="col-sm-10 d-flex justify-content-md-center">
        {{ $rooms->onEachSide(2)->links("pagination::bootstrap-4") }}
    </div>
</div>

@endsection

@section('footer')
<script>
    $('.delete').click(function(){
        var room_id = $(this).attr('room-id');
        var room_name = $(this).attr('room-name');
        var room_url = $(this).attr('room-url');
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "Room number "+room_name+" will be deleted, You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel! ',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = room_url;
            }
        })
    });
</script>
@endsection
