<?php require_once __DIR__ . '/security.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>:: Library Asset Management System</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor_login/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts_login/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts_login/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor_login/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor_login/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor_login/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor_login/select2/select2.min.css">
<!--===============================================================================================-->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css_login/util.css">
	<link rel="stylesheet" type="text/css" href="css_login/main.css">
<!--===============================================================================================-->

	<link rel="shortcut icon" href="mfu.ico" type="image/x-icon">
</head>
<?php $err=$_GET['err'] ?? ''; if($err=="1") { ?>
<body>
<?php } else { ?>
<body onLoad="sf()">
<?php } ?>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('images_login/bg.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" onSubmit="return check()" method="post" name="form_login" action="check_login.php">
					<span class="login100-form-logo">
						<img src="images_login/logo.png" width="130">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">Asset Management System</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="u_username2" placeholder="Username" >
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="u_password2" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

                    <?php $err=$_GET['err'] ?? ''; if($err=="1") { ?>
					<div class="txt99">
						*** Not Correct !
					</div>
                    <?php } ?>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

				<div id="login-error" role="alert" style="display:none;text-align:center;color:#b00020;background:#fff;padding:12px"></div>
</form>

				<script>
                function sf() {document.form_login.u_username2.focus();}
                function check()
                {
                    var v1=document.form_login.u_username2.value;
                    var v2=document.form_login.u_password2.value;
                    if (v1.length==0)
                        {
                            alert ("Please Enter Username!");
                            document.form_login.u_username2.focus();
                            return false;
                        }
                        else if (v2.length==0)
                        {
                            alert("Please Enter Password!");
                            document.form_login.u_password2.focus();
                            return false;
                        }
                        else return true;
                }
         </script>


			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="vendor_login/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor_login/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor_login/bootstrap/js/popper.js"></script>
	<script src="vendor_login/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor_login/select2/select2.min.js"></script>
<!--===============================================================================================-->
<!--===============================================================================================-->
	<script src="js_login/main.js"></script>

<style>
#page-loading-overlay{display:none;position:fixed;z-index:99999;inset:0;background:rgba(255,255,255,.78);text-align:center}
#page-loading-overlay .page-loading-box{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);min-width:180px;padding:20px 26px;border-radius:8px;background:#fff;box-shadow:0 2px 14px rgba(0,0,0,.18);color:#47759b;font-size:16px}
#page-loading-overlay .page-loading-spinner{display:block;width:32px;height:32px;margin:0 auto 10px;border:4px solid #dceaf3;border-top-color:#47759b;border-radius:50%;animation:page-loading-spin .8s linear infinite}
@keyframes page-loading-spin{to{transform:rotate(360deg)}}
</style>
<div id="page-loading-overlay" role="status" aria-live="polite" aria-label="กำลังโหลด"><div class="page-loading-box"><span class="page-loading-spinner"></span>กำลังตรวจสอบข้อมูล กรุณารอสักครู่...</div></div>


<script>
(function () {
 var form=document.forms.form_login, overlay=document.getElementById('page-loading-overlay'), error=document.getElementById('login-error');
 var button=form.querySelector('button'), busy=false;
 form.addEventListener('submit',async function(event){
  if(event.defaultPrevented)return;
  event.preventDefault(); if(busy)return;
  busy=true; button.disabled=true; overlay.style.display='block'; error.style.display='none';
  try {
   var response=await fetch(form.action,{method:'POST',body:new FormData(form),credentials:'same-origin',headers:{Accept:'application/json'}});
   if(!response.ok)throw new Error(response.status===401?'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง':response.status===403?'ไม่ผ่านการตรวจสอบสิทธิ์ กรุณาโหลดหน้าใหม่แล้วลองอีกครั้ง':'เกิดข้อผิดพลาด กรุณาลองอีกครั้ง');
   var result=await response.json(); window.location.assign(result.redirect);
  } catch(err) {
   error.textContent=err.message; error.style.display='block'; overlay.style.display='none';button.disabled=false;busy=false;
  }
 });
 window.addEventListener('pageshow',function(){overlay.style.display='none';button.disabled=false;busy=false;});
})();
</script>
</body>
</html>
