<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$qrcode2 = '';
$var_qr = '';
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
		<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<!-- ace settings handler -->
		<script src="assets/js/ace-extra.min.js"></script>
    <link rel="shortcut icon" href="mfu.ico" type="image/x-icon">
		<link rel="stylesheet" href="reg-style.css" />
		<link rel="stylesheet" href="AdminLTE.min.css" />

    <link rel="stylesheet" href="assets2/plugins/validationengine/css/validationEngine.jquery.css" />
		<style> body { font-family: sarabun; } </style>




	</head>

	<body class="no-skin">
		<?php include("class_head.php");?>

		<div class="main-container" id="main-container">

			<div id="sidebar" class="sidebar responsive">


				<?php include("class_menu.php"); ?>

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>

			<div class="main-content">
				<div class="main-content-inner">

					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li class="active">ข้อมูลครุภัณฑ์</li>
						</ul><!-- /.breadcrumb -->

					</div>


					<?php $qrcode2=$_POST['qrcode2'] ?? ''; ?>
					<?php $var_qr=$_POST['var_qr'] ?? ''; ?>

                    <div class="page-content">


						<div class="row">
							<div class="col-xs-12">

<div class="row">
<form class="form-horizontal" role="form" method="post" name="frmMain" id="popup-validation" action="add_qr_check.php">
<?php


$sql_year="SELECT * FROM data_config order by year_budget desc";
$query_year=ams_query($link,$sql_year);
	$total_qr_config=mysqli_num_rows($query_year);
	$result_year=mysqli_fetch_array($query_year);
		$year_budget=$result_year['year_budget'];
		$status_con=$result_year['status'];


$pie=explode ("-", $qrcode2);
$pie = array_pad($pie, 6, '');
if($pie[1]=="") {
$q_2=ams_sql("SELECT * FROM data_check where year_budget=? and barcode3=?", ["$year_budget", "$qrcode2"]);
} else {
	$q_2=ams_sql("SELECT * FROM data_check where year_budget=? and barcode2=?", ["$year_budget", "$qrcode2"]);
}
$qr_2=ams_query($link,$q_2);
$total_2=mysqli_num_rows($qr_2);
$rs_2=mysqli_fetch_array($qr_2);
$id_check=$rs_2['id'];
$id_data_lda=$rs_2['id_data_lda'];

$sql_data = ams_sql("SELECT * from  data_lda where id=? ", ["$id_data_lda"]);
$qr_data=ams_query($link,$sql_data) or die ("เลือกข้อมูลไม่ได้");
					$rs_data=mysqli_fetch_array($qr_data);
					$year_img=$rs_data['year_budget'];
					$file_img=$rs_data['file_img'];


$lda_list=$rs_2['lda_list'];
$lda_brand=$rs_2['lda_brand'];
$name_use_old=$rs_2['name_use_old'];
$id_location_old=$rs_2['id_location_old'];
$id_location=$rs_2['id_location'];
$status_show=$rs_2['status'];
$name_use=$rs_2['name_use'];
$status_old=$rs_2['status_old'];
$note=$rs_2['note'];
$date_check=$rs_2['date_check'];
$time_check=$rs_2['time_check'];


$status_check=$rs_2['status'];
$id_member_check=$rs_2['id_member_check'];
$q_check=ams_sql("SELECT * FROM member where id=?", ["$id_member_check"]);
$qr_check=ams_query($link,$q_check);
$rs_check=mysqli_fetch_array($qr_check);
$name_check=$rs_check['name'];
$surname_check=$rs_check['surname'];
?>
<input type="hidden" name="var_t" value="<?php echo $qrcode2;?>">
<input type="hidden" name="id_check" value="<?php echo $id_check;?>">
<input type="hidden" name="id_data_lda" value="<?php echo $id_data_lda;?>">

