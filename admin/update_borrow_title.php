<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$id = '';
$id_take_list = '';
$txt_title1 = '';
$amount = '';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
	$sess_user = $_SESSION['sess_user'] ?? '';
	$sess_password = $_SESSION['sess_password'] ?? '';

	require_once __DIR__ . '/con_lda.php';
	if ($sess_user == "" || $status!=0 || $level=="0") {
    ams_deny(403, 'Insufficient permissions.');
	} else {
	set_time_limit(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
</head>
<body>
<?php
$id=$_POST['id'] ?? '';
$id_take_list=$_POST['id_take_list'] ?? '';
$txt_title1=$_POST['txt_title1'] ?? '';
$amount=$_POST['amount'] ?? '';
$trim_title1=trim($txt_title1);

if($amount=="1") {

	$sql_main_title = ams_sql("select * from  data_date_borrow where id_data_take_list=?", ["$id_take_list"]);
	$qr_main_title=ams_query($link,$sql_main_title) or die ("เลือกข้อมูลไม่ได้");
	$num_main_title=mysqli_num_rows($qr_main_title);

			if($num_main_title=="0") {
				$sql_data1 = ams_sql("update data_take_list set title=? where id=?", ["$trim_title1", "$id_take_list"]);
				$qr_data1=ams_query($link,$sql_data1) or die ("Error Update Check2");
				echo "<meta http-equiv=\"Refresh\" content=\"0; URL=form_borrow.php?j=1&id=$id\">";
			} else {
				echo "<SCRIPT LANGUAGE='JavaScript'>alert('ไม่สามารถเปลี่ยนรายการได้ เนื่องด้วยรายการเก่ามีการเลือกครุภัณฑ์ให้ยืมแล้ว!')</script>";
				echo "<meta http-equiv=\"Refresh\" content=\"0; URL=form_borrow.php?j=1&id=$id\">";
			}

} else {

	$sql_ch_title = ams_sql("select * from  data_date_borrow where id_data_take_list=?", ["$id_take_list"]);
	$qr_ch_title=ams_query($link,$sql_ch_title) or die ("เลือกข้อมูลไม่ได้");
	$num_ch_title=mysqli_num_rows($qr_ch_title);
	if($num_ch_title!="0") {

		echo "<SCRIPT LANGUAGE='JavaScript'>alert('ไม่สามารถเปลี่ยนรายการได้ เนื่องด้วยรายการเก่ามีการเลือกครุภัณฑ์ให้ยืมแล้ว!')</script>";
		echo "<meta http-equiv=\"Refresh\" content=\"0; URL=form_borrow.php?j=1&id=$id\">";

	} else {
		$sql_ch_title9 = ams_sql("select * from  data_take_list where title=? and id=? ", ["$trim_title1", "$id_take_list"]);
		$qr_ch_title9=ams_query($link,$sql_ch_title9) or die ("เลือกข้อมูลไม่ได้");
		$num_ch_title9=mysqli_num_rows($qr_ch_title9);
		if($num_ch_title9!="0") {
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=form_borrow.php?j=1&id=$id\">";
		} else {
			$sql_data1 = ams_sql("update data_take_list set title=? where id=?", ["$trim_title1", "$id_take_list"]);
			$qr_data1=ams_query($link,$sql_data1) or die ("Error Update Check2");
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=form_borrow.php?j=1&id=$id\">";
		}
	}

}



?>
</body>
</html>
<?php } ?>
