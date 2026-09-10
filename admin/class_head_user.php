<?php require_once __DIR__ . '/con_lda.php'; ?>
<div id="navbar" class="navbar navbar-default" style="padding:5px;">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar red"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <div class="hidden-xs hidden-sm">
                  <a class="navbar-brand" href="report_data.php?d61=1" style="font-size:18px;">ศูนย์บรรณสารและสื่อการศึกษา มหาวิทยาลัยแม่ฟ้าหลวง</a>
                </div>
                <div class="hidden-md hidden-lg">
                  <a class="navbar-brand " href="report_data.php?d61=1" style="font-size:18px;">ศูนย์บรรณสารฯ มฟล.</a>
                </div>



              </div>

              <div class="hidden-xs hidden-sm pull-right">
                <a class="navbar-brand" href="form_user.php?u=1" style="font-size:14px;">
                  <i class="menu-icon fa fa-user" style="color:#9ce8b5;"> </i> &nbsp<font style="color:#b1d4f2;"><?php echo $name_member; ?>&nbsp;&nbsp;<?php echo $surname_member; ?></font>
                </a>
              </div>
              <div class="hidden-md hidden-lg pull-right"> </div>

</div>
