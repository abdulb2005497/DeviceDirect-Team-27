
<?php
// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: Login_page/login.php");
    exit();
}

// Display a welcome message for the logged-in user
$welcome_message = "Welcome, " . htmlspecialchars($_SESSION['first_name']);

$total_price = isset($_SESSION['total_price']) ? $_SESSION['total_price'] : 0;

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style_cart.css">
    <title></title>
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
          <img
            src="../assests/images/device_direct_logo.png"
            alt="Device Direct Logo"
            class="logo-img"
          />
          <span id="span1">D</span>evice <span>Direct</span></a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span
            ><img src="./assests/images/menu.png" alt="" width="30px"
          /></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a
                class="nav-link active"
                aria-current="page"
                href="../index.php"
                >Home</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../productspage/index.php">Shop</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../aboutuspage/aboutus.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../contactuspage/contactus.php"
                >Contact</a
              >
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Account
              </a>
              <ul
                class="dropdown-menu"
                aria-labelledby="navbarDropdown"
                style="background-color: rgb(67 0 86)"
              >
                <li>
                  <a class="dropdown-item" href="../Login_page/login.php"
                    >Login</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="../Login_page/signup.php"
                    >SignUp</a
                  >
                </li>
                <li>
                  <a
                    class="dropdown-item"
                    href="../previousorders/previousorders.php"
                    >Previous Orders</a
                  >
                </li>
                <li><a class="dropdown-item" href="wishlist/wishlist.php">My Wishlist</a></li>
              </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="../config/logout.php">Logout</a></li>
          </ul>
          <form class="d-flex" id="search">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <button class="btn btn-outline-success" type="submit">
              Search
            </button>
          </form>
          <div class="cart-btn">
            <a href="../checkoutpage/cart.php"
              ><i class="fas fa-shopping-bag"></i
            ></a>
          </div>
        </div>
      </div>
    </nav>
    <!-- navbar -->


     <!-- Checkout Form -->
     <div class="container my-5">
      <h1 class="text-center mb-4">Checkout</h1>
      <form action="process_checkout.php" method="POST">
        <!-- Billing Information -->
        <div class="mb-4">
          <h3>Billing Information</h3>
          <div class="row g-3">
            <div class="col-md-6">
              <label for="billingFirstName" class="form-label">First Name</label>
              <input type="text" class="form-control" name="billingFirstName" placeholder="First name" required>
            </div>
            <div class="col-md-6">
              <label for="billingLastName" class="form-label">Last Name</label>
              <input type="text" class="form-control" name="billingLastName" placeholder="Surname" required>
            </div>
            <div class="col-12">
              <label for="billingAddress" class="form-label">Address</label>
              <input type="text" class="form-control" name="billingAddress" placeholder="Enter address" required>
            </div>
            <div class="col-md-6">
              <label for="billingCity" class="form-label">City</label>
              <input type="text" class="form-control" name="billingCity" placeholder="City" required>
            </div>
            <div class="col-md-6">
              <label for="billingPostalCode" class="form-label">Postal Code</label>
              <input type="text" class="form-control" name="billingPostalCode" placeholder="XX00 0XX" required>
            </div>
          </div>
        </div>

        <div class="mb-4">
          <h3>Payment Details</h3>
          <div class="row g-3">
            <div class="col-md-6">
              <label for="cardName" class="form-label">Name on Card</label>
              <input type="text" class="form-control" name="cardName" placeholder="Full name" required>
            </div>
            <div class="col-md-6">
              <label for="cardNumber" class="form-label">Card Number</label>
              <input type="text" class="form-control" name="cardNumber" placeholder="16 digit code" required>
            </div>
            <div class="col-md-4">
              <label for="expiryDate" class="form-label">Expiry Date</label>
              <input type="text" class="form-control" name="expiryDate" placeholder="MM/YY" required>
            </div>
            <div class="col-md-4">
              <label for="cvc" class="form-label">CVC</label>
              <input type="text" class="form-control" name="cvc" placeholder="3 digit code" required>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">Place Order</button>
      </form>
    </div>

    <!-- footer -->
  <footer name="footer">
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
              <h4>Usefull Links</h4>
              <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="../aboutuspage/aboutus.php">About Us</a></li>
                <li><a href="../config/logout.php">Logout</a></li>
                <li>
                  <a href="../productspage/index.php">Shop Now</a>
                </li>
                <li><a href="../contactuspage/contactus.php">Contact Us</a></li>
              </ul>
            </div>

            <div class="col-lg-3 col-md-6 footer-links">
              <h4>Our Services</h4>

              <ul>
                <li>
                  <a href="productspage\pagescode\consolescode\consoles.php"
                    >Gaming Consoles</a
                  >
                </li>
                <li>
                  <a href="productspage\pagescode\tvcode\tvs.php">TVs</a>
                </li>
                <li>
                  <a href="productspage\pagescode\laptopscode\laptops.php"
                    >Laptops</a
                  >
                </li>
                <li>
                  <a href="productspage\pagescode\monitorscode\monitors.php"
                    >Monitors</a
                  >
                </li>
                <li>
                  <a
                    href="productspage\pagescode\headphonescode\headphones.php"
                    >Headphones</a
                  >
                </li>
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
          &copy; Copyright <strong><span>Device Direct Shop</span></strong
          >. All Rights Reserved
        </div>
      </div>
    </footer>
    <!-- footer -->
    </body>
</html>
