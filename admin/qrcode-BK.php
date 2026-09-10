<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	if (session_status() !== PHP_SESSION_ACTIVE) session_start();
	$sess_user = $_SESSION['sess_user'] ?? '';
	$sess_password = $_SESSION['sess_password'] ?? '';

	require_once __DIR__ . '/con_lda.php';
	if ($sess_user == "" || $status!=0) {
    ams_deny(403, 'Insufficient permissions.');
	} else {
	set_time_limit(0);



?>
<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="Content-Security-Policy" content="block-all-mixed-content">
	<script src="qr/lib/jsqr/jsQR.js"></script>
	  <style>
		h1 {
		  margin: 10px 0;
		  font-size: 40px;
		}
		.wrap-qrcode-scanner{
			  max-width: 440px;
			  margin: 0 auto;
			  position: relative;
		}
		#loadingMessage {
		  text-align: center;
		  padding: 40px;
		  background-color: #eee;
		}
		#canvas {
		  width: 100%;
		}
		#output {
		  margin-top: 20px;
		  background: #eee;
		  padding: 10px;
		  padding-bottom: 0;
		}
		#output div {
		  padding-bottom: 10px;
		  word-wrap: break-word;
		}
		#beepsound{width: 0px;height: 1px;}
	  </style>



    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>:: ระบบฐานข้อมูลครุภัณฑ์ ศูนย์บรรณสารฯ</title>
				<link rel="shortcut icon" href="mfu.ico" type="image/x-icon">


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






				<!-- Add mousewheel plugin (this is optional) -->
				<link rel="stylesheet" href="AdminLTE.min.css">

        <style>
        body {
            font-family: sarabun;
        }
        </style>


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
          <li class="active">ตรวจนับครุภัณฑ์</li>
        </ul><!-- /.breadcrumb -->
      </div>

