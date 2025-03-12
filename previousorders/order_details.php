<?php
session_start();
require '../config/db.php'; 

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Login_page/login.php");
    exit();
}

// Check if order_id is passed
if (!isset($_GET['order_id'])) {
    die("Order ID is missing.");
}

$order_id = intval($_GET['order_id']); // Convert order_id to integer
$user_id = $_SESSION['user_id']; 

// Fetch order details
$stmt = $pdo->prepare("SELECT * FROM orders WHERE order_id = ? AND user_id = ?");
$stmt->execute([$order_id, $user_id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

// If order not found, display error
if (!$order) {
    die("Order not found.");
}

// Fetch order items
$itemStmt = $pdo->prepare("
    SELECT oi.*, p.product_title, pv.image 
    FROM order_items oi
    JOIN product_variants pv ON oi.prod_id = pv.prod_variant_id
    JOIN products p ON pv.product_id = p.product_id
    WHERE oi.order_id = ?
");
$itemStmt->execute([$order_id]);
$order_items = $itemStmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Details</title>
    <link rel="stylesheet" href="style_orders.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../contactuspage/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet" />

    <style>
        /* Centered Box for Order Details */
        .order-box {
            background: #ffffff;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 40px auto; /* Centering */
            text-align: center;
        }

        /* Order Item Styling */
        .order-item-card {
            background: #ffffff;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            text-align: center;
        }

        /* Order Item Image */
        .order-item-image {
            max-width: 100px;  
            height: auto;
            border-radius: 5px;
            display: block;
            margin: 10px auto;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<?php include '../navbar.php'; ?>

<!-- Order Details Section -->
<div class="order-box">
    <h2>Order #<?php echo $order['order_id']; ?></h2>
    <p><strong>Total Price:</strong> $<?php echo number_format($order['total_price'], 2); ?></p>
    <p><strong>Status:</strong> <?php echo ucfirst($order['status']); ?></p>
    <p><strong>Date Ordered:</strong> <?php echo $order['date_ordered']; ?></p>

    <!-- Buttons: View Details + Refund -->
    <div class="d-flex justify-content-center gap-2 mt-3">
        <a href="order_details.php?order_id=<?php echo $order['order_id']; ?>" class="btn btn-primary">View Details</a>
        <a href="refund_request.php?order_id=<?php echo $order['order_id']; ?>" class="btn btn-danger">Refund</a>
    </div>
</div>

<h3 class="text-center mt-4">Items in Order</h3>
<div class="container">
    <div class="row">
        <?php if (count($order_items) > 0): ?>
            <?php foreach ($order_items as $item): ?>
                <div class="col-md-6">
                    <div class="order-item-card">
                        <img src="../product_images/<?php echo $item['image']; ?>" 
                             alt="<?php echo $item['product_title']; ?>" 
                             class="order-item-image img-fluid"
                             onerror="this.onerror=null; this.src='../assets/images/placeholder.png';">
                        <div class="order-item-details">
                            <h5><?php echo $item['product_title']; ?></h5>
                            <p><strong>Quantity:</strong> <?php echo $item['quantity']; ?></p>
                            <p><strong>Price Per Unit:</strong> $<?php echo number_format($item['price_per_unit'], 2); ?></p>
                            <p><strong>Total Price:</strong> $<?php echo number_format($item['total_price'], 2); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No items found in this order.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Footer -->
<?php include '../footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
