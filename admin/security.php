<?php
// Shared by every application entry point; no database connection is needed to reject a request.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start(['cookie_httponly' => true, 'cookie_samesite' => 'Lax',
        'cookie_secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'use_strict_mode' => true]);
}
function ams_deny($status, $message) {
    if ($status === 401) {
        while (ob_get_level() > 0) ob_end_clean();
        http_response_code($status);
        header('Content-Type: text/html; charset=UTF-8');
        header('Cache-Control: no-store');
        $messages = [
            'Authentication required. Please log in.' => 'กรุณาเข้าสู่ระบบก่อนใช้งาน',
            'Invalid session. Please log in again.' => 'กรุณาเข้าสู่ระบบก่อนใช้งาน',
            'Username and password are required.' => 'กรุณากรอกชื่อผู้ใช้และรหัสผ่าน',
            'Username or password is incorrect.' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง',
        ];
        $safeMessage = htmlspecialchars($messages[$message] ?? $message, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        // Build a relative login link for both root and nested application pages.
        $root = str_replace('\\', '/', dirname(__DIR__));
        $entryDir = str_replace('\\', '/', dirname(realpath($_SERVER['SCRIPT_FILENAME'] ?? '') ?: __FILE__));
        $relativeDir = substr($entryDir, strlen($root));
        $depth = count(array_filter(explode('/', $relativeDir), 'strlen'));
        $loginUrl = str_repeat('../', $depth) . 'admin/index.php';
        require __DIR__ . '/login_required.php';
        exit;
    }
    http_response_code($status);
    header('Content-Type: text/plain; charset=UTF-8');
    header('Cache-Control: no-store');
    echo $message;
    exit;
}
function ams_csrf_token() {
    if (empty($_SESSION['ams_csrf'])) $_SESSION['ams_csrf'] = bin2hex(random_bytes(32));
    return $_SESSION['ams_csrf'];
}
function ams_require_csrf() {
    $token = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    if (!is_string($token) || empty($_SESSION['ams_csrf']) || !hash_equals($_SESSION['ams_csrf'], $token)) {
        ams_deny(403, 'CSRF verification failed. Reload the form and try again.');
    }
}
function ams_require_session() {
    if (empty($_SESSION['sess_user']) || empty($_SESSION['sess_password'])) {
        ams_deny(401, 'Authentication required. Please log in.');
    }
}
function ams_require_post() {
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') ams_deny(403, 'This action requires POST.');
    ams_require_csrf();
}
function ams_sql($text, array $params = []) { return ['sql' => $text, 'params' => $params]; }
function ams_limit($query, $offset, $count) {
    if (!is_array($query)) $query = ams_sql($query);
    $query['sql'] .= ' LIMIT ?, ?';
    $query['params'][] = max(0, (int)$offset);
    $query['params'][] = max(1, (int)$count);
    return $query;
}
function ams_query($link, $query) {
    $sql = is_array($query) ? $query['sql'] : $query;
    $params = is_array($query) ? $query['params'] : [];
    if (preg_match('/^\s*(INSERT|UPDATE|DELETE|REPLACE|TRUNCATE|ALTER|DROP|CREATE)\b/i', $sql)) {
        // Only the public request-form handlers may insert without a staff login.
        $entry = realpath($_SERVER['SCRIPT_FILENAME'] ?? '');
        $publicHandlers = [realpath(__DIR__ . '/../add_data.php'), realpath(__DIR__ . '/../add_data-Backup12062563.php')];
        if ($entry === false || !in_array($entry, $publicHandlers, true)) ams_require_session();
        ams_require_post();
    }
    $stmt = mysqli_prepare($link, $sql);
    if (!$stmt) throw new RuntimeException('Unable to prepare database query.');
    if ($params) {
        $types = '';
        foreach ($params as $value) $types .= is_int($value) ? 'i' : 's';
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    return $result === false ? true : $result;
}
// Legacy pages performed housekeeping while displaying a GET page. Never mutate on GET.
function ams_page_update($link, $query) {
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') return true;
    return ams_query($link, $query);
}
function ams_action_routes() {
    return require __DIR__ . '/security_routes.php';
}
function ams_render_security($html) {
    if (stripos($html, '<head') === false) return $html;
    $token = htmlspecialchars(ams_csrf_token(), ENT_QUOTES, 'UTF-8');
    $html = preg_replace_callback('/<form\b[^>]*>/i', function ($m) use ($token) {
        // Do not disclose the session token to an external form target.
        if (preg_match('~\baction\s*=\s*["\'](?:https?:)?//~i', $m[0])) return $m[0];
        if (!preg_match('/\bmethod\s*=\s*["\']?post\b/i', $m[0])) return $m[0];
        return $m[0] . '<input type="hidden" name="csrf_token" value="' . $token . '">';
    }, $html);
    $config = json_encode(['token' => ams_csrf_token(), 'actions' => ams_action_routes()], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    $script = '<script>window.amsSecurity=' . $config . ';</script><script>' . file_get_contents(__DIR__ . '/security.js') . '</script>';
    return preg_replace('/(<head\b[^>]*>)/i', '$1' . $script, $html, 1);
}
ams_csrf_token();
header('Cache-Control: no-store');
header('Referrer-Policy: same-origin');
ob_start('ams_render_security');
