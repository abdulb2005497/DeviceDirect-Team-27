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

