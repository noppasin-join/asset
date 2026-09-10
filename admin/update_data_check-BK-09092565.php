<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$id = '';
$data_lda = '';
$choose_location = '';
$choose_status = '';
$choose_location_new = '';
$txt_name = '';
$txt_note = '';
$s_page2 = '';
$urlquery_str2 = '';
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
$choose_location=$_POST['choose_location'] ?? '';
$choose_status=$_POST['choose_status'] ?? '';
$choose_location_new=$_POST['choose_location_new'] ?? '';
$txt_name=$_POST['txt_name'] ?? '';
$var_trim=trim($txt_name);
$txt_note=$_POST['txt_note'] ?? '';
$var_note=trim($txt_note);

$s_page2=$_POST['s_page2'] ?? '';
$urlquery_str2=$_POST['urlquery_str2'] ?? '';


	if($var_trim!="") {

		$sql_data1 = ams_sql("UPDATE data_check set name_use=?,id_location=?,status_new=?,
		id_member_check=?,
		note=?,date_check=?,time_check=?
		where id=?", ["$var_trim", "$choose_location_new", "$choose_status", "$id_member", "$var_note", "$day/$month/$year", "$time_log", "$id"]);
		$qr_number=ams_query($link,$sql_data1) or die ("Error Update Check1");

		$sql_data2 = ams_sql("UPDATE data_lda set lda_status=?,id_location=?,name_use=?,note=?,
		id_member_update=?,date_update=?,time_update=? where id=?", ["$choose_status", "$choose_location_new", "$var_trim", "$var_note", "$id_member", "$day/$month/$year", "$time_log", "$data_lda"]);
		$qr_number=ams_query($link,$sql_data2) or die ("Error Update Check2");

		echo "<meta http-equiv=\"Refresh\" content=\"0; URL=data_check.php?d5=1&choose_location=$choose_location&s_page2=$s_page2&urlquery_str2=$urlquery_str2&g=1\">";
	}

?>
</body>
</html>
<?php } ?>
