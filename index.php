<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['user_id'])) {
    header("Location: Login_page/login.php");
    exit();
}


$welcome_message = "Welcome, " . htmlspecialchars($_SESSION['first_name']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeviceDirect | Home</title>
    <link rel="stylesheet" href="assests/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php" id="logo">
                <img src="assests/images/device_direct_logo.png" alt="Device Direct Logo" class="logo-img">
                <span id="span1">D</span>evice <span>Direct</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span><img src="./assests/images/menu.png" alt="" width="30px"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="productspage/index.php">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="aboutuspage/aboutus.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="contactuspage/contactus.php">Contact</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: rgb(67 0 86);">
                            <li><a class="dropdown-item" href="Login_page/login.php">Login</a></li>
                            <li><a class="dropdown-item" href="Login_page/signup.php">SignUp</a></li>
                            <li><a class="dropdown-item" href="previousorders/previousorders.php">Previous Orders</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="config/logout.php">Logout</a></li>
                </ul>
                <form class="d-flex" id="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <div class="cart-btn"><a href="checkoutpage/cart.php"><i class="fas fa-shopping-bag"></i></a></div>
            </div>
        </div>
    </nav>

    <!-- Welcome Message -->
    <div class="container mt-4">
        <div class="alert alert-success text-center">
            <h3><?php echo $welcome_message; ?></h3>
        </div>
    </div>

    <!-- Home Content -->
    <section class="home">
        <div class="content">
            <h1>Latest Tech <span id="span2">Unbeatable Prices!</span></h1>
            <p>Found it cheaper? We will match it! <br>We will price match against any other UK retailer.</p>
            <div class="btn">
                <a href="productspage/index.php"> <button>Shop Now</button></a>
            </div>
        </div>
        <div class="img">
            <img src="./assests/images/image1.png" alt="">
        </div>
    </section>

    <!-- Footer -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>Device Direct</h3>
                        <p>
                            236 Coventry Road <br>
                            TW4 5PF, Birmingham <br>
                            United Kingdom <br>
                        </p>
                        <strong>Phone:</strong> +44 7748374824 <br>
                        <strong>Email:</strong> support@devicedirect.co.uk<br>
                    </div>
                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><a href="/Landing-Page/index.html">Home</a></li>
                            <li><a href="/aboutuspage/aboutus.html">About Us</a></li>
                            <li><a href="/Login page/login.php">Account</a></li>
                            <li><a href="/productspage/index.php">Shop Now</a></li>
                            <li><a href="/contactuspage/contactus.php">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container py-4">
            <div class="copyright">
                &copy; Copyright <strong><span>Device Direct Shop</span></strong>. All Rights Reserved
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
