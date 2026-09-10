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
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
        <title>:: ระบบฐานข้อมูลครุภัณฑ์ ศูนย์บรรณสารฯ</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.2.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="assets/fonts/fonts.googleapis.com.css" />
		<!-- ace settings handler -->
		<link rel="stylesheet" href="reg-style.css" />


	</head>

	<body class="no-skin">

			<div class="main-container" id="main-container">

				<div class="main-content">
					<div class="main-content-inner">

<?php
$id=$_GET['id'] ?? '';
$sql_data = ams_sql("select * from  data_lda where id=? ", ["$id"]);
$qr_data=ams_query($link,$sql_data) or die ("เลือกข้อมูลไม่ได้");
					$rs_data=mysqli_fetch_array($qr_data);
					$year_budget=$rs_data['year_budget'];
					$file_img=$rs_data['file_img'];
?>

      <div class="page-content">
        <div class="row">

          <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->





							<img src="file_img/<?php echo $year_budget; ?>/<?php echo $file_img;?>" height="600">






          </div>
          <!-- /.row -->
          <!-- PAGE CONTENT ENDS -->
        </div>
        <!-- /.col -->
      </div>






					 <?php // END BODY ?>

					</div>

				</div><!-- /.main-content -->




			</div><!-- /.main-container -->

			<script src="assets/js/jquery.2.1.1.min.js"></script>
			<script type="text/javascript">
				window.jQuery || document.write("<script src='assets/js/jquery.min.js'>"+"<"+"/script>");
			</script>
			<script type="text/javascript">
				if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
			</script>
			<script src="assets/js/bootstrap.min.js"></script>
			<script src="assets/js/jquery-ui.custom.min.js"></script>
			<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
			<script src="assets/js/ace-elements.min.js"></script>
			<script src="assets/js/ace.min.js"></script>








</body>
</html>
<?php } ?>
