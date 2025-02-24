<?php
session_start();
include_once '../config/db.php';
include_once 'cart_functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?error=Please log in first");
    exit();
}

$user_id = $_SESSION['user_id'];
$cartItems = getCartItems($pdo, $user_id);
$totalAmount = calculate_total($pdo, $_SESSION['user_id']);

$_SESSION['total_price'] = $totalAmount;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style_cart.css">
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
              <img src="../assests/images/device_direct_logo.png" alt="Device Direct Logo" class="logo-img" />
              <span id="span1">D</span>evice <span>Direct</span></a
          >
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span><img src="./assests/images/menu.png" alt="" width="30px" /></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="../productspage/index.php">Shop</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="../aboutuspage/aboutus.php">About</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="../contactuspage/contactus.php">Contact</a>
                  </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: rgb(67 0 86)">
                          <li><a class="dropdown-item" href="../Login_page/login.php">Login</a></li>
                          <li><a class="dropdown-item" href="../Login_page/signup.php">SignUp</a></li>
                          <li><a class="dropdown-item" href="../previousorders/previousorders.php">Previous Orders</a></li>
                          <li><a class="dropdown-item" href="wishlist.php">My Wishlist</a></li>
                      </ul>
                  </li>
                  <li class="nav-item"><a class="nav-link" href="../config/logout.php">Logout</a></li>
              </ul>

              <div class="cart-btn">
                  <a href="../checkoutpage/cart.php"><i class="fas fa-shopping-bag"></i></a>
              </div>
          </div>
      </div>
  </nav>
    <div class="cart-container">
        <div class="cart-items-section">
            <h1>My Cart</h1>
            <?php if (!empty($cartItems)): ?>
                <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item">
                        <img src="../productspage/images/<?php echo $item['image']; ?>" alt="<?php echo $item['product_title']; ?>" class="cart-item-img">
                        <div class="cart-item-details">
                            <p class="product-title"><?php echo $item['product_title']; ?></p>
                            <p class="product-price">£<?php echo number_format($item['price'], 2); ?></p>
                            <form action="update_cart.php" method="post" class="quantity-form">
                                <input type="hidden" name="prod_variant_id" value="<?php echo $item['prod_variant_id']; ?>">
                                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="quantity-input">
                                <button type="submit" name="update_quantity" class="update-btn">Update</button>
                            </form>
                            <form action="remove_item.php" method="post" class="remove-form">
                                <input type="hidden" name="prod_variant_id" value="<?php echo $item['prod_variant_id']; ?>">
                                <button type="submit" name="remove_item" class="remove-btn">Remove</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>
        </div>

        <div class="cart-summary">
            <h2>Total</h2>
            <p>Subtotal: £<?php echo number_format($totalAmount, 2); ?></p>
            <p c>Delivery: <span class="free-shipping">Standard Delivery (Free)</span></p>
            <br><hr><br>
            <p>Total: £<?php echo number_format($totalAmount, 2); ?></p>

            <button class="checkout-btn" onclick="window.location.href='checkout.php'">Checkout</button>
            </div>
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

</body>

</html>
