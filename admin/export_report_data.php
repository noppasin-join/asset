<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
$choose_year = '';
$choose_category = '';
$choose_status = '';
$txt_no = '';
$txt_title = '';
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
header('Content-Disposition: attachment; filename="export_report_data.xls"');

?>

<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta charset="utf-8" />
<title>:: ระบบฐานข้อมูลครุภัณฑ์ ศูนย์บรรณสารฯ</title>
</head>
<body>
  <?php
              $sql_year="SELECT * FROM budget order by year_budget desc";
              $query_year=ams_query($link,$sql_year);
                $result_year=mysqli_fetch_array($query_year);
                  $year_budget=$result_year['year_budget'];

                  $choose_year=$_GET['choose_year'] ?? '';
                  $choose_category=$_GET['choose_category'] ?? '';
                  $choose_status=$_GET['choose_status'] ?? '';
                  $txt_no=$_GET['txt_no'] ?? '';
                  $txt_title=$_GET['txt_title'] ?? '';

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



              <table border="0" width="100%">

                <tr>
                  <td height="8"> </td>
                </tr>
                <tr>
                  <td align="center" style="font-size:15px;" colspan="12"><b>ทะเบียนครุภัณฑ์มหาวิมหาวิทยาลัยแม่ฟ้าหลวง</b></td>
                </tr>
                <tr>
                  <td height="5"> </td>
                </tr>
                <tr>
                  <td align="center" style="font-size:15px;" colspan="12">ศูนย์บรรณสารและสื่อการศึกษา</td>
                </tr>
                <tr>
                  <td height="15"> </td>
                </tr>
              </table>


              <table border="0" width="100%">
                <tr>
                  <td style="font-size:13px;" colspan="12" align="left">
                    <?php if($choose_yar=="") { ?>ปีงบประมาณ : <?php echo "ทั้งหมด"; ?><?php } else { echo $choose_year; } ?>
                      &nbsp;&nbsp;|&nbsp;&nbsp;
                    <?php if($choose_category!="") { ?>
                    <?php
                                  $sql_cat9 = ams_sql("select * from  category where id=? ", ["$choose_category"]);
                                  $qr_cat9=ams_query($link,$sql_cat9) or die ("เลือกข้อมูลไม่ได้");
                                  $rs_cat9=mysqli_fetch_array($qr_cat9);
                                  $name_category9=$rs_cat9['name_category'];
                    ?>

                    หมวดหมู่ : <?php echo $name_category9; ?>
                    &nbsp;&nbsp;|&nbsp;&nbsp;
                    <?php } ?>

                  <?php if($choose_status!="") { ?>
                    สถานะ :
                    <?php if ($choose_status=="1") { ?>ใช้งานปกติ
                    <?php } elseif($choose_status=="2") { ?>ชำรุด
                    <?php } elseif($choose_status=="3") { ?>สูญหาย
                    <?php } elseif($choose_status=="4") { ?>โอนย้าย / บริจาค
                    <?php } elseif($choose_status=="5") { ?>จำหน่ายออก
                    <?php } elseif($choose_status=="6") { ?>ส่งซ่อม
                    <?php } ?>

                  <?php } ?>
                </td>
                </tr>
              </table>

							<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-color:#000;border-collapse:collapse;">
									<tr>
										<td style="color:#FFF;font-size: 13px;" align="center" bgcolor="#7c7b80"> ลำดับ </td>
                    <td style="color:#FFF;font-size: 13px" align="center" bgcolor="#7c7b80">Asset</td>
                    <td style="color:#FFF;font-size: 13px" align="center" bgcolor="#7c7b80">เลขครุภัณฑ์</td>
										<td style="color:#FFF;font-size: 13px" align="center" bgcolor="#7c7b80">ปี</td>
										<td style="color:#FFF;font-size: 13px" align="center" bgcolor="#7c7b80">รายการ</td>
                    <td style="color:#FFF;font-size: 13px" align="center" bgcolor="#7c7b80">ยี่ห้อ</td>
                    <td style="color:#FFF;font-size: 13px" align="center" bgcolor="#7c7b80">Serial No.</td>
										<td style="color:#FFF;font-size: 13px" align="center" bgcolor="#7c7b80">สถานที่ใช้งาน</td>
										<td style="color:#FFF;font-size: 13px" align="center" bgcolor="#7c7b80">ผู้ใช้งาน</td>
										<td style="color:#FFF;font-size: 13px" align="center" bgcolor="#7c7b80">สถานะ</td>
                    <td style="color:#FFF;font-size: 13px" align="center" bgcolor="#7c7b80">หมวดหมู่</td>
                    <td style="color:#FFF;font-size: 13px" align="center" bgcolor="#7c7b80">หมดประกัน</td>
									</tr>
								<tbody>
									<?php




									if($total2!=0){
											$i=1;
											while($rs=mysqli_fetch_array($qr))
									{
										?>
									<tr>
										<td align="center" style="font-size:12px;"><?php echo $i; ?>.</td>
                    <td align="center" style="font-size:12px;"><?php echo $rs['asset']; ?></td>
                    <td align="center" style="font-size:12px;"><?php echo "'$rs[barcode1]"; ?></td>
										<td align="center" style="font-size:12px;"><?php echo $rs['lda_year']; ?></td>
										<td style="font-size:12px;"><?php  echo $rs['lda_list']; ?></td>
                    <td style="font-size:12px;"><?php echo $rs['lda_brand']; ?></td>
                    <td align="center" style="font-size:12px;"><?php echo $rs['lda_serial']; ?></td>
										<td align="center" style="font-size:12px;">
											<?php
																	$sql_locate = ams_sql("select * from  data_location where id=? ", ["$rs[id_location]"]);
																	$qr_locate=ams_query($link,$sql_locate) or die ("เลือกข้อมูลไม่ได้");
																	$rs_locate=mysqli_fetch_array($qr_locate);
																	$name_locate=$rs_locate['name_location'];
											?>
											<?php echo $name_locate; ?>
										</td>
										<td style="font-size:12px;"><?php echo $rs['name_use']; ?></td>
										<td align="center" style="font-size:12px;">
										<?php if ($rs['lda_status']=="1") { ?>ใช้งานปกติ
										<?php } elseif($rs['lda_status']=="2") { ?>ชำรุด
										<?php } elseif($rs['lda_status']=="3") { ?>สูญหาย
										<?php } elseif($rs['lda_status']=="4") { ?>โอนย้าย / บริจาค
                    <?php } elseif($rs['lda_status']=="5") { ?>จำหน่ายออก
                    <?php } elseif($rs['lda_status']=="6") { ?>ส่งซ่อม
                    <?php } elseif($rs['lda_status']=="7") { ?>สภาพปกติ ไม่จำเป็นต้องใช้งาน
										<?php } ?>
										</td>
										<td align="center" style="font-size:12px;">
											<?php
																	$sql_cat_list = ams_sql("select * from  category where id=? ", ["$rs[id_category]"]);
																	$qr_cat_list=ams_query($link,$sql_cat_list) or die ("เลือกข้อมูลไม่ได้");
																	$rs_cat_list=mysqli_fetch_array($qr_cat_list);
																	$name_category_list=$rs_cat_list['name_category'];
											?>
											<?php echo $name_category_list; ?>
										</td>
                    <td align="center" style="font-size:12px;"><?php echo $rs['date_expire']; ?></td>

									</tr>

									<?php $i++; } ?>
									<?php } else { ?>
									<tr>
										<td class="center9 font_brown" colspan="15"><< ไม่มีข้อมูล >></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>

</body>
</html>
<?php } ?>
