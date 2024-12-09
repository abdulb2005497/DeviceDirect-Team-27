<?php
session_start();
include('../config/db.php'); // Database connection
include_once 'cart_functions';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

$user_id = $_SESSION['user_id'];  // Get the logged-in user's ID

// Fetch the cart items from the database
$query = "
    SELECT c.cart_id, p.product_title, pv.image, c.quantity, pv.price, s.size_name, c.prod_variant_id
    FROM cart c
    JOIN product_variants pv ON c.prod_variant_id = pv.prod_variant_id
    JOIN products p ON pv.product_id = p.product_id
    JOIN product_sizes s ON pv.size_id = s.size_id
    WHERE c.user_id = :user_id
";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();

$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the cart items as JSON
echo json_encode($cart_items);
?>
