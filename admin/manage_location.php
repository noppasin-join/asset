<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$v_status = '';
$id_locate = '';
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
	$v_status=$_GET['v_status'] ?? '';
	$id_locate=$_GET['id_locate'] ?? '';
?>

		<?php if ($v_status != "") {

						$q_check=ams_sql("UPDATE data_location set status_location=?  where id = ?  ", ["$v_status", "$id_locate"]);
						$qr_check=ams_query($link,$q_check);
						$total_check=mysqli_num_rows($qr_check);

							echo "<meta http-equiv=\"Refresh\" content=\"0; URL=location.php?d3=1&v_status=0\">";
						}
		?>

</body>
</html>
<?php } ?>
