<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/logo/sip.png') }}">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
</head>

<body>
    <main>
        <div>
            @yield('content')
        </div>
    </main>
    @vite('resources/js/app.js')
    <script src="{{ asset('style/js/global.js') }}"></script>
    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}", "Success")
        @endif
        @if (Session::has('failed'))
            toastr.error("{{ Session::get('failed') }}", "Failed")
        @endif
    </script>
</body>

</html>
