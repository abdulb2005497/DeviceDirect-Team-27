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

include_once '../navbar.php';
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
            <p>Delivery: <span class="free-shipping">Standard Delivery (Free)</span></p>
            <form id="discount-form">
                <label for="discount_code">Discount Code:</label>
                <input type="text" id="discount_code" name="discount_code" class="discount-input">
                <button type="button" id="apply-discount-btn" class="apply-discount-btn">Apply</button>
            </form>
            <p id="discount-message"></p>
            <hr>
            <p>Total: £<span id="total_price"><?php echo number_format($totalAmount, 2); ?></span></p>

            <button class="checkout-btn" id="checkout-btn" onclick="window.location.href='checkout.php'" <?php echo empty($cartItems) ? 'disabled' : ''; ?>>Checkout</button>
        </div>
    </div>

   <!-- footer -->
       <?php include '../footer.php'; ?>
   <!-- footer -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMzT4K+gT9TnL3L2WsmRN8Q6PTg9vLUz59vFlY5fw3zj0o9A6R9zJ6gI65g" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhG0grQ603jE1RUizG9BKA7YIv7pVZHt9YjM9XItGoj6g9q8zRT3GJ8lq2z4" crossorigin="anonymous"></script>
</body>
</html>

<script>
document.addEventListener("DOMContentLoaded", function () {
    var dropdownElementList = document.querySelectorAll('.dropdown-toggle');
    dropdownElementList.forEach(function(dropdownToggleEl) {
        new bootstrap.Dropdown(dropdownToggleEl);
    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let checkoutBtn = document.getElementById("checkout-btn");

    // Check if cart items exist
    let cartItems = document.querySelectorAll(".cart-item").length;

    if (cartItems === 0) {
        checkoutBtn.disabled = true;
        checkoutBtn.style.opacity = "0.5"; // Optional: Make the button look inactive
    }
});
</script>


<script>
document.getElementById('apply-discount-btn').addEventListener('click', function() {
    let discountCode = document.getElementById('discount_code').value;
    let totalPriceElement = document.getElementById('total_price');
    let messageElement = document.getElementById('discount-message');

    fetch('discounts.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'discount_code=' + encodeURIComponent(discountCode)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            totalPriceElement.innerText = data.new_total;
            messageElement.innerText = data.message;
            messageElement.style.color = "green";
        } else {
            messageElement.innerText = data.message;
            messageElement.style.color = "red";
        }
    });
});
</script>



    <!-- footer -->
</body>

</html>
