<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$total_check = '';
$v_update = '';
$ed = '';
$id = '';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
	$sess_user = $_SESSION['sess_user'] ?? '';
	$sess_password = $_SESSION['sess_password'] ?? '';

	require_once __DIR__ . '/con_lda.php';
	if ($sess_user == "" || $status!="0") {
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
		<style> body { font-family: sarabun; } </style>
		<link rel="stylesheet" href="AdminLTE.min.css">

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
								<li class="active">ข้อมูลผู้ใช้ระบบ</li>
							</ul><!-- /.breadcrumb -->

						</div>




	          <div class="page-content">


							<div class="row">
								<div class="col-xs-12">
	              <?php
								$total_check=$_GET['total_check'] ?? '';
								$v_update=$_GET['v_update'] ?? '';
								?>


									<?php if($v_update=="1") { ?>
									<div class="alert alert-block alert-success" id="success-alert">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>

										<i class="ace-icon fa fa-check green"></i> &nbsp;
										<strong>แก้ไขข้อมูลผู้ใช้ระบบ เรียบร้อยแล้ว</strong>
									</div>
	                <?php } ?>


	                            <div class="row">
	                            <div class="col-sm-9 col-xs-12">
	                                  <div >
	                                    <table class="table table-striped table-bordered table-hover">
	                                      <thead>
	                                        <tr>
	                                          <td class="head_blue" colspan="7"> :: ข้อมูลผู้ใช้ระบบ</td>
	                                        </tr>
	                                        <tr>
	                                          <td class="center hidden-480"> ลำดับ. </td>
																						<td class="center">ชื่อ-นามสกุล</td>
																						<td class="center hidden-900">Username</td>
	                                          <td class="center"> </td>
	                                        </tr>
	                                      </thead>
	                                      <tbody>
	                                        <?php
																					 $sql_member = ams_sql("select * from  member where id=? ", ["$id_member"]);
	                                         $qr_member=ams_query($link,$sql_member) or die ("เลือกข้อมูลไม่ได้");
	                                            ams_query($link, "SET NAMES UTF8");
	                                            $num_member=mysqli_num_rows($qr_member);
	                                                          $rs_member=mysqli_fetch_array($qr_member);
																														$id_member_list=$rs_member['id'];
																														$name_list=$rs_member['name'];
																														$surname_list=$rs_member['surname'];
																														$username_list=$rs_member['username'];
																														$password_list=$rs_member['password'];
	                                          ?>
	                                        <tr>
	                                          <td class="center font_brown">1.</td>
	                                          <td class="font_brown"><?php echo $name_list."&nbsp;&nbsp;".$surname_list; ?></td>
																						<td class="center font_brown hidden-900"><?php echo $username_list; ?></td>
																							<td class="center"><a class="green" href="form_user.php?id=<?php echo $id_member_list;?>&ed=1&u=1"><i class="ace-icon fa fa-pencil bigger-130"></i></a></td>
	                                        </tr>
	                                      </tbody>
	                                    </table>
	                                  </div>
	                                </div>

																	<form class="form-horizontal" role="form" method="post" name="frmMain" id="popup-validation" action="update_user.php">
											               <?php $ed=$_GET['ed'] ?? '';$id=$_GET['id'] ?? '';	?>
											                <input type="hidden" name="var_e" value="1">
											                <input type="hidden" name="id" value="<?php echo $id; ?>">
											                <div class="col-xs-12 col-sm-3 widget-container-col">
											                  <div class="widget-box">
											                    <div class="widget-header">
											                      <h5 class="widget-title"><i class="ace-icon fa fa-cube "></i>
											                        ฟอร์มข้อมูลผู้ใช้ระบบ
											                      </h5>
											                    </div>
											                    <div class="widget-body">
											                      <div class="widget-main">
											                        <div>
											                          <label for="form-field-mask-2"> ชื่อ </label>
											                          <div class="input-group"> <span class="input-group-addon">
											                            <i class="ace-icon fa fa-user"> </i> </span>
																									<?php if($ed=="1") { ?>
											                            <input class="col-xs-12 col-sm-12 validate[required]" type="text"  name="txt_name" value="<?php echo $name_list; ?>"/>
																								  <?php } else { ?>
																									<input class="col-xs-12 col-sm-12" type="text"  name="txt_name" value="<?php echo $name_list; ?>" disabled/>
																								  <?php } ?>
											                          </div>
											                        </div>
											                        <hr />
											                        <div>
											                          <label for="form-field-mask-2"> นามสกุล </label>
											                          <div class="input-group"> <span class="input-group-addon">
											                            <i class="ace-icon fa fa-user"></i> </span>
																									<?php if($ed=="1") { ?>
											                            <input class="col-xs-12 col-sm-12 validate[required]" type="text"  name="txt_surname" value="<?php echo $surname_list; ?>"/>
																									<?php } else { ?>
																									<input class="col-xs-12 col-sm-12" type="text"  name="txt_surname" value="<?php echo $surname_list; ?>" disabled/>
																									<?php } ?>
											                          </div>
											                        </div>
											                        <hr />
											                        <div>
											                          <label for="form-field-mask-2"> Username </label>
											                          <div class="input-group"> <span class="input-group-addon">
											                            <i class="ace-icon fa fa-user-md"></i> </span>
											                            <input class="col-xs-12 col-sm-12 validate[required]" type="text"  name="txt_username" value="<?php echo $username_list; ?> " disabled/>
											                          </div>
											                        </div>
											                        <hr />
											                        <div>
											                          <label for="form-field-mask-2"> Password </label>
											                          <div class="input-group"> <span class="input-group-addon">
											                            <i class="ace-icon fa fa-key"></i> </span>
																									<?php if($ed=="1") { ?>
																										<input class="col-xs-12 col-sm-12 validate[required]" type="password"  name="txt_password" value="<?php echo $password_list; ?>"/>
																									<?php } else { ?>
																										<input class="col-xs-12 col-sm-12" type="password"  name="txt_password" value="<?php echo $password_list; ?>" disabled/>
																									<?php } ?>
											                          </div>
											                        </div>

											                        <hr />

											                        <div style="text-align:center">
																								<?php if($ed=="1") { ?>
											                          <input type="submit" value=" Click To Submit"  class="btn btn-primary " />
																							  <?php } else { ?>
																									<input type="submit" value=" Click To Submit"  class="btn btn-primary " disabled/>
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
