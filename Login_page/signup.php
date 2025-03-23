<?php
require_once __DIR__ . '/../config/db.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$email_error = false;
$error_message = ""; // Initialize error message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $error_message = "Invalid CSRF token.";
    } else {
        $first_name = htmlspecialchars($_POST['first_name']);
        $last_name = htmlspecialchars($_POST['last_name']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $address = htmlspecialchars($_POST['address']);
        $city = htmlspecialchars($_POST['city']);
        $postcode = htmlspecialchars($_POST['post_code']);
        $role = 'user';
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        try {
            $stmt = $pdo->prepare("SELECT 1 FROM users WHERE LOWER(email) = LOWER(?) LIMIT 1");
            $stmt->execute([$email]);

            if ($stmt->fetch()) {
                $email_error = true;
                $error_message = "This email is already registered. Please use another email.";
            } else {
                if (!preg_match('/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) {
                    $error_message = "Password must be at least 8 characters long, include an uppercase letter, and a number.";
                } elseif ($password !== $confirm_password) {
                    $error_message = "Passwords do not match.";
                } else {
                    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                    $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, phone, address, city, post_code, password, role)
                                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$first_name, $last_name, $email, $phone, $address, $city, $postcode, $hashed_password, $role]);

                    header("Location: login.php");
                    exit();
                }
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $email_error = true;
                $error_message = "This email is already registered.";
            } else {
                $error_message = "Error. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | DeviceDirect</title>
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <div class="form-container">
        <div class="form-box">
            <h1>Sign Up</h1>
            <h4>It's free</h4>

            <?php if (!empty($error_message)): ?>
                <p class="error-message" style="color: red;"><?php echo $error_message; ?></p>
            <?php endif; ?>

            <form method="POST" action="">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

                <label for="first-name">First Name</label>
                <input id="first-name" name="first_name" type="text" placeholder="Enter your first name" required>

                <label for="last-name">Last Name</label>
                <input id="last-name" name="last_name" type="text" placeholder="Enter your last name" required>

                <label for="email">Email</label>
                <input id="email" name="email" type="email" placeholder="Enter your email"
                       class="<?php echo $email_error ? 'is-invalid' : ''; ?>" required>

                <label for="phone">Phone</label>
                <input id="phone" name="phone" type="text" placeholder="Enter your phone number" required>

                <label for="address">Address</label>
                <input id="address" name="address" type="text" placeholder="Enter your address" required>

                <label for="city">City</label>
                <input id="city" name="city" type="text" placeholder="Enter your city" required>

                <label for="postCode">Postcode</label>
                <input id="postcode" name="post_code" type="text" placeholder="Enter your postcode" required>

                <label for="password">Password</label>
                <input id="password" name="password" type="password" placeholder="Enter your password" required>

                <label for="confirm-password">Confirm Password</label>
                <input id="confirm-password" name="confirm_password" type="password" placeholder="Confirm your password" required>

                <input type="submit" value="Sign Up">
            </form>

            <p>
                By clicking the Sign Up button, you agree to our
                <br>
                <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a>.
            </p>
            <p>Already have an account? <a href="login.php">Login Here</a></p>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const emailInput = document.getElementById("email");
            <?php if ($email_error): ?>
            emailInput.setCustomValidity("Email already in use.");
            emailInput.reportValidity();
            <?php endif; ?>

            emailInput.addEventListener("input", () => {
                emailInput.setCustomValidity("");
            });
        });
    </script>
</body>
</html>
