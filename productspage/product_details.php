<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once('../navbar.php');
include('../config/db.php');
include('../checkoutpage/cart_functions.php');

if (!isset($_GET['variant_id']) || !is_numeric($_GET['variant_id'])) {
    die("Invalid product variant ID.");
}

$variant_id = intval($_GET['variant_id']);

try {
    $query = "
        SELECT
            p.product_title,
            ca.category_name,
            pv.prod_variant_id,
            pv.image,
            pv.price
        FROM product_variants pv
        JOIN products p ON pv.product_id = p.product_id
        JOIN product_categories ca ON pv.category_id = ca.category_id
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
</head>
<body>

<!-- Product Details Container -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img id="product-image" src="../productspage/images/<?= htmlspecialchars($product['image']) ?>"
                class="img-fluid"
                alt="<?= htmlspecialchars($product['product_title']) ?>">
        </div>
        <div class="col-md-6">
            <h2><?php echo htmlspecialchars($product['product_title']); ?></h2>
            <p class="text-muted">Category: <?php echo htmlspecialchars($product['category_name']); ?></p>

            <h4 id="product-price" class="mt-3">Price: £<?php echo number_format($product['price'], 2); ?></h4>

            <!-- Add to Cart Form -->
            <form method="post">
                <input type="hidden" name="variant_id" value="<?= $product['prod_variant_id'] ?>">

                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="1" min="1" class="form-control w-50 mb-3">

                <button type='submit' name='add_to_cart' class="btn btn-primary">Add to Cart</button>
            </form>

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
            }
            ?>
        </div>
    </div>
</div>

<?php include_once'../footer.php';  ?>

<script src="imgchange.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
