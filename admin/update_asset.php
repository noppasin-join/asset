<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php


	set_time_limit(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
</head>
<body>
<?php

$sql_year = "select * from  data_lda order by id desc   ";
$dbquery_year=ams_query($link,$sql_year) or die ("เลือกข้อมูลไม่ได้");
$num_br2=mysqli_num_rows($dbquery_year);


$i=0;
	while($i<$num_br2)
	{
		$result_year=mysqli_fetch_array($dbquery_year);
		$id=$result_year['id'];
		$barcode1=$result_year['barcode1'];

		$sql_list = ams_sql("select * from  sheet1 where barcode1=? ", ["$barcode1"]);
		$qr_list=ams_query($link,$sql_list) or die ("เลือกข้อมูลไม่ได้");
		$rs_list=mysqli_fetch_array($qr_list);
		$asset=$rs_list['asset'];

		$sql_approve = ams_sql("update data_lda set asset=? where id=?", ["$asset", "$id"]);
		$qr_approve=ams_query($link,$sql_approve) or die ("Error Update Approve");

	$i++;
	}



?>
</body>
</html>
