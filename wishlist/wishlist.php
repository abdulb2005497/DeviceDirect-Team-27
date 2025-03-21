<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once('../navbar.php');
include('../config/db.php');

if (!isset($_SESSION['user_id'])) {
    echo "<p class='text-danger mt-3'>You need to log in to view your wishlist.</p>";
    exit;
}

$user_id = $_SESSION['user_id'];

try {
    // Fetch products in the wishlist
    $query = "
        SELECT 
            p.product_title,
            ca.category_name,
            co.colour_name,
            s.size_name,
            pv.prod_variant_id,
            pv.image,
            pv.price
        FROM wishlist w
        JOIN product_variants pv ON w.prod_variant_id = pv.prod_variant_id
        JOIN products p ON pv.product_id = p.product_id
        JOIN product_categories ca ON pv.category_id = ca.category_id
        JOIN product_colours co ON pv.colour_id = co.colour_id
        JOIN product_sizes s ON pv.size_id = s.size_id
        WHERE w.user_id = :user_id
    ";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    
    $wishlist_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "<p class='text-danger mt-3'>Database error: " . $e->getMessage() . "</p>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Wishlist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-5">
    <h2>Your Wishlist</h2>

    <?php if (empty($wishlist_items)): ?>
        <p>Your wishlist is empty. Add items to your wishlist to see them here.</p>
    <?php else: ?>
        <div class="row">
            <?php foreach ($wishlist_items as $item): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="../productspage/images/<?php echo htmlspecialchars($item['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($item['product_title']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($item['product_title']); ?></h5>
                            <p class="text-muted">Category: <?php echo htmlspecialchars($item['category_name']); ?></p>
                            <p class="text-muted">Colour: <?php echo htmlspecialchars($item['colour_name']); ?></p>
                            <p class="text-muted">Size: <?php echo htmlspecialchars($item['size_name']); ?></p>
                            <h5 class="text-success">Price: £<?php echo number_format($item['price'], 2); ?></h5>
                            <form method="POST" class="d-inline">
                                <input type="hidden" name="variant_id" value="<?php echo $item['prod_variant_id']; ?>">
                                <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
                            </form>
                            <form method="POST" class="d-inline">
                                <input type="hidden" name="variant_id" value="<?php echo $item['prod_variant_id']; ?>">
                                <button type="submit" name="remove_from_wishlist" class="btn btn-danger">Remove from Wishlist</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php
// Handling add to cart from wishlist
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $variant_id = $_POST['variant_id'] ?? null;
    $quantity = 1; // Assuming 1 quantity per add to cart for simplicity
    $user_id = $_SESSION['user_id'];

    if ($variant_id) {
        $result = addToCart($pdo, $user_id, $variant_id, $quantity);
        if ($result) {
            echo "<p class='text-success mt-3'>Product added to cart successfully!</p>";
        } else {
            echo "<p class='text-danger mt-3'>Failed to add product to cart.</p>";
        }
    }
}

// Handling remove from wishlist
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_from_wishlist'])) {
    $variant_id = $_POST['variant_id'] ?? null;

    if ($variant_id) {
        $remove_query = "
            DELETE FROM wishlist 
            WHERE user_id = :user_id AND prod_variant_id = :variant_id
        ";
        $stmt = $pdo->prepare($remove_query);
        $stmt->execute([':user_id' => $user_id, ':variant_id' => $variant_id]);
        
        echo "<meta http-equiv='refresh' content='0'>";
    }
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
