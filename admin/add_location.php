<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$var_t = '';
$txt_locate = '';
$send_del = '';
$id_del = '';
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
	$var_t=$_POST['var_t'] ?? '';
	$txt_locate=$_POST['txt_locate'] ?? '';
?>

		<?php if ($var_t == "1") {

				$t_null = trim ($txt_locate);
						$q_check=ams_sql("SELECT * FROM data_location  where name_location = ?  ", ["$t_null"]);
						$qr_check=ams_query($link,$q_check);
						$total_check=mysqli_num_rows($qr_check);

						if ($total_check != "0") {
							echo "<meta http-equiv=\"Refresh\" content=\"0; URL=location.php?d3=1&total_check=$total_check\">";
						} else {


						$sql_cat=ams_sql("insert into data_location(name_location,status_location) values (?,'0') ", ["$t_null"]);
						$qr_cat=ams_query($link,$sql_cat) or die ("Error Create Category");

							echo "<meta http-equiv=\"Refresh\" content=\"0; URL=location.php?d3=1&v_success=1\">";
				?>
                <?php
				}
			}

		$send_del=$_GET['send_del'] ?? '';
		$id_del=$_GET['id_del'] ?? '';

		if ($send_del=="1") {

						$sql_main=ams_sql("delete from data_location where id=? ", ["$id_del"]);
						$dbquery_main=ams_query($link,$sql_main) or die ("เลือกข้อมูลไม่ได้");
						echo "<meta http-equiv=\"Refresh\" content=\"0; URL=location.php?d3=1&v_del=1\">";
		}
		?>

</body>
</html>
<?php } ?>
