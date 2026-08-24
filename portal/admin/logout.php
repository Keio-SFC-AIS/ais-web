<?php
declare(strict_types=1);
require_once __DIR__ . '/bootstrap.php'; admin_start_session(); $_SESSION = []; session_destroy(); header('Location: login.php'); exit;
