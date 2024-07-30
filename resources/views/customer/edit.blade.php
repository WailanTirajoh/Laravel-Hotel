@extends('template.master')
@section('title', 'Edit Customer')
@section('content')
    <div class="row justify-content-md-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border">
                <div class="card-header">
                    <h2>Edit Customer</h2>
                </div>
                <div class="card-body p-3">
                    <form class="row g-3" method="POST"
                        action="{{ route('customer.update', ['customer' => $customer->id]) }}"  enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="col-md-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ $customer->name }}">
                            @error('name')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" " id=" email"
                                name="email" value="{{ $customer->user->email }}" disabled>
                            @error('email')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="birthdate" class="form-label">Date of birth</label>
                            <input type="date" class="form-control @error('birthdate') is-invalid @enderror" id="birthdate"
                                name="birthdate" value="{{ $customer->birthdate }}">
                            @error('birthdate')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender"
                                aria-label="Default select example">
                                {{-- <option selected hidden>Select</option> --}}
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            @error('gender')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="job" class="form-label">Job</label>
                            <input type="text" class="form-control @error('job') is-invalid @enderror" id="job" name="job"
                                value="{{ $customer->job }}">
                            @error('job')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address"
                                rows="3">{{ $customer->address }}</textarea>
                            @error('address')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-mg-12">
                            <label for="avatar" class="form-label">Profile Picture</label>
                            <input class="form-control" type="file" id="avatar" name="avatar" >
                            @error('avatar')
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

@endsection