<?php if($total_2!="0") { ?>
<div class="col-sm-8 col-xs-12">
<div class="widget-box">
<div class="widget-header">
<h5 class="widget-title"><i class="ace-icon fa fa-cube "></i>ตรวจสอบสถานะครุภัณฑ์</h5>
</div>
<div class="widget-body">
<div class="widget-main">
	<div>
		<div class="input-group"> <span class="input-group-addon"><i class="ace-icon fa fa-barcode"> </i> </span>
			<input class="col-xs-10 col-sm-6  validate[required]" type="text" style="background-color:#f3f7f3!important;color: #000!important;" name="txt_barcode" value="<?php echo $qrcode2;?>" disabled/>
		</div>
	</div>
	<div class="row" style="padding:5px;"> </div>
	<div>
		<div class="input-group"> <span class="input-group-addon">ชื่อรายการ </span>
			<input class="col-xs-10 col-sm-12  validate[required]" type="text" style="background-color:#f3f7f3!important;color: #000!important;" name="txt_name" value="<?php echo $lda_list;?>" disabled/>
		</div>
	</div>
	<div class="row" style="padding:5px;"> </div>
	<div>
		<div class="input-group"> <span class="input-group-addon">ยี่ห้อ </span>
			<input class="col-xs-10 col-sm-8  validate[required]" type="text" style="background-color:#f3f7f3!important;color: #000!important;" name="txt_brand" value="<?php echo $lda_brand;?>" disabled/>
		</div>
	</div>
	<hr />
	<div>
		<div class="input-group"> <span class="input-group-addon">ผู้ใช้งาน </span>
			<?php if($status_check=="2") { ?>
			<input class="col-xs-10 col-sm-8  validate[required]" type="text"  name="txt_use" value="<?php echo $name_use_old;?>" />
			<?php } else { ?>
			<input class="col-xs-10 col-sm-8" type="text" style="background-color:#f3f7f3!important;color: #000!important;" name="txt_use" value="<?php echo $name_use;?>" disabled/>
			<?php } ?>
		</div>
	</div>
	<div class="row" style="padding:5px;"> </div>
	<div>
		<div class="input-group"> <span class="input-group-addon">สถานที่ใช้งาน </span>
			<?php if($status_check=="2") { ?>
			<select name="choose_location" style="font-size:14px;height: 34px;" class="col-xs-10 col-sm-8  validate[required]">
				<?php
				$sql_lc = ams_sql("SELECT * from  data_location where id=?", ["$id_location_old"]);
				$qr_lc=ams_query($link,$sql_lc) or die ("เลือกข้อมูลไม่ได้");
									$rs_lc=mysqli_fetch_array($qr_lc);
									$id_lc=$rs_lc['id'];
									$name_lc=$rs_lc['name_location'];
				?>

				<option value="<?php echo $id_lc;?>" selected><?php echo $name_lc;?></option>
				<option value="">------------</option>
				<?php
				$sql_locate = "SELECT * from  data_location where status_location='0' order by name_location ";
				$qr_locate=ams_query($link,$sql_locate) or die ("เลือกข้อมูลไม่ได้");
				ams_query($link, "SET NAMES UTF8");
				$num_locate=mysqli_num_rows($qr_locate);
				$i_lc=0;
							while($i_lc<$num_locate) {
									$rs_locate=mysqli_fetch_array($qr_locate);
									$id_locate=$rs_locate['id'];
									$name_location=$rs_locate['name_location'];
				?>
				<option value="<?php echo $id_locate; ?>"><?php echo $name_location; ?></option>
				<?php $i_lc++; } ?>
			</select>
		<?php } else { ?>
			<?php
			$sql_lc = ams_sql("SELECT * from  data_location where id=?", ["$id_location"]);
			$qr_lc=ams_query($link,$sql_lc) or die ("เลือกข้อมูลไม่ได้");
								$rs_lc=mysqli_fetch_array($qr_lc);
								$id_lc=$rs_lc['id'];
								$name_lc=$rs_lc['name_location'];
			?>
			<input class="col-xs-10 col-sm-8" type="text" style="background-color:#f3f7f3!important;color: #000!important;" name="txt_lc" value="<?php echo $name_lc;?>" disabled/>
		<?php } ?>

		</div>
	</div>
	<div class="row" style="padding:5px;"> </div>
	<div>
		<div class="input-group"> <span class="input-group-addon">สถานะ </span>
			<?php if($status_check=="2") { ?>
			<select name="choose_status" style="font-size:15px;height: 34px;">
					<?php if($status_old=="1") { ?><option value="1" selected>ใช้งานปกติ</option><?php } else { ?><option value="1">ใช้งานปกติ</option><?php } ?>
					<?php if($status_old=="2") { ?><option value="2" selected>ชำรุด</option><?php } else { ?><option value="2">ชำรุด</option><?php } ?>
					<?php if($status_old=="7") { ?><option value="7" selected>สภาพปกติ ไม่จำเป็นต้องใช้งาน</option><?php } else { ?><option value="7">สภาพปกติ ไม่จำเป็นต้องใช้งาน</option><?php } ?>
			</select>
		<?php } else { ?>
			<?php if($status_show=="1") { ?>
			<input class="col-xs-10 col-sm-4" type="text" style="background-color:#f3f7f3!important;color: #000!important;" name="txt_st" value="ใช้งานปกติ" disabled/>
			<?php } ?>
			<?php if($status_show=="2") { ?>
			<input class="col-xs-10 col-sm-4" type="text" style="background-color:#f3f7f3!important;color: #000!important;" name="txt_st" value="ชำรุด" disabled/>
			<?php } ?>
			<?php if($status_show=="3") { ?>
			<input class="col-xs-10 col-sm-4" type="text" style="background-color:#f3f7f3!important;color: #000!important;" name="txt_st" value="สภาพปกติ ไม่จำเป็นต้องใช้งาน" disabled/>
			<?php } ?>
		<?php } ?>

		</div>
	</div>
	<div class="row" style="padding:5px;"> </div>
	<div>
		<div class="input-group"> <span class="input-group-addon">หมายเหตุ </span>
			<?php if($status_check=="2") { ?>
			<input class="col-xs-10 col-sm-8" type="text"  name="txt_note" placeholder="###" />
			<?php } else { ?>
				<input class="col-xs-10 col-sm-8" type="text"  name="txt_note" value="<?php echo $note;?>" style="font-size:14px;height: 34px;background-color:#f3f7f3!important;color: #000!important;" disabled/>
			<?php } ?>
		</div>
	</div>

	<?php if($status_check=="1") { ?>
	<hr />
	<div>
		<div class="input-group"> <span class="input-group-addon">ผู้ตรวจ </span>
				<input class="col-xs-10 col-sm-8" type="text" style="font-size:14px;height: 34px;background-color:#f3f7f3!important;color: #000!important;"
				value="<?php echo $name_check;?> <?php echo $surname_check;?> ** <?php echo $date_check;?> <?php echo $time_check;?>" disabled/>
		</div>
	</div>
	<?php } ?>
	<hr />
	<div>
		<div class="input-group">
				<img src="file_img/<?php echo $year_img; ?>/<?php echo $file_img;?>" width="200">
		</div>
	</div>

	<hr />
<?php if($status_check=="2" && $var_qr!="1") { ?>
<div style="text-align:center">
<input type="submit" value=" Click To Submit"  class="btn bg-olive" id="gritter-without-image" />
</div>
<?php }?>
</div>
</div>
</div>
</div>
<?php } else { echo "<meta http-equiv=\"Refresh\" content=\"0; URL=qrcode.php?q1=1&v_check=1\">"; } ?>

