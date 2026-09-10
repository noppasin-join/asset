<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$txt_barcode = '';
$txt_barcode_lib = '';
$txt_title = '';
$txt_brand = '';
$txt_serial = '';
$choose_category = '';
$choose_locate = '';
$txt_date_expire = '';
$txt_user_use = '';
$choose_status = '';
$choose_borrow = '';
$txt_note = '';
$txt_price = '';
$txt_asset = '';
$file_upload = '';
$file_upload2 = '';
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
$sql_year = "SELECT * from  budget order by year_budget desc   ";
$dbquery_year=ams_query($link,$sql_year) or die ("เลือกข้อมูลไม่ได้");
$result_year=mysqli_fetch_array($dbquery_year);
$year_budget=$result_year['year_budget'];

$txt_barcode=$_POST['txt_barcode'] ?? '';
$txt_barcode_lib=$_POST['txt_barcode_lib'] ?? '';
$txt_title=$_POST['txt_title'] ?? '';	$t_title = trim ($txt_title);
$txt_brand=$_POST['txt_brand'] ?? ''; $t_brand = trim ($txt_brand);
$txt_serial=$_POST['txt_serial'] ?? ''; $t_serial = trim ($txt_serial);
$choose_category=$_POST['choose_category'] ?? '';
$choose_locate=$_POST['choose_locate'] ?? '';
$txt_date_expire=$_POST['txt_date_expire'] ?? '';
$txt_user_use=$_POST['txt_user_use'] ?? ''; $t_user_use = trim ($txt_user_use);

$choose_status=$_POST['choose_status'] ?? '';
$choose_borrow=$_POST['choose_borrow'] ?? '';
$txt_note=$_POST['txt_note'] ?? '';
$txt_price=$_POST['txt_price'] ?? '';
$txt_asset=$_POST['txt_asset'] ?? '';

$pie=explode ("-", $txt_barcode);
$pie = array_pad($pie, 6, '');
$count = $pie[0];
$count1 = $pie[1];
$count2 = $pie[2];
$count3 = $pie[3];
$count4 = $pie[4];
$count5 = $pie[5];
if($pie[5]!="") {
	$all_count = "$pie[0]$pie[1]$pie[2]$pie[3]$pie[4]$pie[5]";
} else {
	$all_count = "$pie[0]$pie[1]$pie[2]$pie[3]$pie[4]";
}

