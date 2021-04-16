@extends('template.master')
@section('title', 'Room')
@section('content')
    <div class="container">

        <div class="card shadow-sm">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-between">
                        <h3>{{ $room->number }} - {{ $room->type->name }}</h3>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Upload Image
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Upload Image</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('image.create', ['room' => $room->id]) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control" name="image" id="inputGroupFile02">
                                                <button class="input-group-text" type="submit"
                                                    for="inputGroupFile02">Upload</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach ($roomimages as $image)
                        <div class="col">
                            <div class="card shadow-sm">
                                <img src="{{ $image->getRoomImage() }}" alt="">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                            <form action="{{ route('image.destroy', ['image' => $image->id]) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-secondary">Delete</button>
                                            </form>
                                        </div>
                                        <small class="text-muted">{{ $image->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @error('image')
        <script>
            toastr.error("{{ $message }}", "Failed");

        </script>
    @enderror
@endsection
