<?php
session_start();
require '../config/db.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: ../Login_page/login.php");
    exit();
}

if (!isset($_GET['order_id'])) {
    die("Order ID is missing.");
}

$order_id = intval($_GET['order_id']); 
$user_id = $_SESSION['user_id']; 

$stmt = $pdo->prepare("SELECT * FROM orders WHERE order_id = ? AND user_id = ?");
$stmt->execute([$order_id, $user_id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    die("Order not found.");
}

$itemStmt = $pdo->prepare("
    SELECT oi.*, p.product_title, pv.image 
    FROM order_items oi
    JOIN product_variants pv ON oi.prod_id = pv.prod_variant_id
    JOIN products p ON pv.product_id = p.product_id
    WHERE oi.order_id = ?
");
$itemStmt->execute([$order_id]);
$order_items = $itemStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Details</title>
    <link rel="stylesheet" href="style_orders.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../contactuspage/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Merriweather', serif;
            background-color: #f8f9fa;
        }

        .order-box {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            margin: 50px auto;
            text-align: center;
        }

        .order-item {
            border-top: 1px solid #ddd;
            padding: 15px 0;
        }

        .order-item img {
            max-width: 100px;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .btn-refund {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 15px;
            margin-top: 20px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .btn-refund:hover {
            background-color: #b02a37;
        }

        .refund-message {
            color: green;
            font-weight: bold;
            margin-top: 15px;
            display: none;
        }

        .modal-content {
            border-radius: 10px;
        }
    </style>
</head>
<body>

<?php include '../navbar.php'; ?>

<div class="order-box">
    <h2>Order #<?php echo $order['order_id']; ?></h2>
    <p><strong>Total Price:</strong> $<?php echo number_format($order['total_price'], 2); ?></p>
    <p><strong>Status:</strong> <?php echo ucfirst($order['status']); ?></p>
    <p><strong>Date Ordered:</strong> <?php echo $order['date_ordered']; ?></p>

    <h3 class="mt-4">Items in Order</h3>

    <?php if (count($order_items) > 0): ?>
        <?php foreach ($order_items as $item): ?>
            <div class="order-item">
                <img src="../product_images/<?php echo $item['image']; ?>" 
                     alt="<?php echo $item['product_title']; ?>" 
                     class="img-fluid"
                     onerror="this.onerror=null; this.src='../assets/images/placeholder.png';">
                <p><strong><?php echo $item['product_title']; ?></strong></p>
                <p><strong>Quantity:</strong> <?php echo $item['quantity']; ?></p>
                <p><strong>Price Per Unit:</strong> $<?php echo number_format($item['price_per_unit'], 2); ?></p>
                <p><strong>Total Price:</strong> $<?php echo number_format($item['total_price'], 2); ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No items found in this order.</p>
    <?php endif; ?>

    <!-- Refund Button -->
    <button class="btn btn-refund" data-bs-toggle="modal" data-bs-target="#refundModal">Request Refund</button>
    <p class="refund-message">Your refund request is under review.</p>
</div>

<!-- Refund Modal -->
<div class="modal fade" id="refundModal" tabindex="-1" aria-labelledby="refundModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content p-4">
      <div class="modal-header">
        <h5 class="modal-title" id="refundModalLabel">Refund Request</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="refundForm">
          <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
          <label for="refundReason">Why are you requesting a refund?</label>
          <select class="form-control mt-2" id="refundReason" name="refund_reason" required>
            <option value="">-- Select a reason --</option>
            <option value="damaged">Product was damaged</option>
            <option value="wrong">Received wrong item</option>
            <option value="late">Late delivery</option>
            <option value="changed_mind">Changed my mind</option>
          </select>
          <button type="submit" class="btn btn-primary mt-3 w-100">Submit Refund Request</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include '../footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.getElementById("refundForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let refundReason = document.getElementById("refundReason").value;
    if (!refundReason) {
        alert("Please select a reason.");
        return;
    }

    const formData = new FormData(this);

    fetch("submit_refund.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(response => {
        if (response.trim() === "success") {
            const refundButton = document.querySelector(".btn-refund");
            refundButton.innerText = "Refund Request Under Review";
            refundButton.style.backgroundColor = "gray";
            refundButton.disabled = true;

            const message = document.querySelector(".refund-message");
            message.style.display = "block";

            const modal = bootstrap.Modal.getInstance(document.getElementById("refundModal"));
            modal.hide();
        } else {
            alert("Error: " + response);
        }
    })
    .catch(err => {
        alert("Something went wrong.");
        console.error(err);
    });
});
</script>

</body>
</html>
