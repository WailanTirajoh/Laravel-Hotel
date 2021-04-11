@extends('template.auth')
@section('title', 'Dashboard')
@section('content')
    <link href="{{ asset('style/css/stylelogin.css') }}" rel="stylesheet">
    <div class="wavestop">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#0099ff" fill-opacity="1"
                d="M0,224L48,186.7C96,149,192,75,288,42.7C384,11,480,21,576,74.7C672,128,768,224,864,256C960,288,1056,256,1152,234.7C1248,213,1344,203,1392,197.3L1440,192L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z">
            </path>
        </svg>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="glassmorphism card-signin my-5">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-center">
                                    <img src="img/logo/sip.png" width="100" height="100" class="rounded-circle mx-auto"
                                        alt="logo" style="background-color: white;">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="card-title text-center">Sistem Informasi Perusahaan</h5>
                            </div>
                        </div>
                        <form class="form-signin" action="http://localhost:81/sip/pelamar/fungsi_daftar" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-label-group">
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email"
                                            value="" required autofocus>
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="password" id="password" name="password" autocomplete="new-password"
                                            class="form-control" placeholder="Password" value="" required>
                                        <label for="password">Password</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="password" id="password_konfirmasi" name="password_konfirmasi"
                                            class="form-control" placeholder="Repead Password" value="" required>
                                        <label for="password_konfirmasi">Konfirmasi password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 d-flex justify-content-center">
                                    <button class="btn btn-lg btn-primary text-white btn-block text-uppercase"
                                        type="submit">Daftar</button>
                                </div>
                            </div>
                            <hr class="my-4">
                            <p class="text-center">Sudah memiliki akun? <a href="/login">masuk</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wavesbottom">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#0099ff" fill-opacity="1"
                d="M0,224L48,213.3C96,203,192,181,288,154.7C384,128,480,96,576,122.7C672,149,768,235,864,234.7C960,235,1056,149,1152,117.3C1248,85,1344,107,1392,117.3L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
        </svg>
    </div>
@endsection
