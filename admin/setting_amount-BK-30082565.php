<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
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

		<script type="text/javaScript">

				//ให้ text รับค่าเป็นตัวเลขอย่างเดียว
				function checknumber()
				{
					key = event.keyCode;
					if ( key != 46 & ( key < 48 || key > 57 ) )
					{
						event.returnValue = false;
					};
				};
				</script>

	</head>
	<?php
	$sql_year_desc="SELECT * FROM data_config order by year_budget desc";
	$query_year_desc=ams_query($link,$sql_year_desc);
		$result_year_desc=mysqli_fetch_array($query_year_desc);
			$year_budget_desc=$result_year_desc['year_budget'];

			$sql_ch_up=ams_sql("SELECT * from data_config where year_budget<>?", ["$year_budget_desc"]);
			$qr_ch_up=ams_query($link,$sql_ch_up);
			$num__ch_up=mysqli_num_rows($qr_ch_up);
			if($num__ch_up!=0) {
				$sql_up=ams_sql("UPDATE data_config set status='2' where year_budget<>?", ["$year_budget_desc"]);
				$qr_up=ams_page_update($link, $sql_up);
			}
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
								<li class="active">ตั้งค่าตรวจนับ</li>
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

										<b class="dark"><u>พบข้อผิดพลาด</u></b>  &nbsp;&nbsp;ปีงบประมาณดังกล่าว มีในระบบแล้ว!
									</div>
									<?php } ?>
	                <?php if($v_success=="1") { ?>
									<div class="alert alert-block alert-success" id="success-alert">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>

										<i class="ace-icon fa fa-check green"></i> &nbsp;
										<strong>เพิ่มการตั้งค่าตรวจนับ เรียบร้อยแล้ว</strong>
									</div>
	                <?php } ?>
									<?php if($v_update=="1") { ?>
									<div class="alert alert-block alert-success" id="success-alert">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>

										<i class="ace-icon fa fa-check green"></i> &nbsp;
										<strong>แก้ไขการตั้งค่าตรวจนับ เรียบร้อยแล้ว</strong>
									</div>
	                <?php } ?>
	                <?php if($v_del=="1") { ?>
									<div class="alert alert-block alert-success" id="success-alert">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>

										<i class="ace-icon fa fa-trash green"></i> &nbsp;
										<strong>ลบการตั้งค่าตรวจนับ เรียบร้อยแล้ว</strong>
									</div>
	                                <?php } ?>


	                            <div class="row">
	                            <div class="col-sm-9 col-xs-12">
	                                  <div >
	                                    <table class="table table-striped table-bordered table-hover">
	                                      <thead>
	                                        <tr>
	                                          <td class="head_blue" colspan="6"> :: ข้อมูลการตั้งค่าตรวจนับ</td>
	                                        </tr>
	                                        <tr>
	                                          <td class="center hidden-480"> ลำดับ. </td>
																						<td class="center">ปีงบประมาณ</td>
																						<td class="center hidden-900">จำนวน จนท. ตรวจนับ</td>
																						<td class="center hidden-500">สถานะเปิด-ปิดตรวจนับ</td>
	                                          <td class="center" colspan="2"> </td>
	                                        </tr>
	                                      </thead>
	                                      <tbody>
	                                        <?php


	                                         $sql_config = "SELECT * from  data_config order by year_budget desc";
	                                         $qr_config=ams_query($link,$sql_config) or die ("เลือกข้อมูลไม่ได้");
	                                            ams_query($link, "SET NAMES UTF8");
	                                            $num_config=mysqli_num_rows($qr_config);
	                                            $i=0;
	                                            $i2=1;

	                                            if ($num_config!=0) {

	                                                 while($i<$num_config)
	                                                       {
	                                                          $rs_config=mysqli_fetch_array($qr_config);
																														$id_config=$rs_config['id'];
																														$year_budget_config=$rs_config['year_budget'];
																														$staff_amount=$rs_config['staff_amount'];
																														$status_config=$rs_config['status'];
	                                          ?>
	                                        <tr>
	                                          <td class="center font_brown"><?php echo $i2;?>.</td>
	                                          <td class="center font_brown"><?php echo $year_budget_config; ?></td>
																						<td class="center font_brown hidden-900"><?php echo $staff_amount; ?></td>
																						<?php if ($status_config=="1") { ?>
																							<td class="center hidden-500" bgcolor="#49ac8b"><font color="#FFFFFF">เปิด</font> </td><?php } elseif($status_config=="2") { ?>
																								<td class="center hidden-500" bgcolor="#d15b47"><font color="#FFFFFF">ปิด</font></td><?php } ?>
								                              </td>
																						<td class="center">
																							<?php if($year_budget_config==$year_budget_desc) { ?>
																							<a class="green" href="setting_amount.php?id=<?php echo $id_config; ?>&ed=1&d9=1"><i class="ace-icon fa fa-pencil bigger-130"></i></a>
																						<?php } else { ?>
																							-
																						<?php } ?>
																						</td>
	                                          <td class="center"><a class="red" href="add_setting.php?id_del=<?php echo $id_config; ?>&send_del=1&year_budget_config=<?php echo $year_budget_config; ?>" onClick="return Conf<?php echo $id_config; ?>(this)">
	                                            <i class="ace-icon fa fa-trash-o bigger-130"></i> </a>
	                                            <script language="JavaScript">
	                                                 function Conf<?php echo $id_config; ?>(object) {
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
	                                          <td class="center" colspan="6"><< ไม่มีข้อมูล >></td>
	                                        </tr>
	                                        <?php } ?>
	                                      </tbody>
	                                    </table>
	                                  </div>
	                                </div>

																	<form class="form-horizontal" role="form" method="post" name="frmMain" id="popup-validation" action="add_setting.php">
											               <?php $ed=$_GET['ed'] ?? '';$id=$_GET['id'] ?? '';	?>
											                <?php if ($ed=="1") { ?>
											                <input type="hidden" name="var_e" value="1">
											                <input type="hidden" name="id" value="<?php echo $id; ?>">
											                <?php


																									$sql_edit = ams_sql("select * from  data_config where id=? ", ["$id"]);
																									$dbquery_edit=ams_query($link,$sql_edit) or die ("เลือกข้อมูลไม่ได้");
																									ams_query($link,"SET NAMES UTF8");
																									$num_rows_edit=mysqli_num_rows($dbquery_edit);
																								$result_edit=mysqli_fetch_array($dbquery_edit);
																								$year_budget_edit=$result_edit['year_budget'];
																								$staff_amount_edit=$result_edit['staff_amount'];
																								$status_edit=$result_edit['status'];
																								?>
											                <?php } else { ?>
											                <input type="hidden" name="var_t" value="1">
											                <?php } ?>
											                <div class="col-xs-12 col-sm-3 widget-container-col">
											                  <div class="widget-box">
											                    <div class="widget-header">
											                      <h5 class="widget-title"><i class="ace-icon fa fa-cube "></i>
											                        <?php if ($ed !="") { ?>
											                        ฟอร์มแก้ไขการตั้งค่าตรวจนับ
											                        <?php } else { ?>
											                        ฟอร์มเพิ่มการตั้งค่าตรวจนับ
											                        <?php } ?>
											                      </h5>
											                    </div>
											                    <div class="widget-body">
											                      <div class="widget-main">
											                        <div>
											                          <label for="form-field-mask-2"> ปีงบระมาณ </label>
											                          <div class="input-group"> <span class="input-group-addon">
											                            <i class="ace-icon fa fa-user"> </i> </span>
																									<?php if($ed !="") { ?>
											                            <input class="col-xs-12 col-sm-12 validate[required]" type="text"  name="txt_year" value="<?php echo $year_budget_edit; ?>" autocomplete="off" onKeyPress="checknumber()" maxlength="4" disabled />
																								<?php } else { ?>
																									<input class="col-xs-12 col-sm-12 validate[required]" type="text"  name="txt_year" value="<?php echo $year_budget_edit; ?>" autocomplete="off" onKeyPress="checknumber()" maxlength="4"  />
																								<?php } ?>
											                          </div>
											                        </div>
											                        <hr />
											                        <div>
											                          <label for="form-field-mask-2"> จำนวน จนท. ตรวจนับ </label>
											                          <div class="input-group"> <span class="input-group-addon">
											                            <i class="ace-icon fa fa-user"></i> </span>
											                            <input class="col-xs-12 col-sm-12 validate[required]" type="text"  name="txt_amount" value="<?php echo $staff_amount_edit; ?>" autocomplete="off" onKeyPress="checknumber()" maxlength="2"/>
											                          </div>
											                        </div>
											                        <hr />

											                        <div>
											                          <label for="form-field-mask-2"> สถานะ เปิด-ปิดตรวจนับ
											                          </label>
											                          <div class="input-group"> <span class="input-group-addon">
											                            <i class="ace-icon fa fa-key"></i> </span>
											                            <select class="col-xs-4 col-sm-10 validate[required]" name="choose_status" style="height:34px;">
													                              <?php if ($ed=="1") { ?>
															                              <?php if ($status_edit=="1") { ?>
															                              	<option value="1" selected>เปิด</option><option value="2">ปิด</option>
																													  <?php } elseif ($status_edit=="2") { ?>
															                              	<option value="2" selected>ปิด</option><option value="1">เปิด</option>
															                              <?php } ?>
													                              <?php } else { ?>
											                              <option value="1">เปิด</option>
											                              <option value="2">ปิด</option>
																									<?php } ?>
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
