
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
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style_cart.css">
    <title></title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
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
 </head>
 <body>
<!-- Navbar -->
<?php include $_SERVER['DOCUMENT_ROOT'] . "../DeviceDirect-Team-27/navbar.php"; ?>
<!-- Navbar -->


    <div class="cart-container">
        <h1>WISHLIST</h1>

        <div class="cart-layout">
          <!-- These are placeholders will later be replaced with php code pulling the data from the database-->
            <div class="cart-items">
                <div class="cart-item">
                    <img src="../productspage/pagescode/tvcode/TVs/40inch/4K-40-Black.webp" alt="">
                    <div class="cart-details">
                        <p>Product Title</p>
                        <p>Product Colour</p>
                        <p>Price</p>
                        <button type="button" name="button">x</button>
                    </div>
                </div>
                <div class="cart-item">
                    <img src="../productspage/pagescode/tvcode/TVs/40inch/4K-40-Black.webp" alt="">
                    <div class="cart-details">
                        <p>Product Title</p>
                        <p>Product Colour</p>
                        <p>Price</p>
                        <button type="button" name="button">x</button>
                    </div>
                </div>
            </div>

     
        </div>
    </div>
    </form>
    <footer class="">

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
                  <li><a href="/Landing-Page/index.html">Home</a></li>
                  <li><a href="/aboutuspage/aboutus.html">About Us</a></li>
                  <li><a href="/loginpage/login.html">Account</a></li>
                  <li>
                    <a href="/productspage/index.html">Shop Now</a>
                  </li>
                  <li><a href="/contactuspage/contactus.html">Contact Us</a></li>
                </ul>
              </div>
  
              <div class="col-lg-3 col-md-6 footer-links">
                <h4>Our Services</h4>
  
                <ul>
                  <li>
                    <a href="/productspage/pagescode/consolescode/consoles.html"
                      >Gaming Consoles</a
                    >
                  </li>
                  <li>
                    <a href="/productspage/pagescode/tvcode/tvs.html">TVs</a>
                  </li>
                  <li>
                    <a href="/productspage/pagescode/laptopscode/laptops.html"
                      >Laptops</a
                    >
                  </li>
                  <li>
                    <a href="/productspage/pagescode/monitorscode/monitors.html"
                      >Monitors</a
                    >
                  </li>
                  <li>
                    <a
                      href="/productspage/pagescode/headphonescode/headphones.html"
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
        <hr/>
        <div class="container py-4">
          <div class="copyright">
            &copy; Copyright <strong><span>Device Direct Shop</span></strong
            >. All Rights Reserved
          </div>
        </div>
      </footer>
      <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    </body>
</html>
