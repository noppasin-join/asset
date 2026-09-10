<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
$id = '';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
$sess_user = $_SESSION['sess_user'] ?? '';
$sess_password = $_SESSION['sess_password'] ?? '';

require_once __DIR__ . '/con_lda.php';
if ($sess_user == "" || $status!=0 || $level==0) {
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
		<link rel="stylesheet" href="AdminLTE.min.css" />

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
								<li class="active">จัดการข้อมูลยืมพัสดุ/ครุภัณฑ์</li>
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
								$status_read_list=$rs_list['status_read'];
								if($status_read_list=="0") {
									$sql_update=ams_sql("update data_take set status_read='1' where id=?", ["$id"]);
									$qr_update=ams_page_update($link, $sql_update) or die ("Error Update Status Read");
								}
					?>


      <div class="page-content">
        <div class="row">

          <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="row">
              <div class="col-xs-12 col-sm-12 ">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title ">:: ข้อมูลผู้ขอยืมพัสดุ/ครุภัณฑ์</h3>
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

										<div class="row" style="padding:5px;"> </div>
										<div class="row">
											<div class="col-xs-12 col-sm-4" style="text-align:left;font-size:14px;color:#797e7c;">
												วันที่ยืม :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo $checkout_list;?>&nbsp;&nbsp;</font>
												<div class="row" style="padding:5px;"> </div>
                      </div>
											<div class="col-xs-12 col-sm-8" style="text-align:left;font-size:14px;color:#797e7c;">
												วันที่ส่ง :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo $checkin_list;?>&nbsp;&nbsp;</font>
												<div class="row" style="padding:5px;"> </div>
                      </div>

                    </div>



                  </div>
                  <!-- /.box-body -->
                </div>
              </div>

              <!-- /.col -->
            </div>

            <!-- /.row -->
						<?php
									$sql_data = ams_sql("select * from  data_take_list where id_data_take=? order by id ", ["$id"]);
									$qr_data=ams_query($link,$sql_data) or die ("เลือกข้อมูลไม่ได้");
									$num_data=mysqli_num_rows($qr_data);

										$rs_data=mysqli_fetch_array($qr_data);
										$id_take_list=$rs_data['id'];
										$title=$rs_data['title'];
										$amount=$rs_data['amount'];
										$unit=$rs_data['unit'];
										$note=$rs_data['note'];
										$status_list=$rs_data['status'];
						?>
						<!-- Start 1 -->
            <div class="row">
            <div class="col-xs-12 col-sm-12 ">
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title ">:: รายการครุภัณฑ์ที่ขอยืม <font color="#4175ab"><b><u>รายการที่ 1</u></b></font></h3>
                </div>
                <div class="box-body">
                  <div class="row" style="padding:3px;"> </div>


									<div class="row">
												<!-- 1 -->
												<form action="update_borrow_title.php" method="post" name="form_update">
													<input type="hidden" name="id_take_list" value="<?php echo $id_take_list;?>">
													<input type="hidden" name="id" value="<?php echo $id;?>">
												<div class="col-xs-12 col-sm-4">
																<div class="input-group"> <span class="input-group-addon"><img src="image_number/1.png"></span>
																		<input type="text" class="form-control" style="font-size:13px;background-color:#f1f9f2;height:34px;"
																		name="txt_title1" placeholder="ชื่อรายการพัสดุ/ครุภัณฑ์..."  maxlength="100" id="txtList" autocomplete="off" value="<?php echo $title; ?>">
																		<span class="input-group-addon"><button class=" btn-info bigger-90"><i class="ace-icon fa fa-random"></i></bontton></span>
																</div>
												<div class="row" style="padding:2px;"> </div>
												</div>
											</form>
												<!-- 2 -->
												<div class="col-xs-8 col-sm-2">
																<div class="input-group"><span class="input-group-addon" style="background-color:#eeeeee;font-size:12px;color:#797e7c;">จำนวนยืม</span>
																<input type="text" class="form-control" style="font-size:13px;background-color:#f1f9f2!important;height:34px;text-align:center;" name="txt_amount1"
																					placeholder="จำนวนยืม" value="<?php echo $amount; ?>" disabled>
																</div>
												<div class="row" style="padding:2px;"> </div>
												</div>
												<!-- 3 -->
												<div class="col-xs-8 col-sm-2">
																<div class="input-group"><span class="input-group-addon" style="background-color:#eeeeee;font-size:12px;color:#797e7c;">หน่วยนับ</span>
																<input type="text" class="form-control" style="font-size:13px;background-color:#f1f9f2!important;height:34px;text-align:center;"
																name="txt_unit" placeholder="หน่วยนับ"  maxlength="20" value="<?php echo $unit; ?>" disabled>
																</div>
												<div class="row" style="padding:2px;"> </div>
												</div>
												<!-- 4 -->
												<div class="col-xs-12 col-sm-4">
																<div class="input-group"><span class="input-group-addon" style="background-color:#eeeeee;font-size:12px;color:#797e7c;">หมายเหตุ</span>
																		<input type="text" class="form-control" name="txt_note" disabled style="background-color:#f1f9f2!important;font-size:13px;height:34px;" value="<?php echo $note; ?>"/>
																</div>
												</div>
									</div>
									<div class="row" style="padding:2px;"> </div>

									<?php
												$sql_check = ams_sql("select * from  data_lda where lda_list like ? and lda_status='1' and status_borrow='1' ", ["%$title%"]);
												$qr_check=ams_query($link,$sql_check) or die ("เลือกข้อมูลไม่ได้");
												$num_check=mysqli_num_rows($qr_check);
									?>
									<?php if($num_check!="0") { ?>
									<div class="row">
												<!-- col 1 -->
												<div class="col-xs-12 col-sm-6">
																<div>

																	<table class="table100 table-striped table-bordered table-hover">
																		<thead>
																		<tr>
																				<td class="head_blue" colspan="5" > :: ข้อมูลครุภัณฑ์</td>
																		</tr>
																	<tr>
																		<th class="center" width="6%">No.</th>
																		<th class="center" width="10%">เลขครุภัณฑ์</th>
																		<th class="center">รายการ</th>
																		<th class="center" colspan="2">สถานะ</th>
																	</tr>
																</thead>

																<?php
																$i_check1=1;
																$i_check2=0;
																	while($i_check2<$num_check)
																	{
																		$rs_check=mysqli_fetch_array($qr_check);
																		$year_budget=$rs_check['year_budget'];
																		$id_br=$rs_check['id'];
																		$barcode1=$rs_check['barcode1'];
																		$lda_list_sh=$rs_check['lda_list'];
																		$status_return=$rs_check['status_return'];

																?>
																<tr>
																	<td class="center"><?php echo $i_check1;?>.</td>
																	<td class="center"><?php echo $barcode1;?></td>
																	<td ><?php echo $lda_list_sh;?></td>
																	<?php if ($status_return=="1") { ?><td class="center" bgcolor="#49ac8b" width="12%"><font color="#FFFFFF">ว่าง</font> </td>
																<?php } elseif($status_return=="2") { ?><td class="center" bgcolor="#d15b47" width="12%"><font color="#FFFFFF">ไม่ว่าง</font></td>
																	<?php } ?>
																	<td class="center" width="6%">
																		<?php if($status_return=="1") { ?>
																		<a class="green" href="update_borrow_check.php?id=<?php echo $id; ?>&id_data_lda=<?php echo $id_br; ?>
																			&id_take_list=<?php echo $id_take_list; ?>&amount=<?php echo $amount; ?>&barcode=<?php echo $barcode1; ?>">
																			<i class="ace-icon fa fa-check bigger-130 blue"></i>
																		</a>
																	<?php } elseif($status_return=="2") { ?><i class="ace-icon fa fa-times bigger-120 red2"></i><?php } ?>
																	</td>
																</tr>
																<?php $i_check1++; $i_check2++; } ?>
																</table>
																</div>
												<div class="row" style="padding:2px;"> </div>
												</div>
												<!-- col 1 End -->

												<!-- col 2 -->
												<?php
												if($amount!="1") {
												$sql_data_lt = ams_sql("select * from  data_take_list_more where id_data_take_list=? order by barcode ", ["$id_take_list"]);
												$qr_data_lt=ams_query($link,$sql_data_lt) or die ("เลือกข้อมูลไม่ได้");
												$num_data_lt=mysqli_num_rows($qr_data_lt);
												?>
												<?php if($num_data_lt!="0") { ?>

												<div class="col-xs-12 col-sm-6">
																<div >

																	<table class="table100 table-striped table-bordered table-hover">
																	<thead>
																	<tr>
																			<td class="head_blue" colspan="4"> :: ครุภัณฑ์ที่ถูกเลือกให้ยืม</td>
																	</tr>
																	<tr>
																		<th class="center font_brown70" width="6%">No.</th>
																		<th class="center font_brown70"width="10%">เลขครุภัณฑ์</th>
																		<th class="center font_brown70">รายการ</td>
																		<th class="center font_brown70" width="8%">ยกเลิก</th>
																	</tr>
																</thead>



																<?php
																$i_more1=1;
																$i_more2=0;
																	while($i_more2<$num_data_lt)
																	{
																		$rs_more=mysqli_fetch_array($qr_data_lt);
																		$id_take_list_more=$rs_more['id'];
																		$id_data_lda_more=$rs_more['id_data_lda'];
																				$sql_bring_data = ams_sql("select * from  data_lda where id=?", ["$id_data_lda_more"]);
																				$qr_bring_data=ams_query($link,$sql_bring_data) or die ("เลือกข้อมูลไม่ได้");
																				$rs_bring=mysqli_fetch_array($qr_bring_data);
																				$barcode_bring=$rs_bring['barcode1'];
																				$title_bring=$rs_bring['lda_list'];
																?>
																<tr>
																	<td class="center"><?php echo $i_more1;?>.</td>
																	<td class="center"><?php echo $barcode_bring;?></td>
																	<td ><?php echo $title_bring;?></td>
																	<td class="center">
																		<a class="green" href="update_borrow_reply.php?id=<?php echo $id; ?>&id_take_list=<?php echo $id_take_list; ?>
																			&id_take_list_more=<?php echo $id_take_list_more; ?>&id_data_lda_more=<?php echo $id_data_lda_more; ?>">
																			<i class="ace-icon fa fa-mail-reply bigger-130 green"></i>
																		</a>
																	</td>
																</tr>
																<?php $i_more1++; $i_more2++; } ?>
																</table>
																</div>
													<div class="row" style="padding:2px;"> </div>
													</div>

													<?php } ?>

												<?php } elseif($amount=="1") { ?>
													<?php
													$sql_data_lt = ams_sql("select * from  data_take_list where id=? and id_data_lda<>'' ", ["$id_take_list"]);
													$qr_data_lt=ams_query($link,$sql_data_lt) or die ("เลือกข้อมูลไม่ได้");
													$num_data_lt=mysqli_num_rows($qr_data_lt);
													$rs_more=mysqli_fetch_array($qr_data_lt);
													$id_data_lda_one=$rs_more['id_data_lda'];
															$sql_one_data = ams_sql("select * from  data_lda where id=?", ["$id_data_lda_one"]);
															$qr_one_data=ams_query($link,$sql_one_data) or die ("เลือกข้อมูลไม่ได้");
															$rs_mor_one=mysqli_fetch_array($qr_one_data);
															$barcode_more=$rs_mor_one['barcode1'];
															$title_more=$rs_mor_one['lda_list'];

													?>
													<?php if($num_data_lt!=0) { ?>
													<div class="col-xs-12 col-sm-6">
																	<div >

																		<table class="table100 table-striped table-bordered table-hover">
																		<thead>
																		<tr>
																				<td class="head_blue" colspan="4"> :: ครุภัณฑ์ที่ถูกเลือกให้ยืม</td>
																		</tr>
																		<tr>
																			<th class="center font_brown70" width="6%">No.</th>
																			<th class="center font_brown70"width="10%">เลขครุภัณฑ์</th>
																			<th class="center font_brown70">รายการ</td>
																			<th class="center font_brown70" width="8%">ยกเลิก</th>
																		</tr>
																	</thead>
																	<tr>
																		<td class="center">1.</td>
																		<td class="center"><?php echo $barcode_more;?></td>
																		<td ><?php echo $title_more;?></td>
																		<td class="center">
																			<a class="green" href="update_borrow_reply_1.php?id=<?php echo $id; ?>&id_take_list=<?php echo $id_take_list; ?>&id_data_lda=<?php echo $id_data_lda_one; ?>">
																				<i class="ace-icon fa fa-mail-reply bigger-130 green"></i>
																			</a>
																		</td>
																	</tr>
																	</table>
																	</div>
														<div class="row" style="padding:2px;"> </div>
														</div>
													<?php } ?>
												<?php }?>

												<!-- col 2 End -->


									</div>
								<?php }?>
									<div class="row" style="padding:2px;"> </div>

                </div>
                <!-- /.box-body -->
              </div>


            </div>
            </div>

						<!-- End 1 -->







						<?php
								$rs_data2=mysqli_fetch_array($qr_data);
								$id_take_list2=$rs_data2['id'];
								$title2=$rs_data2['title'];
								$amount2=$rs_data2['amount'];
								$unit2=$rs_data2['unit'];
								$note2=$rs_data2['note'];
								$status_list2=$rs_data2['status'];

						?>
						<?php if($id_take_list2!="") { ?>
						<!-- Start 2 -->
            <div class="row">
            <div class="col-xs-12 col-sm-12 ">
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title ">:: รายการครุภัณฑ์ที่ขอยืม <font color="#4175ab"><b><u>รายการที่ 2</u></b></font></h3>
                </div>
                <div class="box-body">
                  <div class="row" style="padding:3px;"> </div>


									<div class="row">
												<!-- 1 -->
												<form action="update_borrow_title2.php" method="post" name="form_update">
													<input type="hidden" name="id_take_list" value="<?php echo $id_take_list2;?>">
													<input type="hidden" name="id" value="<?php echo $id;?>">
													<input type="hidden" name="amount" value="<?php echo $amount2;?>">
												<div class="col-xs-12 col-sm-4">
																<div class="input-group"> <span class="input-group-addon"><img src="image_number/2.png"></span>
																		<input type="text" class="form-control" style="font-size:13px;background-color:#f1f9f2;height:34px;"
																		name="txt_title2" placeholder="ชื่อรายการพัสดุ/ครุภัณฑ์..."  maxlength="100" id="txtList2" autocomplete="off" value="<?php echo $title2; ?>">
																		<span class="input-group-addon"><button class=" btn-info bigger-90"><i class="ace-icon fa fa-random"></i></bontton></span>
																</div>
												<div class="row" style="padding:2px;"> </div>
												</div>
											</form>
												<!-- 2 -->
												<div class="col-xs-8 col-sm-2">
																<div class="input-group"><span class="input-group-addon" style="background-color:#eeeeee;font-size:12px;color:#797e7c;">จำนวนยืม</span>
																<input type="text" class="form-control" style="font-size:13px;background-color:#f1f9f2!important;height:34px;text-align:center;" name="txt_amount2"
																					placeholder="จำนวนยืม" value="<?php echo $amount2; ?>" disabled>
																</div>
												<div class="row" style="padding:2px;"> </div>
												</div>
												<!-- 3 -->
												<div class="col-xs-8 col-sm-2">
																<div class="input-group"><span class="input-group-addon" style="background-color:#eeeeee;font-size:12px;color:#797e7c;">หน่วยนับ</span>
																<input type="text" class="form-control" style="font-size:13px;background-color:#f1f9f2!important;height:34px;text-align:center;"
																name="txt_unit2" placeholder="หน่วยนับ"  maxlength="20" value="<?php echo $unit2; ?>" disabled>
																</div>
												<div class="row" style="padding:2px;"> </div>
												</div>
												<!-- 4 -->
												<div class="col-xs-12 col-sm-4">
																<div class="input-group"><span class="input-group-addon" style="background-color:#eeeeee;font-size:12px;color:#797e7c;">หมายเหตุ</span>
																		<input type="text" class="form-control" name="txt_note2" disabled style="background-color:#f1f9f2!important;font-size:13px;height:34px;" value="<?php echo $note2; ?>"/>
																</div>
												</div>
									</div>
									<div class="row" style="padding:2px;"> </div>

									<?php
												$sql_check2 = ams_sql("select * from  data_lda where lda_list like ? and lda_status='1' and status_borrow='1' ", ["%$title2%"]);
												$qr_check2=ams_query($link,$sql_check2) or die ("เลือกข้อมูลไม่ได้");
												$num_check2=mysqli_num_rows($qr_check2);
									?>
									<?php if($num_check2!="0") { ?>
									<div class="row">
												<!-- col 1 -->
												<div class="col-xs-12 col-sm-6">
																<div>

																	<table class="table100 table-striped table-bordered table-hover">
																		<thead>
																		<tr>
																				<td class="head_blue" colspan="5" > :: ข้อมูลครุภัณฑ์</td>
																		</tr>
																	<tr>
																		<th class="center" width="6%">No.</th>
																		<th class="center" width="10%">เลขครุภัณฑ์</th>
																		<th class="center">รายการ</th>
																		<th class="center" colspan="2">สถานะ</th>
																	</tr>
																</thead>

																<?php
																$i_check1_2=1;
																$i_check2_2=0;
																	while($i_check2_2<$num_check2)
																	{
																		$rs_check2=mysqli_fetch_array($qr_check2);
																		$id_br2=$rs_check2['id'];
																		$barcode1_2=$rs_check2['barcode1'];
																		$lda_list_sh2=$rs_check2['lda_list'];
																		$status_return2=$rs_check2['status_return'];

																?>
																<tr>
																	<td class="center"><?php echo $i_check1_2;?>.</td>
																	<td class="center"><?php echo $barcode1_2;?></td>
																	<td ><?php echo $lda_list_sh2;?></td>
																	<?php if ($status_return2=="1") { ?><td class="center" bgcolor="#49ac8b" width="12%"><font color="#FFFFFF">ว่าง</font> </td>
																<?php } elseif($status_return2=="2") { ?><td class="center" bgcolor="#d15b47" width="12%"><font color="#FFFFFF">ไม่ว่าง</font></td>
																	<?php } ?>
																	<td class="center" width="6%">
																		<?php if($status_return2=="1") { ?>
																		<a class="green" href="update_borrow_check2.php?id=<?php echo $id; ?>&id_data_lda=<?php echo $id_br2; ?>
																			&id_take_list=<?php echo $id_take_list2; ?>&amount=<?php echo $amount2; ?>&barcode=<?php echo $barcode1_2; ?>">
																			<i class="ace-icon fa fa-check bigger-130 blue"></i>
																		</a>
																	<?php } elseif($status_return2=="2") { ?><i class="ace-icon fa fa-times bigger-120 red2"></i><?php } ?>
																	</td>
																</tr>
																<?php $i_check1_2++; $i_check2_2++; } ?>
																</table>
																</div>
												<div class="row" style="padding:2px;"> </div>
												</div>
												<!-- col 1 End -->

												<!-- col 2 -->
												<?php
												if($amount2!="1") {
												$sql_data_lt2 = ams_sql("select * from  data_take_list_more where id_data_take_list=? order by barcode ", ["$id_take_list2"]);
												$qr_data_lt2=ams_query($link,$sql_data_lt2) or die ("เลือกข้อมูลไม่ได้");
												$num_data_lt2=mysqli_num_rows($qr_data_lt2);
												?>
												<?php if($num_data_lt2!="0") { ?>

												<div class="col-xs-12 col-sm-6">
																<div >

																	<table class="table100 table-striped table-bordered table-hover">
																	<thead>
																	<tr>
																			<td class="head_blue" colspan="4"> :: ครุภัณฑ์ที่ถูกเลือกให้ยืม</td>
																	</tr>
																	<tr>
																		<th class="center font_brown70" width="6%">No.</th>
																		<th class="center font_brown70"width="10%">เลขครุภัณฑ์</th>
																		<th class="center font_brown70">รายการ</td>
																		<th class="center font_brown70" width="8%">ยกเลิก</th>
																	</tr>
																</thead>



																<?php
																$i_more1_2=1;
																$i_more2_2=0;
																	while($i_more2_2<$num_data_lt2)
																	{
																		$rs_more2=mysqli_fetch_array($qr_data_lt2);
																		$id_take_list_more2=$rs_more2['id'];
																		$id_data_lda_more2=$rs_more2['id_data_lda'];
																				$sql_bring_data2 = ams_sql("select * from  data_lda where id=?", ["$id_data_lda_more2"]);
																				$qr_bring_data2=ams_query($link,$sql_bring_data2) or die ("เลือกข้อมูลไม่ได้");
																				$rs_bring2=mysqli_fetch_array($qr_bring_data2);
																				$barcode_bring2=$rs_bring2['barcode1'];
																				$title_bring2=$rs_bring2['lda_list'];
																?>
																<tr>
																	<td class="center"><?php echo $i_more1_2;?>.</td>
																	<td class="center"><?php echo $barcode_bring2;?></td>
																	<td ><?php echo $title_bring2;?></td>
																	<td class="center">
																		<a class="green" href="update_borrow_reply2.php?id=<?php echo $id; ?>&id_take_list=<?php echo $id_take_list2; ?>
																			&id_take_list_more=<?php echo $id_take_list_more2; ?>&id_data_lda_more=<?php echo $id_data_lda_more2; ?>">
																			<i class="ace-icon fa fa-mail-reply bigger-130 green"></i>
																		</a>
																	</td>
																</tr>
																<?php $i_more1_2++; $i_more2_2++; } ?>
																</table>
																</div>
													<div class="row" style="padding:2px;"> </div>
													</div>

													<?php } ?>

												<?php } elseif($amount2=="1") { ?>
													<?php
													$sql_data_lt2 = ams_sql("select * from  data_take_list where id=? and id_data_lda<>'' ", ["$id_take_list2"]);
													$qr_data_lt2=ams_query($link,$sql_data_lt2) or die ("เลือกข้อมูลไม่ได้");
													$num_data_lt2=mysqli_num_rows($qr_data_lt2);
													$rs_more2=mysqli_fetch_array($qr_data_lt2);
													$id_data_lda_one2=$rs_more2['id_data_lda'];
															$sql_one_data2 = ams_sql("select * from  data_lda where id=?", ["$id_data_lda_one2"]);
															$qr_one_data2=ams_query($link,$sql_one_data2) or die ("เลือกข้อมูลไม่ได้");
															$rs_mor_one2=mysqli_fetch_array($qr_one_data2);
															$barcode_more2=$rs_mor_one2['barcode1'];
															$title_more2=$rs_mor_one2['lda_list'];

													?>
													<?php if($num_data_lt2!=0) { ?>
													<div class="col-xs-12 col-sm-6">
																	<div >

																		<table class="table100 table-striped table-bordered table-hover">
																		<thead>
																		<tr>
																				<td class="head_blue" colspan="4"> :: ครุภัณฑ์ที่ถูกเลือกให้ยืม</td>
																		</tr>
																		<tr>
																			<th class="center font_brown70" width="6%">No.</th>
																			<th class="center font_brown70"width="10%">เลขครุภัณฑ์</th>
																			<th class="center font_brown70">รายการ</td>
																			<th class="center font_brown70" width="8%">ยกเลิก</th>
																		</tr>
																	</thead>
																	<tr>
																		<td class="center">1.</td>
																		<td class="center"><?php echo $barcode_more2;?></td>
																		<td ><?php echo $title_more2;?></td>
																		<td class="center">
																			<a class="green" href="update_borrow_reply_2.php?id=<?php echo $id; ?>&id_take_list=<?php echo $id_take_list2; ?>&id_data_lda=<?php echo $id_data_lda_one2; ?>">
																				<i class="ace-icon fa fa-mail-reply bigger-130 green"></i>
																			</a>
																		</td>
																	</tr>
																	</table>
																	</div>
														<div class="row" style="padding:2px;"> </div>
														</div>
													<?php } ?>
												<?php }?>

												<!-- col 2 End -->


									</div>
								<?php }?>
									<div class="row" style="padding:2px;"> </div>

                </div>
                <!-- /.box-body -->
              </div>


            </div>
            </div>

						<!-- End 2 -->
					<?php } ?>



					<?php
							$rs_data3=mysqli_fetch_array($qr_data);
							$id_take_list3=$rs_data3['id'];
							$title3=$rs_data3['title'];
							$amount3=$rs_data3['amount'];
							$unit3=$rs_data3['unit'];
							$note3=$rs_data3['note'];
							$status_list3=$rs_data3['status'];
					?>
					<?php if($id_take_list3!="") { ?>
					<!-- Start 3 -->
					<div class="row">
					<div class="col-xs-12 col-sm-12 ">
						<div class="box box-success">
							<div class="box-header with-border">
								<h3 class="box-title ">:: รายการครุภัณฑ์ที่ขอยืม <font color="#4175ab"><b><u>รายการที่ 3</u></b></font></h3>
							</div>
							<div class="box-body">
								<div class="row" style="padding:3px;"> </div>


								<div class="row">
											<!-- 1 -->
											<form action="update_borrow_title3.php" method="post" name="form_update">
												<input type="hidden" name="id_take_list" value="<?php echo $id_take_list3;?>">
												<input type="hidden" name="id" value="<?php echo $id;?>">
												<input type="hidden" name="amount" value="<?php echo $amount3;?>">
											<div class="col-xs-12 col-sm-4">
															<div class="input-group"> <span class="input-group-addon"><img src="image_number/3.png"></span>
																	<input type="text" class="form-control" style="font-size:13px;background-color:#f1f9f2;height:34px;"
																	name="txt_title3" placeholder="ชื่อรายการพัสดุ/ครุภัณฑ์..."  maxlength="100" id="txtList3" autocomplete="off" value="<?php echo $title3; ?>">
																	<span class="input-group-addon"><button class=" btn-info bigger-90"><i class="ace-icon fa fa-random"></i></bontton></span>
															</div>
											<div class="row" style="padding:2px;"> </div>
											</div>
										</form>
											<!-- 2 -->
											<div class="col-xs-8 col-sm-2">
															<div class="input-group"><span class="input-group-addon" style="background-color:#eeeeee;font-size:12px;color:#797e7c;">จำนวนยืม</span>
															<input type="text" class="form-control" style="font-size:13px;background-color:#f1f9f2!important;height:34px;text-align:center;" name="txt_amount3"
																				placeholder="จำนวนยืม" value="<?php echo $amount3; ?>" disabled>
															</div>
											<div class="row" style="padding:2px;"> </div>
											</div>
											<!-- 3 -->
											<div class="col-xs-8 col-sm-2">
															<div class="input-group"><span class="input-group-addon" style="background-color:#eeeeee;font-size:12px;color:#797e7c;">หน่วยนับ</span>
															<input type="text" class="form-control" style="font-size:13px;background-color:#f1f9f2!important;height:34px;text-align:center;"
															name="txt_unit3" placeholder="หน่วยนับ"  maxlength="20" value="<?php echo $unit3; ?>" disabled>
															</div>
											<div class="row" style="padding:2px;"> </div>
											</div>
											<!-- 4 -->
											<div class="col-xs-12 col-sm-4">
															<div class="input-group"><span class="input-group-addon" style="background-color:#eeeeee;font-size:12px;color:#797e7c;">หมายเหตุ</span>
																	<input type="text" class="form-control" name="txt_note3" disabled style="background-color:#f1f9f2!important;font-size:13px;height:34px;" value="<?php echo $note3; ?>"/>
															</div>
											</div>
								</div>
								<div class="row" style="padding:2px;"> </div>

								<?php
											$sql_check3 = ams_sql("select * from  data_lda where lda_list like ? and lda_status='1' and status_borrow='1' ", ["%$title3%"]);
											$qr_check3=ams_query($link,$sql_check3) or die ("เลือกข้อมูลไม่ได้");
											$num_check3=mysqli_num_rows($qr_check3);
								?>
								<?php if($num_check3!="0") { ?>
								<div class="row">
											<!-- col 1 -->
											<div class="col-xs-12 col-sm-6">
															<div>

																<table class="table100 table-striped table-bordered table-hover">
																	<thead>
																	<tr>
																			<td class="head_blue" colspan="5" > :: ข้อมูลครุภัณฑ์</td>
																	</tr>
																<tr>
																	<th class="center" width="6%">No.</th>
																	<th class="center" width="10%">เลขครุภัณฑ์</th>
																	<th class="center">รายการ</th>
																	<th class="center" colspan="2">สถานะ</th>
																</tr>
															</thead>

															<?php
															$i_check1_3=1;
															$i_check2_3=0;
																while($i_check2_3<$num_check3)
																{
																	$rs_check3=mysqli_fetch_array($qr_check3);
																	$id_br3=$rs_check3['id'];
																	$barcode1_3=$rs_check3['barcode1'];
																	$lda_list_sh3=$rs_check3['lda_list'];
																	$status_return3=$rs_check3['status_return'];

															?>
															<tr>
																<td class="center"><?php echo $i_check1_3;?>.</td>
																<td class="center"><?php echo $barcode1_3;?></td>
																<td ><?php echo $lda_list_sh3;?></td>
																<?php if ($status_return3=="1") { ?><td class="center" bgcolor="#49ac8b" width="12%"><font color="#FFFFFF">ว่าง</font> </td>
															<?php } elseif($status_return3=="2") { ?><td class="center" bgcolor="#d15b47" width="12%"><font color="#FFFFFF">ไม่ว่าง</font></td>
																<?php } ?>
																<td class="center" width="6%">
																	<?php if($status_return3=="1") { ?>
																	<a class="green" href="update_borrow_check3.php?id=<?php echo $id; ?>&id_data_lda=<?php echo $id_br3; ?>
																		&id_take_list=<?php echo $id_take_list3; ?>&amount=<?php echo $amount3; ?>&barcode=<?php echo $barcode1_3; ?>">
																		<i class="ace-icon fa fa-check bigger-130 blue"></i>
																	</a>
																<?php } elseif($status_return3=="2") { ?><i class="ace-icon fa fa-times bigger-120 red2"></i><?php } ?>
																</td>
															</tr>
															<?php $i_check1_3++; $i_check2_3++; } ?>
															</table>
															</div>
											<div class="row" style="padding:2px;"> </div>
											</div>
											<!-- col 1 End -->

											<!-- col 2 -->
											<?php
											if($amount3!="1") {
											$sql_data_lt3 = ams_sql("select * from  data_take_list_more where id_data_take_list=? order by barcode ", ["$id_take_list3"]);
											$qr_data_lt3=ams_query($link,$sql_data_lt3) or die ("เลือกข้อมูลไม่ได้");
											$num_data_lt3=mysqli_num_rows($qr_data_lt3);
											?>
											<?php if($num_data_lt3!="0") { ?>

											<div class="col-xs-12 col-sm-6">
															<div >

																<table class="table100 table-striped table-bordered table-hover">
																<thead>
																<tr>
																		<td class="head_blue" colspan="4"> :: ครุภัณฑ์ที่ถูกเลือกให้ยืม</td>
																</tr>
																<tr>
																	<th class="center font_brown70" width="6%">No.</th>
																	<th class="center font_brown70"width="10%">เลขครุภัณฑ์</th>
																	<th class="center font_brown70">รายการ</td>
																	<th class="center font_brown70" width="8%">ยกเลิก</th>
																</tr>
															</thead>



															<?php
															$i_more1_3=1;
															$i_more2_3=0;
																while($i_more2_3<$num_data_lt3)
																{
																	$rs_more3=mysqli_fetch_array($qr_data_lt3);
																	$id_take_list_more3=$rs_more3['id'];
																	$id_data_lda_more3=$rs_more3['id_data_lda'];
																			$sql_bring_data3 = ams_sql("select * from  data_lda where id=?", ["$id_data_lda_more3"]);
																			$qr_bring_data3=ams_query($link,$sql_bring_data3) or die ("เลือกข้อมูลไม่ได้");
																			$rs_bring3=mysqli_fetch_array($qr_bring_data3);
																			$barcode_bring3=$rs_bring3['barcode1'];
																			$title_bring3=$rs_bring3['lda_list'];
															?>
															<tr>
																<td class="center"><?php echo $i_more1_3;?>.</td>
																<td class="center"><?php echo $barcode_bring3;?></td>
																<td ><?php echo $title_bring3;?></td>
																<td class="center">
																	<a class="green" href="update_borrow_reply3.php?id=<?php echo $id; ?>&id_take_list=<?php echo $id_take_list3; ?>
																		&id_take_list_more=<?php echo $id_take_list_more3; ?>&id_data_lda_more=<?php echo $id_data_lda_more3; ?>">
																		<i class="ace-icon fa fa-mail-reply bigger-130 green"></i>
																	</a>
																</td>
															</tr>
															<?php $i_more1_3++; $i_more2_3++; } ?>
															</table>
															</div>
												<div class="row" style="padding:2px;"> </div>
												</div>

												<?php } ?>

											<?php } elseif($amount3=="1") { ?>
												<?php
												$sql_data_lt3 = ams_sql("select * from  data_take_list where id=? and id_data_lda<>'' ", ["$id_take_list3"]);
												$qr_data_lt3=ams_query($link,$sql_data_lt3) or die ("เลือกข้อมูลไม่ได้");
												$num_data_lt3=mysqli_num_rows($qr_data_lt3);
												$rs_more3=mysqli_fetch_array($qr_data_lt3);
												$id_data_lda_one3=$rs_more3['id_data_lda'];
														$sql_one_data3 = ams_sql("select * from  data_lda where id=?", ["$id_data_lda_one3"]);
														$qr_one_data3=ams_query($link,$sql_one_data3) or die ("เลือกข้อมูลไม่ได้");
														$rs_mor_one3=mysqli_fetch_array($qr_one_data3);
														$barcode_more3=$rs_mor_one3['barcode1'];
														$title_more3=$rs_mor_one3['lda_list'];

												?>
												<?php if($num_data_lt3!=0) { ?>
												<div class="col-xs-12 col-sm-6">
																<div >

																	<table class="table100 table-striped table-bordered table-hover">
																	<thead>
																	<tr>
																			<td class="head_blue" colspan="4"> :: ครุภัณฑ์ที่ถูกเลือกให้ยืม</td>
																	</tr>
																	<tr>
																		<th class="center font_brown70" width="6%">No.</th>
																		<th class="center font_brown70"width="10%">เลขครุภัณฑ์</th>
																		<th class="center font_brown70">รายการ</td>
																		<th class="center font_brown70" width="8%">ยกเลิก</th>
																	</tr>
																</thead>
																<tr>
																	<td class="center">1.</td>
																	<td class="center"><?php echo $barcode_more3;?></td>
																	<td ><?php echo $title_more3;?></td>
																	<td class="center">
																		<a class="green" href="update_borrow_reply_3.php?id=<?php echo $id; ?>&id_take_list=<?php echo $id_take_list3; ?>&id_data_lda=<?php echo $id_data_lda_one3; ?>">
																			<i class="ace-icon fa fa-mail-reply bigger-130 green"></i>
																		</a>
																	</td>
																</tr>
																</table>
																</div>
													<div class="row" style="padding:2px;"> </div>
													</div>
												<?php } ?>
											<?php }?>

											<!-- col 2 End -->


								</div>
							<?php }?>
								<div class="row" style="padding:2px;"> </div>

							</div>
							<!-- /.box-body -->
						</div>


					</div>
					</div>

					<!-- End 3 -->
				<?php } ?>



				<?php
						$rs_data4=mysqli_fetch_array($qr_data);
						$id_take_list4=$rs_data4['id'];
						$title4=$rs_data4['title'];
						$amount4=$rs_data4['amount'];
						$unit4=$rs_data4['unit'];
						$note4=$rs_data4['note'];
						$status_list4=$rs_data4['status'];
				?>
				<?php if($id_take_list4!="") { ?>
				<!-- Start 4 -->
				<div class="row">
				<div class="col-xs-12 col-sm-12 ">
					<div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title ">:: รายการครุภัณฑ์ที่ขอยืม <font color="#4175ab"><b><u>รายการที่ 4</u></b></font></h3>
						</div>
						<div class="box-body">
							<div class="row" style="padding:3px;"> </div>


							<div class="row">
										<!-- 1 -->
										<form action="update_borrow_title4.php" method="post" name="form_update">
											<input type="hidden" name="id_take_list" value="<?php echo $id_take_list4;?>">
											<input type="hidden" name="id" value="<?php echo $id;?>">
											<input type="hidden" name="amount" value="<?php echo $amount4;?>">
										<div class="col-xs-12 col-sm-4">
														<div class="input-group"> <span class="input-group-addon"><img src="image_number/4.png"></span>
																<input type="text" class="form-control" style="font-size:13px;background-color:#f1f9f2;height:34px;"
																name="txt_title4" placeholder="ชื่อรายการพัสดุ/ครุภัณฑ์..."  maxlength="100" id="txtList4" autocomplete="off" value="<?php echo $title4; ?>">
																<span class="input-group-addon"><button class=" btn-info bigger-90"><i class="ace-icon fa fa-random"></i></bontton></span>
														</div>
										<div class="row" style="padding:2px;"> </div>
										</div>
									</form>
										<!-- 2 -->
										<div class="col-xs-8 col-sm-2">
														<div class="input-group"><span class="input-group-addon" style="background-color:#eeeeee;font-size:12px;color:#797e7c;">จำนวนยืม</span>
														<input type="text" class="form-control" style="font-size:13px;background-color:#f1f9f2!important;height:34px;text-align:center;" name="txt_amount4"
																			placeholder="จำนวนยืม" value="<?php echo $amount4; ?>" disabled>
														</div>
										<div class="row" style="padding:2px;"> </div>
										</div>
										<!-- 3 -->
										<div class="col-xs-8 col-sm-2">
														<div class="input-group"><span class="input-group-addon" style="background-color:#eeeeee;font-size:12px;color:#797e7c;">หน่วยนับ</span>
														<input type="text" class="form-control" style="font-size:13px;background-color:#f1f9f2!important;height:34px;text-align:center;"
														name="txt_unit4" placeholder="หน่วยนับ"  maxlength="20" value="<?php echo $unit4; ?>" disabled>
														</div>
										<div class="row" style="padding:2px;"> </div>
										</div>
										<!-- 4 -->
										<div class="col-xs-12 col-sm-4">
														<div class="input-group"><span class="input-group-addon" style="background-color:#eeeeee;font-size:12px;color:#797e7c;">หมายเหตุ</span>
																<input type="text" class="form-control" name="txt_note4" disabled style="background-color:#f1f9f2!important;font-size:13px;height:34px;" value="<?php echo $note4; ?>"/>
														</div>
										</div>
							</div>
							<div class="row" style="padding:2px;"> </div>

							<?php
										$sql_check4 = ams_sql("select * from  data_lda where lda_list like ? and lda_status='1' and status_borrow='1' ", ["%$title4%"]); 
										$qr_check4=ams_query($link,$sql_check4) or die ("เลือกข้อมูลไม่ได้");
										$num_check4=mysqli_num_rows($qr_check4);
							?>
							<?php if($num_check4!="0") { ?>
							<div class="row">
										<!-- col 1 -->
										<div class="col-xs-12 col-sm-6">
														<div>

															<table class="table100 table-striped table-bordered table-hover">
																<thead>
																<tr>
																		<td class="head_blue" colspan="5" > :: ข้อมูลครุภัณฑ์</td>
																</tr>
															<tr>
																<th class="center" width="6%">No.</th>
																<th class="center" width="10%">เลขครุภัณฑ์</th>
																<th class="center">รายการ</th>
																<th class="center" colspan="2">สถานะ</th>
															</tr>
														</thead>

														<?php
														$i_check1_4=1;
														$i_check2_4=0;
															while($i_check2_4<$num_check4)
															{
																$rs_check4=mysqli_fetch_array($qr_check4);
																$id_br4=$rs_check4['id'];
																$barcode1_4=$rs_check4['barcode1'];
																$lda_list_sh4=$rs_check4['lda_list'];
																$status_return4=$rs_check4['status_return'];

														?>
														<tr>
															<td class="center"><?php echo $i_check1_4;?>.</td>
															<td class="center"><?php echo $barcode1_4;?></td>
															<td ><?php echo $lda_list_sh4;?></td>
															<?php if ($status_return4=="1") { ?><td class="center" bgcolor="#49ac8b" width="12%"><font color="#FFFFFF">ว่าง</font> </td>
														<?php } elseif($status_return4=="2") { ?><td class="center" bgcolor="#d15b47" width="12%"><font color="#FFFFFF">ไม่ว่าง</font></td>
															<?php } ?>
															<td class="center" width="6%">
																<?php if($status_return4=="1") { ?>
																<a class="green" href="update_borrow_check4.php?id=<?php echo $id; ?>&id_data_lda=<?php echo $id_br4; ?>
																	&id_take_list=<?php echo $id_take_list4; ?>&amount=<?php echo $amount4; ?>&barcode=<?php echo $barcode1_4; ?>">
																	<i class="ace-icon fa fa-check bigger-130 blue"></i>
																</a>
															<?php } elseif($status_return4=="2") { ?><i class="ace-icon fa fa-times bigger-120 red2"></i><?php } ?>
															</td>
														</tr>
														<?php $i_check1_4++; $i_check2_4++; } ?>
														</table>
														</div>
										<div class="row" style="padding:2px;"> </div>
										</div>
										<!-- col 1 End -->

										<!-- col 2 -->
										<?php
										if($amount4!="1") {
										$sql_data_lt4 = ams_sql("select * from  data_take_list_more where id_data_take_list=? order by barcode ", ["$id_take_list4"]);
										$qr_data_lt4=ams_query($link,$sql_data_lt4) or die ("เลือกข้อมูลไม่ได้");
										$num_data_lt4=mysqli_num_rows($qr_data_lt4);
										?>
										<?php if($num_data_lt4!="0") { ?>

										<div class="col-xs-12 col-sm-6">
														<div >

															<table class="table100 table-striped table-bordered table-hover">
															<thead>
															<tr>
																	<td class="head_blue" colspan="4"> :: ครุภัณฑ์ที่ถูกเลือกให้ยืม</td>
															</tr>
															<tr>
																<th class="center font_brown70" width="6%">No.</th>
																<th class="center font_brown70"width="10%">เลขครุภัณฑ์</th>
																<th class="center font_brown70">รายการ</td>
																<th class="center font_brown70" width="8%">ยกเลิก</th>
															</tr>
														</thead>



														<?php
														$i_more1_4=1;
														$i_more2_4=0;
															while($i_more2_4<$num_data_lt4)
															{
																$rs_more4=mysqli_fetch_array($qr_data_lt4);
																$id_take_list_more4=$rs_more4['id'];
																$id_data_lda_more4=$rs_more4['id_data_lda'];
																		$sql_bring_data4 = ams_sql("select * from  data_lda where id=?", ["$id_data_lda_more4"]);
																		$qr_bring_data4=ams_query($link,$sql_bring_data4) or die ("เลือกข้อมูลไม่ได้");
																		$rs_bring4=mysqli_fetch_array($qr_bring_data4);
																		$barcode_bring4=$rs_bring4['barcode1'];
																		$title_bring4=$rs_bring4['lda_list'];
														?>
														<tr>
															<td class="center"><?php echo $i_more1_4;?>.</td>
															<td class="center"><?php echo $barcode_bring4;?></td>
															<td ><?php echo $title_bring4;?></td>
															<td class="center">
																<a class="green" href="update_borrow_reply4.php?id=<?php echo $id; ?>&id_take_list=<?php echo $id_take_list4; ?>
																	&id_take_list_more=<?php echo $id_take_list_more4; ?>&id_data_lda_more=<?php echo $id_data_lda_more4; ?>">
																	<i class="ace-icon fa fa-mail-reply bigger-130 green"></i>
																</a>
															</td>
														</tr>
														<?php $i_more1_4++; $i_more2_4++; } ?>
														</table>
														</div>
											<div class="row" style="padding:2px;"> </div>
											</div>

											<?php } ?>

										<?php } elseif($amount4=="1") { ?>
											<?php
											$sql_data_lt4 = ams_sql("select * from  data_take_list where id=? and id_data_lda<>'' ", ["$id_take_list4"]);
											$qr_data_lt4=ams_query($link,$sql_data_lt4) or die ("เลือกข้อมูลไม่ได้");
											$num_data_lt4=mysqli_num_rows($qr_data_lt4);
											$rs_more4=mysqli_fetch_array($qr_data_lt4);
											$id_data_lda_one4=$rs_more4['id_data_lda'];
													$sql_one_data4 = ams_sql("select * from  data_lda where id=?", ["$id_data_lda_one4"]);
													$qr_one_data4=ams_query($link,$sql_one_data4) or die ("เลือกข้อมูลไม่ได้");
													$rs_mor_one7=mysqli_fetch_array($qr_one_data4);
													$barcode_more4=$rs_mor_one7['barcode1'];
													$title_more4=$rs_mor_one7['lda_list'];

											?>
											<?php if($num_data_lt4!=0) { ?>
											<div class="col-xs-12 col-sm-6">
															<div >

																<table class="table100 table-striped table-bordered table-hover">
																<thead>
																<tr>
																		<td class="head_blue" colspan="4"> :: ครุภัณฑ์ที่ถูกเลือกให้ยืม</td>
																</tr>
																<tr>
																	<th class="center font_brown70" width="6%">No.</th>
																	<th class="center font_brown70"width="10%">เลขครุภัณฑ์</th>
																	<th class="center font_brown70">รายการ</td>
																	<th class="center font_brown70" width="8%">ยกเลิก</th>
																</tr>
															</thead>
															<tr>
																<td class="center">1.</td>
																<td class="center"><?php echo $barcode_more4;?></td>
																<td ><?php echo $title_more4;?></td>
																<td class="center">
																	<a class="green" href="update_borrow_reply_3.php?id=<?php echo $id; ?>&id_take_list=<?php echo $id_take_list4; ?>&id_data_lda=<?php echo $id_data_lda_one4; ?>">
																		<i class="ace-icon fa fa-mail-reply bigger-130 green"></i>
																	</a>
																</td>
															</tr>
															</table>
															</div>
												<div class="row" style="padding:2px;"> </div>
												</div>
											<?php } ?>
										<?php }?>

										<!-- col 2 End -->


							</div>

						<?php } else { ?>

							<div class="row">
										<!-- col 1 -->
										<div class="col-xs-12 col-sm-6">
														<div>

															<table class="table100 table-striped table-bordered table-hover">
																<thead>
																<tr>
																		<td class="head_blue" colspan="4" > :: ข้อมูลครุภัณฑ์</td>
																</tr>
															<tr>
																<th class="center" width="6%">No.</th>
																<th class="center" width="10%">เลขครุภัณฑ์</th>
																<th class="center">รายการ</th>
																<th class="center" >สถานะ</th>
															</tr>
														</thead>

														<?php
														$sql_check44 = ams_sql("select * from  data_lda where lda_list like ?  ", ["%$title4%"]);
														$qr_check44=ams_query($link,$sql_check44) or die ("เลือกข้อมูลไม่ได้");
														$num_check44=mysqli_num_rows($qr_check44);
														$i_check1_4=1;
														$i_check2_4=0;
															while($i_check2_4<$num_check44)
															{
																$rs_check4=mysqli_fetch_array($qr_check44);
																$id_br4=$rs_check4['id'];
																$barcode1_4=$rs_check4['barcode1'];
																$lda_list_sh4=$rs_check4['lda_list'];
																$lda_status_44=$rs_check4['lda_status'];

														?>
														<tr>
															<td class="center"><?php echo $i_check1_4;?>.</td>
															<td class="center"><?php echo $barcode1_4;?></td>
															<td ><?php echo $lda_list_sh4;?></td>
															<?php if ($lda_status_44=="1") { ?><td class="center" bgcolor="#49ac8b" width="12%"><font color="#FFFFFF">ใช้งานปกติ</font> </td>
														  <?php } elseif($lda_status_44=="2") { ?><td class="center" bgcolor="#d15b47" width="12%"><font color="#FFFFFF">ชำรุด</font></td>
														  <?php } elseif($lda_status_44=="3") { ?><td class="center" bgcolor="#d15b47" width="12%"><font color="#FFFFFF">สูญหาย</font></td>
														  <?php } elseif($lda_status_44=="4") { ?><td class="center" bgcolor="#d15b47" width="12%"><font color="#FFFFFF">โอนย้าย / บริจาค</font></td>
														  <?php } elseif($lda_status_44=="5") { ?><td class="center" bgcolor="#d15b47" width="12%"><font color="#FFFFFF">จำหน่ายออก</font></td>
															<?php } ?>

														</tr>
														<?php $i_check1_4++; $i_check2_4++; } ?>
														</table>
														</div>
										<div class="row" style="padding:2px;"> </div>
										</div>
										<!-- col 1 End -->

										<!-- col 2 -->
										<?php
										if($amount4!="1") {
										$sql_data_lt4 = ams_sql("select * from  data_take_list_more where id_data_take_list=? order by barcode ", ["$id_take_list4"]);
										$qr_data_lt4=ams_query($link,$sql_data_lt4) or die ("เลือกข้อมูลไม่ได้");
										$num_data_lt4=mysqli_num_rows($qr_data_lt4);
										?>
										<?php if($num_data_lt4!="0") { ?>

										<div class="col-xs-12 col-sm-6">
														<div >

															<table class="table100 table-striped table-bordered table-hover">
															<thead>
															<tr>
																	<td class="head_blue" colspan="4"> :: ครุภัณฑ์ที่ถูกเลือกให้ยืม</td>
															</tr>
															<tr>
																<th class="center font_brown70" width="6%">No.</th>
																<th class="center font_brown70"width="10%">เลขครุภัณฑ์</th>
																<th class="center font_brown70">รายการ</td>
																<th class="center font_brown70" width="8%">ยกเลิก</th>
															</tr>
														</thead>



														<?php
														$i_more1_4=1;
														$i_more2_4=0;
															while($i_more2_4<$num_data_lt4)
															{
																$rs_more4=mysqli_fetch_array($qr_data_lt4);
																$id_take_list_more4=$rs_more4['id'];
																$id_data_lda_more4=$rs_more4['id_data_lda'];
																		$sql_bring_data4 = ams_sql("select * from  data_lda where id=?", ["$id_data_lda_more4"]);
																		$qr_bring_data4=ams_query($link,$sql_bring_data4) or die ("เลือกข้อมูลไม่ได้");
																		$rs_bring4=mysqli_fetch_array($qr_bring_data4);
																		$barcode_bring4=$rs_bring4['barcode1'];
																		$title_bring4=$rs_bring4['lda_list'];
														?>
														<tr>
															<td class="center"><?php echo $i_more1_4;?>.</td>
															<td class="center"><?php echo $barcode_bring4;?></td>
															<td ><?php echo $title_bring4;?></td>
															<td class="center">
																<a class="green" href="update_borrow_reply4.php?id=<?php echo $id; ?>&id_take_list=<?php echo $id_take_list4; ?>
																	&id_take_list_more=<?php echo $id_take_list_more4; ?>&id_data_lda_more=<?php echo $id_data_lda_more4; ?>">
																	<i class="ace-icon fa fa-mail-reply bigger-130 green"></i>
																</a>
															</td>
														</tr>
														<?php $i_more1_4++; $i_more2_4++; } ?>
														</table>
														</div>
											<div class="row" style="padding:2px;"> </div>
											</div>

											<?php } ?>


										<?php }?>

										<!-- col 2 End -->


										</div>
						<?php } ?>
							<div class="row" style="padding:2px;"> </div>

						</div>
						<!-- /.box-body -->
					</div>


				</div>
				</div>

				<!-- End 4 -->
			<?php } ?>

					<?php
							$rs_data5=mysqli_fetch_array($qr_data);
							$id_take_list5=$rs_data5['id'];
							$title5=$rs_data5['title'];echo $id_take_list5;
							$amount5=$rs_data5['amount'];
							$unit5=$rs_data5['unit'];
							$note5=$rs_data5['note'];
							$status_list5=$rs_data5['status'];
					?>




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
