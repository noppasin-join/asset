<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$g = '';
$choose_year = '';
$choose_category = '';
$choose_status = '';
$txt_no = '';
$txt_title = '';
$s_page2 = '';
$urlquery_str2 = '';
$radiobutton = '';
$p = '';
$total_check = '';
$v_success = '';
$v_del = '';
$v_update = '';
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
$choose_category=$_GET['choose_category'] ?? '';
$choose_status=$_GET['choose_status'] ?? '';
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
	$choose_status=$_POST['choose_status'] ?? '';
	$txt_no=$_POST['txt_no'] ?? '';
	$txt_title=$_POST['txt_title'] ?? '';

$s_page2=$_POST['s_page2'] ?? '';
$urlquery_str2=$_POST['urlquery_str2'] ?? '';
$radiobutton=$_POST['radiobutton'] ?? '';

}

$sql_br="SELECT * FROM data_lda  where lda_status<>'1' and status_borrow='1'";
$qr_br=ams_query($link,$sql_br);
$num_br=mysqli_num_rows($qr_br);
if($num_br!=0) {
$sql_br_update="update data_lda set status_borrow='2' where lda_status<>'1' and status_borrow='1'";
$qr_br_update=ams_page_update($link, $sql_br_update) or die ("Error Update Status Borrow ");
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
				function page_navigator2($before_p2,$plus_p2,$total2,$total_p2,$chk_page2,$d4,$choose_year,$choose_category,$choose_status,$txt_no,$txt_title,$g){
				global $urlquery_str2;
				$pPrev=$chk_page2-1;
				$pPrev=($pPrev>=0)?$pPrev:0;
				$pNext=$chk_page2+1;
				$pNext=($pNext>=$total_p2)?$total_p2-1:$pNext;
				$lt_page=$total_p2-4;
				if($chk_page2>0){
				echo "<a  href='?s_page2=$pPrev&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&d4=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_title=$txt_title&&g=1' class='naviPN'><<</a>";
				}
				if($total_p2>=11){
				if($chk_page2>=4){
				echo "<a $nClass href='?s_page2=0&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&d4=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_title=$txt_title&&g=1'>1</a><a class='SpaceC'>. . .</a>";
				}
				if($chk_page2<4){
				for($i=0;$i<$total_p2;$i++){
				$nClass=($chk_page2==$i)?"class='selectPage'":"";
				if($i<=4){
				echo "<a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&d4=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_title=$txt_title&&g=1'>".intval($i+1)."</a> ";
				}
				if($i==$total_p2-1 ){
				echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&d4=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_title=$txt_title&&g=1'>".intval($i+1)."</a> ";
				}
				}
				}
				if($chk_page2>=4 && $chk_page2<$lt_page){
				$st_page=$chk_page2-3;
				for($i=1;$i<=5;$i++){
				$nClass=($chk_page2==($st_page+$i))?"class='selectPage'":"";
				echo "<a $nClass href='?s_page2=".intval($st_page+$i)."&&radiobutton=2&&d4=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_title=$txt_title&&g=1'>".intval($st_page+$i+1)."</a> ";
				}
				for($i=0;$i<$total_p2;$i++){
				if($i==$total_p2-1 ){
				$nClass=($chk_page2==$i)?"class='selectPage'":"";
				echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&d4=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_title=$txt_title&&g=1'>".intval($i+1)."</a> ";
				}
				}
				}
				if($chk_page2>=$lt_page){
				for($i=0;$i<=4;$i++){
				$nClass=($chk_page2==($lt_page+$i-1))?"class='selectPage'":"";
				echo "<a $nClass href='?s_page2=".intval($lt_page+$i-1)."&&radiobutton=2&&d4=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_title=$txt_title&&g=1'>".intval($lt_page+$i)."</a> ";
				}
				}
				}else{
				for($i=0;$i<$total_p2;$i++){
				$nClass=($chk_page2==$i)?"class='selectPage'":"";
				echo "<a href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&d4=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_title=$txt_title&&g=1' $nClass  >".intval($i+1)."</a> ";
				}
				}
				if($chk_page2<$total_p2-1){
				echo "<a href='?s_page2=$pNext&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&d4=1&&choose_year=$choose_year&&choose_category=$choose_category&&choose_status=$choose_status&&txt_no=$txt_no&&txt_title=$txt_title&&g=1'  class='naviPN'>>></a>";
				}
				}
				?>


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
                <li class="active">ข้อมูลครุภัณฑ์</li>
              </ul><!-- /.breadcrumb -->

            </div>




            <div class="page-content">


              <div class="row">
                <div class="col-xs-12">
                <?php
                $total_check=$_GET['total_check'] ?? '';
                $v_success=$_GET['v_success'] ?? '';
                $v_del=$_GET['v_del'] ?? '';
                $v_update=$_GET['v_update'] ?? '';
                ?>
                <?php if($total_check>"0") { ?>
                  <div class="alert alert-block alert-danger font_brown" id="success-alert">
                    <button type="button" class="close" data-dismiss="alert">
                      <i class="ace-icon fa fa-times"></i>
                    </button>

                    <i class="ace-icon fa fa-bullhorn dark"></i>

                    <b class="dark"><u>พบข้อผิดพลาด</u></b>  &nbsp;&nbsp;เลขครุภัณฑ์ดังกล่าว มีในระบบแล้ว!
                  </div>
                  <?php } ?>
                  <?php if($v_success=="1") { ?>
                  <div class="alert alert-block alert-success font_brown" id="success-alert">
                    <button type="button" class="close" data-dismiss="alert">
                      <i class="ace-icon fa fa-times"></i>
                    </button>

                    <i class="ace-icon fa fa-check green"></i> &nbsp;
                    <strong>เพิ่มข้อมูลครุภัณฑ์ เรียบร้อยแล้ว</strong>
                  </div>
                  <?php } ?>
                  <?php if($v_update=="1") { ?>
                  <div class="alert alert-block alert-success font_brown" id="success-alert">
                    <button type="button" class="close" data-dismiss="alert">
                      <i class="ace-icon fa fa-times"></i>
                    </button>

                    <i class="ace-icon fa fa-check green"></i> &nbsp;
                    <strong>แก้ไขข้อมูลครุภัณฑ์ เรียบร้อยแล้ว</strong>
                  </div>
                  <?php } ?>
                  <?php if($v_del=="1") { ?>
                  <div class="alert alert-block alert-success font_brown" id="success-alert">
                    <button type="button" class="close" data-dismiss="alert">
                      <i class="ace-icon fa fa-times"></i>
                    </button>

                    <i class="ace-icon fa fa-trash green"></i> &nbsp;
                    <strong>ลบข้อมูลครุภัณฑ์ เรียบร้อยแล้ว</strong>
                  </div>
                                  <?php } ?>
                  </div>
                </div>



                <div class="row">
                  <div class="alert9 alert-info font_brown">
                    <form name="form_choose" method="post" action="data.php">
                      <input type="hidden" name="d41" value="1">
                      <input type="hidden" name="p" value="1">
                      <input type="hidden" name="choose_year" value="<?php echo $choose_year; ?>">
                      <input type="hidden" name="choose_category" value="<?php echo $choose_category; ?>">
                      <input type="hidden" name="choose_status" value="<?php echo $choose_status; ?>">

                      <input type="hidden" name="txt_no" value="<?php echo $txt_no; ?>">
                      <input type="hidden" name="txt_title" value="<?php echo $txt_title; ?>">

                      <i class="ace-icon fa fa-hand-o-right"></i> ปีงบประมาณ :
                      <?php if ($txt_no != "" || $txt_title !="") {  ?>
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
                      </select><font class="hidden-1000">
                      &nbsp;&nbsp;&nbsp; หมวดหมู่ :
                      <?php if ($txt_no != "" || $txt_title !="") {  ?>
                      <select name="choose_category" style="background-color:#eeeeee"  disabled>
                      <?php } else { ?><select name="choose_category" onChange="submit();" style="font-size:13px;" >
                        <?php } ?>
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
					  </font>

											<font class="hidden-700">&nbsp;&nbsp;&nbsp; สถานะ :
                      <?php if ($txt_no != "" || $txt_title !="") {  ?><select name="choose_status" style="background-color:#eeeeee" disabled>
                      <?php } else { ?><select name="choose_status" onChange="submit();" style="font-size:13px;"><?php } ?>

													<?php if($choose_status=="") { ?><option value="" selected>--- All ---</option><?php } else { ?><option value="">--- All ---</option><?php } ?>
													<?php if($choose_status=="1") { ?><option value="1" selected>ใช้งานปกติ</option><?php } else { ?><option value="1">ใช้งานปกติ</option><?php } ?>
													<?php if($choose_status=="2") { ?><option value="2" selected>ชำรุด</option><?php } else { ?><option value="2">ชำรุด</option><?php } ?>
													<?php if($choose_status=="3") { ?><option value="3" selected>สูญหาย</option><?php } else { ?><option value="3">สูญหาย</option><?php } ?>
													<?php if($choose_status=="4") { ?><option value="4" selected>โอนย้าย / บริจาค</option><?php } else { ?><option value="4">โอนย้าย / บริจาค</option><?php } ?>
													<?php if($choose_status=="5") { ?><option value="5" selected>จำหน่ายออก</option><?php } else { ?><option value="5">จำหน่ายออก</option><?php } ?>
													<?php if($choose_status=="6") { ?><option value="6" selected>ส่งซ่อม</option><?php } else { ?><option value="6">ส่งซ่อม</option><?php } ?>
													<?php if($choose_status=="7") { ?><option value="7" selected>สภาพปกติ ไม่จำเป็นต้องใช้งาน</option><?php } else { ?><option value="7">สภาพปกติ ไม่จำเป็นต้องใช้งาน</option><?php } ?>

                      </select>
                    </font>

										<?php if($level!="0") { ?>
										<?php
													$sql_cre="SELECT * FROM data_config where status='1' order by year_budget desc";
													$query_cre=ams_query($link,$sql_cre);
															$tt_cre=mysqli_num_rows($query_cre);
													if ($tt_cre=="0") {
										 ?>
											<div class="pull-right hidden-800">
												<a href="form_data.php?d4=1" target="_parent" >
				                <button class="btn bg-olive" type="button" style=""><i class="fa fa-plus"></i> Create </button>
				                </a>
										  </div>
										<?php } ?>
										<?php } ?>
                    </form>



                  </div>



                </div>


                <div class="row">
                    <div class="col-xs-12">
                      <div class="nav-search5" id="nav-search">
                        <form class="form-search">
                          <span class="input-icon">
                          <input type="text" placeholder="เลขครุภัณฑ์ ..." class="nav-search-input5"  autocomplete="off" name="txt_no" value="<?php echo $txt_no; ?>"  />
                          <i class="ace-icon fa fa-search nav-search-icon"></i> </span>
                          <input type="hidden" name="g" value="1">
                          <input type="hidden" name="d4" value="1">
                          <input type="hidden" name="choose_year" value="<?php echo $choose_year; ?>">
                          <input type="hidden" name="choose_category" value="<?php echo $choose_category; ?>">
                          <input type="hidden" name="choose_status" value="<?php echo $choose_status; ?>">
                        </form>
                      </div>
                      <div class="nav-search6" id="nav-search">
                        <form class="form-search">
                          <span class="input-icon">
                          <input type="text" placeholder="รายการ ..." class="nav-search-input6"  autocomplete="off" name="txt_title" value="<?php echo $txt_title; ?>"  />
                          <i class="ace-icon fa fa-search nav-search-icon"></i> </span>
                          <input type="hidden" name="g" value="1">
                          <input type="hidden" name="d4" value="1">
                          <input type="hidden" name="choose_year" value="<?php echo $choose_year; ?>">
                          <input type="hidden" name="choose_category" value="<?php echo $choose_category; ?>">
                          <input type="hidden" name="choose_status" value="<?php echo $choose_status; ?>">
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


														if ($txt_no=="" && $txt_title=="") {

																		if ($choose_category=="") {
																							if ($choose_status =="") {
																									$q="SELECT * FROM data_lda  order by barcode1";
																							} else {
																									$q=ams_sql("SELECT * FROM data_lda  where lda_status=? order by barcode1", ["$choose_status"]);
																							}
																		} else {

																							if ($choose_status =="") {
																									$q=ams_sql("SELECT * FROM data_lda where id_category=?  order by barcode1", ["$choose_category"]);
																							} else {
																									$q=ams_sql("SELECT * FROM data_lda  where id_category=? and lda_status=? order by barcode1", ["$choose_category", "$choose_status"]);
																							}
																		}

														} elseif ($txt_no!="" && $txt_title=="") {
																							$var_trim=trim($txt_no);
																							$q=ams_sql("SELECT * FROM data_lda  where  barcode1 like ?", ["%$var_trim%"]);
														} elseif ($txt_no!="" && $txt_title!="") {
																							$var_trim1=trim($txt_no);
																							$var_trim2=trim($txt_title);
																							$q=ams_sql("SELECT * FROM data_lda  where  barcode1 like ?  and lda_list like ?", ["%$var_trim1%", "%$var_trim2%"]);
														} elseif ($txt_no=="" && $txt_title!="") {
																							$var_trim=trim($txt_title);
																							$q=ams_sql("SELECT * FROM data_lda  where  lda_list like ?  order by barcode1  ", ["%$var_trim%"]);
														}


									} elseif($choose_year!="") {

										if ($txt_no=="" && $txt_title=="") {

														if ($choose_category=="") {
																			if ($choose_status =="") {
																					$q=ams_sql("SELECT * FROM data_lda where year_budget=?  order by barcode1", ["$choose_year"]);
																			} else {
																					$q=ams_sql("SELECT * FROM data_lda  where year_budget=? and lda_status=? order by barcode1", ["$choose_year", "$choose_status"]);
																			}
														} else {

																			if ($choose_status =="") {
																					$q=ams_sql("SELECT * FROM data_lda where year_budget=? and id_category=?  order by barcode1", ["$choose_year", "$choose_category"]);
																			} else {
																					$q=ams_sql("SELECT * FROM data_lda  where year_budget=? and id_category=? and lda_status=? order by barcode1", ["$choose_year", "$choose_category", "$choose_status"]);
																			}
														}

										} elseif ($txt_no!="" && $txt_title=="") {
																			$var_trim=trim($txt_no);
																			$q=ams_sql("SELECT * FROM data_lda  where  year_budget=? and barcode1 like ?", ["$choose_year", "%$var_trim%"]);
										} elseif ($txt_no!="" && $txt_title!="") {
																			$var_trim1=trim($txt_no);
																			$var_trim2=trim($txt_title);
																			$q=ams_sql("SELECT * FROM data_lda  where  year_budget=? and barcode1 like ?  and lda_list like ?", ["$choose_year", "%$var_trim1%", "%$var_trim2%"]);
										} elseif ($txt_no=="" && $txt_title!="") {
																			$var_trim=trim($txt_title);
																			$q=ams_sql("SELECT * FROM data_lda  where  year_budget=? and lda_list like ?  order by barcode1  ", ["$choose_year", "%$var_trim%"]);
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
                                            <td class="head_blue" colspan="15"> :: ข้อมูลครุภัณฑ์</td>
                                          </tr>
                                          <tr>
                                            <th class="center font_brown70"> ลำดับ </th>
                                            <th class="center font_brown70">เลขครุภัณฑ์</th>
                                            <th class="center font_brown70 hidden-1100">ปี</th>
                                            <th class="center font_brown70">รายการ</th>
                                            <th class="center font_brown70 hidden-1000">ยี่ห้อ</th>
                                            <th class="center font_brown70 hidden-1200">ราคา</th>
                                            <th class="center font_brown70">สถานที่ใช้งาน</th>
                                            <th class="center font_brown70 hidden-1000">ผู้ใช้งาน</th>
                                            <th class="center font_brown70">สถานะ</th>
                                            <th class="center font_brown70 hidden-1100">หมวดหมู่</th>
                                            <th class="center font_brown70 hidden-800" colspan="3">View</th>
																						<?php if($level!="0") { ?>
                                            <th class="center font_brown70 hidden-1200" colspan="2">Manage</th>
																					  <?php } ?>
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
                                            <td class="center font_brown"><?php echo ($chk_page2*$e_page)+$i; ?>.</td>
                                            <td class="center font_brown"><?php echo $rs['barcode2']; ?></td>
                                            <td class="center font_brown hidden-1100"><?php echo $rs['lda_year']; ?></td>
																						<td class="font_brown">

																							<?php if($rs['file_img']!="") { ?>
																							<a  href="detail_data.php?id=<?php echo $rs['id']; ?>" class="fancybox fancybox.ajax"><?php echo $rs['lda_list']; ?></a>
																							<?php } else { echo $rs['lda_list']; } ?>


																						</td>
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
																						<td class="font_brown hidden-1000"><?php echo $rs['name_use']; ?></td>
                                            <?php if ($rs['lda_status']=="1") { ?><td class="center" bgcolor="#49ac8b"><font color="#FFFFFF">ใช้งานปกติ</font> </td>
																					  <?php } elseif($rs['lda_status']=="2") { ?><td class="center" bgcolor="#d15b47"><font color="#FFFFFF">ชำรุด</font></td>
																					  <?php } elseif($rs['lda_status']=="3") { ?><td class="center" bgcolor="#d15b47"><font color="#FFFFFF">สูญหาย</font></td>
																					  <?php } elseif($rs['lda_status']=="4") { ?><td class="center" bgcolor="#d15b47"><font color="#FFFFFF">โอนย้าย / บริจาค</font></td>
																					  <?php } elseif($rs['lda_status']=="5") { ?><td class="center" bgcolor="#d15b47"><font color="#FFFFFF">จำหน่ายออก</font></td>
																					  <?php } elseif($rs['lda_status']=="6") { ?><td class="center" bgcolor="#d15b47"><font color="#FFFFFF">ส่งซ่อม</font></td>
																					  <?php } elseif($rs['lda_status']=="7") { ?><td class="center" bgcolor="#d15b47"><font color="#FFFFFF">สภาพปกติ ไม่จำเป็นต้องใช้งาน</font></td><?php } ?>
																						<td class="center font_brown hidden-1100">
																							<?php
																													$sql_cat_list = ams_sql("select * from  category where id=? ", ["$rs[id_category]"]);
																													$qr_cat_list=ams_query($link,$sql_cat_list) or die ("เลือกข้อมูลไม่ได้");
																													$rs_cat_list=mysqli_fetch_array($qr_cat_list);
																													$name_category_list=$rs_cat_list['name_category'];
																							?>
																							<?php echo $name_category_list; ?>
																						</td>

																						<td class="center hidden-800"><a  href="detail_barcode.php?id=<?php echo $rs['id']; ?>" class="fancybox fancybox.ajax"><i class="ace-icon fa fa-barcode bigger-130"></i></a></td>
																						<td class="center hidden-800">
																							<?php if($rs['file_img']!="") { ?>
																							<a  href="detail_data.php?id=<?php echo $rs['id']; ?>" class="fancybox fancybox.ajax"><i class="ace-icon fa fa-file-text bigger-130"></i></a>
																							<?php } else { echo "-"; }?>
																						</td>
																						<td class="center hidden-800">
																							<?php if($rs['file_att']!="") { ?>
																							<a  href="file_att/<?php echo $rs['year_budget'];?>/<?php echo $rs['file_att'];?>" target="_blank"> <i class="ace-icon fa fa-tag bigger-130"></i></a>
																						<?php } else { echo "-"; }?>
																						</td>

																						<?php if($level!="0") { ?>
                                            <td class="center hidden-1200"> <a class="green" href="form_edit.php?id=<?php echo $rs['id']; ?>&d4=1"><i class="ace-icon fa fa-pencil bigger-130"></i></a></td>
                                            <td class="center hidden-1200"><a class="red" href="delete_data.php?id=<?php echo $rs['id']; ?>" onClick="return Conf<?php echo $rs['id']; ?>(this)">
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


                                    </div>
                                  </div>

																	<?php   if ($total2 == 0 || $total_p2 == "1")  {  } else {  ?>
																		<div class="pull-right pagination9">
																			<li>
																				<?php page_navigator2($before_p2,$plus_p2,$total2,$total_p2,$chk_page2,$d4,$choose_year,$choose_category,$choose_status,$txt_no,$txt_title,$g); ?>
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
