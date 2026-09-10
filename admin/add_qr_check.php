<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$id_barcode = '';
$id_check = '';
$id_data_lda = '';
$txt_use = '';
$choose_location = '';
$choose_status = '';
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
$id_barcode=$_POST['id_barcode'] ?? '';
$id_check=$_POST['id_check'] ?? '';
$id_data_lda=$_POST['id_data_lda'] ?? '';
$txt_use=$_POST['txt_use'] ?? '';
$choose_location=$_POST['choose_location'] ?? '';
$choose_status=$_POST['choose_status'] ?? '';
$txt_note=$_POST['txt_note'] ?? '';
$var_use=trim($txt_use);
$var_note=trim($txt_note);


		$sql_data1 = ams_sql("UPDATE data_check set status='1',name_use=?,id_location=?,note=?,
		id_member_check=?,
		status_new=?,date_check=?,time_check=?
		where id=?", ["$var_use", "$choose_location", "$var_note", "$id_member", "$choose_status", "$day/$month/$year", "$time_log", "$id_check"]);
		$qr_number1=ams_query($link,$sql_data1) or die ("Error Check");

		$sql_data2 = ams_sql("UPDATE data_lda set lda_status=?,id_location=?,name_use=?,note=?,
		id_member_update=?,date_update=?,time_update=? where id=?", ["$choose_status", "$choose_location", "$var_use", "$var_note", "$id_member", "$day/$month/$year", "$time_log", "$id_data_lda"]);
		$qr_number2=ams_query($link,$sql_data2) or die ("Error Check");

	echo "<meta http-equiv=\"Refresh\" content=\"0; URL=qrcode.php?q1=1&v_success=1\">";

?>
</body>
</html>
<?php } ?>
