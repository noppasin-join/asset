<?php require_once __DIR__ . '/con_lda.php'; ?>
<?php require_once __DIR__ . '/con_lda.php'; ?>
            <ul class="nav nav-list">
            		
                    <?php $d1=$_GET['d1'] ?? '';  ?>
                    <?php if($d1=="1") {  ?><li class="active open hover"><?php } else { ?><li class="hover"><?php } ?>
						<a href="budget.php?d1=1">
							<i class="menu-icon fa fa-calendar red2"></i>
							<span class="menu-text"> ปีงบประมาณ </span>
						</a>

						<b class="arrow"></b>
					</li>

                    <?php $d2=$_GET['d2'] ?? '';  ?>
                    <?php if($d2=="1") {  ?><li class="active open hover"><?php } else { ?><li class="hover"><?php } ?>
						<a href="category.php?d2=1">
							<i class="menu-icon fa fa-archive purple"></i>
							<span class="menu-text"> หมวดหมู่ </span>
						</a>

						<b class="arrow"></b>
					</li>

                    <?php $d3=$_GET['d3'] ?? '';  ?>
                    <?php if($d3=="1") {  ?><li class="active open hover"><?php } else { ?><li class="hover"><?php } ?>
						<a href="location.php?d3=1">
							<i class="menu-icon fa fa-building-o green"></i>
							<span class="menu-text"> สถานที่ใช้งาน </span>
						</a>

						<b class="arrow"></b>
					</li>

                    <?php $d4=$_GET['d4'] ?? '';  ?>
                    <?php if($d4=="1") {  ?><li class="active open hover"><?php } else { ?><li class="hover"><?php } ?>
						<a href="data_lda.php?d4=1">
							<i class="menu-icon fa fa-database blue"></i>
							<span class="menu-text"> ข้อมูลครุภัณฑ์ </span>
						</a>

						<b class="arrow"></b>
						
					</li>

                    <?php $d5=$_GET['d5'] ?? '';  ?>
                    <?php if($d5=="1") {  ?><li class="active open hover"><?php } else { ?><li class="hover"><?php } ?>
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-file-text-o pink"></i>
							<span class="menu-text"> รายงาน </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="hover">
								<a href="tables.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Simple &amp; Dynamic
								</a>

								<b class="arrow"></b>
							</li>

							<li class="hover">
								<a href="jqgrid.html">
									<i class="menu-icon fa fa-caret-right"></i>
									jqGrid plugin
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>

                    <?php if($level=="1") { ?>
                    <?php $d6=$_GET['d6'] ?? '';  ?>
                    <?php if($d6=="1") {  ?><li class="active open hover"><?php } else { ?><li class="hover"><?php } ?>
						<a href="setting.php?d6=1">
							<i class="menu-icon fa fa-user blue"></i>
							<span class="menu-text"> ตั้งค่าผู้ใช้ระบบ </span>
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