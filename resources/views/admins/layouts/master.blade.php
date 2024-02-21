<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page-title')</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="{{ asset('css/admin-styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- 引入 jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- 引入 jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
{{--    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>--}}
    <style type="text/css">
        .ck-editor__editable_inline
        {
            height: 450px;
        }
    </style>
    <style>
        .custom-link {
            color: black; /* 設置字體顏色為黑色 */
            text-decoration: none; /* 移除下劃線 */
        }
    </style>
</head>
<body class="sb-nav-fixed">
    @include('admins.layouts.shared.navbar')
    <div id="layoutSidenav">
        @include('admins.layouts.shared.sidenav')
        <div id="layoutSidenav_content">
            <main>
                @yield('page-content')
            </main>
            @include('admins.layouts.shared.footer')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/admin-scripts.js') }}"></script>
</body>
</html>
