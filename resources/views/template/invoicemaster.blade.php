<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Invoice</title>

    {{-- Icon --}}
    <link rel="icon" href="{{ asset('img/logo/sip.png') }}">

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    @yield('head')
</head>

<body>
    <main class="my-3">
        @yield('content')

    </main>

    @yield('footer')
    <script src="{{ mix('/js/app.js') }}"></script>
</body>

</html>
