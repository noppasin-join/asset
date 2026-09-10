<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
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
		<link rel="stylesheet" href="assets/css/ace2.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<!-- ace settings handler -->
		<script src="assets/js/ace-extra.min.js"></script>
    <link rel="shortcut icon" href="mfu.ico" type="image/x-icon">
		<style> body { font-family: sarabun; } </style>
		<link rel="stylesheet" href="AdminLTE.min.css">

		<link rel="stylesheet" href="reg-style.css" />

		<link rel="stylesheet" href="css/datepicker.css" />
		<link rel="stylesheet" href="assets/css/datepicker.min.css" />

		<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
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
								<li class="active">จัดการข้อมูลคืนวัสดุ/ครุภัณฑ์</li>
							</ul><!-- /.breadcrumb -->

						</div>



					<?php // Start BODY ?>


					<?php
					$id=$_GET['id'] ?? '';
								$sql_list = ams_sql("select * from  data_take where id=? ", ["$id"]);
								$qr_list=ams_query($link,$sql_list) or die ("เลือกข้อมูลไม่ได้");
								$rs_list=mysqli_fetch_array($qr_list);
								$name_list=$rs_list['name'];
								$surname_list=$rs_list['surname'];
								$department_list=$rs_list['department'];
								$tel_list=$rs_list['tel'];
								$email_list=$rs_list['email'];
								$objective_list=$rs_list['objective'];
								$checkout_list=$rs_list['checkout'];
								$checkin_list=$rs_list['checkin'];
								$pickup_list=$rs_list['pickup'];
					?>

      <div class="page-content">
        <div class="row">

          <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
						<div class="row">
              <div class="col-xs-12 col-sm-12 ">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title ">:: ข้อมูลผู้ขอยืมวัสดุ/ครุภัณฑ์</h3>
                  </div>
                  <div class="box-body">
										<div class="row" style="padding:5px;"> </div>
                    <div class="row">
                      <div class="col-xs-12 col-sm-4" style="text-align:left;font-size:14px;color:#797e7c;">
												ชื่อ-นามสกุล :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo $name_list;?>&nbsp;&nbsp;<?php echo $surname_list;?>&nbsp;&nbsp;</font>
												<div class="row" style="padding:5px;"> </div>
                      </div>
											<div class="col-xs-12 col-sm-8" style="text-align:left;font-size:14px;color:#797e7c;">
												หน่วยงาน :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo $department_list;?>&nbsp;&nbsp;</font>
												<div class="row" style="padding:5px;"> </div>
                      </div>
                    </div>
										<div class="row" style="padding:5px;"> </div>
										<div class="row">

											<div class="col-xs-12 col-sm-4" style="text-align:left;font-size:14px;color:#797e7c;">
												เบอร์โทรศัพท์ :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo $tel_list;?>&nbsp;&nbsp;</font>
												<div class="row" style="padding:5px;"> </div>
                      </div>
											<div class="col-xs-12 col-sm-8" style="text-align:left;font-size:14px;color:#797e7c;">
												Email :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo $email_list;?>&nbsp;&nbsp;</font>
												<div class="row" style="padding:5px;"> </div>
                      </div>
                    </div>

										<div class="row" style="padding:5px;"> </div>
										<div class="row">
											<div class="col-xs-12 col-sm-12" style="text-align:left;font-size:14px;color:#797e7c;">
												ความประสงค์ที่ขอยืม :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo $objective_list;?>&nbsp;&nbsp;</font>
												<div class="row" style="padding:5px;"> </div>
                      </div>
                    </div>
										<?php
										$pie=explode ("-", $checkout_list);
$pie = array_pad($pie, 6, ''); $y_ch=(is_numeric($pie[0]) ? (int) $pie[0] + 543 : '');
										$pie2=explode ("-", $checkin_list);
$pie2 = array_pad($pie2, 6, ''); $y_ch2=(is_numeric($pie2[0]) ? (int) $pie2[0] + 543 : '');
										$pie_pickup=explode ("-", $pickup_list);
