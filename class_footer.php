<?php require_once __DIR__ . '/admin/security.php'; ?>
			<!--
            <div class="footer hidden-900">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
                        ฝ่ายเลขานุการและธุรการ -
							<span class="blue bolder"> ศูนย์บรรณสารและสื่อการศึกษา </span>&nbsp;
							Tel. <span class="blue ">0-5391-6315 , 0-5391-6316</span>
						</span>

					</div>
				</div>
			</div>
            -->
            <div class="footer">
            	<div class="footer-inner">
                	<div class="footer-content">
                                <div class="hidden-xs hidden-sm">
                                  <span class="bigger-110">Secretarial and Administrative Department - <span class="blue bolder"> Library </span> &nbsp;&nbsp;Tel. <span class="blue ">0-5391-6315</span></span>
                                </div>
                                <div class="hidden-md hidden-lg">
                                  <span class="bigger-110">Administrative Department- <span class="blue bolder"> Library </span></span>
                                </div>
                     </div>
                </div>
			</div>

<style>
#public-loading{display:none;position:fixed;inset:0;z-index:99999;background:rgba(255,255,255,.8);align-items:center;justify-content:center}
#public-loading .loading-box{text-align:center;padding:24px 32px;background:#fff;border-radius:8px;box-shadow:0 2px 14px rgba(0,0,0,.18);color:#47759b;font-size:16px}
#public-loading .loading-spinner{display:block;width:34px;height:34px;margin:0 auto 12px;border:4px solid #dceaf3;border-top-color:#47759b;border-radius:50%;animation:public-loading-spin .8s linear infinite}
@keyframes public-loading-spin{to{transform:rotate(360deg)}}
@media(prefers-reduced-motion:reduce){#public-loading .loading-spinner{animation:none}}
</style>
<div id="public-loading" role="status" aria-live="polite" aria-label="กำลังดำเนินการ" aria-hidden="true"><div class="loading-box"><span class="loading-spinner" aria-hidden="true"></span><strong>Loading...</strong><br>กำลังดำเนินการ กรุณารอสักครู่</div></div>
<script>
(function(){
 'use strict';
 var overlay=document.getElementById('public-loading'),pending=0,leaving=false;
 if(!overlay)return;
 function render(){var busy=leaving||pending>0;overlay.style.display=busy?'flex':'none';overlay.setAttribute('aria-hidden',busy?'false':'true');document.body.setAttribute('aria-busy',busy?'true':'false');}
 function start(){pending++;render();}
 function finish(){pending=Math.max(0,pending-1);render();}
 function local(url){try{return new URL(url,location.href).origin===location.origin;}catch(e){return false;}}
 // Navigation also covers the existing dropdowns that call form.submit() directly.
 window.addEventListener('beforeunload',function(){leaving=true;render();});
 window.addEventListener('pageshow',function(){leaving=false;pending=0;render();});
 window.addEventListener('load',function(){leaving=false;render();});
 var open=XMLHttpRequest.prototype.open,send=XMLHttpRequest.prototype.send;
 XMLHttpRequest.prototype.open=function(method,url){this.publicLoadingLocal=local(url);return open.apply(this,arguments);};
 XMLHttpRequest.prototype.send=function(){
  if(!this.publicLoadingLocal)return send.apply(this,arguments);
  var xhr=this,done=false;
  function complete(){if(done)return;done=true;xhr.removeEventListener('loadend',complete);finish();}
  start();xhr.addEventListener('loadend',complete);
  try{return send.apply(this,arguments);}catch(error){complete();throw error;}
 };
 if(window.fetch){
  var fetch=window.fetch;
  window.fetch=function(input){
   if(!local(typeof input==='string'?input:input.url||input))return fetch.apply(this,arguments);
   start();
   try{return fetch.apply(this,arguments).then(function(response){finish();return response;},function(error){finish();throw error;});}
   catch(error){finish();throw error;}
  };
 }
})();
</script>
