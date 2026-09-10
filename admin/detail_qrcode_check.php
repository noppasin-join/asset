<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
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

$q="SELECT * FROM data_lda where qrcode_check='1' order by barcode1";


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




<?php

echo "</li>";
?>

<?php $i_list++; } ?>

</ul>
</div><!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->
</div>
<?php
$sql_update="UPDATE data_lda set qrcode_check=''";
$qr_update=ams_query($link,$sql_update) or die ("Error Check QR Code");
?>
<script src="assets/js/jquery.2.1.1.min.js"></script>
<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
<script src="assets/js/bootstrap.min.js"></script>
</html>
<?php } ?>
