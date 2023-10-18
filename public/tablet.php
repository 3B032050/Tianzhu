<?php
require_once "config.php";
$sql = "SELECT * FROM song";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="pragma" content="no-cache"> 
    <meta http-equiv="expires" content="0">
    <title>牌位登記</title>
 
  <style>
    a{text-decoration:none}
    a:hover{text-decoration:none}
    a:link     {color: pink;} 
    a:visited  {color: pink;}
    a:hover    {color: blue;} 	
    a:active   {color: red}

  table,th,td
{	
  
	border:2px solid black; 		
}
  </style>
</SCRIPT> 
</head>
<body>
<body bgcolor="#cccccc">
<table align="center"> <!--設定一個table放表格-->
<colgroup span="3" style="background-color: gray;"></colgroup>
<tr> <!--直排-->
<th><font size="5"><a href="wocao.php">回上一頁</th> <!--橫排-->
<th><font size="5"><a href="activety.php">活動紀實</th>
<th><font size="5"><a href="bright light.php">光明燈登記</th>

</table>
</body>
</html>