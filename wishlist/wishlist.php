<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once('../navbar.php');
include('../config/db.php');
include('../checkoutpage/cart_functions.php');

// Initialize wishlist session if not set
if (!isset($_SESSION['wishlist'])) {
    $_SESSION['wishlist'] = [];
}

// Flash message system
function set_flash_message($message) {
    $_SESSION['flash_message'] = $message;
}

function get_flash_message() {
    if (isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        return $message;
    }
    return null;
}

// Adding item to wishlist
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_wishlist'])) {
    $variant_id = $_POST['variant_id'] ?? null;
    $product_title = $_POST['product_title'] ?? 'Unknown Product';
    $category_name = $_POST['category_name'] ?? 'Unknown Category';
    $colour_name = $_POST['colour_name'] ?? 'Unknown Colour';
    $size_name = $_POST['size_name'] ?? 'Unknown Size';
    $image = $_POST['image'] ?? 'default.jpg';
    $price = $_POST['price'] ?? 0.00;

    if ($variant_id && ctype_digit($variant_id)) {
        $_SESSION['wishlist'][$variant_id] = [
            'product_title' => $product_title,
            'category_name' => $category_name,
            'colour_name' => $colour_name,
            'size_name' => $size_name,
            'image' => $image,
            'price' => $price
        ];
        set_flash_message("Item added to wishlist!");
    }
}

// Removing item from wishlist
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_from_wishlist'])) {
    $variant_id = $_POST['variant_id'] ?? null;
    
    if ($variant_id && isset($_SESSION['wishlist'][$variant_id])) {
        unset($_SESSION['wishlist'][$variant_id]);
        set_flash_message("Item removed from wishlist!");
    }
}

// Moving item to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['move_to_cart'])) {
    $variant_id = $_POST['variant_id'] ?? null;
    
    if ($variant_id && isset($_SESSION['wishlist'][$variant_id])) {
        $item = $_SESSION['wishlist'][$variant_id];
        unset($_SESSION['wishlist'][$variant_id]);

        // Assuming you have a function to add items to cart
        add_to_cart($variant_id, $item['product_title'], $item['category_name'], $item['colour_name'], $item['size_name'], $item['image'], $item['price']);

        set_flash_message("Item moved to cart!");
    }
}

// Get wishlist items from session
$wishlist_items = $_SESSION['wishlist'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-5">
    <h2>Your Wishlist</h2>
    <hr>

    <!-- Display flash message
