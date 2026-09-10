<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$id = '';
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

$y_check=ams_sql("SELECT * FROM data_lda  where id = ?  ", ["$id"]);
$qr_y_check=ams_query($link,$y_check);
$rs_y_check=mysqli_fetch_array($qr_y_check);
$y_year_budget=$rs_y_check['year_budget'];
$file_att=$rs_y_check['file_att'];



												if($file_att!="" && $file_att!="-") { unlink("file_att/$y_year_budget/$file_att");
														$sql_update2=ams_sql("UPDATE data_lda set file_att='' where id=?", ["$id"]);
														$qr_update2=ams_query($link,$sql_update2) or die ("Error_Upload_File PDF");
												}








							echo "<meta http-equiv=\"Refresh\" content=\"0; URL=form_edit.php?d4=1&id=$id&g=1\">";





		?>

</body>
</html>
<?php } ?>
