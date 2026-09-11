<?php require_once __DIR__ . '/admin/security.php'; ?>
<?php
	include ("con_lda.php");
	set_time_limit(0);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>:: Library Asset Management System</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

				<link rel="stylesheet" href="admin/assets/css/bootstrap.min.css" />
				<link rel="stylesheet" href="admin/assets/font-awesome/4.2.0/css/font-awesome.min.css" />
				<link rel="stylesheet" href="admin/assets/fonts/fonts.googleapis.com.css" />
				<!-- ace settings handler -->
						<link rel="stylesheet" href="admin/reg-style.css" />
						<link rel="stylesheet" href="admin/AdminLTE.min.css" />
						<style>
							body, table, td, font { font-family: 'Sarabun', Tahoma, sans-serif; font-size: 14px; }
							.head_99_bold { font-size: 14px !important; }
							.under_line_blue { font-size: 14px !important; }
						</style>


	</head>

	<body class="no-skin">

			<div class="main-container" id="main-container">

				<div class="main-content">
					<div class="main-content-inner">





			          <div class="col-xs-12">
			            <!-- PAGE CONTENT BEGINS -->



									<?php
					$id=isset($_GET['id']) ? (int) $_GET['id'] : 0;
					if (!$id) {
						echo '<div style="padding:16px;font-family:Sarabun,Tahoma,sans-serif;font-size:14px;color:#a94442;">ไม่พบรหัสข้อมูลที่ต้องการแสดง</div>';
						exit;
					}
															$sql_list = ams_sql("select * from  data_take where id=? ", ["$id"]);
															$qr_list=ams_query($link,$sql_list) or die ("เลือกข้อมูลไม่ได้");
															$rs_list=mysqli_fetch_array($qr_list);
															if (!$rs_list) {
																echo '<div style="padding:16px;font-family:Sarabun,Tahoma,sans-serif;font-size:14px;color:#a94442;">ไม่พบข้อมูลผู้ขอใช้สำหรับรายการนี้</div>';
																exit;
															}
												$name_list=$rs_list['name'];
												$surname_list=$rs_list['surname'];
												$department_list=$rs_list['department'];
												$objective_list=$rs_list['objective'];
												$checkout_list=$rs_list['checkout'];
												$checkin_list=$rs_list['checkin'];
															$pickup_list=$rs_list['pickup'] ?? '';

												$sql_pickup = ams_sql("select * from  data_take_list where id_data_take=? and status='1' ", ["$id"]);
												$qr_pickup=ams_query($link,$sql_pickup) or die ("เลือกข้อมูลไม่ได้");
												$num_pickup=mysqli_num_rows($qr_pickup);

															$pie_pickup=explode ("-", $pickup_list);$p_ch3=(!empty($pie_pickup[0]) ? (int) $pie_pickup[0] + 543 : 0);
									?>

										<table cellpadding="0" cellspacing="0"   border="0" style="border-collapse:collapse" >
									            <tr>
									            <td>
									                        <table cellpadding="0" cellspacing="0" width="100%"    border="0" style="border-collapse:collapse" >
									                              <tr>
									                                <td height="30" class="head_99_bold"><u>Information</u></td>
									                              </tr>
									                              <tr>
									                                <td height="30" >Name - Surname :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo $name_list;?>&nbsp;&nbsp;<?php echo $surname_list;?>&nbsp;&nbsp;</font>
								                                </td>
									                              </tr>
									                              <tr>
									                                <td height="30" >Department :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo $department_list;?>&nbsp;&nbsp;</font>
								                                </td>
									                              </tr>
																								<tr>
									                                <td height="30" >Objective :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo $objective_list;?>&nbsp;&nbsp;</font>
								                                </td>
									                              </tr>
																								<?php
																								$pie=explode ("-", $checkout_list);  $p_ch=$pie[0]+543;
																								$pie2=explode ("-", $checkin_list); $p_ch2=$pie2[0]+543;
																								?>
									                              <tr>
									                                <td height="30" >Start Date :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo "$pie[2]-$pie[1]-$p_ch"; ?>&nbsp;&nbsp;</font>
									                                &nbsp;&nbsp;&nbsp;
									                                Dua Date :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo "$pie2[2]-$pie2[1]-$p_ch2"; ?>&nbsp;&nbsp;</font>
																																						<?php if(!empty($pickup_list) && ($num_pickup!="0" || ($pie_pickup[2] ?? "00")!="00")) { ?> &nbsp;&nbsp;&nbsp;
																										Pick up Date :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo "$pie_pickup[2]-$pie_pickup[1]-$p_ch3"; ?>&nbsp;&nbsp;</font>
																									<?php } ?>
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
																				<td class="head_blue" colspan="4"> :: Equipment List</td>
																			</tr>
																			<tr>
																				<td class="font_brown70" style="text-align:center;"> No. </td>
																				<td class="font_brown70" style="text-align:center;">Data List</td>
																				<td class="font_brown70" style="text-align:center;">Amount</td>
																				<td class="font_brown70" style="text-align:center;">Status</td>
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
																				<?php if($status_list=="0") { ?>
																					<td bgcolor="#fcf8e3" align="center" style="font-size:12px;"><font color="#000">Pending</font></td>
																				<?php } elseif($status_list=="1") { ?>
																					<td bgcolor="#49ac8b" align="center" style="font-size:12px;"><font color="#FFFFFF">Approve</font></td>
																				<?php } elseif($status_list=="2") { ?>
																					<td bgcolor="#d15b47" align="center" style="font-size:12px;"><font color="#FFFFFF">Disapprove</font></td>
																				<?php } ?>
																			</tr>



																			<?php $i_no++; $i_data++; } ?>

																		</tbody>
																	</table>


																</div>
															</div>
















					 <?php // END BODY ?>

					</div>

				</div><!-- /.main-content -->




			</div><!-- /.main-container -->

			<script src="admin/assets/js/jquery.2.1.1.min.js"></script>
			<script type="text/javascript">
				window.jQuery || document.write("<script src='admin/assets/js/jquery.min.js'>"+"<"+"/script>");
			</script>
			<script type="text/javascript">
				if('ontouchstart' in document.documentElement) document.write("<script src='admin/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
			</script>








</body>
</html>
