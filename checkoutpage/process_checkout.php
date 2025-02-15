<?php
session_start();
require '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $first_name = htmlspecialchars($_POST['billingFirstName']);
    $last_name = htmlspecialchars($_POST['billingLastName']);
    $address = htmlspecialchars($_POST['billingAddress']);
    $city = htmlspecialchars($_POST['billingCity']);
    $postal_code = htmlspecialchars($_POST['billingPostalCode']);
    $total_price = isset($_SESSION['total_price']) ? $_SESSION['total_price'] : 0;

    if (empty($first_name) || empty($last_name) || empty($address) || empty($city) || empty($postal_code)) {
        echo "All fields are required!";
        exit();
    }

    try {
        $pdo->beginTransaction();


        $stmt = $pdo->prepare("INSERT INTO orders (user_id, first_name, last_name, total_price, address, city, postal_code, date_ordered)
                               VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$user_id, $first_name, $last_name, $total_price, $address, $city, $postal_code]);


        $order_id = $pdo->lastInsertId();


        $cartStmt = $pdo->prepare("SELECT c.prod_variant_id, c.quantity, pv.price, pv.product_id, pv.colour_id, pv.size_id
                                   FROM cart c
                                   JOIN product_variants pv ON c.prod_variant_id = pv.prod_variant_id
                                   WHERE c.user_id = ?");
        $cartStmt->execute([$user_id]);
        $cartItems = $cartStmt->fetchAll(PDO::FETCH_ASSOC);


        $orderItemStmt = $pdo->prepare("INSERT INTO order_items (order_id, prod_id, colour_id, quantity, price_per_unit, total_price, size_id)
                                        VALUES (?, ?, ?, ?, ?, ?, ?)");

        foreach ($cartItems as $item) {
            $total_item_price = $item['quantity'] * $item['price'];
            $orderItemStmt->execute([
                $order_id,
                $item['product_id'],
                $item['colour_id'],
                $item['quantity'],
                $item['price'],
                $total_item_price,
                $item['size_id']
            ]);
        }

        $clearCartStmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ?");
        $clearCartStmt->execute([$user_id]);

        $pdo->commit();

        unset($_SESSION['total_price']);

        header("Location: ../previousorders/previousorders.php");
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        die("Error processing your order: " . $e->getMessage());
    }
}

?>
