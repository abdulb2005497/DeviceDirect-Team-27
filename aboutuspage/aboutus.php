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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Us - Device Direct</title>
    <link rel="stylesheet" href="aboutus.css?v=<?php echo time(); ?>">
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
    <link 
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
    rel="stylesheet"
    />
    <!-- fonts links -->

    
  </head>
  <body>
<!-- Navbar -->
<?php include $_SERVER['DOCUMENT_ROOT'] . "../DeviceDirect-Team-27/navbar.php"; ?>
<!-- Navbar -->
    <!--Hero Section-->
    <section id="hero">
      <div class="hero-bg">
        <img
          src="../Landing-Page/assests/images/about-hero.png"
          alt="About Us Banner"
        />
      </div>
      <div class="hero-text">
        <h1>About Device Direct</h1>
        <p>The tech you need. At prices you deserve.</p>
      </div>
    </section>
    <!--Hero Section-->

  <!--New Improved Slider-->
  <div class="wrapper">
    <div class="info-slider" id="info-slider"></div>
    <button id="prev">&lt;</button>
    <button id="next">&gt;</button>
  </div>
  <!--New Improved Slider-->

  
  
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


    <a href="#" class="arrow"
      ><i><img src="./assests/images/arrow.png" alt="" /></i
    ></a>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <script src="aboutus.js" defer></script>
  </body>
</html>
