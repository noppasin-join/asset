<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$g = '';
$choose_year = '';
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
	if ($sess_user == "" || $status!="0" || $level=="0") {
    ams_deny(403, 'Insufficient permissions.');
	} else {
	set_time_limit(0);


$g=$_GET['g'] ?? '';
if ($g==1) {
$choose_year=$_GET['choose_year'] ?? '';


$s_page2=$_GET['s_page2'] ?? '';
$urlquery_str2=$_GET['urlquery_str2'] ?? '';
$radiobutton=$_GET['radiobutton'] ?? '';

}

$p=$_POST['p'] ?? '';
if ($p==1) {
	$choose_year=$_POST['choose_year'] ?? '';

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
				function page_navigator2($before_p2,$plus_p2,$total2,$total_p2,$chk_page2,$c1,$choose_year,$g){
				global $urlquery_str2;
				$pPrev=$chk_page2-1;
				$pPrev=($pPrev>=0)?$pPrev:0;
				$pNext=$chk_page2+1;
				$pNext=($pNext>=$total_p2)?$total_p2-1:$pNext;
				$lt_page=$total_p2-4;
				if($chk_page2>0){
				echo "<a  href='?s_page2=$pPrev&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&c1=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_title=$txt_title&&g=1' class='naviPN'><<</a>";
				}
				if($total_p2>=11){
				if($chk_page2>=4){
				echo "<a $nClass href='?s_page2=0&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&c1=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_title=$txt_title&&g=1'>1</a><a class='SpaceC'>. . .</a>";
				}
				if($chk_page2<4){
				for($i=0;$i<$total_p2;$i++){
				$nClass=($chk_page2==$i)?"class='selectPage'":"";
				if($i<=4){
				echo "<a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&c1=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_title=$txt_title&&g=1'>".intval($i+1)."</a> ";
				}
				if($i==$total_p2-1 ){
				echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&c1=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_title=$txt_title&&g=1'>".intval($i+1)."</a> ";
				}
				}
				}
				if($chk_page2>=4 && $chk_page2<$lt_page){
				$st_page=$chk_page2-3;
				for($i=1;$i<=5;$i++){
				$nClass=($chk_page2==($st_page+$i))?"class='selectPage'":"";
				echo "<a $nClass href='?s_page2=".intval($st_page+$i)."&&radiobutton=2&&c1=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_title=$txt_title&&g=1'>".intval($st_page+$i+1)."</a> ";
				}
				for($i=0;$i<$total_p2;$i++){
				if($i==$total_p2-1 ){
				$nClass=($chk_page2==$i)?"class='selectPage'":"";
				echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&c1=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_title=$txt_title&&g=1'>".intval($i+1)."</a> ";
				}
				}
				}
				if($chk_page2>=$lt_page){
				for($i=0;$i<=4;$i++){
				$nClass=($chk_page2==($lt_page+$i-1))?"class='selectPage'":"";
				echo "<a $nClass href='?s_page2=".intval($lt_page+$i-1)."&&radiobutton=2&&c1=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_title=$txt_title&&g=1'>".intval($lt_page+$i)."</a> ";
				}
				}
				}else{
				for($i=0;$i<$total_p2;$i++){
				$nClass=($chk_page2==$i)?"class='selectPage'":"";
				echo "<a href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&c1=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_title=$txt_title&&g=1' $nClass  >".intval($i+1)."</a> ";
				}
				}
				if($chk_page2<$total_p2-1){
				echo "<a href='?s_page2=$pNext&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&c1=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_title=$txt_title&&g=1'  class='naviPN'>>></a>";
				}
				}
				?>



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
                <li class="active">เทียบรายการครุภัณฑ์</li>
              </ul><!-- /.breadcrumb -->

            </div>


<?php
$sql_year_def = "select * from  budget order by year_budget desc   ";
$dbquery_year_def=ams_query($link,$sql_year_def) or die ("เลือกข้อมูลไม่ได้");
$result_year_def=mysqli_fetch_array($dbquery_year_def);
$year_budget_def=$result_year_def['year_budget'];

 ?>

            <div class="page-content">

                <div class="row">
                  <div class="alert9 alert-info font_brown">
                    <form name="form_choose" method="post" action="data_compare.php">
                      <input type="hidden" name="c11" value="1">
                      <input type="hidden" name="p" value="1">
                      <input type="hidden" name="choose_year" value="<?php echo $choose_year; ?>">

                      <i class="ace-icon fa fa-hand-o-right"></i> ปีงบประมาณ :
                        <select name="choose_year"  onChange="submit();" >
                        <?php if ($choose_year == "") { ?>

													<option value="<?php echo $year_budget_def; ?>" selected><?php echo $year_budget_def; ?></option>
													<option value="">-----</option>
                        <?php } else { ?>
                        <option value="<?php echo $choose_year; ?>"  selected >
                        <?php echo $choose_year; ?>
                        </option>
                        <option value="">--All--</option>
                        <?php } ?>
                        <?php
        						$sql_year = "select * from  budget order by year_budget desc  ";
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

											<?php
											if ($choose_year=="") {
													$q=ams_sql("SELECT * FROM data_compare where year_budget=? group by barcode  order by barcode", ["$year_budget_def"]);
											} elseif($choose_year!="") {
													$q=ams_sql("SELECT * FROM data_compare where year_budget=? group by barcode  order by barcode", ["$choose_year"]);
											}
													$qr=ams_query($link,$q);
													$total2=mysqli_num_rows($qr);

													$rss_stamp=mysqli_fetch_array($qr);
	        								$date_compare=$rss_stamp['date_compare'];
											 ?>

											<div class="pull-right hidden-800">
												<a href="import_excel.php?c1=1" target="_parent" >
				                <button class="btn bg-olive" type="button" style=""><i class="fa fa-plus"></i> Import </button>
				                </a>
										  </div>
											<div class="pull-right hidden-800" style="width: 10px;"> &nbsp;</div>
											<?php if($total2!="0") { ?>
											<div class="pull-right hidden-800">
												<a href="view_report_compare.php?choose_year=<?php echo $choose_year; ?>" target="_blank" >
				                <button class="btn bg-sky3" type="button"><i class="fa fa-file"></i> &nbsp;รายการที่ไม่ตรงกัน</button>
				                </a>
										  </div>
											<div class="pull-right hidden-800" style="width: 10px;"> &nbsp;</div>
											<div class="pull-right hidden-800">
												<a href="view_report_compare2.php?choose_year=<?php echo $choose_year; ?>" target="_blank" >
				                <button class="btn bg-sky4" type="button"><i class="fa fa-file"></i> &nbsp;รายการที่ตรงกัน</button>
				                </a>
										  </div>
									  	<?php } ?>

                    </form>



                  </div>



                </div>

                <div class="row">

                    <div class="col-sm-12 col-xs-12">



                                    <div >
                                      <table class="table table-striped table-bordered" style="text-align: center;">
                                        <thead>
                                          <tr>
                                            <td class="head_blue" colspan="5"> :: ข้อมูลครุภัณฑ์ <?php if($total2!="0") { ?>ณ วันที่ <?php echo $date_compare;?><?php } ?></td>
                                          </tr>
                                          <tr>
                                            <th class="center font_brown70"> ลำดับ </th>
																						<th class="center font_brown70">Asset</th>
																						<th class="center font_brown70">เลขครุภัณฑ์</th>
																						<th class="center font_brown70">รายการ (LIB)</th>
																						<th class="center font_brown70">รายการ (พัสดุ)</th>
                                          </tr>
                                        </thead>
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

																									if($total2!=0){
																									$i=1;
																									while($rs=mysqli_fetch_array($qr))
																									{

																										$sql_asset = ams_sql("select * from  data_lda where barcode1=?  ", ["$rs[barcode]"]);
																										$qr_asset=ams_query($link,$sql_asset) or die ("เลือกข้อมูลไม่ได้");
																										$rs_asset=mysqli_fetch_array($qr_asset);
																										$asset=$rs_asset['asset'];

                                            ?>
																				<tr>
																					<?php
																					if($rs['title']!=$rs['title_2']) {
																					?>
																						<td class="center font_brown" bgcolor="#f7eee9"><?php echo ($chk_page2*$e_page)+$i; ?>.</td>
																						<td class="center font_brown" bgcolor="#f7eee9"><?php echo $asset; ?></td>
																						<td class="center font_brown" bgcolor="#f7eee9"><?php echo $rs['barcode']; ?></td>

																						<td class="font_brown" align="left" bgcolor="#f7eee9"><?php  echo $rs['title']; ?></td>

																						<td class="font_brown" align="left" bgcolor="#f7eee9"><?php  echo $rs['title_2']; ?></td>
																					<?php } else { ?>
                                            <td class="center font_brown" bgcolor="#e5f9f2"><?php echo ($chk_page2*$e_page)+$i; ?>.</td>
																						<td class="center font_brown" bgcolor="#e5f9f2"><?php echo $asset; ?></td>
																						<td class="center font_brown" bgcolor="#e5f9f2"><?php echo $rs['barcode']; ?></td>

																						<td class="font_brown" align="left" bgcolor="#e5f9f2"><?php  echo $rs['title']; ?></td>

																						<td class="font_brown" align="left" bgcolor="#e5f9f2"><?php  echo $rs['title_2']; ?></td>
																					<?php } ?>
                                          </tr>


                                          <?php $i++; } ?>
																				<?php } else { ?>
																				<tr>
																					<td class="center font_brown" colspan="4"><< ไม่มีข้อมูล >></td>
																				</tr>
																				<?php } ?>

                                        </tbody>
                                      </table>


                                    </div>
                                  </div>

																	<?php   if ($total2 == 0 || $total_p2 == "1")  {  } else {  ?>
																		<div class="pull-right pagination9">
																			<li>
																				<?php page_navigator2($before_p2,$plus_p2,$total2,$total_p2,$chk_page2,$c1,$choose_year,$g); ?>
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
  </body>

</html>
<?php } ?>
