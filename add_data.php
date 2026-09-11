<?php require_once __DIR__ . '/admin/security.php'; ams_require_post();
$request_purpose = $_POST['txt_obj'] ?? '';
$request_start = $_POST['txt_date_start'] ?? '';
$request_end = $_POST['txt_date_end'] ?? '';
if (!is_string($request_purpose) || trim($request_purpose) === '' || !is_string($request_start) || !is_string($request_end)) {
    ams_deny(422, 'Please enter the purpose, start date and return date.');
}
$request_start_date = DateTime::createFromFormat('!d/m/Y', $request_start);
$request_end_date = DateTime::createFromFormat('!d/m/Y', $request_end);
if (!$request_start_date || !$request_end_date || $request_start_date->format('d/m/Y') !== $request_start || $request_end_date->format('d/m/Y') !== $request_end) {
    ams_deny(422, 'Please enter valid dates in DD/MM/YYYY format.');
}
if ($request_end_date < $request_start_date) ams_deny(422, 'Return date must not be before start date.');
$request_purpose = trim($request_purpose);
$request_checkout = $request_start_date->format('Y-m-d');
$request_checkin = $request_end_date->format('Y-m-d');
 ?>
<?php
include ("con_lda.php");
	$back = $_SERVER['HTTP_REFERER'] ?? '';
	set_time_limit(0);
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <title>:: Library Equipment Request</title>
		    <link rel="shortcut icon" href="admin/mfu.ico" type="image/x-icon">
