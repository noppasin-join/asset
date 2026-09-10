<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php
	$v_success = '';
$var_qr = '';
$v_check = '';
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
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	<meta http-equiv="Content-Security-Policy" content="block-all-mixed-content">
	<script src="qr/lib/jsqr/jsQR.js"></script>
	  <style>
		h1 {
		  margin: 10px 0;
		  font-size: 40px;
		}
		.wrap-qrcode-scanner{
			  max-width: 540px;
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

				<script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>
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



			<?php $v_success=$_GET['v_success'] ?? '';?>
			<?php $var_qr=$_GET['var_qr'] ?? '';?>


		<?php if($v_success=="1") { ?>
			<div class="row">
			<div class="col-xs-12">
		<div class="alert alert-block alert-success" id="success-alert">
		<button type="button" class="close" data-dismiss="alert">
		<i class="ace-icon fa fa-times"></i>
		</button>

		<i class="ace-icon fa fa-check green"></i> &nbsp;
		<strong>ตรวจนับครุภัณฑ์ เรียบร้อย!</strong>
		</div>
		</div>
		</div>
	<?php } ?>

<?php $v_check=$_GET['v_check'] ?? '';?>
	<?php if($v_check=="1") { ?>
<div class="alert alert-block alert-danger" id="success-alert">
<button type="button" class="close" data-dismiss="alert">
<i class="ace-icon fa fa-times"></i>
</button>

<i class="ace-icon fa fa-bullhorn dark"></i>

<b class="dark"><u>พบข้อผิดพลาด</u></b>  &nbsp;&nbsp;ข้อมูลครุภัณฑ์ ไม่อยู่ในสถานะตรวจนับ!
</div>
<?php } ?>




<form method="post" action="qrcode_status.php" name="form_qrcode" onSubmit="return check2()">
	<div class="wrap-qrcode-scanner">
		<h1>QR Code Scanner</h1>
		<div id="loadingMessage">🎥 Unable to access video stream (please make sure you have a webcam enabled)</div>
		<canvas id="canvas" ></canvas>
		<div id="output" hidden>
		<div id="outputMessage"></div>
		<div >
			<table border="0" width="100%">
				<tr>
					<td width="12%">
							<font style="padding-top: 15px!important;font-size: 14px;"><b>เลขครุภัณฑ์ : &nbsp;</b></font>
					</td>
					<td width="25%">
							<textarea id="outputData" rows="1" style="padding-top: 10px;border: none;background: #eee;" name="qrcode2"></textarea>
					</td>
					<td width="25%"> &nbsp;
							<button type="submit" class="btn bg-sky33"><i class="ace-icon fa fa-stack-overflow"></i> ตรวจสอบ</button>
					</td>
			</table>
		</div>
		</div>
		<audio id="beepsound" controls>
		<source src="qr/sound/scanner-beeps-barcode.mp3" type="audio/mpeg">
		Your browser does not support the audio tag.
		</audio>

	</div>
	<?php if($var_qr!="1") { ?>
		<input type="hidden" name="q11" value="1">
	<?php } elseif($var_qr=="1") { ?>
		<input type="hidden" name="d41" value="1">
		<input type="hidden" name="d4" value="1">
		<input type="hidden" name="var_qr" value="1">
	<?php } ?>

</form>

<script>
function check2()
{
	var v1=document.form_qrcode.qrcode2.value;
	if (v1.length==0)
		{
			alert ("Please Scan QRCode!");
			document.form_qrcode.qrcode2.focus();
			return false;
		}
		else true;
}
</script>

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
        }
      }
      requestAnimationFrame(tick);
    }



  </script>


      </div>
			<div class="center">

			<?php if($var_qr!="1") { ?>
			<form class="form-horizontal" role="form" method="post" name="form_return" action="data_check_qrcode.php">
				<input type="hidden" name="q11" value="1">
			<input type="submit" value="<-- ย้อนกลับ"  class="btn bg-olive" id="gritter-without-image" />
			</form>
		  <?php } ?>

			<?php if($var_qr=="1") { ?>
			<form class="form-horizontal" role="form" method="post" name="form_return" action="data_check_qrcode.php">
				<input type="hidden" name="d41" value="1">
				<input type="hidden" name="d4" value="1">
				<input type="hidden" name="var_qr" value="1">
			<input type="submit" value="<-- ย้อนกลับ"  class="btn bg-olive" id="gritter-without-image" />
			</form>
		  <?php } ?>

		</div>

      <script type="text/javascript">
        if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
      </script>

			<script src="assets/js/bootstrap.min.js"></script>
			<script src="assets/js/jquery-ui.custom.min.js"></script>
			<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
			<script src="assets/js/ace-elements.min.js"></script>
			<script src="assets/js/ace.min.js"></script>


					<script src="assets2/plugins/validationengine/js/jquery.validationEngine.js"></script>
			        <script src="assets2/plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script>
			        <script src="assets2/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
			        <script src="assets2/js/validationInit.js"></script>
			        <script>
			        $(function () { formValidation(); });
			        </script>

			        <script language="JavaScript">
							window.setTimeout(function() {
							$(".alert").fadeTo(500, 0).slideUp(500, function(){
								$(this).remove();
							});
						  }, 4000);
					   </script>
						 <script src="assets/js/jquery.2.1.1.min.js"></script>
    </div>
  </div>
</div>
</body>
</html>
<?php } ?>
