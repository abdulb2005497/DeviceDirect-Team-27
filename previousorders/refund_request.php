<?php
session_start();
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(["status" => "error", "message" => "Not logged in"]);
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $order_id = intval($_POST['order_id']);
    $refund_reason = trim($_POST['refund_reason']);

    if (!$order_id || empty($refund_reason)) {
        echo json_encode(["status" => "error", "message" => "Invalid input"]);
        exit();
    }

    
    $checkStmt = $pdo->prepare("SELECT * FROM refund_requests WHERE order_id = ?");
    $checkStmt->execute([$order_id]);
    if ($checkStmt->rowCount() > 0) {
        echo json_encode(["status" => "error", "message" => "Refund already requested"]);
        exit();
    }

    
    $stmt = $pdo->prepare("INSERT INTO refund_requests (order_id, user_id, reason) VALUES (?, ?, ?)");
    $stmt->execute([$order_id, $user_id, $refund_reason]);

    
    $updateOrder = $pdo->prepare("UPDATE orders SET status = 'pending_refund' WHERE order_id = ?");
    $updateOrder->execute([$order_id]);

    echo json_encode(["status" => "success", "message" => "Refund request submitted"]);
}
?>