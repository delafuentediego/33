<?php
// php/ajax/update_user_admin.php
require '../config.php';
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
$id    = intval($data['id'] ?? 0);
$field = $data['field'] ?? '';
$value = $data['value'] ?? '';

$allowed = ['active','vip']; 
if (!in_array($field, $allowed)) {
  echo json_encode(['success'=>false]); exit;
}

$stmt = $pdo->prepare("UPDATE users SET $field = ? WHERE id = ?");
try {
  $stmt->execute([$value, $id]);
  echo json_encode(['success'=>true]);
} catch (Exception $e) {
  echo json_encode(['success'=>false]);
}
