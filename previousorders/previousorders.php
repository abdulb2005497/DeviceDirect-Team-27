<?php
session_start();
require '../config/db.php'; 
include_once('../navbar.php');


if (!isset($_SESSION['user_id'])) {
    header("Location: ../Login_page/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$welcome_message = "Welcome, " . htmlspecialchars($_SESSION['first_name']);

// Fetch user orders
$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY date_ordered DESC");
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style_orders.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../contactuspage/style.css">
    <!-- bootstrap links -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
   <!-- fonts links -->
   <link rel="preconnect" href="https://fonts.googleapis.com" />
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
   <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet" />

</head>
<body>


<div class="container mt-5">
    <h2 class="text-center">My Orders</h2>
    <div class="row">
        <?php if (count($orders) > 0): ?>
            <?php foreach ($orders as $order): ?>
                <div class="col-md-6">
                    <div class="order-card">
                        <h4>Order #<?php echo $order['order_id']; ?></h4>
                        <p><strong>Total Price:</strong> $<?php echo number_format($order['total_price'], 2); ?></p>
                        <p><strong>Status:</strong> <?php echo ucfirst($order['status']); ?></p>
                        <p><strong>Date Ordered:</strong> <?php echo $order['date_ordered']; ?></p>
                        <a href="order_details.php?order_id=<?php echo $order['order_id']; ?>" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">You have no orders yet.</p>
        <?php endif; ?>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>