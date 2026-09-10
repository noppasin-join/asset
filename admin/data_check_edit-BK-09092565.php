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
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                                    <div >
																			<input type="hidden" name="year_budget" value="<?php echo $year_budget; ?>">
                                      <table class="table9 table-striped table-bordered table-hover">
                                        <thead>
																					<?php if($status_con=="1") { ?>
                                          <tr>
                                            <td class="head_blue" colspan="15"> :: ปีงบประมาณ : <font color="#e8f652" size="2"><b><?php echo $year_budget; ?></b></font></td>
                                          </tr>
																				<?php } ?>
																				<tr>
																					<th class="center font_brown70 hidden-1000" > ลำดับ.</th>
																					<th class="center font_brown70">เลขครุภัณฑ์</th>
																					<th class="center font_brown70">รายการ</th>
																					<th class="center font_brown70 hidden-1000">ยี่ห้อ</th>
																					<th class="center font_brown70">สถานะ</th>
																					<th class="center font_brown70">สถานที่ใช้งาน</th>
																					<th class="center font_brown70">ผู้ใช้งาน</th>
																					<th class="center font_brown70">หมายเหตุ</th>
																				</tr>
                                        </thead>
                                        <tbody>
                                          <?php
																					$q=ams_sql("SELECT * FROM data_check where id=?", ["$id"]);
																					$qr=ams_query($link,$q);

																					while($rs=mysqli_fetch_array($qr)) {

																												$sql_data = ams_sql("SELECT * from  data_lda where id=? ", ["$rs[id_data_lda]"]);
																												$qr_data=ams_query($link,$sql_data) or die ("เลือกข้อมูลไม่ได้");
																												$total_list=mysqli_num_rows($qr_data);
																												$rs_data=mysqli_fetch_array($qr_data);
																												$data_lda=$rs_data['id'];
																												$barcode2=$rs_data['barcode2'];
																												$lda_list=$rs_data['lda_list'];
																												$lda_brand=$rs_data['lda_brand'];
																												$id_location=$rs_data['id_location'];
																												$name_use=$rs_data['name_use'];
																												$lda_status=$rs_data['lda_status'];
																												$note=$rs_data['note'];
																						?>
																						<?php if($total_list!=0) { ?>
                                          <tr>
                                            <td class="center font_brown hidden-1000" style="vertical-align:middle;">1.</td>
                                            <td class="center font_brown" style="vertical-align:middle;"><?php echo $barcode2; ?></td>
                                            <td class="font_brown" style="vertical-align:middle;">
																							<a  href="detail_data.php?id=<?php echo $rs['id_data_lda']; ?>" class="fancybox fancybox.ajax"><?php echo $lda_list; ?></a>
																						</td>
																						<td class="font_brown hidden-1000" style="vertical-align:middle;"><?php echo $lda_brand; ?></td>





																						<td class="font_brown center" style="vertical-align:middle;">

												                      <select name="choose_status" style="background-color:#f4f9fc;font-size:13px;" class="form-control">
																									<?php if($rs['status_new']=="1") { ?><option value="1" selected>ใช้งานปกติ</option><?php } else { ?><option value="1">ใช้งานปกติ</option><?php } ?>
																									<?php if($rs['status_new']=="2") { ?><option value="2" selected>ชำรุด</option><?php } else { ?><option value="2">ชำรุด</option><?php } ?>
																									<?php if($rs['status_new']=="7") { ?><option value="6" selected>สภาพปกติ ไม่จำเป็นต้องใช้งาน</option><?php } else { ?><option value="7">สภาพปกติ ไม่จำเป็นต้องใช้งาน</option><?php } ?>
												                      </select>

																						</td>
																						<td class="font_brown center" style="vertical-align:middle;">

																							<select class="form-control" name="choose_location_new" style="background-color:#f4f9fc;font-size:13px;">
																								<?php
																								$sql_locate_select = ams_sql("SELECT * from  data_location where id=?", ["$rs[id_location]"]);
																								$qr_locate_select=ams_query($link,$sql_locate_select) or die ("เลือกข้อมูลไม่ได้");
																													$rs_locate_select=mysqli_fetch_array($qr_locate_select);
																													$id_locate_select=$rs_locate_select['id'];
																													$name_location_select=$rs_locate_select['name_location'];
																								?>

																								<option value="<?php echo $id_locate_select;?>" selected><?php echo $name_location_select;?></option>
																								<option value="">------------</option>
																								<?php
																								$sql_locate = "SELECT * from  data_location order by name_location ";
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

																						</td>
																						<td class="font_brown" style="vertical-align:middle;">

																							<input type="text" class="form-control validate[required]" style="font-size:13px;background-color:#f4f9fc;" value="<?php echo $rs['name_use']; ?>" name="txt_name" maxlength="100">

																						</td>
																						<td class="font_brown" style="vertical-align:middle;">

																							<input type="text" class="form-control" style="font-size:13px;background-color:#f4f9fc;" value="<?php echo $rs['note']; ?>" name="txt_note" maxlength="250">
																						</td>



																								<input type="hidden" name="id" value="<?php echo $id; ?>">
																								<input type="hidden" name="data_lda" value="<?php echo $rs['id_data_lda']; ?>">
																								<input type="hidden" name="choose_location" value="<?php echo $choose_location; ?>">

																								<input type="hidden" name="s_page2" value="<?php echo $s_page2; ?>">
																								<input type="hidden" name="urlquery_str2" value="<?php echo $urlquery_str2; ?>">




																						<!-- End form -->
                                          </tr>
																				<?php } ?>

                                          <?php } ?>

                                        </tbody>
                                      </table>


                                    </div>

																		<div class="row">
																			<div class="col-xs-12">
																				<button type="submit" class="btn btn-primary" OnClick="fncAction1()">บันทึกข้อมูล</button>
																			</div>
																		</div>

                                  </div>




                                  </div>
							</form>


            </div>

					</div><!-- /.main-content -->


          </div>




        <?php include("class_footer.php"); ?>

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
