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
              $sql_year="SELECT * FROM budget order by year_budget desc";
              $query_year=ams_query($link,$sql_year);
                $result_year=mysqli_fetch_array($query_year);
                  $year_budget=$result_year['year_budget'];

                  $choose_year=$_GET['choose_year'] ?? '';




    ?>



              <table border="0" width="100%">

                <tr>
                  <td height="8"> </td>
                </tr>
                <tr>
                  <td align="center" style="font-size:15px;" colspan="15"><b>รายงานยืมวัสดุ/ครุภัณฑ์</b></td>
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
                    <?php if($choose_yar=="") { ?>ปีงบประมาณ : <?php echo $year_budget; ?><?php } else { echo $choose_year; } ?>
                </td>
                </tr>
              </table>




              <table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-color:#000;border-collapse:collapse;">
                  <tr>
                    <td style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">ลำดับ</td>
                    <td style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">หมวดหมู่</td>

                    <td style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">ต.ค.<br/>(จำนวน)</td>
                    <td style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">พ.ย.<br/>(จำนวน)</td>
                    <td style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">ธ.ค.<br/>(จำนวน)</td>
                    <td style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">ม.ค.<br/>(จำนวน)</td>
                    <td style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">ก.พ.<br/>(จำนวน)</td>
                    <td style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">มี.ค.<br/>(จำนวน)</td>
                    <td style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">เม.ย.<br/>(จำนวน)</td>
                    <td style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">พ.ค.<br/>(จำนวน)</td>
                    <td style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">มื.ย.<br/>(จำนวน)</td>
                    <td style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">ก.ค.<br/>(จำนวน)</td>
                    <td style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">ส.ค.<br/>(จำนวน)</td>
                    <td style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">ก.ย.<br/>(จำนวน)</td>
                    <td style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">รวม<br/>(จำนวน)</td>
                  </tr>

                <tbody>

                  <?php
                  $q="SELECT * FROM category order by name_category";
                  $qr=ams_query($link,$q);
                  $total2=mysqli_num_rows($qr);
                  ?>


                  <?php if($total2!="0") { ?>
                 <?php
                   $i=1;
                   $i_data=0;
                   while($i_data<$total2)
                   {
                             $rs_cate=mysqli_fetch_array($qr);
                             $id_cate=$rs_cate['id'];
                             $name_category=$rs_cate['name_category'];
                   ?>

                   <?php
                   if($choose_year=="") {
                   $sql_1 = ams_sql("select * from  data_take_list_more where year_budget=? and for_month='01' and id_category=?  ", ["$year_budget", "$id_cate"]); $qr_1=ams_query($link,$sql_1) or die ("เลือกข้อมูลไม่ได้");$num_1=mysqli_num_rows($qr_1);
                   $sql_2 = ams_sql("select * from  data_take_list_more where year_budget=? and for_month='02' and id_category=?  ", ["$year_budget", "$id_cate"]); $qr_2=ams_query($link,$sql_2) or die ("เลือกข้อมูลไม่ได้");$num_2=mysqli_num_rows($qr_2);
                   $sql_3 = ams_sql("select * from  data_take_list_more where year_budget=? and for_month='03' and id_category=?  ", ["$year_budget", "$id_cate"]); $qr_3=ams_query($link,$sql_3) or die ("เลือกข้อมูลไม่ได้");$num_3=mysqli_num_rows($qr_3);
                   $sql_4 = ams_sql("select * from  data_take_list_more where year_budget=? and for_month='04' and id_category=?  ", ["$year_budget", "$id_cate"]); $qr_4=ams_query($link,$sql_4) or die ("เลือกข้อมูลไม่ได้");$num_4=mysqli_num_rows($qr_4);
                   $sql_5 = ams_sql("select * from  data_take_list_more where year_budget=? and for_month='05' and id_category=?  ", ["$year_budget", "$id_cate"]); $qr_5=ams_query($link,$sql_5) or die ("เลือกข้อมูลไม่ได้");$num_5=mysqli_num_rows($qr_5);
                   $sql_6 = ams_sql("select * from  data_take_list_more where year_budget=? and for_month='06' and id_category=?  ", ["$year_budget", "$id_cate"]); $qr_6=ams_query($link,$sql_6) or die ("เลือกข้อมูลไม่ได้");$num_6=mysqli_num_rows($qr_6);
                   $sql_7 = ams_sql("select * from  data_take_list_more where year_budget=? and for_month='07' and id_category=?  ", ["$year_budget", "$id_cate"]); $qr_7=ams_query($link,$sql_7) or die ("เลือกข้อมูลไม่ได้");$num_7=mysqli_num_rows($qr_7);
                   $sql_8 = ams_sql("select * from  data_take_list_more where year_budget=? and for_month='08' and id_category=?  ", ["$year_budget", "$id_cate"]); $qr_8=ams_query($link,$sql_8) or die ("เลือกข้อมูลไม่ได้");$num_8=mysqli_num_rows($qr_8);
                   $sql_9 = ams_sql("select * from  data_take_list_more where year_budget=? and for_month='09' and id_category=?  ", ["$year_budget", "$id_cate"]); $qr_9=ams_query($link,$sql_9) or die ("เลือกข้อมูลไม่ได้");$num_9=mysqli_num_rows($qr_9);
                   $sql_10 = ams_sql("select * from  data_take_list_more where year_budget=? and for_month='10' and id_category=?  ", ["$year_budget", "$id_cate"]); $qr_10=ams_query($link,$sql_10) or die ("เลือกข้อมูลไม่ได้");$num_10=mysqli_num_rows($qr_10);
                   $sql_11 = ams_sql("select * from  data_take_list_more where year_budget=? and for_month='11' and id_category=?  ", ["$year_budget", "$id_cate"]); $qr_11=ams_query($link,$sql_11) or die ("เลือกข้อมูลไม่ได้");$num_11=mysqli_num_rows($qr_11);
                   $sql_12 = ams_sql("select * from  data_take_list_more where year_budget=? and for_month='12' and id_category=?  ", ["$year_budget", "$id_cate"]); $qr_12=ams_query($link,$sql_12) or die ("เลือกข้อมูลไม่ได้");$num_12=mysqli_num_rows($qr_12);
                   } else {
                   	$sql_1 = ams_sql("select * from  data_take_list_more where year_budget=? and for_month='01' and id_category=?  ", ["$choose_year", "$id_cate"]); $qr_1=ams_query($link,$sql_1) or die ("เลือกข้อมูลไม่ได้");$num_1=mysqli_num_rows($qr_1);
                   	$sql_2 = ams_sql("select * from  data_take_list_more where year_budget=? and for_month='02' and id_category=?  ", ["$choose_year", "$id_cate"]); $qr_2=ams_query($link,$sql_2) or die ("เลือกข้อมูลไม่ได้");$num_2=mysqli_num_rows($qr_2);
                   	$sql_3 = ams_sql("select * from  data_take_list_more where year_budget=? and for_month='03' and id_category=?  ", ["$choose_year", "$id_cate"]); $qr_3=ams_query($link,$sql_3) or die ("เลือกข้อมูลไม่ได้");$num_3=mysqli_num_rows($qr_3);
                   	$sql_4 = ams_sql("select * from  data_take_list_more where year_budget=? and for_month='04' and id_category=?  ", ["$choose_year", "$id_cate"]); $qr_4=ams_query($link,$sql_4) or die ("เลือกข้อมูลไม่ได้");$num_4=mysqli_num_rows($qr_4);
                   	$sql_5 = ams_sql("select * from  data_take_list_more where year_budget=? and for_month='05' and id_category=?  ", ["$choose_year", "$id_cate"]); $qr_5=ams_query($link,$sql_5) or die ("เลือกข้อมูลไม่ได้");$num_5=mysqli_num_rows($qr_5);
                   	$sql_6 = ams_sql("select * from  data_take_list_more where year_budget=? and for_month='06' and id_category=?  ", ["$choose_year", "$id_cate"]); $qr_6=ams_query($link,$sql_6) or die ("เลือกข้อมูลไม่ได้");$num_6=mysqli_num_rows($qr_6);
                   	$sql_7 = ams_sql("select * from  data_take_list_more where year_budget=? and for_month='07' and id_category=?  ", ["$choose_year", "$id_cate"]); $qr_7=ams_query($link,$sql_7) or die ("เลือกข้อมูลไม่ได้");$num_7=mysqli_num_rows($qr_7);
                   	$sql_8 = ams_sql("select * from  data_take_list_more where year_budget=? and for_month='08' and id_category=?  ", ["$choose_year", "$id_cate"]); $qr_8=ams_query($link,$sql_8) or die ("เลือกข้อมูลไม่ได้");$num_8=mysqli_num_rows($qr_8);
                   	$sql_9 = ams_sql("select * from  data_take_list_more where year_budget=? and for_month='09' and id_category=?  ", ["$choose_year", "$id_cate"]); $qr_9=ams_query($link,$sql_9) or die ("เลือกข้อมูลไม่ได้");$num_9=mysqli_num_rows($qr_9);
                   	$sql_10 = ams_sql("select * from  data_take_list_more where year_budget=? and for_month='10' and id_category=?  ", ["$choose_year", "$id_cate"]); $qr_10=ams_query($link,$sql_10) or die ("เลือกข้อมูลไม่ได้");$num_10=mysqli_num_rows($qr_10);
                   	$sql_11 = ams_sql("select * from  data_take_list_more where year_budget=? and for_month='11' and id_category=?  ", ["$choose_year", "$id_cate"]); $qr_11=ams_query($link,$sql_11) or die ("เลือกข้อมูลไม่ได้");$num_11=mysqli_num_rows($qr_11);
                   	$sql_12 = ams_sql("select * from  data_take_list_more where year_budget=? and for_month='12' and id_category=?  ", ["$choose_year", "$id_cate"]); $qr_12=ams_query($link,$sql_12) or die ("เลือกข้อมูลไม่ได้");$num_12=mysqli_num_rows($qr_12);
                   }
                   $var_num=$num_1+$num_2+$num_3+$num_4+$num_5+$num_6+$num_7+$num_8+$num_9+$num_10+$num_11+$num_12;
                   ?>

                   <tr>
                   	<td align="center" style="font-size: 13px;"><?php echo $i; ?>.</td>
                   	<td style="padding-left: 10px;font-size: 13px;"><?php echo $name_category; ?></td>

                   	<!-- period 1 -->
                   	<td align="center" bgcolor="#eef5f6" style="font-size: 13px;"><?php if($num_10!="0") { ?><?php echo number_format( $num_10 ) ; ?><?php } else { echo "-"; } ?></td>
                    <td align="center" bgcolor="#eef5f6" style="font-size: 13px;"><?php if($num_11!="0") { ?><?php echo number_format( $num_11 ) ; ?><?php } else { echo "-"; } ?></td>
                    <td align="center" bgcolor="#eef5f6" style="font-size: 13px;"><?php if($num_12!="0") { ?><?php echo number_format( $num_12 ) ; ?><?php } else { echo "-"; } ?></td>

                   <!-- period 2 -->
                   <td align="center" bgcolor="#eff6ee" style="font-size: 13px;"><?php if($num_1!="0") { ?><?php echo number_format( $num_1 ) ; ?><?php } else { echo "-"; } ?></td>
                   <td align="center" bgcolor="#eff6ee" style="font-size: 13px;"><?php if($num_2!="0") { ?><?php echo number_format( $num_2 ) ; ?><?php } else { echo "-"; } ?></td>
                   <td align="center" bgcolor="#eff6ee" style="font-size: 13px;"><?php if($num_3!="0") { ?><?php echo number_format( $num_3 ) ; ?><?php } else { echo "-"; } ?></td>

                   	<!-- period 3 -->
                    <td align="center" bgcolor="#eef5f6" style="font-size: 13px;"><?php if($num_4!="0") { ?><?php echo number_format( $num_4 ) ; ?><?php } else { echo "-"; } ?></td>
                    <td align="center" bgcolor="#eef5f6" style="font-size: 13px;"><?php if($num_5!="0") { ?><?php echo number_format( $num_5 ) ; ?><?php } else { echo "-"; } ?></td>
                    <td align="center" bgcolor="#eef5f6" style="font-size: 13px;"><?php if($num_6!="0") { ?><?php echo number_format( $num_6 ) ; ?><?php } else { echo "-"; } ?></td>

                   	<!-- period 4 -->
                    <td align="center" bgcolor="#eff6ee" style="font-size: 13px;"><?php if($num_7!="0") { ?><?php echo number_format( $num_7 ) ; ?><?php } else { echo "-"; } ?></td>
                    <td align="center" bgcolor="#eff6ee" style="font-size: 13px;"><?php if($num_8!="0") { ?><?php echo number_format( $num_8 ) ; ?><?php } else { echo "-"; } ?></td>
                    <td align="center" bgcolor="#eff6ee" style="font-size: 13px;"><?php if($num_9!="0") { ?><?php echo number_format( $num_9 ) ; ?><?php } else { echo "-"; } ?></td>

                   		<!-- sum -->
                   		<td align="center" bgcolor="#fcfaf2" style="font-size: 13px;"><?php if($var_num!="0") { ?><?php echo number_format( $var_num ) ; ?><?php } else { echo "-"; }?></td>
                                                             </tr>
                   		<?php
                   		if($num_10!="0") {$v_all_10=$v_all_10+$num_10; }
                   		if($num_11!="0") {$v_all_11=$v_all_11+$num_11; }
                   		if($num_12!="0") {$v_all_12=$v_all_12+$num_12; }
                   		if($num_1!="0") {$v_all_1=$v_all_1+$num_1; }
                   		if($num_2!="0") {$v_all_2=$v_all_2+$num_2; }
                   		if($num_3!="0") {$v_all_3=$v_all_3+$num_3; }
                   		if($num_4!="0") {$v_all_4=$v_all_4+$num_4; }
                   		if($num_5!="0") {$v_all_5=$v_all_5+$num_5; }
                   		if($num_6!="0") {$v_all_6=$v_all_6+$num_6; }
                   		if($num_7!="0") {$v_all_7=$v_all_7+$num_7; }
                   		if($num_8!="0") {$v_all_8=$v_all_8+$num_8; }
                   		if($num_9!="0") {$v_all_9=$v_all_9+$num_9; }
                   		$vall_sum=$v_all_10+$v_all_11+$v_all_12+$v_all_1+$v_all_2+$v_all_3+$v_all_4+$v_all_5+$v_all_6+$v_all_7+$v_all_8+$v_all_9;
                   		?>
                                                             <?php $i++;$i_data++; } ?>
                   																					<tr>
                                                               <td colspan="2" style="color:#FFF;font-size: 13px;vertical-align:middle;" align="center" bgcolor="#7c7b80">รวม</td>
                   																						<td align="center" bgcolor="#fcfaf2" style="font-size: 13px;"><?php if($v_all_10=="" || $v_all_10=="0") { echo "-"; } else { echo number_format( $v_all_10 ); } ?></td>
                   																						<td align="center" bgcolor="#fcfaf2" style="font-size: 13px;"><?php if($v_all_11=="" || $v_all_11=="0") { echo "-"; } else { echo number_format( $v_all_11 ); } ?></td>
                   																						<td align="center" bgcolor="#fcfaf2" style="font-size: 13px;"><?php if($v_all_12=="" || $v_all_12=="0") { echo "-"; } else { echo number_format( $v_all_12 ); } ?></td>
                   																						<td align="center" bgcolor="#fcfaf2" style="font-size: 13px;"><?php if($v_all_1=="" || $v_all_1=="0") { echo "-"; } else { echo number_format( $v_all_1 ); } ?></td>
                   																						<td align="center" bgcolor="#fcfaf2" style="font-size: 13px;"><?php if($v_all_2=="" || $v_all_2=="0") { echo "-"; } else { echo number_format( $v_all_2 ); } ?></td>
                   																						<td align="center" bgcolor="#fcfaf2" style="font-size: 13px;"><?php if($v_all_3=="" || $v_all_3=="0") { echo "-"; } else { echo number_format( $v_all_3 ); } ?></td>
                   																						<td align="center" bgcolor="#fcfaf2" style="font-size: 13px;"><?php if($v_all_4=="" || $v_all_4=="0") { echo "-"; } else { echo number_format( $v_all_4 ); } ?></td>
                   																						<td align="center" bgcolor="#fcfaf2" style="font-size: 13px;"><?php if($v_all_5=="" || $v_all_5=="0") { echo "-"; } else { echo number_format( $v_all_5 ); } ?></td>
                   																						<td align="center" bgcolor="#fcfaf2" style="font-size: 13px;"><?php if($v_all_6=="" || $v_all_6=="0") { echo "-"; } else { echo number_format( $v_all_6 ); } ?></td>
                   																						<td align="center" bgcolor="#fcfaf2" style="font-size: 13px;"><?php if($v_all_7=="" || $v_all_7=="0") { echo "-"; } else { echo number_format( $v_all_7 ); } ?></td>
                   																						<td align="center" bgcolor="#fcfaf2" style="font-size: 13px;"><?php if($v_all_8=="" || $v_all_8=="0") { echo "-"; } else { echo number_format( $v_all_8 ); } ?></td>
                   																						<td align="center" bgcolor="#fcfaf2" style="font-size: 13px;"><?php if($v_all_9=="" || $v_all_9=="0") { echo "-"; } else { echo number_format( $v_all_9 ); } ?></td>
                   																						<td align="center" bgcolor="#fcfaf2" style="font-size: 13px;"><?php if($vall_sum=="" || $vall_sum=="0") { echo "-"; } else { echo number_format( $vall_sum ); } ?></td>

                                                             </tr>
                                                             <?php } else { ?>
                                                             <tr>
                                                               <td align="center" colspan="15"><< ไม่มีข้อมูล >></td>
                                                             </tr>
                                                             <?php } ?>
                </tbody>
              </table>

</body>
</html>
<?php } ?>
