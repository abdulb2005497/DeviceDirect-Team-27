<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Login_page/login.php");
    exit();
}

include('../config/db.php');
$welcome_message = "Welcome, " . htmlspecialchars($_SESSION['first_name']);

$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;

if ($category_id) {
    $query = "
        SELECT p.product_id, p.product_title, pv.image, pv.price, ca.category_name
        FROM products p
        JOIN product_variants pv ON p.product_id = pv.product_id
        JOIN product_categories ca ON pv.category_id = ca.category_id
        WHERE pv.category_id = :category_id
        GROUP BY p.product_id
    ";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
} else {
    $query = "
        SELECT p.product_id, p.product_title, pv.image, pv.price, ca.category_name
        FROM products p
        JOIN product_variants pv ON p.product_id = pv.product_id
        JOIN product_categories ca ON pv.category_id = ca.category_id
        GROUP BY p.product_id
    ";
    $stmt = $pdo->prepare($query);
}

$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

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
            <li class="nav-item"><a class="nav-link" href="config/logout.php">Logout</a></li>
          </ul>
         <!-- <form class="d-flex" id="search">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <button class="btn btn-outline-success" type="submit">
              Search
            </button>
          </form> -->
          <div class="searchsectionwrappernav">
  <section class="searchsectionnav">
    <form>
      <img src="../productspage/categoryimages/search.png" alt="Search Icon" />
      <input type="text" placeholder="Search" id="inputsearchnav" autocomplete="off" />
    </form>
    <div class="optionboxnav"></div>
  </section>
</div>




          <div class="cart-btn">
            <a href="../checkoutpage/cart.php"
              ><i class="fas fa-shopping-bag"></i
            ></a>
          </div>
        </div>
      </div>
    </nav>
    <!-- navbar -->
    <h3
      style="
        text-align: center;
        font-weight: 600;
        margin-top: 20px;
        margin-bottom: 15px;
      "
    >

    <h3
      style="
        text-align: center;
        font-weight: 600;
        margin-top: 20px;
        margin-bottom: 15px;
      "
    >
Store page    </h3>

<div class="store-container">
      <h3 class="text-center">Store Page</h3>
      <div class="row">
          <?php if ($products): ?>
              <?php foreach ($products as $product): ?>
                  <div class="col-md-4 mb-4">
                      <div class="card h-100">
                        <img src="images/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['product_title']) ?>">
                          <div class="card-body">
                              <h5 class="card-title"> <?= htmlspecialchars($product['product_title']) ?> </h5>
                              <p class="card-text">Category: <?= htmlspecialchars($product['category_name']) ?></p>
                              <p class="card-text">Price: $<?= number_format($product['price'], 2) ?></p>
                              <a href="product_details.php?product_id=<?= $product['product_id'] ?>" class="btn btn-primary">View Details</a>
                              <a href="../wishlist/wishlist.php $product['product_id'] ?>" class="btn btn-secondary">Save to My Wishlist</a>
                          </div>
                      </div>
                  </div>
              <?php endforeach; ?>
          <?php else: ?>
              <p class="text-center">No products found.</p>
          <?php endif; ?>
  </div>
</div>



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

    <script src="script.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
