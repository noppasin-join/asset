<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
$g = '';
$send_var_show = '';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
$sess_user = $_SESSION['sess_user'] ?? '';
$sess_password = $_SESSION['sess_password'] ?? '';

require_once __DIR__ . '/con_lda.php';
if ($sess_user == "" || $status!="0" || $level=="0") {
    ams_deny(403, 'Insufficient permissions.');
} else {
set_time_limit(0);

$g=$_GET['g'] ?? '';
$sql_year = "select * from  budget order by year_budget desc   ";
$dbquery_year=ams_query($link,$sql_year) or die ("เลือกข้อมูลไม่ได้");
$result_year=mysqli_fetch_array($dbquery_year);
$year_budget=$result_year['year_budget'];

$send_var_show = $_POST['send_var_show'] ?? '';
$import_error = '';
if ($send_var_show == '2') {
    try {
        if (($_FILES['filUpload']['error'][0] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            throw new RuntimeException('อัปโหลดไฟล์ไม่สำเร็จ กรุณาเลือกไฟล์และตรวจสอบขนาดไฟล์ที่เซิร์ฟเวอร์อนุญาต');
        }
        $temporary_file = $_FILES['filUpload']['tmp_name'][0];
        if (!is_uploaded_file($temporary_file)) {
            throw new RuntimeException('ไม่พบไฟล์ที่อัปโหลด');
        }
        require_once __DIR__ . '/compare_excel_reader.php';
        $namedDataArray = agro_read_compare_excel($temporary_file);
        if (!is_dir(__DIR__ . '/upload_compare') || !is_writable(__DIR__ . '/upload_compare')) {
            throw new RuntimeException('ไม่สามารถบันทึกไฟล์ในโฟลเดอร์ upload_compare ได้');
        }
    } catch (Throwable $error) {
        error_log('Excel comparison import: ' . $error->getMessage());
        $import_error = 'นำเข้าไม่สำเร็จ: ' . $error->getMessage();
        $send_var_show = '';
    }
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

	<link rel="stylesheet" href="AdminLTE.min.css">
	<style> body { font-family: sarabun; } </style>

	<script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>

</head>

<body class="no-skin">
<?php include ("class_head.php"); ?>

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

      <div class="page-content">
        <?php
			// Request validated before changing comparison data.
		?>
        <div class="row">
          <div class="alert alert-info"> <i class="ace-icon fa fa-hand-o-right"></i>
            Please Choose File Excel Only. </div>
        </div>
        <?php if ($import_error !== '') { ?><div class="alert alert-danger"><?php echo htmlspecialchars($import_error, ENT_QUOTES, 'UTF-8'); ?></div><?php } ?>
<?php if ($send_var_show != "2") { ?>
        <form  method="post" name="form_purchase" enctype="multipart/form-data" action="import_excel.php"  >
          <input type="hidden" name="send_var_show" value="2">
          <input type="hidden" name="c11" value="1">
          <div class="row">
            <div class="col-sm-3">
              <div class="input-group"> <span class="input-group-addon"> <i class="fa fa-calendar bigger-110"></i>
                </span>
                <input type="file" class="form-control" name="filUpload[]" />
              </div>
            </div>
            <div class="col-sm-4">
              <input  type="submit" name="submit" value="Upload" style="width:75px;height:32px" >
            </div>
          </div>
          <input type="Hidden" value="up" name="job">
        </form>
        <?php } ?>
        <?php if ($send_var_show == "2") { ?>
        <div class="row">
          <?php
		// delete file

				$sql_select_4a="select *  from file_compare";
				$dbquery_select_4a=ams_query($link,$sql_select_4a);
				$result_select_4a=mysqli_fetch_array($dbquery_select_4a);
					$name_select_4a = $result_select_4a['name'] ?? '';


				if (is_string($name_select_4a) && is_file($name_select_4a)) {
                    unlink($name_select_4a);
                }


				// delete data

				$sql_delete_4bb=ams_sql("delete from data_compare where year_budget=?  ", ["$year_budget"]);
				$dbquery_delete_4bb=ams_query($link,$sql_delete_4bb) or die ("เลือกข้อมูลไม่ได้");

				$sql_delete_4bbc=ams_sql("delete from data_compare_view where year_budget=?  ", ["$year_budget"]);
				$dbquery_delete_4bbc=ams_query($link,$sql_delete_4bbc) or die ("เลือกข้อมูลไม่ได้");

						$dmy="$day-$month-$year";

						$sql_lda = "SELECT * from  data_lda where status_check='1' group by barcode1 ";
						$qr_lda=ams_query($link,$sql_lda) or die ("เลือกข้อมูลไม่ได้");
						$num_lda=mysqli_num_rows($qr_lda);
						$i_lda=0;
						while($i_lda<$num_lda)
						{
							$rs_lda=mysqli_fetch_array($qr_lda);
							$barcode1=$rs_lda['barcode1'];
							$lda_list=$rs_lda['lda_list'];
													$sql_up=ams_sql("insert into data_compare(year_budget,date_compare,time_compare,id_member_compare,barcode,title)
													values (?,?,?,?,?,?) ", ["$year_budget", "$dmy", "$time_log", "$id_member", "$barcode1", "".$lda_list.""]);
													$qr_up=ams_query($link,$sql_up) or die ("Error3");
							$i_lda++;
						}

						// delete file

								$sql_delete_4b="delete from file_compare  ";
								$dbquery_delete_4b=ams_query($link,$sql_delete_4b) or die ("เลือกข้อมูลไม่ได้");




			
			$rootdir = "upload_compare";

			for($i=0;$i<count($_FILES["filUpload"]["name"]);$i++) { //echo $_FILES["filUpload"]["name"][$i]."<br/>";
				if($_FILES["filUpload"]["name"][$i] != "") { //echo "$i<br>";

					$var_file= basename($_FILES["filUpload"]["name"][$i]);
					$a="upload_compare/$var_file";



										if ($i==0) {
											if(move_uploaded_file($_FILES["filUpload"]["tmp_name"][$i],"upload_compare/$var_file")) {
													$sql_updatepic=ams_sql("insert into file_compare (name) values (?) ", ["$a"]);
													$dbquery_updatepic=ams_query($link,$sql_updatepic) or die ("Not Complete");


					?>
													<div class="col-xs-12">
            <div class="table-header"> <i class="ace-icon fa fa-shield"></i> ข้อมูลรายการครุภัณฑ์ที่
              Upload >> </div>
            <div>
              <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <?php
				$sql_file= "SELECT * from  file_compare  ";
				$dbquery_file=ams_query($link,$sql_file) or die ("เลือกข้อมูลไม่ได้");
				$num_rows_file=mysqli_num_rows($dbquery_file);
					$result_file=mysqli_fetch_array($dbquery_file);
						$name_file=$result_file['name'];

			?>
                <?php

				// Workbook has already been read and validated before deleting old results.
				$i6 = 0;
				foreach ($namedDataArray as $result) {
						$i6++;

					$Barcode = $result["Barcode"];
					
					$Barcode_exchange = $Barcode;
					$Title = $result["Title"];
					$title_exchange = $Title;

					$dmy="$day-$month-$year";


					$sql_lda_7 = ams_sql("SELECT * from  data_compare where barcode=? and year_budget=?", ["$Barcode_exchange", "$year_budget"]);
					$qr_lda_7=ams_query($link,$sql_lda_7) or die ("เลือกข้อมูลไม่ได้");
					$num_lda_7=mysqli_num_rows($qr_lda_7);

					if($num_lda_7=="0") {
						$strSQL = ams_sql('INSERT INTO data_compare (year_budget,date_compare,time_compare,id_member_compare,barcode,title_2) VALUES (?,?,?,?,?,?)', [$year_budget,$dmy,$time_log,$id_member,$Barcode_exchange,$title_exchange]);

						ams_query($link,"SET NAMES UTF8");
						ams_query($link,$strSQL) or die(mysqli_error($link));
					} else {
						$sql_up_7 = ams_sql("UPDATE data_compare set title_2=? where barcode=? and year_budget=?", ["".$title_exchange."", "$Barcode_exchange", "$year_budget"]);
						$qr_up_7=ams_query($link,$sql_up_7) or die ("Error Update Check5");
					}


									}


									?>
									<div class="alert alert-block alert-success font_brown" id="success-alert">
                    <button type="button" class="close" data-dismiss="alert">
                      <i class="ace-icon fa fa-times"></i>
                    </button>

                    <i class="ace-icon fa fa-check green"></i> &nbsp;
                    <strong>Import Complete</strong>
                  </div>


							  </table>
							</div>
						  </div>

							<?php



							$sql_inst="INSERT INTO data_compare_view (year_budget,date_compare,barcode,title,title_2)
							            select year_budget,date_compare,barcode,title,title_2 from data_compare";
							$qr_inst=ams_query($link,$sql_inst) or die ("Error Update Check7");

							$sql_inst2="INSERT INTO data_compare_view_2 (year_budget,date_compare,barcode,title,title_2)
													select year_budget,date_compare,barcode,title,title_2 from data_compare";
							$qr_inst2=ams_query($link,$sql_inst2) or die ("Error Update Check72");


							$sql_del = ams_sql("SELECT * from  data_compare_view where year_budget=?", ["$year_budget"]);
							$qr_del=ams_query($link,$sql_del) or die ("เลือกข้อมูลไม่ได้");
							$num_del=mysqli_num_rows($qr_del);
							$i_del=0;
							while($i_del<$num_del)
							{
								$rs_del=mysqli_fetch_array($qr_del);
								$id_del=$rs_del['id'];
								$title_t1=$rs_del['title'];
								$title_t2=$rs_del['title_2'];
												if($title_t1==$title_t2) {
														$sql_del_all=ams_sql("DELETE from data_compare_view where id=? ", ["$id_del"]);
														$qr_del_all=ams_query($link,$sql_del_all) or die ("Error3");
												}
								$i_del++;
							}

							$sql_del2 = ams_sql("SELECT * from  data_compare_view_2 where year_budget=?", ["$year_budget"]);
							$qr_del2=ams_query($link,$sql_del2) or die ("เลือกข้อมูลไม่ได้");
							$num_del2=mysqli_num_rows($qr_del2);
							$i_del2=0;
							while($i_del2<$num_del2)
							{
								$rs_del2=mysqli_fetch_array($qr_del2);
								$id_del2=$rs_del2['id'];
								$title_t12=$rs_del2['title'];
								$title_t22=$rs_del2['title_2'];
												if($title_t12!=$title_t22) {
														$sql_del_all2=ams_sql("DELETE from data_compare_view_2 where id=? ", ["$id_del2"]);
														$qr_del_all2=ams_query($link,$sql_del_all2) or die ("Error3");
												}
								$i_del2++;
							}

							echo "<meta http-equiv=\"Refresh\" content=\"3; URL=data_compare.php?c1=1\">";
							?>


								<?php


											}
										}








				}
			}



?>

          <?php } ?>
          <!-- /.row -->
        </div>
        <!-- /.page-content -->
      </div>
    </div>
    <!-- /.main-content -->
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