$pie_pickup = array_pad($pie_pickup, 6, ''); $y_ch_pickup=(is_numeric($pie_pickup[0]) ? (int) $pie_pickup[0] + 543 : '');
										?>
										<div class="row" style="padding:5px;"> </div>
										<div class="row">
											<div class="col-xs-12 col-sm-3" style="text-align:left;font-size:14px;color:#797e7c;">
												วันที่ยืม :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo "$pie[2]-$pie[1]-$y_ch"; ?>&nbsp;&nbsp;</font>
												<div class="row" style="padding:5px;"> </div>
                      </div>
											<div class="col-xs-12 col-sm-3" style="text-align:left;font-size:14px;color:#797e7c;">
												วันที่ส่ง :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo "$pie2[2]-$pie2[1]-$y_ch2"; ?>&nbsp;&nbsp;</font>
												<div class="row" style="padding:5px;"> </div>
                      </div>
											<div class="col-xs-12 col-sm-6" style="text-align:left;font-size:14px;color:#797e7c;">
												สามารถมารับครุภัณฑ์ยืมในวันที่ :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo "$pie_pickup[2]-$pie_pickup[1]-$y_ch_pickup"; ?>&nbsp;&nbsp;</font>
												<div class="row" style="padding:5px;"> </div>
                      </div>

                    </div>



                  </div>
                  <!-- /.box-body -->
                </div>
              </div>

              <!-- /.col -->
            </div>

						<?php

						$varStartDate = "$pie[2]-$pie[1]-$pie[0]"; //echo $varStartDate."<br/>";
						$strStartDate = date_create("$pie[2]-$pie[1]-$pie[0]"); //echo $strStartDate;
						$strEndDate = date_create("$pie2[2]-$pie2[1]-$pie2[0]"); //echo $strEndDate;
						$diff=($strStartDate && $strEndDate ? date_diff($strStartDate, $strEndDate) : null);

						$var_date = ($diff ? (int) $diff->format("%a") : -1);
						$var_date_1 = $var_date+1;



									$sql_data = ams_sql("select * from  data_take_list where id_data_take=? and status='1' order by id ", ["$id"]);
									$qr_data=ams_query($link,$sql_data) or die ("เลือกข้อมูลไม่ได้");
									$num_data=mysqli_num_rows($qr_data);

										$rs_data=mysqli_fetch_array($qr_data);
										$id_data_lda=$rs_data['id_data_lda'];
										$id_take_list=$rs_data['id'];
										$title=$rs_data['title'];
										$amount=$rs_data['amount'];
										$unit=$rs_data['unit'];
										$note=$rs_data['note'];
										$status_list=$rs_data['status'];
										$note_return=$rs_data['note_return'];
						?>


						<div class="row">
            <div class="col-xs-12 col-sm-12 ">
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title ">:: รายการครุภัณฑ์ที่ขอยืม</h3>
                </div>
                <div class="box-body">
                  <div class="row" style="padding:3px;"> </div>





									<?php
												$sql_check = ams_sql("select * from  data_take_list_more where id_data_take=? order by barcode", ["$id"]);
												$qr_check=ams_query($link,$sql_check) or die ("เลือกข้อมูลไม่ได้");
												$num_check=mysqli_num_rows($qr_check);
									?>
									<?php if($num_check!="0") { ?>
									<div class="row">
												<!-- col 1 -->
												<div class="col-xs-12 col-sm-12">
																<div>

																	<table class="table100 table-striped table-bordered table-hover">
																		<thead>
																		<tr>
																				<td class="head_blue" colspan="7" > :: ข้อมูลครุภัณฑ์</td>
																		</tr>
																	<tr>
																		<th style="vertical-align:middle;text-align: center;" rowspan="2">ลำดับ.</th>
																		<th style="vertical-align:middle;text-align: center;" rowspan="2">เลขครุภัณฑ์</th>
																		<th style="vertical-align:middle;text-align: center;" rowspan="2">รายการ</th>
																		<th class="center" colspan="2">จัดการสถานะ</th>
																		<th style="vertical-align:middle;text-align: center;" rowspan="2">สถานะ</th>
																	</tr>
																	<tr>
																		<th class="center">ยังไม่คืน</th>
																		<th class="center">คืนแล้ว</th>
																	</tr>
																</thead>

																<?php
																$i_check1=1;
																$i_check2=0;
																	while($i_check2<$num_check)
																	{
																		$rs_check=mysqli_fetch_array($qr_check);
																		$id_take_list_more=$rs_check['id'];
																		$status_return=$rs_check['status_return'];
																		$id_data_lda=$rs_check['id_data_lda'];
																		$date_return=$rs_check['date_return'];
																		$time_return=$rs_check['time_return'];
																		$date_return=$rs_check['date_return'];

																					$sql_list_lda = ams_sql("select * from  data_lda where id=? ", ["$id_data_lda"]);
																					$qr_list_lda=ams_query($link,$sql_list_lda) or die ("เลือกข้อมูลไม่ได้");
																					$rs_list_lda=mysqli_fetch_array($qr_list_lda);
																					$lda_list=$rs_list_lda['lda_list'];
																					$barcode1=$rs_list_lda['barcode1'];
																					$barcode3=$rs_list_lda['barcode3'];

																?>
																<!-- Start -->

																<tr>
																	<td class="center"><?php echo "<img src=image_number/$i_check1.png>";?></td>
																	<td class="center"><?php if($barcode3!="") { echo $barcode3; } else {  echo $barcode1; }?></td>
																	<td ><?php echo $lda_list;?></td>

<td class="center" ><a href="manage_return.php?id=<?php echo $id; ?>&var_list=<?php echo $id_take_list_more; ?>&rt=0"><i class="ace-icon fa fa-check bigger-150 red" style="vertical-align:middle;"></i></a></td>
<td class="center" ><a href="manage_return.php?id=<?php echo $id; ?>&var_list=<?php echo $id_take_list_more; ?>&rt=1"><i class="ace-icon fa fa-check bigger-150 green" style="vertical-align:middle;"></i></a></td>

																	<?php if ($status_return=="1") { ?><td class="center" bgcolor="#49ac8b" width="12%"><font color="#FFFFFF">คืนแล้ว</font> </td>
																  <?php } elseif ($status_return=="0") { ?><td class="center" bgcolor="#d15b47" width="12%"><font color="#FFFFFF">ยังไม่คืน</font></td>
																	<?php } ?>

																</tr>

																<!-- End -->

																<!-- Start -->



																<?php $i_check1++; $i_check2++; } ?>
																</table>
																</div>
												<div class="row" style="padding:2px;"> </div>
												</div>
												<!-- col 1 End -->

									</div>
								<?php }?>
									<div class="row" style="padding:2px;"> </div>

                </div>
                <!-- /.box-body -->
              </div>


            </div>
            </div>





            <!-- /.row -->


          </div>
          <!-- /.row -->
          <!-- PAGE CONTENT ENDS -->
        </div>
        <!-- /.col -->
      </div>







					 <?php // END BODY ?>

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


			<!-- PAGE LEVEL SCRIPTS -->
			<script src="assets2/plugins/validationengine/js/jquery.validationEngine.js"></script>
			<script src="assets2/plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script>
			<script src="assets2/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
			<script src="assets2/js/validationInit.js"></script>
			<script>
			        $(function () { formValidation(); });
			        </script>

			<script src="assets/js/jquery-ui.custom.min.js"></script>
			<script src="assets/js/chosen.jquery.min.js"></script>
			<script src="assets/js/bootstrap-colorpicker.min.js"></script>
			<script src="assets/js/jquery.autosize.min.js"></script>
			<script src="assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
			<script src="assets/js/jquery.maskedinput.min.js"></script>





			<script src="assets/js/jquery-ui.min.js"></script>
			<script type="text/javascript">
						jQuery(function($) {


							//autocomplete

							$.widget( "custom.catcomplete", $.ui.autocomplete, {
								_create: function() {
									this._super();
									this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
								},
								_renderMenu: function( ul, items ) {
									var that = this,
									currentCategory = "";
									$.each( items, function( index, item ) {
										var li;
										if ( item.category != currentCategory ) {
											ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
											currentCategory = item.category;
										}
										li = that._renderItemData( ul, item );
											if ( item.category ) {
											li.attr( "aria-label", item.category + " : " + item.label );
										}
									});
								}
							});




							 var data = [
							 <?php
								$sql_pg = "select * from  data_lda group by lda_list order by lda_list ";
								$qr_pg=ams_query($link,$sql_pg) or die ("เลือกข้อมูลไม่ได้");
								$num_rows_pg=mysqli_num_rows($qr_pg);
								$i_pg=0;
								while($i_pg<$num_rows_pg)
									{
									$rs_pg=mysqli_fetch_array($qr_pg);
									$lda_list_show=$rs_pg['lda_list'];
							 ?>
								{ label: "<?php echo "$lda_list_show";?>", category: "" },
							 <?php $i_pg++; }  ?>

							];

							$( "#txtList" ).catcomplete({
								delay: 0,
								source: data
							});
							$( "#txtList2" ).catcomplete({
								delay: 0,
								source: data
							});
							$( "#txtList3" ).catcomplete({
								delay: 0,
								source: data
							});
							$( "#txtList4" ).catcomplete({
								delay: 0,
								source: data
							});
							$( "#txtList5" ).catcomplete({
								delay: 0,
								source: data
							});






						});
					</script>



</body>
</html>
<?php } ?>
