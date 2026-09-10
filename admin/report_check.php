<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
$txt_no = '';
$txt_title = '';

	$g = '';
$choose_year = '';
$choose_staff = '';
$choose_status = '';
$choose_location = '';
$s_page2 = '';
$urlquery_str2 = '';
$radiobutton = '';
$p = '';
$chk_page2 = 0;
$before_p2 = 0;
$nClass = '';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
	$sess_user = $_SESSION['sess_user'] ?? '';
	$sess_password = $_SESSION['sess_password'] ?? '';

	require_once __DIR__ . '/con_lda.php';
	if ($sess_user == "" || $status!=0) {
    ams_deny(403, 'Insufficient permissions.');
	} else {
	set_time_limit(0);


$g=$_GET['g'] ?? '';
if ($g==1) {
$choose_year=$_GET['choose_year'] ?? '';
$choose_staff=$_GET['choose_staff'] ?? '';
$choose_status=$_GET['choose_status'] ?? '';
$choose_location=$_GET['choose_location'] ?? '';


$s_page2=$_GET['s_page2'] ?? '';
$urlquery_str2=$_GET['urlquery_str2'] ?? '';
$radiobutton=$_GET['radiobutton'] ?? '';

}

$p=$_POST['p'] ?? '';
if ($p==1) {
	$choose_year=$_POST['choose_year'] ?? '';
	$choose_staff=$_POST['choose_staff'] ?? '';
	$choose_status=$_POST['choose_status'] ?? '';
	$choose_location=$_POST['choose_location'] ?? '';

	$s_page2=$_POST['s_page2'] ?? '';
	$urlquery_str2=$_POST['urlquery_str2'] ?? '';
	$radiobutton=$_POST['radiobutton'] ?? '';

}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
        <title>:: ระบบฐานข้อมูลครุภัณฑ์ ศูนย์บรรณสารฯ</title>
				<link rel="shortcut icon" href="mfu.ico" type="image/x-icon">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />


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
				<script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>



								<?php
								// สร้างฟังก์ชั่น สำหรับแสดงการแบ่งหน้า
								function page_navigator2($before_p2,$plus_p2,$total2,$total_p2,$chk_page2,$d62,$choose_year,$choose_staff,$choose_status,$choose_location,$g){
								global $urlquery_str2;
								$pPrev=$chk_page2-1;
								$pPrev=($pPrev>=0)?$pPrev:0;
								$pNext=$chk_page2+1;
								$pNext=($pNext>=$total_p2)?$total_p2-1:$pNext;
								$lt_page=$total_p2-4;
								if($chk_page2>0){
								echo "<a  href='?s_page2=$pPrev&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&d62=1&&choose_year=$choose_year&&choose_staff=$choose_staff&&choose_status=$choose_status&&choose_location=$choose_location&&g=1' class='naviPN'><<</a>";
								}
								if($total_p2>=11){
								if($chk_page2>=4){
								echo "<a $nClass href='?s_page2=0&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&d62=1&&choose_year=$choose_year&&choose_staff=$choose_staff&&choose_status=$choose_status&&choose_location=$choose_location&&g=1'>1</a><a class='SpaceC'>. . .</a>";
								}
								if($chk_page2<4){
								for($i=0;$i<$total_p2;$i++){
								$nClass=($chk_page2==$i)?"class='selectPage'":"";
								if($i<=4){
								echo "<a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&d62=1&&choose_year=$choose_year&&choose_staff=$choose_staff&&choose_status=$choose_status&&choose_location=$choose_location&&g=1'>".intval($i+1)."</a> ";
								}
								if($i==$total_p2-1 ){
								echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&d62=1&&choose_year=$choose_year&&choose_staff=$choose_staff&&choose_status=$choose_status&&choose_location=$choose_location&&g=1'>".intval($i+1)."</a> ";
								}
								}
								}
								if($chk_page2>=4 && $chk_page2<$lt_page){
								$st_page=$chk_page2-3;
								for($i=1;$i<=5;$i++){
								$nClass=($chk_page2==($st_page+$i))?"class='selectPage'":"";
								echo "<a $nClass href='?s_page2=".intval($st_page+$i)."&&radiobutton=2&&d62=1&&choose_year=$choose_year&&choose_staff=$choose_staff&&choose_status=$choose_status&&choose_location=$choose_location&&g=1'>".intval($st_page+$i+1)."</a> ";
								}
								for($i=0;$i<$total_p2;$i++){
								if($i==$total_p2-1 ){
								$nClass=($chk_page2==$i)?"class='selectPage'":"";
								echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&d62=1&&choose_year=$choose_year&&choose_staff=$choose_staff&&choose_status=$choose_status&&choose_location=$choose_location&&g=1'>".intval($i+1)."</a> ";
								}
								}
								}
								if($chk_page2>=$lt_page){
								for($i=0;$i<=4;$i++){
								$nClass=($chk_page2==($lt_page+$i-1))?"class='selectPage'":"";
								echo "<a $nClass href='?s_page2=".intval($lt_page+$i-1)."&&radiobutton=2&&d62=1&&choose_year=$choose_year&&choose_staff=$choose_staff&&choose_status=$choose_status&&choose_location=$choose_location&&g=1'>".intval($lt_page+$i)."</a> ";
								}
								}
								}else{
								for($i=0;$i<$total_p2;$i++){
								$nClass=($chk_page2==$i)?"class='selectPage'":"";
								echo "<a href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&d62=1&&choose_year=$choose_year&&choose_staff=$choose_staff&&choose_status=$choose_status&&choose_location=$choose_location&&g=1' $nClass  >".intval($i+1)."</a> ";
								}
								}
								if($chk_page2<$total_p2-1){
								echo "<a href='?s_page2=$pNext&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&d62=1&&choose_year=$choose_year&&choose_staff=$choose_staff&&choose_status=$choose_status&&choose_location=$choose_location&&g=1'  class='naviPN'>>></a>";
								}
								}
								?>




</head>

  <body class="no-skin">
		<?php if($level=="0") { include("class_head_user.php"); } else { include("class_head.php"); } ?>

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
                <li class="active">รายงานตรวจนับครุภัณฑ์</li>
              </ul><!-- /.breadcrumb -->

            </div>
						<?php
						$sql_year="SELECT * FROM budget order by year_budget desc";
						$query_year=ams_query($link,$sql_year);
							$result_year=mysqli_fetch_array($query_year);
								$year_budget=$result_year['year_budget'];
						?>
						<?php
							$sql_year_con = "SELECT * from  data_config order by year_budget desc  ";
							$qr_year_con=ams_query($link,$sql_year_con) or die ("เลือกข้อมูลไม่ได้");
									$result_year_con=mysqli_fetch_array($qr_year_con);
									$year_budget_con=$result_year_con['year_budget'];
						?>
            <div class="page-content">

                <div class="row">
                  <div class="alert9 alert-info font_brown">
                    <form name="form_choose" method="post" action="report_check.php">
                      <input type="hidden" name="d621" value="1">
                      <input type="hidden" name="p" value="1">
                      <input type="hidden" name="choose_year" value="<?php echo $choose_year; ?>">
											<input type="hidden" name="choose_staff" value="<?php echo $choose_staff; ?>">
											<input type="hidden" name="choose_status" value="<?php echo $choose_status; ?>">
											<input type="hidden" name="choose_location" value="<?php echo $choose_location; ?>">

                      <i class="ace-icon fa fa-hand-o-right"></i> ปีงบประมาณ :
                        <select name="choose_year"  onChange="submit();" >
                        <?php if ($choose_year == "") { ?>

                        <option value="" selected><?php echo $year_budget_con; ?></option>
												<option value="">----</option>
                        <?php } else { ?>
													<option value="" selected><?php echo $choose_year; ?></option>
													<option value="">----</option>
                        <?php } ?>
                        <?php
        						$sql_year = "select * from  data_config order by year_budget desc  ";
        						$dbquery_year=ams_query($link,$sql_year) or die ("เลือกข้อมูลไม่ได้");
        						$num_rows_year=mysqli_num_rows($dbquery_year);
        						$i_year=0;
        							while($i_year<$num_rows_year)
        							{
        								$result_year=mysqli_fetch_array($dbquery_year);
        								$year_budget_choose=$result_year['year_budget'];
        					?>
                        <option value="<?php echo $year_budget_choose; ?>" >
                        <?php echo $year_budget_choose; ?>
                        </option>
                        <?php
        						$i_year++;
        							}
        					 ?>
                      </select>
										<font class="hidden-1000">
                      &nbsp;&nbsp;&nbsp; ผู้ตรวจนับ :
                      <select name="choose_staff" onChange="submit();" style="font-size:14px;" >
                        <?php if ($choose_staff != "") {  ?>
                        <?php
        														$sql_mb_select = ams_sql("select * from  member where id=? ", ["$choose_staff"]);
        														$dbquery_mb_select=ams_query($link,$sql_mb_select) or die ("เลือกข้อมูลไม่ได้");
        														$result_mb_select=mysqli_fetch_array($dbquery_mb_select);
        														$id_mb_select=$result_mb_select['id'];
																		$name_mb_select=$result_mb_select['name'];
																		$surname_mb_select=$result_mb_select['surname'];
        								?>
                        <option value="<?php echo $id_mb_select; ?>" selected>
                        <?php echo $name_mb_select; ?>&nbsp;<?php echo $surname_mb_select; ?>
                        </option>
                        <option value="">--- All ---</option>
                        <?php } else { ?>
                        <option value="" selected>--- All ---</option>
                        <?php } ?>
                        <?php
        														$sql_mb = "select * from  member where status='0' order by name  ";
        														$dbquery_mb=ams_query($link,$sql_mb) or die ("เลือกข้อมูลไม่ได้");
        														$num_rows_mb=mysqli_num_rows($dbquery_mb);
        														$i_mb=0;
        														while($i_mb<$num_rows_mb)
        														{

        														$result_mb=mysqli_fetch_array($dbquery_mb);
        														$id_mb=$result_mb['id'];
        														$name_mb=$result_mb['name'];
																		$surname_mb=$result_mb['surname'];
        															?>
                        <option value="<?php echo $id_mb; ?>">
                        <?php echo $name_mb; ?>&nbsp;<?php echo $surname_mb; ?>
                        </option>
                        <?php $i_mb++; } ?>
                      </select>
										</font>
											&nbsp;&nbsp;&nbsp; สถานะตรวจนับ :
											<select name="choose_status" onChange="submit();" style="font-size:14px;">
<?php if($choose_status=="") { ?><option value="" selected>---All---</option><?php } else { ?><option value="">---สถานะตรวจ---</option><?php } ?>
<?php if($choose_status=="1") { ?><option value="1" selected>ตรวจนับแล้ว</option><?php } else { ?><option value="1">ตรวจนับแล้ว</option><?php } ?>
<?php if($choose_status=="2") { ?><option value="2" selected>ยังไม่ได้ตรวจนับ</option><?php } else { ?><option value="2">ยังไม่ได้ตรวจนับ</option><?php } ?>
											</select>


											<font class="hidden-1200">&nbsp;&nbsp;&nbsp; ชั้น :
											<?php if ($txt_no != "" || $txt_title !="") {  ?><select name="choose_location" style="background-color:#eeeeee" disabled>
											<?php } else { ?><select name="choose_location" onChange="submit();" style="font-size:13px;"><?php } ?>

												<?php if ($choose_location != "") {  ?>
												<?php
																		$sql_locate_select = ams_sql("select * from  data_location where id=? ", ["$choose_location"]);
																		$dbquery_locate_select=ams_query($link,$sql_locate_select) or die ("เลือกข้อมูลไม่ได้");
																		$result_locate_select=mysqli_fetch_array($dbquery_locate_select);
																		$id_locate_select=$result_locate_select['id'];
																		$name_locate_select=$result_locate_select['name_location'];
												?>
												<option value="<?php echo $id_locate_select; ?>" selected>
												<?php echo $name_locate_select; ?>
												</option>
												<option value="">--- All ---</option>
												<?php } else { ?>
												<option value="" selected>--- All ---</option>
												<?php } ?>
												<?php
																		$sql_locate = "select * from  data_location where status_location='0' order by name_location ";
																		$dbquery_locate=ams_query($link,$sql_locate) or die ("เลือกข้อมูลไม่ได้");
																		$num_rows_locate=mysqli_num_rows($dbquery_locate);
																		$i_locate=0;
																		while($i_locate<$num_rows_locate)
																		{

																		$result_locate=mysqli_fetch_array($dbquery_locate);
																		$id_locat=$result_locate['id'];
																		$name_locate=$result_locate['name_location'];
																			?>
												<option value="<?php echo $id_locat; ?>">
												<?php echo $name_locate; ?>
												</option>
												<?php $i_locate++; } ?>

											</select>
											</font>


											<?php if($level!="0") {?>
												<div class="pull-right hidden-800">
													<a href="export_report_check.php?choose_year=<?php echo $choose_year; ?>&choose_staff=<?php echo $choose_staff; ?>&choose_status=<?php echo $choose_status; ?>&choose_location=<?php echo $choose_location; ?>" target="_blank" >
					                <button class="btn bg-sky2" type="button">Export &nbsp;<i class="fa fa-mail-forward"></i></button>
					                </a>
											  </div>
											<?php } ?>
                    </form>

                  </div>

                </div>

									<?php

								if ($choose_year=="") {
											if ($choose_staff =="") {
												  if ($choose_status=="") {
														if ($choose_location=="") {
															$q=ams_sql("SELECT * FROM data_check where year_budget=?  order by barcode3", ["$year_budget_con"]);
														} else {
															$q=ams_sql("SELECT * FROM data_check where year_budget=? and id_location_old=?  order by barcode3", ["$year_budget_con", "$choose_location"]);
														}

													} else {
														if ($choose_location=="") {
															$q=ams_sql("SELECT * FROM data_check where year_budget=? and status=?  order by barcode3", ["$year_budget_con", "$choose_status"]);
														} else {
															$q=ams_sql("SELECT * FROM data_check where year_budget=? and status=? and id_location_old=? order by barcode3", ["$year_budget_con", "$choose_status", "$choose_location"]);
														}

													}
											} else {
													if ($choose_status=="") {
														if ($choose_location=="") {
															$q=ams_sql("SELECT * FROM data_check where year_budget=? and id_member_check=? order by barcode3", ["$year_budget_con", "$choose_staff"]);
														} else {
															$q=ams_sql("SELECT * FROM data_check where year_budget=? and id_member_check=? and id_location_old=? order by barcode3", ["$year_budget_con", "$choose_staff", "$choose_location"]);
														}

													} else {
														if ($choose_location=="") {
															$q=ams_sql("SELECT * FROM data_check where year_budget=? and id_member_check=? and status=? order by barcode3", ["$year_budget_con", "$choose_staff", "$choose_status"]);
														} else {
															$q=ams_sql("SELECT * FROM data_check where year_budget=? and id_member_check=? and status=? and id_location_old=? order by barcode3", ["$year_budget_con", "$choose_staff", "$choose_status", "$choose_location"]);
														}

													}
											}
								} elseif($choose_year!="") {
									if ($choose_staff =="") {
											if ($choose_status=="") {
												if ($choose_location=="") {
													$q=ams_sql("SELECT * FROM data_check where year_budget=?  order by barcode3", ["$choose_year"]);
												} else {
													$q=ams_sql("SELECT * FROM data_check where year_budget=? and id_location_old=?  order by barcode3", ["$choose_year", "$choose_location"]);
												}

											} else {
												if ($choose_location=="") {
													$q=ams_sql("SELECT * FROM data_check where year_budget=? and status=?  order by barcode3", ["$choose_year", "$choose_status"]);
												} else {
													$q=ams_sql("SELECT * FROM data_check where year_budget=? and status=? and id_location_old=? order by barcode3", ["$choose_year", "$choose_status", "$choose_location"]);
												}

											}
									} else {
											if ($choose_status=="") {
												if ($choose_location=="") {
													$q=ams_sql("SELECT * FROM data_check where year_budget=? and id_member_check=? order by barcode3", ["$choose_year", "$choose_staff"]);
												} else {
													$q=ams_sql("SELECT * FROM data_check where year_budget=? and id_member_check=? and id_location_old=? order by barcode3", ["$choose_year", "$choose_staff", "$choose_location"]);
												}

											} else {
												if ($choose_location=="") {
													$q=ams_sql("SELECT * FROM data_check where year_budget=? and id_member_check=? and status=? order by barcode3", ["$choose_year", "$choose_staff", "$choose_status"]);
												} else {
													$q=ams_sql("SELECT * FROM data_check where year_budget=? and id_member_check=? and status=? and id_location_old=? order by barcode3", ["$choose_year", "$choose_staff", "$choose_status", "$choose_location"]);
												}

											}
									}
								}

																							$qr=ams_query($link,$q);
																							$total2=mysqli_num_rows($qr);

									  ?>


                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                                    <div >
                                      <table class="table table-striped table-bordered">
                                          <tr>
                                            <td rowspan="2" class="center font_bg_white" style="vertical-align:middle;"> ลำดับ</td>
                                            <td rowspan="2" class="center font_bg_white hidden-700" style="vertical-align:middle;">เลขครุภัณฑ์</td>
                                            <td rowspan="2" class="center font_bg_white" style="vertical-align:middle;">รายการ</td>
																						<td rowspan="2" class="center font_bg_white hidden-1000" style="vertical-align:middle;">ยี่ห้อ</td>
																						<td rowspan="2" class="center font_bg_white hidden-1000" style="vertical-align:middle;">สถานที่ใช้งาน (เดิม)</td>

                                            <td colspan="3" class="center font_bg_white" style="vertical-align:middle;">ข้อมูลสถานะ (ปัจจุบัน)</td>
																						<td rowspan="2" class="center font_bg_white" style="vertical-align:middle;">สถานะตรวจนับ</td>
																						<td rowspan="2" class="center font_bg_white hidden-1100" style="vertical-align:middle;">ผู้ตรวจนับ</td>

                                          </tr>
																					<tr>
																						<td class="center font_bg_white" style="vertical-align:middle;">สถานที่ใช้งาน</td>
                                            <td class="center font_bg_white" style="vertical-align:middle;">ผู้ใช้งาน</td>
																						<td class="center font_bg_white " style="vertical-align:middle;">สถานะ</td>

										  </tr>
                                        <tbody>


																					<?php



																					$e_page=50; //
																					if(!isset($_GET['s_page2'])){
																					$_GET['s_page2']=0;
																					}else{
																					$chk_page2 = max(0, (int) ($_GET['s_page2'] ?? 0));
																					$_GET['s_page2'] = max(0, (int) ($_GET['s_page2'] ?? 0)) * $e_page;
																					}


																					$q = ams_limit($q, $_GET['s_page2'] ?? 0, $e_page);
																					$qr=ams_query($link,$q);
																					if(mysqli_num_rows($qr)>=1){
																					$plus_p2=($chk_page2*$e_page)+mysqli_num_rows($qr);
																					}else{
																					$plus_p2=($chk_page2*$e_page);
																					}
																					$total_p2=ceil($total2/$e_page);

																						?>




                                          <?php

																					if($total2!=0){
																							$i=1;
																							while($rs=mysqli_fetch_array($qr))
																					{

																						$sql_data = ams_sql("select * from  data_lda where id=? ", ["$rs[id_data_lda]"]);
																						$qr_data=ams_query($link,$sql_data) or die ("เลือกข้อมูลไม่ได้");
																											$rs_data=mysqli_fetch_array($qr_data);
																											$id_show=$rs_data['id'];
																											$barcode1=$rs_data['barcode1'];
																											$lda_year=$rs_data['lda_year'];
																											$lda_list=$rs_data['lda_list'];
																											$lda_brand=$rs_data['lda_brand'];
																											$status_table=$rs_data['lda_status'];
                                            ?>
                                          <tr>
                                            <td class="center font_brown"><?php echo ($chk_page2*$e_page)+$i; ?>.</td>
                                            <td class="center font_brown hidden-700">
																							<?php if($rs['barcode2']!="" && $rs['barcode2']!="-") { echo $rs['barcode2']; } else { ?>
																							<?php echo $barcode1; ?>
																						<?php } ?>
																						</td>
																						<td class="font_brown"><?php  echo $lda_list; ?></td>
																						<td class="font_brown hidden-1000"><?php echo $lda_brand; ?></td>
																						<td class="center font_brown hidden-1000">
																							<?php
																													$sql_locate2 = ams_sql("select * from  data_location where id=? ", ["$rs[id_location_old]"]);
																													$qr_locate2=ams_query($link,$sql_locate2) or die ("เลือกข้อมูลไม่ได้");
																													$rs_locate2=mysqli_fetch_array($qr_locate2);
																													$name_locate2=$rs_locate2['name_location'];
																							?>
																							<?php echo $name_locate2; ?>
																						</td>


																						<td class="center font_brown" bgcolor="#eff6ee">
																							<?php
																													$sql_locate = ams_sql("select * from  data_location where id=? ", ["$rs[id_location]"]);
																													$qr_locate=ams_query($link,$sql_locate) or die ("เลือกข้อมูลไม่ได้");
																													$rs_locate=mysqli_fetch_array($qr_locate);
																													$name_locate=$rs_locate['name_location'];
																							?>
																							<?php echo $name_locate; ?>
																						</td>
																						<td class="font_brown" bgcolor="#eff6ee"><?php echo $rs['name_use']; ?></td>
																						<td class="center font_brown" bgcolor="#eff6ee">
                                            <?php if ($status_table=="1") { ?>ใช้งานปกติ
																						<?php } elseif($status_table=="2") { ?>ชำรุด
																						<?php } elseif($status_table=="3") { ?>สูญหาย
																						<?php } elseif($status_table=="4") { ?>โอนย้าย / บริจาค
																						<?php } elseif($status_table=="5") { ?>จำหน่ายออก
																						<?php } elseif($status_table=="6") { ?>ส่งซ่อม
																						<?php } elseif($status_table=="7") { ?>สภาพปกติ ไม่จำเป็นต้องใช้งาน
																						<?php } elseif($status_table=="8") { ?>รอจำหน่ายออก
																						<?php } ?>
                                            </td>
																						<?php if($rs['status']=="1") { ?>
																						<td class="font_brown center" bgcolor="#fafad4">ตรวจแล้ว</td>
																						<?php } else { ?>
																						<td class="font_brown center" bgcolor="#f8eeec">ยังไม่ได้ตรวจ</td>
																						<?php } ?>
																						<td class="font_brown hidden-1100" bgcolor="#eef5f6">
																							<?php
																													$sql_member_last = ams_sql("select * from  member where id=? ", ["$rs[id_member_check]"]);
																													$qr_member_last=ams_query($link,$sql_member_last) or die ("เลือกข้อมูลไม่ได้");
																													$rs_member_last=mysqli_fetch_array($qr_member_last);
																													$name_last=$rs_member_last['name'];
																													$surname_last=$rs_member_last['surname'];
																							?>
																							<?php echo $name_last; ?>
																						</td>


                                          </tr>

                                          <?php $i++; } ?>
                                          <?php } else { ?>
                                          <tr>
                                            <td class="center font_brown" colspan="16"><< ไม่มีข้อมูล >></td>
                                          </tr>
                                          <?php } ?>
                                        </tbody>
                                      </table>


</div>
                                  </div>

																	<?php   if ($total2 == 0 || $total_p2 == "1")  {  } else {  ?>
																		<div class="pull-right pagination9">
																			<li>
																				<?php page_navigator2($before_p2,$plus_p2,$total2,$total_p2,$chk_page2,$d62,$choose_year,$choose_staff,$choose_status,$choose_location,$g); ?>
																			</li>
																		</div>
																	<?php } ?>


                                  </div>



            </div>

					</div><!-- /.main-content -->


          </div>




        <?php include("class_footer.php"); ?>

        <?php include("class_scroll_up.php"); ?>
      </div><!-- /.main-container -->

      <script type="text/javascript">
        if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
      </script>
      <script src="assets/js/bootstrap.min.js"></script>
      <script src="assets/js/ace-elements.min.js"></script>
      <script src="assets/js/ace.min.js"></script>




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
