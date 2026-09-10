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
<title>PDF</title>
<link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
<style>
body {
    font-family: sarabun;
}


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

                                    $sql_cat = ams_sql("select * from  category where id=? ", ["$choose_category"]);
                                    $dbquery_cat=ams_query($link,$sql_cat) or die ("เลือกข้อมูลไม่ได้");
                                    $result_cat=mysqli_fetch_array($dbquery_cat);
                                    $cat_list=$result_cat['name_category'];
?>



              <br/>
              <div class="pull-left">
              ปีงบประมาณ :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php if($choose_year=="") { echo "ทั้งหมด"; } else { echo $choose_year; } ?>&nbsp;&nbsp;</font>

                      <?php if($choose_category!="") { ?>&nbsp;&nbsp;&nbsp;
                      หมวดหมู่ :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo "$cat_list"; ?>&nbsp;&nbsp;</font>
                      <?php } ?>
                      <?php if($choose_status!="") { ?>&nbsp;&nbsp;&nbsp;
                      สถานะ :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;
                        <?php if($choose_status=="1") { ?>ใช้งานปกติ<?php } ?>
                        <?php if($choose_status=="2") { ?>ชำรุด<?php } ?>
                        <?php if($choose_status=="3") { ?>สูญหาย<?php } ?>
                        <?php if($choose_status=="4") { ?>โอนย้าย / บริจาค<?php } ?>
                        <?php if($choose_status=="5") { ?>จำหน่ายออก<?php } ?>
                        <?php if($choose_status=="6") { ?>ส่งซ่อม<?php } ?>
                        <?php if($choose_status=="7") { ?>สภาพปกติ ไม่จำเป็นต้องใช้งาน<?php } ?>
                        <?php if($choose_status=="8") { ?>รอจำหน่ายออก<?php } ?>
                        &nbsp;&nbsp;</font>
                      <?php } ?>
                      <?php if($txt_no!="") { ?>&nbsp;&nbsp;&nbsp;
                      ค้นหาเลขครุภัณฑ์ :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo "$txt_no"; ?>&nbsp;&nbsp;</font>
                      <?php } ?>
                      <?php if($txt_title!="") { ?>&nbsp;&nbsp;&nbsp;
                      ค้นหารายการ :&nbsp;&nbsp;<font class="under_line_blue">&nbsp;&nbsp;<?php echo "$txt_title"; ?>&nbsp;&nbsp;</font>
                      <?php } ?>
                </div>
                <div id="non-printable" class="pull-right">ดาวโหลดรายงานในรูปแบบ PDF <a href="mypdf/report_data.pdf" target="_blank">คลิกที่นี้</a></div>



              <table style="border-collapse: collapse;" width="100%">
                  <tr>
                    <th> ลำดับ </th>
                    <th>Asset</th>
                    <th>เลขครุภัณฑ์</th>
                    <th>รายการ</th>
                    <th class="center">ยี่ห้อ</th>
                    <th>สถานที่ใช้งาน</th>
                    <th>ผู้ใช้งาน</th>
                    <th>สถานะ</th>
                    <th>หมวดหมู่</th>
                  </tr>
                <tbody>
                  <?php
                  if($total2!=0){
                      $i=1;
                      while($rs=mysqli_fetch_array($qr))
                  {
                    ?>
                  <tr>
                    <td style="text-align:center;"><?php echo $i; ?>.</td>
                    <td style="text-align:center;"><?php echo $rs['asset']; ?></td>
                    <td style="text-align:center;"><?php echo $rs['barcode1']; ?></td>
                    <td ><?php  echo $rs['lda_list']; ?></td>
                    <td><?php echo $rs['lda_brand']; ?></td>
                    <td>
                      <?php
                                  $sql_locate = ams_sql("select * from  data_location where id=? ", ["$rs[id_location]"]);
                                  $qr_locate=ams_query($link,$sql_locate) or die ("เลือกข้อมูลไม่ได้");
                                  $rs_locate=mysqli_fetch_array($qr_locate);
                                  $name_locate=$rs_locate['name_location'];
                      ?>
                      <?php echo $name_locate; ?>
                    </td>
                    <td><?php echo $rs['name_use']; ?></td>
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
                    <td style="text-align:center;">
                      <?php
                                  $sql_cat_list = ams_sql("select * from  category where id=? ", ["$rs[id_category]"]);
                                  $qr_cat_list=ams_query($link,$sql_cat_list) or die ("เลือกข้อมูลไม่ได้");
                                  $rs_cat_list=mysqli_fetch_array($qr_cat_list);
                                  $name_category_list=$rs_cat_list['name_category'];
                      ?>
                      <?php echo $name_category_list; ?>
                    </td>


                  </tr>

                  <?php $i++; } ?>
                  <?php } else { ?>
                  <tr>
                    <td colspan="15"><< ไม่มีข้อมูล >></td>
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
