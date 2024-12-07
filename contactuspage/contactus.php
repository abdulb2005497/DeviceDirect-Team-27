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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DeviceDirect</title>
    <link rel="stylesheet" href="style.css" />
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
    
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap"
      rel="stylesheet"
    />
    
    <style>
      
      #modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
      }
      #modalContent {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        width: 300px;
      }
      #modalContent h2 {
        margin: 0;
      }
      #modalContent p {
        margin: 10px 0;
      }
      .btn-close {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
      }
      .btn-close:hover {
        background-color: #0056b3;
      }
    </style>
  </head>
  <body>
  
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
              </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="..\config\logout.php">Logout</a></li>
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
    

    <main>
      <section class="contact-section">
        <div class="container">
          <h2>Contact Us</h2>
          <p>
            Have questions or need assistance? Reach out to us using the form
            below.
          </p>
          <form id="contactForm" action="#" method="post">
            <div class="form-group">
              <label for="name">Full Name</label>
              <input
                type="text"
                id="name"
                name="name"
                placeholder="Enter your full name"
                required
              />
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input
                type="email"
                id="email"
                name="email"
                placeholder="Enter your email"
                required
              />
            </div>
            <div class="form-group">
              <label for="message">Message</label>
              <textarea
                id="message"
                name="message"
                placeholder="Write your message or enquiry"
                rows="5"
                required
              ></textarea>
            </div>
            <button type="submit" class="btn">Submit</button>
          </form>
        </div>
      </section>
    </main>

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
      <hr />
      <div class="container py-4">
        <div class="copyright">
          &copy; Copyright <strong><span>Device Direct Shop</span></strong
          >. All Rights Reserved
        </div>
      </div>
    </footer>
    <!-- footer -->

    <!-- Modal for Success Message -->
    <div id="modal">
      <div id="modalContent">
        <h2>Thank You!</h2>
        <p>Your message has been successfully sent.</p>
        <p><strong>We'll get back to you soon.</strong></p>
        <button class="btn-close" id="closeModal">Close</button>
      </div>
    </div>

    <script>
      document
        .getElementById("contactForm")
        .addEventListener("submit", function (e) {
          e.preventDefault(); // Prevent form submission

          const name = document.getElementById("name").value;
          const email = document.getElementById("email").value;
          const message = document.getElementById("message").value;

          // Show the modal with the user's data
          document.getElementById("modal").style.display = "flex";
          document.getElementById("modalContent").innerHTML = `
        <h2>Thank You, ${name}!</h2>
        <p>Your message has been received.</p>
        <p><strong>Email:</strong> ${email}</p>
        <p><strong>Message:</strong> ${message}</p>
        <button class="btn-close" id="closeModal">Close</button>
      `;

          // Reset the form
          document.getElementById("contactForm").reset();
        });

      // Close the modal
      document.getElementById("modal").addEventListener("click", function (e) {
        if (
          e.target === document.getElementById("modal") ||
          e.target.id === "closeModal"
        ) {
          document.getElementById("modal").style.display = "none";
        }
      });
    </script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
