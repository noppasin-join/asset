<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$g = '';
$choose_staff = '';
$s_page2 = '';
$urlquery_str2 = '';
$radiobutton = '';
$chk_page2 = 0;
$before_p2 = 0;
$nClass = '';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
	$sess_user = $_SESSION['sess_user'] ?? '';
	$sess_password = $_SESSION['sess_password'] ?? '';

	require_once __DIR__ . '/con_lda.php';
	if ($sess_user == "" || $status!=0 || $level=="0") {
    ams_deny(403, 'Insufficient permissions.');
	} else {
	set_time_limit(0);


$g=$_GET['g'] ?? '';
	$choose_staff=$_GET['choose_staff'] ?? '';
	$s_page2=$_GET['s_page2'] ?? '';
	$urlquery_str2=$_GET['urlquery_str2'] ?? '';
	$radiobutton=$_GET['radiobutton'] ?? '';
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



				<?php
				// สร้างฟังก์ชั่น สำหรับแสดงการแบ่งหน้า
				function page_navigator2($plus_p2,$total2,$total_p2,$chk_page2){
				global $urlquery_str2;
				$pPrev=$chk_page2-1;
				$pPrev=($pPrev>=0)?$pPrev:0;
				$pNext=$chk_page2+1;
				$pNext=($pNext>=$total_p2)?$total_p2-1:$pNext;
				$lt_page=$total_p2-4;

				if($total_p2>=50){

				if($chk_page2>=$lt_page){
				for($i=0;$i<=4;$i++){
				$nClass=($chk_page2==($lt_page+$i-1))?"class='selectPage'":"";
				echo "<a $nClass href='?s_page2=".intval($lt_page+$i-1)."&&radiobutton=27'>".intval($lt_page+$i)."</a> ";
				}
				}
				}else{
				for($i=0;$i<$total_p2;$i++){
				$nClass=($chk_page2==$i)?"class='selectPage'":"";
				echo "<a href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=28&&s1=1' $nClass  >".intval($i+1)."</a> ";
				}
				}

				}
				?>


				<style> body { font-family: sarabun; } </style>
				<link rel="stylesheet" href="AdminLTE.min.css">
				<script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>
				<!-- Add mousewheel plugin (this is optional) -->
				<!-- Add fancyBox main JS and CSS files -->

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
                <li class="active">ตั้งค่ารายการครุภัณฑ์ที่ต้องตรวจนับ</li>
              </ul><!-- /.breadcrumb -->

            </div>

            <div class="page-content">
				<?php
															$sql_year="SELECT * FROM data_config where status='1' order by year_budget desc";
															$query_year=ams_query($link,$sql_year);
																$total_qr_config=mysqli_num_rows($query_year);
															  $result_year=mysqli_fetch_array($query_year);
															  	$year_budget=$result_year['year_budget'];
																	$staff_amount=$result_year['staff_amount'];

																	$q="SELECT * FROM data_lda where status_check='1'  order by barcode1";
																	$qr=ams_query($link,$q);
																	$total2=mysqli_num_rows($qr);

																					 //+
																					 $var_page=$total2/$staff_amount;
																					 $e_page=floor($var_page);

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


                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                                    <div ><form action="add_list_staff.php" name="form_select" method="post">
																			<input type="hidden" name="year_budget" value="<?php echo $year_budget; ?>">
                                      <table class="table9 table-striped table-bordered table-hover">
                                        <thead>
																					<?php if($total_qr_config!="0") { ?>
                                          <tr>
                                            <td class="head_blue" colspan="15"> :: ปีงบประมาณ : <font color="#e8f652" size="2"><?php echo $year_budget; ?></font> |
																							จำนวน จนท. ตรวจรับ : <font color="#e8f652" size="2"> <?php echo $staff_amount; ?></font> คน |
																							รายการครุภัณฑ์ : <font color="#e8f652" size="2"> <?php echo number_format( $total2 ); ?></font> รายการ
																						</td>
                                          </tr>

										  <tr>
                                            <td  colspan="15">


																		<div class="pull-left pagination9">
																			<li>
																				<?php page_navigator2($plus_p2,$total2,$total_p2,$chk_page2); ?>
																			</li>
																		</div>



																						<?php
																						$send_page=$chk_page2+1;
																						$sql_number = ams_sql("select * from  data_number_check where number_check=? and number_etc='0' and year_budget=?", ["$send_page", "$year_budget"]);
																						$qr_number=ams_query($link,$sql_number) or die ("Error Number Check");
																							$num_number=mysqli_num_rows($qr_number);
																						?>

																							<input type="hidden" name="send_page" value="<?php echo $send_page; ?>">
																							<input type="hidden" name="s_page2" value="<?php echo $s_page2; ?>">
																							<input type="hidden" name="urlquery_str2" value="<?php echo $urlquery_str2; ?>">
																							<input type="hidden" name="chk_page2" value="<?php echo $chk_page2; ?>">
																							<input type="hidden" name="e_page" value="<?php echo $e_page; ?>">

																						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																						ชุดที่ : <?php echo $send_page; ?> &nbsp;

																						<?php if($num_number=="0") { ?>
																							<select name="choose_staff" style="font-size:13px;height:32px;" >
																									<option value="" selected>---------------</option>
																								<?php
																									$sql_sff = "select * from  member order by name ";
																									$dbquery_sff=ams_query($link,$sql_sff) or die ("เลือกข้อมูลไม่ได้");
																										$num_rows_sff=mysqli_num_rows($dbquery_sff);
																										$i_sff=0;
																										while($i_sff<$num_rows_sff)
																										{
																												$result_sff=mysqli_fetch_array($dbquery_sff);
																												$id_sff=$result_sff['id'];
																												$name_sff=$result_sff['name'];
																												$surname_sff=$result_sff['surname'];


																													if($send_page>$staff_amount) {

																																?>
																																<option value="<?php echo $id_sff; ?>"><?php echo $name_sff; ?> <?php echo $surname_sff; ?></option>
																																<?php

																													} else {
																														$sql_nbc = ams_sql("select * from  data_number_check where id_member_check=? and number_etc='0' and year_budget=?  ", ["$id_sff", "$year_budget"]);
																														$qr_nbc=ams_query($link,$sql_nbc) or die ("เลือกข้อมูลไม่ได้");
																															$num_nbc=mysqli_num_rows($qr_nbc);
																															if($num_nbc=="0") {

																														?>
																														<option value="<?php echo $id_sff; ?>"><?php echo $name_sff; ?> <?php echo $surname_sff; ?></option>
																														<?php
																														}
																													 }

																														?>





																								   <?php
																								   $i_sff++;
																							     }
																								   ?>
																							</select>
																						<?php } else {  ?>
																						<!-- Check Number -->
																						<?php if($chk_page2==$staff_amount) { ?>

																							<select name="choose_staff" style="font-size:13px;height:32px;" >
																								<?php if($choose_staff=="") { ?>
																									<option value="" selected>---------------</option>
																								<?php } else { ?>
																									<option value="">---------------</option>
																								<?php } ?>
																								<?php
																									$sql_sff = "select * from  member  order by name ";
																									$dbquery_sff=ams_query($link,$sql_sff) or die ("เลือกข้อมูลไม่ได้");
																										$num_rows_sff=mysqli_num_rows($dbquery_sff);
																										$i_sff=0;
																										while($i_sff<$num_rows_sff)
																										{
																												$result_sff=mysqli_fetch_array($dbquery_sff);
																												$id_sff=$result_sff['id'];
																												$name_sff=$result_sff['name'];
																												$surname_sff=$result_sff['surname'];

																								?>
																												<option value="<?php echo $id_sff; ?>"><?php echo $name_sff; ?> <?php echo $surname_sff; ?></option>
																										<?php $i_sff++; } ?>
																							</select>

																						<?php } else { ?>
																							<?php
																									$result_number=mysqli_fetch_array($qr_number);
																									$id_member_check=$result_number['id_member_check'];
																									$sql_sff = ams_sql("select * from  member where id=? ", ["$id_member_check"]);
																									$dbquery_sff=ams_query($link,$sql_sff) or die ("Error Show Member");
																												$result_sff=mysqli_fetch_array($dbquery_sff);
																												$id_sff=$result_sff['id'];
																												$name_sff=$result_sff['name'];
																												$surname_sff=$result_sff['surname'];
																							?>
																							<select name="choose_staff" style="font-size:13px;height:32px;background-color:#f1f9f2;"  disabled>
																								<option value="<?php echo $id_sff; ?>"><?php echo $name_sff; ?> <?php echo $surname_sff; ?></option>
																							</select>

																						<?php } ?>
																						<!-- End Check Number -->
																					<?php } ?>

																						<?php if($num_number=="0" || $chk_page2==$staff_amount) { ?>
																							<button type="submit" class="btn btn-primary pull-right">บันทึกข้อมูล</button>
																						<?php } ?>

																						</td>
                                          </tr>
																				<?php } ?>
                                          <tr>
                                            <th class="center font_brown70"> ลำดับ. </th>
                                            <th class="center font_brown70">เลขครุภัณฑ์</th>
                                            <th class="center font_brown70 hidden-1100">ปี</th>
                                            <th class="center font_brown70">รายการ</th>
                                            <th class="center font_brown70 hidden-1000">ยี่ห้อ</th>
                                            <th class="center font_brown70 hidden-1200">ราคา</th>
                                            <th class="center font_brown70">สถานที่ใช้งาน</th>
                                            <th class="center font_brown70">ผู้ใช้งาน</th>
                                            <th class="center font_brown70">สถานะ</th>
																						<th class="center font_brown70 hidden-1100">หมวดหมู่</th>
																						<?php if($chk_page2==$staff_amount) { ?>
                                            <th class="center font_brown70 hidden-800" >เลือก</th>
																					<?php } ?>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php




																					if($total2!=0){
																							$i=1;
																							while($rs=mysqli_fetch_array($qr))
																					{
                                            ?>
                                          <tr>
                                            <td class="center font_brown"><?php echo number_format(($chk_page2*$e_page)+$i); ?>.</td>
                                            <td class="center font_brown"><?php echo $rs['barcode2']; ?></td>
                                            <td class="center font_brown hidden-1100"><?php echo $rs['lda_year']; ?></td>
																						<td class="font_brown"><?php echo $rs['lda_list']; ?></td>
																						<td class="font_brown hidden-1000"><?php echo $rs['lda_brand']; ?></td>
																						<td class="font_brown hidden-1200" style="text-align:right;"><?php echo number_format( $rs['price'] , 2 ) ; ?></td>
																						<td class="center font_brown">
																							<?php
																													$sql_locate = ams_sql("select * from  data_location where id=? ", ["$rs[id_location]"]);
																													$qr_locate=ams_query($link,$sql_locate) or die ("เลือกข้อมูลไม่ได้");
																													$rs_locate=mysqli_fetch_array($qr_locate);
																													$name_locate=$rs_locate['name_location'];
																							?>
																							<?php echo $name_locate; ?>
																						</td>
																						<td class="font_brown"><?php echo $rs['name_use']; ?></td>
                                            <?php if ($rs['lda_status']=="1") { ?>
                                              	<td class="center" bgcolor="#49ac8b"><font color="#FFFFFF">ใช้งานปกติ</font> </td><?php } elseif($rs['lda_status']=="2") { ?>
																								<td class="center" bgcolor="#d15b47"><font color="#FFFFFF">ชำรุด</font></td><?php } elseif($rs['lda_status']=="3") { ?>
																								<td class="center" bgcolor="#d15b47"><font color="#FFFFFF">สูญหาย</font></td><?php } elseif($rs['lda_status']=="4") { ?>
																								<td class="center" bgcolor="#d15b47"><font color="#FFFFFF">โอนย้าย / บริจาค</font></td><?php } elseif($rs['lda_status']=="5") { ?>
																								<td class="center" bgcolor="#d15b47"><font color="#FFFFFF">จำหน่ายออก</font></td><?php } elseif($rs['lda_status']=="6") { ?>
																								<td class="center" bgcolor="#d15b47"><font color="#FFFFFF">ส่งซ่อม</font></td><?php } elseif($rs['lda_status']=="7") { ?>
																								<td class="center" bgcolor="#d15b47"><font color="#FFFFFF">สภาพปกติ ไม่จำเป็นต้องใช้งาน</font></td><?php } elseif($rs['lda_status']=="8") { ?>
																								<td class="center" bgcolor="#d15b47"><font color="#FFFFFF">รอจำหน่ายออก</font></td>
																						<?php } ?>
                                            </td>
																						<td class="center font_brown hidden-1100">
																							<?php
																													$sql_cat_list = ams_sql("select * from  category where id=? ", ["$rs[id_category]"]);
																													$qr_cat_list=ams_query($link,$sql_cat_list) or die ("เลือกข้อมูลไม่ได้");
																													$rs_cat_list=mysqli_fetch_array($qr_cat_list);
																													$name_category_list=$rs_cat_list['name_category'];
																							?>
																							<?php echo $name_category_list; ?>
																						</td>

																						<?php if($chk_page2==$staff_amount) { ?>
																							<?php
																							$sql_check = ams_sql("select * from  data_staff_choose where id_data_lda=? and number_check=?  ", ["$rs[id]", "$send_page"]);
																							$qr_check=ams_query($link,$sql_check) or die ("เลือกข้อมูลไม่ได้");
																								$num_check=mysqli_num_rows($qr_check);
																								$result_sff6=mysqli_fetch_array($qr_check);
																								$id_member_choose5=$result_sff6['id_member_choose'];
																							 ?>
                                            <td class="center font_brown">
																							<?php if ($num_check=="0") { ?>
																								<input type="checkbox" name="chkDel[]" value="<?php echo $rs['id'];?>">
																							<?php } else { ?>
																								<?php
																								$sql_sff5 = ams_sql("select * from  member where id=? ", ["$id_member_choose5"]);
																								$dbquery_sff5=ams_query($link,$sql_sff5) or die ("Error Show Member");
																											$result_sff5=mysqli_fetch_array($dbquery_sff5);
																											$name_sff5=$result_sff5['name'];
																								 ?>
																								<?php echo $name_sff5; ?>
																							<?php } ?>
                                            </td>
																					<?php } else { ?>

																							<input type="hidden" name="chkDel[]" value="<?php echo $rs['id'];?>" checked>

																					<?php } ?>

                                          </tr>

                                          <?php $i++; } ?>
                                          <?php } else { ?>
                                          <tr>
                                            <td class="center font_brown" colspan="15"><< ไม่มีข้อมูล >></td>
                                          </tr>
                                          <?php } ?>
                                        </tbody>
                                      </table>
									<input type="hidden" name="e_page" value="<?php echo $e_page; ?>">
									</form>

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
