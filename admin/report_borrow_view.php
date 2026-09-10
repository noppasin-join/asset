<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$g = '';
$choose_year = '';
$for_month = '';
$id_category = '';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
	$sess_user = $_SESSION['sess_user'] ?? '';
	$sess_password = $_SESSION['sess_password'] ?? '';

	require_once __DIR__ . '/con_lda.php';
	if ($sess_user == "" || $status!=0) {
    ams_deny(403, 'Insufficient permissions.');
	} else {
	set_time_limit(0);


$g=$_GET['g'] ?? '';
	$choose_year=$_GET['choose_year'] ?? '';
	$for_month=$_GET['for_month'] ?? '';
	$id_category=$_GET['id_category'] ?? '';
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

      <div class="main-container" id="main-container">


        <div class="main-content">
          <div class="main-content-inner">

						<?php
						$sql_year="SELECT * FROM budget order by year_budget desc";
						$query_year=ams_query($link,$sql_year);
							$result_year=mysqli_fetch_array($query_year);
								$year_budget=$result_year['year_budget'];
						?>
						<?php
							$sql_cat = ams_sql("select * from  category where id=? ", ["$id_category"]);
							$qr_cat=ams_query($link,$sql_cat) or die ("เลือกข้อมูลไม่ได้");
							$rs_cat=mysqli_fetch_array($qr_cat);
							$name_category=$rs_cat['name_category'];
						?>
						<table border="0" width="100%">

							<tr>
								<td height="20"> </td>
							</tr>
							<tr>
								<td align="center" style="font-size:15px;color:#797e7c;"><b>รายงานยืมวัสดุ/ครุภัณฑ์</b></td>
							</tr>
							<tr>
								<td height="5"> </td>
							</tr>
							<tr>
								<td align="center" style="font-size:15px;color:#797e7c;">ศูนย์บรรณสารและสื่อการศึกษา</td>
							</tr>
							<tr>
								<td height="15"> </td>
							</tr>
							<tr>
								<td style="font-size:14px;padding-left:20px;color:#797e7c;">ปีงบประมาณ :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;
									<?php if($choose_year!="") { echo $choose_year; } else { echo $year_budget; }?>
									&nbsp;&nbsp;</font>&nbsp;&nbsp;
									หมวดหมู่ :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo $name_category; ?>&nbsp;&nbsp;</font>&nbsp;&nbsp;
									<?php if($for_month!="") { ?>
									ประจำเดือน :&nbsp;&nbsp;
									<font class="under_line_blue">&nbsp;&nbsp;
										<?php if($for_month=="01") { echo "มกราคม"; } ?>
										<?php if($for_month=="02") { echo "กุมภาพันธ์"; } ?>
										<?php if($for_month=="03") { echo "มีนาคม"; } ?>
										<?php if($for_month=="04") { echo "เมษายน"; } ?>
										<?php if($for_month=="05") { echo "พฤษภาคม"; } ?>
										<?php if($for_month=="06") { echo "มิถุนายน"; } ?>
										<?php if($for_month=="07") { echo "กรกฎาคม"; } ?>
										<?php if($for_month=="08") { echo "สิงหาคม"; } ?>
										<?php if($for_month=="09") { echo "กันยายน"; } ?>
										<?php if($for_month=="10") { echo "ตุลาคม"; } ?>
										<?php if($for_month=="11") { echo "พฤศจิกายน"; } ?>
										<?php if($for_month=="12") { echo "ธันวาคม"; } ?>
										&nbsp;&nbsp;</font>
									<?php } ?>
								</td>
							</tr>
						</table>

            <div class="page-content">



<?php
	if($for_month!="") {
				if($choose_year=="") {
					$q=ams_sql("SELECT * FROM data_take_list_more where year_budget=? and id_category=? and for_month=? order by id ", ["$year_budget", "$id_category", "$for_month"]);
				} else {
					$q=ams_sql("SELECT * FROM data_take_list_more where year_budget=? and id_category=? and for_month=? order by id ", ["$choose_year", "$id_category", "$for_month"]);
				}
	} else {
				if($choose_year=="") {
					$q=ams_sql("SELECT * FROM data_take_list_more where year_budget=? and id_category=? order by id ", ["$year_budget", "$id_category"]);
				} else {
					$q=ams_sql("SELECT * FROM data_take_list_more where year_budget=? and id_category=? order by id ", ["$choose_year", "$id_category"]);
				}
	}
										$qr=ams_query($link,$q);
										$total2=mysqli_num_rows($qr);
?>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">

<table class="table100 table-striped table-bordered">
		<tr>
				<td class="center font_bg_white" style="vertical-align:middle;width:10px;">ลำดับ</td>
        <td class="center font_bg_white" style="vertical-align:middle;">วัน/เดือน/ปี</td>
				<td class="center font_bg_white" style="vertical-align:middle;">ชื่อ-นามสกุล</td>
				<td class="center font_bg_white" style="vertical-align:middle;">หน่วยงาน</td>
				<td class="center font_bg_white" style="vertical-align:middle;">เลขครุภัณฑ์</td>
				<td class="center font_bg_white" style="vertical-align:middle;">ชื่อครุภัณฑ์</td>
				<td class="center font_bg_white" style="vertical-align:middle;">วันที่ยืม</td>
				<td class="center font_bg_white" style="vertical-align:middle;">วันที่คืน</td>
    </tr>
		<?php
			   $i=1;
				 $i_data=0;
				 while($i_data<$total2) {
						$rs_cate=mysqli_fetch_array($qr);
						$id_data_lda=$rs_cate['id_data_lda'];
						$id_data_take=$rs_cate['id_data_take'];
						$id_data_take_list=$rs_cate['id_data_take_list'];
						$barcode=$rs_cate['barcode'];

						$sql_take=ams_sql("SELECT * FROM data_take where id=?", ["$id_data_take"]);
						$qr_take=ams_query($link,$sql_take);
							$rs_take=mysqli_fetch_array($qr_take);
							$name_list=$rs_take['name'];
							$surname_list=$rs_take['surname'];
							$day_submit=$rs_take['day_submit'];
							$month_submit=$rs_take['month_submit'];
							$year_submit=$rs_take['year_submit'];
							$department=$rs_take['department'];
							$checkout=$rs_take['checkout'];
							$checkin=$rs_take['checkin'];

							$sql_list=ams_sql("SELECT * FROM data_take_list where id=?", ["$id_data_take_list"]);
							$qr_list=ams_query($link,$sql_list);
								$rs_list=mysqli_fetch_array($qr_list);
								$title=$rs_list['title'];
    ?>
<tr>
	<td class="center font_brown"><?php echo $i; ?>.</td>
	<td class="center font_brown"><?php echo $day_submit; ?>/<?php echo $month_submit; ?>/<?php echo $year_submit; ?></td>
	<td class="font_brown" style="padding-left:10px;"><?php echo $name_list; ?> &nbsp;<?php echo $surname_list; ?></td>
	<td class="font_brown" style="padding-left:10px;"><?php echo $department; ?></td>
	<td class="center font_brown"><?php echo $barcode; ?></td>
	<td class="font_brown" style="padding-left:10px;"><?php echo $title; ?></td>
	<td class="center font_brown"><?php echo $checkout; ?></td>
	<td class="center font_brown"><?php echo $checkin; ?></td>
</tr>
                                          <?php $i++;$i_data++; } ?>
                                      </table>

                        </div>
          </div>



            </div>

					</div><!-- /.main-content -->


          </div>





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
