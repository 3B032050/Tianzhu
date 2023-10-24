<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>    
<body>
    @include('layouts.partials.navigation')
    @yield('content')
</body>
<html>