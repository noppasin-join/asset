<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
$for_month = '';

	$g = '';
$choose_year = '';
$month_checkout = '';
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
	$month_checkout=$_GET['month_checkout'] ?? '';
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
								<td align="center" style="font-size:15px;color:#797e7c;"><b>รายงานข้อมูลการส่งซ่อม</b></td>
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
									<?php if($month_checkout!="") { ?>
									ประจำเดือน :&nbsp;&nbsp;
									<font class="under_line_blue">&nbsp;&nbsp;
										<?php if($month_checkout=="01") { echo "มกราคม"; } ?>
										<?php if($month_checkout=="02") { echo "กุมภาพันธ์"; } ?>
										<?php if($month_checkout=="03") { echo "มีนาคม"; } ?>
										<?php if($month_checkout=="04") { echo "เมษายน"; } ?>
										<?php if($month_checkout=="05") { echo "พฤษภาคม"; } ?>
										<?php if($month_checkout=="06") { echo "มิถุนายน"; } ?>
										<?php if($month_checkout=="07") { echo "กรกฎาคม"; } ?>
										<?php if($month_checkout=="08") { echo "สิงหาคม"; } ?>
										<?php if($month_checkout=="09") { echo "กันยายน"; } ?>
										<?php if($month_checkout=="10") { echo "ตุลาคม"; } ?>
										<?php if($month_checkout=="11") { echo "พฤศจิกายน"; } ?>
										<?php if($month_checkout=="12") { echo "ธันวาคม"; } ?>
										&nbsp;&nbsp;</font>
									<?php } ?>
								</td>
							</tr>
						</table>

            <div class="page-content">



<?php
	if($for_month!="") {
				if($choose_year=="") {
					$q=ams_sql("SELECT * FROM data_repair where year_budget=? and id_category=? and month_checkout=? order by id ", ["$year_budget", "$id_category", "$month_checkout"]);
				} else {
					$q=ams_sql("SELECT * FROM data_repair where year_budget=? and id_category=? and month_checkout=? order by id ", ["$choose_year", "$id_category", "$month_checkout"]);
				}
	} else {
				if($choose_year=="") {
					$q=ams_sql("SELECT * FROM data_repair where year_budget=? and id_category=? order by id ", ["$year_budget", "$id_category"]);
				} else {
					$q=ams_sql("SELECT * FROM data_repair where year_budget=? and id_category=? order by id ", ["$choose_year", "$id_category"]);
				}
	}
										$qr=ams_query($link,$q);
										$total2=mysqli_num_rows($qr);
?>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">

<table class="table table-striped table-bordered">
		<tr>
				<td class="center font_bg_white" style="vertical-align:middle;width:10px;">ลำดับ</td>
        <td class="center font_bg_white" style="vertical-align:middle;">วัน/เดือน/ปี <br/>(ส่งซ่อม)</td>
				<td class="center font_bg_white" style="vertical-align:middle;">เลขครุภัณฑ์</td>
				<td class="center font_bg_white" style="vertical-align:middle;">ชื่อครุภัณฑ์</td>
				<td class="center font_bg_white" style="vertical-align:middle;">สถานะ (หลังจากซ่อม)</td>
				<td class="center font_bg_white" style="vertical-align:middle;">วัน/เดือน/ปี <br/>เปลี่ยนสถานะ (หลังจากซ่อม)</td>
				<td class="center font_bg_white" style="vertical-align:middle;">หมายเหตุ</td>
    </tr>
		<?php
			   $i=1;
				 $i_data=0;
				 while($i_data<$total2) {
						$rs_repair=mysqli_fetch_array($qr);
						$id_data_lda=$rs_repair['id_data_lda'];
						$day_checkout=$rs_repair['day_checkout'];
						$month_checkout=$rs_repair['month_checkout'];
						$year_checkout=$rs_repair['year_checkout'];
						$note=$rs_repair['note'];
						$status=$rs_repair['status'];
						$day_status=$rs_repair['day_status'];
						$month_status=$rs_repair['month_status'];
						$year_status=$rs_repair['year_status'];

						$sql_lda=ams_sql("SELECT * FROM data_lda where id=?", ["$id_data_lda"]);
						$qr_lda=ams_query($link,$sql_lda);
							$rs_lda=mysqli_fetch_array($qr_lda);
							$barcode1=$rs_lda['barcode1'];
							$lda_list=$rs_lda['lda_list'];
    ?>
<tr>
	<td class="center font_brown"><?php echo $i; ?>.</td>
	<td class="center font_brown"><?php echo $day_checkout; ?>/<?php echo $month_checkout; ?>/<?php echo $year_checkout; ?></td>
	<td class="center font_brown"><?php echo $barcode1; ?></td>
	<td class="font_brown" style="padding-left:10px;"><?php echo $lda_list; ?></td>


	<?php if ($status=="1") { ?><td class="center" bgcolor="#49ac8b"><font color="#FFFFFF">ใช้งานปกติ</font> </td>
	<?php } elseif($status=="2") { ?><td class="center" bgcolor="#d15b47"><font color="#FFFFFF">ชำรุด</font></td>
	<?php } elseif($status=="3") { ?><td class="center" bgcolor="#d15b47"><font color="#FFFFFF">สูญหาย</font></td>
	<?php } elseif($status=="4") { ?><td class="center" bgcolor="#d15b47"><font color="#FFFFFF">โอนย้าย / บริจาค</font></td>
	<?php } elseif($status=="5") { ?><td class="center" bgcolor="#d15b47"><font color="#FFFFFF">จำหน่ายออก</font></td>
	<?php } elseif($status=="6") { ?><td class="center" bgcolor="#d15b47"><font color="#FFFFFF">ส่งซ่อม</font></td>
	<?php } elseif($status=="7") { ?><td class="center" bgcolor="#d15b47"><font color="#FFFFFF">สภาพปกติ ไม่จำเป็นต้องใช้งาน</font></td>
  <?php } elseif($status=="8") { ?><td class="center" bgcolor="#d15b47"><font color="#FFFFFF">รอจำหน่ายออก</font></td><?php } ?>

	<?php if($status!="-") { ?>
	<td class="center font_brown"><?php echo $day_status; ?>/<?php echo $month_status; ?>/<?php echo $year_status; ?></td>
	<?php } else { ?>
		<td class="center font_brown">-</td>
	<?php } ?>

	<td class="center font_brown"><?php echo $note; ?></td>
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
