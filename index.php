<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['user_id'])) {
    header("Location: Login_page/login.php");
    exit();
}


$welcome_message = "Hi, " . htmlspecialchars($_SESSION['first_name']);
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
    <div class="text-center welcome-message">
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
    <!-- product cards -->
    <div class="container" id="product-cards">
      <h1 class="text-center" style="color: rgb(21, 120, 218)">
        Discover our amazing
        <span style="color: black">Black Friday</span> offers!!
      </h1>
      <div class="row" style="margin-top: 30px">
        <!-- product card 1 -->
        <div class="col-md-3 py-3 py-md-0">
          <div class="card">
            <img
              src="productspage/pagescode/tvcode/TVs/40inch/HD-40-Black.webp"
              alt=""
            />
            <div class="card-body">
              <a
                href="productspage/pagescode/tvcode/tvs-HD40.html"
                style="text-decoration: none; color: inherit"
              >
                <h3 class="text-center">HD 40 Inch Black TV</h3>
              </a>
              <div class="star text-center">
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
              </div>
              <h2>
                <del>£199.99</del> £99.99
                <span><li class="fa-solid fa-cart-shopping"></li></span>
              </h2>
            </div>
          </div>
        </div>
        <!-- product card 1 -->

        <!-- product card 2 -->
        <div class="col-md-3 py-3 py-md-0">
          <div class="card">
            <img
              src="productspage/pagescode/headphonescode/Headphones/overeargrey.webp"
              alt=""
            />
            <div class="card-body">
              <a
                href="productspage/pagescode/headphonescode/overeargrey.html"
                style="text-decoration: none; color: inherit"
              >
                <h3 class="text-center">Over Ear Grey Headphones</h3>
              </a>
              <div class="star text-center">
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
              </div>
              <h2>
                <del>£40.99</del> £30.99
                <span><li class="fa-solid fa-cart-shopping"></li></span>
              </h2>
            </div>
          </div>
        </div>
        <!-- product card 2 -->

        <!-- product card 3 -->
        <div class="col-md-3 py-3 py-md-0">
          <div class="card">
            <img
              src="productspage/pagescode/laptopscode/Laptops/16inch/Probook-16-black.webp"
              alt=""
            />
            <div class="card-body">
              <a
                href="productspage/pagescode/laptopscode/laptops-16P.html"
                style="text-decoration: none; color: inherit"
              >
                <h3 class="text-center">16 inch Black Probook</h3>
              </a>
              <div class="star text-center">
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
              </div>
              <h2>
                <del>£499.99</del> £449.99
                <span><li class="fa-solid fa-cart-shopping"></li></span>
              </h2>
            </div>
          </div>
        </div>
        <!-- product card 3 -->

        <!-- product card 4 -->
        <div class="col-md-3 py-3 py-md-0">
          <div class="card">
            <img
              src="productspage/pagescode/monitorscode/Monitors/30inch/4k-30-White.webp"
              alt=""
            />
            <div class="card-body">
              <a
                href="productspage/pagescode/monitorscode/monitors-4K30.html"
                style="text-decoration: none; color: inherit"
              >
                <h3 class="text-center">30 Inch White Monitor 4K</h3>
              </a>
              <div class="star text-center">
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
              </div>
              <h2>
                <del>£259.99</del> £209.99
                <span><li class="fa-solid fa-cart-shopping"></li></span>
              </h2>
            </div>
          </div>
        </div>
      </div>
      <!-- product card 4 -->

      <!-- product card 5 -->
      <div class="row" style="margin-top: 30px">
        <div class="col-md-3 py-3 py-md-0">
          <div class="card">
            <img
              src="productspage/pagescode/consolescode/Consoles/PS5/PS5 White.webp"
              alt=""
            />
            <div class="card-body">
              <a
                href="productspage/pagescode/consolescode/ps5.html"
                style="text-decoration: none; color: inherit"
              >
                <h3 class="text-center">Playstation 5</h3>
              </a>
              <div class="star text-center">
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
              </div>
              <h2>
                <del>£259.99</del> £159.99
                <span><li class="fa-solid fa-cart-shopping"></li></span>
              </h2>
            </div>
          </div>
        </div>
        <!-- product card 5 -->

        <!-- product card 6 -->
        <div class="col-md-3 py-3 py-md-0">
          <div class="card">
            <img
              src="productspage/pagescode/tvcode/TVs/80inch/4k-80-Black.webp"
              alt=""
            />
            <div class="card-body">
              <a
                href="productspage/pagescode/consolescode/ps5.html"
                style="text-decoration: none; color: inherit"
              >
                <h3 class="text-center">80-Inch Black TV 4k</h3>
              </a>
              <div class="star text-center">
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
              </div>
              <h2>
                <del>£349.99</del> £299.99
                <span><li class="fa-solid fa-cart-shopping"></li></span>
              </h2>
            </div>
          </div>
        </div>
        <!-- product card 6 -->

        <!-- product card 7 -->
        <div class="col-md-3 py-3 py-md-0">
          <div class="card">
            <img
              src="productspage/pagescode/laptopscode/Laptops/16inch/Windows-16-White.webp"
              alt=""
            />
            <div class="card-body">
              <a
                href="productspage/pagescode/laptopscode/laptops-16W.html"
                style="text-decoration: none; color: inherit"
              >
                <h3 class="text-center">16 inch Windows Laptop</h3>
              </a>
              <div class="star text-center">
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
              </div>
              <h2>
                <del>£449.99</del> £399.99
                <span><li class="fa-solid fa-cart-shopping"></li></span>
              </h2>
            </div>
          </div>
        </div>
        <!-- product card 7 -->

        <!-- product card 8 -->
        <div class="col-md-3 py-3 py-md-0">
          <div class="card">
            <img
              src="productspage/pagescode/headphonescode/Headphones/inearblack.webp"
              alt=""
            />
            <div class="card-body">
              <a
                href="productspage/pagescode/laptopscode/laptops-16W.html"
                style="text-decoration: none; color: inherit"
              >
                <h3 class="text-center">In Ear Black Headphones</h3>
              </a>
              <div class="star text-center">
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
                <i class="fa-solid fa-star unchecked"></i>
              </div>
              <h2>
                <del>£20.99</del> £15.99
                <span><li class="fa-solid fa-cart-shopping"></li></span>
              </h2>
            </div>
          </div>
        </div>
      </div>
      <!-- product card 8 -->
    </div>
    <!-- product cards -->

    <!-- other cards -->
    <div class="container" id="other-cards">
      <div class="row">
        <div class="col-md-6 py-3 py-md-0">
          <div class="card">
            <img src="./assests/images/c1.png" alt="" />
            <div class="card-img-overlay">
              <h3>Best Laptop</h3>
              <h5>Latest Collection</h5>
              <p>Up To 50% Off</p>
              <a href="productspage/pagescode/laptopscode/laptops.html">
                <button id="shopnow">Shop Now</button></a
              >
            </div>
          </div>
        </div>
        <div class="col-md-6 py-3 py-md-0">
          <div class="card">
            <img src="./assests/images/c2.png" alt="" />
            <div class="card-img-overlay">
              <h3>Best Headphone</h3>
              <h5>Latest Collection</h5>
              <p>Up To 50% Off</p>
              <a href="productspage/pagescode/headphonescode/headphones.html">
                <button id="shopnow">Shop Now</button></a
              >
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- other cards -->

    <!-- banner -->
    <section class="banner">
      <div class="content">
        <h1>
          <span>Great Deals</span>
          <br />
          Up To <span id="span2">50%</span> Off
        </h1>
        <p>
          Discover unbeatable deals on the latest electronic gadgets at Device
          Direct! <br />Whether you're upgrading your smartphone, buying the
          latest gaming console,<br />
          or looking for the perfect gift, our collection has something for
          everyone.
        </p>
        <div class="btn">
          <a href="/productspage/index.html"> <button>Shop Now</button></a>
        </div>
      </div>
      <div class="img">
        <img src="./assests/images/image1.png" alt="" />
      </div>
    </section>
    <!-- banner -->

    <!-- other cards -->
    <div class="container" id="other">
      <div class="row">
        <div class="col-md-4 py-3 py-md-0">
          <div class="card">
            <img src="./assests/images/c3.png" alt="" />
            <div class="card-img-overlay">
              <h3>Home Gadget</h3>
              <p>Latest collection Up To 50% Off</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 py-3 py-md-0">
          <div class="card">
            <img src="./assests/images/c4.png" alt="" />
            <div class="card-img-overlay">
              <h3>Gaming Gadget</h3>
              <p>Latest collection Up To 50% Off</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 py-3 py-md-0">
          <div class="card">
            <img src="./assests/images/c5.png" alt="" />
            <div class="card-img-overlay">
              <h3>Electronic Gadget</h3>
              <p>Latest collection Up To 50% Off</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- other cards -->

    <!-- offer -->
    <div class="container" id="offer">
      <div class="row">
        <div class="col-md-3 py-3 py-md-0">
          <i class="fa-solid fa-cart-shopping"></i>
          <h3>Free Shipping</h3>
          <p>On order over £200</p>
        </div>
        <div class="col-md-3 py-3 py-md-0">
          <i class="fa-solid fa-rotate-left"></i>
          <h3>Free Returns</h3>
          <p>Within 30 days</p>
        </div>
        <div class="col-md-3 py-3 py-md-0">
          <i class="fa-solid fa-truck"></i>
          <h3>Fast Delivery</h3>
          <p>World Wide</p>
        </div>
        <div class="col-md-3 py-3 py-md-0">
          <i class="fa-solid fa-thumbs-up"></i>
          <h3>Big choice</h3>
          <p>Of products</p>
        </div>
      </div>
    </div>
    <!-- offer -->

    <!-- newslater -->
    <div class="container" id="newslater">
      <h3 class="text-center">
        Subscribe To Our Newsletter So You Can Get Our Latest Deals.
      </h3>
      <div class="input text-center">
        <input type="text" placeholder="Enter Your Email.." />
        <button id="subscribe">SUBSCRIBE</button>
      </div>
    </div>
    <!-- newslater -->


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
