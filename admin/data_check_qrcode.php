<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
$choose_location = '';

	$s_page2 = '';
$urlquery_str2 = '';
$radiobutton = '';
$txt_no = '';
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


<style> body { font-family: sarabun; } </style>

				<?php
				// สร้างฟังก์ชั่น สำหรับแสดงการแบ่งหน้า
				function page_navigator2($before_p2,$plus_p2,$total2,$total_p2,$chk_page2,$q1){
				global $urlquery_str2;
				$pPrev=$chk_page2-1;
				$pPrev=($pPrev>=0)?$pPrev:0;
				$pNext=$chk_page2+1;
				$pNext=($pNext>=$total_p2)?$total_p2-1:$pNext;
				$lt_page=$total_p2-4;
				if($chk_page2>0){
				echo "<a  href='?s_page2=$pPrev&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&q1=1' class='naviPN'><<</a>";
				}
				if($total_p2>=11){
				if($chk_page2>=4){
				echo "<a $nClass href='?s_page2=0&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&q1=1'>1</a><a class='SpaceC'>. . .</a>";
				}
				if($chk_page2<4){
				for($i=0;$i<$total_p2;$i++){
				$nClass=($chk_page2==$i)?"class='selectPage'":"";
				if($i<=4){
				echo "<a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&q1=1'>".intval($i+1)."</a> ";
				}
				if($i==$total_p2-1 ){
				echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&q1=1'>".intval($i+1)."</a> ";
				}
				}
				}
				if($chk_page2>=4 && $chk_page2<$lt_page){
				$st_page=$chk_page2-3;
				for($i=1;$i<=5;$i++){
				$nClass=($chk_page2==($st_page+$i))?"class='selectPage'":"";
				echo "<a $nClass href='?s_page2=".intval($st_page+$i)."&&radiobutton=2&&q1=1'>".intval($st_page+$i+1)."</a> ";
				}
				for($i=0;$i<$total_p2;$i++){
				if($i==$total_p2-1 ){
				$nClass=($chk_page2==$i)?"class='selectPage'":"";
				echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&q1=1'>".intval($i+1)."</a> ";
				}
				}
				}
				if($chk_page2>=$lt_page){
				for($i=0;$i<=4;$i++){
				$nClass=($chk_page2==($lt_page+$i-1))?"class='selectPage'":"";
				echo "<a $nClass href='?s_page2=".intval($lt_page+$i-1)."&&radiobutton=2&&q1=1'>".intval($lt_page+$i)."</a> ";
				}
				}
				}else{
				for($i=0;$i<$total_p2;$i++){
				$nClass=($chk_page2==$i)?"class='selectPage'":"";
				echo "<a href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&q1=1' $nClass  >".intval($i+1)."</a> ";
				}
				}
				if($chk_page2<$total_p2-1){
				echo "<a href='?s_page2=$pNext&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&q1=1'  class='naviPN'>>></a>";
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
$s_page2=$_GET['s_page2'] ?? '';
$urlquery_str2=$_GET['urlquery_str2'] ?? '';
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
                <li class="active">ตรวจนับครุภัณฑ์ QR Code</li>
              </ul><!-- /.breadcrumb -->
            </div>
<?php $txt_no=$_GET['txt_no'] ?? '';?>
<div class="page-content">

	<div class="row">
		<div class="col-sm-12 col-xs-12">

			<div class="pull-left">
			<form action="qrcode.php" method="get" target="_parent">
				<input type="hidden" name="q1" value="1">
			<button type="submit" class="btn bg-sky3"><i class="ace-icon fa fa-qrcode"></i> Scan QR Code</button>
			</form>
			</div>
			<div class="nav-search55" id="nav-search">
				<form class="form-search">
					<span class="input-icon">
					<input type="text" placeholder="เลขครุภัณฑ์ที่ตรวจเสร็จ" class="nav-search-input55"  autocomplete="off" name="txt_no" value="<?php echo $txt_no; ?>"  />
					<i class="ace-icon fa fa-search nav-search-icon"></i> </span>
					<input type="hidden" name="g" value="1">
					<input type="hidden" name="q1" value="1">
				</form>
			</div>

		</div>
	</div>
							<?php
															$sql_year="SELECT * FROM data_config order by year_budget desc";
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
          <table class="table9 table-striped table-bordered table-hover">
            <thead>
              <tr>
                <td class="head_blue" colspan="10"> :: ปีงบประมาณ : <font color="#e8f652" size="2"><b><?php echo $year_budget; ?></b></font>
									&nbsp;&nbsp;&nbsp;&nbsp; ผู้ดำเนินการตรวจนับ &nbsp;:&nbsp;
									<font color="#e8f652" size="2"><b><?php echo $name_member; ?>&nbsp;&nbsp;<?php echo $surname_member; ?></b></font>
								</td>
              </tr>

                                          <tr>
                                            <th class="center font_brown70"> ลำดับ.</th>
                                            <th class="center font_brown70 hidden-1000">เลขครุภัณฑ์</th>
                                            <th class="center font_brown70">รายการ</th>
                                            <th class="center font_brown70 hidden-1000">ยี่ห้อ</th>
																						<th class="center font_brown70 hidden-1000">สถานที่ใช้งาน (เดิม)</th>
                                            <th class="center font_brown70 hidden-1000">สถานที่ใช้งาน (ใหม่)</th>
																						<th class="center font_brown70 hidden-1000">ผู้ใช้งาน</th>
																						<th class="center font_brown70 hidden-1000">สถานะ</th>
																						<th class="center font_brown70" colspan="2">วันที่ตรวจ</th>

                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php
if($txt_no=="") {
	$q=ams_sql("SELECT * FROM data_check where year_budget=? and id_member_check=? and status='1' order by lda_list", ["$year_budget", "$id_member"]);
} else {
	$q=ams_sql("SELECT * FROM data_check where year_budget=? and id_member_check=? and status='1' and barcode3 like ? order by lda_list", ["$year_budget", "$id_member", "%$txt_no%"]);
}
$qr=ams_query($link,$q);
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

		if($total2!=0){
		$i=1;
				while($rs=mysqli_fetch_array($qr))
				{
																						?>

																					<tr>
																						<td class="center font_brown" style="vertical-align:middle;"><?php echo ($chk_page2*$e_page)+$i; ?>.</td>
																						<?php if($rs['barcode2']=="") { ?>
                                            <td class="center font_brown hidden-1000" style="vertical-align:middle;"><?php echo $rs['barcode3']; ?></td>
																						<?php } else { ?>
																						<td class="center font_brown hidden-1000" style="vertical-align:middle;"><?php echo $rs['barcode2']; ?></td>
																						<?php } ?>
                                            <td class="font_brown" style="vertical-align:middle;">
																							<?php echo $rs['lda_list']; ?>
																						</td>
																						<td class="font_brown hidden-1000" style="vertical-align:middle;"><?php echo $rs['lda_brand']; ?></td>
																						<td class="center font_brown hidden-1000" style="vertical-align:middle;">
																							<?php
																							$sql_locate2 = ams_sql("SELECT * from  data_location where id=? ", ["$rs[id_location_old]"]);
																							$qr_locate2=ams_query($link,$sql_locate2) or die ("เลือกข้อมูลไม่ได้");
																							$rs_locate2=mysqli_fetch_array($qr_locate2);
																							$name_locate2=$rs_locate2['name_location'];
																							 ?>
																							<?php echo $name_locate2; ?>
																						</td>
																						<td class="center font_brown hidden-1000" style="vertical-align:middle;">
																							<?php
																							$sql_locate = ams_sql("SELECT * from  data_location where id=? ", ["$rs[id_location]"]);
																							$qr_locate=ams_query($link,$sql_locate) or die ("เลือกข้อมูลไม่ได้");
																							$rs_locate=mysqli_fetch_array($qr_locate);
																							$name_locate=$rs_locate['name_location'];
																							 ?>
																							<?php echo $name_locate; ?>
																						</td>
																						<td class="center font_brown hidden-1000" style="vertical-align:middle;"><?php echo $rs['name_use']; ?></td>
                                            <?php if ($rs['status_new']=="1") { ?>
                                              	<td class="center hidden-1000" bgcolor="#49ac8b" style="vertical-align:middle;"><font color="#FFFFFF">ใช้งานปกติ</font> </td>
																							<?php } elseif($rs['status_new']=="2") { ?>
																								<td class="center hidden-1000" bgcolor="#d15b47" style="vertical-align:middle;"><font color="#FFFFFF">ชำรุด</font></td>
																							<?php } elseif($rs['status_new']=="3") { ?>
																								<td class="center hidden-1000" bgcolor="#d15b47" style="vertical-align:middle;"><font color="#FFFFFF">สูญหาย</font></td>
																							<?php } elseif($rs['status_new']=="4") { ?>
																								<td class="center hidden-1000" bgcolor="#d15b47" style="vertical-align:middle;"><font color="#FFFFFF">โอนย้าย / บริจาค</font></td>
																							<?php } elseif($rs['status_new']=="5") { ?>
																								<td class="center hidden-1000" bgcolor="#d15b47" style="vertical-align:middle;"><font color="#FFFFFF">จำหน่ายออก</font></td>
																							<?php } elseif($rs['status_new']=="6") { ?>
																								<td class="center hidden-1000" bgcolor="#d15b47" style="vertical-align:middle;"><font color="#FFFFFF">ส่งซ่อม</font></td>
																							<?php } elseif($rs['status_new']=="7") { ?>
																								<td class="center hidden-1000" bgcolor="#d15b47" style="vertical-align:middle;"><font color="#FFFFFF">สภาพปกติ ไม่จำเป็นต้องใช้งาน</font></td>
																							<?php } elseif($rs['status_new']=="8") { ?>
																								<td class="center hidden-1000" bgcolor="#d15b47" style="vertical-align:middle;"><font color="#FFFFFF">รอจำหน่ายออก</font></td>
																							<?php } ?>
                                            </td>
																						<td class="center font_brown" style="vertical-align:middle;">
																							<?php echo $rs['date_check']; ?>&nbsp;&nbsp; (<?php echo $rs['time_check']; ?> น.)
																						</td>
																						<td class="center" bgcolor="#49ac8b" style="vertical-align:middle;">
																						<a href="data_check_edit.php?q1=1&choose_location=<?php echo $choose_location;?>&id=<?php echo $rs['id'];?>&s_page2=<?php echo $s_page2; ?>&urlquery_str2=<?php echo $urlquery_str2; ?>&g=1"><font color="#fff"><i class="ace-icon fa fa-pencil"></i></font>
																						</a>

																						</td>


                                          </tr>


                                          <?php $i++; } ?>




                                          <?php } else { ?>
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
																				<?php page_navigator2($before_p2,$plus_p2,$total2,$total_p2,$chk_page2,$q1); ?>
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
