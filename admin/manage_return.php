<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$id = '';
$var_list = '';
$rt = '';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
	$sess_user = $_SESSION['sess_user'] ?? '';
	$sess_password = $_SESSION['sess_password'] ?? '';

	require_once __DIR__ . '/con_lda.php';
	if ($sess_user == "" || $status!=0 || $level=="0") {
    ams_deny(403, 'Insufficient permissions.');
	} else {
	set_time_limit(0);
?>
<html lang="en">
<head>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
</head>
<body>
<?php
$id=$_GET['id'] ?? '';
$var_list=$_GET['var_list'] ?? '';
$rt=$_GET['rt'] ?? '';


$sql_check = ams_sql("select * from  data_take_list_more where id = ?", ["$var_list"]);
$qr_check=ams_query($link,$sql_check) or die ("เลือกข้อมูลไม่ได้");
$num_check=mysqli_num_rows($qr_check);
$rs_check=mysqli_fetch_array($qr_check);
$id_data_take_list=$rs_check['id_data_take_list'];
$id_data_lda=$rs_check['id_data_lda'];

$day=date("d");
$month=date("m");
$year=date("Y")+543;
 $timelog=date("H:i");

	if($num_check!="0") {
			if($rt=="1") {
				$sql_data1 = ams_sql("update data_take_list_more set status_return='1',date_return=?,time_return=?,id_member_return=? where id=?", ["$day-$month-$year", "$timelog", "$id_member", "$var_list"]);
			} elseif($rt=="0") {
				$sql_data1 = ams_sql("update data_take_list_more set status_return='0',date_return='',time_return='',id_member_return='' where id=?", ["$var_list"]);
			}
				$qr_data1=ams_query($link,$sql_data1) or die ("Error Update Check1");
				$sql_data2 = ams_sql("update data_date_borrow set status_return=? where id_data_take=? and id_data_take_list=? and id_data_lda=?", ["$rt", "$id", "$id_data_take_list", "$id_data_lda"]);
				$qr_data2=ams_query($link,$sql_data2) or die ("Error Update Check2");

	}



			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=form_return.php?j2=1&id=$id\">";


?>
</body>
</html>
<?php } ?>
