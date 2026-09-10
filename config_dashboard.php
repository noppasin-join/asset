<?php require_once __DIR__ . '/admin/security.php'; ?>
<?php
require __DIR__ . '/config_dashboard.local.php';



$link = mysqli_connect($hostname,$user,$password,$dbname);
ams_query($link,"SET NAMES UTF8");
?>
