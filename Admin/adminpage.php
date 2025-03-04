<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Login_page/login.php");
    exit();
}

include('../config/db.php');
include_once('../navbar.php');

// Fetch all products
$query = "
    SELECT p.product_id, p.product_title, pv.prod_variant_id, pv.image, pv.price, s.size_name, ca.category_name
    FROM products p
    JOIN product_variants pv ON p.product_id = pv.product_id
    JOIN product_categories ca ON pv.category_id = ca.category_id
    LEFT JOIN product_sizes s ON pv.size_id = s.size_id
    ORDER BY RAND()
    LIMIT 8
";
$products = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeviceDirect | Home</title>
    <link rel="stylesheet" href="../assests/css/style.css?v=<?php echo time(); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <?php include 'adminnav.php'; ?>
    <!-- Navbar -->
    
    <!-- Home Content -->
    <section class="home">
        <div class="content">
            <h1>Latest Tech <span id="span2">Unbeatable Prices!</span></h1>
            <p>Found it cheaper? We will match it! <br>We will price match against any other UK retailer.</p>
            <div class="btn">
                <a href="../productspage/index.php"> <button>Shop Now</button></a>
            </div>
        </div>
        <div class="img">
            <img src="../assests/images/image1.png" alt="">
        </div>
    </section>
    <!-- product cards -->
    <div class="container" id="product-cards">
      <h1 class="text-center" style="color: rgb(21, 120, 218)">
        Discover our amazing
        <span style="color: black">Black Friday</span> offers!!
      </h1>
      <div class="row" style="margin-top: 30px">
        <!-- product cards -->
        <div class="row">
                <?php if ($products): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-md-3 py-3 py-md-0">
                            <div class="card">
                                <img src="../productspage/images/<?= htmlspecialchars($product['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['product_title']) ?>">
                                <div class="card-body">
                                    <a href="../productspage/product_details.php?variant_id=<?= $product['prod_variant_id']?>" style="text-decoration: none; color: inherit">
                                        <h3 class="text-center"> <?= htmlspecialchars($product['product_title']) ?> </h3>
                                    </a>
                                    <div class="star text-center">
                                        <i class="fa-solid fa-star unchecked"></i>
                                        <i class="fa-solid fa-star unchecked"></i>
                                        <i class="fa-solid fa-star unchecked"></i>
                                        <i class="fa-solid fa-star unchecked"></i>
                                        <i class="fa-solid fa-star unchecked"></i>
                                    </div>
                                    <h2>
                                        <del>£<?= number_format($product['price'] + 50, 2) ?></del>
                                        £<?= number_format($product['price'], 2) ?>
                                        <span><li class="fa-solid fa-cart-shopping"></li></span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center">No products found.</p>
                <?php endif; ?>
            </div>

        </div>
        <!-- product cards -->

    </div>
    <!-- product cards -->

    <!-- other cards -->
    <div class="container" id="other-cards">
      <div class="row">
        <div class="col-md-6 py-3 py-md-0">
          <div class="card">
            <img src="../assests/images/c1.png" alt="" />
            <div class="card-img-overlay">
              <h3>Best Laptop</h3>
              <h5>Latest Collection</h5>
              <p>Up To 50% Off</p>
              <a href="../productspage/index.php?category_id=3&size=&min_price=&max_price=">
                <button id="shopnow">Shop Now</button></a
              >
            </div>
          </div>
        </div>
        <div class="col-md-6 py-3 py-md-0">
          <div class="card">
            <img src="../assests/images/c2.png" alt="" />
            <div class="card-img-overlay">
              <h3>Best Headphone</h3>
              <h5>Latest Collection</h5>
              <p>Up To 50% Off</p>
              <a href="../productspage/index.php?category_id=4&size=&min_price=0&max_price=0">
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
          Device Direct can GUARUNTEE better prices and quality than our competitors! <br />Whether you're upgrading your smartphone, buying the
          newest gaming console,<br />
          or looking for the perfect gift, our collection has something for
          everyone.
        </p>
        <div class="btn">
          <a href="../productspage\index.php"> <button>Shop Now</button></a>
        </div>
      </div>
      <div class="img">
        <img src="../assests/images/image1.png" alt="" />
      </div>
    </section>
    <!-- banner -->

    <!-- other cards -->
    <div class="container" id="other">
      <div class="row">
        <div class="col-md-4 py-3 py-md-0">
          <div class="card">
            <img src="../assests/images/c3.png" alt="" />
            <div class="card-img-overlay">
              <h3>Home Gadget</h3>
              <p>Latest collection Up To 50% Off</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 py-3 py-md-0">
          <div class="card">
            <img src="../assests/images/c4.png" alt="" />
            <div class="card-img-overlay">
              <h3>Gaming Gadget</h3>
              <p>Latest collection Up To 50% Off</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 py-3 py-md-0">
          <div class="card">
            <img src="../assests/images/c5.png" alt="" />
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

   <!-- footer -->
    <?php include '../footer.php'; ?>
   <!-- footer -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
