<?php require_once __DIR__ . '/admin/security.php'; ?>
<?php
	include ("con_lda.php");
	set_time_limit(0);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
    <title>:: Library Asset Management System</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<link rel="stylesheet" href="admin/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="admin/assets/font-awesome/4.2.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="admin/assets/fonts/fonts.googleapis.com.css" />
		<link rel="stylesheet" href="admin/assets/css/ace2.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<!-- ace settings handler -->
		<script src="admin/assets/js/ace-extra.min.js"></script>
    <link rel="shortcut icon" href="admin/mfu.ico" type="image/x-icon">
		<link rel="stylesheet" href="admin/AdminLTE.min.css" />

		<link rel="stylesheet" href="admin/reg-style.css" />

		<link rel="stylesheet" href="admin/css/datepicker.css" />
		<link rel="stylesheet" href="admin/assets/css/datepicker.min.css" />

    <link rel="stylesheet" href="admin/assets2/plugins/validationengine/css/validationEngine.jquery.css" />
		<script type="text/javaScript">

        //Allow numeric input only
        function checknumber()
        {
          key = event.keyCode;
          if ( key != 46 & ( key < 48 || key > 57 ) )
          {
            event.returnValue = false;
          };
        };
        </script>
				<link rel="stylesheet" href="admin/dist/css/AdminLTE.min.css">
	
