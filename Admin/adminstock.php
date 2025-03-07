<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../Login_page/login.php");
    exit();
}

include('../config/db.php');
include '../navbar.php';
$query = "
SELECT pv.prod_variant_id, p.product_title, pv.prod_desc, pv.quantity, pv.image, pv.price, s.size_name, ca.category_name, co.colour_name
FROM product_variants pv
JOIN products p ON pv.product_id = p.product_id
JOIN product_categories ca ON pv.category_id = ca.category_id
JOIN product_colours co ON pv.colour_id = co.colour_id
LEFT JOIN product_sizes s ON pv.size_id = s.size_id
ORDER BY pv.prod_variant_id ";

$stmt = $pdo->prepare($query);
$stmt->execute();
$variants = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Product Variants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding: 20px; }
        .table img { width: 100px; height: 100px; object-fit: cover; }
        .btn { margin-right: 5px; }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-4 text-center">Stock Control</h2>

    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search by product name...">
    <a href="add_product.php" class="btn btn-success mb-3">Add New Product</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Product</th>
                <th>Description</th>
                <th>Category</th>
                <th>Colour</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Price (£)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="productTable">
            <?php foreach ($variants as $variant): ?>
                <tr>
                    <td><?= $variant['prod_variant_id'] ?></td>
                    <td><img src="../productspage/images/<?= htmlspecialchars($variant['image']) ?>" alt="Product Image"></td>
                    <td><?= htmlspecialchars($variant['product_title']) ?></td>
                    <td><?= nl2br(htmlspecialchars($variant['prod_desc'])) ?></td>
                    <td><?= htmlspecialchars($variant['category_name']) ?></td>
                    <td><?= htmlspecialchars($variant['colour_name']) ?></td>
                    <td><?= htmlspecialchars($variant['size_name'] ?? 'N/A') ?></td>
                    <td><?= $variant['quantity'] ?></td>
                    <td>£<?= number_format($variant['price'], 2) ?></td>
                    <td>
                        <a href="edit_stock.php?id=<?= $variant['prod_variant_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_product.php?id=<?= $variant['prod_variant_id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
document.getElementById("searchInput").addEventListener("keyup", function() {
    var filter = this.value.toLowerCase();
    var rows = document.querySelectorAll("#productTable tr");

    rows.forEach(row => {
        var product = row.cells[2].innerText.toLowerCase();
        row.style.display = product.includes(filter) ? "" : "none";
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
