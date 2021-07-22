<html>
<head>
<title>查詢結果</title>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

</head>
<body>
<table class="table table-bordered">
<tr>
	<td>座號</td><td>出入次數</td><td>記點次數</td>	
</tr>

<?php
include"connect.php";	#連線
$id=$_POST[id];

$sqlQuery = "SELECT 座號,出入次數,記點次數,目前狀態 FROM 出勤 where 座號='".$id."'";	# MySQL/MariaDB 指令

$result = mysqli_query($connection,$sqlQuery);	# 執行 MySQL/MariaDB 指令

	while ($row = mysqli_fetch_row($result)) 	# 取得結果
	{
		$status=$row[3];	#目前狀態
		
		$name=$row[0];
		
		if($name!=$id)
		{
			echo "Error";
		}
		else
		{
			if ($status==1)		#狀態為1
			{
				$bgcolor1="#FF5511";	#紅色
			}
			else
			{
				$bgcolor1="#00DD77";	#綠色
			}	
			echo "<tr bgcolor=".$bgcolor1.">
					<td> $name </td>
					<td> $row[1] </td>
					<td> $row[2] </td>
				 </tr>";
		}	
	}
	
mysqli_close($result);	# 釋放資源	# 釋放資源
mysqli_close($connection);	# 關閉 MySQL/MariaDB 連線
?>	
    
</table>
</body>

</html>