<style>
.request-form{--ink:#203d38;--muted:#71817d;--green:#247b61;max-width:1150px;margin:0 auto;padding:30px 28px 48px;color:var(--ink);text-align:left;font-family:inherit}
.main-content .request-form{background:#f5f8f6}
.request-form *{box-sizing:border-box}
.request-intro{display:flex;align-items:center;justify-content:space-between;gap:20px;margin-bottom:26px}
.request-eyebrow{font-size:11px;font-weight:700;letter-spacing:2px;color:var(--green);margin-bottom:9px}
.request-intro h1{font-size:28px;line-height:1.4;font-weight:600;margin:0 0 7px;color:var(--ink)}
.request-intro p,.request-section p{margin:0;color:var(--muted);font-size:13px;line-height:1.7}

.request-card{background:#fff;border:1px solid #e1e9e5;border-radius:14px;margin-bottom:20px;box-shadow:0 3px 16px rgba(29,63,47,.035);overflow:visible}
.request-section{display:flex;align-items:center;gap:14px;padding:21px 25px;border-bottom:1px solid #edf1ee}
.request-step{display:flex;align-items:center;justify-content:center;flex-shrink:0;width:38px;height:38px;border-radius:11px;background:#edf5f0;color:var(--green);font-size:14px;font-weight:700}
.request-section h2{font-size:17px;font-weight:600;line-height:1.5;margin:0 0 2px;color:var(--ink)}
.request-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:20px 24px;padding:25px}
.request-field{min-width:0}.request-field label{display:block;font-size:13px;font-weight:600;margin:0 0 8px;color:#354e46}
.request-form .request-field input,.request-form .request-field select{display:block;width:100%;min-width:0;height:50px;border:1px solid #dce5e0;border-radius:8px!important;background:#fcfdfc;color:#243d34;padding:10px 12px;font-size:18px;line-height:1.5;box-shadow:none;transition:border-color .15s,box-shadow .15s}
.request-form .request-field input::placeholder{color:#9aa6a1;font-size:18px}
.request-form .request-field input:focus,.request-form .request-field select:focus{outline:none;border-color:#369b79;box-shadow:0 0 0 3px rgba(54,155,121,.12);background:#fff}
.request-wide{grid-column:1/-1}.required-mark{color:#b65748}.request-help{font-size:12px;color:var(--muted);margin:8px 0 0}
.equipment-list{padding:6px 25px 12px}.equipment-row{display:grid;grid-template-columns:28px minmax(170px,2fr) minmax(70px,.65fr) minmax(85px,.8fr) minmax(130px,1.3fr);gap:14px;align-items:start;padding:20px 0;border-bottom:1px solid #edf1ee}.equipment-row:last-child{border-bottom:0}
.equipment-number{margin-top:31px;width:26px;height:26px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:#f0f4f2;color:#668175;font-size:12px;font-weight:600}
.request-actions{display:flex;justify-content:space-between;align-items:center;gap:20px;padding:7px 0}
.request-actions p{font-size:12px;line-height:1.8;color:var(--muted);margin:0}
.request-submit{display:inline-flex;gap:10px;align-items:center;justify-content:center;border:0;border-radius:9px;padding:14px 27px;background:var(--green);color:#fff;font-size:15px;font-weight:600;box-shadow:0 4px 10px rgba(36,123,97,.16);cursor:pointer;transition:background .15s}
.request-submit:hover{background:#19634d}.request-submit:focus-visible{outline:3px solid #92cfb8;outline-offset:3px}
@media(max-width:1050px){.equipment-row{grid-template-columns:26px minmax(0,2fr) minmax(0,1fr) minmax(0,1fr)}.equipment-row .equipment-note{grid-column:2/-1}}
@media(max-width:600px){.request-form{padding:22px 14px 30px}.request-intro{display:block}.request-intro h1{font-size:24px}.request-section{padding:18px 16px}.request-grid{grid-template-columns:1fr;padding:19px 16px;gap:17px}.request-wide{grid-column:auto}.equipment-list{padding:0 16px}.equipment-row{grid-template-columns:24px minmax(0,1fr) minmax(0,1fr);gap:13px 10px}.equipment-row .equipment-choice{grid-column:2/-1}.equipment-row .equipment-amount{grid-column:2}.equipment-row .equipment-note{grid-column:2/-1}.equipment-number{margin-top:32px}.request-actions{flex-direction:column;align-items:stretch}.request-submit{width:100%}.request-form .request-field input,.request-form .request-field select{font-size:18px}}
</style>
</head>

	<body class="no-skin" onLoad="sf()">
		<script>
						function sf() {if (document.frmMain && document.frmMain.txt_name) document.frmMain.txt_name.focus();}
		 </script>

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
								<li class="active">Request Form</li>
							</ul><!-- /.breadcrumb -->

						</div>



					<?php // Start BODY ?>




 <form name="frmMain" id="popup-validation" class="request-form" method="post" action="add_data.php" enctype="multipart/form-data">
<div class="request-intro"><div><div class="request-eyebrow">LIBRARY · EQUIPMENT REQUEST</div><h1>Equipment Request Form</h1><p>Enter your details and select the equipment you would like to request.</p></div></div>
<section class="request-card" aria-labelledby="applicant-title"><div class="request-section"><span class="request-step">01</span><div><h2 id="applicant-title">Applicant Details</h2><p>Contact details for coordinating your equipment request.</p></div></div><div class="request-grid">
<div class="request-field"><label for="txt_name">First Name <span class="required-mark">*</span></label><input id="txt_name" name="txt_name" type="text" class="validate[required]" placeholder="Enter your first name" required maxlength="50" autocomplete="given-name"></div><div class="request-field"><label for="txt_surname">Last Name <span class="required-mark">*</span></label><input id="txt_surname" name="txt_surname" type="text" class="validate[required]" placeholder="Enter your last name" required maxlength="50" autocomplete="family-name"></div><div class="request-field request-wide"><label for="txt_department">Department / Organization</label><input id="txt_department" name="txt_department" type="text" class="" placeholder="Enter your department or organization"  maxlength="200" autocomplete="organization"></div><div class="request-field"><label for="txt_tel">Phone Number <span class="required-mark">*</span></label><input id="txt_tel" name="txt_tel" type="text" class="validate[required]" placeholder="Enter your contact number" required maxlength="30" autocomplete="tel" inputmode="tel"></div><div class="request-field"><label for="txt_email">Email</label><input id="txt_email" name="txt_email" type="text" class="" placeholder="example@email.com"  autocomplete="email" inputmode="email"></div></div></section><section class="request-card" aria-labelledby="period-title"><div class="request-section"><span class="request-step">02</span><div><h2 id="period-title">Request Details</h2><p>Describe the purpose and specify the dates you need the equipment.</p></div></div><div class="request-grid"><div class="request-field request-wide"><label for="txt_obj">Purpose <span class="required-mark">*</span></label><input id="txt_obj" name="txt_obj" type="text" class="validate[required]" placeholder="e.g. For an event or meeting" required maxlength="250"></div><div class="request-field"><label for="datepicker"><i class="fa fa-calendar" aria-hidden="true"></i> Start Date <span class="required-mark">*</span></label><input type="text" id="datepicker" name="txt_date_start" class="validate[required]" placeholder="DD/MM/YYYY" autocomplete="off" required><p class="request-help">Select a date from the calendar.</p></div><div class="request-field"><label for="datepicker2"><i class="fa fa-calendar" aria-hidden="true"></i> Return Date <span class="required-mark">*</span></label><input type="text" id="datepicker2" name="txt_date_end" class="validate[required]" placeholder="DD/MM/YYYY" autocomplete="off" required><p class="request-help">Select a date from the calendar.</p></div></div></section><section class="request-card" aria-labelledby="equipment-title"><div class="request-section"><span class="request-step">03</span><div><h2 id="equipment-title">Equipment List</h2><p>Request up to 5 items. Complete at least the first item.</p></div></div><div class="equipment-list">
<?php
$request_equipment = [];
$request_equipment_result = ams_query($link, "SELECT * FROM data_lda WHERE status_borrow='1' GROUP BY lda_list ORDER BY lda_list");
while ($equipment = mysqli_fetch_assoc($request_equipment_result)) $request_equipment[] = $equipment;
for ($item = 1; $item <= 5; $item++):
?>
<div class="equipment-row"><span class="equipment-number"><?php echo $item; ?></span>
<div class="request-field equipment-choice"><label for="equipment-<?php echo $item; ?>">Equipment <?php if ($item === 1): ?><span class="required-mark">*</span><?php endif; ?></label><select id="equipment-<?php echo $item; ?>" name="txt_title<?php echo $item; ?>" <?php if ($item === 1) echo 'class="validate[required]" required'; ?>><option value="">Select equipment</option><?php foreach ($request_equipment as $equipment): ?><option value="<?php echo htmlspecialchars((string)$equipment['id'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($equipment['lda_list'], ENT_QUOTES, 'UTF-8'); ?></option><?php endforeach; ?></select></div>
<div class="request-field equipment-amount"><label for="amount-<?php echo $item; ?>">Quantity <?php if ($item === 1): ?><span class="required-mark">*</span><?php endif; ?></label><input id="amount-<?php echo $item; ?>" name="txt_amount<?php echo $item; ?>" type="text" inputmode="numeric" maxlength="2" placeholder="0" onkeypress="checknumber()" <?php if ($item === 1) echo 'class="validate[required]" required'; ?>></div>
<div class="request-field"><label for="unit-<?php echo $item; ?>">Unit</label><input id="unit-<?php echo $item; ?>" name="txt_unit<?php echo $item; ?>" type="text" maxlength="20" placeholder="e.g. pieces / units"></div>
<div class="request-field equipment-note"><label for="note-<?php echo $item; ?>">Notes</label><input id="note-<?php echo $item; ?>" name="txt_note<?php echo $item; ?>" type="text" placeholder="Additional details (optional)"></div></div>
<?php endfor; ?>
</div></section><div class="request-actions"><p><span class="required-mark">*</span> Required fields<br>Please review your details before submitting.</p><button type="submit" class="request-submit">Submit Request <i class="fa fa-arrow-right" aria-hidden="true"></i></button></div></form>






					 <?php // END BODY ?>

					</div>

				</div><!-- /.main-content -->



				<?php include("class_footer.php"); ?>

				<?php include("class_scroll_up.php"); ?>
			</div><!-- /.main-container -->

			<script src="admin/assets/js/jquery.2.1.1.min.js"></script>
			<script type="text/javascript">
				window.jQuery || document.write("<script src='admin/assets/js/jquery.min.js'>"+"<"+"/script>");
			</script>
			<script type="text/javascript">
				if('ontouchstart' in document.documentElement) document.write("<script src='admin/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
			</script>
			<script src="admin/assets/js/bootstrap.min.js"></script>
			<script src="admin/assets/js/jquery-ui.custom.min.js"></script>
			<script src="admin/assets/js/jquery.ui.touch-punch.min.js"></script>
			<script src="admin/assets/js/ace-elements.min.js"></script>
			<script src="admin/assets/js/ace.min.js"></script>


			<!-- PAGE LEVEL SCRIPTS -->
			<script src="admin/assets2/plugins/validationengine/js/jquery.validationEngine.js"></script>
			<script src="admin/assets2/plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script>
			<script src="admin/assets2/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
			<script src="admin/assets2/js/validationInit.js"></script>
			<script>
			        $(function () { formValidation(); });
			        </script>

			<script src="admin/assets/js/jquery-ui.custom.min.js"></script>
			<script src="admin/assets/js/chosen.jquery.min.js"></script>
			<script src="admin/assets/js/bootstrap-colorpicker.min.js"></script>
			<script src="admin/assets/js/jquery.autosize.min.js"></script>
			<script src="admin/assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
			<script src="admin/assets/js/jquery.maskedinput.min.js"></script>





			<script src="admin/assets/js/jquery-ui.min.js"></script>
			

					<script type="text/javascript">
								jQuery(function($) {

									$( "#datepicker" ).datepicker({
										dateFormat: 'dd/mm/yy',
                                    showOtherMonths: true,
										selectOtherMonths: false,
										//isRTL:true,
									});


									$( "#datepicker2" ).datepicker({
										dateFormat: 'dd/mm/yy',
                                    showOtherMonths: true,
										selectOtherMonths: false,
										//isRTL:true,
									});


								});


							</script>








</body>
</html>
