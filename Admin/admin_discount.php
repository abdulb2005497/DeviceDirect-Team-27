<?php
session_start();

// Checks if the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../Login_page/login.php");
    exit();
}

include('../config/db.php');
include_once('../navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage Discounts</title>
    <link rel="stylesheet" href="../assests/css/style.css?v=<?php echo time(); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
</head>
<body>
    <h2 style="text-align: center; color: black; padding-top: 20px;">Discount Management System</h2>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th>Code</th>
                <th>Amount</th>
                <th>Type</th>
                <th>Expiry</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $pdo->query("SELECT * FROM discounts");
            while ($discount = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($discount['code']); ?></td>
                    <td>£<?php echo number_format($discount['discount_value'], 2); ?></td>
                    <td><?php echo ucfirst($discount['discount_type']); ?></td>
                    <td><?php echo $discount['expires_at'] ?? 'No Expiry'; ?></td>
                    <td><?php echo $discount['is_active'] ? 'Active' : 'Inactive'; ?></td>
                    <td>
                        <form action="change_discount.php" method="post" style="display:inline;">
                            <input type="hidden" name="discount_id" value="<?php echo $discount['code_id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <div style="text-align: center; margin-top: 20px;">
        <a href="update_discount.php" class="btn btn-primary">Add New Discount</a>
    </div>
</body>

<?php
include_once('../footer.php');
?>

</html>
