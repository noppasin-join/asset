<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$g = '';
$choose_locate_main = '';
$choose_status_main = '';
$var_page = '';
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






				<!-- Add mousewheel plugin (this is optional) -->
				<link rel="stylesheet" href="AdminLTE.min.css">
				<script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>
				<!-- Add mousewheel plugin (this is optional) -->
				<!-- Add fancyBox main JS and CSS files -->
				<script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.5"></script>
				<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.5" media="screen" />
				<!-- Add Button helper (this is optional) -->
				<link rel="stylesheet" type="text/css" href="source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
				<script type="text/javascript" src="source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
				<script type="text/javascript">
						$(document).ready(function() {

							$('.fancybox').fancybox();



						});
					</script>
  </head>
<?php
	$g=$_GET['g'] ?? '';
	if($g=="1") {
		$choose_locate_main=$_GET['choose_locate_main'] ?? '';
		$choose_status_main=$_GET['choose_status_main'] ?? '';
	} else {
		$choose_locate_main=$_POST['choose_locate_main'] ?? '';
		$choose_status_main=$_POST['choose_status_main'] ?? '';
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
                <li class="active">ตรวจนับครุภัณฑ์</li>
              </ul><!-- /.breadcrumb -->

            </div>

            <div class="page-content">
							<?php
															$sql_year="SELECT * FROM data_config order by year_budget desc";
															$query_year=ams_query($link,$sql_year);
																$total_qr_config=mysqli_num_rows($query_year);
															  $result_year=mysqli_fetch_array($query_year);
															  	$year_budget=$result_year['year_budget'];
																	$status_con=$result_year['status'];

																	$var_page=$_GET['var_page'] ?? '';
							?>

                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                                    <div >
																			<input type="hidden" name="year_budget" value="<?php echo $year_budget; ?>">
                                      <table class="table9 table-striped table-bordered table-hover">
                                        <thead>

                                          <tr>
                                            <td class="head_blue" colspan="15"> :: ปีงบประมาณ : <font color="#e8f652" size="2"><b><?php echo $year_budget; ?></b></font>
																							<?php if($var_page!="") { ?>
																								&nbsp;&nbsp;&nbsp;&nbsp; ชุดที่ &nbsp;:&nbsp; <font color="#e8f652" size="2"><b><?php echo $var_page; ?></b></font>

																								<?php
																								if($var_page!="") {
																								$sql_def_ch=ams_sql("SELECT * FROM data_number_check where year_budget=? and number_etc='0' and number_check=?", ["$year_budget", "$var_page"]);
																								$qr_def_ch=ams_query($link,$sql_def_ch);
																								$total_def_ch=mysqli_num_rows($qr_def_ch);
																								 if($total_def_ch!=0) {
																									$rs_def_ch=mysqli_fetch_array($qr_def_ch);
																									$id_member_check_ch=$rs_def_ch['id_member_check'];

																											$sql_mem_list=ams_sql("SELECT * FROM member where id=?", ["$id_member_check_ch"]);
																											$qr_mem_list=ams_query($link,$sql_mem_list);
																												$rs_mem_list=mysqli_fetch_array($qr_mem_list);
																												$name_mem_list=$rs_mem_list['name'];
																												$surname_mem_list=$rs_mem_list['surname'];
																								 }
																								?>
																								&nbsp;&nbsp;&nbsp;&nbsp; ผู้ดำเนินการตรวจนับ &nbsp;:&nbsp;
																								<font color="#e8f652" size="2"><b><?php echo $name_mem_list; ?>&nbsp;&nbsp;<?php echo $surname_mem_list; ?></b></font>
																							<?php } ?>
																							<?php } ?>
																						</td>
                                          </tr>

										  <tr>
                            <td  colspan="15">


															<?php
															$sql_def_number=ams_sql("SELECT * FROM data_number_check where year_budget=? and number_etc='0' and id_member_check=?", ["$year_budget", "$id_member"]);
															$qr_def_number=ams_query($link,$sql_def_number);
															$total_def_number=mysqli_num_rows($qr_def_number);
															 if($total_def_number!=0) {
																$rs_def_number=mysqli_fetch_array($qr_def_number);
																$number_def_check=$rs_def_number['number_check'];
															}
															?>


																						<div class="pull-left">
																							<?php
																							$sql_show_number=ams_sql("SELECT * FROM data_number_check where year_budget=? and number_etc='0' group by number_check order by number_check", ["$year_budget"]);
																							$qr_show_number=ams_query($link,$sql_show_number);
																							$total_show_number=mysqli_num_rows($qr_show_number);
																							if($total_show_number!=0) {
																							$i_show_number=0;
																							while ($i_show_number<$total_show_number) {
																								$rs_show_number=mysqli_fetch_array($qr_show_number);
																								$number_check=$rs_show_number['number_check'];
																								$id_member_check=$rs_show_number['id_member_check'];
																								$var_i=$i_show_number+1;
																							?>
																								<a href="data_check.php?d5=1&var_page=<?php echo $number_check; ?>" target="_parent" >
																									<?php if($id_member==$id_member_check) { ?>
																										<button class="btn bg-olive" type="button"><?php echo $number_check; ?></button>
																							    <?php } else { ?>
																										<?php if($var_i==$var_page) { ?>
																											<button class="btn bg-sky4" type="button"><?php echo $number_check; ?></button>
																										<?php } else { ?>
																											<button class="btn" type="button"><?php echo $number_check; ?></button>
																										<?php } ?>
																									<?php } ?>
																                </a>
																							<?php
																								$i_show_number++;
																							}
																						}

																							?>
																						</div>

																						<form action="data_check.php" method="post" name="form_locate">
																						<input type="hidden" name="d51" value="1">
																						<div class="pull-right">
																						<?php if($var_page=="") { ?>
																						<select class="form-control" name="choose_locate_main" style="background-color:#f4f9fc;font-size:13px;" onChange="submit();">
																						<?php } else { ?>
																							<?php if($var_page==$number_def_check) { ?>
																								<select class="form-control" name="choose_locate_main" style="background-color:#f4f9fc;font-size:13px;" onChange="submit();">
																								<?php } else { ?>
																								<select class="form-control" name="choose_locate_main" style="background-color:#e4e5e6;font-size:13px;" disabled>
																								<?php } ?>
																						<?php } ?>
																							<?php
																							if($choose_locate_main!="") {
																							$sql_locate_m = ams_sql("select * from  data_location where id=?", ["$choose_locate_main"]);
																							$q_locate_m=ams_query($link,$sql_locate_m) or die ("เลือกข้อมูลไม่ได้");
																												$rs_locate_m=mysqli_fetch_array($q_locate_m);
																												$id_locate_m=$rs_locate_m['id'];
																												$name_locate_m=$rs_locate_m['name_location'];
																							?>
																							<option value="<?php echo $id_locate_m;?>" selected><?php echo $name_locate_m;?></option>
																							<option value="">---สถานที่ใช้งาน---</option>
																						<?php } else { ?>
																							<option value="" selected>---สถานที่ใช้งาน---</option>
																						<?php } ?>
																							<?php
																							$sql_locate_m_list = "select * from  data_location order by name_location ";
																							$q_locate_m_list=ams_query($link,$sql_locate_m_list) or die ("เลือกข้อมูลไม่ได้");
																							$num_locate_m_list=mysqli_num_rows($q_locate_m_list);
																							$i_locate_list=0;
																										while($i_locate_list<$num_locate_m_list) {
																												$rs_locate_m_list=mysqli_fetch_array($q_locate_m_list);
																												$id_locate_m_list=$rs_locate_m_list['id'];
																												$name_locate_m_list=$rs_locate_m_list['name_location'];
																							?>
																							<option value="<?php echo $id_locate_m_list; ?>"><?php echo $name_locate_m_list; ?></option>
																							<?php $i_locate_list++; } ?>
																						</select>
																					  </div>
																						<div class="pull-right" style="padding:2px;"></div>
																						<div class="pull-right">
																						<?php if($var_page=="") { ?>
																						<select class="form-control" name="choose_status_main" style="background-color:#f4f9fc;font-size:13px;" onChange="submit();">
																						<?php } else { ?>
																							<?php if($var_page==$number_def_check) { ?>
																						<select class="form-control" name="choose_status_main" style="background-color:#f4f9fc;font-size:13px;" onChange="submit();">
																						<?php } else { ?>
																						<select class="form-control" name="choose_status_main" style="background-color:#e4e5e6;font-size:13px;" disabled>
																						<?php } ?>
																						<?php } ?>
						<?php if($choose_status_main=="") { ?><option value="" selected>---สถานะตรวจ---</option><?php } else { ?><option value="">---สถานะตรวจ---</option><?php } ?>
						<?php if($choose_status_main=="1") { ?><option value="1" selected>ตรวจนับแล้ว</option><?php } else { ?><option value="1">ตรวจนับแล้ว</option><?php } ?>
						<?php if($choose_status_main=="2") { ?><option value="2" selected>ยังไม่ได้ตรวจนับ</option><?php } else { ?><option value="2">ยังไม่ได้ตรวจนับ</option><?php } ?>
																						</select>
																					  </div>

																					  </form>
																						<?php if($var_page=="" || $var_page==$number_def_check) { ?>
																						<form action="data_check_view.php?choose_status_main=<?php echo $choose_status_main;?>&choose_locate_main=<?php echo $choose_locate_main;?>" method="post" target="_blank"><div class="pull-right" style="padding:2px;"></div>
																							<div class="pull-right">
																							<button type="submit" class="btn bg-sky3"><i class="ace-icon fa fa-file-text"></i></button>
																						  </div>
																						</form>
																					  <?php } ?>

																						</td>
                                          </tr>


                                          <tr>
                                            <th class="center font_brown70 hidden-1000"> ลำดับ. </th>
                                            <th class="center font_brown70">เลขครุภัณฑ์</th>
                                            <th class="center font_brown70">รายการ</th>
                                            <th class="center font_brown70 hidden-1000">ยี่ห้อ</th>
                                            <th class="center font_brown70 hidden-1000">สถานที่ใช้งาน</th>
																						<th class="center font_brown70 hidden-1000">ผู้ใช้งาน</th>
                                            <th class="center font_brown70 hidden-1000">สถานะ</th>
																						<?php if($status_con=="1") { ?>
																						<?php if($var_page=="" || $var_page==$number_def_check) { ?>
																						<th class="center font_brown70">สถานะ</th>
																						<th class="center font_brown70">สถานที่ใช้งาน</th>
																						<th class="center font_brown70">ผู้ใช้งาน</th>
																						<th class="center font_brown70">หมายเหตุ</th>
																						<th class="center font_brown70"></th>
																					<?php } ?>
																					<?php } ?>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php

																					if($var_id=="") {
																						if($choose_status_main!="") {
																							if($choose_locate_main!="") {
																								$q=ams_sql("SELECT * FROM data_staff_choose where year_budget=? and id_member_choose=? and status=? and id_location_old=?", ["$year_budget", "$id_member", "$choose_status_main", "$choose_locate_main"]);
																							} else {
																								$q=ams_sql("SELECT * FROM data_staff_choose where year_budget=? and id_member_choose=? and status=?", ["$year_budget", "$id_member", "$choose_status_main"]);
																							}
																						} else {
																							if($choose_locate_main!="") {
																								$q=ams_sql("SELECT * FROM data_staff_choose where year_budget=? and id_member_choose=? and id_location_old=?", ["$year_budget", "$id_member", "$choose_locate_main"]);
																							} else {
																								$q=ams_sql("SELECT * FROM data_staff_choose where year_budget=? and id_member_choose=?", ["$year_budget", "$id_member"]);
																							}
																						}
																					} else {
																						if($choose_status_main!="") {
																							if($choose_locate_main!="") {
																								$q=ams_sql("SELECT * FROM data_staff_choose where year_budget=? and id_member_choose=? and status=? and id_location_old=?", ["$year_budget", "$var_id", "$choose_status_main", "$choose_locate_main"]);
																							} else {
																								$q=ams_sql("SELECT * FROM data_staff_choose where year_budget=? and id_member_choose=? and status=?", ["$year_budget", "$var_id", "$choose_status_main"]);
																							}
																						} else {
																							if($choose_locate_main!="") {
																								$q=ams_sql("SELECT * FROM data_staff_choose where year_budget=? and id_member_choose=? and id_location_old=?", ["$year_budget", "$var_id", "$choose_locate_main"]);
																							} else {
																								$q=ams_sql("SELECT * FROM data_staff_choose where year_budget=? and id_member_choose=?", ["$year_budget", "$var_id"]);
																							}
																						}
																					}

																					$qr=ams_query($link,$q);
																					$total2=mysqli_num_rows($qr);


																					if($total2!=0){
																							$i=1;
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
																						?>
																						<?php if($total_list!=0) { ?>
                                          <tr>
                                            <td class="center font_brown hidden-1000" style="vertical-align:middle;"><?php echo $i; ?>.</td>
                                            <td class="center font_brown" style="vertical-align:middle;"><?php echo $barcode2; ?></td>
                                            <td class="font_brown" style="vertical-align:middle;">
																							<a  href="detail_data.php?id=<?php echo $data_det; ?>" class="fancybox fancybox.ajax"><?php echo $lda_list; ?></a>
																						</td>
																						<td class="font_brown hidden-1000" style="vertical-align:middle;"><?php echo $lda_brand; ?></td>
																						<td class="center font_brown hidden-1000" style="vertical-align:middle;">
																							<?php
																							$sql_locate = ams_sql("select * from  data_location where id=? ", ["$id_location"]);
																							$qr_locate=ams_query($link,$sql_locate) or die ("เลือกข้อมูลไม่ได้");
																							$rs_locate=mysqli_fetch_array($qr_locate);
																							$name_locate=$rs_locate['name_location'];
																							 ?>
																							<?php echo $name_locate; ?>
																						</td>
																						<td class="center font_brown hidden-1000" style="vertical-align:middle;"><?php echo $name_use; ?></td>
                                            <?php if ($lda_status=="1") { ?>
                                              	<td class="center hidden-1000" bgcolor="#49ac8b" style="vertical-align:middle;"><font color="#FFFFFF">ใช้งานปกติ</font> </td><?php } elseif($lda_status=="2") { ?>
																								<td class="center hidden-1000" bgcolor="#d15b47" style="vertical-align:middle;"><font color="#FFFFFF">ชำรุด</font></td><?php } elseif($lda_status=="3") { ?>
																								<td class="center hidden-1000" bgcolor="#d15b47" style="vertical-align:middle;"><font color="#FFFFFF">สูญหาย</font></td><?php } elseif($lda_status=="4") { ?>
																								<td class="center hidden-1000" bgcolor="#d15b47" style="vertical-align:middle;"><font color="#FFFFFF">โอนย้าย / บริจาค</font></td><?php } elseif($lda_status=="5") { ?>
																								<td class="center hidden-1000" bgcolor="#d15b47" style="vertical-align:middle;"><font color="#FFFFFF">จำหน่ายออก</font></td><?php } elseif($lda_status=="6") { ?>
																								<td class="center hidden-1000" bgcolor="#d15b47" style="vertical-align:middle;"><font color="#FFFFFF">ส่งซ่อม</font></td><?php } elseif($lda_status=="7") { ?>
																								<td class="center hidden-1000" bgcolor="#d15b47" style="vertical-align:middle;"><font color="#FFFFFF">สภาพปกติ ไม่จำเป็นต้องใช้งาน</font></td><?php } ?>
                                            </td>

																						<!-- Start form -->
																						<?php if($status_con=="1") { ?>
																						<form name="form_choose" method="post" action="add_data_check.php">
																						<?php if($var_page=="" || $var_page==$number_def_check) { ?>

																						<td class="font_brown center" style="vertical-align:middle;">
																							<?php if($rs['status']==2) { ?>
												                      <select name="choose_status" style="background-color:#f4f9fc;font-size:13px;" class="form-control">
																									<?php if($lda_status=="1") { ?><option value="1" selected>ใช้งานปกติ</option><?php } else { ?><option value="1">ใช้งานปกติ</option><?php } ?>
																									<?php if($lda_status=="2") { ?><option value="2" selected>ชำรุด</option><?php } else { ?><option value="2">ชำรุด</option><?php } ?>
																									<?php if($lda_status=="7") { ?><option value="7" selected>สภาพปกติ ไม่จำเป็นต้องใช้งาน</option><?php } else { ?><option value="7">สภาพปกติ ไม่จำเป็นต้องใช้งาน</option><?php } ?>
												                      </select>
																						<?php } else { ?>
																							<?php if ($lda_status=="1") { ?>ใช้งานปกติ
																							<?php } elseif($lda_status=="2") { ?>ชำรุด
																							<?php } elseif($lda_status=="7") { ?>สภาพปกติ ไม่จำเป็นต้องใช้งาน
																							<?php } ?>
																						<?php } ?>
																						</td>
																						<td class="font_brown center" style="vertical-align:middle;">
																							<?php if($rs['status']==2) { ?>
																							<select class="form-control" name="choose_locate" style="background-color:#f4f9fc;font-size:13px;">
																								<?php
																								$sql_locate_select = ams_sql("select * from  data_location where id=?", ["$id_location"]);
																								$qr_locate_select=ams_query($link,$sql_locate_select) or die ("เลือกข้อมูลไม่ได้");
																													$rs_locate_select=mysqli_fetch_array($qr_locate_select);
																													$id_locate_select=$rs_locate_select['id'];
																													$name_location_select=$rs_locate_select['name_location'];
																								?>

																								<option value="<?php echo $id_locate_select;?>" selected><?php echo $name_location_select;?></option>
																								<option value="">------------</option>
																								<?php
																								$sql_locate = "select * from  data_location order by name_location ";
																								$qr_locate=ams_query($link,$sql_locate) or die ("เลือกข้อมูลไม่ได้");
																								ams_query($link, "SET NAMES UTF8");
																								$num_locate=mysqli_num_rows($qr_locate);
																								$i_lc=0;
																											while($i_lc<$num_locate) {
																													$rs_locate=mysqli_fetch_array($qr_locate);
																													$id_locate=$rs_locate['id'];
																													$name_location=$rs_locate['name_location'];
																								?>
																								<option value="<?php echo $id_locate; ?>"><?php echo $name_location; ?></option>
																								<?php $i_lc++; } ?>
																							</select>
																							<?php } else {
																								$sql_locate_select = ams_sql("select * from  data_location where id=?", ["$id_location"]);
																								$qr_locate_select=ams_query($link,$sql_locate_select) or die ("เลือกข้อมูลไม่ได้");
																													$rs_locate_select=mysqli_fetch_array($qr_locate_select);
																													$id_locate_select=$rs_locate_select['id'];
																													$name_location_select=$rs_locate_select['name_location'];
																								echo $name_location_select; }
																								?>
																						</td>
																						<td class="font_brown" style="vertical-align:middle;">
																							<?php if($rs['status']==2) { ?>
																							<input type="text" class="form-control" style="font-size:13px;background-color:#f4f9fc;" value="<?php echo $name_use; ?>" name="txt_name" maxlength="100">
																							<?php } else { echo $name_use; } ?>
																						</td>
																						<td class="font_brown" style="vertical-align:middle;">
																							<?php if($rs['status']==2) { ?>
																							<input type="text" class="form-control" style="font-size:13px;background-color:#f4f9fc;" value="<?php echo $note; ?>" name="txt_note" maxlength="250"></td>
																							<?php } else { echo $note; } ?>
																						<?php if($rs['status']==2) { ?>
																							<td class="center"><button type="submit" class="btn btn-primary"><i class="ace-icon fa fa-check"></i></button></td>

																								<input type="hidden" name="id_staff_main" value="<?php echo $rs['id']; ?>">
																								<input type="hidden" name="id_data_lda_main" value="<?php echo $data_det; ?>">
																								<input type="hidden" name="choose_locate_main" value="<?php echo $choose_locate_main; ?>">
																								<input type="hidden" name="choose_status_main" value="<?php echo $choose_status_main; ?>">

																						<?php } else { ?>
																							<td class="center" bgcolor="#49ac8b" style="vertical-align:middle;"><font color="#FFFFFF">ตรวจแล้ว</font>&nbsp;
																							<a href="data_check_edit.php?d5=1&choose_status_main=<?php echo $choose_status_main;?>&choose_locate_main=<?php echo $choose_locate_main;?>&id=<?php echo $rs['id'];?>&g=1" method="post"><font color="#fff"><i class="ace-icon fa fa-pencil"></i></font></a>
																							</td>
																						<?php } ?>

																				<?php } ?>
																			</form>
																			<?php } ?>
																						<!-- End form -->
                                          </tr>
																				<?php } ?>

                                          <?php $i++; } ?>
                                          <?php } else { ?>
                                          <tr>
                                            <td class="center font_brown" colspan="15"><< ไม่มีข้อมูล >></td>
                                          </tr>
                                          <?php } ?>
                                        </tbody>
                                      </table>
									<input type="hidden" name="e_page" value="<?php echo $e_page; ?>">

                                    </div>
                                  </div>




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
