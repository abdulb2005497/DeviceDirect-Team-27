<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../Login_page/login.php");
    exit();
}

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if (in_array($action, ['approve', 'decline'])) {
        $stmt = $pdo->prepare("UPDATE refund_requests SET status = ? WHERE id = ?");
        $stmt->execute([$action === 'approve' ? 'approved' : 'declined', $id]);
    }
}

header("Location: refund_requests_admin.php");
exit();