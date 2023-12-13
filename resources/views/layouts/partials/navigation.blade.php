<nav class="navbar navbar-expand-lg navbar-light bg-custom">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ url('/') }}">天筑精舍</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                @foreach($webHierarchies as $webHierarchy)
                    @if($webHierarchy->parent_id == '0')
                        @if(count($webHierarchy->children) > 0)
                            <ul class="nav-item dropdown">
                                <li><a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href='{{ $webHierarchy->url }}' style="color:black">{{ $webHierarchy->title }}</a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach($webHierarchy->children as $child)
                                            <li><a class="dropdown-item" href="{{ $child->url }}">{{ $child->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $webHierarchy->url }}">{{ $webHierarchy->title }}</a>
                            </li>
                        @endif

                    @endif
                @endforeach
            </ul>

            <ul class="navbar-nav">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}" style="color:black">{{ __('登入') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}" style="color:black">{{ __('註冊') }}</a>
                        </li>
                    @endif
                @else
                    <ul class="nav-item dropdown">
                        <li>
                            @if (Auth::check() && Auth::user()->isAdmin())
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href='home.php' style="color:black">管理員：{{ Auth::user()->name }}</a>
                            @else
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href='home.php' style="color:black">使用者：{{ Auth::user()->name }}</a>
                            @endif
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('users.index') }}" style="color:black">{{ __('個人資料') }}</a>
                                </li>
                                @if (Auth::check() && Auth::user()->isAdmin())
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admins.dashboard') }}" style="color:black">{{ __('後台管理') }}</a>
                                    </li>
                                @endif

                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" style="color:black">{{ __('登出') }}</a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    </ul>
                @endguest
            </ul>
        </div>
    </div>
</nav>





{{--<link rel="stylesheet" type="text/css" href="style.css">--}}
{{--<header class="page-header">--}}
{{--    <nav>--}}
{{--        <ul class="nav-list">--}}
{{--            @foreach($webHierarchies as $webHierarchy)--}}
{{--                @if($webHierarchy->parent_id == '0')--}}
{{--                    @if(count($webHierarchy->children) > 0)--}}
{{--                        <ul class="nav-item dropdown">--}}
{{--                            <li><a class="nav-link dropdown-toggle" href='{{ $webHierarchy->url }}' style="color:black">{{ $webHierarchy->title }}</a>--}}
{{--                                <ul class="dropdown-content">--}}
{{--                                    @foreach($webHierarchy->children as $child)--}}
{{--                                        <li><a class="nav-link" href="{{ $child->url }}">{{ $child->title }}</a></li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    @else--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="{{ $webHierarchy->url }}">{{ $webHierarchy->title }}</a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

{{--                @endif--}}
{{--            @endforeach--}}
{{--            --}}
{{--                @guest--}}
{{--                    @if (Route::has('login'))--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="{{ route('login') }}" style="color:black">{{ __('登入') }}</a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

{{--                    @if (Route::has('register'))--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="{{ route('register') }}" style="color:black">{{ __('註冊') }}</a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
{{--                @else--}}
{{--                <ul class="nav-item dropdown">--}}
{{--                    <li>--}}
{{--                        @if (Auth::check() && Auth::user()->isAdmin())--}}
{{--                            <a class="nav-link dropdown-toggle" href='home.php' style="color:black">管理員：{{ Auth::user()->name }}</a>--}}
{{--                        @else--}}
{{--                            <a class="nav-link dropdown-toggle" href='home.php' style="color:black">使用者：{{ Auth::user()->name }}</a>--}}
{{--                        @endif--}}
{{--                        <ul class="dropdown-content">--}}
{{--                            <li>--}}
{{--                                <a class="nav-link" href="{{ route('users.index') }}" style="color:black">{{ __('個人資料') }}</a>--}}
{{--                            </li>--}}
{{--                            @if (Auth::check() && Auth::user()->isAdmin())--}}
{{--                            <li>--}}
{{--                                <a class="nav-link" href="{{ route('admins.dashboard') }}" style="color:black">{{ __('後台管理') }}</a>--}}
{{--                            </li>--}}
{{--                            @endif--}}

{{--                            <li><a class="nav-link" href="{{ route('logout') }}"--}}
{{--                                onclick="event.preventDefault();--}}
{{--                                document.getElementById('logout-form').submit();" style="color:black">{{ __('登出') }}</a>--}}
{{--                            </li>--}}
{{--                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                            @csrf--}}
{{--                            </form>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--                @endguest--}}
{{--        </ul>--}}
{{--    </nav>--}}
{{--</header>--}}
<style>
.bg-custom {
background-color: #DEB887; /* Replace with your desired color code */
}
</style>
