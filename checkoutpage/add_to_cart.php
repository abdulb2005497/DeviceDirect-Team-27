<?php
include('../config/db.php');

session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "error" => "User is not logged in"]);
    exit;
}

$cartData = json_decode(file_get_contents("php://input"));

if (isset($cartData->prod_variant_id) && isset($cartData->quantity)) {
    $prod_variant_id = $cartData->prod_variant_id;
    $quantity = $cartData->quantity;
    $user_id = $_SESSION['user_id'];

    try {
        $query = "SELECT * FROM cart WHERE user_id = :user_id AND prod_variant_id = :prod_variant_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':prod_variant_id', $prod_variant_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $query = "UPDATE cart SET quantity = quantity + :quantity WHERE user_id = :user_id AND prod_variant_id = :prod_variant_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':prod_variant_id', $prod_variant_id, PDO::PARAM_INT);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->execute();
            echo json_encode(["success" => true, "message" => "Product quantity updated in cart"]);
        } else {
            $query = "INSERT INTO cart (user_id, prod_variant_id, quantity) VALUES (:user_id, :prod_variant_id, :quantity)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':prod_variant_id', $prod_variant_id, PDO::PARAM_INT);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->execute();
            echo json_encode(["success" => true, "message" => "Product added to cart"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "error" => "Database error: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid data"]);
}
?>
