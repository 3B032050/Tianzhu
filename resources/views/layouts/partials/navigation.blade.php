<header class="page-header">
    <nav>
        <ul class="nav-list">
            <li class="nav-item">

                @if (Auth::check())
                    @if (Auth::user()->type='1')
                        <li class='nav-item'><a href='manager.php' style='color: black'>管理者</a></li>
                        <li class='nav-item'><a href='logout.php' style='color: black'>登出</a></li>
                    @else
                        <li class='nav-item'><a href='user.php' style='color: black'>會員</a></li>
                        <li class='nav-item'><a href='logout.php' style='color: black'>登出</a></li>
                    @endif    
                @else
                    <li class='nav-item'><a class="nav-item" href="{{route('login.index')}}" style="color:black">登入</a></li>
                @endif   
                <?php
                /*
                session_start();
                if (isset($_SESSION["login_session"])) 
                {
                    if ($_SESSION["login_session"] != true) 
                    {
                        echo "<a href=".{{route('login.index')}}.">最新消息</a>";
                        echo "<li class='nav-item'><a href='login.php' style='color:black'>登入</a></li>";
                    } 
                    else
                    {
                        if ($_SESSION["manager_login_session"] != true )
                        {
                            echo "<li class='nav-item'><a href='user.php' style='color: black'>會員</a></li>";
                            echo "<li class='nav-item'><a href='logout.php' style='color: black'>登出</a></li>";
                        }
                        else
                        {
                            echo "<li class='nav-item'><a href='manager.php' style='color: black'>管理者</a></li>";
                            echo "<li class='nav-item'><a href='logout.php' style='color: black'>登出</a></li>";        
                        }
                    }   
                }
                else 
                {
                    echo "<li class='nav-item'><a href='login.php' style='color: black'>登入</a></li>";
                }
                */
                ?>
            </li>
            <li class="nav-item"><a href="mailto:antory040512@gmail.com" style="color: black;">聯絡我們</a></li>
            <li class="nav-item"><a href='history.php' style="color: black;">歷史公告</a></li>
            <ul class="dropdown">
                <li><a href='home.php' style="color: black;">弘化利生</a>
                    <ul class="dropdown-content">
                        <li><a href='video_list.php' style="color: black;">課程講義</a></li>
                        <li><a href='video_list.php' style="color: black;">佛們小常識</a></li>
                        <li><a href='LBSB.php' style="color: black;">居士學佛</a></li>
                        <li><a href='video_list.php' style="color: black;">法音流佈</a></li>
                    </ul>
                </li>
            </ul>
        </ul>
    </nav>
</header>