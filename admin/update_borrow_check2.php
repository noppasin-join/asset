<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$id = '';
$id_data_lda = '';
$id_take_list = '';
$amount = '';
$barcode = '';
$id_category = '';
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
$id_data_lda=$_GET['id_data_lda'] ?? '';
$id_take_list=$_GET['id_take_list'] ?? '';
$amount=$_GET['amount'] ?? '';
$barcode=$_GET['barcode'] ?? '';
$id_category=$_GET['id_category'] ?? '';

$sql_year = "select * from  budget order by year_budget desc   ";
$dbquery_year=ams_query($link,$sql_year) or die ("เลือกข้อมูลไม่ได้");
$result_year=mysqli_fetch_array($dbquery_year);
$year_budget=$result_year['year_budget'];

$sql_check = ams_sql("select * from  data_take_list_more where id_data_take_list = ?", ["$id_take_list"]);
$qr_check=ams_query($link,$sql_check) or die ("เลือกข้อมูลไม่ได้");
$num_check=mysqli_num_rows($qr_check);

$sql_check2 = ams_sql("select * from  data_take_list_more where id_data_take_list = ? and id_data_lda<>''", ["$id_take_list"]);
$qr_check2=ams_query($link,$sql_check2) or die ("เลือกข้อมูลไม่ได้");
$num_check2=mysqli_num_rows($qr_check2);

			$sql_list = ams_sql("select * from  data_take where id=? ", ["$id"]);
			$qr_list=ams_query($link,$sql_list) or die ("เลือกข้อมูลไม่ได้");
			$rs_list=mysqli_fetch_array($qr_list);
			$checkout_list=$rs_list['checkout'];
			$checkin_list=$rs_list['checkin'];
			$for_month=$rs_list['month_submit'];

			$pie=explode ("-", $checkout_list);
$pie = array_pad($pie, 6, ''); $y_ch=(is_numeric($pie[0]) ? (int) $pie[0] + 543 : '');
			$pie2=explode ("-", $checkin_list);
$pie2 = array_pad($pie2, 6, ''); $y_ch2=(is_numeric($pie2[0]) ? (int) $pie2[0] + 543 : '');

			$varStartDate = "$pie[2]-$pie[1]-$pie[0]"; //echo $varStartDate."<br/>";
			$strStartDate = date_create("$pie[2]-$pie[1]-$pie[0]"); //echo $strStartDate;
			$strEndDate = date_create("$pie2[2]-$pie2[1]-$pie2[0]"); //echo $strEndDate;
			$diff=($strStartDate && $strEndDate ? date_diff($strStartDate, $strEndDate) : null);

			$var_date = ($diff ? (int) $diff->format("%a") : -1);
			$var_date_1 = $var_date+1;

if($amount>1) {
			if($num_check==$amount) {

				echo "<SCRIPT LANGUAGE='JavaScript'>alert('มีเลขครุภัณฑ์ที่เลือก ครบตามจำนวนแล้ว!')</script>";
				echo "<meta http-equiv=\"Refresh\" content=\"0; URL=form_borrow.php?j=1&id=$id&#tbl1\">";

			} else {

				$sql_data2 = ams_sql("insert into data_take_list_more(year_budget,id_data_take,id_data_lda,id_data_take_list,id_category,for_month,barcode,status_return)
											values (?,?,?,?,?,?,?,'0')", ["$year_budget", "$id", "$id_data_lda", "$id_take_list", "$id_category", "$for_month", "$barcode"]);
				$qr_data2=ams_query($link,$sql_data2) or die ("Error Update Check3");


				$i_date1=0;
				while ($i_date1<$var_date_1) {
						$strNewDate1 = date ("Y-m-d", strtotime("+$i_date1 day", strtotime($varStartDate))); //echo $strNewDate1."<br/>";
						$sql_date1=ams_sql("insert into data_date_borrow(year_budget,id_data_take,id_data_take_list,id_data_lda,date_use,status_return) values
						(?,?,?,?,?,'0') ", ["$year_budget", "$id", "$id_take_list", "$id_data_lda", "$strNewDate1"]); //echo $sql_date1."<br/>";
						$qr_date1=ams_query($link,$sql_date1) or die ("Error Insert Date"); //echo $sql_date1."<br/>";
					$i_date1++;
				}

				$sql_approve = ams_sql("update data_take set status_approve='1' where id=?", ["$id"]);
				$qr_approve=ams_query($link,$sql_approve) or die ("Error Update Approve");

			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=form_borrow.php?j=1&id=$id&#tbl1\">";
			}
} elseif($amount=="1") {

		if($num_check2==0) {

			$sql_data1=ams_sql("insert into data_take_list_more(year_budget,id_data_take,id_data_lda,id_data_take_list,id_category,for_month,barcode,status_return) values
				(?,?,?,?,?,?,?,'0') ", ["$year_budget", "$id", "$id_data_lda", "$id_take_list", "$id_category", "$for_month", "$barcode"]); //echo $sql_date1."<br/>";
			$qr_data1=ams_query($link,$sql_data1) or die ("Error Update Check2");

		$i_date1=0;
		while ($i_date1<$var_date_1) {
				$strNewDate1 = date ("Y-m-d", strtotime("+$i_date1 day", strtotime($varStartDate))); //echo $strNewDate1."<br/>";
				$sql_date1=ams_sql("insert into data_date_borrow(year_budget,id_data_take,id_data_take_list,id_data_lda,date_use,status_return) values
				(?,?,?,?,?,'0') ", ["$year_budget", "$id", "$id_take_list", "$id_data_lda", "$strNewDate1"]); //echo $sql_date1."<br/>";
				$qr_date1=ams_query($link,$sql_date1) or die ("Error Insert Date"); //echo $sql_date1."<br/>";
			$i_date1++;
		}

		$sql_approve = ams_sql("update data_take set status_approve='1' where id=?", ["$id"]);
		$qr_approve=ams_query($link,$sql_approve) or die ("Error Update Approve");

		echo "<meta http-equiv=\"Refresh\" content=\"0; URL=form_borrow.php?j=1&id=$id&#tbl1\">";
		} elseif($num_check2==1) {

			echo "<SCRIPT LANGUAGE='JavaScript'>alert('มีเลขครุภัณฑ์ที่เลือก ครบตามจำนวนแล้ว!')</script>";
			echo "<meta http-equiv=\"Refresh\" content=\"0; URL=form_borrow.php?j=1&id=$id&#tbl1\">";

		}

}
?>
</body>
</html>
<?php } ?>
