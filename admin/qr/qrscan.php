<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="Content-Security-Policy" content="block-all-mixed-content">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Document</title>
	<script src="lib/jsqr/jsQR.js"></script>
	  <style>
		h1 {
		  margin: 10px 0;
		  font-size: 40px;
		}
		.wrap-qrcode-scanner{
			  max-width: 640px;
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
  </head>
<body>


<div class="wrap-qrcode-scanner">
	<h1>QRCode Scanner</h1>
	<div id="loadingMessage">🎥 Unable to access video stream (please make sure you have a webcam enabled)</div>
	<canvas id="canvas" hidden></canvas>
	<div id="output" hidden>
	<div id="outputMessage">No QR code detected.</div>
	<div hidden><b>Data:</b> <span id="outputData"></span></div>
	</div>
	<audio id="beepsound" controls>
	<source src="sound/scanner-beeps-barcode.mp3" type="audio/mpeg">
	Your browser does not support the audio tag.
	</audio>
	<img id="outputqrcode">
	<canvas id="canvas2" ></canvas>
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
</body>
</html>
