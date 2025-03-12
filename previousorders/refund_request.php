<?php
session_start();
require '../config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Login_page/login.php");
    exit();
}

// Get order ID from URL
if (!isset($_GET['order_id'])) {
    die("Order ID is missing.");
}

$order_id = intval($_GET['order_id']);
$user_id = $_SESSION['user_id'];

// Check if the order exists and belongs to the user
$stmt = $pdo->prepare("SELECT * FROM orders WHERE order_id = ? AND user_id = ?");
$stmt->execute([$order_id, $user_id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    die("Order not found.");
}

// Check if the order is eligible for a refund (Only pending orders can be refunded)
if ($order['status'] !== 'pending') {
    die("Refunds can only be requested for pending orders.");
}

// Update the order status to 'refund_requested'
$updateStmt = $pdo->prepare("UPDATE orders SET status = 'refund_requested' WHERE order_id = ?");
$updateStmt->execute([$order_id]);

// Redirect back with success message
header("Location: order_details.php?order_id=$order_id&message=Refund requested successfully.");
exit();
?>