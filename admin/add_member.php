<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$txt_name = '';
$txt_surname = '';
$txt_username = '';
$txt_password = '';
$choose_status = '';
$choose_use = '';
$var_t = '';
$var_e = '';
$id = '';
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
	$txt_name=$_POST['txt_name'] ?? '';
	$txt_surname=$_POST['txt_surname'] ?? '';
	$txt_username=$_POST['txt_username'] ?? '';
	$txt_password=$_POST['txt_password'] ?? '';
	$choose_status=$_POST['choose_status'] ?? '';
	$choose_use=$_POST['choose_use'] ?? '';

	$t_name = trim ($txt_name);
	$t_surname = trim ($txt_surname);
	$t_username = trim ($txt_username);

$var_t=$_POST['var_t'] ?? '';
  if ($var_t == "1") {
						$q_check=ams_sql("SELECT * FROM member  where name = ? and surname = ?  ", ["$t_name", "$t_surname"]);
						$qr_check=ams_query($link,$q_check);
						$total_check=mysqli_num_rows($qr_check);

						if ($total_check != "0") {
							echo "<meta http-equiv=\"Refresh\" content=\"0; URL=setting.php?d7=1&total_check=$total_check\">";
						} else {

						$sql_insert=ams_sql("insert into member(name,surname,username,password,level,status,date_login,time_login)
						values (?,?,?,?,?,?,'','') ", ["$t_name", "$t_surname", "$t_username", "$txt_password", "$choose_status", "$choose_use"]);
						$qr_insert=ams_query($link,$sql_insert) or die ("Error Create Member");

							echo "<meta http-equiv=\"Refresh\" content=\"0; URL=setting.php?d7=1&v_success=1\">";
						}
			}


$var_e=$_POST['var_e'] ?? '';
$id=$_POST['id'] ?? '';
	if($var_e=="1") {
						$sql_update=ams_sql("update member set name=?,surname=?,username=?,password=?,level=?,status=? where id=?  ", ["$t_name", "$t_surname", "$t_username", "$txt_password", "$choose_status", "$choose_use", "$id"]);
						$qr_update=ams_query($link,$sql_update) or die ("Error Update Member");
						echo "<meta http-equiv=\"Refresh\" content=\"0; URL=setting.php?d7=1&v_update=1\">";
	}



$send_del=$_GET['send_del'] ?? '';
$id_del=$_GET['id_del'] ?? '';
  if ($send_del=="1") {

						$sql_main=ams_sql("delete from member where id=? ", ["$id_del"]);
						$dbquery_main=ams_query($link,$sql_main) or die ("เลือกข้อมูลไม่ได้");
						echo "<meta http-equiv=\"Refresh\" content=\"0; URL=setting.php?d7=1&v_del=1\">";
	}

?>

</body>
</html>
<?php } ?>