<div class="page-content">




  <div class="row">
    <form name="form_choose" method="post" action="update_check_qrcode2.php">
      <div class="col-sm-12 col-xs-12">

        <div class="wrap-qrcode-scanner">
        	<h1>QRCode Scanner</h1>
        	<div id="loadingMessage">🎥 Unable to access video stream (please make sure you have a webcam enabled)</div>
        	<canvas id="canvas" ></canvas>
        	<div id="output" hidden>
        	<div id="outputMessage"></div>
        	<div hidden><b>เลขครุภัณฑ์:</b>
            <span id="outputData"></span>
          </div>
        	</div>
        	<audio id="beepsound" controls>
        	<source src="qr/sound/scanner-beeps-barcode.mp3" type="audio/mpeg">
        	Your browser does not support the audio tag.
        	</audio>
        	<img id="outputqrcode">
        	<canvas id="canvas2" ></canvas>
        </div>

                      <div >
                        <table class="table9 table-striped table-bordered table-hover">
                          <thead>

                            <tr>
                              <th class="center font_brown70 hidden-1000"> ลำดับ. </th>
                              <th class="center font_brown70">เลขครุภัณฑ์</th>
                              <th class="center font_brown70">รายการ</th>
                              <th class="center font_brown70 hidden-1000">ยี่ห้อ</th>
                              <th class="center font_brown70 hidden-1000">สถานที่ใช้งาน</th>
                              <th class="center font_brown70 hidden-1000">ผู้ใช้งาน</th>
                              <th class="center font_brown70 hidden-1000">สถานะ</th>
                              <th class="center font_brown70">สถานะ</th>
                              <th class="center font_brown70">สถานที่ใช้งาน</th>
                              <th class="center font_brown70">ผู้ใช้งาน</th>
                              <th class="center font_brown70">หมายเหตุ</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $q=ams_sql("SELECT * FROM data_staff_choose where id=?", ["$id"]);
                            $qr=ams_query($link,$q);

                            while($rs=mysqli_fetch_array($qr)) {

                                          $sql_data = "select * from  data_lda where barcode1='outputData' ";
                                          //$qr_data=ams_query($link,$sql_data) or die ("เลือกข้อมูลไม่ได้");
                                          $total_list=mysqli_num_rows($qr_data);
                                          $rs_data=mysqli_fetch_array($qr_data);
                                          $data_lda=$rs_data['id'];
                                          $barcode2=$rs_data['barcode2'];
                              ?>
                              <?php if($total_list!=0) { ?>
                            <tr>
                              <td class="center font_brown hidden-1000" style="vertical-align:middle;">1.</td>
                              <td class="center font_brown" style="vertical-align:middle;"><?php echo $barcode2; ?></td>
                              <td class="font_brown" style="vertical-align:middle;">
                                <a  href="detail_data.php?id=<?php echo $data_det; ?>" class="fancybox fancybox.ajax"><?php echo $lda_list; ?></a>
                              </td>
                              <td class="font_brown hidden-1000" style="vertical-align:middle;"><?php echo $lda_brand; ?></td>
                              <td class="center font_brown hidden-1000" style="vertical-align:middle;">
                                <?php
                                $sql_locate = ams_sql("select * from  data_location where id=? ", ["$id_location"]);
                                $qr_locate=ams_query($link,$sql_locate) or die ("เลือกข้อมูลไม่ได้");
                                $rs_locate=mysqli_fetch_array($qr_locate);
                                $name_locate=$rs_locate['name_location'];
                                 ?>
                                <?php echo $name_locate; ?>
                              </td>
                              <td class="center font_brown hidden-1000" style="vertical-align:middle;"><?php echo $name_use; ?></td>
                              <?php if ($lda_status=="1") { ?>
                                  <td class="center hidden-1000" bgcolor="#49ac8b" style="vertical-align:middle;"><font color="#FFFFFF">ใช้งานปกติ</font> </td><?php } elseif($lda_status=="2") { ?>
                                  <td class="center hidden-1000" bgcolor="#d15b47" style="vertical-align:middle;"><font color="#FFFFFF">ชำรุด</font></td><?php } elseif($lda_status=="7") { ?>
                                  <td class="center hidden-1000" bgcolor="#d15b47" style="vertical-align:middle;"><font color="#FFFFFF">สภาพปกติ ไม่จำเป็นต้องใช้งาน</font></td>
                              <?php } ?>
                              </td>

                              <!-- Start form -->



                              <td class="font_brown center" style="vertical-align:middle;">

                                <select name="choose_status" style="background-color:#f4f9fc;font-size:13px;" class="form-control">
                                    <?php if($lda_status=="1") { ?><option value="1" selected>ใช้งานปกติ</option><?php } else { ?><option value="1">ใช้งานปกติ</option><?php } ?>
                                    <?php if($lda_status=="2") { ?><option value="2" selected>ชำรุด</option><?php } else { ?><option value="2">ชำรุด</option><?php } ?>
                                    <?php if($lda_status=="7") { ?><option value="6" selected>สภาพปกติ ไม่จำเป็นต้องใช้งาน</option><?php } else { ?><option value="7">สภาพปกติ ไม่จำเป็นต้องใช้งาน</option><?php } ?>
                                </select>

                              </td>
                              <td class="font_brown center" style="vertical-align:middle;">

                                <select class="form-control" name="choose_locate" style="background-color:#f4f9fc;font-size:13px;">
                                  <?php
                                  $sql_locate_select = ams_sql("select * from  data_location where id=?", ["$id_location"]);
                                  $qr_locate_select=ams_query($link,$sql_locate_select) or die ("เลือกข้อมูลไม่ได้");
                                            $rs_locate_select=mysqli_fetch_array($qr_locate_select);
                                            $id_locate_select=$rs_locate_select['id'];
                                            $name_location_select=$rs_locate_select['name_location'];
                                  ?>

                                  <option value="<?php echo $id_locate_select;?>" selected><?php echo $name_location_select;?></option>
                                  <option value="">------------</option>
                                  <?php
                                  $sql_locate = "select * from  data_location order by name_location ";
                                  $qr_locate=ams_query($link,$sql_locate) or die ("เลือกข้อมูลไม่ได้");
                                  ams_query($link, "SET NAMES UTF8");
                                  $num_locate=mysqli_num_rows($qr_locate);
                                  $i_lc=0;
                                        while($i_lc<$num_locate) {
                                            $rs_locate=mysqli_fetch_array($qr_locate);
                                            $id_locate=$rs_locate['id'];
                                            $name_location=$rs_locate['name_location'];
                                  ?>
                                  <option value="<?php echo $id_locate; ?>"><?php echo $name_location; ?></option>
                                  <?php $i_lc++; } ?>
                                </select>

                              </td>
                              <td class="font_brown" style="vertical-align:middle;">

                                <input type="text" class="form-control validate[required]" style="font-size:13px;background-color:#f4f9fc;" value="<?php echo $name_use; ?>" name="txt_name" maxlength="100">

                              </td>
                              <td class="font_brown" style="vertical-align:middle;">

                                <input type="text" class="form-control" style="font-size:13px;background-color:#f4f9fc;" value="<?php echo $note; ?>" name="txt_note" maxlength="250"></td>



                                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                                  <input type="hidden" name="data_lda" value="<?php echo $data_lda; ?>">
                                  <input type="hidden" name="choose_locate_main" value="<?php echo $choose_locate_main; ?>">
                                  <input type="hidden" name="choose_status_main" value="<?php echo $choose_status_main; ?>">





                              <!-- End form -->
                            </tr>
                          <?php } ?>

                            <?php } ?>

                          </tbody>
                        </table>


                      </div>

                      <div class="row">
                        <div class="col-xs-12">
                          <button type="submit" class="btn btn-primary" OnClick="fncAction1()">บันทึกข้อมูล</button>
                        </div>
                      </div>

                    </div>


