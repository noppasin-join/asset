<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$total_check = '';
$v_success = '';
$v_status = '';
$v_del = '';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
	$sess_user = $_SESSION['sess_user'] ?? '';
	$sess_password = $_SESSION['sess_password'] ?? '';

	require_once __DIR__ . '/con_lda.php';
	if ($sess_user == "" || $status!=0  || $level=="0") {
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
		<style> body { font-family: sarabun; } </style>
    <link rel="stylesheet" href="assets2/plugins/validationengine/css/validationEngine.jquery.css" />

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
								<li class="active">สถานที่ใช้งาน</li>
							</ul><!-- /.breadcrumb -->

						</div>




	          <div class="page-content">


							<div class="row">
								<div class="col-xs-12">
	              <?php
								$total_check=$_GET['total_check'] ?? '';
								$v_success=$_GET['v_success'] ?? '';
								$v_status=$_GET['v_status'] ?? '';
								$v_del=$_GET['v_del'] ?? '';
								?>
	              <?php if($total_check>"0") { ?>
									<div class="alert alert-block alert-danger" id="success-alert">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>

										<i class="ace-icon fa fa-bullhorn dark"></i>

										<b class="dark"><u>พบข้อผิดพลาด</u></b>  &nbsp;&nbsp;สถานที่ใช้งานดังกล่าว มีในระบบแล้ว!
									</div>
									<?php } ?>
	                <?php if($v_success=="1") { ?>
									<div class="alert alert-block alert-success" id="success-alert">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>

										<i class="ace-icon fa fa-check green"></i> &nbsp;
										<strong>เพิ่มสถานที่ใช้งาน เรียบร้อยแล้ว</strong>
									</div>
	                <?php } ?>
	                <?php if($v_del=="1") { ?>
									<div class="alert alert-block alert-success" id="success-alert">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>

										<i class="ace-icon fa fa-trash green"></i> &nbsp;
										<strong>ลบสถานที่ใช้งาน เรียบร้อยแล้ว</strong>
									</div>
	                <?php } ?>
									<?php if($v_status!="") { ?>
									<div class="alert alert-block alert-success" id="success-alert">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>

										<i class="ace-icon fa fa-check green"></i> &nbsp;
										<strong>เปลี่ยนสถานะ เรียบร้อยแล้ว</strong>
									</div>
	                <?php } ?>


	                            <div class="row">
	                            <div class="col-sm-6 col-xs-10">
	                                  <div >
	                                    <table class="table table-striped table-bordered table-hover">
	                                      <thead>
	                                        <tr>
	                                          <td class="head_blue" colspan="5"> :: ข้อมูลสถานที่ใช้งาน</td>
	                                        </tr>
	                                        <tr>
	                                          <td class="center "><b> ลำดับ. </b></td>
	                                          <td class="center"><b>ชื่อสถานที่ใช้งาน</b></td>
																						<?php if($level!=0) { ?>
																						<td class="center" colspan="2"><b>สถานะ (เพื่อแสดงในการตรวจนับ)</b></td>

	                                          <td class="center"> </td>
																					  <?php } ?>
	                                        </tr>
	                                      </thead>
	                                      <tbody>
	                                        <?php


	                                                                            $sql_locate = "SELECT * from  data_location order by name_location ";
	                                                                            $qr_locate=ams_query($link,$sql_locate) or die ("เลือกข้อมูลไม่ได้");
	                                                                            ams_query($link, "SET NAMES UTF8");
	                                                                            $num_locate=mysqli_num_rows($qr_locate);
	                                                                            $i=0;
	                                                                            $i2=1;

	                                                                    if ($num_locate!=0) {

	                                                                        while($i<$num_locate)
	                                                                        {
	                                                                        $rs_locate=mysqli_fetch_array($qr_locate);
																																					$id_locate=$rs_locate['id'];
																																					$name_location=$rs_locate['name_location'];
																																					$status_location=$rs_locate['status_location'];
	                                                                        ?>
	                                        <tr>
	                                          <td class="center font_brown"><?php echo $i2;?>.</td>
																						<td class="font_brown"><?php echo $name_location; ?></td>
																						<?php if($level!=0) { ?>
																						<?php if ($status_location=="0") { ?>
																							<td class="center hidden-500" bgcolor="#49ac8b"><font color="#FFFFFF">แสดง</font></td>
																						<?php } elseif($status_location=="1") { ?>
																								<td class="center hidden-500" bgcolor="#d15b47"><font color="#FFFFFF">ไม่แสดง</font></td>
																						<?php } ?>

																						<td class="font_brown center">
																							<a href="manage_location.php?d3=1&v_status=0&id_locate=<?php echo $id_locate; ?>">เปิด</a>&nbsp;&nbsp;|&nbsp;&nbsp;
																							<a href="manage_location.php?d3=1&v_status=1&id_locate=<?php echo $id_locate; ?>">ปิด</a>
																						</td>

	                                          <td class="center"><a class="red" href="add_location.php?id_del=<?php echo $id_locate;?>&send_del=1" onClick="return Conf<?php echo $id_locate; ?>(this)">
	                                            <i class="ace-icon fa fa-trash-o bigger-130"></i> </a>
	                                            <script language="JavaScript">
	                                                                                function Conf<?php echo $id_locate; ?>(object) {
	                                                                                if (confirm("ยืนยันในการลบข้อมูล! ") ==true) {
	                                                                                return true;
	                                                                                }
	                                                                                return false;
	                                                                                }

	                                                                                </script>
	                                          </td>
																					  <?php } ?>
	                                        </tr>

	                                        <?php $i2++; $i++; } ?>
	                                        <?php } else { ?>
	                                        <tr>
	                                          <td class="center" colspan="3"><< ไม่มีข้อมูล >></td>
	                                        </tr>
	                                        <?php } ?>
	                                      </tbody>
	                                    </table>
	                                  </div>
	                                </div>

	                        		<form class="form-horizontal" role="form" method="post" name="frmMain" id="popup-validation" action="add_location.php">

	                                              <input type="hidden" name="var_t" value="1">

	                                      <div class="col-sm-4 col-xs-10">
	                                        <div class="widget-box">
	                                          <div class="widget-header">
	                                            <h5 class="widget-title"><i class="ace-icon fa fa-cube "></i>
	                                              ฟอร์มเพิ่มข้อมูลสถานที่ใช้งาน
	                                            </h5>
	                                          </div>
	                                          <div class="widget-body">
	                                            <div class="widget-main">
	                                              <div>
	                                                <div class="input-group"> <span class="input-group-addon">
	                                                  <i class="ace-icon fa fa-calendar"> </i> </span>
																										<?php if($level=="0") { ?>
	                                                  <input class="col-xs-12 col-sm-12" type="text"  name="txt_locate" placeholder="ชื่อสถานที่ใช้งาน" style="font-size:13px;background-color:#f8f0f2 !important;height:34px;" disabled/>
																										<?php } else { ?>
																											<input class="col-xs-12 col-sm-12  validate[required]" type="text"  name="txt_locate" placeholder="ชื่อสถานที่ใช้งาน"/>
																										<?php } ?>
	                                                </div>
	                                              </div>
	                                              <hr />
	                                              <div style="text-align:center">
																									<?php if($level=="0") { ?>
	                                                <input type="submit" value=" Click To Submit"  class="btn" disabled/>
																									<?php } else { ?>
																									<input type="submit" value=" Click To Submit"  class="btn bg-olive" id="gritter-without-image" />
																									<?php } ?>
	                                              </div>
	                                            </div>
	                                          </div>
	                                        </div>
	                                      </div>
	                                    </form>


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
	</body>
</html>
<?php } ?>
