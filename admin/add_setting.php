<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$txt_year = '';
$choose_status = '';
$var_t = '';
$var_e = '';
$id = '';
$send_del = '';
$id_del = '';
$year_budget_config = '';
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
	$txt_year=$_POST['txt_year'] ?? '';
	$choose_status=$_POST['choose_status'] ?? '';

$var_t=$_POST['var_t'] ?? '';
  if ($var_t == "1") {
						$q_check=ams_sql("SELECT * FROM data_config  where year_budget = ?", ["$txt_year"]);
						$qr_check=ams_query($link,$q_check);
						$total_check=mysqli_num_rows($qr_check);

						if ($total_check != "0") {
							echo "<meta http-equiv=\"Refresh\" content=\"0; URL=setting_amount.php?d9=1&total_check=$total_check\">";
						} else {

						$sql_insert=ams_sql("INSERT into data_config(year_budget,status) values (?,?) ", ["$txt_year", "$choose_status"]);
						$qr_insert=ams_query($link,$sql_insert) or die ("Error Create Member");


						$sql_data = "SELECT * from  data_lda where status_check='1' ";
						$qr_data=ams_query($link,$sql_data) or die ("เลือกข้อมูลไม่ได้");
						while($rs=mysqli_fetch_array($qr_data))
						{
							if($rs['lda_status']=='1' || $rs['lda_status']=='2' || $rs['lda_status']=='7') {
							$sql_data2=ams_sql("INSERT INTO data_check(year_budget,id_data_lda,barcode1,barcode2,status,name_use_old,id_location_old,status_old,lda_list,file_img,lda_brand,barcode3) VALUES (?,?,?,?,'2',?,?,?,?,?,?,?)", [$txt_year, $rs['id'], $rs['barcode2'], $rs['barcode3'], $rs['name_use'], $rs['id_location'], $rs['lda_status'], $rs['lda_list'], $rs['file_img'], $rs['lda_brand'], $rs['barcode1']]);
							$query_data2=ams_query($link,$sql_data2);
							
						  }
						}


						echo "<meta http-equiv=\"Refresh\" content=\"0; URL=setting_amount.php?d9=1\">";
						}
			}


$var_e=$_POST['var_e'] ?? '';
$id=$_POST['id'] ?? '';
	if($var_e=="1") {
						$sql_update=ams_sql("UPDATE data_config set status=? where id=?", ["$choose_status", "$id"]);
						$qr_update=ams_query($link,$sql_update) or die ("Error Update Member");
						echo "<meta http-equiv=\"Refresh\" content=\"0; URL=setting_amount.php?d9=1&v_update=1\">";
	}



$send_del=$_GET['send_del'] ?? '';
$id_del=$_GET['id_del'] ?? '';
$year_budget_config=$_GET['year_budget_config'] ?? '';
  if ($send_del=="1") {

						$sql_main=ams_sql("DELETE from data_config where id=? ", ["$id_del"]);
						$dbquery_main=ams_query($link,$sql_main) or die ("Error Del Table data_config");

						$sql_main2=ams_sql("DELETE from data_check_config where year_budget=? ", ["$year_budget_config"]);
						$dbquery_main2=ams_query($link,$sql_main2) or die ("Error Del Table data_config");

						$sql_main3=ams_sql("DELETE from data_check where year_budget=? ", ["$year_budget_config"]);
						$dbquery_main3=ams_query($link,$sql_main3) or die ("Error Del Table data_config");

						echo "<meta http-equiv=\"Refresh\" content=\"0; URL=setting_amount.php?d9=1&v_del=1\">";

	}

?>

</body>
</html>
<?php } ?>
