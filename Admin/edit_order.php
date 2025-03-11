<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../Login_page/login.php");
    exit();
}

include('../config/db.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid order ID");
}

$order_id = $_GET['id'];

// Fetch order details
$query = "SELECT * FROM orders WHERE order_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$order_id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    die("Order not found");
}

// Fetch order items
$query = "
SELECT oi.*, p.product_title, pv.image, c.colour_name, s.size_name
FROM order_items oi
JOIN product_variants pv ON oi.prod_id = pv.prod_variant_id
JOIN products p ON pv.product_id = p.product_id
JOIN product_colours c ON oi.colour_id = c.colour_id
LEFT JOIN product_sizes s ON oi.size_id = s.size_id
WHERE oi.order_id = ?";

$stmt = $pdo->prepare($query);
$stmt->execute([$order_id]);
$order_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
$currentStatus = trim(strtolower($order['status']));

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'];

    $updateQuery = "UPDATE orders SET status = ? WHERE order_id = ?";
    $stmt = $pdo->prepare($updateQuery);
    $stmt->execute([$status, $order_id]);

    header("Location: orders.php");
    exit();
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Order #<?= htmlspecialchars($order['order_id']) ?></h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Order Status</label>
            <select name="status" class="form-control">
      <?php

      $statuses = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];
      foreach ($statuses as $status):
          $selected = (strtolower($currentStatus) === strtolower($status)) ? 'selected' : '';

      ?>
          <option value="<?= htmlspecialchars($status) ?>" <?= $selected ?>>
              <?= htmlspecialchars($status) ?>
          </option>
      <?php endforeach; ?>
  </select>

        </div>
        <button type="submit" class="btn btn-primary">Update Order</button>
        <a href="orders.php" class="btn btn-secondary">Cancel</a>
    </form>

    <h3 class="mt-4">Order Items</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Product</th>
                <th>Colour</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order_items as $item): ?>
            <tr>
                <td><img src="../productspage/images/<?= htmlspecialchars($item['image']) ?>" width="50"></td>
                <td><?= htmlspecialchars($item['product_title']) ?></td>
                <td><?= htmlspecialchars($item['colour_name']) ?></td>
                <td><?= htmlspecialchars($item['size_name'] ?? 'N/A') ?></td>
                <td><?= $item['quantity'] ?></td>
                <td>£<?= number_format($item['total_price'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
