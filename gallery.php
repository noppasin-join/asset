<?php require_once __DIR__ . '/admin/security.php'; ?>
<?php
	include ("con_lda.php");
	set_time_limit(0);

$choose_year = $choose_category = $txt_name = $txt_user = $urlquery_str2 = $radiobutton = '';
$s_page2 = $chk_page2 = 0;
$g=$_GET['g'] ?? '';
if ($g==1) {
	$choose_year=$_GET['choose_year'] ?? '';
	$choose_category=$_GET['choose_category'] ?? '';
	$txt_name=$_GET['txt_name'] ?? '';

$s_page2=$_GET['s_page2'] ?? '';
$urlquery_str2=$_GET['urlquery_str2'] ?? '';
$radiobutton=$_GET['radiobutton'] ?? '';

}

$p=$_POST['p'] ?? '';
if ($p==1) {
	$choose_year=$_POST['choose_year'] ?? '';
	$choose_category=$_POST['choose_category'] ?? '';
	$txt_name=$_POST['txt_name'] ?? '';
	$GLR=$_POST['GLR'] ?? '';

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


<link rel="stylesheet" href="admin/assets/css/colorbox.min.css" />

<?php
// สร้างฟังก์ชั่น สำหรับแสดงการแบ่งหน้า
function page_navigator2($before_p2,$plus_p2,$total2,$total_p2,$chk_page2,$GL,$choose_year,$choose_category,$txt_name,$g){
global $urlquery_str2;
$pPrev=$chk_page2-1;
$pPrev=($pPrev>=0)?$pPrev:0;
$pNext=$chk_page2+1;
$pNext=($pNext>=$total_p2)?$total_p2-1:$pNext;
$lt_page=$total_p2-4;
if($chk_page2>0){
echo "<a  href='?s_page2=$pPrev&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&GL=1&&choose_year=$choose_year&&choose_category=$choose_category&&txt_name=$txt_name&&g=1' class='naviPN'><<</a>";
}
if($total_p2>=11){
if($chk_page2>=4){
echo "<a $nClass href='?s_page2=0&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&GL=1&&choose_year=$choose_year&&choose_category=$choose_category&&txt_name=$txt_name&&g=1'>1</a><a class='SpaceC'>. . .</a>";
}
if($chk_page2<4){
for($i=0;$i<$total_p2;$i++){
$nClass=($chk_page2==$i)?"class='selectPage'":"";
if($i<=4){
echo "<a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&GL=1&&choose_year=$choose_year&&choose_category=$choose_category&&txt_name=$txt_name&&g=1'>".intval($i+1)."</a> ";
}
if($i==$total_p2-1 ){
echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&GL=1&&choose_year=$choose_year&&choose_category=$choose_category&&txt_name=$txt_name&&g=1'>".intval($i+1)."</a> ";
}
}
}
if($chk_page2>=4 && $chk_page2<$lt_page){
$st_page=$chk_page2-3;
for($i=1;$i<=5;$i++){
$nClass=($chk_page2==($st_page+$i))?"class='selectPage'":"";
echo "<a $nClass href='?s_page2=".intval($st_page+$i)."&&radiobutton=2&&GL=1&&choose_year=$choose_year&&choose_category=$choose_category&&txt_name=$txt_name&&g=1'>".intval($st_page+$i+1)."</a> ";
}
for($i=0;$i<$total_p2;$i++){
if($i==$total_p2-1 ){
$nClass=($chk_page2==$i)?"class='selectPage'":"";
echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&GL=1&&choose_year=$choose_year&&choose_category=$choose_category&&txt_name=$txt_name&&g=1'>".intval($i+1)."</a> ";
}
}
}
if($chk_page2>=$lt_page){
for($i=0;$i<=4;$i++){
$nClass=($chk_page2==($lt_page+$i-1))?"class='selectPage'":"";
echo "<a $nClass href='?s_page2=".intval($lt_page+$i-1)."&&radiobutton=2&&GL=1&&choose_year=$choose_year&&choose_category=$choose_category&&txt_name=$txt_name&&g=1'>".intval($lt_page+$i)."</a> ";
}
}
}else{
for($i=0;$i<$total_p2;$i++){
$nClass=($chk_page2==$i)?"class='selectPage'":"";
echo "<a href='?s_page2=$i&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&GL=1&&choose_year=$choose_year&&choose_category=$choose_category&&txt_name=$txt_name&&g=1' $nClass  >".intval($i+1)."</a> ";
}
}
if($chk_page2<$total_p2-1){
echo "<a href='?s_page2=$pNext&urlquery_str2=".$urlquery_str2."&&radiobutton=2&&GL=1&&choose_year=$choose_year&&choose_category=$choose_category&&txt_name=$txt_name&&g=1'  class='naviPN'>>></a>";
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
                <li class="active">Gallery</li>
              </ul><!-- /.breadcrumb -->

            </div>




            <div class="page-content">

                <div class="row">
                  <div class="alert9 alert-info font_brown">
                    <form name="form_choose" method="post" action="gallery.php">
                      <input type="hidden" name="GLR" value="1">
                      <input type="hidden" name="p" value="1">
											<input type="hidden" name="choose_year" value="<?php echo $choose_year; ?>">
											<input type="hidden" name="choose_category" value="<?php echo $choose_year; ?>">

                      <input type="hidden" name="txt_name" value="<?php echo $txt_name; ?>">

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

											&nbsp;&nbsp;&nbsp; Category :
											<select name="choose_category" onChange="submit();" style="font-size:13px;" >
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




                    </form>



                  </div>



                </div>



								<?php
					if($choose_year=="") {
							if($choose_category=="") {
									if($txt_name=="") {
											$q = "select * from  data_lda where status_borrow='1' group by lda_list order by lda_list  ";
									} else {
										 $q = ams_sql("select * from  data_lda where status_borrow='1' and lda_list like ? group by lda_list order by lda_list  ", ["%$txt_name%"]);
									}
							} else {
									if($txt_name=="") {
											$q = ams_sql("select * from  data_lda where status_borrow='1' and id_category=? group by lda_list order by lda_list  ", ["$choose_category"]);
									} else {
											$q = ams_sql("select * from  data_lda where status_borrow='1' and id_category=? and lda_list like ? group by lda_list order by lda_list  ", ["$choose_category", "%$txt_name%"]);
									}
							}
					} else {
						if($choose_category=="") {
									if($txt_name=="") {
											$q = ams_sql("select * from  data_lda where status_borrow='1' and year_budget=? group by lda_list order by lda_list  ", ["$choose_year"]);
									} else {
										  $q = ams_sql("select * from  data_lda where status_borrow='1' and year_budget=? and lda_list like ? group by lda_list order by lda_list  ", ["$choose_year", "%$txt_name%"]);
									}
						} else {
									if($txt_name=="") {
											$q = ams_sql("select * from  data_lda where status_borrow='1' and id_category=? and year_budget=? group by lda_list order by lda_list  ", ["$choose_category", "$choose_year"]);
									} else {
											$q = ams_sql("select * from  data_lda where status_borrow='1' and id_category=? and year_budget=? and lda_list like ? group by lda_list order by lda_list  ", ["$choose_category", "$choose_year", "%$txt_name%"]);
									}
						}
					}


					$qr=ams_query($link,$q);
					$total2=mysqli_num_rows($qr);
								?>

								<?php if($total2!=0) { ?>
								<!-- search -->
								<div class="row">
                    <div class="col-xs-12">
                      <div class="nav-search56" id="nav-search">
                        <form class="form-search">
                          <span class="input-icon">
                          <input type="text" placeholder="Asset ..." class="nav-search-input5"  autocomplete="off" name="txt_name" value="<?php echo $txt_name; ?>"  />
                          <i class="ace-icon fa fa-search nav-search-icon"></i> </span>
                          <input type="hidden" name="g" value="1">
                          <input type="hidden" name="GL" value="1">
                          <input type="hidden" name="choose_year" value="<?php echo $choose_year; ?>">
                          <input type="hidden" name="choose_category" value="<?php echo $choose_category; ?>">
                        </form>
                      </div>



                    </div>

                  </div>
								<?php } ?>
									<div class="row" style="padding:14px;"> </div>
								<!-- search -->

								<?php
								$e_page=100; //
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

								if($total2!=0) {
								?>

								<div class="row">
									<div class="col-xs-12">
										<!-- PAGE CONTENT BEGINS -->
										<div>
											<ul class="ace-thumbnails clearfix">

												<?php
												while($rs=mysqli_fetch_array($qr))
												{
												?>
												<li>
													<a href="admin/file_img/<?php echo $rs['year_budget']; ?>/<?php echo $rs['barcode1']; ?>.jpg" title="Data List : <?php echo $rs['lda_list']; ?>" data-rel="colorbox">
														<img width="150" height="150" src="admin/file_img/<?php echo $rs['year_budget']; ?>/<?php echo $rs['barcode1']; ?>.jpg" />
														<div class="text">
															<div class="inner"><?php echo $rs['lda_list']; ?></div>
														</div>
													</a>
												</li>
												<?php } ?>

											</ul>
										</div><!-- PAGE CONTENT ENDS -->
									 </div><!-- /.col -->
									</div>

							    <?php } ?>

									<?php if($total2=="0") { ?>
									<div class="alert alert-block alert-danger row" id="success-alert">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>

										<i class="ace-icon fa fa-times black"></i>

										<b class="black"><u>No data</u></b>  &nbsp;&nbsp;Please choose again!
									</div>
									<?php } ?>

									<?php   if ($total2 == 0 || $total_p2 == "1")  {  } else {  ?>
										<div class="pull-left pagination9" style="padding-top:8px;">
											<li>
												<?php page_navigator2($before_p2,$plus_p2,$total2,$total_p2,$chk_page2,$GL,$choose_year,$choose_category,$txt_name,$g); ?>
											</li>
										</div>
									<?php } ?>



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




			<!--[if !IE]> -->
		<script src="admin/assets/js/jquery.2.1.1.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='admin/assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<!-- page specific plugin scripts -->
		<script src="admin/assets/js/jquery.colorbox.min.js"></script>

		<!-- ace scripts -->

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
	var $overflow = '';
	var colorbox_params = {
		rel: 'colorbox',
		reposition:true,
		scalePhotos:true,
		scrolling:false,
		previous:'<i class="ace-icon fa fa-arrow-left"></i>',
		next:'<i class="ace-icon fa fa-arrow-right"></i>',
		close:'&times;',
		current:'{current} of {total} ',
		maxWidth:'100%',
		maxHeight:'100%',
		onOpen:function(){
			$overflow = document.body.style.overflow;
			document.body.style.overflow = 'hidden';
		},
		onClosed:function(){
			document.body.style.overflow = $overflow;
		},
		onComplete:function(){
			$.colorbox.resize();
		}
	};

	$('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
	$("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon


	$(document).one('ajaxloadstart.page', function(e) {
		$('#colorbox, #cboxOverlay').remove();
   });
})
		</script>




  </body>

</html>
