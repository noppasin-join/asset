<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$id = '';
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
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
</head>

<body>
<?php

$id=$_GET['id'] ?? '';
$sql_del = ams_sql("select * from  data_lda where id=? ", ["$id"]);
$qr_del=ams_query($link,$sql_del) or die ("Error Connect Data");
$rs_del=mysqli_fetch_array($qr_del);
$year_budget_list=$rs_del['year_budget'];
$file_img=$rs_del['file_img'];
$file_att=$rs_del['file_att'];
if ($file_img != "-") {
		unlink("file_img/$year_budget_list/$file_img");
}
if ($file_att != "-") {
		unlink("file_att/$year_budget_list/$file_att");
}

$sql_del_data=ams_sql("delete from data_lda where id=? ", ["$id"]);
$qr_del_data=ams_query($link,$sql_del_data) or die ("Delete Not Complete");

echo "<meta http-equiv=\"Refresh\" content=\"0; URL=data.php?d4=1&v_del=1\">";



		?>

</body>
</html>
<?php } ?>
