<!DOCTYPE html>
<html>
<head>
<title>結果</title>
</head>
<body>
<?php
$座號=$_REQUEST["座號"];
?>
</body>
</html>

<?php  
include"connect.php";	#連線
$sql = "select * from 出勤  ";
$result = mysqli_query($connection,$sqlQuery);	# 執行 MySQL/MariaDB 指令

$rows=mysqli_affected_rows($connection);//獲取行數
$colums=mysqli_num_fields($result);//獲取列數
echo "資料庫"."$出勤"."的所有使用者資料如下：<br/>";
        echo "共計".$rows."行 ".$colums."列<br/>";
 echo "<table><tr>";
        for($i=0; $i < $colums; $i++){
            $field_name=mysqli_query($result,$i);
            echo "<th>$field_name</th>";
        }
echo "</tr>";
        while($row=mysqli_fetch_row($result)){
            echo "<tr>";
            for($i=0; $i<$colums; $i++){
                echo "<td>$row[$i]</td>";
            }
            echo "</tr>";
        }
        echo "</table>";

?>