</form>

                    </div>


  <script>
    var video = document.createElement("video");
    var canvasElement = document.getElementById("canvas");
    var canvas = canvasElement.getContext("2d");
    var loadingMessage = document.getElementById("loadingMessage");
    var outputContainer = document.getElementById("output");
    var outputMessage = document.getElementById("outputMessage");
    var outputData = document.getElementById("outputData");
	var beepsound = document.getElementById("beepsound");
	var outputQrcode = document.getElementById('outputqrcode');
	var TLR,TRR,BRL,BLL;
	var code;
	var waiting;

    function drawLine(begin, end, color) {
      canvas.beginPath();
      canvas.moveTo(begin.x, begin.y);
      canvas.lineTo(end.x, end.y);
      canvas.lineWidth = 4;
      canvas.strokeStyle = color;
      canvas.stroke();
	  return true;
    }

    // Use facingMode: environment to attemt to get the front camera on phones
    navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } }).then(function(stream) {
      video.srcObject = stream;
      video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
      video.play();
      requestAnimationFrame(tick);
    });

    function tick() {
      loadingMessage.innerText = "⌛ Loading video..."
      if (video.readyState === video.HAVE_ENOUGH_DATA) {
        loadingMessage.hidden = true;
        canvasElement.hidden = false;
        outputContainer.hidden = false;

        canvasElement.height = video.videoHeight;
        canvasElement.width = video.videoWidth;
		canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
		if(!video.paused){
			var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
			 code = jsQR(imageData.data, imageData.width, imageData.height, {
			  inversionAttempts: "dontInvert",
			});
		}
        if (code) {
          TLR = drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
          TRR = drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
          BRL = drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
          BLL = drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");
          outputMessage.hidden = true;
          outputData.parentElement.hidden = false;
          outputData.innerText = code.data;
		  if(code.data!="" && !waiting && TLR==true && TRR==true && BRL==true && BLL==true ){
		  	console.log(code.data);
			// สามารถส่งค่า code.data ไปทำงานอย่างอื่นๆ ผ่าน ajax ได้
		  	video.pause();
			beepsound.play();
			beepsound.onended = function() {
				beepsound.muted = true;
			};
			// ให้เริ่มเล่นวิดีโอก่อนล็กน้อย เพื่อล้างค่ารูป qrcod ล่าสุด เป็นการใช้รูปจากกล้องแทน
			setTimeout(function(){
				video.play();
			},4500);
			// ให้รอ 5 วินาทีสำหรับการ สแกนในครั้งจ่อไป
			 waiting = setTimeout(function(){
			 	TLR,TRR,BRL,BLL = null;
				beepsound.muted = false;
				if(waiting){
					clearTimeout(waiting);
					waiting = null;
				}
      },5000);
		  }
        } else {
          outputMessage.hidden = false;
          outputData.parentElement.hidden = true;
        }
      }
      requestAnimationFrame(tick);
    }
  </script>


      </div>


      <script type="text/javascript">
        if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
      </script>
      <script src="assets/js/bootstrap.min.js"></script>
      <script src="assets/js/ace-elements.min.js"></script>
      <script src="assets/js/ace.min.js"></script>

    </div>
  </div>
</div>
</body>
</html>
<?php } ?>
