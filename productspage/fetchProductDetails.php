<?php
include('../config/db.php');

$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;

if ($product_id && is_numeric($product_id)) {
    $query = "
    SELECT pv.prod_variant_id, pv.product_id, pv.category_id, pv.colour_id, pv.size_id, pv.prod_desc, pv.price, pv.image,
           c.colour_name, s.size_name, ca.category_name, p.product_title
    FROM product_variants pv
    JOIN product_colours c ON pv.colour_id = c.colour_id
    JOIN product_sizes s ON pv.size_id = s.size_id
    JOIN product_categories ca ON pv.category_id = ca.category_id
    JOIN products p ON pv.product_id = p.product_id
    WHERE pv.product_id = :product_id
    ";

    try {
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->execute();

        $product = [];
        $product['variants'] = [];

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $product['product_title'] = $row['product_title'];

            do {
                $product['variants'][] = [
                    'prod_variant_id' => $row['prod_variant_id'],
                    'colour_id' => $row['colour_id'],
                    'size_id' => $row['size_id'],
                    'prod_desc' => $row['prod_desc'],
                    'price' => $row['price'],
                    'image' => $row['image'],
                    'colour_name' => $row['colour_name'],
                    'size_name' => $row['size_name'],
                    'category_name' => $row['category_name'],
                ];
            } while ($row = $stmt->fetch(PDO::FETCH_ASSOC));

            echo json_encode($product);
        } else {
            echo json_encode(["error" => "Product not found"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => "Error fetching product details: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "Invalid or missing product_id"]);
}

$pdo = null;
?>
