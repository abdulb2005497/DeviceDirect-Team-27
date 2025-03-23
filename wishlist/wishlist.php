<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once('../navbar.php');
include('../config/db.php');
include('../checkoutpage/cart_functions.php');
include('../wishlist/wishlist_function.php');

if (!isset($_GET['variant_id']) || !is_numeric($_GET['variant_id'])) {
    die("Invalid product variant ID.");
}

$variant_id = intval($_GET['variant_id']);
$user_id = $_SESSION['user_id'] ?? null;
try {
    $query = "
        SELECT
            p.product_title,
            ca.category_name,
            co.colour_name,
            s.size_name,
            pv.prod_variant_id,
            p.prod_desc,
            pv.quantity,
            pv.image,
            pv.price
        FROM product_variants pv
        JOIN products p ON pv.product_id = p.product_id
        JOIN product_categories ca ON pv.category_id = ca.category_id
        JOIN product_colours co ON pv.colour_id = co.colour_id
        JOIN product_sizes s ON pv.size_id = s.size_id
        WHERE pv.prod_variant_id = :variant_id
        LIMIT 1
    ";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':variant_id', $variant_id, PDO::PARAM_INT);
    $stmt->execute();

    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        die("Product variant not found.");
    }

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
$in_wishlist = false;
if ($user_id) {
    $stmt = $pdo->prepare("SELECT 1 FROM wishlist WHERE user_id = ? AND prod_variant_id = ?");
    $stmt->execute([$user_id, $variant_id]);
    $in_wishlist = $stmt->fetch() ? true : false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['product_title']); ?> - Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">


    <!--CSS styling for Reviews section-->

<style>
.reviews-section {
        background-color: #f8f9fa;
        padding: 20px 0;
    }

    .reviews-section .mb-3 {
        background-color: #e9ecef;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .reviews-section .text-muted {
        color: #6c757d !important;
    }

    .reviews-section .text-warning {
        color: #ffc107 !important;
    }

    .reviews-section strong {
        font-size: 1.1em;
        color: #343a40;
    }

    .reviews-section p.mt-2 {
        font-size: 1rem;
        color: #495057;
    }

    .reviews-section small {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .reviews-section .text-muted a {
        color: #007bff;
        text-decoration: none;
    }

    .reviews-section .text-muted a:hover {
        text-decoration: underline;
    }

    .reviews-section form {
        margin-top: 30px;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .reviews-section form .form-label {
        font-weight: bold;
    }

    .reviews-section form .star {
        font-size: 1.5em;
        cursor: pointer;
    }

    .reviews-section form button {
        margin-top: 15px;
    }

    .reviews-section form button:hover {
        background-color: #28a745;
    }
        .reviews-section form .btn-danger {
    background-color: #e9ecef;
    color: #dc3545;
    border: none;
    padding: 0;
    margin: 0;
    box-shadow: none;
    font-size: 0.9rem;
}

.reviews-section form .btn-danger:hover {
    background-color: #e9ecef;
    color: #bd2130;
}
</style>

</head>
<body>

<!-- Product Details Container -->
<div class="container mt-5 product-container">
    <div class="row">
        <div class="col-md-6">
            <img id="product-image" src="../productspage/images/<?php echo htmlspecialchars($product['image']); ?>" class="img-fluid product-image" alt="<?php echo htmlspecialchars($product['product_title']); ?>">
        </div>
        <div class="col-md-6">
            <h2><?php echo htmlspecialchars($product['product_title']); ?></h2>
            <p class="text-muted">Category: <?php echo htmlspecialchars($product['category_name']); ?></p>
            <p class="text-muted">Colour: <?php echo htmlspecialchars($product['colour_name']); ?></p>
            <p class="text-muted">Size: <?php echo htmlspecialchars(string: $product['size_name']); ?></p>
            <h4 id="product-price" class="text-success">Price: £<?php echo number_format($product['price'], 2); ?></h4>
            <form method="post">
                        <input type="hidden" name="variant_id" value="<?php echo $product['prod_variant_id']; ?>">
                        <label for="quantity" class="form-label">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="<?php echo htmlspecialchars($product['quantity']); ?>" class="form-control w-50 mb-3" <?php echo ($product['quantity'] == 0) ? 'disabled' : ''; ?>>
                        <button type='submit' name='add_to_cart' class="btn btn-primary w-100" <?php echo ($product['quantity'] == 0) ? 'disabled style="background-color: grey; border-color: grey;"' : ''; ?>>Add to Cart</button>
                    </form>
                    <?php if ($product['quantity'] == 0): ?>
                        <p class="text-danger mt-2">Out of stock</p>
                    <?php endif; ?>

                    <form method="post" class="mt-2">
                        <input type="hidden" name="variant_id" value="<?php echo $product['prod_variant_id']; ?>">
                        <button type='submit' name='add_to_wishlist' class="btn btn-warning w-100">
                            <?php echo $in_wishlist ? "Already in Wishlist" : "Add to Wishlist"; ?>
                        </button>
                    </form>
            <br><h4 id="product-info" class="product-description">Product Details <br><br><?php echo htmlspecialchars(string: $product['prod_desc']) ?></h4>

        </div>
    </div>
</div>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
                $user_id = $_SESSION['user_id'] ?? null;
                $variant_id = $_POST['variant_id'] ?? null;
                $quantity = $_POST['quantity'] ?? 1;


                if ($user_id && $variant_id && $quantity) {
                    $result = addToCart($pdo, $user_id, $variant_id, $quantity);
                    if ($result) {
                        echo "<p class='text-success mt-3'>Product added to cart successfully!</p>";
                    } else {
                        echo "<p class='text-danger mt-3'>Failed to add product to cart.</p>";
                    }
                } else {
                    echo "<p class='text-danger mt-3'>Error: Missing required fields.</p>";
                }


                if ((int) $quantity > (int) $product['quantity']) {
                    echo "<p class='text-danger mt-3'>Error: You cannot order more than the available stock ("
                         . htmlspecialchars((int) $product['quantity']) . ").</p>";
                } else {
                    echo "<p class='text-success mt-3'>Your order has been added successfully.</p>";
                }


            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_wishlist'])) {
                $variant_id = $_POST['variant_id'] ?? null;
                if ($user_id && $variant_id) {
                    $result = addToWishlist($pdo, $user_id, $variant_id);
                    if ($result) {
                        echo "<script>location.reload();</script>"; // Refresh the page automatically
                        exit();
                    } else {
                        echo "<p class='text-danger mt-3'>Failed to add product to wishlist.</p>";
                    }
                }
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>
