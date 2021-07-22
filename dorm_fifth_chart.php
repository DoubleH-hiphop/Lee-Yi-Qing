<?php
include"connect.php";	#連線
$sql = "select date_format(`日期`, '%Y%m')AS 日期,COUNT(date_format(`日期`, '%Y%m')) as 次數, `學生資料`.`房號`
FROM `出勤` INNER JOIN `學生資料` ON `學生資料`.`座號`=`出勤`.`座號`INNER JOIN `遲到` ON `出勤`.`座號` = `遲到`.`座號`
WHERE (date_format(`日期`, '%Y%m') BETWEEN '202104' AND '202106') AND `性別`='男'
GROUP by `學生資料`.`房號`,date_format(`日期`, '%Y%m')
ORDER BY date_format(`日期`, '%Y%m'),`學生資料`.`房號`";
$result = mysqli_query($connection,$sql);	# 執行 MySQL/MariaDB 指令
$f501 = [];
$f502 = [];
$f503 = [];
$f504 = [];
$f505 = [];
$f506 = [];
$f507 = [];
while ($row = mysqli_fetch_row($result))    # 取得結果
{
    if($row[2] == "501"){
        $f501[$row[0]] = $row[1];
    }elseif($row[2] == "502"){
        $f502[$row[0]] = $row[1];
    }elseif($row[2] == "503"){
        $f503[$row[0]] = $row[1];
    }elseif($row[2] == "504"){
        $f504[$row[0]] = $row[1];
    }elseif($row[2] == "505"){
        $f505[$row[0]] = $row[1];
    }elseif($row[2] == "506"){
        $f506[$row[0]] = $row[1];
    }elseif($row[2] == "507"){
		$f507[$row[0]] = $row[1];
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
        labels: [<?php foreach ($f501 as $key => $value) {echo sprintf("%s,",$key);} ?>],
        datasets: [{
            label: '501',
            data:[<?php foreach ($f501 as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(54, 162, 235, 0.5)'],
            borderColor: ['rgba(54, 162, 235, 1)'],
            borderWidth: 1
        },{
            label: '502',
            data:[<?php foreach ($f502 as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(255, 99, 132, 0.5)'],
            borderColor: ['rgba(255, 99, 132, 1)'],
            borderWidth: 1
        },{
            label: '503',
            data:[<?php foreach ($f503 as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(255, 159, 64, 0.5)',],
            borderColor: ['rgba(255, 159, 64, 1)'],
            borderWidth: 1
        },{
            label: '504',
            data:[<?php foreach ($f504 as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(255, 205, 86, 0.5)',],
            borderColor: ['rgba(255, 205, 86, 1)'],
            borderWidth: 1
        },{
            label: '505',
            data:[<?php foreach ($f505 as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(153, 102, 255, 0.5)'],
            borderColor: ['rgba(575, 192, 192, 1)'],
            borderWidth: 1
        },{
            label: '506',
            data:[<?php foreach ($f506 as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(21, 203, 207, 0.5)'],
            borderColor: ['rgba(21, 203, 207, 1)'],
            borderWidth: 1
        },{
            label: '507',
            data:[<?php foreach ($f507 as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(75, 192, 192, 0.5)'],
            borderColor: ['rgba(75, 192, 192, 1)'],
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