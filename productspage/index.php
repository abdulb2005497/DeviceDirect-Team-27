<?php
if (session_status() == PHP_SESSION_NONE) { session_start();
}
if (!isset($_SESSION['user_id'])) { header("Location: ../Login_page/login.php");
    exit();
}

include('../config/db.php');
include_once('../navbar.php');

$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;
$size = isset($_GET['size']) ? $_GET['size'] : null;
$min_price = isset($_GET['min_price']) ? floatval($_GET['min_price']) : null;
$max_price = isset($_GET['max_price']) ? floatval($_GET['max_price']) : null;

$category_query = "SELECT category_id, category_name FROM product_categories";
$categories = $pdo->query($category_query)->fetchAll(PDO::FETCH_ASSOC);

$size_query = "SELECT DISTINCT s.size_id, s.size_name
               FROM product_sizes s
               JOIN product_variants pv ON s.size_id = pv.size_id
               WHERE s.size_name IS NOT NULL
               ORDER BY s.size_name";
$sizes = $pdo->query($size_query)->fetchAll(PDO::FETCH_ASSOC);

$query = "
    SELECT p.product_title, pv.prod_variant_id, pv.image, pv.price, s.size_name, ca.category_name
    FROM product_variants pv
    JOIN products p ON pv.product_id = p.product_id
    JOIN product_categories ca ON pv.category_id = ca.category_id
    LEFT JOIN product_sizes s ON pv.size_id = s.size_id
    WHERE 1=1
";
$params = [];


if (!empty($category_id)) {
    $query .= " AND pv.category_id = :category_id";
    $params[':category_id'] = $category_id;
}
if (!empty($size)) {
    $query .= " AND s.size_id = :size";
    $params[':size'] = $size;
}
if (!empty($min_price)) {
    $query .= " AND pv.price >= :min_price";
    $params[':min_price'] = $min_price;
}
if (!empty($max_price)) {
    $query .= " AND pv.price <= :max_price";
    $params[':max_price'] = $max_price;
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
</head>
<body>
    

<!-- Filter Sidebar -->
<div class="sidebar" id="filterSidebar">
    <h3>Filters</h3>
    <form method="GET" action="">
        <label for="category">Category:</label>
        <select name="category_id" id="category">
            <option value="">All Categories</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= htmlspecialchars($category['category_id']) ?>"
                    <?= ($category_id == $category['category_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category['category_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="size">Size:</label>
        <select name="size" id="size">
            <option value="">All Sizes</option>
            <?php foreach ($sizes as $available_size): ?>
                <option value="<?= htmlspecialchars($available_size['size_id']) ?>"
                    <?= ($size == $available_size['size_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($available_size['size_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="min_price">Price:</label>
        <input type="number" name="min_price" id="min_price" placeholder="Min" value="<?= $min_price ?>">
        <input type="number" name="max_price" id="max_price" placeholder="Max" value="<?= $max_price ?>">

        <button type="submit" class="btn btn-primary">Apply Filters</button>
        <button type="button" id="resetFilters" class="btn btn-secondary">Reset Filters</button>
    </form>
</div>

<!-- Products Display -->
 
<div class="container mt-4 d-flex justify-content-end">
    <div class="w-75">
        <h3 class="text-center">Store Page</h3>
        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search for products...">

        <div class="row">
            <?php if ($products): ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="images/<?= htmlspecialchars($product['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['product_title']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($product['product_title']) ?></h5>
                                <p class="card-text">Category: <?= htmlspecialchars($product['category_name']) ?></p>
                                <p class="card-text">Size: <?= htmlspecialchars($product['size_name']) ?></p>
                                <p class="card-text">Price: £<?= number_format($product['price'], 2) ?></p>
                                <a href="product_details.php?variant_id=<?= $product['prod_variant_id'] ?>" class="btn btn-primary">View Details</a>
                                
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No products found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>





<?php include_once '../footer.php'; ?>
<script>
  document.getElementById("resetFilters").addEventListener("click", function () {
  window.location.href = window.location.pathname;
});

document.getElementById("searchInput").addEventListener("keyup", function() {
    var filter = this.value.toLowerCase();
    var cards = document.querySelectorAll(".col-md-4"); // Selects product cards

    cards.forEach(card => {
        var productName = card.querySelector(".card-title").innerText.toLowerCase();
        card.style.display = productName.includes(filter) ? "" : "none";
    });
});

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
