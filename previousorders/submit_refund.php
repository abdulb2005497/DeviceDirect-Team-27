<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo "Unauthorized";
    exit();
}

$user_id = $_SESSION['user_id'];
$order_id = $_POST['order_id'] ?? null;
$reason = $_POST['refund_reason'] ?? null;

if (!$order_id || !$reason) {
    http_response_code(400);
    echo "Missing required data.";
    exit();
}
try {
    $stmt = $pdo->prepare("INSERT INTO refund_requests (order_id, user_id, reason, status, requested_at) VALUES (?, ?, ?, 'under_review', NOW())");
    $stmt->execute([$order_id, $user_id, $reason]);

    echo "success";
} catch (PDOException $e) {
    http_response_code(500);
    echo "Database error: " . $e->getMessage();
}