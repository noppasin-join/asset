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

// Table data_date_borrow
$sql_data_date_borrow = ams_sql("select * from  data_date_borrow where id_data_take=? ", ["$id"]);
$qr_data_date_borrow=ams_query($link,$sql_data_date_borrow) or die ("Error Check Data Date Borrow");
$total_data_date_borrow=mysqli_num_rows($qr_data_date_borrow);
if ($total_data_date_borrow!=0) {
	$sql_data_date_borrow_del=ams_sql("delete from data_date_borrow where id_data_take=? ", ["$id"]);
	$qr_data_date_borrow_del=ams_query($link,$sql_data_date_borrow_del) or die ("Delete Data Date Borrow Error");
}

// Table data_take_list_more
$sql_data_take_list_more = ams_sql("select * from  data_take_list_more where id_data_take=? ", ["$id"]);
$qr_data_take_list_more=ams_query($link,$sql_data_take_list_more) or die ("Error Check Data Take List More");
$total_data_take_list_more=mysqli_num_rows($qr_data_take_list_more);
if ($total_data_take_list_more!=0) {
	$sql_data_take_list_more_del=ams_sql("delete from data_take_list_more where id_data_take=? ", ["$id"]);
	$qr_data_take_list_more_del=ams_query($link,$sql_data_take_list_more_del) or die ("Delete Data Take List More Error");
}

// Table data_take_list
$sql_data_take_list = ams_sql("select * from  data_take_list where id_data_take=? ", ["$id"]);
$qr_data_take_list=ams_query($link,$sql_data_take_list) or die ("Error Check Data Take List ");
$total_data_take_list=mysqli_num_rows($qr_data_take_list);
if ($total_data_take_list!=0) {
	$sql_data_take_list_del=ams_sql("delete from data_take_list where id_data_take=? ", ["$id"]);
	$qr_data_take_list_del=ams_query($link,$sql_data_take_list_del) or die ("Delete Data Take List Error");
}
// Table data_take
$sql_data_take = ams_sql("select * from  data_take where id=? ", ["$id"]);
$qr_data_take=ams_query($link,$sql_data_take) or die ("Error Check Data Take");
$total_data_take=mysqli_num_rows($qr_data_take);
if ($total_data_take!=0) {
	$sql_data_take_del=ams_sql("delete from data_take where id=? ", ["$id"]);
	$qr_data_take_del=ams_query($link,$sql_data_take_del) or die ("Delete Data Take Error");
}


echo "<meta http-equiv=\"Refresh\" content=\"0; URL=data_borrow.php?j=1\">";

?>
</body>
</html>
<?php } ?>
