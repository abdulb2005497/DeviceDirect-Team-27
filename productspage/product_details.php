<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('../config/db.php'); // Include database connection
include('../checkoutpage/cart_functions.php');

// Validate and get the product ID from the URL
if (!isset($_GET['product_id']) || !is_numeric($_GET['product_id'])) {
    echo "Invalid product ID.";
    exit();
}

$product_id = intval($_GET['product_id']); // Ensure product_id is an integer

try {
    // Query to fetch product base details
    $query = "
        SELECT p.product_title, ca.category_name
        FROM products p
        JOIN product_variants pv ON p.product_id = pv.product_id
        JOIN product_categories ca ON pv.category_id = ca.category_id
        WHERE p.product_id = :product_id
        LIMIT 1
    ";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->execute();

    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo "Product not found.";
        exit();
    }

    // Query to fetch available color variants for the product
    $colorQuery = "
        SELECT pv.prod_variant_id, pv.image, pv.price, pv.colour_id, c.colour_name
        FROM product_variants pv
        JOIN product_colours c ON pv.colour_id = c.colour_id
        WHERE pv.product_id = :product_id
    ";
    $colorStmt = $pdo->prepare($colorQuery);
    $colorStmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $colorStmt->execute();

    $colors = $colorStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['product_title']); ?> - Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <!-- Product Image -->
            <img id="product-image" src="images/<?= htmlspecialchars($colors[0]['image']) ?>" class="img-fluid" alt="<?= htmlspecialchars($product['product_title']) ?>">
        </div>
        <div class="col-md-6">
            <!-- Product Details -->
            <h2><?php echo htmlspecialchars($product['product_title']); ?></h2>
            <p class="text-muted">Category: <?php echo htmlspecialchars($product['category_name']); ?></p>

            <!-- Color Selection -->
            <label for="color-select" class="form-label">Select Color:</label>
            <select id="color-select">
                <?php
                $uniqueColors = []; // Array to track unique colors
                foreach ($colors as $color):
                    $colorName = $color['colour_name'] ?? 'Unknown';
                    $imagePath = !empty($color['image']) ? '/DeviceDirect-newprod/productspage/images/' . $color['image'] : '/images/default-placeholder.png';

                    if (!isset($uniqueColors[$colorName])):
                        $uniqueColors[$colorName] = true; // Mark this color as seen
                ?>
                    <option
                        value="<?= htmlspecialchars($color['prod_variant_id'] ?? '') ?>"
                        data-price="<?= htmlspecialchars($color['price'] ?? '0') ?>"
                        data-image="<?= htmlspecialchars($imagePath) ?>">
                        <?= htmlspecialchars($colorName) ?>
                    </option>
                <?php
                    endif;
                endforeach;
                ?>
            </select>

            <!-- Price -->
            <h4 id="product-price" class="mt-3">Price: £<?php echo number_format($colors[0]['price'], 2); ?></h4>

            <!-- Add to Cart Button -->
            <form method="post">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <input type="hidden" name="variant_id" id="variant-id" value="<?= $colors[0]['prod_variant_id'] ?>">
                <input type="number" name="quantity" value="1" min="1">
                <button type='submit' name='add_to_cart'>Add to Cart</button>
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
                $user_id = $_SESSION['user_id'] ?? null;
                $variant_id = $_POST['variant_id'] ?? null;
                $quantity = $_POST['quantity'] ?? 1;

                if ($user_id && $variant_id && $quantity) {
                    $result = addToCart($pdo, $user_id, $variant_id, $quantity);

                } else {
                    echo "Error: Missing required fields.";
                }
            }
            ?>
        </div>
    </div>
</div>

<script src="imgchange.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
