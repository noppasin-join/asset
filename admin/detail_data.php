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

<?php
$id=$_GET['id'] ?? '';
$sql_data = ams_sql("select * from  data_lda where id=? ", ["$id"]);
$qr_data=ams_query($link,$sql_data) or die ("เลือกข้อมูลไม่ได้");
					$rs_data=mysqli_fetch_array($qr_data);
					$year_budget=$rs_data['year_budget'];
					$barcode1=$rs_data['barcode1'];
					$barcode2=$rs_data['barcode2'];
					$lda_category=$rs_data['lda_category'];
					$lda_type=$rs_data['lda_type'];
					$lda_detail=$rs_data['lda_detail'];
					$lda_year=$rs_data['lda_year'];
					$lda_no=$rs_data['lda_no'];
					$lda_list=$rs_data['lda_list'];
					$lda_brand=$rs_data['lda_brand'];
					$lda_serial=$rs_data['lda_serial'];
					$id_category=$rs_data['id_category'];
					$id_location=$rs_data['id_location'];
					$name_use=$rs_data['name_use'];
					$id_member_input=$rs_data['id_member_input'];
					$date_input=$rs_data['date_input'];
					$time_input=$rs_data['time_input'];
					$id_member_update=$rs_data['id_member_update'];
					$date_update=$rs_data['date_update'];
					$time_update=$rs_data['time_update'];
					$lda_status=$rs_data['lda_status'];
					$note=$rs_data['note'];
					$file_img=$rs_data['file_img'];
					$price=$rs_data['price'];
					$date_expire=$rs_data['date_expire'];
					$status_borrow=$rs_data['status_borrow'];