if($choose_status=="1" || $choose_status=="2" || $choose_status=="7") { $var_status=1;  }
elseif ($choose_status=="3" || $choose_status=="4" || $choose_status=="5" || $choose_status=="6" || $choose_status=="8") { $var_status=2; }



						$q_check=ams_sql("SELECT * FROM data_lda  where barcode2 = ?  ", ["$txt_barcode_lib"]);
						$qr_check=ams_query($link,$q_check);
					  $total_check=mysqli_num_rows($qr_check);

						if ($total_check != "0") {
							echo "<meta http-equiv=\"Refresh\" content=\"0; URL=data.php?d4=1&total_check=$total_check\">";
						} else {

						$sql_insert=ams_sql("insert into data_lda(asset,year_budget,barcode1,barcode2,barcode3,
						lda_category,lda_type,lda_detail,lda_year,lda_mfu,lda_no,lda_list,lda_brand,lda_serial,
						id_category,id_location,name_use,
						id_member_input,date_input,time_input,
						id_member_update,date_update,time_update,
						lda_status,note,
						file_img,file_att,price,status_check,date_expire,status_borrow) values
						(?,?,?,?,?,
						?,?,?,?,?,?,?,?,?,
						?,?,?,
						?,?,?,
						'-','-','-',
						?,?,
						'-','-',?,?,?,?
						) ", ["$txt_asset", "$year_budget", "$all_count", "$txt_barcode", "$txt_barcode_lib", "$count", "$count1", "$count2", "$count3", "$count4", "$count5", "".$t_title."", "$t_brand", "$t_serial", "$choose_category", "$choose_locate", "$t_user_use", "$id_member", "$day/$month/$year", "$time_log", "$choose_status", "$txt_note", "$txt_price", "$var_status", "$txt_date_expire", "$choose_borrow"]);
						$qr_insert=ams_query($link,$sql_insert) or die ("Error3");


						$file_upload=$_POST['file_upload'] ?? '';
						$var_file= $_FILES["file_upload"]["name"];
						if($var_file!="") {
						$pie_file=explode (".", $var_file);
$pie_file = array_pad($pie_file, 6, '');

							$sql_sort = "select * from  data_lda order by id desc   ";
							$qr_sort=ams_query($link,$sql_sort) or die ("เลือกข้อมูลไม่ได้");
							$rs_sort=mysqli_fetch_array($qr_sort);
							$id_sort=$rs_sort['id'];

								if ($pie_file[1]=="jpg" || $pie_file[1]=="JPG") {

												if(is_dir("file_img/$year_budget/")) {  } else { mkdir("file_img/$year_budget/"); }
												if(move_uploaded_file($_FILES["file_upload"]["tmp_name"],"file_img/$year_budget/$all_count.jpg")) {
														$sql_update=ams_sql("update data_lda set file_img=? where id=?", ["$all_count.jpg", "$id_sort"]);
														$qr_update=ams_query($link,$sql_update) or die ("Error_Upload_File JPG");
												}


								} elseif ($pie_file[1]=="jpeg" || $pie_file[1]=="JPEG") {

												if(is_dir("file_img/$year_budget/")) {  } else { mkdir("file_img/$year_budget/"); }
												if(move_uploaded_file($_FILES["file_upload"]["tmp_name"],"file_img/$year_budget/$all_count.jpeg")) {
														$sql_update=ams_sql("update data_lda set file_img=? where id=?", ["$all_count.jpeg", "$id_sort"]);
														$qr_update=ams_query($link,$sql_update) or die ("Error_Upload_File JPEG");
												}


								} elseif ($pie_file[1]=="gif" || $pie_file[1]=="GIF") {

												if(is_dir("file_img/$year_budget/")) {  } else { mkdir("file_img/$year_budget/"); }
												if(move_uploaded_file($_FILES["file_upload"]["tmp_name"],"file_img/$year_budget/$all_count.gif")) {
														$sql_update=ams_sql("update data_lda set file_img=? where id=?", ["$all_count.jpeg", "$id_sort"]);
														$qr_update=ams_query($link,$sql_update) or die ("Error_Upload_File GIF");
												}


								} elseif ($pie_file[1]=="tif" || $pie_file[1]=="TIF" || $pie_file[1]=="tiff" || $pie_file[1]=="TIFF") {

												if(is_dir("file_img/$year_budget/")) {  } else { mkdir("file_img/eng/$year_budget/"); }
												if(move_uploaded_file($_FILES["file_upload"]["tmp_name"],"file_img/$year_budget/$all_count.tif")) {
														$sql_update=ams_sql("update data_lda set file_img=? where id=?", ["$all_count.jpeg", "$id_sort"]);
														$qr_update=ams_query($link,$sql_update) or die ("Error_Upload_File TIF");
												}


								} elseif ($pie_file[1]=="bmp" || $pie_file[1]=="BMP" ) {

												if(is_dir("file_img/$year_budget/")) {  } else { mkdir("file_img/$year_budget/"); }
												if(move_uploaded_file($_FILES["file_upload"]["tmp_name"],"file_img/$year_budget/$all_count.bmp")) {
														$sql_update=ams_sql("update data_lda set file_img=? where id=?", ["$all_count.jpeg", "$id_sort"]);
														$qr_update=ams_query($link,$sql_update) or die ("Error_Upload_File BMP");
												}


								}


							}


						$file_upload2=$_POST['file_upload2'] ?? '';
						$var_file2= $_FILES["file_upload2"]["name"];
						if($var_file2!="") {
						$pie_file2=explode (".", $var_file2);
$pie_file2 = array_pad($pie_file2, 6, '');


								if ($pie_file2[1]=="pdf" || $pie_file2[1]=="PDF") {

												if(is_dir("file_att/$year_budget/")) {  } else { mkdir("file_att/$year_budget/"); }
												if(move_uploaded_file($_FILES["file_upload2"]["tmp_name"],"file_att/$year_budget/$all_count.pdf")) {
														$sql_update2=ams_sql("update data_lda set file_att=? where id=?", ["$all_count.pdf", "$id_sort"]);
														$qr_update2=ams_query($link,$sql_update2) or die ("Error_Upload_File PDF");
												}

								}



						}



							echo "<meta http-equiv=\"Refresh\" content=\"0; URL=data.php?d4=1&v_success=1\">";
}



		?>

</body>
</html>
<?php } ?>
