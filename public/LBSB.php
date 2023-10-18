<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>居士學佛</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>    
<body>
    <form style="text-align:center" action="">
        <a href='web.php' class='nav-item nav-link'>回首頁</a><br><hr><br>
    </form> 
<?php
session_start();
$link = @mysqli_connect('localhost:33060', 'root', 'root', 'tianzhu');
mysqli_query($link, 'SET CHARACTER SET utf8');

if (isset($_GET['hierarchy_id']))
{
    if (isset($_GET['lastlayer']))
    {
        $id_before = explode('.',$_GET['hierarchy_id']);
        $length = count($id_before);
        unset($id_before[$length-1]);
        $id_after = implode('.',$id_before);
        $hierarchy_id = $id_after; 
    }
    else
    {
        $hierarchy_id = $_GET['hierarchy_id'];
    }
}
else
{
    $hierarchy_id = 1;
}

// add into data
if (isset($_GET['hierarchy_add_submit']))
{
    $web_id = $_GET['web_id'];
    $parent_id= $_GET['parent_id'];
    $web_name = $_GET['web_name'];
    $web_title = $_GET['web_title'];
    $create_date = date("Y-m-d H:i:s");

    $sql_search = "SELECT * FROM web_hierarchy WHERE web_id='$web_id'";
    if ($result = mysqli_query($link,$sql_search))
    {
        if (@mysqli_num_rows($result)>0)
        {
            echo "<script>alert('不可重複輸入!')</script>";
        }
        else
        {
            $sql_insert = "INSERT INTO `web_hierarchy`(`web_id`, `parent_id` , `web_name`, `web_title` , `create_date`) 
            VALUES ('$web_id','$parent_id','$web_name','$web_title','$create_date')";
            mysqli_query($link,$sql_insert);
        }
    }
}



//頁面階層增/減
echo "<table border=1 align=center width=1050>";
echo "<form method=get action=LBSB.php>";
echo "<input type=hidden name=hierarchy_id value='$hierarchy_id'>";
echo "<th colspan=7>目前位於第：".$hierarchy_id."層"; 
if ($hierarchy_id != 1)
{
    echo "<input type=submit name=lastlayer value=回上一層>";
}
echo "<input type=submit name=hierarchy_add value=新增子階層></th>";
echo "</form>";
$sql_search = "SELECT * FROM web_hierarchy WHERE parent_id='$hierarchy_id'";
echo "<tr align=center>
        <td width=150>階層代號</td>
        <td width=220>階層名稱</td>
        <td width=110>網頁標題</td>
        <td width=110>建立日期</td>
        <td width=150>網站內容</td>";
        if (!isset($_GET['hierarchy_add']))
        {
            echo "<td width=100>順序調整</td>";
        }
        echo "
        <td width=100>刪除階層</td>
        </tr>";
if ($result = mysqli_query($link,$sql_search))
{
    if (@mysqli_num_rows($result)>0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            if ($row <> null)
            {
                echo "<form method=get action=LBSB.php>";
                echo "<tr align=center>";
                echo "<td>";
                echo $row['web_id'];
                echo "<input type=hidden name=hierarchy_id value=".$row['web_id'].">";
                echo "</td><td>".$row['web_name'];
                echo "</td><td>";
                echo "<input type=submit name=web_name value=".$row['web_title'].">";
                echo "</td><td>".$row['create_date'];
                echo "</td><td><a href=Testing_web_view.php?web_id=".$row['web_id']."&web_title=".$row['web_title']."><input type=button name=web_view value=查看內容></a>";
                if (!isset($_GET['hierarchy_add']))
                {
                    $array_id= explode(".",$row['web_id']);
                    $array_count = count($array_id);
                    if ($array_id[$array_count-1] == 1)
                    {
                        echo "</td><td><a href=Testing.php?down=".$row['web_id']."><input type=button name=down value='&darr;'></a>";
                    }
                    else if ($array_id[$array_count-1] == mysqli_num_rows($result))
                    {
                        echo "</td><td><a href=Testing.php?up=".$row['web_id']."><input type=button name=up value='&uarr;'></a>";
                    }
                    else
                    {
                        echo "</td><td><a href=LBSB.php?up=".$row['web_id']."><input type=button name=up value='&uarr;'></a>";
                        echo "<a href=LBSB.php?down=".$row['web_id']."><input type=button name=down value='&darr;'></a>";
                    }
                }
                
                
                
                echo "</td><td>";
                echo "<button><a href=javascript:if(confirm('確定要刪除嗎?'))window.location='Testing.php?hierarchy_delete=".$row['web_id']."&hierarchy_id=".$row['parent_id']."'>刪除階層</a></button>";
                echo "</td>";
                echo "</tr>";
                echo "</form>";
            }
        }
    }
}


echo "<form method=get action=LBSB.php>";
$maximum = 0;
if (isset($_GET['hierarchy_add']))
{
    $sql_search = "SELECT * FROM web_hierarchy WHERE parent_id='$hierarchy_id'";
    if ($result = mysqli_query($link,$sql_search))
    {
        if (@mysqli_num_rows($result)>0)
        { 
            while($row = mysqli_fetch_assoc($result))
            {
                if ($row <> null)
                {
                    $array_id= explode(".",$row['web_id']);
                    $array_count = count($array_id);
                    $array_create = $array_id[$array_count-1];
                    if ($array_create > $maximum)
                    {
                        $maximum = $array_create;
                    }
                }
            }
            $array_id[$array_count-1] = $maximum + 1;
            $array_after = implode(".",$array_id);
        }
        else
        {
            $array_after = $hierarchy_id.".1";
        }
    }

    echo "<input type=hidden name=parent_id value='$hierarchy_id'>";
    echo "<input type=hidden name=hierarchy_id value='$hierarchy_id'>";
    echo "<tr align=center>";
    echo "<td>";
    echo "<input type=text name=web_id value=".$array_after." readonly=readonly>";
    echo "</td><td>";
    echo "<input type=text name=web_name>";
    echo "</td><td>";
    echo "<input type=text name=web_title>";
    echo "</td><td colspan=3>";
    echo "<input type=submit name=hierarchy_add_submit value=新增階層>";
    echo "<input type=submit name=hierarchy_add_cancel value=取消新增>";
    echo "</td>";
    echo "</tr>";
}
echo "</form>";
echo "</table>";



?>

</body>
</html>