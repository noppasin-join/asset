<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$id = '';
$s_page2 = '';
$urlquery_str2 = '';
$txt_title_search = '';
$txt_no_search = '';
$txt_barcode = '';
$txt_title = '';
$txt_brand = '';
$txt_serial = '';
$choose_category = '';
$choose_locate = '';
$choose_status = '';
$choose_borrow = '';
$txt_user_use = '';
$txt_note = '';
$txt_date_expire = '';
$txt_price = '';
$txt_asset = '';
$file_upload = '';
$file_upload2 = '';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
	$sess_user = $_SESSION['sess_user'] ?? '';
	$sess_password = $_SESSION['sess_password'] ?? '';

	require_once __DIR__ . '/con_lda.php';
	if ($sess_user == "" || $status!="0" || $level=="0") {
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
$sql_year = "select * from  budget order by year_budget desc   ";
$dbquery_year=ams_query($link,$sql_year) or die ("เลือกข้อมูลไม่ได้");
$result_year=mysqli_fetch_array($dbquery_year);
$year_budget=$result_year['year_budget'];

$id=$_POST['id'] ?? '';
$s_page2=$_POST['s_page2'] ?? '';
$urlquery_str2=$_POST['urlquery_str2'] ?? '';
$txt_title_search=$_POST['txt_title_search'] ?? '';
$txt_no_search=$_POST['txt_no_search'] ?? '';

$y_check=ams_sql("SELECT * FROM data_lda  where id = ?  ", ["$id"]);
$qr_y_check=ams_query($link,$y_check);
$rs_y_check=mysqli_fetch_array($qr_y_check);
$y_year_budget=$rs_y_check['year_budget'];
$file_img=$rs_y_check['file_img'];
$file_att=$rs_y_check['file_att'];
$lda_status=$rs_y_check['lda_status'];
$id_category=$rs_y_check['id_category'];

$txt_barcode=$_POST['txt_barcode'] ?? '';
$txt_title=$_POST['txt_title'] ?? '';	$t_title = trim ($txt_title);
$txt_brand=$_POST['txt_brand'] ?? ''; $t_brand = trim ($txt_brand);
$txt_serial=$_POST['txt_serial'] ?? ''; $t_serial = trim ($txt_serial);
$choose_category=$_POST['choose_category'] ?? '';
$choose_locate=$_POST['choose_locate'] ?? '';
$choose_status=$_POST['choose_status'] ?? '';
$choose_borrow=$_POST['choose_borrow'] ?? '';
$txt_user_use=$_POST['txt_user_use'] ?? ''; $t_user_use = trim ($txt_user_use);
$txt_note=$_POST['txt_note'] ?? '';
$txt_date_expire=$_POST['txt_date_expire'] ?? '';
$txt_price=$_POST['txt_price'] ?? '';
$txt_asset=$_POST['txt_asset'] ?? '';

$pie=explode ("-", $txt_barcode);
$pie = array_pad($pie, 6, '');
$count = $pie[0];
$count1 = $pie[1];
$count2 = $pie[2];
$count3 = $pie[3];
$count4 = $pie[4];
$all_count = "$pie[0]$pie[1]$pie[2]$pie[3]$pie[4]";

if($choose_status=="1" || $choose_status=="2" || $choose_status=="7") { $var_status=1;  }
elseif ($choose_status=="3" || $choose_status=="4" || $choose_status=="5" || $choose_status=="6" || $choose_status=="8") { $var_status=2; }


						$q_check=ams_sql("SELECT * FROM data_lda  where barcode1 = ?  ", ["$all_count"]);
						$qr_check=ams_query($link,$q_check);
					    $total_check=mysqli_num_rows($qr_check);
						$rs_check=mysqli_fetch_array($qr_check);
						$id_check=$rs_check['id'];


						$sql_update = ams_sql("update data_lda set barcode1=?,
						barcode2=?,
						lda_category=?,
						asset=?,
						lda_type=?,
						lda_detail=?,
						lda_year=?,
						lda_no=?,
						lda_list=?,
						lda_brand=?,
						lda_serial=?,
						id_category=?,
						id_location=?,
						name_use=?,
						id_member_update=?,
						date_update=?,
						time_update=?,
						lda_status=?,
						note=?,
						price=?,
						status_check=?,
						date_expire=?,
						status_borrow=?
						where id=? ", ["$all_count", "$txt_barcode", "$count", "$txt_asset", "$count1", "$count2", "$count3", "$count4", "$t_title", "$t_brand", "$t_serial", "$choose_category", "$choose_locate", "$t_user_use", "$id_member", "$day/$month/$year", "$time_log", "$choose_status", "$txt_note", "$txt_price", "$var_status", "$txt_date_expire", "$choose_borrow", "$id"]);
						$qr_update=ams_query($link,$sql_update) or die ("Error Update Data");

						if($lda_status!="6" && $choose_status=="6") {
						$sql_repair=ams_sql("insert into data_repair(year_budget,id_data_lda,id_category,day_checkout,month_checkout,year_checkout,time_checkout,note,status,day_status,month_status,year_status,time_status) values
						(?,?,?,?,?,?,?,?,'-','-','-','-','-') ", ["$year_budget", "$id", "$id_category", "$day", "$month", "$year", "$time_log", "$txt_note"]);
						$qr_repair=ams_query($link,$sql_repair) or die ("Error Repair");
						}

						if($lda_status=="6" && $choose_status!="6") {

							$sql_rp_sort = ams_sql("select * from  data_repair where id_data_lda=? order by id desc   ", ["$id"]);
							$qr_rp_sort=ams_query($link,$sql_rp_sort) or die ("เลือกข้อมูลไม่ได้");
							$rs_rp_sort=mysqli_fetch_array($qr_rp_sort);
							$id_rp_sort=$rs_rp_sort['id'];

							$sql_repair = ams_sql("update data_repair set status=?,
							day_status=?,
							month_status=?,
							year_status=?,
							time_status=?
							where id=? ", ["$choose_status", "$day", "$month", "$year", "$time_log", "$id_rp_sort"]);
							$qr_repair=ams_query($link,$sql_repair) or die ("Error Repair");
						}

						$file_upload=$_POST['file_upload'] ?? '';
						$var_file= $_FILES["file_upload"]["name"];
						if($var_file!="") {
						$pie_file=explode (".", $var_file);
$pie_file = array_pad($pie_file, 6, '');


								if ($pie_file[1]=="jpg" || $pie_file[1]=="JPG") {

												if ($file_img != "-") { unlink("file_img/$y_year_budget/$file_img"); }
												if(is_dir("file_img/$y_year_budget/")) {  } else { mkdir("file_img/$y_year_budget/"); }
												if(move_uploaded_file($_FILES["file_upload"]["tmp_name"],"file_img/$y_year_budget/$all_count.jpg")) {
														$sql_update=ams_sql("update data_lda set file_img=? where id=?", ["$all_count.jpg", "$id"]);
														$qr_update=ams_query($link,$sql_update) or die ("Error_Upload_File JPG");
												}


								} elseif ($pie_file[1]=="jpeg" || $pie_file[1]=="JPEG") {

												if ($file_img != "-") { unlink("file_img/$y_year_budget/$file_img"); }
												if(is_dir("file_img/$y_year_budget/")) {  } else { mkdir("file_img/$y_year_budget/"); }
												if(move_uploaded_file($_FILES["file_upload"]["tmp_name"],"file_img/$y_year_budget/$all_count.jpg")) {
														$sql_update=ams_sql("update data_lda set file_img=? where id=?", ["$all_count.jpg", "$id"]);
														$qr_update=ams_query($link,$sql_update) or die ("Error_Upload_File JPEG");
												}


								} elseif ($pie_file[1]=="gif" || $pie_file[1]=="GIF") {

												if ($file_img != "-") { unlink("file_img/$y_year_budget/$file_img"); }
												if(is_dir("file_img/$y_year_budget/")) {  } else { mkdir("file_img/$y_year_budget/"); }
												if(move_uploaded_file($_FILES["file_upload"]["tmp_name"],"file_img/$y_year_budget/$all_count.jpg")) {
														$sql_update=ams_sql("update data_lda set file_img=? where id=?", ["$all_count.jpeg", "$id"]);
														$qr_update=ams_query($link,$sql_update) or die ("Error_Upload_File GIF");
												}


								} elseif ($pie_file[1]=="tif" || $pie_file[1]=="TIF" || $pie_file[1]=="tiff" || $pie_file[1]=="TIFF") {

												if ($file_img != "-") { unlink("file_img/$y_year_budget/$file_img"); }
												if(is_dir("file_img/$y_year_budget/")) {  } else { mkdir("file_img/$y_year_budget/"); }
												if(move_uploaded_file($_FILES["file_upload"]["tmp_name"],"file_img/$year_budget/$all_count.jpg")) {
														$sql_update=ams_sql("update data_lda set file_img=? where id=?", ["$all_count.jpg", "$id"]);
														$qr_update=ams_query($link,$sql_update) or die ("Error_Upload_File TIF");
												}


								} elseif ($pie_file[1]=="bmp" || $pie_file[1]=="BMP" ) {

												if ($file_img != "-") { unlink("file_img/$y_year_budget/$file_img"); }
												if(is_dir("file_img/$y_year_budget/")) {  } else { mkdir("file_img/$y_year_budget/"); }
												if(move_uploaded_file($_FILES["file_upload"]["tmp_name"],"file_img/$y_year_budget/$all_count.jpg")) {
														$sql_update=ams_sql("update data_lda set file_img=? where id=?", ["$all_count.jpg", "$id"]);
														$qr_update=ams_query($link,$sql_update) or die ("Error_Upload_File BMP");
												}


								}

						}





						$file_upload2=$_POST['file_upload2'] ?? '';echo $file_upload2;
						$var_file2= $_FILES["file_upload2"]["name"];
						if($var_file2!="") {
						$pie_file2=explode (".", $var_file2);
$pie_file2 = array_pad($pie_file2, 6, '');


								if ($pie_file2[1]=="pdf" || $pie_file2[1]=="PDF") {

												if ($file_att != "-") { unlink("file_att/$y_year_budget/$file_att"); }
												if(is_dir("file_att/$y_year_budget/")) {  } else { mkdir("file_att/$y_year_budget/"); }
												if(move_uploaded_file($_FILES["file_upload2"]["tmp_name"],"file_att/$y_year_budget/$all_count.pdf")) {
														$sql_update2=ams_sql("update data_lda set file_att=? where id=?", ["$all_count.pdf", "$id"]);
														$qr_update2=ams_query($link,$sql_update2) or die ("Error_Upload_File PDF");
												}

								}



						}





							echo "<meta http-equiv=\"Refresh\" content=\"0; URL=data.php?d4=1&v_update=1&s_page2=$s_page2&urlquery_str2=$urlquery_str2&txt_title=$txt_title_search&txt_no=$txt_no_search&g=1\">";





		?>

</body>
</html>
<?php } ?>
