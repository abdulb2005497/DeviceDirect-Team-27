<?php
session_start();
include_once '../config/db.php';
include_once 'wishlist_functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?error=Please log in first");
    exit();
}

$user_id = $_SESSION['user_id'];
$wishlistItems = getWishlistItems($pdo, $user_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style_wishlist.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php" id="logo">
                <img src="../assests/images/device_direct_logo.png" alt="Device Direct Logo" class="logo-img">
                <span id="span1">D</span>evice <span>Direct</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span><img src="./assests/images/menu.png" alt="" width="30px"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../productspage/index.php">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="../aboutuspage/aboutus.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="../contactuspage/contactus.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="../config/logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Wishlist Section -->
    <div class="wishlist-container">
        <h1>My Wishlist</h1>
        <?php if (!empty($wishlistItems)): ?>
            <?php foreach ($wishlistItems as $item): ?>
                <div class="wishlist-item">
                    <img src="../productspage/images/<?php echo $item['image']; ?>" alt="<?php echo $item['product_title']; ?>" class="wishlist-item-img">
                    <div class="wishlist-item-details">
                        <p class="product-title"><?php echo $item['product_title']; ?></p>
                        <p class="product-price">£<?php echo number_format($item['price'], 2); ?></p>

                        <form action="remove_wishlist.php" method="post" class="remove-form">
                            <input type="hidden" name="prod_variant_id" value="<?php echo $item['prod_variant_id']; ?>">
                            <button type="submit" name="remove_item" class="remove-btn">Remove</button>
                        </form>
                        <a href="../checkoutpage/cart.php?add=<?php echo $item['prod_variant_id']; ?>" class="add-to-cart-btn">Add to Cart</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Your wishlist is empty.</p>
    
