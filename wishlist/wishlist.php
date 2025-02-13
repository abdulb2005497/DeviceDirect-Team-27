<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: ../Login_page/login.php");
    exit();
}

$welcome_message = "Welcome, " . htmlspecialchars($_SESSION['first_name']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Wishlist</title>
    <link rel="stylesheet" href="../assests/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="wishlist.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet"/>
</head>
<body>
<!-- Navbar -->
<?php include '../navbar.php'; ?>
<!-- Navbar -->


<div class="wishlist-container">
    <h1>My Wishlist</h1>
    <div class="wishlist-layout">
        <div class="wishlist-items">
            
        </div>
    </div>
</div>

<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>Device Direct</h3>
                    <p>236 Coventry Road<br/>TW4 5PF, Birmingham<br/>United Kingdom</p>
                    <strong>Phone:</strong> +44 7748374824<br/>
                    <strong>Email:</strong> support@devicedirect.co.uk
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
                    <h4>Our Social</h4>
                    <div class="social-links mt-3">
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <div class="container py-4">
        <div class="copyright">
            &copy; Copyright <strong><span>Device Direct Shop</span></strong>. All Rights Reserved
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
