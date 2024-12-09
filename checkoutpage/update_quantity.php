<?php
session_start();
include('../config/db.php'); // Database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");  // Redirect to login if the user is not logged in
    exit();
}

$user_id = $_SESSION['user_id'];  // Get the logged-in user's ID

// Check if the required POST data exists
if (isset($_POST['cart_id']) && isset($_POST['quantity'])) {
    $cart_id = $_POST['cart_id'];
    $quantity = $_POST['quantity'];

    // Ensure quantity is a positive number
    if ($quantity > 0) {
        // Update the quantity in the cart table
        $update_query = "UPDATE cart SET quantity = :quantity WHERE cart_id = :cart_id AND user_id = :user_id";
        $stmt = $pdo->prepare($update_query);
        $stmt->execute(['quantity' => $quantity, 'cart_id' => $cart_id, 'user_id' => $user_id]);

        // Redirect back to the cart page
        header("Location: cart.php");
        exit();
    } else {
        // If invalid quantity, redirect back to the cart with an error
        $_SESSION['error'] = "Quantity must be greater than zero!";
        header("Location: cart.php");
        exit();
    }
} else {
    // Redirect back to the cart if the required data is not present
    $_SESSION['error'] = "Invalid cart item or quantity!";
    header("Location: cart.php");
    exit();
}
?>