?>

      <div class="page-content">
        <div class="row">

          <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->





							<table cellpadding="0" cellspacing="0"   border="0" style="border-collapse:collapse" >
						            <tr>
						            <td>
						                        <table cellpadding="0" cellspacing="0" width="100%"    border="0" style="border-collapse:collapse" >
						                              <tr>
						                                <td height="30" class="head_99_bold"><u>ข้อมูลครุภัณฑ์</u></td>
						                              </tr>
						                              <tr>
						                                <td height="30" >Barcode :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo $barcode2;?>&nbsp;&nbsp;</font>
					                                </td>
						                              </tr>
						                              <tr>
						                                <td height="30" >รายการ :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo $lda_list;?>&nbsp;&nbsp;</font>
					                                </td>
						                              </tr>
						                              <tr>
						                                <td height="30" >ยี่ห้อ :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo $lda_brand;?>&nbsp;&nbsp;</font>
						                                &nbsp;&nbsp;&nbsp;
						                                Serial No. :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo $lda_serial; ?>&nbsp;&nbsp;</font>
						                              </td>
						                              </tr>
																					<tr>
						                                <td height="30" >ราคา :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo number_format( $price , 2 ) ; ?>&nbsp;&nbsp;</font> บาท
																							<?php if($date_expire!="" ) { ?>
																							&nbsp;&nbsp;&nbsp;
																							หมดประกัน : &nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo $date_expire; ?>&nbsp;&nbsp;</font>
																						<?php } ?>
																						</td>
						                              </tr>
																					<tr>
						                                <td height="30" >หมวดหมู่ :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;
																							<?php
																									$sql_ct = ams_sql("select * from  category where id=? ", ["$id_category"]);
																									$qr_ct=ams_query($link,$sql_ct) or die ("Error Connect Category");
																									$rs_ct=mysqli_fetch_array($qr_ct);
																									$name_ct=$rs_ct['name_category'];
																							?>
																							<?php echo $name_ct; ?>
																							&nbsp;&nbsp;</font>
						                              </td>
						                              </tr>
						                              <tr><td height="5" > </td></tr>
						                        </table>

						                        <table cellpadding="0" cellspacing="0" width="100%"    border="0" style="border-collapse:collapse" >
						                              <tr>
						                                <td height="30" colspan="3" class="head_99_bold"><u>ข้อมูลสถานที่และผู้ใช้งาน</u></td>
						                              </tr>
						                              <tr>
						                                <td height="30" >สถานที่ใช้งาน :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;
																							<?php
																									$sql_lc = ams_sql("select * from  data_location where id=? ", ["$id_location"]);
																									$qr_lc=ams_query($link,$sql_lc) or die ("Error Connect Data Location");
																									$rs_lc=mysqli_fetch_array($qr_lc);
																									$name_lc=$rs_lc['name_location'];
																							?>
																							<?php echo $name_lc; ?>
																							&nbsp;&nbsp;</font>
																							&nbsp;&nbsp;&nbsp;
																							ผู้ใช้งาน :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo $name_use; ?>&nbsp;&nbsp;</font>
						                                </td>
						                              </tr>
						                              <tr><td height="5" > </td></tr>
						                        </table>

						                        <table cellpadding="0" cellspacing="0" width="100%"    border="0" style="border-collapse:collapse" >
						                              <tr>
						                                <td height="30" colspan="3" class="head_99_bold"><u>ข้อมูลสถานะ</u></td>
						                              </tr>
						                              <tr>
						                                <td height="30" >สถานะ :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;
																							<?php if($lda_status=="1") { echo "ใช้งานปกติ"; }
																							elseif ($lda_status=="2") { echo "ชำรุด"; }
																							elseif ($lda_status=="3") { echo "สูญหาย"; }
																							elseif ($lda_status=="4") { echo "โอนย้าย/บริจาค"; }
																							elseif ($lda_status=="5") { echo "จำหน่ายออก"; }
																							elseif ($lda_status=="6") { echo "ส่งซ่อม"; }
																							elseif ($lda_status=="7") { echo "สภาพปกติ ไม่่จำเป็นต้องใช้งาน"; }
																							elseif ($lda_status=="8") { echo "รอจำหน่ายออก"; }
																							?>
																							&nbsp;&nbsp;</font>
																							&nbsp;&nbsp;&nbsp;
																							สถานะให้ยืม :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;
																							<?php if($status_borrow=="1") { echo "เปิดให้ยืม"; }
																							elseif ($status_borrow=="2") { echo "ไม่เปิดให้ยืม"; }
																							?>
																							&nbsp;&nbsp;</font>
																							&nbsp;&nbsp;&nbsp;
																							หมายเหตุ :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo $note;?>&nbsp;&nbsp;</font>
						                                </td>
						                              </tr>
						                              <tr><td height="5"> </td></tr>
						                        </table>

																		<table cellpadding="0" cellspacing="0" width="100%"    border="0" style="border-collapse:collapse" >
																				 <tr>
																					 <td height="30" colspan="3" class="head_99_bold"><u>จนท.ดำเนินการ</u></td>
																				 </tr>
																				 <tr>
																					 <td height="30" >จนท.นำเข้าระบบ :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;
																						 <?php
						 																		$sql_member_list = ams_sql("select * from  member where id=? ", ["$id_member_input"]);
						 																		$qr_member_list=ams_query($link,$sql_member_list) or die ("เลือกข้อมูลไม่ได้");
						 																		$rs_member_list=mysqli_fetch_array($qr_member_list);
																								$name_list=$rs_member_list['name'];
																								$surname_list=$rs_member_list['surname'];
						 																?>
																						<?php echo $name_list; ?>&nbsp;<?php echo $surname_list; ?>
																						 &nbsp;&nbsp;</font>
																					 &nbsp;&nbsp;&nbsp;
																					 <font class="hidden-700">
																					 วันที่นำเข้าระบบ :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo $date_input;?> (<?php echo $time_input; ?> น.)&nbsp;&nbsp;</font>
																				 </font>
																					 </td>
																				 </tr>
																				 <?php if($id_member_update!="-") { ?>
																				 <tr>
																					 <td height="30" >จนท.แก้ไขล่าสุด :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;
																						 <?php
						 																		$sql_member_up = ams_sql("select * from  member where id=? ", ["$id_member_update"]);
						 																		$qr_member_up=ams_query($link,$sql_member_up) or die ("เลือกข้อมูลไม่ได้");
						 																		$rs_member_up=mysqli_fetch_array($qr_member_up);
																								$name_list_up=$rs_member_up['name'];
																								$surname_list_up=$rs_member_up['surname'];
						 																?>
																						<?php echo $name_list_up; ?>&nbsp;<?php echo $surname_list_up; ?>
																						 &nbsp;&nbsp;</font>
																					 &nbsp;&nbsp;&nbsp;
																					 <font class="hidden-700">
																					 วันที่แก้ไขล่าสุด :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo $date_update;?> (<?php echo $time_update; ?> น.)&nbsp;&nbsp;</font>
																					 </font>
																					 </td>
																				 </tr>
																			 <?php } ?>
																				 <tr><td height="5"> </td></tr>
																	 </table>
						            </td>

						            </tr>
						            </table>


												<table cellpadding="0" cellspacing="0" width="100%"    border="0" style="border-collapse:collapse" >
												 <tr>
													 <td><img src="file_img/<?php echo $year_budget; ?>/<?php echo $file_img;?>" width="200" height="200"></td>
													 <td width="10"> </td>
													 <td>
														 <?php
														 include "barcode/src/BarcodeGenerator.php";
														 include "barcode/src/BarcodeGeneratorHTML.php";
														 $code = "$barcode1";
														 $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
															$border = 1;//กำหนดความหน้าของเส้น Barcode
															$height = 50;//กำหนดความสูงของ Barcode
															echo "<center>".$generator->getBarcode($code , $generator::TYPE_CODE_128,$border,$height)."</center>";
															echo "<center>".$code."</center>" ;
															echo "<center>MFU Library</center>" ;
														 ?>
													 </td>
												 </tr>
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
