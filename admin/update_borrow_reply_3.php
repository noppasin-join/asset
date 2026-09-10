<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$id = '';
$id_take_list = '';
$id_data_lda = '';
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
$id=$_GET['id'] ?? '';
$id_take_list=$_GET['id_take_list'] ?? '';
$id_data_lda=$_GET['id_data_lda'] ?? '';

  $sql_data_borrow = ams_sql("delete from data_take_list_more where id_data_take=? and id_data_take_list=? and id_data_lda=?", ["$id", "$id_take_list", "$id_data_lda"]);
	$qr_borrow=ams_query($link,$sql_data_borrow) or die ("Error 4");

	$sql_data = ams_sql("delete from data_date_borrow where id_data_take=? and id_data_take_list=? and id_data_lda=?", ["$id", "$id_take_list", "$id_data_lda"]);
	$qr_data=ams_query($link,$sql_data) or die ("Error 2");


echo "<meta http-equiv=\"Refresh\" content=\"0; URL=form_borrow.php?j=1&id=$id&#tbl2\">";


?>
</body>
</html>
<?php } ?>
