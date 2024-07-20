@extends('template.master')
@section('title', 'Create Identity')
@section('head')
    <link rel="stylesheet" href="{{ asset('style/css/progress-indication.css') }}">
@endsection
@section('content')
    @include('transaction.reservation.progressbar')
    <div class="container mt-3">
        <div class="row justify-content-md-center">
            <div class="col-lg-12">
                <div class="card shadow-sm border">
                    <div class="card-header">
                        <h2>Crear Cliente</h2>
                    </div>
                    <div class="card-body p-3">
                        <form class="row g-3" method="POST" action="{{ route('transaction.reservation.storeCustomer') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="email" class="form-label">Correo</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" " id=" email"
                                    name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="birthdate" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control @error('birthdate') is-invalid @enderror"
                                    id="birthdate" name="birthdate" value="{{ old('birthdate') }}">
                                @error('birthdate')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="gender" class="form-label">Género</label>
                                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" aria-label="Default select example">
                                    {{-- <option selected hidden>Select</option> --}}
                                    <option value="Male">Masculino</option>
                                    <option value="Female">Femenino</option>
                                </select>
                                @error('gender')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="job" class="form-label">Trabajo</label>
                                <input type="text" class="form-control @error('job') is-invalid @enderror" id="job"
                                    name="job" value="{{ old('job') }}">
                                @error('job')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="address" class="form-label">Direccion</label>
                                <textarea class="form-control" id="address" name="address"
                                    rows="3">{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-mg-12">
                                <label for="avatar" class="form-label">Foto de Perfil</label>
                                <input class="form-control" type="file" name="avatar" id="avatar">
                                @error('avatar')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn myBtn shadow-sm border float-end">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
