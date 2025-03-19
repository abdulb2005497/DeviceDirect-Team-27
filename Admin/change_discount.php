<?php
session_start();
include('../config/db.php');
include('admin_action.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../Login_page/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['discount_id'])) {
    $discount_id = intval($_POST['discount_id']);
    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("SELECT * FROM discounts WHERE code_id = ?");
        $stmt->execute([$discount_id]);
        $discount = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($discount) {
            $deleteDiscountStmt = $pdo->prepare("DELETE FROM discounts WHERE code_id = ?");
            if ($deleteDiscountStmt->execute([$discount_id])) {
                logAdminAction($pdo, $_SESSION['user_id'], "Deleted discount ID: $discount_id", "discounts");

                $_SESSION['success_message'] = "Discount deleted successfully.";
            } else {
                throw new Exception("Failed to delete discount from the database.");
            }
        } else {
            $_SESSION['error_message'] = "Discount not found.";
        }

        $pdo->commit();
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['error_message'] = "Error: " . $e->getMessage();
    }
}

header("Location: admin_discount.php");
exit();
