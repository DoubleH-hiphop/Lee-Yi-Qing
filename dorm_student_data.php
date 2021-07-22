<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>學生資料</title>
</head>

<body>
<table border="1" width="100%">

<tr>
	<td> 科系 </td>
	<td> 座號 </td>
	<td> 姓名 </td>
	<td> 性別 </td>
	<td> 房號 </td>
	<td> 身分 </td>
</tr>
		
<?php

$include"connect.php";	#連線
# MySQL/MariaDB 指令
$sqlQuery = "SELECT * FROM 學生資料 ";

# 執行 MySQL/MariaDB 指令
if ($result = $connection->query($sqlQuery)) {
  # 取得結果
  while ($row = $result->fetch_row()) {
    
	echo"<tr>
			<td> $row[0] </td>
			<td> $row[1] </td>
			<td> $row[2] </td>
			<td> $row[3] </td>
			<td> $row[4] </td>
			<td> $row[5] </td>
		</tr>";
  }
  	
  # 釋放資源
  $result->close();
} else {
  echo "執行失敗：" . $connection->error;
}

# 關閉 MySQL/MariaDB 連線
$connection->close();
?>

</table>
</body>
</html>