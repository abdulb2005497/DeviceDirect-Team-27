<?php
session_start();
include('../config/db.php');
include_once('../navbar.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../Login_page/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $discount_code = trim($_POST['discount_code']);
    $discount_value = $_POST['discount_amount'];
    $discount_type = $_POST['discount_type'];
    $discount_expiry = !empty($_POST['discount_expiry']) ? $_POST['discount_expiry'] : NULL;

    if (empty($discount_code) || empty($discount_value) || empty($discount_type)) {
        $_SESSION['error_message'] = "All fields except expiry date are required.";
        header("Location: update_discount.php");
        exit();
    }

    try {
        $stmt = $pdo->prepare("SELECT code_id FROM discounts WHERE code = ?");
        $stmt->execute([$discount_code]);
        $existingDiscount = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingDiscount) {
            $_SESSION['error_message'] = "Discount code already exists!";
            header("Location: update_discount.php");
            exit();
        } else {
            $stmt = $pdo->prepare("INSERT INTO discounts (code, discount_value, discount_type, expires_at, is_active) VALUES (?, ?, ?, ?, 1)");
            $stmt->execute([$discount_code, $discount_value, $discount_type, $discount_expiry]);
            $_SESSION['success_message'] = "New discount added successfully!";
            header("Location: admin_discount.php");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Error: " . $e->getMessage();
        header("Location: update_discount.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Discount</title>
    <link rel="stylesheet" href="../assests/css/style.css?v=<?php echo time(); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
</head>
<body>
    <h2 style="text-align: center; color: black; padding-top: 20px;">Add New Discount</h2>
    <div class="container">
        <form action="update_discount.php" method="post">
            <div class="form-group">
                <label for="discount_code">Discount Code</label>
                <input type="text" name="discount_code" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="discount_amount">Discount Amount</label>
                <input type="number" name="discount_amount" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="discount_type">Discount Type</label>
                <select name="discount_type" class="form-control" required>
                    <option value="percentage">Percentage</option>
                    <option value="fixed">Fixed</option>
                </select>
            </div>
            <div class="form-group">
                <label for="discount_expiry">Discount Expiry Date</label>
                <input type="date" name="discount_expiry" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Discount</button>
            <a href="admin_discount.php" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>
</body>
<?php
include_once('../footer.php');
?>

</html>
