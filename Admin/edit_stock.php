<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../Login_page/login.php");
    exit();
}

include('../config/db.php');
include('admin_action.php');

$prod_variant_id = $_GET['id'];

$stmt = $pdo->prepare("
    SELECT pv.*,
           p.product_title,
           p.prod_desc,
           c.category_name,
           co.colour_name,
           s.size_name
    FROM product_variants pv
    JOIN products p ON pv.product_id = p.product_id
    JOIN product_categories c ON pv.category_id = c.category_id
    JOIN product_colours co ON pv.colour_id = co.colour_id
    LEFT JOIN product_sizes s ON pv.size_id = s.size_id
    WHERE pv.prod_variant_id = ?
");
$stmt->execute([$prod_variant_id]);
$variant = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$variant) {
    die("Product variant not found.");
}

$categories = $pdo->query("SELECT * FROM product_categories")->fetchAll(PDO::FETCH_ASSOC);
$colours = $pdo->query("SELECT * FROM product_colours")->fetchAll(PDO::FETCH_ASSOC);
$sizes = $pdo->query("SELECT * FROM product_sizes")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_id = intval($_POST['category_id']);
    $colour_id = intval($_POST['colour_id']);
    $size_id = !empty($_POST['size_id']) ? intval($_POST['size_id']) : null;
    $prod_desc = trim($_POST['prod_desc']);
    $quantity = intval($_POST['quantity']);
    $price = floatval($_POST['price']);
    $image = $variant['image'];

    $changes = [];

    $new_category = $pdo->prepare("SELECT category_name FROM product_categories WHERE category_id = ?");
    $new_category->execute([$category_id]);
    $new_category = $new_category->fetchColumn();

    $new_colour = $pdo->prepare("SELECT colour_name FROM product_colours WHERE colour_id = ?");
    $new_colour->execute([$colour_id]);
    $new_colour = $new_colour->fetchColumn();

    $new_size = null;
    if ($size_id) {
        $new_size_stmt = $pdo->prepare("SELECT size_name FROM product_sizes WHERE size_id = ?");
        $new_size_stmt->execute([$size_id]);
        $new_size = $new_size_stmt->fetchColumn();
    }

    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../productspage/images/";
        $image_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $allowed_types = ['jpg', 'jpeg', 'png', 'webp'];
        if (!in_array($imageFileType, $allowed_types)) {
            die("Invalid file type. Only JPG, JPEG, PNG, and WEBP are allowed.");
        }
        if ($_FILES["image"]["size"] > 5000000) {
            die("File is too large. Maximum size is 5MB.");
        }

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            if ($image !== $image_name) {
                $changes[] = "Image changed from '{$image}' to '{$image_name}'";
                $image = $image_name;
            }
        } else {
            die("Error uploading image.");
        }
    }

    if ($new_category !== $variant['category_name']) {
        $changes[] = "Category changed from '{$variant['category_name']}' to '{$new_category}'";
    }
    if ($new_colour !== $variant['colour_name']) {
        $changes[] = "Colour changed from '{$variant['colour_name']}' to '{$new_colour}'";
    }
    if ($new_size !== $variant['size_name']) {
        $changes[] = "Size changed from '{$variant['size_name']}' to '{$new_size}'";
    }
    if ($prod_desc !== $variant['prod_desc']) {
        $changes[] = "Description updated";
    }
    if ($quantity !== $variant['quantity']) {
        $changes[] = "Quantity changed from '{$variant['quantity']}' to '{$quantity}'";
    }
    if ($price !== $variant['price']) {
        $changes[] = "Price changed from '£" . number_format($variant['price'], 2) . "' to '£" . number_format($price, 2) . "'";
    }

    if (!empty($changes)) {
        $update_stmt = $pdo->prepare("
            UPDATE product_variants
            SET category_id = ?, colour_id = ?, size_id = ?, quantity = ?, price = ?, image = ?
            WHERE prod_variant_id = ?
        ");
        $update_stmt->execute([$category_id, $colour_id, $size_id, $quantity, $price, $image, $prod_variant_id]);

        $update_desc_stmt = $pdo->prepare("
            UPDATE products
            SET prod_desc = ?
            WHERE product_id = ?
        ");
        $update_desc_stmt->execute([$prod_desc, $variant['product_id']]);

        $change_details = implode("; ", $changes);
        logAdminAction($pdo, $_SESSION['user_id'], "Updated product variant ID '{$prod_variant_id}'. Changes: {$change_details}", "product_variants");

        echo "<script>alert('Product updated successfully!'); window.location.href='adminstock.php';</script>";
    } else {
        echo "<script>alert('No changes detected.'); window.location.href='adminstock.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Stock</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Edit Product Variant</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Product</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($variant['product_title']) ?>" readonly>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['category_id'] ?>" <?= $category['category_id'] == $variant['category_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['category_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Colour</label>
            <select name="colour_id" class="form-control" required>
                <?php foreach ($colours as $colour): ?>
                    <option value="<?= $colour['colour_id'] ?>" <?= $colour['colour_id'] == $variant['colour_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($colour['colour_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Size</label>
            <select name="size_id" class="form-control">
                <option value="">N/A</option>
                <?php foreach ($sizes as $size): ?>
                    <option value="<?= $size['size_id'] ?>" <?= $size['size_id'] == $variant['size_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($size['size_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="prod_desc" class="form-control" rows="4"><?= htmlspecialchars($variant['prod_desc']) ?></textarea>
        </div>

        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" value="<?= $variant['quantity'] ?>" required>
        </div>

        <div class="mb-3">
            <label>Price (£)</label>
            <input type="text" name="price" class="form-control" value="<?= number_format($variant['price'], 2) ?>" required>
        </div>

        <div class="mb-3">
            <label>Current Image</label><br>
            <img src="../productspage/images/<?= htmlspecialchars($variant['image']) ?>" alt="Product Image" width="150">
        </div>

        <div class="mb-3">
            <label>New Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
        <a href="adminstock.php" class="btn btn-secondary">Cancel</a>
    </form>
</body>
</html>
