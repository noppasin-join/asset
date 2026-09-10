<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$id = '';
$data_lda = '';
$choose_locate_main = '';
$choose_status_main = '';
$choose_status = '';
$choose_locate = '';
$txt_name = '';
$txt_note = '';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
	$sess_user = $_SESSION['sess_user'] ?? '';
	$sess_password = $_SESSION['sess_password'] ?? '';

	require_once __DIR__ . '/con_lda.php';
	if ($sess_user == "" || $status!=0 || $num_menu_check!="1") {
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
$data_lda=$_POST['data_lda'] ?? '';
$choose_locate_main=$_POST['choose_locate_main'] ?? '';
$choose_status_main=$_POST['choose_status_main'] ?? '';

$choose_status=$_POST['choose_status'] ?? '';
$choose_locate=$_POST['choose_locate'] ?? '';
$txt_name=$_POST['txt_name'] ?? '';
$var_trim=trim($txt_name);
$txt_note=$_POST['txt_note'] ?? '';
$var_note=trim($txt_note);


	if($var_trim!="") {
		$sql_data1 = ams_sql("update data_staff_choose set name_use=?,id_location=?,note=?,date_check=?,time_check=?
		where id=?", ["$var_trim", "$choose_locate", "$var_note", "$day/$month/$year", "$time_log", "$id"]);
		$qr_number=ams_query($link,$sql_data1) or die ("Error Update Check1");
		$sql_data2 = ams_sql("update data_lda set lda_status=?,id_location=?,name_use=?,note=?,
		id_member_update=?,date_update=?,time_update=? where id=?", ["$choose_status", "$choose_locate", "$var_trim", "$var_note", "$id_member", "$day/$month/$year", "$time_log", "$data_lda"]);
		$qr_number=ams_query($link,$sql_data2) or die ("Error Update Check2");

	echo "<meta http-equiv=\"Refresh\" content=\"0; URL=data_check.php?d5=1&choose_locate_main=$choose_locate_main&choose_status_main=$choose_status_main&g=1\">";
	}

?>
</body>
</html>
<?php } ?>
