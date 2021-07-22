<?php
include"connect.php";	#連線
$sql = "select date_format(`日期`, '%Y%m')AS 日期,COUNT(date_format(`日期`, '%Y%m')) as 次數 ,`學生資料`.`座號`
FROM `出勤` INNER JOIN `學生資料` ON `學生資料`.`座號`=`出勤`.`座號`INNER JOIN `遲到` ON `出勤`.`座號` = `遲到`.`座號`
WHERE date_format(`日期`, '%Y%m')='202106'
GROUP by `學生資料`.`姓名`,date_format(`日期`, '%Y%m')
ORDER BY COUNT(date_format(`日期`, '%Y%m'))DESC
LIMIT 10";
$result = mysqli_query($connection,$sql);	# 執行 MySQL/MariaDB 指令
$p1 = array("0","0","0","0","0","0","0","0","0","0");


$now=0;
while ($row = mysqli_fetch_row($result))    # 取得結果
{
	$p1[$now]=$row[2];	
	$now++;
	
	if($row[2] == $p1[0]){
        $n1[$row[0]] = $row[1];
    }elseif($row[2] == $p1[1]){
        $n2[$row[0]] = $row[1];
	}elseif($row[2] == $p1[2]){
        $n3[$row[0]] = $row[1];
	}elseif($row[2] == $p1[3]){
        $n4[$row[0]] = $row[1];
	}elseif($row[2] == $p1[4]){
        $n5[$row[0]] = $row[1];
	}elseif($row[2] == $p1[5]){
        $n6[$row[0]] = $row[1];
	}elseif($row[2] == $p1[6]){
        $n7[$row[0]] = $row[1];
	}elseif($row[2] == $p1[7]){
        $n8[$row[0]] = $row[1];
	}elseif($row[2] == $p1[8]){
        $n9[$row[0]] = $row[1];
	}elseif($row[2] == $p1[9]){
        $n10[$row[0]] = $row[1];
	}
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf8">
    <title>男女記點次數比較圖</title>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
<center> <a href="main_dorm.html">主頁</a> </center>

<canvas id="myChart"></canvas>
<script>
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php foreach ($n1 as $key => $value) {echo sprintf("%s,",$key);} ?>],
        datasets: [{
            label: '<?php echo "$p1[0]" ?>',
            data:[<?php foreach ($n1 as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(54, 162, 235, 0.5)'],
            borderColor: ['rgba(54, 162, 235, 1)'],
            borderWidth: 1
        },{
            label: '<?php echo "$p1[1]" ?>',
            data:[<?php foreach ($n2 as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(255, 99, 132, 0.5)'],
            borderColor: ['rgba(255, 99, 132, 1)'],
            borderWidth: 1
        },{
            label: '<?php echo "$p1[2]" ?>',
            data:[<?php foreach ($n3 as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(255, 159, 64, 0.5)',],
            borderColor: ['rgba(255, 159, 64, 1)'],
            borderWidth: 1
        },{
            label: '<?php echo "$p1[3]" ?>',
            data:[<?php foreach ($n4 as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(255, 205, 86, 0.5)',],
            borderColor: ['rgba(255, 205, 86, 1)'],
            borderWidth: 1
        },{
            label: '<?php echo "$p1[4]" ?>',
            data:[<?php foreach ($n5 as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(153, 102, 255, 0.5)'],
            borderColor: ['rgba(575, 192, 192, 1)'],
            borderWidth: 1
        },{
            label: '<?php echo "$p1[5]" ?>',
            data:[<?php foreach ($n6 as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(172, 51, 13, 0.5)'],
            borderColor: ['rgba(201, 203, 207, 1)'],
            borderWidth: 1
        },{
            label: '<?php echo "$p1[6]" ?>',
            data:[<?php foreach ($n7 as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(75, 192, 192, 0.5)'],
            borderColor: ['rgba(75, 192, 192, 1)'],
            borderWidth: 1
        },{
            label: '<?php echo "$p1[7]" ?>',
            data:[<?php foreach ($n8 as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(201, 112, 175, 0.5)'],
            borderColor: ['rgba(201, 162, 175, 1)'],
            borderWidth: 1
        },{
            label: '<?php echo "$p1[8]" ?>',
            data:[<?php foreach ($n9 as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(75, 203, 100, 0.5)'],
            borderColor: ['rgba(54, 162, 235, 1)'],
            borderWidth: 1
        },{
            label: '<?php echo "$p1[9]" ?>',
            data:[<?php foreach ($n10 as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(104, 111, 35, 0.5)'],
            borderColor: ['rgba(54, 162, 235, 1)'],
            borderWidth: 1
        }
        
		]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

</body>

</html>