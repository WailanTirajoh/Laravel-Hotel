<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/logo/sip.png') }}">
    @vite('resources/sass/app.scss')
    <title>@yield('title')</title>
</head>

<body>
    <main>
        <div>
            @yield('content')
        </div>
    </main>
    @vite('resources/js/app.js')
    @yield('scripts')
</body>

</html>
