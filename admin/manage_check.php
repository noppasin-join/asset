<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$id_location = '';
$id_mem = '';
$var_dpm = '';
$v_add = '';
$v_del = '';
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
$id_location=$_GET['id_location'] ?? '';
$id_mem=$_GET['id_mem'] ?? '';
$var_dpm=$_GET['var_dpm'] ?? '';
$v_add=$_GET['v_add'] ?? '';
$v_del=$_GET['v_del'] ?? '';

$day=date("d");
$month=date("m");
$year=date("Y")+543;
$timelog=date("H:i");

$sql_year="SELECT * FROM data_config  order by year_budget desc";
$query_year=ams_query($link,$sql_year);
$result_year=mysqli_fetch_array($query_year);
$year_budget=$result_year['year_budget'];

if($v_add=="1") {
	$q_check=ams_sql("SELECT * FROM data_check_config where year_budget=? and id_member=? and id_location=?", ["$year_budget", "$id_mem", "$id_location"]);
	$qr_check=ams_query($link,$q_check);
	$total_check=mysqli_num_rows($qr_check);
	if($total_check=="0") {
	$sql_data=ams_sql("INSERT into data_check_config(year_budget,id_member,id_location,date_config) values
	(?,?,?,?) ", ["$year_budget", "$id_mem", "$id_location", "$day-$month-$year $timelog"]);
	$query_data=ams_query($link,$sql_data);
	}
}

if($v_del=="1") {
	$q_check=ams_sql("DELETE FROM data_check_config where year_budget=? and id_member=? and id_location=?", ["$year_budget", "$id_mem", "$id_location"]);
	$qr_check=ams_query($link,$q_check); //echo $q_check;
}


echo "<meta http-equiv=\"Refresh\" content=\"0; URL=form_setting.php?s1=1&var_dpm=$var_dpm\">";


?>
</body>
</html>
<?php } ?>
