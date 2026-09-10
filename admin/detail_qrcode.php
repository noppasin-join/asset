<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$id = '';
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
				<script type="text/javascript" src="qr/qrcode.js"></script>
				<style> body { font-family: sarabun; } </style>
				<link rel="stylesheet" href="AdminLTE.min.css">

	</head>

	<body>
	<?php
	$id=$_GET['id'] ?? '';
	$sql_data = ams_sql("select * from  data_lda where id=? ", ["$id"]);
	$qr_data=ams_query($link,$sql_data) or die ("เลือกข้อมูลไม่ได้");
					$rs_data=mysqli_fetch_array($qr_data);
					$barcode1=$rs_data['barcode1'];
					$barcode3=$rs_data['barcode3'];
					$lda_list=$rs_data['lda_list'];

?>
<input id="text" type="hidden" value="http://jindo.dev.naver.com/collie" />
<div style="width:200px;padding-top: 2px;font-size: 15px; "><?php echo "<center>".$lda_list."</center>" ;?></div>
<div id="qrcode" style="width:200px; height:200px;padding-top: 2px;"></div>
<?php if($barcode3=="") { ?>
<div style="width:200px;padding-top: 2px; "><?php echo "<center>".$barcode1."</center>" ;?></div>
<script type="text/javascript">
var qrcode = new QRCode(document.getElementById("qrcode"), {
	width : 200,
	height : 200
});

function makeCode () {
	var elText = document.getElementById("text");

	if (!elText.value) {
		alert("Input a text");
		elText.focus();
		return;
	}

	qrcode.makeCode("<?php echo $barcode1; ?>");
}

makeCode();
</script>
<?php } else { ?>
	<div style="width:200px;padding-top: 2px; "><?php echo "<center>".$barcode3."</center>" ;?></div>
	<script type="text/javascript">
	var qrcode = new QRCode(document.getElementById("qrcode"), {
		width : 200,
		height : 200
	});

	function makeCode () {
		var elText = document.getElementById("text");

		if (!elText.value) {
			alert("Input a text");
			elText.focus();
			return;
		}

		qrcode.makeCode("<?php echo $barcode3; ?>");
	}

	makeCode();
	</script>
<?php } ?>
<script src="assets/js/jquery.2.1.1.min.js"></script>
<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
<script src="assets/js/bootstrap.min.js"></script>
</html>
<?php } ?>
