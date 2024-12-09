<?php
session_start();
include '../config/db.php';  // Include the cart functions file
include_once 'cart_functions.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit();
}
if (isset($_POST['remove_item'])) {
    $cart_id = $_POST['cart_id'];

    // SQL query to remove the item from the cart
    $remove_query = "DELETE FROM cart WHERE cart_id = :cart_id";
    $remove_stmt = $pdo->prepare($remove_query);
    $remove_stmt->execute(['cart_id' => $cart_id]);

    // Redirect to the cart page after removing the item
    header("Location: cart.php");
    exit();
  }
?>
