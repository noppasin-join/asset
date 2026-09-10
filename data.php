<?php require_once __DIR__ . '/admin/security.php'; ?>
<?php
	include ("con_lda.php");
	set_time_limit(0);

$choose_year = $choose_category = $txt_name = $txt_user = $urlquery_str2 = $radiobutton = '';
$s_page2 = $chk_page2 = 0;
$g=$_GET['g'] ?? '';
if ($g==1) {
$choose_year=$_GET['choose_year'] ?? '';
$txt_user=$_GET['txt_user'] ?? '';

$s_page2=$_GET['s_page2'] ?? '';
$urlquery_str2=$_GET['urlquery_str2'] ?? '';
$radiobutton=$_GET['radiobutton'] ?? '';

}

$p=$_POST['p'] ?? '';
if ($p==1) {
	$choose_year=$_POST['choose_year'] ?? '';
	$txt_user=$_POST['txt_user'] ?? '';
	$LBM=$_POST['LBM'] ?? '';

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
		<title>:: Library Asset Management System</title>
				<link rel="shortcut icon" href="admin/mfu.ico" type="image/x-icon">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />


<link rel="stylesheet" href="admin/assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="admin/assets/font-awesome/4.2.0/css/font-awesome.min.css" />
<!-- page specific plugin styles -->
<link rel="stylesheet" href="admin/assets/css/jquery-ui.min.css" />
<link rel="stylesheet" href="admin/assets/css/ui.jqgrid.min.css" />
<!-- text fonts -->
<link rel="stylesheet" href="admin/assets/fonts/fonts.googleapis.com.css" />
<!-- ace styles -->
<link rel="stylesheet" href="admin/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
<script src="admin/assets/js/ace-extra.min.js"></script>
<link rel="stylesheet" href="admin/reg-style.css" />



				<?php
				// สร้างฟังก์ชั่น สำหรับแสดงการแบ่งหน้า
				function page_navigator2($before_p2,$plus_p2,$total2,$total_p2,$chk_page2,$LB,$choose_year,$txt_user,$g){
				global $urlquery_str2;
				$pPrev=$chk_page2-1;
				$pPrev=($pPrev>=0)?$pPrev:0;
				$pNext=$chk_page2+1;
				$pNext=($pNext>=$total_p2)?$total_p2-1:$pNext;
				$lt_page=$total_p2-4;
				if($chk_page2>0){
				echo "<a  href='?s_page2=$pPrev&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&LB=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_year=$txt_year&&g=1' class='naviPN'><<</a>";
				}
				if($total_p2>=11){
				if($chk_page2>=4){
				echo "<a $nClass href='?s_page2=0&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&LB=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_year=$txt_year&&g=1'>1</a><a class='SpaceC'>. . .</a>";
				}
				if($chk_page2<4){
				for($i=0;$i<$total_p2;$i++){
				$nClass=($chk_page2==$i)?"class='selectPage'":"";
				if($i<=4){
				echo "<a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&LB=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_year=$txt_year&&g=1'>".intval($i+1)."</a> ";
				}
				if($i==$total_p2-1 ){
				echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&LB=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_year=$txt_year&&g=1'>".intval($i+1)."</a> ";
				}
				}
				}
				if($chk_page2>=4 && $chk_page2<$lt_page){
				$st_page=$chk_page2-3;
				for($i=1;$i<=5;$i++){
				$nClass=($chk_page2==($st_page+$i))?"class='selectPage'":"";
				echo "<a $nClass href='?s_page2=".intval($st_page+$i)."&&radiobutton=2&&LB=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_year=$txt_year&&g=1'>".intval($st_page+$i+1)."</a> ";
				}
				for($i=0;$i<$total_p2;$i++){
				if($i==$total_p2-1 ){
				$nClass=($chk_page2==$i)?"class='selectPage'":"";
				echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&LB=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_year=$txt_year&&g=1'>".intval($i+1)."</a> ";
				}
				}
				}
				if($chk_page2>=$lt_page){
				for($i=0;$i<=4;$i++){
				$nClass=($chk_page2==($lt_page+$i-1))?"class='selectPage'":"";
				echo "<a $nClass href='?s_page2=".intval($lt_page+$i-1)."&&radiobutton=2&&LB=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_year=$txt_year&&g=1'>".intval($lt_page+$i)."</a> ";
				}
				}
				}else{
				for($i=0;$i<$total_p2;$i++){
				$nClass=($chk_page2==$i)?"class='selectPage'":"";
				echo "<a href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&LB=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_year=$txt_year&&g=1' $nClass  >".intval($i+1)."</a> ";
				}
				}
				if($chk_page2<$total_p2-1){
				echo "<a href='?s_page2=$pNext&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&LB=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_year=$txt_year&&g=1'  class='naviPN'>>></a>";
				}
				}
				?>


				<link rel="stylesheet" href="admin/AdminLTE.min.css">
				<script type="text/javascript" src="admin/lib/jquery-1.10.1.min.js"></script>
				<!-- Add mousewheel plugin (this is optional) -->
				<!-- Add fancyBox main JS and CSS files -->
				<script type="text/javascript" src="admin/source/jquery.fancybox.js?v=2.1.5"></script>
				<link rel="stylesheet" type="text/css" href="admin/source/jquery.fancybox.css?v=2.1.5" media="screen" />
				<!-- Add Button helper (this is optional) -->
				<link rel="stylesheet" type="text/css" href="admin/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
				<script type="text/javascript" src="admin/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
				<script type="text/javascript">
						$(document).ready(function() {

							$('.fancybox').fancybox();



						});
					</script>



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
                <li class="active">Data Equipment</li>
              </ul><!-- /.breadcrumb -->

            </div>




            <div class="page-content">

                <div class="row">
                  <div class="alert9 alert-info font_brown">
                    <form name="form_choose" method="post" action="data.php">
                      <input type="hidden" name="LBM" value="1">
                      <input type="hidden" name="p" value="1">
                      <input type="hidden" name="choose_year" value="<?php echo $choose_year; ?>">

                      <input type="hidden" name="txt_user" value="<?php echo $txt_user; ?>">

                      <i class="ace-icon fa fa-hand-o-right"></i> Year :
                      <?php if ($txt_user != "" ) {  ?>
                        <select name="choose_year" style="background-color:#eeeeee"  disabled>
                      <?php } else { ?>
                        <select name="choose_year"  onChange="submit();" >
                      <?php } ?>
                        <?php if ($choose_year == "") { ?>

                        <option value="" selected>--All--</option>
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




                    </form>



                  </div>



                </div>


                <div class="row">
                    <div class="col-xs-12">
                      <div class="nav-search5" id="nav-search">
                        <form class="form-search">
                          <span class="input-icon">
                          <input type="text" placeholder="Person Name ..." class="nav-search-input5" autocomplete="off" name="txt_user" value="<?php echo $txt_user; ?>"  />
                          <i class="ace-icon fa fa-search nav-search-icon"></i> </span>
                          <input type="hidden" name="g" value="1">
                          <input type="hidden" name="LB" value="1">
                          <input type="hidden" name="choose_year" value="<?php echo $choose_year; ?>">
                        </form>
                      </div>





                    </div>

                  </div>


                  <div class="row" style="padding:14px;"> </div>



									<?php
															$sql_year="SELECT * FROM budget order by year_budget desc";
															$query_year=ams_query($link,$sql_year);
															  $result_year=mysqli_fetch_array($query_year);
															  	$year_budget=$result_year['year_budget'];

								if ($choose_year=="") {
														if ($txt_user=="") {
																$q="SELECT * FROM data_take  order by id desc";
														} else {
																$var_trim=trim($txt_user);
																$q=ams_sql("SELECT * FROM data_take  where  name like ?", ["%$var_trim%"]);
														}
									} elseif($choose_year!="") {
										if ($txt_user=="") {
												$q=ams_sql("SELECT * FROM data_take where year_budget=?  order by id desc", ["$choose_year"]);
										} else {
												$var_trim=trim($txt_user);
												$q=ams_sql("SELECT * FROM data_take  where  year_budget=? and name like ?", ["$choose_year", "%$var_trim%"]);
										}
									}
									$qr=ams_query($link,$q);
									$total2=mysqli_num_rows($qr);

							?>


                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                                    <div >
                                      <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                          <tr>
                                            <td class="head_blue" colspan="15"> :: Equipment List</td>
                                          </tr>
                                          <tr>
                                            <th class="center font_brown70"> No. </th>
                                            <th class="center font_brown70 hidden-1100">Date</th>
                                            <th class="center font_brown70">Name - Surname</th>
																						<th class="center font_brown70 hidden-1000">Department</th>
																						<th class="center font_brown70 hidden-1000">Objective</th>
																						<th class="center font_brown70 hidden-1000">Equipment Date</th>
																						<th class="center font_brown70 hidden-1000">Amount List</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php



																					$e_page=50; //
																					if(!isset($_GET['s_page2'])){
																					$_GET['s_page2']=0;
																					}else{
																					$chk_page2=$_GET['s_page2'] ?? '';
																					$_GET['s_page2']=$_GET['s_page2']*$e_page;
																					}


																					$q = ams_limit($q, $_GET['s_page2'] ?? 0, $e_page);
																					$qr=ams_query($link,$q);
																					if(mysqli_num_rows($qr)>=1){
																					$plus_p2=($chk_page2*$e_page)+mysqli_num_rows($qr);
																					}else{
																					$plus_p2=($chk_page2*$e_page);
																					}
																					$total_p2=ceil($total2/$e_page);
															//echo "$total2";

																					if($total2!=0){
																							$i=1;
																							while($rs=mysqli_fetch_array($qr))
																					{
                                            ?>
                                          <tr>
                                            <td class="center font_brown"><?php echo ($chk_page2*$e_page)+$i; ?>.</td>
                                            <td class="center font_brown hidden-1100"><?php echo $rs['day_submit']; ?>/<?php echo $rs['month_submit']; ?>/<?php echo $rs['year_submit']; ?></td>
																						<td class="font_brown">
																							<a  href="detail_data.php?id=<?php echo $rs['id']; ?>" class="fancybox fancybox.ajax"><?php echo $rs['name']; ?>&nbsp;&nbsp;<?php echo $rs['surname']; ?></a>
																						</td>
																						<td class="font_brown hidden-1000"><?php echo $rs['department']; ?></td>
																						<td class="font_brown hidden-1000"><?php echo $rs['objective']; ?></td>
																						<?php
																						$pie=explode ("-", $rs['checkout']); $y_ch=$pie[0]+543;
																						$pie2=explode ("-", $rs['checkin']); $y_ch2=$pie2[0]+543;
																						?>
																						<td class="font_brown center hidden-1000"><?php echo "$pie[2]-$pie[1]-$y_ch"; ?> - <?php echo "$pie2[2]-$pie2[1]-$y_ch2"; ?></td>
																						<?php
																						$sql_num = ams_sql("select * from  data_take_list where id_data_take=?", ["$rs[id]"]);
																						$qr_num=ams_query($link,$sql_num) or die ("เลือกข้อมูลไม่ได้");
																						$num_num=mysqli_num_rows($qr_num);
																						?>
																						<td class="font_brown center hidden-1000">
																							<a  href="detail_data.php?id=<?php echo $rs['id']; ?>" class="fancybox fancybox.ajax"><?php echo $num_num; ?></a>
																						</td>




                                          </tr>

                                          <?php $i++; } ?>
                                          <?php } else { ?>
                                          <tr>
                                            <td class="center font_brown" colspan="15"><< No data >></td>
                                          </tr>
                                          <?php } ?>
                                        </tbody>
                                      </table>


                                    </div>
                                  </div>

																	<?php   if ($total2 == 0 || $total_p2 == "1")  {  } else {  ?>
																		<div class="pull-right pagination9">
																			<li>
																				<?php page_navigator2($before_p2,$plus_p2,$total2,$total_p2,$chk_page2,$LB,$choose_year,$txt_user,$g); ?>
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
        if('ontouchstart' in document.documentElement) document.write("<script src='admin/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
      </script>
      <script src="admin/assets/js/bootstrap.min.js"></script>
      <script src="admin/assets/js/ace-elements.min.js"></script>
      <script src="admin/assets/js/ace.min.js"></script>



      </script>
  </body>

</html>
