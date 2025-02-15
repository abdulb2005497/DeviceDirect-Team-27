<?php
session_start();
include('../config/db.php');
include('cart_functions.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?error=Please log in first");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_quantity'])) {
    $user_id = $_SESSION['user_id'];
    $prod_variant_id = $_POST['prod_variant_id'] ?? null;
    $quantity = $_POST['quantity'] ?? 1;

    if ($prod_variant_id && $quantity > 0) {
        $success = update_cart_quantity($pdo, $user_id, $prod_variant_id, $quantity);
        header("Location: cart.php?message=" . ($success ? "Cart updated!" : "Error updating cart."));
        exit();
    } else {
        header("Location: cart.php?error=Invalid input.");
        exit();
    }
}

header("Location: cart.php");
exit();
?>
