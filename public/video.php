
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
<title>影片上傳</title>
<link rel="stylesheet" type="text/css" href=".css">
<script type='text/javascript'>
function del() 
{
var msg = '您真的確定要刪除嗎？請確認！';
return confirm(msg);
};
</script>
</head>
<body>
<?php
session_start();  // 啟用交談期
// 檢查Session變數是否存在, 表示是否已成功登入
session_regenerate_id(true);
if ( $_SESSION["login_session"] != true )  
{    
//echo "<script>alert('請登入')</script>";   
header("Location: login.php");
}
    $login_account = $_SESSION["account"];
if($_SESSION["manager_login_session"] == true)
{
         echo "
         <table>
         <td>歡迎管理者( $login_account)進入網站!</td>
         </table>
         ";
         $link=@mysqli_connect('localhost:33060','root','root','tianzhu');
         $currentDate = date("Y-m-d");
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
                $sus_day = $row['time'];
                $ann_date= $row['ann_date'];
             }
         }
          $idleTimeout = $idleTimeout * 60 * 1000; // 超過時間的毫秒數
             // 將閒置時間值傳遞給 JavaScript 變數
             $sql = "select * from `video`";
             $result = mysqli_query($link,$sql);
             $data_nums = mysqli_num_rows($result);//統計總比數
             $data_nums = intval($data_nums); 
             if (isset($_GET["per"]))
             { 
                 $per = intval($_GET["per"]); //確認頁數只能夠是數值資料 
                 $sql_update = "UPDATE setting SET show_per = ? WHERE setting = '1'";
                 $stmt = mysqli_prepare($link, $sql_update);
                 mysqli_stmt_bind_param($stmt, "i", $per); // "i" 表示整數
                 $updateResult = mysqli_stmt_execute($stmt);
                 mysqli_stmt_close($stmt);
             } 
             else 
             {
                 $per=$per;
             }
                 $pages = ceil($data_nums/$per); //取得不小於值的下一個整數
             if (isset($_GET["page"]))
             { 
                 $page = intval($_GET["page"]); //確認頁數只能夠是數值資料 
             } else 
             {
                 $page=1; //則在此設定起始頁數
             }
             $start = ($page-1)*$per; //每一頁開始的資料序號
             $result = mysqli_query($link, $sql . ' LIMIT ' . $start . ', ' . $per);
             echo '<script>var idleTimeout = ' . $idleTimeout . ';</script>';
             echo "
            <table>
                <td>
                <form action=video.php method=POST enctype=multipart/form-data>
                    影片描述:<input type=text name=text required><br>
                    選擇要上傳的MP4或mp3文件：<input type=file name=file ><br>
                    選擇youtube連結：<input type=text name=videolink>
                    <input type=submit value=上傳 required>
                </form>
                <hr>
                <form  method=post action=manager.php>
                    <input type=submit name=button value=回首頁>
                </form>
            </td>
            </table>
            ";
            echo "<table>";
        echo "<td>";  
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['text']))
        {
            if(isset($_FILES["file"]) && !empty($_FILES["file"]["name"]) || isset($_POST["videolink"]) && !empty($_POST['videolink'])) 
            {
                $text=$_POST['text'];
                $videolink=$_POST['videolink'];
                $file_name = $_FILES["file"]["name"];
                $file_tmp_name = $_FILES["file"]["tmp_name"];
                $file_type = $_FILES["file"]["type"];
                $file_size = $_FILES["file"]["size"];
        
                // 檢查文件類型，確保是MP4
                $fileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                if ($fileType == "mp4" || $fileType=="mp3") 
                {
                    // 移動上傳的文件到目標路徑
                    $file_path = "upload/" . basename($file_name);
                    
                    if (move_uploaded_file($file_tmp_name, $file_path)) 
                    {
                        // 檢查是否文件名已存在於資料庫中
                        $sql_check = "SELECT * FROM video WHERE text = ?";
                        $stmt = mysqli_prepare($link, $sql_check);
                        if ($stmt) 
                        {
                            mysqli_stmt_bind_param($stmt, "s", $text);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);
                            
                            if (mysqli_num_rows($result) > 0) 
                            {
                                echo "<script>alert('文件名已被使用')</script>";
                            } 
                            else 
                            {
                                // 將文件信息存儲到資料庫
                                $sql_insert = "INSERT INTO video (text,file_name,file_path,videolink) VALUES (?,?,?,?)";
                                $stmt = mysqli_prepare($link, $sql_insert);
                                if ($stmt) 
                                {
                                    mysqli_stmt_bind_param($stmt, "ssss",$text,$file_name,$file_path,$videolink);
                                    if (mysqli_stmt_execute($stmt)) 
                                    {
                                        echo "<script>alert('上傳成功'); setTimeout(function() { window.location.href = 'video.php'; }, 1000);</script>";
                                    } 
                                    else 
                                    {
                                        echo "<script>alert('檔案上傳失敗')</script>";
                                    }
                                    mysqli_stmt_close($stmt);
                                } 
                                else 
                                {
                                    echo "準備語句失敗：" . mysqli_error($link);
                                }
                            }
                        }
                    } 
                }
                else if(!empty($_POST['videolink']))
                {
                    $file_name="";
                    $file_path="";
                    // 檢查是否文件名已存在於資料庫中
                    $sql_check = "SELECT * FROM video WHERE text = ?";
                    $stmt = mysqli_prepare($link, $sql_check);
                    if ($stmt) 
                    {
                        mysqli_stmt_bind_param($stmt, "s", $text);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        
                        if (mysqli_num_rows($result) > 0) 
                        {
                            echo "<script>alert('文件名已被使用')</script>";
                        } 
                        else 
                        {
                            // 將文件信息存儲到資料庫
                            $sql_insert = "INSERT INTO video (text,file_name,file_path,videolink) VALUES (?,?,?,?)";
                            $stmt = mysqli_prepare($link, $sql_insert);
                            if ($stmt) 
                            {
                                mysqli_stmt_bind_param($stmt, "ssss",$text,$file_name,$file_path,$videolink);
                                if (mysqli_stmt_execute($stmt)) 
                                {
                                    echo "<script>alert('上傳成功'); setTimeout(function() { window.location.href = 'video.php'; }, 1000);</script>";
                                } 
                                else 
                                {
                                    echo "<script>alert('檔案上傳失敗')</script>";
                                }
                                mysqli_stmt_close($stmt);
                            } 
                            else 
                            {
                                echo "準備語句失敗：" . mysqli_error($link);
                            }
                        }
                    }
                }
            }
            else 
            {
                echo "<script>alert('未選擇文件或提供 YouTube 連結。')</script>";
            }
            
        }
        
    // 顯示資料庫中的檔案列表
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        if (isset($_POST['sort'])) 
        {
            $sort = $_POST['sort'];
            if ($sort == 'asc') 
            {
                $selectAllQuery = "SELECT * FROM video ORDER BY date ASC";
            } 
            else 
            {
                $selectAllQuery = "SELECT * FROM video ORDER BY date DESC";
            }
        } 
        else 
        {
            $selectAllQuery = "SELECT * FROM video"; // 預設的查詢
        }
    } 
    else 
    {
        $selectAllQuery = "SELECT * FROM video"; // 預設的查詢
    }
    $fileList = mysqli_query($link, $selectAllQuery);
    echo "<table>";
    if (mysqli_num_rows($fileList) > 0) 
    {
        echo "<td>"."<font size=5>"."影片描述"."</td><br>";
        echo "<td >"."<font size=5>"."youtube連結"."</td><br>";  
        while ($fileData = mysqli_fetch_assoc($fileList)) 
        {
            
            echo "<tr>";
            if($fileData['file_name']!="")
            {
                echo "<td><a href='video.php?text=" .  urlencode($fileData['text']) ."'>" . $fileData['text'] . "</a></td>";
            }
            else
            {
                echo "<td>".$fileData['text']."</td><br>";
            }
           
            $videolink=$fileData['videolink'];
            if (strpos($videolink, 'youtube.com') !== false)
            {
                echo "<td><a href='$videolink' target='_blank'>$videolink</a><br></td>";
            }
            else
            {
                echo "<td>"."目前沒有youtube連結"."</td><br>";
            }
            echo "<td >
            <form method='post' action='video.php' onsubmit='return del()'>
            <input type='hidden' name='file_name' value='".$fileData['file_name']."'>
            <input type='submit' name='button' value='刪除'></form>
            </td>";
            echo "</tr>";
            }
            echo "<br>"; 
    }
   
    else 
    {

        echo "目前沒有檔案可以下載。";
    }
    echo "</font></td></table>";
    echo "<table>";
    if (isset($_GET['text'])) 
    {
        $text = $_GET['text'];
        
        // 使用 mysqli_real_escape_string 處理 $text 變數以避免 SQL 注入
        $text = mysqli_real_escape_string($link, $text);
    
        // 查詢資料庫以獲取檔案路徑
        $sql_search = "SELECT * FROM video WHERE text = '$text'";
        $result = mysqli_query($link, $sql_search);
    
        if (mysqli_num_rows($result) > 0) {  
            $row = mysqli_fetch_assoc($result);
            $file_path = $row['file_path'];
            $file_name = $row['file_name'];
            $fileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    
            if ($fileType == "mp4") 
            {
                echo "<video width=100% height=auto controls><source src='$file_path' type='video/mp4'></video>";
            } 
            else if ($fileType == "mp3") 
            {
                echo "<audio width=100% height=auto controls><source src='$file_path' type='audio/mpeg'></audio>";
            }
        }
    }
    echo "</table>";
    

    echo "<table>";
    echo "<td >";   
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
    echo " 頁 <a href=?page=".$pages.">末頁</a>";  
    echo " 每頁顯示項目數量".$per;
    echo "
    <form method=get action=video.php>
        <label for=per>每頁顯示比數：</label>
        <select name=per id=per>";
        foreach ($drop_per as $value) {
            echo "<option value='$value'>$value</option>";
        }
        echo"
        </select>
        <input type=submit value=送出>
    </form>
    </td>
    
    <br><br><hr>
    ";

    if (isset($_POST['button']) && $_POST['button'] == '刪除')
    {
        if (isset($_POST['file_name'])) 
        {
            $file_name = $_POST['file_name'];
                // 執行刪除的 SQL 語句
                $sql_delete = "DELETE FROM `video` WHERE file_name='$file_name'";
                mysqli_query($link, $sql_delete);

                if (mysqli_affected_rows($link) > 0) 
                {
                    // 在刪除成功後重新導向頁面
                    echo "<script>alert('刪除成功'); setTimeout(function() { window.location.href = 'video.php'; }, 1000);</script>";
                } 
                else 
                {
                    echo "<script>alert('刪除失敗')</script>";
                }
        }
        
    }
}
else
{
   echo "<script>alert('此帳號非管理員帳號，請使用正確的管理員帳號'); setTimeout(function() { window.location.href = 'logout.php'; }, 1000);</script>";
}
?>
<script>
    var idleTimer;

    function resetIdleTimer() {
        clearTimeout(idleTimer);
        idleTimer = setTimeout(logoutUser, idleTimeout);
    }

    function logoutUser() {
        // 顯示提示訊息
        alert('工作階段過期，請重新登入');
        window.location.href = 'logout.php'; // 
    }

    // 在使用者進行任何操作時，重置計時器
    document.addEventListener('mousemove', resetIdleTimer);
    document.addEventListener('keypress', resetIdleTimer);
</script>

</body>
</html>
