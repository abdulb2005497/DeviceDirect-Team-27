<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: Login_page/login.php");
    exit();
}

$welcome_message = "Welcome, " . htmlspecialchars($_SESSION['first_name']);

// Initialize cart if not already set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle adding product to cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['quantity'];
    $product_colour = $_POST['colour'];

    // Check if the product already exists in the cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $product_id && $item['colour'] == $product_colour) {
            $item['quantity'] += $product_quantity;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = [
            'id' => $product_id,
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => $product_quantity,
            'colour' => $product_colour
        ];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shop</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="consolestyle.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body data-model="xbox1">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php" id="logo">
                <img src="../../../assests/images/device_direct_logo.png" alt="Device Direct Logo" class="logo-img" />
                <span id="span1">D</span>evice <span>Direct</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span><img src="../../../assests/images/menu.png" alt="" width="30px" /></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="../../../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../index.php">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../../aboutuspage/aboutus.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../../contactuspage/contactus.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../../config/logout.php">Logout</a></li>
                </ul>
                <div class="cart-btn"><a href="../../../checkoutpage/cart.php"><i class="fas fa-shopping-bag"></i></a></div>
            </div>
        </div>
    </nav>

    <hr />
    <h3 style="text-align: center; font-weight: 600; margin-top: 20px; margin-bottom: 15px;">Select Your Colour</h3>

    <section id="details" class="diffitems">
        <div class="mainimage">
            <img src="Consoles/xbox/xboxblack.webp" width="100%" id="product-image" alt="Black Xbox One" />
            <div class="secimages">
                <div class="secimagescols"><img src="Consoles/xbox/xboxblack.webp" width="100%" class="smallimg" id="black" /></div>
                <div class="secimagescols"><img src="Consoles/xbox/white.webp" width="100%" class="smallimg" id="white" /></div>
                <div class="secimagescols"><img src="Consoles/xbox/red.webp" width="100%" class="smallimg" id="red" /></div>
            </div>
        </div>
        <div class="maindescription">
            <h4 id="pname">Black Xbox One</h4>
            <h2 id="pprice"><del>£199.99</del> £99.99</h2>
            <form action="xbox1.php" method="POST">
                <select id="colourselector" name="colour" onchange="updateProductDetails()">
                    <option value="Black" data-price="99.99" data-name="Black Xbox One" data-image="Consoles/xbox/xboxblack.webp">Black</option>
                    <option value="White" data-price="109.99" data-name="White Xbox One" data-image="Consoles/xbox/white.webp">White</option>
                    <option value="Red" data-price="109.99" data-name="Red Xbox One" data-image="Consoles/xbox/red.webp">Red</option>
                </select>
                <input type="number" name="quantity" id="quantity" value="1" min="1" required />
                <input type="hidden" name="product_id" value="6" />
                <input type="hidden" name="product_name" id="product_name" value="Black Xbox One" />
                <input type="hidden" name="product_price" id="product_price" value="99.99" />
                <button type="submit" name="add_to_cart" class="cartclass">Add to Cart</button>
            </form>
            <h4 id="pdescriptionheading">Product Description:</h4>
            <span id="pdescription">
              The black Xbox is a powerhouse designed for serious gamers, offering next-gen performance and a sleek, modern aesthetic. With support for 4K gaming, lightning-fast load times, and advanced hardware, it delivers an immersive experience across a wide range of titles. Its bold black finish adds a professional touch to any setup, while its seamless online connectivity ensures smooth multiplayer gameplay. Whether you’re streaming, gaming, or exploring expansive open worlds, the black Xbox delivers flawless performance.
            </span>
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
    <!-- footer -->
    </body>
  </html>



    <script>
        // Update product details dynamically
        function updateProductDetails() {
            const selector = document.getElementById('colourselector');
            const selectedOption = selector.options[selector.selectedIndex];

            // Update displayed details
            document.getElementById('pname').innerText = selectedOption.getAttribute('data-name');
            document.getElementById('pprice').innerText = '£' + selectedOption.getAttribute('data-price');
            document.getElementById('product-image').src = selectedOption.getAttribute('data-image');

            // Update hidden input values
            document.getElementById('product_name').value = selectedOption.getAttribute('data-name');
            document.getElementById('product_price').value = selectedOption.getAttribute('data-price');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
