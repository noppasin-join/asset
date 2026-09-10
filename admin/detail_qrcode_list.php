<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$choose_year = '';
$choose_category = '';
$choose_status = '';
$choose_location = '';
$txt_title = '';
$txt_no = '';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
	$sess_user = $_SESSION['sess_user'] ?? '';
	$sess_password = $_SESSION['sess_password'] ?? '';

	require_once __DIR__ . '/con_lda.php';
	if ($sess_user == "" || $status!=0) {
    ams_deny(403, 'Insufficient permissions.');
	} else {
	set_time_limit(0);

?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
        <title>:: ระบบฐานข้อมูลครุภัณฑ์ ศูนย์บรรณสารฯ</title>
				<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />





				<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
				<link rel="stylesheet" href="assets/font-awesome/4.2.0/css/font-awesome.min.css" />
				<!-- page specific plugin styles -->
				<link rel="stylesheet" href="assets/css/jquery-ui.min.css" />
				<link rel="stylesheet" href="assets/css/ui.jqgrid.min.css" />
				<!-- text fonts -->
				<link rel="stylesheet" href="assets/fonts/fonts.googleapis.com.css" />
				<!-- ace styles -->
				<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
				<script src="assets/js/ace-extra.min.js"></script>






				<style> body { font-family: sarabun; } </style>
				<link rel="stylesheet" href="AdminLTE.min.css">
					<!--			<script type="text/javascript" src="qr/qrcode.js"></script> -->

<?php include "phpqrcode/qrlib.php"; ?>


	</head>

	<body style="background-color:#FFF;">

	<?php
	$choose_year=$_GET['choose_year'] ?? '';
	$choose_category=$_GET['choose_category'] ?? '';
	$choose_status=$_GET['choose_status'] ?? '';
	$choose_location=$_GET['choose_location'] ?? '';
	$txt_title=$_GET['txt_title'] ?? '';
	$txt_no=$_GET['txt_no'] ?? '';


	if ($choose_year=="") {


							if ($txt_no=="" && $txt_title=="") {

											if ($choose_category=="") {
																if ($choose_status =="") {
																		if($choose_location == "") {
																			$q="SELECT * FROM data_lda  order by barcode1";
																		} else {
																			$q=ams_sql("SELECT * FROM data_lda where id_location=?  order by barcode1", ["$choose_location"]);
																		}
																} else {
																		if($choose_location == "") {
																			$q=ams_sql("SELECT * FROM data_lda  where lda_status=? order by barcode1", ["$choose_status"]);
																		} else {
																			$q=ams_sql("SELECT * FROM data_lda  where lda_status=? and id_location=? order by barcode1", ["$choose_status", "$choose_location"]);
																		}
																}
											} else {

																if ($choose_status =="") {
																		if($choose_location == "") {
																			$q=ams_sql("SELECT * FROM data_lda where id_category=?  order by barcode1", ["$choose_category"]);
																		} else {
																			$q=ams_sql("SELECT * FROM data_lda where id_category=? and id_location=?  order by barcode1", ["$choose_category", "$choose_location"]);
																		}
																} else {
																		if($choose_location == "") {
																			$q=ams_sql("SELECT * FROM data_lda  where id_category=? and lda_status=? order by barcode1", ["$choose_category", "$choose_status"]);
																		} else {
																			$q=ams_sql("SELECT * FROM data_lda  where id_category=? and lda_status=? and id_location=? order by barcode1", ["$choose_category", "$choose_status", "$choose_location"]);
																		}
																}
											}

							} elseif ($txt_no!="" && $txt_title=="") {
																$var_trim=trim($txt_no);
																$q=ams_sql("SELECT * FROM data_lda  where  barcode1 like ?", ["%$var_trim%"]);
							} elseif ($txt_no!="" && $txt_title!="") {
																$var_trim1=trim($txt_no);
																$var_trim2=trim($txt_title);
																$q=ams_sql("SELECT * FROM data_lda  where  barcode1 like ?  and lda_list like ?", ["%$var_trim1%", "%$var_trim2%"]);
							} elseif ($txt_no=="" && $txt_title!="") {
																$var_trim=trim($txt_title);
																$q=ams_sql("SELECT * FROM data_lda  where  lda_list like ?  order by barcode1  ", ["%$var_trim%"]);
							}


		} elseif($choose_year!="") {

							if ($txt_no=="" && $txt_title=="") {

											if ($choose_category=="") {
																if ($choose_status =="") {
																		if($choose_location == "") {
																			$q=ams_sql("SELECT * FROM data_lda where year_budget=?  order by barcode1", ["$choose_year"]);
																		} else {
																			$q=ams_sql("SELECT * FROM data_lda where year_budget=? and id_location=?  order by barcode1", ["$choose_year", "$choose_location"]);
																		}
																} else {
																		if($choose_location == "") {
																			$q=ams_sql("SELECT * FROM data_lda  where year_budget=? and lda_status=? order by barcode1", ["$choose_year", "$choose_status"]);
																		} else {
																			$q=ams_sql("SELECT * FROM data_lda  where year_budget=? and lda_status=? and id_location=? order by barcode1", ["$choose_year", "$choose_status", "$choose_location"]);
																		}
																}
											} else {

																if ($choose_status =="") {
																		if($choose_location == "") {
																			$q=ams_sql("SELECT * FROM data_lda where year_budget=? and id_category=?  order by barcode1", ["$choose_year", "$choose_category"]);
																		} else {
																			$q=ams_sql("SELECT * FROM data_lda where year_budget=? and id_category=? and id_location=?  order by barcode1", ["$choose_year", "$choose_category", "$choose_location"]);
																		}
																} else {
																		if($choose_location == "") {
																			$q=ams_sql("SELECT * FROM data_lda  where year_budget=? and id_category=? and lda_status=? order by barcode1", ["$choose_year", "$choose_category", "$choose_status"]);
																		} else {
																			$q=ams_sql("SELECT * FROM data_lda  where year_budget=? and id_category=? and lda_status=? and id_location=? order by barcode1", ["$choose_year", "$choose_category", "$choose_status", "$choose_location"]);
																		}
																}
											}

							} elseif ($txt_no!="" && $txt_title=="") {
																$var_trim=trim($txt_no);
																$q=ams_sql("SELECT * FROM data_lda  where  barcode1 like ?", ["%$var_trim%"]);
							} elseif ($txt_no!="" && $txt_title!="") {
																$var_trim1=trim($txt_no);
																$var_trim2=trim($txt_title);
																$q=ams_sql("SELECT * FROM data_lda  where  barcode1 like ?  and lda_list like ?", ["%$var_trim1%", "%$var_trim2%"]);
							} elseif ($txt_no=="" && $txt_title!="") {
																$var_trim=trim($txt_title);
																$q=ams_sql("SELECT * FROM data_lda  where  lda_list like ?  order by barcode1  ", ["%$var_trim%"]);
							}


		}

$objScan = scandir("image");
foreach ($objScan as $value) {
//echo "folder : $value<br>";
unlink("image/".$value);
}

	$qr_data=ams_query($link,$q) or die ("เลือกข้อมูลไม่ได้");
	$total2=mysqli_num_rows($qr_data);
	$i_list=0;
	?>


	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div>
				<ul class="ace-thumbnails clearfix center">
	<?php
		while ($i_list<$total2) {
					$rs_data=mysqli_fetch_array($qr_data);
					$barcode1=$rs_data['barcode1'];
					$barcode3=$rs_data['barcode3'];
					$lda_list=$rs_data['lda_list'];

					?>

					<?php

if($barcode3=="") {
					$tempDir = dirname(__FILE__).DIRECTORY_SEPARATOR.'image/'.DIRECTORY_SEPARATOR;
					$codeContents = $barcode1;
					$fileName =  "$barcode1.png";
					$errorCorrectionLevel = 'H';
					$pngAbsoluteFilePath = $tempDir.$fileName;
					if (!file_exists($pngAbsoluteFilePath)) {
					QRcode::png($codeContents, $pngAbsoluteFilePath, $errorCorrectionLevel, 2);
					}
} else {
					$tempDir = dirname(__FILE__).DIRECTORY_SEPARATOR.'image/'.DIRECTORY_SEPARATOR;
					$codeContents = $barcode3;
					$fileName =  "$barcode3.png";
					$errorCorrectionLevel = 'H';
					$pngAbsoluteFilePath = $tempDir.$fileName;
					if (!file_exists($pngAbsoluteFilePath)) {
					QRcode::png($codeContents, $pngAbsoluteFilePath, $errorCorrectionLevel, 2);
					}
}
echo "<li>";
?>

<table border="0">
<tr>
<td><div style="width:140px;padding-top: 2px;font-size: 11px; "><?php echo $lda_list;?></div></td>
<td rowspan="2">
	<?php if($barcode3=="") { ?>
	<img src="image/<?php echo $barcode1.".png"; ?>">
	<?php } else { ?>
	<img src="image/<?php echo $barcode3.".png"; ?>">
	<?php } ?>
</td>
</tr>
<tr>
<td>
	<?php if($barcode3=="") { ?>
		<div style="font-size: 11px;"><?php echo $barcode1;?></div>
	<?php } else { ?>
		<div style="font-size: 11px;"><?php echo $barcode3;?></div>
	<?php } ?>
</td>
</tr>

</table>




<?php /* ?>
<?php if($barcode3=="") { ?>
<div style="font-size: 3px;"><?php echo $barcode1;?></div>
<img src="image/<?php echo $barcode1.".png"; ?>">
<?php } else { ?>
<div style="font-size: 3px;"><?php echo $barcode3;?></div>
<img src="image/<?php echo $barcode3.".png"; ?>">
<?php } ?>
<?php */?>
<?php

echo "</li>";
?>

<?php $i_list++; } ?>

</ul>
</div><!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->
</div>

<script src="assets/js/jquery.2.1.1.min.js"></script>
<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
<script src="assets/js/bootstrap.min.js"></script>
</html>
<?php } ?>