</head>
<body>
<?php
		$sql_year = "select * from  budget order by year_budget desc   ";
		$dbquery_year=ams_query($link,$sql_year) or die ("Unable to retrieve data.");
		$result_year=mysqli_fetch_array($dbquery_year);
		$year_budget=$result_year['year_budget'];

			$txt_name=$_POST['txt_name'];
			$txt_surname=$_POST['txt_surname'];
			$txt_department=$_POST['txt_department'];
			$txt_tel=$_POST['txt_tel'];
			$txt_email=$_POST['txt_email'];
			$trim_name = trim ($txt_name);
			$trim_surname = trim ($txt_surname);
			$trim_department = trim ($txt_department);
			$trim_tel = trim ($txt_tel);
			$trim_email = trim ($txt_email);
			

			$txt_title1=$_POST['txt_title1']; $txt_amount1=$_POST['txt_amount1']; $txt_unit1=$_POST['txt_unit1']; $txt_note1=$_POST['txt_note1'];
			$txt_title2=$_POST['txt_title2']; $txt_amount2=$_POST['txt_amount2']; $txt_unit2=$_POST['txt_unit2']; $txt_note2=$_POST['txt_note2'];
			$txt_title3=$_POST['txt_title3']; $txt_amount3=$_POST['txt_amount3']; $txt_unit3=$_POST['txt_unit3']; $txt_note3=$_POST['txt_note3'];
			$txt_title4=$_POST['txt_title4']; $txt_amount4=$_POST['txt_amount4']; $txt_unit4=$_POST['txt_unit4']; $txt_note4=$_POST['txt_note4'];
			$txt_title5=$_POST['txt_title5']; $txt_amount5=$_POST['txt_amount5']; $txt_unit5=$_POST['txt_unit5']; $txt_note5=$_POST['txt_note5'];

			$sql_insert=ams_sql("insert into data_take(year_budget,name,surname,department,tel,email,objective,checkout,checkin,day_submit,month_submit,year_submit,time_submit,status_read,status_approve) values
			(?,?,?,?,?,?,?,?,?,?,?,?,?,'0','2') ", ["$year_budget", "$trim_name", "$trim_surname", "$trim_department", "$trim_tel", "$trim_email", $request_purpose, $request_checkout, $request_checkin, "$day", "$month", "$year", "$time_log"]);
			$qr_insert=ams_query($link,$sql_insert) or die ("Error Insert");

			$sql_sort = ams_sql("select * from  data_take where year_budget=? and name=? and surname=? and day_submit=? and month_submit=? and year_submit=? order by id desc", ["$year_budget", "$trim_name", "$trim_surname", "$day", "$month", "$year"]);
			$qr_sort=ams_query($link,$sql_sort) or die ("Unable to retrieve data.");
			$num_sort=mysqli_num_rows($qr_sort);
			if($num_sort!=0) {
						$rs_sort=mysqli_fetch_array($qr_sort);
						$id_sort=$rs_sort['id'];

						//1
						$sql_lda_1 = ams_sql("select * from  data_lda where id=? ", ["$txt_title1"]);
						$qr_lda_1=ams_query($link,$sql_lda_1) or die ("Unable to retrieve data.");
							$rs_lda_1=mysqli_fetch_array($qr_lda_1);
							$lda_list_1=$rs_lda_1['lda_list'];

						$sql_list_1=ams_sql("insert into data_take_list(year_budget,id_data_take,title,month_submit,amount,unit,note,status) values
						(?,?,?,?,?,?,?,'0') ", ["$year_budget", "$id_sort", "$lda_list_1", "$month", "$txt_amount1", "$txt_unit1", "$txt_note1"]);
						$qr_list_1=ams_query($link,$sql_list_1) or die ("Error Insert List1");

						//2
						if($txt_title2!="") {
							$sql_lda_2 = ams_sql("select * from  data_lda where id=? ", ["$txt_title2"]);
							$qr_lda_2=ams_query($link,$sql_lda_2) or die ("Unable to retrieve data.");
								$rs_lda_2=mysqli_fetch_array($qr_lda_2);
								$lda_list_2=$rs_lda_2['lda_list'];

						$sql_list_2=ams_sql("insert into data_take_list(year_budget,id_data_take,title,month_submit,amount,unit,note,status) values
						(?,?,?,?,?,?,?,'0') ", ["$year_budget", "$id_sort", "$lda_list_2", "$month", "$txt_amount2", "$txt_unit2", "$txt_note2"]);
						$qr_list_2=ams_query($link,$sql_list_2) or die ("Error Insert List2");
					  }

						//3
						if($txt_title3!="") {
							$sql_lda_3 = ams_sql("select * from  data_lda where id=? ", ["$txt_title3"]);
							$qr_lda_3=ams_query($link,$sql_lda_3) or die ("Unable to retrieve data.");
								$rs_lda_3=mysqli_fetch_array($qr_lda_3);
								$lda_list_3=$rs_lda_3['lda_list'];

						$sql_list_3=ams_sql("insert into data_take_list(year_budget,id_data_take,title,month_submit,amount,unit,note,status) values
						(?,?,?,?,?,?,?,'0') ", ["$year_budget", "$id_sort", "$lda_list_3", "$month", "$txt_amount3", "$txt_unit3", "$txt_note3"]);
						$qr_list_3=ams_query($link,$sql_list_3) or die ("Error Insert List3");
					  }

						//4
						if($txt_title4!="") {
							$sql_lda_4 = ams_sql("select * from  data_lda where id=? ", ["$txt_title4"]);
							$qr_lda_4=ams_query($link,$sql_lda_4) or die ("Unable to retrieve data.");
								$rs_lda_4=mysqli_fetch_array($qr_lda_4);
								$lda_list_4=$rs_lda_4['lda_list'];

						$sql_list_4=ams_sql("insert into data_take_list(year_budget,id_data_take,title,month_submit,amount,unit,note,status) values
						(?,?,?,?,?,?,?,'0') ", ["$year_budget", "$id_sort", "$lda_list_4", "$month", "$txt_amount4", "$txt_unit4", "$txt_note4"]);
						$qr_list_4=ams_query($link,$sql_list_4) or die ("Error Insert List4");
					  }

						//5
						if($txt_title5!="") {
							$sql_lda_5 = ams_sql("select * from  data_lda where id=? ", ["$txt_title5"]);
							$qr_lda_5=ams_query($link,$sql_lda_5) or die ("Unable to retrieve data.");
								$rs_lda_5=mysqli_fetch_array($qr_lda_5);
								$lda_list_5=$rs_lda_5['lda_list'];

						$sql_list_5=ams_sql("insert into data_take_list(year_budget,id_data_take,title,month_submit,amount,unit,note,status) values
						(?,?,?,?,?,?,?,'0') ", ["$year_budget", "$id_sort", "$lda_list_5", "$month", "$txt_amount5", "$txt_unit5", "$txt_note5"]);
						$qr_list_5=ams_query($link,$sql_list_5) or die ("Error Insert List5");
					  }

		  }

        echo <<<'SUCCESS_POPUP'
<style>
body{margin:0;background:#f2f7f4;font-family:Arial,sans-serif;color:#213e34}
.request-success{box-sizing:border-box;width:calc(100% - 36px);max-width:430px;padding:36px 32px 28px;border:1px solid #e0eae4;border-radius:20px;text-align:center;color:#213e34;background:#fff;box-shadow:0 24px 70px rgba(24,64,46,.18)}
.request-success::backdrop{background:rgba(22,46,36,.38);backdrop-filter:blur(4px)}
.request-success[open]{position:fixed;inset:0;margin:auto;height:fit-content;animation:success-in .2s ease-out}
.success-icon{display:flex;align-items:center;justify-content:center;width:72px;height:72px;margin:0 auto 22px;background:#e9f6ef;border-radius:50%;color:#247b61}
.request-success h1{font-size:24px;line-height:1.35;margin:0 0 12px;font-weight:600}
.request-success p{font-size:15px;line-height:1.75;color:#71817b;margin:0 0 26px}
.success-confirm{box-sizing:border-box;display:block;width:100%;padding:14px 20px;background:#247b61;border-radius:10px;color:#fff;text-decoration:none;font-size:15px;font-weight:600;transition:background .15s}
.success-confirm:hover{background:#19634d}.success-confirm:focus-visible{outline:3px solid #96d4b8;outline-offset:4px}
@keyframes success-in{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
@media(prefers-reduced-motion:reduce){.request-success[open]{animation:none}}
</style>
<dialog class="request-success" id="request-success" open aria-labelledby="success-title" aria-describedby="success-description">
<div class="success-icon" aria-hidden="true"><svg width="36" height="36" viewBox="0 0 36 36" fill="none"><path d="M9 18.5l6 6L28 11" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
<h1 id="success-title">Request submitted!</h1>
<p id="success-description">Your equipment request has been<br>submitted successfully.</p>
<a class="success-confirm" href="data.php?LB=1" id="success-confirm" autofocus>OK</a>
</dialog>
<script>
(function(){
 var dialog=document.getElementById('request-success');
 function continueToRequests(){window.location.replace('data.php?LB=1');}
 if(typeof dialog.showModal==='function'){dialog.removeAttribute('open');dialog.showModal();}
 document.getElementById('success-confirm').addEventListener('click',function(event){event.preventDefault();continueToRequests();});
 dialog.addEventListener('cancel',function(event){event.preventDefault();continueToRequests();});
})();
</script>
SUCCESS_POPUP;

?>
</body>
</html>
