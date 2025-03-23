<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../config/db.php');

function addToWishlist($pdo, $user_id, $variant_id) {
    try {
        $stmt = $pdo->prepare("SELECT 1 FROM wishlist WHERE user_id = ? AND prod_variant_id = ?");
        $stmt->execute([$user_id, $variant_id]);

        if ($stmt->fetch()) {
            echo "Item already exists in wishlist";
            return false;
        }

        $stmt = $pdo->prepare("INSERT INTO wishlist (user_id, prod_variant_id) VALUES (?, ?)");
        if ($stmt->execute([$user_id, $variant_id])) {
            echo "Item successfully added to wishlist!";
            return true;
        } else {
            echo "Failed to insert into wishlist.";
            return false;
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
        return false;
    }
}
