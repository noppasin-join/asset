<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
$choose_year = '';
$choose_category = '';
$id = '';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
$sess_user = $_SESSION['sess_user'] ?? '';
$sess_password = $_SESSION['sess_password'] ?? '';

require_once __DIR__ . '/con_lda.php';
if ($sess_user == "" || $status!="0") {
    ams_deny(403, 'Insufficient permissions.');
} else {
set_time_limit(0);

?>


<?php
// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];
$mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/tmp',
    'fontdata' => $fontData + [
            'sarabun' => [
                'R' => 'THSarabunNew.ttf',
                'I' => 'THSarabunNewItalic.ttf',
                'B' =>  'THSarabunNewBold.ttf',
                'BI' => "THSarabunNewBoldItalic.ttf",
            ]
        ],
]);

ob_start(); // Start get HTML code
?>

<!DOCTYPE html>
<html>
<head>
<title>View เทียบรายการครุภัณฑ์</title>
<link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
<style>


td {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>

<style type="text/css">

#printable { display: block; }

@media print
{
     #non-printable { display: none; }
     #printable { display: block; }
}

</style>


<link rel="stylesheet" href="assets/font-awesome/4.2.0/css/font-awesome.min.css" />
<!-- ace styles -->
<link rel="stylesheet" href="reg-style.css" />
<style> body { font-family: sarabun; } </style>
<link rel="stylesheet" href="AdminLTE.min.css">

</head>
<body>
  <?php

  $sql_year="SELECT * FROM budget order by year_budget desc";
  $query_year=ams_query($link,$sql_year);
    $result_year=mysqli_fetch_array($query_year);
      $year_budget=$result_year['year_budget'];

			$choose_year=$_GET['choose_year'] ?? '';
			$choose_category=$_GET['choose_category'] ?? '';
			$id=$_GET['id'] ?? '';

			if ($choose_year=="") {

					if ($choose_category=="") {
							$q=ams_sql("SELECT * FROM data_lda where barcode1=?  order by barcode3", ["$id"]);
					} else {
							$q=ams_sql("SELECT * FROM data_lda where barcode1=? and id_category=? order by barcode3", ["$id", "$choose_category"]);
					}

			} elseif($choose_year!="") {

					if ($choose_category=="") {
							$q=ams_sql("SELECT * FROM data_lda where barcode1=? and year_budget=? order by barcode3", ["$id", "$choose_year"]);
					} else {
							$q=ams_sql("SELECT * FROM data_lda where barcode1=? and year_budget=? and id_category=? order by barcode3", ["$id", "$choose_year", "$choose_category"]);
					}

			}

                                    $qr=ams_query($link,$q);
                                    $total2=mysqli_num_rows($qr);

                                    $sql_cat = ams_sql("SELECT * from  category where id=? ", ["$choose_category"]);
                                    $dbquery_cat=ams_query($link,$sql_cat) or die ("เลือกข้อมูลไม่ได้");
                                    $result_cat=mysqli_fetch_array($dbquery_cat);
                                    $cat_list=$result_cat['name_category'];
?>



              <br/>
              <div class="pull-left">
              ปีงบประมาณ :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php if($choose_year=="") { echo $year_budget; } else { echo $choose_year; } ?>&nbsp;&nbsp;</font>
                </div>
                <div id="non-printable" class="pull-right">ดาวโหลดรายงานในรูปแบบ <a href="mypdf/report_data.pdf" target="_blank">PDF</a> </div>


              <table style="border-collapse: collapse;" width="100%">
                  <tr>
                    <th> ลำดับ </th>
                    <th>Asset</th>
										<th>เลขครุภัณฑ์(พัสดุ)</th>
										<th>เลขครุภัณฑ์(ศูนย์บรรณสารฯ)</th>
                    <th>ชื่อรายการ</th>
										<th>สถานที่ใช้งาน</th>
										<th>ผู้ใช้งาน</th>
										<th>สถานะ</th>
                  </tr>
                <tbody>
                  <?php
                  if($total2!=0){
                      $i=1;
                      while($rs=mysqli_fetch_array($qr))
                  {



                    ?>
                  <tr>
                    <td style="text-align:center;"><?php echo $i; ?>.
                      <?php
                      //$sql_update="UPDATE data_lda set barcode3='$rs[barcode1]-$i' where id='$rs[id]'";
                      //$qr_update=ams_query($link,$sql_update) or die ("Error_Upload_File JPG");
                      ?>
                    </td>
                    <td style="text-align:center;"><?php echo $rs['asset']; ?></td>
										<td style="text-align:center;"><?php echo $rs['barcode1']; ?></td>
										<td style="text-align:center;"><?php echo $rs['barcode3']; ?></td>
										<td><?php echo $rs['lda_list']; ?></td>
                    <td style="text-align:center;">
											<?php
																	$sql_locate = ams_sql("SELECT * from  data_location where id=? ", ["$rs[id_location]"]);
																	$qr_locate=ams_query($link,$sql_locate) or die ("เลือกข้อมูลไม่ได้");
																	$rs_locate=mysqli_fetch_array($qr_locate);
																	$name_locate=$rs_locate['name_location'];
											?>
											<?php echo $name_locate; ?>
										</td>
                    <td ><?php echo $rs['name_use']; ?></td>
										<td style="text-align:center;">
											<?php if ($rs['lda_status']=="1") { ?>ใช้งานปกติ
											<?php } elseif($rs['lda_status']=="2") { ?>ชำรุด
											<?php } elseif($rs['lda_status']=="3") { ?>สูญหาย
											<?php } elseif($rs['lda_status']=="4") { ?>โอนย้าย / บริจาค
											<?php } elseif($rs['lda_status']=="5") { ?>จำหน่ายออก
											<?php } elseif($rs['lda_status']=="6") { ?>ส่งซ่อม
											<?php } elseif($rs['lda_status']=="7") { ?>สภาพปกติ ไม่จำเป็นต้องใช้งาน
											<?php } elseif($rs['lda_status']=="8") { ?>รอจำหน่ายออก
											<?php } ?>
										</td>
                  </tr>

                  <?php $i++; } ?>
                  <?php } else { ?>
                  <tr>
                    <td colspan="4" align="center"><< ไม่มีข้อมูล >></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>





</body>
</html>


<?php
$html = ob_get_contents();
$mpdf->WriteHTML($html);
$mpdf->Output("mypdf/report_data.pdf");
ob_end_flush()
?>


<?php } ?>
