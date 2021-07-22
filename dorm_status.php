<?php

include"connect.php";	#連線
# MySQL/MariaDB 指令
$sql = "SELECT 學生資料.科系,學生資料.座號,學生資料.姓名,出勤.目前狀態,IF(`目前狀態`=0 ,'紅' , '綠') as 顏色
FROM 學生資料 INNER JOIN 出勤 ON 學生資料.座號=出勤.座號";

# 執行 MySQL/MariaDB 指令
$result = mysqli_query($connection,$sql);
  mysqli_close($result);

# 關閉 MySQL/MariaDB 連線
mysqli_close($connection);
?>
