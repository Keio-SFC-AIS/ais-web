<?php
declare(strict_types=1);
require_once __DIR__ . '/bootstrap.php'; admin_start_session(); admin_require_authentication(); admin_verify_csrf();
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if ($id) { $statement = portal_database()->prepare('DELETE FROM cards WHERE id = ?'); $statement->execute([$id]); admin_flash('message', 'Card deleted.'); }
header('Location: index.php'); exit;
