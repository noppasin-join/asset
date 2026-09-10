<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$id = '';
$s_page2 = '';
$urlquery_str2 = '';
$txt_title_search = '';
$txt_no_search = '';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
	$sess_user = $_SESSION['sess_user'] ?? '';
	$sess_password = $_SESSION['sess_password'] ?? '';

	require_once __DIR__ . '/con_lda.php';
	if ($sess_user == "" || $status!="0" || $level=="0") {
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
$sql_year = "SELECT * from  budget order by year_budget desc   ";
$dbquery_year=ams_query($link,$sql_year) or die ("เลือกข้อมูลไม่ได้");
$result_year=mysqli_fetch_array($dbquery_year);
$year_budget=$result_year['year_budget'];

$id=$_GET['id'] ?? '';
$s_page2=$_GET['s_page2'] ?? '';
$urlquery_str2=$_GET['urlquery_str2'] ?? '';
$txt_title_search=$_GET['txt_title_search'] ?? '';
$txt_no_search=$_GET['txt_no_search'] ?? '';





						$sql_del = ams_sql("DELETE from data_lda where id=? ", ["$id"]);
						$qr_del=ams_query($link,$sql_del) or die ("Error Delete Data");

						echo "<meta http-equiv=\"Refresh\" content=\"0; URL=data.php?d4=1&s_page2=$s_page2&urlquery_str2=$urlquery_str2&txt_title=$txt_title_search&txt_no=$txt_no_search&g=1\">";





		?>

</body>
</html>
<?php } ?>
