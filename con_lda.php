<?php require_once __DIR__ . '/admin/security.php'; ?>
<?php
require __DIR__ . '/con_lda.local.php';



$link = mysqli_connect($hostname,$user,$password,$dbname);
ams_query($link,"SET NAMES UTF8");




date_default_timezone_set("Asia/Bangkok");

$day=date("d");
$month=date("m");
$year=date("Y")+543;
$time_log=date("H:i");

$year_eng=date("Y");
?>

<?php if (!in_array($_SERVER['REQUEST_METHOD'] ?? 'GET', ['GET','HEAD'], true)) ams_require_csrf(); ?>