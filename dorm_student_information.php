<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>學生住宿</title>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<style>
table tr{
    border-collapse:separate;
    collapse;border:1.5px solid black;
}
td{
	border:1px solid black;
}

body { 
    background-image:url(bg.jpg); 
	
} 

</style>
</head>

<body align="center"><h1>住宿資訊</h1> 

<table class="table " style="width:95%" align="center">
<a href="main_dorm.html"><h4>主頁</h4></a>

<tr>
	<td> 科系 </td>	<td> 座號 </td>	<td> 姓名 </td>	<td> 性別 </td>	<td>房號</td>	
</tr>

<?php
include"connect.php";	#連線

$sql = 
	"SELECT  distinct 學生資料.科系,學生資料.座號,學生資料.姓名,學生資料.性別,學生資料.房號,出勤.目前狀態 
	FROM 學生資料  INNER JOIN 出勤 ON 學生資料.座號=出勤.座號   
	where `身分`<4 
	ORDER by 房號 ";	# MySQL/MariaDB 指令
$result = mysqli_query($connection,$sql);	# 執行 MySQL/MariaDB 指令

$data_nums  = mysqli_num_rows($result);
$per = 8; 			#每頁顯示項目數量
$pages = ceil($data_nums/$per);	#總頁碼
	
	if (!isset($_GET["page"]))	#假如$_GET["page"]未設置
	{ 	
		$page=1; #則在此設定起始頁數
	} 
	else 
	{
		$page = intval($_GET["page"]); #確認頁數只能夠是數值資料
	}

$start = ($page-1)*$per; #每一頁開始的資料序號

$sqlQuery =
	"SELECT 學生資料.科系,學生資料.座號,學生資料.姓名,學生資料.性別,學生資料.房號,出勤.目前狀態 
	FROM 學生資料  INNER JOIN 出勤 ON 學生資料.座號=出勤.座號   
	where `身分`<4 
	ORDER by 房號 
	LIMIT $start,$per";	# MySQL/MariaDB 指令

$result1 = mysqli_query($connection,$sqlQuery);	# 執行 MySQL/MariaDB 指令

	while ($row = mysqli_fetch_row($result1)) 	# 取得結果
	{
		$status=$row[5];	#目前狀態
		if ($status==1)		#狀態為1
        {
          $bgcolor1="#FF5511";	#紅色
        }
        else
        {
          $bgcolor1="#00DD77";	#綠色
        }
		
        echo "<tr bgcolor=".$bgcolor1.">
				<td> $row[0] </td>
				<td> $row[1] </td>
				<td> $row[2] </td>
				<td> $row[3] </td>
				<td> $row[4] </td>
			</tr>"
	;}
	
mysqli_close($result);	# 釋放資源	# 釋放資源
mysqli_close($connection);	# 關閉 MySQL/MariaDB 連線			
?>
</table>

<?php
echo '共 '.$data_nums.' 筆 在 '.$page.' 頁 共 '.$pages.' 頁';
    echo "<br /><a href=?page=1>首頁</a> ";
    echo "第 ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
        if ( $page-3 < $i && $i < $page+3 ) {
            echo "<a href=?page=".$i.">".$i."</a> ";
        }
    } 
    echo " 頁 <a href=?page=".$pages.">末頁</a><br /><br />";
?>

	<!-- 學生出入/記點查詢 -->
	<form 
		action="dorm_check.php" target="search_form" 
		onsubmit="window.open('','search_form','resizable=1, scrollbars=1,width=400,height=300')" method="post">
		<input type="test" name="id" placeholder="Search for..."/>
		<input type="submit" value="查詢"/>
	</form>
	
	
	

</body>
</html>


