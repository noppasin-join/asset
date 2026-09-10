<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$txt_name = '';
$txt_surname = '';
$txt_password = '';
$var_e = '';
$id = '';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
	$sess_user = $_SESSION['sess_user'] ?? '';
	$sess_password = $_SESSION['sess_password'] ?? '';

	require_once __DIR__ . '/con_lda.php';
	if ($sess_user == "" || $status!="0") {
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
	$txt_password=$_POST['txt_password'] ?? '';

	$t_name = trim ($txt_name);
	$t_surname = trim ($txt_surname);
	$t_password = trim ($txt_password);



$var_e=$_POST['var_e'] ?? '';
$id=$id_member;
	if($var_e=="1") {
						$sql_update=ams_sql("update member set name=?,surname=?,password=? where id=?  ", ["$t_name", "$t_surname", "$t_password", "$id"]);
						$qr_update=ams_query($link,$sql_update) or die ("Error Update Member");
						$_SESSION['sess_password'] = $t_password;
						echo "<meta http-equiv=\"Refresh\" content=\"0; URL=form_user.php?u=1&v_update=1\">";
	}
?>

</body>
</html>
<?php } ?>
