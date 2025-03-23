<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('../config/db.php'); 

function addToWishlist($pdo, $user_id, $prod_variant_id) {
    try {
        if (!$user_id || !$prod_variant_id) {
            die("Error: Missing required values - User ID: $user_id, Variant ID: $prod_variant_id");
        }

        // Check if the item already exists in the wishlist
        $query = "SELECT prod_variant_id FROM wishlist WHERE user_id = ? AND prod_variant_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$user_id, $prod_variant_id]);
        $existingItem = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingItem) {
            // Item is already in the wishlist
            echo "This item is already in your wishlist!";
        } else {
            // Insert new item into wishlist
            $query = "INSERT INTO wishlist (user_id, prod_variant_id) VALUES (?, ?)";
            $stmt = $pdo->prepare($query);
            $success = $stmt->execute([$user_id, $prod_variant_id]);

            if ($success) {
                echo "Item added to your wishlist!";
            } else {
                die("Error adding item to wishlist.");
            }
        }

        return true;
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}
?>
