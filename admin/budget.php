<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$total_check = '';
$v_success = '';
$v_del = '';
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
		<link rel="stylesheet" href="AdminLTE.min.css" />

    <link rel="stylesheet" href="assets2/plugins/validationengine/css/validationEngine.jquery.css" />
		<style> body { font-family: sarabun; } </style>

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
							<li class="active">ปีงบประมาณ</li>
						</ul><!-- /.breadcrumb -->

					</div>




                    <div class="page-content">


						<div class="row">
							<div class="col-xs-12">
                            <?php
							$total_check=$_GET['total_check'] ?? '';
							$v_success=$_GET['v_success'] ?? '';
							$v_del=$_GET['v_del'] ?? '';
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
									<strong>เพิ่มปีงบประมาณเรียบร้อย</strong>
								</div>
                                <?php } ?>
                                <?php if($v_del=="1") { ?>
								<div class="alert alert-block alert-success" id="success-alert">
									<button type="button" class="close" data-dismiss="alert">
										<i class="ace-icon fa fa-times"></i>
									</button>

									<i class="ace-icon fa fa-trash green"></i> &nbsp;
									<strong>ลบปีงบประมาณเรียบร้อย</strong>
								</div>
                                <?php } ?>


                            <div class="row">
                            <div class="col-sm-6 col-xs-10">
                                  <div >
                                    <table class="table table-striped table-bordered table-hover">
                                      <thead>
                                        <tr>
                                          <td class="head_blue" colspan="3"> :: ข้อมูลปีงบประมาณ</td>
                                        </tr>
                                        <tr>
                                          <td class="center "><b> ลำดับ. </b></td>
                                          <td class="center"><b>ปีงบประมาณ </b></td>
                                          <td class="center"> </td>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php


                                                                            $sql_budget = "select * from  budget order by year_budget ";
                                                                            $qr_budget=ams_query($link,$sql_budget) or die ("เลือกข้อมูลไม่ได้");
                                                                            ams_query($link, "SET NAMES UTF8");
                                                                            $num_budget=mysqli_num_rows($qr_budget);
                                                                            $i=0;
                                                                            $i2=1;

                                                                    if ($num_budget!=0) {

                                                                        while($i<$num_budget)
                                                                        {
                                                                        $rs_budget=mysqli_fetch_array($qr_budget);
                                                                        $year_budget=$rs_budget['year_budget'];
                                                                        ?>
                                        <tr>
                                          <td class="center font_brown"><?php echo $i2;?>.</td>
                                          <td class="center font_brown"><?php echo $year_budget; ?></td>


                                          <td class="center"><a class="red" href="add_budget.php?id_del=<?php echo $year_budget;?>&send_del=1" onClick="return Conf<?php echo $year_budget; ?>(this)">
                                            <i class="ace-icon fa fa-trash-o bigger-130"></i> </a>
                                            <script language="JavaScript">
                                                                                function Conf<?php echo $year_budget; ?>(object) {
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
                                          <td class="center" colspan="3"><< ไม่มีข้อมูล >></td>
                                        </tr>
                                        <?php } ?>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>

                        		<form class="form-horizontal" role="form" method="post" name="frmMain" id="popup-validation" action="add_budget.php">

                                              <input type="hidden" name="var_t" value="1">

                                      <div class="col-sm-4 col-xs-10">
                                        <div class="widget-box">
                                          <div class="widget-header">
                                            <h5 class="widget-title"><i class="ace-icon fa fa-cube "></i>
                                              ฟอร์มเพิ่มปีงบประมาณ
                                            </h5>
                                          </div>
                                          <div class="widget-body">
                                            <div class="widget-main">
                                              <div>
                                                <div class="input-group"> <span class="input-group-addon">
                                                  <i class="ace-icon fa fa-calendar"> </i> </span>
                                                  <input class="col-xs-10 col-sm-8  validate[required]" type="text"  name="txt_budget" onKeyPress="checknumber()" maxlength="4" placeholder="ปีงบประมาณ"/>
                                                </div>
                                              </div>
                                              <hr />
                                              <div style="text-align:center">
                                                <input type="submit" value=" Click To Submit"  class="btn bg-olive" id="gritter-without-image" />
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
