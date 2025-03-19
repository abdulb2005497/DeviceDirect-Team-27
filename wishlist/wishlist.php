<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once('../navbar.php');
include('../config/db.php');
include('../checkoutpage/cart_functions.php');

if (!isset($_SESSION['user_id'])) {
    die("You need to <a href='../Login_page/login.php'>log in</a> to view your wishlist.");
}

$user_id = $_SESSION['user_id'];

// Adding item to wishlist
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_wishlist'])) {
    $variant_id = $_POST['variant_id'] ?? null;

    if ($variant_id) {
        $query = "INSERT INTO wishlist (user_id, prod_variant_id) VALUES (:user_id, :variant_id) ON DUPLICATE KEY UPDATE added_at = NOW()";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':user_id' => $user_id, ':variant_id' => $variant_id]);
    }
}

// Removing item from wishlist
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_from_wishlist'])) {
    $variant_id = $_POST['variant_id'] ?? null;

    if ($variant_id) {
        $query = "DELETE FROM wishlist WHERE user_id = :user_id AND prod_variant_id = :variant_id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':user_id' => $user_id, ':variant_id' => $variant_id]);
    }
}

// Fetch wishlist items
$query = "
SELECT p.product_title, ca.category_name, co.colour_name, s.size_name, pv.prod_variant_id, pv.image, pv.price
FROM wishlist w
JOIN product_variants pv ON w.prod_variant_id = pv.prod_variant_id
JOIN products p ON pv.product_id = p.product_id
JOIN product_categories ca ON pv.category_id = ca.category_id
JOIN product_colours co ON pv.colour_id = co.colour_id
JOIN product_sizes s ON pv.size_id = s.size_id
WHERE w.user_id = :user_id
ORDER BY w.added_at DESC
";
$stmt = $pdo->prepare($query);
$stmt->execute([':user_id' => $user_id]);
$wishlist_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <?php foreach ($wishlist_items as $item): ?>
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
                                <input type="hidden" name="variant_id" value="<?= $item['prod_variant_id'] ?>">
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
