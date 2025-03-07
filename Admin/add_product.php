<?php
session_start();

// Check if the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../Login_page/login.php");
    exit();
}

include('../config/db.php');

$categories = $pdo->query("SELECT * FROM product_categories")->fetchAll(PDO::FETCH_ASSOC);
$colours = $pdo->query("SELECT * FROM product_colours")->fetchAll(PDO::FETCH_ASSOC);
$sizes = $pdo->query("SELECT * FROM product_sizes")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category_id = $_POST['category'];
    $colour_id = $_POST['colour'];
    $size_id = $_POST['size'] ?: NULL;
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $image = $_FILES['image']['name'];
    $target_dir = "../productspage/images/";
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

    $stmt = $pdo->prepare("INSERT INTO products (product_title) VALUES (?)");
    $stmt->execute([$title]);
    $product_id = $pdo->lastInsertId();

    $stmt = $pdo->prepare("INSERT INTO product_variants (product_id, prod_desc, category_id, colour_id, size_id, price, quantity, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$product_id, $description, $category_id, $colour_id, $size_id, $price, $quantity, $image]);

    header("Location: adminstock.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-4">Add New Product</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Product Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category" class="form-control" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Colour</label>
            <select name="colour" class="form-control" required>
                <?php foreach ($colours as $colour): ?>
                    <option value="<?= $colour['colour_id'] ?>"><?= $colour['colour_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Size (Optional)</label>
            <select name="size" class="form-control">
                <option value="">None</option>
                <?php foreach ($sizes as $size): ?>
                    <option value="<?= $size['size_id'] ?>"><?= $size['size_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Price (£)</label>
            <input type="number" name="price" class="form-control" step="0.01" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Stock Quantity</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Product Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
        <a href="adminstock.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