</form>


</div>

<?php if($status_check=="1" && $var_qr!="1") { ?>
<form class="form-horizontal" role="form" method="post" name="form_return" action="qrcode.php">
	<input type="hidden" name="q11" value="1">
<div>
<input type="submit" value="<-- ย้อนกลับ"  class="btn bg-olive" id="gritter-without-image" />
</div>
</form>
<?php } ?>

<div class="pull-left">
<?php if($var_qr=="1") { ?>
<form class="form-horizontal" role="form" method="post" name="form_return" action="data.php">
	<input type="hidden" name="d41" value="1">
<input type="submit" value="<-- ย้อนกลับ"  class="btn bg-olive" id="gritter-without-image" />
</form>
<?php } ?>

</div>


							</div><!-- /.col -->
						</div><!-- /.row -->
					</div>

				</div>

			</div><!-- /.main-content -->



			<?php include("class_footer.php"); ?>

			<?php include("class_scroll_up.php"); ?>
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


		<script src="assets2/plugins/validationengine/js/jquery.validationEngine.js"></script>
        <script src="assets2/plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script>
        <script src="assets2/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
        <script src="assets2/js/validationInit.js"></script>
        <script>
        $(function () { formValidation(); });
        </script>

        <script language="JavaScript">
				window.setTimeout(function() {
				$(".alert").fadeTo(500, 0).slideUp(500, function(){
					$(this).remove();
				});
			  }, 4000);
		   </script>


        <!--
        <script language="JavaScript">
				$(document).ready(function() {
				  $("#success-alert").hide();
					$("#success-alert").fadeTo(4500, 500).slideUp(500, function() {
					  $("#success-alert").slideUp(500);
					});
				});
		</script>
        -->

	</body>
</html>
<?php } ?>
