<?php
session_start();
require '../config/db.php'; 


if (!isset($_SESSION['user_id'])) {
    header("Location: ../Login_page/login.php");
    exit();
}


if (!isset($_GET['order_id'])) {
    die("Order ID is missing.");
}

$order_id = intval($_GET['order_id']); 
$user_id = $_SESSION['user_id']; 


$stmt = $pdo->prepare("SELECT * FROM orders WHERE order_id = ? AND user_id = ?");
$stmt->execute([$order_id, $user_id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$order) {
    die("Order not found.");
}


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
        
        .order-box {
            background: #ffffff;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            margin: 40px auto; 
            text-align: center;
        }

        
        .order-item {
            border-top: 1px solid #ddd;
            padding: 15px 0;
        }

        
        .order-item img {
            max-width: 80px;
            height: auto;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        
        .btn-refund {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 15px;
            margin-top: 15px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .btn-refund:hover {
            background-color: #b02a37;
        }
    </style>
</head>
<body>


<?php include '../navbar.php'; ?>


<div class="order-box">
    <h2>Order #<?php echo $order['order_id']; ?></h2>
    <p><strong>Total Price:</strong> $<?php echo number_format($order['total_price'], 2); ?></p>
    <p><strong>Status:</strong> <?php echo ucfirst($order['status']); ?></p>
    <p><strong>Date Ordered:</strong> <?php echo $order['date_ordered']; ?></p>

    <h3 class="mt-4">Items in Order</h3>

    
    <?php if (count($order_items) > 0): ?>
        <?php foreach ($order_items as $item): ?>
            <div class="order-item">
                <img src="../product_images/<?php echo $item['image']; ?>" 
                     alt="<?php echo $item['product_title']; ?>" 
                     class="img-fluid"
                     onerror="this.onerror=null; this.src='../assets/images/placeholder.png';">
                <p><strong><?php echo $item['product_title']; ?></strong></p>
                <p><strong>Quantity:</strong> <?php echo $item['quantity']; ?></p>
                <p><strong>Price Per Unit:</strong> $<?php echo number_format($item['price_per_unit'], 2); ?></p>
                <p><strong>Total Price:</strong> $<?php echo number_format($item['total_price'], 2); ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No items found in this order.</p>
    <?php endif; ?>

    
    <a href="refund_request.php?order_id=<?php echo $order['order_id']; ?>" class="btn btn-refund">Request Refund</a>
</div>

<!-- Footer -->
<?php include '../footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
