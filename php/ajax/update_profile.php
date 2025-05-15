<?php
// php/ajax/update_profile.php
require '../config.php';
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
$field = $data['field'] ?? '';
$value = $data['value'] ?? '';
$userId = $_SESSION['user']['id'] ?? 0;

$allowed = ['username','email', /* etc */];
if (!in_array($field, $allowed)) {
  echo json_encode(['success'=>false]); exit;
}

$stmt = $pdo->prepare("UPDATE users SET $field = ? WHERE id = ?");
try {
  $stmt->execute([$value, $userId]);
  $_SESSION['user'][$field] = $value;
  echo json_encode(['success'=>true]);
} catch (Exception $e) {
  echo json_encode(['success'=>false]);
}
