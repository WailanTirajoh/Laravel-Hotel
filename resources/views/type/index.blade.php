@extends('template.master')
@section('title', 'Type')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row mt-2 mb-2">
                <div class="col-lg-6 mb-2">
                    <div class="d-grid gap-2 d-md-block">
                        <a href="{{ route('type.create') }}" class="btn btn-sm shadow-sm myBtn border rounded">
                            <svg width="25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="black">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 mb-2">
                    <form class="d-flex" method="GET" action="{{ route('type.index') }}">
                        <input class="form-control me-2" type="Search by name" placeholder="Search by name"
                            aria-label="Search" id="search" name="search" value="{{ request()->input('search') }}">
                        <button class="btn btn-outline-dark" type="submit">Search</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm border">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" style="">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Information</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($types as $type)
                                            <tr>
                                                <td scope="row">
                                                    {{ ($types->currentpage() - 1) * $types->perpage() + $loop->index + 1 }}
                                                </td>
                                                <td style="white-space: nowrap">{{ $type->name }}</td>
                                                <td><span style="
                                                                    display:inline-block;
                                                                    /* white-space: nowrap; */
                                                                    overflow: hidden;
                                                                    text-overflow: ellipsis;
                                                                    max-width: 1000px;">{{ $type->information }}</span></td>
                                                <td>
                                                    <a class="btn btn-light btn-sm rounded shadow-sm border"
                                                        href="{{ route('type.edit', ['type' => $type->id]) }}">
                                                        <svg width="25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                    <form class="btn btn-sm" method="POST"
                                                        id="delete-type-form-{{ $type->id }}"
                                                        action="{{ route('type.destroy', ['type' => $type->id]) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a class="btn btn-light btn-sm rounded shadow-sm border delete" href="#"
                                                            type-id="{{ $type->id }}" type-role="type"
                                                            type-name="{{ $type->name }}" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Delete Type">
                                                            <svg width="25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </a>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center">
                                                    There's no data in this table
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <h3>Room Type</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center mt-3">
                <div class="col-sm-10 d-flex justify-content-md-center">
                    {{ $types->onEachSide(2)->links('template.paginationlinks') }}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
<script>
    $('.delete').click(function() {
        var type_id = $(this).attr('type-id');
        var type_name = $(this).attr('type-name');
        var type_url = $(this).attr('type-url');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: type_name + " will be deleted, You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel! ',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                id = "#delete-type-form-" + type_id
                console.log(id)
                $(id).submit();
            }
        })
    });

</script>
@endsection
