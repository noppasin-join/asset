<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>กรุณาเข้าสู่ระบบ | ระบบครุภัณฑ์</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; min-height: 100dvh; display: grid; place-items: center; padding: 24px; background: radial-gradient(ellipse at top, #ede9fe, transparent 65%), #f5f6fa; color: #25233a; font-family: Tahoma, sans-serif; line-height: 1.7; }
        .login-notice { width: 100%; max-width: 520px; padding: 44px 32px 32px; text-align: center; background: #fff; border: 1px solid #e8e4f2; border-top: 5px solid #7153b7; border-radius: 20px; box-shadow: 0 18px 60px #32215d14; }
        .lock { display: grid; place-items: center; width: 80px; height: 80px; margin: 0 auto 24px; border-radius: 24px; background: #f0ebfa; color: #7153b7; }
        .system-name { margin: 0 0 8px; font-size: 16px; color: #716a80; }
        h1 { margin: 0 0 14px; font-size: 24px; line-height: 1.55; overflow-wrap: anywhere; }
        .description { margin: 0 0 28px; color: #655f73; font-size: 16px; }
        .login-button { display: inline-flex; justify-content: center; align-items: center; min-height: 48px; width: 100%; padding: 12px 24px; border-radius: 10px; background: #6947ac; color: #fff; font-size: 16px; font-weight: bold; text-decoration: none; }
        .login-button:hover { background: #55358f; }
        .login-button:focus-visible { outline: 3px solid #9472d4; outline-offset: 4px; }
        .hint { margin: 20px 0 0; font-size: 16px; color: #716a80; }
        @media (max-width: 480px) { body { padding: 16px; } .login-notice { padding: 32px 22px 24px; } h1 { font-size: 21px; } }
    </style>
</head>
<body>
    <main class="login-notice" aria-labelledby="notice-title">
        <div class="lock" aria-hidden="true">
            <svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="10" width="14" height="11" rx="3"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/><path d="M12 14v3"/></svg>
        </div>
        <p class="system-name">ระบบบริหารจัดการครุภัณฑ์</p>
        <h1 id="notice-title"><?= $safeMessage ?? 'กรุณาเข้าสู่ระบบก่อนใช้งาน' ?></h1>
        <p class="description">โปรดเข้าสู่ระบบด้วยบัญชีผู้ใช้งานของคุณ<br>เพื่อเข้าถึงหน้านี้และทำรายการต่อ</p>
        <a class="login-button" href="<?= htmlspecialchars($loginUrl ?? 'index.php', ENT_QUOTES, 'UTF-8') ?>">เข้าสู่ระบบ <span aria-hidden="true">&nbsp; →</span></a>
        <p class="hint">หากไม่สามารถเข้าสู่ระบบได้ กรุณาติดต่อผู้ดูแลระบบ</p>
    </main>
</body>
</html>
