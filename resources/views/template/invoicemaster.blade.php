<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Icon --}}
    <link rel="icon" href="{{ asset('img/logo/sip.png') }}">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('package/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    {{-- style --}}
    <link rel="stylesheet" href="{{ asset('style/css/style.css') }}">
    @yield('head')
</head>

<body>
    <main class="my-3">
        @yield('content')

    </main>
    <script src="{{ asset('package/bootstrap/js/bootstrap.bundle.min.js') }}"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    @yield('footer')
</body>

</html>
