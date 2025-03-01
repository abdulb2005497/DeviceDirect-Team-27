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
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shop</title>
    <link
      rel="stylesheet"
      href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <link rel="stylesheet" href="../productspage/style.css?v=<?php echo time(); ?>">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    />
    <!-- Bootstrap links -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <style>
      /* Make navbar fixed */
      #navbar {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          z-index: 1000;
          background-color: #ffffff; /* Adjust color as needed */
          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
          padding: 10px 0;
      }

      /* Prevent content from being hidden under fixed navbar */
      body {
          padding-top: 80px; /* Adjust this based on navbar height */
      }

      /* Adjustments for mobile responsiveness */
      @media (max-width: 768px) {
          #navbar {
              padding: 5px 0;
          }
          body {
              padding-top: 60px; /* Adjust for smaller navbar */
          }
      }
    </style>
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
                <span><img src="../assests/images/menu.png" alt="Menu" width="30px"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="../Landing-Page/index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../productspage/index.php">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="../aboutuspage/aboutus.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="../contactuspage/contactus.php">Contact</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">Account</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: rgb(67 0 86);">
                            <li><a class="dropdown-item" href="Login_page/login.php">Login</a></li>
                            <li><a class="dropdown-item" href="Login_page/signup.php">SignUp</a></li>
                            <li><a class="dropdown-item" href="previousorders/previousorders.php">Previous Orders</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../config/logout.php">Logout</a></li>
                </ul>
                <div class="searchsectionwrappernav">
                    <section class="searchsectionnav">
                        <form>
                            <img src="./productspage/categoryimages/search.png" alt="Search Icon" />
                            <input type="text" placeholder="Search" id="inputsearchnav" autocomplete="off" />
                        </form>
                        <div class="optionboxnav"></div>
                    </section>
                </div>
                <div class="cart-btn">
                    <a href="../checkoutpage/cart.php"><i class="fas fa-shopping-bag"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Bootstrap scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
