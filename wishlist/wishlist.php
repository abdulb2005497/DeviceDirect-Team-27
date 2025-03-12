<?php
session_start();
include_once '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?error=Please log in first");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM wishlist WHERE user_id = ?");
$stmt->execute([$user_id]);
$wishlistItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style_wishlist.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Device Direct</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>My Wishlist</h1>
        <div id="wishlist-items">
            <?php if (!empty($wishlistItems)): ?>
                <?php foreach ($wishlistItems as $item): ?>
                    <div class="wishlist-item d-flex justify-content-between align-items-center border p-3 mb-2">
                        <div>
                            <p><strong><?php echo htmlspecialchars($item['product_name']); ?></strong></p>
                            <p>Price: £<?php echo number_format($item['price'], 2); ?></p>
                        </div>
                        <form action="remove_wishlist.php" method="post">
                            <input type="hidden" name="wishlist_id" value="<?php echo $item['id']; ?>">
                            <button class="btn btn-danger" type="submit">Remove</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Your wishlist is empty.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
