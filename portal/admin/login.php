<?php
declare(strict_types=1);
require_once __DIR__ . '/bootstrap.php';
admin_start_session();
try { $config = admin_config(); } catch (RuntimeException $exception) { http_response_code(503); exit(portal_escape($exception->getMessage())); }
if (admin_is_authenticated()) { header('Location: index.php'); exit; }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_verify_csrf();
    $attempts = (int) ($_SESSION['portal_admin_login_attempts'] ?? 0);
    if ($attempts >= 5) { $error = 'Too many attempts. Wait for the session to expire, then try again.'; }
    elseif (password_verify((string) ($_POST['password'] ?? ''), $config['password_hash'])) { session_regenerate_id(true); $_SESSION['portal_admin_authenticated'] = true; unset($_SESSION['portal_admin_login_attempts']); header('Location: index.php'); exit; }
    else { $_SESSION['portal_admin_login_attempts'] = $attempts + 1; $error = 'Incorrect password.'; }
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Portal admin | AIS</title><link rel="stylesheet" href="admin.css"></head><body class="admin-page"><main class="login-panel"><h1>AIS Portal</h1><p>Admin sign in</p><?php if ($error): ?><div class="notice error"><?= portal_escape($error) ?></div><?php endif; ?><form method="post"><input type="hidden" name="csrf_token" value="<?= portal_escape(admin_csrf_token()) ?>"><label>Password<input name="password" type="password" autocomplete="current-password" required autofocus></label><button type="submit">Sign in</button></form></main></body></html>
