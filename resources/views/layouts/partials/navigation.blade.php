<nav class="navbar navbar-expand-lg navbar-light bg-custom">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ url('/') }}">天筑精舍</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
{{--                @foreach($webHierarchies as $webHierarchy)--}}
{{--                    @if($webHierarchy->parent_id == '0')--}}
{{--                        <ul class="nav-item">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{ route('web.index', ['web_id' => $webHierarchy->web_id]) }}" style="color:black">{{ $webHierarchy->title }}</a>--}}
{{--                            </li>--}}
{{--                            @if(count($webHierarchy->children) > 0)--}}
{{--                                <li class="nav-item dropdown">--}}
{{--                                    <div class="dropdown">--}}
{{--                                        <button class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:black">--}}
{{--                                            <span class="d-none d-md-inline">{{ $webHierarchy->title }}</span>--}}
{{--                                        </button>--}}
{{--                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
{{--                                            @foreach($webHierarchy->children as $child)--}}
{{--                                                <li>--}}
{{--                                                    <a class="dropdown-item" href="{{ route('web.index', ['web_id' => $child->web_id]) }}">{{ $child->title }}</a>--}}
{{--                                                </li>--}}
{{--                                            @endforeach--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                        </ul>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
                <ul class="nav-item">
                    <li class="nav-item dropdown">
                        <div class="dropdown">
                            <button class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:black">
                                <span class="d-none d-md-inline">天筑精舍簡介</span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="/">交通資訊</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/">緣起與宗旨</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <li class="nav-item">
                    <a class="nav-link" href="/" style="color:black">最新消息</a>
                </li>
                <ul class="nav-item">
                    <li class="nav-item dropdown">
                        <div class="dropdown">
                            <button class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:black">
                                <span class="d-none d-md-inline">僧伽教育</span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('courses.overview') }}">總覽</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider"/>
                                </li>
                                @foreach($courseCategories as $courseCategory)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('courses.show',$courseCategory->id) }}">{{ $courseCategory->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                </ul>
                <ul class="nav-item">
                    <li class="nav-item dropdown">
                        <div class="dropdown">
                            <button class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:black">
                                <span class="d-none d-md-inline">弘化利生</span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="/">課程講義</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/">佛門小常識</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/">居士學佛</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/">法音流布</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <ul class="nav-item">
                    <li class="nav-item dropdown">
                        <div class="dropdown">
                            <button class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:black">
                                <span class="d-none d-md-inline">法會活動</span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('activities.index') }}">活動紀實</a>
                                </li>
                                @if (Auth::user())
                                    <li>
                                        <a class="dropdown-item" href="/">光明燈登記</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/">牌位登記</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                </ul>
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
<style>
.bg-custom {
background-color: #DEB887; /* Replace with your desired color code */
}
</style>
