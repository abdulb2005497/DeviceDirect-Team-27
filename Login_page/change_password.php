<?php
require_once __DIR__ . '/../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$error_message = "";
$success_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $error_message = "New passwords do not match.";
    } else {
        $stmt = $pdo->prepare("SELECT password FROM users WHERE user_id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch();

        if ($user && password_verify($current_password, $user['password'])) {
            $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE user_id = ?");
            $stmt->execute([$new_password_hashed, $_SESSION['user_id']]);
            $success_message = 'Password has successfully been changed.';

            echo "<script>
                alert('Your password has been successfully changed. You will be redirected to the login page.');
                window.location.href = 'login.php';
                </script>";
            exit();
        } else {
            $error_message = "Current password is incorrect.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Change Password | DeviceDirect</title>
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <div class="form-container">
        <div class="form-box">
            <h1>Change Password</h1>
            <form method="POST" action="">
                <label for="current_password">Current Password</label>
                <input id="current_password" name="current_password" type="password" placeholder="Enter your current password" required>
                <label for="new_password">New Password</label>
                <input id="new_password" name="new_password" type="password" placeholder="Enter your new password" required>
                <label for="confirm_password">Confirm New Password</label>
                <input id="confirm_password" name="confirm_password" type="password" placeholder="Confirm your new password" required>
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
                <?php endif; ?>
                <?php if (!empty($success_message)): ?>
                    <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
                <?php endif; ?>
                <input type="submit" value="Change Password">
            </form>
        </div>
    </div>
</body>
</html>