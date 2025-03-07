<?php
session_start();
include('../../config/db.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../Login_page/login.php");
    exit();
}

if (isset($_GET['id'])) {
    $variant_id = $_GET['id'];

    $query = "SELECT image FROM product_variants WHERE prod_variant_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$variant_id]);
    $variant = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($variant) {
        $image_path = "../../productspage/images/" . $variant['image'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        $deleteQuery = "DELETE FROM product_variants WHERE prod_variant_id = ?";
        $deleteStmt = $pdo->prepare($deleteQuery);
        if ($deleteStmt->execute([$variant_id])) {
            $_SESSION['success_message'] = "Product variant deleted successfully.";
        } else {
            $_SESSION['error_message'] = "Failed to delete product variant.";
        }
    }
}

header("Location: adminstock.php");
exit();
