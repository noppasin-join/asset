<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$year_budget = '';
$choose_staff = '';
$send_page = '';
$s_page2 = '';
$urlquery_str2 = '';
$e_page = '';
$chkDel = '';
$chk_page2 = 0;
$before_p2 = 0;
$nClass = '';
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
$year_budget=$_POST['year_budget'] ?? '';

$sql_year=ams_sql("SELECT * FROM data_config where status='1' and year_budget=?", ["$year_budget"]);
$query_year=ams_query($link,$sql_year);
	$total_qr_config=mysqli_num_rows($query_year);
	$result_year=mysqli_fetch_array($query_year);
		$staff_amount=$result_year['staff_amount'];


$choose_staff=$_POST['choose_staff'] ?? '';
$send_page=$_POST['send_page'] ?? '';
$s_page2=$_POST['s_page2'] ?? '';
$urlquery_str2=$_POST['urlquery_str2'] ?? '';
$chk_page2 = max(0, (int) ($_POST['chk_page2'] ?? 0));
$e_page=$_POST['e_page'] ?? '';

if($choose_staff!="") {
	$chkDel=$_POST['chkDel'] ?? '';
	$e_page=$_POST['e_page'] ?? '';

	$var_s=$s_page2+1; //echo $s_page2;

if($send_page<=$staff_amount) {  //echo "777";


	$sql_nb_check = ams_sql("SELECT * from  data_number_check where id_member_check=? and year_budget=? and number_etc<>'0'", ["$choose_staff", "$year_budget"]);
	$qr_nb_check=ams_query($link,$sql_nb_check) or die ("Error Check");
		$num_nb_check=mysqli_num_rows($qr_nb_check);

		$sql_number = ams_sql("SELECT * from  data_number_check where number_check=? and year_budget=? and number_etc='0'", ["$send_page", "$year_budget"]);
		$qr_number=ams_query($link,$sql_number) or die ("Error Number Check");
			$num_number=mysqli_num_rows($qr_number);

		if($num_nb_check!="0") {
				echo "<SCRIPT LANGUAGE='JavaScript'>alert('เจ้าหน้าที่ดังกล่าว เลือกชุดครุภัณฑ์ตรวจนับแล้ว กรุณาเลือกเจ้าหน้าที่ท่านอื่น! ')</script>";
				echo "<meta http-equiv=\"Refresh\" content=\"0; URL=form_setting.php?s1=1&s_page2=$s_page2&urlquery_str2=$urlquery_str2\">";
		} else {

					if($num_number!="0") {
						echo "<SCRIPT LANGUAGE='JavaScript'>alert('ชุดที่ $send_page ถูกเลือกแล้ว กรุณาเลือกใหม่! ')</script>";
						echo "<meta http-equiv=\"Refresh\" content=\"0; URL=form_setting.php?s1=1&s_page2=$s_page2&urlquery_str2=$urlquery_str2\">";
					} else {
						$sql_nb_insert=ams_sql("INSERT into data_number_check(year_budget,id_member_check,number_check,number_etc) values (?,?,?,'0') ", ["$year_budget", "$choose_staff", "$send_page"]);
						$qr_nb_insert=ams_query($link,$sql_nb_insert) or die ("Error Create Number Check");
								$i_zero=0;
									while ($i_zero<$e_page) {

									$var_chk=$chkDel[$i_zero];
									if($var_chk!="") {
									$q27=ams_sql("SELECT * FROM data_lda where id=?", ["$var_chk"]);
									$qr27=ams_query($link,$q27);
									$rs27=mysqli_fetch_array($qr27);
									$name_use_old=$rs27['name_use'];
									$id_location_old=$rs27['id_location'];
									$barcode_list=$rs27['barcode1'];
									$status_old=$rs27['lda_status'];

									$sql_insert=ams_sql("INSERT into data_staff_choose (year_budget,id_member_choose,id_data_lda,barcode,status,number_check,name_use_old,id_location_old,status_old)
									values (?,?,?,?,'2',?,?,?,?) ", ["$year_budget", "$choose_staff", "$chkDel[$i_zero]", "$barcode_list", "$send_page", "$name_use_old", "$id_location_old", "$status_old"]);
									$qr_insert=ams_query($link,$sql_insert) or die ("Error Create Number Check");
								  }

									$i_zero++;
									}

									echo "<meta http-equiv=\"Refresh\" content=\"0; URL=form_setting.php?s1=1&s_page2=$s_page2&urlquery_str2=$urlquery_str2\">";
						}

		}



	} else {

					if($chkDel[0]=="") {
						  echo "<SCRIPT LANGUAGE='JavaScript'>alert('กรุณาเลือกครุภัณฑ์ !!! ')</script>";
					  	echo "<meta http-equiv=\"Refresh\" content=\"0; URL=form_setting.php?s1=1&s_page2=$s_page2&urlquery_str2=$urlquery_str2\">";
					} else {
									$sql_nb_insert=ams_sql("INSERT into data_number_check(year_budget,id_member_check,number_check,number_etc) values (?,?,?,'1') ", ["$year_budget", "$choose_staff", "$send_page"]);
									$qr_nb_insert=ams_query($link,$sql_nb_insert) or die ("Error Create Number Check");
									$i_zero=0;
										while ($i_zero<$e_page) {
											$var_chk=$chkDel[$i_zero];
											if($var_chk!="") { //echo $send_page."<br/>";

												$q27=ams_sql("SELECT * FROM data_lda where id=?", ["$var_chk"]);
												$qr27=ams_query($link,$q27);
												$rs27=mysqli_fetch_array($qr27);
												$name_use_old=$rs27['name_use'];
												$id_location_old=$rs27['id_location'];
												$barcode_list=$rs27['barcode1'];
												$status_old=$rs27['lda_status'];

												$sql_insert=ams_sql("INSERT into data_staff_choose (year_budget,id_member_choose,id_data_lda,barcode,status,number_check,name_use_old,id_location_old,status_old)
												values (?,?,?,?,'2',?,?,?,?) ", ["$year_budget", "$choose_staff", "$var_chk", "$barcode_list", "$send_page", "$name_use_old", "$id_location_old", "$status_old"]);
												$qr_insert=ams_query($link,$sql_insert) or die ("Error Create Number Check");
											}
										$i_zero++;
										}

										echo "<meta http-equiv=\"Refresh\" content=\"0; URL=form_setting.php?s1=1&s_page2=$s_page2&urlquery_str2=$urlquery_str2\">";
					}

	}

} else {
	echo "<SCRIPT LANGUAGE='JavaScript'>alert('กรุณาเลือกเจ้าหน้าที่ประจำชุดที่ $send_page !!! ')</script>";
	echo "<meta http-equiv=\"Refresh\" content=\"0; URL=form_setting.php?s1=1&s_page2=$s_page2&urlquery_str2=$urlquery_str2\">";
}

?>
</body>
</html>
<?php } ?>
