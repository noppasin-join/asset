<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$g = '';
$choose_year = '';
$choose_category = '';
$choose_location = '';
$txt_no = '';
$txt_title = '';
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
$choose_category=$_GET['choose_category'] ?? '';
$choose_location=$_GET['choose_location'] ?? '';
$txt_no=$_GET['txt_no'] ?? '';
$txt_title=$_GET['txt_title'] ?? '';

$s_page2=$_GET['s_page2'] ?? '';
$urlquery_str2=$_GET['urlquery_str2'] ?? '';
$radiobutton=$_GET['radiobutton'] ?? '';

}

$p=$_POST['p'] ?? '';
if ($p==1) {
	$choose_year=$_POST['choose_year'] ?? '';
	$choose_category=$_POST['choose_category'] ?? '';
	$choose_location=$_POST['choose_location'] ?? '';
	$txt_no=$_POST['txt_no'] ?? '';
	$txt_title=$_POST['txt_title'] ?? '';

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



				<?php
				// สร้างฟังก์ชั่น สำหรับแสดงการแบ่งหน้า
				function page_navigator2($before_p2,$plus_p2,$total2,$total_p2,$chk_page2,$dm1,$choose_year,$choose_category,$choose_location,$txt_no,$txt_title,$g){
				global $urlquery_str2;
				$pPrev=$chk_page2-1;
				$pPrev=($pPrev>=0)?$pPrev:0;
				$pNext=$chk_page2+1;
				$pNext=($pNext>=$total_p2)?$total_p2-1:$pNext;
				$lt_page=$total_p2-4;
				if($chk_page2>0){
				echo "<a  href='?s_page2=$pPrev&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&dm1=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_location=$choose_location&&txt_no=$txt_no&&txt_title=$txt_title&&g=1' class='naviPN'><<</a>";
				}
				if($total_p2>=11){
				if($chk_page2>=4){
				echo "<a $nClass href='?s_page2=0&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&dm1=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_location=$choose_location&&txt_no=$txt_no&&txt_title=$txt_title&&g=1'>1</a><a class='SpaceC'>. . .</a>";
				}
				if($chk_page2<4){
				for($i=0;$i<$total_p2;$i++){
				$nClass=($chk_page2==$i)?"class='selectPage'":"";
				if($i<=4){
				echo "<a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&dm1=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_location=$choose_location&&txt_no=$txt_no&&txt_title=$txt_title&&g=1'>".intval($i+1)."</a> ";
				}
				if($i==$total_p2-1 ){
				echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&dm1=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_location=$choose_location&&txt_no=$txt_no&&txt_title=$txt_title&&g=1'>".intval($i+1)."</a> ";
				}
				}
				}
				if($chk_page2>=4 && $chk_page2<$lt_page){
				$st_page=$chk_page2-3;
				for($i=1;$i<=5;$i++){
				$nClass=($chk_page2==($st_page+$i))?"class='selectPage'":"";
				echo "<a $nClass href='?s_page2=".intval($st_page+$i)."&&radiobutton=2&&dm1=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_location=$choose_location&&txt_no=$txt_no&&txt_title=$txt_title&&g=1'>".intval($st_page+$i+1)."</a> ";
				}
				for($i=0;$i<$total_p2;$i++){
				if($i==$total_p2-1 ){
				$nClass=($chk_page2==$i)?"class='selectPage'":"";
				echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&dm1=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_location=$choose_location&&txt_no=$txt_no&&txt_title=$txt_title&&g=1'>".intval($i+1)."</a> ";
				}
				}
				}
				if($chk_page2>=$lt_page){
				for($i=0;$i<=4;$i++){
				$nClass=($chk_page2==($lt_page+$i-1))?"class='selectPage'":"";
				echo "<a $nClass href='?s_page2=".intval($lt_page+$i-1)."&&radiobutton=2&&dm1=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_location=$choose_location&&txt_no=$txt_no&&txt_title=$txt_title&&g=1'>".intval($lt_page+$i)."</a> ";
				}
				}
				}else{
				for($i=0;$i<$total_p2;$i++){
				$nClass=($chk_page2==$i)?"class='selectPage'":"";
				echo "<a href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&dm1=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_location=$choose_location&&txt_no=$txt_no&&txt_title=$txt_title&&g=1' $nClass  >".intval($i+1)."</a> ";
				}
				}
				if($chk_page2<$total_p2-1){
				echo "<a href='?s_page2=$pNext&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&dm1=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_location=$choose_location&&txt_no=$txt_no&&txt_title=$txt_title&&g=1'  class='naviPN'>>></a>";
				}
				}
				?>


				<style> body { font-family: sarabun; } </style>
				<link rel="stylesheet" href="AdminLTE.min.css">
				<script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>
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
                <li class="active">รายงานข้อมูลครุภัณฑ์ (ชุด)</li>
              </ul><!-- /.breadcrumb -->

            </div>

            <div class="page-content">

                <div class="row">
                  <div class="alert9 alert-info font_brown">
                    <form name="form_choose" method="post" action="report_data_group.php">
                      <input type="hidden" name="dm11" value="1">
                      <input type="hidden" name="p" value="1">
                      <input type="hidden" name="choose_year" value="<?php echo $choose_year; ?>">
                      <input type="hidden" name="choose_category" value="<?php echo $choose_category; ?>">

                      <i class="ace-icon fa fa-hand-o-right"></i> ปีงบประมาณ :
                        <select name="choose_year"  onChange="submit();" style="font-size:15px;">
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
                      &nbsp;&nbsp;&nbsp; หมวดหมู่ :
                      <select name="choose_category" onChange="submit();" style="font-size:15px;" >
                        <?php if ($choose_category != "") {  ?>
                        <?php
        														$sql_cat_select = ams_sql("select * from  category where id=? ", ["$choose_category"]);
        														$dbquery_cat_select=ams_query($link,$sql_cat_select) or die ("เลือกข้อมูลไม่ได้");
        														$result_cat_select=mysqli_fetch_array($dbquery_cat_select);
        														$id_cat_select=$result_cat_select['id'];
        														$cat_select=$result_cat_select['name_category'];
        								?>
                        <option value="<?php echo $id_cat_select; ?>" selected>
                        <?php echo $cat_select; ?>
                        </option>
                        <option value="">--- All ---</option>
                        <?php } else { ?>
                        <option value="" selected>--- All ---</option>
                        <?php } ?>
                        <?php
        														$sql_cat = "select * from  category order by name_category ";
        														$dbquery_cat=ams_query($link,$sql_cat) or die ("เลือกข้อมูลไม่ได้");
        														$num_rows_cat=mysqli_num_rows($dbquery_cat);
        														$i_llt=0;
        														while($i_llt<$num_rows_cat)
        														{

        														$result_cat=mysqli_fetch_array($dbquery_cat);
        														$id_cat=$result_cat['id'];
        														$name_cat=$result_cat['name_category'];
        															?>
                        <option value="<?php echo $id_cat; ?>">
                        <?php echo $name_cat; ?>
                        </option>
                        <?php $i_llt++; } ?>
                      </select>



											&nbsp;&nbsp;&nbsp; ชั้น :
											<select name="choose_location" onChange="submit();" style="font-size:15px;">

												<?php if ($choose_location != "") {  ?>
												<?php
																		$sql_locate_select = ams_sql("SELECT * from  data_location where id=? ", ["$choose_location"]);
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
																		$sql_locate = "select * from  data_location order by name_location ";
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



										<?php /* if($level!="0") {?>
											<div class="pull-right hidden-800">
												<a href="export_report_data.php?choose_year=<?php echo $choose_year; ?>&choose_category=<?php echo $choose_category; ?>&choose_status=<?php echo $choose_status; ?>&txt_no=<?php echo $txt_no; ?>&txt_title=<?php echo $txt_title; ?>" target="_blank" >
				                <button class="btn bg-sky2" type="button">Export &nbsp;<i class="fa fa-mail-forward"></i></button>
				                </a>
										  </div>
											<div class="pull-right hidden-800" style="width: 10px;"> &nbsp;</div>
										<?php } */ ?>
										<?php /* ?>
											<div class="pull-right hidden-800">
												<a href="view_report_data.php?choose_year=<?php echo $choose_year; ?>&choose_category=<?php echo $choose_category; ?>&choose_status=<?php echo $choose_status; ?>&txt_no=<?php echo $txt_no; ?>&txt_title=<?php echo $txt_title; ?>" target="_blank" >
				                <button class="btn bg-sky3" type="button"><i class="fa fa-file"></i> &nbsp;View</button>
				                </a>
										  </div>
											<?php */ ?>


											<div class="pull-right hidden-800"> &nbsp;</div>
											<div class="pull-right hidden-800">
												<a href="detail_qrcode_report.php?choose_year=<?php echo $choose_year; ?>&choose_category=<?php echo $choose_category; ?>&choose_location=<?php echo $choose_location; ?>&txt_no=<?php echo $txt_no; ?>&txt_title=<?php echo $txt_title; ?>" target="_blank" >
												<button class="btn bg-sky3" type="button"><i class="fa fa-qrcode bigger-130"></i> </button>
												</a>
											</div>


                    </form>

                  </div>

                </div>

								<div class="row">
                    <div class="col-xs-12">
                      <div class="nav-search4" id="nav-search">
                        <form class="form-search">
                          <span class="input-icon">
                          <input type="text" placeholder="เลขครุภัณฑ์ ส่วนพัสดุ" class="nav-search-input4"  autocomplete="off" name="txt_no" value="<?php echo $txt_no; ?>"  />
                          <i class="ace-icon fa fa-search nav-search-icon"></i> </span>
                          <input type="hidden" name="g" value="1">
                          <input type="hidden" name="dm1" value="1">
                          <input type="hidden" name="choose_year" value="<?php echo $choose_year; ?>">
                          <input type="hidden" name="choose_category" value="<?php echo $choose_category; ?>">
                        </form>
                      </div>
                      <div class="nav-search66" id="nav-search">
                        <form class="form-search">
                          <span class="input-icon">
                          <input type="text" placeholder="ชื่อครุภัณฑ์ ..." class="nav-search-input66"  autocomplete="off" name="txt_title" value="<?php echo $txt_title; ?>"  />
                          <i class="ace-icon fa fa-search nav-search-icon"></i> </span>
                          <input type="hidden" name="g" value="1">
                          <input type="hidden" name="dm1" value="1">
                          <input type="hidden" name="choose_year" value="<?php echo $choose_year; ?>">
                          <input type="hidden" name="choose_category" value="<?php echo $choose_category; ?>">
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

		if ($choose_category=="") {

			if($choose_location=="") {
				$q="SELECT *,count(barcode1) as h1 FROM data_lda group by barcode1 having h1>1  order by barcode1";
			} else {
				$q=ams_sql("SELECT *,count(barcode1) as h1 FROM data_lda where id_location=? group by barcode1 having h1>1  order by barcode1", ["$choose_location"]);
			}
		} else {
			if($choose_location=="") {
				$q=ams_sql("SELECT *,count(barcode1) as h1 FROM data_lda where id_category=? group by barcode1 having h1>1  order by barcode1", ["$choose_category"]);
			} else {
				$q=ams_sql("SELECT *,count(barcode1) as h1 FROM data_lda where id_category=? and id_location=? group by barcode1 having h1>1  order by barcode1", ["$choose_category", "$choose_location"]);
			}
		}

} elseif($choose_year!="") {

		if ($choose_category=="") {

			if($choose_location=="") {
				$q=ams_sql("SELECT *,count(barcode1) as h1 FROM data_lda where year_budget=? group by barcode1 having h1>1  order by barcode1", ["$choose_year"]);
			} else {
				$q=ams_sql("SELECT *,count(barcode1) as h1 FROM data_lda where year_budget=? and id_location=? group by barcode1 having h1>1  order by barcode1", ["$choose_year", "$choose_location"]);
			}
		} else {
			if($choose_location=="") {
				$q=ams_sql("SELECT *,count(barcode1) as h1 FROM data_lda where year_budget=? and id_category=? group by barcode1 having h1>1  order by barcode1", ["$choose_year", "$choose_category"]);
			} else {
				$q=ams_sql("SELECT *,count(barcode1) as h1 FROM data_lda where year_budget=? and id_category=? and id_location=? group by barcode1 having h1>1  order by barcode1", ["$choose_year", "$choose_category", "$choose_location"]);
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
                                        <thead>
                                          <tr>
                                            <td class="head_blue" colspan="10"> :: รายงานข้อมูลครุภัณฑ์</td>
                                          </tr>
                                          <tr>
                                            <th class="center font_brown70"> ลำดับ </th>
																						<th class="center font_brown70">Asset</th>
																						<th class="center font_brown70">เลขครุภัณฑ์</th>
                                            <th class="center font_brown70">จำนวน(รายการ)</th>
                                            <th class="center font_brown70">รายการ</th>
                                            <th class="center font_brown70">หมวดหมู่</th>
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
															//echo "$total2";

																					if($total2!=0){
																							$i=1;
																							while($rs=mysqli_fetch_array($qr))
																					{
                                            ?>
                                          <tr>
                                            <td class="center font_brown-14"><?php echo ($chk_page2*$e_page)+$i; ?>.</td>
																						<td class="center font_brown-14"><?php echo $rs['asset']; ?></td>
																						<td class="center font_brown-14"><?php echo $rs['barcode1']; ?>

																						</td>
                                            <td class="center font_brown-14">
																							<a href="report_detail_group.php?id=<?php echo $rs['barcode1']; ?>&choose_year=<?php echo $choose_year; ?>&choose_category=<?php echo $choose_category; ?>" target="_blank">
																								<?php echo $rs['h1']; ?>
																							</a>
																						</td>
																						<td class="font_brown-14"><?php  echo $rs['lda_list']; ?></td>
																						<td class="center font_brown-14">
																							<?php
																													$sql_cat_list = ams_sql("select * from  category where id=? ", ["$rs[id_category]"]);
																													$qr_cat_list=ams_query($link,$sql_cat_list) or die ("เลือกข้อมูลไม่ได้");
																													$rs_cat_list=mysqli_fetch_array($qr_cat_list);
																													$name_category_list=$rs_cat_list['name_category'];
																							?>
																							<?php echo $name_category_list; ?>
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
																				<?php page_navigator2($before_p2,$plus_p2,$total2,$total_p2,$chk_page2,$dm1,$choose_year,$choose_category,$choose_location,$txt_no,$txt_title,$g); ?>
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
