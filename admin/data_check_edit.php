<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$g = '';
$id = '';
$choose_location = '';
$s_page2 = '';
$urlquery_str2 = '';
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
				<link rel="shortcut icon" href="mfu.ico" type="image/x-icon">
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
<link rel="stylesheet" href="reg-style.css" />



<style> body { font-family: sarabun; } </style>



				<!-- Add mousewheel plugin (this is optional) -->
				<link rel="stylesheet" href="AdminLTE.min.css">
				<script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>
				<!-- Add mousewheel plugin (this is optional) -->
				<!-- Add fancyBox main JS and CSS files -->
				<script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.5"></script>
				<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.5" media="screen" />
				<!-- Add Button helper (this is optional) -->
				<link rel="stylesheet" type="text/css" href="source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
				<script type="text/javascript" src="source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
				<script type="text/javascript">
						$(document).ready(function() {

							$('.fancybox').fancybox();



						});
					</script>

					<link rel="stylesheet" href="assets2/plugins/validationengine/css/validationEngine.jquery.css" />

  </head>
<?php
$g=$_GET['g'] ?? '';
$id=$_GET['id'] ?? '';
		$choose_location=$_GET['choose_location'] ?? '';
		$s_page2=$_GET['s_page2'] ?? '';
		$urlquery_str2=$_GET['urlquery_str2'] ?? '';

?>
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
                <li class="active">แก้ไขตรวจนับครุภัณฑ์</li>
              </ul><!-- /.breadcrumb -->

            </div>

            <div class="page-content">
							<?php
															$sql_year="SELECT * FROM data_config where status='1' order by year_budget desc";
															$query_year=ams_query($link,$sql_year);
																$total_qr_config=mysqli_num_rows($query_year);
															  $result_year=mysqli_fetch_array($query_year);
															  	$year_budget=$result_year['year_budget'];
																	$status_con=$result_year['status'];

							?>
							<form name="form_choose" method="post" action="update_data_check.php" id="popup-validation">



