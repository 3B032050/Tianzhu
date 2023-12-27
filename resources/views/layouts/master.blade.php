<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">--}}

        <link rel="icon" type="image/x-icon" href="{{asset('assets/favicon.ico')}}" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="{{asset('css/homepage-styles.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


        <link href="library/bootstrap-5/bootstrap.min.css" rel="stylesheet" />
        <script src="library/bootstrap-5/bootstrap.bundle.min.js"></script>
        <script src="library/dselect.js"></script>
</head>
<body>
    @include('layouts.partials.navigation')
    @yield('content')
    @include('layouts.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>
<html>
