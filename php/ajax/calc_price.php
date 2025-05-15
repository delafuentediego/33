<?php
// php/ajax/calc_price.php
require '../config.php';
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
$voyageId = intval($data['voyageId'] ?? 0);
$options  = $data['options'] ?? [];

// recalcule : prix de base + sommaire des options
$stmt = $pdo->prepare("SELECT price FROM voyages WHERE id = ?");
$stmt->execute([$voyageId]);
$total = floatval($stmt->fetchColumn() ?: 0);

foreach ($options as $field => $val) {
  $stmt = $pdo->prepare("SELECT price FROM options WHERE field = ? AND value = ?");
  $stmt->execute([$field, $val]);
  $total += floatval($stmt->fetchColumn() ?: 0);
}

echo json_encode(['total'=>$total]);
