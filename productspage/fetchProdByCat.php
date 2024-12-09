<?php
include('../config/db.php');

$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;



if (empty($category_id)) {
    $query = "
        SELECT p.product_id, p.product_title, pv.image, pv.price, ca.category_name
        FROM products p
        JOIN product_variants pv ON p.product_id = pv.product_id
        JOIN product_categories ca ON pv.category_id = ca.category_id
        GROUP BY p.product_id
    ";
    $stmt = $pdo->prepare($query);
} else {
    $query = "
        SELECT p.product_id, p.product_title, pv.image, pv.price, ca.category_name
        FROM products p
        JOIN product_variants pv ON p.product_id = pv.product_id
        JOIN product_categories ca ON pv.category_id = ca.category_id
        WHERE pv.category_id = :category_id
        GROUP BY p.product_id
    ";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
}

$stmt->execute();

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($products) {
    echo json_encode($products);
} else {
    echo json_encode(["error" => "No products found"]);
}

$pdo = null;
?>
