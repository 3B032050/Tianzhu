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
</head>
<body>
    @include('layouts.partials.navigation')
    @yield('content')
    @include('layouts.partials.footer')
</body>
<html>
