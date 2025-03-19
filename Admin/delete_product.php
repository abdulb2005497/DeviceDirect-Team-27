<?php
session_start();
include('../config/db.php');
include('admin_action.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../Login_page/login.php");
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $variant_id = intval($_GET['id']);

    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("
            SELECT pv.product_id, pv.image, p.product_title, c.colour_name, s.size_name
            FROM product_variants pv
            JOIN products p ON pv.product_id = p.product_id
            JOIN product_colours c ON pv.colour_id = c.colour_id
            LEFT JOIN product_sizes s ON pv.size_id = s.size_id
            WHERE pv.prod_variant_id = ?
        ");
        $stmt->execute([$variant_id]);
        $variant = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($variant) {
            $image_path = "../../productspage/images/" . $variant['image'];

            if (!empty($variant['image']) && file_exists($image_path)) {
                if (!unlink($image_path)) {
                    $_SESSION['error_message'] = "Warning: Unable to delete the image file.";
                }
            }

            $deleteStmt = $pdo->prepare("DELETE FROM product_variants WHERE prod_variant_id = ?");
            if ($deleteStmt->execute([$variant_id])) {
                logAdminAction(
                    $pdo,
                    $_SESSION['user_id'],
                    "Deleted product variant ID $variant_id (Product: " . htmlspecialchars($variant['product_title']) .
                    ", Colour: " . htmlspecialchars($variant['colour_name']) .
                    ", Size: " . (!empty($variant['size_name']) ? htmlspecialchars($variant['size_name']) : 'N/A') .
                    ", Product ID: " . $variant['product_id'] . ")",
                    "product_variants"
                );

                $_SESSION['success_message'] = "Product variant deleted successfully.";
            } else {
                throw new Exception("Failed to delete product variant from the database.");
            }
        } else {
            $_SESSION['error_message'] = "Product variant not found.";
        }

        $pdo->commit();

    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['error_message'] = "Error: " . $e->getMessage();
    }
}

header("Location: adminstock.php");
exit();
