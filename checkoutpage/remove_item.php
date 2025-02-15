<?php
session_start();
include('../config/db.php');
include('cart_functions.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?error=Please log in first");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_item'])) {
    $user_id = $_SESSION['user_id'];
    $prod_variant_id = $_POST['prod_variant_id'] ?? null;

    if ($prod_variant_id) {
        $success = remove_from_cart($pdo, $user_id, $prod_variant_id);
        header("Location: cart.php?message=" . ($success ? "Item removed!" : "Error removing item."));
        exit();
    } else {
        header("Location: cart.php?error=Invalid request.");
        exit();
    }
}

header("Location: cart.php");
exit();
?>
