<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('../config/db.php'); // Include database connection

/**
 * Add item to cart
 */
 function addToCart($pdo, $user_id, $prod_variant_id, $quantity) {
     try {
         if (!$user_id || !$prod_variant_id || !$quantity) {
             die("Error: Missing required values - User ID: $user_id, Variant ID: $prod_variant_id, Quantity: $quantity");
         }

         // Check if the item already exists in the cart
         $query = "SELECT quantity FROM cart WHERE user_id = ? AND prod_variant_id = ?";
         $stmt = $pdo->prepare($query);
         $stmt->execute([$user_id, $prod_variant_id]);
         $existingItem = $stmt->fetch(PDO::FETCH_ASSOC);

         if ($existingItem) {
             // Item exists, update the quantity
             $newQuantity = $existingItem['quantity'] + $quantity;
             $query = "UPDATE cart SET quantity = ? WHERE user_id = ? AND prod_variant_id = ?";
             $stmt = $pdo->prepare($query);
             $success = $stmt->execute([$newQuantity, $user_id, $prod_variant_id]);

             if ($success) {
                 echo "Cart updated successfully!";
             } else {
                 die("Error updating cart.");
             }
         } else {
             // Insert new item into cart
             $query = "INSERT INTO cart (user_id, prod_variant_id, quantity) VALUES (?, ?, ?)";
             $stmt = $pdo->prepare($query);
             $success = $stmt->execute([$user_id, $prod_variant_id, $quantity]);

             if ($success) {
                 echo "Item added to cart!";
             } else {
                 die("Error adding item to cart.");
             }
         }

         return true;
     } catch (PDOException $e) {
         die("Database error: " . $e->getMessage());
     }
 }

/**
 * Remove item from cart
 */
 function remove_from_cart($pdo, $user_id, $prod_variant_id) {
     if (!$user_id || !$prod_variant_id) {
         return false; // Prevent execution if values are missing
     }

     try {
         $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ? AND prod_variant_id = ?");
         $stmt->execute([$user_id, $prod_variant_id]);

         return $stmt->rowCount() > 0; // Returns true if a row was deleted
     } catch (PDOException $e) {
         die("Database error: " . $e->getMessage());
     }
 }

/**
 * Update cart item quantity
 */
 function update_cart_quantity($pdo, $user_id, $prod_variant_id, $quantity) {
     if (!$user_id || !$prod_variant_id || $quantity < 1) {
         return false; // Prevent invalid updates
     }

     try {
         $stmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND prod_variant_id = ?");
         $stmt->execute([$quantity, $user_id, $prod_variant_id]);

         return $stmt->rowCount() > 0; // Returns true if a row was updated
     } catch (PDOException $e) {
         die("Database error: " . $e->getMessage());
     }
 }
/**
 * Retrieve cart contents
 */
 function getCartItems($pdo, $user_id) {
    if (!$user_id) {
        return [];
    }

    try {
        $stmt = $pdo->prepare("SELECT c.quantity, p.product_title, pv.image, pv.price, c.prod_variant_id
                               FROM cart c
                               JOIN product_variants pv ON c.prod_variant_id = pv.prod_variant_id
                               JOIN products p ON pv.product_id = p.product_id
                               WHERE c.user_id = ?");
        $stmt->execute([$user_id]);
        $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Debugging: print result to check what is fetched


        return $cartItems;
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}


/**
 * Calculate total cart value
 */
 function calculate_total($pdo, $user_id) {
     if (!$user_id) {
         return 0;
     }

     try {
         $stmt = $pdo->prepare("SELECT SUM(c.quantity * pv.price) AS total FROM cart c
                                 JOIN product_variants pv ON c.prod_variant_id = pv.prod_variant_id
                                 WHERE c.user_id = ?");
         $stmt->execute([$user_id]);
         $result = $stmt->fetch(PDO::FETCH_ASSOC);
         return $result['total'] ?? 0;
     } catch (PDOException $e) {
         die("Database error: " . $e->getMessage());
     }
 }
 ?>
