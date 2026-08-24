<?php
declare(strict_types=1);
require_once __DIR__ . '/bootstrap.php'; admin_start_session(); admin_require_authentication(); admin_verify_csrf();
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT); $direction = $_POST['direction'] ?? '';
if ($id && in_array($direction, ['up', 'down'], true)) { $database = portal_database(); $current = $database->prepare('SELECT id, sort_order FROM cards WHERE id = ?'); $current->execute([$id]); $current = $current->fetch(); if ($current) { $operator = $direction === 'up' ? '<' : '>'; $order = $direction === 'up' ? 'DESC' : 'ASC'; $neighbor = $database->prepare("SELECT id, sort_order FROM cards WHERE sort_order $operator ? ORDER BY sort_order $order LIMIT 1"); $neighbor->execute([$current['sort_order']]); $neighbor = $neighbor->fetch(); if ($neighbor) { $database->beginTransaction(); $update = $database->prepare('UPDATE cards SET sort_order = ? WHERE id = ?'); $update->execute([$neighbor['sort_order'], $current['id']]); $update->execute([$current['sort_order'], $neighbor['id']]); $database->commit(); admin_flash('message', 'Card order updated.'); } } }
header('Location: index.php'); exit;
