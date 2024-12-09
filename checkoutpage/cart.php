<?php
session_start();
include_once '../config/db.php';
include_once 'cart_functions.php';

// Check if the  is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$cart_items = getCartItems($user_id);

$total = 0;
foreach ($cart_items as $item) {
    $total += $item['price'] * $item['quantity'];
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style_cart.css">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <!-- bootstrap links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-- fonts links -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet" />
</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php" id="logo">
                <img src="../assests/images/device_direct_logo.png" alt="Device Direct Logo" class="logo-img" />
                <span id="span1">D</span>evice <span>Direct</span></a
            >
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span><img src="./assests/images/menu.png" alt="" width="30px" /></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../productspage/index.php">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../aboutuspage/aboutus.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../contactuspage/contactus.php">Contact</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: rgb(67 0 86)">
                            <li><a class="dropdown-item" href="../Login_page/login.php">Login</a></li>
                            <li><a class="dropdown-item" href="../Login_page/signup.php">SignUp</a></li>
                            <li><a class="dropdown-item" href="../previousorders/previousorders.php">Previous Orders</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../config/logout.php">Logout</a></li>
                </ul>
             
                <div class="cart-btn">
                    <a href="../checkoutpage/cart.php"><i class="fas fa-shopping-bag"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <div class="cart-container">
        <h1>CART PAGE</h1>
        <div class="cart-layout">
            <div class="cart-items">
                <?php if (empty($cart_items)): ?>
                    <p>Your cart is empty!</p>
                <?php else: ?>
                    <?php foreach ($cart_items as $item): ?>
                        <div class="cart-item">
                            <img src="../productspage/images/<?php echo $item['image']; ?>" alt="<?php echo $item['product_title']; ?>">
                            <div class="cart-details">
                                <p><?php echo $item['product_title']; ?></p>
                                <p>£<?php echo $item['price']; ?></p>
                                <p>Size: <?php echo $item['size_name']; ?></p>
                                <p>Quantity: <?php echo $item['quantity']; ?></p>
                                <div class="buttons-container">
                                    <form action="update_quantity.php" method="post">
                                        <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                                        <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" style="width: 50px;">
                                        <button type="submit" name="update_quantity">Update</button>
                                    </form>
                                    <form action="remove_from_cart.php" method="post">
                                        <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                                        <button type="submit" name="remove_item" class="remove-btn">Remove</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="checkout-summary">
                <h2>Checkout Summary</h2>
                <p>Total: £<?php echo number_format($total, 2); ?></p>
                <p>Shipping: Free</p>
                <p>Total: £<?php echo number_format($total, 2); ?></p>
                <a href="../checkoutpage/checkout.php"><button class="checkout-btn">Checkout</button></a>
                <button class="paypal-btn">Pay with PayPal</button>
                <h3>Discount code:</h3>
                <form class="discount-code" action="index.html" method="post">
                    <input type="text" name="" placeholder="Enter code here">
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>Device Direct</h3>
                        <p>
                            236 Coventry Road <br />
                            TW4 5PF, Birmingham <br />
                            United Kingdom <br />
                        </p>
                        <strong>Phone:</strong> +44 7748374824 <br />
                        <strong>Email:</strong>support@devicedirect.co.uk<br />
                    </div>
                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><a href="../index.php">Home</a></li>
                            <li><a href="../aboutuspage/aboutus.php">About Us</a></li>
                            <li><a href="../config/logout.php">Logout</a></li>
                            <li><a href="../productspage/index.php">Shop Now</a></li>
                            <li><a href="../contactuspage/contactus.php">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><a href="#">Gaming Consoles</a></li>
                            <li><a href="#">TVs</a></li>
                            <li><a href="#">Laptops</a></li>
                            <li><a href="#">Monitors</a></li>
                            <li><a href="#">Headphones</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Social</h4>
                        <div class="socail-links mt-3">
                            <a href="#"><i class="fa-brands fa-twitter"></i></a>
                            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <div class="container py-4">
            <div class="copyright">
                &copy; Copyright <strong><span>Device Direct Shop</span></strong>. All Rights Reserved
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
