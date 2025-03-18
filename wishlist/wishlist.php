<?php
session_start();
include_once '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?error=Please log in first");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .wishlist-container {
            max-width: 1200px;
            margin: auto;
            padding: 40px 20px;
        }
        .wishlist-item {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .wishlist-item:hover {
            transform: translateY(-5px);
        }
        .wishlist-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .btn-danger {
            font-weight: 600;
            border-radius: 5px;
        }
        .btn-danger:hover {
            background-color: #d9534f;
        }
        .btn-success {
            font-weight: 600;
            border-radius: 5px;
        }
        footer {
            margin-top: 30px;
            text-align: center;
            padding: 20px;
            background-color: #343a40;
            color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <img src="../assets/images/device_direct_logo.png" alt="Device Direct Logo" style="width: 40px; margin-right: 10px;">
                Device Direct
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span><i class="fas fa-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../productspage/index.php">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="../aboutuspage/aboutus.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="../contactuspage/contactus.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link active" href="wishlist.php"><i class="fas fa-heart"></i> Wishlist</a></li>
                    <li class="nav-item"><a class="nav-link" href="../config/logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container wishlist-container">
        <h1 class="text-center">My Wishlist</h1>

        <?php if (!empty($successMessage)): ?>
            <div class="alert alert-success text-center"><?php echo $successMessage; ?></div>
        <?php endif; ?>

        <?php if (!empty($wishlistItems)): ?>
            <div class="row">
                <?php foreach ($wishlistItems as $item): ?>
                    <div class="col-md-4">
                        <div class="wishlist-item card">
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
            </div>
        <?php else: ?>
            <p class="text-center mt-4">Your wishlist is empty.</p>
        <?php endif; ?>
    </div>

    <footer>&copy; 2024 Device Direct. All Rights Reserved.</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
