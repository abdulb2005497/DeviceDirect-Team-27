<?php
session_start();
include_once '../config/db.php';
include_once 'cart_functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?error=" . urlencode("Please log in first"));
    exit();
}

$user_id = $_SESSION['user_id'];
$cartItems = getCartItems($pdo, $user_id);
$totalAmount = calculate_total($pdo, $user_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style_cart.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php" id="logo">
                <img src="../assets/images/device_direct_logo.png" alt="Device Direct Logo" class="logo-img" />
                <span id="span1">D</span>evice <span>Direct</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span><img src="../assets/images/menu.png" alt="Menu" width="30px" /></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../productspage/index.php">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="../aboutuspage/aboutus.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="../contactuspage/contactus.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="../config/logout.php">Logout</a></li>
                </ul>
                <div class="cart-btn">
                    <a href="../checkoutpage/cart.php"><i class="fas fa-shopping-bag"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Cart Section -->
    <div class="cart-container">
        <h1>My Cart</h1>
        <?php if (!empty($cartItems)): ?>
            <?php foreach ($cartItems as $item): ?>
                <div class="cart-item">
                    <img src="../productspage/images/<?= htmlspecialchars($item['image']); ?>" alt="<?= htmlspecialchars($item['product_title']); ?>" class="cart-item-img">
                    <div class="cart-item-details">
                        <p class="product-title"> <?= htmlspecialchars($item['product_title']); ?> </p>
                        <p class="product-price"> £<?= number_format($item['price'], 2); ?> </p>
                        <form action="update_cart.php" method="post" class="quantity-form">
                            <input type="hidden" name="prod_variant_id" value="<?= htmlspecialchars($item['prod_variant_id']); ?>">
                            <input type="number" name="quantity" value="<?= $item['quantity']; ?>" min="1" class="quantity-input">
                            <button type="submit" name="update_quantity" class="update-btn">Update</button>
                        </form>
                        <form action="remove_item.php" method="post" class="remove-form">
                            <input type="hidden" name="prod_variant_id" value="<?= htmlspecialchars($item['prod_variant_id']); ?>">
                            <button type="submit" name="remove_item" class="remove-btn">Remove</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>

    <!-- Cart Summary -->
    <div class="cart-summary">
        <h2>Total</h2>
        <p>Subtotal: £<?= number_format($totalAmount, 2); ?></p>
        <p>Delivery: <span class="free-shipping">Standard Delivery (Free)</span></p>
        <hr>
        <p>Total: £<?= number_format($totalAmount, 2); ?></p>
        <button class="checkout-btn" onclick="window.location.href='checkout.php'">Checkout</button>
    </div>
    
    <!-- Footer -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 footer-contact">
                        <h3>Device Direct</h3>
                        <p>236 Coventry Road <br />TW4 5PF, Birmingham<br />United Kingdom</p>
                        <strong>Phone:</strong> +44 7748374824 <br />
                        <strong>Email:</strong> support@devicedirect.co.uk
                    </div>
                    <div class="col-lg-3 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><a href="../index.php">Home</a></li>
                            <li><a href="../aboutuspage/aboutus.php">About Us</a></li>
                            <li><a href="../config/logout.php">Logout</a></li>
                            <li><a href="../productspage/index.php">Shop Now</a></li>
                            <li><a href="../contactuspage/contactus.php">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <div class="container py-4">
            <div class="copyright">
                &copy; <?= date("Y"); ?> <strong>Device Direct Shop</strong>. All Rights Reserved.
            </div>
        </div>
    </footer>

</body>
</html>
