<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Invoice</title>

    {{-- Icon --}}
    <link rel="icon" href="{{ asset('img/logo/sip.png') }}">

    @vite('resources/sass/app.scss')
    @yield('head')
</head>

<body>
    <main class="my-3">
        @yield('content')

    </main>

    @yield('footer')
    @vite('resources/js/app.js')
</body>

</html>
