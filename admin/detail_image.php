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
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
        <title>:: ระบบฐานข้อมูลครุภัณฑ์ ศูนย์บรรณสารฯ</title>
				<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	</head>

	<body>
	<?php
	$id=$_GET['id'] ?? '';
	$sql_data = ams_sql("select * from  data_lda where id=? ", ["$id"]);
	$qr_data=ams_query($link,$sql_data) or die ("เลือกข้อมูลไม่ได้");
					$rs_data=mysqli_fetch_array($qr_data);
					$file_img=$rs_data['file_img'];
					$year_budget=$rs_data['year_budget'];
	?>
	<img src="file_img/<?php echo $year_budget; ?>/<?php echo $file_img;?>" width="400">
</html>
<?php } ?>
