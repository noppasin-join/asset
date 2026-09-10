<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$id = '';
$txt_date_pickup = '';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
	$sess_user = $_SESSION['sess_user'] ?? '';
	$sess_password = $_SESSION['sess_password'] ?? '';

	require_once __DIR__ . '/con_lda.php';
	if ($sess_user == "" || $status!=0 || $level=="0") {
    ams_deny(403, 'Insufficient permissions.');
	} else {
	set_time_limit(0);
?>
<html lang="en">
<head>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
</head>
<body>
<?php
$id=$_POST['id'] ?? '';
$txt_date_pickup=$_POST['txt_date_pickup'] ?? '';

			$pie=explode ("/", $txt_date_pickup);
$pie = array_pad($pie, 6, '');
			$varStartDate = "$pie[2]-$pie[1]-$pie[0]"; //echo $varStartDate."<br/>";

						$strNewDate1 = date ("Y-m-d", strtotime($varStartDate)); //echo $strNewDate1."<br/>";
						$sql_pickup=ams_sql("update data_take set pickup=? where id=?  ", ["$strNewDate1", "$id"]); //echo $sql_date1."<br/>";
						$qr_pickup=ams_query($link,$sql_pickup) or die ("Error Insert Date"); //echo $sql_date1."<br/>";

echo "<meta http-equiv=\"Refresh\" content=\"0; URL=form_borrow.php?j=1&id=$id\">";

?>
</body>
</html>
<?php } ?>
