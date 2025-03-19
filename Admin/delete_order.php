<?php
session_start();
include('../config/db.php');
include('admin_action.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../Login_page/login.php");
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $order_id = intval($_GET['id']);

    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("SELECT * FROM orders WHERE order_id = ?");
        $stmt->execute([$order_id]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($order) {
            $deleteStmt = $pdo->prepare("DELETE FROM orders WHERE order_id = ?");
            if ($deleteStmt->execute([$order_id])) {
                logAdminAction($pdo, $_SESSION['user_id'], "Deleted order  ''$order_id'", "orders");

                $_SESSION['success_message'] = "Order deleted successfully.";
            } else {
                throw new Exception("Failed to delete order from the database.");
            }
        } else {
            $_SESSION['error_message'] = "Order not found.";
        }

        $pdo->commit();

    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['error_message'] = "Error: " . $e->getMessage();
    }
}

header("Location: orders.php");
exit();
