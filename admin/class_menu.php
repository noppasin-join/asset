<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php require_once __DIR__ . '/con_lda.php'; ?>
<div class="lter" style="padding:2px;background-color:#89cc97;">  </div>
            <ul class="nav nav-list">

          <?php if($level==1 || $level==2) { ?>
           <?php $d1=$_GET['d1'] ?? '';  ?>
           <?php if($d1=="1") {  ?><li class="active open hover"><?php } else { ?><li class="hover"><?php } ?>
						<a href="budget.php?d1=1">
							<i class="menu-icon fa fa-calendar" style="color:#8b230a"></i>
							<span class="menu-text"> ปีงบประมาณ </span>
						</a>

						<b class="arrow"></b>
					</li>


          <?php $d2=$_GET['d2'] ?? '';  ?>
          <?php if($d2=="1") {  ?><li class="active open hover"><?php } else { ?><li class="hover"><?php } ?>
						<a href="category.php?d2=1">
							<i class="menu-icon fa fa-archive" style="color:#0a7a8b;"></i>
							<span class="menu-text"> หมวดหมู่ </span>
						</a>

						<b class="arrow"></b>
					</li>


            <?php $d3=$_GET['d3'] ?? '';  ?>
            <?php if($d3=="1") {  ?><li class="active open hover"><?php } else { ?><li class="hover"><?php } ?>
						<a href="location.php?d3=1">
							<i class="menu-icon fa fa-building-o" style="color:#710a8b;"></i>
							<span class="menu-text"> สถานที่ใช้งาน </span>
						</a>

						<b class="arrow"></b>
					</li>

<?php } ?>

            <?php $d4=$_GET['d4'] ?? '';  ?>
            <?php $d41=$_POST['d41'] ?? '';  ?>
            <?php if($d4=="1" || $d41=="1") {  ?><li class="active open hover"><?php } else { ?><li class="hover"><?php } ?>
						<a href="data.php?d4=1">
							<i class="menu-icon fa fa-database blue"></i>
							<span class="menu-text"> ข้อมูลครุภัณฑ์ </span>
						</a>

						<b class="arrow"></b>

					</li>






          <?php if($level!="0") { ?>
            <?php $c1=$_GET['c1'] ?? ''; ?>
            <?php $c11=$_POST['c11'] ?? ''; ?>
            <?php if($c1=="1" || $c11==1) {  ?><li class="active open hover"><?php } else { ?><li class="hover"><?php } ?>
						<a href="data_compare.php?c1=1">
							<i class="menu-icon fa fa-leaf" style="color:#0a7a8b;"></i>
							<span class="menu-text"> เทียบรายการครุภัณฑ์ </span>
						</a>

						<b class="arrow"></b>

					</li>

          <?php } ?>



      <?php if($level!=0) { ?>
        <?php $j=$_GET['j'] ?? ''; ?><?php $j1=$_POST['j1'] ?? ''; ?>
        <?php $j2=$_GET['j2'] ?? ''; ?><?php $j21=$_POST['j21'] ?? ''; ?>

          <?php if ($j=="1" || $j1=="1" || $j2=="1" || $j21=="1") { ?>
					<li class="active open">
                    <?php } else { ?>
                    <li>
                    <?php }?>
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-folder-open green"></i>
							<span class="menu-text"> ยืมคืนวัสดุ/ครุภัณฑ์ </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
              <?php
                $sql_f = "select * from  data_take where status_read='0'  ";
                $dbquery_f=ams_query($link,$sql_f) or die ("เลือกข้อมูลไม่ได้");
                $num_rows_f=mysqli_num_rows($dbquery_f);
              ?>
							<?php if ($j=="1" || $j1=="1") { ?><li class="active"><?php } else { ?><li><?php } ?>
								<a href="data_borrow.php?j=1"><i class="menu-icon fa fa-caret-right"></i> ยืมวัสดุ/ครุภัณฑ์
                  <?php if ($num_rows_f > 0) { ?><span class="badge badge-primary"><?php echo $num_rows_f; ?></span><?php } ?></a> <b class="arrow"></b>
							</li>

              <?php if ($j2=="1" || $j21=="1") { ?><li class="active"><?php } else { ?><li><?php } ?>
								<a href="data_return.php?j2=1"><i class="menu-icon fa fa-caret-right"></i> คืนวัสดุ/ครุภัณฑ์</a> <b class="arrow"></b>
							</li>




						</ul>
					</li>
      <?php } ?>







      <?php $d61=$_GET['d61'] ?? '';  ?><?php $d611=$_POST['d611'] ?? '';  ?>
      <?php $dm1=$_GET['dm1'] ?? '';  ?><?php $dm11=$_POST['dm11'] ?? '';  ?>
          <?php $d62=$_GET['d62'] ?? '';  ?><?php $d621=$_POST['d621'] ?? '';  ?>
          <?php $d63=$_GET['d63'] ?? '';  ?><?php $d631=$_POST['d631'] ?? '';  ?>
          <?php $j3=$_GET['j3'] ?? ''; ?><?php $j31=$_POST['j31'] ?? ''; ?>

            <?php if ($d61=="1" || $dm1=="1" || $dm11=="1" || $d62=="1" || $d611=="1" || $d621=="1" || $d63=="1" || $d631=="1" || $j3=="1" || $j31=="1") { ?>
            <li class="active open">
                      <?php } else { ?>
                      <li>
                      <?php }?>
              <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-file-text-o" style="color:#0a898b;"></i>
                <span class="menu-text"> รายงาน </span>

                <b class="arrow fa fa-angle-down"></b>
              </a>

              <b class="arrow"></b>

              <ul class="submenu">
                <?php if ($d61==1 || $d611==1) { ?><li class="active"><?php } else { ?><li><?php } ?>
                  <a href="report_data.php?d61=1"><i class="menu-icon fa fa-caret-right"></i> รายงานข้อมูลครุภัณฑ์ </a> <b class="arrow"></b>
                </li>

                <?php if ($dm1==1 || $dm11==1) { ?><li class="active"><?php } else { ?><li><?php } ?>
                  <a href="report_data_group.php?dm1=1"><i class="menu-icon fa fa-caret-right"></i> รายงานข้อมูลครุภัณฑ์(ชุด) </a> <b class="arrow"></b>
                </li>

                <?php if ($d62==1 || $d621==1) { ?><li class="active"><?php } else { ?><li><?php } ?>
                  <a href="report_check.php?d62=1"><i class="menu-icon fa fa-caret-right"></i> รายงานตรวจนับครุภัณฑ์ </a> <b class="arrow"></b>
                </li>

                <?php if ($d63==1 || $d631==1) { ?><li class="active"><?php } else { ?><li><?php } ?>
                  <a href="report_repair.php?d63=1"><i class="menu-icon fa fa-caret-right"></i> รายงานข้อมูลการส่งซ่อม </a> <b class="arrow"></b>
                </li>

                <?php if ($j3=="1" || $j31=="1") { ?><li class="active"><?php } else { ?><li><?php } ?>
  								<a href="report_borrow.php?j3=1"><i class="menu-icon fa fa-caret-right"></i> รายงานยืมวัสดุ/ครุภัณฑ์</a> <b class="arrow"></b>
  							</li>

              </ul>
            </li>





          <?php if($level=="2" || $level=="1") { ?>
                    <?php $d7=$_GET['d7'] ?? '';  ?>
                    <?php if($d7=="1") {  ?><li class="active open hover"><?php } else { ?><li class="hover"><?php } ?>
        						<a href="setting.php?d7=1">
        							<i class="menu-icon fa fa-user blue"></i>
        							<span class="menu-text"> ตั้งค่าผู้ใช้ระบบ </span>
        						</a>
        						<b class="arrow"></b>
        				  	</li>
          <?php } ?>
          <?php if($level=="1" || $level==2) { ?>
                    <?php $d9=$_GET['d9'] ?? '';  ?>
                    <?php if($d9=="1") {  ?><li class="active open hover"><?php } else { ?><li class="hover"><?php } ?>
        						<a href="setting_amount.php?d9=1">
        							<i class="menu-icon fa fa-cogs blue"></i>
        							<span class="menu-text"> ตั้งค่าปีตรวจนับ</span>
        						</a>
        						<b class="arrow"></b>
        				  	</li>

                    <?php $s1=$_GET['s1'] ?? '';  ?>
                    <?php if($s1=="1") {  ?><li class="active open hover"><?php } else { ?><li class="hover"><?php } ?>
        						<a href="form_setting.php?s1=1">
        							<i class="menu-icon fa fa-bars green"></i>
        							<span class="menu-text"> ตั้งค่ารายการตรวจนับ </span>
        						</a>
        						<b class="arrow"></b>
        				  	</li>
          <?php } ?>

          <?php /* ?>
          <?php if($num_menu_check=="1") { ?>
            <?php $d5=$_GET[d5]; ?>
            <?php $d51=$_POST[d51]; ?>
            <?php if($d5=="1" || $d51==1) {  ?><li class="active open hover"><?php } else { ?><li class="hover"><?php } ?>
						<a href="data_check.php?d5=1">
							<i class="menu-icon fa fa-gavel red2"></i>
							<span class="menu-text"> ตรวจนับครุภัณฑ์ </span>
						</a>

						<b class="arrow"></b>

					</li>

          <?php } ?>
          <?php */ ?>

          <?php if($num_menu_check=="1") { ?>
            <?php $q1=$_GET['q1'] ?? ''; ?>
            <?php $q11=$_POST['q11'] ?? ''; ?>
            <?php if($q1=="1" || $q11==1) {  ?><li class="active open hover"><?php } else { ?><li class="hover"><?php } ?>
						<a href="data_check_qrcode.php?q1=1">
							<i class="menu-icon fa fa-qrcode blue"></i>
							<span class="menu-text"> ตรวจนับแบบ QR Code </span>
						</a>

						<b class="arrow"></b>

					</li>

          <?php } ?>

          <?php $GL=$_GET['GL'] ?? ''; ?><?php $GLR=$_POST['GLR'] ?? ''; ?>
          <?php if($GL=="1" || $GLR=="1") {  ?><li class="active open hover"><?php } else { ?><li class="hover"><?php } ?>
          <a href="gallery.php?GL=1">
            <i class="menu-icon fa fa-picture-o" style="color:#0a7a8b;"></i>
            <span class="menu-text"> Gallery </span>
          </a>

          <b class="arrow"></b>

          </li>

          <?php if($level=="1" || $level==2) { ?>
          <?php $doc=$_GET['doc'] ?? ''; ?>
          <?php if($doc=="1") {  ?><li class="active open hover"><?php } else { ?><li class="hover"><?php } ?>
          <a href="document.php?doc=1">
            <i class="menu-icon fa fa-file" style="color:#0a7a8b;"></i>
            <span class="menu-text"> คู่มือการใช้งานระบบ </span>
          </a>

          <b class="arrow"></b>

          </li>

         <?php } ?>




         <?php if($level=="0" && $status=="0") { ?>
         <?php $doc_user=$_GET['doc_user'] ?? ''; ?>
         <?php if($doc_user=="1") {  ?><li class="active open hover"><?php } else { ?><li class="hover"><?php } ?>
         <a href="document_user.php?doc_user=1">
           <i class="menu-icon fa fa-file" style="color:#0a7a8b;"></i>
           <span class="menu-text"> คู่มือการใช้งานระบบ </span>
         </a>

         <b class="arrow"></b>

         </li>

        <?php } ?>



					<li class="hover">
						<a href="logout.php">
							<i class="menu-icon fa fa-power-off red"></i>
							<span class="menu-text"> ออกจากระบบ </span>
						</a>

						<b class="arrow"></b>
					</li>


				</ul>

                <br/>

       <div class="hidden-xs hidden-sm">
        <center><img src="logo.png" width="30%"></center>
       </div>
       <div class="hidden-md hidden-lg">
        <center><img src="logo.png" width="20%"></center>
       </div>
                <br/>
