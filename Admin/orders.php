<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../Login_page/login.php");
    exit();
}

include('../config/db.php');
include '../navbar.php';

$query = "
SELECT o.order_id, o.date_ordered, o.status, o.total_price, o.first_name, o.last_name,
       oi.prod_id, p.product_title, pv.image, oi.quantity, oi.price_per_unit, oi.total_price,
       c.colour_name, s.size_name
FROM orders o
JOIN order_items oi ON o.order_id = oi.order_id
JOIN product_variants pv ON oi.prod_id = pv.prod_variant_id
JOIN products p ON pv.product_id = p.product_id
JOIN product_colours c ON oi.colour_id = c.colour_id
LEFT JOIN product_sizes s ON oi.size_id = s.size_id
ORDER BY o.order_id DESC";

$stmt = $pdo->prepare($query);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Orders</title>
    <link rel="stylesheet" href="../assests/css/style.css?v=<?php echo time(); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">

    <style>
        body { padding: 20px; }
        .table th, .table td { vertical-align: middle; }
        .product-img { width: 50px; height: 50px; object-fit: cover; margin-right: 10px; }
        .order-items { display: none; }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-4 text-center">Order Management</h2>
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search by customer name...">

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Total (£)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="orderTable">
            <?php
            $currentOrder = null;
            foreach ($orders as $order):
                if ($currentOrder !== $order['order_id']):
                    if ($currentOrder !== null) echo "</tbody></table></td></tr>"; // Close previous order items
                    $currentOrder = $order['order_id'];
            ?>
            <tr>
                <td><?= $order['order_id'] ?></td>
                <td><?= htmlspecialchars($order['first_name'] . ' ' . $order['last_name']) ?></td>
                <td><?= $order['date_ordered'] ?></td>
                <td><?= htmlspecialchars($order['status']) ?></td>
                <td>£<?= number_format($order['total_price'], 2) ?></td>
                <td>
                    <button class="btn btn-info btn-sm toggle-items" data-order-id="<?= $order['order_id'] ?>">View Items</button>
                    <a href="edit_order.php?id=<?= $order['order_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete_order.php?id=<?= $order['order_id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            <tr class="order-items" id="items-<?= $order['order_id'] ?>">
                <td colspan="6">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Colour</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
            <?php endif; ?>
                            <tr>
                                <td>
                                    <img src="../productspage/images/<?= htmlspecialchars($order['image']) ?>" alt="Product Image" class="product-img">
                                    <?= htmlspecialchars($order['product_title']) ?>
                                </td>
                                <td><?= htmlspecialchars($order['colour_name']) ?></td>
                                <td><?= htmlspecialchars($order['size_name'] ?? 'N/A') ?></td>
                                <td><?= $order['quantity'] ?></td>
                                <td>£<?= number_format($order['total_price'], 2) ?></td>
                            </tr>
            <?php endforeach; ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<script>
document.getElementById("searchInput").addEventListener("keyup", function() {
    var filter = this.value.toLowerCase();
    var rows = document.querySelectorAll("#orderTable tr");

    rows.forEach(row => {
        var customer = row.cells[1]?.innerText.toLowerCase() || "";
        row.style.display = customer.includes(filter) ? "" : "none";
    });
});

document.querySelectorAll(".toggle-items").forEach(button => {
    button.addEventListener("click", function() {
        var orderId = this.getAttribute("data-order-id");
        var itemsRow = document.getElementById("items-" + orderId);
        itemsRow.style.display = (itemsRow.style.display === "none" || itemsRow.style.display === "") ? "table-row" : "none";
    });
});
</script>

    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
