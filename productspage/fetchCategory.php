<?php
include('../config/db.php');

$query = "SELECT category_id, category_name FROM product_categories";

$stmt = $pdo->prepare($query);

$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($categories) {
    echo json_encode($categories);
} else {
    echo json_encode([]);
}

$pdo = null;

?>
