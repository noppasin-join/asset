<?php require_once __DIR__ . '/admin/security.php'; ams_require_post(); ?>
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
			$txt_obj=$_POST['txt_obj'];
			$txt_date_start=$_POST['txt_date_start'];
			$txt_date_end=$_POST['txt_date_end'];

			$pie=explode ("/", $txt_date_start);
			$pie2=explode ("/", $txt_date_end);

			$varStartDate = "$pie[2]-$pie[1]-$pie[0]"; //echo $varStartDate;
			$strStartDate = date_create("$pie[2]-$pie[1]-$pie[0]"); //echo $strStartDate;
			$strEndDate = date_create("$pie2[2]-$pie2[1]-$pie2[0]"); //echo $strEndDate;
			$diff=date_diff($strStartDate,$strEndDate);

			$var_date = $diff->format("%a");
			$var_date_1 = $var_date+1;




			$trim_name = trim ($txt_name);
			$trim_surname = trim ($txt_surname);
			$trim_department = trim ($txt_department);
			$trim_tel = trim ($txt_tel);
			$trim_email = trim ($txt_email);
			$trim_obj = trim ($txt_obj);

			$txt_title1=$_POST['txt_title1']; $txt_amount1=$_POST['txt_amount1']; $txt_unit1=$_POST['txt_unit1']; $txt_note1=$_POST['txt_note1'];
			$txt_title2=$_POST['txt_title2']; $txt_amount2=$_POST['txt_amount2']; $txt_unit2=$_POST['txt_unit2']; $txt_note2=$_POST['txt_note2'];
			$txt_title3=$_POST['txt_title3']; $txt_amount3=$_POST['txt_amount3']; $txt_unit3=$_POST['txt_unit3']; $txt_note3=$_POST['txt_note3'];
			$txt_title4=$_POST['txt_title4']; $txt_amount4=$_POST['txt_amount4']; $txt_unit4=$_POST['txt_unit4']; $txt_note4=$_POST['txt_note4'];
			$txt_title5=$_POST['txt_title5']; $txt_amount5=$_POST['txt_amount5']; $txt_unit5=$_POST['txt_unit5']; $txt_note5=$_POST['txt_note5'];

			$sql_insert=ams_sql("insert into data_take(year_budget,name,surname,department,tel,email,objective,checkout,checkin,day_submit,month_submit,year_submit,time_submit,status_read,status_approve) values
			(?,?,?,?,?,?,?,?,?,?,?,?,?,'0','2') ", ["$year_budget", "$trim_name", "$trim_surname", "$trim_department", "$trim_tel", "$trim_email", "$trim_obj", "$pie[2]-$pie[1]-$pie[0]", "$pie2[2]-$pie2[1]-$pie2[0]", "$day", "$month", "$year", "$time_log"]);
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

		echo "<SCRIPT LANGUAGE='JavaScript'>alert('Your equipment request has been submitted successfully.')</script>";
		echo "<meta http-equiv=\"Refresh\" content=\"0; URL=data.php?LB=1\">";

?>
</body>
</html>
