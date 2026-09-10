<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$var_t = '';
$txt_budget = '';
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
	$txt_budget=$_POST['txt_budget'] ?? '';
?>

		<?php if ($var_t == "1") {

				$t_null = trim ($txt_budget);
						$q_check=ams_sql("SELECT * FROM budget  where year_budget = ?  ", ["$t_null"]);
						$qr_check=ams_query($link,$q_check);
						$total_check=mysqli_num_rows($qr_check);

						if ($total_check != "0") {
							echo "<meta http-equiv=\"Refresh\" content=\"0; URL=budget.php?d1=1&total_check=$total_check\">";
						} else {


						$sql_budget=ams_sql("insert into budget(year_budget) values (?) ", ["$t_null"]);
						$qr_budget=ams_query($link,$sql_budget) or die ("Error3");

							echo "<meta http-equiv=\"Refresh\" content=\"0; URL=budget.php?d1=1&v_success=1\">";
				?>
                <?php
				}
			}

		$send_del=$_GET['send_del'] ?? '';
		$id_del=$_GET['id_del'] ?? '';

		if ($send_del=="1") {

						$sql_main=ams_sql("delete from budget where year_budget=? ", ["$id_del"]);
						$dbquery_main=ams_query($link,$sql_main) or die ("เลือกข้อมูลไม่ได้");

						$sql_lda=ams_sql("delete from data_lda where year_budget=? ", ["$id_del"]);
						$qr_lda=ams_query($link,$sql_lda) or die ("เลือกข้อมูลไม่ได้");

						$sql_take=ams_sql("delete from data_take where year_budget=? ", ["$id_del"]);
						$qr_take=ams_query($link,$sql_take) or die ("เลือกข้อมูลไม่ได้");

						$sql_take_list=ams_sql("delete from data_take_list where year_budget=? ", ["$id_del"]);
						$qr_take_list=ams_query($link,$sql_take_list) or die ("เลือกข้อมูลไม่ได้");

						$sql_take_list_more=ams_sql("delete from data_take_list_more where year_budget=? ", ["$id_del"]);
						$qr_take_list_more=ams_query($link,$sql_take_list_more) or die ("เลือกข้อมูลไม่ได้");

						$sql_date_borrow=ams_sql("delete from data_date_borrow where year_budget=? ", ["$id_del"]);
						$qr_date_borrow=ams_query($link,$sql_date_borrow) or die ("เลือกข้อมูลไม่ได้");

						$sql_repair=ams_sql("delete from data_repair where year_budget=? ", ["$id_del"]);
						$qr_repair=ams_query($link,$sql_repair) or die ("เลือกข้อมูลไม่ได้");

						$sql_compare=ams_sql("delete from data_compare where year_budget=? ", ["$id_del"]);
						$qr_compare=ams_query($link,$sql_compare) or die ("เลือกข้อมูลไม่ได้");

						echo "<meta http-equiv=\"Refresh\" content=\"0; URL=budget.php?d1=1&v_del=1\">";
		}
		?>

</body>
</html>
<?php } ?>
