<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
<script type='text/javascript'>
    function del() {
    var msg = '您真的確定要刪除嗎？請確認！';
    return confirm(msg);
}
</script>
<style>
        /* 顯示在頂部的樣式 */
        .top-message {
            color: #ffffff; /* 設置文字顏色為白色 */
            text-align: center; /* 文字居中 */
            padding: 10px; /* 增加內邊距 */
        }
    </style>
<title>管理者介面</title>
</head>    
<body>
<?php
ini_set('session.gc_maxlifetime', 5);
   session_start();  // 啟用交談期
   // 檢查Session變數是否存在, 表示是否已成功登入
   session_regenerate_id(true);
   if ( $_SESSION["login_session"] != true )  
   {    
    echo "<script>alert('請登入'); setTimeout(function() { window.location.href = 'login.php'; }, 1000);</script>";
   }
   $login_account = $_SESSION["account"];
   if($_SESSION["manager_login_session"] == true)
   {

        $link=@mysqli_connect('localhost:33060','root','root','tianzhu');
        mysqli_query($link,'SET CHARACTER SET utf8');
        $sql_search = "SELECT * FROM `setting` WHERE setting_id='1'";
        $result = mysqli_query($link, $sql_search);

        if (mysqli_num_rows($result) > 0)
        {  
            while ($row = mysqli_fetch_assoc($result))
            {
                $setting=$row['setting_id'];
                $expire_time = $row['expire_time'];
                $show_per = $row['show_per'];
                $drop_per = $row['drop_per'];
                $drop_per = explode(",", $drop_per);
                $sus_day = $row['sus_day'];
                $ann_date= $row['ann_date'];
            }
        }
        $idleTimeout = $expire_time * 60 * 1000; // 超過時間的毫秒數
         // 將閒置時間值傳遞給 JavaScript 變數
         echo '<script>var idleTimeout = ' . $idleTimeout . ';</script>';
         echo "<table>";
         echo "<tr>";
         echo "<td>歡迎管理者($login_account)進入網站!</td>";
         echo "</tr>";
         echo "</table>";
         echo "
         <table >
         <tr>
             <td>
             <form method='post' action='update.php'>
             <input type='hidden' name='account' value='" . $login_account . "'>
             <input type='submit' name='button' value='修改資料'>
             </form>
             </font></td>
             <td>
             <form method='post' action='backstage.php'>
                 <input type='submit' name='button' value='後臺處理'>
             </form>
             </td>
             <td>
             <form method='post' action='product.php'>
                 <input type='submit' name='button' value='商品'>
             </form>
             </td>
             <td>
             <form method='post' action='setting.php'>
                 <input type='submit' name='button' value='設定'>
             </form>
             </td>
             <td>
             <form method='post' action='file.php'>
                 <input type='submit' name='button' value='佈告欄'>
             </form>
             </td>
             <td>
             <form method='post' action='video.php'>
                 <input type='submit' name='button' value='影片管理'>
             </form>
             <td>
             <form method='post' action='message.php'>
                 <input type='submit' name='button' value='留言管理'>
             </form>
             </td>
             <td>
                 <form method='post' action='logout.php'>
                     <input type='submit' name='button' value='登出'>
                 </form>
             </td>
         </tr>
         </table>
         ";
         
        echo "<table>";
        $sql="SELECT * FROM `user` WHERE `authority` = 1 OR `authority` = 2";
        $result = mysqli_query($link,$sql);
        $data_nums = mysqli_num_rows($result); //統計總比數
        
        $pages = ceil($data_nums/$show_per); //取得不小於值的下一個整數
        if (!isset($_GET["page"]))
        { 
            $page=1; //則在此設定起始頁數
        } else 
        {
            $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
        }
        $start = ($page-1)*$show_per; //每一頁開始的資料序號
        $result = mysqli_query($link, $sql . ' LIMIT ' . $start . ', ' . $show_per);
        if(@mysqli_num_rows($result)>0)
        {
            echo "<td>"."<font size=5>"."管理者帳號"."</td>";
            echo "<td>"."<font size=5>"."管理者密碼"."</td>";
            echo "<td>"."<font size=5>"."使用者電話"."</td>";
            echo "<td>"."<font size=5>"."電子郵件"."</td>";
            echo "<td>"."<font size=5>"."註冊時間"."</td>";   
            if($_SESSION["authority"]=='1')
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    
                    if ($row <> null)
                    {
                        echo "<tr>";
                        echo "<td>".$row['account']."</td>";
                        echo "<td>"."******"."</td>";
                        echo "<td>".$row['telephone']."</td>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['date']."</td>";
                        echo "<td>
                        <form method='post' action='update.php' '>
                        <input type='hidden' name='account' value='".$row['account']."'>
                        <input type='submit' name='button' value='修改資料'></form></font>
                        </td>";
                        echo "<td>
                        <form method='post' action='manager.php' onsubmit='return del()'>
                        <input type='hidden' name='account' value='".$row['account']."'>
                        <input type='hidden' name='level' value='".$row['level']."'>
                        <input type='submit' name='button' value='刪除'></form></font>
                        </td>";
                        echo "</tr>";  
                    }
                    echo "<br>";
                }
            }
            else
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    
                    if ($row <> null)
                    {
                        echo "<tr>";
                        echo "<td align =center heigh=500 width=500>"."<font size=5>".$row['account']."</td>";
                        echo "<td align =center heigh=500 width=500>"."<font size=5>"."******"."</td>";
                        echo "<td align =center heigh=500 width=500>"."<font size=5>".$row['telephone']."</td>";
                        echo "<td align =center heigh=500 width=500>"."<font size=5>".$row['email']."</td>";
                        echo "<td align =center heigh=500 width=500>"."<font size=5>".$row['date']."</td>";
                        echo "</tr>";  
                        
                    }
                    echo "<br>";
                }
            }
           
        }
            
            
            echo "</table>";
        echo "<table>";
        echo "<td>";   
        //分頁頁碼
        echo '共 '.$data_nums.' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
        echo "<br /><a href=?page=1>首頁</a> ";
        echo "第 ";
        for( $i=1 ; $i<=$pages ; $i++ ) 
        {
            if ( $page-3 < $i && $i < $page+3 ) 
            {
                echo "<a href=?page=".$i.">".$i."</a> ";
            }
        } 
        echo " 頁 <a href=?page=".$pages.">末頁</a><br /><br />";  
        echo "</td>"; 
        if (isset($_POST['button']) && $_POST['button'] == '刪除') 
        {
            if (isset($_POST['account'])) 
            {
                $account = $_POST['account'];
                $level = $_POST['level'];
        
                // 檢查權限，只有 level 為 1 的使用者可以執行刪除
                if ($_SESSION["level"] == '1') 
                {
                    $account = mysqli_real_escape_string($link, $account);
                    $level = mysqli_real_escape_string($link, $level);
        
                    $sql_delete = "DELETE FROM `user` WHERE account=?";
                    $stmt = mysqli_prepare($link, $sql_delete);
        
                    if ($stmt) 
                    {
                        // 綁定參數
                        mysqli_stmt_bind_param($stmt, "s", $account);
        
                        // 執行刪除操作
                        mysqli_stmt_execute($stmt);
        
                        if (mysqli_affected_rows($link) > 0) 
                        {
                            // 在刪除成功後重新導向頁面
                            echo "<script>alert('刪除成功'); setTimeout(function() { window.location.href = 'manager.php'; }, 1000);</script>";
                        } 
                        else 
                        {
                            echo "<script>alert('刪除失敗')</script>";
                        }
        
                        // 關閉準備語句
                        mysqli_stmt_close($stmt);
                    }
                } 
                else 
                {
                    echo "<script>alert('權限不足')</script>";
                }
            }
        }    
}  
else
{
    echo "<script>alert('此帳號非管理員帳號，請使用正確的管理員帳號'); setTimeout(function() { window.location.href = 'logout.php'; }, 1000);</script>";
}
?>
<script type="text/javascript">
    var idleTimer;

    function resetIdleTimer() {
        clearTimeout(idleTimer);
        idleTimer = setTimeout(logoutUser, idleTimeout);
    }

    function logoutUser() {
        // 顯示提示訊息
       alert('工作階段已過期，請重新登入'); setTimeout(function() { window.location.href = 'logoutphp'; }, 1000)
    }

    // 在使用者進行任何操作時，重置計時器
    document.addEventListener('mousemove', resetIdleTimer);
    document.addEventListener('keypress', resetIdleTimer);
</script>
</body>
</html>