<?php
session_start();
require '../config/db.php'; // Include database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Login_page/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$welcome_message = "Welcome, " . htmlspecialchars($_SESSION['first_name']);

// Fetch user orders
$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY date_ordered DESC");
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Orders</title>
    <link rel="stylesheet" href="../assets/css/style_orders.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<?php include '../includes/navbar.php'; ?> <!-- If you have a navbar file, include it -->

<!-- Orders Section -->
<div class="container mt-5">
    <h2 class="text-center">My Orders</h2>
    <div class="row">
        <?php if (count($orders) > 0): ?>
            <?php foreach ($orders as $order): ?>
                <div class="col-md-6">
                    <div class="order-card p-4 shadow-sm">
                        <h4>Order #<?php echo $order['order_id']; ?></h4>
                        <p><strong>Total Price:</strong> $<?php echo number_format($order['total_price'], 2); ?></p>
                        <p><strong>Status:</strong> <?php echo ucfirst($order['status']); ?></p>
                        <p><strong>Date Ordered:</strong> <?php echo $order['date_ordered']; ?></p>
                        <a href="order_details.php?order_id=<?php echo $order['order_id']; ?>" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">You have no orders yet.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Footer -->
<?php include '../includes/footer.php'; ?> <!-- If you have a footer file, include it -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
