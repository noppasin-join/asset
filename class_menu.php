<?php require_once __DIR__ . '/admin/security.php'; ?>
<?php include("con_lda.php"); ?>
<div class="lter" style="padding:2px;background-color:#89cc97;">  </div>
            <ul class="nav nav-list">


              <?php $LB=$_GET['LB'] ?? ''; ?><?php $LBM=$_POST['LBM'] ?? ''; ?><?php $GL=$_GET['GL'] ?? ''; ?><?php $GLR=$_POST['GLR'] ?? ''; ?><?php $doc=$_GET['doc'] ?? ''; ?>
              <?php if($LB=="" && $LBM=="" && $GL=="" && $GLR=="" && $doc=="") {  ?><li class="active open hover"><?php } else { ?><li class="hover"><?php } ?>
              <a href="index.php">
              <i class="menu-icon fa fa-file-text" style="color:#0a7a8b;"></i>
              <span class="menu-text"> Request</span>
              </a>

              <b class="arrow"></b>

              </li>

              <?php if($LB=="1" || $LBM=="1") {  ?><li class="active open hover"><?php } else { ?><li class="hover"><?php } ?>
  						<a href="data.php?LB=1">
  							<i class="menu-icon fa fa-database blue"></i>
  							<span class="menu-text"> Information </span>
  						</a>

  						<b class="arrow"></b>

    					</li>


              <?php if($GL=="1" || $GLR=="1") {  ?><li class="active open hover"><?php } else { ?><li class="hover"><?php } ?>
  						<a href="gallery.php?GL=1">
  							<i class="menu-icon fa fa-picture-o green"></i>
  							<span class="menu-text"> Gallery </span>
  						</a>

  						<b class="arrow"></b>

    					</li>




				</ul>

                <br/>

       <div class="hidden-xs hidden-sm">
        <center><img src="admin/logo.png" width="30%"></center>
       </div>
       <div class="hidden-md hidden-lg">
        <center><img src="admin/logo.png" width="20%"></center>
       </div>
                <br/>
