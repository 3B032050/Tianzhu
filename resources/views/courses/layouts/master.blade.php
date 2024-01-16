<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <title>@yield('title')</title>

        <link rel="icon" type="image/x-icon" href="{{asset('assets/favicon.ico')}}" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />


        <link href="{{asset('css/homepage-styles.css')}}" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}">
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Bootstrap JS（包含 Popper.js） -->

{{--        <link href="library/bootstrap-5/bootstrap.min.css" rel="stylesheet" />--}}
{{--        <script src="library/bootstrap-5/bootstrap.bundle.min.js"></script>--}}
{{--        <script src="library/dselect.js"></script>--}}

        <!-- Bootstrap JS (popper.js and jquery are required dependencies for Bootstrap 4) -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
    @include('layouts.partials.navigation')
    @yield('content')
    @include('layouts.partials.footer')

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- 引入 jQuery UI 库 -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>
<html>
