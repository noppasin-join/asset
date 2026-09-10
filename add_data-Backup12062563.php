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
        <title>:: ระบบยืมพัสดุ/ครุภัณฑ์ ศูนย์บรรณสารฯ</title>
		    <link rel="shortcut icon" href="admin/mfu.ico" type="image/x-icon">
</head>
<body>
<?php
		$sql_year = "select * from  budget order by year_budget desc   ";
		$dbquery_year=ams_query($link,$sql_year) or die ("เลือกข้อมูลไม่ได้");
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

			$txt_title1=$_POST['txt_title1']; $txt_amount1=$_POST['txt_amount1']; $txt_unit1=$_POST['txt_unit1']; $txt_note1=$_POST['txt_note1']; $ttrim1=trim($txt_title1);
			$txt_title2=$_POST['txt_title2']; $txt_amount2=$_POST['txt_amount2']; $txt_unit2=$_POST['txt_unit2']; $txt_note2=$_POST['txt_note2']; $ttrim2=trim($txt_title2);
			$txt_title3=$_POST['txt_title3']; $txt_amount3=$_POST['txt_amount3']; $txt_unit3=$_POST['txt_unit3']; $txt_note3=$_POST['txt_note3']; $ttrim3=trim($txt_title3);
			$txt_title4=$_POST['txt_title4']; $txt_amount4=$_POST['txt_amount4']; $txt_unit4=$_POST['txt_unit4']; $txt_note4=$_POST['txt_note4']; $ttrim4=trim($txt_title4);
			$txt_title5=$_POST['txt_title5']; $txt_amount5=$_POST['txt_amount5']; $txt_unit5=$_POST['txt_unit5']; $txt_note5=$_POST['txt_note5']; $ttrim5=trim($txt_title5);

			$sql_insert=ams_sql("insert into data_take(year_budget,name,surname,department,tel,email,objective,checkout,checkin,day_submit,month_submit,year_submit,time_submit,status_read) values
			(?,?,?,?,?,?,?,?,?,?,?,?,?,'0') ", ["$year_budget", "$trim_name", "$trim_surname", "$trim_department", "$trim_tel", "$trim_email", "$trim_obj", "$pie[2]-$pie[1]-$pie[0]", "$pie2[2]-$pie2[1]-$pie2[0]", "$day", "$month", "$year", "$time_log"]);
			$qr_insert=ams_query($link,$sql_insert) or die ("Error Insert");

			$sql_sort = ams_sql("select * from  data_take where year_budget=? and name=? and surname=? and day_submit=? and month_submit=? and year_submit=? order by id desc", ["$year_budget", "$trim_name", "$trim_surname", "$day", "$month", "$year"]);
			$qr_sort=ams_query($link,$sql_sort) or die ("เลือกข้อมูลไม่ได้");
			$num_sort=mysqli_num_rows($qr_sort);
			if($num_sort!=0) {
						$rs_sort=mysqli_fetch_array($qr_sort);
						$id_sort=$rs_sort['id'];

						//1
						$sql_list_1=ams_sql("insert into data_take_list(year_budget,id_data_take,title,month_submit,amount,unit,note,status) values
						(?,?,?,?,?,?,?,'0') ", ["$year_budget", "$id_sort", "$ttrim1", "$month", "$txt_amount1", "$txt_unit1", "$txt_note1"]);
						$qr_list_1=ams_query($link,$sql_list_1) or die ("Error Insert List1");
						$sql_sort_list1 = ams_sql("select * from  data_take_list where year_budget=? and id_data_take=? and title=? order by id desc", ["$year_budget", "$id_sort", "$ttrim1"]);
						$qr_sort_list1=ams_query($link,$sql_sort_list1) or die ("เลือกข้อมูลไม่ได้");
						$rs_list_1=mysqli_fetch_array($qr_sort_list1);
						$id_list_1=$rs_list_1['id'];
								$i_date1=0;
								while ($i_date1<$var_date_1) {
										$strNewDate1 = date ("Y-m-d", strtotime("+$i_date1 day", strtotime($varStartDate))); //echo $strNewDate1."<br/>";
										$sql_date1=ams_sql("insert into data_date_borrow(year_budget,id_data_take,id_data_take_list,date_use,status_return) values
										(?,?,?,?,'0') ", ["$year_budget", "$id_sort", "$id_list_1", "$strNewDate1"]); //echo $sql_date1."<br/>";
										$qr_date1=ams_query($link,$sql_date1) or die ("Error Insert Date11");
									$i_date1++;
								}

						//2
						if($txt_title2!="") {
						$sql_list_2=ams_sql("insert into data_take_list(year_budget,id_data_take,title,month_submit,amount,unit,note,status) values
						(?,?,?,?,?,?,?,'0') ", ["$year_budget", "$id_sort", "$ttrim2", "$month", "$txt_amount2", "$txt_unit2", "$txt_note2"]);
						$qr_list_2=ams_query($link,$sql_list_2) or die ("Error Insert List2");
						$sql_sort_list2 = ams_sql("select * from  data_take_list where year_budget=? and id_data_take=? and title=? order by id desc", ["$year_budget", "$id_sort", "$ttrim2"]);
						$qr_sort_list2=ams_query($link,$sql_sort_list2) or die ("เลือกข้อมูลไม่ได้");
						$rs_list_2=mysqli_fetch_array($qr_sort_list2);
						$id_list_2=$rs_list_2['id'];
								$i_date2=0;
								while ($i_date2<$var_date_1) {
										$strNewDate2 = date ("Y-m-d", strtotime("+$i_date2 day", strtotime($varStartDate))); //echo $strNewDate1."<br/>";
										$sql_date2=ams_sql("insert into data_date_borrow(year_budget,id_data_take,id_data_take_list,date_use,status_return) values
										(?,?,?,?,'0') ", ["$year_budget", "$id_sort", "$id_list_2", "$strNewDate2"]); //echo $sql_date2."<br/>";
										$qr_date2=ams_query($link,$sql_date2) or die ("Error Insert Date22");
									$i_date2++;
								}
					  }

						//3
						if($txt_title3!="") {
						$sql_list_3=ams_sql("insert into data_take_list(year_budget,id_data_take,title,month_submit,amount,unit,note,status) values
						(?,?,?,?,?,?,?,'0') ", ["$year_budget", "$id_sort", "$ttrim3", "$month", "$txt_amount3", "$txt_unit3", "$txt_note3"]);
						$qr_list_3=ams_query($link,$sql_list_3) or die ("Error Insert List3");
						$sql_sort_list3 = ams_sql("select * from  data_take_list where year_budget=? and id_data_take=? and title=? order by id desc", ["$year_budget", "$id_sort", "$ttrim3"]);
						$qr_sort_list3=ams_query($link,$sql_sort_list3) or die ("เลือกข้อมูลไม่ได้");
						$rs_list_3=mysqli_fetch_array($qr_sort_list3);
						$id_list_3=$rs_list_3['id'];
								$i_date3=0;
								while ($i_date3<$var_date_1) {
										$strNewDate3 = date ("Y-m-d", strtotime("+$i_date3 day", strtotime($varStartDate))); //echo $strNewDate1."<br/>";
										$sql_date3=ams_sql("insert into data_date_borrow(year_budget,id_data_take,id_data_take_list,date_use,status_return) values
										(?,?,?,?,'0') ", ["$year_budget", "$id_sort", "$id_list_3", "$strNewDate3"]); //echo $sql_date3."<br/>";
										$qr_date3=ams_query($link,$sql_date3) or die ("Error Insert Date33");
									$i_date3++;
								}
					  }

						//4
						if($txt_title4!="") {
						$sql_list_4=ams_sql("insert into data_take_list(year_budget,id_data_take,title,month_submit,amount,unit,note,status) values
						(?,?,?,?,?,?,?,'0') ", ["$year_budget", "$id_sort", "$ttrim4", "$month", "$txt_amount4", "$txt_unit4", "$txt_note4"]);
						$qr_list_4=ams_query($link,$sql_list_4) or die ("Error Insert List4");
						$sql_sort_list4 = ams_sql("select * from  data_take_list where year_budget=? and id_data_take=? and title=? order by id desc", ["$year_budget", "$id_sort", "$ttrim4"]);
						$qr_sort_list4=ams_query($link,$sql_sort_list4) or die ("เลือกข้อมูลไม่ได้");
						$rs_list_4=mysqli_fetch_array($qr_sort_list4);
						$id_list_4=$rs_list_4['id'];
								$i_date4=0;
								while ($i_date4<$var_date_1) {
										$strNewDate4 = date ("Y-m-d", strtotime("+$i_date4 day", strtotime($varStartDate))); //echo $strNewDate1."<br/>";
										$sql_date4=ams_sql("insert into data_date_borrow(year_budget,id_data_take,id_data_take_list,date_use,status_return) values
										(?,?,?,?,'0') ", ["$year_budget", "$id_sort", "$id_list_4", "$strNewDate4"]); //echo $sql_date4."<br/>";
										$qr_date4=ams_query($link,$sql_date4) or die ("Error Insert Date44");
									$i_date4++;
								}
					  }

						//5
						if($txt_title5!="") {
						$sql_list_5=ams_sql("insert into data_take_list(year_budget,id_data_take,title,month_submit,amount,unit,note,status) values
						(?,?,?,?,?,?,?,'0') ", ["$year_budget", "$id_sort", "$ttrim5", "$month", "$txt_amount5", "$txt_unit5", "$txt_note5"]);
						$qr_list_5=ams_query($link,$sql_list_5) or die ("Error Insert List5");
						$sql_sort_list5 = ams_sql("select * from  data_take_list where year_budget=? and id_data_take=? and title=? order by id desc", ["$year_budget", "$id_sort", "$ttrim5"]);
						$qr_sort_list5=ams_query($link,$sql_sort_list5) or die ("เลือกข้อมูลไม่ได้");
						$rs_list_5=mysqli_fetch_array($qr_sort_list5);
						$id_list_5=$rs_list_5['id'];

								$i_date5=0;
								while ($i_date5<$var_date_1) {
										$strNewDate5 = date ("Y-m-d", strtotime("+$i_date5 day", strtotime($varStartDate))); //echo $strNewDate1."<br/>";
										$sql_date5=ams_sql("insert into data_date_borrow(year_budget,id_data_take,id_data_take_list,date_use,status_return) values
										(?,?,?,?,'0') ", ["$year_budget", "$id_sort", "$id_list_5", "$strNewDate5"]); //echo $sql_date5."<br/>";
										$qr_date5=ams_query($link,$sql_date5) or die ("Error Insert Date55");
									$i_date5++;
								}
					  }

		  }

		echo "<SCRIPT LANGUAGE='JavaScript'>alert('บันทึกข้อมูลขอยืมพัสดุ/ครุภัณฑ์ เรียบร้อย')</script>";
		echo "<meta http-equiv=\"Refresh\" content=\"0; URL=data.php?LB=1\">";

?>
</body>
</html>
