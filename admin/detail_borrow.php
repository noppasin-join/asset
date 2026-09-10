<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$id = '';
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
		<!-- ace settings handler -->
		<link rel="stylesheet" href="reg-style.css" />
		<style> body { font-family: sarabun; } </style>
		<link rel="stylesheet" href="AdminLTE.min.css">

	</head>

	<body class="no-skin">

			<div class="main-container" id="main-container">

				<div class="main-content">
					<div class="main-content-inner">



      <div class="page-content">
        <div class="row">

          <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->



						<?php
						$id=$_GET['id'] ?? '';
									$sql_list = ams_sql("select * from  data_take where id=? ", ["$id"]);
									$qr_list=ams_query($link,$sql_list) or die ("เลือกข้อมูลไม่ได้");
									$rs_list=mysqli_fetch_array($qr_list);
									$name_list=$rs_list['name'];
									$surname_list=$rs_list['surname'];
									$department_list=$rs_list['department'];
									$objective_list=$rs_list['objective'];
									$checkout_list=$rs_list['checkout'];
									$checkin_list=$rs_list['checkin'];
									$status_read_list=$rs_list['status_read'];
									if($status_read_list=="0") {
										$sql_update=ams_sql("update data_take set status_read='1' where id=?", ["$id"]);
										$qr_update=ams_page_update($link, $sql_update) or die ("Error Update Status Read");
									}
						?>


							<table cellpadding="0" cellspacing="0"   border="0" style="border-collapse:collapse" >
												<tr>
												<td>
																		<table cellpadding="0" cellspacing="0" width="100%"    border="0" style="border-collapse:collapse" >
																					<tr>
																						<td height="30" class="head_99_bold"><u>ข้อมูลผู้ยืม</u></td>
																					</tr>
																					<tr>
																						<td height="30" >ชื่อ-นามสกุล :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo $name_list;?>&nbsp;&nbsp;<?php echo $surname_list;?>&nbsp;&nbsp;</font>
																					</td>
																					</tr>
																					<tr>
																						<td height="30" >หน่วยงาน :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo $department_list;?>&nbsp;&nbsp;</font>
																					</td>
																					</tr>
																					<tr>
																						<td height="30" >ความประสงค์ที่ขอยืม :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo $objective_list;?>&nbsp;&nbsp;</font>
																					</td>
																					</tr>
																					<?php
																					$pie=explode ("-", $checkout_list);
$pie = array_pad($pie, 6, ''); $y_ch=(is_numeric($pie[0]) ? (int) $pie[0] + 543 : '');
																					$pie2=explode ("-", $checkin_list);
$pie2 = array_pad($pie2, 6, ''); $y_ch2=(is_numeric($pie2[0]) ? (int) $pie2[0] + 543 : '');
																					?>
																					<tr>
																						<td height="30" >วันที่ยืม :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo "$pie[2]-$pie[1]-$y_ch"; ?>&nbsp;&nbsp;</font>
																						&nbsp;&nbsp;&nbsp;
																						วันที่คืน :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo "$pie2[2]-$pie2[1]-$y_ch2"; ?>&nbsp;&nbsp;</font>
																					</td>
																					</tr>

																					<tr><td height="5" > </td></tr>
																		</table>

												</td>

												</tr>
												</table>

					</div>
					<!-- /.row -->
					<!-- PAGE CONTENT ENDS -->
				<!-- /.col -->




					<div class="col-sm-12 col-xs-12">
													<div >
														<table class="table table-striped table-bordered table-hover">
															<thead>
																<tr>
																	<td class="head_blue" colspan="5"> :: ข้อมูลการขอยืมวัสดุ/ครุภัณฑ์</td>
																</tr>
																<tr>
																	<td class="font_brown70" style="text-align:center;"> ลำดับ </td>
																	<td class="font_brown70" style="text-align:center;">รายการ</td>
																	<td class="font_brown70" style="text-align:center;">จำนวนยืม</td>
																	<td class="font_brown70" style="text-align:center;">จำนวนอนุมัติ</td>
																	<td class="font_brown70" style="text-align:center;">สถานะ</td>
																</tr>
															</thead>
															<tbody>
																<?php
																			$sql_data = ams_sql("select * from  data_take_list where id_data_take=? ", ["$id"]);
																			$qr_data=ams_query($link,$sql_data) or die ("เลือกข้อมูลไม่ได้");
																			$num_data=mysqli_num_rows($qr_data);
																$i_no=1;
																$i_data=0;
																	while($i_data<$num_data)
																	{
																		$rs_data=mysqli_fetch_array($qr_data);
																		$year_budget=$rs_data['year_budget'];
																		$id_ttkk=$rs_data['id'];
																		$title=$rs_data['title'];
																		$amount=$rs_data['amount'];
																		$unit=$rs_data['unit'];
																		$note=$rs_data['note'];
																		$status_list=$rs_data['status'];
																?>
																<tr>
																	<td class="font_brown_12" align="center"><?php echo $i_no; ?>.</td>
																	<td class="font_brown_12"><?php echo $title; ?></td>
																	<td class="font_brown_12" align="center"><?php echo number_format( $amount ) ; ?>&nbsp;&nbsp;<?php echo $unit; ?></td>


																	<?php
																		$sql_data_num = ams_sql("select * from  data_take_list_more where id_data_take_list=? ", ["$id_ttkk"]);
																		$qr_data_num=ams_query($link,$sql_data_num) or die ("เลือกข้อมูลไม่ได้");
																		$total_num=mysqli_num_rows($qr_data_num);
																	?>
																				<td class="font_brown_12" align="center"><?php if($status_list!="0") { ?><?php echo number_format( $total_num ) ; ?>&nbsp;&nbsp;<?php echo $unit; ?><?php } else { echo "-"; } ?></td>

																	<?php if($status_list=="0") { ?>
																		<td bgcolor="#fcf8e3" align="center" style="font-size:12px;"><font color="#000">รอพิจารณา</font></td>
																	<?php } elseif($status_list=="1") { ?>
																		<td bgcolor="#49ac8b" align="center" style="font-size:12px;"><font color="#FFFFFF">อนุมัติ</font></td>
																	<?php } elseif($status_list=="2") { ?>
																		<td bgcolor="#d15b47" align="center" style="font-size:12px;"><font color="#FFFFFF">ไม่อนุมัติ</font></td>
																	<?php } ?>
																</tr>



																<?php $i_no++; $i_data++; } ?>

															</tbody>
														</table>



          </div>
          <!-- /.row -->
          <!-- PAGE CONTENT ENDS -->
        </div>
        <!-- /.col -->
      </div>






					 <?php // END BODY ?>

					</div>

				</div><!-- /.main-content -->




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








</body>
</html>
<?php } ?>
