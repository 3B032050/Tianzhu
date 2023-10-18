
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
<title>法音流佈</title>
</head>
<body>
<?php
session_start();  // 啟用交談期
// 檢查Session變數是否存在, 表示是否已成功登入
session_regenerate_id(true);
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
       $sus_day = $row['sus_day'];
       $ann_date= $row['ann_date'];
    }
}
 $idleTimeout = $expire_time * 60 * 1000; // 超過時間的毫秒數
            // 將閒置時間值傳遞給 JavaScript 變數
            $sql = "select * from `video`";
            $result = mysqli_query($link,$sql);
            $data_nums = mysqli_num_rows($result);//統計總比數
            $data_nums = intval($data_nums); 
            if (isset($_GET["per"]))
            { 
                $per = intval($_GET["per"]); //確認頁數只能夠是數值資料 
                $sql_update = "UPDATE setting SET show_per = ? WHERE setting_id = '1'";
                $stmt = mysqli_prepare($link, $sql_update);
                mysqli_stmt_bind_param($stmt, "i", $show_per); // "i" 表示整數
                $updateResult = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            } 
            else 
            {
                $per=$show_per;
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
                 echo "<td><a href='video.php?file_name=" .  urlencode($fileData['file_name']) ."'>" . $fileData['file_name'] . "</a></td>";
             }
             else
             {
                 echo "<td>".$fileData['video_desc']."</td><br>";
             }
            
             $video_link=$fileData['video_link'];
             if (strpos($video_link, 'youtube.com') !== false)
             {
                 echo "<td><a href='$video_link' target='_blank'>$video_link</a><br></td>";
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
     if (isset($_GET['video_desc'])) 
     {
         $video_desc = $_GET['video_desc'];
         
         // 使用 mysqli_real_escape_string 處理 $video_desc 變數以避免 SQL 注入
         $video_desc = mysqli_real_escape_string($link, $video_desc);
     
         // 查詢資料庫以獲取檔案路徑
         $sql_search = "SELECT * FROM video WHERE video_desc = '$video_desc'";
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
     <form method=get action=video_list.php>
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
