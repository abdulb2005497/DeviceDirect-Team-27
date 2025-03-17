<?php
session_start();
include_once '../config/db.php';
include_once 'wishlist_functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?error=Please log in first");
    exit();
}

$user_id = $_SESSION['user_id'];
$wishlistItems = getWishlistItems($pdo, $user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Wishlist</title>
    <link rel="stylesheet" href="style_wishlist.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
          <a class="navbar-brand" href="../index.php">
              <img src="../assets/images/device_direct_logo.png" alt="Device Direct Logo" class="logo-img">
              <span>D</span>evice <span>Direct</span>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
              <span><img src="../assets/images/menu.png" alt="Menu" width="30px"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                  <li class="nav-item"><a class="nav-link" href="../productspage/index.php">Shop</a></li>
                  <li class="nav-item"><a class="nav-link" href="../aboutuspage/aboutus.php">About</a></li>
                  <li class="nav-item"><a class="nav-link" href="../contactuspage/contactus.php">Contact</a></li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown">Account</a>
                      <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="../Login_page/login.php">Login</a></li>
                          <li><a class="dropdown-item" href="../Login_page/signup.php">Sign Up</a></li>
                          <li><a class="dropdown-item" href="../previousorders/previousorders.php">Previous Orders</a></li>
                          <li><a class="dropdown-item active" href="wishlist.php">My Wishlist</a></li>
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

  <div class="wishlist-container">
      <h1>My Wishlist</h1>
      <?php if (!empty($wishlistItems)): ?>
          <?php foreach ($wishlistItems as $item): ?>
              <div class="wishlist-item">
                  <img src="../productspage/images/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['product_title']); ?>" class="wishlist-item-img">
                  <div class="wishlist-item-details">
                      <p class="product-title"><?php echo htmlspecialchars($item['product_title']); ?></p>
                      <p class="product-price">£<?php echo number_format($item['price'], 2); ?></p>
                      <form action="add_to_cart.php" method="post">
                          <input type="hidden" name="prod_variant_id" value="<?php echo $item['prod_variant_id']; ?>">
                          <button type="submit" class="wishlist-add-btn">Add to Cart</button>
                      </form>
                      <form action="remove_wishlist_item.php" method="post">
                          <input type="hidden" name="prod_variant_id" value="<?php echo $item['prod_variant_id']; ?>">
                          <button type="submit" class="wishlist-remove-btn">Remove</button>
                      </form>
                  </div>
              </div>
          <?php endforeach; ?>
      <?php else: ?>
          <p>Your wishlist is empty. <a href="../productspage/index.php">Start shopping now!</a></p>
      <?php endif; ?>
  </div>

  <footer>
      <div class="container">
          <div class="copyright">
              &copy; 2024 Device Direct. All Rights Reserved.
          </div>
      </div>
  </footer>

</body>
</html>
