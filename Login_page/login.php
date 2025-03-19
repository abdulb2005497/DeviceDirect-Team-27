<?php
require_once __DIR__ . '/../config/db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();}
$error_message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE Email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: ../Admin/adminpage.php"); 
        } else {
            header("Location: ../Landing-Page/index.php");
        }
        exit();
    } else {
        $error_message = "Invalid email or password.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"> <meta name="viewport" content="width=device-width,initial-scale=1.0"><title>Login | DeviceDirect</title>
    <link href="styles.css" rel="stylesheet"></head>
<body><div class="form-container"><div class="form-box">
            <h1>Login</h1><form method="POST" action="">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" placeholder="Enter your email" required>
                <label for="password">Password</label>
                <input id="password" name="password" type="password" placeholder="Enter your password" required>
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
                <?php endif; ?>
                <input type="submit" value="Login">
            </form>
            <p>Don't have an account? <a href="signup.php">Sign Up Here</a></p>
        </div>
    </div>
</body>
</html>
