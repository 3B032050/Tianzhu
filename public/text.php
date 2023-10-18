<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="pragma" content="no-cache"> 
    <meta http-equiv="expires" content="0">
    <title>光明燈登記</title>
 
    <style>
      a {
        text-decoration: none;
      }
      a:hover {
        text-decoration: none;
      }
      a:link {
        color: pink;
      }
      a:visited {
        color: pink;
      }
      a:hover {
        color: blue;
      }
      a:active {
        color: red;
      }
      table, th, td {
        border: 2px solid black;
      }
      body {
        background-color: #cccccc;
        text-align: center; /* 居中页面文本 */
      }
      .centered {
        text-align: center; /* 居中内部文本 */
      }
      label {
        display: inline-block;
        width: 150px; /* 设置标签的宽度，根据需要调整 */
        text-align: right;
    }
    input {
        width: 200px; /* 设置输入字段的宽度，根据需要调整 */
    }
    </style>
  </head>
  <body>
    <table align="center"> <!--设置一个table放表格-->
      <colgroup span="3" style="background-color: gray;"></colgroup>
      <tr> <!--直排-->
        <th><font size="5"><a href="wocao.php">回上一頁</a></th> <!--横排-->
        <th><font size="5"><a href="activety.php">活動紀實</a></th>
        <th><font size="5"><a href="tablet.php">牌位登記</a></th>
      </tr>
    </table>

    <h2 class="centered">新增資料</h2>
    <form method="post" action="process_data.php">
    <label for="birthdate">出生年月日：</label>
    <input type="text" name="birthdate" id="birthdate" required>
    <br>
    <label for="name">姓名：</label>
    <input type="text" name="name" id="name" required>
    <br>
    <label for="data_to_modify">電話號碼：</label>
    <input type="text" name="data_to_modify" id="data_to_modify" required>
    <br>
    <input type="submit" value="提交修改">
</form>
  </body>
</html>