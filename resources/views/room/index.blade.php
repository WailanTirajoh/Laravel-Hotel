@extends('template.master')
@section('title', 'Room')
@section('head')
    <style>
        .text {
            display: block;
            width: 150px;
            height: 100px;
            overflow: hidden;
            /* white-space: nowrap; */
            text-overflow: ellipsis;
        }
    </style>
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="row mt-2 mb-2">
                <div class="col-lg-6 mb-2">
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
                <div class="col-lg-6 mb-2">
                    <form class="d-flex" method="GET" action="{{ route('room.index') }}">
                        <input class="form-control me-2" room="search" placeholder="Search by number" aria-label="Search"
                            id="search" name="search" value="{{ request()->input('search') }}">
                        <button class="btn btn-outline-dark" room="submit">Search</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm border">
                        <div class="card-body">
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
                                        {{-- @forelse ($rooms as $room)
                                            <tr>
                                                <td>{{ $room->number }}</td>
                                                <td>{{ $room->type->name }}</td>
                                                <td>{{ $room->capacity }}</td>
                                                <td>{{ Helper::convertToRupiah($room->price) }}</td>
                                                <td>{{ $room->roomStatus->name }}</td>
                                                <td>
                                                    <button class="btn btn-light btn-sm rounded shadow-sm border"
                                                        data-action="edit-room" data-room-id="{{ $room->id }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit room">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form class="btn btn-sm delete-room" method="POST"
                                                        id="delete-room-form-{{ $room->id }}"
                                                        action="{{ route('room.destroy', ['room' => $room->id]) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a class="btn btn-light btn-sm rounded shadow-sm border delete"
                                                            href="#" room-id="{{ $room->id }}" room-role="room"
                                                            room-name="{{ $room->name }}" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Delete room">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </form>
                                                    <a class="btn btn-light btn-sm rounded shadow-sm border"
                                                        href="{{ route('room.show', ['room' => $room->id]) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Room detail">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center">
                                                    There's no data in this table
                                                </td>
                                            </tr>
                                        @endforelse --}}
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

@section('footer')
    <script>
        $(function() {
            const datatable = $("#room-table").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: `/room`,
                    type: 'GET',
                    error: function(xhr, status, error) {

                    }
                },
                "columns": [{
                        "name": "number",
                        "data": "number"
                    },
                    {
                        "name": "type",
                        "data": "type"
                    },
                    {
                        "name": "capacity",
                        "data": "capacity"
                    },
                    {
                        "name": "price",
                        "data": "price",
                        "render": function(price) {
                            return `<div>${new Intl.NumberFormat().format(price)}</div>`
                        }
                    },
                    {
                        "name": "status",
                        "data": "status"
                    },
                    {
                        "name": "id",
                        "data": "id",
                        "render": function(roomId) {
                            return `
                                <button class="btn btn-light btn-sm rounded shadow-sm border"
                                    data-action="edit-room" data-room-id="${roomId}"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit room">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form class="btn btn-sm delete-room" method="POST"
                                    id="delete-room-form-${roomId}"
                                    action="/room/${roomId}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-light btn-sm rounded shadow-sm border delete"
                                        href="#" room-id="${roomId}" room-role="room" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Delete room">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </form>
                                <a class="btn btn-light btn-sm rounded shadow-sm border"
                                    href="/room/${roomId}"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Room detail">
                                    <i class="fas fa-info-circle"></i>
                                </a>

                            `
                        }
                    }
                ]
            });

            const modal = new bootstrap.Modal($("#main-modal"), {
                backdrop: true,
                keyboard: true,
                focus: true
            })

            $(document).on('click', '.delete', function() {
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
                    text: "Room will be deleted, You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel! ',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(`#delete-room-form-${room_id}`).submit();
                    }
                })
            }).on('click', '#add-button', async function() {
                modal.show()

                $('#main-modal .modal-body').html(`Fetching data`)

                const response = await $.get(`/room/create`);
                if (!response) return

                $('#main-modal .modal-title').text('Create new room')
                $('#main-modal .modal-body').html(response.view)
                $('.select2').select2();
            }).on('click', '#btn-modal-save', function() {
                $('#form-save-room').submit()
            }).on('submit', '#form-save-room', async function(e) {
                e.preventDefault();
                CustomHelper.clearError()
                $('#btn-modal-save').attr('disabled', true)
                try {
                    const response = await $.ajax({
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        method: $(this).attr('method'),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    })

                    if (!response) return

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    })

                    modal.hide()
                    datatable.ajax.reload()
                } catch (e) {
                    if (e.status === 422) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: e.responseJSON.message,
                        })
                        CustomHelper.errorHandlerForm(e)
                    }
                } finally {
                    $('#btn-modal-save').attr('disabled', false)
                }
            }).on('click', '[data-action="edit-room"]', async function() {
                modal.show()

                $('#main-modal .modal-body').html(`Fetching data`)

                const roomId = $(this).data('room-id')

                const response = await $.get(`/room/${roomId}/edit`);
                if (!response) return

                $('#main-modal .modal-title').text('Edit room')
                $('#main-modal .modal-body').html(response.view)
                $('.select2').select2();
            }).on('submit', '.delete-room', async function(e) {
                e.preventDefault()

                try {
                    const response = await $.ajax({
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        method: $(this).attr('method'),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    })

                    if (!response) return

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    })

                    datatable.ajax.reload()
                } catch (e) {

                }
            })
        });
    </script>
@endsection
