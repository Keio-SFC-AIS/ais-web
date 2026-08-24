<?php
declare(strict_types=1);
require_once __DIR__ . '/../lib.php';
const PORTAL_ADMIN_CONFIG = __DIR__ . '/config.local.php';
function admin_start_session(): void { if (session_status() === PHP_SESSION_ACTIVE) return; session_name('ais_portal_admin'); session_set_cookie_params(['httponly' => true, 'secure' => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'), 'samesite' => 'Lax', 'path' => '/portal/admin/']); session_start(); }
function admin_config(): array { if (!is_file(PORTAL_ADMIN_CONFIG)) throw new RuntimeException('Admin setup is incomplete. Create portal/admin/config.local.php from config.example.php.'); $config = require PORTAL_ADMIN_CONFIG; if (!is_array($config) || empty($config['password_hash']) || $config['password_hash'] === 'REPLACE_WITH_A_PASSWORD_HASH') throw new RuntimeException('Admin setup is incomplete. Configure a valid password hash.'); return $config; }
function admin_is_authenticated(): bool { return !empty($_SESSION['portal_admin_authenticated']); }
function admin_require_authentication(): void { if (!admin_is_authenticated()) { header('Location: login.php'); exit; } }
function admin_csrf_token(): string { if (empty($_SESSION['portal_admin_csrf'])) $_SESSION['portal_admin_csrf'] = bin2hex(random_bytes(32)); return $_SESSION['portal_admin_csrf']; }
function admin_verify_csrf(): void { $token = $_POST['csrf_token'] ?? ''; if (!is_string($token) || !hash_equals($_SESSION['portal_admin_csrf'] ?? '', $token)) { http_response_code(400); exit('Invalid form request. Please return to the admin page and try again.'); } }
function admin_flash(string $key, ?string $value = null): ?string { if ($value !== null) { $_SESSION['portal_admin_flash'][$key] = $value; return null; } $value = $_SESSION['portal_admin_flash'][$key] ?? null; unset($_SESSION['portal_admin_flash'][$key]); return $value; }
