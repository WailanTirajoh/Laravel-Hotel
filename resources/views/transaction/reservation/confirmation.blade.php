@extends('template.master')
@section('title', 'Choose Day Reservation')
@section('head')
<link rel="stylesheet" href="{{ asset('style/css/progress-indication.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('content')
@include('transaction.reservation.progressbar')
<div class="container mt-3">
    <div class="row justify-content-md-center">
        <div class="col-md-8 mt-2">
            <div class="card shadow-sm border">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row mb-3">
                                <label for="room_number" class="col-sm-2 col-form-label">Habitacion</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="room_number" name="room_number" placeholder="col-form-label" value="{{ $room->number }} " readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="room_type" class="col-sm-2 col-form-label">Tipo</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="room_type" name="room_type" placeholder="col-form-label" value="{{ $room->type->name }} " readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="room_capacity" class="col-sm-2 col-form-label">Capacidad</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="room_capacity" name="room_capacity" placeholder="col-form-label" value="{{ $room->capacity }} " readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="room_price" class="col-sm-2 col-form-label">Precio / Día</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="room_price" name="room_price" placeholder="col-form-label" value="{{ Helper::convertToRupiah($room->price) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-sm-12 mt-2">
                            <form id="paymentForm" method="POST" action="{{ route('transaction.reservation.payDownPayment', ['customer' => $customer->id, 'room' => $room->id]) }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="check_in" class="col-sm-2 col-form-label">Ingreso</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="check_in" name="check_in" placeholder="col-form-label" value="{{ $stayFrom }}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="check_out" class="col-sm-2 col-form-label">Salida</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="check_out" name="check_out" placeholder="col-form-label" value="{{ $stayUntil }}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="how_long" class="col-sm-2 col-form-label">Precio por dia</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="how_long" name="how_long" placeholder="col-form-label" value="{{ $dayDifference }} {{ Helper::plural('Day', $dayDifference) }} " readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="total_price" class="col-sm-2 col-form-label">Precio Total</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="total_price" name="total_price" placeholder="col-form-label" value="{{ Helper::convertToRupiah(Helper::getTotalPayment($dayDifference, $room->price)) }} " readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="minimum_dp" class="col-sm-2 col-form-label">Monto minimo $</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="minimum_dp" name="minimum_dp" placeholder="col-form-label" value="{{ Helper::convertToRupiah($downPayment) }} " readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="downPayment" class="col-sm-2 col-form-label">Pago</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('downPayment') is-invalid @enderror" id="downPayment" name="downPayment" placeholder="Ingresar Pago" value="{{ old('downPayment') }}">
                                        @error('downPayment')
                                        <div class="text-danger mt-1">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10" id="showPaymentType"></div>
                                </div>
                                <button type="submit" class="btn btn-primary float-end" id="payButton">Pago</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-2">
            <div class="card shadow-sm">
                <img src="{{ $customer->user->getAvatar() }}" style="border-top-right-radius: 0.5rem; border-top-left-radius: 0.5rem">
                <div class="card-body">
                    <table>
                        <tr>
                            <td style="text-align: center; width:50px">
                                <span>
                                    <i class="fas {{ $customer->gender == 'Male' ? 'fa-male' : 'fa-female' }}">
                                    </i>
                                </span>
                            </td>
                            <td>
                                {{ $customer->name }}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; ">
                                <span>
                                    <i class="fas fa-user-md"></i>
                                </span>
                            </td>
                            <td>{{ $customer->job }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: center; ">
                                <span>
                                    <i class="fas fa-birthday-cake"></i>
                                </span>
                            </td>
                            <td>
                                {{ $customer->birthdate }}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; ">
                                <span>
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                            </td>
                            <td>
                                {{ $customer->address }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
<script>
    $('#downPayment').keyup(function() {
        $('#showPaymentType').text('$. ' + parseFloat($(this).val(), 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1.")
            .toString());
    });

    document.getElementById('payButton').addEventListener('click', function(event) {
        event.preventDefault();

        Swal.fire({
            title: 'Success!',
            text: 'Your payment was successful!',
            icon: 'success',
            showConfirmButton: false,
            timer: 3000,
            willClose: () => {
                Swal.fire({
                    title: 'Redirecting',
                    text: 'Please wait...',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000,
                    willClose: () => {
                        document.getElementById('paymentForm').submit();
                    }
                });
            }
        });
    });
</script>
@endsection