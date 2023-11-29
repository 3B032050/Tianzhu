<link rel="stylesheet" type="text/css" href="style.css">
<header class="page-header">
    <nav>
        <ul class="nav-list">
{{--            @if ($webHierarchies->parent_id == '0')--}}
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}" style="color:black">首頁</a></li>
                <li class="nav-item"><a class="nav-link" href="mailto:antory040512@gmail.com" style="color:black">聯絡我們</a></li>
                <li class="nav-item"><a class="nav-link" href='history.php' style="color:black">歷史公告</a></li>
                <ul class="nav-item dropdown">
                    <li><a class="nav-link dropdown-toggle" href='home.php' style="color:black">弘化利生</a>
                        <ul class="dropdown-content">
                            <li><a class="nav-link" href='video_list.php' style="color:black">課程講義</a></li>
                            <li><a class="nav-link" href='video_list.php' style="color:black">佛們小常識</a></li>
                            <li><a class="nav-link" href='LBSB.php' style="color:black">居士學佛</a></li>
                            <li><a class="nav-link" href='video_list.php' style="color:black">法音流佈</a></li>
                        </ul>
                    </li>
                </ul>
{{--            @endif--}}
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
                            <a class="nav-link dropdown-toggle" href='home.php' style="color:black">管理員：{{ Auth::user()->name }}</a>
                        @else
                            <a class="nav-link dropdown-toggle" href='home.php' style="color:black">{{ Auth::user()->name }}</a>
                        @endif
                        <ul class="dropdown-content">
                            <li>
                                <a class="nav-link" href="{{ route('users.index') }}" style="color:black">{{ __('個人資料') }}</a>
                            </li>
                            @if (Auth::check() && Auth::user()->isAdmin())
                            <li>
                                <a class="nav-link" href="{{ route('admins.dashboard') }}" style="color:black">{{ __('後台管理') }}</a>
                            </li>
                            @endif

                            <li><a class="nav-link" href="{{ route('logout') }}"
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
    </nav>
</header>