<?php
	$q_2=ams_sql("SELECT * FROM data_check where year_budget=? and id=?", ["$year_budget", "$id"]);
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
$barcode2=$rs_2['barcode2'];
$barcode3=$rs_2['barcode3'];
$name_use_old=$rs_2['name_use_old'];
$id_location_old=$rs_2['id_location_old'];
$id_location=$rs_2['id_location'];
$status_show=$rs_2['status'];
$status_new = $rs_2['status_new'] ?? '';
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
 <input type="hidden" name="id" value="<?php echo $id; ?>">
 <input type="hidden" name="data_lda" value="<?php echo $id_data_lda; ?>">
 <input type="hidden" name="choose_location" value="<?php echo $choose_location; ?>">

 <input type="hidden" name="s_page2" value="<?php echo $s_page2; ?>">
 <input type="hidden" name="urlquery_str2" value="<?php echo $urlquery_str2; ?>">

																	<div class="col-sm-12 col-xs-12 row">
																	<div class="widget-box">
																	<div class="widget-header">
																	<h5 class="widget-title"><i class="ace-icon fa fa-cube "></i>แก้ไขตรวจนับครุภัณฑ์</h5>
																	</div>
																	<div class="widget-body">
																	<div class="widget-main">
																		<div>
																			<div class="input-group"> <span class="input-group-addon"><i class="ace-icon fa fa-barcode"> </i> </span>
																				<?php if($barcode2=="") { ?>
																				<input class="col-xs-12 col-sm-12  validate[required]" type="text"
																				style="background-color:#f3f7f3!important;color: #000!important;" name="txt_barcode" value="<?php echo $barcode3;?>"
																				disabled/>
																			<?php } else { ?>
																				<input class="col-xs-12 col-sm-12  validate[required]" type="text"
																				style="background-color:#f3f7f3!important;color: #000!important;" name="txt_barcode" value="<?php echo $barcode2;?>"
																				disabled/>
																			<?php } ?>
																			</div>
																		</div>
																		<div class="row" style="padding:5px;"> </div>
																		<div>
																			<div class="input-group"> <span class="input-group-addon">ชื่อรายการ </span>
																				<input class="col-xs-12 col-sm-12  validate[required]" type="text" style="background-color:#f3f7f3!important;color: #000!important;" name="txt_name" value="<?php echo $lda_list;?>" disabled/>
																			</div>
																		</div>
																		<div class="row" style="padding:5px;"> </div>
																		<div>
																			<div class="input-group"> <span class="input-group-addon">ยี่ห้อ </span>
																				<input class="col-xs-12 col-sm-12  validate[required]" type="text" style="background-color:#f3f7f3!important;color: #000!important;" name="txt_brand" value="<?php echo $lda_brand;?>" disabled/>
																			</div>
																		</div>
																		<hr />

																		<div>
																			<div class="input-group"> <span class="input-group-addon">สถานที่ใช้งาน </span>
																					<select class="form-control" name="choose_location_new" style="font-size:14px;height: 34px;color: #000!important;">
																						<?php
																						$sql_locate_select = ams_sql("SELECT * from  data_location where id=?", ["$id_location"]);
																						$qr_locate_select=ams_query($link,$sql_locate_select) or die ("เลือกข้อมูลไม่ได้");
																											$rs_locate_select=mysqli_fetch_array($qr_locate_select);
																											$id_locate_select=$rs_locate_select['id'];
																											$name_location_select=$rs_locate_select['name_location'];
																						?>

																						<option value="<?php echo $id_locate_select;?>" selected><?php echo $name_location_select;?></option>
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


																			</div>
																		</div>
																		<div class="row" style="padding:5px;"> </div>
																		<div>
																			<div class="input-group"> <span class="input-group-addon">สถานะ </span>
																				<select name="choose_status" style="font-size:14px;height: 34px;color: #000!important;">
																						<?php if($status_new=="1") { ?><option value="1" selected>ใช้งานปกติ</option><?php } else { ?><option value="1">ใช้งานปกติ</option><?php } ?>
																						<?php if($status_new=="2") { ?><option value="2" selected>ชำรุด</option><?php } else { ?><option value="2">ชำรุด</option><?php } ?>
																						<?php if($status_new=="7") { ?><option value="7" selected>สภาพปกติ ไม่จำเป็นต้องใช้งาน</option><?php } else { ?><option value="7">สภาพปกติ ไม่จำเป็นต้องใช้งาน</option><?php } ?>
																				</select>

																			</div>
																		</div>
																		<div class="row" style="padding:5px;"> </div>
																		<div>
																			<div class="input-group"> <span class="input-group-addon">ผู้ใช้งาน </span>
																				<input class="col-xs-10 col-sm-8" type="text" style="color: #000!important;font-size:14px;" name="txt_use" value="<?php echo $name_use;?>"/>
																			</div>
																		</div>
																		<div class="row" style="padding:5px;"> </div>
																		<div>
																			<div class="input-group"> <span class="input-group-addon">หมายเหตุ </span>
																					<input class="col-xs-12 col-sm-12" type="text"  name="txt_note" value="<?php echo $note;?>" style="font-size:14px;height: 34px;color: #000!important;" />
																			</div>
																		</div>

																		<hr />
																		<div>
																			<div class="input-group"> <span class="input-group-addon">ผู้ตรวจ </span>
																					<input class="col-xs-12 col-sm-12" type="text" style="font-size:14px;height: 34px;background-color:#f3f7f3!important;color: #000!important;"
																					value="<?php echo $name_check;?> <?php echo $surname_check;?> ** <?php echo $date_check;?> <?php echo $time_check;?>" disabled/>
																			</div>
																		</div>
																		<hr />
																		<div>
																			<div class="input-group">
																					<img src="file_img/<?php echo $year_img; ?>/<?php echo $file_img;?>" width="200">
																			</div>
																		</div>

																		<hr />
																	<div style="text-align:center">
																	<input type="submit" value=" Update ข้อมูล"  class="btn bg-olive" id="gritter-without-image" />
																	</div>
																	</div>
																	</div>
																	</div>
																	</div>








                                  </div>
							</form>


            </div>

					</div><!-- /.main-content -->


          </div>




        <?php //include("class_footer.php"); ?>

        <?php include("class_scroll_up.php"); ?>
      </div><!-- /.main-container -->

      <script type="text/javascript">
        if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
      </script>
      <script src="assets/js/bootstrap.min.js"></script>
      <script src="assets/js/ace-elements.min.js"></script>
      <script src="assets/js/ace.min.js"></script>

			<script src="assets2/plugins/validationengine/js/jquery.validationEngine.js"></script>
			<script src="assets2/plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script>
			<script src="assets2/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
			<script src="assets2/js/validationInit.js"></script>
			<script>
			        $(function () { formValidation(); });
			        </script>

  </body>

</html>
<?php } ?>
