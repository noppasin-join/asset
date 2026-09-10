<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$id = '';
$s_page2 = '';
$urlquery_str2 = '';
$txt_title_search = '';
$txt_no_search = '';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
	$sess_user = $_SESSION['sess_user'] ?? '';
	$sess_password = $_SESSION['sess_password'] ?? '';

	require_once __DIR__ . '/con_lda.php';
	if ($sess_user == "" || $status!="0") {
    ams_deny(403, 'Insufficient permissions.');
	} else {
	set_time_limit(0);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
        <title>:: ระบบฐานข้อมูลครุภัณฑ์ ศูนย์บรรณสารฯ</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.2.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="assets/fonts/fonts.googleapis.com.css" />
		<link rel="stylesheet" href="assets/css/ace2.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<!-- ace settings handler -->
		<script src="assets/js/ace-extra.min.js"></script>
    <link rel="shortcut icon" href="mfu.ico" type="image/x-icon">
		<style> body { font-family: sarabun; } </style>
		<link rel="stylesheet" href="AdminLTE.min.css">

		<link rel="stylesheet" href="reg-style.css" />

		<link rel="stylesheet" href="css/datepicker.css" />
		<link rel="stylesheet" href="assets/css/datepicker.min.css" />

    <link rel="stylesheet" href="assets2/plugins/validationengine/css/validationEngine.jquery.css" />
		<script type="text/javaScript">

        //ให้ text รับค่าเป็นตัวเลขอย่างเดียว
        function checknumber()
        {
          key = event.keyCode;
          if ( key != 46 & ( key < 48 || key > 57 ) )
          {
            event.returnValue = false;
          };
        };
        </script>
				<link rel="stylesheet" href="dist/css/AdminLTE.min.css">

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
								<li class="active">ฟอร์มแก้ไขข้อมูลครุภัณฑ์</li>
							</ul><!-- /.breadcrumb -->

						</div>



<?php // Start BODY ?>


<?php

$id=$_GET['id'] ?? '';
$s_page2=$_GET['s_page2'] ?? '';
$urlquery_str2=$_GET['urlquery_str2'] ?? '';
$txt_title_search=$_GET['txt_title_search'] ?? '';
$txt_no_search=$_GET['txt_no_search'] ?? '';

$sql_data = ams_sql("select * from  data_lda where id=? ", ["$id"]);
$qr_data=ams_query($link,$sql_data) or die ("เลือกข้อมูลไม่ได้");
					$rs_data=mysqli_fetch_array($qr_data);
					$barcode1=$rs_data['barcode1'];
					$barcode2=$rs_data['barcode2'];
					$barcode3=$rs_data['barcode3'];
					$lda_category=$rs_data['lda_category'];
					$lda_type=$rs_data['lda_type'];
					$lda_detail=$rs_data['lda_detail'];
					$lda_year=$rs_data['lda_year'];
					$lda_no=$rs_data['lda_no'];
					$lda_list=$rs_data['lda_list'];
					$lda_brand=$rs_data['lda_brand'];
					$lda_serial=$rs_data['lda_serial'];
					$id_category=$rs_data['id_category'];
					$id_location=$rs_data['id_location'];
					$name_use=$rs_data['name_use'];
					$id_member_input=$rs_data['id_member_input'];
					$date_input=$rs_data['date_input'];
					$time_input=$rs_data['time_input'];
					$id_member_update=$rs_data['id_member_update'];
					$date_update=$rs_data['date_update'];
					$time_update=$rs_data['time_update'];
					$lda_status=$rs_data['lda_status'];
					$note=$rs_data['note'];
					$file_img=$rs_data['file_img'];
					$file_att=$rs_data['file_att'];
					$price=$rs_data['price'];
					$date_expire=$rs_data['date_expire'];
					$status_borrow=$rs_data['status_borrow'];
					$asset=$rs_data['asset'];
					$year_budget=$rs_data['year_budget'];
?>

 <form name="frmMain" id="popup-validation" method="post" action="update_data.php" enctype="multipart/form-data">
	 <input type="hidden" name="id" value="<?php echo $id; ?>">
	 <input type="hidden" name="s_page2" value="<?php echo $s_page2; ?>">
	 <input type="hidden" name="urlquery_str2" value="<?php echo $urlquery_str2; ?>">
	 <input type="hidden" name="txt_title_search" value="<?php echo $txt_title_search; ?>">
	 <input type="hidden" name="txt_no_search" value="<?php echo $txt_no_search; ?>">
      <div class="page-content">
        <div class="row">

          <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="row">
              <div class="col-xs-12 col-sm-12 infobox-container">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title ">:: ข้อมูลครุภัณฑ์</h3>
                  </div>
                  <div class="box-body">
                    <div class="row">
                      <div class="col-xs-7 col-sm-4">
                        <div class="input-group"> <span class="input-group-addon" style="background-color:#eeeeee;"><i class="ace-icon fa fa-bars"></i></span>
                          <input type="text" class="form-control  validate[required]" style="font-size:14px;background-color:#f4f9fc;" name="txt_barcode"
                          placeholder="เลขครุภัณฑ์ ส่วนพัสดุ" autocomplete="off" value="<?php echo $barcode2; ?>" maxlength="25">
                        </div>
												<div class="row" style="padding:3px;"> </div>
                      </div>
											<div class="col-xs-7 col-sm-4">
                        <div class="input-group"> <span class="input-group-addon" style="background-color:#eeeeee;"><i class="ace-icon fa fa-bars"></i></span>
                          <input type="text" class="form-control" style="font-size:14px;background-color:#f4f9fc;" name="txt_barcode_lib2"
                          placeholder="เลขครุภัณฑ์ ศูนย์บรรณสารฯ" autocomplete="off" value="<?php echo $barcode1; ?>" maxlength="30" >
                        </div>
												<div class="row" style="padding:3px;"> </div>
                      </div>
											<div class="col-xs-7 col-sm-4">
                        <div class="input-group"> <span class="input-group-addon" style="background-color:#eeeeee;"><i class="ace-icon fa fa-bars"></i></span>
                          <input type="text" class="form-control" style="font-size:14px;background-color:#f4f9fc;" name="txt_barcode_lib"
                          placeholder="เลขครุภัณฑ์ ศูนย์บรรณสารฯ" autocomplete="off" value="<?php echo $barcode3; ?>" maxlength="20">
                        </div>
												<div class="row" style="padding:3px;"> </div>
                      </div>

                    </div>
                    <div class="row" style="padding:2px;"> </div>
										<div class="row">
											<div class="col-xs-12 col-sm-4">
                        <div class="input-group"> <span class="input-group-addon" style="background-color:#eeeeee;font-size:12px;color:#797e7c;">ชื่อรายการ</span>
                          <input type="text" class="form-control validate[required]" style="font-size:13px;background-color:#f4f9fc;" name="txt_title"
                          placeholder="..." autocomplete="off" maxlength="200" value="<?php echo $lda_list; ?>">
                        </div>
												<div class="row" style="padding:3px;"> </div>
                      </div>
											<div class="col-xs-12 col-sm-4">
                        <div class="input-group"> <span class="input-group-addon" style="background-color:#eeeeee;font-size:12px;color:#797e7c;">ราคา</span>
                          <input type="text" class="form-control validate[required]" style="font-size:13px;background-color:#f4f9fc;" name="txt_price" value="<?php echo $price; ?>"
                          placeholder="00.00" autocomplete="off" maxlength="10"><span class="input-group-addon" style="background-color:#eeeeee;"><i class="ace-icon fa fa-money"></i></span>
                        </div>
												<div class="row" style="padding:3px;"> </div>
                      </div>
											<div class="col-xs-12 col-sm-4 font_brown">
												<div class="input-group"> <span class="input-group-addon" style="background-color:#eeeeee;"><i class="ace-icon fa fa-key"></i></span>
													<input type="text" class="form-control-mdf"  name="txt_asset" placeholder="เลข Aseet ส่วนพัสดุ"
													style="font-size:13px;font-color:#747272;background-color:#f4f9fc;height:34px;" autocomplete="off" value="<?php echo $asset;?>">
												</div><div class="row" style="padding:2px;"> </div>
											</div>
                    </div>
										<div class="row" style="padding:2px;"> </div>
                    <div class="row">
                      <div class="col-xs-12 col-sm-4 font_brown">
                        <div class="input-group"> <span class="input-group-addon" style="background-color:#eeeeee;"><i class="ace-icon fa fa-barcode"></i></span>
                          <input type="text" class="form-control-mdf" style="font-size:13px;font-color:#e3f0f9;background-color:#f4f9fc;height:34px;" name="txt_serial"
													placeholder="Serial No." autocomplete="off" maxlength="30" value="<?php echo $lda_serial; ?>">
                        </div>
												<div class="row" style="padding:3px;"> </div>
                      </div>
                      <div class="col-xs-12 col-sm-4 font_brown">
                        <div class="input-group"> <span class="input-group-addon" style="background-color:#eeeeee;font-size:12px;color:#797e7c;">ยี่ห้อ / รุ่น</span>
                          <input type="text" class="form-control" style="font-size:13px;font-color:#747272;background-color:#f4f9fc;" name="txt_brand"
													placeholder="..." maxlength="100" value="<?php echo $lda_brand; ?>">
                        </div>
												<div class="row" style="padding:3px;"> </div>
                      </div>
                      <div class="col-xs-12 col-sm-4 font_brown">
                        <div class="input-group"> <span class="input-group-addon" style="background-color:#eeeeee;font-size:12px;color:#797e7c;">หมวดหมู่</span>
                          <select class="form-control validate[required]" name="choose_category" style="background-color:#f4f9fc;font-size:13px;">
														<?php
														$sql_cat_select = ams_sql("select * from  category where id=? ", ["$id_category"]);
														$qr_cat_select=ams_query($link,$sql_cat_select) or die ("เลือกข้อมูลไม่ได้");
															$rs_cat_select=mysqli_fetch_array($qr_cat_select);
															$id_cat_select=$rs_cat_select['id'];
															$name_category_select=$rs_cat_select['name_category'];
														?>
														<option value="<?php echo $id_cat_select; ?>" selected><?php echo $name_category_select; ?></option>
														<option value="">-----</option>
														<?php
														$sql_cat = "select * from  category order by name_category ";
														$qr_cat=ams_query($link,$sql_cat) or die ("เลือกข้อมูลไม่ได้");
														ams_query($link, "SET NAMES UTF8");
														$num_cat=mysqli_num_rows($qr_cat);
														$i=0;
																	while($i<$num_cat) {
																			$rs_cat=mysqli_fetch_array($qr_cat);
																			$id_cat=$rs_cat['id'];
																			$name_category=$rs_cat['name_category'];
														?>
												  	<option value="<?php echo $id_cat; ?>"><?php echo $name_category; ?></option>
													  <?php $i++; } ?>
                          </select>
                        </div>
                      </div>
                    </div>

										<div class="row" style="padding:2px;"> </div>
                    <div class="row">
											<div class="col-xs-12 col-sm-4 font_brown">
												<div class="input-group"> <span class="input-group-addon" style="background-color:#eeeeee;"><i class="ace-icon fa fa-calendar"></i></span>
							 						<input type="text" class="form-control-mdf"  name="txt_date_expire" placeholder="วันที่หมดประกัน" id="datepicker"
													style="font-size:13px;font-color:#747272;background-color:#f4f9fc;height:34px;" autocomplete="off" value="<?php echo $date_expire; ?>">
												</div><div class="row" style="padding:2px;"> </div>
											</div>

                    </div>

                    <div class="row" style="padding:3px;"> </div>
                  </div>
                  <!-- /.box-body -->
                </div>
              </div>

              <!-- /.col -->
            </div>





						<div class="row">
              <div class="col-xs-12 col-sm-12 infobox-container">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title ">:: รูปภาพ / ไฟล์แนบ</h3>
                  </div>
                  <div class="box-body">

										<div class="row" style="padding:2px;"> </div>
                    <div class="row">

                      <div class="col-xs-12 col-sm-4 font_brown">
                        <div class="input-group"> <span class="input-group-addon" style="background-color:#eeeeee;"><i class="ace-icon fa fa-location-arrow"></i></span>
													<input type="file" name="file_upload"  style="display:none" class="form-control" autocomplete="off" />
            			  			<input type="button" name="uploadbutton"  class="form-control-mdf" value="เลือกไฟล์รูปภาพ" onclick="file_upload.click()"
													style="font-color:#747272;font-size: 13px;background-color:#f4f9fc;height:34px;" onmouseout="uploadtext.value=file_upload.value" />
                        </div>
												<div class="row" style="padding:3px;"> </div>
                      </div>
											<div class="col-xs-12 col-sm-4 font_brown">
                        <div class="input-group"> <span class="input-group-addon" style="background-color:#eeeeee;"><i class="ace-icon fa fa-file"></i></span>
													<input type="file" name="file_upload2"  style="display:none" class="form-control" autocomplete="off" />
            			  			<input type="button" name="uploadbutton"  class="form-control-mdf" value="เลือกไฟล์แนบ" onclick="file_upload2.click()"
													style="font-color:#747272;font-size: 13px;background-color:#f4f9fc;height:34px;" onmouseout="uploadtext.value=file_upload2.value" />
                        </div>
                      </div>

                    </div>

										<div class="row" style="padding:2px;"> </div>
										<div class="row">

											<?php if($file_att!="" && $file_att!="-") { ?>
											<div class="col-xs-12 col-sm-4 font_brown" style="padding-top: 12px;">
												<label class="input-group">ไฟล์แนบ : &nbsp;
													<a  href="file_att/<?php echo $year_budget;?>/<?php echo $file_att;?>" target="_blank"> <i class="ace-icon fa fa-tag bigger-130"></i> <?php echo $file_att; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
													<a  href="del_file_att.php?id=<?php echo $id; ?>" target="_parent" class="red"> <i class="ace-icon fa fa-trash-o bigger-130"></i></a>
												</label><div class="row" style="padding:2px;"> </div>
											</div>
											<?php } ?>

										</div>

										<div class="row" style="padding:2px;"> </div>
										<div class="row">

											<?php if($file_img!="" && $file_img!="-") { ?>
											<div class="col-xs-12 col-sm-4 font_brown" style="padding-top: 8px;">
												<label class="input-group">
													<img src="file_img/<?php echo $year_budget; ?>/<?php echo $file_img;?>" width="300">
												</label><div class="row" style="padding:2px;"> </div>
											</div>
											<?php } ?>

										</div>




                    <div class="row" style="padding:3px;"> </div>
                  </div>
                  <!-- /.box-body -->
                </div>
              </div>

              <!-- /.col -->
            </div>




            <!-- /.row -->
            <div class="row">
            <div class="col-xs-12 col-sm-12 infobox-container">
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title ">:: สถานที่ใช้งานและผู้ใช้งาน</h3>
                </div>
                <div class="box-body">
                  <div class="row" style="padding:3px;"> </div>

                  <div class="row">

                        <div class="col-xs-7 col-sm-3 font_brown">
                            <div class="input-group">
                              <span class="input-group-addon" style="background-color:#eeeeee;font-size:12px;color:#797e7c;">สถานที่ใช้งาน</span>
																<select class="form-control-mdf validate[required]" name="choose_locate" style="background-color:#f1f9f2;font-size:13px;height:34px;">
																	<?php
																	$sql_locate_select = ams_sql("select * from  data_location where id=? ", ["$id_location"]);
																	$qr_locate_select=ams_query($link,$sql_locate_select) or die ("เลือกข้อมูลไม่ได้");
																		$rs_locate_select=mysqli_fetch_array($qr_locate_select);
																		$id_locate_select=$rs_locate_select['id'];
																		$name_locate_select=$rs_locate_select['name_location'];
																	?>
																	<option value="<?php echo $id_locate_select; ?>"><?php echo $name_locate_select; ?></option>
																	<option value="">-----</option>
																	<?php
																	$sql_locate = "select * from  data_location order by name_location ";
																	$qr_locate=ams_query($link,$sql_locate) or die ("เลือกข้อมูลไม่ได้");
																	ams_query($link, "SET NAMES UTF8");
																	$num_locate=mysqli_num_rows($qr_locate);
																	$i3=0;
																				while($i3<$num_locate) {
																						$rs_locate=mysqli_fetch_array($qr_locate);
																						$id_locate=$rs_locate['id'];
																						$name_location=$rs_locate['name_location'];
																	?>
															  	<option value="<?php echo $id_locate; ?>"><?php echo $name_location; ?></option>
																  <?php $i3++; } ?>
			                          </select>
                            </div>
														<div class="row" style="padding:2px;"> </div>
                        </div>
                        <div class="col-xs-12 col-sm-5 font_brown">
                            <div class="input-group">
                              <span class="input-group-addon" style="background-color:#eeeeee;font-size:12px;color:#797e7c;">ผู้ใช้งาน</span>
                              <input type="text" class="form-control-mdf validate[required]" name="txt_user_use" style="background-color:#f1f9f2;font-size:13px;height:34px;" value="<?php echo $name_use; ?>" />
                            </div>
                        </div>

                  </div>

                  <div class="row" style="padding:5px;"> </div>

                </div>
                <!-- /.box-body -->
              </div>


            </div>
            </div>





						<div class="row col-sm-12 infobox-container">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title ">:: ข้อมูลสถานะ</h3>
                </div>
                <div class="box-body">
                  <div class="row" style="padding:3px;"> </div>
                  <div class="row">
                    <div class="col-xs-7 col-sm-3">
                      <div class="input-group"> <span class="input-group-addon" style="background-color:#eeeeee;"><i class="ace-icon fa fa-spinner"></i></span>

											<select class="form-control"  name="choose_status" style="font-size:13px;color:#747272;background-color:#fcfaf2;">
													<?php if($lda_status=="1") { ?><option value="1" selected>ใช้งานปกติ</option><?php } else { ?><option value="1">ใช้งานปกติ</option><?php } ?>
													<?php if($lda_status=="2") { ?><option value="2" selected>ชำรุด</option><?php } else { ?><option value="2">ชำรุด</option><?php } ?>
													<?php if($lda_status=="3") { ?><option value="3" selected>สูญหาย</option><?php } else { ?><option value="3">สูญหาย</option><?php } ?>
													<?php if($lda_status=="4") { ?><option value="4" selected>โอนย้าย / บริจาค</option><?php } else { ?><option value="4">โอนย้าย / บริจาค</option><?php } ?>
													<?php if($lda_status=="5") { ?><option value="5" selected>จำหน่ายออก</option><?php } else { ?><option value="5">จำหน่ายออก</option><?php } ?>
													<?php if($lda_status=="6") { ?><option value="6" selected>ส่งซ่อม</option><?php } else { ?><option value="6">ส่งซ่อม</option><?php } ?>
													<?php if($lda_status=="7") { ?><option value="7" selected>สภาพปกติ ไม่จำเป็นต้องใช้งาน</option><?php } else { ?><option value="7">สภาพปกติ ไม่จำเป็นต้องใช้งาน</option><?php } ?>
													<?php if($lda_status=="8") { ?><option value="8" selected>รอจำหน่ายออก</option><?php } else { ?><option value="8">รอจำหน่ายออก</option><?php } ?>
											</select>

										</div><div class="row" style="padding:2px;"> </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                      <div class="input-group"> <span class="input-group-addon" style="background-color:#eeeeee;"><i class="ace-icon fa fa-building"></i></span>
                        <input type="text" class="form-control"  name="txt_note" style="font-size:13px;color:#747272;background-color:#fcfaf2;" value="<?php echo $note; ?>" >
                      </div><div class="row" style="padding:2px;"> </div>
                    </div>
										<div class="col-xs-12 col-sm-3">
                      <div class="input-group"> <span class="input-group-addon" style="background-color:#eeeeee;"><i class="ace-icon fa fa-anchor"></i></span>
												<select class="form-control"  name="choose_borrow" style="font-size:13px;color:#747272;background-color:#fcfaf2;">
														<?php if($status_borrow=="1") { ?><option value="1" selected>เปิดให้ยืม</option><?php } else { ?><option value="1">เปิดให้ยืม</option><?php } ?>
														<?php if($status_borrow=="2") { ?><option value="2" selected>ไม่เปิดให้ยืม</option><?php } else { ?><option value="2">ไม่เปิดให้ยืม</option><?php } ?>
												</select>
                      </div><div class="row" style="padding:2px;"> </div>
                    </div>
                  </div>
                  <div class="row" style="padding:3px;"> </div>


                  <div class="row">

										<?php
											$sql_input = ams_sql("select * from  member where id=?  ", ["$id_member_input"]);
											$qr_input=ams_query($link,$sql_input) or die ("เลือกข้อมูลไม่ได้");
											$rs_input=mysqli_fetch_array($qr_input);
											$name_input=$rs_input['name'];
											$surname_input=$rs_input['surname'];
									  ?>
                    <div class="col-xs-12 col-sm-6 font_brown">
                      <div class="input-group"> <span class="input-group-addon" style="background-color:#eeeeee;"><i class="ace-icon fa fa-user"></i></span>
                        <input type="text" class="form-control" style="font-size:13px;color:#747272;" name="txt_user_input"
												value="จนท.นำเข้า : <?php echo $name_input; ?> <?php echo $surname_input; ?>" readonly>
                      </div><div class="row" style="padding:3px;"> </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 font_brown">
                      <div class="input-group"> <span class="input-group-addon" style="background-color:#eeeeee;"><i class="ace-icon fa fa-calendar"></i></span>
                        <input type="text" class="form-control"  style="font-size:13px;color:#747272;" name="txt_date_input"
												value="วันที่นำเข้า : <?php echo $date_input; ?> (<?php echo $time_input; ?> น.)" readonly>
                      </div>
                    </div>

                  </div>

									<?php if($id_member_update!="-") { ?>
                  <div class="row" style="padding:5px;"> </div>
                  <div class="row">

										<?php
											$sql_ed_update = ams_sql("select * from  member where id=?  ", ["$id_member_update"]);
											$qr_ed_update=ams_query($link,$sql_ed_update) or die ("เลือกข้อมูลไม่ได้");
											$rs_ed_update=mysqli_fetch_array($qr_ed_update);
											$name_ed_update=$rs_ed_update['name'];
											$surname_ed_update=$rs_ed_update['surname'];
									  ?>
                    <div class="col-xs-6 font_brown">
                      <div class="input-group"> <span class="input-group-addon" style="background-color:#eeeeee;"><i class="ace-icon fa fa-user"></i></span>
                        <input type="text" class="form-control" style="font-size:13px;color:#747272;" name="txt_user_update"
												value="จนท.แก้ไข (ล่าสุด) : <?php echo $name_ed_update; ?> <?php echo $surname_ed_update; ?>" readonly>
                      </div>
                    </div>
										<div class="col-xs-6 font_brown">
                      <div class="input-group"> <span class="input-group-addon" style="background-color:#eeeeee;"><i class="ace-icon fa fa-calendar"></i></span>
                        <input type="text" class="form-control"  style="font-size:13px;color:#747272" name="txt_date_update"
												value="วันที่แก้ไข (ล่าสุด) : <?php echo $date_update; ?> (<?php echo $time_update; ?> น.)" readonly>
                      </div>
                    </div>

                  </div>
								<?php } ?>


                  <div class="row" style="padding:3px;"> </div>
                </div>
                <!-- /.box-body -->
              </div>
            </div>






            <!-- /.row -->
						<?php if($level!="0") { ?>
            <div class="row">
              <div class="col-xs-12">
                <button type="submit" class="btn btn-primary" OnClick="fncAction1()">Update ข้อมูล</button>
              </div>
            </div>
					<?php } else { ?>
							<input type="hidden" name="var_return" value="1">
						<input type="submit" value="<-- ย้อนกลับ"  class="btn bg-olive" id="gritter-without-image" />
					<?php } ?>
          </div>
          <!-- /.row -->
          <!-- PAGE CONTENT ENDS -->
        </div>
        <!-- /.col -->
      </div>
    </form>






					 <?php // END BODY ?>

					</div>

				</div><!-- /.main-content -->



				<?php include("class_footer.php"); ?>

				<?php include("class_scroll_up.php"); ?>
			</div><!-- /.main-container -->

			<script src="assets/js/jquery.2.1.1.min.js"></script>
			<script type="text/javascript">
				window.jQuery || document.write("<script src='assets/js/jquery.min.js'>"+"<"+"/script>");
			</script>
			<script type="text/javascript">
				if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
			</script>
			<script src="assets/js/bootstrap.min.js"></script>
			<script src="assets/js/jquery-ui.custom.min.js"></script>
			<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
			<script src="assets/js/ace-elements.min.js"></script>
			<script src="assets/js/ace.min.js"></script>




			<!-- PAGE LEVEL SCRIPTS -->
			<script src="assets2/plugins/validationengine/js/jquery.validationEngine.js"></script>
			<script src="assets2/plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script>
			<script src="assets2/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
			<script src="assets2/js/validationInit.js"></script>
			<script>
			        $(function () { formValidation(); });
			        </script>

							<script src="assets/js/jquery-ui.custom.min.js"></script>
							<script src="assets/js/chosen.jquery.min.js"></script>
							<script src="assets/js/bootstrap-colorpicker.min.js"></script>
							<script src="assets/js/jquery.autosize.min.js"></script>
							<script src="assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
							<script src="assets/js/jquery.maskedinput.min.js"></script>



			<!-- inline scripts related to this page -->
			<script type="text/javascript">
				jQuery(function($) {

					$.mask.definitions['~']='[+-]';
					$('.input-mask-date').mask('9999-999-9999-99-9999-999');
					$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});

				});
			</script>

			<script src="assets/js/jquery-ui.min.js"></script>
			<script type="text/javascript">
						jQuery(function($) {

							$( "#datepicker" ).datepicker({
								showOtherMonths: true,
								selectOtherMonths: false,
								//isRTL:true,


							});

						});
					</script>

			<script type="text/javascript">
						jQuery(function($) {


							//autocomplete

							$.widget( "custom.catcomplete", $.ui.autocomplete, {
								_create: function() {
									this._super();
									this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
								},
								_renderMenu: function( ul, items ) {
									var that = this,
									currentCategory = "";
									$.each( items, function( index, item ) {
										var li;
										if ( item.category != currentCategory ) {
											ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
											currentCategory = item.category;
										}
										li = that._renderItemData( ul, item );
											if ( item.category ) {
											li.attr( "aria-label", item.category + " : " + item.label );
										}
									});
								}
							});




							 var data = [
							 <?php
								$sql_pg = "select * from  data_lda group by lda_list order by lda_list ";
								$qr_pg=ams_query($link,$sql_pg) or die ("เลือกข้อมูลไม่ได้");
								$num_rows_pg=mysqli_num_rows($qr_pg);
								$i_pg=0;
								while($i_pg<$num_rows_pg)
									{
									$rs_pg=mysqli_fetch_array($qr_pg);
									$lda_list_show=$rs_pg['lda_list'];
							 ?>
								{ label: "<?php echo "$lda_list_show";?>", category: "" },
							 <?php $i_pg++; }  ?>

							];
							$( "#txtList" ).catcomplete({
								delay: 0,
								source: data
							});



							var data = [
							<?php
							 $sql_bd = "select * from  data_lda group by lda_brand order by lda_brand ";
							 $qr_bd=ams_query($link,$sql_bd) or die ("เลือกข้อมูลไม่ได้");
							 $num_rows_bd=mysqli_num_rows($qr_bd);
							 $i_bd=0;
							 while($i_bd<$num_rows_bd)
								 {
								 $rs_bd=mysqli_fetch_array($qr_bd);
								 $lda_brand_show=$rs_bd['lda_brand'];
							?>
							 { label: "<?php echo "$lda_brand_show";?>", category: "" },
							<?php $i_bd++; }  ?>

						 ];
						 $( "#txtBrandList" ).catcomplete({
							 delay: 0,
							 source: data
						 });



						});
					</script>





</body>
</html>
<?php } ?>
