<?php
session_start();
require '../config/db.php'; 
include_once('../navbar.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../Login_page/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$successMessage = "";

// Remove item from wishlist
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_item'])) {
    $prod_variant_id = $_POST['prod_variant_id'];
    $stmt = $pdo->prepare("DELETE FROM wishlist WHERE user_id = ? AND prod_variant_id = ?");
    $stmt->execute([$user_id, $prod_variant_id]);
    $successMessage = "Item removed from wishlist.";
}

// Move item to cart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['move_to_cart'])) {
    $prod_variant_id = $_POST['prod_variant_id'];
    
    // Add item to cart
    $stmt = $pdo->prepare("INSERT INTO cart (user_id, prod_variant_id) VALUES (?, ?)");
    $stmt->execute([$user_id, $prod_variant_id]);

    // Remove from wishlist
    $stmt = $pdo->prepare("DELETE FROM wishlist WHERE user_id = ? AND prod_variant_id = ?");
    $stmt->execute([$user_id, $prod_variant_id]);

    $successMessage = "Item moved to cart.";
}

// Fetch wishlist items
$stmt = $pdo->prepare("SELECT w.prod_variant_id, p.product_title, p.image, p.price 
                       FROM wishlist w
                       JOIN products p ON w.prod_variant_id = p.prod_variant_id
                       WHERE w.user_id = ?");
$stmt->execute([$user_id]);
$wishlistItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Wishlist</title>
    <link rel="stylesheet" href="../styles/wishlist.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../contactuspage/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">My Wishlist</h2>

    <?php if (!empty($successMessage)): ?>
        <div class="alert alert-success text-center"><?php echo $successMessage; ?></div>
    <?php endif; ?>

    <div class="row">
        <?php if (!empty($wishlistItems)): ?>
            <?php foreach ($wishlistItems as $item): ?>
                <div class="col-md-4">
                    <div class="card wishlist-item">
                        <img src="<?php echo file_exists("../productspage/images/".$item['image']) 
                            ? "../productspage/images/".htmlspecialchars($item['image']) 
                            : '../assets/images/default-product.png'; ?>" 
                            alt="<?php echo htmlspecialchars($item['product_title']); ?>" 
                            class="card-img-top wishlist-img">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($item['product_title']); ?></h5>
                            <p class="card-text">£<?php echo number_format($item['price'], 2); ?></p>
                            <form action="wishlist.php" method="post">
                                <input type="hidden" name="prod_variant_id" value="<?php echo $item['prod_variant_id']; ?>">
                                <button type="submit" name="remove_item" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i> Remove
                                </button>
                                <button type="submit" name="move_to_cart" class="btn btn-success btn-sm">
                                    <i class="fas fa-shopping-cart"></i> Move to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center mt-4">Your wishlist is empty.</p>
        <?php endif; ?>
    </div>
</div>

<footer class="text-center mt-5">
    &copy; 2024 Device Direct. All Rights Reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
