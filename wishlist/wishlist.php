<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once('../navbar.php');
include('../config/db.php');
include('../checkoutpage/cart_functions.php');

// Initialize wishlist session if not set
if (!isset($_SESSION['wishlist'])) {
    $_SESSION['wishlist'] = [];
}

// Adding item to wishlist
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_wishlist'])) {
    $variant_id = $_POST['variant_id'] ?? null;
    $product_title = $_POST['product_title'] ?? 'Unknown Product';
    $category_name = $_POST['category_name'] ?? 'Unknown Category';
    $colour_name = $_POST['colour_name'] ?? 'Unknown Colour';
    $size_name = $_POST['size_name'] ?? 'Unknown Size';
    $image = $_POST['image'] ?? 'default.jpg';
    $price = $_POST['price'] ?? 0.00;

    if ($variant_id) {
        $_SESSION['wishlist'][$variant_id] = [
            'product_title' => $product_title,
            'category_name' => $category_name,
            'colour_name' => $colour_name,
            'size_name' => $size_name,
            'image' => $image,
            'price' => $price
        ];
    }
}

// Removing item from wishlist
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_from_wishlist'])) {
    $variant_id = $_POST['variant_id'] ?? null;
    
    if ($variant_id && isset($_SESSION['wishlist'][$variant_id])) {
        unset($_SESSION['wishlist'][$variant_id]);
    }
}

// Get wishlist items from session
$wishlist_items = $_SESSION['wishlist'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-5">
    <h2>Your Wishlist</h2>
    <hr>
    
    <?php if ($wishlist_items): ?>
        <div class="row">
            <?php foreach ($wishlist_items as $variant_id => $item): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="../productspage/images/<?= htmlspecialchars($item['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($item['product_title']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"> <?= htmlspecialchars($item['product_title']) ?> </h5>
                            <p class="text-muted">Category: <?= htmlspecialchars($item['category_name']) ?></p>
                            <p class="text-muted">Colour: <?= htmlspecialchars($item['colour_name']) ?></p>
                            <p class="text-muted">Size: <?= htmlspecialchars($item['size_name']) ?></p>
                            <h4 class="text-success">£<?= number_format($item['price'], 2) ?></h4>
                            
                            <form method="post" class="mt-2">
                                <input type="hidden" name="variant_id" value="<?= $variant_id ?>">
                                <button type="submit" name="remove_from_wishlist" class="btn btn-danger w-100">Remove from Wishlist</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Your wishlist is empty. Start adding your favourite products!</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
