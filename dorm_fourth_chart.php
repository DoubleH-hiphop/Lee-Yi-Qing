<?php
include"connect.php";	#連線
$sql = "select date_format(`日期`, '%Y%m')AS 日期,COUNT(date_format(`日期`, '%Y%m')) as 次數, `學生資料`.`房號`
FROM `出勤` INNER JOIN `學生資料` ON `學生資料`.`座號`=`出勤`.`座號`INNER JOIN `遲到` ON `出勤`.`座號` = `遲到`.`座號`
WHERE (date_format(`日期`, '%Y%m') BETWEEN '202104' AND '202106') AND `性別`='女'
GROUP by `學生資料`.`房號`,date_format(`日期`, '%Y%m')
ORDER BY date_format(`日期`, '%Y%m'),`學生資料`.`房號`";
$result = mysqli_query($connection,$sql);	# 執行 MySQL/MariaDB 指令
$f401 = [];
$f402 = [];
$f403 = [];
$f404 = [];
$f405 = [];
$f406 = [];
while ($row = mysqli_fetch_row($result))    # 取得結果
{
    if($row[2] == "401"){
        $f401[$row[0]] = $row[1];
    }elseif($row[2] == "402"){
        $f402[$row[0]] = $row[1];
    }elseif($row[2] == "403"){
        $f403[$row[0]] = $row[1];
    }elseif($row[2] == "404"){
        $f404[$row[0]] = $row[1];
    }elseif($row[2] == "405"){
        $f405[$row[0]] = $row[1];
    }elseif($row[2] == "406"){
        $f406[$row[0]] = $row[1];
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
        labels: [<?php foreach ($f401 as $key => $value) {echo sprintf("%s,",$key);} ?>],
        datasets: [{
            label: '401',
            data:[<?php foreach ($f401 as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(54, 162, 235, 0.5)'],
            borderColor: ['rgba(54, 162, 235, 1)'],
            borderWidth: 1
        },{
            label: '402',
            data:[<?php foreach ($f402 as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(255, 99, 132, 0.5)'],
            borderColor: ['rgba(255, 99, 132, 1)'],
            borderWidth: 1
        },{
            label: '403',
            data:[<?php foreach ($f403 as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(255, 159, 64, 0.5)',],
            borderColor: ['rgba(255, 159, 64, 1)'],
            borderWidth: 1
        },{
            label: '404',
            data:[<?php foreach ($f404 as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(255, 205, 86, 0.5)',],
            borderColor: ['rgba(255, 205, 86, 1)'],
            borderWidth: 1
        },{
            label: '405',
            data:[<?php foreach ($f405 as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(153, 102, 255, 0.5)'],
            borderColor: ['rgba(575, 192, 192, 1)'],
            borderWidth: 1
        },{
            label: '406',
            data:[<?php foreach ($f406 as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(21, 203, 207, 0.5)'],
            borderColor: ['rgba(21, 203, 207, 1)'],
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