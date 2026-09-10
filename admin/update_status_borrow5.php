<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$id = '';
$id_take_list = '';
$choose_status5 = '';
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
$choose_status5=$_GET['choose_status5'] ?? '';

				if($choose_status5!="2") {
					$sql_data = ams_sql("update data_take_list set status=? where id=?", ["$choose_status5", "$id_take_list"]);
					$qr_data=ams_query($link,$sql_data) or die ("Error Update Status2");
				} else {
					$sql_data = ams_sql("update data_take_list set status='2' where id=?", ["$id_take_list"]);
					$qr_data=ams_query($link,$sql_data) or die ("Error Update Status2");

								$sql_check_del = ams_sql("select * from  data_take_list_more where id_data_take = ? and id_data_take_list=?", ["$id", "$id_take_list"]);
								$qr_check_del=ams_query($link,$sql_check_del) or die ("Error 3");
								$num_check_del=mysqli_num_rows($qr_check_del);
								if($num_check_del!=0) {
									$sql_check = ams_sql("delete from  data_take_list_more where id_data_take = ? and id_data_take_list=?", ["$id", "$id_take_list"]);
									$qr_check=ams_query($link,$sql_check) or die ("Error 1");
							  }
								$sql_check_del3 = ams_sql("select * from  data_date_borrow where id_data_take = ? and id_data_take_list=?", ["$id", "$id_take_list"]);
								$qr_check_del3=ams_query($link,$sql_check_del3) or die ("Error 3");
								$num_check_del3=mysqli_num_rows($qr_check_del3);
								if($num_check_del3!=0) {
									$sql_data3 = ams_sql("delete from data_date_borrow where id_data_take=? and id_data_take_list=?", ["$id", "$id_take_list"]);
									$qr_data3=ams_query($link,$sql_data3) or die ("Error 2");
							  }

				}
			$sql_member_update = ams_sql("update data_take set id_member_manage=?,date_manage=?,time_manage=? where id=?", ["$id_member", "$day/$month/$year", "$time_log", "$id"]);
			$qr_member_update=ams_query($link,$sql_member_update) or die ("Error Update Status2");
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=form_borrow.php?j=1&id=$id&#tbl5\">";

?>
</body>
</html>
<?php } ?>
