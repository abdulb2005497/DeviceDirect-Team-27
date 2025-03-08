<?php
session_start();
include_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $code = trim($_POST['discount_code']);

    if (empty($code)) {
        echo json_encode(['success' => false, 'message' => 'Please enter a discount code.']);
        exit();
    }
    $stmt = $pdo->prepare("SELECT * FROM discounts WHERE code = ? AND is_active = 1 AND (expires_at IS NULL OR expires_at > NOW())");
    $stmt->execute([$code]);
    $discount = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$discount) {
        echo json_encode(['success' => false, 'message' => 'Invalid or expired discount code.']);
        exit();
    }  
    $totalAmount = $_SESSION['total_price'] ?? 0;
    if ($discount['discount_type'] == 'percentage') {
        $discountAmount = $totalAmount * ($discount['discount_value'] / 100);
    } else {
        $discountAmount = $discount['discount_value'];
    }

    $newTotal = max(0, $totalAmount - $discountAmount);
    $_SESSION['total_price'] = $newTotal;

    echo json_encode([
        'success' => true,
        'new_total' => number_format($newTotal, 2),
        'discount_amount' => number_format($discountAmount, 2),
        'message' => "Discount applied! You saved £" . number_format($discountAmount, 2),
    ]);
}
?>
