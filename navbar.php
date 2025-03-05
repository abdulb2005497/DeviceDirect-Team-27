<?php

if (session_status() == PHP_SESSION_NONE) { session_start();
}


if (!isset($_SESSION['user_id'])) { header("Location: ../Login_page/login.php");
    exit();
}
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="../Landing-Page/index.php" id="logo">
            <img src="../assests/images/device_direct_logo.png" alt="Device Direct Logo" class="logo-img" />
            <span id="span1">D</span>evice <span>Direct</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span><img src="../assests/images/menu.png" alt="Menu" width="30px" /></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="../Landing-Page/index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="../productspage/index.php">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="../aboutuspage/aboutus.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="../contactuspage/contactus.php">Contact</a></li>

                <!-- Account Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Account
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../Login_page/login.php">Login</a></li>
                        <li><a class="dropdown-item" href="../Login_page/signup.php">Sign Up</a></li>
                        <li><a class="dropdown-item" href="../Login_page/change_password.php">Change Password</a></li>
                        <li><a class="dropdown-item" href="../previousorders/previousorders.php">Previous Orders</a></li>
                        <li><a class="dropdown-item" href="../wishlist/wishlist.php">My Wishlist</a></li>
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

<style>
/* Ensure the navbar stays fixed at the top */
.navbar {
    top: 0;
    left: 0;
    width: 100%;
    background-color: rgb(248, 249, 250);
    z-index: 1050; /* Ensures it's above all other elements */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Optional: Adds shadow for better visibility */
}

/* Prevent content from getting hidden behind navbar */
body {
    padding-top: 70px; /* Adjust this value to match the navbar height */
}

.dropdown-menu {
    background-color: #4B014D !important;
    border: none;
}

.dropdown-menu li {
    background-color: #4B004B;
    color: white;
}

.dropdown-menu li:hover {
    background-color: #6A006A;
}
</style>
