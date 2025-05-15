<?php
// php/ajax/get_options.php
require '../config.php';
header('Content-Type: application/json');
$stepId = intval($_GET['stepId'] ?? 0);

// ex : table options {step_id, value, label, price}
$stmt = $pdo->prepare("SELECT value,label,price FROM options WHERE step_id = ?");
stmt->execute([$stepId]);
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
