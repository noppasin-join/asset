<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$g = '';
$choose_year = '';
$txt_name = '';
$var_page = '';
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
	if ($sess_user == "" || $status!=0 || $level==0) {
    ams_deny(403, 'Insufficient permissions.');
	} else {
	set_time_limit(0);


$g=$_GET['g'] ?? '';
if ($g==1) {
$choose_year=$_GET['choose_year'] ?? '';
$txt_name=$_GET['txt_name'] ?? '';
$var_page=$_GET['var_page'] ?? '';

$s_page2=$_GET['s_page2'] ?? '';
$urlquery_str2=$_GET['urlquery_str2'] ?? '';
$radiobutton=$_GET['radiobutton'] ?? '';

}

$p=$_POST['p'] ?? '';
if ($p==1) {
	$choose_year=$_POST['choose_year'] ?? '';
	$txt_name=$_POST['txt_name'] ?? '';
	$var_page=$_POST['var_page'] ?? '';

$s_page2=$_POST['s_page2'] ?? '';
$urlquery_str2=$_POST['urlquery_str2'] ?? '';
$radiobutton=$_POST['radiobutton'] ?? '';

}



$sql_year_app="SELECT * FROM budget order by year_budget desc";
$query_year_app=ams_query($link,$sql_year_app);
$result_year_app=mysqli_fetch_array($query_year_app);
$year_budget_app=$result_year_app['year_budget'];

$sql_br2=ams_sql("SELECT * FROM data_take_list  where year_budget=? and status='1'", ["$year_budget_app"]);
$qr_br2=ams_query($link,$sql_br2);
$num_br2=mysqli_num_rows($qr_br2);
$i_app=0;
	while($i_app<$num_br2)
	{
		$rs_app=mysqli_fetch_array($qr_br2);
		$id_app=$rs_app['id'];
		$id_data_take_app=$rs_app['id_data_take'];
				$sql_app_list=ams_sql("SELECT * FROM data_take_list_more  where id_data_take_list=?", ["$id_app"]);
				$qr_app_list=ams_query($link,$sql_app_list);
				$num_app_list=mysqli_num_rows($qr_app_list);
					if($num_app_list=="0") {
						$sql_approve_update = ams_sql("update data_take set status_approve='2' where id=?", ["$id_data_take_app"]);
						$qr_approve_update =ams_page_update($link, $sql_approve_update) or die ("Error Update Approve");
						$sql_approve_update2 = ams_sql("update data_take_list set status='0' where id=?", ["$id_app"]);
						$qr_approve_update2 =ams_page_update($link, $sql_approve_update2) or die ("Error Update Approve");

					}
		$i_app++;
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



				<?php
				// สร้างฟังก์ชั่น สำหรับแสดงการแบ่งหน้า
				function page_navigator2($before_p2,$plus_p2,$total2,$total_p2,$chk_page2,$j,$choose_year,$txt_name,$var_page,$g){
				global $urlquery_str2;
				$pPrev=$chk_page2-1;
				$pPrev=($pPrev>=0)?$pPrev:0;
				$pNext=$chk_page2+1;
				$pNext=($pNext>=$total_p2)?$total_p2-1:$pNext;
				$lt_page=$total_p2-4;
				if($chk_page2>0){
				echo "<a  href='?s_page2=$pPrev&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&j=1&&choose_year=$choose_year&&txt_name=$txt_name&&var_page=$var_page&&g=1' class='naviPN'><<</a>";
				}
				if($total_p2>=11){
				if($chk_page2>=4){
				echo "<a $nClass href='?s_page2=0&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&j=1&&choose_year=$choose_year&&txt_name=$txt_name&&var_page=$var_page&&g=1'>1</a><a class='SpaceC'>. . .</a>";
				}
				if($chk_page2<4){
				for($i=0;$i<$total_p2;$i++){
				$nClass=($chk_page2==$i)?"class='selectPage'":"";
				if($i<=4){
				echo "<a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&j=1&&choose_year=$choose_year&&txt_name=$txt_name&&var_page=$var_page&&g=1'>".intval($i+1)."</a> ";
				}
				if($i==$total_p2-1 ){
				echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&j=1&&choose_year=$choose_year&&txt_name=$txt_name&&var_page=$var_page&&g=1'>".intval($i+1)."</a> ";
				}
				}
				}
				if($chk_page2>=4 && $chk_page2<$lt_page){
				$st_page=$chk_page2-3;
				for($i=1;$i<=5;$i++){
				$nClass=($chk_page2==($st_page+$i))?"class='selectPage'":"";
				echo "<a $nClass href='?s_page2=".intval($st_page+$i)."&&radiobutton=2&&j=1&&choose_year=$choose_year&&txt_name=$txt_name&&var_page=$var_page&&g=1'>".intval($st_page+$i+1)."</a> ";
				}
				for($i=0;$i<$total_p2;$i++){
				if($i==$total_p2-1 ){
				$nClass=($chk_page2==$i)?"class='selectPage'":"";
				echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&j=1&&choose_year=$choose_year&&txt_name=$txt_name&&var_page=$var_page&&g=1'>".intval($i+1)."</a> ";
				}
				}
				}
				if($chk_page2>=$lt_page){
				for($i=0;$i<=4;$i++){
				$nClass=($chk_page2==($lt_page+$i-1))?"class='selectPage'":"";
				echo "<a $nClass href='?s_page2=".intval($lt_page+$i-1)."&&radiobutton=2&&j=1&&choose_year=$choose_year&&txt_name=$txt_name&&var_page=$var_page&&g=1'>".intval($lt_page+$i)."</a> ";
				}
				}
				}else{
				for($i=0;$i<$total_p2;$i++){
				$nClass=($chk_page2==$i)?"class='selectPage'":"";
				echo "<a href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&j=1&&choose_year=$choose_year&&txt_name=$txt_name&&var_page=$var_page&&g=1' $nClass  >".intval($i+1)."</a> ";
				}
				}
				if($chk_page2<$total_p2-1){
				echo "<a href='?s_page2=$pNext&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&j=1&&choose_year=$choose_year&&txt_name=$txt_name&&var_page=$var_page&&g=1'  class='naviPN'>>></a>";
				}
				}
				?>
				<style> body { font-family: sarabun; } </style>


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
                <li class="active">ข้อมูลการยืมวัสดุ/ครุภัณฑ์</li>
              </ul><!-- /.breadcrumb -->

            </div>




            <div class="page-content">






                <div class="row">
                  <div class="alert9 alert-info font_brown">
                    <form name="form_choose" method="post" action="data_borrow.php">
                      <input type="hidden" name="j1" value="1">
                      <input type="hidden" name="p" value="1">
                      <input type="hidden" name="choose_year" value="<?php echo $choose_year; ?>">

                      <input type="hidden" name="txt_name" value="<?php echo $txt_name; ?>">
                      <input type="hidden" name="var_page" value="<?php echo $var_page; ?>">

                      <i class="ace-icon fa fa-hand-o-right"></i> ปีงบประมาณ :
                        <select name="choose_year"  onChange="submit();" >
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





										<?php if($choose_year!="") { ?>
											<div class="pull-right hidden-800">

												<a href="data_borrow.php?var_page=10&j=1&choose_year=<?php echo $choose_year; ?>&txt_name=<?php echo $txt_name; ?>&g=1">ต.ค.</a>
        &nbsp;&nbsp;| &nbsp;<a href="data_borrow.php?var_page=11&j=1&choose_year=<?php echo $choose_year; ?>&txt_name=<?php echo $txt_name; ?>&g=1">พ.ย.</a>&nbsp;&nbsp;|
        &nbsp;&nbsp;<a href="data_borrow.php?var_page=12&j=1&choose_year=<?php echo $choose_year; ?>&txt_name=<?php echo $txt_name; ?>&g=1" >ธ.ค.</a>&nbsp;&nbsp;|
        &nbsp;&nbsp;<a href="data_borrow.php?var_page=01&j=1&choose_year=<?php echo $choose_year; ?>&txt_name=<?php echo $txt_name; ?>&g=1" >ม.ค.</a>&nbsp;&nbsp;|
        &nbsp;&nbsp;<a href="data_borrow.php?var_page=02&j=1&choose_year=<?php echo $choose_year; ?>&txt_name=<?php echo $txt_name; ?>&g=1" >ก.พ.</a>&nbsp;&nbsp;|
        &nbsp;&nbsp;<a href="data_borrow.php?var_page=03&j=1&choose_year=<?php echo $choose_year; ?>&txt_name=<?php echo $txt_name; ?>&g=1" >มี.ค.</a>&nbsp;&nbsp;|
        &nbsp;&nbsp;<a href="data_borrow.php?var_page=04&j=1&choose_year=<?php echo $choose_year; ?>&txt_name=<?php echo $txt_name; ?>&g=1" >เม.ย.</a>&nbsp;&nbsp;|
        &nbsp;&nbsp;<a href="data_borrow.php?var_page=05&j=1&choose_year=<?php echo $choose_year; ?>&txt_name=<?php echo $txt_name; ?>&g=1" >พ.ค.</a>&nbsp;&nbsp;|
        &nbsp;&nbsp;<a href="data_borrow.php?var_page=06&j=1&choose_year=<?php echo $choose_year; ?>&txt_name=<?php echo $txt_name; ?>&g=1" >มิ.ย.</a>&nbsp;&nbsp;|
        &nbsp;&nbsp;<a href="data_borrow.php?var_page=07&j=1&choose_year=<?php echo $choose_year; ?>&txt_name=<?php echo $txt_name; ?>&g=1" >ก.ค.</a>&nbsp;&nbsp;|
        &nbsp;&nbsp;<a href="data_borrow.php?var_page=08&j=1&choose_year=<?php echo $choose_year; ?>&txt_name=<?php echo $txt_name; ?>&g=1" >ส.ค</a>&nbsp;&nbsp;|
        &nbsp;&nbsp;<a href="data_borrow.php?var_page=09&j=1&choose_year=<?php echo $choose_year; ?>&txt_name=<?php echo $txt_name; ?>&g=1" >ก.ย.</a>&nbsp;&nbsp;|
        &nbsp;&nbsp;<a href="data_borrow.php?j=1&choose_year=<?php echo $choose_year; ?>&txt_name=<?php echo $txt_name; ?>&g=1" >All</a>

										  </div>
										<?php } ?>


                    </form>



                  </div>



                </div>


                <div class="row">
                    <div class="col-xs-12">
                      <div class="nav-search4" id="nav-search">
                        <form class="form-search">
                          <span class="input-icon">
                          <input type="text" placeholder="ชื่อผู้ขอยืม ..." class="nav-search-input4"  autocomplete="off" name="txt_name" value="<?php echo $txt_name; ?>"  />
                          <i class="ace-icon fa fa-search nav-search-icon"></i> </span>
                          <input type="hidden" name="g" value="1">
													<input type="hidden" name="j" value="1">
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


							if ($txt_name=="") {
									if ($choose_year=="") {
										$q="SELECT * FROM data_take  order by status_read,id desc";
									} else {
											if($var_page=="") {
												$q=ams_sql("SELECT * FROM data_take where year_budget=?  order by status_read,id desc", ["$choose_year"]);
											} else {
												$q=ams_sql("SELECT * FROM data_take where year_budget=? and month_submit=?  order by status_read,id desc", ["$choose_year", "$var_page"]);
											}

									}
							} else {
										$var_trim=trim($txt_name);
								    $q=ams_sql("SELECT * FROM data_take  where  name like ? order by id desc", ["%$var_trim%"]);
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
                                            <td class="head_blue" colspan="15"> :: ข้อมูลการยืมวัสดุ/ครุภัณฑ์</td>
                                          </tr>
                                          <tr>
                                            <th class="center font_brown70"> ลำดับ </th>
                                            <th class="center font_brown70">วัน/เดือน/ปี</th>
                                            <th class="center font_brown70">ชื่อ-นามสกุล</th>
                                            <th class="center font_brown70 hidden-1100">หน่วยงาน</th>
                                            <th class="center font_brown70 hidden-1100">ความประสงค์ที่ขอยืม</th>
                                            <th class="center font_brown70">วันที่ยืม-คืน</th>
																						<th class="center font_brown70 hidden-1100">จำนวนรายการขอยืม</th>
																						<th class="center font_brown70 hidden-1100">จำนวนรายการอนุมัติ</th>

                                            <th class="center font_brown70 hidden-1200" colspan="3">Manage</th>

                                          </tr>
                                        </thead>
                                        <tbody>
                <?php
											$e_page=50; //
											if(!isset($_GET['s_page2'])){
													$_GET['s_page2']=0;
											} else {
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
															//echo "$total2";

																					if($total2!=0){
																							$i=1;
																							while($rs=mysqli_fetch_array($qr))
																					{
                                            ?>
																						<?php if ($rs['status_read']=="0") { ?>
                    												<tr class="font_no_read center" style="background-color: #f6e9ec">
																						<?php } else { ?>
																						<tr>
                                          	<?php } ?>
                                            <td class="center font_brown"><?php echo ($chk_page2*$e_page)+$i; ?>.</td>
                                            <td class="center font_brown"><?php echo $rs['day_submit']; ?>/<?php echo $rs['month_submit']; ?>/<?php echo $rs['year_submit']; ?></td>
																						<td class="font_brown" align="left">
																							<a  href="detail_borrow.php?id=<?php echo $rs['id']; ?>" class="fancybox fancybox.ajax">
																								<?php echo $rs['name']; ?>&nbsp;&nbsp;<?php echo $rs['surname']; ?>
																							</a>
																						</td>
																						<td class="font_brown hidden-1100" align="left"><?php echo $rs['department']; ?></td>
																						<td class="font_brown hidden-1100" align="left"><?php echo $rs['objective']; ?></td>
																						<?php
																						$pie=explode ("-", $rs['checkout']);
$pie = array_pad($pie, 6, ''); $y_ch=(is_numeric($pie[0]) ? (int) $pie[0] + 543 : '');
																						$pie2=explode ("-", $rs['checkin']);
$pie2 = array_pad($pie2, 6, ''); $y_ch2=(is_numeric($pie2[0]) ? (int) $pie2[0] + 543 : '');
																						?>
																						<td class="center"><b><font class="font_green"><?php echo "$pie[2]-$pie[1]-$y_ch"; ?></font> - <font class="font_red"><?php echo "$pie2[2]-$pie2[1]-$y_ch2"; ?></font></b></td>

																						<td class="center font_brown hidden-1100">
																							<?php
																							$sql_num = ams_sql("select * from  data_take_list where id_data_take=?", ["$rs[id]"]);
																							$qr_num=ams_query($link,$sql_num) or die ("เลือกข้อมูลไม่ได้");
																							$num_num=mysqli_num_rows($qr_num);
																							?>
																							<?php echo number_format( $num_num ) ; ?>
																						</td>

																						<?php
																						$sql_num_confirm = ams_sql("select * from  data_take_list where id_data_take=? and status='1'", ["$rs[id]"]);
																						$qr_num_confirm=ams_query($link,$sql_num_confirm) or die ("เลือกข้อมูลไม่ได้");
																						$num_num_confirm=mysqli_num_rows($qr_num_confirm);
																						?>
																						<td class="center font_brown hidden-1100"><?php echo number_format( $num_num_confirm ) ; ?></td>
																						<td class="center hidden-1200">
																							<?php if($num_num_confirm!="0") { ?>
																							<a class="green" href="view_borrow.php?id=<?php echo $rs['id']; ?>" target="_blank">
																							<i class="ace-icon fa fa-file bigger-100 blue"></i>
																						  </a>
																						<?php } else { echo "-"; }?>
																						</td>


																						<td class="center hidden-1200"> <a class="green" href="form_borrow.php?id=<?php echo $rs['id']; ?>&j=1"><i class="ace-icon fa fa-cog bigger-130"></i></a></td>
                                            <td class="center hidden-1200"><a class="red" href="delete_borrow.php?id=<?php echo $rs['id']; ?>" onClick="return Conf<?php echo $rs['id']; ?>(this)">
                                              <i class="ace-icon fa fa-trash-o bigger-130"></i> </a>
                                              <script language="JavaScript">
                                                    function Conf<?php echo $rs['id']; ?>(object) {
                                                    if (confirm("ยืนยันในการลบข้อมูล! ") ==true) {
                                                    return true;
                                                          }
                                                          return false;
                                                          }

                                              </script>
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
																				<?php page_navigator2($before_p2,$plus_p2,$total2,$total_p2,$chk_page2,$j,$choose_year,$txt_name,$var_page,$g); ?>
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
