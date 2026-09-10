<?php
require_once __DIR__ . '/security.php';
ams_require_post();
$sess_user = $_POST['u_username2'] ?? '';
$sess_password = $_POST['u_password2'] ?? '';
if (!is_string($sess_user) || !is_string($sess_password) || $sess_user === '' || $sess_password === '') {
    ams_deny(401, 'Username and password are required.');
}
require __DIR__ . '/check_login.local.php';



$link = mysqli_connect($hostname,$user,$password,$dbname);

mysqli_set_charset($link, 'utf8');
$result = ams_query($link, ams_sql('SELECT * FROM member WHERE username = ? AND password = ? LIMIT 1', [$sess_user, $sess_password]));
$member = mysqli_fetch_assoc($result);
if (!$member) ams_deny(401, 'Username or password is incorrect.');
if ((string)$member['status'] !== '0') ams_deny(403, 'This account is disabled.');
session_regenerate_id(true);
$_SESSION['sess_user'] = $sess_user;
$_SESSION['sess_password'] = $sess_password;
date_default_timezone_set('Asia/Bangkok');
$date_login = date('d/m/') . (date('Y') + 543);
ams_query($link, ams_sql('UPDATE member SET date_login = ?, time_login = ? WHERE id = ?', [$date_login, date('H:i'), $member['id']]));
$_SESSION['ams_csrf'] = bin2hex(random_bytes(32));
$target = (string)$member['level'] === '0' ? 'report_data.php?d61=1' : 'data.php?d4=1';
if (strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false) {
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode(['redirect' => $target]);
    exit;
}
header('Location: ' . $target, true, 303);
exit;
