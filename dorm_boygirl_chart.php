<?php
include"connect.php";	#連線
$sql = "select date_format(`日期`, '%Y%m')AS 日期,COUNT(date_format(`日期`, '%Y%m')) as 次數,`學生資料`.`性別`
FROM `出勤` INNER JOIN `學生資料` ON `學生資料`.`座號`=`出勤`.`座號` INNER JOIN `遲到` ON `出勤`.`座號` = `遲到`.`座號`
GROUP by date_format(`日期`, '%Y%m'),`學生資料`.`性別`
ORDER BY date_format(`日期`, '%Y%m'),`學生資料`.`房號`,COUNT(date_format(`日期`, '%Y%m'))DESC";
$result = mysqli_query($connection,$sql);	# 執行 MySQL/MariaDB 指令
$male = []; # 放男生的計點次數
$female = [];# 放女生的計點次數
while ($row = mysqli_fetch_row($result))    # 取得結果
{
    if($row[2] == "男"){
        $male[$row[0]] = $row[1];
    }elseif($row[2] == "女"){
        $female[$row[0]] = $row[1];
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
        labels: [<?php foreach ($male as $key => $value) {echo sprintf("%s,",$key);} ?>],
        datasets: [{
            label: '男生',
            data:[<?php foreach ($male as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(54, 162, 235, 0.5)'],
            borderColor: ['rgba(54, 162, 235, 1)'],
            borderWidth: 1
        },
        {
            label: '女生',
            data:[<?php foreach ($female as $key) {echo $key.",";} ?>],
            backgroundColor: ['rgba(255, 99, 132, 0.5)'],
            borderColor: ['rgba(255, 99, 132, 1)'],
            borderWidth: 1
        }]
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