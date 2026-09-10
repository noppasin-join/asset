<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
$v_all_1 = 0;
$v_all_2 = 0;
$v_all_3 = 0;
$v_all_4 = 0;
$v_all_5 = 0;
$v_all_6 = 0;
$v_all_7 = 0;
$v_all_8 = 0;
$v_all_9 = 0;
$v_all_10 = 0;
$v_all_11 = 0;
$v_all_12 = 0;

	$g = '';
$choose_year = '';
$p = '';
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
}

$p=$_POST['p'] ?? '';
if ($p==1) {
	$choose_year=$_POST['choose_year'] ?? '';
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
                <li class="active">รายงานข้อมูลการส่งซ่อม</li>
              </ul><!-- /.breadcrumb -->

            </div>
						<?php
						$sql_year="SELECT * FROM budget order by year_budget desc";
						$query_year=ams_query($link,$sql_year);
							$result_year=mysqli_fetch_array($query_year);
								$year_budget=$result_year['year_budget'];
						?>
            <div class="page-content">

                <div class="row">
                  <div class="alert9 alert-info font_brown">
                    <form name="form_choose" method="post" action="report_repair.php">
                      <input type="hidden" name="j631" value="1">
                      <input type="hidden" name="p" value="1">
                      <input type="hidden" name="choose_year" value="<?php echo $choose_year; ?>">

                      <i class="ace-icon fa fa-hand-o-right"></i> ปีงบประมาณ :
                        <select name="choose_year"  onChange="submit();" >
                        <?php if ($choose_year == "") { ?>

                        <option value="" selected><?php echo $year_budget; ?></option>
												<option value="">----</option>
                        <?php } else { ?>
													<option value="" selected><?php echo $choose_year; ?></option>
													<option value="">----</option>
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


											<?php if($level!="0") {?>
												<div class="pull-right hidden-800">
													<a href="export_report_repair.php?choose_year=<?php echo $choose_year; ?>" target="_blank" >
					                <button class="btn bg-sky2" type="button">Export &nbsp;<i class="fa fa-mail-forward"></i></button>
					                </a>
											  </div>
											<?php } ?>


                    </form>

                  </div>

                </div>

									  <?php
										$q="SELECT * FROM category order by name_category";
										$qr=ams_query($link,$q);
										$total2=mysqli_num_rows($qr);
									  ?>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">

                                      <table class="table100 table-striped table-bordered">
                                          <tr>
                                            <td class="center font_bg_white" style="vertical-align:middle;width:10px;">ลำดับ</td>
                                            <td class="center font_bg_white" style="vertical-align:middle;">หมวดหมู่</td>

																						<td class="center font_bg_white" style="vertical-align:middle;">ต.ค.<br/>(จำนวน)</td>
																						<td class="center font_bg_white" style="vertical-align:middle;">พ.ย.<br/>(จำนวน)</td>
																						<td class="center font_bg_white" style="vertical-align:middle;">ธ.ค.<br/>(จำนวน)</td>
																						<td class="center font_bg_white" style="vertical-align:middle;">ม.ค.<br/>(จำนวน)</td>
																						<td class="center font_bg_white" style="vertical-align:middle;">ก.พ.<br/>(จำนวน)</td>
																						<td class="center font_bg_white" style="vertical-align:middle;">มี.ค.<br/>(จำนวน)</td>
																						<td class="center font_bg_white" style="vertical-align:middle;">เม.ย.<br/>(จำนวน)</td>
																						<td class="center font_bg_white" style="vertical-align:middle;">พ.ค.<br/>(จำนวน)</td>
																						<td class="center font_bg_white" style="vertical-align:middle;">มื.ย.<br/>(จำนวน)</td>
																						<td class="center font_bg_white" style="vertical-align:middle;">ก.ค.<br/>(จำนวน)</td>
																						<td class="center font_bg_white" style="vertical-align:middle;">ส.ค.<br/>(จำนวน)</td>
																						<td class="center font_bg_white" style="vertical-align:middle;">ก.ย.<br/>(จำนวน)</td>
                                            <td class="center font_bg_white" style="vertical-align:middle;">รวม<br/>(จำนวน)</td>

                                          </tr>


																					 <?php if($total2!="0") { ?>
                                          <?php
																						$i=1;
																						$i_data=0;
																						while($i_data<$total2)
																					  {
																											$rs_cate=mysqli_fetch_array($qr);
																											$id_cate=$rs_cate['id'];
																											$name_category=$rs_cate['name_category'];
                                            ?>
<?php
if($choose_year=="") {
$sql_1 = ams_sql("select * from  data_repair where year_budget=? and month_checkout='01' and id_category=?  ", ["$year_budget", "$id_cate"]); $qr_1=ams_query($link,$sql_1) or die ("เลือกข้อมูลไม่ได้");$num_1=mysqli_num_rows($qr_1);
$sql_2 = ams_sql("select * from  data_repair where year_budget=? and month_checkout='02' and id_category=?  ", ["$year_budget", "$id_cate"]); $qr_2=ams_query($link,$sql_2) or die ("เลือกข้อมูลไม่ได้");$num_2=mysqli_num_rows($qr_2);
$sql_3 = ams_sql("select * from  data_repair where year_budget=? and month_checkout='03' and id_category=?  ", ["$year_budget", "$id_cate"]); $qr_3=ams_query($link,$sql_3) or die ("เลือกข้อมูลไม่ได้");$num_3=mysqli_num_rows($qr_3);
$sql_4 = ams_sql("select * from  data_repair where year_budget=? and month_checkout='04' and id_category=?  ", ["$year_budget", "$id_cate"]); $qr_4=ams_query($link,$sql_4) or die ("เลือกข้อมูลไม่ได้");$num_4=mysqli_num_rows($qr_4);
$sql_5 = ams_sql("select * from  data_repair where year_budget=? and month_checkout='05' and id_category=?  ", ["$year_budget", "$id_cate"]); $qr_5=ams_query($link,$sql_5) or die ("เลือกข้อมูลไม่ได้");$num_5=mysqli_num_rows($qr_5);
$sql_6 = ams_sql("select * from  data_repair where year_budget=? and month_checkout='06' and id_category=?  ", ["$year_budget", "$id_cate"]); $qr_6=ams_query($link,$sql_6) or die ("เลือกข้อมูลไม่ได้");$num_6=mysqli_num_rows($qr_6);
$sql_7 = ams_sql("select * from  data_repair where year_budget=? and month_checkout='07' and id_category=?  ", ["$year_budget", "$id_cate"]); $qr_7=ams_query($link,$sql_7) or die ("เลือกข้อมูลไม่ได้");$num_7=mysqli_num_rows($qr_7);
$sql_8 = ams_sql("select * from  data_repair where year_budget=? and month_checkout='08' and id_category=?  ", ["$year_budget", "$id_cate"]); $qr_8=ams_query($link,$sql_8) or die ("เลือกข้อมูลไม่ได้");$num_8=mysqli_num_rows($qr_8);
$sql_9 = ams_sql("select * from  data_repair where year_budget=? and month_checkout='09' and id_category=?  ", ["$year_budget", "$id_cate"]); $qr_9=ams_query($link,$sql_9) or die ("เลือกข้อมูลไม่ได้");$num_9=mysqli_num_rows($qr_9);
$sql_10 = ams_sql("select * from  data_repair where year_budget=? and month_checkout='10' and id_category=?  ", ["$year_budget", "$id_cate"]); $qr_10=ams_query($link,$sql_10) or die ("เลือกข้อมูลไม่ได้");$num_10=mysqli_num_rows($qr_10);
$sql_11 = ams_sql("select * from  data_repair where year_budget=? and month_checkout='11' and id_category=?  ", ["$year_budget", "$id_cate"]); $qr_11=ams_query($link,$sql_11) or die ("เลือกข้อมูลไม่ได้");$num_11=mysqli_num_rows($qr_11);
$sql_12 = ams_sql("select * from  data_repair where year_budget=? and month_checkout='12' and id_category=?  ", ["$year_budget", "$id_cate"]); $qr_12=ams_query($link,$sql_12) or die ("เลือกข้อมูลไม่ได้");$num_12=mysqli_num_rows($qr_12);
} else {
	$sql_1 = ams_sql("select * from  data_repair where year_budget=? and month_checkout='01' and id_category=?  ", ["$choose_year", "$id_cate"]); $qr_1=ams_query($link,$sql_1) or die ("เลือกข้อมูลไม่ได้");$num_1=mysqli_num_rows($qr_1);
	$sql_2 = ams_sql("select * from  data_repair where year_budget=? and month_checkout='02' and id_category=?  ", ["$choose_year", "$id_cate"]); $qr_2=ams_query($link,$sql_2) or die ("เลือกข้อมูลไม่ได้");$num_2=mysqli_num_rows($qr_2);
	$sql_3 = ams_sql("select * from  data_repair where year_budget=? and month_checkout='03' and id_category=?  ", ["$choose_year", "$id_cate"]); $qr_3=ams_query($link,$sql_3) or die ("เลือกข้อมูลไม่ได้");$num_3=mysqli_num_rows($qr_3);
	$sql_4 = ams_sql("select * from  data_repair where year_budget=? and month_checkout='04' and id_category=?  ", ["$choose_year", "$id_cate"]); $qr_4=ams_query($link,$sql_4) or die ("เลือกข้อมูลไม่ได้");$num_4=mysqli_num_rows($qr_4);
	$sql_5 = ams_sql("select * from  data_repair where year_budget=? and month_checkout='05' and id_category=?  ", ["$choose_year", "$id_cate"]); $qr_5=ams_query($link,$sql_5) or die ("เลือกข้อมูลไม่ได้");$num_5=mysqli_num_rows($qr_5);
	$sql_6 = ams_sql("select * from  data_repair where year_budget=? and month_checkout='06' and id_category=?  ", ["$choose_year", "$id_cate"]); $qr_6=ams_query($link,$sql_6) or die ("เลือกข้อมูลไม่ได้");$num_6=mysqli_num_rows($qr_6);
	$sql_7 = ams_sql("select * from  data_repair where year_budget=? and month_checkout='07' and id_category=?  ", ["$choose_year", "$id_cate"]); $qr_7=ams_query($link,$sql_7) or die ("เลือกข้อมูลไม่ได้");$num_7=mysqli_num_rows($qr_7);
	$sql_8 = ams_sql("select * from  data_repair where year_budget=? and month_checkout='08' and id_category=?  ", ["$choose_year", "$id_cate"]); $qr_8=ams_query($link,$sql_8) or die ("เลือกข้อมูลไม่ได้");$num_8=mysqli_num_rows($qr_8);
	$sql_9 = ams_sql("select * from  data_repair where year_budget=? and month_checkout='09' and id_category=?  ", ["$choose_year", "$id_cate"]); $qr_9=ams_query($link,$sql_9) or die ("เลือกข้อมูลไม่ได้");$num_9=mysqli_num_rows($qr_9);
	$sql_10 = ams_sql("select * from  data_repair where year_budget=? and month_checkout='10' and id_category=?  ", ["$choose_year", "$id_cate"]); $qr_10=ams_query($link,$sql_10) or die ("เลือกข้อมูลไม่ได้");$num_10=mysqli_num_rows($qr_10);
	$sql_11 = ams_sql("select * from  data_repair where year_budget=? and month_checkout='11' and id_category=?  ", ["$choose_year", "$id_cate"]); $qr_11=ams_query($link,$sql_11) or die ("เลือกข้อมูลไม่ได้");$num_11=mysqli_num_rows($qr_11);
	$sql_12 = ams_sql("select * from  data_repair where year_budget=? and month_checkout='12' and id_category=?  ", ["$choose_year", "$id_cate"]); $qr_12=ams_query($link,$sql_12) or die ("เลือกข้อมูลไม่ได้");$num_12=mysqli_num_rows($qr_12);
}
$var_num=$num_1+$num_2+$num_3+$num_4+$num_5+$num_6+$num_7+$num_8+$num_9+$num_10+$num_11+$num_12;
?>
<tr>
	<td class="center font_brown"><?php echo $i; ?>.</td>
	<td style="padding-left: 10px;" class="font_brown"><?php echo $name_category; ?></td>

	<!-- period 1 -->
	<td class="center font_brown" bgcolor="#eef5f6">
		<?php if($num_10!="0") { ?>
			<a href="report_repair_view.php?month_checkout=10&choose_year=<?php echo $choose_year;?>&id_category=<?php echo $id_cate;?>" target="_blank"><?php echo number_format( $num_10 ) ; ?></a>
		<?php } else { echo "-"; } ?>
	</td>
	<td class="center font_brown" bgcolor="#eef5f6">
		<?php if($num_11!="0") { ?>
			<a href="report_repair_view.php?month_checkout=11&choose_year=<?php echo $choose_year;?>&id_category=<?php echo $id_cate;?>" target="_blank"><?php echo number_format( $num_11 ) ; ?></a>
		<?php } else { echo "-"; } ?>
	</td>
	<td class="center font_brown" bgcolor="#eef5f6">
		<?php if($num_12!="0") { ?>
			<a href="report_repair_view.php?month_checkout=12&choose_year=<?php echo $choose_year;?>&id_category=<?php echo $id_cate;?>" target="_blank"><?php echo number_format( $num_12 ) ; ?></a>
		<?php } else { echo "-"; } ?>
	</td>

<!-- period 2 -->
	<td class="center font_brown" bgcolor="#eff6ee">
		<?php if($num_1!="0") { ?>
			<a href="report_repair_view.php?month_checkout=01&choose_year=<?php echo $choose_year;?>&id_category=<?php echo $id_cate;?>" target="_blank"><?php echo number_format( $num_1 ) ; ?></a>
		<?php } else { echo "-"; } ?>
	</td>
	<td class="center font_brown" bgcolor="#eff6ee">
		<?php if($num_2!="0") { ?>
			<a href="report_repair_view.php?month_checkout=02&choose_year=<?php echo $choose_year;?>&id_category=<?php echo $id_cate;?>" target="_blank"><?php echo number_format( $num_2 ) ; ?></a>
		<?php } else { echo "-"; } ?>
	</td>
	<td class="center font_brown" bgcolor="#eff6ee">
		<?php if($num_3!="0") { ?>
			<a href="report_repair_view.php?month_checkout=03&choose_year=<?php echo $choose_year;?>&id_category=<?php echo $id_cate;?>" target="_blank"><?php echo number_format( $num_3 ) ; ?></a>
		<?php } else { echo "-"; } ?>
	</td>

	<!-- period 3 -->
	<td class="center font_brown" bgcolor="#eef5f6">
		<?php if($num_4!="0") { ?>
			<a href="report_repair_view.php?month_checkout=04&choose_year=<?php echo $choose_year;?>&id_category=<?php echo $id_cate;?>" target="_blank"><?php echo number_format( $num_4 ) ; ?></a>
		<?php } else { echo "-"; } ?>
	</td>
	<td class="center font_brown" bgcolor="#eef5f6">
		<?php if($num_5!="0") { ?>
			<a href="report_repair_view.php?month_checkout=05&choose_year=<?php echo $choose_year;?>&id_category=<?php echo $id_cate;?>" target="_blank"><?php echo number_format( $num_5 ) ; ?></a>
		<?php } else { echo "-"; } ?>
	</td>
	<td class="center font_brown" bgcolor="#eef5f6">
		<?php if($num_6!="0") { ?>
			<a href="report_repair_view.php?month_checkout=06&choose_year=<?php echo $choose_year;?>&id_category=<?php echo $id_cate;?>" target="_blank"><?php echo number_format( $num_6 ) ; ?></a>
		<?php } else { echo "-"; } ?>
	</td>

	<!-- period 4 -->
		<td class="center font_brown" bgcolor="#eff6ee">
			<?php if($num_7!="0") { ?>
				<a href="report_repair_view.php?month_checkout=07&choose_year=<?php echo $choose_year;?>&id_category=<?php echo $id_cate;?>" target="_blank"><?php echo number_format( $num_7 ) ; ?></a>
			<?php } else { echo "-"; } ?>
		</td>
		<td class="center font_brown" bgcolor="#eff6ee">
			<?php if($num_8!="0") { ?>
				<a href="report_repair_view.php?month_checkout=08&choose_year=<?php echo $choose_year;?>&id_category=<?php echo $id_cate;?>" target="_blank"><?php echo number_format( $num_8 ) ; ?></a>
			<?php } else { echo "-"; } ?>
		</td>
		<td class="center font_brown" bgcolor="#eff6ee">
			<?php if($num_9!="0") { ?>
				<a href="report_repair_view.php?month_checkout=09&choose_year=<?php echo $choose_year;?>&id_category=<?php echo $id_cate;?>" target="_blank"><?php echo number_format( $num_9 ) ; ?></a>
			<?php } else { echo "-"; } ?>
		</td>

		<!-- sum -->
		<td class="center font_brown" bgcolor="#fcfaf2"><?php if($var_num!="0") { ?><a href="report_repair_view.php?choose_year=<?php echo $choose_year;?>&id_category=<?php echo $id_cate;?>" target="_blank"><?php echo number_format( $var_num ) ; ?></a><?php } else { echo "-"; }?></td>
                                          </tr>
		<?php
		if($num_10!="0") {$v_all_10=$v_all_10+$num_10; }
		if($num_11!="0") {$v_all_11=$v_all_11+$num_11; }
		if($num_12!="0") {$v_all_12=$v_all_12+$num_12; }
		if($num_1!="0") {$v_all_1=$v_all_1+$num_1; }
		if($num_2!="0") {$v_all_2=$v_all_2+$num_2; }
		if($num_3!="0") {$v_all_3=$v_all_3+$num_3; }
		if($num_4!="0") {$v_all_4=$v_all_4+$num_4; }
		if($num_5!="0") {$v_all_5=$v_all_5+$num_5; }
		if($num_6!="0") {$v_all_6=$v_all_6+$num_6; }
		if($num_7!="0") {$v_all_7=$v_all_7+$num_7; }
		if($num_8!="0") {$v_all_8=$v_all_8+$num_8; }
		if($num_9!="0") {$v_all_9=$v_all_9+$num_9; }
		$vall_sum=$v_all_10+$v_all_11+$v_all_12+$v_all_1+$v_all_2+$v_all_3+$v_all_4+$v_all_5+$v_all_6+$v_all_7+$v_all_8+$v_all_9;
		?>
                                          <?php $i++;$i_data++; } ?>
																					<tr>
                                            <td colspan="2" class="center font_bg_white" style="vertical-align:middle;">รวม</td>
																						<td class="center font_brown" bgcolor="#fcfaf2"><?php if($v_all_10=="" || $v_all_10=="0") { echo "-"; } else { echo number_format( $v_all_10 ); } ?></td>
																						<td class="center font_brown" bgcolor="#fcfaf2"><?php if($v_all_11=="" || $v_all_11=="0") { echo "-"; } else { echo number_format( $v_all_11 ); } ?></td>
																						<td class="center font_brown" bgcolor="#fcfaf2"><?php if($v_all_12=="" || $v_all_12=="0") { echo "-"; } else { echo number_format( $v_all_12 ); } ?></td>
																						<td class="center font_brown" bgcolor="#fcfaf2"><?php if($v_all_1=="" || $v_all_1=="0") { echo "-"; } else { echo number_format( $v_all_1 ); } ?></td>
																						<td class="center font_brown" bgcolor="#fcfaf2"><?php if($v_all_2=="" || $v_all_2=="0") { echo "-"; } else { echo number_format( $v_all_2 ); } ?></td>
																						<td class="center font_brown" bgcolor="#fcfaf2"><?php if($v_all_3=="" || $v_all_3=="0") { echo "-"; } else { echo number_format( $v_all_3 ); } ?></td>
																						<td class="center font_brown" bgcolor="#fcfaf2"><?php if($v_all_4=="" || $v_all_4=="0") { echo "-"; } else { echo number_format( $v_all_4 ); } ?></td>
																						<td class="center font_brown" bgcolor="#fcfaf2"><?php if($v_all_5=="" || $v_all_5=="0") { echo "-"; } else { echo number_format( $v_all_5 ); } ?></td>
																						<td class="center font_brown" bgcolor="#fcfaf2"><?php if($v_all_6=="" || $v_all_6=="0") { echo "-"; } else { echo number_format( $v_all_6 ); } ?></td>
																						<td class="center font_brown" bgcolor="#fcfaf2"><?php if($v_all_7=="" || $v_all_7=="0") { echo "-"; } else { echo number_format( $v_all_7 ); } ?></td>
																						<td class="center font_brown" bgcolor="#fcfaf2"><?php if($v_all_8=="" || $v_all_8=="0") { echo "-"; } else { echo number_format( $v_all_8 ); } ?></td>
																						<td class="center font_brown" bgcolor="#fcfaf2"><?php if($v_all_9=="" || $v_all_9=="0") { echo "-"; } else { echo number_format( $v_all_9 ); } ?></td>
																						<td class="center font_brown" bgcolor="#fcfaf2"><?php if($vall_sum=="" || $vall_sum=="0") { echo "-"; } else { echo number_format( $vall_sum ); } ?></td>

                                          </tr>
                                          <?php } else { ?>
                                          <tr>
                                            <td class="center font_brown" colspan="15"><< ไม่มีข้อมูล >></td>
                                          </tr>
                                          <?php } ?>

                                      </table>



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
  </body>

</html>
<?php } ?>
