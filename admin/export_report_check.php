<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
$choose_year = '';
$choose_staff = '';
$choose_status = '';
$choose_location = '';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
$sess_user = $_SESSION['sess_user'] ?? '';
$sess_password = $_SESSION['sess_password'] ?? '';

require_once __DIR__ . '/con_lda.php';
if ($sess_user == "" || $status!=0) {
    ams_deny(403, 'Insufficient permissions.');
} else {
set_time_limit(0);

?>
<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="export_report_check.xls"');
?>

<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta charset="utf-8" />
<title>:: ระบบฐานข้อมูลครุภัณฑ์ ศูนย์บรรณสารฯ</title>
</head>
<body>
  <?php
  $sql_year_con = "SELECT * from  data_config order by year_budget desc  ";
  $qr_year_con=ams_query($link,$sql_year_con) or die ("เลือกข้อมูลไม่ได้");
      $result_year_con=mysqli_fetch_array($qr_year_con);
      $year_budget_con=$result_year_con['year_budget'];

                  $choose_year=$_GET['choose_year'] ?? '';
                  $choose_staff=$_GET['choose_staff'] ?? '';
                  $choose_status=$_GET['choose_status'] ?? '';
                  $choose_location=$_GET['choose_location'] ?? '';


                  								if ($choose_year=="") {
                  											if ($choose_staff =="") {
                  												  if ($choose_status=="") {
                  														if ($choose_location=="") {
                  															$q=ams_sql("SELECT * FROM data_check where year_budget=?  order by barcode3", ["$year_budget_con"]);
                  														} else {
                  															$q=ams_sql("SELECT * FROM data_check where year_budget=? and id_location_old=?  order by barcode3", ["$year_budget_con", "$choose_location"]);
                  														}

                  													} else {
                  														if ($choose_location=="") {
                  															$q=ams_sql("SELECT * FROM data_check where year_budget=? and status=?  order by barcode3", ["$year_budget_con", "$choose_status"]);
                  														} else {
                  															$q=ams_sql("SELECT * FROM data_check where year_budget=? and status=? and id_location_old=? order by barcode3", ["$year_budget_con", "$choose_status", "$choose_location"]);
                  														}

                  													}
                  											} else {
                  													if ($choose_status=="") {
                  														if ($choose_location=="") {
                  															$q=ams_sql("SELECT * FROM data_check where year_budget=? and id_member_check=? order by barcode3", ["$year_budget_con", "$choose_staff"]);
                  														} else {
                  															$q=ams_sql("SELECT * FROM data_check where year_budget=? and id_member_check=? and id_location_old=? order by barcode3", ["$year_budget_con", "$choose_staff", "$choose_location"]);
                  														}

                  													} else {
                  														if ($choose_location=="") {
                  															$q=ams_sql("SELECT * FROM data_check where year_budget=? and id_member_check=? and status=? order by barcode3", ["$year_budget_con", "$choose_staff", "$choose_status"]);
                  														} else {
                  															$q=ams_sql("SELECT * FROM data_check where year_budget=? and id_member_check=? and status=? and id_location_old=? order by barcode3", ["$year_budget_con", "$choose_staff", "$choose_status", "$choose_location"]);
                  														}

                  													}
                  											}
                  								} elseif($choose_year!="") {
                  									if ($choose_staff =="") {
                  											if ($choose_status=="") {
                  												if ($choose_location=="") {
                  													$q=ams_sql("SELECT * FROM data_check where year_budget=?  order by barcode3", ["$choose_year"]);
                  												} else {
                  													$q=ams_sql("SELECT * FROM data_check where year_budget=? and id_location_old=?  order by barcode3", ["$choose_year", "$choose_location"]);
                  												}

                  											} else {
                  												if ($choose_location=="") {
                  													$q=ams_sql("SELECT * FROM data_check where year_budget=? and status=?  order by barcode3", ["$choose_year", "$choose_status"]);
                  												} else {
                  													$q=ams_sql("SELECT * FROM data_check where year_budget=? and status=? and id_location_old=? order by barcode3", ["$choose_year", "$choose_status", "$choose_location"]);
                  												}

                  											}
                  									} else {
                  											if ($choose_status=="") {
                  												if ($choose_location=="") {
                  													$q=ams_sql("SELECT * FROM data_check where year_budget=? and id_member_check=? order by barcode3", ["$choose_year", "$choose_staff"]);
                  												} else {
                  													$q=ams_sql("SELECT * FROM data_check where year_budget=? and id_member_check=? and id_location_old=? order by barcode3", ["$choose_year", "$choose_staff", "$choose_location"]);
                  												}

                  											} else {
                  												if ($choose_location=="") {
                  													$q=ams_sql("SELECT * FROM data_check where year_budget=? and id_member_check=? and status=? order by barcode3", ["$choose_year", "$choose_staff", "$choose_status"]);
                  												} else {
                  													$q=ams_sql("SELECT * FROM data_check where year_budget=? and id_member_check=? and status=? and id_location_old=? order by barcode3", ["$choose_year", "$choose_staff", "$choose_status", "$choose_location"]);
                  												}

                  											}
                  									}
                  								}

                  																							$qr=ams_query($link,$q);
                  																							$total2=mysqli_num_rows($qr);


    ?>



              <table border="0" width="100%">

                <tr>
                  <td height="8"> </td>
                </tr>
                <tr>
                  <td align="center" style="font-size:15px;" colspan="15"><b>ทะเบียนครุภัณฑ์มหาวิมหาวิทยาลัยแม่ฟ้าหลวง</b></td>
                </tr>
                <tr>
                  <td height="5"> </td>
                </tr>
                <tr>
                  <td align="center" style="font-size:15px;" colspan="15">ศูนย์บรรณสารและสื่อการศึกษา</td>
                </tr>
                <tr>
                  <td height="15"> </td>
                </tr>
              </table>


              <table border="0" width="100%">
                <tr>
                  <td style="font-size:13px;" colspan="12" align="left">
                    <?php if($choose_yar=="") { ?>ปีงบประมาณ : <?php echo $year_budget_con; ?><?php } else { echo $choose_year; } ?>
                      &nbsp;&nbsp;|&nbsp;&nbsp;
                    <?php if($choose_staff!="") { ?>
                    <?php
                    $sql_mb_select = ams_sql("select * from  member where id=? ", ["$choose_staff"]);
                    $dbquery_mb_select=ams_query($link,$sql_mb_select) or die ("เลือกข้อมูลไม่ได้");
                    $result_mb_select=mysqli_fetch_array($dbquery_mb_select);
                    $id_mb_select=$result_mb_select['id'];
                    $name_mb_select=$result_mb_select['name'];
                    $surname_mb_select=$result_mb_select['surname'];
                    ?>

                    ผู้ตรวจนับ : <?php echo $name_mb_select; ?>&nbsp;<?php echo $surname_mb_select; ?>
                    <?php } ?>
                    &nbsp;&nbsp;|&nbsp;&nbsp;
                  <?php if($choose_status!="") { ?>
                    สถานะตรวจนับ :
                    <?php if ($choose_status=="1") { ?>ตรวจนับแล้ว
                    <?php } elseif($choose_status=="2") { ?>ยังไม่ได้ตรวจนับ
                    <?php } ?>

                  <?php } ?>
                </td>
                </tr>
              </table>




              <table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-color:#000;border-collapse:collapse;">
                  <tr>
                    <td rowspan="2" style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80"> ลำดับ</td>
                    <td rowspan="2" style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">เลขครุภัณฑ์</td>
                    <td rowspan="2" style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">รายการ</td>

                    <td colspan="3" style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">ข้อมูลสถานะ (เดิม)</td>
                    <td colspan="3" style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">ข้อมูลสถานะ (ปัจจะบัน)</td>
                    <td rowspan="2" style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">ผู้ตรวจนับ</td>

                  </tr>
                  <tr>
                    <td style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">สถานที่ใช้งาน</td>
                    <td style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">ผู้ใช้งาน</td>
                    <td style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">สถานะ</td>
                    <td style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">สถานที่ใช้งาน</td>
                    <td style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">ผู้ใช้งาน</td>
                    <td style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">สถานะ</td>

</tr>
                <tbody>
                  <?php
                  if($total2!=0){
                      $i=1;
                      while($rs=mysqli_fetch_array($qr))
                  {

                    $sql_data = ams_sql("select * from  data_lda where id=? ", ["$rs[id_data_lda]"]);
                    $qr_data=ams_query($link,$sql_data) or die ("เลือกข้อมูลไม่ได้");
                              $rs_data=mysqli_fetch_array($qr_data);
                              $barcode1=$rs_data['barcode1'];
                              $lda_year=$rs_data['lda_year'];
                              $lda_list=$rs_data['lda_list'];
                              $lda_brand=$rs_data['lda_brand'];
                              $status_table=$rs_data['lda_status'];
                              $price=$rs_data['price'];
                              $id_category=$rs_data['id_category'];
                              $lda_serial=$rs_data['lda_serial'];
                    ?>
                  <tr>
                    <td style="font-size:12px;" align="center"><?php echo $i;?>.</td>
                    <td style="font-size:12px;" align="center">
                      <?php if($rs['barcode2']!="" && $rs['barcode2']!="-") { echo $rs['barcode2']; } else { ?>
                      <?php echo $barcode1; ?>
                    <?php } ?>
                    </td>
                    <td style="font-size:12px;"><?php  echo $lda_list; ?></td>

                    <td style="font-size:12px;" align="center">
                      <?php
                                  $sql_locate95 = ams_sql("select * from  data_location where id=? ", ["$rs[id_location_old]"]);
                                  $qr_locate95=ams_query($link,$sql_locate95) or die ("เลือกข้อมูลไม่ได้");
                                  $rs_locate95=mysqli_fetch_array($qr_locate95);
                                  $name_locate95=$rs_locate95['name_location'];
                      ?>
                      <?php echo $name_locate95; ?>

                    </td>
                    <td style="font-size:12px;" ><?php echo $rs['name_use_old']; ?></td>
                    <td style="font-size:12px;" align="center">
                      <?php if ($rs['status_old']=="1") { ?>ใช้งานปกติ
                      <?php } elseif($rs['status_old']=="2") { ?>ชำรุด
                      <?php } elseif($rs['status_old']=="3") { ?>สูญหาย
                      <?php } elseif($rs['status_old']=="4") { ?>โอนย้าย / บริจาค
                      <?php } elseif($rs['status_old']=="5") { ?>จำหน่ายออก
                      <?php } elseif($rs['status_old']=="6") { ?>ส่งซ่อม
                      <?php } elseif($rs['status_old']=="7") { ?>สภาพปกติ ไม่่จำเป็นต้องใช้งาน
                      <?php } elseif($rs['status_old']=="8") { ?>รอจำหน่ายออก
                      <?php } ?>
                    </td>
                    <td style="font-size:12px;" align="center">
                      <?php
                                  $sql_locate = ams_sql("select * from  data_location where id=? ", ["$rs[id_location]"]);
                                  $qr_locate=ams_query($link,$sql_locate) or die ("เลือกข้อมูลไม่ได้");
                                  $rs_locate=mysqli_fetch_array($qr_locate);
                                  $name_locate=$rs_locate['name_location'];
                      ?>
                      <?php echo $name_locate; ?>
                    </td>
                    <td style="font-size:12px;" ><?php echo $rs['name_use']; ?></td>
                    <td style="font-size:12px;" align="center">
                    <?php if ($status_table=="1") { ?>ใช้งานปกติ
                    <?php } elseif($status_table=="2") { ?>ชำรุด
                    <?php } elseif($status_table=="3") { ?>สูญหาย
                    <?php } elseif($status_table=="4") { ?>โอนย้าย / บริจาค
                    <?php } elseif($status_table=="5") { ?>จำหน่ายออก
                    <?php } elseif($status_table=="6") { ?>ส่งซ่อม
                    <?php } elseif($status_table=="7") { ?>สภาพปกติ ไม่่จำเป็นต้องใช้งาน
                    <?php } elseif($status_table=="8") { ?>รอจำหน่ายออก
                    <?php } ?>
                    </td>
                    <td style="font-size:12px;">
                      <?php
                                  $sql_member_last = ams_sql("select * from  member where id=? ", ["$rs[id_member_choose]"]);
                                  $qr_member_last=ams_query($link,$sql_member_last) or die ("เลือกข้อมูลไม่ได้");
                                  $rs_member_last=mysqli_fetch_array($qr_member_last);
                                  $name_last=$rs_member_last['name'];
                                  $surname_last=$rs_member_last['surname'];
                      ?>
                      <?php echo $name_last; ?>&nbsp;<?php echo $surname_last; ?>
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

</body>
</html>
<?php } ?>
