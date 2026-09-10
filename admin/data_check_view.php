<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$choose_location = '';
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
				<link rel="shortcut icon" href="mfu.ico" type="image/x-icon">


<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="assets/font-awesome/4.2.0/css/font-awesome.min.css" />
<!-- page specific plugin styles -->
<link rel="stylesheet" href="assets/css/jquery-ui.min.css" />
<link rel="stylesheet" href="assets/css/ui.jqgrid.min.css" />
<!-- text fonts -->
<link rel="stylesheet" href="assets/fonts/fonts.googleapis.com.css" />
<!-- ace styles -->
<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
<script src="assets/js/ace-extra.min.js"></script>
<link rel="stylesheet" href="reg-style.css" />
<style> body { font-family: sarabun; } </style>

<link rel="stylesheet" href="AdminLTE.min.css">

  </head>
<?php
		$choose_location=$_GET['choose_location'] ?? '';
?>
  <body>

      <div class="main-container" id="main-container">



        <div class="">
          <div class="">



            <div class="">
							<?php
															$sql_year="SELECT * FROM data_config where status='1' order by year_budget desc";
															$query_year=ams_query($link,$sql_year);
																$total_qr_config=mysqli_num_rows($query_year);
															  $result_year=mysqli_fetch_array($query_year);
															  	$year_budget=$result_year['year_budget'];
																	$status_con=$result_year['status'];

							?>

                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                                    <div >
																			<input type="hidden" name="year_budget" value="<?php echo $year_budget; ?>">
                                      <table class="table-bordered" width="100%">
                                        <thead>
																					<?php if($status_con=="1") { ?>
                                          <tr>
                                            <td class="head_blue" colspan="15"> :: ปีงบประมาณ : <font color="#e8f652" style="font-size:12px;"><b><?php echo $year_budget; ?></b></font>
																								<?php
																											$sql_mem_list=ams_sql("SELECT * FROM member where id=?", ["$id_member"]);
																											$qr_mem_list=ams_query($link,$sql_mem_list);
																												$rs_mem_list=mysqli_fetch_array($qr_mem_list);
																												$name_mem_list=$rs_mem_list['name'];
																												$surname_mem_list=$rs_mem_list['surname'];

																								?>
																								&nbsp;&nbsp;&nbsp;&nbsp; ผู้ดำเนินการตรวจนับ &nbsp;:&nbsp;
																								<font color="#e8f652" style="font-size:12px;"><b><?php echo $name_mem_list; ?>&nbsp;&nbsp;<?php echo $surname_mem_list; ?></b></font>



																								&nbsp;&nbsp;&nbsp;&nbsp; สถานที่ใช้งาน &nbsp;:&nbsp;
																								<?php
																								if($choose_location!="") {
																									$sql_locate_m4 = ams_sql("SELECT * from  data_check_config where id_member=? and year_budget=? and id=? order by id_location", ["$id_member", "$year_budget", "$choose_location"]);
																								} else {
																									$sql_locate_m4 = ams_sql("SELECT * from  data_check_config where id_member=? and year_budget=? order by id_location", ["$id_member", "$year_budget"]);
																								}
																								$q_locate_m4=ams_query($link,$sql_locate_m4) or die ("เลือกข้อมูลไม่ได้");
																													$rs_locate_m4=mysqli_fetch_array($q_locate_m4);
																													$id_locate_m4=$rs_locate_m4['id'];
																													$id_lc_4=$rs_locate_m4['id_location'];
																								$sql_locate27 = ams_sql("SELECT * from  data_location where id=? ", ["$id_lc_4"]);
																								$qr_locate27=ams_query($link,$sql_locate27) or die ("เลือกข้อมูลไม่ได้");
																								$rs_locate27=mysqli_fetch_array($qr_locate27);
																								$name_locate27=$rs_locate27['name_location'];
																								 ?>

																								<font color="#e8f652" style="font-size:12px;"><b><?php echo $name_locate27; ?></b></font>

																						</td>
                                          </tr>


																				<?php } ?>

                                          <tr>
                                            <th class="center font_brown70_12 hidden-1000"> ลำดับ. </th>
                                            <th class="center font_brown70_12">เลขครุภัณฑ์</th>
                                            <th class="center font_brown70_12">รายการ</th>
                                            <th class="center font_brown70_12 hidden-1000">ยี่ห้อ</th>
                                            <th class="center font_brown70_12 hidden-1000">สถานที่ใช้งาน</th>
																						<th class="center font_brown70_12 hidden-1000">ผู้ใช้งาน</th>
                                            <th class="center font_brown70_12 hidden-1000">สถานะ</th>
																						<th class="center font_brown70_12">หมายเหตุ</th>
																						<th class="center font_brown70_12 hidden-1000">รูปภาพ</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php

																					$q=ams_sql("SELECT * FROM data_check where year_budget=? and id_location_old=?", ["$year_budget", "$choose_location"]);
																					$qr=ams_query($link,$q);
																					$total2=mysqli_num_rows($qr);


																					if($total2!=0){
																						$i2=1;
																							while($rs=mysqli_fetch_array($qr))
																					{
																												$sql_data = ams_sql("select * from  data_lda where id=? ", ["$rs[id_data_lda]"]);
																												$qr_data=ams_query($link,$sql_data) or die ("เลือกข้อมูลไม่ได้");
																												$total_list=mysqli_num_rows($qr_data);
																												$rs_data=mysqli_fetch_array($qr_data);
																												$data_det=$rs_data['id'];
																												$barcode2=$rs_data['barcode2'];
																												$lda_list=$rs_data['lda_list'];
																												$lda_brand=$rs_data['lda_brand'];
																												$id_location=$rs_data['id_location'];
																												$name_use=$rs_data['name_use'];
																												$lda_status=$rs_data['lda_status'];
																												$note=$rs_data['note'];
																												$file_img=$rs_data['file_img'];
																						?>
																						<?php if($total_list!=0) {  ?>
                                          <tr>
                                            <td class="center font_brown_12 hidden-1000" style="vertical-align:middle;"><?php echo $i2; ?>.</td>
                                            <td class="center font_brown_12" style="vertical-align:middle;"><?php echo $barcode2; ?></td>
                                            <td class="font_brown_12" style="vertical-align:middle;">
																							<?php echo $lda_list; ?>
																						</td>
																						<td class="font_brown_12 hidden-1000" style="vertical-align:middle;"><?php echo $lda_brand; ?></td>
																						<td class="center font_brown_12 hidden-1000" style="vertical-align:middle;">
																							<?php
																							$sql_locate = ams_sql("select * from  data_location where id=? ", ["$id_location"]);
																							$qr_locate=ams_query($link,$sql_locate) or die ("เลือกข้อมูลไม่ได้");
																							$rs_locate=mysqli_fetch_array($qr_locate);
																							$name_locate=$rs_locate['name_location'];
																							 ?>
																							<?php echo $name_locate; ?>
																						</td>
																						<td class="center font_brown_12 hidden-1000" style="vertical-align:middle;"><?php echo $name_use; ?></td>
																						<td class="center font_brown_12 hidden-1000" style="vertical-align:middle;">
																						<?php if ($lda_status=="1") { ?>ใช้งานปกติ
																						<?php } elseif($lda_status=="2") { ?>ชำรุด
																						<?php } elseif($lda_status=="3") { ?>สูญหาย
																						<?php } elseif($lda_status=="4") { ?>โอนย้าย / บริจาค
																						<?php } elseif($lda_status=="5") { ?>จำหน่ายออก
																						<?php } elseif($lda_status=="6") { ?>ส่งซ่อม
																						<?php } elseif($lda_status=="7") { ?>สภาพปกติ ไม่จำเป็นต้องใช้
																						<?php } elseif($lda_status=="8") { ?>รอจำหน่ายออก
																						<?php } ?>
                                            </td>
																						<td class="font_brown_12" style="vertical-align:middle;"><?php echo $note; ?></td>
																						<td class="center font_brown_12" style="vertical-align:middle;">
																							<?php if($file_img!="") { echo "มี"; } else { echo "ไม่มี"; } ?>
																						</td>


                                          </tr>
																				<?php } ?>

                                          <?php $i2++; } ?>
                                          <?php } else { ?>
                                          <tr>
                                            <td class="center font_brown_12" colspan="15"><< ไม่มีข้อมูล >></td>
                                          </tr>
                                          <?php } ?>
                                        </tbody>
                                      </table>
									<input type="hidden" name="e_page" value="<?php echo $total2; ?>">

                                    </div>
                                  </div>




                                  </div>



            </div>

					</div><!-- /.main-content -->


          </div>





        <?php include("class_scroll_up.php"); ?>
      </div><!-- /.main-container -->

      <script type="text/javascript">
        if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
      </script>

  </body>

</html>
<?php } ?>
