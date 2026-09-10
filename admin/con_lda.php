<?php
require_once __DIR__ . '/security.php';
ams_require_session();
if (!in_array($_SERVER['REQUEST_METHOD'] ?? 'GET', ['GET', 'HEAD'], true)) ams_require_csrf();
if (in_array(basename($_SERVER['SCRIPT_FILENAME'] ?? ''), ams_action_routes(), true)) {
    ams_require_post();
    // These legacy handlers read action parameters from GET. Their callers now send POST.
    $_GET = array_merge($_GET, $_POST);
}
require __DIR__ . '/con_lda.local.php';



$link = mysqli_connect($hostname,$user,$password,$dbname);

mysqli_set_charset($link, 'utf8');
$sess_user = $_SESSION['sess_user'];
$sess_password = $_SESSION['sess_password'];
$dbquery = ams_query($link, ams_sql('SELECT * FROM member WHERE username = ? AND password = ? LIMIT 1', [$sess_user, $sess_password]));
$result_chk = mysqli_fetch_assoc($dbquery);
if (!$result_chk) ams_deny(401, 'Invalid session. Please log in again.');
if ((string)$result_chk['status'] !== '0') ams_deny(403, 'This account is disabled.');
$id_member = $result_chk['id'];
$username = $result_chk['username'];
$password = $result_chk['password'];
$name_member = $result_chk['name'];
$surname_member = $result_chk['surname'];
$level = $result_chk['level'];
$status = $result_chk['status'];
if ((string)$level === '0' && in_array(basename($_SERVER['SCRIPT_FILENAME'] ?? ''), ams_action_routes(), true)
    && !in_array(basename($_SERVER['SCRIPT_FILENAME'] ?? ''), ['update_user.php', 'logout.php'], true)) {
    ams_deny(403, 'Insufficient permissions.');
}
date_default_timezone_set('Asia/Bangkok');
$day = date('d'); $month = date('m'); $year = date('Y') + 543; $time_log = date('H:i'); $year_eng = date('Y');
$sql_menu_check = "SELECT * FROM data_config WHERE status='1'";
$qr_menu_check = ams_query($link, $sql_menu_check);
$num_menu_check = mysqli_num_rows($qr_menu_check);
