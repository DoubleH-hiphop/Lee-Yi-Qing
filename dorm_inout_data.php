<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<style>
body { 
    background-image:url(bg.jpg); 
} 
</style>

</head>
<meta charset="utf-8">
<title>出入表</title>
</head>

<body>
<center><h4> <a href="main_dorm.html">主頁</a></center>
<div align="center">
<form action="dorm_inout_data.php" method="post">
<input type="test" name="YourName">
<input type="submit" value="查詢"/>
<input type="submit" value="全部資料"/>
</form>

<table border="1" style="width:95%">

<tr>
	<td><h4> 座號 </td>
	<td><h4> 出入時間 </td>
	<td><h4> 出入狀況 </td>
</tr>

　
<?php
include"connect.php";	#連線
ob_start();
$sqlQuery1 = "SELECT * FROM 出入表 order by 日期 DESC ";

$result1 = mysqli_query($connection,$sqlQuery1);	# 執行 MySQL/MariaDB 指令

$nums = mysqli_num_rows($result1);
echo '<h4>共 '.$nums.' 筆';

	while ($row = mysqli_fetch_row($result1)) 
    {
	echo"<tr>
			<td><h4> $row[0] </td>
			<td><h4> $row[1] </td>
			<td><h4> $row[2] </td>
		</tr>";
  }
  
$YourName=$_POST[YourName];

# MySQL/MariaDB 指令
$sqlQuery = "SELECT * FROM 出入表 where 座號='".$YourName."' order by 日期 DESC ";

$result = mysqli_query($connection,$sqlQuery);	# 執行 MySQL/MariaDB 指令
	
	if($YourName!=NULL)		#有查詢資料時，清空前資料
	{
		$num = mysqli_num_rows($result);
		ob_end_clean ();
		echo '<h4>共 '.$num.' 筆';
	}
	
	while ($row = mysqli_fetch_row($result)) 	# 取得結果
    {
	echo"<tr>
			<td><h4> $row[0] </td>
			<td><h4> $row[1] </td>
			<td><h4> $row[2] </td>
		</tr>";
	}
  	

mysqli_close($result);	# 釋放資源	# 釋放資源
	
mysqli_close($connection);	# 關閉 MySQL/MariaDB 連線
?>

</table>
</div>
</body>
</html>