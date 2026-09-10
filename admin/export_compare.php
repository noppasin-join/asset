<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
$choose_year = '';
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
header('Content-Disposition: attachment; filename="export_compare.xls"');
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

                  if ($choose_year=="") {
                      $q=ams_sql("SELECT * FROM data_compare_view where year_budget=? group by barcode order by barcode", ["$year_budget"]);
                  } elseif($choose_year!="") {
                      $q=ams_sql("SELECT * FROM data_compare_view where year_budget=? group by barcode order by barcode", ["$choose_year"]);
                  }

                              $qr=ams_query($link,$q);
                              $total2=mysqli_num_rows($qr);

    ?>



              <table border="0" width="100%">

                <tr>
                  <td height="8"> </td>
                </tr>
                <tr>
                  <td align="center" style="font-size:15px;" colspan="6"><b>เทียบรายการครุภัณฑ์กับส่วนพัสดุ</b></td>
                </tr>
                <tr>
                  <td align="center" style="font-size:15px;" colspan="6"><b>กรณีชื่อรายการที่ไม่ตรงกัน</b></td>
                </tr>
                <tr>
                  <td height="15"> </td>
                </tr>
              </table>


              <table border="0" width="100%">
                <tr>
                  <td style="font-size:13px;" colspan="6" align="left">
                    <?php if($choose_yar=="") { ?>ปีงบประมาณ : <?php echo $year_budget; ?><?php } else { echo $choose_year; } ?>
                </td>
                </tr>
              </table>

							<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-color:#000;border-collapse:collapse;">
									<tr>
										<td style="color:#FFF;font-size: 13px;" align="center" bgcolor="#7c7b80">ลำดับ </td>
                    <td style="color:#FFF;font-size: 13px" align="center" bgcolor="#7c7b80">Asset</td>
                    <td style="color:#FFF;font-size: 13px" align="center" bgcolor="#7c7b80">เลขครุภัณฑ์</td>
										<td style="color:#FFF;font-size: 13px" align="center" bgcolor="#7c7b80">รายการ (LIB)</td>
                    <td style="color:#FFF;font-size: 13px" align="center" bgcolor="#7c7b80">รายการ (พัสดุ)</td>
									</tr>
								<tbody>
									<?php




									if($total2!=0){
											$i=1;
											while($rs=mysqli_fetch_array($qr))
									{

                    $sql_asset = ams_sql("select * from  data_lda where barcode1=?  ", ["$rs[barcode]"]);
                    $qr_asset=ams_query($link,$sql_asset) or die ("เลือกข้อมูลไม่ได้");
                    $rs_asset=mysqli_fetch_array($qr_asset);
                    $asset=$rs_asset['asset'];

										?>
									<tr>
										<td align="center" style="font-size:12px;"><?php echo $i; ?>.</td>
                    <td align="center" style="font-size:12px;"><?php echo $asset; ?></td>
                    <td align="center" style="font-size:12px;"><?php echo $rs['barcode']; ?></td>
										<td align="left" style="font-size:12px;"><?php echo $rs['title']; ?></td>
                    <td align="left" style="font-size:12px;"><?php echo $rs['title_2']; ?></td>

									</tr>

									<?php $i++; } ?>
									<?php } else { ?>
									<tr>
										<td class="center9 font_brown" colspan="6"><< ไม่มีข้อมูล >></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>

</body>
</html>
<?php } ?>
