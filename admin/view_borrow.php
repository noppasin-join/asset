<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
$id = '';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
$sess_user = $_SESSION['sess_user'] ?? '';
$sess_password = $_SESSION['sess_password'] ?? '';

require_once __DIR__ . '/con_lda.php';
if ($sess_user == "" || $status!=0 || $level==0) {
    ams_deny(403, 'Insufficient permissions.');
} else {
set_time_limit(0);

?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta charset="utf-8" />
  <title>:: ระบบฐานข้อมูลครุภัณฑ์ ศูนย์บรรณสารและสื่อการศึกษา</title>
  <link rel="shortcut icon" href="mfu.ico" type="image/x-icon">
  <meta name="description" content="#" />
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

</head>
<body class="no-skin">
<div class="main-container" id="main-container">
  <?php
  			$id=$_GET['id'] ?? '';

				$sql_list = ams_sql("select * from  data_take where id=? ", ["$id"]);
				$qr_list=ams_query($link,$sql_list) or die ("เลือกข้อมูลไม่ได้");
				$rs_list=mysqli_fetch_array($qr_list);
				$name_list=$rs_list['name'];
				$surname_list=$rs_list['surname'];
        $department_list=$rs_list['department'];
        $tel_list=$rs_list['tel'];
				$objective_list=$rs_list['objective'];
				$checkout_list=$rs_list['checkout'];
				$checkin_list=$rs_list['checkin'];
				$status_read_list=$rs_list['status_read'];

        $day_submit=$rs_list['day_submit'];
        $month_submit=$rs_list['month_submit'];
        $year_submit=$rs_list['year_submit'];

?>
  <div class="">
    <div class="">
      <div class="page-content">
        <div class="row">
          <div class="col-xs-12">
            <div>

              <table cellpadding="0" cellspacing="0" width="100%" border="0" style="border-collapse:collapse" align="center">
                <tr>
                  <td align="left" height="30" style="vertical-align:top;"  class="font_13">เลขที่ <?php echo $id; ?></td>
                </tr>
              </table>

							<table cellpadding="0" cellspacing="0" width="100%" border="0" style="border-collapse:collapse" align="center">
                <tr>
									<td align="left" width="5%"> </td>
									<td align="center" style="vertical-align:top;" width="20%"><img src="logo.png" width="60"></td>
                  <td align="left" width="55%">
                  	<table border="0">
                        <tr><td align="center" style="font-size:15px;"><b>แบบฟอร์มขอยืมวัสดุ/ครุภัณฑ์</b></font></td></tr>
                        <tr><td class="font_13">ศูนย์บรรณสารและสื่อการศึกษา มหาวิทยาลัยแม่ฟ้าหลวง</td></tr>
                        <tr><td class="font_13" align="center">โทร. <font class="font_12_df">0-5391-6315</font> โทรสาร <font class="font_12_df">0-5391-6314</font></td></tr>
                    </table>
                  </td>
                </tr>
              </table>

              <table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                <tr><td style="font-size:6px;">&nbsp; </td></tr>
                <tr>
                  <td align="right" height="35" style="vertical-align:top;padding-right:10px;"  class="font_13">วันที่
                    <font class="font_12_df"><?php echo $day_submit; ?></font>
                    <?php if($month_submit=="01") { ?>มกราคม
                    <?php } elseif($month_submit=="02") { ?>กุมภาพันธ์
                    <?php } elseif($month_submit=="03") { ?>มีนาคม
                    <?php } elseif($month_submit=="04") { ?>เมษายน
                    <?php } elseif($month_submit=="05") { ?>พฤษภาคม
                    <?php } elseif($month_submit=="06") { ?>มิถุนายน
                    <?php } elseif($month_submit=="07") { ?>กรกฎาคม
                    <?php } elseif($month_submit=="08") { ?>สิงหาคม
                    <?php } elseif($month_submit=="09") { ?>กันยายน
                    <?php } elseif($month_submit=="10") { ?>ตุลาคม
                    <?php } elseif($month_submit=="11") { ?>พฤศจิกายน
                    <?php } elseif($month_submit=="12") { ?>ธันวาคม
                    <?php } ?>
                    <font class="font_12_df"><?php echo $year_submit; ?></font>
                  </td>
                </tr>
                <tr>
                  <td align="left" height="15px;" style="vertical-align:top;"  class="font_13">เรียน&nbsp;&nbsp;
                  	ผู้อำนวยการศูนย์บรรณสารและสื่อการศึกษา
                  </td>
                </tr>
              </table>

              <table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                <tr><td style="font-size:3px;">&nbsp; </td></tr>
                <tr>
                  <td height="24" style="vertical-align:top;"  class="font_13">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  ข้าพเจ้า <?php echo $name_list; ?> <?php echo $surname_list; ?>
                  หน่วยงาน <?php echo $department_list; ?>
                  เบอร์โทรติดต่อ <font class="font_12_df"><?php echo $tel_list; ?></font>
                  มีความประสงค์
                  </td>
                </tr>
                <?php $pie=explode("-",$checkout_list);
$pie = array_pad($pie, 6, ''); $pp=(is_numeric($pie[0]) ? (int) $pie[0] + 543 : ''); ?>
                <?php $pie2=explode("-",$checkin_list);
$pie2 = array_pad($pie2, 6, ''); $pp2=(is_numeric($pie2[0]) ? (int) $pie2[0] + 543 : ''); ?>
                <tr>
                  <td height="28" style="vertical-align:top;"  class="font_13">
                  ขอยืมวัสดุ/ครุภัณฑ์ เพื่อใช้ในงาน <?php echo $objective_list; ?>
                  วันที่ <font class="font_12_df"><?php echo $pie[2]; ?></font>
                  <?php if($pie[1]=="01") { ?>มกราคม
                  <?php } elseif($pie[1]=="02") { ?>กุมภาพันธ์
                  <?php } elseif($pie[1]=="03") { ?>มีนาคม3
                  <?php } elseif($pie[1]=="04") { ?>เมษายน
                  <?php } elseif($pie[1]=="05") { ?>พฤษภาคม
                  <?php } elseif($pie[1]=="06") { ?>มิถุนายน
                  <?php } elseif($pie[1]=="07") { ?>กรกฎาคม
                  <?php } elseif($pie[1]=="08") { ?>สิงหาคม
                  <?php } elseif($pie[1]=="09") { ?>กันยายน
                  <?php } elseif($pie[1]=="10") { ?>ตุลาคม
                  <?php } elseif($pie[1]=="11") { ?>พฤศจิกายน
                  <?php } elseif($pie[1]=="12") { ?>ธันวาคม
                  <?php } ?>
                  <font class="font_12_df"><?php echo $pp; ?></font>
                  ถึง <font class="font_12_df"><?php echo $pie2[2]; ?></font>
                  <?php if($pie2[1]=="01") { ?>มกราคม
                  <?php } elseif($pie2[1]=="02") { ?>กุมภาพันธ์
                  <?php } elseif($pie2[1]=="03") { ?>มีนาคม
                  <?php } elseif($pie2[1]=="04") { ?>เมษายน
                  <?php } elseif($pie2[1]=="05") { ?>พฤษภาคม
                  <?php } elseif($pie2[1]=="06") { ?>มิถุนายน
                  <?php } elseif($pie2[1]=="07") { ?>กรกฎาคม
                  <?php } elseif($pie2[1]=="08") { ?>สิงหาคม
                  <?php } elseif($pie2[1]=="09") { ?>กันยายน
                  <?php } elseif($pie2[1]=="10") { ?>ตุลาคม
                  <?php } elseif($pie2[1]=="11") { ?>พฤศจิกายน
                  <?php } elseif($pie2[1]=="12") { ?>ธันวาคม
                  <?php } ?>
                  <font class="font_12_df"><?php echo $pp2; ?></font>
                  ดังรายการต่อไปนี้
                  </td>
                </tr>

                <tr>
                  <td style="vertical-align:top;">
                      <table cellpadding="0" cellspacing="0" width="100%" border="1" style="border: 1px solid #dddddd;" align="center">
                        <tr>
        									<td align="center" height="30" width="8%">ลำดับ</td>
        									<td align="center" width="25%">รหัสครุภัณฑ์</td>
                          <td align="center">รายการ</td>
                          <td align="center">หมายเหตุ</td>
                        </tr>
                        <?php
                              $sql_data = ams_sql("select * from  data_take_list where id_data_take=? and status='1' ", ["$id"]);
                              $qr_data=ams_query($link,$sql_data) or die ("เลือกข้อมูลไม่ได้");
                              $num_data=mysqli_num_rows($qr_data);
                        $i_no=1;
                        $i_data=0;
                          while($i_data<$num_data)
                          {
                            $rs_data=mysqli_fetch_array($qr_data);
                            $year_budget=$rs_data['year_budget'];
                            $id_take_list=$rs_data['id'];
                            $title=$rs_data['title'];
                            $amount=$rs_data['amount'];
                            $unit=$rs_data['unit'];
                            $note=$rs_data['note'];
                            $status_list=$rs_data['status'];

                            $sql_lda_dt = ams_sql("select * from  data_take_list_more where id_data_take=? and id_data_take_list=? ", ["$id", "$id_take_list"]);
                            $qr_lda_dt=ams_query($link,$sql_lda_dt) or die ("เลือกข้อมูลไม่ได้");
                            $num_lda_dt=mysqli_num_rows($qr_lda_dt);
                            if($num_lda_dt!=0) {

                              $rs_dt=mysqli_fetch_array($qr_lda_dt);
                              $id_data_lda_lt2=$rs_dt['id_data_lda'];
                              $sql_dt_lda = ams_sql("select * from  data_lda where id=?", ["$id_data_lda_lt2"]);
                              $qr_dt_lda=ams_query($link,$sql_dt_lda) or die ("เลือกข้อมูลไม่ได้");
                              $rs_dt_lda=mysqli_fetch_array($qr_dt_lda);
                              $barcode1_lt2=$rs_dt_lda['barcode1'];
                              $barcode3_lt2=$rs_dt_lda['barcode3'];


                            }
                        ?>
                        <?php if($amount=="1") { ?>
                          <tr>
          									<td align="center" class="font_12_df"><?php echo $i_no;?>.</td>
                            <td align="center" class="font_12_df"><?php if($num_lda_dt!=0) { if($barcode3_lt2!="") { echo $barcode3_lt2; } else { echo $barcode1_lt2;} } else { echo "-"; }?></td>

                            <td style="padding-left:10px;"  height="22"><?php echo $title;?></td>
                            <td style="padding-left:10px;"><?php echo $note;?></td>
                          </tr>
                        <?php } else { ?>
                          <tr>
                            <td align="center" class="font_12_df"><?php echo $i_no;?>.</td>
                            <td align="center">
                              <?php if($num_lda_dt!=0) { ?>
                              <table cellpadding="0" cellspacing="0" width="100%" border="1" style="border-bottom:1px;border-top:1px;border-left:1px;border-right:1px;" align="center">
                                <?php
                                  $sql_dt_over = ams_sql("select * from  data_take_list_more where id_data_take=? and id_data_take_list=? order by barcode ", ["$id", "$id_take_list"]);
                                  $qr_dt_over=ams_query($link,$sql_dt_over) or die ("เลือกข้อมูลไม่ได้");
                                  $num_dt_over=mysqli_num_rows($qr_dt_over);
                                  $i_dt_over=0;
                                    while($i_dt_over<$num_dt_over)
                                    {
                                      $rs_dt_over=mysqli_fetch_array($qr_dt_over);
                                      $id_data_lda_over=$rs_dt_over['id_data_lda'];
                                      $barcode_over=$rs_dt_over['barcode'];
                                          $sql_sh = ams_sql("select * from  data_lda where id=? ", ["$id_data_lda_over"]);
                                          $qr_sh=ams_query($link,$sql_sh) or die ("เลือกข้อมูลไม่ได้");
                                          $rs_sh=mysqli_fetch_array($qr_sh);
                                          $lda_list=$rs_sh['lda_list'];
                                          $barcode1_list=$rs_sh['barcode1'];
                                          $barcode3_list=$rs_sh['barcode3'];
                                ?>
                                <tr>
                                  <td align="center" class="font_12_df" height="22"><?php if($barcode3_list!="") { echo $barcode3_list; } else { echo $barcode_over;}?></td>
                                </tr>
                                <?php $i_dt_over++; } ?>
                              </table>
                            <?php } else { echo "-"; }?>
                            </td>

                            <?php if($num_lda_dt!=0) { ?>
                            <td align="center">
                              <table cellpadding="0" cellspacing="0" width="100%" border="1" style="border-bottom:1px;border-top:1px;border-left:1px;border-right:1px;" align="center">
                                <?php
                                  $sql_dt_over2 = ams_sql("select * from  data_take_list_more where id_data_take=? and id_data_take_list=? order by barcode ", ["$id", "$id_take_list"]);
                                  $qr_dt_over2=ams_query($link,$sql_dt_over2) or die ("เลือกข้อมูลไม่ได้");
                                  $num_dt_over2=mysqli_num_rows($qr_dt_over2);
                                  $i_dt_over2=0;
                                    while($i_dt_over2<$num_dt_over2)
                                    {
                                      $rs_dt_over2=mysqli_fetch_array($qr_dt_over2);
                                      $id_data_lda_over2=$rs_dt_over2['id_data_lda'];
                                          $sql_sh2 = ams_sql("select * from  data_lda where id=? ", ["$id_data_lda_over2"]);
                                          $qr_sh2=ams_query($link,$sql_sh2) or die ("เลือกข้อมูลไม่ได้");
                                          $rs_sh2=mysqli_fetch_array($qr_sh2);
                                          $lda_list2=$rs_sh2['lda_list'];
                                ?>
                                <tr>
                                  <td style="padding-left:10px;" height="22"><?php echo $lda_list2;?></td>
                                </tr>
                                <?php $i_dt_over2++; } ?>
                              </table>
                            </td>
                            <?php } else { ?>
                              <td style="padding-left:10px;" height="22"><?php echo $title;?></td>
                            <?php } ?>

                            <td style="padding-left:10px;"><?php echo $note;?></td>
                          </tr>

                        <?php } ?>
                        <?php $i_no++;$i_data++; } ?>
                      </table>
                  </td>
                </tr>
                <tr><td style="font-size:6px;">&nbsp; </td></tr>
                <tr>
                  <td height="28" style="vertical-align:top;"  class="font_13">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  หากวัสดุ/ครุภัณฑ์ที่ขอยืมเกิดชำรุด เสียหาย หรือสูญหาย ข้าพเจ้ายินดีชดใช้ค่าเสียหาย ที่เกิดขึ้นทุกประการ
                  </td>
                </tr>

              </table>


              <table cellpadding="0" cellspacing="0" width="100%" border="0" style="border-collapse:collapse" align="center">
                <tr>

                  <td align="right" width="100%">
                    <table border="0" class="font_13">
                        <tr><td height="15"  class="font_13"> </td></tr>
                        <tr><td align="center"  class="font_13">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <?php echo $name_list; ?> <?php echo $surname_list; ?>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
                          <tr><td height="6"  class="font_13"> </td></tr>
                        <tr><td align="center"  class="font_13">ผู้ขอยืม</td></tr>
                    </table>
                  </td>
                </tr>
              </table>


              <table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                <tr><td><img src="bg-line.jpg" width="100%" height="1"> </td></tr>
              </table>



              <table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">

                <tr>
                  <td align="left" style="vertical-align:top;">
                  	<font class="font_13"><u>ผลการพิจารณา</u></font>
                  </td>
                </tr>
              </table>



              <table cellpadding="0" cellspacing="0" width="100%" border="0" style="border-collapse:collapse" align="center">
                <tr><td style="font-size:10px;" colspan="2">&nbsp; </td></tr>
                <tr>
                  <td align="center" width="50%">
                    <table border="0" class="font_13">
                        <tr><td align="center"  class="font_13">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td></tr>
                          <tr><td height="15"  class="font_13"> </td></tr>
                        <tr><td align="center"  class="font_13">เจ้าหน้าที่ผู้ตรวจสอบ</td></tr>
                    </table>
                  </td>
                  <td align="center" width="50%">
                    <table border="0" class="font_13">
                        <tr><td align="center"  class="font_13">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td></tr>
                          <tr><td height="15"  class="font_13"> </td></tr>
                        <tr><td align="center"  class="font_13">หัวหน้าหน่วยงาน</td></tr>
                    </table>
                  </td>
                </tr>
              </table>


              <table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                <tr><td><img src="bg-line.jpg" width="100%" height="1"> </td></tr>
              </table>

              <table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                <tr>
                  <td align="left" >
                  	<font class="font_13"><u>การรับคืน</u></font>
                  </td>
                </tr>
              </table>




              <table cellpadding="0" cellspacing="0" width="100%" border="0" align="center">
                <tr><td style="font-size:3px;">&nbsp; </td></tr>


                <tr>
                  <td style="vertical-align:top;">
                      <table cellpadding="0" cellspacing="0" width="100%" border="1" style="border: 1px solid #dddddd;" align="center">
                        <tr>
        									<td align="center" height="30" width="8%">ลำดับ</td>
        									<td align="center" width="25%">รหัสครุภัณฑ์</td>
                          <td align="center">รายการ</td>
                          <td align="center">คืนแล้ว</td>
                          <td align="center">ยังไม่คืน</td>
                        </tr>
                        <?php
                              $sql_data = ams_sql("select * from  data_take_list where id_data_take=? and status='1' ", ["$id"]);
                              $qr_data=ams_query($link,$sql_data) or die ("เลือกข้อมูลไม่ได้");
                              $num_data=mysqli_num_rows($qr_data);
                        $i_no=1;
                        $i_data=0;
                          while($i_data<$num_data)
                          {
                            $rs_data=mysqli_fetch_array($qr_data);
                            $year_budget=$rs_data['year_budget'];
                            $id_take_list=$rs_data['id'];
                            $title=$rs_data['title'];
                            $amount=$rs_data['amount'];
                            $unit=$rs_data['unit'];
                            $note=$rs_data['note'];
                            $status_list2=$rs_data['status'];

                            $sql_lda_dt = ams_sql("select * from  data_take_list_more where id_data_take=? and id_data_take_list=? ", ["$id", "$id_take_list"]);
                            $qr_lda_dt=ams_query($link,$sql_lda_dt) or die ("เลือกข้อมูลไม่ได้");
                            $num_lda_dt=mysqli_num_rows($qr_lda_dt);
                            if($num_lda_dt!=0) {
                              $rs_dt=mysqli_fetch_array($qr_lda_dt);
                              $id_data_lda_lt2=$rs_dt['id_data_lda'];
                              $sql_dt_lda = ams_sql("select * from  data_lda where id=?", ["$id_data_lda_lt2"]);
                              $qr_dt_lda=ams_query($link,$sql_dt_lda) or die ("เลือกข้อมูลไม่ได้");
                              $rs_dt_lda=mysqli_fetch_array($qr_dt_lda);
                              $barcode1_lt2=$rs_dt_lda['barcode1'];
                              $barcode3_lt2=$rs_dt_lda['barcode3'];

                            }


                        ?>
                        <?php if($amount=="1") { ?>
                          <tr>
          									<td align="center" class="font_12_df"><?php echo $i_no;?>.</td>
          									<td align="center" class="font_12_df"><?php if($num_lda_dt!=0) { if($barcode3_lt2!="") { echo $barcode3_lt2; } else { echo $barcode1_lt2;} } else { echo "-"; }?></td>
                            <td style="padding-left:10px;"><?php echo $title;?></td>
                            <td align="center"><input type="checkbox" style="height:12px;"></td>
                            <td align="center"><input type="checkbox" style="height:12px;"></td>
                          </tr>
                        <?php } else { ?>
                          <tr>
                            <td align="center" class="font_12_df"><?php echo $i_no;?>.</td>
                            <td align="center">
                              <table cellpadding="0" cellspacing="0" width="100%" border="1" style="border-bottom:1px;border-top:1px;border-left:1px;border-right:1px;" align="center">
                                <?php
                                  $sql_dt_over = ams_sql("select * from  data_take_list_more where id_data_take=? and id_data_take_list=? order by barcode ", ["$id", "$id_take_list"]);
                                  $qr_dt_over=ams_query($link,$sql_dt_over) or die ("เลือกข้อมูลไม่ได้");
                                  $num_dt_over=mysqli_num_rows($qr_dt_over);
                                  $i_dt_over=0;
                                    while($i_dt_over<$num_dt_over)
                                    {
                                      $rs_dt_over=mysqli_fetch_array($qr_dt_over);
                                      $id_data_lda_over=$rs_dt_over['id_data_lda'];
                                      $barcode_over=$rs_dt_over['barcode'];
                                          $sql_sh = ams_sql("select * from  data_lda where id=? ", ["$id_data_lda_over"]);
                                          $qr_sh=ams_query($link,$sql_sh) or die ("เลือกข้อมูลไม่ได้");
                                          $rs_sh=mysqli_fetch_array($qr_sh);
                                          $lda_list=$rs_sh['lda_list'];
                                          $barcode1_list=$rs_sh['barcode1'];
                                          $barcode3_list=$rs_sh['barcode3'];

                                ?>
                                <tr>

                                  <td align="center" height="22" class="font_12_df"><?php if($barcode3_list!="") { echo $barcode3_list; } else { echo $barcode_over;}?></td>
                                </tr>
                                <?php $i_dt_over++; } ?>
                              </table>
                            </td>

                            <td align="center">
                              <table cellpadding="0" cellspacing="0" width="100%" border="1" style="border-bottom:1px;border-top:1px;border-left:1px;border-right:1px;" align="center">
                                <?php
                                  $sql_dt_over2 = ams_sql("select * from  data_take_list_more where id_data_take=? and id_data_take_list=? order by barcode ", ["$id", "$id_take_list"]);
                                  $qr_dt_over2=ams_query($link,$sql_dt_over2) or die ("เลือกข้อมูลไม่ได้");
                                  $num_dt_over2=mysqli_num_rows($qr_dt_over2);
                                  $i_dt_over2=0;
                                    while($i_dt_over2<$num_dt_over2)
                                    {
                                      $rs_dt_over2=mysqli_fetch_array($qr_dt_over2);
                                      $id_data_lda_over2=$rs_dt_over2['id_data_lda'];
                                          $sql_sh2 = ams_sql("select * from  data_lda where id=? ", ["$id_data_lda_over2"]);
                                          $qr_sh2=ams_query($link,$sql_sh2) or die ("เลือกข้อมูลไม่ได้");
                                          $rs_sh2=mysqli_fetch_array($qr_sh2);
                                          $lda_list2=$rs_sh2['lda_list'];
                                ?>
                                <tr>
                                  <td style="padding-left:10px;" height="22"><?php echo $lda_list2;?></td>
                                </tr>
                                <?php $i_dt_over2++; } ?>
                              </table>
                            </td>



                            <td align="center">
                              <table cellpadding="0" cellspacing="0" width="100%" border="1" style="border-bottom:1px;border-top:1px;border-left:1px;border-right:1px;" align="center">
                                <?php
                                  $i_amount2=0; while($i_amount2<$num_dt_over2) {
                                ?>
                                <tr>
                                  <td align="center"><input type="checkbox"  style="height:12px;"></td>
                                </tr>
                                <?php $i_amount2++; } ?>
                              </table>
                            </td>

                            <td align="center">
                              <table cellpadding="0" cellspacing="0" width="100%" border="1" style="border-bottom:1px;border-top:1px;border-left:1px;border-right:1px;" align="center">
                                <?php
                                  $i_amount3=0; while($i_amount3<$num_dt_over2) {
                                ?>
                                <tr>
                                  <td align="center"><input type="checkbox"  style="height:12px;"></td>
                                </tr>
                                <?php $i_amount3++; } ?>
                              </table>
                            </td>



                          </tr>
                        <?php } ?>
                        <?php $i_no++;$i_data++; } ?>
                      </table>
                  </td>
                </tr>


              </table>

              <table cellpadding="0" cellspacing="0" width="100%" border="0"><tr><td height="20"> </td></tr></table>

              <table cellpadding="0" cellspacing="0" width="100%" border="0" style="border-collapse:collapse" align="center">
                <tr>
                  <td width="7%">&nbsp; </td>
                  <td align="left" >
                    <table border="0" class="font_13">
                        <tr><td height="15"  class="font_13"> </td></tr>
                        <tr><td align="center"  class="font_13">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td></tr>
                          <tr><td height="15"  class="font_13"> </td></tr>
                        <tr><td align="center"  class="font_13">ผู้ส่งคืน</td></tr>
                    </table>
                  </td>
                  <td align="right" >
                    <table border="0" class="font_13">
                        <tr><td height="15"  class="font_13"> </td></tr>
                        <tr><td align="center"  class="font_13">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td></tr>
                          <tr><td height="15"  class="font_13"> </td></tr>
                        <tr><td align="center"  class="font_13">เจ้าหน้าที่รับคืน</td></tr>
                    </table>
                  </td>
                  <td width="7%">&nbsp; </td>
                </tr>
              </table>

            </div>
          </div>
        </div>
      </div>
      <!-- /.page-content -->
    </div>
  </div>
  <!-- /.main-content -->
</div>
</body>
</html>




<?php } ?>
