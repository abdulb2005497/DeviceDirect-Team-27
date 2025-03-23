<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../Login_page/login.php");
    exit();
}

include('../config/db.php');
include('admin_action.php'); 

$categories = $pdo->query("SELECT * FROM product_categories")->fetchAll(PDO::FETCH_ASSOC);
$colours = $pdo->query("SELECT * FROM product_colours")->fetchAll(PDO::FETCH_ASSOC);
$sizes = $pdo->query("SELECT * FROM product_sizes")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $category_id = intval($_POST['category']);
    $colour_id = intval($_POST['colour']);
    $size_id = !empty($_POST['size']) ? intval($_POST['size']) : NULL;
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);

    $category_name = $pdo->query("SELECT category_name FROM product_categories WHERE category_id = $category_id")->fetchColumn();
    $colour_name = $pdo->query("SELECT colour_name FROM product_colours WHERE colour_id = $colour_id")->fetchColumn();
    $size_name = $size_id ? $pdo->query("SELECT size_name FROM product_sizes WHERE size_id = $size_id")->fetchColumn() : "N/A";

    $image = $_FILES['image']['name'];
    $target_dir = "../productspage/images/";
    $target_file = $target_dir . basename($image);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $allowed_types = ['jpg', 'jpeg', 'png', 'webp'];
    if (!in_array($imageFileType, $allowed_types)) {
        die("Invalid file type. Only JPG, JPEG, PNG, and WEBP are allowed.");
    }
    if ($_FILES["image"]["size"] > 5000000) {
        die("File is too large. Maximum size is 5MB.");
    }
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        die("Error uploading image.");
    }

    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("INSERT INTO products (product_title, prod_desc) VALUES (?, ?)");
        $stmt->execute([$title, $description]);
        $product_id = $pdo->lastInsertId();

        $stmt = $pdo->prepare("
            INSERT INTO product_variants (product_id, category_id, colour_id, size_id, price, quantity, image)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$product_id, $category_id, $colour_id, $size_id, $price, $quantity, $image]);

        $pdo->commit();

        logAdminAction(
            $pdo,
            $_SESSION['user_id'],
            "Added new product '$title' (ID: $product_id), Category: $category_name, Colour: $colour_name, Size: $size_name, Price: £$price, Quantity: $quantity",
            "product_variants"
        );

        echo "<script>alert('Product added successfully!'); window.location.href='adminstock.php';</script>";
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        die("Error adding product: " . $e->getMessage());
    }
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
