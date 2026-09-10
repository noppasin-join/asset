<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
$choose_year = '';
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

      if ($choose_year=="") {
          $q=ams_sql("SELECT * FROM data_compare_view_2 where year_budget=? group by barcode  order by barcode", ["$year_budget"]);
      } elseif($choose_year!="") {
          $q=ams_sql("SELECT * FROM data_compare_view_2 where year_budget=? group by barcode order by barcode", ["$choose_year"]);
      }

      $qr=ams_query($link,$q);
      $total2=mysqli_num_rows($qr);
?>



              <br/>
              <div class="pull-left">
              ปีงบประมาณ :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php if($choose_year=="") { echo $year_budget; } else { echo $choose_year; } ?>&nbsp;&nbsp;</font>
                </div>
                <div id="non-printable" class="pull-right">ดาวโหลดรายงานในรูปแบบ <a href="mypdf/report_data.pdf" target="_blank">PDF</a> , <a href="export_compare_2.php?choose_year=<?php echo $choose_year;?>" target="_blank">Excel</a></div>


              <table style="border-collapse: collapse;" width="100%">
                  <tr>
                    <th> ลำดับ </th>
                    <th>Asset</th>
                    <th>เลขครุภัณฑ์</th>
                    <th>รายการ (LIB)</th>
                    <th>รายการ (พัสดุ)</th>
                  </tr>
                <tbody>
                  <?php
                  if($total2!=0){
                      $i=1;
                      while($rs=mysqli_fetch_array($qr))
                  {

                    $sql_asset = ams_sql("SELECT * from  data_lda where barcode1=?  ", ["$rs[barcode]"]);
                    $qr_asset=ams_query($link,$sql_asset) or die ("เลือกข้อมูลไม่ได้");
                    $rs_asset=mysqli_fetch_array($qr_asset);
                    $asset=$rs_asset['asset'];

                    ?>
                  <tr>
                    <td style="text-align:center;"><?php echo $i; ?>.</td>
                    <td style="text-align:center;"><?php echo $asset; ?></td>
                    <td style="text-align:center;"><?php echo $rs['barcode']; ?></td>
                    <td ><?php  echo $rs['title']; ?></td>
                    <td ><?php  echo $rs['title_2']; ?></td>
                  </tr>

                  <?php $i++; } ?>
                  <?php } else { ?>
                  <tr>
                    <td colspan="5" align="center"><< ไม่มีข้อมูล >></td>
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
