<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$g = '';
$choose_staff = '';
$s_page2 = '';
$urlquery_str2 = '';
$radiobutton = '';
$var_dpm = '';
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





				<style> body { font-family: sarabun; } </style>
				<link rel="stylesheet" href="AdminLTE.min.css">
				<script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>

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
$sql_year="SELECT * FROM data_config  order by year_budget desc";
$query_year=ams_query($link,$sql_year);
$result_year=mysqli_fetch_array($query_year);
$year_budget=$result_year['year_budget'];

$q="SELECT * FROM data_location where status_location='0'  order by name_location";
$qr=ams_query($link,$q);
$total2=mysqli_num_rows($qr);

$q_data="SELECT * FROM data_lda where status_check='1'";
$qr_data=ams_query($link,$q_data);
$total_data=mysqli_num_rows($qr_data);

$var_dpm=$_GET['var_dpm'] ?? '';
?>

<div class="row" style="padding-top: 10px;">
<div class="col-sm-12 col-xs-12">
	<a href="form_setting.php?s1=1&var_dpm=1" class="font_link">ฝ่ายเลขานุการและธุรการ + ฝ่ายเทคโนโลยีสารสนเทศ</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="form_setting.php?s1=1&var_dpm=2" class="font_link">ฝ่ายบริการทรัพยากรสารนิเทศ</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="form_setting.php?s1=1&var_dpm=3" class="font_link">ฝ่ายพัฒนาและจัดระบบทรัพยากรสารนิเทศ</a>
</div>
</div>

<div class="row" style="padding-top: 10px;">
<div class="col-sm-12 col-xs-12">
<div >
<table class="table9 table-striped table-bordered table-hover">
<thead>

<tr>
<td class="head_blue" colspan="15"> :: ปีงบประมาณ : <font color="#e8f652" size="2"><?php echo $year_budget; ?></font>
	รายการครุภัณฑ์ : <font color="#e8f652" size="2"> <?php echo number_format( $total_data ); ?></font> รายการ
</td>
</tr>

<tr>
<th class="center font_brown70" colspan="2">สถานที่ใช้งาน</th>
<th class="center font_brown70">จำนวนรายการ</th>
<?php if($var_dpm!="") { ?>
<?php
$q_mem=ams_sql("SELECT * FROM member where status='0' and id_department=? order by name", ["$var_dpm"]);
$qr_mem=ams_query($link,$q_mem);
$total_mem=mysqli_num_rows($qr_mem);
$i_mem=0;
while ($i_mem<$total_mem) {
	$rs_mem=mysqli_fetch_array($qr_mem);
	$name_data=$rs_mem['name'];
 ?>
<th class="center font_brown70"><?php echo $name_data; ?></th>
<?php $i_mem++; } ?>
<?php } ?>
</tr>
</thead>
<tbody>
<?php
if($total2!=0){
$i=1;
while($rs=mysqli_fetch_array($qr))
{
	$q_location=ams_sql("SELECT * FROM data_lda where status_check='1' and id_location=?", ["$rs[id]"]);
	$qr_location=ams_query($link,$q_location);
	$total_location=mysqli_num_rows($qr_location);
?>
<tr>
<td class="center font_brown"><?php echo $i; ?>.</td>
<td class="font_brown"><?php echo $rs['name_location']; ?></td>
<td class="center font_brown"><?php echo number_format( $total_location ); ?></td>

<?php if($var_dpm!="") { ?>
	<?php
	$q_mem2=ams_sql("SELECT * FROM member where status='0' and id_department=? order by name", ["$var_dpm"]);
	$qr_mem2=ams_query($link,$q_mem2);
	$total_mem2=mysqli_num_rows($qr_mem2);
	$i_mem2=0;
	while ($i_mem2<$total_mem2) {
		$rs_mem2=mysqli_fetch_array($qr_mem2);
		$id_check=$rs_mem2['id'];

		$q_check=ams_sql("SELECT * FROM data_check_config where year_budget=? and id_member=? and id_location=?", ["$year_budget", "$id_check", "$rs[id]"]);
		$qr_check=ams_query($link,$q_check);
		$total_check=mysqli_num_rows($qr_check);
	 ?>
	<td class="center">
		<?php if($total_check!="0") { ?>
			<a href="manage_check.php?id_location=<?php echo $rs['id'];?>&id_mem=<?php echo $id_check;?>&var_dpm=<?php echo $var_dpm;?>&v_del=1" target="_parent"><i class="fa fa-check green bigger-120"></i></a>
	  <?php } else { ?>
		<a href="manage_check.php?id_location=<?php echo $rs['id'];?>&id_mem=<?php echo $id_check;?>&var_dpm=<?php echo $var_dpm;?>&v_add=1" target="_parent" style="color: #dfdfdf;"><i class="fa fa-check bigger-100"></i></a>
	  <?php } ?>
	</td>
	<?php $i_mem2++; } ?>
<?php } ?>



</tr>

<?php $i++; } ?>
<?php } else { ?>
<tr>
<td class="center font_brown" colspan="3"><< ไม่มีข้อมูล >></td>
</tr>
<?php } ?>
</tbody>
</table>

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
