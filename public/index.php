<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta viewport" content="width=device-width, initial-scale=1.0">
<title>首頁</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>    
<body>
<header class="page-header">
    <nav>
        <ul class="nav-list">
            <li class="nav-item">

                <?php
                    session_start();

                    if (isset($_SESSION["login_session"])) 
                    {
                        if ($_SESSION["login_session"] != true) 
                        {
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
                ?>
               
            </li>
            <li class="nav-item"><a href="mailto:antory040512@gmail.com" style="color: black;">聯絡我們</a></li>
            <li class="nav-item"><a href='history.php' style="color: black;">歷史公告</a></li>
            <li class="nav-item"><a href='home.php' style="color: black;">弘化利生</a></li>
        </ul>
    </nav>
</header>



   <section id="location">
    <div class="wrapper">
        <dic class ="location-info">
            <h3 class "sub-title">天筑精舍</h3>
            <p>
                地址:335桃園市大溪區內柵路一段98巷54-1號<br>
                電話:033883257<br>
            </p>
        </div>
        <div class="location-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3620.1942296287816!2d121.27671427444545!3d24.85721504538914!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3468176912c5eaa7%3A0x46b0f53d5ae5cb0!2z5aSp562R57K-6IiN!5e0!3m2!1szh-TW!2stw!4v1696680829001!5m2!1szh-TW!2stw" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    </section>
</body>
<html>

