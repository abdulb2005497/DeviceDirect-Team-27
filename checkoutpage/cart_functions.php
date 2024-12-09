<?php

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}


function add_to_cart($product_id, $product_title, $price, $image, $quantity) {
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = [
            'product_title' => $product_title,
            'price' => $price,
            'image' => $image,
            'quantity' => $quantity
        ];
    }
}

 function updateCartQuantity($cart_id, $quantity) {
     global $pdo;

     if ($quantity <= 0) {
         return "Quantity must be greater than zero.";
     }

     $update_query = "UPDATE cart SET quantity = :quantity WHERE cart_id = :cart_id";
     $stmt = $pdo->prepare($update_query);
     $stmt->execute(['quantity' => $quantity, 'cart_id' => $cart_id]);

     return "Cart quantity updated successfully!";
 }

 function removeFromCart($cart_id) {
     global $pdo;

     $query = "DELETE FROM cart WHERE cart_id = :cart_id";
     $stmt = $pdo->prepare($query);
     $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);

     $stmt->execute();

     if ($stmt->rowCount() > 0) {
         return true;
     } else {
         return false;
     }
 }


function calculate_cart_total() {
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}

 function getCartItems($user_id) {
     global $pdo;

     $query = "SELECT c.cart_id, p.product_title, pv.image, c.quantity, pv.price, s.size_name, c.prod_variant_id
               FROM cart c
               JOIN product_variants pv ON c.prod_variant_id = pv.prod_variant_id
               JOIN products p ON pv.product_id = p.product_id
               JOIN product_sizes s ON pv.size_id = s.size_id
               WHERE c.user_id = :user_id";

     $stmt = $pdo->prepare($query);
     $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
     $stmt->execute();

     return $stmt->fetchAll(PDO::FETCH_ASSOC); 
 }



?>
