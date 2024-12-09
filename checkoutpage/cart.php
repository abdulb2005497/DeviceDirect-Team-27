<?php
session_start();

// Check if the  is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
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
    <title></title>
  </head>
  <body>

    <div class="cart-container">
        <h1>CART PAGE</h1>

        <div class="cart-layout">
          <!-- These are placeholders will later be replaced with php code pulling the data from the database-->
            <div class="cart-items">
                <div class="cart-item">
                    <img src="../productsmonitor.jpg" alt="">
                    <div class="cart-details">
                        <p>Product Title</p>
                        <p>Product Colour</p>
                        <p>Price</p>
                        <button type="button" name="button">x</button>
                    </div>
                </div>
                <div class="cart-item">
                    <img src="images/monitor.jpg" alt="">
                    <div class="cart-details">
                        <p>Product Title</p>
                        <p>Product Colour</p>
                        <p>Price</p>
                        <button type="button" name="button">x</button>
                    </div>
                </div>
            </div>

            <!-- Placeholder until php is complete -->
            <div class="checkout-summary">
                <h2>Checkout Summary</h2>
                <p>Total: £519.97</p>
                <p>Shipping: Free</p>
                <p>Total: £519.97</p>
                <button class="checkout-btn">Checkout</button>
                <button class="paypal-btn">Pay with PayPal</button>
                <h3>Discount code:</h3>
                <form class="discount-code" action="index.html" method="post">
                  <input type="text" name="" placeholder="Enter code here">
                </form>
            </div>
        </div>
        <a href="wishlist.php">Enter wishlist</a>
    </div>
    </form>
  </body>
</html>
