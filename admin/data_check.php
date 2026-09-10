<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$g = '';
$choose_location = '';
$s_page2 = '';
$urlquery_str2 = '';
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

				<?php
				// สร้างฟังก์ชั่น สำหรับแสดงการแบ่งหน้า
				function page_navigator2($before_p2,$plus_p2,$total2,$total_p2,$chk_page2,$d5,$choose_location,$g){
				global $urlquery_str2;
				$pPrev=$chk_page2-1;
				$pPrev=($pPrev>=0)?$pPrev:0;
				$pNext=$chk_page2+1;
				$pNext=($pNext>=$total_p2)?$total_p2-1:$pNext;
				$lt_page=$total_p2-4;
				if($chk_page2>0){
				echo "<a  href='?s_page2=$pPrev&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&d5=1&&choose_location=$choose_location&&g=1' class='naviPN'><<</a>";
				}
				if($total_p2>=11){
				if($chk_page2>=4){
				echo "<a $nClass href='?s_page2=0&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&d5=1&&choose_location=$choose_location&&g=1'>1</a><a class='SpaceC'>. . .</a>";
				}
				if($chk_page2<4){
				for($i=0;$i<$total_p2;$i++){
				$nClass=($chk_page2==$i)?"class='selectPage'":"";
				if($i<=4){
				echo "<a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&d5=1&&choose_location=$choose_location&&g=1'>".intval($i+1)."</a> ";
				}
				if($i==$total_p2-1 ){
				echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&d5=1&&choose_location=$choose_location&&g=1'>".intval($i+1)."</a> ";
				}
				}
				}
				if($chk_page2>=4 && $chk_page2<$lt_page){
				$st_page=$chk_page2-3;
				for($i=1;$i<=5;$i++){
				$nClass=($chk_page2==($st_page+$i))?"class='selectPage'":"";
				echo "<a $nClass href='?s_page2=".intval($st_page+$i)."&&radiobutton=2&&d5=1&&choose_location=$choose_location&&g=1'>".intval($st_page+$i+1)."</a> ";
				}
				for($i=0;$i<$total_p2;$i++){
				if($i==$total_p2-1 ){
				$nClass=($chk_page2==$i)?"class='selectPage'":"";
				echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&d5=1&&choose_location=$choose_location&&g=1'>".intval($i+1)."</a> ";
				}
				}
				}
				if($chk_page2>=$lt_page){
				for($i=0;$i<=4;$i++){
				$nClass=($chk_page2==($lt_page+$i-1))?"class='selectPage'":"";
				echo "<a $nClass href='?s_page2=".intval($lt_page+$i-1)."&&radiobutton=2&&d5=1&&choose_location=$choose_location&&g=1'>".intval($lt_page+$i)."</a> ";
				}
				}
				}else{
				for($i=0;$i<$total_p2;$i++){
				$nClass=($chk_page2==$i)?"class='selectPage'":"";
				echo "<a href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&d5=1&&choose_location=$choose_location&&g=1' $nClass  >".intval($i+1)."</a> ";
				}
				}
				if($chk_page2<$total_p2-1){
				echo "<a href='?s_page2=$pNext&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&d5=1&&choose_location=$choose_location&&g=1'  class='naviPN'>>></a>";
				}
				}
				?>


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
		$choose_location=$_GET['choose_location'] ?? '';
		$s_page2=$_GET['s_page2'] ?? '';
		$urlquery_str2=$_GET['urlquery_str2'] ?? '';
	} else {
		$choose_location=$_POST['choose_location'] ?? '';
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
				<?php
												$sql_year="SELECT * FROM data_config order by year_budget desc";
												$query_year=ams_query($link,$sql_year);
													$total_qr_config=mysqli_num_rows($query_year);
													$result_year=mysqli_fetch_array($query_year);
														$year_budget=$result_year['year_budget'];
														$status_con=$result_year['status'];

				?>

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


							<div class="pull-right" style="padding-top:5px;">
								<form action="data_check.php" method="post" name="form_locate">
								<input type="hidden" name="d51" value="1">

							<select class="form-control" name="choose_location" style="background-color:#f4f9fc;font-size:13px;" onChange="submit();">
								<?php
								if($choose_location!="") {
								$sql_locate_m = ams_sql("SELECT * from  data_check_config where id=? and id_member=? and year_budget=?", ["$choose_location", "$id_member", "$year_budget"]);
								$q_locate_m=ams_query($link,$sql_locate_m) or die ("เลือกข้อมูลไม่ได้");
													$rs_locate_m=mysqli_fetch_array($q_locate_m);
													$id_locate_m=$rs_locate_m['id'];
													$id_lc_3=$rs_locate_m['id_location'];
													$sql_lc_3 = ams_sql("SELECT * from  data_location where id=?", ["$id_lc_3"]);
													$qr_lc_3=ams_query($link,$sql_lc_3) or die ("เลือกข้อมูลไม่ได้");
																		$rs_lc_3=mysqli_fetch_array($qr_lc_3);
																		$name_lo_3=$rs_lc_3['name_location'];
								?>
								<option value="<?php echo $id_locate_m;?>" selected><?php echo $name_lo_3;?></option>
								<option value="">---สถานที่ใช้งาน---</option>
							<?php } else { ?>
								<?php
								$sql_locate_m4 = ams_sql("SELECT * from  data_check_config where id_member=? and year_budget=? order by id_location", ["$id_member", "$year_budget"]);
								$q_locate_m4=ams_query($link,$sql_locate_m4) or die ("เลือกข้อมูลไม่ได้");
													$rs_locate_m4=mysqli_fetch_array($q_locate_m4);
													$id_locate_m4=$rs_locate_m4['id'];
													$id_lc_4=$rs_locate_m4['id_location'];
													$sql_lc_4 = ams_sql("SELECT * from  data_location where id=?", ["$id_lc_4"]);
													$qr_lc_4=ams_query($link,$sql_lc_4) or die ("เลือกข้อมูลไม่ได้");
																		$rs_lc_4=mysqli_fetch_array($qr_lc_4);
																		$name_lo_4=$rs_lc_4['name_location'];
								?>
								<option value="<?php echo $id_locate_m4;?>" selected><?php echo $name_lo_4;?></option>
								<option value="">---สถานที่ใช้งาน---</option>
							<?php } ?>
								<?php
								$sql_lc = ams_sql("SELECT * from  data_check_config where id_member=? and year_budget=?", ["$id_member", "$year_budget"]);
								$qr_lc=ams_query($link,$sql_lc) or die ("เลือกข้อมูลไม่ได้");
								$num_lc=mysqli_num_rows($qr_lc);
								$i_lc=0;
											while($i_lc<$num_lc) {
													$rs_lc=mysqli_fetch_array($qr_lc);
													$id_m=$rs_lc['id'];
													$id_lc=$rs_lc['id_location'];
													$sql_lc_2 = ams_sql("SELECT * from  data_location where id=?", ["$id_lc"]);
													$qr_lc_2=ams_query($link,$sql_lc_2) or die ("เลือกข้อมูลไม่ได้");
																		$rs_lc_2=mysqli_fetch_array($qr_lc_2);
																		$name_lo_2=$rs_lc_2['name_location'];
								?>
								<option value="<?php echo $id_m; ?>"><?php echo $name_lo_2; ?></option>
								<?php $i_lc++; } ?>
							</select>
						</form>
							</div>
							<div class="pull-right" style="padding:2px;"></div>



								<div class="pull-right">
									<form action="data_check_view.php?choose_location=<?php echo $choose_location;?>" method="post" target="_blank"><div class="pull-right" style="padding:2px;"></div>
								<button type="submit" class="btn bg-sky3"><i class="ace-icon fa fa-file-text"></i></button>
							</form>
								</div>

            </div>

            <div class="page-content">

                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                                    <div >
																			<input type="hidden" name="year_budget" value="<?php echo $year_budget; ?>">
                                      <table class="table9 table-striped table-bordered table-hover">
                                        <thead>

                                          <tr>
                                            <td class="head_blue" colspan="15"> :: ปีงบประมาณ : <font color="#e8f652" size="2"><b><?php echo $year_budget; ?></b></font>
																						</td>
                                          </tr>




                                          <tr>
                                            <th class="center font_brown70 hidden-1000" colspan="2"> ลำดับ.</th>
                                            <th class="center font_brown70">เลขครุภัณฑ์</th>
																						<th class="center font_brown70">เลขครุภัณฑ์ (LIB)</th>
                                            <th class="center font_brown70">รายการ</th>
                                            <th class="center font_brown70 hidden-1000">ยี่ห้อ</th>
																						<th class="center font_brown70">สถานะ</th>
																						<th class="center font_brown70">สถานที่ใช้งาน</th>
																						<th class="center font_brown70">ผู้ใช้งาน</th>
																						<th class="center font_brown70">หมายเหตุ</th>
																						<th class="center font_brown70">ผู้ตรวจ</th>
																						<th class="center font_brown70"></th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php
if($choose_location=="") {
	$q_2=ams_sql("SELECT * FROM data_check_config where year_budget=? and id_member=? and id=? order by id_location", ["$year_budget", "$id_member", "$id_locate_m4"]);
} else {
	$q_2=ams_sql("SELECT * FROM data_check_config where year_budget=? and id_member=? and id=? order by id_location", ["$year_budget", "$id_member", "$choose_location"]);
}
$qr_2=ams_query($link,$q_2);
$total_2=mysqli_num_rows($qr_2);
$rs_2=mysqli_fetch_array($qr_2);
$id_locate_2=$rs_2['id_location'];
		if($total_2!=0){
					$q = ams_sql("SELECT * from  data_check where id_location_old=? and year_budget=? order by barcode3 ", ["$id_locate_2", "$year_budget"]);
					$qr=ams_query($link,$q) or die ("เลือกข้อมูลไม่ได้3");
					$total2=mysqli_num_rows($qr);

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
		$i=1;
		while($rs2=mysqli_fetch_array($qr))
		{
?>
<tr>
																						<td class="center font_brown hidden-1000" style="vertical-align:middle;"><?php echo ($chk_page2*$e_page)+$i; ?>.</td>
																						<td class="center font_brown hidden-1000" style="vertical-align:middle;">
																							<?php if($rs2['file_img']!="") { ?>
																							<a  href="detail_data_pic.php?id=<?php echo $rs2['id_data_lda']; ?>" class="fancybox fancybox.ajax"><i class="ace-icon fa fa-picture-o bigger-130"></i></a>
																							<?php } else { echo "-"; }?>
																						</td>
																						<td class="center font_brown" style="vertical-align:middle;"><?php echo $rs2['barcode1']; ?></td>
																						<td class="center font_brown" style="vertical-align:middle;"><?php if($rs2['barcode2']!="") { echo $rs2['barcode2']; } else { echo "-"; } ?></td>
                                            <td class="font_brown" style="vertical-align:middle;">
																							<a  href="detail_data.php?id=<?php echo $rs2['id_data_lda']; ?>" class="fancybox fancybox.ajax"><?php echo $rs2['lda_list']; ?></a>
																						</td>
																						<td class="font_brown hidden-1000" style="vertical-align:middle;"><?php echo $rs2['lda_brand']; ?></td>



																						<!-- Start form -->
																						<?php if($status_con=="1") { ?>
																						<form name="form_choose" method="post" action="add_data_check.php">
																							<input type="hidden" name="id_data_lda" value="<?php echo $rs2['id_data_lda'];?>">
																							<input type="hidden" name="id_data" value="<?php echo $rs2['id'];?>">
																							<input type="hidden" name="choose_location" value="<?php echo $choose_location;?>">
																						<td class="font_brown center" style="vertical-align:middle;">
																							<?php if($rs2['status']==2) { ?>
												                      <select name="choose_status" style="background-color:#f4f9fc;font-size:13px;" class="form-control">
																									<?php if($rs2['status_old']=="1") { ?><option value="1" selected>ใช้งานปกติ</option><?php } else { ?><option value="1">ใช้งานปกติ</option><?php } ?>
																									<?php if($rs2['status_old']=="2") { ?><option value="2" selected>ชำรุด</option><?php } else { ?><option value="2">ชำรุด</option><?php } ?>
																									<?php if($rs2['status_old']=="7") { ?><option value="7" selected>สภาพปกติ ไม่จำเป็นต้องใช้งาน</option><?php } else { ?><option value="7">สภาพปกติ ไม่จำเป็นต้องใช้งาน</option><?php } ?>
												                      </select>
																						<?php } else { ?>
																							<?php if ($rs2['status_new']=="1") { ?>ใช้งานปกติ
																							<?php } elseif($rs2['status_new']=="2") { ?>ชำรุด
																							<?php } elseif($rs2['status_new']=="7") { ?>สภาพปกติ ไม่จำเป็นต้องใช้งาน
																							<?php } ?>
																						<?php } ?>
																						</td>
																						<td class="font_brown center" style="vertical-align:middle;">
																							<?php if($rs2['status']==2) { ?>
																							<select class="form-control" name="choose_location_new" style="background-color:#f4f9fc;font-size:13px;">
																								<?php
																								$sql_locate_select = ams_sql("SELECT * from  data_location where id=?", ["$rs2[id_location_old]"]);
																								$qr_locate_select=ams_query($link,$sql_locate_select) or die ("เลือกข้อมูลไม่ได้");
																													$rs_locate_select=mysqli_fetch_array($qr_locate_select);
																													$id_locate_select=$rs_locate_select['id'];
																													$name_location_select=$rs_locate_select['name_location'];
																								?>

																								<option value="<?php echo $id_locate_select;?>" selected><?php echo $name_location_select;?></option>
																								<option value="">------------</option>
																								<?php
																								$sql_locate = "SELECT * from  data_location where status_location='0' order by name_location ";
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
																								$sql_locate_select = ams_sql("SELECT * from  data_location where id=?", ["$rs2[id_location]"]);
																								$qr_locate_select=ams_query($link,$sql_locate_select) or die ("เลือกข้อมูลไม่ได้");
																													$rs_locate_select=mysqli_fetch_array($qr_locate_select);
																													$id_locate_select=$rs_locate_select['id'];
																													$name_location_select=$rs_locate_select['name_location'];
																								echo $name_location_select; }
																								?>
																						</td>
																						<td class="font_brown" style="vertical-align:middle;">
																							<?php if($rs2['status']==2) { ?>
																							<input type="text" class="form-control" style="font-size:13px;background-color:#f4f9fc;" value="<?php echo $rs2['name_use_old']; ?>" name="txt_name" maxlength="100">
																						<?php } else { echo $rs2['name_use']; } ?>
																						</td>
																						<td class="font_brown" style="vertical-align:middle;">
																							<?php if($rs2['status']==2) { ?>
																							<input type="text" class="form-control" style="font-size:13px;background-color:#f4f9fc;" value="<?php echo $rs2['note']; ?>" name="txt_note" maxlength="250"></td>
																							<?php } else { echo $note; } ?>
																						<?php if($rs2['status']==2) { ?>
																							<td class="center">-</td>
																							<td class="center"><button type="submit" class="btn btn-primary"><i class="ace-icon fa fa-check"></i></button></td>
																						<?php } else { ?>
																							<?php
																							$sql_mc = ams_sql("SELECT * from  member where id=?", ["$rs2[id_member_check]"]);
																							$qr_mc=ams_query($link,$sql_mc) or die ("เลือกข้อมูลไม่ได้");
																												$rs_mc=mysqli_fetch_array($qr_mc);
																												$name_mc=$rs_mc['name'];
																							?>
																							<td class="font_brown center" style="vertical-align:middle;"><?php echo $name_mc;?></td>
																							<td class="center" bgcolor="#49ac8b" style="vertical-align:middle;"><font color="#FFFFFF">ตรวจแล้ว</font>&nbsp;
																							<a href="data_check_edit.php?d5=1&choose_location=<?php echo $choose_location;?>&id=<?php echo $rs2['id'];?>&s_page2=<?php echo $s_page2; ?>&urlquery_str2=<?php echo $urlquery_str2; ?>&g=1" method="post"><font color="#fff"><i class="ace-icon fa fa-pencil"></i></font>
																							</a>

																							</td>
																						<?php } ?>
																						<input type="hidden" name="s_page2" value="<?php echo $s_page2; ?>">
																						<input type="hidden" name="urlquery_str2" value="<?php echo $urlquery_str2; ?>">

																			</form>
																			<?php } ?>

</tr>

                                          <?php $i++; } ?>




                                          <?php  } else { ?>
                                          <tr>
                                            <td class="center font_brown" colspan="15"><< ไม่มีข้อมูล >></td>
                                          </tr>
                                          <?php } ?>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>

																	<?php   if ($total2 == 0 || $total_p2 == "1")  {  } else {  ?>
																		<div class="pull-right pagination9">
																			<li>
																				<?php page_navigator2($before_p2,$plus_p2,$total2,$total_p2,$chk_page2,$d5,$choose_location,$g); ?>
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
