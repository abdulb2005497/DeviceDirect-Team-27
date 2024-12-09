<?php
if (session_status() == PHP_SESSION_NONE) 
{ session_start();}      if (!isset($_SESSION['user_id'])) {
    header("Location: Login_page/login.php");
    exit(); }
$welcome_message = "Welcome, " . htmlspecialchars($_SESSION['first_name']);
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

    <link rel="stylesheet" href="headphonestyle.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    />
    <!-- bootstrap links -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <!-- bootstrap links -->
    <!-- fonts links -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap"
      rel="stylesheet"
    />
    <!-- fonts links -->
  </head>
  <body>
   <!-- navbar -->
  <nav class="navbar navbar-expand-lg" id="navbar">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php" id="logo">
          <img
            src="../../../assests/images/device_direct_logo.png"
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
            ><img src="../../../assests/images/menu.png" alt="" width="30px"
          /></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a
                class="nav-link active"
                aria-current="page"
                href="../../../index.php"
                >Home</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../index.php">Shop</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../../aboutuspage/aboutus.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../../contactuspage/contactus.php"
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
                  <a class="dropdown-item" href="../../../Login_page/login.php"
                    >Login</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="../../../Login_page/signup.php"
                    >SignUp</a
                  >
                </li>
                <li>
                  <a
                    class="dropdown-item"
                    href="../../../previousorders/previousorders.php"
                    >Previous Orders</a
                  >
                </li>
              </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="../../../config/logout.php">Logout</a></li>
          </ul>
          
          <div class="cart-btn">
            <a href="../../../checkoutpage/cart.php"
              ><i class="fas fa-shopping-bag"></i
            ></a>
          </div>
        </div>
      </div>
    </nav>
    <!-- navbar -->
    <hr />
    <h3
      style="
        text-align: center;
        font-weight: 600;
        margin-top: 20px;
        margin-bottom: 15px;
      "
    ></h3>

    <section id="details" class="diffitems">
      <div class="mainimage">
        <img
          src="Headphones/overeargrey.webp"
          width="100%"
          id="normal"
          alt=""
        />
        <div class="secimages">
          <div class="secimagescols"></div>
          <div class="secimagescols"></div>
        </div>
      </div>
      <div class="maindescription">
        <br />
        <h4 id="pname">Over Ear Grey Headphones</h4>
        <br />
        <h2 id="pprice"><del>£40.99</del> £30.99</h2>
        <br />
        <!--<select id="colourselector"> 
            <option value="Black">Black </option>
            <option value="White">White</option>
           </select>-->
        <input type="number" value="1" />
        <br />
        <br />
        <a href="../../../checkoutpage/cart.php"><button class="cartclass">Add to Cart</button></a>
        <br />
        <br />
        <h4 id="pdescriptionheading">
          Product Description: Over Ear Grey Headphones
        </h4>
        <br />
        <span id="pdescription"
          >Experience premium sound and ultimate comfort with these over-ear
          headphones in grey. Featuring soft, cushioned ear cups and an
          adjustable headband, they’re designed for extended wear without
          fatigue. The advanced audio drivers deliver immersive, high-definition
          sound with deep bass and crisp detail, perfect for audiophiles and
          professionals alike. The sleek grey finish adds a modern touch to
          these versatile headphones, making them a stylish choice for any
          setting.</span
        >
      </div>
    </section>

    <hr />
  <!-- footer -->
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
              <h4>Usefull Links</h4>
              <ul>
                <li><a href="../../../index.php">Home</a></li>
                <li><a href="../../../aboutuspage/aboutus.php">About Us</a></li>
                <li><a href="../../../config/logout.php">Logout</a></li>
                <li>
                  <a href="../../../productspage/index.php">Shop Now</a>
                </li>
                <li><a href="../../../contactuspage/contactus.php">Contact Us</a></li>
              </ul>
            </div>

            <div class="col-lg-3 col-md-6 footer-links">
              <h4>Our Services</h4>

              <ul>
                <li>
                  <a href="/DeviceDirect-Team-27/productspage/pagescode/consolescode/consoles.php"
                    >Gaming Consoles</a
                  >
                </li>
                <li>
                  <a href="/DeviceDirect-Team-27/productspage/pagescode/tvcode/tvs.php">TVs</a>
                </li>
                <li>
                  <a href="/DeviceDirect-Team-27/productspage/pagescode/laptopscode/laptops.php"
                    >Laptops</a
                  >
                </li>
                <li>
                  <a href="/DeviceDirect-Team-27/productspage/pagescode/monitorscode/monitors.php"
                    >Monitors</a
                  >
                </li>
                <li>
                  <a
                    href="/DeviceDirect-Team-27/productspage/pagescode/headphonescode/headphones.php"
                    >Headphones</a
                  >
                </li>
              </ul>
            </div>

            <div class="col-lg-3 col-md-6 footer-links">
              <h4>Our Social</h4>
              <div class="socail-links mt-3">
                <a href="https://x.com/?lang=en"><i class="fa-brands fa-twitter"></i></a>
                <a href="https://www.facebook.com/"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a>
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
    <script src="headphonescript.js"></script>
    <!--nav account dropdown -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <!--nav account dropdown -->
  </body>
</html>
