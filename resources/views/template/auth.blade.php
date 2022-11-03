<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/logo/sip.png') }}">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
</head>

<body>
    <main>
        <div>
            @yield('content')
        </div>
    </main>
    <script src="{{ mix('/js/app.js') }}"></script>
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
