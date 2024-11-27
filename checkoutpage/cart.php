
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style_cart.css">
    <title></title>
  </head>
  <body>

    <div class="cart-container">
        <h1>CART PAGE</h1>

        <div class="cart-layout">
          <!-- These are placeholders will later be replaced with php code pulling the data from the database-->
            <div class="cart-items">
                <div class="cart-item">
                    <img src="images/monitor.jpg" alt="">
                    <div class="cart-details">
                        <p>Product Title</p>
                        <p>Product Colour</p>
                        <p>Price</p>
                        <button type="button" name="button">x</button>
                    </div>
                </div>
                <div class="cart-item">
                    <img src="images/monitor.jpg" alt="">
                    <div class="cart-details">
                        <p>Product Title</p>
                        <p>Product Colour</p>
                        <p>Price</p>
                        <button type="button" name="button">x</button>
                    </div>
                </div>
            </div>

            <!-- Placeholder until php is complete -->
            <div class="checkout-summary">
                <h2>Checkout Summary</h2>
                <p>Total: £519.97</p>
                <p>Shipping: Free</p>
                <p>Total: £519.97</p>
                <button class="checkout-btn">Checkout</button>
                <button class="paypal-btn">Pay with PayPal</button>
                <h3>Discount code:</h3>
                <form class="discount-code" action="index.html" method="post">
                  <input type="text" name="" placeholder="Enter code here">
                </form>
            </div>
        </div>
        <a href="wishlist.php">Enter wishlist</a>
    </div>
    </form>
  </body>
</html>
