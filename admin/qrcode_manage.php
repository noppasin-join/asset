<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$id = '';
$c = '';
$s_page2 = '';
$urlquery_str2 = '';
$txt_title_search = '';
$txt_no_search = '';
$choose_category = '';
$choose_status = '';
$choose_location = '';
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
$c=$_GET['c'] ?? '';
$s_page2=$_GET['s_page2'] ?? '';
$urlquery_str2=$_GET['urlquery_str2'] ?? '';
$txt_title_search=$_GET['txt_title_search'] ?? '';
$txt_no_search=$_GET['txt_no_search'] ?? '';

$choose_category=$_GET['choose_category'] ?? '';
$choose_status=$_GET['choose_status'] ?? '';
$choose_location=$_GET['choose_location'] ?? '';

if($c=="1") {
	$sql_update=ams_sql("UPDATE data_lda set qrcode_check='1' where id=?", ["$id"]);
} else {
	$sql_update=ams_sql("UPDATE data_lda set qrcode_check='' where id=?", ["$id"]);
}
	$qr_update=ams_query($link,$sql_update) or die ("Error Check QR Code");

echo "<meta http-equiv=\"Refresh\" content=\"0; URL=data.php?d4=1&s_page2=$s_page2&urlquery_str2=$urlquery_str2&txt_title=$txt_title_search&txt_no=$txt_no_search&choose_category=$choose_category&choose_status=$choose_status&choose_location=$choose_location&g=1\">";



		?>

</body>
</html>
<?php } ?>
