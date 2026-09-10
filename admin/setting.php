<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
$name_edit = '';
$surname_edit = '';
$username_edit = '';
$password_edit = '';

	$total_check = '';
$v_success = '';
$v_del = '';
$v_update = '';
$ed = '';
$id = '';
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
								<li class="active">ตั้งค่าผู้ใช้ระบบ</li>
							</ul><!-- /.breadcrumb -->

						</div>




	          <div class="page-content">


							<div class="row">
								<div class="col-xs-12">
	              <?php
								$total_check=$_GET['total_check'] ?? '';
								$v_success=$_GET['v_success'] ?? '';
								$v_del=$_GET['v_del'] ?? '';
								$v_update=$_GET['v_update'] ?? '';
								?>
	              <?php if($total_check>"0") { ?>
									<div class="alert alert-block alert-danger" id="success-alert">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>

										<i class="ace-icon fa fa-bullhorn dark"></i>

										<b class="dark"><u>พบข้อผิดพลาด</u></b>  &nbsp;&nbsp;ชื่อผู้ใช้ระบบดังกล่าว มีในระบบแล้ว!
									</div>
									<?php } ?>
	                <?php if($v_success=="1") { ?>
									<div class="alert alert-block alert-success" id="success-alert">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>

										<i class="ace-icon fa fa-check green"></i> &nbsp;
										<strong>เพิ่มข้อมูลผู้ใช้ระบบ เรียบร้อยแล้ว</strong>
									</div>
	                <?php } ?>
									<?php if($v_update=="1") { ?>
									<div class="alert alert-block alert-success" id="success-alert">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>

										<i class="ace-icon fa fa-check green"></i> &nbsp;
										<strong>แก้ไขข้อมูลผู้ใช้ระบบ เรียบร้อยแล้ว</strong>
									</div>
	                <?php } ?>
	                <?php if($v_del=="1") { ?>
									<div class="alert alert-block alert-success" id="success-alert">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>

										<i class="ace-icon fa fa-trash green"></i> &nbsp;
										<strong>ลบข้อมูลผู้ใช้ระบบ เรียบร้อยแล้ว</strong>
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
																						<td class="center">ระดับ</td>
																						<td class="center hidden-500">สถานะเข้าใช้ระบบ</td>
	                                          <td class="center" colspan="2"> </td>
	                                        </tr>
	                                      </thead>
	                                      <tbody>
	                                        <?php

																				if($level=="2") {
	                                         $sql_member = "select * from  member order by name ";
																				 } else {
																					 $sql_member = "select * from  member where level<>'2' order by name ";
																				 }
	                                         $qr_member=ams_query($link,$sql_member) or die ("เลือกข้อมูลไม่ได้");
	                                            $num_member=mysqli_num_rows($qr_member);
	                                            $i=0;
	                                            $i2=1;

	                                            if ($num_member!=0) {

	                                                 while($i<$num_member)
	                                                       {
	                                                          $rs_member=mysqli_fetch_array($qr_member);
																														$id_member_list=$rs_member['id'];
																														$name_list=$rs_member['name'];
																														$surname_list=$rs_member['surname'];
																														$username_list=$rs_member['username'];
																														$level_list=$rs_member['level'];
																														$status_list=$rs_member['status'];
	                                          ?>
	                                        <tr>
	                                          <td class="center font_brown"><?php echo $i2;?>.</td>
	                                          <td class="font_brown"><?php echo $name_list."&nbsp;&nbsp;".$surname_list; ?></td>
																						<td class="center font_brown hidden-900"><?php echo $username_list; ?></td>
																						<td class="center font_brown"><?php if($level_list=="0") { echo "จนท.ทั่วไป"; } elseif($level_list=="1") { echo "ผู้ดูและระบบ"; } elseif($level_list=="2") { echo "Super Admin"; }  ?></td>
																						<?php if ($status_list=="0") { ?>
																							<td class="center hidden-500" bgcolor="#49ac8b"><font color="#FFFFFF">ปกติ</font> </td>
																						<?php } elseif($status_list=="1") { ?>
																								<td class="center hidden-500" bgcolor="#d15b47"><font color="#FFFFFF">ระงับเข้าใช้ระบบ</font></td>
																						<?php } ?>

																							<td class="center"> <a class="green" href="setting.php?id=<?php echo $id_member_list; ?>&ed=1&d7=1"><i class="ace-icon fa fa-pencil bigger-130"></i></a></td>
	                                          <td class="center"><a class="red" href="add_member.php?id_del=<?php echo $id_member_list; ?>&send_del=1" onClick="return Conf<?php echo $id_member_list; ?>(this)">
	                                            <i class="ace-icon fa fa-trash-o bigger-130"></i> </a>
	                                            <script language="JavaScript">
	                                                                                function Conf<?php echo $id_member_list; ?>(object) {
	                                                                                if (confirm("ยืนยันในการลบข้อมูล! ") ==true) {
	                                                                                return true;
	                                                                                }
	                                                                                return false;
	                                                                                }

	                                                                                </script>
	                                          </td>
	                                        </tr>

	                                        <?php $i2++; $i++; } ?>
	                                        <?php } else { ?>
	                                        <tr>
	                                          <td class="center" colspan="7"><< ไม่มีข้อมูล >></td>
	                                        </tr>
	                                        <?php } ?>
	                                      </tbody>
	                                    </table>
	                                  </div>
	                                </div>

																	<form class="form-horizontal" role="form" method="post" name="frmMain" id="popup-validation" action="add_member.php">
											               <?php $ed=$_GET['ed'] ?? '';$id=$_GET['id'] ?? '';	?>
											                <?php if ($ed=="1") { ?>
											                <input type="hidden" name="var_e" value="1">
											                <input type="hidden" name="id" value="<?php echo $id; ?>">
											                <?php


																									$sql_edit = ams_sql("select * from  member where id=? ", ["$id"]);
																									$dbquery_edit=ams_query($link,$sql_edit) or die ("เลือกข้อมูลไม่ได้");
																									ams_query($link,"SET NAMES UTF8");
																									$num_rows_edit=mysqli_num_rows($dbquery_edit);
																								$result_edit=mysqli_fetch_array($dbquery_edit);
																								$name_edit=$result_edit['name'];
																								$surname_edit=$result_edit['surname'];
																								$username_edit=$result_edit['username'];
																								$password_edit=$result_edit['password'];
																								$level_edit=$result_edit['level'];
																								$status_edit=$result_edit['status'];
																								$id_department=$result_edit['id_department'];
																								?>
											                <?php } else { ?>
											                <input type="hidden" name="var_t" value="1">
											                <?php } ?>
											                <div class="col-xs-12 col-sm-3 widget-container-col">
											                  <div class="widget-box">
											                    <div class="widget-header">
											                      <h5 class="widget-title"><i class="ace-icon fa fa-cube "></i>
											                        <?php if ($ed !="") { ?>
											                        ฟอร์มแก้ไขข้อมูลผู้ใช้ระบบ
											                        <?php } else { ?>
											                        ฟอร์มเพิ่มข้อมูลผู้ใช้ระบบ
											                        <?php } ?>
											                      </h5>
											                    </div>
											                    <div class="widget-body">
											                      <div class="widget-main">
											                        <div>
											                          <label for="form-field-mask-2"> ชื่อ </label>
											                          <div class="input-group"> <span class="input-group-addon">
											                            <i class="ace-icon fa fa-user"> </i> </span>
											                            <input class="col-xs-12 col-sm-12 validate[required]" type="text"  name="txt_name" value="<?php echo $name_edit; ?>"/>
											                          </div>
											                        </div>
											                        <hr />
											                        <div>
											                          <label for="form-field-mask-2"> นามสกุล </label>
											                          <div class="input-group"> <span class="input-group-addon">
											                            <i class="ace-icon fa fa-user"></i> </span>
											                            <input class="col-xs-12 col-sm-12 validate[required]" type="text"  name="txt_surname" value="<?php echo $surname_edit; ?>"/>
											                          </div>
											                        </div>
											                        <hr />
											                        <div>
											                          <label for="form-field-mask-2"> Username </label>
											                          <div class="input-group"> <span class="input-group-addon">
											                            <i class="ace-icon fa fa-user-md"></i> </span>
											                            <input class="col-xs-12 col-sm-12 validate[required]" type="text"  name="txt_username" value="<?php echo $username_edit; ?>"/>
											                          </div>
											                        </div>
											                        <hr />
											                        <div>
											                          <label for="form-field-mask-2"> Password </label>
											                          <div class="input-group"> <span class="input-group-addon">
											                            <i class="ace-icon fa fa-key"></i> </span>
											                            <input class="col-xs-12 col-sm-12 validate[required]" type="password"  name="txt_password" value="<?php echo $password_edit; ?>"/>
											                          </div>
											                        </div>
											                        <hr />
											                        <div>
											                          <label for="form-field-mask-2"> ระดับการเข้าใช้ระบบ
											                          </label>
											                          <div class="input-group"> <span class="input-group-addon">
											                            <i class="ace-icon fa fa-key"></i> </span>
											                            <?php if($id!=$id_member) { ?><select class="col-xs-4 col-sm-10 validate[required]" name="choose_status" style="height:34px;"><?php } ?>
											                            <?php if($id==$id_member) { ?><select class="col-xs-4 col-sm-10" name="choose_status" style="height:34px;background-color:#f6f5f5;" disabled><?php } ?>
											                              <?php if ($ed=="1") { ?>
											                              <?php if ($level_edit=="0") { ?>
											                              <option value="0" selected>จนท.ทั่วไป</option>
											                              <?php } elseif ($level_edit=="1") { ?>
											                              <option value="1" selected>ผู้ดูแลระบบ</option>
																									<?php } elseif ($level_edit=="2") { ?>
																									<option value="2" selected>Super Admin</option>
											                              <?php } ?>
											                              <?php } ?>
											                              <option value="">-</option>
											                              <option value="0">จนท.ทั่วไป</option>
											                              <option value="1">ผู้ดูแลระบบ</option>
																										<option value="2">Super Admin</option>
											                            </select>
											                          </div>
											                        </div>
											                        <hr />
											                        <div>
											                          <label for="form-field-mask-2"> การอนุญาตเข้าใช้ระบบ
											                          </label>
											                          <div class="input-group"> <span class="input-group-addon">
											                            <i class="ace-icon fa fa-key"></i> </span>
											                            <?php if($id!=$id_member) { ?><select class="col-xs-4 col-sm-10 validate[required]" name="choose_use" style="height:34px;"><?php } ?>
											                            <?php if($id==$id_member) { ?><select class="col-xs-4 col-sm-10" name="choose_use" style="height:34px;background-color:#f6f5f5;" disabled><?php } ?>
											                              <?php if ($ed=="1") { ?>
											                              <?php if ($status_edit=="0") { ?>
											                              <option value="0" selected>ปกติ</option>
											                              <?php } elseif ($status_edit=="1") { ?>
											                              <option value="1" selected>ระงับเข้าใช้ระบบ</option>
											                              <?php } ?>
											                              <?php } ?>
											                              <option value="">-</option>
											                              <option value="0">ปกติ</option>
											                              <option value="1">ระงับเข้าใช้ระบบ</option>
											                            </select>
											                          </div>
											                        </div>
											                        <hr />
											                        <div style="text-align:center">
											                          <input type="submit" value=" Click To Submit"  class="btn btn-primary " />
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
