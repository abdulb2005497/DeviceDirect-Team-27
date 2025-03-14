<?php
session_start();
include('../config/db.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../Login_page/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['discount_id'])) {
    $discount_id = $_POST['discount_id'];
    try {
        $stmt = $pdo->prepare("DELETE FROM discounts WHERE code_id = ?");
        $stmt->execute([$discount_id]);
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}

header("Location: admin_discount.php");
exit();
?>
